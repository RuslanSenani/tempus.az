<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Language extends Model
{
    use  HasTranslations;

    protected $fillable = ['code', 'name', 'is_active', 'is_default'];

    public array $translatable = ['name'];
}
