<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Mailsetting;
use Illuminate\Support\Facades\Event;

use App\Listeners\TableChangeListener;
use Illuminate\Database\Events\StatementExecuted;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
