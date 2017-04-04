<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Activation
 * @package App\Models
 * @mixin Eloquent
 */
class Activation extends Model
{
    const EXPIRE_DAYS = 7;
    const ACTIVATION_HASH_LENGTH = 50;

    public $table = 'user_activation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token', 'expired', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
