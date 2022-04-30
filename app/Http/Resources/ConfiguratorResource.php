<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfiguratorResource extends JsonResource
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
            'id' => $this->id,
            'server' => $this->server,
            'ram' => $this->ram,
            'hdd' => $this->hdd,
            'location' => $this->location,
            'price' => $this->price,
        ];
    }
}
