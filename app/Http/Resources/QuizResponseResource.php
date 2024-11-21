<?php

namespace App\Http\Resources;

use App\Models\QuizResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin QuizResponse */
class QuizResponseResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'response' => $this->response,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'quiz_id' => $this->quiz_id,

            'quiz' => new QuizResource($this->whenLoaded('quiz')),
        ];
    }
}
