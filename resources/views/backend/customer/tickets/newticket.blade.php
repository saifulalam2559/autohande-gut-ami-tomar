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
                  <h3 class="float-left">Erstellung eines Supporttickets</h3>
               <a style="color:#fff;" href="{{route('open.ticket')}}" class="float-right btn btn-dark">Alle Support-Tickets</a>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row">
                      
                      <div class="col-md-6">
                                <form action="{{route('store.ticket')}}" method="post" id="ticketForm" enctype="multipart/form-data">
                    @csrf
                  
                  <div class="form-group">
                    <label for="">Betreff</label>
                    <input type="text" name="subject" class="form-control" id="exampleInputTitle" placeholder="z. B. Bestellnummer, Produktname..." value="{{old('subject')}}">
                  </div>
                  <div class="form-group">
                    <label for="">Prioritätsstufen</label>
                    <select class="form-control my-select" id="priority" name="priority">
                        <option disabled="" selected="" >Auswählen</option>
                        <option value="Niedrig" {{old('priority') == 'Niedrig' ? 'selected' : ''}}>Niedrig </option>
                        <option value="Mittel"  {{old('priority') == 'Mittel' ? 'selected' : ''}}> Mittel </option>
                         <option value="Hoch"  {{old('priority') == 'Hoch' ? 'selected' : ''}}> Hoch </option>
                    </select>
                   </div>
                    
                   <div class="form-group">
                    <label for="">Service</label>
                    <select class="form-control my-select" id="service" name="service">
                        <option disabled="" selected="" >Auswählen</option>
                        <option value="Technisch" {{old('service') == 'Technisch' ? 'selected' : ''}}>Technisch </option>
                        <option value="Zahlung"  {{old('service') == 'Zahlung' ? 'selected' : ''}}> Zahlung </option>
                         <option value="Zurückkehren"  {{old('service') == 'Zurückkehren' ? 'selected' : ''}}> Zurückkehren </option>
                         <option value="Erstattung"  {{old('service') == 'Erstattung' ? 'selected' : ''}}> Erstattung </option>
                    </select>
                   </div>
                    
                       <div class="form-group">
                               <label for="message">Nachricht</label>
                               <textarea name="message" class="form-control" rows="4" cols="50">{{ old('message') }}</textarea>
                           </div>
                  
                 <div class="form-group">
                    <label for="">Bild</label>
                    <input type="file" name="image" class="form-control" id="attachment" placeholder="Bild..." value="">
                  </div>
                  
                <div id="file-error" style="color:red; font-size: 14px;"></div>
                    
 
                  
                    <br>


                <div class="form-group">
                 
                    <button type="submit" class="btn btn-dark" style="width:200px;">Senden</button>
                        
                     </div>
                   
                  
                  
                  
         
                
        
                    
                </form>
                      </div>
                      
                       <div class="col-md-6">
                          
                      </div>
                      
                  </div>

          

             
             
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
</div>
     
      
       @endsection
       
       
       @section('scripts')


<script>
$('#ticketForm').on('submit', function(e) {
    let fileInput = $('#attachment')[0];
    let file = fileInput.files[0];
    let error = '';
    let allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
    let maxSize = 500 * 1024;  // 500KB

    if (file) {
        let fileExt = file.name.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(fileExt)) {
            error = "Es sind nur JPG-, PNG-, GIF- oder SVG-Dateien zulässig.";
        } else if (file.size > maxSize) {
            error = "Die Dateigröße muss kleiner als 500 KB sein.";
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