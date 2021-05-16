<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Users view file
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
 * Complete users template.
 */

// Calling common adminend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/header'); ?>

<nav class="navbar navbar-expand-md navbar-light px-0 py-3">
    <span class="navbar-brand mb-0 h1">
        Users

        <?php if (!empty($users->numRows)): ?>
        <span class="badge badge-pill badge-secondary"><?php echo $users->numRows; ?></span>
        <?php endif; ?>
    </span>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#crudMainNavbar" aria-controls="crudMainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="crudMainNavbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), 'add']); ?>">Add new</a>
            </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0" method="get" action="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2)]); ?>">
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
                        <a class="nav-link p-md-0 mr-md-3" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2)]); ?>">
                            All
                        </a>
                    </li>

                    <li class="nav-item <?php

                        if ($this->input->get('filterby', true) == 'state' && $this->input->get('filter', true) == 'active') {
                            echo 'active';
                        }

                        ?>">
                        <a class="nav-link p-md-0 mr-md-3" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2)]); ?>?filterby=state&filter=active">
                            Active
                        </a>
                    </li>

                    <li class="nav-item <?php

                        if ($this->input->get('filterby', true) == 'state' && $this->input->get('filter', true) == 'inactive') {
                            echo 'active';
                        }

                        ?>">
                        <a class="nav-link p-md-0 mr-md-3" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2)]); ?>?filterby=state&filter=inactive">
                            Inactive
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <?php if (empty($users->result)): ?>

    <div class="card-body">
        No users found.
    </div>

    <?php else: ?>

    <div class="card-body p-0">
        <?php if (isset($userFilter)): ?>
        <div class="px-3 py-2 border-bottom bg-light"><span class="text-muted">Users under:</span> <?php echo $userFilter->filterValue; ?> user <?php echo $userFilter->filterName; ?><?php echo (strtolower($userFilter->filterValueState) == 'inactive' ? ' (Inactive)' : ''); ?>.</div>
        <?php endif; ?>
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
                            <a class="d-block text-secondary" href="<?php echo $this->crud->sortingLink('ID', 'ASC', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?>">
                                <span class="text-nowrap">ID <?php echo $this->crud->sortingIcon('ID', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?></span>
                            </a>
                        </th>
                        <th scope="col">
                            <a class="d-block text-secondary" href="<?php echo $this->crud->sortingLink('firstName', 'ASC', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?>">
                                <span class="text-nowrap">First name <?php echo $this->crud->sortingIcon('firstName', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?></span>
                            </a>
                        </th>
                        <th scope="col">
                            <a class="d-block text-secondary" href="<?php echo $this->crud->sortingLink('surname', 'ASC', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?>">
                                <span class="text-nowrap">Surname <?php echo $this->crud->sortingIcon('surname', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?></span>
                            </a>
                        </th>
                        <th scope="col">
                            <a class="d-block text-secondary" href="<?php echo $this->crud->sortingLink('username', 'ASC', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?>">
                                <span class="text-nowrap">Username <?php echo $this->crud->sortingIcon('username', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?></span>
                            </a>
                        </th>
                        <th scope="col">
                            <a class="text-secondary" href="<?php echo $this->crud->sortingLink('email', 'ASC', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?>">
                                <span class="text-nowrap">Email <?php echo $this->crud->sortingIcon('email', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?></span>
                            </a>
                            <a class="text-secondary" href="<?php echo $this->crud->sortingLink('emailVerification', 'ASC', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?>">
                                <span class="text-nowrap"><i class="fas fa-check-circle" title="Email verification"></i> <?php echo $this->crud->sortingIcon('emailVerification', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?></span>
                            </a>
                        </th>
                        <th scope="col">
                            <a class="d-block text-secondary" href="<?php echo $this->crud->sortingLink('datetimeCreated', 'ASC', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?>">
                                <span class="text-nowrap">Registered <?php echo $this->crud->sortingIcon('datetimeCreated', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?></span>
                            </a>
                        </th>
                        <th scope="col">
                            <a class="d-block text-secondary" href="<?php echo $this->crud->sortingLink('datetimeLastActivity', 'ASC', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?>">
                                <span class="text-nowrap">Last active <?php echo $this->crud->sortingIcon('datetimeLastActivity', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?></span>
                            </a>
                        </th>
                        <th scope="col">
                            Status
                        </th>
                        <th scope="col">
                            Tags
                        </th>
                        <th scope="col">
                            Roles
                        </th>
                        <th scope="col">
                            Groups
                        </th>
                        <?php if (strtolower($this->input->get('filterby', true)) != 'state'): ?>
                        <th scope="col">
                            <a class="d-block text-secondary" href="<?php echo $this->crud->sortingLink('state', 'ASC', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?>">
                                <span class="text-nowrap">State <?php echo $this->crud->sortingIcon('state', $users->sortingInfo->orderBy, $users->sortingInfo->order); ?></span>
                            </a>
                        </th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($users->result as $user): ?>

                    <tr>
                        <td>
                            <a class="d-inline-block text-info" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), 'edit', $user->ID]); ?>" title="Edit user">
                                <i class="fas fa-edit fa-fw"></i>
                            </a>
                        </td>
                        <td><?php echo $user->ID; ?></td>
                        <td>
                            <?php echo $user->firstName; ?>
                            <?php if ($this->user->isOnline($user->datetimeLastActivity)): ?>
                            <small><i class="fas fa-circle text-success small" title="Online"></i></small>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $user->surname; ?></td>
                        <td><?php echo $user->username; ?></td>
                        <td>
                            <span class="text-nowrap">
                                <?php if ($user->emailVerification): ?>
                                <i class="fas fa-check-circle text-primary" title="Verified"></i>
                                <?php else: ?>
                                <i class="fas fa-exclamation-circle text-secondary" title="Unverified"></i>
                                <?php endif; ?>
                                <a href="mailto:<?php echo strtolower($user->email); ?>">
                                    <?php echo strtolower($user->email); ?>
                                </a>
                            </span>
                        </td>
                        <td title="<?php echo timespan(strtotime($user->datetimeCreated), time()); ?> ago">
                            <?php echo $user->datetimeCreated; ?>
                        </td>
                        <td title="<?php echo timespan(strtotime($user->datetimeLastActivity), time()); ?> ago">
                            <?php echo $user->datetimeLastActivity; ?>
                        </td>
                        <td>
                            <?php if (empty($user->statusName)): ?>
                                —
                            <?php else: ?>
                                <a class="text-nowrap" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2)]); ?>?filterby=statusID&filter=<?php echo $user->statusID; ?>">
                                    <?php echo $user->statusName; ?><?php echo ($user->statusState == 'inactive' ? ' <span class="badge badge-pill badge-secondary font-weight-normal">Inactive</span>' : ''); ?>
                                </a>
                            <?php endif; ?>
                        </td>
                        <td <?php echo ($user->tagCount == 1 ? 'class="text-nowrap"' : ''); ?>>
                            <?php if (empty($user->tagCount)): ?>
                                —
                            <?php else: ?>

                                <?php

                                $tagIDs = explode(',', $user->tagIDs);
                                $tagNames = explode(',', $user->tagNames);
                                $tagStates = explode(',', $user->tagStates);

                                foreach ($tagIDs as $key => $tagID) {
                                    $tagLinks[] = '<a href="' . site_url([$this->uri->segment(1), $this->uri->segment(2)]) . '?filterby=tagID&filter=' . $tagID . '"><span class="text-nowrap">' . $tagNames[$key] . ($tagStates[$key] == 'inactive' ? ' <span class="badge badge-pill badge-secondary font-weight-normal">Inactive</span>' : '') . '</span></a>';
                                }

                                ?>

                                <span class="badge badge-pill _badge_light"><?php echo $user->tagCount; ?></span>

                                <?php

                                echo implode(', ', $tagLinks);
                                $tagLinks = [];

                                ?>

                            <?php endif; ?>
                        </td>
                        <td <?php echo ($user->roleCount == 1 ? 'class="text-nowrap"' : ''); ?>>
                            <?php if (empty($user->roleCount)): ?>
                                —
                            <?php else: ?>

                                <?php

                                $roleIDs = explode(',', $user->roleIDs);
                                $roleNames = explode(',', $user->roleNames);
                                $roleStates = explode(',', $user->roleStates);

                                foreach ($roleIDs as $key => $roleID) {
                                    $roleLinks[] = '<a href="' . site_url([$this->uri->segment(1), $this->uri->segment(2)]) . '?filterby=roleID&filter=' . $roleID . '"><span class="text-nowrap">' . $roleNames[$key] . ($roleStates[$key] == 'inactive' ? ' <span class="badge badge-pill badge-secondary font-weight-normal">Inactive</span>' : '') . '</span></a>';
                                }

                                ?>

                                <span class="badge badge-pill _badge_light"><?php echo $user->roleCount; ?></span>

                                <?php

                                echo implode(', ', $roleLinks);
                                $roleLinks = [];

                                ?>

                            <?php endif; ?>
                        </td>
                        <td <?php echo ($user->groupCount == 1 ? 'class="text-nowrap"' : ''); ?>>
                            <?php if (empty($user->groupCount)): ?>
                                —
                            <?php else: ?>

                                <?php

                                $groupIDs = explode(',', $user->groupIDs);
                                $groupNames = explode(',', $user->groupNames);
                                $groupStates = explode(',', $user->groupStates);

                                foreach ($groupIDs as $key => $groupID) {
                                    $groupLinks[] = '<a href="' . site_url([$this->uri->segment(1), $this->uri->segment(2)]) . '?filterby=groupID&filter=' . $groupID . '"><span class="text-nowrap">' . $groupNames[$key] . ($groupStates[$key] == 'inactive' ? ' <span class="badge badge-pill badge-secondary font-weight-normal">Inactive</span>' : '') . '</span></a>';
                                }

                                ?>

                                <span class="badge badge-pill _badge_light"><?php echo $user->groupCount; ?></span>

                                <?php

                                echo implode(', ', $groupLinks);
                                $groupLinks = [];

                                ?>

                            <?php endif; ?>
                        </td>
                        <?php if (strtolower($this->input->get('filterby', true)) != 'state'): ?>
                        <td>
                            <?php if (strtolower($user->state) == 'active'): ?>
                            <span class="badge badge-pill badge-success font-weight-normal"><?php echo ucfirst($user->state); ?></span>
                            <?php elseif (strtolower($user->state) == 'inactive'): ?>
                            <span class="badge badge-pill badge-danger font-weight-normal"><?php echo ucfirst($user->state); ?></span>
                            <?php else: ?>
                            <span class="badge badge-pill badge-secondary font-weight-normal"><?php echo ucfirst($user->state); ?></span>
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

<?php if (!empty($users->result)): ?>

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
                users
                <?php else: ?>
                user
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
