<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\Api\User\AuthResource;
use App\Http\Resources\Api\User\WalletResource;
use App\Http\Requests\Dashboard\User\StoreUserRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\ActivateAccountRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Traits\ApiResponses;
use App\Http\Traits\UploadImageTrait;
class AuthController extends Controller
{
    use ApiResponses;
    use UploadImageTrait;
    public function register(StoreUserRequest $request)
    {
        $user = User::create($request->validated()+['account_type' => 'users']);
        $token = JWTAuth::fromUser($user);
        $user->mobile_code = $user->activationCode();
        $user->save();
        $userData =new AuthResource($user);
        return $this->createdResponse($userData,__('api.user created'));
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('mobile', $request->mobile)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->unauthorizedResponse('error');
        }

        if ($user->status === 'blocked') {
            return $this->forbiddenResponse(__('api.contact with admin'));
        }

        if ($user->status === 'pending') {
            $user->mobile_code = $user->activationCode();
            $user->save();
            return $this->successResponse(new AuthResource($user), __('api.sent sms message'));
        }
        $rememberMe = $request->filled('remember_me') && $request->remember_me;
        if ($rememberMe) {
            JWTAuth::factory()->setTTL(60 * 24 * 7);
        } else {
            JWTAuth::factory()->setTTL(60); 
        }

        $token = JWTAuth::fromUser($user);
        $user->update(['last_login' => now()]);
        $payload = JWTAuth::setToken($token)->getPayload();
        $expiration = $payload->get('exp')??null;

        $now = Carbon::now()->timestamp; 
        $isExpired = $expiration <= $now; 

