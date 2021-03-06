<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Celular;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class TableCelularesExport implements FromCollection ,  WithHeadings, ShouldAutoSize,  WithEvents
{
    use Exportable;

    public function __construct($role)
    {
        $this->rol = $role;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->rol == "Operador")
        {
            $celulares = DB::table('celulares')
                ->leftjoin('marcas', 'marcas.id', '=', 'celulares.marca_id')
                ->leftjoin('modelos', 'modelos.id', '=', 'celulares.modelo_id')
                ->leftjoin('capacidades', 'capacidades.id', '=', 'celulares.capacidad_id')
                ->leftjoin('colores', 'colores.id', '=', 'celulares.color_id')
                ->select('celulares.imei','marcas.desc as marca_desc', 'modelos.desc as modelo_desc','colores.desc as color_desc', 'capacidades.desc as capacidad_desc','celulares.comprador','celulares.fecha_compra','celulares.precio_compra','celulares.vendedor','celulares.fecha_venta')
                ->get();

            return $celulares;
        }
        $celulares = DB::table('celulares')
            ->leftjoin('marcas', 'marcas.id', '=', 'celulares.marca_id')
            ->leftjoin('modelos', 'modelos.id', '=', 'celulares.modelo_id')
            ->leftjoin('capacidades', 'capacidades.id', '=', 'celulares.capacidad_id')
            ->leftjoin('colores', 'colores.id', '=', 'celulares.color_id')
            ->select('celulares.imei','marcas.desc as marca_desc', 'modelos.desc as modelo_desc','colores.desc as color_desc', 'capacidades.desc as capacidad_desc','celulares.comprador','celulares.fecha_compra','celulares.precio_compra','celulares.vendedor','celulares.fecha_venta','celulares.precio_venta')
            ->get();

        return $celulares;
    }

    public function headings(): array
    {
        if($this->rol == "Operador")
        {
            return [
                'Imei',
                'Marca',
                'Modelo',
                'Color',
                'Capacidad',
                'Proveedor',
                'Fecha compra',
                'Precio compra',
                'Comprador',
                'Fecha venta',
            ];
        }
        return [
            'Imei',
            'Marca',
            'Modelo',
            'Color',
            'Capacidad',
            'Proveedor',
            'Fecha compra',
            'Precio compra',
            'Comprador',
            'Fecha venta',
            'Precio venta',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:K1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);

            },
        ];
    }
}
