<?php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;

if (!function_exists('available_languages')) {
  function available_languages() {
    return ['ar', 'en'];
  }
}

 function id($guard)
{
  if(auth($guard)->check()){
    $admin = auth($guard)->user()->id;
  }
  if(!$admin){
    $admin = null;
  }
  return $admin;
}
 function verifyRecaptcha($recaptchaToken)
{
    $secret = env('RECAPTCHA_SECRET_KEY');
    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => $secret,
        'response' => $recaptchaToken,
    ]);
    // Return the response data (will contain success and error codes)
    return $response->json();
}

function generateRandomCode(){
    return rand(1000,9999);
}

function colors(){
  $arr= [
    'rgb(0, 0, 0)' => 'أسود',
    'rgb(255, 255, 255)' => 'أبيض',
    'rgb(227, 227, 227)' => 'فضي',
    'rgb(189, 189, 189)' => 'رمادي',
    'rgb(0, 86, 193)' => 'أزرق',
    'rgb(211, 211, 211)' => 'رصاصي',
    'rgb(218, 52, 52)' => 'أحمر',
    'rgb(14, 25, 126)' => 'أزرق غامق ( كحلي )',
    'rgb(135, 63, 11)' => 'بني',
    'rgb(169, 169, 169)' => 'رصاصي غامق',
    'rgb(137, 207, 240)' => 'أزرق فاتح',
    'rgb(104, 106, 108)' => 'أسمنتي',
    'rgb(255, 199, 0)' => 'ذهبي',
    'rgb(211, 211, 211)' => 'رمادي فاتح',
    'rgb(192, 192, 192)' => 'رصاصي فاتح',
    'rgb(248, 236, 209)' => 'بيج',
    'rgb(42, 163, 19);' => 'أخضر',
    'rgb(26, 106, 11)' => 'زيتي',
    'rgb(237, 78, 0)' => 'برتقالي',
    'rgb(0, 95, 106)' => 'بترولي',
    'rgb(78, 53, 36)' => 'بني غامق',
    'rgb(104, 64, 62)' => 'أحمر غامق',
    'rgb(255, 232, 0)' => 'أصفر',
    'rgb(160, 32, 240)' => 'بنفسجي',
    'rgb(1, 50, 32)' => 'أخضر غامق',
    'rgb(241, 229, 172)' => 'ذهبي فاتح',
    'other' => 'لون اخر',
    'rgb(224, 200, 161)' => 'برونزي',
    'rgb(78 9 120)' => 'بنفسجي غامق',
    'rgb(144, 238, 144)' => 'اخضر فاتح',
    'rgb(201, 158, 135)' => 'بني فاتح',
    'rgb(130 109 10)' => 'ذهبي غامق',
  ];
  return $arr;
}

function searchColorByName($name) {
    $colors = colors();
    $key = array_search($name, $colors);
    if ($key !== false) {
        return $key;
    } else {
        return "Color not found!";
    }
}
function status_requests_trans($status){
  if($status == 'pending'){
            $status = trans('main.orders.pending');
        }elseif($status == 'accepted'){
            $status = trans('main.orders.accepted');
        }elseif($status == 'completed'){
            $status = trans('main.orders.completed');
        }elseif($status == 'shipped'){
            $status = trans('main.orders.shipped');
        }elseif($status == 'return'){
            $status = trans('main.orders.return');
        }elseif($status == 'cancelled'){
            $status = trans('main.orders.cancelled');
        }else{
            $status = trans('main.orders.declined');
        }

  return $status;
}
function status_offers_trans($status){
  if($status == 'pending'){
            $status = trans('main.pending');
        }elseif($status == 'accept'){
            $status = trans('main.accepted');
        }elseif($status == 'refused'){
            $status = trans('main.declined');
        }

  return $status;
}

function days_trans($day_name){
    switch ($day_name) {
      case "1":
        $day_name = trans('main.saturday');
        break;
      case "2":
        $day_name = trans('main.sunday');
        break;
      case "3":
        $day_name = trans('main.monday');
        break;
      case "4":
        $day_name = trans('main.tuesday');
        break;
      case "5":
        $day_name = trans('main.wednesday');
        break;
      case "6":
        $day_name = trans('main.thursday');
        break;
      case "7":
        $day_name = trans('main.friday');
        break;
    }
    return $day_name;
}


