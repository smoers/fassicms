<?php

namespace App\Widgets;

use App\Models\ViewPartmetadatasReassort;

class StockInfo extends AbstractWidgetCore
{
    protected function config(): array
    {
        return [
            'title' => trans('Stock info'),
            'count' => ViewPartmetadatasReassort::query()->count(),
            'report' => route('report.reassortLevel'),
            'width' => '300px',
            'height' => '150px',
        ];
    }

    protected function widget(): string
    {
        return 'widgets.stock-info';
    }
}
