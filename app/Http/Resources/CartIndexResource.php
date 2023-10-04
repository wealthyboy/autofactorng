<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Cart;

class CartIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'product' => $this->product,
            'image' => optional($this->product)->image_m,
            'quantity' => $this->quantity,
            'user_id' => $this->user_id,
            'remember_token' => $this->remember_token,
            'price' => Cart::ConvertCurrencyRate($this->price),
            'currency' => optional($this->product)->currency,
            'product_name' => optional($this->product)->name,
            'link' => optional($this->product)->link,
        ];
    }
}
