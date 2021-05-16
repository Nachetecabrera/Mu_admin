<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| User roles view file
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
 * Complete user roles template.
 */

// Calling common adminend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/header'); ?>

<nav class="navbar navbar-expand-md navbar-light px-0 py-3">
    <span class="navbar-brand mb-0 h1">
        User roles

        <?php if (!empty($userRoles->numRows)): ?>
        <span class="badge badge-pill badge-secondary"><?php echo $userRoles->numRows; ?></span>
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

    <?php if (empty($userRoles->result)): ?>

    <div class="card-body">
        No user roles found.
    </div>

    <?php else: ?>

    <div class="card-body p-0">
        <div class="table-responsive _custom_scrollbar">
            <table class="table table-borderless table-hover table-striped mb-0" _fixed_header>
                <colgroup>
                    <col class="bg-light">
                </colgroup>
                <thead class="border-bottom thead-light">
                    <tr>
                        <th class="bg-light _table_cell_shrink" scope="col">
                            <i class="fas fa-edit fa-fw _opacity_0"></i>
                        </th>
                        <th scope="col">
                            <a class="d-block text-secondary" href="<?php echo $this->crud->sortingLink('roleName', 'ASC', $userRoles->sortingInfo->orderBy, $userRoles->sortingInfo->order); ?>">
                                <span class="text-nowrap">Name <?php echo $this->crud->sortingIcon('roleName', $userRoles->sortingInfo->orderBy, $userRoles->sortingInfo->order); ?></span>
                            </a>
                        </th>
                        <th scope="col">
                            <a class="d-block text-secondary" href="<?php echo $this->crud->sortingLink('roleDescription', 'ASC', $userRoles->sortingInfo->orderBy, $userRoles->sortingInfo->order); ?>">
                                <span class="text-nowrap">Description <?php echo $this->crud->sortingIcon('roleDescription', $userRoles->sortingInfo->orderBy, $userRoles->sortingInfo->order); ?></span>
                            </a>
                        </th>
                        <th scope="col">
                            <a class="d-block text-secondary" href="<?php echo $this->crud->sortingLink('roleSlug', 'ASC', $userRoles->sortingInfo->orderBy, $userRoles->sortingInfo->order); ?>">
                                <span class="text-nowrap">Slug <?php echo $this->crud->sortingIcon('roleSlug', $userRoles->sortingInfo->orderBy, $userRoles->sortingInfo->order); ?></span>
                            </a>
                        </th>
                        <th scope="col">
                            <a class="d-block text-secondary" href="<?php echo $this->crud->sortingLink('userCount', 'ASC', $userRoles->sortingInfo->orderBy, $userRoles->sortingInfo->order); ?>">
                                <span class="text-nowrap"><i class="fas fa-user-friends fa-fw" title="User count"></i> <?php echo $this->crud->sortingIcon('userCount', $userRoles->sortingInfo->orderBy, $userRoles->sortingInfo->order); ?></span>
                            </a>
                        </th>
                        <th scope="col">
                            <a class="d-block text-secondary" href="<?php echo $this->crud->sortingLink('permissionCount', 'ASC', $userRoles->sortingInfo->orderBy, $userRoles->sortingInfo->order); ?>">
                                <span class="text-nowrap"><i class="fas fa-lock fa-fw" title="Permission count"></i> <?php echo $this->crud->sortingIcon('permissionCount', $userRoles->sortingInfo->orderBy, $userRoles->sortingInfo->order); ?></span>
                            </a>
                        </th>
                        <?php if (strtolower($this->input->get('filterby', true)) != 'state'): ?>
                        <th scope="col">
                            <a class="d-block text-secondary" href="<?php echo $this->crud->sortingLink('state', 'ASC', $userRoles->sortingInfo->orderBy, $userRoles->sortingInfo->order); ?>">
                                <span class="text-nowrap">State <?php echo $this->crud->sortingIcon('state', $userRoles->sortingInfo->orderBy, $userRoles->sortingInfo->order); ?></span>
                            </a>
                        </th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($userRoles->result as $userRole): ?>

                    <tr>
                        <td>
                            <a class="d-inline-block text-info" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3), 'edit', $userRole->ID]); ?>" title="Edit user role">
                                <i class="fas fa-edit fa-fw"></i>
                            </a>
                        </td>
                        <td><?php echo $userRole->roleName; ?></td>
                        <td><?php echo $userRole->roleDescription; ?></td>
                        <td><?php echo $userRole->roleSlug; ?></td>
                        <td>
                            <a class="badge badge-pill badge-secondary" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2)]); ?>?filterby=roleID&filter=<?php echo $userRole->ID; ?>">
                                <?php echo $userRole->userCount; ?>
                            </a>
                        </td>
                        <td>
                            <a class="badge badge-pill badge-secondary" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), 'permissions']); ?>?filterby=ID&filter=<?php echo $userRole->ID; ?>">
                                <?php echo $userRole->permissionCount; ?>
                            </a>
                        </td>
                        <?php if (strtolower($this->input->get('filterby', true)) != 'state'): ?>
                        <td>
                            <?php if (strtolower($userRole->state) == 'active'): ?>
                            <span class="badge badge-pill badge-success font-weight-normal"><?php echo ucfirst($userRole->state); ?></span>
                            <?php elseif (strtolower($userRole->state) == 'inactive'): ?>
                            <span class="badge badge-pill badge-danger font-weight-normal"><?php echo ucfirst($userRole->state); ?></span>
                            <?php else: ?>
                            <span class="badge badge-pill badge-secondary font-weight-normal"><?php echo ucfirst($userRole->state); ?></span>
                            <?php endif; ?>
                        </td>
                        <?php endif; ?>
                    </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

    <?php endif; ?>

</div>

<?php if (!empty($userRoles->result)): ?>

<nav class="mb-3" aria-label="Pagination">
    <ul class="pagination justify-content-end flex-wrap mb-0">
        <li class="page-item disabled">
            <span class="page-link">
                Showing

                <?php if ($paginationInfo->pageStartRow == $paginationInfo->pageEndRow): ?>
                <?php echo $paginationInfo->pageStartRow; ?>
                <?php else: ?>
                <?php echo $paginationInfo->pageStartRow; ?> - <?php echo $paginationInfo->pageEndRow; ?>
                <?php endif; ?>

                of

                <?php echo $paginationInfo->totalRows; ?>

                <?php if ($paginationInfo->totalRows > 1): ?>
                user roles
                <?php else: ?>
                user role
                <?php endif; ?>

                in

                <?php echo $paginationInfo->totalPages; ?>

                <?php if ($paginationInfo->totalPages > 1): ?>
                pages
                <?php else: ?>
                page
                <?php endif; ?>
            </span>
        </li>

        <?php echo $pagination; ?>
    </ul>
</nav>

<?php endif; ?>

<?php

// Calling common adminend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/footer'); ?>
