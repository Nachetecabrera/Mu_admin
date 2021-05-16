<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Add user group model file
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




class Add_user_group_model extends CI_Model
{
    /**
     * Add new user group.
     *
     * @param $formData Array.
     */
    public function addUserGroup($formData)
    {
        $this->db->set('groupName', $formData['userGroupName']);
        $this->db->set('groupSlug', str_replace(' ', '-', $formData['userGroupSlug']));
        $this->db->set('groupDescription', $formData['userGroupDescription']);
        $this->db->set('state', $formData['state']);
        $this->db->set('datetimeCreated', date('Y-m-d H:i:s'));

        $this->db->insert('users_user_groups');

        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
} // Class end.
