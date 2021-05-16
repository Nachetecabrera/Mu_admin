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
 * Complete user emails settings template.
 */

// Calling common adminend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/header'); ?>

<div class="container p-0">

    <?php

    // Calling common user settings nav bar view file.
    $this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/modules/users/adminend/user/settings/settings_nav_bar'); ?>

    <div class="row">
        <div class="col-sm-4 col-lg-3">

            <?php

            // Calling common user settings nav column view file.
            $this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/modules/users/adminend/user/settings/settings_nav_column'); ?>

        </div>
        <div class="col-sm-8 col-lg-9">

            <?php if (!$this->user->isEmailVerified()): ?>
            <div class="alert alert-primary animated faster fadeIn" role="alert">
                <i class="fas fa-info-circle mr-1"></i> Please verify your email address.
            </div>
            <?php endif; ?>

            <form class="mb-3 clearfix" method="POST">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="card mb-3">
                    <div class="card-header">
                        Change/verify email
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-0">
                            <label for="email">Email</label>

                            <?php if ($user->emailVerification): ?>
                            <span class="badge badge-primary">Verified <i class="fas fa-check-circle"></i></span>
                            <?php else: ?>
                            <span class="badge badge-secondary">Unverified <i class="fas fa-exclamation-circle"></i></span>
                            <?php endif; ?>

                            <input type="hidden" name="email" value="<?php echo $user->email; ?>">
                            <input type="email" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('email')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="email" name="email" value="<?php echo ($this->input->post('email') === null ? $user->email : set_value('email')); ?>" placeholder="Enter email" <?php if (!$this->user->hasPermission('users_editEmailUserSettings')) echo 'disabled'; ?> autofocus required>

                            <?php if (isset($_POST['submit']) && !empty(form_error('email'))): ?>
                                <div class="invalid-feedback">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('email'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right" name="submit" <?php if (!$this->user->hasPermission('users_editEmailUserSettings') && $user->emailVerification == true) echo 'disabled'; ?>>Continue</button>
            </form>

        </div>
    </div>

</div>

<?php

// Calling common adminend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/footer'); ?>
