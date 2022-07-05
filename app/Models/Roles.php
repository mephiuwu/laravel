<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Roles extends Model
{
    use HasFactory;
    protected $fillable = ['rol_name'];

    public function usuarios(){
        return $this->hasMany(User::class,'rol_id');
    }
}
