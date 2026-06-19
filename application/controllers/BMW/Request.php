<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends BaseBMWController {

    function __construct()
    {
        parent::__construct();
         if(!session_userdata('isBMWLoggedin')){
             redirect($this->data['base_url']);
        }

    }
    function handover_to_bmw_overview() 
    {
        $this->data['page_title'] = 'Request';
        $this->data['bredcrumbs'] = array(
            'Dashboard' => $this->data['base_url'],
            'Blood Group' => '',
        );
        $this->theme->title($this->data['page_title'])->load('dashboards/vw_hp_stock_overview', $this->data);
       
    }
    public function hp_stock_over_view_search()
    {
        // if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
            $param['column_order'] = array(
                null,
                'p_name',
                'mobile',
                'component',
                'hospital',
                'hospital',
            );
            $param['column_search'] = array('p_name', 'mobile', 'component', 'hospital', 'hospital');
            $param['order'] = array('id' => 'ASC');
            $posts = $this->input->post();
            $posts['status'] = 'BMW';
            $posts['bmw_id'] = decode_data(session_userdata('admin_id'));
            $txt = '';
            $list = $this->um->_get_hp_blood_stock_overview_bmw($posts, $param, FALSE, FALSE);
            $data = array();
            $no = isset($posts['start']) ? $posts['start'] : 0;
            $comp = $this->db->query("SELECT * FROM bl_masters WHERE master_type_key = 'component_types'")->result();
            // print_r($comp);die();
            foreach ($list as $lab) {
                $txt = 'WB';
                if($lab->hp_id != null){
                    $rec = json_decode($lab->stock_data);
                    foreach ($comp as $c) {
                        if ($c->master_id == $rec[0]->component) {
                            $txt = $c->master_type_key_short_value; // or master_type_key_value if you want full name
                            break;
                        }
                    }
                }else{
                    if($lab->cros_id !== null){
                       $rec = json_decode($lab->stock_data);
                        foreach ($comp as $c) {
                            if ($c->master_id == $rec[0]->component) {
                                $txt = $c->master_type_key_short_value; // or master_type_key_value if you want full name
                                break;
                            }
                        } 
                    }
                    if($lab->blood_record_id !== null){
                       $rec = json_decode($lab->stock_data);
                        foreach ($comp as $c) {
                            if ($c->master_id == $rec[0]->component) {
                                $txt = $c->master_type_key_short_value; // or master_type_key_value if you want full name
                                break;
                            }
                        } 
                    }
                    if($lab->donatioform_id !== null){
                    //   $rec = json_decode($lab->stock_data);
                    //     foreach ($comp as $c) {
                    //         if ($c->master_id == $rec[0]->component) {
                    //             $txt = $c->master_type_key_short_value; // or master_type_key_value if you want full name
                    //             break;
                    //         }
                    //     } 
                    }
                }
                
                $no++;
                $row = array();
                $row[] = $lab->id;
                // $row[] = $lab->a_name;
                $row[] = $lab->hospital_name ? $lab->hospital_name : $lab->bloodbank_name;

                $row[] = $lab->discard_no;
                $row[] = $txt;
                $row[] = $rec[0]->blood_group; // Fixed typo here
                $row[] = $rec[0]->unit_no; // Fixed typo here
                $row[] = $lab->created_at; // Fixed typo here
                $row[] = $lab->bmw_status; // Fixed typo here
                $row[] = $lab->dispose;
                $data[] = $row;
            }
            $output = array(
                "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                "recordsTotal" => $this->um->_get_hp_blood_stock_overview_bmw($posts, $param, TRUE),
                "recordsFiltered" => $this->um->_get_hp_blood_stock_overview_bmw($posts, $param, TRUE),
                "data" => $data,
            );
            echo json_encode($output);
        // } else {
        //     redirect($this->data['base_url']);
        // }
    }
    public function update_bmw_status() {
        $id = $this->input->post('id');
        $status = $this->input->post('bmw_status');
    
        $this->db->where('id', $id);
        $update = $this->db->update('bl_stock_handover', ['bmw_status' => $status]);
    
        if($update){
            echo json_encode(['status'=>1,'msg'=>'Updated successfully']);
        } else {
            echo json_encode(['status'=>0,'msg'=>'Update failed']);
        }
    }
    public function update_bmw_req($id,$status) {
       
        $status = str_replace('_', ' ', $status);
        $this->db->where('id', $id);
        $update = $this->db->update('bl_stock_handover', ['bmw_status' => $status]);
    
        
        redirect($this->data['base_url'] . '/stock_hospital');
    }
    public function update_bmw_req_dispose($id,$status) {
       
        $status = str_replace('_', ' ', $status);
        $this->db->where('id', $id);
        $update = $this->db->update('bl_stock_handover', ['dispose' => $status]);
    
        
        redirect($this->data['base_url'] . '/stock_hospital');
    }


}