        $userData =[    
                'user' => new AuthResource($user),
                'token' => $token,
                'isExpired' => $isExpired,
        ];
        return $this->successResponse($userData, __('api.user login'));
    }


    public function activateAccount(ActivateAccountRequest $request)
    {
        $user = User::where('mobile', $request->mobile)->first();
        if ($user->mobile_code !== (int) $request->verification_code) {
            return $this->errorResponse(__('api.Invalid verification code'));
        }
        $user->status = 'accepted';
        $user->mobile_code = null;
        $user->mobile_verified_at = now();
        $user->save();
        return $this->successResponse('done',__('api.mobile activated'));
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return $this->successResponse('done',__('api.user logout'));
    }
    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }

    public function profile()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $token = JWTAuth::fromUser($user);
        $payload = JWTAuth::setToken($token)->getPayload();
        $expiration = $payload->get('exp')??null;

        $now = Carbon::now()->timestamp; 
        $isExpired = $expiration <= $now; 

        $userData =[    
                'user' => new AuthResource($user),
                'token' => $token,
                'isExpired' => $isExpired,
        ];
        return $this->successResponse($userData,__('api.user profile'));
    }
    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|min:2|max:130',
            'email' => 'sometimes|email|unique:users,email,'.$user->id,
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
        $user->update($request->only(['name', 'email']));
        $userData = new AuthResource(auth('api')->user());
        return $this->successResponse($userData,__('api.update user profile'));
    }

    public function updatePhoto(Request $request)
    {
        $user = auth('api')->user();
        $validator = Validator::make($request->all(), [
            'photo_profile' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
        if($request->hasFile('photo_profile') && $request->file('photo_profile')->isValid())
        {
            $user->clearMediaCollection('photo_profile'); 
            $this->convertImageToWebp($request->photo_profile,$user,'photo_profile','users');
        }
        $userData = new AuthResource($user);
        return $this->successResponse($userData,__('api.update photo profile'));
    }


    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric|digits:10|exists:users,mobile',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
        $user = User::where('mobile', $request->mobile)->first();
        if (!$user) {
            return $this->errorResponse(__('api.user not found'));
        }
        $user = User::where('mobile', $request->mobile)->first();
        $resetCode = '1234';
        DB::table('password_resets')->updateOrInsert(
            ['mobile' => $request->mobile],
            ['token' => $resetCode, 'created_at' => Carbon::now()]
        );
        //send by sms 
        // return response()->json(['message' => 'تم إرسال كود إعادة تعيين كلمة المرور', 'reset_code' => $resetCode]);
        return $this->successResponse($resetCode,__('api.code sent'));

    }
    public function checkResetCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10|exists:users,mobile',
            'code' => 'required|numeric|digits:4'
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
        $exists = DB::table('password_resets')
            ->where('mobile', $request->mobile)
            ->where('token', $request->code)
            ->exists();

        if (!$exists) {
            return $this->errorResponse(__('api.error in code sent'));

        }
        return $this->successResponse(['mobile'=>$request->mobile,'code' => $request->code],__('api.now, you can reset password'));
    }
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10|exists:users,mobile',
            'code' => 'required|numeric|digits:4',
            'password' => 'required|string|min:6|max:20'
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
        $reset = DB::table('password_resets')
            ->where('mobile', $request->mobile)
            ->where('token', $request->code)
            ->first();
        if (!$reset) {
            return $this->errorResponse(__('api.error in code sent'));
        }
        $user = User::where('mobile', $request->mobile)->first();
        $user->password = ($request->password);
        $user->save();
        DB::table('password_resets')->where('mobile', $request->mobile)->delete();
        return $this->successResponse($user,__('api.reset password is done'));
    }
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string|min:6|max:20',
            'password' => 'required|string|min:6|max:20|confirmed',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
        $user = auth('api')->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return $this->errorResponse(__('api.current password incorrect'));
        }
        $user->password = ($request->password);
        $user->save();
        $userData= new AuthResource(auth('api')->user());
        return $this->successResponse($userData,__('api.change password is done'));
    }

    public function deleteAccount(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $validator = Validator::make($request->all(), [
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->first());
            }
            if (!Hash::check($request->password, $user->password)) {
                return $this->errorResponse(__('api.current password incorrect'));
            }
            DB::beginTransaction();
            // Optional: Delete Related Data (Orders, Wishlists, etc.)
            // $user->orders()->delete();
            // $user->wishlist()->delete();
            // $user->reviews()->delete();

            // Delete User
            $user->delete();
            JWTAuth::invalidate(JWTAuth::getToken());
            DB::commit();
            return $this->successResponse('done',__('api.Account deleted successfully'));

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse(__('api.failed to delete'));
        }
    }

    public function getNotifications()
    {
        $user = auth('api')->user();
        $notifications = $user->notifications; 
        return $this->successResponse($notifications,__('api.all notifications'));

        $notification = $user->notifications()
        ->whereJsonContains('data->id', $screenId) // البحث داخل الـ JSON
        ->whereNull('read_at') // فقط الإشعارات غير المقروءة
        ->first();
    }
    public function requestChangeMobile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10|exists:users,mobile',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
        $user = auth('api')->user();
        // $otpCode = mt_rand(1000, 9999);
        $otpCode = '1234';

        // Store OTP in the database
        DB::table('mobile_changes')->updateOrInsert(
            ['user_id' => $user->id],
            [
                'old_mobile' => $request->mobile,
                'otp_code' => $otpCode,
                'created_at' => Carbon::now()
            ]
        );

        // Here, send OTP via SMS (implement SMS service)
        // sendSms($request->new_mobile, "Your OTP Code is: $otpCode");
        return $this->successResponse('otp done',__('api.otp is sent'));
    }
    public function verifyChangeMobile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10|exists:users,mobile',
            'otp_code' => 'required|numeric|digits:4',
            'new_mobile' => 'required|digits:10|unique:users,mobile',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
        $user = auth('api')->user();
        $otpRecord = DB::table('mobile_changes')
            ->where('user_id', $user->id)
            ->where('old_mobile', $request->mobile)
            ->where('otp_code', $request->otp_code)
            ->first();
        if (!$otpRecord) {
            return $this->errorResponse('otp done',__('api.Invalid OTP or mobile number'));
        }
        $user->update(['mobile' => $request->new_mobile]);
        DB::table('mobile_changes')->where('user_id', $user->id)->delete();
        $userData= new AuthResource($user);
        return $this->successResponse($userData,__('api.Mobile number updated successfully'));

    }
    
    public function wallet(Request $request)
    {
        $user = auth('api')->user();
        $wallet = $user->wallet;
        
        if (!$wallet) {
            return $this->errorResponse(__('api.No wallet found.'));
        }
        $transactions = $wallet->transactions;
        $userData = WalletResource::collection($transactions);
        return $this->successResponse([
                    'balance' => (double) $wallet->balance,
                    'transactions' => $userData
                ],__('api.Wallet data'));
    }
        
}
