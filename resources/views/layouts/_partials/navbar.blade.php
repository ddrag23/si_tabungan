      <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <ul class="navbar-nav mr-auto">
              <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"
                  ><i class="fas fa-bars"></i
                ></a>
              </li>
            </ul>
          <ul class="navbar-nav navbar-right">
            <li class="dropdown dropdown-list-toggle">
              <a
                href="#"
                data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg beep"
                ><i class="far fa-bell"></i
              ></a>
              <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">
                  Notifications
                  <div class="float-right">
                    <a href="#">Mark All As Read</a>
                  </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                  <a href="#" class="dropdown-item dropdown-item-unread">
                    <div class="dropdown-item-icon bg-primary text-white">
                      <i class="fas fa-code"></i>
                    </div>
                    <div class="dropdown-item-desc">
                      Template update is available now!
                      <div class="time text-primary">2 Min Ago</div>
                    </div>
                  </a>
                </div>
                <div class="dropdown-footer text-center">
                  <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </li>
            <li class="dropdown">
              <a
                href="#"
                data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user"
              >
                <img
                  alt="image"
                  src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                  class="rounded-circle mr-1"
                />
                <div class="d-sm-none d-lg-inline-block">
                  {{ Auth::user()->name }}
                </div></a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="features-profile.html" class="dropdown-item has-icon">
                  <i class="far fa-user"></i> Profile
                </a>
                <a href="features-settings.html" class="dropdown-item has-icon">
                  <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item btn-sm has-icon text-danger"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>

              </div>
            </li>
          </ul>
        </nav>
        <div class="main-sidebar sidebar-style-2">
          <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
              <a href="{{ url('home') }}">Stisla</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
              <a href="{{ url('home') }}">St</a>
            </div>
            <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('home') }}"
                  ><i class="fas fa-fire"></i> <span>Dashboard</span></a
                >
              </li>
              <li class="menu-header">Menu</li>

              <li class="dropdown {{ Request::is('transaksi*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"
                  ><i class="fas fa-dollar-sign"></i> <span>Master Transaksi</span></a
                >
                <ul class="dropdown-menu">
                  <li class="{{ Request::is('transaksi/transaksi-masuk') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('income.index') }}">Transaksi Masuk</a>
                  </li>
                  <li class="{{ Request::is('transaksi/transaksi-keluar') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('outgoing.index') }}">Transaksi Keluar</a>
                  </li>
                </ul>
              </li>

              <li class="{{ Request::is('tabungan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('tabungan.index') }}"
                  ><i class="fas fa-save"></i> <span>Master Tabungan</span></a
                >
              </li>
              <li class="{{ Request::is('pinjaman*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pinjaman.index') }}"
                  ><i class="fas fa-save"></i> <span>Master Pinjaman</span></a
                >
              </li>

              <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"
                  ><i class="fas fa-file"></i> <span>Master Laporan</span></a
                >
                <ul class="dropdown-menu">
                  <li>
                    <a class="nav-link" href="bootstrap-alert.html">Laporan Perhari</a>
                  </li>
                  <li>
                    <a class="nav-link" href="bootstrap-alert.html">Laporan Perminggu</a>
                  </li>
                  <li>
                    <a class="nav-link" href="bootstrap-alert.html">Laporan Perbulan</a>
                  </li>
                </ul>
              </li>

              <li class="menu-header">Settings</li>
              <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"
                  ><i class="fas fa-users"></i> <span>Users</span></a
                >
                <ul class="dropdown-menu">
                  <li>
                    <a class="nav-link" href="layout-default.html"
                      >Tambah User</a
                    >
                  </li>
                  <li>
                    <a class="nav-link" href="layout-transparent.html"
                      >Daftar User</a
                    >
                  </li>
                </ul>
              <li class="">
                <a class="nav-link" href="blank.html"
                  ><i class="far fa-square"></i> <span>Role & Permission</span></a
                >
              </li>

              </li>

            </ul>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a
                href="https://getstisla.com/docs"
                class="btn btn-primary btn-lg btn-block btn-icon-split"
              >
                <i class="fas fa-rocket"></i> Documentation
              </a>
            </div>
          </aside>
        </div>

