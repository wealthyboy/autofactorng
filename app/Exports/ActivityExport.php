<?php

namespace App\Exports;

use App\Models\Activity;
use App\Models\Customer;
use App\Models\CustomerWarehouse;
use App\Models\User;
use Carbon\Carbon;

class CustomerExport extends Exporter
{
  public function headings(): array
  {
    return [
      "Id",
      "User",
      "Activity",
      "Date Added",
    ];
  }

  public function collection()
  {
    ini_set('memory_limit', -1);
    // $items = data_get($this->filter, 'items', []);
    $query = Activity::query();
    // if (!data_get($this->filter, 'all_items')) {
    //   $query->whereIn('customer_id', $items);
    // }

    $activities = $query->get();

    return $activities->map(function (Activity $activity) {

      return [
        $activity->id,
        optional($activity->user)->name,
        $activity->action,
        $activity->created_at->format('d-m-y'),
      ];
    });
  }
}
