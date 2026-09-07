       @extends('backend.layouts.master')
       @section('content')
       
       
       <div class="container-fluid">

       <div class="row userindex">
          <div class="col-12">
              @include('backend.layouts.notification')
              



              <div class="card" >
              <div class="card-header">
                
                  <b>My Order</b>
              </div>
              <!-- /.card-header -->

          <div class="card-body">
                            <form action="{{route('traclocation')}}" method="post">
                            @csrf
                                
                      
                            <div class="form-group col col-6">

                                <label for="">Tracking Number </label>
                                <input type="text" name="Tracking_Number" class="form-control" id="exampleInputTitle" value="" require  placeholder="Enter your Tracking Number (7777777770)">
                                <br>
                                <button type="submit" class="btn btn-primary" style="width:200px;">Track</button>   
                            </div>
                          
                            </form>
              
                       <div class="row">
                           
                           <div class="col-md-6">
                               
                                   <ul>
                                   <?php
if (isset($response) && isset($response['shipments'][0]['events']) && is_array($response['shipments'][0]['events']) && count($response['shipments'][0]['events']) > 0) {
    $data = $response;

    foreach ($data['shipments'][0]['events'] as $key => $row) {
?>

        <li class="list-group-item list-group-item-success" style="background-color: #3fb75b;padding: 20px 20px 20px 20px;font-size: 16px;">
            <span><strong>Date Time : </strong> <?php echo($row['timestamp']); ?></span><br>
            <span><strong>Status Code : </strong><?php echo($row['statusCode']); ?></span><br>
            <span><strong>Status : </strong><?php echo($row['status']); ?></span><br>
            <span><strong>Description : </strong><?php  if(isset($row['description'])){
                echo(($row['description']));
            } ?></span><br>
            <span><strong>Address : </strong> <?php  if(isset($row['location'])){
                echo(($row['location']['address']['countryCode'])." | ");
                echo(($row['location']['address']['postalCode'])." | ");
                echo(($row['location']['address']['addressLocality']));
            } ?></span>
        </li>

<?php
    }
} elseif (isset($response)) { 
    // Only show this message after form submission, not on the initial page load
?>
    <li class="list-group-item list-group-item-warning" style="background-color: #f8d7da;padding: 20px 20px 20px 20px;font-size: 16px;">
        <span><strong>Tracking Information Not Available.</strong> Please check again later.</span>
    </li>
<?php
}
?>



            </ul>
                               
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
     
       <style>
           
 
    
    

           
           </style>
      
       @endsection
       
       
       
       
       
       @section('scripts')






@endsection