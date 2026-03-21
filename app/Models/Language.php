<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Language extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    use  HasTranslations;

    protected $fillable = ['code', 'name', 'is_active', 'is_default'];

    public array $translatable = ['name'];

    protected static function booted()
    {
        static::saving(function ($language) {
            // Əgər bu dil default olaraq işarələnirsə...
            if ($language->is_default) {
                // Digər bütün dillərin is_default dəyərini false et
                static::where('id', '!=', $language->id)
                    ->where('is_default', true)
                    ->update(['is_default' => false]);
            }
        });

        // Keşi təmizləmək üçün əvvəl yazdığımız kod (əgər varsa)

        static::saved(function () {
            Cache::forget('active_languages');
        });
    }
}
