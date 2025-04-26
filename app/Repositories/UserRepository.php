<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Models\PendingVendor;
use App\Http\Traits\UploadImageTrait;
use Arr;
use DB;
use Mail;
use Illuminate\Support\Facades\Cache;

use Carbon\Carbon;
class UserRepository implements UserRepositoryInterface 
{
    use UploadImageTrait;

    public function getAllUsers($request) 
    {
        

$searchQuery = trim($request->query('search'));
$users = User::query();

// Filter by account type only if it's provided
if ($request->query('account_type')) {
    if($request->query('account_type') == 'admins'){
        $users->whereIn('account_type',['admins','subadmins']);
    }
    $users->where('account_type', $request->query('account_type'));
}

// Search by name or email if a search query is provided
if (!empty($searchQuery)) {
    $users->where(function ($query) use ($searchQuery) {
        $query->where('name', 'like', '%' . $searchQuery . '%')
              ->orWhere('email', 'like', '%' . $searchQuery . '%');
    });
}

// Filter by date range if provided
if ($request->query('from_date')) {
    $fromDate = Carbon::parse($request->query('from_date'));
    $users->where('created_at', '>=', $fromDate);
}

if ($request->query('to_date')) {
    $toDate = Carbon::parse($request->query('to_date'));
    $users->where('created_at', '<=', $toDate);
}

// Order by ID and paginate the results
$users = $users->orderBy('id', 'desc')->paginate(30);

return $users;
    }
 
    public function getUserById($userId) 
    {
        return User::findOrFail($userId);
    }

    public function deleteUser($userId) 
    {
        if($userId == 1){
            abort(403);
        }
        $get_user = User::whereId($userId)->delete();
        
    }
    public function createUser(array $userDetails) 
    {  
        unset($userDetails['photo_profile']);
        $userDetails['password'] =$userDetails['password'];
        $userDetails['roles_name'] = json_encode($userDetails['roles_name']);

        $user = User::create($userDetails);
        $user->status = 'accepted';
        if(request()->hasFile('photo_profile') && request()->file('photo_profile')->isValid())
        {
            $this->convertImageToWebp(request('photo_profile'),$user,'photo_profile','users');
        }
        if($userDetails['account_type'] == 'admins'||$userDetails['account_type'] == 'subadmins' ||$userDetails['account_type'] == 'vendors' ||$userDetails['account_type'] == 'subadmins'){
            $user->assignRole(json_decode($userDetails['roles_name']));
        }

        if($user->hasRole(1)){
            $user->account_type = 'admins';            
        }elseif($user->hasRole(3)){
            $user->account_type = 'subadmins';
        }elseif($user->hasRole(4)){
            $account_type = 'vendors';
        }
        $user->card_code = $user->generateCardCode();
        $user->save();

        $request = request();
        // $password[]=$request->password;

        //send emails by number of branches
        $to_email = $user->email;
        if($to_email){
            try{
            // $mail=Mail::send('emails.send_pending_vendor_acceptance_email', ['user' => $user->name, 'email' => $to_email, 'mobile' => $mobile, 'password' => $password], function($message) use ($request, $to_email) {
            //     $message->to($to_email);
            //     $message->subject('Send Notification');
            // });
            } catch (\Exception $e) {
                return false;
            }
        }
        if($user->account_type == 'vendors'){
        
        $vendor = PendingVendor::where('id', $user->pending_vendor_id)->first();
        if($vendor){
            $vendor->update(['status' => 'accepted']);
        }
            session()->put('vendor_id', $user->id);
            Cache::put('vendor_created', true, now()->addMinutes(1));
            dispatch(function () {
                session()->forget('vendor_id');
            })->delay(now()->addMinute());

        }
        return $user;
    }

    public function updateUser($userId, array $newDetails) 
    {

        unset($newDetails['photo_profile']);
        unset($newDetails['user_id']);
        $get_user = User::whereId($userId)->first();
        if(request()->hasFile('photo_profile') && request()->file('photo_profile')->isValid())
        {
            $this->convertImageToWebp(request('photo_profile'),$get_user,'photo_profile','users');
        }

        if(!empty($newDetails['password'])){
            $newDetails['password'] = bcrypt($newDetails['password']);
        }else{
            $newDetails = Arr::except($newDetails,array('password'));
        }
        if($get_user->id != 1 && $newDetails['account_type'] == 'admins'||$newDetails['account_type'] == 'subadmins' ||$newDetails['account_type'] == 'vendors'){
            DB::table('model_has_roles')->where('model_id',$get_user->id)->delete();
            $get_user->assignRole($newDetails['roles_name']);
        }
        
        // if($get_user->hasRole(2)){
        //     $account_type = 'admins';            
        // }elseif($get_user->hasRole(3)){
        //     $account_type = 'subadmins';
        // }
        // elseif($get_user->hasRole(4)){
        //     $account_type = 'vendors';
        // }else{
        //     $account_type = null;
        // }
        // $newDetails['account_type'] = $account_type;
        return User::whereId($userId)->update($newDetails);
    }

    public function deleteAllUsers($ids) 
    {
        $idArray = explode(",", $ids);
        if (in_array(1, $idArray)) {
            abort(403, 'Unauthorized action: Cannot delete user with ID 1.');
        }
        return User::whereIn('id', $idArray)->delete();
    }


}