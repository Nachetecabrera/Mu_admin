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
 * Complete users module settings template.
 */

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
                        Verification settings
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="d-block" for="verificationRequired">Email verification</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="verificationRequired" name="users_emailVerification" value="required" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('users_emailVerification')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo ($this->input->post('users_emailVerification') === null ? ($this->preferences->type('system')->item('users_emailVerification') == 'required' ? 'checked' : '') : set_radio('users_emailVerification', 'checked')); ?> required>
                                <label class="custom-control-label" for="verificationRequired">Required</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="verificationOptional" name="users_emailVerification" value="optional" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('users_emailVerification')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo ($this->input->post('users_emailVerification') === null ? ($this->preferences->type('system')->item('users_emailVerification') == 'optional' ? 'checked' : '') : set_radio('users_emailVerification', 'unchecked')); ?>>
                                <label class="custom-control-label" for="verificationOptional">Optional</label>
                            </div>

                            <?php if (isset($_POST['submit']) && !empty(form_error('users_emailVerification'))): ?>
                                <div class="invalid-feedback d-block">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('users_emailVerification'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-0">
                            <label for="users_emailVerificationTokenExpirationInMinutes">Email verification token expiration in minutes</label>
                            <input type="number" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('users_emailVerificationTokenExpirationInMinutes')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="users_emailVerificationTokenExpirationInMinutes" name="users_emailVerificationTokenExpirationInMinutes" value="<?php echo ($this->input->post('users_emailVerificationTokenExpirationInMinutes') === null ? $this->preferences->type('system')->item('users_emailVerificationTokenExpirationInMinutes') : set_value('users_emailVerificationTokenExpirationInMinutes')); ?>" placeholder="Enter time in minutes" required>

                            <?php if (isset($_POST['submit']) && !empty(form_error('users_emailVerificationTokenExpirationInMinutes'))): ?>
                                <div class="invalid-feedback">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('users_emailVerificationTokenExpirationInMinutes'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        Password settings
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-0">
                            <label for="users_minimumPasswordLength">Minimum password character length</label>
                            <input type="number" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('users_minimumPasswordLength')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="users_minimumPasswordLength" name="users_minimumPasswordLength" value="<?php echo ($this->input->post('users_minimumPasswordLength') === null ? $this->preferences->type('system')->item('users_minimumPasswordLength') : set_value('users_minimumPasswordLength')); ?>" placeholder="Enter minimum password character length" required>
                            <small id="users_minimumPasswordLengthHelp" class="form-text text-muted"><i class="fas fa-info-circle"></i> It's recommended that passwords must be at least 8 characters in length.</small>

                            <?php if (isset($_POST['submit']) && !empty(form_error('users_minimumPasswordLength'))): ?>
                                <div class="invalid-feedback">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('users_minimumPasswordLength'); ?>
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

// Calling common adminend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/footer'); ?>
