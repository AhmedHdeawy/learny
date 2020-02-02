<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link {{ $segment == null ? 'active' : '' }}" href="{{ route('admin.dashboard.index') }}">
                    <i class="icon-home"></i> {{ __('lang.dashboard') }} 
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ $segment == 'categories' ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                    <i class="icon-info"></i> {{ __('lang.categories') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $segment == 'videos' ? 'active' : '' }}" href="{{ route('admin.videos.index') }}">
                    <i class="icon-info"></i> {{ __('lang.videos') }}
                </a>
            </li>

{{-- 
            <li class="nav-item">
                <a class="nav-link {{ $segment == 'settings' ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                    <i class="icon-settings"></i> {{ __('lang.settings') }}
                </a>
            </li> --}}
            

            <li class="nav-item">
                <a class="nav-link {{ $segment == 'users' ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="icon-user"></i> {{ __('lang.users') }}
                </a>
            </li>

{{--             <li class="nav-item">
                <a class="nav-link {{ $segment == 'users' ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="icon-people"></i> {{ __('lang.users') }} 
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link {{ $segment == 'admins' ? 'active' : '' }}" href="{{ route('admin.admins.index') }}">
                    <i class="icon-diamond"></i> {{ __('lang.admins') }} 
                </a>
            </li>

        </ul>
    </nav>
</div>

  {{--   <li class="{{ $segment == null ? 'active' : '' }}"><a href="{{ route('dashboard') }}"> <i class="icon-home"></i>Home </a></li>
  
    <li class="{{ in_array($segment, ['categories']) ? 'active' : '' }}">
      <a href="{{ route('dashboard.categories') }}">
         <i class="fa fa-list fa-lg"></i>
         <span class="px-2">Categories</span> 
      </a>
    </li>
 --}}
