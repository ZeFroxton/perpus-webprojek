<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="./index.html" class="text-nowrap logo-img">
          <h3>Perpustakaan</h3>
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-8"></i>
        </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('user.index') }}" aria-expanded="false">
              <span>
                <i class="ti ti-layout-dashboard"></i>
              </span>
              <span class="hide-menu">Dashboard</span>
            </a>
          </li>


          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('profile.edit') }}" aria-expanded="false">
              <span>
                <i class="ti ti-file-description"></i>
              </span>
              <span class="hide-menu">Profile</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('user.loans') }}" aria-expanded="false">
              <span>
                <i class="ti ti-file-book"></i>
              </span>
              <span class="hide-menu">Loan lounge</span>
            </a>
          </li>
          <form method="POST" action="{{ route('logout') }}">
              @csrf
                <li class="sidebar-item">
                    <a class="sidebar-link" :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();" >
                               <span>
                                <i class="ti ti-logout"></i>
                              </span>
                              <span class="hide-menu">{{ __('Log Out') }}</span>
                            </a>
                  </li>

            </form>



        </ul>

      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>
