<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Donation  extends BaseAdminController
{

    function __construct()
    {
        parent::__construct();
    }

    //Apointments
    function indexAppointments(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Appointments';

            $this->theme->title($this->data['page_title'])->load('donations/vw_appointments', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }


    public function edit_donation_form(){

        if(session_userdata('isAdminLoggedin')){
           
            $this->data['page_title']='Edit for Blood Donation';


            $this->theme->title($this->data['page_title'])->load('donations/vw_edit_donation_form_1', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }
    public function onSearchAppointments(){
        if(session_userdata('isAdminLoggedin')==TRUE && session_userdata('admin_id')){
            if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('first_name','mid_name','last_name','email','ph_no');
                $param['order'] = array('id' => 'ASC');
                $posts=$this->input->post();

                //$param['type_key']='blood_groups';

                $list = $this->dm->_get_appointments($posts,$param,FALSE,FALSE);

                // print_obj($list);die;
                
                $data = array();
                $no = isset($posts['start'])?$posts['start']:0;

                $action='';

                foreach ($list as $donar){
                    $no++;
//print_r($doner);die();
                     $row = array();

                    if(!empty($donar->mid_name)){
                        $donar_name=$donar->first_name.' '.$donar->mid_name.' '.$donar->last_name;
                    }else{
                        $donar_name=$donar->first_name.' '.$donar->last_name;
                    }

                    $row[]  =   $no;
                    $row[]  =   $donar_name;    
                    $row[]  =   $donar->email;
                    $row[]  =   $donar->ph_no;   
                    $row[]  =   date('d-m-Y',strtotime($donar->created_at));            
                    $row[]  =   '<button type="button" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></button>
                    <button type="button" class="btn btn-xs btn-dark btn_del_data" data-master_id=""><i class="fa fa-trash"></i></button>';

                    $data[] = $row; 
                }

                $output = array(
                    "draw" => isset($posts['draw'])?$posts['draw']:'',
                    "recordsTotal" => $this->dm->_get_appointments($posts,$param,TRUE),
                    "recordsFiltered" => $this->dm->_get_appointments($posts,$param,TRUE),
                    "data" => $data,
                );
                
                echo json_encode($output);

            }else{
                redirect($this->data['base_url']);
            }
        }else{
            redirect($this->data['base_url']);
        }
    }



  // public function update_donation_form(){

  //             $post=$this->input->post();

                
  //                   if($step=='step_1'){
  //                       if($added){
  //                           $return['step']='step_2';
  //                           $return['step_no']='2';
  //                           $return['step_back']='step_1';
  //                       }else{
  //                           $return['error']='Data not saved';
  //                       }

  //                   }else if($step=='step_2'){
  //                          if($added){
  //                               $return['step']='step_3';
  //                               $return['step_no']='3';
  //                               $return['step_back']='step_2';
  //                           }else{
  //                               $return['error']='Data not saved';
  //                           }
  //                   }else if($step=='step_3'){
  //                          if($added){
  //                               $return['step']='step_4';
  //                               $return['step_no']='4';
  //                               $return['step_back']='step_3';
  //                           }else{
  //                               $return['error']='Data not saved';
  //                           }
  //                   }else if($step=='step_4'){
  //                          if($added){
  //                               $return['step']='step_5';
  //                               $return['step_no']='5';
  //                               $return['step_back']='step_4';
  //                           }else{
  //                               $return['error']='Data not saved';
  //                           }
  //                   }else{
  //                               $return['error']='Data not saved';
  //                           }
                
  //               return json_headers($return); 
  //   }
}