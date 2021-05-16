<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| User tag relations model file
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




class User_tag_relations_model extends CI_Model
{
    /**
     * Assign user tags.
     *
     * @param $tags Array.
     * @param $identifier String|Integer.
     */
    public function assignUserTags($tags, $identifier)
    {
        foreach ($tags as $tag) {
            $rows[] = ['tagID' => $tag, 'userID' => $identifier];
        }

        $this->db->insert_batch('users_user_tag_relations', $rows);

        if ($this->db->affected_rows() == count($tags)) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * De-assign user tags.
     *
     * @param $identifier String|Integer.
     */
    public function deAssignUserTags($identifier)
    {
        $this->db->where('userID', $identifier);
        $this->db->delete('users_user_tag_relations');

        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }
} // Class end.
