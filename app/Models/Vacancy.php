<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Vacancy extends Model
{
    use  HasTranslations;

    protected $fillable = [
        'title', 'salary', 'company', 'city',
        'age', 'education', 'experience', 'phone', 'email', 'description', 'is_active'
    ];

    public array $translatable = ['title', 'description', 'age', 'city', 'company', 'experience', 'education'];


}
