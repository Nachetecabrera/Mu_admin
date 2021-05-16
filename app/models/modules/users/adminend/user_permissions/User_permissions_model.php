<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| User permissions model file
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




class User_permissions_model extends CI_Model
{
    /**
     * Get all user permissions.
     *
     * Support for single field sorting.
     * Support for multiple field searching.
     * Support for single field filtering.
     *
     * @param $selectFields Array.
     * @param $defaultOrderBy String.
     * @param $defaultOrder String.
     * @param $searchFields Array.
     * @param $filterFields Array.
     */
    public function userPermissions($selectFields, $defaultOrderBy, $defaultOrder, $searchFields = [], $filterFields = [])
    {
        $this->db->select(implode(',', $selectFields));

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

        $this->db->order_by($defaultOrderBy, $defaultOrder);

        // Gather data of first query.
        $queryResult = $this->db->get('users_permissions');

        // Gather data of second query.
        $queryNumRows = $this->db->query('SELECT FOUND_ROWS() AS Count');

        // Validate & return data.
        if ($queryResult && $queryNumRows) {

            $data['result'] = $queryResult->result();
            $data['numRows'] = (int) $queryNumRows->row()->Count;

            return (object) $data;

        } else {
            return false;
        }
    }
} // Class end.
