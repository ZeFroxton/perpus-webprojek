<nav class="navbar bg-primary navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">Library</a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
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
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <h4>{{ Auth::user()->name }}</h4>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  @if (Auth::user()->profile_photo)
                  <img src="{{ asset('storage/profilepic/' . Auth::user()->profile_photo) }}" alt="/../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                  @endif
                </a>
              </li>
            </ul>
          </div>
      </div>
    </div>
  </nav>
