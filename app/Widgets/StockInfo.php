<?php

namespace App\Widgets;

use App\Models\ViewPartmetadatasReassort;
use Arrilot\Widgets\AbstractWidget;

class StockInfo extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = null;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $this->config();
        return view('widgets.stock_info', [
            'config' => $this->config,
        ]);
    }

    private function config(){
        $this->config = [
            'title' => trans('Stock info'),
            'count' => ViewPartmetadatasReassort::query()->count(),
            'report' => route('report.reassortLevel'),
            'width' => '300px',
            'height' => '150px',
        ];
    }
}
