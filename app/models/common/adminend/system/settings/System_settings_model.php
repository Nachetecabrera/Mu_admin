<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Common system settings model file
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




class System_settings_model extends CI_Model
{
    /**
     * Get settings.
     *
     * @param $moduleSlug String.
     */
    public function settings($moduleSlug = '')
    {
        $this->db->select('settingKey, settingValue, moduleSlug');

        if (!empty($moduleSlug)) {
            $this->db->where('moduleSlug', $moduleSlug);
        }

        $query = $this->db->get('system_settings');

        if ($query->result()) {

            $settings = $query->result();

            foreach ($settings as $setting) {
                $systemSettings[$setting->settingKey] = $setting->settingValue;
            }

            return (object) $systemSettings;

        } else {
            return false;
        }
    }



    /**
     * Replace settings.
     *
     * @param $rows Array.
     */
    public function replaceSettings($rows)
    {
        $loopCounter = 0;

        foreach ($rows as $row) {
            $this->db->replace('system_settings', $row);
            $loopCounter++;
        }

        if (count($rows) == $loopCounter) {
            return true;
        } else {
            return false;
        }
    }
} // Class end.
