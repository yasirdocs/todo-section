<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "task";
    protected $fillable = [
        'id',
        'id_section',
        'name',
        'description',
        'state'
    ];

    public function sections()
    {
        return $this->belongsTo('App\Section', 'id_section', 'id');
    }

    public function scopeFilter($query, $filters)
    {
        if( isset($filters['state']) ){
          $query->where('state', '=', $filters['state']);
        }
    }    
}
