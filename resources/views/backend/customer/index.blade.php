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
                <h3 class="float-left">Willkommen zurück, {{$user->first_name}}&nbsp; {{$user->last_name}}</h3>

              </div>
                    <div class="card-body">
                        
                           <div class="row">
                      <div class="col-md-12">



                      </div>
                     
                  </div>              
                        
                          <div id="useraccount" class="row ">

        
                <div class="col-md-12 " style="background:#fff;padding: 20px 20px 20px 20px;font-size: 18px;">
                 
                 Hier sehen Sie links Ihren "Mein Konto", "Meine Wunschliste", "Meine Adressen" und "Meine Bestellungen". 
                 <br><br>
                <ul>

 <li>Sie können Ihre Persönliche Daten unter 'Mein Konto' jederzeit einsehen und ändern.  </li>
  <li>Unter "Meine Adressen" können Sie Ihre am häufigsten verwendeten Rechnungs- und Versandadressen verwalten. </li>
  <li>Unter "Meine Bestellungen" finden Sie eine Übersicht Ihre aktuellen und vorausgegangenen Bestellungen. </li>
  <li>Unter "Meine Wunschliste" finden Sie eine Übersicht Ihrer Lieblingsartikel.</li>

 </ul>
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
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
    
    
#useraccount ul {
    list-style: none; /* Remove default bullets */
    padding: 0;
}

#useraccount ul li {
    display: flex;
    align-items: center; /* Ensures vertical centering */
    gap: 8px; /* Space between square and text */
}

#useraccount ul li::before {
    content: "☞"; /* Custom square */
    color: black; /* Change color if needed */
    font-size: 1.8em; /* Adjust size */
    line-height: 1; /* Prevents extra spacing */
    display: flex;
    align-items: center;
    justify-content: center;
    width: 1.2em; /* Fixed width for consistency */
    flex-shrink: 0; /* Prevents shrinking when text wraps */
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
       
       
       
          @endsection