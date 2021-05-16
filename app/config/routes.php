<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home'; // Handle app index.
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



# Custom routes.

// App module routes.
$route['admin'] = 'modules/app/adminend/admin/Home';
$route['admin/system/settings/app'] = 'modules/app/adminend/system/Settings';



// Auth module routes.
$route['auth'] = 'modules/auth/userend/Signin';
$route['auth/signup'] = 'modules/auth/userend/Signup';

$route['auth/reset'] = 'modules/auth/userend/Reset/identifyAccount';
$route['auth/reset/code'] = 'modules/auth/userend/Reset/verifyPasswordResetCode';
$route['auth/reset/password'] = 'modules/auth/userend/Reset/resetPassword';

$route['auth/signout'] = 'modules/auth/userend/Signout';

$route['admin/system/settings/auth'] = 'modules/auth/adminend/system/Settings';



// Users module routes.
$route['admin/users'] = 'modules/users/adminend/users/Users';
$route['admin/users/page/(:num)'] = 'modules/users/adminend/users/Users';
$route['admin/users/add'] = 'modules/users/adminend/users/Add_user';
$route['admin/users/edit/(:num)'] = 'modules/users/adminend/users/Edit_user';

$route['admin/users/overview'] = 'modules/users/adminend/user_overview/User_overview';

$route['admin/users/statuses'] = 'modules/users/adminend/user_statuses/User_statuses';
$route['admin/users/statuses/page/(:num)'] = 'modules/users/adminend/user_statuses/User_statuses';
$route['admin/users/statuses/add'] = 'modules/users/adminend/user_statuses/Add_user_status';
$route['admin/users/statuses/edit/(:num)'] = 'modules/users/adminend/user_statuses/Edit_user_status';

$route['admin/users/tags'] = 'modules/users/adminend/user_tags/User_tags';
$route['admin/users/tags/page/(:num)'] = 'modules/users/adminend/user_tags/User_tags';
$route['admin/users/tags/add'] = 'modules/users/adminend/user_tags/Add_user_tag';
$route['admin/users/tags/edit/(:num)'] = 'modules/users/adminend/user_tags/Edit_user_tag';

$route['admin/users/roles'] = 'modules/users/adminend/user_roles/User_roles';
$route['admin/users/roles/page/(:num)'] = 'modules/users/adminend/user_roles/User_roles';
$route['admin/users/roles/add'] = 'modules/users/adminend/user_roles/Add_user_role';
$route['admin/users/roles/edit/(:num)'] = 'modules/users/adminend/user_roles/Edit_user_role';

$route['admin/users/groups'] = 'modules/users/adminend/user_groups/User_groups';
$route['admin/users/groups/page/(:num)'] = 'modules/users/adminend/user_groups/User_groups';
$route['admin/users/groups/add'] = 'modules/users/adminend/user_groups/Add_user_group';
$route['admin/users/groups/edit/(:num)'] = 'modules/users/adminend/user_groups/Edit_user_group';

$route['admin/users/permissions'] = 'modules/users/adminend/user_permissions/User_permissions';
$route['admin/users/permissions/add'] = 'modules/users/adminend/user_permissions/Add_user_permission';
$route['admin/users/permissions/edit/(:num)'] = 'modules/users/adminend/user_permissions/Edit_user_permission';

$route['admin/user/settings/profile'] = 'modules/users/adminend/user/settings/profile/Profile';
$route['admin/user/settings/account'] = 'modules/users/adminend/user/settings/account/Account';
$route['admin/user/settings/security'] = 'modules/users/adminend/user/settings/security/Security';
$route['admin/user/settings/email'] = 'modules/users/adminend/user/settings/email/Email';
$route['admin/user/settings/email/code'] = 'modules/users/adminend/user/settings/email/Email/verifyEmailVerificationCode';
$route['admin/user/settings/email/succeeded'] = 'modules/users/adminend/user/settings/email/Email/operationSucceeded';

$route['admin/system/settings/users'] = 'modules/users/adminend/system/Settings';
