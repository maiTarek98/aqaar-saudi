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
        if(! $property){
            return abort(404);
        }
        if($property->type == 'investment'){
            return view('site.product-investment',compact('property'));
        }else{
            return view('site.property_link', compact('property'));
        }
    }

    public function verify($token)
    {
        $access = PropertyAccessLink::where('token', $token)->firstOrFail();
        $user = auth()->user();
        $already = ProductVerification::where('product_id', $access->product_id)
            ->where('user_id', $user->id)
            ->first();

        if ($already) {
            return redirect()->route('property.show', $access->property?->listing_number)
                ->with('info', 'أنت موثّق بالفعل.');
        }
        ProductVerification::create([
            'product_id' => $access->product_id,
            'user_id' => $user->id,
            'via_user_id' => $access->source_user_id,
            'verification_level' => $access->current_level + 1,
            'method' => 'link',
        ]);
        $newToken = Str::uuid();
        PropertyAccessLink::create([
            'product_id' => $access->product_id,
            'token' => $newToken,
            'current_level' => $access->current_level + 1,
            'source_user_id' => $user->id,
        ]);

        return redirect()->route('property.show', $access->property?->listing_number)
            ->with('success', 'تم توثيقك كجهة رقم ' . ($access->current_level + 1));
    }


}