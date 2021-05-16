<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Edit user permission model file
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




class Edit_user_permission_model extends CI_Model
{
    /**
     * Edit user permission.
     *
     * @param $formData Array.
     * @param $permissionType String.
     */
    public function editUserPermission($formData, $permissionType)
    {
        if (strtolower($permissionType) == 'local') {
            $this->db->set('moduleSlug', $formData['userPermissionModuleSlug']);
            $this->db->set('permissionName', $formData['userPermissionName']);
            $this->db->set('permissionKey', $formData['userPermissionKey']);
            $this->db->set('permissionDescription', $formData['userPermissionDescription']);
        }

        $this->db->set('state', $formData['state']);
        $this->db->set('datetimeUpdated', date('Y-m-d H:i:s'));
        $this->db->where('ID', $this->uri->segment(5));

        $this->db->update('users_permissions');

        if ($this->db->affected_rows() == 1 || $this->db->affected_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }
} // Class end.
