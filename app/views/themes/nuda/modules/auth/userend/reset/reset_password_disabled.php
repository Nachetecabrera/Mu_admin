<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Password reset disabled view file
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
 * Complete password reset disabled template.
 */

// Calling common userend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/header'); ?>

<!-- Reset password disabled view -->
<div class="container">

    <?php

    // Calling common userend branding view file.
    $this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/branding'); ?>

    <div class="row">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto">
            <div class="card mb-4">
                <div class="card-header">
                    <h1 class="h5">Reset password</h1>
                    <span class="small text-muted">Back to</span>
                    <a href="<?php echo ($this->url->isNextUrl()) ? site_url('auth') . '?next=' . $this->url->nextUrl() : site_url('auth'); ?>" class="small text-nowrap"><i class="fas fa-sign-in-alt"></i> Sign in</a>
                </div>

                <div class="card-body">
                    <div class="alert alert-danger mb-0 animated faster shake" role="alert">
                        <i class="fas fa-times-circle mr-1"></i> Reset password is disabled.
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

// Calling common userend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/footer'); ?>
