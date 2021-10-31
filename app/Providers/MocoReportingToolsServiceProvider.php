<?php

namespace App\Providers;

use App\Moco\Reporting\MocoReportingTools;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MocoReportingToolsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('moco.fieldlist', function (){
            return new MocoReportingTools();
        });

        $this->app->alias('moco.fieldlist','Moco\Reporting\MocoReportingTools');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('mocorfl',function ($expression){
            return app('moco.fieldlist')->run($expression);
        });
    }
}
