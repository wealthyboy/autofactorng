<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class Exporter implements FromCollection, WithHeadings
{
    protected $filter;

    public function __construct()
    {
        // $this->filter = $filter;
    }

    public function collection()
    {
        // TODO: Implement collection() method.
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
    }
}
