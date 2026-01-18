<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SiteContent extends Model
{
    use  HasTranslations;

    protected $fillable = ['key', 'value'];

    public array $translatable = ['value'];
}
