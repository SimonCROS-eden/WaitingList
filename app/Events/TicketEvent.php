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
    public $remove = [];

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($update, $remove = [])
    {
        foreach ($update as $ticket) {
            $this->update[] = [
                "ticket" => [
                    "id" => $ticket->id,
                    "title" => $ticket->title,
                    "desc" => $ticket->desc,
                    "asker" => [
                        "first_name" => $ticket->asker->first_name,
                        "last_name" => $ticket->asker->last_name,
                    ]
                ]
            ];
        }
        foreach ($remove as $ticket) {
            $this->remove[] = [
                "id" => $ticket->id
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
