<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Statistics extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "number" => $this->number,
            "count" => $this->count,
            "updated_at" => $this->updated_at
        ];
    }
}
