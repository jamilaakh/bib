<?php

namespace App\Providers;

use App\Events\Books\ReadBookEvent;
use App\Events\Books\CreateBookEvent;
use App\Events\Books\DeleteBookEvent;
use App\Events\Books\UpdateBookEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\Books\ReadBookListener;
use App\Listeners\Books\CreateBookListener;
use App\Listeners\Books\DeleteBookListener;
use App\Listeners\Books\UpdateBookListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        CreateBookEvent::class => [CreateBookListener::class],
        ReadBookEvent::class   => [ReadBookListener::class],
        UpdateBookEvent::class => [UpdateBookListener::class],
        DeleteBookEvent::class => [DeleteBookListener::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
