<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      
      <span class="brand-text font-weight-light"><b>KRCS GF SYSTEM</b></span>
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
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p class="text-warning">
                Targets
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.target')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Targets</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.target.all')}}" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>All Targets</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.target.reports')}}" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Reports</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{route('admin.target.template')}}" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Template</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p class="text-warning">
                QPMM
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.qpmm')}}" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>New Upload</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.qpmm.allreports')}}" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>All QPMMS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.reports')}}" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>QPMM Reports</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p class="text-warning">
                HRG
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.hrg.index')}}" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>New Upload</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.hrg.consolidated')}}" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>All HRG data</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>HRG Reports</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p class="text-warning">
                GBV data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.gbv.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Upload</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.gbv.consolidated')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consolidated</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.gbv.visualize')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Visualizations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.gbv.template')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Template</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p class="text-warning">
                Typologies
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.fsw.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>FSW</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.msm.report')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>MSM</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PWID</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Template</p>
                </a>
              </li>
            </ul>
          </li>
          @can('Read C7 Coverage')
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-map-marker"></i>
              <p class="text-warning">
                GC Program
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>GC6 Coverage</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.gc7')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>GC7 Coverage</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reports</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan
          <li class="nav-header text-warning">QUICK lINKS</li>
          <li class="nav-item">
            <a href="https://krcs-analytics.shinyapps.io/GF-ANALYTICS/" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>Indicator Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
            <li class="nav-item">
            <a href="{{route('admin.regions')}}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Regions</p>
            </a>
          </li>
          @can('Manage Users')
          <li class="nav-item">
            <a href="{{route('admin.users')}}" class="nav-link">
              <i class="nav-icon far fa-user text-warning"></i>
              <p>User Management</p>
            </a>
          </li>
          <!--  <li class="nav-item {{Request::is('logs*')?' active':''}}">
              <a class="nav-link {{ Request::is('logs') ? 'active' : null }}" href="{{ url('/logs') }}" > <i class="nav-icon fas fa-clipboard-list"></i>System Logs
              </a>
          </li> -->
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
          @endcan
          <li class="nav-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="nav-link">
              <i class="fas fa-sign-out-alt nav-icon"></i>
              <p>Logout</p>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>