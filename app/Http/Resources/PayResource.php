<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "payment_amount" => $this->payment_amount,
            "image_url" => $this->routeImage,
            "description" => $this->description,
            "type_string" => $this->typeString,
            "type" => $this->type,
            // "history_pays" => [
            //     "count" => $this->history_pay()->count(),
            //     "pays_route" => null
            // ],
            // "history_pays_url" => ,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
