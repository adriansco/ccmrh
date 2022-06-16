<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function petitions()
    {
        return $this->belongsToMany(Petition::class, 'exam_petition');
    }

    public function results()
    {
        return $this->belongsToMany(Result::class, 'exam_result');/* ->withPivot('feedback', 'date')->orderByPivot('date', 'desc'); */
    }
}
