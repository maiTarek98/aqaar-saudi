<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\UserController;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
use DB;
use Carbon\Carbon;
use Notification;
use App\Models\PropertyAccessLink;
use App\Models\ProductVerification;
use Illuminate\Support\Facades\Auth;
use Str;
class PropertyVerificationController extends Controller {

    public function show($listing_number)
    {
        $property = Product::with('access_links.source_user')->where('listing_number',$listing_number)->first();
        $requests = PropertyDelegation::where('property_id', $property->id)->where('status', 'pending')->get();

        if(! $property){
            return abort(404);
        }
        if($property->type == 'investment'){
            return view('site.product-investment',compact('property','requests'));
        }elseif($property->type == 'auction'){
            return view('site.product-auction',compact('property','requests'));
        }else{
            return view('site.property_link', compact('property','requests'));
        }
    }

    public function verify($token, Request $request)
    {
        $access = PropertyAccessLink::where('token', $token)->firstOrFail();
        $user = auth()->user();
        $already = ProductVerification::where('product_id', $access->product_id)
            ->where('user_id', $user->id)
            ->first();
        if($access->property?->status == 'closed'){
            return redirect()->route('property.show', $access->property?->listing_number)
                ->with('info', 'انتهي العرض');
        }
        if ($already) {
            return redirect()->route('property.show', $access->property?->listing_number)
                ->with('info', 'أنت موثّق بالفعل.');
        }
        $parentLevel = $access->current_level ?? 0;
        $newLevel = $parentLevel + 1;
        if ($user->id != $access->property?->added_by) {
            ProductVerification::create([
                'product_id' => $access->product_id,
                'user_id' => $user->id,
                'via_user_id' => $access->source_user_id,
                'verification_level' => $newLevel,
                'method' => $request->filled('source') ? 'link' : 'qr',
            ]);
            $newToken = Str::uuid();
            PropertyAccessLink::create([
                'product_id' => $access->product_id,
                'token' => $newToken,
                'current_level' => $newLevel,
                'source_user_id' => $user->id,
                'parent_id' => $access->id,
                'method' => $request->filled('source') ? 'link' : 'qr',
            ]);
    
            return redirect()->route('property.show', $access->property?->listing_number)
                ->with('success', 'تم توثيقك كجهة رقم ' . $newLevel);
        }
        return redirect()->route('property.show', $access->property?->listing_number);
    }



}