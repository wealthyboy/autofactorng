<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait ColumnFillable
{
    public function getFillable()
    {
        return Schema::getColumnListing($this->getTable());
    }
}