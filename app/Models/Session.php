<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'sessions';

    protected $fillable = [
        'user_id',
        'ip_address',
        'with_cookies',
        'user_agent',
        'payload',
        'last_activity'
    ];
}
