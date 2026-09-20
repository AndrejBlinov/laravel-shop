<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
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
        if (!Schema::hasTable('cities')) {
            View::share('cities', collect());
            View::share('currentCity', null);
            return;
        }

        $cities = Cache::remember('city_list', 3600, function () {
            $cities = City::with('warehouses')->get()->toArray();
            return $cities;
        });
        
        // 2. Превращаем массив обратно в объекты, сохраняя вложенные отношения!
        $cities = collect($cities)->map(function ($item) {
            $cityObj = (object) $item;
            
            // Если у города есть склады, превращаем их массив тоже в коллекцию объектов
            if (isset($cityObj->warehouses) && is_array($cityObj->warehouses)) {
                $cityObj->warehouses = collect($cityObj->warehouses)->map(function ($wh) {
                    return (object) $wh;
                });
            }
            
            return $cityObj;
        });

        View::composer('*', function ($view) use ($cities) {
            $cityId = session('city_id');
            $cityId = $cityId ?? 1;

            $currentCity = $cityId ? $cities->firstWhere('id', $cityId) : null;

            // Делимся выбранным городом со всеми view
            $view->with('currentCity', $currentCity);
            $view->with('cities', $cities);
        });
        
    }
}
