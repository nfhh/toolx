<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
/*        if (App::environment() === 'local') {
            DB::listen(function ($query) {
                $sql = $query->sql;
                $i = 0;
                while (true) {
                    if (!$position = strpos($sql, '?')) {
                        break;
                    }

                    $prefix = substr($sql, 0, $position) . $query->bindings[$i];
                    $subfix = substr($sql, $position + 1);

                    $sql = $prefix . $subfix;
                    $i++;
                }
                Log::debug($sql);
            });
        }*/
    }
}
