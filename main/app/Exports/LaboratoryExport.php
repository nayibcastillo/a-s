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
            'N°', 'Nombres y apellidos', 'N° de documento', 'Hora de recolección', 'Número telefónico', 'Código CUP'
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return new Collection(
            Laboratories::where('status', '=', 'Tomado')
            ->join('patients', 'laboratories.patient', '=', 'patients.id')
            ->join('cup_laboratories as cl', 'cl.id_laboratory', '=', 'laboratories.id')
            ->join('cups as c', 'cl.id_cup', '=', 'c.id')
            ->join('colors', 'colors.id', '=', 'c.color_id')
            ->join('laboratory_tube', function($join) {
                $join->on('laboratory_tube.laboratory_id', '=', 'laboratories.id');
                $join->on('laboratory_tube.color_id', '=', 'colors.id');
            } )
            ->select(
                'laboratories.id',
                DB::raw("CONCAT_WS(' ', patients.firstname, patients.middlename, patients.surname, patients.secondsurname) AS name_patient"),
                'patients.identifier',
                DB::raw('MAX(laboratory_tube.hour) as hour'),
                'patients.phone',
                /* DB::raw('MAX(laboratory_tube.count) as count'),
                'c.code', 
                'c.color_id', 
                'colors.abbreviation',  */
                DB::raw('group_concat(DISTINCT(c.code) SEPARATOR " - ") AS CUPS'))
            ->groupBy('c.color_id')
            ->get()
        );
        return new Collection(
            DB::table('laboratories')
                ->join('patients', 'laboratories.patient', '=', 'patients.id')
                ->join('municipalities', 'patients.municipality_id', '=', 'municipalities.id')
                ->join('eps', 'patients.eps_id', '=', 'eps.id')
                ->join('cup_laboratories', 'cup_laboratories.id_laboratory', '=', 'laboratories.id')
                ->join('cups', 'cup_laboratories.id_cup', '=', 'cups.id')
                ->where('status', '=', 'Tomado')
                ->select(
                    'laboratories.id',
                    DB::raw("CONCAT(patients.firstname, ' ', patients.middlename, ' ', patients.surname, ' ', patients.secondsurname) AS name_patient"),
                    'patients.identifier',
                    'laboratories.hour',
                    'patients.phone',
                    'cups.code',
                    'cups.description',
                )
                ->orderByDesc('laboratories.created_at')
                ->get()
        );
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:G1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
