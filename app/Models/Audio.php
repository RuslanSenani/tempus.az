<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mostafaznv\NovaCkEditor\AudioStorage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


class Audio extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected $fillable = [
        'name', 'file', 'disk', 'mime', 'size'
    ];

    protected static function booted(): void
    {
        parent::booted();

        self::saving(function ($model) {
            if (!$model->name) {
                if ($file = request()->file('file')) {
                    $name = $file->getClientOriginalName();
                } else {
                    $name = $model->file;
                }

                $model->name = pathinfo($name, PATHINFO_FILENAME);
            }
        });
    }

    public function getUrlAttribute(): string
    {
        return AudioStorage::make($this->attributes['disk'])->url($this->attributes['file']);
    }

    public function getSizeAttribute(): string
    {
        return AudioStorage::bytesForHumans($this->attributes['size']);
    }
}
