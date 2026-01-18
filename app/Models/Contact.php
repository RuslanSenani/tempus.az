<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Contact extends Model
{
    use  HasTranslations;

    protected $fillable = ['address', 'phone', 'email', 'map_link'];
    public array $translatable = ['address', 'map_link'];
}
