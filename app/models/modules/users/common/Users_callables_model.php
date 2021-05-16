<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Users callables model file
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




class Users_callables_model extends CI_Model
{
    /**
     * Check the correctness of user current password.
     *
     * @param $password String.
     */
    public function isCurrentPasswordCorrect($password)
    {
        $this->db->select('password');
        $this->db->where('ID', $this->session->userID);

        $queryResult = $this->db->get('users_users');

        if ($queryResult->num_rows() == 1) {

            $currentPassword = $queryResult->row()->password;
            $password = htmlspecialchars(trim($password));

            if (empty($password)) {

                $this->form_validation->set_message('isCurrentPasswordCorrect', '{field} is required.');
                return false;

            } elseif (!password_verify($password, $currentPassword)) {

                $this->form_validation->set_message('isCurrentPasswordCorrect', '{field} you have entered is incorrect.');
                return false;

            } else {

                return true;

            }

        } else {

            $this->form_validation->set_message('isCurrentPasswordCorrect', 'User current password checking failed due to an internal error.');
            return false;

        }
    }
} // Class end.
