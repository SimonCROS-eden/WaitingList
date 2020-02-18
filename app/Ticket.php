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

    public function shortDesc()
    {
        return substr($this->desc,0,100).(strlen($this->desc) > 100 ? ". . ." : "");
    }

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
}
