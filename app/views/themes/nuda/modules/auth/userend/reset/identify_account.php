<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Identify account view file
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
 * Complete password reset: identify account template.
 */

// Calling common userend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/header'); ?>

<!-- Reset password view -->
<div class="container">

    <?php

    // Calling common userend branding view file.
    $this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/branding'); ?>

    <div class="row">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto">
            <div class="card mb-4">
                <div class="card-header">
                    <h1 class="h5 m-0">Reset password</h1>
                </div>

                <div class="card-body">
                    <p class="small text-muted">Enter your email or username to reset your password.</p>

                    <form method="POST">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <label for="authIdentifier">Email or username</label>
                            <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('authIdentifier')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="authIdentifier" name="authIdentifier" value="<?php echo set_value('authIdentifier'); ?>" placeholder="Enter email or username" autofocus required>

                            <?php if (isset($_POST['submit']) && !empty(form_error('authIdentifier'))): ?>
                                <div class="invalid-feedback">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('authIdentifier'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
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
