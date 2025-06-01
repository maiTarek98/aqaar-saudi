<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductLetter;
use Illuminate\Http\Request;
use Response;
    use App\Models\PropertyAccessLink;

use App\Http\Traits\UploadImageTrait;
use App\Http\Requests\Dashboard\Category\ProductRequest;
use DB;
use Notification;
use App\Notifications\NewPropertyLetterNotification;
use App\Notifications\AccessLinkAcceptedNotification;
use App\Notifications\OfferEndedNotification;
use App\Notifications\AdminAccessLinkAcceptedNotification;

class PropertyLetterController extends Controller {
    use UploadImageTrait;
	public function getLetters(User $user,Product $property) {
		$urlPrevious = url()->current();
		$letters = DB::table('product_letters')
        ->where('product_id', $property->id)->whereNull('letter_id')
        ->select(
            'product_id',
            DB::raw('LEAST(sender_id, receiver_id) as user1'),
            DB::raw('GREATEST(sender_id, receiver_id) as user2'),
            DB::raw('MAX(created_at) as last_message_at')
        )
        ->where('status','!=','pending')->groupBy('product_id', 'user1', 'user2')
        ->orderByDesc('last_message_at')
        ->get();
        // dd($letters);
      	session()->put('url.intended', $urlPrevious);
		return view('site.property-letters',compact('user','letters'));
	}
    public function showLetterMessages($productId, $user1, $user2) {
		$urlPrevious = url()->current();
      	session()->put('url.intended', $urlPrevious);
    //   	$messages = ProductLetter::where('product_id', $productId)
    //         ->where(function ($q) use ($user1, $user2) {
    //             $q->where(function ($q2) use ($user1, $user2) {
    //                 $q2->where('sender_id', $user1)->where('receiver_id', $user2);
    //             })->orWhere(function ($q2) use ($user1, $user2) {
    //                 $q2->where('sender_id', $user2)->where('receiver_id', $user1);
    //             });
    //         })
    //         ->orderBy('created_at')
    //         ->get();
        $messages = ProductLetter::with('childs.sender')->whereNull('letter_id')->where('product_id', $productId)->orderBy('created_at')->get();
		return view('site.property-single-letter',compact('messages', 'productId', 'user1', 'user2'));
	}
    public function accept($id, Request $request)
    {
        $letter = ProductLetter::findOrFail($id);
    
        if ($letter->receiver_id !== auth()->id()) {
            abort(403);
        }
    
        $letter->status = 'approve';
        $letter->status_changed_by = $request->status_changed_by;
        $letter->save();
        $property = Product::findOrFail($letter->product_id);
        
        $accessLinks = $property->access_links()
            ->with('parent')
            ->where('source_user_id', $letter->sender_id)
            ->get();
        if($letter->sender_id){
            $sender= $letter->sender;
            $sender->notify(new AccessLinkAcceptedNotification($accessLinks[0]));
        }
        foreach ($accessLinks as $link) {
            $parents = $link->getAllParents();
            foreach ($parents as $parentLink) {
                $user = $parentLink->source_user;
                if ($user && $user->id != 1) {
                    $user->notify(new AccessLinkAcceptedNotification($parentLink));
                }
            }
        }
        $rootLink = $property->access_links()->whereNull('parent_id')->first();
        if ($rootLink) {
            $allChildren = $rootLink->getAllChildrenRecursive();
            $excludedUserIds = $accessLinks->pluck('source_user_id')->toArray();
            foreach ($allChildren as $childLink) {
                $user = $childLink->source_user;
                if ($user && $user->id != 1 && !in_array($user->id, $excludedUserIds)) {
                    $user->notify(new OfferEndedNotification($parentLink));
                }
            }
        }
        $admin_access = PropertyAccessLink::create([
            'source_user_id' => 1,
            'product_id' => $property->id, 
            'current_level' =>((int)$accessLinks->where('source_user_id', $letter->sender_id)[0]->current_level) +1,
            'parent_id' => $accessLinks->where('source_user_id', $letter->sender_id)[0]->id,
        ]);
        if($admin_access){
            $user = User::where('id',$admin_access->source_user_id)->first();
            $user->notify(new AdminAccessLinkAcceptedNotification($letter));
        }
        $property->update(['status' => 'closed']);
    
        return back()->with('success', 'تم قبول الخطاب بنجاح');
    }
    
    
        
    public function reject($id,Request $request)
    {
        $letter = ProductLetter::findOrFail($id);
        if ($letter->receiver_id !== auth()->id()) {
            abort(403);
        }
        $letter->status = 'rejected';
        $letter->status_changed_by = $request->status_changed_by;
        $letter->save();
        return back()->with('error', 'تم رفض الخطاب');
    }

    public function replyForm($id)
    {
        $letter = ProductLetter::findOrFail($id);
        return view('site.letters-reply', compact('letter'));
    }
    public function storeLetter(Request $request, Product $property)
    {
        $request->validate([
            'type' => 'required|string|min:2|max:255',
            'message' => 'required|string|min:2|max:1200',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:4048',
        ]);
        $existing = ProductLetter::where('product_id', $property->id)->whereIn('status', ['pending','accept','approve'])->first();
        if ($existing) {
            return redirect()->back()->with('error', 'لا يمكنك إرسال خطاب الآن، يوجد خطاب جاري.');
        }
        $product_letter = ProductLetter::create([
            'product_id'  => $property->id,
            'sender_id'   => auth('web')->id(),
            'receiver_id' => $request->receiver_id,
            'type'        => $request->type,
            'message'     => $request->message,
            'status'      => 'pending',
        ]);
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if ($file->isValid()) {
                    $product_letter->addMedia($file)->toMediaCollection('attachments','product_letters');
                }
            }
        }
        $admins = User::where('account_type', 'admins')->get();
        foreach ($admins as $admin) {
            $admin->notify(new \App\Notifications\AdminPendingLetterNotification($product_letter));
        }
    
        return redirect()->back()->with('success', 'تم إرسال الخطاب بنجاح، وسيتم التواصل قريبا.');
    }

    public function replySend(Request $request, $id)
    {
        $original = ProductLetter::findOrFail($id);
        $request->validate([
            'type' => 'required|string',
            'message' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
        ]);
        $attachmentPath = null;
        $product_letter = ProductLetter::create([
            'product_id' => $original->product_id,
            'sender_id' => auth('web')->id(),
            'receiver_id' => $request->receiver_id,
            'type' => $request->type,
            'message' => $request->message,
            'status_changed_by' => $request->status_changed_by,
            'status' => 'pending',
            'letter_id' => $original->id,
        ]);
        if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
            $product_letter->addMedia($request->file('attachment'))->toMediaCollection('attachment','product_letters');
        }
        
        $admins = User::where('account_type', 'admins')->get();
        foreach ($admins as $admin) {
            $admin->notify(new \App\Notifications\AdminPendingLetterNotification($product_letter));
        }
        return redirect()->back()->with('success', 'تم إرسال الرد، بانتظار التواصل');
    }


}