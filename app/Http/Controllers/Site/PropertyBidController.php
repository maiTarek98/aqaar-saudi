<?php
namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\AuctionWinnerNotification;
use App\Models\User;
use App\Notifications\NotifyNewBidAdded;

class PropertyBidController extends Controller
{
    public function store(Request $request, $propertyId)
	{
	    $request->validate([
	        'amount' => 'required|numeric|min:1',
	    ]);

	    $property = Product::where('status','pending')->where('id',$propertyId)->first();
	    if(!$property){
	       abort(403, 'غير مصرح لك بالمزايدة داخل هذا المزاد.');
	    }
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
	       $owner= User::find($property->added_by);
            if ($owner) {
                $owner->notify(new NotifyNewBidAdded($property, $request->amount));
            }
            foreach ($property->property_delegations as $delegation) {
                if ($delegation->agent && $delegation->status == 'approved') {
                    $delegation->agent->notify(new NotifyNewBidAdded($property, $request->amount));
                }
            }

	    });

	    return redirect()->back()->with('success', 'تم إضافة العرض بنجاح!');
	}


// 	public function closeAuction($id)
//     {
//         $property = Product::with('bids.user')->findOrFail($id);
//         if ($property->status == 'closed') {
//             return redirect()->back()->with('error', 'المزاد مغلق بالفعل');
//         }
//         if (auth()->id() !== $property->added_by) {
//             abort(403, 'غير مصرح لك بإغلاق هذا المزاد.');
//         }
//         $winningBid = $property->bids->sortByDesc('amount')->first();
//         $property->update([
//             'status'     => 'closed',
//             'winner_id'  => $winningBid?->user_id, 
//         ]);
//         if ($winningBid) {
//             $winner = $winningBid->user;
//             $winner->notify(new \App\Notifications\AuctionWinnerNotification(
//                 $property->title,
//                 $winningBid->amount
//             ));
//         }
//         $owner = $property->admin;
//         $owner->notify(new \App\Notifications\AuctionClosedNotification(
//             $property->title,
//             $winningBid?->amount,
//             $winningBid?->user?->name
//         ));
//         $notifiedUserIds = [];
//         foreach ($property->bids as $bid) {
//             if (
//                 $bid->user_id !== $winningBid?->user_id &&
//                 !in_array($bid->user_id, $notifiedUserIds)
//             ) {
//                 $bid->user->notify(new \App\Notifications\AuctionEndedNotification(
//                     $property->title
//                 ));
//                 $notifiedUserIds[] = $bid->user_id;
//             }
//         }
    
//         return redirect()->back()->with('success', 'تم إغلاق المزاد بنجاح وتم إخطار الفائز وباقي المشاركين.');
//     }
    public function closeAuction(Request $request, $id)
    {
        $property = Product::with('bids.user')->findOrFail($id);
    
        if (auth()->id() !== $property->added_by) {
            abort(403, 'غير مصرح لك بإدارة هذا المزاد.');
        }
    
        $actionType = $request->input('status', 'closed');
    
        if ($property->status == 'closed' && $actionType === 'closed') {
            return redirect()->back()->with('error', 'المزاد مغلق بالفعل.');
        }
    
        switch ($actionType) {
            case 'inactive': // إيقاف مؤقت
                $property->update([
                    'status' => 'inactive', // تأكد أن العمود موجود في جدول المنتجات
                ]);
                return redirect()->back()->with('success', 'تم إيقاف المزاد مؤقتًا.');
    
            case 'cancelled': // إلغاء نهائي بدون فائز
                $property->update([
                    'status'          => 'cancelled',
                    'winner_id'       => null,
                ]);
                return redirect()->back()->with('success', 'تم إلغاء المزاد بنجاح.');
    
            case 'closed': // إغلاق رسمي مع فائز
            default:
                $winningBid = $property->bids->sortByDesc('amount')->first();
    
                $property->update([
                    'status'     => 'closed',
                    'winner_id'  => $winningBid?->user_id,
                ]);
    
                if ($winningBid) {
                    $winner = $winningBid->user;
                    $winner->notify(new \App\Notifications\AuctionWinnerNotification(
                        $property->title,
                        $winningBid->amount
                    ));
                }
    
                $owner = $property->admin;
                $owner->notify(new \App\Notifications\AuctionClosedNotification(
                    $property->title,
                    $winningBid?->amount,
                    $winningBid?->user?->name
                ));
    
                $notifiedUserIds = [];
                foreach ($property->bids as $bid) {
                    if (
                        $bid->user_id !== $winningBid?->user_id &&
                        !in_array($bid->user_id, $notifiedUserIds)
                    ) {
                        $bid->user->notify(new \App\Notifications\AuctionEndedNotification(
                            $property->title
                        ));
                        $notifiedUserIds[] = $bid->user_id;
                    }
                }
    
                return redirect()->back()->with('success', 'تم إغلاق المزاد بنجاح وتم إخطار الفائز وباقي المشاركين.');
        }
    }

    public function resumeAuction($id)
    {
        $property = Product::findOrFail($id);
        if (auth()->id() !== $property->added_by) {
            abort(403, 'غير مصرح لك بتفعيل هذا المزاد.');
        }
        if ($property->status !== 'inactive') {
            return redirect()->back()->with('error', 'لا يمكن تفعيل المزاد لأنه ليس في حالة إيقاف مؤقت.');
        }
    
        $property->update([
            'status' => 'pending', // أو أي حالة تعني أنه تم استئناف المزاد
        ]);
    
        return redirect()->back()->with('success', 'تم تفعيل المزايدة بنجاح.');
    }

}
