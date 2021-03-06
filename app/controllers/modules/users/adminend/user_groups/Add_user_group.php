<?php
defined('BASEPATH') OR exit('No direct script access allowed');




/*!
|--------------------------------------------------------------------------
| Add user group controller file
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




class Add_user_group extends MY_Controller
{
    /**
     * Add new user group.
     */
    public function index()
    {
        if (!$this->user->isSignin()) {

            redirect('auth' . '?next=' . $this->url->currentUrl());

        } elseif (!$this->user->isEmailVerification()) {

            redirect('admin/user/settings/email' . '?next=' . $this->url->currentUrl());

        } elseif (!$this->user->hasPermission('users_viewCreateUserGroup')) {

            $this->output->set_status_header(401);

            $data['title'] = 'Access denied';

            $this->load->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/errors/access_denied', $data);

        } else {

            $this->load->library('form_validation');

            $this->form_validation->set_error_delimiters('<li class="mb-1">', '</li>');

            $this->form_validation->set_rules('userGroupName', 'User group name', 'trim|htmlspecialchars|required|regex_match[/^[^,]+$/]', ['regex_match' => 'These characters are not allowed: ,']);
            $this->form_validation->set_rules('userGroupSlug', 'User group slug', 'trim|htmlspecialchars|required|is_unique[users_user_groups.groupSlug]', ['is_unique' => 'This user group slug is already in use. please choose another one.']);
            $this->form_validation->set_rules('userGroupDescription', 'User group description', 'trim|htmlspecialchars');
            $this->form_validation->set_rules('state', 'State', 'trim|htmlspecialchars|required|in_list[active,inactive]');

            // Custom error messages for specific validation rules.
            $this->form_validation->set_message('required', '{field} is required.');
            $this->form_validation->set_message('in_list', '{field} must be one of: {param}.');

            if ($this->form_validation->run() == false) {

                $data['title'] = 'Add user group';

                $this->load->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/modules/users/adminend/user_groups/add_user_group/add_user_group', $data);

            } else {

                if (!$this->user->hasPermission('users_createUserGroups')) {

                    $this->output->set_status_header(401);

                    $data['title'] = 'Access denied';

                    $this->load->view($this->preferences->type('system')->item('app_themesDir') . '/' . $this->preferences->type('system')->item('app_themeDir') . '/common/adminend/errors/access_denied', $data);

                } else {

                    $this->load->model('modules/users/adminend/user_groups/add_user_group_model');
                    $insertID = $this->add_user_group_model->addUserGroup($this->input->post(null, true));

                    if (!$insertID) {
                        $this->session->set_flashdata('addUserGroupSuccess', false);
                    } else {
                        $this->session->set_flashdata('addUserGroupSuccess', true);
                        $this->session->set_flashdata('insertID', $insertID);
                    }

                    redirect(current_url());

                }

            }

        }
    }
} // Class end.
