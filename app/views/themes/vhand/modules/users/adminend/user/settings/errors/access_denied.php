<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Access denied view file
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
 * Complete access denied template.
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
            <div class="card mb-3">
                <div class="card-header">
                    Access denied
                </div>

                <div class="card-body">
                    <div class="alert alert-danger mb-0 animated faster shake" role="alert">
                        <i class="fas fa-times-circle mr-1"></i> You are not authorized to perform this action.
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

// Calling common adminend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/footer'); ?>
