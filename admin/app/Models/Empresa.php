<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table = "empresa";
    protected $fillable = ['emp_razon_social','emp_email_empresarial',
    'emp_email_contacto','emp_direccion','emp_telefono','emp_logo',
    'emp_url_facebook','emp_url_twitter','emp_url_instagram',
    'emp_url_youtube' ,'emp_coords_lat', 'emp_coords_lng','emp_meta_title','emp_meta_keywords','emp_meta_description','emp_analytics'
   ];
}