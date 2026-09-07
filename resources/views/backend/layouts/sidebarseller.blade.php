
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <div class="sidebar-heading">EESTIL Store</div>
        <div class="list-group list-group-flush">
            <a href="" class="sidebar-item list-group-item list-group-item-action" id="home-link">
                <i class="fas fa-home"></i> Home
            </a>
            <a href="#" class="sidebar-item list-group-item list-group-item-action" data-toggle="collapse" data-target="#submenu11" aria-expanded="false" aria-controls="submenu11" id="profile-link">
                <i class="fas fa-user"></i> Profile
            </a>
            <div class="collapse submenu" id="submenu11">
                <a href="#" class="list-group-item list-group-item-action" id="all-main-category-link"><i class="fas fa-eye"></i> All User</a>
                <a href="#" class="list-group-item list-group-item-action" id="add-main-category-link"><i class="fas fa-edit"></i> Add User</a>
            </div>
            
            
           
            
            
            
            <a href="{{route('logout')}}" class="sidebar-item list-group-item list-group-item-action" id="logout-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->