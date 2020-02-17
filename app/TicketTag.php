<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketTag extends Model
{
    protected $table = 'ticket-tag';

    protected $fillable = [
        'ticket_id', 'tag_id'
    ];

    public function tags()
    {
        return $this->belongsTo('App\Tag', 'tag_id');
    }

    public function tickets()
    {
        return $this->belongsTo('App\Ticket', 'ticket_id');
    }
}
