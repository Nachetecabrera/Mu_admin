<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Paginator library
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




class Paginator
{
    private $CI;



    public function __construct()
    {
        // Initialize CI super object.
        $this->CI =& get_instance();

        $this->CI->config->load('pagination');
        $this->CI->load->library('pagination');
    }



    /**
     * Create pagination.
     *
     * @param $firstUrl String.
     * @param $baseUrl String.
     * @param $totalRows Integer.
     * @param $uriSegment Integer.
     */
    public function pagination($firstUrl, $baseUrl, $totalRows, $uriSegment)
    {
        $config['suffix'] = $this->CI->config->item('url_suffix');
        $config['first_url'] = $firstUrl;
        $config['base_url'] = $baseUrl;
        $config['total_rows'] = $totalRows;
        $config['per_page'] = $this->CI->config->item('per_page');
        $config['uri_segment'] = $uriSegment;

        $this->CI->pagination->initialize($config);

        return $this->CI->pagination->create_links();
    }



    /**
     * Create pagination meta information.
     *
     * @param $totalRows Integer.
     */
    public function paginationInfo($totalRows)
    {
        $currentPage = ($this->CI->pagination->cur_page === 0 ? 1 : $this->CI->pagination->cur_page);

        $pageStartRow = (($currentPage - 1) * $this->CI->pagination->per_page) + 1;
        $pageEndRow = $currentPage * $this->CI->pagination->per_page;

        if ($pageEndRow > $totalRows) {
            $pageEndRow = $totalRows;
        }

        $totalPages = (int) ceil($totalRows / $this->CI->config->item('per_page'));

        return (object) [
            'pageStartRow' => $pageStartRow,
            'pageEndRow' => $pageEndRow,
            'totalRows' => $totalRows,
            'totalPages' => $totalPages
        ];
    }
} // Class end.
