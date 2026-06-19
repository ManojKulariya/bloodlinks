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
        $this->data['page_title']='BMW Login';

		$this->theme->title($this->data['page_title'])->load('account/vw_bmw_login', $this->data);
    }
    public function otp_hospital(){
       $otp = 1234;
       $cust_phone = $_POST['cust_phone'];
       $sql = "SELECT * FROM bl_users WHERE phone = '$cust_phone' AND role_id=8 ";
       $user = $this->db->query($sql)->result_array();
       if(count($user) == 0){
            $this->session->set_flashdata('error', 'BMW account not found!');
            redirect(site_url('bmw'));
            return;
       }
    //   var_dump($user);
        $insert = $this->db->query("INSERT INTO authentication (mobile , otp , expired) VALUES ('$cust_phone','$otp','0')");
        $this->data['page_title']='verify otp';
        $this->data['phone']= $cust_phone;
        $this->theme->title($this->data['page_title'])->load('account/bmw_otpverification', $this->data);
	
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
            $this->theme->title($this->data['page_title'])->load('account/bmw_otpverification', $this->data);
                return; 
        }
    
        // OTP matched → delete record
        $this->db->query("Delete FROM authentication WHERE mobile = '$phone'");
        // var_dump($auth);
        // Fetch customer
        $customer = $this->db->where('mobile', $phone)->get('bl_bmw_users')->row();
        // var_dump($customer);
        if (!$customer) {   
            $this->session->set_flashdata('error', 'Customer not found!');
            redirect('bmw');
            return;
        }
    
        // Create session
        $session_data = [
            'isBMWLoggedin' => true,
            'user_id'       => encode_data($customer->user_id),
            'customer_id'   => $customer->user_id,
            'form_id'       => uniqid(),
            'admin_id'=>encode_data($customer->id),
            'user_type'     => '8',
            'admin_type'    => '8',
            'name'        =>$customer->name,
            // 'reg_no'          =>$customer->lic_no,
            'loggedin_time' => time()
        ];
    
        $this->session->set_userdata($session_data);
    
        redirect('bmw/dashboard');
    }

}
