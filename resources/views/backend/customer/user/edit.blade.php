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
          <div class="col-md-3">
          
            <!-- /.card -->

        
            <!-- /.card -->
          </div>
            <div class="col-md-6">
              
               @include('backend.layouts.notification')
               
@if($errors->any())
    <div class="d-flex justify-content-center">  <!-- Flexbox for center alignment -->
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert" style="max-width:1000px;">
            @foreach($errors->all() as $error)
                <p class="mb-0 d-inline-block">
                    {{$error}}
                </p>
            @endforeach
            <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

       
                <div class="card">
                    <div class="card-header">
                <b>Konto aktualisieren </b>

              </div>
                    <div class="card-body">
                <form id="supportForm" action="{{route('user.accountupdate',$user->id)}}" method="post" enctype="multipart/form-data">
                   
                    @csrf
                   
                  
                  <div class="form-group">
                    <label for="">Vorname</label>
                    <input type="text" name="first_name" class="form-control" id="exampleInputTitle" placeholder="Vorname" value="{{$user->first_name}}">
                  </div>
                  <div class="form-group">
                    <label for="">Nachname</label>
                    <input type="text" name="last_name" class="form-control" id="exampleInputTitle" placeholder="Nachname" value="{{$user->last_name}}">
                  </div>
                    <br>
                 <div class="form-group">
                    <label for="">Foto Hochladen</label>
                    <input type="file" name="photo" class="form-control" id="attachment" placeholder="upload your photo" value="{{$user->photo}}">
                  </div> 
                    <div id="file-error" style="color:red; font-size: 14px;"></div>

                <div class="form-group">
             
                    @if($user->photo)
                        <img src="{{ asset('images/users/' . $user->photo) }}" alt="User Photo" style="height: 100px; width: auto;border-radius: 50%;">
                    @else
                    <p style="color:red;font-size:15px;"></p>
                    @endif
                </div>
                   <br>
                 <div class="form-group">
                    <label for="">E-Mail (Konto E-Mail kann nicht geändert werden)</label>
                    <input type="email" name="email" class="form-control" id="exampleInputTitle" placeholder="Enter Email" value="{{$user->email}}" disabled>
                        
                     </div>
                    

                    

                    
                 <div class="form-group">
                    <label for="">Telefon</label>
                    <input type="text" name="phone" class="form-control" id="exampleInputTitle" placeholder="Telefon" value="{{$user->phone}}">
                  </div>
                     
                    <br>
                    <hr>
                     <b id="pass">Kontokennwort ändern </b>
                     <hr>
              
                     <!-- Password Update Section -->
            <div class="form-group">
                <label for="oldpassword">Aktuelles Passwort</label>
                <input type="password" name="oldpassword" class="form-control" placeholder="Aktuelles Passwort eingeben">
            </div>

            <div class="form-group">
                <label for="newpassword">Neues Passwort</label>
                <input type="password" name="newpassword" class="form-control" placeholder="Neues Passwort eingeben">
            </div>
 
                     <br>

                <div class="form-group">
                 
                    <button type="submit" class="btn btn-dark" style="width:200px;">Aktualisieren</button>
                        
                     </div>
                   
                     </form> 
                  
                  
              </div>
                
        
                    
            
                        
                  </div> <!-- card body -->
                    
                    </div> <!-- card -->
                      </div> <!-- /.col 8-->
             
                       
             <div class="col-md-3">
                
                
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
        <div class="row" style="margin-top: 80px;">
            
            
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




</div>
<!-- ./wrapper -->
       
       
       <style>
           

  

  

       </style>
       
      @endsection
      
      
      
       @section('scripts')
 


<script>
$('#supportForm').on('submit', function(e) {
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
