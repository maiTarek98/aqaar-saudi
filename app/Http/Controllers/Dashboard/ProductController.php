<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\ProductRequest; 
use App\Http\Traits\UploadImageTrait;
use App\Models\Product;
use App\Models\User;
use App\Models\PropertyAccessLink;
use App\Models\Category;
use App\Models\ProductLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use Notification;        
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Notifications\NewPropertyLetterNotification;

class ProductController extends Controller
{
    use UploadImageTrait;

    public $currentPage;
    function __construct()
    {
        $this->middleware('permission:products-list|products-create|products-edit|products-delete', ['only' => ['index','store']]);
        $this->middleware('permission:products-list', ['only' => ['show']]);
        $this->middleware('permission:products-create', ['only' => ['create','store']]);
        $this->middleware('permission:products-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:products-delete', ['only' => ['destroy']]);
        $this->currentPage = request()->input('page', request('page'));
    }

    public function index(Request $request)
    {
        $searchQuery = trim($request->query('search'));
        $searchNumber = trim($request->query('listing_number'));
        $per_page = $request->input('per_page', 10);
        $sortBy = $request->input('sortBy', 'ASC');
        $query = Product::where(function ($query) use ($searchQuery) {
            $query->where('title', 'like', '%' . $searchQuery . '%')->orWhere('description', 'like', '%' . $searchQuery . '%');
        })->when($request->query('added_by'), function($query, $added_by) {
            $query->where('added_by', $added_by );
        })->where(function ($query) use ($searchNumber) {
            $query->where('listing_number', 'like', '%' . $searchNumber . '%');
        })->when($request->query('status'), function($query, $status) {
                $query->where('status', $status);
        })->when($request->query('form_type'), function($query, $form_type) {
                $query->where('form_type', $form_type);
            })->when($request->query('type'), function($query, $type) {
                $query->where('type', $type);
            })->when($request->query('in_home'), function($query, $in_home) {
                $query->where('in_home', $in_home);
            })->orderBy('id', $sortBy);
        if ($per_page === 'all') {
            $result = $query->get(); 
        } else {
            $result = $query->paginate((int) $per_page);
            $result->withQueryString();
        }
        if(request('form_type') == 'site_property'){
                    $fields = ['id','title','price','created_at'];
        }else{
            $fields = ['id','title','type','price','created_at'];
        }
        $model = 'products';
        $queryParameters = $request->query(); // Get query parameters
        if ($request->ajax()) {
            
            return response()->json([
                'html' => view('components.crud-table', compact('result', 'fields','queryParameters', 'model'))->render(),
            ]);
        }

        return view('admin.products.index', compact('result', 'fields', 'queryParameters','model'));
    }


    public function create()
    {
        $product = new Product() ;
        return view('admin.products.create' , compact('product'));
    }


