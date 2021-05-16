<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| User library
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




class User
{
    private $CI;



    public function __construct()
    {
        // Initialize CI super object.
        $this->CI =& get_instance();

        $this->CI->config->load('modules/auth/config');
        $this->CI->config->load('modules/users/config');
    }



    # Authentication related.

    /**
     * Make user authenticate/signin.
     *
     * @param $userID String/Integer.
     */
    public function signin($userID)
    {
        $this->CI->session->signin = true;
        $this->CI->session->userID = (int) $userID;
    }



    /**
     * Make user unauthenticate/signout.
     *
     * @param $sessionDestroy Boolean.
     */
    public function signout($sessionDestroy = false)
    {
        if ($sessionDestroy) {
            $this->CI->session->sess_destroy(); // Remove current session completely.
        } else {
            $this->CI->session->unset_userdata(['signin', 'userID']); // Remove specific session data.
        }

        $this->CI->load->helper('cookie');

        delete_cookie($this->CI->preferences->type('system')->item('auth_rememberMeCookieName'), $this->CI->config->item('cookie_domain'), $this->CI->config->item('cookie_path'), $this->CI->config->item('cookie_prefix'));
    }



    /**
     * Check user authentication.
     */
    public function isSignin()
    {
        if ($this->CI->session->signin === true) {
            return true;
        } else {

            // Check for remember me option settings.
            if (!$this->CI->preferences->type('system')->item('auth_rememberMeOption')) {
                return false;
            } else {

                // Check for remember me cookie existence.
                $this->CI->load->helper('cookie');

                if (!get_cookie($this->CI->preferences->type('system')->item('auth_rememberMeCookieName'), true)) {
                    return false;
                } else {

                    // Check if corresponding remember me token exist in the database.
                    $explodedRememberMeCookie = explode(',', get_cookie($this->CI->preferences->type('system')->item('auth_rememberMeCookieName'), true));

                    $tokenID = (int) $explodedRememberMeCookie[0];
                    $token = $explodedRememberMeCookie[1];

                    $this->CI->load->model('modules/auth/userend/signin_model');

                    $tokenRow = $this->CI->signin_model->token(['ID', 'userID', 'token'], $tokenID);

                    if (!$tokenRow) {
                        return false;
                    } else {

                        // Check if cookie is valid.
                        if (!password_verify($token, $tokenRow->token)) {
                            return false;
                        } else {

                            $this->CI->load->helper('string');
                            $rememberMeToken = random_string('alnum', 256);

                            $rememberMeTokenHash = password_hash($rememberMeToken, PASSWORD_DEFAULT);

                            $this->CI->load->library('user_agent');

                            $rememberMeTokenData = [
                                'IP' => $_SERVER['REMOTE_ADDR'],
                                'userAgent' => $this->CI->agent->agent_string()
                            ];

                            $serializedRememberMeTokenData = serialize($rememberMeTokenData);

                            if (!$this->CI->signin_model->updateToken(['tokenID' => $tokenRow->ID, 'rememberMeTokenHash' => $rememberMeTokenHash, 'serializedRememberMeTokenData' => $serializedRememberMeTokenData])) {
                                return false;
                            } else {

                                $rememberMeTokenExpirationTimestamp = (int) 60 * $this->CI->preferences->type('system')->item('auth_rememberMeTokenExpirationInMinutes'); // In seconds.

                                $this->CI->load->helper('cookie');

                                set_cookie($this->CI->preferences->type('system')->item('auth_rememberMeCookieName'), $tokenRow->ID . ',' . $rememberMeToken, $rememberMeTokenExpirationTimestamp, $this->CI->config->item('cookie_domain'), $this->CI->config->item('cookie_path'), $this->CI->config->item('cookie_prefix'), $this->CI->config->item('cookie_secure'), $this->CI->config->item('cookie_httponly'));

                                $this->signin($tokenRow->userID);

                                return true;

                            }

                        }

                    }

                }

            }

        }
    }



    /**
     * Check if user online or not.
     *
     * @param $lastActivityDateTime String.
     */
    public function isOnline($lastActivityDateTime)
    {
        $lastActivityDateTime = new DateTime($lastActivityDateTime);
        $nowDateTime = new DateTime();

        $diff = $nowDateTime->diff($lastActivityDateTime);

        $diffInMinutes = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;

        $userOfflineConsiderationInMinutes = (int) $this->CI->preferences->type('system')->item('auth_userOfflineConsiderationInMinutes');

        if ($diffInMinutes >= $userOfflineConsiderationInMinutes) {
            return false;
        } else {
            return true;
        }
    }



