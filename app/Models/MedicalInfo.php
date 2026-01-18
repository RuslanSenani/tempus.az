<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MedicalInfo extends Model
{
    use HasTranslations;

    protected $fillable = ['title', 'content', 'image','image_alt_text', 'slug'];
    public array $translatable = ['title', 'content','image','image_alt_text','slug'];
}
