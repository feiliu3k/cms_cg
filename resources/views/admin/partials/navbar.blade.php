<ul class="nav navbar-nav">
    <li><a href="{{ url('/') }}">首页</a></li>
    @if (Auth::check())
        @can('edit-post')
        <li @if (Request::is('admin/news*')) class="active" @endif>
            <a href="{{ url('admin/news') }}">{{ config('cms.title') }}</a>
        </li>
        @endcan
        @can('edit-pro')
        <li @if (Request::is('admin/pro*')) class="active" @endif>
            <a href="{{ url('admin/pro') }}">{{ config('cms.pro') }}</a>
        </li>
        @endcan
        @can('edit-comment')
        <li @if (Request::is('admin/comment*')) class="active" @endif>
            <a href="{{ url('admin/comment') }}">{{ config('cms.comment') }}</a>
        </li>
        @endcan

    @endif
</ul>
<ul class="nav navbar-nav nav-tabs">
 @if (Auth::check())
  @can('edit-user')

  <li role="presentation" class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      系统工具 <span class="caret"></span>
    </a>

    <ul class="dropdown-menu">
        <li><a href="{{ url('admin/user') }}">用户</a></li>
        <li><a href="{{ url('admin/role') }}">角色</a></li>
        <li><a href="{{ url('admin/permission') }}">权限</a></li>
    </ul>
  </li>
    @endcan
  @endif
</ul>


<ul class="nav navbar-nav navbar-right">
    @if (Auth::guest())
        <li><a href="{{ url('auth/login') }}">登陆</a></li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                    aria-expanded="false">
                {{ Auth::user()->name }}
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('auth/logout') }}">注销</a></li>
            </ul>
        </li>
    @endif
</ul>