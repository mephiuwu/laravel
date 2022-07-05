<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactoRequest;
use App\Mail\FormContact;
use App\Models\Asuntos;
use App\Models\Contactos;
use App\Models\Empresa;
use App\Models\Regiones;
use Carbon\Carbon;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str as SupportStr;

class ContactoController extends Controller
{
    public function index(){
        $regiones = Regiones::all();
        $asuntos = Asuntos::all()->where('asun_estado','=',1);
        return view('pages.contacto.index',compact('regiones','asuntos'));
    }

    public function enviar_email(ContactoRequest $request){
         
         $date = Carbon::now()->format('d-m-Y');
       
        //guardar contacto
         $contacto = Contactos::create([
            'con_nombre' => $request->nombre,
            'con_id_asunto' => $request->asunto,
            'con_email' => $request->email,
            'con_telefono' => $request->telefono,
            'con_mensaje' => $request->mensaje,
            'con_id_comuna' => $request->comuna,
            'con_direccion' => $request->direccion,
         ]);
       
         $nombre_concat = str_replace(' ','_',$contacto->con_nombre);
       
         //actualizar path_documento con id de contacto

            if($request->file('documento')){
                //almacenar documento
    /*              $name_document =  SupportStr::random('30'). '-' . $request->file('documento')->getClientOriginalName();
    */          $name_document = $contacto->id.'_'.$nombre_concat.'_'.$date.'.'.$request->file('documento')->getClientOriginalExtension();
               
                $path = $request->file('documento')->move(public_path("documentos/"), $name_document);
                $path_url = URL::asset("public/documentos/".$name_document);
            }else{
                $path_url = null;
            }

            $contacto->update([
                'con_path_documento' => $path_url
            ]);

      

         //enviar correo 
         $correo_empresa = Empresa::first()->emp_email_contacto;
          $empresa = Empresa::first();
         $subject = Asuntos::findOrFail($contacto->con_id_asunto)->asun_nombre;
         $for = $correo_empresa;
         $from = $request->email;

       /* Mail::send('layouts.email',[$request->all(),$empresa->emp_logo], function($msj) use($subject,$for,$from){
             $msj->from('noreply@aeurus.cl');
             $msj->subject($subject);   
             $msj->to($for);
         });
 */      
         $contact_data = [
            'mensaje' => $contacto->con_mensaje,
            'asunto' => $contacto->con_asunto,
            'logo' => $empresa->emp_logo
         ];
        
         Mail::to($for)->send(new FormContact($contacto,$empresa));
         

         return redirect()->route('contacto.index')->with('contact_success','Mensaje enviado exitosamente, trataremos de contactarte a la brevedad.');

    }

    public function getComunas(Request $request){
         $region = Regiones::findOrFail($request->id_region);
         
         $comunas = $region->comunas;
         
         return response()->json([
            'status' => 200,
            'comunas' => $comunas
         ]);

         
    }
}
