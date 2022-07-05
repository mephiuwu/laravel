<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Regiones;
use App\Models\Contactos;

class Comunas extends Model
{
    use HasFactory;
    protected $fillable = ['comu_nombre','comu_region_id'];

    public function region(){
        return $this->belongsTo(regiones::class, 'comu_region_id');
    }

    public function contacto(){
        return $this->hasMany(contactos::class,'contac_id_comuna');
    }
}
