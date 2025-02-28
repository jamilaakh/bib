<?php

namespace App\Listeners\Books;

use App\Events\Books\ReadBookEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReadBookListener
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
    public function handle(ReadBookEvent $event)
    {
        $id = $event->book->id;
        Log::info("The user inspected book $id");
    }
}
