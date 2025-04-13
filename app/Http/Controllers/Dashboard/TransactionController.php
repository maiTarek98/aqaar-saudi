<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\FinanceService;

class TransactionController extends Controller
{
    public function __invoke()
    {
        $revenues = FinanceService::calculateMonthlyRevenue();
        return view('admin.transactions.index', ['transactions' => Transaction::paginate(10),            'storesRevenue' => $revenues['stores_revenue'],
            'adminRevenue' => $revenues['admin_total']]);
    }
}
