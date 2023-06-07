<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;
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
        /**
         * @param $data array
         * @param $message string
         * @param $status_code int
         * @param $status bool
         * @return JsonResource
         */
        Response::macro('success', function ($data = [], $message = 'Success', $status_code = 200) {
            return \response()->json([
                'status' => true,
                'message' => $message,
                'data' => $data,
            ], $status_code);
        });

        /**
         * @param $data array
         * @param $message string
         * @param $status_code int
         * @param $status bool
         * @return JsonResource
         */
        Response::macro('error', function ($data = [], $message = 'Something went wrong', $status_code = 500) {
            return \response()->json([
                'status' => false,
                'message' => $message,
                'data' => $data,
            ], $status_code);
        });

        /**
         * @param $data array
         * @param $message string
         * @param $status_code int
         * @param $status bool
         * @return JsonResource
         */
        Response::macro('failed', function ($data = [],
            $message = 'failed',
            $status_code = 404) {
            return abort(
                response()->json([
                    'status' => false,
                    'message' => $message,
                    'data' => $data,
                ], $status_code)
            );
        });
    }
}
