<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Order\OrderRequest;
use App\Models\Order;
use App\Models\ActivityLog;
use App\Models\ProductCapacity;
use App\Models\Product;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:orders-list|orders-create|orders-edit|orders-delete', ['only' => ['index','store']]);
        $this->middleware('permission:orders-list', ['only' => ['show']]);
        $this->middleware('permission:orders-create', ['only' => ['create','store']]);
        $this->middleware('permission:orders-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:orders-delete', ['only' => ['destroy']]);
    }
public function downloadInvoice(Request $request)
{
    $invoice = Cart::where('id', $request->id)->first();       
    view()->share('invoice', $invoice);

    $pdf = null;

    if ($request->type === 'admin') {
        if ($request->has('download')) {
            $pdf = PDF::loadView('pdfInvoice')->setOptions(['images' => true]);
            return $pdf->download('invoice_of_no_' . $request->id . '_' . now() . '.pdf');
        }
        return view('pdfInvoice');
    } elseif ($request->type === 'worker') {
        if ($request->has('download')) {
            $pdf = PDF::loadView('pdfWorkerInvoice')->setOptions([
              'images' => true
          ]) ->setOption('no-images', false)
          ->setOption('enable-local-file-access', true)
           -> setOption('enable-external-links', true);
            return $pdf->download('invoice_of_worker_no_' . $request->id . '_' . now() . '.pdf');
        }
        return view('pdfWorkerInvoice');
    }

    return abort(404); // or handle unexpected types
}
    // public function index(Request $request)
    // {
    //     $per_page = $request->input('per_page', 10);
    //     $sortBy = $request->input('sortBy', 'desc');
    //     $result = Order::with(['user','store'])->orderBy('id', $sortBy)->paginate($per_page);
    //     $fields = ['id', 'order_no','storename' ,'username','payment_type', 'status'];
    //     $model = 'orders';
    //     $queryParameters = $request->query(); // Get query parameters
    //     if ($request->ajax()) {

    //         return response()->json([
    //             'html' => view('components.crud-table', compact('result', 'fields','queryParameters', 'model'))->render(),
    //         ]);
    //     }
    //     return view('admin.orders.index', compact('result', 'fields','queryParameters', 'model'));
    // }
    public function create(Request $request)
    {
        return redirect()->route('invoices.create');
    }
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 10);
        $sortBy = $request->input('sortBy', 'asc');
        $filter = $request->input('filter', null); // Get the filter parameter

        // Apply filtering logic based on the selected filter
        $query = Order::query();
        if ($filter) {
            switch ($filter) {
                case 'pending':
                    $query->where('status', 'pending');
                    break;
                case 'accepted':
                    $query->where('status', 'accepted');
                    break;
                case 'shipped':
                    $query->where('status', 'shipped');
                    break;
                case 'completed':
                    $query->where('status', 'completed');
                    break;
                case 'return':
                    $query->where('status', 'return');
                    break;
                case 'declined':
                    $query->where('status', 'declined');
                    break;
                default:
                    break;
            }
        }
        $res = $query->with(['user','store'])->when($request->query('store_id'), function($query, $store_id) {
                $query->where('store_id', $store_id);
            })->when($request->query('user_id'), function($query, $user_id) {
                $query->where('user_id', $user_id);
            })->orderBy('id', $sortBy);
        if ($per_page === 'all') {
            $result = $res->get(); 
        } else {
            $result = $res->paginate((int) $per_page);
            $result->withQueryString();
        }
        $fields = ['id', 'order_no','storename' ,'username','payment_type', 'status'];

        $model = 'orders';
        $queryParameters = $request->query();
         // Count orders by status
        $counts = [
            'pending' => Order::where('status', 'pending')->count(),
            'accepted' => Order::where('status', 'accepted')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'return' => Order::where('status', 'return')->count(),
            'declined' => Order::where('status', 'declined')->count(),
        ];
        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.crud-table', compact('result', 'fields', 'queryParameters', 'model'))->render(),
            ]);
        }

        return view('admin.orders.index', compact('result', 'fields', 'queryParameters', 'model','counts'));
    }

    public function show(Order $order)
    {
        $model= 'orders';
        $order_logs = ActivityLog::where('subject_type', 'App\Models\Order')->where('subject_id', $order->id)->orderBy('id','desc')->paginate(30);
        return view('admin.orders.show', compact('order','model','order_logs') );
    }

    public function destroy(Order $order)
    {
        $order->delete();      
        return redirect()->route('orders.index')->with('success',trans('messages.DeleteSuccessfully'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $orders = Order::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }
    public function changeStatus(Order $order){
        $status = (request('status') == 'on')? 'show' :'hide';
        $order->update(['status' =>$status]);      
        return redirect()->route('orders.index',['parent_id' => request('parent_id')])->with('success',trans('messages.UpdateSuccessfully'));

    }
    public function restore($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->restore();

        return redirect()->route('orders.index')->with('success',trans('messages.UpdateSuccessfully'));
    }

    public function updateAssignTo(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'assign_to' => 'required|exists:users,id',
        ]);
        $order = Order::find($request->order_id);
        if ($order) {
            $order->assign_to = $request->assign_to;
            $order->save();
            return response()->json(['success' => true, 'message' => __('messages.order assignment updated successfully')]);
        }
        return response()->json(['success' => false, 'message' => __('messages.order not found')]);
    }
    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|string|in:accepted,declined,pending,shipped,return,completed',
            'notes' => 'nullable|string|min:3|max:900',
        ]);

        $order = Order::find($request->order_id);

        if ($order) {
            $order->status = $request->status;
            $order->notes = $request->notes;
            $order->save();

            return response()->json([
                'success' => true,
                'statusText' => __('main.orders.' . $order->status),
                'message' =>  __('messages.Order status updated successfully'),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' =>  __('messages.order not found'),
        ]);
    }
    public function updateNotesToOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'add_notes' => 'required|string|min:3|max:900',

        ]);
        $order = Order::find($request->order_id);
        if ($order) {
            $order->notes = $request->add_notes;
            $order->save();
            return response()->json(['success' => true, 'message' => __('messages.order assignment updated successfully')]);
        }
        return response()->json(['success' => false, 'message' => __('messages.order not found')]);
    }

    //update on order
    public function edit(Order $order)
    {
        $model= 'orders';
        return view('admin.orders.edit' , compact('order','model'));
    }
    public function fetchCapacity(Request $request)
    {
        if($request->ajax()){
            $capacitys = ProductCapacity::where("product_id",$request->product_id)->get(["amount",'product_id', "id"]);
            if($capacitys->isEmpty()){
                $prices = Product::where("id",$request->product_id)->first(["from_price", "id"]);
                $shipping = 1;
                $data = view('admin.orders.ajax-product-price-select',compact('prices','shipping'))->render();
                return response()->json(['options'=>$data,'prices'=> $prices, 'shipping' => $shipping]);
            }else{
                // dd($capacitys);
                $data = view('admin.orders.ajax-capacity-select',compact('capacitys'))->render();
                return response()->json(['options'=>$data,'capacitys'=> $capacitys]);
            }
        }
    }

    public function fetchShipping(Request $request)
    {
        if($request->ajax()){
            $is_powdered = Product::where("id",$request->product_id)->first(["is_powdered", "id"]);
            $data = view('admin.orders.ajax-is_powdered-select',compact('is_powdered'))->render();
            return response()->json(['options'=>$data,'is_powdered'=> $is_powdered]);
        }
    }

    public function fetchPrice(Request $request)
    { 
        if($request->ajax()){
            $product = Product::where("id",$request->product_id)->first(["discount_type","discount","price", "id"]);
            $prices = $product->real_price;
            // $prices = priceOfCapacity($request->product_id, $request->capacity_id);
            $shipping = 1;
            $data = view('admin.orders.ajax-price-select',compact('prices','shipping'))->render();
            return response()->json(['options'=>$data,'prices'=> $prices, 'shipping' => $shipping]);
        }
    }
    
    public function updateOrder(Cart $order , Request $request){
        // dd($request->all());
        $order->orders()->delete();
        $sum = 0;
        for($i=0; $i< count($request->product_id); $i++){
            if($request->product_id[$i] != null){
            $create_order = Order::create([
                // 'is_powdered' => ($request->is_powdered[$i])? true: false,
                'capacity' => $request->capacity_id[$i],
                'cart_id' => $order->id,
                'is_powdered' => $request->is_powdered[$i],
                'product_id' => $request->product_id[$i],
                'product_price' => $request->price[$i],
                'qty' => $request->quantity[$i],  //1
                'total_price' => $request->quantity[$i] * $request->price[$i] ,
                'user_id' => $order->user_id,
            ]);
            $sum += $create_order->total_price;
            }
        }
        $update = $order->update([
            'total_price' => $sum,
            ]);
            
            if($order->user_id){
            $to_email = $order->user?->email;
        }else{
            $to_email = $order->user_address?->email;
        }
            $mail=Mail::send('emails.order_updated', ['cart' => $order], function($message) use ($request, $to_email) {
                 $message->to($to_email);
                 $message->subject('Order Updates');
            });
        return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));
    }
    
}