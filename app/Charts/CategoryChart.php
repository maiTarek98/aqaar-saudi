<?php
namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Cart;
use App\Models\Category;

class CategoryChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $salesData = Cart::whereHas('order',function($q){
            $q->where('status','completed');
        })->join('products', 'carts.product_id', '=', 'products.id')
            ->selectRaw('products.category_id, COUNT(carts.id) as sales')
            ->groupBy('products.category_id')
            ->get();
        $categoryNames = [];
        $salesCounts = [];

        foreach ($salesData as $data) {
            $category = Category::find($data->category_id);
            if ($category) {
                $categoryNames[] = $category->title;
                $salesCounts[] = $data->sales;
            }
        }
        return $this->chart->pieChart()
            ->setTitle('المبيعات حسب الفئة')
            ->setLabels($categoryNames)
            ->setDataset($salesCounts);
    }
}
