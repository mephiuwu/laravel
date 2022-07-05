<?php

namespace App\Exports;

use App\Models\Contactos;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExcelExport implements
 WithHeadings, 
FromCollection,
 WithStyles,
 ShouldAutoSize
/*  FromArray */
/*  FromQuery */
 {
    /**
    * @return \Illuminate\Support\Collection
    */
   public $data = [],$header = [];

   public function __construct($data,$header = [])
   {
      
     $this->data = $data;
     $this->header = $header;
   } 

   public function headings() : array{
      return $this->header;
   }

  
   public function collection()
   {
   
    return $this->data;

   }

   public function styles(Worksheet $sheet){

      if(count($this->header) > 0){
         return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
         ];
      }
   
   }

  

  /*  public function map() : array{
      
      return $this->data;
   } */
   

   
  

   

  
   
}
 