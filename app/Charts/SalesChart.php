<?php
namespace App\Charts;

// use ArielMejiaDev\LarapexCharts\LarapexChart;
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
            ->setHeight(280)
            ->setDataset([
                [
                    'name' => 'المبيعات',
                    'data' => $salesData->pluck('sales')->toArray(),
                ]
            ])
            ->setOptions([
                'plotOptions' => [
                    'bar' => [
                        'columnWidth' => '40%', // عرض العمود (كلما قل الرقم زاد نحافة العمود)
                        'barHeight' => '100%', // هذا للحالات العرضية، غالبًا ما تستخدم في bar chart الأفقي
                        'distributed' => false // لو حابب الأعمدة تكون كل واحدة بلون مختلف
                    ]
                ],
                'chart' => [
                    'toolbar' => [
                        'show' => false
                    ]
                ],
                'dataLabels' => [
                    'enabled' => true
                ]
            ])
            ->setColors(['#957427']);
    }

}
