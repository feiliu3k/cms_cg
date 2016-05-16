<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ChaoSky
 *
 * @property integer $tipid
 * @property string $tiptitle
 * @property string $tipimg1
 * @property string $tipcontent
 * @property \Carbon\Carbon $stime
 * @property integer $postflag
 * @property string $posttime
 * @property integer $userid
 * @property integer $post_user
 * @property integer $readnum
 * @property integer $proid
 * @property string $tipvideo
 * @property integer $commentflag
 * @property integer $delflag
 * @property integer $draftflag
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\ChaoPro $chaoPro
 * @property-read \App\User $createUser
 * @property-read \App\User $postUser
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ChaoComment[] $chaoComment
 * @property-read mixed $publish_date
 * @property-read mixed $publish_time
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky whereTipid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky whereTiptitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky whereTipimg1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky whereTipcontent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky whereStime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky wherePostflag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky wherePosttime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky whereUserid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky wherePostUser($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky whereReadnum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky whereProid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky whereTipvideo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky whereCommentflag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky whereDelflag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky whereDraftflag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ChaoSky whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChaoSky extends Model
{
    protected $table = 'chaosky';
    protected $primaryKey='tipid';
    protected $dates = ['stime'];

    protected $fillable = [
        'tiptitle', 'tipimg1','tipcontent','tipvideo','readnum','commentflag','draftflag','stime','proid',
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
}
