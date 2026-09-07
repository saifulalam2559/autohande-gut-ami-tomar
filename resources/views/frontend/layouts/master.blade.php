<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

  <!--Start Head -->

  @include('frontend.layouts.header')
  <!-- End Head -->

<body class="body header-fixed">
    
    

    <div class="preload preload-container">
        <div class="middle">
        </div>
    </div>

    <!-- /preload -->

    <div id="wrapper">
        <div id="pagee" class="clearfix">
            
            

            <!-- Main Header 3-->
           @include('frontend.layouts.nav')
            <!-- End Main Header 3-->
            
            
            


            
             <!-- main part  -->
              @yield('content')  
            <!-- end main part  -->


            <!-- Footer -->
              @include('frontend.layouts.footer')
            <!-- end Footer -->
    
    
     @include('frontend.layouts.footerjs')

</body>

</html>