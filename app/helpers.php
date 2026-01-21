<?php

use Illuminate\Support\Facades\DB;

function translate(string $key): string
{
    $locale = app()->getLocale();

    $row = DB::table('site_contents')->where('key', $key)->first();

    if (!$row) {
        return $key;
    }

    $values = json_decode($row->value, true);

    return $values[$locale] ?? $values['en'] ?? $key;
}
