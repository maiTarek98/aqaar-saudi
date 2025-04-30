<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactReply;
use Mail;
use Notification;
class ContactController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:contacts-list|contacts-delete', ['only' => ['index']]);
        $this->middleware('permission:contacts-list', ['only' => ['show']]);
        $this->middleware('permission:contacts-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $searchQuery = trim($request->query('search'));
        $per_page = $request->input('per_page', 10);
        $sortBy = $request->input('sortBy', 'asc');
        $query = Contact::where(function($query) use($searchQuery) {
            $query->where('email', 'like',  '%' . $searchQuery .'%')->orWhere('name', 'like',  '%' . $searchQuery .'%')->orWhere('mobile', 'like',  '%' . $searchQuery .'%');
        })->when($request->query('is_viewed'), function($query, $is_viewed) {
                $query->where('is_viewed', $is_viewed);
            })->orderBy('id', $sortBy);
        if ($per_page === 'all') {
            $result = $query->get(); 
        } else {
            $result = $query->paginate((int) $per_page);
            $result->withQueryString();
        }
        $fields = ['id', 'name','email','is_viewed'];
        $model = 'contacts';
        $queryParameters = $request->query(); // Get query parameters
        if ($request->ajax()) {
            
            return response()->json([
                'html' => view('components.crud-table', compact('result', 'fields', 'queryParameters','model'))->render(),
            ]);
        }

        return view('admin.contacts.index', compact('result', 'fields','queryParameters', 'model'));
    }
    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact') );
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success',trans('messages.DeleteSuccessfully'));
    }

     public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        if (!is_array($ids)) {
            $ids = explode(",", $ids);
        }
        $ids = array_filter($ids, fn($id) => is_numeric($id));
    
        if (empty($ids)) {
            return response()->json(['error' => 'لم يتم تحديد عناصر للحذف.'], 400);
        }
    
        Contact::whereIn('id', $ids)->delete();
    
        return response()->json(['success' => trans('messages.RecordsDeleteSuccessfully')]);
    }

    public function send_email(Contact $contact, Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:10000',
        ]);

        $body = $request->body;
        $to_email = $contact->email;
        
        try{
            ContactReply::create([
                'admin_id' => auth('admin')->user()->id,
                'contact_id' => $contact->id,
                'body' => $body,
            ]);
            $mail=Mail::send('emails.contact_reply', ['contact' => $contact, 'body' => $body,'email' => $to_email], function($message) use ($request, $to_email) {
                 $message->to($to_email);
                 $message->subject('Reply to our contact us');
            });
             return redirect()->back()->with('success',trans('messages.UpdatedSuccessfully'));
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->back()->with('error',trans('messages.no email sent'));
            // throw new HttpException(500, $e->getMessage());
        }
        
    }

    public function changeStatus(Contact $Contact){
        $is_viewed = request('status');
        if( $is_viewed == 'show'){
            $Contact->update(['is_viewed' =>'yes']); 
            return response()->json(['success' => true, 'message' => trans('messages.ShowSuccessfully')]);

        }else{
            $Contact->update(['is_viewed' =>'no']); 
            return response()->json(['success' => false, 'message' => trans('messages.HideSuccessfully')]);
        }  
    }
}
