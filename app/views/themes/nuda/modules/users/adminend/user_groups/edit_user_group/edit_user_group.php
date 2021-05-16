<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Edit user group view file
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
 * Complete edit user group template.
 */

// Calling common adminend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/header'); ?>

<div class="container p-0">
    <nav class="py-3">
        <span class="navbar-brand mb-0 h1">Edit user group</span>
    </nav>

    <?php if ($this->session->flashdata('editUserGroupSuccess') === true): ?>
    <div class="alert alert-success alert-dismissible fade show animated faster fadeIn" role="alert" _auto_close="15000">
        <i class="fas fa-check-circle mr-1"></i> The changes were successfully saved. <a class="alert-link" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3)]); ?>">check all user groups</a>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('editUserGroupSuccess') === false): ?>
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
            <div class="card-body">
                <div class="form-group">
                    <label for="userGroupName">Name</label>
                    <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('userGroupName')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="userGroupName" name="userGroupName" value="<?php echo ($this->input->post('userGroupName') === null ? $userGroup->groupName : set_value('userGroupName')); ?>" aria-describedby="userGroupNameHelp" placeholder="Enter user group name" autofocus required>

                    <?php if (isset($_POST['submit']) && !empty(form_error('userGroupName'))): ?>
                        <div class="invalid-feedback">
                            <ul class="list-unstyled m-0" _last_child_mb_0>
                                <?php echo form_error('userGroupName'); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <small id="userGroupNameHelp" class="form-text text-muted">The name is how it appears on the system.</small>
                </div>

                <div class="form-group">
                    <label for="userGroupSlug">Slug</label>
                    <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('userGroupSlug')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="userGroupSlug" name="userGroupSlug" value="<?php echo ($this->input->post('userGroupSlug') === null ? $userGroup->groupSlug : set_value('userGroupSlug')); ?>" aria-describedby="userGroupSlugHelp" placeholder="Enter user group slug" required>

                    <?php if (isset($_POST['submit']) && !empty(form_error('userGroupSlug'))): ?>
                        <div class="invalid-feedback">
                            <ul class="list-unstyled m-0" _last_child_mb_0>
                                <?php echo form_error('userGroupSlug'); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <small id="userGroupSlugHelp" class="form-text text-muted">The “slug” is the URL-friendly version of the user group name. it's usually all lowercase and contains only letters, numbers, and hyphens. e.g., my-slug, my-slug-02.</small>
                </div>

                <div class="form-group mb-0">
                    <label for="userGroupDescription">Description</label> <i class="small text-muted">(Optional)</i>
                    <textarea class="form-control" id="userGroupDescription" name="userGroupDescription" rows="4" placeholder="Enter user group description"><?php echo ($this->input->post('userGroupDescription') === null ? $userGroup->groupDescription : set_value('userGroupDescription')); ?></textarea>
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
                        <input type="radio" id="stateActive" name="state" value="active" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('state')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo ($this->input->post('state') === null ? ($userGroup->state == 'active' ? 'checked' : '') : set_radio('state', 'active')); ?> required>
                        <label class="custom-control-label" for="stateActive">Active</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="stateInactive" name="state" value="inactive" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('state')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo ($this->input->post('state') === null ? ($userGroup->state == 'inactive' ? 'checked' : '') : set_radio('state', 'inactive')); ?>>
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
