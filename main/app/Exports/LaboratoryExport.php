<?php

namespace App\Exports;

use App\Models\Laboratories;
use App\Services\DotationDownloadService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;


class LaboratoryExport implements FromCollection,  WithHeadings, ShouldAutoSize, WithEvents
{    
    public function headings(): array
    {
        return [
          'N°', 'Nombres y apellidos', 'N° de documento', 'Hora de recolección', 'Número telefónico'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

         return new Collection(
            DB::table('laboratories')
            ->join('patients', 'laboratories.patient', '=', 'patients.id')
            ->join('municipalities', 'patients.municipality_id', '=', 'municipalities.id')
            ->join('eps', 'patients.eps_id', '=', 'eps.id')
            ->join('cup_laboratories', 'cup_laboratories.id_laboratory', '=', 'laboratories.id')
            ->where('status', '=', 'Tomado')
            ->select(
                'laboratories.id',
                DB::raw("CONCAT(patients.firstname, ' ', patients.middlename, ' ', patients.surname, ' ', patients.secondsurname) AS name_patient"),
                'patients.identifier',
                'laboratories.hour',
                'patients.phone',
                'cup_laboratories.*',
            )
            ->orderByDesc('laboratories.created_at')
            ->get()
         );

    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

}
