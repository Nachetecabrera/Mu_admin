<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Signin model file
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




class Signin_model extends CI_Model
{
    /**
     * Authenticate users.
     *
     * @param $formData Array.
     */
    public function signin($formData)
    {
        $this->db->select('ID, password');

        if (filter_var($formData['authIdentifier'], FILTER_VALIDATE_EMAIL)) {
            $this->db->where('email', $formData['authIdentifier']);
        } else {
            $this->db->where('username', $formData['authIdentifier']);
        }

        $query = $this->db->get('users_users');

        if ($query->num_rows() == 1) {

            if (password_verify($formData['password'], $query->row()->password)) {
                return $query->row()->ID;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }



    /**
     * Get remember me token.
     *
     * @param $selectFields Array.
     * @param $identifier String|Integer.
     */
    public function token($selectFields, $identifier)
    {
        $this->db->select(implode(',', $selectFields));
        $this->db->where('ID', $identifier);

        $queryResult = $this->db->get('auth_remember_me_tokens');

        if ($queryResult->num_rows() == 1) {
            return $queryResult->row();
        } else {
            return false;
        }
    }



    /**
     * Create new remember me tokens.
     *
     * @param $userID String|Integer.
     * @param $rememberMeTokenHash String.
     * @param $data Blob.
     */
    public function createToken($userID, $rememberMeTokenHash, $data)
    {
        $cookieExpirationTimestamp = time() + (60 * $this->preferences->type('system')->item('auth_rememberMeTokenExpirationInMinutes')); // In seconds.

        $this->db->set('userID', $userID);
        $this->db->set('token', $rememberMeTokenHash);
        $this->db->set('data', $data);
        $this->db->set('datetimeCreated', date('Y-m-d H:i:s'));
        $this->db->set('datetimeUpdated', date('Y-m-d H:i:s'));
        $this->db->set('datetimeExpiration', date('Y-m-d H:i:s', $cookieExpirationTimestamp));

        $this->db->insert('auth_remember_me_tokens');

        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }



    /**
     * Edit remember me token.
     *
     * @param $data Array.
     */
    public function updateToken($data)
    {
        $cookieExpirationTimestamp = time() + (60 * $this->preferences->type('system')->item('auth_rememberMeTokenExpirationInMinutes')); // In seconds.

        $this->db->set('token', $data['rememberMeTokenHash']);
        $this->db->set('data', $data['serializedRememberMeTokenData']);
        $this->db->set('datetimeUpdated', date('Y-m-d H:i:s'));
        $this->db->set('datetimeExpiration', date('Y-m-d H:i:s', $cookieExpirationTimestamp));
        $this->db->where('ID', $data['tokenID']);

        $this->db->update('auth_remember_me_tokens');

        if ($this->db->affected_rows() == 1 || $this->db->affected_rows() == 0) { // affected_rows == 0 is a very rare situation here.
            return true;
        } else {
            return false;
        }
    }
} // Class end.
