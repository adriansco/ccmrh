<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'department_employee');
    }
    public function managers()
    {
        return $this->belongsToMany(Employee::class, 'department_manager');/* ->where('department_id', 1); */
    }
    public function brigades()
    {
        return $this->belongsToMany(Employee::class, 'brigade_department');/* ->where('department_id', 1); */
    }
}
