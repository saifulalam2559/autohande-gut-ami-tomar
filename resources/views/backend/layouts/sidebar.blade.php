
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <div class="sidebar-heading">
    <img src="{{ asset('images/nlogo.png') }}" alt="Naim Autohandel" class="sidebar-logo">

  
</div>
    
        <div class="list-group list-group-flush">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item list-group-item list-group-item-action" id="home-link">
                <i class="fas fa-home"></i> Home
            </a>
            <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu11" aria-expanded="false" aria-controls="submenu11" id="profile-link">
                <i class="fas fa-user"></i> User
            </a>
            <div class="collapse submenu" id="submenu11">
                <a href="{{ route('usermanagement.index') }}" class="list-group-item list-group-item-action" id="1-link"><i class="fas fa-eye"></i> All User</a>
                <a href="{{ route('usermanagement.create') }}" class="list-group-item list-group-item-action" id="2-link"><i class="fas fa-edit"></i> Add User</a>
            </div>
            
           <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu39" aria-expanded="false" aria-controls="submenu39" id="profile-link">
                 <i class="fas fa-car"></i> Auto POST
            </a>
            <div class="collapse submenu" id="submenu39">
                <a href="{{ route('auto.index') }}" class="list-group-item list-group-item-action" id="1-link"><i class="fas fa-eye"></i> Auto </a>
                <a href="{{ route('auto.create') }}" class="list-group-item list-group-item-action" id="2-link"><i class="fas fa-edit"></i> Add Auto </a>
            </div>
            
            

            

            <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu111" aria-expanded="false" aria-controls="submenu111" id="profile-link">
                 <i class="fas fa-car-side"></i> Brand
            </a>
            <div class="collapse submenu" id="submenu111">
                <a href="{{ route('marke.index') }}" class="list-group-item list-group-item-action" id="1-link"><i class="fas fa-eye"></i> All Brand</a>
                <a href="{{ route('marke.create') }}" class="list-group-item list-group-item-action" id="2-link"><i class="fas fa-edit"></i> Add Brand</a>
            </div>
            
             <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu15" aria-expanded="false" aria-controls="submenu15" id="profile-link">
                <i class="fas fa-car-side"></i> Model
            </a>
            <div class="collapse submenu" id="submenu15">
                <a href="{{ route('modell.index') }}" class="list-group-item list-group-item-action" id="1-link"><i class="fas fa-eye"></i> All Model</a>
                <a href="{{ route('modell.create') }}" class="list-group-item list-group-item-action" id="2-link"><i class="fas fa-edit"></i> Add Model</a>
            </div>
            
             <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu15" aria-expanded="false" aria-controls="submenu15" id="profile-link">
                <i class="fas fa-plus"></i> Body Type
            </a>
            <div class="collapse submenu" id="submenu15">
                <a href="{{ route('fahrzeugtyp.index') }}" class="list-group-item list-group-item-action" id="1-link"><i class="fas fa-eye"></i> All BodyType</a>
                <a href="{{ route('fahrzeugtyp.create') }}" class="list-group-item list-group-item-action" id="2-link"><i class="fas fa-edit"></i> Add BodyType</a>
            </div>
            
            
            <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu16" aria-expanded="false" aria-controls="submenu16" id="profile-link">
                <i class="fas fa-gas-pump"></i> Fuel Type
            </a>
            <div class="collapse submenu" id="submenu16">
                <a href="{{ route('kraftstoffart.index') }}" class="list-group-item list-group-item-action" id="1-link"><i class="fas fa-eye"></i> All Fuel Type</a>
                <a href="{{ route('kraftstoffart.create') }}" class="list-group-item list-group-item-action" id="2-link"><i class="fas fa-edit"></i> Add Fuel Type</a>
            </div>
            
            
           <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu17" aria-expanded="false" aria-controls="submenu17" id="profile-link">
                 <i class="fas fa-cogs"></i> Transmission
            </a>
            <div class="collapse submenu" id="submenu17">
                <a href="{{ route('getriebe.index') }}" class="list-group-item list-group-item-action" id="1-link"><i class="fas fa-eye"></i> All Transmission</a>
                <a href="{{ route('getriebe.create') }}" class="list-group-item list-group-item-action" id="2-link"><i class="fas fa-edit"></i> Add Transmission</a>
            </div>
            
            
            <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu18" aria-expanded="false" aria-controls="submenu18" id="profile-link">
                 <i class="fas fa-palette"></i> Color
            </a>
            <div class="collapse submenu" id="submenu18">
                <a href="{{ route('color.index') }}" class="list-group-item list-group-item-action" id="1-link"><i class="fas fa-eye"></i> All Color</a>
                <a href="{{ route('color.create') }}" class="list-group-item list-group-item-action" id="2-link"><i class="fas fa-edit"></i> Add Color</a>
            </div>

            
            <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu18" aria-expanded="false" aria-controls="submenu18" id="profile-link">
                 <i class="fas fa-car-crash"></i> Vehicle Condition
            </a>
            <div class="collapse submenu" id="submenu18">
                <a href="{{ route('fahrzeugzustand.index') }}" class="list-group-item list-group-item-action" id="1-link"><i class="fas fa-eye"></i> Vehicle Condition</a>
                <a href="{{ route('fahrzeugzustand.create') }}" class="list-group-item list-group-item-action" id="2-link"><i class="fas fa-edit"></i> Add Vehicle Condition</a>
            </div>
            
            
          <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu19" aria-expanded="false" aria-controls="submenu19" id="profile-link">
                <i class="fas fa-leaf"></i> Emission Class
            </a>
            <div class="collapse submenu" id="submenu19">
                <a href="{{ route('schadstoffklasse.index') }}" class="list-group-item list-group-item-action" id="1-link"><i class="fas fa-eye"></i> Emission Class</a>
                <a href="{{ route('schadstoffklasse.create') }}" class="list-group-item list-group-item-action" id="2-link"><i class="fas fa-edit"></i> Add Emission Class</a>
            </div>
            
            
            
            <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu35" aria-expanded="false" aria-controls="submenu35" id="profile-link">
                <i class="fas fa-layer-group"></i> Feature Category
            </a>
            <div class="collapse submenu" id="submenu35">
                <a href="{{ route('ausstattungcategory.index') }}" class="list-group-item list-group-item-action" id="1-link"><i class="fas fa-eye"></i> Feature Category</a>
                <a href="{{ route('ausstattungcategory.create') }}" class="list-group-item list-group-item-action" id="2-link"><i class="fas fa-edit"></i> Add FeatureCategory</a>
            </div>
            
            
           <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu30" aria-expanded="false" aria-controls="submenu30" id="profile-link">
                <i class="fas fa-tools"></i> features
            </a>
            <div class="collapse submenu" id="submenu30">
                <a href="{{ route('ausstattung.index') }}" class="list-group-item list-group-item-action" id="1-link"><i class="fas fa-eye"></i> features</a>
                <a href="{{ route('ausstattung.create') }}" class="list-group-item list-group-item-action" id="2-link"><i class="fas fa-edit"></i> Add features</a>
            </div>
            
            
            
           <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu39" aria-expanded="false" aria-controls="submenu39" id="profile-link">
                 <i class="fas fa-images"></i>  Auto Images
            </a>
            <div class="collapse submenu" id="submenu39">
                <a href="{{ route('autobilder.index') }}" class="list-group-item list-group-item-action" id="1-link"><i class="fas fa-eye"></i> Auto Image</a>
                <a href="{{ route('autobilder.create') }}" class="list-group-item list-group-item-action" id="2-link"><i class="fas fa-edit"></i> Add Auto Image</a>
            </div>
            
            

            

            <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu112" aria-expanded="false" aria-controls="submenu112" id="profile-link">
                <i class="fas fa-user"></i> Test 2
            </a>
            <div class="collapse submenu" id="submenu112">
                <a href="#" class="list-group-item list-group-item-action" id="1-link"><i class="fas fa-eye"></i> All Test 2</a>
                <a href="#" class="list-group-item list-group-item-action" id="2-link"><i class="fas fa-edit"></i> Add Test 2</a>
            </div>

     
          
            <a href="{{route('logout')}}" class="sidebar-item list-group-item list-group-item-action" id="logout-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->