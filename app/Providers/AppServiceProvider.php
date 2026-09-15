<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\City;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $cityId = session('city_id');
        $currentCity = $cityId ? City::find($cityId) : null;
        $cities = City::with('warehouses')->get();
        // Делимся выбранным городом со всеми view
        View::share('currentCity', $currentCity);
        View::share('cities', $cities);
    }
}
