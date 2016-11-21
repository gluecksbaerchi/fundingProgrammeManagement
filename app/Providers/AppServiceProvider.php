<?php

namespace App\Providers;

use App\Models\FundingProgramme;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        FundingProgramme::updating( function (FundingProgramme $fundingProgramme) {
            $actualFundingProgramme = FundingProgramme::find($fundingProgramme->id);
            $copy = $fundingProgramme->replicate();
            $copy->actual_id = $actualFundingProgramme->id;
            $copy->user_id = \Auth::user()->id;
            $copy->changes = $fundingProgramme->compareWith($actualFundingProgramme);
            return $copy->save();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
