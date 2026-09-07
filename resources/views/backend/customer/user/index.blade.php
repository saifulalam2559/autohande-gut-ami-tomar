       @extends('backend.layouts.master')
       @section('content')
       
       
       <div class="container-fluid">

       <div class="row userindex">
          <div class="col-12">
              @include('backend.layouts.notification')
              
              
               






          
              


 @foreach($user as $row)
              <div class="card" >
              <div class="card-header">
                
                 <b>Mein Konto</b>
                  <a style="color:#fff;" class="float-right btn btn-dark" href="{{route('edit.user.account',$row->id)}}">Konto bearbeiten</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  

                  
                  <div class="row">
                      <div class="col-md-2">
                          Kndennummer:
                      </div>
                      
                      <div class="col-md-10">
                          <b>{{$row->kundennummer}}  </b> 
                      </div>
                      
                  </div>  
                  <br>
                  <div class="row">
                      <div class="col-md-2">
                          Name:
                      </div>
                      
                      <div class="col-md-10">
                         {{$row->first_name}}  {{$row->last_name}}
                      </div>
                      
                  </div>  
                   <br>
                   <div class="row">
                      <div class="col-md-2">
                          E-Mail:
                      </div>
                      
                      <div class="col-md-10">
                         {{$row->email}}  
                      </div>
                      
                  </div> 
                   
                    <br>
                    <div class="row">
                      <div class="col-md-2">
                          Telefon:
                      </div>
                      
                      <div class="col-md-10">
                         {{$row->phone}}  
                      </div>
                      
                  </div> 
                   
                                      <br>
                   <div class="row">
                      <div class="col-md-2">
                          Foto:
                      </div>
                      
                      <div class="col-md-10">
                          
                     
                          
                    @if($row->photo)
                        <img src="{{ asset('images/users/' . $row->photo) }}" alt="User Photo" style="height: 100px; width: auto;border-radius: 50%;">
                    @else
                         <img src="{{asset('frontend/images/userprofile.jpg')}}" style="height: 50px; width: auto;border-radius: 50%;">
                    @endif
                    
                          
                       <a href="{{route('edit.user.account',$row->id)}}"  data-toggle="tooltip" title="edit" data-placement="bottom" class=" ml-2 btn btn-sm btn-outline-dark"> <i class="fas fa-edit"></i></a>
                      
                         
                      </div>
                      
                  </div> 
                                      
                             <br>
                   <div class="row">
                      <div class="col-md-2">
                          2FA deaktivieren<br>
oder aktivieren:
                      </div>
                      
                      <div class="col-md-10">
                                @if($row->two_factor_enabled)
            <form id="disable2fa-form-{{ $row->id }}" action="{{ route('dashboard.customerdisable2fa', $row->id) }}" method="POST">
                @csrf
                <button type="button" class="btn btn-info" onclick="confirmDisable2FA({{ $row->id }})">2FA aktiviert</button> <br>
            </form>
        @else
            <form id="enable2fa-form-{{ $row->id }}" action="{{ route('dashboard.customerenable2fa', $row->id) }}" method="POST">
                @csrf
                <button type="button" class="btn btn-danger" onclick="confirmEnable2FA({{ $row->id }})">2FA deaktiviert</button><br>
            </form>
        @endif
                      </div>
                      
                  </div> 
                             
        
                                

                                    
                                      
                 
                 <br>                                 
               
                   <div class="row">
                      <div class="col-md-2">
                          Anmeldekennwort ändern:
                      </div>
                      
                      <div class="col-md-10">
                           
                       <a href="{{route('edit.user.account',$row->id)}}/#pass"  data-toggle="tooltip" title="edit" data-placement="bottom" class=" ml-2 btn btn-sm btn-outline-dark"> <i class="fas fa-edit"></i></a>
                         
                      </div>
                      
                  </div> 
                                                                                      
      <br>

  
                 
                     <div class="row">
                      <div class="col-md-2">
                           <i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:#ffc106;font-size:27px;"></i>
                          Konto löschen:
                         
                      </div>
                      
                      <div class="col-md-10">
                                                   
                        
                              <p style="font-size:20px;line-height:25px;">Das Löschen Ihres Kontos ist endgültig. Wenn Sie Ihr Konto löschen, werden alle mit Ihrem Konto verknüpften Informationen gelöscht.<br> Sie können Ihren Bestellverlauf nicht mehr anzeigen und auch keine Kaufnachweise oder Rechnungen ausdrucken.</p>
               
                          
                          <a href="{{route('useraccount.delete.form', $row->id)}}"  class=" btn btn-sm btn-outline-danger">Konto löschen</a>
                         
                          <br>
                          <br>
                         
                      </div>
                      
                  </div>  
                  
                @endforeach
                  
             
                
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

<script>
    $(document).ready(function () {
        $('input[name=toggleUserControl]').change(function () {
            var isChecked = $(this).prop('checked');
            var id = $(this).val();
            var statusLabel = $('#statusLabel_' + id);
            
            // Update status label based on the switch state
            var newStatus = isChecked ? 'Active' : 'Inactive';
            
            // Confirm action with the user
            var confirmation = confirm('Are you sure you want to ' + (isChecked ? 'activate' : 'deactivate') + ' this item?');

            if (confirmation) {
                // Proceed with the AJAX request
                $.ajax({
                    url: "{{ route('user.status') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        modeAdminControl: isChecked,
                        id: id
                    },
                    success: function (res) {
                        if (res.status) {
                            alert(res.msg); // Alert success message
                            statusLabel.text(newStatus); // Update the status label
                        } else {
                            alert('Failed to update status'); // Alert failure message
                        }
                    },
                    error: function () {
                        alert('An error occurred while processing your request'); // Alert error message
                        // Revert the switch if the request fails
                        $('input[name=toggleAdminControl][value=' + id + ']').prop('checked', !isChecked);
                    }
                });
            } else {
                // Revert the switch if user cancels
                $(this).prop('checked', !isChecked);
            }
        });
    });
</script>


<script>
    // Function for enabling 2FA confirmation
    function confirmEnable2FA(id) {
        Swal.fire({
            title: '2FA aktivieren?',
            text: "Möchten Sie die Zwei-Faktor Authentifizierung wirklich aktivieren?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ja, aktivieren Sie es!',
            cancelButtonText: 'Abbrechen' // Change "Cancel" button text here
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('enable2fa-form-' + id).submit();
            }
        });
    }

    // Function for disabling 2FA confirmation
    function confirmDisable2FA(id) {
        Swal.fire({
            title: '2FA deaktivieren?',
            text: "Möchten Sie die Zwei-Faktor Authentifizierung wirklich deaktivieren?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ja, deaktiviere es!',
            cancelButtonText: 'Abbrechen' // Change "Cancel" button text here
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('disable2fa-form-' + id).submit();
            }
        });
    }
</script>




@endsection