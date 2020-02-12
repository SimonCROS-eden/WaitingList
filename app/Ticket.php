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
}
