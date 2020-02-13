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
    public function __construct($update, $remove = [])
    {
        foreach ($update as $ticket) {
            $helper = $ticket->helper ? [
                "first_name" => $ticket->helper->first_name,
                "last_name" => $ticket->helper->last_name,
            ] : null;
            $this->update = [
                "id" => $ticket->id,
                "title" => $ticket->title,
                "desc" => $ticket->desc,
                "ask_id" => $ticket->ask_id,
                "help_id" => $ticket->help_id,
                "update_take" => $ticket->updateTake(),
                "update_take_maker" => $ticket->updateTakeMaker(),
                "asker" => [
                    "first_name" => $ticket->asker->first_name,
                    "last_name" => $ticket->asker->last_name,
                ],
                "helper" => $helper,
            ];
        }
        foreach ($remove as $ticket) {
            $this->remove = [
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
