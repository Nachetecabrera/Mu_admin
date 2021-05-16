<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| User role relations model file
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




class User_role_relations_model extends CI_Model
{
    /**
     * Assign user roles.
     *
     * @param $roles Array.
     * @param $identifier String|Integer.
     */
    public function assignUserRoles($roles, $identifier)
    {
        foreach ($roles as $role) {
            $rows[] = ['roleID' => $role, 'userID' => $identifier];
        }

        $this->db->insert_batch('users_user_role_relations', $rows);

        if ($this->db->affected_rows() == count($roles)) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * De-assign user roles.
     *
     * @param $identifier String|Integer.
     */
    public function deAssignUserRoles($identifier)
    {
        $this->db->where('userID', $identifier);
        $this->db->delete('users_user_role_relations');

        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }
} // Class end.
