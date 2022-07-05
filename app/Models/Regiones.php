<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comunas;

class Regiones extends Model
{
    use HasFactory;
    protected $fillable = ['reg_nombre','reg_sigla'];

    //retornas todas las comunas de la respectiva región, hasMany (tiene muchas). <<X>> Región tiene(has) muchas(many) Comunas.
    public function comunas(){
        return $this->hasMany(comunas::class,'comu_region_id');
    }
}
