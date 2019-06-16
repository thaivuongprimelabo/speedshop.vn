<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ Auth::user()->getAvatar() }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{ Auth::user()->name }}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul  class="sidebar-menu" data-widget="tree">
  <li><a href="{{ route('home') }}" target="_blank"><i class="fa fa-files-o"></i><span>{{ trans('auth.back_to_home') }}</span></a></li>
  {!! Utils::createSidebar() !!}}
  </ul>
</section>
<!-- /.sidebar -->
</aside>