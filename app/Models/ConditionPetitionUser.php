<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionPetitionUser extends Model
{
    use HasFactory;
    protected $table = 'condition_petition_user';
    public $timestamps = false;
    protected $guarded = [];
}
