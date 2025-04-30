<?php
namespace App\Charts;

// use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Order;

class OrdersStatusChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $orderStatusData = Order::selectRaw('status, COUNT(id) as count')
            ->groupBy('status')
            ->get();
        $statuses = [];
        $totals = [];

        foreach ($orderStatusData as $data) {
            $statuses[] = ucfirst($data->status);
            $totals[] = $data->count;
        }                 

        return $this->chart->donutChart()
            // ->setTitle('حالات الطلبات')
            ->setLabels($statuses)
            ->setDataset($totals)
            ->setOptions([
                'plotOptions' => [
                    'pie' => [
                        'donut' => [
                            'size' => '75%' // حجم الفتحة الوسطى
                        ]
                    ]
                ],
                'legend' => [
                    'position' => 'bottom', // تحط الليجند تحت لو عايزة
                    'labels' => [
                        'colors' => '#333',
                        'useSeriesColors' => false
                    ]
                ]
            ]);
    }
}
