<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends BaseFrontController {
//Blood Banks

    function appointments(){
        $this->data['page_title']='Schedule Appointment';
           $this->theme->title($this->data['page_title'])->load('file/schedule-appointment', $this->data);
    
    }
    public function appointmen()
    {
        // $this->load->library('pagination');
        // $config['base_url']= base_url('file/schedule-appointment');
        // $config['per_page']= 10;
        // $config['total_rows']= $this->User_model->getTotalRows();
        // $data['blood'] = $this->User_model->getStudentsData();
        // $this->load->view('file/schedule-appointment', $data);
       
                 $param['column_order'] = array(
                     null,
                     'name',
                     'city',
                     'state_name'
                 );

                 $param['column_search'] = array('name','city','state_name');
                 $param['order'] = array('id' => 'ASC');
                 $posts=$this->input->post();
 // $list = array();

                 //$param['created_by']=session_userdata('admin_id');


                 $list = $this->um->_get_blood_banks($posts,$param,FALSE,FALSE);
                 // print_r($list); die;
                 //$data = json_decode($list['value']);
               

                     //print_r($data); die;

                 foreach($list as $key => $value){
                    $nad[] = $value->name;
                    //$nad[] = $value->city_name;
                 }
                 // print_r($nad);

                  // die;

                 // $data2 =[
                 //    'list1'=>$data->name,
                 //    'list2'=>$data->city_name
                 // ];
                 // print_r($data);die;
                 // foreach ($list as $key => $value) {
                 //     echo $value[$key]->blood_bank_id;
                 // }

                 // die;
                     // print_r($list['value']);die;
                  $this->load->view('file/schedule-appointment',$nad);
                       // $this->theme->title($this->data['page_title'])->load('file/schedule-appointment', $list);
         // $this->theme->title($this->data['page_title'])->load('file/schedule-appointment', $this->data);
    }
       

}
?>
