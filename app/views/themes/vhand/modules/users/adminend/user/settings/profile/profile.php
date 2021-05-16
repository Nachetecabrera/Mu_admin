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
 * Complete user profile settings template.
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
            <fieldset <?php if (!$this->user->hasPermission('users_editProfileUserSettings')) echo 'disabled'; ?>>
                <form class="mb-3 clearfix" method="POST">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="card mb-3">
                        <div class="card-header">
                            Update profile
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-md-0">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('firstName')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="firstName" name="firstName" value="<?php echo ($this->input->post('firstName') === null ? $user->firstName : set_value('firstName')); ?>" placeholder="Enter first name" autofocus required>

                                    <?php if (isset($_POST['submit']) && !empty(form_error('firstName'))): ?>
                                    <div class="invalid-feedback">
                                        <ul class="list-unstyled m-0" _last_child_mb_0>
                                            <?php echo form_error('firstName'); ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group col-md-6 mb-0">
                                    <label for="surname">Surname</label>
                                    <input type="text" class="form-control <?php echo (isset($_POST['submit']) ? (empty(form_error('surname')) ? 'is-valid' : 'is-invalid') : ''); ?>" id="surname" name="surname" value="<?php echo ($this->input->post('surname') === null ? $user->surname : set_value('surname')); ?>" placeholder="Enter surname" required>

                                    <?php if (isset($_POST['submit']) && !empty(form_error('surname'))): ?>
                                    <div class="invalid-feedback">
                                        <ul class="list-unstyled m-0" _last_child_mb_0>
                                            <?php echo form_error('surname'); ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-right" name="submit">Save</button>
                </form>
            </fieldset>
        </div>
    </div>

</div>

<?php

// Calling common adminend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/footer'); ?>
