<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function petitions()
    {
        return $this->belongsToMany(Petition::class, 'condition_petition_user');/* ->withPivot('user_id', 'status', 'feedback', 'date')->orderByPivot('date', 'desc'); */
    }
}
