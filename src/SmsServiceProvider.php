<?php
namespace Codificar\Sms;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'sms');

        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/sms'),
        ], 'sms-auth');
    }

    public function register()
    {

    }
}
?>