<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Barangay Information System</title>
    <!-- Scripts -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet">
 
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper" id="app">
    <app-header/>
    </app-header>
    <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">
          <b>MAIN NAVIGATION</b>
        </li>
        <li class="treeview" routerLinkActive="active menu-open">
          <router-link :to="{name: 'home'}">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
            <span class="pull-right-container"></span>
          </router-link>
        </li>
        <li class="treeview" routerLinkActive="active menu-open">
          <a href="#" role="button">
            <i class="glyphicon glyphicon-user"></i>
            <span>Resident Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <router-link to="/residents/list">
                <i class="fa fa-circle-o"></i> Resident List
              </router-link>
            </li>
            <li>
              <router-link :to="{name: 'resident-create'}">
                <i class="fa fa-circle-o"></i> New Resident
              </router-link>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-circle-o"></i> HouseHold
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-circle-o"></i> Families
              </a>
            </li>
            <li>
              <router-link :to="{name: 'voter-index'}">
                <i class="fa fa-circle-o"></i> Voters
              </router-link>
            </li>
          </ul>
        </li>
        <li class="treeview" routerLinkActive="active menu-open">
          <a href="#" role="button">
            <i class="fa fa-institution"></i>
            <span>Barangay Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li>
              <router-link :to="{ name: 'purok' }">
                <i class="fa fa-circle-o"></i> Puroks
              </router-link>
            </li>

            <li>
              <router-link :to="{ name: 'official-index' }">
                <i class="fa fa-circle-o"></i> Officials
              </router-link>
            </li>
          </ul>
        </li>

        <li class="treeview" routerLinkActive="active menu-open">
          <a href="#" role="button">
            <i class="fa fa-folder"></i>
            <span>Request</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <router-link :to="{ name: 'blotter-index' }">
                <i class="fa fa-circle-o"></i> Blotter
              </router-link>
            </li>
          </ul>
        </li>
        <li class="treeview" routerLinkActive="active menu-open">
          <a  href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-power-off"></i>
            <span>Logout</span>
            <span class="pull-right-container"></span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
           </form>
          
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
    <div class="content-wrapper">
    <section class="content-header">
      <h1>    
      <small></small>
      </h1>
    </section>
     <section class="content">
      <router-view></router-view>
      </section> 
    </div>
    <app-footer></app-footer>
  </div>
    <script  src="{{ asset(mix('js/app.js')) }}"></script>

</body>
</html>
