<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends BaseFrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }
    public function loginpage(){
        $this->data['page_title']='Hospital Login';

		$this->theme->title($this->data['page_title'])->load('account/vw_hp_login', $this->data);
    }
    public function otp_hospital(){
       $otp = 1234;
       $cust_phone = $_POST['cust_phone'];
       $sql = "SELECT * FROM bl_users WHERE phone = '$cust_phone' AND role_id IN (7,9) ";
       $user = $this->db->query($sql)->result_array();
       if(count($user) == 0){
            $this->session->set_flashdata('error', 'account not found!');
            redirect(site_url('hospital'));
            return;
       }
    //   var_dump($user);
        $insert = $this->db->query("INSERT INTO authentication (mobile , otp , expired) VALUES ('$cust_phone','$otp','0')");
        $this->data['page_title']='verify otp';
        $this->data['phone']= $cust_phone;
        $this->theme->title($this->data['page_title'])->load('account/hp_otpverification', $this->data);
	
    }
    public function verify_otp()
    {
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    
        $phone = $this->input->post('phone', true);
        $input_otp = $this->input->post('otp', true);
    
        // Fetch OTP from DB
        $sql = $this->db->query("SELECT * FROM authentication WHERE mobile = '$phone'");
        $auth = $sql->row();
    
        if (!$auth) {
            $this->session->set_flashdata('error', 'OTP not found. Please request a new one.');
            redirect('hospital');
            return;
        }
    
        if ($auth->otp != $input_otp) {
            // Wrong OTP → delete record and return error
            $this->session->set_flashdata('error', 'Invalid OTP! Please try again.');
            $this->data['page_title']='verify otp';
            $this->data['phone']= $phone;
            $this->theme->title($this->data['page_title'])->load('account/hp_otpverification', $this->data);
                return; 
        }
       
        // OTP matched → delete record
        $this->db->query("Delete FROM authentication WHERE mobile = '$phone'");
        
        
        $user_role = $this->db->where('phone', $phone)->get('bl_users')->row();
        if($user_role->role_id == 7){
            // Fetch customer
            $customer = $this->db->where('contact_ph_no', $phone)->get('hospital_onboard')->row();
            // var_dump($customer);
            if (!$customer) {   
                $this->session->set_flashdata('error', 'Customer not found!');
                redirect('hospital');
                return;
            }
        
            // Create session
            $session_data = [
                'isHospitalLoggedin' => true,
                'auth_id'       => $user_role->id,
                'user_id'       => encode_data($customer->user_id),
                'customer_id'   => $customer->user_id,
                'form_id'       => uniqid(),
                'admin_id'=>encode_data($customer->id),
                'user_type'     => '7',
                'admin_type'    => '7',
                'name'        =>$customer->name,
                'reg_no'          =>$customer->lic_no,
                'loggedin_time' => time()
            ];
        }
        if($user_role->role_id == 9){
            
            // Fetch customer
            $customer = $this->db->where('mobile', $phone)->get('bl_hospital_user')->row();
            // var_dump($customer);
            if (!$customer) {   
                $this->session->set_flashdata('error', 'Customer not found!');
                redirect('hospital');
                return;
            }
            $customerhp = $this->db->where('id', $customer->hospital_id)->get('hospital_onboard')->row();
            $services = json_decode($customer->servies, true);
            $permissions = json_decode($customer->servies_permission, true);
            // Create session
            $session_data = [
               
                'isHospitalLoggedin' => true,
                'auth_id'       => $user_role->id,
                'hospital_id'   => $customerhp->user_id,
                'user_id'       => encode_data($customer->user_id),
                'customer_id'   => $customerhp->user_id,
                'form_id'       => uniqid(),
                'admin_id'      => encode_data($customer->id),
                'user_type'     => '9',
                'admin_type'    => '9',
                'name'          =>$customerhp->name,
                'reg_no'        =>$customerhp->lic_no,
                'loggedin_time' => time(),
                'services' =>   $services,
                'permissions'=> $permissions
            ];
        }
    
        $this->session->set_userdata($session_data);
    
        redirect('hospital/dashboard');
    }

    public function add_hospital()
    {
        $this->data['page_title'] = 'Add Hospital';

        // Generate captcha
        $captcha = $this->generate_captcha();
        $this->data['captcha_image'] = $captcha['image'];
        $this->data['captcha_word']  = $captcha['word'];

        // Load view
        $this->theme->title($this->data['page_title'])->load('donation/vw_add_hospital', $this->data);
    }

    public function add_hospital_reg()
    {
        
        $org_ph_no  = $this->input->post('org_ph_no', true);
        $sql = "SELECT * FROM bl_users WHERE phone = '$org_ph_no' ";
        $user = $this->db->query($sql)->result_array();
        if(count($user) != 0){
            $this->session->set_flashdata('error', 'Mobile no already exists!');
            redirect(site_url('add_hospital'));
            return;
        }
        if ($this->input->post('captcha') !== $this->input->post('captcha_word')) {
           
            $this->session->set_flashdata('error', 'Incorrect CAPTCHA. Please try again.');
            redirect(site_url('add_hospital'));
            return;
        }
       
        // Collect input safely
        $org_name        = $this->input->post('org_name', true);
        $org_short_name  = $this->input->post('org_short_name', true);
        $org_email       = $this->input->post('org_email', true);
        
        $org_help_line_no= $this->input->post('org_help_line_no', true);
        $org_category    = $this->input->post('org_category', true);
        $website         = $this->input->post('website', true);
        $blood_center    = $this->input->post('blood_center', true);
        $org_districs    = $this->input->post('cust_districts', true);
        $org_state       = $this->input->post('cust_states', true);
        $org_city        = $this->input->post('cust_cities', true);
        $org_pincode     = $this->input->post('org_pincode', true);
        $org_address1    = $this->input->post('org_address1', true);
        $org_lic_no      = $this->input->post('org_lic_no', true);
        $org_lic_valid_from = date('Y-m-d', strtotime($this->input->post('org_lic_valid_from', true)));
        $org_lic_valid_to   = date('Y-m-d', strtotime($this->input->post('org_lic_valid_to', true)));
        $latitude       = $this->input->post('latitude', true);
        $longitude      = $this->input->post('longitude', true);

        // Start DB Transaction (safer)
        $this->db->trans_start();

        // Insert into bl_users
        $this->db->insert('bl_users', [
            'role_id'       => 7,
            'email'         => $org_email,
            'phone'         => $org_ph_no,
            'password'      => '', 
            'user_status'   => 'active',
            'user_verified' => 'yes',
        ]);

        $last_id = $this->db->insert_id();

        // Insert into bl_blood_banks
        $this->db->insert('bl_hospital_onboard', [
            'user_id'        => $last_id,
            'name'           => $org_name,
            'short_name'     => $org_short_name,
            'website'        => $website,
            'latitude'       => $latitude,
            'longitude'      => $longitude,
            'state_id'       => $org_state,
            'city_id'        => $org_city,
            'district_id'    => $org_districs,
            'pincode'        => $org_pincode,
            'address_1'      => $org_address1,
            'category_id'    => $org_category,
            'contact_email'  => $org_email,
            'contact_ph_no'  => $org_ph_no,
            'lic_no'         => $org_lic_no,
            'lic_valid_from' => $org_lic_valid_from,
            'lic_valid_to'   => $org_lic_valid_to,
        ]);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Failed to register hospital. Try again.');
            redirect('register/add_hospital');
        } else {
            $this->session->set_flashdata('success', 'Hospital registered successfully!');
            redirect('register/add_hospital');
        }
    }
}
