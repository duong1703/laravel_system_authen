<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    
    }

    protected $policies = [
        // Các policies của bạn
    ];


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
