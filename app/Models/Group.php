<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = "code";
    public $incrementing = false;
    protected $guarded = [];
    protected function setPrimaryKey($key)
    {
        $this->primaryKey = $key;
    }
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_group');
    }
}
