<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tag';

    protected $fillable = [
        'name', 'color'
    ];

    public function tickets()
    {
        return $this->belongsToMany('App\Ticket', 'ticket-tag');
    }
}
