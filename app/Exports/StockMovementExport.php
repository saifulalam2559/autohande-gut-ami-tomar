<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class StockMovementExport implements FromCollection, WithHeadings
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


        ->select(

            'stock_movements.product_id',


            DB::raw(
                'DATE(stock_movements.created_at) as movement_date'
            ),



            /*
            |--------------------------------------------------------------------------
            | Stock IN
            |--------------------------------------------------------------------------
            */

            DB::raw("
                SUM(
                    CASE
                        WHEN stock_movements.type = 'IN'
                        THEN stock_movements.quantity
                        ELSE 0
                    END
                ) as total_in
            "),



            /*
            |--------------------------------------------------------------------------
            | Stock OUT
            |--------------------------------------------------------------------------
            */

            DB::raw("
                SUM(
                    CASE
                        WHEN stock_movements.type = 'OUT'
                        THEN stock_movements.quantity
                        ELSE 0
                    END
                ) as total_out
            "),



            /*
            |--------------------------------------------------------------------------
            | Positive Adjustment
            |--------------------------------------------------------------------------
            */

            DB::raw("
                SUM(
                    CASE
                        WHEN stock_movements.type = 'ADJUSTMENT'
                        AND stock_movements.quantity > 0
                        THEN stock_movements.quantity
                        ELSE 0
                    END
                ) as total_adjustment_in
            "),



            /*
            |--------------------------------------------------------------------------
            | Negative Adjustment
            |--------------------------------------------------------------------------
            */

            DB::raw("
                SUM(
                    CASE
                        WHEN stock_movements.type = 'ADJUSTMENT'
                        AND stock_movements.quantity < 0
                        THEN ABS(stock_movements.quantity)
                        ELSE 0
                    END
                ) as total_adjustment_out
            ")

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


                $query->whereExists(

                    function ($q) use ($search) {


                        $q->select(
                            DB::raw(1)
                        )


                        ->from('products')


                        ->whereColumn(

                            'products.id',

                            'stock_movements.product_id'

                        )


                        ->where(

                            function ($p) use ($search) {


                                $p->where(

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

                                );


                            }

                        );


                    }

                );


            }

        )



        /*
        |--------------------------------------------------------------------------
        | Group By Product + Date
        |--------------------------------------------------------------------------
        */

        ->groupBy(

            'stock_movements.product_id',

            DB::raw(
                'DATE(stock_movements.created_at)'
            )

        )



        /*
        |--------------------------------------------------------------------------
        | Latest First
        |--------------------------------------------------------------------------
        */

        ->orderBy(

            'movement_date',

            'desc'

        )


        ->get()



        /*
        |--------------------------------------------------------------------------
        | Format Excel Rows
        |--------------------------------------------------------------------------
        */

        ->map(

            function ($row) {


                $product =

                    \App\Models\Product::with('stock')

                    ->find(
                        $row->product_id
                    );



                /*
                |--------------------------------------------------------------------------
                | Adjustment Calculation
                |--------------------------------------------------------------------------
                */

                $adjustment = 0;



                if (
                    $row->total_adjustment_in > 0
                ) {


                    $adjustment +=

                        $row->total_adjustment_in;


                }



                if (
                    $row->total_adjustment_out > 0
                ) {


                    $adjustment -=

                        $row->total_adjustment_out;


                }



                /*
                |--------------------------------------------------------------------------
                | Return Row
                |--------------------------------------------------------------------------
                */

                return [


                    'date' => date(

                        'd-m-Y',

                        strtotime(
                            $row->movement_date
                        )

                    ),



                    'product' =>

                        $product->name ?? '-',



                    'sku' =>

                        $product->sku ?? '-',



                    'barcode' =>

                        $product->barcode ?? '-',



                    'stock_in' =>

                        $row->total_in,



                    'stock_out' =>

                        $row->total_out,



                    'adjustment' =>

                        $adjustment > 0

                            ? '+' . $adjustment

                            : (
                                $adjustment < 0

                                ? (string) $adjustment

                                : '0'
                            ),



                    'current_stock' =>

                        $product->stock->quantity ?? 0,


                ];


            }

        );


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


            'Stock IN',


            'Stock OUT',


            'Adjustment',


            'Current Stock'


        ];


    }


}