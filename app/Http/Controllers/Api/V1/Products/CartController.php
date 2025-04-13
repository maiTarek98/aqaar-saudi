<?php
namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponses;
use Validator;
use App\Http\Resources\Api\User\CartResource;
class CartController extends Controller
{
    use ApiResponses;
    public function index()
    {
        $user = auth('api')->user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        $items = CartResource::collection($cartItems);
        return $this->successResponse($items,__('api.get cart'));
    }

    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
        $user = Auth::id();
        $product = Product::where('id',(int)$request->product_id)->where('status','show')->first();
        if (!$product) {
            return $this->errorResponse(__('api.product_not_found'));
        }
        if ($product->stock == 'off'){
            return $this->errorResponse(__('api.product stock off'));
        }
        $cart = Cart::whereNull('order_id')->where('user_id',$user)
                    ->where('product_id', (int)$request->product_id)
                    ->first();
        if ($cart) {
            $cart->increment('qty', $request->qty);
        } else {
            $cart = Cart::create([
                'user_id' => $user,
                'product_id' => $request->product_id,
                'qty' => $request->qty
            ]);
        }
        $cart->update([
                'price' => $product->real_price,
                'total_price' => $product->real_price* $cart->qty,
            ]);
        return $this->createdResponse($cart,__('api.Product added to cart'));
    }

    public function removeFromCart($cart_id)
    {
        Cart::where('id', $cart_id)->where('user_id', Auth::id())->delete();
        return $this->successResponse(null,__('api.Item removed from cart'));
    }

    public function clearCart()
    {
        Cart::where('user_id', Auth::id())->delete();
        return $this->successResponse(null,__('api.Cart cleared'));
    }
}

