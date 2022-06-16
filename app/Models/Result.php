<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_result')->withPivot('feedback', 'date')->orderByPivot('date', 'desc');
    }
}
