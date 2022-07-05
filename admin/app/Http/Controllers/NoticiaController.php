<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Galeria_noticia;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;

class NoticiaController extends Controller
{
    public function index()
    {
        return view('admin.noticias.index');
    }

    public function table(Request $request)
    {
        $inicio = $request->inicio.' 00:00:00';
        $fin = $request->fin.' 23:59:59';
        
        $data = Noticia::whereBetween('created_at',[$inicio,$fin])->orderBy('created_at', 'DESC')->get();

    
       
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '
            <div class="flex justify-center w-full">
                <a data-tooltip="Editar" href="' . route('noticia.editView', $data->id) . '" id="btn-edit"  class="inline-block py-1 px-2 text-center   text-white transition bg-blue-700 rounded-full shadow relative tooltip ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none waves-effect">
                <i class="fas fa-pencil-alt text-white text-center" ></i>
                </a>
                <button data-tooltip="Eliminar" id="btn-delete" onclick="datosEliminar(' . $data->id . ')" class="inline-block ml-3 py-1 px-2 text-center   text-white transition bg-red-700 rounded-full shadow ripple relative tooltip hover:shadow-lg hover:bg-red-800 focus:outline-none waves-effect">
                <i class="fas fa-trash-alt text-white text-center" ></i>
                </button>
                <a data-tooltip="Galería" href="' . route('noticia.galery', $data->id) . '" id="btn-galery"  class="inline-block py-1 px-2  ml-3 text-center   text-white transition bg-green-700 rounded-full shadow relative tooltip ripple hover:shadow-lg hover:bg-green-800 focus:outline-none waves-effect">
                <i class="fas fa-image text-white text-center" ></i>
                </a>
            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.noticias.create');
    }

