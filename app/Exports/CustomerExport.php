<?php
namespace App\Exports;

use App\Models\Customer;
use App\Models\CustomerWarehouse;
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
      'Address 1',
      'Address 2',
      'City',
      'State',
      'Zip',
      'Phone',
      'Email',
      'DOB',
      'Gender',
      'Notes',
      'Total Transactions',
      'Total Sales',
      'Lead',
      'IP Address',
      'Google ID',
      'Time Zone',
    ];
  }

  public function collection()
  {
    ini_set('memory_limit', -1);
    $items = data_get($this->filter, 'items', []);
    $query = CustomerWarehouse::query();
    if (!data_get($this->filter, 'all_items')) {
      $query->whereIn('customer_id', $items);
    }

    $customers = $query->get();

    return $customers->map(function (CustomerWarehouse $customer) {

      return [
        $customer->id,
        Carbon::parse($customer->customer_since)->format('m-d-Y'),
        $customer->first_name,
        $customer->last_name,
        $customer->address,
        $customer->address2,
        $customer->city,
        $customer->state,
        $customer->state,
        $customer->mobile_number,
        $customer->email,
        $customer->dob ? Carbon::parse($customer->dob)->format('m-d-Y') : '',
        $customer->gender,
        $customer->customer_notes,
        $customer->total_transactions,
        $customer->total_sales,
        $customer->lead,
        $customer->ip_address,
        $customer->google_seo_client_id,
        $customer->time_zone,
      ];

    });
  }
}

