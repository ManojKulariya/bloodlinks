<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BloodBankLimitHook {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->load->library('session');
        $this->CI->load->helper('url');
    }

    public function check_limit()
    {
        $directory = strtolower($this->CI->router->fetch_directory()); // admin/
        $class     = strtolower($this->CI->router->fetch_class());     // payment
        $method    = strtolower($this->CI->router->fetch_method());
            // ✅ ALLOW logout & login (VERY IMPORTANT)
        if (($directory === 'admin/' && $class === 'accounts') || in_array($method, ['login', 'logout'])) {
            return;
        }
        if($directory === 'admin/' && $class === 'payment' && $method === 'payment_required') {
                return;
            }
        $admin_type = $this->CI->session->userdata('admin_type') ?? 45;
    
        // Skip for admin & auth pages
        $class = $this->CI->router->fetch_class();
        if ($admin_type != 5) {
            return;
        }

        $bloodbank_id = $this->CI->session->userdata('auth_id');
        
        if (!$bloodbank_id) return;
        
        $bank = $this->CI->db->where('user_id', $bloodbank_id)->get('blood_banks')->row();
       
        if (!$bank) return;

        if ($bank->used_requests > $bank->request_limit && $bank->payments_approved == 0) {
            
            redirect(base_url('admin/payment_required'));
            exit;
        }
    }
}
