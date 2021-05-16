<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Preferences library
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




class Preferences
{
    private $CI;
    private $preferencesType;



    public function __construct()
    {
        // Initialize CI super object.
        $this->CI =& get_instance();
    }



    /**
     * Set $preferencesType property.
     *
     * @param $preferencesType String.
     */
    public function type($preferencesType)
    {
        $this->preferencesType = strtolower($preferencesType);

        return $this;
    }



    /**
     * If database settingKey not set, then return corresponding config item.
     *
     * @param $preference String.
     */
    public function item($preference)
    {
        if ($this->preferencesType == 'system') {

            return (isset($this->CI->systemSettings->$preference) ? $this->CI->systemSettings->$preference : $this->CI->config->item($preference));

        } elseif ($this->preferencesType == 'user') {

            return (isset($this->CI->userSettings->$preference) ? $this->CI->userSettings->$preference : $this->CI->config->item($preference));

        } else {

            return false;

        }
    }
} // Class end.
