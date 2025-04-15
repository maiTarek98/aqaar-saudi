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
        $per_page = $request->input('per_page', 10);
        $sortBy = $request->input('sortBy', 'ASC');
        $query = Product::where(function ($query) use ($searchQuery) {
            $query->where('name_'.\App::getLocale(), 'like', '%' . $searchQuery . '%')->orWhere('overview_'.\App::getLocale(), 'like', '%' . $searchQuery . '%')->orWhere('description_'.\App::getLocale(), 'like', '%' . $searchQuery . '%');
        })->when($request->query('category_id'), function($query, $category_id) {
                $query->where('category_id', $category_id);
            })->when($request->query('store_id'), function($query, $store_id) {
                $query->where('store_id', $store_id);
            })->when($request->query('status'), function($query, $status) {
                $query->where('status', $status);
            })->when($request->query('in_home'), function($query, $in_home) {
                $query->where('is_in_home', $in_home);
            })->orderBy('order', $sortBy);
        if ($per_page === 'all') {
            $result = $query->get(); 
        } else {
            $result = $query->paginate((int) $per_page);
            $result->withQueryString();
        }
        $fields = ['id','products_image','name_'.\App::getLocale(),'stock','price', 'status','created_at'];
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
        $data = $request->except('_token','admin_id','category_year_id','products_image','document','page_title','page_description','page','page_url');
        if (!empty($request->tags) && is_array($request->tags)) {
            $tagsArray = is_array($request->tags) ? $request->tags : explode(',', $request->tags);
            $data['new_arrival'] = in_array('new_arrival', $tagsArray) ? 'yes' : 'no';
            $data['we_choose_for_u'] = in_array('we_choose_for_u', $tagsArray) ? 'yes' : 'no';
        }
        $product = Product::create(\Arr::except($data, ['tags']));
        if(request()->hasFile('products_image') && request()->file('products_image')->isValid())
        {
            $this->convertImageToWebp(request('products_image'),$product,'products_image','products');
        }

        if (!empty($request->page_title) || !empty($request->page_description)) {
            SeoTag::create([
                'admin_id'         => $request->added_by,
                'model_name'       => Product::class,
                'model_id'         => $product->id,
                'page_title'       => $request->page_title,
                'page_description' => $request->page_description,
                'page_url'         => $request->page_url,
            ]);
        }
        if($request->document){
            foreach ($request->document as $file) {
                $product->addMedia( $file)->toMediaCollection('document','products_images');
            }
        }

        return redirect()->route('products.index',['page'=> $this->currentPage])->with('success',trans('messages.AddSuccessfully'));
    }

    public function show(Product $product)
    {
        $product->load(['product_reviews','wishlist','wishlist.user','carts.order', 'customers','customerOrders.user']);
        return view('admin.products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        $document = DB::table('media')->where('model_type','App\Models\Product')->where('collection_name','document')->where('model_id', $product->id)->get();
        return view('admin.products.edit' , compact('product','document'));
    }

    public function update(ProductRequest $request,Product $product)
    {
        $data = $request->except('_token','category_year_id','products_image','document','page_title','tags','page_description','page','page_url');
       // dd($data);
        if(request()->hasFile('products_image') && request()->file('products_image')->isValid())
        {
            $product->clearMediaCollection('products_image'); 
            $this->convertImageToWebp(request('products_image'),$product,'products_image','products');
        } 
        if($request->page_title || $request->page_description){
            SeoTag::where('model_name','\App\Models\Product')->where('model_id',$product->id)->update([
                'admin_id'          => $request->added_by,
                'page_title'        => $request->page_title,
                'page_description'  => $request->page_description,
                'page_url'          => $request->page_url,
            ]);
        }
        if (!empty($request->tags) && is_array($request->tags)) {
            $tagsArray = is_array($request->tags) ? $request->tags : explode(',', $request->tags);
            $data['new_arrival'] = in_array('new_arrival', $tagsArray) ? 'yes' : 'no';
            $data['we_choose_for_u'] = in_array('we_choose_for_u', $tagsArray) ? 'yes' : 'no';
        }
        $updated = $product->update(\Arr::except($data, ['tags']));
        $product->stock = ($request->input('stock')!= null)? 'on': 'off';
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

        return redirect()->route('products.index',['page'=> $this->currentPage])->with('success',trans('messages.UpdateSuccessfully'));
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
        if( $status == 'show'){
            return response()->json(['success' => true, 'message' => trans('messages.ShowSuccessfully')]);

        }else{
            return response()->json(['success' => false, 'message' => trans('messages.HideSuccessfully')]);
        } 
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