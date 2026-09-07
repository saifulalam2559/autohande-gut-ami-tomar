@extends('backend.layouts.master')
       @section('content')


<div class="wrapper">
  <!-- Navbar -->

  <!-- /.navbar -->



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
        
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
           
           
    
             
          <div class="col-md-12">
             
                @include('backend.layouts.notification')
         
                
            <!-- /.card -->

                            <div class="card">
                     <div class="card-header">
                         <div class="row">
                             <div class="col-md-6">
                                 <b> Alle Wunschliste ({{$wishlist->total()}})</b>
                             </div>
                             <div class="col-md-6">
                                
                             </div>
                         </div>
                     </div>

                     <div class="card-body">

                         @if( count($wishlist)> 0 )

                          <div class="row  justify-content-center">

                              <?php $crn = ($wishlist->currentpage()-1) * $wishlist->perpage() + 1; ?>

                 @foreach($wishlist as $row)
                     @php
                         $product = $row->product;
                         // Ensure product is not null before accessing its properties
                         $featuredImage = $product && $product->images 
                             ? $product->images->where('is_featured', true)->first() 
                             : null;
                     @endphp

                     <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-5th px-4 py-4" style="border:1px solid #cbcbcb;position: relative;top: 0; left: 0; right: 0; bottom: 0;">

                         <a href="{{ $product ? route('FrontendActivewearDetailPageSlug', $product->slug) : '#' }}" target="_blank">
                             <img class="center-block" src="{{ $product && $featuredImage ? asset( $featuredImage->image_path) : 'No image' }}" alt="image-product" style="width:150px;height:auto;">
                         </a>
                         <a href="{{ $product ? route('FrontendActivewearDetailPageSlug', $product->slug) : '#' }}" target="_blank" style="text-decoration:none;">
                             <span style="font-size:14px;display:block;margin-top:10px;font-weight:700;">
                                 {{ $product ? $product->title : 'Product Not Available' }}
                             </span>
                         </a>
                         <span class="price" style="font-size:16px;display:block;margin-top:10px;font-weight:700;">
                             <span style="color:gray;font-size:14px;">Preis:</span>
                             {{ number_format($product ? $product->offer_price : 0, 2, ',', '.') }}  €
                             @if($product && $product->discount > 0)
                                 <span style="color:red;font-size:14px;text-decoration: line-through;">
                                      {{ number_format($product->price, 2, ',', '.') }}  €
                                 </span>
                             @endif
                         </span>
                         <span class="price" style="font-size:16px;display:block;margin-top:5px;font-weight:700;">
                             <span style="color:gray;font-size:14px;display:block;">Größe:</span>
                             {{ $product ? implode(', ', $product->attributes->pluck('size')->toArray()) : 'Keine Größe verfügbar' }}
                         </span>
                         <span class="price" style="font-size:16px;display:block;margin-top:5px;font-weight:700;">
                             <span style="color:gray;font-size:14px;display:block;">Kategorie:</span>
                             {{ $product && $product->subsubcategory ? $product->subsubcategory->name : 'Keine Kategorie verfügbar' }}
                         </span>

                         <div style="position: absolute; top: 5%;left: 80%;display: block;">
                             <form class="float-left ml-2" action="{{ route('RemoveWishlistProduct', $row->id) }}" method="POST">
                                 @csrf
                                 @method('delete')
                                 <a href="" data-toggle="tooltip" title="delete" data-placement="bottom" data-id="{{ $row->id }}" class="dtlBtn btn btn-sm btn-outline-danger">
                                     <i class="fas fa-trash-alt" style="font-size:12px;"></i>
                                 </a>
                             </form>
                         </div>
                     </div>
                 @endforeach

                
            </div>

    </div>
</div>
            
           


<h5 style="color:red;padding-top: 15px;">
    Aktuelle Seite {{$wishlist->currentPage()}} von {{$wishlist->firstItem()}} bis {{$wishlist->lastItem()}}
</h5>
            
                   @else
                    <div id="centernofound">
                        <h5 style="padding:50px 0 0 0;color:red;">Keine wishlist gefunden!!</h5>
                    </div>

                    @endif

{{$wishlist->appends($_GET)->links('pagination-links')}}

            <!-- /.card -->
            
            
          </div> <!-- /.col md 8 -->
          

         
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




</div>
<!-- ./wrapper -->


 <style>
     
     
     
.center-block {
    display: block;
    margin-left: auto;
    margin-right: auto;
 }
 
 .col-5th {
    flex: 0 0 20%;
    max-width: 20%;
}
 
 </style>

 @endsection
 
 

 
 
 @section('scripts')
 



 
     
     


 
  


 
 @endsection
