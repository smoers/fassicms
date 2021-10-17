<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class VersionInfo extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $this->config();
        return view('widgets.version_info', [
            'config' => $this->config,
        ]);
    }

    private function config(){
        $this->config = [
            'title' => trans('Fassi Store Management System'),
            'version' => config('moco.app.version'),
            'release' => config('moco.app.release'),
            'width' => '350px',
            'height' => '200px',
        ];
    }
}
