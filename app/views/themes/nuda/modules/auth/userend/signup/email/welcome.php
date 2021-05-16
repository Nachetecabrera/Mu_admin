<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Signup welcome email template view file
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
        <title>Welcome</title>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
        <h1>Welcome to <?php echo $this->preferences->type('system')->item('app_name'); ?>!</h1>

        <hr>

        <p>Hi <?php echo $this->input->post('firstName', true); ?>,</p>

        <p>Thanks for signing up for our <?php echo $this->preferences->type('system')->item('app_name'); ?>!</p>

        <p>We're happy to have you onboard.</p>

        <p>Wasn't this you? if so, please ignore this email.</p>
    </body>
</html>
