<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      @php
      $admin = Auth::user();
      @endphp
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{$admin->getPhoto()}}" class="img-circle" alt="User Image">
        </div>
         
        <div class="pull-left info">
          <p>{{$admin->firstname}} {{$admin->lastname}}</p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">REPORTS</li>
        <li class=""><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class=""><a href="{{url('admin/votes')}}"><span class="glyphicon glyphicon-lock"></span> <span>Votes</span></a></li>
        <li class="header">MANAGE</li>
        <li class=""><a href="{{url('admin/voters')}}"><i class="fa fa-users"></i> <span>Voters</span></a></li>
        <li class=""><a href="{{url('admin/positions')}}"><i class="fa fa-tasks"></i> <span>Positions</span></a></li>
        <li class=""><a href="{{url('admin/candidates')}}"><i class="fa fa-black-tie"></i> <span>Candidates</span></a></li>
        <li class="header">SETTINGS</li>
        <li class=""><a href="{{url('admin/ballot-position')}}"><i class="fa fa-file-text"></i> <span>Ballot Position</span></a></li>
        <li class=""><a href="#config" data-toggle="modal"><i class="fa fa-cog"></i> <span>Election Title</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  @include('admin.config_modal')