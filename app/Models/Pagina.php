<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Galeria_paginas;

class Pagina extends Model
{
    use HasFactory;
    protected $fillable = ['pag_nombre','pag_contenido','pag_estado','pag_orden','pag_slug'];

    public function imagenes(){
        return $this->hasMany(galeria_paginas::class,'gpag_pagina_id');
    }
}