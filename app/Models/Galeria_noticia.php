<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Noticia;

class Galeria_noticia extends Model
{
    use HasFactory;
    protected $fillable = ['gnot_nombre','gnot_path','gnot_orden','gnot_noticias_id'];

    public function noticia(){
       return $this->belongsTo(noticia::class, 'gnot_noticias_id');
    }
}