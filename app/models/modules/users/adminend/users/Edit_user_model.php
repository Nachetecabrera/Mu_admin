<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Edit user model file
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




class Edit_user_model extends CI_Model
{
    /**
     * Edit user.
     *
     * @param $formData Array.
     * @param $userID Integer|String.
     */
    public function editUser($formData, $userID)
    {
        $this->db->set('firstName', $formData['firstName']);
        $this->db->set('surname', $formData['surname']);
        $this->db->set('username', $formData['username']);
        $this->db->set('email', $formData['email']);
        $this->db->set('emailVerification', $formData['emailVerification']);

        if (!empty($formData['password'])) {
            $this->db->set('password', password_hash($formData['password'], PASSWORD_DEFAULT));
        }

        if (!empty($formData['datetimeCreated'])) {
            $this->db->set('datetimeCreated', $formData['datetimeCreated']);
        }

        $this->db->set('datetimeUpdated', date('Y-m-d H:i:s'));
        $this->db->set('state', $formData['state']);

        $this->db->where('ID', $userID);

        $this->db->update('users_users');

        if ($this->db->affected_rows() == 1 || $this->db->affected_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Edit specific user data.
     *
     * @param $data Array.
     * @param $userID Integer|String.
     */
    public function editUserData($data, $userID)
    {
        foreach ($data as $field => $value) {
            $this->db->set($field, $value);
        }

        $this->db->where('ID', $userID);

        $this->db->update('users_users');

        if ($this->db->affected_rows() == 1 || $this->db->affected_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }
} // Class end.
