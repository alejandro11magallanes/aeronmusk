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
        Event::listen(StatementExecuted::class, TableChangeListener::class);
        
        if (\Schema::hasTable('mailsettings')) {
            $mailsetting = Mailsetting::first();
            if($mailsetting){
                $data = [
                    'driver'            => $mailsetting->mail_transport,
                    'host'              => $mailsetting->mail_host,
                    'port'              => $mailsetting->mail_port,
                    'encryption'        => $mailsetting->mail_encryption,
                    'username'          => $mailsetting->mail_username,
                    'password'          => $mailsetting->mail_password,
                    'from'              => [
                        'address'=>$mailsetting->mail_from,
                        'name'   => 'LaravelStarter'
                    ]
                ];
                Config::set('mail',$data);
            }
        }
    }
}
