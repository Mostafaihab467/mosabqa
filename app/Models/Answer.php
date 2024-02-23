<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use softDeletes;
    protected $guarded = [];
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
