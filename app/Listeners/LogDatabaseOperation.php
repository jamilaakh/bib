<?php

namespace App\Listeners;

use App\Models\Operation;
use App\Events\DatabaseOperation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogDatabaseOperation
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
     * @param  \App\Events\DatabaseOperation  $event
     * @return void
     */
    public function handle(DatabaseOperation $event)
    {
        Operation::create([
            'type' => $event->type,
            'table' => $event->table,
            'user_id' => $event->user_id,
        ]);
    }
}
