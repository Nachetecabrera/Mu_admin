<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| User group model file
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




class User_group_model extends CI_Model
{
    /**
     * Get user group.
     *
     * @param $selectFields Array.
     * @param $identifier String|Integer.
     */
    public function userGroup($selectFields, $identifier)
    {
        $this->db->select(implode(',', $selectFields));
        $this->db->where('ID', $identifier);

        $queryResult = $this->db->get('users_user_groups');

        if ($queryResult->num_rows() == 1) {
            return $queryResult->row();
        } else {
            return false;
        }
    }
} // Class end.
