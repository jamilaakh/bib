<?php

namespace App\Listeners\Books;

use Illuminate\Support\Facades\Log;
use App\Events\Books\DeleteBookEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteBookListener
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
    public function handle(DeleteBookEvent $event)
    {
        $id = $event->book->id;
        Log::info("The book $id has been deleted");
    }
}
