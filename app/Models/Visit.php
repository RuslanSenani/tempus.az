<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{

    protected $fillable = [
        'ip_address',
        'browser',
        'os',
        'is_bot',
        'user_agent',
        'url',
        'referer',
        'language',
        'reason',
        'request_count'
    ];

}
