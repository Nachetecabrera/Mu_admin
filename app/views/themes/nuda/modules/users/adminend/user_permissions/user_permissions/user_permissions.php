<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| User permissions view file
|
| Author:       Nudasoft
| Copyright:    Copyright (C) Nudasoft, all rights reserved
| Author email: nudasoft@gmail.com
| Author url:   http://www.nudasoft.com
|
| Author twitter:   https://twitter.com/Nudasoft
| Author facebook:  https://www.facebook.com/Nudasoft
| Author instagram: https://www.instagram.com/nudasoft
| Author linkedin:  https://www.linkedin.com/company/nudasoft
|--------------------------------------------------------------------------
*/




/**
 * Complete user permissions template.
 */

// Calling common adminend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/header'); ?>

<nav class="navbar navbar-expand-md navbar-light px-0 py-3">
    <span class="navbar-brand mb-0 h1">
        User permissions

        <?php if (!empty($userPermissions->numRows)): ?>
        <span class="badge badge-pill badge-secondary"><?php echo $userPermissions->numRows; ?></span>
        <?php endif; ?>
    </span>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#crudMainNavbar" aria-controls="crudMainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="crudMainNavbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3), 'add']); ?>">Add new</a>
            </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0" method="get" action="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3)]); ?>">
            <?php

            $queryStringAssoc = $this->input->get(null, true);

            // Remove 'search' key from the associative array.
            unset($queryStringAssoc['search']);

            $cancelSearchUrl = site_url(uri_string()) . (!empty($queryStringAssoc) ? '?' . http_build_query($queryStringAssoc) : '');

            foreach ($queryStringAssoc as $key => $value): ?>

            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">

            <?php endforeach; ?>

            <div class="input-group w-100">
                <input type="search" class="form-control" name="search" placeholder="Search" aria-label="Search" value="<?php echo ($this->input->get('search', true) !== null ? $this->input->get('search', true) : ''); ?>" required>
                <div class="input-group-append">
                    <?php if ($this->input->get('search', true) != null): ?>
                    <a class="btn btn-secondary" href="<?php echo $cancelSearchUrl; ?>" role="button"><i class="fas fa-times-circle"></i></a>
                    <?php endif; ?>

                    <button class="btn btn-dark" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</nav>

<?php if ($this->session->flashdata('editUserRolePermissionsSuccess') === true): ?>
<div class="alert alert-success alert-dismissible fade show animated faster fadeIn" role="alert" _auto_close="15000">
    <i class="fas fa-check-circle mr-1"></i> The changes were successfully saved.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('editUserRolePermissionsSuccess') === false): ?>
<div class="alert alert-danger alert-dismissible fade show animated faster shake" role="alert" _auto_close="15000">
    <i class="fas fa-times-circle mr-1"></i> The changes were not saved due to an internal error. please try again later.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
</div>
<?php endif; ?>

