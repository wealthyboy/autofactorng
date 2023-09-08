<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\CustomerWarehouse;
use App\Models\User;
use Carbon\Carbon;

class CustomerExport extends Exporter
{
  public function headings(): array
  {
    return [
      'Customer ID',
      'Customer Since',
      'First Name',
      'Last Name',
      'Phone',
      'Email',
      'Lead',
    ];
  }

  public function collection()
  {
    ini_set('memory_limit', -1);
    // $items = data_get($this->filter, 'items', []);
    $query = User::query();
    // if (!data_get($this->filter, 'all_items')) {
    //   $query->whereIn('customer_id', $items);
    // }

    $users = $query->get();

    return $users->map(function (User $user) {

      return [
        $user->id,
        Carbon::parse($user->created_at)->format('m-d-Y'),
        $user->name,
        $user->last_name,
        $user->phone_number,
        $user->email,
      ];
    });
  }
}
