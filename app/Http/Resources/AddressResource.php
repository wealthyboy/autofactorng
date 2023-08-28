<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'first_name'   => $this->first_name,
            'last_name'    => $this->last_name,
            'address'      => $this->address,
            'address_2'      => $this->address_2,
            'email'      => $this->email,
            'phone_number'      => $this->phone_number,
            'city'         => $this->city,
            'state'        => optional($this->address_state)->name,
            'country'      => optional($this->address_country)->name ,
            'state_id'        => $this->state_id,
            'country_id'      => $this->country_id,
            'is_active'    => $this->is_active  
        ];
    }


    
}
