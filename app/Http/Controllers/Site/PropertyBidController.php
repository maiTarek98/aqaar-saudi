<?php
namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
	use App\Notifications\AuctionWinnerNotification;

class PropertyBidController extends Controller
{
    public function store(Request $request, $propertyId)
	{
	    $request->validate([
	        'amount' => 'required|numeric|min:1',
	    ]);

	    $property = Product::findOrFail($propertyId);
	    $now = now();
	    if ($property->start_date && $now->lt($property->start_date)) {
	        return back()->with('error', 'المزاد لم يبدأ بعد.');
	    }
	    if ($property->end_date && $now->gt($property->end_date)) {
	        return back()->with('error', 'انتهى المزاد ولا يمكن تقديم عروض جديدة.');
	    }
	    if ($property->status == 'closed') {
		    return back()->with('error', 'تم إغلاق المزاد ولا يمكنك تقديم عروض.');
		}
	    $minimumBid = $property->investment_collected ?? $property->start_date;

	    if ($request->amount <= $minimumBid) {
	        return back()->with('error', 'يجب أن يكون عرضك أعلى من السعر الحالي.');
	    }
	    DB::transaction(function () use ($property, $request) {
	        ProductBid::create([
	            'product_id' => $property->id,
	            'user_id' => auth()->id(),
	            'amount' => $request->amount,
	        ]);

	        $property->update([
	            'investment_collected' => $request->amount,
	        ]);
	    });

	    return redirect()->back()->with('success', 'تم إضافة العرض بنجاح!');
	}


	public function closeAuction($id)
	{
	    $property = Product::with('bids.user')->findOrFail($id);

	    if (auth()->id() !== $property->added_by) {
	        abort(403, 'غير مصرح لك بإغلاق هذا المزاد.');
	    }

	    $property->update([
	        'status' => 'closed',
	    ]);
	    $winningBid = $property->bids->sortByDesc('amount')->first();

	    if ($winningBid) {
	        $winner = $winningBid->user;
	        $winner->notify(new AuctionWinnerNotification($property->title, $winningBid->amount));
	    }

	    return redirect()->back()->with('success', 'تم إغلاق المزاد بنجاح وتم إخطار الفائز.');
	}


}
