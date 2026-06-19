<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database', 'email', 'session','calendar','theme','encryption'=>'enc','user_agent' => 'ua','uploader','tokens','widget','form_validation');


$autoload['drivers'] = array();


$autoload['helper'] = array('auth','sms_helper','url','security','session_helper','email','xml','captcha','utility_helper','date_helper','string_helper','curl_helper','format_helper','utf8_helper','file_helper','paytm_helper');

$autoload['config'] = array();


$autoload['language'] = array();


$autoload['model'] = array('user_model'=>'um','settings_model'=>'sm','donation_model'=>'dm','DonarRegister'=>'dr','AdminDonarRegister'=>'adr');