    public function store(ProductRequest $request)
    {
        if($request->type == 'auction'){
            $price =$request->price_auction; 
        }elseif($request->type == 'investment'){
            $price =$request->price_investment; 
        }elseif($request->type == 'shared'){
            $price =$request->price_shared; 
        }else{
            $price =$request->price; 
        }
        $product = Product::create([
            'added_by' => $request->added_by,
            'title' => $request->title,
            'in_home' => ($request->in_home)?? null,
            'price' => $price,
            'description' => $request->description,
            'owner_id' => $request->owner_id,
            'investment_min' => $request->investment_min,
            'status' => 'pending',
            'type' => $request->type,
            'product_for' => $request->product_for,
            'map_location' => $request->map_location,
            'link_video' => $request->link_video,
            'area_id' => $request->district_id,
            'is_private' => $request->boolean('is_private'),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'form_type' => $request->input('form_type')?? 'add_property',
        ]);  
        if( $request->input('name') != null && $request->input('mobile') != null){
            $product['request_data'] = [
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
            ];
            $product->save();
        }
        if($request->input('added_by_user')){
            $product->added_by = $request->input('added_by_user');
            $product->save();
        }
        $product->feature()->create([
            'plan_number' => $request->plan_number,
            'plot_number' => $request->plot_number,
            'area' => $request->area,
            'area_after_development' => $request->area_after_development,
            'valuation' => $request->valuation,
            'valuation_date' => $request->valuation_date,
            // 'has_planning_diagram' => $request->boolean('has_planning_diagram'),
            // 'has_electronic_deed' => $request->boolean('has_electronic_deed'),
            // 'has_real_estate_market' => $request->boolean('has_real_estate_market'),
            // 'has_survey_decision' => $request->boolean('has_survey_decision'),
            'penalty_type' => ($request->penalty_type)?implode('_', $request->penalty_type):null,
            'valuation_type' => $request->valuation_type,
            // 'has_penalties' => $request->boolean('has_penalties'),
            // 'has_mortgage' => $request->boolean('has_mortgage'),
            // 'accepts_mortgage' => $request->boolean('accepts_mortgage'),
            // 'usufruct_lease' => $request->boolean('usufruct_lease'),
            // 'is_rented' => $request->boolean('is_rented'),
            'annual_rent' => $request->annual_rent,
            'remaining_lease_years' => $request->remaining_lease_years,
            'license_number' => $request->license_number,
            'additional_info' => $request->additional_info,
            'represented_by' => $request->represented_by,
            'agency_number' => $request->agency_number,
            'val_number' => $request->val_number,
            'sak_number' => $request->sak_number,
            'product_type' => $request->product_type,
            'owner_type' => $request->owner_type,
            'features' => $request->input('features', []),
        ]);
        if(request()->hasFile('products_image') && request()->file('products_image')->isValid())
        {
            $this->convertImageToWebp(request('products_image'),$product,'products_image','products');
        }
        if($request->document){
            foreach ($request->document as $file) {
                $product->addMedia( $file)->toMediaCollection('document','products_images');
            }
        }
        
        $listingNumber = $product->listing_number;
        $token = Str::uuid(); 
        
        $qrFileName = 'qr_' . $product->id . '.png';
        if($request->type == 'shared' && $request->phone_numbers != null){
            $product->update([
                'phone_numbers' => explode(',', $request->phone_numbers)
            ]);
            // $qrCodes = [];
            // foreach (explode(',', $request->phone_numbers) as $key => $value) {
            //     $token = Str::uuid();
            //     $secureUrl = route('property.private.verify', ['token' => $token]);

            //     $qrFileName = 'qr_' . $product->id . '_' . $key . '.png';
            //     $qrPath = "qr_codes/{$qrFileName}";
            //     $qrImage = QrCode::format('png')->size(300)->generate($secureUrl);
            //     Storage::disk('public')->put($qrPath, $qrImage);
            //     $qrCodes[] = $qrPath;
            //     DB::table('property_private_links')->insert([
            //         'product_id' => $product->id,
            //         'token' => $token,
            //         'verification_level' => 3,
            //         'phone_number' => trim($value),
            //     ]);
            // }
            // $product->update([
            //     'qr_code' => json_encode($qrCodes),
            // ]);
        }
            $secureUrl = route('property.verify.link', ['token' => $token, 'ref' => 2]);
            DB::table('property_access_links')->insert([
                'product_id' => $product->id,
                'token' => $token,
                'current_level' => 1, 
                'created_at' => now(),
                'source_user_id' => $product->added_by,
            ]);
            $qrImage = QrCode::format('png')->size(300)->generate($secureUrl);
            Storage::disk('public')->put("qr_codes/{$qrFileName}", $qrImage);
            $product->update([
                'qr_code' => "qr_codes/{$qrFileName}"
            ]);
        
        $admins = User::where('account_type','admins')->where('id','!=',$product->added_by)->get();
        foreach ($admins as $key => $value) {   
            if($value->hasPermissionTo('products-list')){
                Notification::send($value,new \App\Notifications\NotifyNewProductToAdmin($product));
            }
        }
        if(($product->form_type == 'add_request') || ($product->form_type == 'site_property') && auth('admin')->check()){
                return redirect()->back()->with('success',trans('messages.AddSuccessfully'));
            }
        if($product->request_data != null || $request->input('added_by_user') != null){
            $arr  = ['user'=> $product->added_by,'code'=>$product->listing_number];
            return redirect()->route('linkPropertyAdmin',['user'=> $arr['user'],'code'=>$arr['code']])->with('success',trans('messages.AddSuccessfully'));
        }
        // dd(auth('web')->check());
        if(auth('web')->check() && $product->admin?->account_type == 'users'){
            $arr  = ['user'=> $product->added_by,'code'=>$product->listing_number];
            return $arr;
        }else{
            return redirect()->back()->with('success',trans('messages.AddSuccessfully'));
        }
    }

	public function linkPropertyAdmin($user , $code) {
		$urlPrevious = url()->current();
		$product = Product::where('listing_number',$code)->first();
      	session()->put('url.intended', $urlPrevious);
		return view('admin.products.link-property',compact('product'));
	}
    public function show(Product $product)
    {
        $product->load(['feature','offers']);
        $root = PropertyAccessLink::where('product_id', $product->id)
            ->orderBy('current_level')
            ->first();
        if (!$root) {
            return "لا توجد توثيقات لهذا العقار.";
        }
        $allLinks = PropertyAccessLink::where('product_id', $product->id)->get()->toArray();
        $structuredTree = $this->buildTree($allLinks, null);
        return view('admin.products.show', compact('product','structuredTree'));
    }

