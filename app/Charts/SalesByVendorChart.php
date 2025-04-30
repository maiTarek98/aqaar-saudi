<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Order;
use App\Models\Store;
class SalesByVendorChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $salesData = Order::where('status','completed')->selectRaw('store_id, COUNT(id) as sales')
            ->groupBy('store_id')
            ->orderBy('sales', 'desc')
            ->get();
        $storeNames = [];
        $salesCounts = [];

        foreach ($salesData as $data) {
            $store = store::find($data->store_id);
            if ($store) {
                $storeNames[] = $store->name;
                $salesCounts[] = $data->sales;
            }
        }
        return $this->chart->barChart()
            ->setTitle('إجمالي المبيعات لكل متجر')
            ->setXAxis($storeNames)
            ->setHeight(280)
            ->setDataset([
                [
                    'name' => 'عدد الطلبات',
                    'data' => $salesCounts,
                ]
            ])->setColors(['#957427']);
    }
}

