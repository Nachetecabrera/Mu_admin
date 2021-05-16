<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| User groups model file
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




class User_groups_model extends CI_Model
{
    /**
     * Get all user groups.
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
     */
    public function userGroups($selectFields, $defaultOrderBy, $defaultOrder, $perPage = false, $searchFields = [], $filterFields = [])
    {
        /**
         * Compiled sub queries.
         */

        // For aliased userGroupsWithRelationsTable.
        $this->db->select('users_user_groups.ID AS userGroupID, COUNT(groupID) AS userCount');
        $this->db->from('users_user_groups');
        $this->db->join('users_user_group_relations', 'users_user_group_relations.groupID = users_user_groups.ID', 'left');
        $this->db->group_by('users_user_groups.ID');

        $subQueryUserGroupsWithRelationsTable = $this->db->get_compiled_select();

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

        $this->db->join('(' . $subQueryUserGroupsWithRelationsTable . ') AS userGroupsWithRelationsTable', 'userGroupsWithRelationsTable.userGroupID = users_user_groups.ID', 'left');

        // Handle filtering.
        if (
            !empty($filterFields) &&
            !empty($this->input->get('filterby', true)) &&
            in_array(strtolower($this->input->get('filterby', true)), array_map('strtolower', $filterFields)) &&
            $this->input->get('filter', true) !== null
        ) {
            // Using 'LIKE' operator instead of '= (equals operator)' due to returning wrong results.
            // Homework: https://stackoverflow.com/questions/15715719/why-does-mysql-return-rows-that-seemingly-do-not-match-the-where-clause
            $this->db->like($this->input->get('filterby', true), $this->input->get('filter', true), 'none');
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
            if (empty($this->uri->segment(5))) {
                $offSet = 0;
            } else {
                // $offSet = ($offSet - 1) * $perPage.
                $offSet = ($this->uri->segment(5) - 1) * $perPage;
            }

            // Limit the number of rows in the result set.
            $this->db->limit($perPage, $offSet);
        }

        // Gather data of first query.
        $queryResult = $this->db->get('users_user_groups');

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
