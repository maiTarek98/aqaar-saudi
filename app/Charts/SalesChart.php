<?php
namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Order;

class SalesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $salesData = Order::where('status', 'completed')
            ->selectRaw('DATE(created_at) as date, COUNT(id) as sales')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    
        return $this->chart->barChart()
            ->setTitle('المبيعات اليومية')
            ->setXAxis($salesData->pluck('date')->toArray())
            ->setDataset([
                [
                    'name' => 'المبيعات',
                    'data' => $salesData->pluck('sales')->toArray(),
                ]
            ])->setColors(['#957427']);
    }

}
