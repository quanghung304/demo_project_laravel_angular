<?php

namespace App\Providers;

use App\Services\CandBPolicy;
use App\Services\TaxPolicy;
use Illuminate\Support\ServiceProvider;

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
        $this->app->singleton(CandBPolicy::class, function ($app){
            return new CandBPolicy(2);
        });
        $this->app->singleton(TaxPolicy::class, function ($app){
            return new TaxPolicy(730000, 11000000, 4400000);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
