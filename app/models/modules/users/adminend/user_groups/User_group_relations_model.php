<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| User group relations model file
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




class User_group_relations_model extends CI_Model
{
    /**
     * Assign user groups.
     *
     * @param $groups Array.
     * @param $identifier String|Integer.
     */
    public function assignUserGroups($groups, $identifier)
    {
        foreach ($groups as $group) {
            $rows[] = ['groupID' => $group, 'userID' => $identifier];
        }

        $this->db->insert_batch('users_user_group_relations', $rows);

        if ($this->db->affected_rows() == count($groups)) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * De-assign user groups.
     *
     * @param $identifier String|Integer.
     */
    public function deAssignUserGroups($identifier)
    {
        $this->db->where('userID', $identifier);
        $this->db->delete('users_user_group_relations');

        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }
} // Class end.