  private function buildTree(array $elements, $parentId = null)
    {
        $branch = [];
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                $element['children'] = $children;
                $branch[] = $element;
            }
        }
        return $branch;
    }
    public function edit(Product $product)
    {
        $document = DB::table('media')->where('model_type','App\Models\Product')->where('collection_name','document')->where('model_id', $product->id)->get();
        return view('admin.products.edit' , compact('product','document'));
    }

    public function update(ProductRequest $request,Product $product)
    {
        if(request()->hasFile('products_image') && request()->file('products_image')->isValid())
        {
            $product->clearMediaCollection('products_image'); 
            $this->convertImageToWebp(request('products_image'),$product,'products_image','products');
        } 
        if($request->type == 'auction'){
            $price =$request->price_auction; 
        }elseif($request->type == 'investment'){
            $price =$request->price_investment; 
        }else{
            $price =$request->price_shared; 
        }
        $product->update([
            'added_by' => auth()->id(),
            'title' => $request->title,
            'price' => $price,
            'description' => $request->description,
            'owner_id' => $request->investment_min,
            'investment_min' => $request->investment_min,
            'status' => $request->status,
            'type' => $request->type,
            'product_for' => $request->product_for,
            'area_id' => $request->district_id,
            'is_private' => $request->boolean('is_private'),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
        $product->feature()->update([
            'plan_number' => $request->plan_number,
            'plot_number' => $request->plot_number,
            'area' => $request->area,
            'area_after_development' => $request->area_after_development,
            'valuation' => $request->valuation,
            'valuation_date' => $request->valuation_date,
            // 'has_planning_diagram' => $request->boolean('has_planning_diagram'),
            // 'has_electronic_deed' => $request->boolean('has_electronic_deed'),
            // 'has_real_estate_market' => $request->boolean('has_real_estate_market'),
            // 'has_survey_decision' => $request->boolean('has_survey_decision'),
            'penalty_type' => $request->penalty_type,
            'valuation_type' => $request->valuation_type,
            // 'has_penalties' => $request->boolean('has_penalties'),
            // 'has_mortgage' => $request->boolean('has_mortgage'),
            // 'accepts_mortgage' => $request->boolean('accepts_mortgage'),
            // 'usufruct_lease' => $request->boolean('usufruct_lease'),
            // 'is_rented' => $request->boolean('is_rented'),
            'annual_rent' => $request->annual_rent,
            'remaining_lease_years' => $request->remaining_lease_years,
            'license_number' => $request->license_number,
            'additional_info' => $request->additional_info,
            'represented_by' => $request->represented_by,
            'agency_number' => $request->agency_number,
            'val_number' => $request->val_number,
            'sak_number' => $request->sak_number,
            'product_type' => $request->product_type,
            'owner_type' => $request->owner_type,
            'features' => $request->input('features', []),
        ]);
        
        $product->save();
        $document = DB::table('media')->where('model_type','App\Models\Product')->where('collection_name','document')->where('model_id', $product->id)->get();

        $media = $document->pluck('file_name')->toArray();
        if($request->document){
            foreach ($request->document as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $product->addMedia( $file)->toMediaCollection('document','products_images');
                }
            }
        }
        return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));
    }

    public function destroy(Product $product)
    {
        $product->delete();      
        return redirect()->route('products.index',['page'=> $this->currentPage])->with('success',trans('messages.DeleteSuccessfully'));
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
    
        Product::whereIn('id', $ids)->delete();
    
        return response()->json(['success' => trans('messages.RecordsDeleteSuccessfully')]);
    }
    public function toggleStatus(Product $product){
        $status = (request('status') == 'on')? 'show' :'hide';
        $product->update(['status' =>$status]);      
        return redirect()->route('products.index',['page'=> $this->currentPage])->with('success',trans('messages.UpdateSuccessfully'));

    }

    public function productReviews()
    {
        $product_reviews = ProductReview::paginate(30);
        return view('admin.products.reviews', compact('product_reviews') );
    }

    public function productReviewDelete(ProductReview $product)
    {
        $product->delete();      
        return redirect()->route('products.index',['page'=> $this->currentPage])->with('success',trans('messages.DeleteSuccessfully'));
    }
    public function productReviewsdeleteAll(Request $request)
    {
        $ids = $request->ids;
        $products = ProductReview::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }

    public function productReviewstoggleStatus(ProductReview $product){
        $status = (request('status') == 'on')? 'show' :'hide';
        $product->update(['status' =>$status]);      
        return redirect()->route('products.index',['page'=> $this->currentPage])->with('success',trans('messages.UpdateSuccessfully'));

    }
