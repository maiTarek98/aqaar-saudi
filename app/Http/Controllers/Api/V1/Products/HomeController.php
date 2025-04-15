<?php
namespace App\Http\Controllers\Api\V1\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Home\CategoryResource;
use App\Http\Traits\ApiResponses;
use App\Http\Resources\Api\Home\BrandResource;
use App\Http\Resources\Api\Home\ProductResource;
use App\Http\Traits\VendorStoreTrait;
use App\Models\ProductReview;
use App\Models\QuestionAnswer;
use App\Http\Resources\Api\Home\HelpResource;
use App\Models\Page;
use Validator;
use DB;
class HomeController extends Controller
{
    use ApiResponses;
    use VendorStoreTrait;
    
    public function getPages(Request $request)
    {
        $locale = in_array(app()->getLocale(), ['ar', 'en']) ? app()->getLocale() : 'en';
    
        $pages = Page::where('status','show')->get();
        $faqs = QuestionAnswer::get();
        $collection = [
            'privacy_policy'    => $pages[0]['content_'.$locale],
            'return_policy'     => $pages[1]['content_'.$locale],
            'term_conditions'   => $pages[2]['content_'.$locale],
            'faqs'              => HelpResource::collection($faqs),
        ];
    
        return $this->successResponse($collection, __('api.get all pages'));
    }
    public function getCategorys(Request $request)
    {
        $categorys = $this->getCategories();
        return $this->successResponse(CategoryResource::collection($categorys),__('api.get all categorys'));
    }
    public function getBrands(Request $request)
    {
        $brands = $this->getBrandes();
        return $this->successResponse(BrandResource::collection($brands),__('api.get all brands'));
    }

    public function getStoreProducts()
    {
        $products = $this->getProducts();
        $collection=[
            'data' => ProductResource::collection($products),
            'links' => $products->linkCollection(),
            'meta' => [
                    'current_page' => $products->currentPage(),
                    'from' => $products->firstItem(),
                    'last_page' => $products->lastPage(),
                    'path' => $products->path(),
                    'per_page' => $products->perPage(),
                    'to' => $products->lastItem(),
                    'total' => $products->total(),
            ],
        ];
        return $this->successResponse($collection,__('api.get all products'));
    }

    public function getSingleProduct($id)
    {
        $product = $this->getProduct($id);
        return $this->successResponse(ProductResource::make($product),__('api.get single product'));
    }
    
    public function addReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'star' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
        $user = auth('api')->user();
        if (!$user) {
            return $this->errorResponse(__('api.Unauthorized'), 401);
        }

        $review = ProductReview::updateOrCreate(
            ['user_id' => $user->id, 'product_id' => $request->product_id],
            ['star' => $request->star, 'review' => $request->review]
        );
        return $this->createdResponse($review, __('api.Review added successfully'));
    }

}
