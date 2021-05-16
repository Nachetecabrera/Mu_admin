<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Signin view file
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
 * Complete signin template.
 */

// Calling common userend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/header'); ?>

<!-- Sign in view -->
<div class="container">

    <?php

    // Calling common userend branding view file.
    $this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/branding'); ?>

    <div class="row">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto">

            <?php if ($this->url->isNextUrl()): ?>
            <div class="alert alert-primary animated faster fadeIn" role="alert">
                <i class="fas fa-info-circle mr-1"></i> You must sign in to continue.
            </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('signinSuccess') === false): ?>
            <div class="alert alert-danger alert-dismissible fade show animated faster shake" role="alert" _auto_close="15000">
                <i class="fas fa-times-circle mr-1"></i> Sign in credentials are incorrect. please recheck your credentials or <a href="<?php echo ($this->url->isNextUrl()) ? site_url(['auth', 'reset']) . '?next=' . $this->url->nextUrl() : site_url(['auth', 'reset']); ?>">recover</a> your account.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('signoutSuccess') === true): ?>
            <div class="alert alert-success alert-dismissible fade show animated faster fadeIn" role="alert" _auto_close="15000">
                <i class="fas fa-check-circle mr-1"></i> You have successfully signed out.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('signupSuccess') === true): ?>
            <div class="alert alert-success alert-dismissible fade show animated faster fadeIn" role="alert" _auto_close="15000">
                <i class="fas fa-check-circle mr-1"></i> Signup process was successful. signin with your credentials.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('resetPassword') === true): ?>
            <div class="alert alert-success alert-dismissible fade show animated faster fadeIn" role="alert" _auto_close="15000">
                <i class="fas fa-check-circle mr-1"></i> Your password has been successfully updated. signin with your new credentials.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header">
                    <h1 class="h5">Sign in</h1>
                    <span class="small text-muted">Don't have an account yet?</span>
                    <a href="<?php echo ($this->url->isNextUrl()) ? site_url(['auth', 'signup']) . '?next=' . $this->url->nextUrl() : site_url(['auth', 'signup']); ?>" class="small text-nowrap"><i class="fas fa-user-plus"></i> Sign up</a>
                </div>

                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <label for="authIdentifier">Email or username</label>
                            <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('authIdentifier')) ? '' : 'is-invalid') : ''); ?>" id="authIdentifier" name="authIdentifier" value="<?php echo (!empty($this->session->flashdata('authIdentifierValue')) ? $this->session->flashdata('authIdentifierValue') : set_value('authIdentifier')); ?>" placeholder="Enter email or username" autofocus required>

                            <?php if (isset($_POST['submit']) && !empty(form_error('authIdentifier'))): ?>
                                <div class="invalid-feedback">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('authIdentifier'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group" _password_visibility_toggle>
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('password')) ? '' : 'is-invalid') : ''); ?>" id="password" name="password" placeholder="Enter password" required>
                                <div class="input-group-append">
                                    <a class="input-group-text rounded-right" href="<?php echo ($this->url->isNextUrl()) ? site_url(['auth', 'reset']) . '?next=' . $this->url->nextUrl() : site_url(['auth', 'reset']); ?>">Forgot?</a>
                                </div>

                                <?php if (isset($_POST['submit']) && !empty(form_error('password'))): ?>
                                <div class="invalid-feedback">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('password'); ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if ($this->preferences->type('system')->item('auth_rememberMeOption')): ?>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" id="rememberMe" name="rememberMe" value="1" class="custom-control-input <?php echo (isset($_POST['submit']) ? (empty(form_error('rememberMe')) ? 'is-valid' : 'is-invalid') : ''); ?>" <?php echo set_checkbox('rememberMe', '1', $this->preferences->type('system')->item('auth_rememberMeDefaultState') == 'checked'); ?>>
                                <label class="custom-control-label" for="rememberMe">Remember me</label> <i class="small text-muted">(Uncheck if on public or shared device.)</i>
                            </div>
                        </div>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-primary btn-block" name="submit"><i class="fas fa-sign-in-alt"></i> Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

// Calling common userend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/footer'); ?>
