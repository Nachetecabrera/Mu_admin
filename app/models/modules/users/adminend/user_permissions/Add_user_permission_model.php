<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Add user permission model file
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




class Add_user_permission_model extends CI_Model
{
    /**
     * Add new user permission.
     *
     * @param $formData Array.
     */
    public function addUserPermission($formData)
    {
        $this->db->set('moduleSlug', $formData['userPermissionModuleSlug']);
        $this->db->set('permissionName', $formData['userPermissionName']);
        $this->db->set('permissionKey', $formData['userPermissionKey']);
        $this->db->set('permissionDescription', $formData['userPermissionDescription']);
        $this->db->set('state', $formData['state']);
        $this->db->set('datetimeCreated', date('Y-m-d H:i:s'));

        $this->db->insert('users_permissions');

        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
} // Class end.
