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
               


       
                <div class="card">
                    <div class="card-header">
                <b>Konto löschen </b>

              </div>
                    <div class="card-body">
                        
                        <p style="color:red;font-size:18px;">
                            Das Löschen Ihres Kontos ist endgültig. Wenn Sie Ihr Konto löschen, werden alle mit Ihrem Konto verknüpften Informationen gelöscht.
                            Sie können Ihren Bestellverlauf nicht mehr anzeigen und auch keine Kaufnachweise oder Rechnungen ausdrucken.<br><br>

                            Nach der Löschung können wir Ihnen dann keine Services mehr bereitstellen. <br><br>
                        </p>
                        
               <form action="{{ route('useraccount.delete') }}" method="POST">
        @csrf
     

        <div class="form-group mt-3">
            <label>Bitte geben Sie Ihr Passwort ein<br><!-- comment -->
          <p style="color:red;font-size:18px;"> ( Geben Sie Ihr Kennwort ein, um Ihre Identität zu bestätigen, und Klicken Sie auf die Schaltfläche "Mein Konto löschen", um die Kontolöschung abzuschließen. )</p>
            </label>
            <input type="password" name="password" class="form-control" required>
        </div>
        
                <div class="form-group mt-3">
            <label>
         Optional können Sie einen Grund für die Löschung Ihres Accounts nennen.
            </label>
           <textarea name="reason" id="reason" class="form-control" rows="4" placeholder="Grund für die Kontolöschung (optional)"></textarea>

        </div>

        <button type="submit" class=" btn btn-danger mt-3">Mein Konto löschen</button>
        <a href="{{ route('userIndex') }}" class="btn btn-secondary mt-3">Abbrechen</a>
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