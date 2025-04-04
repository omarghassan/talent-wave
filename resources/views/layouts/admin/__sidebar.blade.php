<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="https://demos.creative-tim.com/material-dashboard/pages/dashboard" target="_blank">
            <img src="{{asset('../assets/img/title.png')}}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
            <span class="ms-1 text-sm text-dark">Talent Wave</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-dark position-relative" href="../pages/dashboard.html">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark position-relative" data-bs-toggle="collapse" href="#usersSubmenu" role="button">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Users</span>
                    <i class="material-symbols-rounded opacity-5 position-absolute end-0 me-3">expand_more</i>
                </a>
                <div class="collapse" id="usersSubmenu">
                    <ul class="nav flex-column ms-4">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('all_users') }}">
                                <span class="nav-link-text">All Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('admin.create') }}">
                                <span class="nav-link-text">Add New User</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('deletedeusers.index') }}">
                                <span class="nav-link-text">Deleted User</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @if(Auth::guard('admin')->user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link text-dark position-relative" data-bs-toggle="collapse" href="#hrSubmenu" role="button">
                    <i class="material-symbols-rounded opacity-5">groups</i>
                    <span class="nav-link-text ms-1">HR</span>
                    <i class="material-symbols-rounded opacity-5 position-absolute end-0 me-3">expand_more</i>
                </a>
                <div class="collapse" id="hrSubmenu">
                    <ul class="nav flex-column ms-4">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('hr.index') }}">
                                <span class="nav-link-text">All HRs</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('hr.index_deleted') }}">
                                <span class="nav-link-text">Deleted HRs</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('hr.create') }}">
                                <span class="nav-link-text">Add New HR</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link text-dark position-relative" data-bs-toggle="collapse" href="#departmentSubmenu" role="button">
                    <i class="material-symbols-rounded opacity-5">category</i>
                    <span class="nav-link-text ms-1">Departments</span>
                    <i class="material-symbols-rounded opacity-5 position-absolute end-0 me-3">expand_more</i>
                </a>
                <div class="collapse" id="departmentSubmenu">
                    <ul class="nav flex-column ms-4">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('all_department') }}">
                                <span class="nav-link-text">All Departments</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('all.deleted_departments') }}">
                                <span class="nav-link-text">Deleted Departments</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark position-relative" data-bs-toggle="collapse" href="#leavesSubmenu" role="button">
                    <i class="material-symbols-rounded opacity-5">event</i>
                    <span class="nav-link-text ms-1">Leaves</span>
                    <i class="material-symbols-rounded opacity-5 position-absolute end-0 me-3">expand_more</i>
                </a>
                <div class="collapse" id="leavesSubmenu">
                    <ul class="nav flex-column ms-4">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('admin.leave-balances.index') }}">
                                <span class="nav-link-text">Employee leave balance</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('admin.leave-types.index') }}">
                                <span class="nav-link-text">Leaves types</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('admin.leaves.index') }}">
                                <span class="nav-link-text">Employee Leaves</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('attendances.index') }}">
                    <i class="material-symbols-rounded opacity-5">access_time</i>
                    <span class="nav-link-text ms-1">Attendace</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('document.index')}}">
                    <i class="material-symbols-rounded opacity-5">article</i>
                    <span class="nav-link-text ms-1">Documents</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('hr.show', ['id' => Auth::guard('admin')->user()->id]) }}">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('admin_logout')}}">
                    <i class="material-symbols-rounded opacity-5">login</i>
                    <span class="nav-link-text ms-1">Log out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>