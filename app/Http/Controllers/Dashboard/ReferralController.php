<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdCategory\StoreAdCategoryRequest;
use App\Models\Referral;
use App\Models\ReferralLog;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index()
    {
        $referral = Referral::where('user_id', auth('admin')->id())->first();
        return view('admin.referrals.index', compact('referral'));
    }

    public function store(Request $request)
    {
        $referral = Referral::create([
            'user_id' => auth('admin')->id(),
            'referral_code' => auth('admin')->user()->generateReferralCode(),
            'points' => 0,
        ]);

        return redirect()->route('referral.index');
    }

    public function addPoints(Request $request)
    {
        $referral = Referral::where('referral_code', $request->referral_code)->first();

        if ($referral) {
            $referral->increment('points', 10); // Add 10 points for the referral
            ReferralLog::create([
                'referrer_id' => $referrer->id,
                'referred_user_id' => $user->id,
                'points_awarded' => 10,
            ]);
            return response()->json(['message' => 'Points added successfully!']);
        }



        return response()->json(['message' => 'Invalid referral code!'], 400);
    }
}
