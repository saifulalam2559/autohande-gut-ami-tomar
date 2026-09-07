@extends('frontend.layouts.master')
@section('content')







       <!-- preload -->
       <div class="preload preload-container" >
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div id="wrapper" style="margin-top:80px;">

<!-- page-title -->
        <div class="tf-page-title cardgradient">
            <div class="container-full">
                <div class="heading text-center">Return</div>
            </div>
        </div>
        <!-- /page-title -->
        
        <!-- page-cart -->
        <div class="container">
            


      
  
       <br><br>

  <div class="row">
      
      <div class="col-md-2">
          
      </div>
      
      <div class="col-md-8">
          
            
        
                 @include('backend.layouts.notification')
                 
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <br>
                
                <div class="row" style="display: flex; justify-content: center; align-items: center;">
                   
                    <div class="col-md-2">
              @php
                    // Retrieve the featured image
                    $featuredImage = $product->images->where('is_featured', true)->first();

                   
                @endphp
                
                 <a href="{{$productUrl}}" class="product-img">
 
                @if($featuredImage)
                
                    <!-- Display the featured image -->
                    <img class="lazyload img-product" data-src="{{ asset( $featuredImage->image_path) }}" src="{{ asset( $featuredImage->image_path) }}" alt="image-product" style="width:150px;">
                    
                     
                @else
                    <!-- Fallback: If no featured image is found, use the first image -->
                    @if($product->images->first())
                        <img class="lazyload img-product" data-src="{{ asset( $product->images->first()->image_path) }}" src="{{ asset( $product->images->first()->image_path) }}" style="width:150px;" alt="image-product">
                    @endif
                @endif
                
                 </a>
                    </div>
                       
                    
                    <div class="col-md-10">
                        <p>
                         <a href="{{$productUrl}}" class="product-img">
                             <h5>{{ $product->title }}</h5><br>
                         </a>
                            </p>
                            
                          
                                <p>Price: € {{ number_format($orderItems->price, 2, ',', '.') }}</p>
                                    <p>Quantity: {{ $orderItems->qty }}</p>
                                    <p>Size: {{ $orderItems->size }}</p>
                                    <p>Color: {{ $orderItems->color }}</p>
                                    <p>id: {{ $orderItems->id }}</p>
                                    
                  
    
     



                    </div>
                    
                    
                </div>
               


               
                <br>
                 <br>
                  <br>
                      
    <form action="{{ route('return.store', $product->id) }}" method="POST">
    @csrf
 
    <input type="hidden" name="order_item_id" value="{{ $orderItems->id }}">
                        <div class="form-group">
                          <label for="">Return Reason</label>
                         
                              <select class="form-control my-select" id="" name="return_reason">
                                     <option disabled="" selected="" >Auswählen</option>                                  
                                        <option value="Größe entspricht nicht der Beschreibung auf der Website">Größe entspricht nicht der Beschreibung auf der Website</option> 
                                        <option value="Farbe  entspricht nicht der Beschreibung auf der Website">Farbe  entspricht nicht der Beschreibung auf der Website</option> 
                                        <option value="Leistung oder Qualität ungenügend">Leistung oder Qualität ungenügend</option> 
                                        <option value="Gefällt mir nicht mehr">Gefällt mir nicht mehr</option> 
                                        <option value=" Artikel ist fehlerhaft oder funktioniert nicht"> Artikel ist fehlerhaft oder funktioniert nicht</option> 
                                        <option value=" Der Artikel  entspricht nicht der Beschreibung auf der Website"> Der Artikel  entspricht nicht der Beschreibung auf der Website</option> 
                                        <option value="Keinen Grund angeben">Keinen Grund angeben</option> 
                                        <option value="Nicht autorisierter Kauf">Nicht autorisierter Kauf</option> 
                                        <option value="Der Artikel und die Versandverpackung sind beschädigt">Der Artikel und die Versandverpackung sind beschädigt</option> 
                                        <option value="Voraussichtliches Lieferdatum nicht eingehalten">Voraussichtliches Lieferdatum nicht eingehalten</option> 
                                        <option value="Inkompatibel oder für vorgesehenen Einsatz ungeeignet">Inkompatibel oder für vorgesehenen Einsatz ungeeignet</option> 
                                        <option value="Woanders günstiger entdeckt ">Woanders günstiger entdeckt </option> 
                                        <option value="Falschen Artikel erhalten">Falschen Artikel erhalten</option> 
                                        <option value="Wurde über die bestellte Ware hinaus geliefert">Wurde über die bestellte Ware hinaus geliefert</option> 
                                        <option value="UG">UG</option> 
                                        <option value="LTD">LTD</option> 
                                        <option value="Sonstiges">Sonstiges</option>  
                                     
                                  </select>
                        </div>


                              <br>
                              
                              <div class="form-group">
                                                       
                                  <label for="review_text">Note:</label>
    <textarea name="return_notes" class="form-control " style="border: 1px solid #c2c2c2;"></textarea><br>

                                  
                              </div><br>
                      <div class="form-group">

                          <button type="submit" class="btn btn-dark btn-round" style="width:200px;">Senden</button>

                           </div>

</form>

            
          
 

          




          
      </div>
      
      <div class="col-md-2">
          
          
      </div>


  </div>


</div>
        <!-- page-cart -->

     </div> 
    


 
 <style>

        .checkfont1{
         font-size:16px !important;
         color:#7e7e7e !important;
     }  
     
     
  
    .star-rating .fa-star {
        font-size: 2em;
        color: gray;
        cursor: pointer;
    }

    .star-rating .fa-star.selected {
        color:  #de7922;
    }



</style>



 @endsection
 
 

 
 
 @section('scripts')
 
 


 
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('.star-rating .fa-star');
        const ratingInput = document.getElementById('rating');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                // Set the rating value based on the clicked star
                const ratingValue = this.getAttribute('data-value');
                ratingInput.value = ratingValue;

                // Update star colors
                stars.forEach(s => s.classList.remove('selected'));
                for (let i = 0; i < ratingValue; i++) {
                    stars[i].classList.add('selected');
                }
            });
        });
    });
</script>







 @endsection