<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'airline_id' => $this->airline_id,
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'two_way' => $this->two_way,
            'price' => $this->price,
            'pasangers' => $this->pasangers,
            $this->mergeWhen($this->two_way, [
                'two_way_departure_time' => $this->two_way_departure_time,
                'two_way_arrival_time' => $this->two_way_arrival_time,
            ]),
        ];
    }
}
