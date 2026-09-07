<?php

namespace App\Exports;


use App\Models\Product;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;



class InventoryExport implements FromCollection, WithHeadings, WithMapping
{


    protected $request;



    public function __construct($request)
    {
        $this->request = $request;
    }




    public function collection()
    {


        return Product::with([
            'stock',
            'category'
        ])


        ->when($this->request->search,function($query){

            $search = $this->request->search;


            $query->where(function($q) use($search){


                $q->where(
                    'name',
                    'like',
                    '%'.$search.'%'
                )


                ->orWhere(
                    'sku',
                    'like',
                    '%'.$search.'%'
                )


                ->orWhere(
                    'barcode',
                    'like',
                    '%'.$search.'%'
                )


                ->orWhere(
                    'store_no',
                    'like',
                    '%'.$search.'%'
                );


            });


        })



        ->when($this->request->category_id,function($query){

            $query->where(
                'category_id',
                $this->request->category_id
            );

        })


        ->latest()

        ->get();


    }





    public function headings(): array
    {

        return [

            'Name',
            'SKU',
            'Store Number',
            'Barcode',
            'Purchase Price',
            'Selling Price',
            'Stock',
            'Category',
            'Status'

        ];

    }





    public function map($product): array
    {


        return [

            $product->name,

            $product->sku,

            $product->store_no,

            $product->barcode,

            $product->purchase_price,

            $product->selling_price,

            $product->stock->quantity ?? 0,

            $product->category->name ?? '-',

            $product->status ? 'Active':'Inactive'


        ];


    }


}