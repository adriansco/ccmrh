<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public  function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public  function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public  function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }

    public  function department($id)
    {
        $department = Department::find($id);
        return $department->name;
    }

    public  function findUser($id)
    {
        $user = User::find($id);
        return $user->name;
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_petition')->withPivot('user_id', 'note_id', 'feedback', 'date')->orderByPivot('date', 'desc');
    }

    public function conditions()
    {
        return $this->belongsToMany(Condition::class, 'condition_petition_user')->withPivot('comment', 'date_change', 'user_id')->orderByPivot('date_change', 'desc');
    }
}
