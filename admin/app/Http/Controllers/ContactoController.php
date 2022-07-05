<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contactos;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\ContactosExport;
use App\Models\Asuntos;
use App\Models\User;
use App\Traits\ApiTrait;
use App\Traits\ExcelTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\LaravelExcelWorksheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;

class ContactoController extends Controller
{
    use ExcelTrait,ApiTrait; 

    public function index()
    {
        return view('admin.contactos.index');
    }

    public function table(Request $request)
    {
        $inicio = $request->inicio.' 00:00:00';
        $fin = $request->fin.' 23:59:59';
        $data = Contactos::whereBetween('created_at',[$inicio,$fin])->orderBy('created_at', 'DESC')->get();
        
        return DataTables::of($data)
            ->addColumn('asunto', function ($data) {
                $asunto = $data->asunto;
                if ($asunto) {
                    return $asunto->asun_nombre;
                } else {
                    return "-";
                }
            })
            ->addColumn('fecha', function ($data) {
                $fecha = $data->created_at->format('d-m-Y H:i:s');
                return $fecha;
            })
            ->addColumn('action', function ($data) {
                /*       return '
            <div class="grid grid-cols-2 text-center">
                <div class="w-full"> 
                    <a  id="btn-edit"  class="text-sm font-normal bg-transparent text-blueGray-700">
                    <i class="fas fa-pencil-alt text-blue-600"></i> Ver detalle</a>
                </div>
            </div>'; */
                return '
            <div class="flex justify-center w-full">
            <a href="' . route('contactos.detalle', $data->id) . '" data-tooltip="Ver detalle" class="inline-block tooltip relative py-1 px-2 text-center text-white transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none waves-effect">
                <i class="fas fa-eye text-white text-center" ></i>
            </a>
            </div>
           ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

  


    public function exportExcel(Request $request){
        

       $where = array();
        if ($request->dateInicio != '' ) {
            $fecha_inicio = $request->dateInicio . ' 00:00:00';
            $where[] = ['created_at', '>=', $fecha_inicio];
        }

        if ($request->dateFin != '') {
            $fecha_termino = $request->dateFin . ' 23:59:59';
            $where[] = ['created_at', '<=', $fecha_termino];
        }


        if(isset($fecha_inicio) && isset($fecha_termino) && ($fecha_inicio > $fecha_termino)){
            return redirect()->route('contactos.index')->with('date_error', 'Rango de fechas invalidas');
        }
        
   
      /*    $contactos = Contactos::select('id','con_nombre','con_email','con_telefono',
        'con_mensaje','con_path_documento','con_direccion','con_id_asunto','con_id_comuna', DB::raw("DATE_FORMAT(created_at,'%d-%b-%Y %H:%i:%s') as fecha"))
      
         ->with(['asunto','comuna'])
        ->where($where)
        ->orderBy('fecha','DESC')
        ->get(); 
        */
       
       
        $contactos = DB::table('contactos')
        ->join('asuntos','asuntos.id', '=', 'contactos.con_id_asunto')
        ->join('comunas','comunas.id','=','contactos.con_id_comuna')
        ->select('contactos.id','contactos.con_nombre','contactos.con_email',
        'contactos.con_telefono','contactos.con_mensaje',
        'contactos.con_path_documento','contactos.con_direccion','asuntos.asun_nombre',
        'comunas.comu_nombre', DB::raw("DATE_FORMAT(contactos.created_at,'%d-%b-%Y %H:%i:%s') as fecha"))
        ->orderBy('fecha','DESC')
        ->get();
 
        
         
        
    

        if ($contactos->count() == 0) {
            return redirect()->route('contactos.index')->with('date_error', 'No hay resultados para tu busqueda');
        }

        $carbon = Carbon::now();
        $parse = Carbon::parse($carbon)->format('Y-m-d H:i:s');
        $now = str_replace(' ','_',$parse);

        $fileName = 'contactos_'.$now.'.xlsx';

        $header = [
           'ID',
           'Nombre',
           'Email',
           'Teléfono',
           'Mensaje',
           'Documento',
           'Dirección',
           'Asunto',
           'Comuna',
           'Fecha',
        ];
        
        

        //$data = $this->ApiService('GET','http://127.0.0.1:8000/export/excel',$contactos,'contactos');

        //dd($data);
        
        #Exportar excel
        /* $writer = new WriterXlsx($contactos);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output'); */
       /*  return $results; */
        /*   
        $header = [
            'ID',
            'Nombre',
            'Asunto',
            'Email',
            'Teléfono',
            'Mensaje',
            'Documento',
            'Dirección',
            'Comuna',
            'Fecha',
            'Update_at'
         ]; */

         
         return $this->generar_excel($contactos,$fileName,$header);  

           //PHP SPREADSHEET
         
   
        
     
    }

    //aquí mostraremos la ventana del gráfico
    public function grafico()
    {

        return view('admin.contactos.grafico');
    }

    public function datosGrafico()
    {


        $asuntos = Asuntos::all();
        $aux_asuntos = [];

        foreach ($asuntos as $asunto) {
            array_push($aux_asuntos, $asunto->contactos->count());
        }
        $total = 0;
        foreach ($aux_asuntos as $aux) {
            $total = $total + $aux;
        }



        $data = [
            'asuntos' => $asuntos,
            'count_asuntos' => $aux_asuntos,
            'total' => $total
        ];


        return $data;
    }

    public function detalle(Request $request, $id)
    {


        $contacto = Contactos::findorFail($id);

    
        /*         $file = Storage::url($contacto->con_path_documento);
 */
        return view('admin.contactos.detalle', compact('contacto'));
    }
    public function PDF()
    {
        $pdf = PDF::loadView('admin.contactos.graficoDOM');
        return $pdf->download('grafico-contactos.pdf');
    }

    public function filtroGrafico(Request $request)
    {

       
        $fecha_inicio = $request->fechaInicio . ' 00:00:00';
        $fecha_termino = $request->fechaFin . ' 23:59:59';
        $asuntos = Asuntos::all();
        $aux_asuntos = [];
        $num_contactos = [];
        $nombres_asuntos = [];

        foreach ($asuntos as $asunto) {
            $filter_asuntos = $asunto->contactos->whereBetween('created_at', [$fecha_inicio, $fecha_termino])->count();
            if ($filter_asuntos > 0) {
                array_push($aux_asuntos, $filter_asuntos);
                array_push($nombres_asuntos, $asunto);
            }
        }
        $total = 0;
        foreach ($aux_asuntos as $aux) {
            $total = $total + $aux;
        }


        $data = [
            'asuntos' => $nombres_asuntos,
            'count_asuntos' => $aux_asuntos,
            'total' => $total
        ];
       
        return $data;
    }
}
