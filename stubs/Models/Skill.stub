<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Skill extends Model
{
    use Notifiable;

    public $table = 'skills';

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
