<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'ticket-tag', 'ticket_id', 'tag_id');
    }
}
