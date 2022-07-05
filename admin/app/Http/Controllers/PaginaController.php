<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class PaginaController extends Controller
{
    public function index()
    {
        return view('admin.paginas.index');
    }

    public function table(Request $request)
    {
        $inicio = $request->inicio.' 00:00:00';
        $fin = $request->fin.' 23:59:59';
        $data = Pagina::whereBetween('created_at',[$inicio,$fin])->orderBy('created_at', 'DESC')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '
            <div class="flex justify-center w-full">
                <a data-tooltip="Editar" href="' . route('paginas.edit', $data->id) . '" id="btn-edit"  class="inline-block py-1 px-2 text-center   text-white transition bg-blue-700 rounded-full shadow relative tooltip ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none waves-effect">
                <i class="fas fa-pencil-alt text-white text-center" ></i>
                </a>
                <button data-tooltip="Eliminar" id="btn-delete" onclick="modalEliminar(' . $data->id . ')" class="inline-block ml-3 py-1 px-2 text-center   text-white transition bg-red-700 rounded-full shadow ripple relative tooltip hover:shadow-lg hover:bg-red-800 focus:outline-none waves-effect">
                <i class="fas fa-trash-alt text-white text-center" ></i>
                </button>
            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {

        return view('admin.paginas.create');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('img/paginas'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/img/paginas/' . $fileName);
            $msg = 'Image successfully uploaded';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');

            echo $response;
        }
    }

    public function store(Request $request)
    {
        try {
            $validacion =  Validator::make($request->all(), [
                'titulo' => 'required|max:500',
                'contenido' => 'required',
                'estado' => ['required', Rule::in([1, 0])],
                'orden' => ['required', 'min: 0', 'Integer']
            ]);
            if ($validacion->fails()) {
                return redirect()->route('paginas.create')->withInput()->withErrors($validacion);
            }
            $pagina = Pagina::create([
                'pag_nombre' => $request->titulo,
                'pag_contenido' => $request->contenido,
                'pag_estado' => 1,
                'pag_orden' => $request->orden,
                'pag_slug' => Str::slug($request->titulo)
            ]);
            Log::info("Noticia con ID: " . $pagina->id . " - " . $pagina->pag_nombre . " creada exitosamente");
            Artisan::call('cache:clear');
            Log::info(json_encode([
                'status' => 'success',
                'request' => $request->all(),
                'action' => 'Crear Slider'
           ]));
            return redirect()->route('paginas.index')->with('pagina_created', 'Pagina creada exitosamente!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => $request->all(),
                'action' => 'Crear Slider'
           ]));
            return redirect()->route('paginas.create')->withInput()->withErrors(array('message' => 'Ha ocurrido un error interno'));
        }
    }


    public function edit($id)
    {

        $pagina = Pagina::findOrFail($id);

        return view('admin.paginas.edit', compact('pagina'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validacion =  Validator::make($request->all(), [
                'titulo' => 'required|max:500',
                'contenido' => 'required',
                'estado' => ['required', Rule::in([1, 0])],
                'orden' => ['required', 'min:0', 'Integer']
            ]);

            if ($validacion->fails()) {
                return redirect()->back()->withInput()->withErrors($validacion);
            }

            $pagina = Pagina::findOrFail($id);

            $pagina->update([
                'pag_nombre' => $request->titulo,
                'pag_contenido' => $request->contenido,
                'pag_estado' => $request->estado,
                'pag_orden' => $request->orden,
                'pag_slug' =>  Str::slug($request->titulo)
            ]);
            Artisan::call('cache:clear');
            Log::info(json_encode([
                'status' => 'error',
                'request' => $request->all(),
                'action' => 'Eliminar Slider'
           ]));
            Log::info("Noticia con ID: " . $pagina->id . " - " . $pagina->pag_nombre . " actualizada exitosamente");

            return redirect()->route('paginas.index')->with('pagina_updated', 'Pagina actualizada exitosamente!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => $request->all(),
                'action' => 'Actualizar Pagina'
           ]));
            return redirect()->back()->withInput()->withErrors(array('message' => 'Ha ocurrido un error interno'));
        }
    }


    public function delete(Request $request)
    {
        try {
            $data = Pagina::findOrFail($request->id);

            if ($request->id == 1) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Esta pagina no se puede eliminar!'
                ]);
            }

            $data->delete();
            Log::info("Pagina con ID: " . $data->id . " eliminada exitosamente");
            Artisan::call('cache:clear');
            Log::info(json_encode([
                'status' => 'success',
                'request' => $request->all(),
                'action' => 'Eliminar Pagina'
           ]));
            return response()->json(['status' => 200, 'message' => 'Pagina eliminada correctamente.']);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => $request->all(),
                'action' => 'Eliminar Pagina'
           ]));
            return response()->json([
                'status' => 500,
                'message' => 'Ha ocurrido un error interno'
            ]);
        }
    }
}
