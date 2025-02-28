<?php

namespace App\Listeners\Books;

use Illuminate\Support\Facades\Log;
use App\Events\Books\CreateBookEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateBookListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        // 
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CreateBookEvent $event)
    {
        $id = $event->book->id;
        Log::info("The book $id has been created");
    }
}
