<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jrsx extends Model
{
    protected $table = 'jrsx';
    protected $primaryKey='id';
    protected $dates = ['postdate'];
    public $timestamps = false;

    protected $guarded = [];

    public function favUsers()
    {
        return $this->hasMany('App\User','jrsxfav','jrsxid','userid');
    }

    public function remarks()
    {
        return $this->hasMany('App\Jrsxremark','jrsxid','id');
    }
}
