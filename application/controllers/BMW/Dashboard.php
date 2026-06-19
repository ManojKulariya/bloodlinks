<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends BaseBMWController {

    function __construct()
    {
        parent::__construct();
         if(!session_userdata('isBMWLoggedin')){
             redirect($this->data['base_url']);
        }

    }
	public function dashboards()
	{
	    $id = decode_data(session_userdata('admin_id'));
	    
        $this->data['page_title']='Dashboard';
        
        $this->data['bredcrumbs']=array(
            'Dashboard'=>$this->data['base_url'],
            'Blood Group'=>''
        );       
        // Get all requests
        $this->db->select('bl_stock_handover.*');
        $this->db->from('bl_stock_handover');
        $this->db->where('bmw_id', $id);
        $query = $this->db->get();
        
        // Total requests sent
        $this->data['total_stock'] = $query->num_rows();
        // ✅ Count Pending
        $this->db->where('bmw_id', $id);
        $this->db->where('bmw_status', 'Pending');
        $this->data['total_pending'] = $this->db->count_all_results('bl_stock_handover');
        
        // ✅ Count Reached
        $this->db->where('bmw_id', $id);
        $this->db->where('bmw_status', 'Complete');
        $this->data['total_reached'] = $this->db->count_all_results('bl_stock_handover');
        
        // ✅ Count Not Reached
        $this->db->where('bmw_id', $id);
        $this->db->where('bmw_status', 'Not Complete');
        $this->data['total_not_reached'] = $this->db->count_all_results('bl_stock_handover');
        
        

        $this->theme->title($this->data['page_title'])->load('dashboards/vw_dashboard', $this->data);
      
	}
	public function nearby_bloodbank(){
	   // log_message('error', 'This is an error log');
	    $this->data['page_title']='Blood Bank Stock';
          
        $this->data['bredcrumbs']=array(
            'Dashboard'=>$this->data['base_url'],
            'Blood Group'=>''
        );        
        $this->theme->title($this->data['page_title'])->load('dashboards/vw_blood_inventory', $this->data);
        
	}
	public function bb_inv_search()
    {
        
        
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                
                $param['column_order'] = array(
                    null,
                    'short_name',
                    'whole_blood_unit_count',
                    'Cryo_Poor_Plasma_unit_count',
                    'Cryoprecipitate_unit_count',
                    'Fresh_Frozen_Plasma_unit_count',
                    'Red_blood_cell_unit_count',
                    'Platelet_rich_concentrate_unit_count',
                    'total_component_count'
                );

                $param['column_search'] = array('short_name', 'whole_blood_unit_count', 'Cryo_Poor_Plasma_unit_count', 'Cryoprecipitate_unit_count', 'Fresh_Frozen_Plasma_unit_count', 'Red_blood_cell_unit_count', 'Platelet_rich_concentrate_unit_count');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['days_filter'] = post_data('days_filter');
                $posts['end_date'] = post_data('end_date');
                $posts['start_date'] = post_data('start_date');

                $list = $this->um->_get_bb_inv($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    // Fetch blood bank address
                    $address = '';
                    $name = '';
                    $bb = $this->db
                        ->select('address_1, address_2,name,short_name')
                        ->from('bl_blood_banks')
                        ->where('blood_bank_id', $lab->blood_bank_id)
                        ->get()
                        ->row();
                
                    if ($bb) {
                        $address = $bb->address_1 . ' ' . $bb->address_2;
                        $name = $bb->name.' '.$bb->short_name;
                    }
                    $no++;
                    $row = array();
                    $row[]  =   $no;
                    $row[]  = '<a href="" >' . $name . '</a><br><small>' . $address . '</small>';
                    $row[]  =   $lab->whole_blood_unit_count;
                    $row[]  =   $lab->Platelet_rich_concentrate_unit_count;
                    $row[]  =   $lab->Red_blood_cell_unit_count;
                    $row[]  =   $lab->Fresh_Frozen_Plasma_unit_count;
                    $row[]  =   $lab->total_component_count;
                    $row[]  =   '<a href="' . $this->data['base_url'] . '/Blood_request/' . encode_data($lab->blood_bank_id) .' " >Request blood from <br>' . $lab->short_name . '-></a>';;
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bb_inv($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bb_inv($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
     
    }
}