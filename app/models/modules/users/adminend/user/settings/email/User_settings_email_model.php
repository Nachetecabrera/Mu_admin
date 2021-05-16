<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Email user settings model file
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




class User_settings_email_model extends CI_Model
{
    /**
     * Check whether user requested email verification before.
     *
     * @param $userID String|Integer.
     * @param $tokenFields Array.
     */
    public function verificationRequested($userID, $tokenFields)
    {
        foreach ($tokenFields as $tokenField) {
            $this->db->select($tokenField);
        }

        $this->db->where('userID', $userID);

        $query = $this->db->get('users_email_verification_tokens');

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }



    /**
     * Create new email verification tokens.
     *
     * @param $data Array.
     */
    public function createToken($data)
    {
        $tokenExpirationTimestamp = time() + (60 * $this->preferences->type('system')->item('users_emailVerificationTokenExpirationInMinutes')); // In seconds.

        $this->db->set('userID', $data['userID']);
        $this->db->set('token', $data['token']);
        $this->db->set('datetimeCreated', date('Y-m-d H:i:s'));
        $this->db->set('datetimeUpdated', date('Y-m-d H:i:s'));
        $this->db->set('datetimeExpiration', date('Y-m-d H:i:s', $tokenExpirationTimestamp));

        $this->db->insert('users_email_verification_tokens');

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Update already existing email verification tokens.
     *
     * @param $tokenID String|Integer.
     * @param $data Array.
     */
    public function updateToken($tokenID, $data)
    {
        $tokenExpirationTimestamp = time() + (60 * $this->preferences->type('system')->item('users_emailVerificationTokenExpirationInMinutes')); // In seconds.

        $this->db->set('token', $data['token']);
        $this->db->set('datetimeUpdated', date('Y-m-d H:i:s'));
        $this->db->set('datetimeExpiration', date('Y-m-d H:i:s', $tokenExpirationTimestamp));
        $this->db->where('ID', $tokenID);

        $this->db->update('users_email_verification_tokens');

        if ($this->db->affected_rows() == 1 || $this->db->affected_rows() == 0) { // affected_rows == 0 is a very rare situation here.
            return true;
        } else {
            return false;
        }
    }



    /**
     * Check email verification code expiration.
     *
     * @param $userID String|Integer.
     */
    public function emailVerificationCodeExpired($userID)
    {
        $this->db->select('datetimeUpdated');
        $this->db->where('userID', $userID);

        $query = $this->db->get('users_email_verification_tokens');

        if ($query->num_rows() == 1) {

            $this->config->load('modules/users/config');

            // Check token expiration.
            $tokenDateTime = new DateTime($query->row()->datetimeUpdated);
            $nowDateTime = new DateTime();

            $diff = $nowDateTime->diff($tokenDateTime);

            $diffInMinutes = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;

            $tokenExpirationInMinutes = (int) $this->preferences->type('system')->item('users_emailVerificationTokenExpirationInMinutes');

            if ($diffInMinutes > $tokenExpirationInMinutes) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }



    /**
     * Verify/Validate email verification code.
     *
     * @param $userID String|Integer.
     * @param $emailVerificationCode String|Integer.
     */
    public function validateEmailVerificationCode($userID, $emailVerificationCode)
    {
        $this->db->select('token');
        $this->db->where('userID', $userID);

        $query = $this->db->get('users_email_verification_tokens');

        if ($query->num_rows() == 1) {

            $this->load->library('encryption');

            $decryptedEmailVerificationCode = $this->encryption->decrypt($query->row()->token);

            if ($emailVerificationCode == $decryptedEmailVerificationCode) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }



    /**
     * Change/verify user email
     *
     * @param $userID String|Integer.
     * @param $email String.
     */
    public function changeVerifyEmail($userID, $email)
    {
        $this->db->set('email', $email);
        $this->db->set('emailVerification', 1);
        $this->db->where('ID', $userID);

        $this->db->update('users_users');

        if ($this->db->affected_rows() == 1 || $this->db->affected_rows() == 0) { // affected_rows == 0 is a very rare situation here.
            return true;
        } else {
            return false;
        }
    }



    /**
     * Delete used email verification token database table row.
     *
     * @param $userID String|Integer.
     */
    public function deleteEmailVerificationToken($userID)
    {
        $this->db->where('userID', $userID);

        $this->db->delete('users_email_verification_tokens');

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
} // Class end.
