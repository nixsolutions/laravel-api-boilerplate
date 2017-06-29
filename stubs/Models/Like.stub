<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Like extends Model
{
    use Notifiable;

    public $table = 'likes';

    protected $fillable = [
        'comment'
    ];

    protected $guarded = array('updated_at');

    public $timestamps = false;

    public function liker()
    {
        return $this->belongsTo(User::class, 'liker_id');
    }

    public function liked()
    {
        return $this->belongsTo(User::class, 'liked_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
