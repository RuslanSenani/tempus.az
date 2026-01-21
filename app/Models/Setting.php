<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;


    protected $fillable = ['company_name', 'address', 'about_us', 'mission', 'vision', 'logo', 'phone_1', 'phone_2', 'fax_1', 'fax_2', 'instagram', 'tik_tok', 'youtube', 'facebook', 'email'];

    public array $translatable = ['company_name', 'address', 'about_us', 'mission', 'vision'];


    protected $appends = ['logo_url'];

    public function getLogoUrlAttribute(): ?string
    {
        if (!$this->logo) {
            return null;
        }

        return Storage::disk('public')->url('Logo/' . $this->logo);
    }
}
