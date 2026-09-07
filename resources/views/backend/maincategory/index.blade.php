@extends('backend.layouts.master')
@section('content')

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('backend.layouts.notification')
            


            <div class="card">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="float-left">All Category ({{$maincategory->total()}})</h3>
                    </div>
                    <div class="col-md-6">
                        <a style="color:#fff;" href="{{route('maincategory.create')}}" class="float-right btn btn-dark">Add Category</a>
                    </div>
                </div>
                  
                  <form method="GET" action="{{ route('maincategory.index') }}">
    <div class="row mb-4">
        <div class="col-md-4">
            <input type="text" name="name" class="form-control" placeholder="Search by Name" value="{{ request('name') }}">
        </div>
        <div class="col-md-4">
            <select name="status" class="form-control my-select">
                <option value="">All Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary mr-2">Search</button>
            <a href="{{ route('maincategory.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>

              </div>
              <div class="card-body">
                <table id="example1x" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th class="sno">S.No</th>
                      <th class="subcc1">Name</th>
                      <th class="subcc2yy">Slug</th>
                      <th class="subcc2x">Active</th>
                      <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $crn = ($maincategory->currentpage()-1)* $maincategory->perpage() + 1; ?>  
                  @foreach($maincategory as $row)
                  <tr>
                      <td style="width:50px;"> {{$crn++}}</td>
                      <td>{{$row->name}} </td>
                      <td>{{$row->slug}}</td>
                      <td>
<div class="custom-switch">
    <input type="checkbox"
           id="toggleSwitch_{{ $row->id }}"
           class="toggle-input"
           data-id="{{ $row->id }}"
           {{ $row->status == 'active' ? 'checked' : '' }}>

    <label for="toggleSwitch_{{ $row->id }}" class="toggle-slider"></label>
</div>

<label id="statusLabel_{{ $row->id }}" class="status-label">
    <span>{{ $row->status == 'active' ? 'Active' : 'Inactive' }}</span>
</label>


</td>

                      <td>
                          <a href="{{route('maincategory.edit',$row->id)}}" class="float-left  ml-2 btn btn-sm btn-outline-dark" style="margin-right: 14px;margin-top: 2px;"> <i class="fas fa-edit"></i></a>
             
<form id="deleteForm{{ $row->id }}" 
      action="{{ route('maincategory.destroy', $row->id) }}"
      method="POST">
    @csrf
    @method('DELETE')

    <a href="javascript:void(0)" 
       class="confirmDelete btn btn-sm btn-outline-danger"
       data-id="{{ $row->id }}">
        <i class="fas fa-trash-alt"></i>
    </a>
</form>





                      </td>
                  </tr>
                  @endforeach
                  
                  @if($maincategory->count() == 0)
                        <tr>
                            <td colspan="5" class="text-center">No main category found.</td>
                        </tr>
                    @endif

                  </tbody>
                </table>
                <h5 style="color:red;padding-top: 15px;">Current Page {{$maincategory->currentPage()}} row from {{$maincategory->firstItem()}} to row {{$maincategory->lastItem()}}</h5>
                {{$maincategory->appends($_GET)->links('pagination-links')}} 
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<style>
 



</style>

@endsection


@section('scripts')

@if(session('delete_success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Gelöscht!',
    text: '{{ session("delete_success") }}',
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Error!',
    text: '{{ session("error") }}',
});
</script>
@endif





<script>

$(document).on('change', '.toggle-input', function () {

    let id = $(this).data('id');
    let mode = $(this).is(':checked') ? 'true' : 'false';

    // Update label instantly
    $('#statusLabel_' + id).html(
        `<span>${mode === 'true' ? 'Active' : 'Inactive'}</span>`
    );

    $.ajax({
        url: "{{ route('MainCategorystatus') }}",
        method: "POST",
        data: {
            id: id,
            modeAdminControl: mode,
            _token: "{{ csrf_token() }}"
        },
        success: function (response) {

            Swal.fire({
                icon: "success",
                title: "Status Updated",
                text: response.msg,
                timer: 1500,
                showConfirmButton: false
            });
        },
        error: function () {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Something went wrong"
            });
        }
    });

});

</script>

@endsection
