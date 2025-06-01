<?php
namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;

use App\Models\PropertyPrivateLink;
use App\Models\ProductVerification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductOffer;
use Illuminate\Http\Request;
use App\Notifications\OfferApprovedNotification;
use App\Notifications\NewProductOfferNotification;

use Notifications;
class PropertyPrivateLinkController extends Controller
{
    public function verify($token)
    {
        $privateLink = PropertyPrivateLink::where('token', $token)->firstOrFail();
        $user = auth()->user();
        // if ($privateLink->phone_number != $user->mobile) {
        //     abort(403, 'هذا الرابط غير مخصص لك.');
        // }
        $already = ProductVerification::where([
            'product_id' => $privateLink->product_id,
            'user_id' => $user->id,
        ])->first();

        if ($already) {
            return redirect()->route('property.show', $privateLink->product_id)
                ->with('info', 'أنت موثّق بالفعل.');
        }
        ProductVerification::create([
            'product_id' => $privateLink->product_id,
            'user_id' => $user->id,
            'via_user_id' => $privateLink->property?->added_by,
            'verification_level' => $privateLink->verification_level,
            'method' => (request('source'))?'link':'qr',
        ]);
        $privateLink->update(['used' => true]);

        return redirect()->route('property.show', $privateLink->property?->listing_number)
            ->with('success', 'تم توثيقك كجهة رقم ' . ($privateLink->verification_level));
    }
    
    public function offers(User $user,Product $property) {
		$urlPrevious = url()->current();
      	session()->put('url.intended', $urlPrevious);
      	$offers = $property->offers;
		return view('site.property-offers',compact('user','property','offers'));
	}
	
	
	public function storeOffer(Request $request, $productId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);
    
        $product = Product::findOrFail($productId);
    
        $offer = ProductOffer::create([
            'product_id' => $product->id,
            'user_id' => auth('web')->id(),
            'amount' => $request->amount,
            'status' => 'pending',
        ]);
        $owner = $product->admin; // تأكد إن العلاقة موجودة في موديل Product
    $owner->notify(new NewProductOfferNotification($offer));

        return back()->with('success', 'تم تقديم عرضك بنجاح.');
    }

    // public function approveOffer(Request $request, ProductOffer $offer)
    // {
    //     $offer->product?->update(['status' => 'closed']);
    //     $offer->update(['status' => 'approve']);
    //     $offer->user->notify(new OfferApprovedNotification(
    //         'تم قبول عرضك',
    //         'تهانينا! تم قبول عرضك على العقار رقم #' . $offer->product_id . ' بقيمة ' . number_format($offer->amount) . ' ريال.'
    //     ));
    //     ProductOffer::where('product_id', $offer->product_id)
    //         ->where('id', '!=', $offer->id)
    //         ->get()
    //         ->each(function ($otherOffer) use ($offer) {
    //             $otherOffer->user->notify(new OfferApprovedNotification(
    //                 'تم قبول عرض آخر',
    //                 'نأسف! تم قبول عرض آخر على العقار رقم #' . $offer->product_id . ' بقيمة ' . number_format($offer->amount) . ' ريال.'
    //             ));
    //         });
    
    //     return back()->with('success', 'تم قبول العرض وإشعار جميع المتقدمين.');
    // }
    
    
    public function approveOffer(Request $request, ProductOffer $offer)
    {
        $existingApproved = ProductOffer::where('product_id', $offer->product_id)
            ->where('status', 'approve')
            ->exists();
        if ($existingApproved) {
            return back()->with('error', 'لا يمكن قبول هذا العرض، لقد تم بالفعل قبول عرض آخر لهذا العقار.');
        }
        $offer->product?->update(['status' => 'closed']);
        $offer->update(['status' => 'approve']);
        $offer->user->notify(new OfferApprovedNotification(
            'تم قبول عرضك',
            'تهانينا! تم قبول عرضك على العقار رقم #' . $offer->product_id . ' بقيمة ' . number_format($offer->amount) . ' ريال.'
        ));
    
        // إشعار باقي المتقدمين أن عرضًا آخر قد تم قبوله
        // ProductOffer::where('product_id', $offer->product_id)
        //     ->where('id', '!=', $offer->id)
        //     ->get()
        //     ->each(function ($otherOffer) use ($offer) {
        //         $otherOffer->user->notify(new OfferApprovedNotification(
        //             'تم قبول عرض آخر',
        //             'نأسف! تم قبول عرض آخر على العقار رقم #' . $offer->product_id . ' بقيمة ' . number_format($offer->amount) . ' ريال.'
        //         ));
        //     });
    
        return back()->with('success', 'تم قبول العرض وإشعار جميع المتقدمين.');
    }



}
