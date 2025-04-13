<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\InvoiceTemplate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
class InvoiceController extends Controller
{
    public function storeTemplate(Request $request)
    {
        $data = $request->except('_token');
        $templates = InvoiceTemplate::where('id',$request->id)->update($data);
        return back();
    }
    public function create()
    {
        $templates = InvoiceTemplate::get();
        $users = User::where('account_type','users')->get();
        $products =Product::get();
        return view('invoices.create', compact('templates','users','products'));
    }

    public function store(Request $request)
    {
        $invoice = Order::create([
            'order_no' => $request->invoice_number,
            'order_date' => $request->invoice_date,
            'user_id' => $request->customer_id,
            'notes' => $request->notes,
            // 'discount' => $request->coupon_discount,
            // 'total_amount' => $request->final_total,
        ]);

        foreach ($request->items as $item) {
            Cart::create([
                'order_id' => $invoice->id,
                'user_id' => $invoice->user_id,
                'product_id' => $item['product_id'],
                'qty' => $item['quantity'],
                'price' => $item['price'],
                // 'total' => $item['quantity'] * $item['price'],
            ]);
        }

        return redirect()->route('invoices.show', $invoice->id);
    }

    public function show($id)
    {
        $invoice = Order::with('carts')->findOrFail($id);
        return view('invoices.show', compact('invoice'));
    }

    public function generatePDF($id, $templateId)
    {
        $invoice = Order::with('carts')->findOrFail($id);
        $template = InvoiceTemplate::findOrFail($templateId);
        $html = $this->renderTemplate($template->html_template, $invoice);

        $pdf = \PDF::loadHTML($html);
        return $pdf->download("invoice_{$invoice->order_no}.pdf");
    }

    private function renderTemplate($template, $invoice)
    {
        return view('invoices.templates.raw', compact('template', 'invoice'))->render();
    }
}
