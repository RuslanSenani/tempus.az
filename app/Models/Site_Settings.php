<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site_Settings extends Model
{
    protected $table = 'site_settings';
    protected $fillable = ['key_value'];
    protected $casts = [
        'key_value' => 'array',
    ];

}
