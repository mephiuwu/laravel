<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comunas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Contactos extends Model
{
    use HasFactory;
    protected $table = "contactos";
    protected $with = ['asunto', 'comuna'];
    protected $fillable = [
        'con_nombre', 'con_id_asunto', 'con_email', 'con_telefono', 'con_mensaje', 'con_direccion',
        'con_path_documento', 'con_id_comuna'
    ];

    public function comuna()
    {
        return $this->belongsTo(Comunas::class, 'con_id_comuna');
    }

    public function asunto()
    {
        return $this->belongsTo(Asuntos::class, 'con_id_asunto');
    }

    public function test()
    {
        $contactos = DB::table('contactos')
            ->join('asuntos', 'asuntos.id', 'contactos.con_id_asunto')
            ->join('comunas', 'comunas.id', 'contactos.con_id_comuna')
            /*  ->where('propuesta_documentos.id_propuesta',$propuesta->id) */
            ->select(
                'contactos.id',
                'contactos.con_nombre',
                'asuntos.asun_nombre',
                'contactos.con_email',
                'contactos.con_telefono',
                'contactos.con_mensaje',
                /*  'contactos.con_path_documento', */
                'comunas.comu_nombre',
                'contactos.con_direccion',
                'contactos.created_at'
            );
        return $contactos;
    }

   
}
