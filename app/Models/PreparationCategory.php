<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class PreparationCategory extends Model
{
    use HasTranslations;

    protected $fillable = ['name', 'slug'];

    public array $translatable = ['name', 'slug'];

    public function preparations(): HasMany
    {
        return $this->hasMany(Preparation::class, 'category_id');
    }
}
