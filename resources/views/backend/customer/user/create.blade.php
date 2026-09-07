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
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add User</li>
            </ol>
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
                <h3 class="card-title">User Creation</h3>
                <h3 class="float-right btn btn-success"><a style="color:#fff;" href="{{route('usermanagement.index')}}">All User</a></h3>
              </div>
                    <div class="card-body">
                <form action="{{route('usermanagement.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                  
                  <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputTitle" placeholder="Enter Name" value="{{old('name')}}">
                  </div>
                  <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputTitle" placeholder="Enter User Name" value="{{old('username')}}">
                  </div>
                  
                 <div class="form-group">
                    <label for="">Photo Upload</label>
                    <input type="file" name="photo" class="form-control" id="exampleInputTitle" placeholder="upload your photo" value="">
                  </div>
                  
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
                    
 
                  
                  <div class="form-group">
                    <label for="">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option value="">--Role--</option>
                        <option value="admin" {{old('role') == 'admin' ? 'selected' : ''}}>Admin </option>
                        <option value="seller"  {{old('role') == 'seller' ? 'selected' : ''}}> Seller </option>
                         <option value="customer"  {{old('role') == 'customer' ? 'selected' : ''}}> Customer </option>
                    </select>
                   </div>


                       <div class="form-group">
                    <label for="">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="">--Status--</option>
                        <option value="active" {{old('status') == 'active' ? 'selected' : ''}}>Active </option>
                        <option value="inactive"  {{old('status') == 'inactive' ? 'selected' : ''}}> Inactive </option>
                    </select>
                   </div>     


                <div class="form-group">
                 
                    <button type="submit" class="btn btn-primary" style="width:200px;">Submit</button>
                        
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