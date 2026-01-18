<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Preparation extends Model
{
    use  HasTranslations;

    protected $fillable = ['category_id','title', 'name', 'description', 'image', 'slug'];

    public  array $translatable = ['name','title','description','image_alt_text','slug'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(PreparationCategory::class, 'category_id');
    }
}
