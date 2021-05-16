<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| CRUD library
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




/**
 * Homework.
 *
 * https://ux.stackexchange.com/questions/28730/sorting-on-a-multipage-list-should-it-send-you-to-the-first-page
 */

class Crud
{
    private $CI;



    public function __construct()
    {
        // Initialize CI super object.
        $this->CI =& get_instance();
    }



    /**
     * Create CRUD index sorting icons.
     *
     * @param $sortingField String.
     * @param $currentSortingField String.
     * @param $currentSortingOrder String.
     */
    public function sortingIcon($sortingField, $currentSortingField, $currentSortingOrder)
    {
        if (strtolower($sortingField) == $currentSortingField) {
            if ($currentSortingOrder == 'asc') {
                $sortingIcon = '<i class="fas fa-sort-up" title="Ascending order"></i>';
            } else {
                $sortingIcon = '<i class="fas fa-sort-down" title="Descending order"></i>';
            }
        } else {
            $sortingIcon = '<i class="fas fa-sort" title="Mixed order"></i>';
        }

        return $sortingIcon;
    }



    /**
     * Create CRUD index sorting links.
     *
     * @param $sortingField String.
     * @param $sortingOrder String.
     * @param $currentSortingField String.
     * @param $currentSortingOrder String.
     */
    public function sortingLink($sortingField, $sortingOrder, $currentSortingField, $currentSortingOrder)
    {
        $queryString = $this->CI->input->server('QUERY_STRING', true);

        // Parses the query string into an associative array.
        parse_str($queryString, $queryStringArray);

        // Remove "orderby" and "order" keys from the associative array.
        unset($queryStringArray['orderby']);
        unset($queryStringArray['order']);

        // Add "orderby" key to the associative array.
        $queryStringArray['orderby'] = $sortingField;

        // Add "order" key to the associative array.
        if (strtolower($sortingField) == $currentSortingField) {
            if ($currentSortingOrder == 'asc') {
                $queryStringArray['order'] = 'DESC';
            } else {
                $queryStringArray['order'] = 'ASC';
            }
        } else {
            $queryStringArray['order'] = $sortingOrder;
        }

        // Generate query string from the associative array.
        $queryString = '?' . http_build_query($queryStringArray);

        return site_url(uri_string()) . $queryString;
    }



    /**
     * Generate few difference variants of the same array.
     *
     * @param $fields Array.
     * @param $typeOfArray String.
     *
     * Check bellow examples.
     * ----------------------
     * Passed array.
     * array(3) { [0]=> string(8) "field_01" [1]=> string(8) "field_02" [2]=> array(1) { ["alias"]=> string(17) "COUNT(some_field)" } }
     *
     * Returning 'fieldsAssoc' array.
     * array(3) { ["field_01"]=> string(0) "" ["field_02"]=> string(0) "" ["alias"]=> string(17) "COUNT(some_field)" }
     *
     * Returning 'fieldsPlusOnlyAliases' array.
     * array(3) { [0]=> string(8) "field_01" [1]=> string(8) "field_02" [2]=> string(5) "alias" }
     *
     * Returning 'fieldsPlusOnlyFields' array.
     * array(3) { [0]=> string(8) "field_01" [1]=> string(8) "field_02" [2]=> string(17) "COUNT(some_field)" }
     *
     * Returning 'fieldsPlusFieldsWithAliases' array.
     * array(3) { [0]=> string(8) "field_01" [1]=> string(8) "field_02" [2]=> string(26) "COUNT(some_field) AS alias" }
     */
    public function generateFieldsArrays($fields, $typeOfArray)
    {
        if (!empty($fields)) {

            foreach ($fields as $key => $value) {

                if (!is_array($value)) {

                    $fieldsAssoc[$value] = '';
                    $fieldsPlusOnlyAliases[] = $value;
                    $fieldsPlusOnlyFields[] = $value;
                    $fieldsPlusFieldsWithAliases[] = $value;

                } else {

                    foreach ($value as $key => $value) {

                        $fieldsAssoc[$key] = $value;
                        $fieldsPlusOnlyAliases[] = $key;
                        $fieldsPlusOnlyFields[] = $value;
                        $fieldsPlusFieldsWithAliases[] = $value . ' AS ' . $key;

                    }

                }

            }

            switch ($typeOfArray) {
                case 'fieldsAssoc':
                    return $fieldsAssoc;
                    break;

                case 'fieldsPlusOnlyAliases':
                    return $fieldsPlusOnlyAliases;
                    break;

                case 'fieldsPlusOnlyFields':
                    return $fieldsPlusOnlyFields;
                    break;

                case 'fieldsPlusFieldsWithAliases':
                    return $fieldsPlusFieldsWithAliases;
                    break;
            }

        } else {

            return [];

        }
    }
} // Class end.
