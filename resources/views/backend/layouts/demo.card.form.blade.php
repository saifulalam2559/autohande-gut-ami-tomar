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
                        <h2 class="float-left">Create</h2>
                    </div>
                    
                    <div class="col-md-6">
                        <a style="color:#fff;" href="" class="float-right btn btn-dark">Add User</a>
                    </div>
                    
                </div>
              </div>
               
             
              <!-- /.card-header -->
                    <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                  
                  
                                 
                  <div class="form-group">
                    <label for="">Kaufgesuchesbranches Name</label>
                    <input type="text" name="kaufgesuche_branche_title" class="form-control" id="exampleInputTitle" placeholder="Bitte schreiben Sie kaufgesuchesbranches name" value="">
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



 @endsection
 
 
 <style>
     

 
 </style>
 
 
 @section('scripts')
 

 
 

 


 
 @endsection
