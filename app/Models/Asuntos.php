<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contactos;


class Asuntos extends Model
{
    use HasFactory;
    protected $fillable = ['asun_nombre','asun_estado'];

    public function contactos(){
        return $this->hasMany(contactos::class,'con_id_asunto');
    }
}
