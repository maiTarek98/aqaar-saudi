<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\ProductRequest; 
use App\Http\Traits\UploadImageTrait;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Wishlist;
use App\Models\SeoTag;
use App\Models\ProductYear;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
        })->where(function ($query) use ($searchNumber) {
            $query->where('listing_number', 'like', '%' . $searchNumber . '%');
        })->when($request->query('status'), function($query, $status) {
                $query->where('status', $status);
        })->when($request->query('area_id'), function($query, $governorate_id) {
                $query->whereHas('area.parent.parent', function($q) use($governorate_id) {
                    $q->where('id', $governorate_id)
                      ->where('type', 'governorate');
                });
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
        $fields = ['id','title','type','price', 'property_status','created_at'];
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
        $product = Product::create([
            'added_by' => auth()->id(),
            'title' => $request->title,
            'price' => $request->price_.$request->type,
            'description' => $request->description,
            'owner_id' => $request->owner_id,
            'status' => 'pending',
            'type' => $request->type,
            'product_for' => $request->product_for,
            'area_id' => $request->district_id,
            'is_private' => $request->boolean('is_private'),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
        $product->feature()->create([
            'plan_number' => $request->plan_number,
            'plot_number' => $request->plot_number,
            'area' => $request->area,
            'area_after_development' => $request->area_after_development,
            'valuation' => $request->valuation,
            'valuation_date' => $request->valuation_date,
            'has_planning_diagram' => $request->boolean('has_planning_diagram'),
            'has_electronic_deed' => $request->boolean('has_electronic_deed'),
            'has_real_estate_market' => $request->boolean('has_real_estate_market'),
            'has_survey_decision' => $request->boolean('has_survey_decision'),
            'penalty_type' => $request->penalty_type,
            'valuation_type' => $request->valuation_type,
            'has_penalties' => $request->boolean('has_penalties'),
            'has_mortgage' => $request->boolean('has_mortgage'),
            'accepts_mortgage' => $request->boolean('accepts_mortgage'),
            'usufruct_lease' => $request->boolean('usufruct_lease'),
            'is_rented' => $request->boolean('is_rented'),
            'annual_rent' => $request->annual_rent,
            'remaining_lease_years' => $request->remaining_lease_years,
            'license_number' => $request->license_number,
            'additional_info' => $request->additional_info,
            'represented_by' => $request->represented_by,
            'product_type' => $request->product_type,
            'owner_type' => $request->owner_type,
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
        $url = route('property.show', $listingNumber);
        $qrFileName = 'qr_' . $product->id . '.png';
        $qrImage = QrCode::format('png')->size(300)->generate($url);
        Storage::disk('public')->put("qr_codes/{$qrFileName}", $qrImage);
        $product->update([
            'qr_code' => "qr_codes/{$qrFileName}"
        ]);
        return redirect()->back()->with('success',trans('messages.AddSuccessfully'));
    }

    public function show(Product $product)
    {
        $product->load(['feature','offers']);
        return view('admin.products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        $document = DB::table('media')->where('model_type','App\Models\Product')->where('collection_name','document')->where('model_id', $product->id)->get();
        return view('admin.products.edit' , compact('product','document'));
    }

    public function update(ProductRequest $request,Product $product)
    {
        $product->update([
            'added_by' => auth()->id(),
            'title' => $request->title,
            'price' => ($request->type == 'auction')?$request->price_auction:$request->price_investment,
            'description' => $request->description,
            'owner_id' => $request->owner_id,
            'status' => 'pending',
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
            'has_planning_diagram' => $request->boolean('has_planning_diagram'),
            'has_electronic_deed' => $request->boolean('has_electronic_deed'),
            'has_real_estate_market' => $request->boolean('has_real_estate_market'),
            'has_survey_decision' => $request->boolean('has_survey_decision'),
            'penalty_type' => $request->penalty_type,
            'valuation_type' => $request->valuation_type,
            'has_penalties' => $request->boolean('has_penalties'),
            'has_mortgage' => $request->boolean('has_mortgage'),
            'accepts_mortgage' => $request->boolean('accepts_mortgage'),
            'usufruct_lease' => $request->boolean('usufruct_lease'),
            'is_rented' => $request->boolean('is_rented'),
            'annual_rent' => $request->annual_rent,
            'remaining_lease_years' => $request->remaining_lease_years,
            'license_number' => $request->license_number,
            'additional_info' => $request->additional_info,
            'represented_by' => $request->represented_by,
            'product_type' => $request->product_type,
            'owner_type' => $request->owner_type,
        ]);
        if(request()->hasFile('products_image') && request()->file('products_image')->isValid())
        {
            $product->clearMediaCollection('products_image'); 
            $this->convertImageToWebp(request('products_image'),$product,'products_image','products');
        } 
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
        $products = Product::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
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

     public function productWishlists()
    {
        $product_wishlists = Wishlist::paginate(30);
        return view('admin.products.wishlists', compact('product_wishlists') );
    }

    public function productWishlistDelete(Wishlist $product)
    {
        $product->delete();      
        return redirect()->route('products.index',['page'=> $this->currentPage])->with('success',trans('messages.DeleteSuccessfully'));
    }
    public function productWishlistsdeleteAll(Request $request)
    {
        $ids = $request->ids;
        $products = Wishlist::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
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
        $newProduct->name_ar = $product->name_ar . ' (Copy)';
        $newProduct->name_en = $product->name_en . ' (Copy)';
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