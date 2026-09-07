       @extends('backend.layouts.master')
       @section('content')
       
       
       <div class="container-fluid">

       <div class="row userindex">
          <div class="col-12">
              @include('backend.layouts.notification')
              



            <div class="card">
              <div class="card-header">
                  <h3 class="float-left">All User ({{$users->total()}})</h3>
               <h3 class="float-right btn btn-dark"><a style="color:#fff;" href="{{route('usermanagement.create')}}">Add User</a></h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  
<form action="{{ route('admin.user.search') }}" method="GET">
    <div class="row">
        <div class="col-md-2">
            <input type="text" id="kundennummer_search" name="kundennummer" class="form-control" placeholder="Search by Kundennummer" value="{{ request('kundennummer') }}">
        </div>
        <div class="col-md-2">
            <input type="text" id="email_search" name="email" class="form-control" placeholder="Search by Email" value="{{ request('email') }}">
        </div>
        
<div class="col-md-2">
    <select name="has_admin_note" class="form-control my-select">
        <option disabled selected>Admin Note</option>
        <option value="yes" {{ request('has_admin_note') == 'yes' ? 'selected' : '' }}>Has Note</option>
        <option value="no" {{ request('has_admin_note') == 'no' ? 'selected' : '' }}>No Note</option>
    </select>
</div>

        
        <div class="col-md-2">
    <select name="status" class="form-control  my-select">
        <option disabled="" selected="" >Status</option>
        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
</div>
<div class="col-md-2">
    <select name="email_verified_at" class="form-control  my-select">
        <option disabled="" selected="" >Email Verified </option>
        <option value="yes" {{ request('email_verified_at') == 'yes' ? 'selected' : '' }}>Yes</option>
        <option value="no" {{ request('email_verified_at') == 'no' ? 'selected' : '' }}>No</option>
    </select>
</div>

        <div class="col-md-1">
            <button type="submit" class="btn btn-dark w-100">Search</button>
        </div>
         <div class="col-md-1">
            
            <a style="color:#fff;" class="btn btn-secondary" href="{{route('usermanagement.index')}}">Reset </a>
        </div>
    </div>
</form>


                  
                <table id="example1XXXX" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Name</th>
              
                    <th>Email</th>
                    
                    <th>Photo</th>
           
                    <th>Role</th>
                      <th>Click for 2FA <br>Disable and Enable</th>
                    <th>Status</th>
                 <th>Email Verified</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php $crn = ($users->currentpage()-1)* $users->perpage() + 1; ?>  
                      @foreach($users as $row)
                      
                      <tr>
                      <td> {{$crn++}}</td>
                      <td>
                          {{$row->first_name}} {{$row->last_name}}
                          @if($row->admin_note != NULL)
<br>
    <span  style="background-color:#eeee90;">{{$row->admin_note}}</span>         


        @else
     
      @endif
                      
                      </td>
                   
                      <td> {{$row->email}}</td>
                      

                      
           <td> 
               
               
                    @if($row->photo)
                       <img src="{{ asset('images/users/' . $row->photo) }}" alt="User Photo" style="height: 100px; width: auto;border-radius: 50%;">
                    @else
                         <img src="{{asset('frontend/images/userprofile.jpg')}}" style="height: 50px; width: auto;border-radius: 50%;">
                    @endif
           </td>         
                
                
           <td> {{$row->role}}</td>
             <td>             
            
            @if($row->two_factor_enabled)
    <form id="disable2faForm_{{ $row->id }}" action="{{ route('dashboard.disable2fa', $row->id) }}" method="POST">
        @csrf
        <button type="button" class="btn btn-info" onclick="confirmDisable2FA({{ $row->id }})">2FA Enabled</button> <br>
    </form>
@else
    <form id="enable2faForm_{{ $row->id }}" action="{{ route('dashboard.enable2fa', $row->id) }}" method="POST">
        @csrf
        <button type="button" class="btn btn-danger" onclick="confirmEnable2FA({{ $row->id }})">2FA Disabled</button><br>
    </form>
