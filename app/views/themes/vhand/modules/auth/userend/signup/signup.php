<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Signup view file
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
 * Complete signup template.
 */

// Calling common userend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/header'); ?>

<!-- Sign up view -->
<div class="container">

    <?php

    // Calling common userend branding view file.
    $this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/branding'); ?>

    <div class="row">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto">

            <?php if ($this->session->flashdata('signupSuccess') === false): ?>
            <div class="alert alert-danger alert-dismissible fade show animated faster shake" role="alert" _auto_close="15000">
                <i class="fas fa-times-circle mr-1"></i> Signup process was unsuccessful due to an internal error. please try again later.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header">
                    <h1 class="h5">Sign up</h1>
                    <span class="small text-muted">Already have an account?</span>
                    <a href="<?php echo ($this->url->isNextUrl()) ? site_url('auth') . '?next=' . $this->url->nextUrl() : site_url('auth'); ?>" class="small text-nowrap"><i class="fas fa-sign-in-alt"></i> Sign in</a>
                </div>

                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="firstName">First name</label>
                                <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('firstName')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="firstName" name="firstName" value="<?php echo set_value('firstName'); ?>" placeholder="Enter first name" autofocus required>

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
                                <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('surname')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="surname" name="surname" value="<?php echo set_value('surname'); ?>" placeholder="Enter surname" required>

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
                            <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('username')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="username" name="username" value="<?php echo set_value('username'); ?>" placeholder="Pick a username" required>

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
                            <input type="email" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('email')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Enter email" required>

                            <?php if (isset($_POST['submit']) && !empty(form_error('email'))): ?>
                                <div class="invalid-feedback">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('email'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group" _password_visibility_toggle>
                            <label for="password">New password</label>
                            <div>
                                <input type="password" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('password')) ? '' : 'is-invalid') : ''); ?>" id="password" name="password" placeholder="Create new password" required data-toggle="popover" data-placement="top" data-trigger="focus" title="Note" data-content="It's recommended that new password must be at least 8 characters in length. to make it stronger, use upper and lower case letters, numbers, and symbols like ! # ? $ % ^ & @.">
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

                        <p class="small text-muted text-center">
                            By clicking "Sign up" button, you agree to the our <a href="#" target="_blank">User agreement</a>, <a href="#" target="_blank">Privacy policy</a>, and <a href="#" target="_blank">Cookie policy</a>.
                        </p>

                        <button type="submit" class="btn btn-primary btn-block" name="submit"><i class="fas fa-user-plus"></i> Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

// Calling common userend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/footer'); ?>
