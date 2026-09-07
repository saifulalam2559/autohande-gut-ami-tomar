<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ProductExport implements FromCollection, WithHeadings
{


    protected $products;



    public function __construct($products)
    {
        $this->products = $products;
    }



    public function collection()
    {


        return $this->products->map(function($product){


            return [

                'name' => $product->name,

                'sku' => $product->sku,

                'store_no' => $product->store_no,

                'barcode' => $product->barcode,

                'purchase_price' => $product->purchase_price,

                'selling_price' => $product->selling_price,

                'stock' => $product->stock->quantity ?? 0,

                'status' => $product->status ? 'Active' : 'Inactive',

                'category' => $product->category->name ?? '-',


            ];


        });


    }





    public function headings(): array
    {

        return [

            'Product Name',

            'SKU',

            'Store Number',

            'Barcode',

            'Purchase Price',

            'Selling Price',

            'Stock',

            'Status',

            'Category'


        ];

    }



}