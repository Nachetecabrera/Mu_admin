<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Edit user role model file
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




class Edit_user_role_model extends CI_Model
{
    /**
     * Edit user role.
     *
     * @param $formData Array.
     */
    public function editUserRole($formData)
    {
        $this->db->set('roleName', $formData['userRoleName']);
        $this->db->set('roleSlug', str_replace(' ', '-', $formData['userRoleSlug']));
        $this->db->set('roleDescription', $formData['userRoleDescription']);
        $this->db->set('state', $formData['state']);
        $this->db->set('datetimeUpdated', date('Y-m-d H:i:s'));
        $this->db->where('ID', $this->uri->segment(5));

        $this->db->update('users_user_roles');

        if ($this->db->affected_rows() == 1 || $this->db->affected_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }
} // Class end.
