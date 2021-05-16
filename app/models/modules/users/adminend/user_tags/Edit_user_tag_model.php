<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Edit user tag model file
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




class Edit_user_tag_model extends CI_Model
{
    /**
     * Edit user tag.
     *
     * @param $formData Array.
     */
    public function editUserTag($formData)
    {
        $this->db->set('tagName', $formData['userTagName']);
        $this->db->set('tagSlug', str_replace(' ', '-', $formData['userTagSlug']));
        $this->db->set('tagDescription', $formData['userTagDescription']);
        $this->db->set('state', $formData['state']);
        $this->db->set('datetimeUpdated', date('Y-m-d H:i:s'));
        $this->db->where('ID', $this->uri->segment(5));

        $this->db->update('users_user_tags');

        if ($this->db->affected_rows() == 1 || $this->db->affected_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }
} // Class end.
