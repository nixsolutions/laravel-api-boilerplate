<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Team extends Model
{
    use Notifiable;

    public $table = 'teams';

    protected $fillable = [
        'name'
    ];

    public function parent()
    {
        return $this->belongsTo(Team::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Team::class, 'parent_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'membership', 'team_id', 'user_id');
    }
}
