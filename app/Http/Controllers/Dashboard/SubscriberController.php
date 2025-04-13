<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Notification;
use Mail;
class SubscriberController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:subscribers-list|subscribers-delete', ['only' => ['index']]);
        $this->middleware('permission:subscribers-list', ['only' => ['show']]);
        $this->middleware('permission:subscribers-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $searchQuery = trim($request->query('search'));
        $per_page = $request->input('per_page', 10);
        $sortBy = $request->input('sortBy', 'asc');
        $result = Subscriber::where(function($query) use($searchQuery) {
            $query->where('email', 'like',  '%' . $searchQuery .'%');
        })->orderBy('id', $sortBy)->paginate($per_page);
        $fields = ['email'];
        $model = 'subscribers';
        $queryParameters = $request->query(); // Get query parameters
        if ($request->ajax()) {
            
            return response()->json([
                'html' => view('components.crud-table', compact('result', 'fields','queryParameters', 'model'))->render(),
            ]);
        }

        return view('admin.subscribers.index', compact('result', 'fields', 'queryParameters','model'));
    }
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        return redirect()->route('subscribers.index')->with('success',trans('messages.DeleteSuccessfully'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Subscriber::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }

    public function sendSubscriberEmail(Request $request){
        $ids = $request->ids;
        if($ids == null){
            $subscriberrs = Subscriber::get();
        }else{
            $subscriberrs = Subscriber::whereIn('id',explode(",",$ids))->get();
        }
        foreach ($subscriberrs as $key => $value) {
            $to_email = $value->email;
            $mail=Mail::send('emails.send_subscriber_email', ['email' => $value->email, 'data' => $request->message], function($message) use ($request, $to_email) {
                 $message->to($to_email);
                 $message->subject('Send Notification To Our Subscribers');
            });
            // AdminMail::create([
            //     'admin_id' => auth('admin')->user()->id,
            //     'subscriber_id' => $value->id,
            //     'mail' => $request->message,
            // ]);
        }

        return redirect()->back()->with('success',trans('messages.MessageSentSuccessfully'));
    }
}
