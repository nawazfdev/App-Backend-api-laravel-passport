<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    

    use HasFactory;
    protected $fillable = [
        'name',
        'user_id'
    ];
    protected $primaryKey='user_id';
    public function groups()
    {
        return $this->hasMany(Group::class);
    }
     
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    
 

}

 
?>