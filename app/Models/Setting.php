<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
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

    protected $fillable = ['company_name', 'address', 'about_us', 'mission', 'vision', 'logo', 'phone_1', 'phone_2', 'fax_1', 'fax_2', 'instagram', 'tik_tok', 'youtube', 'facebook', 'email', 'activities', 'values', 'history', 'advantages', 'results_achievements', 'team', 'activity_zone', 'logo1', 'logo2','mission_vision_logo','activities_logo','active_zone_logo'];

    public array $translatable = ['company_name', 'address', 'about_us', 'mission', 'vision', 'activities', 'values', 'history', 'advantages', 'results_achievements', 'team', 'activity_zone'];


    protected $appends = ['logo_url'];

    public function getLogoUrlAttribute(): ?string
    {
        if (!$this->logo) {
            return null;
        }

        return Storage::disk('public')->url('Logo/' . $this->logo);
    }
}
