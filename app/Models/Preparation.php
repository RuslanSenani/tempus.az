<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Preparation extends Model
{
    use  HasTranslations;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
    protected $fillable = ['category_id', 'title', 'name', 'description', 'image', 'slug', 'pdf'];

    public array $translatable = ['name', 'title', 'description', 'image_alt_text', 'slug', 'pdf'];

    protected $casts = [
        'name' => 'json',
        'title' => 'json',
        'pdf' => 'json'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(PreparationCategory::class, 'category_id');
    }
}
