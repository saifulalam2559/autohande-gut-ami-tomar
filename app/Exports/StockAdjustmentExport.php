<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class StockAdjustmentExport implements FromCollection, WithHeadings
{


    protected $request;



    public function __construct($request)
    {

        $this->request = $request;

    }



    /*
    |--------------------------------------------------------------------------
    | Export Collection
    |--------------------------------------------------------------------------
    */

    public function collection()
    {


        return DB::table('stock_movements')

        ->leftJoin(
            'products',
            'products.id',
            '=',
            'stock_movements.product_id'
        )

        ->leftJoin(
            'stocks',
            'stocks.product_id',
            '=',
            'products.id'
        )

        ->leftJoin(
            'users',
            'users.id',
            '=',
            'stock_movements.created_by'
        )


        /*
        |--------------------------------------------------------------------------
        | Only Adjustments
        |--------------------------------------------------------------------------
        */

        ->where(
            'stock_movements.type',
            'ADJUSTMENT'
        )



        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        ->when(
            $this->request->search,
            function ($query) {

                $search =
                    $this->request->search;


                $query->where(function ($q) use ($search) {


                    $q->where(
                        'products.name',
                        'like',
                        '%' . $search . '%'
                    )


                    ->orWhere(
                        'products.sku',
                        'like',
                        '%' . $search . '%'
                    )


                    ->orWhere(
                        'products.barcode',
                        'like',
                        '%' . $search . '%'
                    )


                    ->orWhere(
                        'stock_movements.reference',
                        'like',
                        '%' . $search . '%'
                    );


                });


            }
        )



        /*
        |--------------------------------------------------------------------------
        | Select
        |--------------------------------------------------------------------------
        */

        ->select(

            'stock_movements.created_at',

            'products.name as product_name',

            'products.sku',

            'products.barcode',

            'stock_movements.quantity',

            'stocks.quantity as current_stock',

            'stock_movements.reference',

            'stock_movements.note',

            'users.first_name as created_by'

        )



        /*
        |--------------------------------------------------------------------------
        | Latest First
        |--------------------------------------------------------------------------
        */

        ->orderBy(
            'stock_movements.created_at',
            'desc'
        )


        ->get()



        /*
        |--------------------------------------------------------------------------
        | Format Excel Rows
        |--------------------------------------------------------------------------
        */

        ->map(function ($row) {


            return [

                'date' =>
                    date(
                        'd-m-Y H:i',
                        strtotime($row->created_at)
                    ),


                'product' =>
                    $row->product_name ?? '-',


                'sku' =>
                    $row->sku ?? '-',


                'barcode' =>
                    $row->barcode ?? '-',


                'adjustment' =>
                    $row->quantity > 0
                        ? '+' . $row->quantity
                        : (string) $row->quantity,


                'current_stock' =>
                    $row->current_stock ?? 0,


                'reference' =>
                    $row->reference ?? '-',


                'note' =>
                    $row->note ?? '-',


                'created_by' =>
                    $row->created_by ?? 'System',

            ];


        });


    }



    /*
    |--------------------------------------------------------------------------
    | Excel Headings
    |--------------------------------------------------------------------------
    */

    public function headings(): array
    {


        return [

            'Date',

            'Product',

            'SKU',

            'Barcode',

            'Adjustment Qty',

            'Current Stock',

            'Reference',

            'Note',

            'Created By'

        ];


    }


}