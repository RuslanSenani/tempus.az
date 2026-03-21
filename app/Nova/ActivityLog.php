<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\Activitylog\Models\Activity;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Badge;
use Illuminate\Database\Eloquent\Builder;

class ActivityLog extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ActivityLog>
     */
    public static $model = Activity::class;

    public static $group = 'Sistem';
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'description';


    /**
     * The columns that should be searched.
     *
     * @var array
     */

    public static $search = ['id', 'description', 'subject_type', 'event', 'properties', 'causer_id', 'created_at'];
    public static $globallySearchable = true;

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Hərəkət', 'description')->sortable(),

            Text::make('İcraçı (User)', function () {
                if (!$this->causer) return '<span class="text-gray-400">Sistem/Qonaq</span>';

                return $this->causer->name . " <span class='text-gray-400'>(ID: {$this->causer->id})</span>";
            })->asHtml(),

            Text::make('Resurs', 'subject_type'),

            Badge::make('Növ', 'event')->map([
                'created' => 'success',
                'updated' => 'info',
                'deleted' => 'danger',
                null => 'warning',
                '' => 'warning',
            ])->labels([
                'created' => 'Yaradıldı',
                'updated' => 'Yeniləndi',
                'deleted' => 'Silindi',
                null => 'İdentifikasiya',
                '' => 'İdentifikasiya',
            ])->displayUsing(function ($value) {

                if (is_null($value)) {
                    if (str_contains(strtolower($this->description), 'login')) return 'Giriş Edildi';
                    if (str_contains(strtolower($this->description), 'logout')) return 'Çıxış Edildi';
                    return 'İdentifikasiya';
                }
                return $value;
            }),
            DateTime::make('Tarix', 'created_at')
                ->displayUsing(fn ($v) => $v ? $v->format('d.m.Y H:i') : '-')
                ->sortable(),


            Text::make('Dəyişiklik Tarixçəsi', function () {
                $props = $this->properties;
                $event = $this->event; // created, updated, deleted

                // Əgər heç bir detal yoxdursa
                if (!isset($props['attributes']) && !isset($props['old'])) {
                    return '<div style="padding: 20px; text-align: center; color: #9ca3af; background: #f9fafb; border-radius: 12px; border: 1px dashed #e5e7eb; font-style: italic;">
                    Əlavə detal qeydə alınmayıb.
                </div>';
                }

                // Dinamik başlıqları təyin edirik
                $oldHeader = 'Köhnə Dəyər';
                $newHeader = 'Yeni Dəyər';

                if ($event === 'deleted') {
                    $oldHeader = 'Silinən Məlumat';
                    $newHeader = 'Status';
                } elseif ($event === 'created') {
                    $oldHeader = 'Status';
                    $newHeader = 'Yaradılan Məlumat';
                }

                // Hansı massiv doludursa, ondan sahə adlarını götürürük
                $dataKeys = isset($props['attributes']) ? array_keys($props['attributes']) : array_keys($props['old']);

                $html = '<div style="border: 1px solid #eef0f3; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">';
                $html .= '<table style="width: 100%; text-align: left; border-collapse: collapse; font-family: sans-serif; font-size: 0.9rem;">';
                $html .= '<thead style="background-color: #f8fafc; border-bottom: 1px solid #eef0f3;">
                <tr>
                    <th style="padding: 14px 16px; font-weight: 600; color: #64748b; text-transform: uppercase; font-size: 0.75rem;">Sahə</th>
                    <th style="padding: 14px 16px; font-weight: 600; color: #ef4444; text-transform: uppercase; font-size: 0.75rem;">' . $oldHeader . '</th>
                    <th style="padding: 14px 16px; font-weight: 600; color: #10b981; text-transform: uppercase; font-size: 0.75rem;">' . $newHeader . '</th>
                </tr>
              </thead>';
                $html .= '<tbody>';

                foreach ($dataKeys as $key) {
                    $oldValue = $props['old'][$key] ?? null;
                    $newValue = $props['attributes'][$key] ?? null;

                    // Məlumat silinibsə Yeni sütununa "Silindi" yazırıq
                    if ($event === 'deleted') {
                        $newDisplay = '<span style="color: #ef4444; font-weight: bold;">[SİLİNDİ]</span>';
                        $oldDisplay = is_array($oldValue) ? json_encode($oldValue, JSON_UNESCAPED_UNICODE) : $oldValue;
                    } // Məlumat yeni yaradılıbsa Köhnə sütununa "Yeni" yazırıq
                    elseif ($event === 'created') {
                        $oldDisplay = '<span style="color: #10b981; font-weight: bold;">[YENİ]</span>';
                        $newDisplay = is_array($newValue) ? json_encode($newValue, JSON_UNESCAPED_UNICODE) : $newValue;
                    } // Yenilənmə halı (Standart)
                    else {
                        $oldDisplay = is_array($oldValue) ? json_encode($oldValue, JSON_UNESCAPED_UNICODE) : ($oldValue ?? '-');
                        $newDisplay = is_array($newValue) ? json_encode($newValue, JSON_UNESCAPED_UNICODE) : ($newValue ?? '-');
                    }

                    $html .= "<tr style='border-bottom: 1px solid #f1f5f9;'>
            <td style='padding: 14px 16px; font-weight: 700; color: #1e293b; background-color: #fcfdfe; width: 25%;'>" . ucfirst(str_replace('_', ' ', $key)) . "</td>
            <td style='padding: 14px 16px; width: 37.5%; color: #b91c1c;'>" . $oldDisplay . "</td>
            <td style='padding: 14px 16px; width: 37.5%; color: #15803d;'>" . $newDisplay . "</td>
          </tr>";
                }

                $html .= '</tbody></table></div>';

                return $html;
            })->asHtml()->onlyOnDetail(),


        ];
    }

    protected static function applySearch($query, $search)
    {
        $search = strtolower($search);


        return $query->where(function ($q) use ($search) {
            // 1. Standart sütunlar
            $q->where('activity_log.id', 'like', "%{$search}%")
                ->orWhere('activity_log.description', 'like', "%{$search}%")
                ->orWhere('activity_log.subject_type', 'like', "%{$search}%")
                ->orWhere('activity_log.properties', 'like', "%{$search}%");

            // 2. "Yeniləndi", "Yaradıldı" kimi statusların axtarışı (Event tərcüməsi)
            $q->orWhere(function ($sub) use ($search) {
                if (str_contains($search, 'yeni')) $sub->orWhere('event', 'updated');
                if (str_contains($search, 'yara')) $sub->orWhere('event', 'created');
                if (str_contains($search, 'sil')) $sub->orWhere('event', 'deleted');

                // Əgər heç biri deyilsə, ingiliscə sütun daxilində axtar
                if (str_contains($search, 'iden') || str_contains($search, 'giriş') || str_contains($search, 'çıxış')) {
                    $sub->orWhereNull('event')->orWhere('event', '');
                }
                $sub->where('activity_log.created_at', 'like', "%{$search}%")

                    // --- RƏQƏMLƏRİN BİTİŞİK VƏ QARIŞIQ VERSİYALARI ---
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%d%m%Y')"), 'like', "%{$search}%")   // 22032026
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%Y%m%d')"), 'like', "%{$search}%")   // 20260322
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%H%i%s')"), 'like', "%{$search}%")   // 012214

                    // --- AY ADLARI (Azərbaycan dili üçün xüsusi məntiq) ---
                    // Əgər istifadəçi ayın adını azərbaycanca yazsa, onu rəqəmə çevirib axtarırıq
                    ->orWhere(function($query) use ($search) {
                        $months = [
                            'yanvar' => '01', 'fevral' => '02', 'mart' => '03', 'aprel' => '04',
                            'may' => '05', 'iyun' => '06', 'iyul' => '07', 'avqust' => '08',
                            'sentyabr' => '09', 'oktyabr' => '10', 'noyabr' => '11', 'dekabr' => '12',
                            'yan' => '01', 'fev' => '02', 'mar' => '03', 'apr' => '04', 'iyn' => '06',
                            'iyl' => '07', 'avq' => '08', 'sen' => '09', 'okt' => '10', 'noy' => '11', 'dek' => '12'
                        ];
                        foreach ($months as $name => $num) {
                            if (str_contains(strtolower($search), $name)) {
                                $query->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%m')"), $num);
                            }
                        }
                    })

                    // --- BÜTÜN AYIRICILARLA (Tire, Nöqtə, Slash, Boşluq, Vergül) ---
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%d-%m-%Y %H:%i')"), 'like', "%{$search}%")
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%d.%m.%Y %H:%i')"), 'like', "%{$search}%")
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%d/%m/%Y %H:%i')"), 'like', "%{$search}%")
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%d %m %Y %H %i')"), 'like', "%{$search}%")
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%Y, %m, %d')"), 'like', "%{$search}%")

                    // --- AM/PM VƏ SAAT VARIANTLARI ---
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%h:%i %p')"), 'like', "%{$search}%") // 01:22 AM
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%r')"), 'like', "%{$search}%")       // 01:22:14 AM
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%H.%i.%s')"), 'like', "%{$search}%") // 01.22.14

                    // --- İNSANIN AĞLINA GƏLƏCƏK QƏRİBƏ KOMBİNASİYALAR ---
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%M %Y %d')"), 'like', "%{$search}%") // March 2026 22
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%d %M %Y, %W')"), 'like', "%{$search}%") // 22 March 2026, Sunday
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%W %H:%i')"), 'like', "%{$search}%") // Sunday 01:22
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%b %d')"), 'like', "%{$search}%")    // Mar 22
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%y/%m/%d')"), 'like', "%{$search}%") // 26/03/22

                    // --- SƏRHƏDSİZ FORMAT (Hər şeyi bir-birinə qatanlar üçün) ---
                    ->orWhere(DB::raw("CONCAT(DAY(activity_log.created_at), MONTH(activity_log.created_at), YEAR(activity_log.created_at))"), 'like', "%{$search}%")
                    ->orWhere(DB::raw("DATE_FORMAT(activity_log.created_at, '%D %M %Y %H:%i:%s %p %W')"), 'like', "%{$search}%");
            });

            if (str_contains($search, 'sist') || str_contains($search, 'qonaq')) {
                $q->orWhereNull('causer_id');
            }

            // 4. İcraçı (User) adına görə axtarış
            $q->orWhereExists(function ($subQuery) use ($search) {
                $subQuery->select(\Illuminate\Support\Facades\DB::raw(1))
                    ->from('users')
                    ->whereRaw('users.id = activity_log.causer_id')
                    ->where('users.name', 'like', "%{$search}%");
            });

            // 5. Tarix
            $q->orWhere('activity_log.created_at', 'like', "%{$search}%");
        });
    }


    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
