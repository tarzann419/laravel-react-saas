<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResource extends JsonResource
{

    public static $wrap = false;

    // By default, when you return a resource or a collection of resources, 
    // Laravel wraps the data in a data key. 
    // For example, if you have a UserResource, the JSON response might look like this:

    // {
    // "data": {
    //     "id": 1,
    //     "name": "John Doe",
    //     "email": "john@example.com"
    // }
    // }


    // without wrap: 
    // {
    //     "id": 1,
    //     "name": "John Doe",
    //     "email": "john@example.com"
    // }


    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'route_name' => $this->route_name,
            'image' => $this->image ?: null,
            'name' => $this->name,
            'description' => $this->description,
            'active' => $this->active,
            'required_credits' => $this->required_credits,
        ];
    }
}
