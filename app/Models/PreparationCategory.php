<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class PreparationCategory extends Model
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
    protected $fillable = ['name', 'slug', 'sort_order'];

    public array $translatable = ['name', 'slug'];

    public function preparations(): HasMany
    {
        return $this->hasMany(Preparation::class, 'category_id');
    }
}
