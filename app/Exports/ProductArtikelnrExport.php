<?php

namespace App\Exports;

use App\Models\ProductArtikelnr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductArtikelnrExport implements FromCollection, WithHeadings, WithMapping
{

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {

        return ProductArtikelnr::with('product')

        ->when($this->request->search,function($query){

            $search = $this->request->search;

            $query->where(function($q) use($search){

                $q->where('artikelnr','like','%'.$search.'%')

                ->orWhere('source','like','%'.$search.'%')

                ->orWhere('store_no','like','%'.$search.'%')

                ->orWhereHas('product',function($product) use($search){

                    $product->where('name','like','%'.$search.'%')

                    ->orWhere('sku','like','%'.$search.'%')

                    ->orWhere('barcode','like','%'.$search.'%')

                    ->orWhere('store_no','like','%'.$search.'%');

                });

            });

        })

        ->when(

            $this->request->status !== null
            &&
            $this->request->status !== '',

            function($query){

                $query->where(
                    'status',
                    $this->request->status
                );

            }

        )

        ->latest()

        ->get();

    }

    public function headings(): array
    {

        return [

            'Product',

            'SKU',

            'Store No',

            'Barcode',

            'Source',

            'Artikel Number',

            'Status'

        ];

    }

    public function map($row): array
    {

        return [

            $row->product->name ?? '-',

            $row->product->sku ?? '-',

            $row->store_no,

            $row->product->barcode ?? '-',

            $row->source,

            $row->artikelnr,

            $row->status ? 'Active' : 'Inactive'

        ];

    }

}