<?php

namespace Lotto\Providers;

use Illuminate\Support\ServiceProvider;

class LottoProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when('\Lotto\Services\DrawMainService')
            ->needs('Lotto\Interfaces\LottoGameRepositoryInterface')
            ->give('\Lotto\Repositories\LottoGameRepository');

        $this->app->when('\Lotto\Services\DrawPowerballService')
            ->needs('Lotto\Interfaces\LottoGameRepositoryInterface')
            ->give('\Lotto\Repositories\LottoGameRepository');

    }
}
