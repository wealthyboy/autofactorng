<?php

namespace App\Filters\ProductsFilter;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class DynamicFiltersFilter extends AbstractFilter
{
    public function filter(Builder $builder, $value)
    {
        if (! is_array($value)) {
            return $builder;
        }

        foreach ($value as $groupId => $optionIds) {
            $groupId = (int) $groupId;
            $optionIds = collect((array) $optionIds)
                ->map(function ($optionId) {
                    return (int) $optionId;
                })
                ->filter()
                ->unique()
                ->values()
                ->all();

            if (! $groupId || empty($optionIds)) {
                continue;
            }

            // Values selected inside one group are OR-ed together. Each
            // additional group adds another whereHas, which gives us AND
            // behaviour across groups (e.g. Viscosity AND Specification).
            $builder->whereHas('filterOptions', function (Builder $query) use ($groupId, $optionIds) {
                $query->where('product_filter_options.product_filter_group_id', $groupId)
                    ->whereIn('product_filter_options.id', $optionIds);
            });
        }

        return $builder;
    }
}