    /**
     * Make user remember after signed in.
     *
     * @param $userID String/Integer.
     */
    public function rememberMe($userID)
    {
        $this->CI->load->helper('string');
        $rememberMeToken = random_string('alnum', 256);

        $rememberMeTokenHash = password_hash($rememberMeToken, PASSWORD_DEFAULT);

        $this->CI->load->library('user_agent');

        $rememberMeTokenData = [
            'IP' => $_SERVER['REMOTE_ADDR'],
            'userAgent' => $this->CI->agent->agent_string()
        ];

        $serializedRememberMeTokenData = serialize($rememberMeTokenData);

        // Creating remember me tokens in the database.
        $insertID = $this->CI->signin_model->createToken($userID, $rememberMeTokenHash, $serializedRememberMeTokenData);

        if ($insertID) {

            $rememberMeTokenExpirationTimestamp = (int) 60 * $this->CI->preferences->type('system')->item('auth_rememberMeTokenExpirationInMinutes'); // In seconds.

            $this->CI->load->helper('cookie');

            // Placing remember me cookies.
            set_cookie($this->CI->preferences->type('system')->item('auth_rememberMeCookieName'), $insertID . ',' . $rememberMeToken, $rememberMeTokenExpirationTimestamp, $this->CI->config->item('cookie_domain'), $this->CI->config->item('cookie_path'), $this->CI->config->item('cookie_prefix'), $this->CI->config->item('cookie_secure'), $this->CI->config->item('cookie_httponly'));

        }
    }



    # Permission related.

    /**
     * Return different kind of user data.
     */
    private function getUserData()
    {
        $this->CI->load->model('modules/users/adminend/users/user_model');
        $user = $this->CI->user_model->user(['users_users.emailVerification', 'users_users.state', 'rolesTable.roleStates', 'rolesTable.roleDataBlobs'], $this->CI->session->userID);

        if (empty($user->roleStates)) { // If there are no user roles assigned to the user.
            $roleStates = [];
        } else {
            $roleStates = explode(',', $user->roleStates);
        }

        // Generate active state only role data BLOBS array.
        if (!empty($user->roleDataBlobs)) { // If assigned all user roles contain NULL values instead of BLOB values in the 'data' table field.
            foreach ($roleStates as $key => $roleState) {
                if (strtolower($roleState) == 'active') {
                    $activeStateSerializedRoleDataBlobs[] = explode(',', $user->roleDataBlobs)[$key];
                }
            }
        }

        // Generate unserialized role data BLOBS array.
        if (!empty($activeStateSerializedRoleDataBlobs)) {
            foreach ($activeStateSerializedRoleDataBlobs as $roleDataBlob) {
                $unserializedRoleDataBlobs[] = unserialize($roleDataBlob);
            }
        }

        // Generate an array that contain only permissions arrays.
        if (!empty($unserializedRoleDataBlobs)) {
            foreach ($unserializedRoleDataBlobs as $unserializedRoleDataBlob) {
                $rolePermissionsArrays[] = $unserializedRoleDataBlob['permissions'];
            }
        }

        // Generate active state role permissionKeys array.
        if (!empty($rolePermissionsArrays)) {
            foreach ($rolePermissionsArrays as $rolePermissionsArray) {
                foreach ($rolePermissionsArray as $permissionKey => $state) {
                    if (strtolower($state) == 'active') {
                        $allActiveStateRolePermissionKeys[] = $permissionKey;
                    }
                }
            }
        }

        if (!empty($allActiveStateRolePermissionKeys)) {
            $allUniqueRolePermissionKeys = array_unique($allActiveStateRolePermissionKeys);
        } else {
            $allUniqueRolePermissionKeys = [];
        }

        return (object) [
            'userEmailVerification' => $user->emailVerification,
            'userState' => $user->state,
            'userPermissions' => $allUniqueRolePermissionKeys
        ];
    }



    /**
     * Check if user email verified.
     */
    public function isEmailVerified()
    {
        if ($this->getUserData()->userEmailVerification) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Check email verification with both system settings and user information.
     */
    public function isEmailVerification()
    {
        if (strtolower($this->CI->preferences->type('system')->item('users_emailVerification')) == 'optional') {
            return true;
        } else {
            if ($this->isEmailVerified()) {
                return true;
            } else {
                return false;
            }
        }
    }



    /**
     * Check if user has a specific permission.
     *
     * @param $permission String.
     */
    public function hasPermission($permission)
    {
        if (strtolower($this->getUserData()->userState) == 'active' &&
            in_array($permission, $this->getUserData()->userPermissions)
        ) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Check if user has any of an array of permissions.
     *
     * @param $permissions Array.
     */
    public function hasAnyPermission($permissions)
    {
        if (strtolower($this->getUserData()->userState) == 'active' &&
            count(array_intersect($this->getUserData()->userPermissions, $permissions)) >= 1
        ) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Check if user has all of an array of permissions.
     *
     * @param $permissions Array.
     */
    public function hasAllPermissions($permissions)
    {
        if (strtolower($this->getUserData()->userState) == 'active' &&
            count($permissions) == count(array_intersect($this->getUserData()->userPermissions, $permissions))
        ) {
            return true;
        } else {
            return false;
        }
    }
} // Class end.
