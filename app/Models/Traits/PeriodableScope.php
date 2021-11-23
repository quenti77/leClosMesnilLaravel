<?php

namespace App\Models\Traits;

use DatePeriod;

trait PeriodableScope
{
    public function scopeIncludePeriod($query, DatePeriod $period)
    {
        return $query
            ->where(function ($query) use ($period) {
                return $query
                    ->where('started_at', '<', $period->start)
                    ->where('finished_at', '>', $period->start);
            })
            ->orWhere(function ($query) use ($period) {
                return $query
                    ->where('started_at', '<', $period->end)
                    ->where('finished_at', '>', $period->end);
            })
            ->orWhere(function ($query) use ($period) {
                return $query
                    ->where('started_at', '>=', $period->start)
                    ->where('finished_at', '<=', $period->end);
            });
    }
}
