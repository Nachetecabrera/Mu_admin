<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Reset password email template view file
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
        <title>Reset password</title>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
        <h1><?php echo $this->preferences->type('system')->item('app_name'); ?></h1>

        <hr>

        <p>Hi <?php echo $accountInfo->firstName; ?>,</p>

        <p>We received a request to reset your <?php echo $this->preferences->type('system')->item('app_name'); ?> password.</p>

        <p>Your password reset code is: <b><?php echo $randomIntegerNumber; ?></b></p>

        <p>If you didn't request this change, please ignore this email.</p>
    </body>
</html>
