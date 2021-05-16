<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Add user tag model file
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




class Add_user_tag_model extends CI_Model
{
    /**
     * Add new user tag.
     *
     * @param $formData Array.
     */
    public function addUserTag($formData)
    {
        $this->db->set('tagName', $formData['userTagName']);
        $this->db->set('tagSlug', str_replace(' ', '-', $formData['userTagSlug']));
        $this->db->set('tagDescription', $formData['userTagDescription']);
        $this->db->set('state', $formData['state']);
        $this->db->set('datetimeCreated', date('Y-m-d H:i:s'));

        $this->db->insert('users_user_tags');

        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
} // Class end.
