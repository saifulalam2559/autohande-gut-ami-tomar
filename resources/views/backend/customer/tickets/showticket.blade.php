       @extends('backend.layouts.master')
       @section('content')
       
       
       <div class="container-fluid">

       <div class="row userindex">
          <div class="col-12">
              @include('backend.layouts.notification')
              
                  @if ($errors->any())
                    <div id="error-message" class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


            <div class="card">
              <div class="card-header">
                  <b class="float-left">Ticket Details</b>
             <a style="color:#fff;" href="{{route('open.ticket')}}" class="float-right btn btn-dark">Alle Support-Tickets</a>
                
              </div>
              <!-- /.card-header -->
             
              <!-- start card-body 1 -->
              <div class="card-body">
                  
                   <!--start row   -->   
                  <div class="row">
                     
                <!--  ticket detail-->
                      <div class="col-md-4">
                          
                 <div class="row">
                      <div class="col-md-4">
                          Datum
                      </div>
                      
                      <div class="col-md-8">:
                          <b>{{ \Carbon\Carbon::parse($ticket->date)->format('d.m.Y') }} </b> 
                      </div>
                      
                  </div> 
                          
                          
               <div class="row">
                      <div class="col-md-4">
                          Betreff
                      </div>
                      
                      <div class="col-md-8">:
                          <b>{{$ticket->subject}}  </b> 
                      </div>
                      
                  </div> 
                                    <div class="row">
                      <div class="col-md-4">
                          Service
                      </div>
                      
                      <div class="col-md-8">:
                          <b>{{$ticket->service}}  </b> 
                      </div>
                      
                  </div>  
                                    <div class="row">
                      <div class="col-md-4">
                          Prioritätsstufen
                      </div>
                      
                      <div class="col-md-8">:
                          <b>
                              
                        @if($ticket->priority=='Niedrig')
                          <span class="badge badge-warning">Niedrig</span>
                          @elseif($ticket->priority=='Mittel')
                          <span class="badge badge-warning">Mittel</span>
                          @elseif($ticket->priority=='Hoch')
                          <span class="badge badge-warning">Hoch</span>
                          @endif
                          
                          </b> 
                      </div>
                      
                  </div> 
                          
                  <div class="row">
                      <div class="col-md-4">
                          Status
                      </div>
                      
                      <div class="col-md-8">:
                          <b>
                              
                          @if($ticket->status==0)
                          <span class="badge badge-secondary">Ausstehend</span>
                          @elseif($ticket->status==1)
                          <span class="badge badge-success">Antworten</span>
                          @elseif($ticket->status==2)
                          <span class="badge badge-danger">Geschlossen</span>
                          @endif
                          
                          </b> 
                      </div>
                      
                  </div> 
                                    <div class="row">
                      <div class="col-md-4">
                          Nachricht
                      </div>
                      
                      <div class="col-md-8">:
                          <b>{{$ticket->message}}  </b> 
                      </div>
                      
                  </div>  
                          <br>  
                          
              @if($ticket->image)
                   <div class="row">
                      <div class="col-md-4">
                          Bild
                      </div>
                      
                      <div class="col-md-8">
                          
                          <a href="{{ asset( $ticket->image) }}" target="_blank"> <img src="{{ asset( $ticket->image) }}" alt="" style="height: 200px; width: auto;"></a>   
                          
                      </div>
                      
                  </div> 
                 @endif         
                       
                  
                      </div>
                <!--End   ticket detail-->
                  
                 <!--  image-->
              <div class="col-md-8">
                          
                               <!-- start card-body 2 -->
             
            
               <div id="mess" class="card-body" style="height: 450px;  overflow-y: scroll;">

                   <!--     foreach    loop  -->

                @isset($replays)
                
                    @foreach( $replays as $row)
                   <div class="card @if($row->user->role === 'admin')   @else ml-4  @endif">
                         <div class="card-header @if($row->user->role === 'admin') adminnbg @else custobg @endif">
                           @if($row->user->role === 'admin') 


                    @if($row->user->photo)
                        <img src="{{ asset('images/users/' . $row->user->photo) }}" alt="User Photo" style="height: 50px; width: auto;border-radius: 50%;">
                    @else
                         <img src="{{asset('frontend/images/userprofile.jpg')}}" style="height: 50px; width: auto;border-radius: 50%;">
                    @endif
                    
                    Ahkunst Support-Team

