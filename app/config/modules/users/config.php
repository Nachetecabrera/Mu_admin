<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Users module configuration file
|
| Note: Config items should be same as corresponding database settingKeys
|       if exist.
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
 * Email verification.
 *
 * Default: optional
 *
 * Available options:
 * - required (Email verification required)
 * - optional (Email verification optional)
 */
$config['users_emailVerification'] = 'optional';

/**
 * Email verification token expiration in minutes.
 *
 * NOTE: Must only contain digits & must be greater than zero.
 *
 * Default: 60 (An hour)
 */
$config['users_emailVerificationTokenExpirationInMinutes'] = 60;



/**
 * Minimum password character length.
 *
 * NOTE: Must only contain digits & must be greater than zero.
 *
 * Default: 8
 */
$config['users_minimumPasswordLength'] = 8;
