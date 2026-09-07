<!DOCTYPE html>
<html lang="en">

  <!--Start Head -->

  @include('backend.layouts.header')
  <!-- End Head -->

<body>

<div id="wrapper">
    
    
    
     <!-- Main Sidebar Container -->
  @if(Auth::check() && Auth::user()->yesAdmin())
  
       @include('backend.layouts.sidebar')
  
  @elseif(Auth::check() && Auth::user()->yesCustomer())
  
        @include('backend.layouts.sidebarcustomer')
        
  @elseif(Auth::check() && Auth::user()->yesSeller())
  
        @include('backend.layouts.sidebarseller')
        
  
  @endif
  
    <!-- end Sidebar -->

    

    <!-- /#sidebar-wrapper -->

    <!-- Page Content tag and nav-->
    <div id="page-content-wrapper">
        @include('backend.layouts.nav')

          <!-- Content Wrapper. Contains page content -->
         @yield('content')
         <!-- /.content-wrapper -->

    </div>
    <!-- /#page-content-wrapper -->

    <!-- Footer -->
    @include('backend.layouts.footer')

   
</body>
</html>
