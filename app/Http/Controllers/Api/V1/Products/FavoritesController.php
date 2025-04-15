<?php
namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponses;
use Validator;
use App\Http\Resources\Api\User\FavoriteResource;
use App\Http\Resources\Api\Home\ProductResource;
class FavoritesController extends Controller
{
    use ApiResponses;
    public function toggleFavorite(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);
        $user = auth('api')->user();
        $product_id = $request->product_id;
        $favorite = Wishlist::where('user_id', $user->id)->where('product_id', $product_id)->first();

        if ($favorite) {
            $favorite->delete();
            return $this->successResponse(null,__('api.Product removed from favorites'));
        } else {
            $item = Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product_id
            ]);
            return $this->createdResponse($item,__('api.Product added to favorites'));
        }
    }

    public function getUserFavorites()
    {
        $user = auth('api')->user();
        $favorites = $user->wishlists()->with('product')->get();
        // $items = FavoriteResource::collection($favorites);
        
        $products = Product::whereHas('wishlist',function($q) use($user){
            $q->where('user_id',$user->id);
        })->paginate(6);
        $items=[
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
        return $this->successResponse($items,__('api.get favorites'));
    }
}
