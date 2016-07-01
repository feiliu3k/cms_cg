<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteItem extends Model
{
    protected $table = 'voteitem';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable = [
        'itemcontent'
    ];
    public function chaosky()
    {
        return $this->belongsTo('App\ChaoSky','tipid','tipid');
    }


}
