<?php

namespace App\Exports;

use App\Models\PickingList;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PickingListsExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithStyles
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }


    /*
    |--------------------------------------------------------------------------
    | Collection
    |--------------------------------------------------------------------------
    */

    public function collection()
    {
        $request = $this->request;

        $query = PickingList::with('product');


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'artikelnr',
                    'LIKE',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'order_no',
                    'LIKE',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'source',
                    'LIKE',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'store_no',
                    'LIKE',
                    '%' . $search . '%'
                )

                ->orWhereHas('product', function ($productQuery) use ($search) {

                    $productQuery
                        ->where(
                            'name',
                            'LIKE',
                            '%' . $search . '%'
                        )

                        ->orWhere(
                            'sku',
                            'LIKE',
                            '%' . $search . '%'
                        )

                        ->orWhere(
                            'barcode',
                            'LIKE',
                            '%' . $search . '%'
                        );

                });

            });

        }


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Shipped
        |--------------------------------------------------------------------------
        */

        if ($request->filled('shipped')) {

            $query->where(
                'shipped',
                $request->shipped
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Source
        |--------------------------------------------------------------------------
        */

        if ($request->filled('source')) {

            $query->where(
                'source',
                $request->source
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Get all matching records
        |--------------------------------------------------------------------------
        */

        return $query
            ->latest()
            ->get();
    }


    /*
    |--------------------------------------------------------------------------
    | Excel Headings
    |--------------------------------------------------------------------------
    */

    public function headings(): array
    {
        return [

            'No.',

            'Store No.',

            'Product Name',

            'Artikel Number',

            'Barcode',

            'Quantity',

            'Order Number',

            'Source',

            'Picked',

            'Shipped',

        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Excel Row Mapping
    |--------------------------------------------------------------------------
    */

    public function map($pickingList): array
    {
        static $number = 0;

        $number++;


        return [

            $number,

            $pickingList->store_no ?? '-',

            $pickingList->product->name ?? '-',

            $pickingList->artikelnr,

            $pickingList->product->barcode ?? '-',

            $pickingList->quantity,

            $pickingList->order_no,

            $pickingList->source ?? '-',

            '',

            $pickingList->shipped
                ? 'Yes'
                : 'No',

        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Excel Styling
    |--------------------------------------------------------------------------
    */

    public function styles(Worksheet $sheet)
    {
        return [

            /*
            | Header
            */

            1 => [

                'font' => [

                    'bold' => true,

                ],

                'alignment' => [

                    'horizontal' => 'center',

                    'vertical' => 'center',

                ],

            ],

        ];
    }
}