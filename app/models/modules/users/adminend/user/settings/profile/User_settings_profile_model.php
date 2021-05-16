<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Profile user settings model file
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




class User_settings_profile_model extends CI_Model
{
    /**
     * Update user profile.
     *
     * @param $formData Array.
     * @param $userID Integer|String.
     */
    public function updateProfile($formData, $userID)
    {
        $this->db->set('firstName', $formData['firstName']);
        $this->db->set('surname', $formData['surname']);
        $this->db->set('datetimeUpdated', date('Y-m-d H:i:s'));

        $this->db->where('ID', $userID);

        $this->db->update('users_users');

        if ($this->db->affected_rows() == 1 || $this->db->affected_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }
} // Class end.
