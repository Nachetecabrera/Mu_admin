<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Reset password view file
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
 * Complete password reset: reset password template.
 */

// Calling common userend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/header'); ?>

<!-- Create new password view -->
<div class="container">

    <?php

    // Calling common userend branding view file.
    $this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/branding'); ?>

    <div class="row">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto">

            <?php if ($this->session->flashdata('resetPassword') === false): ?>
            <div class="alert alert-danger alert-dismissible fade show animated faster shake" role="alert" _auto_close="15000">
                <i class="fas fa-times-circle mr-1"></i> Reset password process was unsuccessful due to an internal error. please try again later.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header">
                    <h1 class="h5 m-0">Create new password</h1>
                </div>

                <div class="card-body">
                    <p class="small text-muted">
                        <i class="fas fa-info-circle"></i> It's recommended that new password must be at least 8 characters in length. to make it stronger, use upper and lower case letters, numbers, and symbols like ! # ? $ % ^ & @.
                    </p>

                    <form method="POST">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="form-group" _password_visibility_toggle>
                            <label for="password">New password</label>
                            <div>
                                <input type="password" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('password')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="password" name="password" placeholder="Create new password" autofocus required>
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
