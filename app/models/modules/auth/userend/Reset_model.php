<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Reset model file
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




class Reset_model extends CI_Model
{
    /**
     * Check account existence.
     *
     * @param $authIdentifier String.
     */
    public function accountExist($authIdentifier)
    {
        $this->db->select('ID');

        if (filter_var($authIdentifier, FILTER_VALIDATE_EMAIL)) {
            $this->db->where('email', $authIdentifier);
        } else {
            $this->db->where('username', $authIdentifier);
        }

        $query = $this->db->get('users_users');

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Get specified account information by user identifier.
     *
     * @param $authIdentifier String.
     * @param $accountFields Array.
     */
    public function accountInfo($authIdentifier, $accountFields)
    {
        foreach ($accountFields as $accountField) {
            $this->db->select($accountField);
        }

        if (filter_var($authIdentifier, FILTER_VALIDATE_EMAIL)) {
            $this->db->where('email', $authIdentifier);
        } else {
            $this->db->where('username', $authIdentifier);
        }

        $query = $this->db->get('users_users');

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }



    /**
     * Check whether user requested password reset before.
     *
     * @param $userID String|Integer.
     * @param $tokenFields Array.
     */
    public function resetRequested($userID, $tokenFields)
    {
        foreach ($tokenFields as $tokenField) {
            $this->db->select($tokenField);
        }

        $this->db->where('userID', $userID);

        $query = $this->db->get('auth_password_reset_tokens');

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }



    /**
     * Create new password reset tokens.
     *
     * @param $data Array.
     */
    public function createToken($data)
    {
        $tokenExpirationTimestamp = time() + (60 * $this->preferences->type('system')->item('auth_passwordResetTokenExpirationInMinutes')); // In seconds.

        $this->db->set('userID', $data['userID']);
        $this->db->set('token', $data['token']);
        $this->db->set('datetimeCreated', date('Y-m-d H:i:s'));
        $this->db->set('datetimeUpdated', date('Y-m-d H:i:s'));
        $this->db->set('datetimeExpiration', date('Y-m-d H:i:s', $tokenExpirationTimestamp));

        $this->db->insert('auth_password_reset_tokens');

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Update already existing password reset tokens.
     *
     * @param $tokenID String|Integer.
     * @param $data Array.
     */
    public function updateToken($tokenID, $data)
    {
        $tokenExpirationTimestamp = time() + (60 * $this->preferences->type('system')->item('auth_passwordResetTokenExpirationInMinutes')); // In seconds.

        $this->db->set('token', $data['token']);
        $this->db->set('datetimeUpdated', date('Y-m-d H:i:s'));
        $this->db->set('datetimeExpiration', date('Y-m-d H:i:s', $tokenExpirationTimestamp));
        $this->db->where('ID', $tokenID);

        $this->db->update('auth_password_reset_tokens');

        if ($this->db->affected_rows() == 1 || $this->db->affected_rows() == 0) { // affected_rows == 0 is a very rare situation here.
            return true;
        } else {
            return false;
        }
    }



    /**
     * Check password reset code expiration.
     *
     * @param $userID String|Integer.
     */
    public function passwordResetCodeExpired($userID)
    {
        $this->db->select('datetimeUpdated');
        $this->db->where('userID', $userID);

        $query = $this->db->get('auth_password_reset_tokens');

        if ($query->num_rows() == 1) {

            $this->config->load('modules/auth/config');

            // Check token expiration.
            $tokenDateTime = new DateTime($query->row()->datetimeUpdated);
            $nowDateTime = new DateTime();

            $diff = $nowDateTime->diff($tokenDateTime);

            $diffInMinutes = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;

            $tokenExpirationInMinutes = (int) $this->preferences->type('system')->item('auth_passwordResetTokenExpirationInMinutes');

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
     * Verify/Validate password reset code.
     *
     * @param $userID String|Integer.
     * @param $passwordResetCode String|Integer.
     */
    public function validatePasswordResetCode($userID, $passwordResetCode)
    {
        $this->db->select('token');
        $this->db->where('userID', $userID);

        $query = $this->db->get('auth_password_reset_tokens');

        if ($query->num_rows() == 1) {

            $this->load->library('encryption');

            $decryptedPasswordResetCode = $this->encryption->decrypt($query->row()->token);

            if ($passwordResetCode == $decryptedPasswordResetCode) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }



    /**
     * Reset/Update old password with a new one.
     *
     * @param $userID String|Integer.
     * @param $password String.
     */
    public function resetPassword($userID, $password)
    {
        $this->db->set('password', password_hash($password, PASSWORD_DEFAULT));
        $this->db->where('ID', $userID);

        $this->db->update('users_users');

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Delete used reset password token database table row.
     *
     * @param $userID String|Integer.
     */
    public function deleteResetPasswordToken($userID)
    {
        $this->db->where('userID', $userID);

        $this->db->delete('auth_password_reset_tokens');

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

} // Class end.
