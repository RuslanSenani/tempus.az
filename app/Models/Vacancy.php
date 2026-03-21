<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Vacancy extends Model
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
    protected $fillable = [
        'title', 'salary', 'company', 'city',
        'age', 'education', 'experience', 'phone', 'email', 'description', 'is_active'
    ];

    public array $translatable = ['title', 'description', 'age', 'city', 'company', 'experience', 'education'];


}
