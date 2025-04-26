<?php
namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductInvestment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewInvestmentNotification;
use App\Notifications\InvestmentCompletedNotification;
class PropertyInvestmentController extends Controller
{
    public function store(Request $request, $propertyId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $property = Product::findOrFail($propertyId);

        if ($property->investment_collected >= $property->price) {
            return back()->with('error', 'تم اكتمال التمويل بالفعل.');
        }

        DB::transaction(function () use ($property, $request) {
            ProductInvestment::create([
                'product_id' => $property->id,
                'user_id' => auth()->id(),
                'amount' => $request->amount,
            ]);
            $property->increment('investment_collected', $request->amount);
        });

        $owner = $property->admin;
        $owner->notify(new NewInvestmentNotification($request->amount, $property->title));
        if ($property->investment_collected >= $property->price) {
            $investors = $property->investments()->with('user')->get();
            foreach ($investors as $investment) {
                $investment->user->notify(new InvestmentCompletedNotification($property->title));
            }
        }

        return redirect()->back()->with('success', 'تمت المشاركة بنجاح!');
    }
}
