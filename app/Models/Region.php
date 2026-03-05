<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Region extends Model
{
    use HasTranslations;

    protected $fillable = [ 'names'];
    public array $translatable = ['names'];
    protected $casts = [
        'names' => 'json',
    ];
}
