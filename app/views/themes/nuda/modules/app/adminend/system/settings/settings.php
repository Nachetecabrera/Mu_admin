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
 * Complete app module settings template.
 */

// Calling common adminend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/header'); ?>

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
                        General settings
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="app_name">App name</label>
                            <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('app_name')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="app_name" name="app_name" value="<?php echo ($this->input->post('app_name') === null ? $this->preferences->type('system')->item('app_name') : set_value('app_name')); ?>" placeholder="Enter app name" autofocus required>

                            <?php if (isset($_POST['submit']) && !empty(form_error('app_name'))): ?>
                                <div class="invalid-feedback">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('app_name'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="app_slogan">App slogan</label> <i class="small text-muted">(Optional)</i>
                            <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('app_slogan')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="app_slogan" name="app_slogan" value="<?php echo ($this->input->post('app_slogan') === null ? $this->preferences->type('system')->item('app_slogan') : set_value('app_slogan')); ?>" aria-describedby="appSloganHelp" placeholder="Enter app slogan">

                            <?php if (isset($_POST['submit']) && !empty(form_error('app_slogan'))): ?>
                                <div class="invalid-feedback">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('app_slogan'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <small id="appSloganHelp" class="form-text text-muted">Explain in a few words, what this app is about.</small>
                        </div>

                        <div class="form-group mb-0">
                            <label for="app_email">App email</label>
                            <input type="email" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('app_email')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="app_email" name="app_email" value="<?php echo ($this->input->post('app_email') === null ? $this->preferences->type('system')->item('app_email') : set_value('app_email')); ?>" aria-describedby="appEmailHelp" placeholder="Enter app email" required>

                            <?php if (isset($_POST['submit']) && !empty(form_error('app_email'))): ?>
                                <div class="invalid-feedback">
                                    <ul class="list-unstyled m-0" _last_child_mb_0>
                                        <?php echo form_error('app_email'); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <small id="appEmailHelp" class="form-text text-muted">This email address is used for send various types of emails.</small>
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
