<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'response',
        'quiz_id',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
