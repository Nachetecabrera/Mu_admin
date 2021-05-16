<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Header view file
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




?><!doctype html>
<html class="h-100" lang="en">
    <head>
        <title><?php echo (empty($title) ? $this->preferences->type('system')->item('app_name') : $title . ' - ' . $this->preferences->type('system')->item('app_name')); ?></title>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'adminend', 'css', 'adminend.min.css?v=' . $this->config->item('appskull_version')]); ?>">
        <link rel="stylesheet" href="<?php echo base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'common', 'css', 'app.css?v=' . $this->config->item('app_version')]); ?>">
        <link rel="stylesheet" href="<?php echo base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'adminend', 'css', 'app.css?v=' . $this->config->item('app_version')]); ?>">

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="<?php echo base_url('favicon.ico?v=' . $this->config->item('app_version')); ?>">

        <?php

        // Header injector.
        if (isset($injections)) {
            $this->asset->injector('header', $injections);
        }

        ?>
    </head>

    <body class="h-100" style="overflow:hidden;">
        <div class="container-fluid p-0 h-100 d-flex flex-column">
            <nav id="main_nav" class="navbar navbar-expand-sm navbar-dark bg-dark _app_frame" style="z-index:1199;">
                <button class="navbar-toggler d-block d-md-none mr-3" type="button" data-toggle="collapse" data-target="#aside" aria-controls="aside" aria-expanded="false" aria-label="Toggle main sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand mr-auto" href="<?php echo site_url(); ?>">
                    <img src="<?php echo base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'adminend', 'img', 'navbar_logo.svg?v=' . $this->config->item('app_version')]); ?>" width="30" height="30" class="d-inline-block align-top" alt="Logo"> <?php echo $this->preferences->type('system')->item('app_name'); ?>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbarContent" aria-controls="mainNavbarContent" aria-expanded="false" aria-label="Toggle main navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNavbarContent">
                    <ul class="navbar-nav ml-auto">
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
                    </ul>
                </div>
            </nav>

            <div class="row m-0 flex-nowrap _flex_1 _mh_0px">
                <div id="aside" class="col p-0 d-none d-md-flex flex-column flex-grow-0 flex-shrink-0 h-100 bg-dark _app_frame">
                    <ul class="list-unstyled m-0 h-100 _oy_auto _custom_scrollbar">
                        <li class="nav-item">
                            <a class="nav-link <?php echo (($this->uri->segment(1) == 'admin' && empty($this->uri->segment(2))) ? 'active' : ''); ?>" href="<?php echo site_url('admin'); ?>">
                                <i class="fas fa-home fa-fw mr-1"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <span class="d-flex <?php echo ($this->uri->segment(2) == 'users' ? 'active' : ''); ?>">
                                <a class="nav-link flex-grow-1 pr-0" href="<?php echo site_url(['admin', 'users']); ?>?filterby=state&filter=active">
                                    <i class="fas fa-user-friends fa-fw mr-1"></i> Users
                                </a>

                                <a href="<?php echo site_url(['admin', 'users', 'add']); ?>" class="_nav_link_append py-2 px-3 <?php echo (($this->uri->segment(2) == 'users' && $this->uri->segment(3) == 'add') ? 'active' : ''); ?>">
                                    <i class="fas fa-plus-circle"></i>
                                </a>
                            </span>

                            <?php if ($this->uri->segment(2) == 'users'): ?>
                            <ul class="list-unstyled">
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($this->uri->segment(3) == 'overview' ? 'active' : ''); ?>" href="<?php echo site_url(['admin', 'users', 'overview']); ?>">Overview</a>
                                </li>
                                <div class="dropdown-divider"></div>
                                <li class="nav-item">
                                    <span class="d-flex <?php echo ($this->uri->segment(3) == 'statuses' ? 'active' : ''); ?>">
                                        <a class="nav-link flex-grow-1 pr-0" href="<?php echo site_url(['admin', 'users', 'statuses']); ?>?filterby=state&filter=active">Statuses</a>

                                        <a href="<?php echo site_url(['admin', 'users', 'statuses', 'add']); ?>" class="_nav_link_append py-1 px-3 <?php echo (($this->uri->segment(3) == 'statuses' && $this->uri->segment(4) == 'add') ? 'active' : ''); ?>">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                    </span>
                                </li>
                                <li class="nav-item">
                                    <span class="d-flex <?php echo ($this->uri->segment(3) == 'tags' ? 'active' : ''); ?>">
                                        <a class="nav-link flex-grow-1 pr-0" href="<?php echo site_url(['admin', 'users', 'tags']); ?>?filterby=state&filter=active">Tags</a>

                                        <a href="<?php echo site_url(['admin', 'users', 'tags', 'add']); ?>" class="_nav_link_append py-1 px-3 <?php echo (($this->uri->segment(3) == 'tags' && $this->uri->segment(4) == 'add') ? 'active' : ''); ?>">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                    </span>
                                </li>
                                <li class="nav-item">
                                    <span class="d-flex <?php echo ($this->uri->segment(3) == 'roles' ? 'active' : ''); ?>">
                                        <a class="nav-link flex-grow-1 pr-0" href="<?php echo site_url(['admin', 'users', 'roles']); ?>?filterby=state&filter=active">Roles</a>

                                        <a href="<?php echo site_url(['admin', 'users', 'roles', 'add']); ?>" class="_nav_link_append py-1 px-3 <?php echo (($this->uri->segment(3) == 'roles' && $this->uri->segment(4) == 'add') ? 'active' : ''); ?>">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                    </span>
                                </li>
                                <li class="nav-item">
                                    <span class="d-flex <?php echo ($this->uri->segment(3) == 'groups' ? 'active' : ''); ?>">
                                        <a class="nav-link flex-grow-1 pr-0" href="<?php echo site_url(['admin', 'users', 'groups']); ?>?filterby=state&filter=active">Groups</a>

                                        <a href="<?php echo site_url(['admin', 'users', 'groups', 'add']); ?>" class="_nav_link_append py-1 px-3 <?php echo (($this->uri->segment(3) == 'groups' && $this->uri->segment(4) == 'add') ? 'active' : ''); ?>">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                    </span>
                                </li>
                                <li class="nav-item">
                                    <span class="d-flex <?php echo ($this->uri->segment(3) == 'permissions' ? 'active' : ''); ?>">
                                        <a class="nav-link flex-grow-1 pr-0" href="<?php echo site_url(['admin', 'users', 'permissions']); ?>?filterby=state&filter=active">Permissions</a>

                                        <a href="<?php echo site_url(['admin', 'users', 'permissions', 'add']); ?>" class="_nav_link_append py-1 px-3 <?php echo (($this->uri->segment(3) == 'permissions' && $this->uri->segment(4) == 'add') ? 'active' : ''); ?>">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                    </span>
                                </li>
                                <!--<li class="nav-item">
                                    <a class="nav-link" href="#">Activities</a>
                                </li>-->
                            </ul>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($this->uri->segment(2) == 'system' ? 'active' : ''); ?>" href="<?php echo site_url(['admin', 'system', 'settings', 'app']); ?>">
                                <i class="fas fa-hdd fa-fw mr-1"></i> System
                            </a>

                            <?php if ($this->uri->segment(2) == 'system'): ?>
                            <ul class="list-unstyled">
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($this->uri->segment(3) == 'settings' ? 'active' : ''); ?>" href="<?php echo site_url(['admin', 'system', 'settings', 'app']); ?>">Settings</a>
                                </li>
                            </ul>
                            <?php endif; ?>
                        </li>
                    </ul>

                    <a id="brand" class="p-3 mt-auto text-center small font-italic" href="<?php echo $this->config->item('app_authorUrl'); ?>">© <?php echo date('Y'); ?> <?php echo $this->config->item('app_author'); ?></a>
                </div>

                <div id="content" class="col p-0 d-flex flex-column h-100 _flex_1 _oy_auto _custom_scrollbar">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">

                                <noscript>
                                    <div class="alert alert-danger rounded-0 mt-3 mb-0 animated faster shake" role="alert">
                                        <i class="fas fa-times-circle mr-1"></i> Javascript is required. please enable it on your web browser.
                                    </div>
                                </noscript>
