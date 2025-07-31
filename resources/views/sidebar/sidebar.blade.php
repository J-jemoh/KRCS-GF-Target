<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-danger elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      
      <span class="brand-text font-weight-light"><b>KRCS CORPORATE</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       
        <div class="info">
          <a href="#" class="d-block"><b>{{auth()->user()->name}}</b>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{route('admin.dashboard')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
           @can('Department Updates')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p class="text-warning">
                Reports
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{route('department.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Weekly Updates</p>
                </a>
              </li>
              @can('View Reports')
              <li class="nav-item">
                <a href="{{route('department.all')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Weekly Updates</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('weekly.summary')}}" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Report Summary</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcan
          @can('Monthly Highlights')
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p class="text-warning">
                Monthly Highlights
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('Create Highlight')
              <li class="nav-item">
                <a href="{{route('monthly.mine')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Monthly Highlights</p>
                </a>
              </li>
              @endcan
              @can('View Highlights')
              <li class="nav-item">
                <a href="{{route('monthly.all')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Highlights</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('weekly.summary')}}" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Highlight Summary</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
    
        @endcan
        @can('Manage Actions')
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-link"></i>
              <p class="text-warning">
                Management Actions
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('Create Action')
              <li class="nav-item">
                <a href="{{route('keyActions.mine')}}" class="nav-link">
                  <i class="fas fa-bars nav-icon"></i>
                  <p>My Key actions</p>
                </a>
              </li>
              @endcan
              @can('View Actions')
              <li class="nav-item">
                <a href="{{route('keyActions.allactions')}}" class="nav-link">
                  <i class="fas fa-bars nav-icon"></i>
                  <p>All Key Actions</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('keyActions.mysummary')}}" class="nav-link">
                  <i class="fas fa-bars nav-icon"></i>
                  <p>Action Summary</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcan
           @can('Manage Users')
            <li class="nav-item">
            <a href="{{route('admin.regions')}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Regions</p>
            </a>
          </li>
         
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p class="text-warning">
                Manage Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="{{route('admin.users')}}" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Active users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.user.trashed')}}" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Trashed users</p>
                </a>
              </li>
              @can('Manage Roles')
              <li class="nav-item">
                <a href="{{route('admin.users.role.index')}}" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>User Roles</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{route('admin.users.permission.index')}}" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>User Permissions</p>
                </a>
              </li>
              @endcan
            </ul>
              </li>
              <li class="nav-item">
                 <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p class="text-warning">
                    Manage Assets
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('assets.index')}}" class="nav-link">
                          <i class="far fa-user nav-icon"></i>
                          <p>All Assets</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('assets.issued')}}" class="nav-link">
                          <i class="far fa-user nav-icon"></i>
                          <p>Issued Assets</p>
                        </a>
                      </li>
                  </ul>
              </li>

      
           <li class="nav-item {{Request::is('activity*')?' active':''}}">
              <a class="nav-link {{ Request::is('activity') ? 'active' : null }}" href="{{ url('/activity') }}" > <i class="nav-icon fas fa-users-cog"></i>User Activities
              </a>
          </li>
          <li class="nav-item">
                <a href="{{route('admin.db.backup')}}" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Database Backup</p>
                </a>
              </li>
           <li class="nav-item">
                <a href="{{route('admin.manage.settings')}}" class="nav-link">
                  <i class="fa fa-cog nav-icon"></i>
                  <p>Settings</p>
                </a>
              </li>
          @endcan
          <li class="nav-item">
                <a href="{{route('admin.users.profile')}}" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>User Profile</p>
                </a>
              </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="nav-link">
              <i class="fas fa-sign-out-alt nav-icon"></i>
              <p>Logout</p>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                      </form>
            </a>
          </li>
           
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>