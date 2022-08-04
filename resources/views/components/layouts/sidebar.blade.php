<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Loker<span> SIAK</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ url('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            @role('superadmin')
            <li class="nav-item nav-category">User Management</li>
            <li class="nav-item">
                <a href="{{ url('user') }}" class="nav-link">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">User</span>
                </a>
            </li>
            @endrole
            @role('superadmin|admin')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#tables" role="button" aria-expanded="false" aria-controls="tables">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Table</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="tables">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/tables/basic-table.html" class="nav-link">Basic Tables</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/data-table.html" class="nav-link">Data Table</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endrole
        </ul>
    </div>
</nav>