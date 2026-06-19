<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends BaseHospitalController {

    function __construct()
    {
        parent::__construct();
         if(!session_userdata('isHospitalLoggedin')){
             redirect($this->data['base_url']);
        }

    }
	public function dashboards()
	{
	    $hospital_id = session_userdata('customer_id');
	    
        $this->data['page_title']='Dashboard';
        
        $this->data['bredcrumbs']=array(
            'Dashboard'=>$this->data['base_url'],
            'Blood Group'=>''
        );       
        // Get all requests
        $this->db->select('br.*, bb.name as bb_name');
        $this->db->from('bl_blood_request br');
        $this->db->join('bl_blood_banks bb', 'bb.blood_bank_id = br.org_id', 'left');
        $this->db->where('br.hospital_id', $hospital_id);
        $this->db->order_by('br.id', 'DESC'); // latest first
        $query = $this->db->get();
        
        // Total requests sent
        $this->data['total_req_send'] = $query->num_rows();
        
        // Total pending requests
        $this->db->from('bl_blood_request');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('request', '');
        $this->data['total_req_pending'] = $this->db->count_all_results();
        
        // Total accepted requests
        $this->db->from('bl_blood_request');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('request', 'Accept');
        $this->data['total_req_accepted'] = $this->db->count_all_results();
        
        // Total rejected requests
        $this->db->from('bl_blood_request');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('request', 'Reject');
        $this->data['total_req_rejected'] = $this->db->count_all_results();
        
        // --------- issued---------------
        $this->db->select('bl_crossmatch.*, bl_masters.master_type_key_short_value,bb.name as bb_name,
                        inq.is_rec,inq.res_by,inq.status inq_status,inq.dis_res,inq.dis_by');
        $this->db->from('bl_crossmatch');
        $this->db->join('bl_masters', 'bl_masters.master_id = bl_crossmatch.component');
        $this->db->join('bl_blood_banks bb', 'bb.blood_bank_id = bl_crossmatch.bloodbank_id', 'left');
        $this->db->join('bl_issuedblood_inq inq', 'inq.cros_id = bl_crossmatch.id', 'left');
        $this->db->where('bl_masters.master_type_name', 'Components Types');
        $this->db->where('bl_crossmatch.status', 'issued');
        $this->db->order_by('bl_crossmatch.id', 'DESC');
        $this->db->where('bl_crossmatch.hospital_id', $hospital_id);
        $queryissued =  $this->db->get();
        $this->data['total_blood_issued'] = $queryissued->num_rows();
        // Convert to array for filtering
        $issued_results = $queryissued->result_array();
        
        // Filter for is_rec = Yes / No
        $total_rec_yes = 0;
        $total_rec_no  = 0;

        foreach ($issued_results as $row) {
            if (isset($row['is_rec'])) {
                if (strtolower($row['is_rec']) === 'yes') {
                    $total_rec_yes++;
                } elseif (strtolower($row['is_rec']) === 'no') {
                    $total_rec_no++;
                }
            }
        }
        
        $this->data['total_blood_rec'] = $total_rec_yes;
        $this->data['total_blood_rec_not'] = $total_rec_no;
        
        

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
	public function nearby_bloodbank_1($id){
	   // log_message('error', 'This is an error log');
	    $this->data['page_title']='Blood Bank Stock';
        $this->data['req_id'] = $id;
        $this->data['bredcrumbs']=array(
            'Dashboard'=>$this->data['base_url'],
            'Blood Group'=>''
        );        
        $this->theme->title($this->data['page_title'])->load('dashboards/vw_blood_inventory_1', $this->data);
        
	}
	public function bb_inv_search()
    {
        
        
            // if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $hospital_id = session_userdata('customer_id');
                $hpdata = $this->um->get_lat_long_by_id($hospital_id);
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
                // print_r($hpdata);
                $posts['lat'] = $hpdata['latitude'];
                $posts['lng'] = $hpdata['longitude'];

                $list = $this->um->_get_bb_inv_hp($posts, $param, FALSE, FALSE);
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
                    $row[] = is_null($lab->distance_km) ? 'Distance N/A' : round($lab->distance_km, 2) . ' km';

                    $row[]  =   '<a href="' . $this->data['base_url'] . '/Blood_request/' . encode_data($lab->blood_bank_id) .' " >Request blood from <br>' . $lab->short_name . '-></a>';;
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bb_inv_hp($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bb_inv_hp($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            // } else {
            //     redirect($this->data['base_url']);
            // }
     
    }
    public function bb_inv_search_1()
    {
        
        
            // if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $hospital_id = session_userdata('customer_id');
                $hpdata = $this->um->get_lat_long_by_id($hospital_id);
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
                $req_id = post_data('req_id');

                $param['column_search'] = array('short_name', 'whole_blood_unit_count', 'Cryo_Poor_Plasma_unit_count', 'Cryoprecipitate_unit_count', 'Fresh_Frozen_Plasma_unit_count', 'Red_blood_cell_unit_count', 'Platelet_rich_concentrate_unit_count');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['days_filter'] = post_data('days_filter');
                $posts['end_date'] = post_data('end_date');
                $posts['start_date'] = post_data('start_date');
                // print_r($hpdata);
                $posts['lat'] = $hpdata['latitude'];
                $posts['lng'] = $hpdata['longitude'];

                $list = $this->um->_get_bb_inv_hp($posts, $param, FALSE, FALSE);
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
                    $row[] = is_null($lab->distance_km) ? 'Distance N/A' : round($lab->distance_km, 2) . ' km';

                    $row[]  =   '<a href="' . $this->data['base_url'] . '/Blood_request_1/' . $lab->blood_bank_id .'/'.$req_id.' " >Send Request</a>';
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bb_inv_hp($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bb_inv_hp($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            // } else {
            //     redirect($this->data['base_url']);
            // }
     
    }
}