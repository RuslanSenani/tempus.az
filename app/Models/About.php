<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
    use HasTranslations;

    protected $fillable = ['title', 'description', 'image_alt_text', 'image'];
    public array $translatable = ['title', 'description', 'image_alt_text'];

}
