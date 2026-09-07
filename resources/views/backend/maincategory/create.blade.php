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
           
                   <div class="col-md-2">
                
            </div>    
             
             
          <div class="col-md-8">
             
                @include('backend.layouts.notification')
         
            <!-- /.card body start -->

            <div class="card">
              <div class="card-header">
              

                <div class="row">
                    <div class="col-md-6">
                        <h3 class="float-left">Create  Category</h3>
                    </div>
                    
                    <div class="col-md-6">
                        <a style="color:#fff;" href="{{route('maincategory.index')}}" class="float-right btn btn-dark">All  Category</a>
                    </div>
                    
                </div>
              </div>
               
             
              <!-- /.card-header -->
                    <div class="card-body">
                <form action="{{route('maincategory.store')}}" method="post" enctype="multipart/form-data">
                  
                     @csrf

                        <div class="form-group">
                          <label for=""> Category Name</label>
                          <input type="text" name="name" class="form-control" id="exampleInputTitle" placeholder="Main Category" value="{{old('name')}}">
                        </div>


                              <br>
                      <div class="form-group">

                          <button type="submit" class="btn btn-dark btn-round" style="width:200px;">Senden</button>

                           </div>




                    </div>
                
        
                    
                </form>
                        
              </div> <!-- card body -->
            </div>
            <!-- /.card -->
            
            <div class="col-md-2">
                
            </div>
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

 <style>
     

 
 </style>

 @endsection
 
 

 
 
 @section('scripts')
 

 
 

 


 
 @endsection
