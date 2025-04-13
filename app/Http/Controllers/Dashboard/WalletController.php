<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    // استرجاع تفاصيل المحفظة
    public function show()
    {
        $wallet = Auth::user()->wallet;
        
        if (!$wallet) {
            return response()->json(['message' => 'لم يتم العثور على محفظة لهذا المستخدم'], 404);
        }

        return response()->json([
            'balance' => $wallet->balance,
            'transactions' => $wallet->transactions()->latest()->get()
        ]);
    }

    // إضافة أموال إلى المحفظة
    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01'
        ]);

        $wallet = Auth::user()->wallet ?? Wallet::create(['user_id' => Auth::id(), 'balance' => 0]);

        $wallet->balance += $request->amount;
        $wallet->save();

        WalletTransaction::create([
            'wallet_id' => $wallet->id,
            'type' => 'deposit',
            'amount' => $request->amount,
            'description' => 'إيداع في المحفظة'
        ]);

        return response()->json(['message' => 'تم إضافة الأموال بنجاح', 'balance' => $wallet->balance]);
    }

    // سحب أموال من المحفظة
    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01'
        ]);

        $wallet = Auth::user()->wallet;

        if (!$wallet || $wallet->balance < $request->amount) {
            return response()->json(['message' => 'الرصيد غير كافٍ'], 400);
        }

        $wallet->balance -= $request->amount;
        $wallet->save();

        WalletTransaction::create([
            'wallet_id' => $wallet->id,
            'type' => 'withdrawal',
            'amount' => $request->amount,
            'description' => 'سحب من المحفظة'
        ]);

        return response()->json(['message' => 'تم سحب الأموال بنجاح', 'balance' => $wallet->balance]);
    }
}
