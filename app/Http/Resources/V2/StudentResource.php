<?php

namespace App\Http\Resources\V2;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'surname' => $this->surname,
            'gender' => $this->gender,
            'group' => Group::find($this->group_id)->name,
            'status' => $this->status,
            'birthday' => $this->birthday,
        ];
    }       
}