@else 


                    @if($row->user->photo)
                        <img src="{{ asset('images/users/' . $row->user->photo) }}" alt="User Photo" style="height: 50px; width: auto;border-radius: 50%;">
                    @else
                         <img src="{{asset('frontend/images/userprofile.jpg')}}" style="height: 50px; width: auto;border-radius: 50%;">
                    @endif
      {{$row->user->first_name}} {{$row->user->last_name}} 

@endif  
<span style="display:inline;font-size:16px;font-weight:500;margin-left:50px;">{{ \Carbon\Carbon::parse($row->reply_date)->format('d.m.Y H:i') }}</span>

                        </div>
                        <div class="card-body">
                          <blockquote class="blockquote mb-0">
                            <p>{{$row->message}}</p>
                            
                             <a href="{{ asset( $row->image) }}" target="_blank"> <img src="{{ asset( $row->image) }}" alt="" style="height:200px; width: auto;"></a>  
                           
                          </blockquote>
                        </div>
                      </div>
                    @endforeach
                @endisset($replays)
                

    <!--  end   foreach    loop  -->   
    
              </div>
       
         
                <!-- end card-body 2 -->
                
                
                          <!-- start card-body 3 -->
            
              <div class="card-body">
                  
                  <div class="row">
                      
                      <div class="col-md-12">
                                <form id="supportForm" action="{{route('customer.ticket.reply')}}" method="post" enctype="multipart/form-data">
                    @csrf
                  
    
                    
                       <div class="form-group">
                               <label for="message">Nachricht</label>
                               <textarea name="message" class="form-control" rows="2" cols="50">{{ old('message') }}</textarea>
                               <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                           </div>
                  
                 <div class="form-group">
                    <label for="">Bild</label>
                    <input type="file" name="image" class="form-control" id="attachment" placeholder="upload your image" value="">
                  </div>
                     <div id="file-error" style="color:red; font-size: 14px;"></div>
                  

                     <br>

                <div class="form-group">
                 
                    <button type="submit" class="btn btn-dark" style="width:200px;">Senden</button>
                        
                     </div>
                   
                  
                  
                  
         
                
        
                    
                </form>
                      </div>
                      
            
                      
                  </div>

          

             
             
              </div>
                    <!-- end card-body 3 -->
                        
                         
                      </div>
                  <!--end   image-->    
                      
                  </div>
                  <!--row end   -->   
   
                  
              </div>
              <!-- / main card-body  -->
              
    

              
            </div>
            <!-- end main card -->
            <!-- end main card -->
            <!-- end main card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
</div>
       
       
       <style>
          
           .adminnbg{
             background-color:#d5e7ff;
           }
           
           
               .custobg{
             background-color:#d5fadd;
           }
           
           

           
       </style>
     
      
       @endsection
       
       
       @section('scripts')



<script>
$('#supportForm').on('submit', function(e) {
    let fileInput = $('#attachment')[0];
    let file = fileInput.files[0];
    let error = '';
    let allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'docx'];
    let maxSize = 1024 * 1024; // 1MB

    if (file) {
        let fileExt = file.name.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(fileExt)) {
            error = "Es sind nur JPG-, PNG-, PDF- oder DOCX-Dateien zulässig.";
        } else if (file.size > maxSize) {
            error = "Die Dateigröße muss kleiner als 1 MB sein.";
        }
    }

    if (error !== '') {
        e.preventDefault(); // Stop form submission
        $('#file-error').text(error);
    } else {
        $('#file-error').text('');
    }
});
</script>




@endsection