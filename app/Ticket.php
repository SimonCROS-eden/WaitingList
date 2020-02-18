<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ticket extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ticket';

    protected $fillable = [
        'title', 'desc'
    ];

    public function asker()
    {
        return $this->belongsTo('App\User', 'ask_id');
    }

    public function helper()
    {
        return $this->belongsTo('App\User', 'help_id');
    }

    public function hasHelper()
    {
        return !empty($this->helper);
    }
  
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'ticket-tag', 'ticket_id', 'tag_id');
    }

    public function updateTake()
    {
        return Auth::user()->can('updateTake', $this);
    }

    public function updateTakeMaker()
    {
        return Auth::user()->can('updateTakeMaker', $this);
    }

    public function serialize()
    {
        $helper = $this->helper ? [
            "first_name" => $this->helper->first_name,
            "last_name" => $this->helper->last_name,
        ] : null;
        $tags = [];
        foreach ($this->tags as $tag) {
            $tags[] = [
                "name" => $tag->name,
                "color" => $tag->color
            ];
        }
        return [
            "id" => $this->id,
            "title" => $this->title,
            "desc" => $this->desc,
            "ask_id" => $this->ask_id,
            "help_id" => $this->help_id,
            "update_take" => $this->updateTake(),
            "update_take_maker" => $this->updateTakeMaker(),
            "asker" => [
                "first_name" => $this->asker->first_name,
                "last_name" => $this->asker->last_name,
            ],
            "helper" => $helper,
            "tags" => $tags
        ];
    }
}
