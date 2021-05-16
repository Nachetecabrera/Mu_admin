<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Auth module configuration file
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
 * Sign in redirect route.
 *
 * Default: '' (App index route)
 */
$config['auth_signinRedirectRoute'] = 'admin';



/**
 * Remember me option.
 *
 * Default: true
 *
 * Available options:
 * - true (Remember me option enabled)
 * - false (Remember me option disabled)
 */
$config['auth_rememberMeOption'] = true;

/**
 * Remember me default state.
 *
 * Default: 'unchecked'
 *
 * Available options:
 * - 'checked'
 * - 'unchecked'
 */
$config['auth_rememberMeDefaultState'] = 'checked';

/**
 * Remember me token expiration in minutes.
 *
 * NOTE: Must only contain digits & must be greater than zero.
 *
 * Default: 525600 (A year)
 */
$config['auth_rememberMeTokenExpirationInMinutes'] = 525600;

/**
 * Remember me cookie name.
 *
 * NOTE: Separate words should be concatenated with underscore.
 *
 * Default: 'rememberMe'
 */
$config['auth_rememberMeCookieName'] = 'rememberMe';



/**
 * Sign up option.
 *
 * Default: true
 *
 * Available options:
 * - true (Sign up option enabled)
 * - false (Sign up option disabled)
 */
$config['auth_signupOption'] = true;

/**
 * Sign up default user state.
 *
 * Default: 'active'
 *
 * Available options:
 * - 'active'
 * - 'inactive'
 */
$config['auth_signupDefaultUserState'] = 'active';

/**
 * Sign up welcome email sending.
 *
 * Default: true
 *
 * Available options:
 * - true (Sign up welcome email sending option enabled)
 * - false (Sign up welcome email sending option disabled)
 */
$config['auth_signupWelcomeEmail'] = true;



/**
 * Password reset option.
 *
 * Default: true
 *
 * Available options:
 * - true (Password reset option enabled)
 * - false (Password reset option disabled)
 */
$config['auth_passwordResetOption'] = true;

/**
 * Password reset token expiration in minutes.
 *
 * NOTE: Must only contain digits & must be greater than zero.
 *
 * Default: 60 (An hour)
 */
$config['auth_passwordResetTokenExpirationInMinutes'] = 60;



/**
 * Consider user is offline after certain number of minutes of inactivity.
 *
 * NOTE: Must only contain digits & must be greater than zero.
 *
 * Default: 5
 */
$config['auth_userOfflineConsiderationInMinutes'] = 5;
