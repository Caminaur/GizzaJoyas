<?php

namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;
// https://phpspreadsheet.readthedocs.io/
// Creamos una macro para usar dentro de la clase
Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
    $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
});

class StocksExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, WithEvents
{
    use Exportable;

    // Luego de crear la hoja le agregamos estilos via eventos
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $columns = ['A','B','C','D','E','F','G','H','I'];
                foreach ($columns as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
                }
                $event->sheet->styleCells(
                    'A1:O1',
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => '000000'],
                            ],
                        ],
                        'font' => [
                          'bold' => true,
                        ]
                    ]
                );
            },
        ];
    }

    public function query()
    {
        // Buscar forma de traer las tablas relacionadas
        return Stock::where('id','>',0);
    }

    // Organizamos la info que va a traer por fila
    public function map($stock): array
    {
        return [
            $stock->id,
            $stock->product->name,
            $stock->product->price,
            $stock->product->category->name,
            $stock->product->discount,
            $stock->product->gender->name,
            $stock->quantity == '' ? '0' : $stock->quantity,
            $stock->size->name,
            $stock->color == null ? " " : $stock->color->name,
            $stock->product->gender->name,
            $stock->product->ages == null ? " " : $stock->product->ages->name,
            $stock->product->brand == null ? " " :$stock->product->brand->name,
            $stock->product->material == null ? " " : $stock->product->material->name,
            $stock->created_at->format('d-m-Y'),
        ];
    }

    // Organizamos los headings o titulos de las columnas
    public function headings(): array
    {
        return [
            'id',
            'Nombre',
            'Precio',
            'Categoria',
            'Descuento',
            'Genero',
            'Cantidad',
            'Talle',
            'Color',
            'Genero',
            'Adulto o niño',
            'Marca',
            'Material',
            'Fecha de creacion',
        ];
    }

    // Ordenamos el formato de fecha
    public function columnFormats(): array
    {
        return [
            'i' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
