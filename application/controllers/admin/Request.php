<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request  extends BaseAdminController
{

    function __construct()
    {
        parent::__construct();
    }

 //Blood Request Apointments
    function blood_appointment(){


        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Blood Request Appointments';

            $this->theme->title($this->data['page_title'])->load('Request/vw_blood_appointments', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }

//Blood Request Form
    function request_form(){


        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Blood Request Form';

            $this->theme->title($this->data['page_title'])->load('Request/vw_request_form', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }
    //Blood Request Form Add
    function request_form_add(){


        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Blood Request Form Add';

            $this->theme->title($this->data['page_title'])->load('Request/vw_request_form_add', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }
    
} 
?>