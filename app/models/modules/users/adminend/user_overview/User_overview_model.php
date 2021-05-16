<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| User overview model file
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




class User_overview_model extends CI_Model
{
    /**
     * Get number of online users.
     */
    public function numOnlineUsers()
    {
        $this->db->select('ID');
        $this->db->from('users_users');
        $this->db->where('TIMESTAMPDIFF(MINUTE, datetimeLastActivity, "' . date('Y-m-d H:i:s') . '") <', $this->preferences->type('system')->item('auth_userOfflineConsiderationInMinutes'));

        $queryResult = $this->db->get();

        if ($queryResult) {
            return $queryResult->num_rows();
        } else {
            return false;
        }
    }



    /**
     * Get number of today active users.
     */
    public function numTodayActiveUsers()
    {
        $this->db->select('ID');
        $this->db->from('users_users');
        $this->db->where('TIMESTAMPDIFF(DAY, datetimeLastActivity, "' . date('Y-m-d H:i:s') . '") =', 0);

        $queryResult = $this->db->get();

        if ($queryResult) {
            return $queryResult->num_rows();
        } else {
            return false;
        }
    }



    /**
     * Get number of users by user state.
     */
    public function numUsersByState()
    {
        // Since there is no any params get passed into this query from outside, no need to escape those params.
        $queryResult = $this->db->query('
            SELECT
            (SELECT COUNT(ID) FROM ' . $this->db->dbprefix('users_users') . ') AS allUserCount,
            (SELECT COUNT(ID) FROM ' . $this->db->dbprefix('users_users') . ' WHERE state = "active") AS activeUserCount,
            (SELECT COUNT(ID) FROM ' . $this->db->dbprefix('users_users') . ' WHERE state = "inactive") AS inactiveUserCount
        ');

        if ($queryResult) {
            return $queryResult->row();
        } else {
            return false;
        }
    }



    /**
     * Get number of users by user email verification.
     */
    public function numUsersByEmailVerification()
    {
        // Since there is no any params get passed into this query from outside, no need to escape those params.
        $queryResult = $this->db->query('
            SELECT
            (SELECT COUNT(ID) FROM ' . $this->db->dbprefix('users_users') . ') AS allUserEmailCount,
            (SELECT COUNT(ID) FROM ' . $this->db->dbprefix('users_users') . ' WHERE emailVerification = 1) AS verifiedUserEmailCount,
            (SELECT COUNT(ID) FROM ' . $this->db->dbprefix('users_users') . ' WHERE emailVerification = 0) AS unverifiedUserEmailCount
        ');

        if ($queryResult) {
            return $queryResult->row();
        } else {
            return false;
        }
    }



    /**
     * Get number of users by their registered month.
     */
    public function numUsersByRegisteredMonth()
    {
        // Generate dates array.
        $currentDate = date('Y-m-d');
        $dates[] = $currentDate;

        for ($i = 0; $i < 12; $i++) {
            $dates[] = date('Y-m-d', strtotime('' . $currentDate . ' first day of previous month'));
            $currentDate = $dates[$i + 1];
        }

        // Generating SQL query.
        // Since there is no any params get passed into this query from outside, no need to escape those params.
        foreach ($dates as $date) {
            $this->db->select('(SELECT COUNT(ID) FROM ' . $this->db->dbprefix('users_users') . ' WHERE YEAR(datetimeCreated) = ' . date('Y', strtotime($date)) .  ' AND MONTH(datetimeCreated) = ' . date('n', strtotime($date)) . ') AS "' . date('M Y', strtotime($date)) . '"');
        }

        $sql = $this->db->get_compiled_select();

        $queryResult = $this->db->query($sql);

        if ($queryResult) {
            return (object) array_reverse((array) $queryResult->row());
        } else {
            return false;
        }
    }



    /**
     * Get specific number of last registered users.
     *
     * @param $selectFields Array.
     * @param $numOfUsers Integer.
     */
    public function lastRegisteredUsers($selectFields, $numOfUsers = 5)
    {
        $this->db->select(implode(',', $selectFields));
        $this->db->order_by('ID', 'DESC');
        $this->db->limit($numOfUsers);

        $queryResult = $this->db->get('users_users');

        if ($queryResult) {
            return $queryResult->result();
        } else {
            return false;
        }
    }



    /**
     * Get specific number of last active users.
     *
     * @param $selectFields Array.
     * @param $numOfUsers Integer.
     */
    public function lastActiveUsers($selectFields, $numOfUsers = 5)
    {
        $this->db->select(implode(',', $selectFields));
        $this->db->order_by('datetimeLastActivity', 'DESC');
        $this->db->limit($numOfUsers);

        $queryResult = $this->db->get('users_users');

        if ($queryResult) {
            return $queryResult->result();
        } else {
            return false;
        }
    }
} // Class end.
