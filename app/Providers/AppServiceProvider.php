<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registers any application services.
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
        Validator::extend('check_past_time', function ($attribute, $value, $parameters, $validator) {
            if (!isset($parameters[0])) {
                return true; // No date provided, so can't check against it
            }

            $eventDate = Carbon::parse($parameters[0])->toDateString();
            $eventTime = Carbon::parse($value)->toTimeString();
            $eventDateTime = Carbon::parse($eventDate . ' ' . $eventTime);
            $now = Carbon::now();

            if ($eventDate === $now->toDateString() && $eventDateTime->isPast()) {
                return false;
            }

            return true;
        });
    }
}
