<div id="main-wrapper">
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                        class="ti-menu ti-close"></i></a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand" href="index.html">
                    <!-- Logo icon -->
                    <b class="logo-icon">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                        <!-- Light Logo icon -->
                        <img src="../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                        <!-- dark Logo text -->
                        <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                        <!-- Light Logo text -->
                        <img src="../assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                    </span>
                </a>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                    data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto float-left"></ul>
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-right">
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="../assets/images/users/user.jpg" alt="user" width="30"
                                class="profile-pic rounded-circle" />
                        </a>
                        <div class="dropdown-menu mailbox dropdown-menu-right scale-up">
                            <ul class="dropdown-user list-style-none">
                                <li>
                                    <div class="dw-user-box p-3 d-flex">
                                        <div class="u-img"><img src="../assets/images/users/user.jpg" alt="user"
                                                class="rounded" width="80"></div>
                                        <?php if(session()->loggedin == 'loggedin'): ?>
                                        <div class="u-text ml-2">
                                            <h4 class="mb-0"><?= ucfirst(session()->name); ?></h4>
                                            <p class="text-muted mb-1 font-14"><?= session()->email; ?></p>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                </li>
                                <li role="separator" class="dropdown-divider"></li>
                                <li class="user-list"><a class="px-3 py-2" href="<?= base_url('admin/logout') ?>"><i class="fa fa-power-off"></i>
                                        SignOut</a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                </ul>
            </div>
        </nav>
    </header>

    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="app-calendar.html"
                            aria-expanded="false">
                            <i class="mdi mdi-gauge"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="app-chats.html" aria-expanded="false">
                            <i class="mdi mdi-collage"></i>
                            <span class="hide-menu">Reports</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
</div>