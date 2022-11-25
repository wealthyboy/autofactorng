<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $appends = [
        'state'
    ];
    //
    //brings out the info in the addreses table that belongs to the customer

    protected $table = 'addresses';

    protected $fillable = [
        'first_name', 'last_name', 'customer_id', 'address', 'address_2', 'city', 'state', 'state_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address_state()
    {
        return $this->belongsTo(Location::class, 'state_id');
    }

    public function getStateAttribute()
    {
        return $this->address_state->name;
    }
}
