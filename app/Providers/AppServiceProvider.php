<?php

namespace App\Providers;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        //        if (env('APP_DEBUG')) {
        //            DB::listen(function ($query) {
        //                Log::debug('SQL', ['query' => $query->sql, 'bindings' => $query->bindings, 'time' => $query->time]);
        //            });
        //        }
        JsonResource::wrap('items');

        // DB::listen(function ($query) {
        //     File::append(
        //         storage_path('/logs/query.log'),
        //         '[' . date('Y-m-d H:i:s') . ']' . PHP_EOL . $query->sql . ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL . PHP_EOL
        //     );
        // });

    }
}
