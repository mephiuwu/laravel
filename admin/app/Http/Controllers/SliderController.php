<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();

        return view('admin.sliders.index', compact('sliders'));
    }

    public function table(Request $request)
    {
        $inicio = $request->inicio.' 00:00:00';
        $fin = $request->fin.' 23:59:59';
        $data = Slider::whereBetween('created_at',[$inicio,$fin])->orderBy('created_at', 'DESC')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '
                <div class="flex justify-center">
                <a data-tooltip="Editar" href="' . route('slider.edit', $data->id) . '" class="inline-block  tooltip group cursor-pointer relative  border-b border-gray-400  text-center py-1 px-2   text-white transition bg-blue-700 rounded-full text-center shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none waves-effect">
                <i class="fas fa-pencil-alt text-white text-center" ></i>
                </a>
                <a data-tooltip="Eliminar" href="#" id="btn-delete" onclick="eliminarModal(' . $data->id . ')" class="inline-block tooltip group cursor-pointer relative  border-b border-gray-400 ml-3 py-1 px-2 text-center text-white transition bg-red-700 rounded-full shadow ripple hover:shadow-lg hover:bg-red-800 focus:outline-none waves-effect">
                <i class="fas fa-trash-alt text-white"></i> 
                 </a>
                </div>
               ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {

        $sliders_activos = Slider::where('sli_estado', 1)->get();
        return view('admin.sliders.create', compact('sliders_activos'));
    }

    public function store(Request $request)
    {


        try {
            $validacion = Validator::make($request->all(), [
                'sli_nombre' => ['required', 'string', 'max:250'],
                'sli_orden' => ['required'],
                'sli_estado' => ['required'],
                'path_recorte_image' => ['required'],
            ], [], [
                'sli_nombre' => 'Nombre',
                'sli_orden' => 'Orden',
                'sli_estado' => 'Estado',
                'path_recorte_image' => 'Imagen'
            ]);

            if ($validacion->fails()) {
                return redirect()->route('sliders.create')->withInput()->withErrors($validacion);
            }



            //guardar imagen de slider       
            /* $name_image =  Str::random('30') . '-' . $request->file('input-image')->getClientOriginalName();
            $path = $request->file('input-image')->move(public_path("img/sliders/"), $name_image);
            $path_url = URL::asset("public/img/sliders/" . $name_image); */

            $slider = Slider::create([
                'sli_nombre' => $request->sli_nombre,
                'sli_orden' => $request->sli_orden,
                'sli_estado' => $request->sli_estado,
                'sli_path' => $request->path_recorte_image
            ]);
            Log::info(json_encode([
                'status' => 'success',
                'request' => [
                    'nombre' => $request->sli_nombre,
                    'orden' => $request->sli_orden,
                    'estado' => $request->sli_estado,
                ],
                'action' => 'Crear Slider'
           ]));
         
            if ($slider) {
                Log::info("Slider con ID: " . $slider->id . " - " . $slider->sli_nombre . " creado exitosamente");

                return redirect()->route('sliders.index')->with('slider_success', 'Slider creado exitosamente!');
            } else {
                return back()->with('slider_error', 'Ha ocurrido un error, verifique los datos y vuelva a intentarlo');
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => [
                    'nombre' => $request->sli_nombre,
                    'orden' => $request->sli_orden,
                    'estado' => $request->sli_estado,
                ],
                'action' => 'Crear Slider'
           ]));
            return redirect()->route('sliders.create')->withInput()->withErrors(['errors' => 'Ha ocurrido un error interno']);
        }
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        $sliders_activos = Slider::where('sli_estado', 1)->get();
        return view('admin.sliders.edit', compact('slider', 'sliders_activos'));
    }

    public function update(Request $request, $id)
    {


        try {
            $validacion = Validator::make($request->all(), [
                'sli_nombre' => ['required', 'string', 'max:250'],
                'sli_orden' => ['required'],
                'sli_estado' => ['required'],

            ], [], [
                'sli_nombre' => 'Nombre',
                'sli_orden' => 'Orden',
                'sli_estado' => 'Estado',
                'path_recorte_image' => 'Imagen'
            ]);

            if ($validacion->fails()) {
                return redirect()->back()->withInput()->withErrors($validacion);
            }

            $slider = Slider::findOrFail($id);

            $slider->update([
                'sli_nombre' => $request->sli_nombre,
                'sli_orden' => $request->sli_orden,
                'sli_estado' => $request->sli_estado,
            ]);
            if ($request->path_recorte_image) {
                $slider->update([
                    'sli_path' => $request->path_recorte_image,
                ]);
            }

            if ($slider) {
                Log::info(json_encode([
                    'status' => 'success',
                    'request' => [
                        'nombre' => $request->sli_nombre,
                        'orden' => $request->sli_orden,
                        'estado' => $request->sli_estado,
                    ],
                    'action' => 'Actualizar Slider'
               ]));
             
                Log::info("Slider con ID: " . $slider->id . " - " . $slider->sli_nombre . " actualizado exitosamente");
                return redirect()->route('sliders.index')->with('slider_success', 'Slider actualizado exitosamente!');
            } else {
                return back()->with('slider_error', 'Ha ocurrido un error, verifique los datos y vuelva a intentarlo');
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => [
                    'nombre' => $request->sli_nombre,
                    'orden' => $request->sli_orden,
                    'estado' => $request->sli_estado,
                ],
                'action' => 'Actualizar Slider'
           ]));
            return redirect()->back()->withInput()->withErrors(['errors' => 'Ha ocurrido un error interno']);
        }
    }

    public function delete(Request $request)
    {
        try {
            $slider = Slider::findOrFail($request->id);

            $slider->delete();
            Log::info(json_encode([
                'status' => 'success',
                'request' => $request->all(),
                'action' => 'Eliminar Slider'
           ]));
            Log::info("Slider con ID: " . $slider->id . " - " . $slider->sli_nombre . " eliminado exitosamente");

            return response()->json([
                'status' => 200,
                'message' => 'Slider eliminado exitosamente'
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => $request->id,
                'action' => 'Eliminar Slider'
           ]));
            return response()->json([
                'status' => 500,
                'message' => 'Ha ocurrido un error interno'
            ]);
        }
    }

    public function crop_image(Request $request)
    {

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
            $path_local = public_path() . "/img/sliders/" . $image_name;
            $path_app = Storage::disk('local')->path($path_local);


            file_put_contents($path_local, $data);
            $path_url = URL::asset("public/img/sliders/" . $image_name);
            
            return response()->json(['message' => 'Imagen actualizada exitosamente', 'img' => $path_url]);
        }
    }
}
