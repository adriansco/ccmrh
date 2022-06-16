<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentMaganer extends Model
{
    use HasFactory;
    protected $table = 'department_manager';
    public $timestamps = false;
    protected $guarded = [];
}
