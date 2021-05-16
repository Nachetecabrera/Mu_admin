<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Users model file
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




class Users_model extends CI_Model
{
    /**
     * Get user filter data for specific filters.
     *
     * @param $tableField String.
     * @param $table String.
     * @param $filter String.
     */
    public function userFilterData($tableField, $table, $filter)
    {
        $this->db->select($tableField);
        $this->db->select('state');
        $this->db->where('ID', $filter);

        $queryResult = $this->db->get($table);

        if ($queryResult->num_rows() == 1) {
            return $queryResult->row();
        } else {
            return false;
        }
    }



    /**
     * Get user IDs for specific filters.
     *
     * @param $filterbyField String.
     * @param $filterValue String.
     * @param $table String.
     */
    public function userIDs($filterbyField, $filterValue, $table)
    {
        $this->db->select($table . '.userID');

        // Using 'LIKE' operator instead of '= (equals operator)' due to returning wrong results.
        // Homework: https://stackoverflow.com/questions/15715719/why-does-mysql-return-rows-that-seemingly-do-not-match-the-where-clause
        $this->db->like($filterbyField, $filterValue, 'none');

        $queryResult = $this->db->get($table);

        if ($queryResult) {
            return $queryResult->result();
        } else {
            return false;
        }
    }



    /**
     * Get all users.
     *
     * Support for single field sorting.
     * Support for multiple field searching.
     * Support for single field filtering.
     *
     * @param $selectFields Array.
     * @param $defaultOrderBy String.
     * @param $defaultOrder String.
     * @param $perPage Integer.
     * @param $searchFields Array.
     * @param $filterFields Array.
     * @param $userIDs Null|Array.
     */
    public function users($selectFields, $defaultOrderBy, $defaultOrder, $perPage = false, $searchFields = [], $filterFields = [], $userIDs = null)
    {
        // Increase the length of group concat string (default length: 1024 characters).
        $this->db->query('SET SESSION group_concat_max_len = 1000000');

        /**
         * Compiled sub queries.
         */

        // For aliased statusesTable.
        $this->db->select('users_user_statuses.ID AS userStatusID, statusName, users_user_statuses.state AS statusState');
        $this->db->from('users_user_statuses');

        $subQueryStatusesTable = $this->db->get_compiled_select();

        // For aliased tagsTable.
        $this->db->select('userID, COUNT(tagID) AS tagCount, GROUP_CONCAT(tagID) AS tagIDs, GROUP_CONCAT(tagName) AS tagNames, GROUP_CONCAT(state) AS tagStates');
        $this->db->from('users_user_tag_relations');
        $this->db->join('users_user_tags', 'users_user_tags.ID = users_user_tag_relations.tagID', 'left');
        $this->db->group_by('userID');

        $subQueryTagsTable = $this->db->get_compiled_select();

        // For aliased rolesTable.
        $this->db->select('userID, COUNT(roleID) AS roleCount, GROUP_CONCAT(roleID) AS roleIDs, GROUP_CONCAT(roleName) AS roleNames, GROUP_CONCAT(state) AS roleStates');
        $this->db->from('users_user_role_relations');
        $this->db->join('users_user_roles', 'users_user_roles.ID = users_user_role_relations.roleID', 'left');
        $this->db->group_by('userID');

        $subQueryRolesTable = $this->db->get_compiled_select();

        // For aliased groupsTable.
        $this->db->select('userID, COUNT(groupID) AS groupCount, GROUP_CONCAT(groupID) AS groupIDs, GROUP_CONCAT(groupName) AS groupNames, GROUP_CONCAT(state) AS groupStates');
        $this->db->from('users_user_group_relations');
        $this->db->join('users_user_groups', 'users_user_groups.ID = users_user_group_relations.groupID', 'left');
        $this->db->group_by('userID');

        $subQueryGroupsTable = $this->db->get_compiled_select();

        /**
         * Real query start from here.
         */

        /**
         * A SELECT statement may include a LIMIT clause to restrict the number of rows the server returns to the client.
         * In some cases, it is desirable to know how many rows the statement would have returned without the LIMIT,
         * but without running the statement again. To obtain this row count,
         * include an SQL_CALC_FOUND_ROWS option in the SELECT statement, and then invoke FOUND_ROWS() afterward.
         */
        $this->db->select('SQL_CALC_FOUND_ROWS ' . implode(',', $selectFields), false);

        $this->db->join('(' . $subQueryStatusesTable . ') AS statusesTable', 'statusesTable.userStatusID = users_users.statusID', 'left');
        $this->db->join('(' . $subQueryTagsTable . ') AS tagsTable', 'tagsTable.userID = users_users.ID', 'left');
        $this->db->join('(' . $subQueryRolesTable . ') AS rolesTable', 'rolesTable.userID = users_users.ID', 'left');
        $this->db->join('(' . $subQueryGroupsTable . ') AS groupsTable', 'groupsTable.userID = users_users.ID', 'left');

        // Handle filtering.
        if (
            !empty($filterFields) &&
            !empty($this->input->get('filterby', true)) &&
            in_array(strtolower($this->input->get('filterby', true)), array_map('strtolower', $filterFields)) &&
            $this->input->get('filter', true) !== null
        ) {
            // Using 'LIKE' operator instead of '= (equals operator)' due to returning wrong results.
            // Homework: https://stackoverflow.com/questions/15715719/why-does-mysql-return-rows-that-seemingly-do-not-match-the-where-clause
            $this->db->like('users_users.' . $this->input->get('filterby', true), $this->input->get('filter', true), 'none');
        }

        // Handle 'custom' filterby fields.
        if ($userIDs !== null) {
            $this->db->where_in('users_users.ID', $userIDs);
        }

        // Handle searching.
        if (!empty($searchFields) && $this->input->get('search', true) !== null) {

            $this->db->group_start();

            foreach ($searchFields as $searchField) {
                $this->db->or_like($searchField, trim($this->input->get('search', true)), 'both');
            }

            $this->db->group_end();

        }

        // Handle sorting.
        if (
            empty($this->input->get('orderby', true)) ||
            !in_array(strtolower($this->input->get('orderby', true)), array_map('strtolower', $selectFields)) ||
            !in_array(strtoupper($this->input->get('order', true)), ['ASC', 'DESC'])
        ) {

            $this->db->order_by($defaultOrderBy, $defaultOrder);

            // Just to return sorting info.
            $orderBy = $defaultOrderBy;
            $order = $defaultOrder;

        } else {

            $this->db->order_by($this->input->get('orderby', true), $this->input->get('order', true));

            // Just to return sorting info.
            $orderBy = $this->input->get('orderby', true);
            $order = $this->input->get('order', true);

        }

        // Handle pagination.
        if ($perPage) {
            if (empty($this->uri->segment(4))) {
                $offSet = 0;
            } else {
                // $offSet = ($offSet - 1) * $perPage.
                $offSet = ($this->uri->segment(4) - 1) * $perPage;
            }

            // Limit the number of rows in the result set.
            $this->db->limit($perPage, $offSet);
        }

        // Gather data of first query.
        $queryResult = $this->db->get('users_users');

        // Gather data of second query.
        $queryNumRows = $this->db->query('SELECT FOUND_ROWS() AS Count');

        // Validate & return data.
        if ($queryResult && $queryNumRows) {

            $data['result'] = $queryResult->result();
            $data['numRows'] = (int) $queryNumRows->row()->Count;
            $data['sortingInfo'] = (object) ['orderBy' => strtolower($orderBy), 'order' => strtolower($order)];

            return (object) $data;

        } else {
            return false;
        }
    }
} // Class end.
