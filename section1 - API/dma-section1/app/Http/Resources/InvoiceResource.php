<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Invoice extends JsonResource
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
            'invoice_no' => $this->invoice_no,
            'date' => $this->date,
            'customer_name' => $this->customer_name,
            'salesperson_name' => $this->salesperson_name,
            'payment_type' => $this->payment_type
        ];
    }
}