function account_type_trans($account_type){
    if($account_type == 'delegate'){
        $account_type = trans('main.delegate');
    }elseif($account_type == 'user'){
        $account_type = trans('main.user');
    }elseif($account_type == 'workshop'){
        $account_type = trans('main.workshop');
    }
    return $account_type;   
}

function rating_trans($rate){
  if($rate == '0'){
    $rate = trans('main.very bad');
  }elseif($rate == '1'){
    $rate = trans('main.bad');
  }elseif($rate == '2'){
    $rate = trans('main.good');
  }elseif($rate == '3'){
    $rate = trans('main.very good');
  }else{
    $rate = trans('main.excellent');
  }

  return $rate;
}

function slug($string, $separator = '-') {
    if (is_null($string)) {
    return "";
    }

    $string = trim($string);

    $string = mb_strtolower($string, "UTF-8");;

    $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

    $string = preg_replace("/[\s-]+/", " ", $string);

    $string = preg_replace("/[\s_]/", $separator, $string);

  return $string;
}

function removeSlug($string, $separator = '-') {
    // Check if the string is null or empty
    if (is_null($string)) {
        return "";
    }

    // Replace the separator (e.g., hyphen) with spaces
    $string = str_replace($separator, ' ', $string);

    // Trim the result to remove any leading/trailing spaces
    $string = trim($string);

    return $string;
}




function incoming()
{
  $arr = [
    'saudi',
    'other',
    'gulf',
  ];
  return $arr;
}

function fuel_type()
{
  $arr = [
    'gasoline',
    'diesel',
    'hybrid',
    'electric',
  ];
  return $arr;
}

function carsCount($car_type)
{
  $cars = \App\Models\Car::query();

  $cars=$cars->where('car_type', $car_type)->where('status', 'show')->count();

  return $cars;
}

function isUserSellCar()
{
  $car = \App\Models\SellCar::whereNull('status')->where('ip_address',request()->ip())->first();
  if(!$car){
    return null;
  }
  return $car;
}
function getMenuData() {
    return [
        'roles' => 'bi bi-shield-lock',
        'admins' => 'bi bi-person-gear',
        'users' => 'bi bi-people',
        // 'vendors' => 'bi bi-person-badge',
        'settings' => 'bi bi-gear',
        'pages' => 'bi bi-file-richtext',
        'products' => 'bi bi-box-seam',
        // 'reports' => 'bi bi-file-earmark-bar-graph',
        'blogs' => 'bi bi-newspaper',
        'contacts' => 'bi bi-chat-text',
        'subscribers' => 'bi bi-envelope',
        'locations' => 'bi bi-pin-map',
    ];
}

function permissionArrayLoop() {
    return array_keys(getMenuData());
}

function iconMenuLoop() {
    $data =getMenuData();
    if(auth()->user()->account_type == 'admins'){
        unset($data['subadmins']);
    }
    return $data;
}

 function shorten_URL ($longUrl) {
  $key = 'AIzaSyCiHHQPjy6oeKoN9H-j1LNEBZnwIu7n1pQ';
  $url = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=' . $key;
  $data = array(
     "dynamicLinkInfo" => array(
        "dynamicLinkDomain" => "freshcoupnn.page.link",
        "link" => $longUrl
     )
  );

  $headers = array('Content-Type: application/json');

  $ch = curl_init ();
  curl_setopt ( $ch, CURLOPT_URL, $url );
  curl_setopt ( $ch, CURLOPT_POST, true );
  curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt ( $ch, CURLOPT_POSTFIELDS, json_encode($data) );

  $data = curl_exec ( $ch );
  curl_close ( $ch );
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );

  $short_url = json_decode($data);
  if(isset($short_url->error)){
      return $short_url->error->message;
  } else {
      return $short_url->shortLink;
  }

}


function week_days(){
  return ['saturday','sunday','monday','tuesday','wednesday','thursday','friday'];
}


