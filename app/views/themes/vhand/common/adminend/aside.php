<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

<div class="slimscroll-menu">

    <!-- User box -->
    <div class="user-box text-center">
        <img src="<?php echo base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir')]); ?>/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
        <div class="dropdown">
            <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown"  aria-expanded="false">Nowak Helme</a>
            <div class="dropdown-menu user-pro-dropdown">

                <a class="dropdown-item" href="<?php echo site_url(['admin', 'user', 'settings', 'profile']); ?>">
                    <i class="fe-settings mr-1"></i> User settings
                </a>

                <div class="dropdown-divider"></div>

                <form action="<?php echo site_url(['auth', 'signout']); ?>" method="POST">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <button type="submit" class="dropdown-item" name="submit">
                        <i class="fe-log-out mr-1"></i> Logout
                    </button>
                </form>

            </div>
        </div>
        <p class="text-muted">Admin Head</p>
        <ul class="list-inline">
            <li class="list-inline-item">
                <a href="<?php echo site_url(['admin', 'user', 'settings', 'profile']); ?>" class="text-muted">
                    <i class="mdi mdi-cog"></i>
                </a>
            </li>

            <li class="list-inline-item">
                <form action="<?php echo site_url(['auth', 'signout']); ?>" method="POST">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <button type="submit" class="dropdown-item" name="submit">
                    <i class="mdi mdi-power"></i>
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <ul class="metismenu" id="side-menu">
            <li>
                <a class="" href="<?php echo site_url('admin'); ?>">
                    <i class="fas fa-home fa-fw mr-1"></i>
                    <span> Home </span>
                </a>
            </li>
            <li class="menu-title">Editor</li>
            <li class="menu-title">Gameserver Settings</li>
            <li class="menu-title">Web Settings</li>
            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-page-layout-sidebar-left"></i>
                    <span> Users </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($this->uri->segment(3) == 'overview' ? 'active' : ''); ?>" href="<?php echo site_url(['admin', 'users', 'overview']); ?>">Overview</a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="nav-item">
                        <span class="d-flex <?php echo ($this->uri->segment(3) == 'statuses' ? 'active' : ''); ?>">
                            <a class="nav-link flex-grow-1 pr-0" href="<?php echo site_url(['admin', 'users', 'statuses']); ?>?filterby=state&filter=active">Statuses</a>

                            <a href="<?php echo site_url(['admin', 'users', 'statuses', 'add']); ?>" class="_nav_link_append py-1 px-3 <?php echo (($this->uri->segment(3) == 'statuses' && $this->uri->segment(4) == 'add') ? 'active' : ''); ?>">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="d-flex <?php echo ($this->uri->segment(3) == 'tags' ? 'active' : ''); ?>">
                            <a class="nav-link flex-grow-1 pr-0" href="<?php echo site_url(['admin', 'users', 'tags']); ?>?filterby=state&filter=active">Tags</a>

                            <a href="<?php echo site_url(['admin', 'users', 'tags', 'add']); ?>" class="_nav_link_append py-1 px-3 <?php echo (($this->uri->segment(3) == 'tags' && $this->uri->segment(4) == 'add') ? 'active' : ''); ?>">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="d-flex <?php echo ($this->uri->segment(3) == 'roles' ? 'active' : ''); ?>">
                            <a class="nav-link flex-grow-1 pr-0" href="<?php echo site_url(['admin', 'users', 'roles']); ?>?filterby=state&filter=active">Roles</a>

                            <a href="<?php echo site_url(['admin', 'users', 'roles', 'add']); ?>" class="_nav_link_append py-1 px-3 <?php echo (($this->uri->segment(3) == 'roles' && $this->uri->segment(4) == 'add') ? 'active' : ''); ?>">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="d-flex <?php echo ($this->uri->segment(3) == 'groups' ? 'active' : ''); ?>">
                            <a class="nav-link flex-grow-1 pr-0" href="<?php echo site_url(['admin', 'users', 'groups']); ?>?filterby=state&filter=active">Groups</a>

                            <a href="<?php echo site_url(['admin', 'users', 'groups', 'add']); ?>" class="_nav_link_append py-1 px-3 <?php echo (($this->uri->segment(3) == 'groups' && $this->uri->segment(4) == 'add') ? 'active' : ''); ?>">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </span>
                    </li>
                    <li class="nav-item">
                        <span class="d-flex <?php echo ($this->uri->segment(3) == 'permissions' ? 'active' : ''); ?>">
                            <a class="nav-link flex-grow-1 pr-0" href="<?php echo site_url(['admin', 'users', 'permissions']); ?>?filterby=state&filter=active">Permissions</a>

                            <a href="<?php echo site_url(['admin', 'users', 'permissions', 'add']); ?>" class="_nav_link_append py-1 px-3 <?php echo (($this->uri->segment(3) == 'permissions' && $this->uri->segment(4) == 'add') ? 'active' : ''); ?>">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </span>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);">
                    <i class="fas fa-hdd fa-fw mr-1"></i> 
                    <span> Layouts </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="<?php echo site_url(['admin', 'system', 'settings', 'app']); ?>">Settings</a>
                    </li>
                </ul>
            </li>
            <li class="menu-title">Navigation</li>
            <li>
                <a href="index.html">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-page-layout-sidebar-left"></i>
                    <span> Layouts </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="layouts-horizontal.html">Horizontal</a></li>
                    <li><a href="layouts-sidebar-sm.html">Small Sidebar</a></li>
                    <li><a href="layouts-dark-sidebar.html">Dark Sidebar</a></li>
                    <li><a href="layouts-dark-topbar.html">Dark Topbar</a></li>
                    <li><a href="layouts-preloader.html">Preloader</a></li>
                    <li><a href="layouts-sidebar-collapsed.html">Sidebar Collapsed</a></li>
                    <li><a href="layouts-boxed.html">Boxed</a></li>
                </ul>
            </li>

            <li class="menu-title">Apps</li>

            <li>
                <a href="apps-chat.html">
                    <i class="mdi mdi-forum"></i>
                    <span class="badge badge-purple float-right">New</span>
                    <span> Chat </span>
                </a>
            </li>

            <li>
                <a href="calendar.html">
                    <i class="mdi mdi-calendar"></i>
                    <span> Calendar </span>
                </a>
            </li>

            <li>
                <a href="inbox.html">
                    <i class="mdi mdi-email"></i>
                    <span> Mail </span>
                </a>
            </li>

            <li class="menu-title">Components</li>

            <li>
                <a href="ui-typography.html">
                    <i class="mdi mdi-format-font"></i>
                    <span> Typography </span>
                </a>
            </li>

            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-invert-colors"></i>
                    <span> User Interface </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="ui-buttons.html">Buttons</a></li>
                    <li><a href="ui-cards.html">Cards</a></li>
                    <li><a href="ui-draggable-cards.html">Draggable Cards</a></li>
                    <li><a href="ui-checkbox-radio.html">Checkboxs-Radios</a></li>
                    <li><a href="ui-material-icons.html">Material Design</a></li>
                    <li><a href="ui-font-awesome-icons.html">Font Awesome 5</a></li>
                    <li><a href="ui-dripicons.html">Dripicons</a></li>
                    <li><a href="ui-feather-icons.html">Feather Icons</a></li>
                    <li><a href="ui-themify-icons.html">Themify Icons</a></li>
                    <li><a href="ui-modals.html">Modals</a></li>
                    <li><a href="ui-notification.html">Notification</a></li>
                    <li><a href="ui-range-slider.html">Range Slider</a></li>
                    <li><a href="ui-components.html">Components</a>
                    <li><a href="ui-sweetalert.html">Sweet Alert</a>
                    <li><a href="ui-treeview.html">Tree view</a>
                    <li><a href="ui-widgets.html">Widgets</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-texture"></i>
                    <span class="badge badge-warning float-right">7</span>
                    <span> Forms </span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="form-elements.html">General Elements</a></li>
                    <li><a href="form-advanced.html">Advanced Form</a></li>
                    <li><a href="form-validation.html">Form Validation</a></li>
                    <li><a href="form-wizard.html">Form Wizard</a></li>
                    <li><a href="form-fileupload.html">Form Uploads</a></li>
                    <li><a href="form-quilljs.html">Quilljs Editor</a></li>
                    <li><a href="form-xeditable.html">X-editable</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-view-list"></i>
                    <span> Tables </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="tables-basic.html">Basic Tables</a></li>
                    <li><a href="tables-datatable.html">Data Tables</a></li>
                    <li><a href="tables-responsive.html">Responsive Table</a></li>
                    <li><a href="tables-editable.html">Editable Table</a></li>
                    <li><a href="tables-tablesaw.html">Tablesaw Table</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-chart-donut-variant"></i>
                    <span> Charts </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="charts-flot.html">Flot Charts</a></li>
                    <li><a href="charts-morris.html">Morris Charts</a></li>
                    <li><a href="charts-chartist.html">Chartist Charts</a></li>
                    <li><a href="charts-chartjs.html">Chartjs Charts</a></li>
                    <li><a href="charts-other.html">Other Charts</a></li>
                </ul>
            </li>


            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-file-multiple"></i>
                    <span> Pages </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="pages-starter.html">Starter Page</a></li>
                    <li><a href="pages-login.html">Login</a></li>
                    <li><a href="pages-register.html">Register</a></li>
                    <li><a href="pages-recoverpw.html">Recover Password</a></li>
                    <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                    <li><a href="pages-confirm-mail.html">Confirm Mail</a></li>
                    <li><a href="pages-404.html">Error 404</a></li>
                    <li><a href="pages-500.html">Error 500</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-layers"></i>
                    <span> Extra Pages </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="extras-projects.html">Projects</a></li>
                    <li><a href="extras-tour.html">Tour</a></li>
                    <li><a href="extras-taskboard.html">Taskboard</a></li>
                    <li><a href="extras-taskdetail.html">Task Detail</a></li>
                    <li><a href="extras-profile.html">Profile</a></li>
                    <li><a href="extras-maps.html">Maps</a></li>
                    <li><a href="extras-contact.html">Contact list</a></li>
                    <li><a href="extras-pricing.html">Pricing</a></li>
                    <li><a href="extras-timeline.html">Timeline</a></li>
                    <li><a href="extras-invoice.html">Invoice</a></li>
                    <li><a href="extras-faq.html">FAQs</a></li>
                    <li><a href="extras-gallery.html">Gallery</a></li>
                    <li><a href="extras-email-templates.html">Email Templates</a></li>
                    <li><a href="extras-maintenance.html">Maintenance</a></li>
                    <li><a href="extras-comingsoon.html">Coming Soon</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-share-variant"></i>
                    <span> Multi Level </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level nav" aria-expanded="false">
                    <li>
                        <a href="javascript: void(0);">Level 1.1</a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" aria-expanded="false">Level 1.2
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-third-level nav" aria-expanded="false">
                            <li>
                                <a href="javascript: void(0);">Level 2.1</a>
                            </li>
                            <li>
                                <a href="javascript: void(0);">Level 2.2</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">