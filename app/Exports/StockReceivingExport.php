<?php

namespace App\Exports;


use App\Models\Stock_movement;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;




class StockReceivingExport implements FromCollection, WithHeadings, WithMapping
{


    protected $request;



    public function __construct($request)
    {
        $this->request = $request;
    }




    public function collection()
    {


        return Stock_movement::with([

            'product',
            'product.stock',
            'user'

        ])


        ->where('type','IN')



        ->when($this->request->search,function($query){


            $search = $this->request->search;



            $query->where(function($q) use($search){


                $q->whereHas('product',function($product) use($search){


                    $product->where('name','like','%'.$search.'%')

                    ->orWhere('sku','like','%'.$search.'%')

                    ->orWhere('barcode','like','%'.$search.'%');


                })


                ->orWhere(
                    'reference',
                    'like',
                    '%'.$search.'%'
                );


            });



        })



        ->latest()

        ->get();



    }





    public function headings(): array
    {


        return [

            'Date',
            'Product',
            'SKU',
            'Barcode',
            'Received Quantity',
            'Current Stock',
            'Reference',
            'Note',
            'Created By'

        ];


    }







    public function map($row): array
    {


        return [


            $row->created_at->format('d-m-Y'),


            $row->product->name ?? '-',


            $row->product->sku ?? '-',


            $row->product->barcode ?? '-',


            $row->quantity,


            $row->product->stock->quantity ?? 0,


            $row->reference,


            $row->note,


            $row->user->first_name ?? '-'


        ];


    }
    
    
    





}