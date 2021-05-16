<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| User model file
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




class User_model extends CI_Model
{
    /**
     * Get user.
     *
     * @param $selectFields Array.
     * @param $identifier String|Integer.
     */
    public function user($selectFields, $identifier)
    {
        // Increase the length of group concat string (default length: 1024 characters).
        $this->db->query('SET SESSION group_concat_max_len = 1000000');

        /**
         * Compiled sub queries.
         */

        // For aliased tagsTable.
        $this->db->select('userID, COUNT(tagID) AS tagCount, GROUP_CONCAT(tagID) AS tagIDs, GROUP_CONCAT(tagName) AS tagNames');
        $this->db->from('users_user_tag_relations');
        $this->db->join('users_user_tags', 'users_user_tags.ID = users_user_tag_relations.tagID', 'left');
        $this->db->group_by('userID');

        $subQueryTagsTable = $this->db->get_compiled_select();

        // For aliased rolesTable.
        $this->db->select('userID, COUNT(roleID) AS roleCount, GROUP_CONCAT(roleID) AS roleIDs, GROUP_CONCAT(roleName) AS roleNames, GROUP_CONCAT(state) AS roleStates, GROUP_CONCAT(data) AS roleDataBlobs');
        $this->db->from('users_user_role_relations');
        $this->db->join('users_user_roles', 'users_user_roles.ID = users_user_role_relations.roleID', 'left');
        $this->db->group_by('userID');

        $subQueryRolesTable = $this->db->get_compiled_select();

        // For aliased groupsTable.
        $this->db->select('userID, COUNT(groupID) AS groupCount, GROUP_CONCAT(groupID) AS groupIDs, GROUP_CONCAT(groupName) AS groupNames');
        $this->db->from('users_user_group_relations');
        $this->db->join('users_user_groups', 'users_user_groups.ID = users_user_group_relations.groupID', 'left');
        $this->db->group_by('userID');

        $subQueryGroupsTable = $this->db->get_compiled_select();

        /**
         * Real query start from here.
         */

        $this->db->select(implode(',', $selectFields));

        $this->db->join('users_user_statuses', 'users_user_statuses.ID = users_users.statusID', 'left');
        $this->db->join('(' . $subQueryTagsTable . ') AS tagsTable', 'tagsTable.userID = users_users.ID', 'left');
        $this->db->join('(' . $subQueryRolesTable . ') AS rolesTable', 'rolesTable.userID = users_users.ID', 'left');
        $this->db->join('(' . $subQueryGroupsTable . ') AS groupsTable', 'groupsTable.userID = users_users.ID', 'left');

        $this->db->where('users_users.ID', $identifier);

        $queryResult = $this->db->get('users_users');

        if ($queryResult->num_rows() == 1) {
            return $queryResult->row();
        } else {
            return false;
        }
    }
} // Class end.
