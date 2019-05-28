<template>
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
            <i class="fa fa-hospital-o"></i>
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
            <i class="fa fa-institution"></i>
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
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
</template>
<script>
export default {
  name: "Sidebar"
};
</script>
