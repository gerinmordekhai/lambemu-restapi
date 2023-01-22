<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'data' => [
                'user_id' => $this->user_id,
                'img' => $this->img,
                'desc' => $this->desc,
                'has_comments' => $this->has_comments,
                'has_likes' => $this->has_likes,
                'has_saved' => $this->has_saved,
            ]
        ];
    }
}
