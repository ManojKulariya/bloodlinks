<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Donation  extends BaseHospitalController
{

    function __construct()
    {
        parent::__construct();
         if(!session_userdata('isHospitalLoggedin')){
             redirect($this->data['base_url']);
        }

    }
     function indexbloodbank_user_role()
    {
     
        $this->data['page_title'] = 'Hospital User Role';
        $this->data['bloodbank_id'] = decode_data($this->session->userdata('admin_id'));

        $this->theme->title($this->data['page_title'])->load('donations/vw_bloodbank_user_role', $this->data);
        
    }
    function indexbloodbank_user()
    {

        $this->data['page_title'] = 'Hospital User';
        $this->data['bloodbank_id'] = decode_data($this->session->userdata('admin_id'));
        $this->theme->title($this->data['page_title'])->load('donations/vw_bloodbank_user', $this->data);
   
    }
    public function onSearchbloodbank_user()
    {

        // if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
            $param['column_order'] = array(
                null,
                'first_name'
            );

            $param['column_search'] = array('name', 'email', 'mobile', 'role');
            $param['order'] = array('id' => 'ASC');
            $posts = $this->input->post();
            $param['bank_id'] = decode_data($this->session->userdata('admin_id'));
            $param['type_key'] = 'blood_groups';

            $list = $this->dm->_get_hpuser($posts, $param, FALSE, FALSE);
            // print_obj($list);die;

            $data = array();
            $no = isset($posts['start']) ? $posts['start'] : 0;

            $action = '';
            $base_url = str_replace('/admin', '', $this->data['base_url']);
            foreach ($list as $bank_user) {
                $no++;
                $row = array();
                $row[]  =   $no;
                $row[]  =   $bank_user->name;
                $row[]  =   $bank_user->role;
                $row[]  =   $bank_user->email;
                $row[]  =   $bank_user->mobile;
                $row[]  =   '<img src="'.$base_url.'/' . $bank_user->sign . '" width="70px" height="70px" />';
                // $row[]  = '<a href="' . $this->data['base_url'] . '/donations/bloodbank_user/edit/' . $bank_user->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $bank_user->id . ');" ><i class="fa fa-trash"></i></button> ';
                $row[] = '--';
                $data[] = $row;
            }

            $output = array(
                "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                "recordsTotal" => $this->dm->_get_hpuser($posts, $param, TRUE),
                "recordsFiltered" => $this->dm->_get_hpuser($posts, $param, TRUE),
                "data" => $data,
            );

            echo json_encode($output);
        // } else {
        //     redirect($this->data['base_url']);
        // }
        
    }
    function bloodbank_user_add()
    {

        $this->data['page_title'] = 'Hospital User Add';
        $this->data['bank_id'] = decode_data($this->session->userdata('admin_id'));

        $this->theme->title($this->data['page_title'])->load('donations/vw_bloodbank_user_add', $this->data);
        
    }
    public function onSearchbloodbank_user_role()
    {

        if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
            $param['column_order'] = array(
                null,
                'first_name'
            );

            $param['column_search'] = array('master_type_key_value');
            $param['order'] = array('master_id' => 'ASC');
            $posts = $this->input->post();

            $param['type_key'] = 'blood_groups';
            $param['bank_id'] = decode_data($this->session->userdata('admin_id'));

            $list = $this->dm->_get_user_role_hp($posts, $param, FALSE, FALSE);

            $data = array();
            $no = isset($posts['start']) ? $posts['start'] : 0;

            $action = '';

            foreach ($list as $manufecture) {
                $no++;
                $row = array();
              
                $row[]  =   $no;
                $row[]  =   $manufecture->master_type_key_value;

                // $row[]  = '<a href="' . $this->data['base_url'] . '/donations/bloodbank_user_role/edit/' . $manufecture->master_id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $manufecture->master_id . ');" ><i class="fa fa-trash"></i></button> ';
                $row[]  =  '--';
                $data[] = $row;
            }

            $output = array(
                "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                "recordsTotal" => $this->dm->_get_user_role_hp($posts, $param, TRUE),
                "recordsFiltered" => $this->dm->_get_user_role_hp($posts, $param, TRUE),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect($this->data['base_url']);
        }
       
    }
}