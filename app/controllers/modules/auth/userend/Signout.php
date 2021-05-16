<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Signout controller file
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




class Signout extends MY_Controller
{
    /**
     * User signout.
     */
    public function index()
    {   
        if (!$this->user->isSignin()) {
            
            redirect('auth');

        } else {

            if (empty($this->input->post(null, true))) {

                $data['title'] = 'Sign out';

                $this->load->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/modules/auth/userend/signout/signout', $data);

            } else {

                $this->user->signout();
                $this->session->set_flashdata('signoutSuccess', true);
                redirect('auth');

            }
            
        }
    }
} // Class end.
