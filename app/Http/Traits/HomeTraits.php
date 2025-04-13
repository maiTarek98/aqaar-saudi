<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Banner;
use App\Models\QuestionAnswer;
use Illuminate\Support\Str;
trait HomeTraits
{

    public function generateUniqueCode($length = 10)
    {
        do {
            $code = Str::upper(Str::random($length));
        } while (CouponSubscripe::where('user_coupon_code', $code)->exists());

        return $code;
    }
}