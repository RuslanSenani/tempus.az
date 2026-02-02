<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyApplication extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'vacancy_name',
        'available_days',
        'message',
        'work_experience',
        'is_read'
    ];
}
