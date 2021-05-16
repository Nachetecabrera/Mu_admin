<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Url library
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




class Url
{
    private $CI;



    public function __construct()
    {
        // Initialize CI super object.
        $this->CI =& get_instance();
    }



    /**
     * Return current URL.
     */
    public function currentUrl()
    {
        if (empty($_SERVER['QUERY_STRING'])) {
            return current_url();
        } else {
            return current_url() . '?' . $_SERVER['QUERY_STRING'];
        }
    }



    /**
     * Check whether GET['next'] set or not.
     *
     * @param $rootGetKey String.
     */
    public function isNextUrl($rootGetKey = 'next')
    {
        if ($this->CI->input->get($rootGetKey, true) !== null) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Return next URL.
     *
     * @param $rootGetKey String.
     */
    public function nextUrl($rootGetKey = 'next')
    {
        $getVars = $this->CI->input->get(null, true);
        $rootGetValue = $getVars[$rootGetKey];
        unset($getVars[$rootGetKey]);

        $uriString = $rootGetValue;
        foreach ($getVars as $getKey => $getValue) {
            $uriString .= '&' . $getKey . '=' . $getValue;
        }

        // Check if both base url and next url are under the same domain/host name. This is important for the security.
        $baseUrlHost = parse_url(base_url());
        $baseUrlHost = strtolower($baseUrlHost['host']);

        $nextUrlHost = parse_url($uriString);
        $nextUrlHost = strtolower($nextUrlHost['host']);

        if ($baseUrlHost == $nextUrlHost) {
            return $uriString;
        } else {
            return base_url();
        }
    }
} // Class end.
