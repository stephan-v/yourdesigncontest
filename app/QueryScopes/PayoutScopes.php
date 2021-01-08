<?php

namespace App\QueryScopes;

use App\Models\Payout;
use Illuminate\Database\Eloquent\Builder;

trait PayoutScopes
{
    /**
     * Scope a query to only include pending payouts.
     *
     * @param Builder $query The query to scope.
     * @return Builder The scoped query.
     */
    public function scopePending($query): Builder
    {
        return $query->where('status', Payout::PENDING);
    }
}
