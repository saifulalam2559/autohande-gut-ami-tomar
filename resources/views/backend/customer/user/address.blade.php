       @extends('backend.layouts.master')
       @section('content')
       
       
       
  <div class="wrapper">
  <!-- Navbar -->

  <!-- /.navbar -->



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                
              
       
                <div class="card">
                    <div class="card-header">
                <b>Meine Adressen</b>
      
              </div>
                    <div class="card-body">
                        
                         <div class="row ">

        
                <div class="col-md-12 " style="background:#fff;padding: 20px 20px 20px 20px;font-size: 20px;">
                 Dies ist Ihre Rechnungs- und Lieferadresse. Sie können Ihre bestehende Adresse jederzeit ändern. Bei Fragen kontaktieren Sie uns gerne!
                    <br><br>  <br>
                    <div class="row">
                        
                        <div class="col-md-6">
                        
                        <div class="col-md-12" style="border:1px solid #000;padding:50px;">
                            <strong>Rechnungsadresse</strong><br><br>
                            <address>
                                {{$user->first_name}}&nbsp; {{$user->last_name}}<br>
                                {{$user->street_and_number}}&nbsp;{{$user->house_no}}<br> 
                                {{$user->postcode}}&nbsp; {{$user->city}}<br> 
                                {{$user->country}}<br> <br> 
                                Telefonnummer:&nbsp; {{$user->phone}}<br> <br> 
                                
                            </address>
                            
                            <a href="" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#editAddress">Rechnungsadresse bearbeiten</a>
                            
                                                <!-- Modal -->
                        <div class="modal fade" id="editAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog  modal-dialog-centered" role="document" >
                              
            
                              
                              <!-- we are already in foreach loop -->
                              
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLongTitle"></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body ">
                                  
                                                  
                                
                                  
                               <div class="card">
                    <div class="card-header">
                <h3 class="card-title">Rechnungsadresse bearbeiten</h3>
              
              </div>
                    <div class="card-body">
                <form action="{{route('user.billingAddress',$user->id)}}" method="post">
                    @csrf
                   
                    
                      <div class="card-body">
                          
                  <div class="form-group">
                    <label for="">Vorname</label>
                    <input type="text" name="first_name" class="form-control" id="exampleInputTitle" placeholder="Vorname" value="{{$user->first_name}}">
                  </div>
                  <div class="form-group">
                    <label for="">Nachname</label>
                    <input type="text" name="last_name" class="form-control" id="exampleInputTitle" placeholder="Nachname" value="{{$user->last_name}}">
                  </div>
                          <div class="row"> 
                           <div class="col-md-9">    
                           <div class="form-group">
                    <label for="">Straße</label>
                    <input type="text" name="street_and_number" class="form-control" id="exampleInputTitle" placeholder="Straße" value="{{$user->street_and_number}}">
                  </div>
                        </div>  
                              
                         <div class="col-md-3">    
                           <div class="form-group">
                    <label for="">Hausnr.</label>
                    <input type="text" name="house_no" class="form-control" id="exampleInputTitle" placeholder="Hausnr." value="{{$user->house_no}}" required="">
                  </div>
                        </div>  
                              
                     </div> 
                          
                          
                    <div class="row"> 
                        
                     <div class="col-md-3">    
                    <div class="form-group">
                    <label for="">PLZ</label>
                    <input type="number" name="postcode" class="form-control" id="exampleInputTitle" placeholder=" PLZ" value="{{$user->postcode}}">
                  </div>
                        </div> 
                           <div class="col-md-9">    
                            <div class="form-group">
                    <label for="">Ort</label>
                    <input type="text" name="city" class="form-control" id="exampleInputTitle" placeholder="Ort" value="{{$user->city}}">
                  </div>
                        </div>  
                              
 
                              
                     </div>  
                          
                          
                     <div class="row"> 
                        
                     <div class="col-md-8">    
                           <div class="form-group">
                    <label for="">Bundesland</label>
                    <input type="text" name="state" class="form-control" id="exampleInputTitle" placeholder="Bundesland" value="{{$user->state}}">
                  </div>
                        </div> 
                           <div class="col-md-4">    
                <div class="form-group">
                    <label for="">Land</label>
                    <input type="text" name="country" class="form-control" id="exampleInputTitle" placeholder="Land" value="{{$user->country}}">
                  </div>
                        </div>  
                              
 
                              
                     </div>  
                              
                          

                          

 
                          
                 
                          

                          
                          

                  

                          
                          
                  <div class="form-group">
                    <label for="">Telefonnummer</label>
                    <input type="number" name="phone" class="form-control" id="exampleInputTitle" placeholder="Telefonnummer" value="{{$user->phone}}">
                  </div>  
                  
 
                    
                          <br>   



                <div class="form-group">
                 
                    <button type="submit" class=" btn btn-dark" style="width:200px;">Aktualisieren</button>
                        
                     </div>
                   
                  
                  
                  
              </div>
                
            </div>
                    
                </form>
                        </div>
            </div>
                                  
                                          
                  
                                  

                                  
                                  
       
                         
                                  
          
                                  
                                  
                              </div>

                            </div>
                          </div>
                        </div>
                            </div>
        <!-- Modal --> 
                            
                       
                         <!-- start shipping address Modal --> 
                         <div class="col-md-6">
                                          <div class="col-md-12" style="border:1px solid #000;padding:50px;">
                            <strong>Lieferadresse</strong><br><br>
                            <address>
                               
                          @if(auth()->user()->sfirst_name)
                          
                          {{$user->sfirst_name}}&nbsp; {{$user->slast_name}}
                          
                          @else
                          
                          {{$user->first_name}}&nbsp; {{$user->last_name}}
                          
                          @endif
                                
                                
                                
                                <br>
                                {{$user->sstreet_and_number}}&nbsp;{{$user->shouse_no}}<br> 
                                {{$user->spostcode}}&nbsp; {{$user->scity}}<br> 
                                {{$user->scountry}}<br> <br> 
                                Telefonnummer:&nbsp; {{$user->sphone}}<br> <br> 
                                
                            </address>
                            
                            <a href="" class="btn btn-dark btn-sm"  data-toggle="modal" data-target="#shippingAddress">Lieferadresse bearbeiten</a>
                            
                                                <!-- Modal -->
                        <div class="modal fade" id="shippingAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog  modal-dialog-centered" role="document" >
                              
            
                              
                              <!-- we are already in foreach loop -->
                              
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLongTitle"></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body ">
                                  
                                                  
                                
                                  
                               <div class="card">
                    <div class="card-header">
                <h3 class="card-title">Lieferadresse bearbeiten</h3>
              
              </div>
                    <div class="card-body">
                <form action="{{route('user.shippingAddress',$user->id)}}" method="post">
                    @csrf
                   
                    
                     <div class="card-body">
                          
                  <div class="form-group">
                    <label for="">Vorname</label>
                    <input type="text" name="sfirst_name" class="form-control" id="exampleInputTitle" placeholder="Vorname" value="{{$user->sfirst_name}}">
                  </div>
                  <div class="form-group">
                    <label for="">Nachname</label>
                    <input type="text" name="slast_name" class="form-control" id="exampleInputTitle" placeholder="Nachname" value="{{$user->slast_name}}">
                  </div>
                          <div class="row"> 
                           <div class="col-md-9">    
                           <div class="form-group">
                    <label for="">Straße</label>
                    <input type="text" name="sstreet_and_number" class="form-control" id="exampleInputTitle" placeholder="Straße" value="{{$user->sstreet_and_number}}">
                  </div>
                        </div>  
                              
                         <div class="col-md-3">    
                           <div class="form-group">
                    <label for="">Hausnr.</label>
                    <input type="text" name="shouse_no" class="form-control" id="exampleInputTitle" placeholder="Hausnr." value="{{$user->shouse_no}}" required="">
                  </div>
                        </div>  
                              
                     </div> 
                          
                          
                    <div class="row"> 
                        
                     <div class="col-md-3">    
                    <div class="form-group">
                    <label for="">PLZ</label>
                    <input type="number" name="spostcode" class="form-control" id="exampleInputTitle" placeholder=" PLZ" value="{{$user->spostcode}}">
                  </div>
                        </div> 
                           <div class="col-md-9">    
                            <div class="form-group">
                    <label for="">Ort</label>
                    <input type="text" name="scity" class="form-control" id="exampleInputTitle" placeholder="Ort" value="{{$user->scity}}">
                  </div>
                        </div>  
                              
 
                              
                     </div>  
                          
                          
                     <div class="row"> 
                        
                     <div class="col-md-8">    
                           <div class="form-group">
                    <label for="">Bundesland</label>
                    <input type="text" name="sstate" class="form-control" id="exampleInputTitle" placeholder="Bundesland" value="{{$user->sstate}}">
                  </div>
                        </div> 
                           <div class="col-md-4">    
                <div class="form-group">
                    <label for="">Land</label>
                    <input type="text" name="scountry" class="form-control" id="exampleInputTitle" placeholder="Land" value="{{$user->scountry}}">
                  </div>
                        </div>  
                              
 
                              
                     </div>  
                              
                          

                          

 
                          
                 
                          

                          
                          

                  

                          
                          
                  <div class="form-group">
                    <label for="">Telefonnummer</label>
                    <input type="number" name="sphone" class="form-control" id="exampleInputTitle" placeholder="Telefonnummer" value="{{$user->sphone}}">
                  </div>  
                  
 
                    
                          <br>   



                <div class="form-group">
                 
                    <button type="submit" class=" btn btn-dark" style="width:200px;">Aktualisieren</button>
                        
                     </div>
                   
                  
                  
                  
              </div>
                
            </div>
                    
                </form>
                        </div>
            </div>
                                  
                                          
                  
                                  

                                  
                                  
       
                         
                                  
          
                                  
                                  
                              </div>

                            </div>
                          </div>
                        </div>
                             
                             </div>
        <!-- end Modal --> 
        
                    </div> <!-- end inner row -->
                        
                    </div>

        </div>
                        
               </div>
                
        
                    
              
                        
                  </div> <!-- card body -->
                    
                    </div> <!-- card -->
                      </div> <!-- /.col 8-->
             
                       
 
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
        <div class="row" style="margin-top: 80px;">
            
            
        </div>
           </section>
    <!-- /.content -->
      </div>
      <!-- /.container-fluid -->
 
  </div>
  <!-- /.content-wrapper -->




</div>
<!-- ./wrapper -->
       
       
       <style>
           
           
           .navbar {
    background-color: #f8f9fa !important;
    margin-bottom: 80px;
    font-size: 16px;
}
  

           
            .sidenav a{      
        display:block;
        font-size: 20px;
        line-height: 50px;
        border-bottom: 1px solid #000;
        
    }
    
    




@media only screen and (min-width: 800px) {
    
.modal-dialog {
    max-width: 800px;
    margin: 250px auto;
}

}
  


       </style>
       
      @endsection
      
      
       @section('scripts')
       
       <script>
           
           
           
       
       
       </script>
       
          @endsection