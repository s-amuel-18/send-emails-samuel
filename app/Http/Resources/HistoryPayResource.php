<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoryPayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this);
        return [
            "id" => $this->id,
            "payment_amount" => $this->payment_amount,
            "description" => $this->description,
            "type_string" => $this->typeString["sing"]["word"],
            "pay_route" => route("api.pay.show", ["pay" => $this->pay_id]),
            "type" => $this->type,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
