<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_employee')->withPivot('from_date', 'to_date')->orderByPivot('from_date', 'desc');
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'employee_position')->withPivot('from_date', 'to_date')->orderByPivot('from_date', 'desc');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'employee_group')->withPivot('created_at', 'finished_at')->orderByPivot('created_at', 'desc');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'employee_role')->withPivot('from_date', 'to_date')->orderByPivot('from_date', 'desc');
    }

    public function managers()
    {
        return $this->belongsToMany(Department::class, 'department_manager')->withPivot('from_date', 'to_date')->orderByPivot('from_date', 'desc');
    }

    public function brigades()
    {
        return $this->belongsToMany(Department::class, 'brigade_department')->withPivot('from_date', 'to_date')->orderByPivot('from_date', 'desc');
    }

    public  function petitions()
    {
        return $this->hasMany('App\Models\Petition');
    }
}
