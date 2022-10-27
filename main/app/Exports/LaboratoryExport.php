<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaboratoryExport implements FromCollection,  WithHeadings, ShouldAutoSize, WithDrawings, WithStyles
{

    public function __construct($data)
    {
        $this->fecha = $data['fecha'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/app/public/terceros/alifehealth.jpg'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return $drawing;
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
            'Exámenes a procesar',
            ['Tipo de muestra', 'T'],
            'Total muestras',
            'Temperatura',
            'Observaciones (EPS)',
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return new Collection(
            DB::table('laboratory_tube')
                ->select(
                    'laboratories.id',
                    'type_documents.code',
                    'patients.identifier',
                    DB::raw('CONCAT_WS(" ",patients.surname,patients.secondsurname,patients.firstname,patients.middlename)'),
                    'patients.date_of_birth',
                    'patients.gener',
                    DB::raw('(SELECT GROUP_CONCAT(DISTINCT(cups.code) SEPARATOR " - ") 
                        FROM cup_laboratories
			            INNER JOIN cups ON cup_laboratories.id_cup=cups.id 
                        WHERE cup_laboratories.id_laboratory =laboratories.id) AS cups'),
                    DB::raw('SUM(laboratory_tube.amount) AS Examenes'),
                    'eps.name',
                )
                ->join('laboratories', 'laboratory_tube.laboratory_id', '=', 'laboratories.id')
                ->join('patients', 'patients.id', '=', 'laboratories.patient')
                ->join('type_documents', 'type_documents.id', '=', 'patients.type_document_id')
                ->join('eps', 'eps.id', '=', 'patients.eps_id')
                ->where([['laboratories.status', 'Tomado']])
                ->when($this->fecha, function ($q, $fill) {
                    $fechas = explode('a', $this->fecha);
                    $f1 = new Carbon($fechas[0]);
                    $f2 = new Carbon($fechas[1]);
                    $q->whereBetween('date', [$f1, $f2]);
                })
                ->groupBy('laboratory_tube.laboratory_id')
                ->get()
        );
    }
}
