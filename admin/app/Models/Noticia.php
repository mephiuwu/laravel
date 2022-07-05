<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Galeria_noticia;

class Noticia extends Model
{
    use HasFactory;
    protected $fillable = ['not_titulo','not_resumen','not_contenido','not_portada','not_estado','not_url'];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];
     
     

    public function getRouteKeyName()
    {
        return 'not_url';
    }

    public function imagenes(){
        return $this->hasMany(galeria_noticia::class,'gnot_noticias_id');
    }
}
