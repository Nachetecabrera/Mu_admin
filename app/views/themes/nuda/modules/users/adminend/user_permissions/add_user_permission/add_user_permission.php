<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Add user permission view file
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
 * Complete add new user permission template.
 */

// Calling common adminend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/header'); ?>

<div class="container p-0">
    <nav class="py-3">
        <span class="navbar-brand mb-0 h1">Add user permission</span>
    </nav>

    <?php if ($this->session->flashdata('addUserPermissionSuccess') === true): ?>
    <div class="alert alert-success alert-dismissible fade show animated faster fadeIn" role="alert" _auto_close="15000">
        <i class="fas fa-check-circle mr-1"></i> User permission was successfully added. <a class="alert-link" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3), 'edit', $this->session->flashdata('insertID')]); ?>">edit that user permission</a> or <a class="alert-link" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3)]); ?>">check all user permissions</a>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('addUserPermissionSuccess') === false): ?>
    <div class="alert alert-danger alert-dismissible fade show animated faster shake" role="alert" _auto_close="15000">
        <i class="fas fa-times-circle mr-1"></i> Add user permission process was unsuccessful due to an internal error. please try again later.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <?php endif; ?>

    <form class="mb-3 clearfix" method="POST">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <div class="card mb-3">
            <div class="card-body">
                <div class="form-group">
                    <label for="userPermissionModuleSlug">Module slug</label>
                    <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('userPermissionModuleSlug')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="userPermissionModuleSlug" name="userPermissionModuleSlug" value="<?php echo set_value('userPermissionModuleSlug'); ?>" aria-describedby="userPermissionModuleSlugHelp" placeholder="Enter user permission module slug" autofocus required>

                    <?php if (isset($_POST['submit']) && !empty(form_error('userPermissionModuleSlug'))): ?>
                        <div class="invalid-feedback">
                            <ul class="list-unstyled m-0" _last_child_mb_0>
                                <?php echo form_error('userPermissionModuleSlug'); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <small id="userPermissionModuleSlugHelp" class="form-text text-muted">Letters should be all lowercase & words should concatenate by underscore. e.g., module, my_module, my_module_two.</small>
                </div>

                <div class="form-group">
                    <label for="userPermissionName">Name</label>
                    <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('userPermissionName')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="userPermissionName" name="userPermissionName" value="<?php echo set_value('userPermissionName'); ?>" aria-describedby="userPermissionNameHelp" placeholder="Enter user permission name" autofocus required>

                    <?php if (isset($_POST['submit']) && !empty(form_error('userPermissionName'))): ?>
                        <div class="invalid-feedback">
                            <ul class="list-unstyled m-0" _last_child_mb_0>
                                <?php echo form_error('userPermissionName'); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <small id="userPermissionNameHelp" class="form-text text-muted">The name is how it appears on the system.</small>
                </div>

                <div class="form-group">
                    <label for="userPermissionKey">Key</label>
                    <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('userPermissionKey')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="userPermissionKey" name="userPermissionKey" value="<?php echo set_value('userPermissionKey'); ?>" aria-describedby="userPermissionKeyHelp" placeholder="Enter user permission key" required>

                    <?php if (isset($_POST['submit']) && !empty(form_error('userPermissionKey'))): ?>
                        <div class="invalid-feedback">
                            <ul class="list-unstyled m-0" _last_child_mb_0>
                                <?php echo form_error('userPermissionKey'); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <small id="userPermissionKeyHelp" class="form-text text-muted">Permission key should be prefixed by corresponding module slug using underscore & permission key should follow camelcase naming convention. e.g., module_myPermissionKey, my_module_justAnotherPermissionKey.</small>
                </div>

                <div class="form-group mb-0">
                    <label for="userPermissionDescription">Description</label> <i class="small text-muted">(Optional)</i>
                    <textarea class="form-control" id="userPermissionDescription" name="userPermissionDescription" rows="4" placeholder="Enter user permission description"><?php echo set_value('userPermissionDescription'); ?></textarea>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">
                    <button class="btn btn-link p-0 border-0 <?php echo (isset($_POST['submit']) ? (empty(form_error('state')) ? 'text-success' : 'text-danger') : ''); ?>" type="button" data-toggle="collapse" data-target="#state" aria-expanded="false" aria-controls="state">
                        State
                    </button>
                </h5>
            </div>

            <div id="state" class="collapse">
                <div class="card-body">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="stateActive" name="state" value="active" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('state')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo set_radio('state', 'active', true); ?> required>
                        <label class="custom-control-label" for="stateActive">Active</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="stateInactive" name="state" value="inactive" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('state')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo set_radio('state', 'inactive'); ?>>
                        <label class="custom-control-label" for="stateInactive">Inactive</label>
                    </div>

                    <?php if (isset($_POST['submit']) && !empty(form_error('state'))): ?>
                        <div class="invalid-feedback d-block">
                            <ul class="list-unstyled m-0" _last_child_mb_0>
                                <?php echo form_error('state'); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary float-right" name="submit">Save</button>
    </form>
</div>

<?php

// Calling common adminend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/footer'); ?>
