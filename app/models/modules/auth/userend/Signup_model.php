<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Signup model file
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




class Signup_model extends CI_Model
{
    /**
     * Signup users.
     *
     * @param $formData Array.
     */
    public function signup($formData)
    {
        $this->db->set('firstName', $formData['firstName']);
        $this->db->set('surname', $formData['surname']);
        $this->db->set('username', $formData['username']);
        $this->db->set('email', $formData['email']);
        $this->db->set('password', password_hash($formData['password'], PASSWORD_DEFAULT));
        $this->db->set('state', $this->preferences->type('system')->item('auth_signupDefaultUserState'));
        $this->db->set('datetimeCreated', date('Y-m-d H:i:s'));
        $this->db->set('datetimeLastActivity', date('Y-m-d H:i:s'));

        $this->db->insert('users_users');

        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
} // Class end.
