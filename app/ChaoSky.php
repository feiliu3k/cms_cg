<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ChaoSky extends Model
{
    protected $table = 'chaosky';
    protected $primaryKey='tipid';
    protected $dates = ['stime','vbtime','vetime'];

    protected $fillable = [
        'tiptitle', 'tipimg1', 'tipcontent', 'tipvideo', 'readnum', 'commentflag', 'draftflag', 'stime', 'proid', 'votenum', 'voteflag', 'vbtime', 'vetime'
    ];


    public function chaoPro()
    {
        return $this->belongsTo('App\ChaoPro','proid','id');
    }

    public function createUser()
    {
        return $this->belongsTo('App\User','userid','id');
    }

    public function postUser()
    {
        return $this->belongsTo('App\User','post_user','id');
    }


    public function comments()
    {
        return $this->hasMany('App\ChaoComment','tipid','tipid');
    }

    public function voteItems()
    {
        return $this->hasMany('App\VoteItem','tipid','tipid');
    }

    /**
     * Return the date portion of published_at
     */
    public function getPublishDateAttribute($value)
    {
        return $this->stime->format('Y-m-d');
    }

    /**
     * Return the time portion of published_at
     */
    public function getPublishTimeAttribute($value)
    {
        return $this->stime->format('H:i:s');
    }


     /**
     * Return the date portion of published_at
     */
    public function getVoteBeginDateAttribute($value)
    {
        return $this->vbtime->format('Y-m-d');
    }

    /**
     * Return the time portion of published_at
     */
    public function getVoteBeginTimeAttribute($value)
    {
        return $this->vbtime->format('H:i:s');
    }

     /**
     * Return the date portion of published_at
     */
    public function getVoteEndDateAttribute($value)
    {
        return $this->vetime->format('Y-m-d');
    }

    /**
     * Return the time portion of published_at
     */
    public function getVoteEndTimeAttribute($value)
    {
        return $this->vetime->format('H:i:s');
    }



}
