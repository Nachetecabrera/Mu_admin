<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| App home view file
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
 * Complete app home template.
 */

// Calling common userend header view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/header'); ?>

<!-- App home view -->
<div class="container-fluid p-0 h-100 d-flex flex-column">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand mr-auto" href="<?php echo site_url(); ?>">
            <img src="<?php echo base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'adminend', 'img', 'navbar_logo.svg?v=' . $this->config->item('app_version')]); ?>" width="30" height="30" class="d-inline-block align-top" alt="Logo"> <?php echo $this->preferences->type('system')->item('app_name'); ?>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbarContent" aria-controls="mainNavbarContent" aria-expanded="false" aria-label="Toggle main navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbarContent">
            <ul class="navbar-nav ml-auto">
                <?php if (!$this->user->isSignin()): ?>
                <li class="nav-item ml-sm-3">
                    <a class="nav-link px-sm-0" href="<?php echo site_url('auth'); ?>">Sign in</a>
                </li>
                <li class="nav-item ml-sm-3">
                    <a class="nav-link px-sm-0" href="<?php echo site_url(['auth', 'signup']); ?>">Sign up</a>
                </li>
                <?php else: ?>
                <li class="nav-item dropdown ml-sm-3">
                    <a class="nav-link px-sm-0" href="#" id="mainNavbarUserDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $this->session->user->username; ?> <i class="fas fa-caret-down"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="mainNavbarUserDropdown">
                        <a class="dropdown-item" href="<?php echo site_url(['admin', 'user', 'settings', 'profile']); ?>">
                            <i class="fas fa-user-cog fa-fw mr-1"></i> User settings
                        </a>

                        <div class="dropdown-divider"></div>

                        <form action="<?php echo site_url(['auth', 'signout']); ?>" method="POST">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <button type="submit" class="dropdown-item" name="submit">
                                <i class="fas fa-sign-out-alt fa-fw mr-1"></i> Sign out
                            </button>
                        </form>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="row m-0 _flex_1">
        <div class="col py-3 d-flex flex-column justify-content-center text-center">
            <h1 class="display-3 font-weight-bold mb-3 text-body">Appskull <small class="font-weight-light text-black-50"><?php echo $this->config->item('appskull_version'); ?></small></h1>

            <p class="lead">
                The ultimate web app starter kit
            </p>

            <p class="text-muted">
                Don't spend time building everything from scratch. Instead, focus on building your business logic.
            </p>

            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link text-info" target="_blank" href="https://codecanyon.net/item/appskull-advanced-user-login-registration-management-permissions/23974662?ref=nudasoft">BUY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" target="_blank" href="http://www.nudasoft.com/docs/appskull/">DOCS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" target="_blank" href="https://twitter.com/Nudasoft">NEWS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="mailto:nudasoft@gmail.com">CONTACT</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php

// Calling common userend footer view file.
$this->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/userend/footer'); ?>
