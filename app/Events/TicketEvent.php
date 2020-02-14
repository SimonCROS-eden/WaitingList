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
            $helper = $update->helper ? [
                "first_name" => $update->helper->first_name,
                "last_name" => $update->helper->last_name,
            ] : null;
            $tags = [];
            foreach ($update->tags as $tag) {
                $tags[] = [
                    "name" => $tag->name,
                    "color" => $tag->color
                ];
            }
            $this->update = [
                "id" => $update->id,
                "title" => $update->title,
                "desc" => $update->desc,
                "ask_id" => $update->ask_id,
                "help_id" => $update->help_id,
                "update_take" => $update->updateTake(),
                "update_take_maker" => $update->updateTakeMaker(),
                "asker" => [
                    "first_name" => $update->asker->first_name,
                    "last_name" => $update->asker->last_name,
                ],
                "helper" => $helper,
                "tags" => $tags
            ];
        }
        if ($remove) {
            $this->remove = $update->id;
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
