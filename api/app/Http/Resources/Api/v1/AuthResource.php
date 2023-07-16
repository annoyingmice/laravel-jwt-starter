<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Libs\JsonWebToken;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'          => $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name,
            'first_name'    => $this->first_name,
            'middle_name'   => $this->middle_name,
            'last_name'     => $this->last_name,
            'username'      => $this->username,
            'email'         => $this->email,
            'tel'           => $this->contact_no,
            'address'       => $this->address,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->udated_at,
            'token'         => JsonWebToken::token($this->getAttributes()),
        ];
    }
}
