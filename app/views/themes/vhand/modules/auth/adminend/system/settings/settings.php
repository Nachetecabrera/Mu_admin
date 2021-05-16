<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Settings view file
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
 * Complete auth module settings template.
 */

// CSS file injections.
$data['injections']['header']['files']['css'] = [
    base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'adminend', 'libs', 'select2-4.0.6-rc.0', 'css' , 'select2.min.css'])
];

// Calling common adminend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/header', $data); ?>

<div class="container p-0">

    <?php

    // Calling common system settings nav bar view file.
    $this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/system/settings_nav_bar'); ?>

    <div class="row">
        <div class="col-sm-4 col-lg-3">

            <?php

            // Calling common system settings nav column view file.
            $this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/system/settings_nav_column'); ?>

        </div>
        <div class="col-sm-8 col-lg-9">
            <form class="mb-3 clearfix" method="POST">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="card mb-3">
                    <div class="card-header">
                        Sign in settings
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="hidden" name="auth_rememberMeOption" value="0">
                                <input type="checkbox" id="auth_rememberMeOption" name="auth_rememberMeOption" value="1" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('auth_rememberMeOption')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo set_checkbox('auth_rememberMeOption', '1', $this->preferences->type('system')->item('auth_rememberMeOption') == true); ?>>
                                <label class="custom-control-label" for="auth_rememberMeOption">Remember me option</label>
                            </div>

                            <?php if (isset($_POST['submit']) && !empty(form_error('auth_rememberMeOption'))): ?>
                                <div class="invalid-feedback d-block">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('auth_rememberMeOption'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-0">
                            <label class="d-block" for="stateChecked">Remember me default state</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="stateChecked" name="auth_rememberMeDefaultState" value="checked" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('auth_rememberMeDefaultState')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo ($this->input->post('auth_rememberMeDefaultState') === null ? ($this->preferences->type('system')->item('auth_rememberMeDefaultState') == 'checked' ? 'checked' : '') : set_radio('auth_rememberMeDefaultState', 'checked')); ?> required>
                                <label class="custom-control-label" for="stateChecked">Checked</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="stateUnchecked" name="auth_rememberMeDefaultState" value="unchecked" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('auth_rememberMeDefaultState')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo ($this->input->post('auth_rememberMeDefaultState') === null ? ($this->preferences->type('system')->item('auth_rememberMeDefaultState') == 'unchecked' ? 'checked' : '') : set_radio('auth_rememberMeDefaultState', 'unchecked')); ?>>
                                <label class="custom-control-label" for="stateUnchecked">Unchecked</label>
                            </div>

                            <?php if (isset($_POST['submit']) && !empty(form_error('auth_rememberMeDefaultState'))): ?>
                                <div class="invalid-feedback d-block">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('auth_rememberMeDefaultState'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        Sign up settings
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="hidden" name="auth_signupOption" value="0">
                                <input type="checkbox" id="auth_signupOption" name="auth_signupOption" value="1" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('auth_signupOption')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo set_checkbox('auth_signupOption', '1', $this->preferences->type('system')->item('auth_signupOption') == true); ?>>
                                <label class="custom-control-label" for="auth_signupOption">Sign up option</label>
                            </div>

                            <?php if (isset($_POST['submit']) && !empty(form_error('auth_signupOption'))): ?>
                                <div class="invalid-feedback d-block">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('auth_signupOption'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label class="d-block" for="stateActive">Sign up default user state</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="stateActive" name="auth_signupDefaultUserState" value="active" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('auth_signupDefaultUserState')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo ($this->input->post('auth_signupDefaultUserState') === null ? ($this->preferences->type('system')->item('auth_signupDefaultUserState') == 'active' ? 'checked' : '') : set_radio('auth_signupDefaultUserState', 'active')); ?> required>
                                <label class="custom-control-label" for="stateActive">Active</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="stateInactive" name="auth_signupDefaultUserState" value="inactive" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('auth_signupDefaultUserState')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo ($this->input->post('auth_signupDefaultUserState') === null ? ($this->preferences->type('system')->item('auth_signupDefaultUserState') == 'inactive' ? 'checked' : '') : set_radio('auth_signupDefaultUserState', 'inactive')); ?>>
                                <label class="custom-control-label" for="stateInactive">Inactive</label>
                            </div>

                            <?php if (isset($_POST['submit']) && !empty(form_error('auth_signupDefaultUserState'))): ?>
                                <div class="invalid-feedback d-block">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('auth_signupDefaultUserState'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="hidden" name="auth_signupWelcomeEmail" value="0">
                                <input type="checkbox" id="auth_signupWelcomeEmail" name="auth_signupWelcomeEmail" value="1" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('auth_signupWelcomeEmail')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo set_checkbox('auth_signupWelcomeEmail', '1', $this->preferences->type('system')->item('auth_signupWelcomeEmail') == true); ?>>
                                <label class="custom-control-label" for="auth_signupWelcomeEmail">Sign up welcome email</label>
                            </div>

                            <?php if (isset($_POST['submit']) && !empty(form_error('auth_signupWelcomeEmail'))): ?>
                                <div class="invalid-feedback d-block">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('auth_signupWelcomeEmail'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>

                        <hr>

                        <div class="form-group">
                            <?php if (empty($userStatuses->result)): ?>
                                <label class="mb-0">Sign up default user status</label> <i class="small text-muted">(Optional)</i>
                                <small class="form-text text-muted">No user statuses found. <a href="<?php echo site_url(['admin', 'users', 'statuses', 'add']); ?>">add user statuses</a>.</small>
                            <?php else: ?>
                                <label for="status">Sign up default user status</label> <i class="small text-muted">(Optional)</i>
                                <input type="hidden" name="auth_signupDefaultUserStatus" value="">
                                <select class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('auth_signupDefaultUserStatus')) ? '' : 'is-invalid') : ''); ?>" id="status" name="auth_signupDefaultUserStatus" placeholder="Select a status">
                                    <option></option>
                                    <?php foreach ($userStatuses->result as $userStatus): ?>
                                    <option value="<?php echo $userStatus->ID; ?>" <?php echo ($this->input->post('auth_signupDefaultUserStatus') === null ? ($userStatus->ID == $this->preferences->type('system')->item('auth_signupDefaultUserStatus') ? 'selected' : '') : set_select('auth_signupDefaultUserStatus', $userStatus->ID)); ?>><?php echo $userStatus->statusName; ?> (<?php echo $userStatus->userCount; ?>) <?php echo ($userStatus->state == 'inactive' ? 'Inactive' : ''); ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <?php if (isset($_POST['submit']) && !empty(form_error('auth_signupDefaultUserStatus'))): ?>
                                    <div class="invalid-feedback">
                                        <ul class="list-unstyled m-0" _last_child_mb_0>
                                            <?php echo form_error('auth_signupDefaultUserStatus'); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <?php if (empty($userTags->result)): ?>
                                <label class="mb-0">Sign up default user tags</label> <i class="small text-muted">(Optional)</i>
                                <small class="form-text text-muted">No user tags found. <a href="<?php echo site_url(['admin', 'users', 'tags', 'add']); ?>">add user tags</a>.</small>
                            <?php else: ?>
                                <label for="tags">Sign up default user tags</label> <i class="small text-muted">(Optional)</i>
                                <input type="hidden" name="auth_signupDefaultUserTags" value="">
                                <select class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('auth_signupDefaultUserTags')) ? '' : 'is-invalid') : ''); ?>" id="tags" name="auth_signupDefaultUserTags[]" data-placeholder="Select tags" multiple>
                                    <?php foreach ($userTags->result as $userTag): ?>
                                    <option value="<?php echo $userTag->ID; ?>" <?php echo ($this->input->input_stream('auth_signupDefaultUserTags') === null ? (in_array($userTag->ID, explode(',', $this->preferences->type('system')->item('auth_signupDefaultUserTags'))) ? 'selected' : '') : set_select('auth_signupDefaultUserTags', $userTag->ID)); ?>><?php echo $userTag->tagName; ?> (<?php echo $userTag->userCount; ?>) <?php echo ($userTag->state == 'inactive' ? 'Inactive' : ''); ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <?php if (isset($_POST['submit']) && !empty(form_error('auth_signupDefaultUserTags'))): ?>
                                    <div class="invalid-feedback">
                                        <ul class="list-unstyled m-0" _last_child_mb_0>
                                            <?php echo form_error('auth_signupDefaultUserTags'); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <?php if (empty($userRoles->result)): ?>
                                <label class="mb-0">Sign up default user roles</label> <i class="small text-muted">(Optional)</i>
                                <small class="form-text text-muted">No user roles found. <a href="<?php echo site_url(['admin', 'users', 'roles', 'add']); ?>">add user roles</a>.</small>
                            <?php else: ?>
                                <label for="roles">Sign up default user roles</label> <i class="small text-muted">(Optional)</i>
                                <input type="hidden" name="auth_signupDefaultUserRoles" value="">
                                <select class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('auth_signupDefaultUserRoles')) ? '' : 'is-invalid') : ''); ?>" id="roles" name="auth_signupDefaultUserRoles[]" aria-describedby="userRolesHelp" data-placeholder="Select roles" multiple>
                                    <?php foreach ($userRoles->result as $userRole): ?>
                                    <option value="<?php echo $userRole->ID; ?>" <?php echo ($this->input->input_stream('auth_signupDefaultUserRoles') === null ? (in_array($userRole->ID, explode(',', $this->preferences->type('system')->item('auth_signupDefaultUserRoles'))) ? 'selected' : '') : set_select('auth_signupDefaultUserRoles', $userRole->ID)); ?>><?php echo $userRole->roleName; ?> (<?php echo $userRole->userCount; ?>) <?php echo ($userRole->state == 'inactive' ? 'Inactive' : ''); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small id="userRolesHelp" class="form-text text-muted">
                                    <i class="fas fa-exclamation-triangle"></i> Assign right user roles to right users only; this can cause security issues.
                                </small>

                                <?php if (isset($_POST['submit']) && !empty(form_error('auth_signupDefaultUserRoles'))): ?>
                                    <div class="invalid-feedback">
                                        <ul class="list-unstyled m-0" _last_child_mb_0>
                                            <?php echo form_error('auth_signupDefaultUserRoles'); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-0">
                            <?php if (empty($userGroups->result)): ?>
                                <label class="mb-0">Sign up default user groups</label> <i class="small text-muted">(Optional)</i>
                                <small class="form-text text-muted">No user groups found. <a href="<?php echo site_url(['admin', 'users', 'groups', 'add']); ?>">add user groups</a>.</small>
                            <?php else: ?>
                                <label for="groups">Sign up default user groups</label> <i class="small text-muted">(Optional)</i>
                                <input type="hidden" name="auth_signupDefaultUserGroups" value="">
                                <select class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('auth_signupDefaultUserGroups')) ? '' : 'is-invalid') : ''); ?>" id="groups" name="auth_signupDefaultUserGroups[]" data-placeholder="Select groups" multiple>
                                    <?php foreach ($userGroups->result as $userGroup): ?>
                                    <option value="<?php echo $userGroup->ID; ?>" <?php echo ($this->input->input_stream('auth_signupDefaultUserGroups') === null ? (in_array($userGroup->ID, explode(',', $this->preferences->type('system')->item('auth_signupDefaultUserGroups'))) ? 'selected' : '') : set_select('auth_signupDefaultUserGroups', $userGroup->ID)); ?>><?php echo $userGroup->groupName; ?> (<?php echo $userGroup->userCount; ?>) <?php echo ($userGroup->state == 'inactive' ? 'Inactive' : ''); ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <?php if (isset($_POST['submit']) && !empty(form_error('auth_signupDefaultUserGroups'))): ?>
                                    <div class="invalid-feedback">
                                        <ul class="list-unstyled m-0" _last_child_mb_0>
                                            <?php echo form_error('auth_signupDefaultUserGroups'); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        Password reset settings
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="hidden" name="auth_passwordResetOption" value="0">
                                <input type="checkbox" id="auth_passwordResetOption" name="auth_passwordResetOption" value="1" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('auth_passwordResetOption')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo set_checkbox('auth_passwordResetOption', '1', $this->preferences->type('system')->item('auth_passwordResetOption') == true); ?>>
                                <label class="custom-control-label" for="auth_passwordResetOption">Password reset option</label>
                            </div>

                            <?php if (isset($_POST['submit']) && !empty(form_error('auth_passwordResetOption'))): ?>
                                <div class="invalid-feedback d-block">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('auth_passwordResetOption'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-0">
                            <label for="auth_passwordResetTokenExpirationInMinutes">Password reset token expiration in minutes</label>
                            <input type="number" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('auth_passwordResetTokenExpirationInMinutes')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="auth_passwordResetTokenExpirationInMinutes" name="auth_passwordResetTokenExpirationInMinutes" value="<?php echo ($this->input->post('auth_passwordResetTokenExpirationInMinutes') === null ? $this->preferences->type('system')->item('auth_passwordResetTokenExpirationInMinutes') : set_value('auth_passwordResetTokenExpirationInMinutes')); ?>" placeholder="Enter time in minutes" required>

                            <?php if (isset($_POST['submit']) && !empty(form_error('auth_passwordResetTokenExpirationInMinutes'))): ?>
                                <div class="invalid-feedback">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('auth_passwordResetTokenExpirationInMinutes'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right" name="submit">Save</button>
            </form>
        </div>
    </div>

</div>

<?php

// JS file injections.
$data['injections']['footer']['files']['js'] = [
    base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'adminend', 'libs', 'select2-4.0.6-rc.0', 'js', 'select2.min.js'])
];

// JS Code injections.
$data['injections']['footer']['codes']['js'] = [
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
