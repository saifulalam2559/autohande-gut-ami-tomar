@extends('frontend.layouts.master')
@section('content')












<form action="" method="post"> 
    @csrf
        <!-- page-title -->
        <div class="tf-page-title" style="margin-top:100px;">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h1 class="heading text-center">Session Expired</h1>
                        <p class="text-center text-2 text_black-2 mt_5">Shop through our latest selection of Fashion</p> 
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->
        <section class="flat-spacing-1">
            <div class="container">
               
                <div class="row">
                    
                    <div class="col-md-12">
                        sorry, Session Expired
                    </div>
                    
                    
                </div>
                
            </div>
        </section>
        <div class="btn-sidebar-style2">
            <button data-bs-toggle="offcanvas" data-bs-target="#sidebarmobile" aria-controls="offcanvas"><i class="icon icon-sidebar-2"></i></button>
        </div>


    </form>
 <style>

     
   


 </style>

 @endsection
 
 

 
 
 @section('scripts')
 




 

 
 @endsection
