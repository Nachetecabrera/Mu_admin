<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| New account view file
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
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSS -->

        <title><?php echo 'Your ' . $this->preferences->type('system')->item('app_name') . ' account has been created'; ?></title>
    </head>
    <body>
        <h1><?php echo $this->preferences->type('system')->item('app_name'); ?></h1>

        <hr>

        <p>Hi <?php echo $this->input->post('firstName', true); ?>,</p>

        <p>A authorized person at <?php echo $this->preferences->type('system')->item('app_name'); ?> has created an account for you.</p>

        <p>Your username is: <?php echo $this->input->post('username', true); ?></p>

        <?php if (!empty($this->input->post('password', true))): ?>
        <p>Please contact <?php echo $this->preferences->type('system')->item('app_name'); ?> support to get your password or follow bellow instructions to reset your account password.</p>
        <?php endif; ?>

        <p>To set your password and gain access to your account, visit the following  URL/address and use the password reset option.</p>

        <p><a href="<?php echo site_url(['auth', 'reset']); ?>"><?php echo site_url(['auth', 'reset']); ?></a></p>

        <p>If you think this was a mistake, please ignore this email.</p>
    </body>
</html>
