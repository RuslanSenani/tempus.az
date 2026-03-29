<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
//use Spatie\Activitylog\LogOptions;
//use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class Partner extends Model implements Sortable
{
    use HasTranslations;
//    use LogsActivity;
    use SortableTrait;
//    public function getActivitylogOptions(): LogOptions
//    {
//        return LogOptions::defaults()
//            ->logAll()
//            ->logOnlyDirty()
//            ->logExcept(['sort_order'])
//            ->dontSubmitEmptyLogs();
//    }

    public function buildSortQuery(): Builder
    {
        return static::query();
    }

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
//        'sort_on_has_many' => true,

    ];
    protected $fillable = ['name', 'logo', 'website','sort_order'];
    public array $translatable = ['name'];
}
