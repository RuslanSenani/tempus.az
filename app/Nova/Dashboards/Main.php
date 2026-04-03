<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;
use Tightenco\NovaGoogleAnalytics\MostVisitedPagesCard;
use Tightenco\NovaGoogleAnalytics\PageViewsMetric;
use Tightenco\NovaGoogleAnalytics\ReferrersList;
use Tightenco\NovaGoogleAnalytics\SessionsMetric;
use Tightenco\NovaGoogleAnalytics\VisitorsMetric;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new VisitorsMetric,      // Ziyarətçi sayı qrafiki
            new PageViewsMetric,     // Səhifə baxış sayı
            new SessionsMetric,      // Sessiyaların sayı
            new MostVisitedPagesCard, // Ən çox baxılan səhifələr siyahısı
            new ReferrersList(),    // Sayta haradan gəliblər? (Google, Facebook və s.)
        ];
    }

}