function getSubAdmins($roleId){ 
  if($roleId == 2)
  {
    $roleId = 2; // order manager
  }
  else if($roleId == 3){
    $roleId = 3; // order employee
  }
  $users = \App\Models\User::where('added_by',auth('admin')->user()->id)->whereHas('roles', function ($query) use ($roleId) {
              $query->where('id', $roleId);
          })->get();

  return $users;
}
function getArea($areaId){ 
  $area = \App\Models\Location::where('type','governorate')->where('id', $areaId)->first();
  return $area;
}
function getGovernorates(){ 
  $area = \App\Models\Location::where('type','governorate')->get();
  return $area;
}
function getStore($storeId){ 
  $store = \App\Models\Store::where('id', $storeId)->first();
  return $store;
}
function getCoupon($couponId){ 
  $coupon = \App\Models\Coupon::where('id', $couponId)->first();
  return $coupon;
}

function getCategory($categoryId){ 
  $category = \App\Models\Category::where('id', $categoryId)->first();
  return $category;
}

function priceOfCapacity($product_id, $amount)
{
    $product = \App\Models\Product::findOrFail($product_id);
    // $price_capacity = \App\Models\ProductCapacity::where('product_id',$product_id)->where('amount', $amount)->first();
    if(! $price_capacity){
        return null;
    }

    // $coupon = \App\Models\ProductCoupon::whereHas('coupon',function($q){
         // $q->where('type','percentage');
      // })->where('product_id',$product->id)->first();
      $current_price = round( (($product->price * $amount) /1000) ,2);
      // if(! $coupon){
         return ['current_price' => $current_price, 'offer_coupon' => 0];
      // }else{
         // $offer_coupon = round( $current_price - (($current_price * $coupon->discount) /100) ,2);
         // return ['current_price' => $current_price, 'offer_coupon' => $offer_coupon];
      // }
}


// function applyCoupon($coupon, $cart){ 
//     dd($cart);
//     $couponProductIds = $coupon->products->pluck('id')->toArray();
//     $cartProductIds = $cart->pluck('product_id')->toArray();
//     $cartTotalPrice = $cart->sum('total_price');
//     $cartTotalPriceAfterDiscount=0;
//     $productsCouponNotApplied = 0;
//     $cartBrandIds = \App\Models\Brand::whereHas('products',function($q) use($cartProductIds){
//         $q->whereIn('id',$cartProductIds);
//     })->pluck('id')->toArray();
//     if(count($couponProductIds) > 0){
//         $hasCouponProduct = !empty(array_intersect($cartProductIds, $couponProductIds));
//         $productsCouponApplied = $cart->filter(function($cartItem) use ($couponProductIds) {
//             return in_array($cartItem->product_id, $couponProductIds);
//         });
//         $productsCouponNotApplied = $cart->filter(function($cartItem) use ($couponProductIds) {
//             return !in_array($cartItem->product_id, $couponProductIds);
//         });
//         $cartTotalPrice = $productsCouponApplied->sum('total_price');
//     }elseif($coupon->coupon_discount->brand_id != null){
//         $hasCouponProduct = !empty(in_array($coupon->coupon_discount->brand_id,$cartBrandIds ));
//         $productsCouponApplied = $cart->filter(function($cartItem) use ($coupon) {
//             return $cartItem->product->brand_id == $coupon->coupon_discount->brand_id;
//         });
//         $productsCouponNotApplied = $cart->filter(function($cartItem) use ($coupon) {
//             return $cartItem->product->brand_id != $coupon->coupon_discount->brand_id;
//         });
//         $cartTotalPrice =$productsCouponApplied->sum('total_price');
//     }elseif($coupon->coupon_discount->category_id != null){
//         $hasCouponProduct = !empty(in_array($coupon->coupon_discount->category_id,$cartBrandIds ));
//         $productsCouponApplied = $cart->filter(function($cartItem) use ($coupon) {
//             return $cartItem->product->category_id == $coupon->coupon_discount->category_id;
//         });
//         $productsCouponNotApplied = $cart->filter(function($cartItem) use ($coupon) {
//             return $cartItem->product->category_id != $coupon->coupon_discount->category_id;
//         });
//         $cartTotalPrice =$productsCouponApplied->sum('total_price');
//     }
    
