<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * 
 */
class Accounts  extends BaseHospitalController
{
    function __construct()
    {
        parent::__construct();
    }
    function edit_profile()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit Profile';

            $this->theme->title($this->data['page_title'])->load('accounts/vw_bloodbank_user_edit', $this->data);
        } else {

            redirect($this->data['base_url'] . '/dashboard');
        }
    }
    function index()
    {

        if (!session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Login';

            $this->theme->title($this->data['page_title'])->load('accounts/vw_login', $this->data);
        } else {

            redirect($this->data['base_url'] . '/dashboard');
        }
    }


    public function onLogin()
    {
        if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

            $username       =   post_data('username');
            $password       =   post_data('password');

            $userdata       =   $this->um->_get_user(array('email' => $username));

            if ($userdata != '' && ($userdata->user_status == 'active')) {

                if (password_verify($password, $userdata->password)) {

                    if ($userdata->role_id == '5') {
                        # code...

                        $bank = $this->db->query("SELECT * FROM bl_blood_banks WHERE user_id = '$userdata->id'");

                        foreach ($bank->result() as $value) {
                            # code...
                            $bank_id = $value->blood_bank_id;
                            $_SESSION['bank_id'] =  $bank_id;
                            break;
                        }
                    }

                    if ($userdata->role_id == '0') {
                        # code...

                        $bank = $this->db->query("SELECT * FROM bl_bloodbank_user WHERE user_id = '$userdata->id'");

                        foreach ($bank->result() as $user) {
                            # code...
                            $bloodbank_user_id = $user->id;
                            $_SESSION['bloodbank_user_id'] =  $bloodbank_user_id;
                            $bank_id = $user->bloodbank_id;
                            $_SESSION['bank_id'] =  $bank_id;
                            $bloodbank_user_name = $user->name;
                            $_SESSION['bloodbank_user_name'] =  $bloodbank_user_name;
                            $bloodbank_user_servies = $user->servies;
                            $_SESSION['bloodbank_user_servies'] =  $bloodbank_user_servies;
                            $bloodbank_user_servies_permission = $user->servies_permission;
                            $_SESSION['bloodbank_user_servies_permission'] =  $bloodbank_user_servies_permission;
                            break;
                        }
                    }


                    $session_data = array(
                        'isAdminLoggedin' => true,
                        'admin_id' => encode_data($userdata->id),
                        'auth_id' => $userdata->id,
                        'admin_type' => $userdata->role_id,
                        'loggedin_time' => time()
                    );

                    session_set_userdata($session_data);

                    $return['redirect'] = $this->data['base_url'] . '/dashboard';
                    $return['success'] = 'Loggedin successfully';
                } else {
                    $return['error'] = 'Credentials are invalid';
                    $return['hash'] = $this->security->get_csrf_hash();
                }
            } else if ($userdata != '' && ($userdata->user_status == 'inactive')) {
                $return['error'] = 'Your id is deactivated.';
            } else {
                $return['redirect'] = $this->data['base_url'] . '/dashboard';
                $return['error'] = 'Credentials are invalid';
            }

            json_headers($return);
        } else {
            redirect($this->data['base_url']);
        }
    }


    public function onLogout()
    {
        if (session_userdata('admin_id') && session_userdata('isHospitalLoggedin') == TRUE) {
            $this->session->sess_destroy();
            redirect($this->data['base_url']);
        } else {
            redirect($this->data['base_url']);
        }
    }
}
