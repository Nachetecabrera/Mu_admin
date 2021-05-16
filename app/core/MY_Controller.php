<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Core controller file
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




class MY_Controller extends CI_Controller
{
    public $systemSettings;

    public function __construct()
    {
        parent::__construct();

        // Set default app timezone.
        date_default_timezone_set($this->preferences->type('system')->item('app_timezone'));

        // Load stuff.
        $this->load->model('common/adminend/system/settings/system_settings_model');
        $this->load->model('modules/users/adminend/users/user_model');
        $this->load->model('modules/users/adminend/users/edit_user_model');

        // Assign system settings object.
        $this->systemSettings = $this->system_settings_model->settings();

        // Assign user session data object.
        if ($this->user->isSignin()) {
            $this->session->user = $this->user_model->user(['username'], $this->session->userID);
        } else {
            $this->session->unset_userdata('user'); // Remove specific session data.
        }

        // Update user last activity datetime.
        $this->edit_user_model->editUserData(['datetimeLastActivity' => date('Y-m-d H:i:s')], $this->session->userID);

        // Add Databases
        $this->db_game = $this->load->database('db_game', true);
        $this->db_char = $this->load->database('db_characters', true);
        
    }
} // Class end.
