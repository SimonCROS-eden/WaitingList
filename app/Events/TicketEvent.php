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

    public $update = null;
    public $remove = null;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($update, $remove = null)
    {
        if ($update) {
            $this->update = $update->serialize();
        }
        if ($remove) {
            $this->remove = $remove->id;
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

    public function broadcastAs() {
        return 'ticket.update';
    }
}
