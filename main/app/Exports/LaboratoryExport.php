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
    public function __construct($data)
    {
        $this->fecha = $data['fecha'];
    }
    public function headings(): array
    {
        return [
            'N°', 
            'Tipo de doc', 
            'N° de documento', 
            'Apellidos y nombres', 
            'Fecha de nacimiento', 
            'Sexo', 
            'Código CUP',
            'Tipo de muestra',
            'Total muestras',
            'EPS',
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return new Collection(
            Laboratories::where('status', '=', 'Tomado')
            ->when($this->fecha, function ($q, $fill) {
                $fechas = explode('a', $this->fecha);
                $f1 = new Carbon($fechas[0]);
                $f2 = new Carbon($fechas[1]);
                $q->whereBetween('date', [$f1, $f2]);
            })
            ->join('patients', 'laboratories.patient', '=', 'patients.id')
            ->join('cup_laboratories as cl', 'cl.id_laboratory', '=', 'laboratories.id')
            ->join('cups as c', 'cl.id_cup', '=', 'c.id')
            ->join('type_documents', 'type_documents.id', '=', 'patients.type_document_id')
            ->join('laboratory_tube', 'laboratory_tube.laboratory_id', '=', 'laboratories.id')
            ->select(
                'laboratories.id',
                'type_documents.code',
                'patients.identifier',
                DB::raw("CONCAT_WS(' ', patients.surname, patients.secondsurname, patients.firstname, patients.middlename) AS name_patient"),
                'patients.date_of_birth',
                'patients.gener',
                DB::raw('group_concat(DISTINCT(c.code) SEPARATOR " - ") AS CUPS'),                
                DB::raw('SUM(laboratory_tube.amount)')
            )
            ->groupBy('laboratories.patient')
            ->get()
        );
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:J1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11);
            },
        ];
    }
}
