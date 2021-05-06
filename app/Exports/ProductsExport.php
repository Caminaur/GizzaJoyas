<?php

namespace App\Exports;

use App\Models\Product;
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

class ProductsExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, WithEvents
{
    use Exportable;

    // Luego de crear la hoja le agregamos estilos via eventos
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->styleCells(
                    'A1:J1',
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
        return Product::where('id','>',0);
    }

    // Organizamos la info que va a traer por fila
    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->price,
            $product->category->name,
            $product->discount,
            $product->gender->name,
            $product->ages == null ? " " : $product->ages->name,
            $product->brand == null ? " " :$product->brand->name,
            $product->material == null ? " " : $product->material->name,
            $product->created_at->format('d-m-Y'),
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
            'Edad',
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
