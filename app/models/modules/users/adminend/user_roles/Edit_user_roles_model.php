<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Edit user roles model file
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




class Edit_user_roles_model extends CI_Model
{
    /**
     * Edit user role permissions.
     *
     * @param $data Array.
     */
    public function editUserRolePermissions($data)
    {
        $affectedRows = $this->db->update_batch('users_user_roles', $data, 'ID');

        if ($affectedRows >= 1 || $affectedRows == 0) {
            return true;
        } else {
            return false;
        }
    }
} // Class end.
