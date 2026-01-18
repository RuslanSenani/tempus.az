<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Vacancy extends Model
{
    use  HasTranslations;

    protected $fillable = [
        'title', 'description', 'location', 'salary',
        'experience', 'education', 'email', 'phone', 'is_active'
    ];

    public array $translatable = ['title', 'description', 'location', 'experience', 'education'];


}
