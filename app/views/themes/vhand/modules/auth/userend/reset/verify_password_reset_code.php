<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Verify password reset code view file
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
 * Complete password reset: verify password reset code template.
 */

// Calling common userend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/header'); ?>

<!-- Enter password reset code view -->
<div class="container">

    <?php

    // Calling common userend branding view file.
    $this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/branding'); ?>

    <div class="row">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto">
            <div class="card mb-4">
                <div class="card-header">
                    <h1 class="h5 m-0">Enter password reset code</h1>
                </div>

                <div class="card-body">
                    <p class="small text-muted">Please check your email for a message with password reset code.</p>

                    <form method="POST">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <label for="passwordResetCode">Password reset code</label>
                            <div class="input-group">
                                <input type="number" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('passwordResetCode')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="passwordResetCode" name="passwordResetCode" placeholder="Enter password reset code" autofocus required>
                                <div class="input-group-append">
                                    <a class="input-group-text rounded-right" href="<?php echo ($this->url->isNextUrl()) ? site_url(['auth', 'reset']) . '?next=' . $this->url->nextUrl() : site_url(['auth', 'reset']); ?>">Didn't get a code?</a>
                                </div>

                                <?php if (isset($_POST['submit']) && !empty(form_error('passwordResetCode'))): ?>
                                <div class="invalid-feedback">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('passwordResetCode'); ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php

                        if (!$this->user->isSignin()) {
                            if ($this->url->isNextUrl()) {
                                $cancelUrl = site_url('auth') . '?next=' . $this->url->nextUrl();
                            } else {
                                $cancelUrl = site_url('auth');
                            }
                        } else {
                            if ($this->url->isNextUrl()) {
                                $cancelUrl = $this->url->nextUrl();
                            } else {
                                $cancelUrl = site_url($this->preferences->type('system')->item('auth_signinRedirectRoute'));
                            }
                        }

                        ?>

                        <button type="submit" class="btn btn-primary float-right ml-2" name="submit">Continue</button>
                        <a class="btn btn-secondary float-right" href="<?php echo $cancelUrl; ?>" role="button">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

// Calling common userend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/footer'); ?>
