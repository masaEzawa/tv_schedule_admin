<?php

namespace App\Providers;

use App\Models\UserAccount;
// TV番組
use App\Models\Tv\TvReserve;

// オブサーバー
use App\Original\Observer\UserAccountModelObserver;
use App\Original\Observer\ModelsObserver;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // ユーザーアカウント用オブザーバー
        UserAccount::observe( new UserAccountModelObserver() );

        // TV番組
        TvReserve::observe( new ModelsObserver() );
    }
}
