<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPetition extends Model
{
    use HasFactory;
    protected $table = 'exam_petition';
    public $timestamps = false;
    protected $guarded = [];
}
