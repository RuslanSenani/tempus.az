<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Statistic extends Model
{
    use HasTranslations;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
    protected $fillable = ['title', 'preparation_count', 'customer_count', 'partner_count', 'preparation', 'customer', 'partner'];

    public array $translatable = ['title', 'preparation', 'customer', 'partner'];

    protected static function booted()
    {
        static::saving(function ($statistic) {

            if ($statistic->is_active) {
                static::where('id', '!=', $statistic->id)
                    ->where('is_active', true)
                    ->update(['is_active' => false]);
            }
        });
    }
}
