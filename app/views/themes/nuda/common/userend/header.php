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
        <link rel="stylesheet" href="<?php echo base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'userend', 'css', 'userend.min.css?v=' . $this->config->item('appskull_version')]); ?>">
        <link rel="stylesheet" href="<?php echo base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'common', 'css', 'app.css?v=' . $this->config->item('app_version')]); ?>">
        <link rel="stylesheet" href="<?php echo base_url([$this->preferences->type('system')->item('app_assetsDir'), $this->preferences->type('system')->item('app_themesDir'), $this->preferences->type('system')->item('app_themeDir'), 'common', 'userend', 'css', 'app.css?v=' . $this->config->item('app_version')]); ?>">

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="<?php echo base_url('favicon.ico?v=' . $this->config->item('app_version')); ?>">

        <?php

        // Header injector.
        if (isset($injections)) {
            $this->asset->injector('header', $injections);
        }

        ?>
    </head>

    <body class="h-100">
