<?php

namespace App\Exports;

use App\Models\contactos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactosExport implements
    WithHeadings,
   /*  FromCollection, */
    WithStyles,
    ShouldAutoSize
/*     FromQuery,  */
  /*   WithMapping */
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    protected $contactos;


    public function __construct($contactos)
    {
        $this->contactos = $contactos;
        
       
    }

    public function headings(): array
    {
      
        return [
            'ID',
            'Nombre',
            'Asunto',
            'Email',
            'Teléfono',
            'Documento',
            'Mensaje',
            'Comuna',
            'Dirección',
            'Fecha',
        ];
    }
    
    
    public function collection($contactos): array {
        
       return $this->contactos;
    }

   

   /*  public function map($contactos) : array {

        return [
            $contactos->id,
            $contactos->con_nombre,
            $contactos->con_id_asunto,
            $contactos->con_email,
            $contactos->con_telefono,
            $contactos->con_path_documento,
            $contactos->con_mensaje,
            $contactos->con_id_comuna,
            $contactos->con_direccion,
            $contactos->created_at,
        ];
    } */

    public function styles(WorkSheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }





}
