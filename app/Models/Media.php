<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Media extends Model
{
    use HasTranslations;

    public array $translatable = ['title', 'description'];

    protected $fillable = ['title', 'description', 'type', 'image_url','video_url'];

}
