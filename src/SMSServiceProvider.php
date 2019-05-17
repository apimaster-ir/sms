<?php

namespace APIMaster\SMS;

use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $api_key = env('APIMASTER_SMS_API_KEY');

        if (!is_null($api_key)) {
            SMS::setApiKey($api_key);
        }
    }
}
