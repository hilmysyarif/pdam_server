<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin') }}">
          <i class="nav-icon fas fa-tachometer-alt"></i> @lang('Beranda')
        </a>
      </li>
      @role('admin')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.berita') }}">
          <i class="nav-icon fas fa-file"></i> @lang('Berita')
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.history-pemakaian') }}">
          <i class="nav-icon fas fa-list"></i> @lang('History Pemakaian')
        </a>
      </li>

      @endrole
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.history-pemakaian') }}">
          <i class="nav-icon fas fa-list"></i> @lang('Pemakaian Saya')
        </a>
      </li>
      <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="nav-icon fas fa-user-circle"></i> @lang('Pengguna')</a>
        <ul class="nav-dropdown-items">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.edit', Auth::user()->name) }}">
              <i class="nav-icon fas fa-user"></i> @lang('Profilku')</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.change-password', Auth::user()->name) }}">
              <i class="nav-icon fas fa-key"></i> @lang('Ganti Password')</a>
          </li>
          @role('admin')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">
              <i class="nav-icon fas fa-users"></i> @lang('Semua Pengguna')</a>
          </li>
          @endrole
        </ul>
      </li>
    </ul>
  </nav>
  <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
