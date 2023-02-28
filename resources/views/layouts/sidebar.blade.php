<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link" >
        <img src="{{ asset('vendor/admin-lte/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Admin-Dev</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Auth::user()->gambar)
                    <img src="{{ asset('storage/public/images/'. Auth::user()->gambar) }}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img  src="{{ asset('gambar/npc.jpg') }}" class="img-circle " alt="User Image">
                @endif
            </div>
            @if(auth()->user())
            <div class="info">
                <a href="{{ route('home') }}" class="d-block">{{ Auth::user()->nama }}</a>
            </div>
            @endif
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                          </svg>
                        <p style="margin-left: 10px;">
                            Home
                        </p>
                    </a>
                </li>

                {{-- user --}}
                {{-- @if (Auth::User()->role == 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ (Request::is('user')||Request::is('show*')) ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                          </svg>
                        <p style="margin-left: 10px;">
                            User
                        </p>
                    </a>
                </li>
                @endif --}}


                {{-- user ls --}}
                @if (Auth::User()->role == 'superadmin')

                <li class="nav-item {{ (Request::is('user*')||Request::is('show*')) ? 'menu-open' : '' }}">
                    
                  <a href="#" class="nav-link {{ (Route::is('user.index') || Route::is('create.user')||Request::is('show*')) ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                      <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                    </svg>
                    <p style="margin-left: 10px;">
                      User
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('user.index') }}" class="nav-link {{ (Request::is('user')||Request::is('show*')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List User</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('create.user') }}"class="nav-link {{ (Request::is('user/create')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create User</p>
                      </a>
                    </li>
                  </ul>
                @endif

                
                
                {{-- tag --}}
                  <li class="nav-item {{ (Request::is('tag*')) ? 'menu-open' : '' }}">
                    
                    <a href="#" class="nav-link {{ (Route::is('tag.index') || Route::is('tag.create') || Route::is('tag.edit')) ? 'active' : '' }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-bookmarks-fill" viewBox="0 0 16 16">
                        <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4z"/>
                        <path d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1H4.268z"/>
                      </svg>
                      <p style="margin-left: 10px;">
                        Tag
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('tag.index') }}" class="nav-link {{ (Request::is('tag')) ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>List</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('tag.create') }}"class="nav-link {{ (Request::is('tag/create')) ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Create</p>
                        </a>
                      </li>
                    </ul>



                    {{-- category --}}
                <li class="nav-item {{ (Request::is('category*')) ? 'menu-open' : '' }}">
                    
                    <a href="#" class="nav-link {{ (Route::is('catego.index') || Route::is('catego.create') || Route::is('catego.edit')) ? 'active' : '' }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                        <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z"/>
                        <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z"/>
                      </svg>
                      <p style="margin-left: 10px;">
                        Category
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('catego.index') }}" class="nav-link {{ (Request::is('category')) ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>List</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('catego.create') }}"class="nav-link {{ (Request::is('category/create')) ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Create</p>
                        </a>
                      </li>
                    </ul>
                 

                    {{-- Post --}}
                    <li class="nav-item {{ (Request::is('post*')) ? 'menu-open' : '' }}">
                    
                      <a href="#" class="nav-link {{ (Route::is('post.index') || Route::is('post.create') || Route::is('post.edit')) ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-file-post" viewBox="0 0 16 16">
                          <path d="M4 3.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-8z"/>
                          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                        </svg>
                        <p style="margin-left: 10px;">
                          Post
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{ route('post.index') }}" class="nav-link {{ (Route::is('post.edit') ||Request::is('post')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('post.create') }}"class="nav-link {{ (Request::is('post/create')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create</p>
                          </a>
                        </li>
                      </ul>


                {{-- <li class="nav-item">
                    <a href="{{ route('show') }}" class="nav-link {{ Request::is('show') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                          </svg>
                        <p style="margin-left: 10px;">
                            Detail user
                        </p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('alluser') }}" class="nav-link{{ Route::is('alluser')?'active':'' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                          </svg>
                        <p style="margin-left: 10px;">
                            USER
                        </p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>