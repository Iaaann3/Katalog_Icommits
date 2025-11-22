<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('pages.admin.dashboard') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img
          src="{{ asset('assets/img/logo/icommits.jpg') }}"
          alt="iCommits Logo"
          style="width: 40px; height: 40px; border-radius: 8px;"
        />
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">iCommits</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item active">
      <a href="{{ route('pages.admin.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>
  </ul>
</aside>
