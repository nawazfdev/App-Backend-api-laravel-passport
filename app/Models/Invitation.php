<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id',
        'user_id',
        'email',
        'status',
        'token',

    ];
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
  
}
