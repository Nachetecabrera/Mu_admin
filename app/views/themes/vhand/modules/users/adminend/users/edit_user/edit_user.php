<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Edit user view file
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
 * Complete edit user template.
 */

// CSS file injections.
$data['injections']['header']['files']['css'] = [
    base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'adminend', 'libs', 'flatpickr-4.5.2', 'css' , 'flatpickr.min.css']),
    base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'adminend', 'libs', 'select2-4.0.6-rc.0', 'css' , 'select2.min.css'])
];

// Calling common adminend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/header', $data); ?>

<div class="container p-0">
    <nav class="py-3">
        <span class="navbar-brand mb-0 h1">Edit user</span>
    </nav>

    <?php if ($this->session->flashdata('editUserSuccess') === true): ?>
    <div class="alert alert-success alert-dismissible fade show animated faster fadeIn" role="alert" _auto_close="15000">
        <i class="fas fa-check-circle mr-1"></i> The changes were successfully saved. <a class="alert-link" href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2)]); ?>">check all users</a>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('editUserSuccess') === false): ?>
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
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('firstName')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="firstName" name="firstName" value="<?php echo ($this->input->post('firstName') === null ? $user->firstName : set_value('firstName')); ?>" placeholder="Enter first name" autofocus required>

                        <?php if (isset($_POST['submit']) && !empty(form_error('firstName'))): ?>
                        <div class="invalid-feedback">
                            <ul class="list-unstyled m-0" _last_child_mb_0>
                                <?php echo form_error('firstName'); ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('surname')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="surname" name="surname" value="<?php echo ($this->input->post('surname') === null ? $user->surname : set_value('surname')); ?>" placeholder="Enter surname" required>

                        <?php if (isset($_POST['submit']) && !empty(form_error('surname'))): ?>
                        <div class="invalid-feedback">
                            <ul class="list-unstyled m-0" _last_child_mb_0>
                                <?php echo form_error('surname'); ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('username')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="username" name="username" value="<?php echo ($this->input->post('username') === null ? $user->username : set_value('username')); ?>" placeholder="Pick a username" required>

                    <?php if (isset($_POST['submit']) && !empty(form_error('username'))): ?>
                        <div class="invalid-feedback">
                            <ul class="list-unstyled m-0" _last_child_mb_0>
                                <?php echo form_error('username'); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('email')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="email" name="email" value="<?php echo ($this->input->post('email') === null ? $user->email : set_value('email')); ?>" placeholder="Enter email" required>

                    <?php if (isset($_POST['submit']) && !empty(form_error('email'))): ?>
                        <div class="invalid-feedback">
                            <ul class="list-unstyled m-0" _last_child_mb_0>
                                <?php echo form_error('email'); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group mb-0">
                    <label class="d-block" for="emailVerified">Email verification</label>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="emailVerified" name="emailVerification" value="1" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('emailVerification')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo ($this->input->post('emailVerification') === null ? ($user->emailVerification == '1' ? 'checked' : '') : set_radio('emailVerification', '1')); ?> required>
                        <label class="custom-control-label" for="emailVerified">Verified</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="emailUnverified" name="emailVerification" value="0" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('emailVerification')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo ($this->input->post('emailVerification') === null ? ($user->emailVerification == '0' ? 'checked' : '') : set_radio('emailVerification', '0')); ?>>
                        <label class="custom-control-label" for="emailUnverified">Unverified</label>
                    </div>

                    <?php if (isset($_POST['submit']) && !empty(form_error('emailVerification'))): ?>
                        <div class="invalid-feedback d-block">
                            <ul class="list-unstyled m-0" _last_child_mb_0>
                                <?php echo form_error('emailVerification'); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0 d-inline">
                    <button class="btn btn-link p-0 border-0 <?php echo (isset($_POST['submit']) ? (empty(form_error('status')) ? '' : 'text-danger') : ''); ?>" type="button" data-toggle="collapse" data-target="#userStatus" aria-expanded="false" aria-controls="userStatus">
                        Status
                    </button>
                </h5>
                <i class="small text-muted">(Optional)</i>
            </div>

            <div id="userStatus" class="collapse">
                <div class="card-body">
                    <?php if (empty($userStatuses->result)): ?>
                    No user statuses found. <a href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), 'statuses', 'add']); ?>">add user statuses</a>.
                    <?php else: ?>
                    <div class="form-group mb-0">
                        <select class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('status')) ? '' : 'is-invalid') : ''); ?>" name="status" placeholder="Select a status">
                            <option></option>
                            <?php foreach ($userStatuses->result as $userStatus): ?>
                            <option value="<?php echo $userStatus->ID; ?>" <?php echo ($this->input->post('status') === null ? ($userStatus->ID == $user->statusID ? 'selected' : '') : set_select('status', $userStatus->ID)); ?>><?php echo $userStatus->statusName; ?> (<?php echo $userStatus->userCount; ?>) <?php echo ($userStatus->state == 'inactive' ? 'Inactive' : ''); ?></option>
                            <?php endforeach; ?>
                        </select>

                        <?php if (isset($_POST['submit']) && !empty(form_error('status'))): ?>
                            <div class="invalid-feedback">
                                <ul class="list-unstyled m-0" _last_child_mb_0>
                                    <?php echo form_error('status'); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0 d-inline">
                    <button class="btn btn-link p-0 border-0 <?php echo (isset($_POST['submit']) ? (empty(form_error('tags')) ? '' : 'text-danger') : ''); ?>" type="button" data-toggle="collapse" data-target="#userTags" aria-expanded="false" aria-controls="userTags">
                        Tags
                    </button>
                </h5>
                <i class="small text-muted">(Optional)</i>
            </div>

            <div id="userTags" class="collapse">
                <div class="card-body">
                    <?php if (empty($userTags->result)): ?>
                    No user tags found. <a href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), 'tags', 'add']); ?>">add user tags</a>.
                    <?php else: ?>
                    <div class="form-group mb-0">
                        <select class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('tags')) ? '' : 'is-invalid') : ''); ?>" name="tags[]" data-placeholder="Select tags" multiple>
                            <?php foreach ($userTags->result as $userTag): ?>
                            <option value="<?php echo $userTag->ID; ?>" <?php echo ($this->input->input_stream('tags') === null ? (in_array($userTag->ID, explode(',', $user->tagIDs)) ? 'selected' : '') : set_select('tags', $userTag->ID)); ?>><?php echo $userTag->tagName; ?> (<?php echo $userTag->userCount; ?>) <?php echo ($userTag->state == 'inactive' ? 'Inactive' : ''); ?></option>
                            <?php endforeach; ?>
                        </select>

                        <?php if (isset($_POST['submit']) && !empty(form_error('tags'))): ?>
                            <div class="invalid-feedback">
                                <ul class="list-unstyled m-0" _last_child_mb_0>
                                    <?php echo form_error('tags'); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0 d-inline">
                    <button class="btn btn-link p-0 border-0 <?php echo (isset($_POST['submit']) ? (empty(form_error('roles')) ? '' : 'text-danger') : ''); ?>" type="button" data-toggle="collapse" data-target="#userRoles" aria-expanded="false" aria-controls="userRoles">
                        Roles
                    </button>
                </h5>
                <i class="small text-muted">(Optional)</i>
            </div>

            <div id="userRoles" class="collapse">
                <div class="card-body">
                    <?php if (empty($userRoles->result)): ?>
                    No user roles found. <a href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), 'roles', 'add']); ?>">add user roles</a>.
                    <?php else: ?>
                    <div class="form-group mb-0">
                        <select class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('roles')) ? '' : 'is-invalid') : ''); ?>" name="roles[]" aria-describedby="userRolesHelp" data-placeholder="Select roles" multiple>
                            <?php foreach ($userRoles->result as $userRole): ?>
                            <option value="<?php echo $userRole->ID; ?>" <?php echo ($this->input->input_stream('roles') === null ? (in_array($userRole->ID, explode(',', $user->roleIDs)) ? 'selected' : '') : set_select('roles', $userRole->ID)); ?>><?php echo $userRole->roleName; ?> (<?php echo $userRole->userCount; ?>) <?php echo ($userRole->state == 'inactive' ? 'Inactive' : ''); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="userRolesHelp" class="form-text text-muted">
                            <i class="fas fa-exclamation-triangle"></i> Assign right user roles to right users only; this can cause security issues.
                        </small>

                        <?php if (isset($_POST['submit']) && !empty(form_error('roles'))): ?>
                            <div class="invalid-feedback">
                                <ul class="list-unstyled m-0" _last_child_mb_0>
                                    <?php echo form_error('roles'); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0 d-inline">
                    <button class="btn btn-link p-0 border-0 <?php echo (isset($_POST['submit']) ? (empty(form_error('groups')) ? '' : 'text-danger') : ''); ?>" type="button" data-toggle="collapse" data-target="#userGroups" aria-expanded="false" aria-controls="userGroups">
                        Groups
                    </button>
                </h5>
                <i class="small text-muted">(Optional)</i>
            </div>

            <div id="userGroups" class="collapse">
                <div class="card-body">
                    <?php if (empty($userGroups->result)): ?>
                    No user groups found. <a href="<?php echo site_url([$this->uri->segment(1), $this->uri->segment(2), 'groups', 'add']); ?>">add user groups</a>.
                    <?php else: ?>
                    <div class="form-group mb-0">
                        <select class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('groups')) ? '' : 'is-invalid') : ''); ?>" name="groups[]" data-placeholder="Select groups" multiple>
                            <?php foreach ($userGroups->result as $userGroup): ?>
                            <option value="<?php echo $userGroup->ID; ?>" <?php echo ($this->input->input_stream('groups') === null ? (in_array($userGroup->ID, explode(',', $user->groupIDs)) ? 'selected' : '') : set_select('groups', $userGroup->ID)); ?>><?php echo $userGroup->groupName; ?> (<?php echo $userGroup->userCount; ?>) <?php echo ($userGroup->state == 'inactive' ? 'Inactive' : ''); ?></option>
                            <?php endforeach; ?>
                        </select>

                        <?php if (isset($_POST['submit']) && !empty(form_error('groups'))): ?>
                            <div class="invalid-feedback">
                                <ul class="list-unstyled m-0" _last_child_mb_0>
                                    <?php echo form_error('groups'); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0 d-inline">
                    <button class="btn btn-link p-0 border-0 <?php echo (isset($_POST['submit']) && !empty($this->input->post('password')) ? (empty(form_error('password')) ? '' : 'text-danger') : ''); ?>" type="button" data-toggle="collapse" data-target="#newPassword" aria-expanded="false" aria-controls="newPassword">
                        New password
                    </button>
                </h5>
                <i class="small text-muted">(Optional)</i>
            </div>

            <div id="newPassword" class="collapse show">
                <div class="card-body">
                    <div class="form-group mb-0" _password_visibility_toggle>
                        <div>
                            <input type="password" class="form-control <?php echo (isset($_POST['submit']) && !empty($this->input->post('password')) ? (empty(form_error('password')) ? '' : 'is-invalid') : ''); ?>" id="password" name="password" value="" placeholder="Create new password" data-toggle="popover" data-placement="top" data-trigger="focus" title="Note" data-content="It's recommended that new password must be at least 8 characters in length. to make it stronger, use upper and lower case letters, numbers, and symbols like ! # ? $ % ^ & @.">
                            <div class="input-group-append"></div>

                            <?php if (isset($_POST['submit']) && !empty(form_error('password'))): ?>
                                <div class="invalid-feedback">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('password'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">
                    <button class="btn btn-link p-0 border-0 <?php echo (isset($_POST['submit']) ? (empty(form_error('datetimeCreated')) ? 'text-success' : 'text-danger') : ''); ?>" type="button" data-toggle="collapse" data-target="#dateAndTime" aria-expanded="false" aria-controls="dateAndTime">
                        Date & time
                    </button>
                </h5>
            </div>

            <div id="dateAndTime" class="collapse">
                <div class="card-body">
                    <div class="form-group mb-0">
                        <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('datetimeCreated')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="datetimeCreated" name="datetimeCreated" value="<?php echo ($this->input->post('datetimeCreated') === null ? $user->datetimeCreated : set_value('datetimeCreated')); ?>" aria-describedby="datetimeHelp" placeholder="0000-00-00 00:00:00">
                        <small id="datetimeHelp" class="form-text text-muted">Date & time format: Year-Month-Day Hour:Minute:Second</small>

                        <?php if (isset($_POST['submit']) && !empty(form_error('datetimeCreated'))): ?>
                            <div class="invalid-feedback">
                                <ul class="list-unstyled m-0" _last_child_mb_0>
                                    <?php echo form_error('datetimeCreated'); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
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
                        <input type="radio" id="stateActive" name="state" value="active" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('state')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo ($this->input->post('state') === null ? ($user->state == 'active' ? 'checked' : '') : set_radio('state', 'active')); ?> required>
                        <label class="custom-control-label" for="stateActive">Active</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="stateInactive" name="state" value="inactive" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('state')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo ($this->input->post('state') === null ? ($user->state == 'inactive' ? 'checked' : '') : set_radio('state', 'inactive')); ?>>
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

// JS file injections.
$data['injections']['footer']['files']['js'] = [
    base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'adminend', 'libs', 'flatpickr-4.5.2', 'js', 'flatpickr.min.js']),
    base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'adminend', 'libs', 'select2-4.0.6-rc.0', 'js', 'select2.min.js'])
];

// JS Code injections.
$data['injections']['footer']['codes']['js'] = [
    '
    $(function () {
        var calendar = flatpickr("input#datetimeCreated", {
            enableTime: true,
            dateFormat: "Y-m-d H:i:S",
            enableSeconds: true,
            defaultHour: ' . date('H') . '
        });

        $("#content").on("scroll", function () {
            calendar._positionCalendar();
        });
    });
    '
    ,
    '
    $(function () {
        $("select").each(function () {
            $(this).select2({
                width: "100%",
                placeholder: $(this).attr("placeholder") || $(this).data("placeholder"),
                allowClear: true
            });
        });
        $(".select2-selection__rendered").each(function () {
            $(this).find(".select2-search__field").css({width: ""});
        });
    });
    '
];

// Calling common adminend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/footer', $data); ?>