public function storeMedia(Request $request)
{
    $path = storage_path('tmp/uploads');

    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    $file = $request->file('file');

    $name = uniqid() . '_' . trim($file->getClientOriginalName());

    $file->move($path, $name);

    return response()->json([
        'name'          => $name,
        'original_name' => $file->getClientOriginalName(),
    ]);
}


    public function fetchSubcategory(Request $request)
    {
        if($request->ajax()){
            $product = Product::where('id',$request->product_id)->first();
            $category = Category::where('parent_id',$request->category_id)->get();
            $data = view('admin.products.ajax-subcategory-select',compact('category','product'))->render();
            return response()->json(['options'=>$data,'product' => $product,'category' => $category]);
        }
    }

    public function changeStatus(Product $product){
        $status = request('status');
        $product->update(['status' =>$status]); 
        return response()->json(['success' => true, 'message' => trans('messages.UpdateSuccessfully')]);
    }

     public function productLetters(Product $product)
    {
        $letters = ProductLetter::where('product_id',$product->id)->whereNull('letter_id')->paginate(30);
        return view('admin.products.letters', compact('letters') );
    }
     public function productSingleLetter(Product $product,ProductLetter $letter)
    {
        $replies = ProductLetter::where('letter_id', $letter->id)->latest()->get();
        return view('admin.products.letter', compact('letter','product','replies') );
    }
    public function letterAccept(Product $product , ProductLetter $letter)
    {
        $letter->update(['status' => 'accept']);
        if ($letter->product->added_by != $letter->sender_id) {
            $owner = $letter->product->admin;
            if ($owner) {
                $owner->notify(new NewPropertyLetterNotification($letter));
            }
        }
        $agent = $letter->product->property_delegations()
            ->where('status', 'accept')
            ->latest()
            ->first();
        if ($agent && $agent->agent_id != $letter->sender_id) {
            $agentUser = \App\Models\User::find($agent->agent_id);
            if ($agentUser) {
                $agentUser->notify(new NewPropertyLetterNotification($letter));
            }
        }

        return redirect()->back()->with('success', 'تم قبول الخطاب وإرسال الإشعارات');
    }
    public function editAndAccept(Request $request, ProductLetter $letter)
    {
        $request->validate([
            'message' => 'required|string',
        ]);
        $letter->update([
            'message' => $request->message,
            'status'  => 'accept',
        ]);
        
        if ($request->hasFile('attachments')) {
        $letter->clearMediaCollection('attachments');
            foreach ($request->file('attachments') as $file) {
                if ($file->isValid()) {
                    $letter->addMedia($file)->toMediaCollection('attachments','product_letters');
                }
            }
        }
        
        if ($request->hasFile('attachment')) {
        $letter->clearMediaCollection('attachment');
           $file = $request->file('attachment') ;
        $letter->addMedia($file)->toMediaCollection('attachment','product_letters');
        }
        if ($letter->product->added_by != $letter->sender_id) {
            $owner = $letter->product->admin;
            if ($owner) {
                $owner->notify(new NewPropertyLetterNotification($letter));
            }
        }
        $agent = $letter->product->property_delegations()->where('status', 'accept')->latest()->first();
        if ($agent && $agent->agent_id != $letter->sender_id) {
            $agentUser = \App\Models\User::find($agent->agent_id);
            if ($agentUser) {
                $agentUser->notify(new NewPropertyLetterNotification($letter));
            }
        }
        return redirect()->back()->with('success', 'تم تعديل الخطاب وقبوله وإرسال الإشعارات.');
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('products.index')->with('success',trans('messages.UpdateSuccessfully'));
    }
    public function cloneProduct($productId,Request $request)
    {
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->route('products.index')->with('error',trans('messages.Product not found'));
        }
        $newProduct = $product->replicate();
        $newProduct->title = $product->title . ' (Copy)';
        $newProduct->save(); 
        if ($product->hasMedia('products_image')) {
            $media = $product->getFirstMedia('products_image'); // Get the single image
            $newProduct->addMedia($media->getPath())
                ->preservingOriginal()
                ->toMediaCollection('products_image','products');
        }
    
        return redirect()->route('products.index')->with('success',trans('messages.CloneAddedSuccessfully'));
    }

    public function deleteImage(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'file_name' => 'required|string'
        ]);

        $product = Product::find($request->product_id);
        $media = $product->getMedia('document')->where('file_name', $request->file_name)->first();

        if ($media) {
            $media->delete();
            return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Image not found.']);
    }

}