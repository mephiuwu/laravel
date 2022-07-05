<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Models\Empresa;
use App\Models\User;
use App\Traits\ExcelTrait;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmpresaController extends Controller
{
   use ExcelTrait;


  public function index()
  {

    $empresa = Empresa::first();

    $header = [
      'id',
      'Razón Social',
      'Email Empresarial',
      'Email de Contacto',
      'Dirección',
      'Teléfono',
      'Logo',
      'Facebook',
      'Twitter',
      'Instagram',
      'Youtube',
      'Latitud',
      'Longitud',
      'Meta title',
      'Meta keywords',
      'Meta Description',
      'Google analytics',
      'Fecha de creacion',
      'Fecha de actualización'
    ];
    
   
   
   /*  $empresa = DB::table('empresa')->get();

     /* dd(array_keys($empresa->first()->toArray()));  */

    /* return $this->generar_excel($empresa,'empresa.xlsx',$header);   */



    $corte_ancho = 1440;
    $corte_alto = 280;
    $corte_ancho_resp = 800;
    $corte_alto_resp = 500;
    return view('admin.empresas.index', compact(
      'empresa',
      'corte_ancho',
      'corte_alto',
      'corte_ancho_resp',
      'corte_alto_resp'
    ));
  }


  public function update(EmpresaRequest $request, $id)
  {
    $empresa = Empresa::findOrFail($id);

    $empresa->update([
      'emp_razon_social' => $request->razon_social,
      'emp_email_empresarial' => $request->email_empresarial,
      'emp_email_contacto' => $request->email_contacto,
      'emp_direccion' => $request->direccion,
      'emp_telefono' => $request->telefono,
      /*  'emp_logo' => $path_url, //$path */
      'emp_url_facebook' => $request->facebook_url,
      'emp_url_twitter' => $request->twitter_url,
      'emp_url_instagram' => $request->instagram_url,
      'emp_url_youtube' => $request->youtube_url,
      'emp_coords_lat' => $request->coords_map_lat,
      'emp_coords_lng' => $request->coords_map_lng,
      'emp_meta_title' => $request->meta_title,
      'emp_meta_keywords' => $request->meta_keywords,
      'emp_meta_description' => $request->meta_description,
      'emp_analytics' => $request->analytics
    ]);

    Log::info(json_encode([
      'status' => 'success',
      'request' => $request->all(),
      'action' => 'Actualizar datos de empresa'
    ]));

    return redirect()->route('empresa.index')->with('empresa_update', 'Empresa actualizada exitosamente!');
  }

  public function imageCropPost(Request $request)
  {

    try {
      $data = $request->image;

      $validator = Validator::make($request->all(), [
        'image' => 'required',
      ]);

      if ($validator->fails()) {

        return response()->json(['error' => $validator->errors()->all()]);
      } else {
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);
        $image_name = time() . '.png';
        $path_local = public_path() . "/img/logos/" . $image_name;
        $path_app = Storage::disk('local')->path($path_local);


        file_put_contents($path_local, $data);
        $path_url = URL::asset("public/img/logos/" . $image_name);
        //guardar en path en bd
        $empresa = Empresa::findOrFail($request->id);

        if ($empresa) {
          $empresa->update([
            'emp_logo' => $path_url,
          ]);
           
          Log::info(json_encode([
            'status' => 'success',
            'request' => $request->all(),
            'action' => 'Actualizar logo de empresa'
          ]));
          Log::info("Logo de Empresa " . $empresa->emp_razon_social . " actualizada exitosamente");
          return response()->json(['message' => 'Imagen actualizada exitosamente', 'img' => $path_url]);
        }
      }
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      Log::error(json_encode([
        'status' => 'error',
        'request' => $request->all(),
        'action' => 'Actualizar logo de empresa'
   ]));
      return response()->json(['message' => 'Ha ocurrido un error interno', 'status' => 500]);
    }
  }
}
