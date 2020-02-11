<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $update = [];

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($update)
    {
        foreach ($update as $ticket) {
            $this->update[] = [
                "id" => $ticket->id,
                "title" => $ticket->title,
                "user" => $ticket->asker->first_name . " " . $ticket->asker->last_name,
                "description" => $ticket->desc
            ];
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('ticket');
    }
}
