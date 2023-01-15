<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{   
    public $status;
    public $message;

    public function __construct($status, $message, $resource) {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'result' => [
                'data' => [
                    'id' => $this->id,
                    'first_name' => $this->first_name,
                    'first_name' => $this->first_name,
                    'profile_picture' => $this->profile_picture,
                    'username' => $this->username,
                    'email' => $this->email,
                    'phone_number' => $this->phone_number,
                ],
            ],
        ];
    }
}
