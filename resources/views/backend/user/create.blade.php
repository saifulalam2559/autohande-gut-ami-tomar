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
                <h3>Add User</h3><br>
              
        
                <div class="card">
                    <div class="card-header">
                        
                        @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

                <h3 class="card-title">User Creation</h3>
                <h3 class="float-right btn btn-dark"><a style="color:#fff;" href="{{route('usermanagement.index')}}">All User</a></h3>
              </div>
                    <div class="card-body">
                <form action="{{route('usermanagement.store')}}" id="userForm" method="post" enctype="multipart/form-data">
                    @csrf
                  
                  <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="exampleInputTitle" placeholder="Enter first Name" value="{{old('first_name')}}">
                  </div>
                  <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="exampleInputTitle" placeholder="Enter last Name" value="{{old('last_name')}}">
                  </div>
                  
                 <div class="form-group">
                    <label for="">Photo Upload</label>
                    <input type="file" name="photo" class="form-control" id="attachment" placeholder="upload your photo" value="">
                  </div>
                   <div id="file-error" style="color:red; font-size: 14px;"></div>
                 <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputTitle" placeholder="Enter Email" value="{{old('email')}}">
                        
                     </div>
                    
                   <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputTitle" placeholder="Enter Password" >
                        
                     </div>
                    
                 <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" name="phone" class="form-control" id="exampleInputTitle" placeholder="Enter Phone" value="{{old('phone')}}">
                  </div>
                     <div id="file-error" style="color:red; font-size: 14px;"></div>
 
                  
                  <div class="form-group">
                    <label for="">Role</label>
                    <select class="form-control my-select" id="role" name="role">
                        <option value="">--Role--</option>
                        <option value="admin" {{old('role') == 'admin' ? 'selected' : ''}}>Admin </option>
                    
                    </select>
                   </div>


                       <div class="form-group">
                    <label for="">Status</label>
                    <select class="form-control my-select" id="status" name="status">
                        <option value="">--Status--</option>
                        <option value="active" {{old('status') == 'active' ? 'selected' : ''}}>Active </option>
                        <option value="inactive"  {{old('status') == 'inactive' ? 'selected' : ''}}> Inactive </option>
                    </select>
                   </div>     


                <div class="form-group">
                 
                    <button type="submit" class="btn btn-dark" style="width:200px;">Submit</button>
                        
                     </div>
                   
                  
                  
                  
              </div>
                
        
                    
                </form>
                        
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
$('#userForm').on('submit', function(e) {
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
