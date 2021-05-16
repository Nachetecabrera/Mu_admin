<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Add user model file
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




class Add_user_model extends CI_Model
{
    /**
     * Add new user.
     *
     * @param $formData Array.
     */
    public function addUser($formData)
    {
        $this->db->set('firstName', $formData['firstName']);
        $this->db->set('surname', $formData['surname']);
        $this->db->set('username', $formData['username']);
        $this->db->set('email', $formData['email']);
        $this->db->set('emailVerification', $formData['emailVerification']);

        if (!empty($formData['password'])) {
            $this->db->set('password', password_hash($formData['password'], PASSWORD_DEFAULT));
        }

        $this->db->set('state', $formData['state']);
        $this->db->set('datetimeCreated', (empty($formData['datetimeCreated']) ? date('Y-m-d H:i:s') : $formData['datetimeCreated']));

        $this->db->insert('users_users');

        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
} // Class end.
