<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asuntos;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class AsuntosController extends Controller
{
    public function index()
    {
        $asuntos = Asuntos::all();
        return view('admin.asuntos.index', compact('asuntos'));
    }

    public function table(Request $request)
    {
        $inicio = $request->inicio.' 00:00:00';
        $fin = $request->fin.' 23:59:59';
        $data = Asuntos::whereBetween('created_at',[$inicio,$fin])->orderBy('created_at', 'DESC')->get();
        return DataTables::of($data)->make(true);
    }

    public function create(Request $request)
    {
        try {
            $validacion = Validator::make($request->all(), [
                'nombre' => ['required', 'string', 'max:100'],
                
            ]);
            if ($validacion->fails()) {
                return redirect()->route('asuntos.index')->withInput()->withErrors($validacion->errors());
            }
            //pasa la validacion
            $asunto = Asuntos::create([
                'asun_nombre' => $request->nombre,  
                'asun_estado' => 1
            ]);
            Log::info(json_encode([
                'status' => 'success',
                'request' => $request->all(),
                'action' => 'Crear asunto'
           ]));
            Log::info("Asunto con ID: ".$asunto->id." - ".$asunto->asun_nombre." creado exitosamente");

            return redirect()->route('asuntos.index')->with('asunto_created', 'Asunto creado exitosamente!');
          
        } catch (\Throwable $th) {
            //throw $th;
           
            Log::error(json_encode([
                'status' => 'error',
                'request' => $request->all(),
                'action' => 'Crear asunto',
                
           ]));
            return redirect()->route('asuntos.index')->withErrors(array('message' => 'Ha ocurrido un error interno'));
            /*  echo $th->getMessage(); */
        }
    }

    public function eliminar(Request $request)
    {

        try {
            $id = $request->id_asunto;
            $asunto = Asuntos::findOrFail($id);
    
            if ($asunto->contactos->count() > 0) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Error: Hay registros de contactos con este asunto!'
                ]);
            } else {
                $asunto->delete();
                Log::info(json_encode([
                    'status' => 'success',
                    'request' => $request->all(),
                    'action' => 'Eliminar Asunto'
               ]));
                Log::info("Asunto con ID: ".$asunto->id." - ".$asunto->asun_nombre." eliminado exitosamente");
                return response()->json([
                    'status' => 200,
                    'message' => 'Asunto eliminado exitosamente!'
                ]);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => $request->all(),
                'action' => 'Eliminar Asunto'
           ]));
            return response()->json([
                'status' => 500,
                'message' => 'Ha ocurrido un error interno'
            ]);
        }
        
      
    }

    public function datosEditar(Request $request)
    {
        $asunto = Asuntos::findOrFail($request->id_asunto);
        return $asunto;
    }

    public function editar(Request $request)
    {
        try {
            $asunto = Asuntos::findOrFail($request->id);

            $validacion = Validator::make($request->all(), [
                'nombre' => ['required', 'string','max:100'],
                'estado' => ['required', Rule::in([1, 0])],
            ]);
            if ($validacion->fails()) {
              /*   return redirect()->route('asuntos.index')->withInput()->withErrors($validacion->errors()); */
                return response()->json(['status' => 500, 'message' => $validacion->errors()->first()]);
            }
            $asunto->update([
                "asun_nombre" => $request->nombre,
                "asun_estado" => $request->estado,
            ]);
            Log::info(json_encode([
                'status' => 'success',
                'request' => $request->all(),
                'action' => 'Actualizar asunto'
           ]));
            Log::info("Asunto con ID: ".$asunto->id." - ".$asunto->asun_nombre." actualizado exitosamente");
            return response()->json(['status' => 200, 'message' => 'Asunto editado correctamente.']);
        } catch (\Throwable $th) {
                Log::error($th->getMessage());
                Log::error(json_encode([
                    'status' => 'error',
                    'request' => $request->all(),
                    'action' => 'Actualizar asunto'
               ]));
                return response()->json([
                    'status' => 500,
                    'message' => 'Ha ocurrido un error interno'
                ]);
        }
       
    }
}
