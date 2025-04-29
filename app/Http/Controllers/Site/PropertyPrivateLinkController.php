<?php
namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;

use App\Models\PropertyPrivateLink;
use App\Models\ProductVerification;
use Illuminate\Support\Facades\Auth;

class PropertyPrivateLinkController extends Controller
{
    public function verify($token)
    {
        $privateLink = PropertyPrivateLink::where('token', $token)->firstOrFail();
        $user = auth()->user();
        if ($privateLink->phone_number != $user->mobile) {
            abort(403, 'هذا الرابط غير مخصص لك.');
        }
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
}