    public function store(Request $request)
    {
        
        try {
        
            $validacion =  Validator::make($request->all(), [
                'titulo' => 'required|max:500',
                'fecha' => 'required|date',
                'resumen' => 'required|max:500|min:20',
                'contenido' => 'required',
                'estado' => ['required', Rule::in(["1", "0"])]
            ]);

            
            if ($validacion->fails()) {
                return redirect()->route('noticia.create')->withInput()->withErrors($validacion);
            }
    
            $urlAmigable = Str::slug($request->titulo, '-');
           // $tituloGigante = mb_strtoupper($request->titulo);
            $url = $urlAmigable . '-' . $request->fecha;
            
            $noticia = Noticia::create([
                'not_titulo' => $request->titulo,
                'created_at' => $request->fecha,
                'not_resumen' => $request->resumen,
                'not_contenido' => $request->contenido,
                 'not_portada' => 1,
                'not_estado' => $request->estado,
                'not_url' => $url, 
            ]);
            Log::info(json_encode([
                'status' => 'success',
                'request' => $request->all(),
                'action' => 'Crear Noticia'
           ]));
            Log::info("Noticia con ID: ".$noticia->id." - ".$noticia->not_titulo." creada exitosamente");
            return redirect()->route('noticia.index')->with('news_created', 'Noticia creada exitosamente!');
        } catch (\Throwable $th) {
            
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => $request->all(),
                'action' => 'Crear Noticia'
           ]));
            return redirect()->route('noticia.create')->withInput()->withErrors(array('message' => 'Ha ocurrido un error interno'));
        }
        
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/images/' . $fileName);
            $msg = 'Image successfully uploaded';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function dataDelete(Request $request)
    {
        $data = Noticia::findOrFail($request->id);
        return $data;
    }

    public function delete(Request $request)
    {
       try {
            $data = Noticia::findOrFail($request->id);
            $id = $data->id;
            $titulo = $data->not_titulo;
            $data->delete();
            Log::info(json_encode([
                'status' => 'success',
                'request' => $request->all(),
                'action' => 'Eliminar Noticia'
           ]));
            Log::info("Noticia con ID: ".$id." - ".$titulo." eliminada exitosamente");
            return response()->json(['status' => 200, 'message' => 'Noticia borrada correctamente.']);
       } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => $request->all(),
                'action' => 'Eliminar Noticia'
           ]));
            return response()->json([
                'status' => 500,
                'message' => 'Ha ocurrido un error interno'
            ]);
       } 
    }

    public function editView(Request $request, $id)
    {
        $noticia = Noticia::findOrFail($id);

        return view('admin.noticias.edit', compact('noticia'));
    }

    public function update(Request $request, $id)
    {
        
        try {
            $validacion =  Validator::make($request->all(), [
                'titulo' => 'required|max:300',
                'fecha' => 'required|date',
                'resumen' => 'required|max:500|min:20',
                'contenido' => 'required',
                'estado' => ['required', Rule::in(["1", "0"])]
            ]);
            


            if ($validacion->fails()) {
                return redirect()->route('noticia.editView',$id)->withInput()->withErrors($validacion);
            }
            
            $noticia = Noticia::findOrFail($id);

            $urlAmigable = Str::slug($request->titulo, '-');
          //  $tituloGigante = mb_strtoupper($request->titulo);
            $url = $urlAmigable . '-' . $request->fecha;

           $noticia->update([
                'not_titulo' => $request->titulo,
                'create_at' => $request->fecha,
                'not_resumen' => $request->resumen,
                'not_contenido' => $request->contenido,
                'not_estado' => $request->estado,
                'not_url' => $url
            ]);
            Log::info(json_encode([
                'status' => 'success',
                'request' => $request->all(),
                'action' => 'Actualizar Noticia'
           ]));
            Log::info("Noticia con ID: ".$noticia->id." - ".$noticia->not_titulo." actualizada exitosamente");
            return redirect()->route('noticia.index')->with('noticiaUpdate', '¡Noticia actualizada exitosamente!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => $request->all(),
                'action' => 'Actualizar Noticia'
           ]));
            return redirect()->route('noticia.editView',$id)->withInput()->withErrors(['errors' => 'Ha ocurrido un error interno']);

        }

      
    }

    public function galery($id){
        $noticia = Noticia::findOrFail($id);
        return view('admin.noticias.galery',compact('noticia'));
    }

    public function fileStore(Request $request){
        $idNoticia = $request->idNew;

        $ultimoRegistro = Galeria_noticia::where('gnot_noticias_id',$idNoticia)->orderByDesc('gnot_orden')->first();

        
        if($ultimoRegistro == null){
            $orden = 1;
        }else{
            $orden = $ultimoRegistro->gnot_orden;
            $orden++;
        }

        /* $request->validate([
            'file' => 'required|image'
        ]); */
        $name_image =  Str::random('30') . '-' . $request->file('file')->getClientOriginalName();
        $imagenes = $request->file('file')->move(public_path("img/noticias/"), $name_image);
        $path_url = URL::asset("public/img/noticias/" . $name_image);

        $ultGalery = Galeria_noticia::create([
            "gnot_path" => $path_url,
            "gnot_orden" => $orden,
            "gnot_noticias_id" => $idNoticia,
        ]);

        return response()->json([
            'path' => $path_url,
            'id' => $ultGalery->id
        ]);
    }

    public function eliminarFoto(Request $request){
        try {
            Galeria_noticia::findOrFail($request->id)->delete();
            $galeria_total = Galeria_noticia::where('gnot_noticias_id',$request->id_noticia)->count();
            Log::info(json_encode([
                'status' => 'success',
                'request' => $request->all(),
                'action' => 'Eliminar Imagen de galeria de noticia'
           ]));
            Log::info("La imagen se borró correctamente.");
            return response()->json([
                'status' => 200,
                'message' => "Imagen eliminada exitosamente",
                'total_imagenes' => $galeria_total
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => $request->all(),
                'action' => 'Eliminar Imagen de galeria de noticia'
           ]));
        }
    }
}
