<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class Preparation extends Model
{
    use HasTranslations;
    use LogsActivity;
    use SortableTrait;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logExcept(['sort_order'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
    public function buildSortQuery(): Builder
    {
        return static::query();
    }

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,

    ];
    protected $fillable = ['category_id', 'title', 'name', 'description', 'image', 'slug', 'pdf','sort_order','is_active'];

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