@endif


                      
                      </td>
                      

                      
                      <td>
                           <!-- Custom Toggle Switch -->
    <div class="custom-switch">
        <input type="checkbox" id="toggleSwitch_{{$row->id}}" name="toggleUserControl" value="{{$row->id}}" {{ $row->status == 'active' ? 'checked' : '' }}>
        <label for="toggleSwitch_{{$row->id}}" class="switch-slider"></label>
    </div>
    <!-- Display the status label -->
    <label id="statusLabel_{{$row->id}}" class="status-label">
        <span style="width:150px;"> {{ $row->status == 'active' ? 'Active' : 'Inactive' }}</span>
    </label>
            </td>           
                      
                                  <td> 
                      @if($row->email_verified_at === NULL)
                      <button type="button" class="btn btn-danger" >Nein</button>
                      @else
                      <button type="button" class="btn btn-success" >Ja</button>
                      @endif
                      </td>         
                      
                      
                      
                      <td> 
                          

                       <a href="{{route('usermanagement.edit',$row->id)}}"  data-toggle="tooltip" title="edit" data-placement="bottom" class="float-left  ml-2 btn btn-sm btn-outline-dark"> <i class="fas fa-edit"></i></a>

                       <form action="{{ route('usermanagement.destroy', $row->id) }}" method="POST" class="d-inline delete-form ml-2">
                            @csrf
                            @method('DELETE')

                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                      
                      </td>
                      
                       <!-- Modal Start-->
                       
                       
                       <!-- Modal wider class modal-lg modal-xl -->
                       
  
                      
                  
                      
                   
                      
                       <!-- Modal End-->
                      
                      </tr>
                
               
     
                  @endforeach
                  </tbody>
                </table>
                <h5 style="color:red;padding-top: 15px;">Current Page {{$users->currentPage()}} row from {{$users->firstItem()}} to row {{$users->lastItem()}}</h5>
                  {{$users->appends($_GET)->links('pagination-links')}} 
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
</div>
     
      
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
                        modeUserControl: isChecked,
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
                        $('input[name=toggleUserControl][value=' + id + ']').prop('checked', !isChecked);
                    }
                });
            } else {
                // Revert the switch if user cancels
                $(this).prop('checked', !isChecked);
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDisable2FA(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to disable 2FA?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, disable it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('disable2faForm_' + id).submit(); // Submit the form after confirmation
            }
        })
    }

    function confirmEnable2FA(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to enable 2FA?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, enable it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('enable2faForm_' + id).submit(); // Submit the form after confirmation
            }
        })
    }
</script>


<script>
    $(document).ready(function () {
        // Autocomplete for Kundennummer
        $("#kundennummer_search").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "{{ route('admin.user.autocomplete') }}",
                    dataType: "json",
                    data: {
                        term: request.term,
                        field: 'kundennummer' // Send field type as kundennummer
                    },
                    success: function (data) {
                        if (data.length === 0) {
                            // If no data found, show a custom "No data found" message
                            response([{ label: "No data found", value: "" }]);
                        } else {
                            response(data);
                        }
                    }
                });
            },
            minLength: 2
        });

        // Autocomplete for Email
        $("#email_search").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "{{ route('admin.user.autocomplete') }}",
                    dataType: "json",
                    data: {
                        term: request.term,
                        field: 'email' // Send field type as email
                    },
                    success: function (data) {
                        if (data.length === 0) {
                            // If no data found, show a custom "No data found" message
                            response([{ label: "No data found", value: "" }]);
                        } else {
                            response(data);
                        }
                    }
                });
            },
            minLength: 2
        });

        // Reset search fields when reset button is clicked
        $("#reset_search").click(function () {
            // Clear both the search fields
            $("#kundennummer_search").val('');
            $("#email_search").val('');
            // Optionally, reset any displayed autocomplete data if needed
            $("#kundennummer_search").autocomplete("close");
            $("#email_search").autocomplete("close");
        });
    });
</script>



<script>
$(document).ready(function () {

    $('.delete-btn').on('click', function (e) {
        e.preventDefault();

        let form = $(this).closest('form');

        Swal.fire({
            title: 'Are you sure?',
            text: "This user will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });

    });

});
</script>

@endsection