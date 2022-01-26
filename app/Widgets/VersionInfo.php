<?php

namespace App\Widgets;


class VersionInfo extends AbstractWidgetCore
{
    protected function config(): array
    {
        return [
            'title' => trans('Fassi Store Management System'),
            'version' => config('moco.app.version'),
            'release' => config('moco.app.release'),
            'width' => '350px',
            'height' => '200px',
        ];
    }

    protected function widget(): string
    {
        return 'widgets.version-info';
    }
}