<form class="mb-3 clearfix" method="POST">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="card mb-3">
        <div class="card-header p-0">
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <span class="navbar-brand d-md-none" href="#">Filters</span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#crudFilterNavbar" aria-controls="crudFilterNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="crudFilterNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item <?php

                            if (empty($this->input->get('filterby', true))) {
                                echo 'active';
                            }

                            ?>">
                            <a class="nav-link p-md-0 mr-md-3" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3)]); ?>">
                                All
                            </a>
                        </li>

                        <li class="nav-item <?php

                            if ($this->input->get('filterby', true) == 'state' && $this->input->get('filter', true) == 'active') {
                                echo 'active';
                            }

                            ?>">
                            <a class="nav-link p-md-0 mr-md-3" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3)]); ?>?filterby=state&filter=active">
                                Active
                            </a>
                        </li>

                        <li class="nav-item <?php

                            if ($this->input->get('filterby', true) == 'state' && $this->input->get('filter', true) == 'inactive') {
                                echo 'active';
                            }

                            ?>">
                            <a class="nav-link p-md-0 mr-md-3" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3)]); ?>?filterby=state&filter=inactive">
                                Inactive
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <?php if (empty($userPermissions->result)): ?>

        <div class="card-body">
            No user permissions found.
        </div>

        <?php else: ?>

        <div class="card-body p-0">

            <?php

            // Generate moduleSlug array.
            foreach ($userPermissions->result as $userPermission) {
                $moduleSlugs[] = $userPermission->moduleSlug;
            }

            // Remove duplicate values from moduleSlug array.
            $distinctModuleSlugs = array_unique($moduleSlugs);

            // Restructure default returned result set into grouped array.
            foreach ($distinctModuleSlugs as $distinctModuleSlug) {
                foreach ($userPermissions->result as $userPermission) {
                    if ($distinctModuleSlug == $userPermission->moduleSlug) {
                        $userPermissionModules[$distinctModuleSlug][] = $userPermission;
                    }
                }
            }

            // Calculate total number of table columns to set 'colspan' HTML attribute in module name <td></td> tags.
            $numCols = 1; // Set initial value.

            $numRoles = (int) $userRoles->numRows;

            $numCols += $numRoles;

            ?>

            <div class="table-responsive _custom_scrollbar">
                <table class="table table-borderless table-hover table-striped mb-0" _fixed_header>
                    <thead class="border-bottom thead-light">
                        <tr>
                            <th class="align-middle" scope="col">
                                Permission
                            </th>

                            <?php

                            if (!empty($userRoles->result)):
                            foreach($userRoles->result as $userRole):

                            ?>

                            <th class="align-middle text-center" scope="col">
                                <?php echo $userRole->roleName; ?> <br><span class="badge badge-pill badge-light font-weight-normal mt-1"><i class="fas fa-circle <?php echo (strtolower($userRole->state) == 'active' ? 'text-success' : 'text-danger'); ?>" title="<?php echo (strtolower($userRole->state) == 'active' ? 'Active user role' : 'Inactive user role'); ?>"></i> Role</span>
                            </th>

                            <?php

                            endforeach;
                            endif;

                            ?>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($userPermissionModules as $moduleSlug => $userPermissionModule): ?>

                        <tr>
                            <td class="font-weight-bold text-secondary table-secondary" colspan="<?php echo $numCols; ?>">
                                <?php echo ucfirst(str_replace('_', ' ', $moduleSlug)); ?> module <span class="badge badge-pill badge-secondary"><?php echo count($userPermissionModule); ?></span>
                            </td>
                        </tr>

                        <?php foreach ($userPermissionModule as $permission): ?>

                        <tr>
                            <td>
                                <div class="mb-1">
                                    <a class="d-inline-block text-info" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3), 'edit', $permission->ID]); ?>" title="Edit user permission">
                                        <i class="fas fa-edit fa-fw"></i>
                                    </a>
                                    <?php echo $permission->permissionName; ?> <small class="text-muted"><?php echo $permission->permissionType; ?></small>
                                </div>

                                <?php if (strtolower($permission->state) == 'active'): ?>
                                <span class="badge badge-pill badge-success font-weight-normal" title="Active permission"><?php echo $permission->permissionKey; ?></span>
                                <?php else: ?>
                                <span class="badge badge-pill badge-danger font-weight-normal" title="Inactive permission"><?php echo $permission->permissionKey; ?></span>
                                <?php endif; ?>

                                <?php if (!empty($permission->permissionDescription)): ?>
                                <div class="mt-1 small font-italic">
                                    <?php echo $permission->permissionDescription; ?>
                                </div>
                                <?php endif; ?>
                            </td>

                            <?php

                            if (!empty($userRoles->result)):
                            foreach($userRoles->result as $userRole):

                            if (empty($userRole->data)) {
                                $userRolePermissions = [];
                            } else {
                                $userRolePermissions = array_keys(unserialize($userRole->data)['permissions']);
                            }

                            ?>

                            <td class="text-center align-middle">
                                <div class="custom-control custom-switch">
                                    <input type="hidden" name="roles[<?php echo $userRole->ID; ?>][<?php echo $permission->permissionKey; ?>]" value="0">
                                    <input type="checkbox" class="custom-control-input" id="<?php echo $userRole->ID; ?>_<?php echo $permission->ID; ?>" name="roles[<?php echo $userRole->ID; ?>][<?php echo $permission->permissionKey; ?>]" value="<?php echo $permission->state; ?>" <?php echo (in_array($permission->permissionKey, $userRolePermissions) ? 'checked' : ''); ?>>
                                    <label class="custom-control-label" for="<?php echo $userRole->ID; ?>_<?php echo $permission->ID; ?>"></label>
                                </div>
                            </td>

                            <?php

                            endforeach;
                            endif;

                            ?>
                        </tr>

                        <?php endforeach; ?>

                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

        </div>

        <?php endif; ?>

    </div>

    <?php if (!empty($userRoles->result) && !empty($userPermissions->result)): ?>
    <button type="submit" class="btn btn-primary float-right" name="submit">Save</button>
    <?php endif; ?>
</form>

<?php

// Calling common adminend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/footer'); ?>
