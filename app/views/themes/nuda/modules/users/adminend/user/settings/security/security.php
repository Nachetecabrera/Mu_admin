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
 * Complete user security settings template.
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
                <fieldset <?php if (!$this->user->hasPermission('users_editSecurityUserSettings')) echo 'disabled'; ?>>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="card mb-3">
                        <div class="card-header">
                            Change password
                        </div>
                        <div class="card-body">
                            <div class="form-group" _password_visibility_toggle>
                                <label for="currentPassword">Current password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('currentPassword')) ? '' : 'is-invalid') : ''); ?>" id="currentPassword" name="currentPassword" placeholder="Enter current password" autofocus required>
                                    <div class="input-group-append">
                                        <a class="input-group-text rounded-right" href="<?php echo site_url(['auth', 'reset']) . '?next=' . $this->url->currentUrl(); ?>">Forgot?</a>
                                    </div>

                                    <?php if (isset($_POST['submit']) && !empty(form_error('currentPassword'))): ?>
                                    <div class="invalid-feedback">
                                        <ul class="list-unstyled m-0" _last_child_mb_0>
                                            <?php echo form_error('currentPassword'); ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group mb-0" _password_visibility_toggle>
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
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-right" name="submit">Save</button>
                </fieldset>
            </form>
        </div>
    </div>

</div>

<?php

// Calling common adminend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/footer'); ?>
