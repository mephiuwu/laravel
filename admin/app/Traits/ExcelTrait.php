<?php

namespace App\Traits;

use App\Exports\ExcelExport;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;
use Illuminate\Database\Eloquent\Collection;
trait ExcelTrait
{
    public function generar_excel($data, $nombre = "data.xlsx", $header = [], $path = null){

        return Excel::download(new ExcelExport($data,$header),$nombre);

    }


    public function generar_excel2($data, $nombre = "data.xlsx", $header = [], $path = null)
    {
       
        $data = $data->toArray();
        $columns = array_keys($data->first()->attributesToArray());
         
       
        //PHP SPREADSHEET
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        if (count($header) > 0) {
            //llenar header
            $letra = 'A';
            foreach ($header as $key => $h) {
                $sheet->setCellValue($letra . "1", $h);
                $letra++;
            }
        }

        //llenar body
        $array_body = array();
        $letra = 'A';
       
        //dd($data);
        if ($data instanceof Collection) {
            //dd($data,"collecion");
            foreach ($data as $dato) {
                //data del modelo con relaciones 
                $model = $dato->toArray();
                
               /*  dd($model); */
                $obj_piv = new \stdClass();


                foreach($model as $modelo){
                    if(is_array($modelo) ){
                     /* dd('es array',$modelo); */
                        $modelo = array_values($modelo);
                        $obj_piv->$letra = $modelo[1];
                        foreach ($modelo as $campo) {
                            //buscar el campo de la relacion y reemplazarlo
                            if($campo == $modelo[0]){
                               $obj_piv->$letra = $modelo[1];
                            }
                        }
                    }else{
                        $obj_piv->$letra = $modelo;
                    }
                    $letra++;
                }
                
                //se termina la fila y se vuelve a la posicion "A"
                $letra = "A";
                //se agrega la fila creada al array del body
                $array_body[] = $obj_piv;
            }
        }else{
           // dd($data,"objeto");

          //  dd("es objeto");
            $data = $data->toArray();
            /*   dd("es objeto",$data); */
            $model = $data;
            $obj_piv = new \stdClass();
            foreach ($data as $column) {
               // dd($column,$model);
                //por cada columna se llena el objecto pivote
                $obj_piv->$letra = $model[$column];
                $letra++;
            }
            $array_body[] = $obj_piv;
        }



         //dd($array_body);

        //se llenan las celdas con el array del body

        //si existe header empieza en 2 sino en 1...
        if (count($header) > 0) {
            $i = 2;
        } else {
            $i = 1;
        }
        
     //   dd($array_body,$data);
        foreach ($array_body as $body) {

            $letra = 'A';
            //dd($body);
            foreach($body as $fila){
              //  dd($fila,$body,$array_body,$data->toArray());
                $sheet->setCellValue($letra. $i,$fila);
                $letra++;
            }
            $i++;
        }

        //CELDAS con width auto
        foreach (range('A', $letra) as $letra) {
            $spreadsheet->getActiveSheet()->getColumnDimension($letra)->setAutoSize(true);
        }

        
        if (count($header) > 0) {
        //estilos para header
        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 12,

            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'FFA0A0A0',
                ],
                'endColor' => [
                    'argb' => 'FFFFFFFF',
                ],
            ],
        ];

        $sheet->getStyle('A1:' . $letra . '1')->applyFromArray($styleArray);
         }

        $writer = new WriterXlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($nombre) . '"');
        $writer->save('php://output');






        // return Excel::download(new ExcelExport(/* $data,$header */),$nombre);


    }


}
