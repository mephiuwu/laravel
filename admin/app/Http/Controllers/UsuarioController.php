<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('admin.usuarios.index');
    }

    public function table(Request $request)
    {
        $inicio = $request->inicio.' 00:00:00';
        $fin = $request->fin.' 23:59:59';
        $data = User::whereBetween('created_at',[$inicio,$fin])->orderBy('created_at', 'DESC')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '
                <div class="flex justify-center">
                <a data-tooltip="Editar" href="' . route('usuarios.edit', $data->id) . '" class="inline-block  tooltip group cursor-pointer relative  border-b border-gray-400 py-1 px-2   text-white transition bg-blue-700 rounded-full text-center shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none waves-effect">
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

    public function dataDelete(Request $request)
    {
        $data = User::findOrFail($request->id);
        return $data;
    }


    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        try {

            $rules = [
                'name' => 'required|string|max:255',
                'rut' => ["required", "string", "max:13"],
                'telefono' => 'required|max:13|min:9',
                'email' => ["required", "email"],
                'rol' => 'required',
                'estado' => 'required|' . Rule::in([1, 0]),
                'password' =>  ['required', 'confirmed', 'alpha_num', RulesPassword::min(8)],
                'password_confirmation' => ["required"],
            ];

            $validacion = Validator::make($request->all(), $rules, [], [
                'name' => 'nombre',
                'telefono' => 'teléfono',
                'password' => 'contraseña',
                'password_confirmation' => 'confirmación de contraseña'
            ]);

            //validar email y rut unicos encriptados
            $rut_unique = User::whereEncrypted('rut', $request->rut)->count();
            $email_unique = User::whereEncrypted('email', $request->email)->count();


            //despues de validaciones iniciales agregar mas validaciones
            $validacion->after(function ($validacion) use ($rut_unique, $email_unique) {
                if ($rut_unique > 0) {
                    $validacion->errors()->add(
                        'rut',
                        'El rut Ingresado ya se encuentra registrado'
                    );
                }
                if ($email_unique > 0) {
                    $validacion->errors()->add(
                        'email',
                        'El Email Ingresado ya se encuentra registrado'
                    );
                }
            });



            if ($validacion->fails()) {
                return redirect()->route('usuarios.create')->withInput()->withErrors($validacion);
            }

            $user = User::create([
                'name' => $request->name,
                'rut' => $request->rut,
                'email' =>  $request->email,
                'password' => Hash::make($request->password),
                'estado' => $request->estado,
                'telefono' => $request->telefono,
                'rol_id' => $request->rol
            ]);
            
            Log::info(json_encode([
                'status' => 'success',
                'request' => [
                    'name' => $request->name,
                    'rut' => $request->rut,
                    'email' =>  $request->email,
                    'estado' => $request->estado,
                    'telefono' => $request->telefono,
                    'rol_id' => $request->rol
                ],
                'action' => 'Registrar usuario'
            ]));
            Log::info("Usuario con ID: " . $user->id . " - " . $user->name . " registrado exitosamente");
            return redirect()->route('usuarios.index')->with('user_created', 'Usuario creado exitosamente!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => [
                    'name' => $request->name,
                    'rut' => $request->rut,
                    'email' =>  $request->email,
                    'estado' => $request->estado,
                    'telefono' => $request->telefono,
                    'rol_id' => $request->rol
                ],
                'action' => 'Registrar usuario'
            ]));
            return redirect()->route('usuarios.index')->withErrors(['intern' => 'Ha ocurrido un error interno'])/* ->with(['status' => 'error']) */;
        }
    }

    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);



        return view('admin.usuarios.edit', compact('user'));
    }



    public function update(Request $request, $id)
    {
        try {

            //validaciones 
            $rules = [
                'name' => 'required|string|max:255',
                'rut' => ["required", "string", "max:13"],
                'telefono' => 'required|max:13|min:9',
                'email' => ["required", "email"],
                'rol' => 'required',
                'estado' => 'required|' . Rule::in([1, 0]),

            ];


            $validacion = Validator::make($request->all(), $rules, [], [
                'name' => 'nombre',
                'telefono' => 'teléfono',
                'password' => 'contraseña',
                'password_confirmation' => 'confirmación de contraseña'
            ]);

            $user = User::findOrFail($id);

            //verificar que rut y email no esten registrados 
            $rut_unique = User::whereEncrypted('rut', $request->rut)->count();
            $email_unique = User::whereEncrypted('email', $request->email)->count();

            //despues de validaciones iniciales agregar mas validaciones
            $validacion->after(function ($validacion) use ($rut_unique, $email_unique, $request, $user) {
                if ($request->rut != $user->rut) {
                    if ($rut_unique > 0) {
                        $validacion->errors()->add(
                            'rut',
                            'El rut Ingresado ya se encuentra registrado'
                        );
                    }
                }
                if ($request->email != $user->email) {
                    if ($email_unique > 0) {
                        $validacion->errors()->add(
                            'email',
                            'El Email Ingresado ya se encuentra registrado'
                        );
                    }
                }
            });

            if ($validacion->fails()) {
                return redirect()->back()->withInput()->withErrors($validacion);
            }


            $user->update([
                'name' => $request->name,
                'rut' => $request->rut,
                'email' =>  $request->email,
                'estado' =>  $request->estado,
                'telefono' => $request->telefono,
                'rol_id' =>  $request->rol
            ]);
            Log::info(json_encode([
                'status' => 'success',
                'request' => [
                    'name' => $request->name,
                    'rut' => $request->rut,
                    'email' =>  $request->email,
                    'estado' => $request->estado,
                    'telefono' => $request->telefono,
                    'rol_id' => $request->rol
                ],
                'action' => 'Actualizar usuario'
            ]));
            Log::info("Usuario con ID: " . $user->id . " - " . $user->name . " actualizado exitosamente");

            return redirect()->route('usuarios.index')->with('user_updated', 'Usuario actualizado exitosamente!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => [
                    'name' => $request->name,
                    'rut' => $request->rut,
                    'email' =>  $request->email,
                    'estado' => $request->estado,
                    'telefono' => $request->telefono,
                    'rol_id' => $request->rol
                ],
                'action' => 'Actualizar usuario'
            ]));
            return redirect()->route('usuarios.index')->withErrors(array('message' => 'Ha ocurrido un error interno'));
        }
    }

    public function delete(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $id = $user->id;
            $name = $user->name;
            $user->delete();
              Log::info(json_encode([
                'status' => 'success',
                'request' => $user,
                'action' => 'Eliminar usuario'
            ]));
            Log::info("Usuario con ID: " . $id . " - " . $name . " eliminado exitosamente");
            return response()->json(['status' => 200, 'message' => 'Usuario borrado correctamente.']);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'ID' => $request->id,
                'action' => 'Eliminar usuario'
            ]));
            return response()->json([
                'status' => 500,
                'message' => 'Ha ocurrido un error interno'
            ]);
        }
    }

    public function profile()
    {
        return view('admin.perfil.index');
    }

    public function update_profile(Request $request)
    {
        try {
            $validacion = Validator::make($request->all(), [
                'name' => ['required', 'string'],
                'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::user()->id)],
                'phone' => ['required', 'max:13', 'min:9'],
            ], [], [
                'name' => 'Nombre',
                'phone' => 'Teléfono'
            ]);

            if ($validacion->fails()) {
                return redirect()->route('perfil.index')->withErrors($validacion);
            }

            $user = User::findOrFail(Auth::user()->id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'telefono' => $request->phone,
            ]);
          

            Log::info(json_encode([
                'status' => 'success',
                'request' => $request->all(),
                'action' => 'Actualizar perfil'
            ]));
            Log::info("Perfil de Usuario con ID: " . $user->id . " - " . $user->name . " actualizado exitosamente");
            return redirect()->route('perfil.index')->with('profile_updated', 'Perfil actualizado exitosamente!');
        } catch (\Throwable $th) {
            
            Log::error($th->getMessage());
            Log::error(json_encode([
                 'status' => 'error',
                 'request' => $request->all(),
                 'action' => 'Actualizar perfil'
            ]));

            return redirect()->route('perfil.index')->withErrors(['error' => 'Ha ocurrido un error interno']);
        }
    }
    public function update_image(Request $request)
    {
        try {
            $validacion = Validator::make($request->all(), [
                'avatarinput' => ['required', 'mimes:jpg,jpeg,png,gif,webp']
            ]);
            if ($validacion->fails()) {
                /*   return redirect()->route('asuntos.index')->withInput()->withErrors($validacion->errors()); */
                return response()->json(['status' => 500, 'message' => $validacion->errors()->first()]);
            }
            $user = Auth::user();
            $name_image =  Str::random('30') . '-' . $request->file('avatarinput')->getClientOriginalName();
            $path = $request->file('avatarinput')->move(public_path("img/perfiles/"), $name_image);
            $path_url = URL::asset("public/img/perfiles/" . $name_image);

            $user->update([
                'profile_image' => $path_url
            ]);
            Log::info(json_encode([
                'status' => 'success',
                'request' => $request->file('avatarinput'),
                'action' => 'Actualizar imagen de perfil'
           ]));
            Log::info("Imagen de Perfil de Usuario con ID: " . $user->id . " - " . $user->name . " actualizada exitosamente");

            return response()->json([
                'status' => 200,
                'message' => "Imagen de perfil actualizada correctamente.",
                'photo' => $path_url
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => $request->all(),
                'action' => 'Actualizar imagen de perfil'
           ]));
            return response()->json([
                'status' => 500,
                'message' => "Ha ocurrido un error interno",
            ]);
        }
    }

    public function update_password(Request $request)
    {

        try {
            $user = Auth::user();
            $password_actual = $user->password;

            //validar nueva contraseña y la confirmacion de contraseña
            $validacion = Validator::make($request->all(), [
                'old_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('La contraseña es incorrecta.'));
                    }
                }],
                'password' => ['required', 'confirmed', RulesPassword::min(8)],
            ], [], [
                'password' => 'Nueva Contraseña',
                'old_password' => 'Contraseña actual'
            ]);
            if ($validacion->fails()) {
                return redirect()->route('perfil.index')->withErrors($validacion);
            }

            //update y hashear password
            Auth::user()->update([
                'password' => Hash::make($request->password),
            ]);

            Log::info(json_encode([
                'status' => 'success',
                'request' => Auth::user(),
                'action' => 'Actualizar Contraseña'
           ]));

            Log::info("Contraseña de Usuario con ID: " . $user->id . " - " . $user->name . " actualizada exitosamente");
            return redirect()->route('perfil.index')->with('password_updated', 'Contraseña actualizada exitosamente!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error(json_encode([
                'status' => 'error',
                'request' => Auth::user(),
                'action' => 'Actualizar Contraseña de usuario'
           ]));
            return redirect()->route('perfil.index')->withErrors(array('message' => 'Ha ocurrido un error interno'));
        }
    }
}
