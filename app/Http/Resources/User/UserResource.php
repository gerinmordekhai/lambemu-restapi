<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public $status;
    public $message;
    public $token;

    public function __construct($status, $message, $resource, $token = null) {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
        
        if ($token != null) {
            $this->token = $token;
        }
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
            'data' => [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'first_name' => $this->first_name,
                'profile_picture' => $this->profile_picture,
                'username' => $this->username,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
            ],
            'token' => $this->token,
        ];
    }
}
