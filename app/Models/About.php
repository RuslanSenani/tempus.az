<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
    use HasTranslations;
    use LogsActivity;

    protected $fillable = ['title', 'description', 'image_alt_text', 'image'];
    public array $translatable = ['title', 'description', 'image_alt_text'];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
