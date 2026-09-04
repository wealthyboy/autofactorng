<?php

namespace App\Filters\ProductsFilter;

use App\Filters\AbstractFilter;
use App\Models\ProductFilterOption;
use Illuminate\Database\Eloquent\Builder;

class DynamicFiltersFilter extends AbstractFilter
{
    public function filter(Builder $builder, $value)
    {
        if (! is_array($value)) {
            return $builder;
        }

        // Do not trust the nested request keys as the source of truth for the
        // filter group. Flatten the submitted values, validate them against
        // the database, then group them by their real product filter group.
        // This also makes the filter resilient to different query-string
        // serializers while keeping OR-within-a-group / AND-across-groups.
        $submittedOptionIds = collect($value)
            ->flatMap(function ($optionIds) {
                return (array) $optionIds;
            })
            ->map(function ($optionId) {
                return (int) $optionId;
            })
            ->filter()
            ->unique()
            ->values();

        if ($submittedOptionIds->isEmpty()) {
            return $builder;
        }

        $optionsByGroup = ProductFilterOption::query()
            ->select(['id', 'product_filter_group_id'])
            ->whereIn('id', $submittedOptionIds)
            ->where('is_active', true)
            ->whereHas('group', function ($query) {
                $query->where('is_active', true);
            })
            ->get()
            ->groupBy('product_filter_group_id');

        foreach ($optionsByGroup as $options) {
            $optionIds = $options->pluck('id')->map(function ($id) {
                return (int) $id;
            })->all();

            if (empty($optionIds)) {
                continue;
            }

            // Match the pivot directly. This is the authoritative assignment
            // made from Product Create/Edit and avoids relationship-query
            // ambiguity when the main product query already contains other
            // whereHas clauses (category, vehicle fitment, brand, etc.).
            $builder->whereExists(function ($query) use ($optionIds) {
                $query->selectRaw('1')
                    ->from('product_filter_option_product as pfop')
                    ->whereColumn('pfop.product_id', 'products.id')
                    ->whereIn('pfop.product_filter_option_id', $optionIds);
            });
        }

        return $builder;
    }
}
