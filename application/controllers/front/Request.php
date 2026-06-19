<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Request extends BaseFrontController
{

	public function indexRequest(){

		if(session_userdata('isUserLoggedin')){
            $userdata=$this->userdata;

            //print_obj($userdata);die;

            $this->data['page_title']='Request for Blood';



            $this->theme->title($this->data['page_title'])->load('Request/blood_request_form', $this->data);
        }else{
            redirect(base_url('signin'));
        }
    }

    public function blood_request_appointment(){

        if(session_userdata('isUserLoggedin')){
            $userdata=$this->userdata;

            //print_obj($userdata);die;

            $this->data['page_title']='Request for Blood';



            $this->theme->title($this->data['page_title'])->load('Request/blood_request_appointment', $this->data);
        }else{
            redirect(base_url('signin'));
        }
    }

    
    public function blood_appointment(){

        if(session_userdata('isUserLoggedin')){
            $userdata=$this->userdata;

            //print_obj($userdata);die;

            $this->data['page_title']='Request for Blood Appointment';



            $this->theme->title($this->data['page_title'])->load('Request/blood_request_appointment', $this->data);
        }else{
            redirect(base_url('signin'));
        }
    }
    public function blood_appointment_search(){

        // echo "hiii"; die;

        if(session_userdata('isAdminLoggedin')==TRUE && session_userdata('admin_id')){

            if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){
                $param['column_order'] = array(
                    null,
                    'first_name'
                );
              
                $param['column_search'] = array('');
                $param['order'] = array('id' => 'ASC');
                $posts=$this->input->post();

                $param['type_key']='blood_groups';

                $list = $this->dm->_get_blood_appointment($posts,$param,FALSE,FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start'])?$posts['start']:0;

                $action='';

                foreach ($list as $request){
                    $no++;
          //print_obj($donar);
       //echo $donar;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $request->id;
                    $row[]  =   $request->id;
                    $row[]  =   $request->id;   
                    // $row[]  =   date('d-m-Y',strtotime($donar->created_at));
                    $row[]  =   $request->id;
                    $row[]  =   $request->id;
                    $row[]  =   $request->id;

                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            

                 //    if($donar->donation_status == 'not donated'){
                 //     $checkin = '<a href="'.$this->data['base_url'].'/donations/check_in/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-check"></i></a> <a href="'.$this->data['base_url'].'/donations/donation_form/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>';
                 // }else{
                 //     $checkin ='<a href="'.$this->data['base_url'].'/donations/download/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>';
                 // }


                 //$row[]  = $checkin.'  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$donar->id.');" ><i class="fa fa-trash"></i></button>';

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

public function blood_appointment_delete(){
   // echo 'hiiii'; die;
  // alert('sdadassad'); die();
  $id=$this->input->post('id');

  $dataDelete = $this->db->query("DELETE FROM bl_blood_request WHERE id = '$id'");
     // echo $dataDelete; die;
  if ($dataDelete==true) {

      echo "1";

    }else{
    echo "2";
    }
  }
}