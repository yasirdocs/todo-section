<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = "section";
    protected $fillable = [
        'id',
        'name',
        'description'
    ];
    
    public function tasks()
    {
       return $this->hasMany('App\Task');
    }
}
