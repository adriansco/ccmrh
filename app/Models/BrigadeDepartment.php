<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrigadeDepartment extends Model
{
    use HasFactory;
    protected $table = 'brigade_department';
    public $timestamps = false;
    protected $guarded = [];
}
