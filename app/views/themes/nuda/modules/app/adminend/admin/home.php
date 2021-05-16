<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Home view file
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
 * Complete home template.
 */

// Calling common adminend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/header'); ?>

<div class="container p-0">

    <nav class="py-3">
        <span class="navbar-brand mb-0 h1">Home</span>
    </nav>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text small text-muted">Manage users, user statuses,  user tags, user roles, user groups & user permissions.</p>
                </div>
                <ul class="list-group list-group-flush border-top mb-3">
                    <a href="<?php echo site_url(['admin', 'users']); ?>?filterby=state&filter=active" class="list-group-item list-group-item-action text-primary">List users</a>
                    <a href="<?php echo site_url(['admin', 'users', 'add']); ?>" class="list-group-item list-group-item-action text-primary">Add new user</a>
                    <a href="<?php echo site_url(['admin', 'users', 'overview']); ?>" class="list-group-item list-group-item-action text-primary">View user overview</a>
                </ul>

                <div class="card-body">
                    <h6 class="card-title m-0">User statuses</h6>
                </div>
                <ul class="list-group list-group-flush border-top mb-3">
                    <a href="<?php echo site_url(['admin', 'users', 'statuses']); ?>?filterby=state&filter=active" class="list-group-item list-group-item-action text-primary">List user statuses</a>
                    <a href="<?php echo site_url(['admin', 'users', 'statuses', 'add']); ?>" class="list-group-item list-group-item-action text-primary">Add new user status</a>
                </ul>

                <div class="card-body">
                    <h6 class="card-title m-0">User tags</h6>
                </div>
                <ul class="list-group list-group-flush border-top mb-3">
                    <a href="<?php echo site_url(['admin', 'users', 'tags']); ?>?filterby=state&filter=active" class="list-group-item list-group-item-action text-primary">List user tags</a>
                    <a href="<?php echo site_url(['admin', 'users', 'tags', 'add']); ?>" class="list-group-item list-group-item-action text-primary">Add new user tag</a>
                </ul>

                <div class="card-body">
                    <h6 class="card-title m-0">User roles</h6>
                </div>
                <ul class="list-group list-group-flush border-top mb-3">
                    <a href="<?php echo site_url(['admin', 'users', 'roles']); ?>?filterby=state&filter=active" class="list-group-item list-group-item-action text-primary">List user roles</a>
                    <a href="<?php echo site_url(['admin', 'users', 'roles', 'add']); ?>" class="list-group-item list-group-item-action text-primary">Add new user role</a>
                </ul>

                <div class="card-body">
                    <h6 class="card-title m-0">User groups</h6>
                </div>
                <ul class="list-group list-group-flush border-top mb-3">
                    <a href="<?php echo site_url(['admin', 'users', 'groups']); ?>?filterby=state&filter=active" class="list-group-item list-group-item-action text-primary">List user groups</a>
                    <a href="<?php echo site_url(['admin', 'users', 'groups', 'add']); ?>" class="list-group-item list-group-item-action text-primary">Add new user group</a>
                </ul>

                <div class="card-body">
                    <h6 class="card-title m-0">User permissions</h6>
                </div>
                <ul class="list-group list-group-flush border-top">
                    <a href="<?php echo site_url(['admin', 'users', 'permissions']); ?>?filterby=state&filter=active" class="list-group-item list-group-item-action text-primary">List user permissions</a>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">System</h5>
                    <p class="card-text small text-muted">Manage system related stuff.</p>
                </div>
                <ul class="list-group list-group-flush border-top">
                    <a href="<?php echo site_url(['admin', 'system', 'settings', 'app']); ?>" class="list-group-item list-group-item-action text-primary">System settings</a>
                </ul>
            </div>
        </div>
    </div>

</div>

<?php

// Calling common adminend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/footer'); ?>
