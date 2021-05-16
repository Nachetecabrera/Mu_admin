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
 * Complete email verification code settings template.
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
            <form class="mb-3 clearfix" method="POST">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="card mb-3">
                    <div class="card-header">
                        Enter email verification code
                    </div>

                    <div class="card-body">
                        <p class="small text-muted">Please check your <strong><?php echo $this->session->emailUserSettings_stepOne_email; ?></strong> email for a message with email verification code.</p>

                        <div class="form-group mb-0">
                            <label for="emailVerificationCode">Email verification code</label>
                            <div class="input-group">
                                <input type="number" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('emailVerificationCode')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="emailVerificationCode" name="emailVerificationCode" placeholder="Enter email verification code" autofocus required>
                                <div class="input-group-append">
                                    <a class="input-group-text rounded-right" href="<?php echo site_url(['admin', 'user', 'settings', 'email']); ?>">Didn't get a code?</a>
                                </div>

                                <?php if (isset($_POST['submit']) && !empty(form_error('emailVerificationCode'))): ?>
                                <div class="invalid-feedback">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('emailVerificationCode'); ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right" name="submit">Continue</button>
            </form>
        </div>
    </div>

</div>

<?php

// Calling common adminend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/footer'); ?>