//     if ($hasCouponProduct) {
//         if($coupon->coupon_discount){
//             if($coupon->coupon_discount->discount_type == 'percentage'){
//                 $cartTotalPriceAfterDiscount= $cartTotalPrice - ($cartTotalPrice* $coupon->coupon_discount->discount_value/100) + ($productsCouponNotApplied->sum('total_price'));
//             }
//             else if($coupon->coupon_discount->discount_type == 'fixed'){
//                 $cartTotalPriceAfterDiscount = $cartTotalPrice - $coupon->coupon_discount->discount_value + ($productsCouponNotApplied->sum('total_price'));
//             }
//         }
//         return ['coupon_applied' => 'yes', 'price_after_coupon' => round($cartTotalPriceAfterDiscount,2)]; //done coupon applied
//     } else {
//         return ['coupon_applied' => 'no', 'price_after_coupon' => round($cartTotalPriceAfterDiscount,2)]; //not found product inside coupons
//     }
// }

function applyCoupon($coupon, $cart)
{
    $couponProductIds = $coupon->products->pluck('id')->toArray();
    $cartProductIds = collect($cart)->pluck('product_id')->filter()->toArray(); 
    $cartTotalPrice = 0;
    $cartTotalPriceAfterDiscount = 0;

    $productsCouponApplied = collect();
    $productsCouponNotApplied = collect();
    $products = \App\Models\Product::query();
    if($coupon->admin?->store?->name != null){
        $products = $products->where('store_id', $coupon->admin?->store?->id);
    }
    $products = $products->whereIn('id', $cartProductIds)->with('brand', 'category')->get()->keyBy('id');
    foreach ($cart as $item) {
        if (!isset($item['product_id']) || !isset($item['qty'])) {
            continue;
        }

        $product = $products[$item['product_id']] ?? null;
        if (!$product) continue;

        $itemTotal = $product->realprice * $item['qty'];
        $item['total_price'] = $itemTotal;
        $item['product'] = $product;
        
        if (!empty($couponProductIds)) {
            if (in_array($product->id, $couponProductIds)) {
                $productsCouponApplied->push($item);
            } else {
                $productsCouponNotApplied->push($item);
            }
        } elseif ($coupon->coupon_discount->brand_id) {
            if ($product->brand_id == $coupon->coupon_discount->brand_id) {
                $productsCouponApplied->push($item);
            } else {
                $productsCouponNotApplied->push($item);
            }
        } elseif ($coupon->coupon_discount->category_id) {
            if ($product->category_id == $coupon->coupon_discount->category_id) {
                $productsCouponApplied->push($item);
            } else {
                $productsCouponNotApplied->push($item);
            }
        }
    }

    $hasCouponProduct = $productsCouponApplied->isNotEmpty();
    $cartTotalPrice = $productsCouponApplied->sum('total_price');
    if ($hasCouponProduct) {
        if ($coupon->coupon_discount) {
            if ($coupon->coupon_discount->discount_type == 'percentage') {
                $cartTotalPriceAfterDiscount = $cartTotalPrice - ($cartTotalPrice * $coupon->coupon_discount->discount_value / 100)
                    + $productsCouponNotApplied->sum('total_price');
            } elseif ($coupon->coupon_discount->discount_type == 'fixed') {
                $cartTotalPriceAfterDiscount = $cartTotalPrice - $coupon->coupon_discount->discount_value
                    + $productsCouponNotApplied->sum('total_price');
            }
        }

        return [
            'price_before_coupon' => round($productsCouponNotApplied->sum('total_price')+ $productsCouponApplied->sum('total_price'),2),
            'coupon_applied' => 'yes',
            'price_after_coupon' => round($cartTotalPriceAfterDiscount, 2)
        ];
    } else {
        return [
            'price_before_coupon' => round($productsCouponNotApplied->sum('total_price')+ $productsCouponApplied->sum('total_price'),2),
            'coupon_applied' => 'no',
            'price_after_coupon' => round($cartTotalPriceAfterDiscount, 2)
        ];
    }
}

?>