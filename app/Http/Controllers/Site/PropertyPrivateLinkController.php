<?php
namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;

use App\Models\PropertyPrivateLink;
use App\Models\PropertyVerification;
use Illuminate\Support\Facades\Auth;

class PropertyPrivateLinkController extends Controller
{
    public function verify($token)
    {
        $privateLink = PropertyPrivateLink::where('token', $token)->firstOrFail();
        $user = auth()->user();
        if ($privateLink->receiver_id != $user->id) {
            abort(403, 'هذا الرابط غير مخصص لك.');
        }
        $already = PropertyVerification::where([
            'product_id' => $privateLink->product_id,
            'user_id' => $user->id,
        ])->first();

        if ($already) {
            return redirect()->route('property.show', $privateLink->product_id)
                ->with('info', 'أنت موثّق بالفعل.');
        }
        PropertyVerification::create([
            'product_id' => $privateLink->product_id,
            'user_id' => $user->id,
            'source_user_id' => auth()->id(),
            'current_level' => $privateLink->current_level,
            'method' => 'private_link',
        ]);
        $privateLink->update(['used' => true]);

        return redirect()->route('property.show', $privateLink->product_id)
            ->with('success', 'تم توثيقك بنجاح!');
    }
}
