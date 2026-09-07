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
           
           
             
             
          <div class="col-12">
             
                @include('backend.layouts.notification')
         
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="float-left"> All Main Category</h3>
                    </div>
                    
                    <div class="col-md-6">
                        <a style="color:#fff;" href="" class="float-right btn btn-dark">Add User</a>
                    </div>
                    
                </div>
              </div>
               
             
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1x" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Full Name</th>
                    <th>Role</th>
                    <th>Photo</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      
      
                  <tr>
                     <td></td>
                    <td></td>
                    <td></td>
             
                    <td><img src="" style="max-height: 90px; max-width: 90px;border-radius: 50%;"> </td>
                      <td></td>
                       <td></td>
                        <td></td>
       
                    <td>
                        
                    </td>
                    <td>
                         
                    </td>
                   
                   
                  </tbody>
           
                </table>
                  
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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



 @endsection
 
 
 <style>
     

 
 </style>
 
 
 @section('scripts')
 

 
 

 


 
 @endsection
