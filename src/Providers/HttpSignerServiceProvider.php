<?php

namespace foxett\HttpSignerForLaravel\Providers;

use Illuminate\Support\ServiceProvider;

class HttpSignerServiceProvider extends ServiceProvider
{
    public function boot()
    {
            $this->publishes([
                __DIR__ . '/../../config/http-signer.php' => config_path('http-signer.php'),
            ], 'http-signer-config');

    }
}