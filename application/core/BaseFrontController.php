<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class BaseFrontController extends CI_Controller
{
    public $data=array();
    public $permission = array();
    public $login_session_duration = 5;
    public $current_url='';
    public $userdata=array();

    function __construct(){
        
        parent::__construct();

        $this->theme->view_type='front';

        $this->theme->initialize(array(
            'theme'            => 'default',
            'master'           => 'default',
            'layout'           => 'default',
            'title_sep'        => '-',
            'compress'         => (ENVIRONMENT !== 'development')?false:false,
            'cache_lifetime'   => 0,
            'cdn_enabled'      => true,
            'cdn_server'       => false,
            'site_name'        => 'Blood Link',
            'site_description' => 'Blood Link',
            'site_keywords'    => 'Blood Link'
        ));

        $this->data=array(
          'csrf'=>array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
          )
        );

        $this->data['system_name']='Blood Link';
        $this->data['system_title']='Blood Link';

        $this->data['logo_image']=base_url('uploads/app/logo.png');
        $this->data['favicon_image']=base_url('uploads/app/fav.ico');
        $this->data['loader_image']=base_url('uploads/app/loader.gif');

        if(session_userdata('isUserLoggedin')==TRUE && session_userdata('user_id')){
            $user_id=decode_data(session_userdata('user_id'));
            $user_type=session_userdata('user_type');

            $userdata=$this->um->get_user(array('users.id'=>$user_id),$user_type);

            $this->userdata=$userdata;

            //print_obj($this->userdata);die;
        }

        $this->theme->theme('default',$this->data)->add_partial('partial_header',$this->data)->add_partial('partial_footer',$this->data);
    }
    // In your BaseController or wherever you define it
    public function generate_captcha() {
        $this->load->helper('captcha');
        
        $captcha_config = array(
            'word' => rand(1000, 9999), // Generates a random 4-digit number
            'img_path' => './captcha/', // Make sure this folder exists and is writable
            'img_url' => base_url('captcha/'), // URL to access the CAPTCHA images
            'font_path' => './path/to/font.ttf', // Optional: path to a custom font
            'img_width' => 150,
            'img_height' => 50,
            'expiration' => 7200 // 2 hours
        );
    
        $captcha = create_captcha($captcha_config);
        if ($captcha) {
            return $captcha; // Return the full CAPTCHA array
        }
        return false; // Return false if CAPTCHA generation fails
    }

}