<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\App;

class Brand extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $guarded = [];
	public function scopeActive($query)
    {
       return $query->where('status','show');
    }

    public function admin() {
        return $this->belongsTo(\App\Models\User::class,'added_by');
    }
   protected static function boot() {
      parent::boot();
         static::deleting(function($brand) {
         });
   }

   public function getTitleAttribute()
   {
       $lang = App::getLocale();
       $column = "title_" . $lang;
       return $this->{$column};
   }

   public function products() {
        return $this->hasMany(\App\Models\Product::class);
    }

    private static function getSalesForDateRange($dateRange, $range)
    {
        $query = self::with(['products.carts.order' => function ($query) {
            $query->where('status', 'completed'); // only completed orders
        }]);

        // Apply the appropriate date filtering
        if ($dateRange === 'whereDate') {
            $query->whereDate('created_at', $range);
        } elseif ($dateRange === 'whereBetween') {
            $query->whereBetween('created_at', $range);
        } elseif ($dateRange === 'whereMonth') {
            $query->whereMonth('created_at', $range);
        } elseif ($dateRange === 'whereYear') {
            $query->whereYear('created_at', $range);
        }

        $sales = $query->get()->map(function ($brand) {
            $totalSales = $brand->products->sum(function ($product) {
                return $product->carts->sum(function ($cart) {
                    return $cart->qty * $cart->price;
                });
            });

            return [
                'brand_name' => $brand->title,
                'grand_total' => $totalSales,
            ];
        });

        return [
            'sales' => $sales,
        ];
    }

    // Example usage for specific date ranges
    public static function getDailySales()
    {
        return self::getSalesForDateRange('whereDate', now()->toDateString());
    }

    public static function getYesterdaySales()
    {
        return self::getSalesForDateRange('whereDate', now()->subDay()->toDateString());
    }

    public static function getWeeklySales()
    {
        return self::getSalesForDateRange('whereBetween', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public static function getLastWeekSales()
    {
        $startOfLastWeek = now()->subWeek()->startOfWeek();
        $endOfLastWeek = now()->subWeek()->endOfWeek();

        return self::getSalesForDateRange('whereBetween', [$startOfLastWeek, $endOfLastWeek]);
    }

    public static function getMonthlySales()
    {
        return self::getSalesForDateRange('whereMonth', now()->month)->whereYear('created_at', now()->year);
    }

    public static function getLastMonthSales()
    {
        $startOfLastMonth = now()->subMonth()->startOfMonth();
        $endOfLastMonth = now()->subMonth()->endOfMonth();

        return self::getSalesForDateRange('whereBetween', [$startOfLastMonth, $endOfLastMonth]);
    }

    public static function getYearlySales()
    {
        return self::getSalesForDateRange('whereYear', now()->year);
    }

    public static function getLastYearSales()
    {
        $startOfLastYear = now()->subYear()->startOfYear();
        $endOfLastYear = now()->subYear()->endOfYear();

        return self::getSalesForDateRange('whereBetween', [$startOfLastYear, $endOfLastYear]);
    }

    public static function getSalesBetweenDates($startDate, $endDate)
    {
        return self::getSalesForDateRange('whereBetween', [$startDate, $endDate]);
    }

    public static function getBrandPaymentsReport()
    {
        $sales = self::with(['products.carts.order' => function ($query) {
            // Filter completed orders only
            $query->where('status', 'completed');
        }])->get()->map(function ($brand) {
            $cashPayments = $brand->products->sum(function ($product) {
                return $product->carts->sum(function ($cart) {
                    // Ensure only cash payments are counted
                    if ($cart->order->payment_method === 'cash') {
                        return $cart->qty * $cart->price;
                    }
                    return 0;
                });
            });

            $onlinePayments = $brand->products->sum(function ($product) {
                return $product->carts->sum(function ($cart) {
                    // Ensure only online payments are counted
                    if ($cart->order->payment_method === 'online') {
                        return $cart->qty * $cart->price;
                    }
                    return 0;
                });
            });

            return [
                'brand_name' => $brand->title,
                'cash_payments' => $cashPayments,
                'online_payments' => $onlinePayments,
            ];
        });

        return [
            'sales' => $sales,
        ];
    }

}
