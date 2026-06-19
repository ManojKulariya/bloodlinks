<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends BaseHospitalController {

    function __construct()
    {
        parent::__construct();
         if(!session_userdata('isHospitalLoggedin')){
             redirect($this->data['base_url']);
        }

    }
    function stock_handover()
    {
        $this->data['page_title'] = 'Discard Handover To BMW';
        $this->db->from("bl_masters");
        $this->db->where('master_type_key', 'component_types');
        $com = $this->db->get();
        $com = $com->result();
        $this->data['bredcrumbs'] = array(
            'Dashboard' => $this->data['base_url'],
            'Blood Group' => '',
        );
        $this->data['com'] = $com;
        $this->data['bmw'] =  $this->dm->get_assigned_bmw(session_userdata('customer_id')); 
       
        $this->theme->title($this->data['page_title'])->load('dashboards/vw_stock_handover', $this->data);
       
    }
    public function bb_stock_handover_search()
    {
        if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
            $param['column_order'] = array(
                null,
                'unit_no',
                'bag_config',
                'final_vol',
                'blood_group',
                'expiry_date',
                'created_at'
            );
            $param['column_search'] = array('unit_no', 'bag_config', 'final_vol', 'blood_group', 'expiry_date', 'created_at');
            $param['order'] = array('id' => 'ASC');
            $posts = $this->input->post();
            // $posts['end_date'] = post_data('end_date');
            // $posts['start_date'] = post_data('start_date');
            $list = $this->um->_search_hp_stock_handover($posts, $param, FALSE, FALSE);
            $data = array();
            $no = isset($posts['start']) ? $posts['start'] : 0;
            $action = '';
            foreach ($list as $lab) {

                $no++;
                $row = array();
                $row[]  = $no; // Checkbox column
                $row[]  = $lab->unit_no;
                $row[]  = $lab->p_name;
                $row[]  = $lab->master_type_key_short_value;
                $row[]  =   $lab->balance_vol;
                $row[]  =   $lab->blood_group;
                $row[]  =   $lab->inq_status;
                $row[]  =   $lab->dis_no;
                $row[]  =   $lab->dis_res;
                $row[]  =   $lab->dis_date;
                $row[]  = '<button class="btn btn-sm btn-primary handover-btn" data-id="' . $lab->id . '"  data-dis_no="' . $lab->dis_no . '"  data-dis_res="' . $lab->dis_res . '">Handover to BMW</button>';
                
                $data[] = $row;
            }

            $output = array(
                "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                "recordsTotal" => $this->um->_search_hp_stock_handover($posts, $param, TRUE),
                "recordsFiltered" => $this->um->_search_hp_stock_handover($posts, $param, TRUE),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect($this->data['base_url']);
        }
       
    }
    function generateUniqueIssueNo()
    {
        // Get the current date and time
        $dateTime = date('mdHs'); // Format: YYYYMMDDHHMMSS

        // Generate a random string of 4 capital letters
        $randomString = $this->generateRandomString(4);

        // Concatenate date, time, and random string to form the unique issue number
        $uniqueIssueNo = $randomString . $dateTime;

        return $uniqueIssueNo;
    }
    function generateRandomString($length = 4)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function bmw_stock_hand_over()
    {
        $aj = post_data('aj');
        $issue_to = post_data('issue_to');
        $des_res = post_data('dis_res');
        $desno = post_data('dis_no');
        $selectedIds = $this->input->post('selectedIds'); // Directly using CI's input class to get the array
        $issueNo = $this->generateUniqueIssueNo();
        $B_id = session_userdata('customer_id');
        $by_user = session_userdata('auth_id');
        foreach ($selectedIds as $selectedId) {
            $this->db->select('bl_crossmatch.*');
            $this->db->where('bl_crossmatch.id', $selectedId); 
            $query = $this->db->get('bl_crossmatch');
            $result = json_encode($query->result());
            $added = $this->db->query("INSERT INTO bl_stock_handover (cros_id,hp_id,issue_to,bmw_id,stock_data,issue_no,status,bmw_status,discard_no,discard_res,by_user)
            VALUES ('$selectedId','$B_id','$issue_to','$aj','$result','$issueNo','BMW','Pending','$desno','$des_res','$by_user')");
        }

        echo json_encode('Staock handover to BMW successfuly.');
    }
    public function hp_stock_over_view_search()
    {
        if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
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
            $posts['hp_id'] = session_userdata('customer_id');
            $txt = '';
            $list = $this->um->_get_hp_blood_stock_overview($posts, $param, FALSE, FALSE);
            $data = array();
            $no = isset($posts['start']) ? $posts['start'] : 0;
            $comp = $this->db->query("SELECT * FROM bl_masters WHERE master_type_key = 'component_types'")->result();
            // print_r($comp);die();
            foreach ($list as $lab) {
                $rec = json_decode($lab->stock_data);
                foreach ($comp as $c) {
                    if ($c->master_id == $rec[0]->component) {
                        $txt = $c->master_type_key_short_value; // or master_type_key_value if you want full name
                        break;
                    }
                }
                // $txt = $rec[0]->component;
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $lab->a_name;
                $row[] = $rec[0]->p_name;
                $row[] = $rec[0]->balance_vol;
                $row[] = $txt;
                $row[] = $rec[0]->blood_group; // Fixed typo here
                $row[] = $rec[0]->unit_no; // Fixed typo here
                $row[] = $lab->created_at; // Fixed typo here
                $row[] = $lab->discard_no; // Fixed typo here
                $row[] = $lab->discard_res; // Fixed typo here
                $row[] = $lab->bmw_status; // Fixed typo here
                $data[] = $row;
            }
            $output = array(
                "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                "recordsTotal" => $this->um->_get_hp_blood_stock_overview($posts, $param, TRUE),
                "recordsFiltered" => $this->um->_get_hp_blood_stock_overview($posts, $param, TRUE),
                "data" => $data,
            );
            echo json_encode($output);
        } else {
            redirect($this->data['base_url']);
        }
    }
    public function Request_1($bankid , $req_id){
        $this->db->where('id', $req_id)->update('bl_blood_request', ['org_id' => $bankid]);
        
        $this->session->set_flashdata('success', 'Your blood request has been submitted successfully!');
        
        redirect('hospital/Blood_request_history/');
    }
	public function Request($id)
	{
	    
	    $id = decode_data($id);
	    $com = get_components_by_bank($id);
	   // print_r($com);
	   // die();
        $this->data['page_title'] = 'Request Blood';
        // $this->data['component'] = $this->db->query("SELECT * FROM bl_masters WHERE master_type_key = 'component_types'")->result();
        $this->data['component'] = $com;
        $this->data['bank_id'] = $id;
        $this->data['hp_name'] = session_userdata('name');
	    $this->data['hp_reg'] =session_userdata('reg_no');
        $this->data['bredcrumbs']=array(
            'Dashboard'=>$this->data['base_url'],
            'Blood Group'=>''
        );       
        $this->theme->title($this->data['page_title'])->load('Request/vw_req_form', $this->data);
      
	}
	public function req_bloodbank(){
	   
        $this->data['page_title'] = 'Request Blood';
        $com = $this->db->query("SELECT * FROM bl_masters WHERE master_type_key = 'component_types'")->result();
        $this->data['component'] = $com;
        $this->data['hp_name'] = session_userdata('name');
	    $this->data['hp_reg'] = session_userdata('reg_no');
        $this->data['bredcrumbs']=array(
            'Dashboard'=>$this->data['base_url'],
            'Blood Group'=>''
        );       
        $this->theme->title($this->data['page_title'])->load('Request/vw_req_form_1', $this->data); 
	}
    public function Blood_request_submit()
    {
            $data = [
                'user_id'           => 0,
                'hospital_id'       => session_userdata('customer_id'),
                'p_name'            => $this->input->post('p_name'),
                'age'               => $this->input->post('age'),
                'gender'            => $this->input->post('gender'),
                'registration'      => $this->input->post('registration'),
                'ward'              => $this->input->post('ward'),
                'bed'               => $this->input->post('bed'),
                'f_name'            => $this->input->post('f_name'),
                'hospital'          => $this->input->post('hospital'),
                'phone'             => $this->input->post('phone'),
                'consultant'        => $this->input->post('consultant'),
                'consultant_phone'  => $this->input->post('consultant_phone') ?? null,
                'clinical_history'  => $this->input->post('clinical_history'),
                'diagnosis'         => $this->input->post('diagnosis'),
                'hb'                => $this->input->post('hb'),
                'platelet'          => $this->input->post('platelet'),
                'reasons'           => $this->input->post('reasons'),
                'history_previous'  => $this->input->post('history_previous'),
                'blood_group'       => $this->input->post('blood_group'),
                'female'            => $this->input->post('female'),
                'required_date'     => $this->input->post('required_date'),
                'required_time'     => $this->input->post('required_time'),
                'stat'              => $this->input->post('stat') ?? '',
                'urgent'            => $this->input->post('urgent') ?? '',
                'routine'           => $this->input->post('routine') ?? '',
                'reserved'          => $this->input->post('reserved') ?? '',
                'patient'           => $this->input->post('patient') ?? '',
                'identity'          => $this->input->post('identity') ?? '',
                'medical'           => $this->input->post('medical') ?? '',
                'completely'        => $this->input->post('completely') ?? '',
                'sample'            => $this->input->post('sample') ?? '',
                'matchs'            => $this->input->post('match') ?? '',
                'sample_tube'       => $this->input->post('sample_tube') ?? '',
                'org_id'            => $this->input->post('bank_id'),
                'req_by'            => session_userdata('auth_id'),
            ];
    
            // Handle units & tests dynamically
            $units = [];
            $tests = [];
            foreach ($this->input->post() as $key => $value) {
                if (strpos($key, 'unit') !== false) {
                    $units[$key] = $value;
                }
                if (strpos($key, 'test') !== false) {
                    $tests[$key] = $value;
                }
            }
    
            $data['components_unit'] = json_encode($units);
            $data['components_test'] = json_encode($tests);
    
            // Insert into DB securely
            $this->db->insert('bl_blood_request', $data);
            $_SESSION['last_id'] = $this->db->insert_id();
    
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Your blood request has been submitted successfully!');
                
            } else {
                $this->session->set_flashdata('error', 'Something went wrong! Please try again.');
            }
            $id =$this->input->post('bank_id');
            redirect('hospital/Blood_request/'. encode_data($id));
    }
    public function Blood_request_submit_1()
    {
            $data = [
                'user_id'           => 0,
                'hospital_id'       => session_userdata('customer_id'),
                'p_name'            => $this->input->post('p_name'),
                'age'               => $this->input->post('age'),
                'gender'            => $this->input->post('gender'),
                'registration'      => $this->input->post('registration'),
                'ward'              => $this->input->post('ward'),
                'bed'               => $this->input->post('bed'),
                'f_name'            => $this->input->post('f_name'),
                'hospital'          => $this->input->post('hospital'),
                'phone'             => $this->input->post('phone'),
                'consultant'        => $this->input->post('consultant'),
                'consultant_phone'  => $this->input->post('consultant_phone') ?? null,
                'clinical_history'  => $this->input->post('clinical_history'),
                'diagnosis'         => $this->input->post('diagnosis'),
                'hb'                => $this->input->post('hb'),
                'platelet'          => $this->input->post('platelet'),
                'reasons'           => $this->input->post('reasons'),
                'history_previous'  => $this->input->post('history_previous'),
                'blood_group'       => $this->input->post('blood_group'),
                'female'            => $this->input->post('female'),
                'required_date'     => $this->input->post('required_date'),
                'required_time'     => $this->input->post('required_time'),
                'stat'              => $this->input->post('stat') ?? '',
                'urgent'            => $this->input->post('urgent') ?? '',
                'routine'           => $this->input->post('routine') ?? '',
                'reserved'          => $this->input->post('reserved') ?? '',
                'patient'           => $this->input->post('patient') ?? '',
                'identity'          => $this->input->post('identity') ?? '',
                'medical'           => $this->input->post('medical') ?? '',
                'completely'        => $this->input->post('completely') ?? '',
                'sample'            => $this->input->post('sample') ?? '',
                'matchs'            => $this->input->post('match') ?? '',
                'sample_tube'       => $this->input->post('sample_tube') ?? '',
                // 'org_id'            => $this->input->post('bank_id'),
                 'req_by'            => session_userdata('auth_id'),
            ];
    
            // Handle units & tests dynamically
            $units = [];
            $tests = [];
            foreach ($this->input->post() as $key => $value) {
                if (strpos($key, 'unit') !== false) {
                    $units[$key] = $value;
                }
                if (strpos($key, 'test') !== false) {
                    $tests[$key] = $value;
                }
            }
    
            $data['components_unit'] = json_encode($units);
            $data['components_test'] = json_encode($tests);
    
            // Insert into DB securely
            $this->db->insert('bl_blood_request', $data);
            $_SESSION['last_id'] = $this->db->insert_id();
    
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Your blood request has been submitted successfully!');
                
            } else {
                $this->session->set_flashdata('error', 'Something went wrong! Please try again.');
            }
            $id = $this->db->insert_id();
            redirect('hospital/nearby_bloodbank_1/'.$id);
            
    }
    public function Blood_request_history()
    {
        // Get hospital_id from session
        $hospital_id = session_userdata('customer_id');
    
        // Query blood request history with JOIN
        $this->db->select('br.*, bb.name as bb_name');
        $this->db->from('bl_blood_request br');
        $this->db->join('bl_blood_banks bb', 'bb.blood_bank_id = br.org_id', 'left');
        $this->db->where('br.hospital_id', $hospital_id);
        $this->db->order_by('br.id', 'DESC'); // latest first
        $query = $this->db->get();
    
        $this->data['requests'] = $query->result();
        $this->data['master'] = $this->db->query("SELECT * FROM bl_masters  WHERE master_type_name = 'Components Types'")->result();
        
        // Load view
        $this->data['page_title'] = "Blood Request History";
        $this->theme->title($this->data['page_title'])->load('Request/blood_request_history', $this->data);
        
    }
    public function Blood_request_issued(){
        $hospital_id = session_userdata('customer_id');
    
        // Query blood request history with JOIN
        $this->db->select('bl_crossmatch.*, bl_masters.master_type_key_short_value,bb.name as bb_name,
                        inq.is_rec,inq.res_by,inq.status inq_status,inq.dis_res,inq.dis_by');
        $this->db->from('bl_crossmatch');
        $this->db->join('bl_masters', 'bl_masters.master_id = bl_crossmatch.component');
        $this->db->join('bl_blood_banks bb', 'bb.blood_bank_id = bl_crossmatch.bloodbank_id', 'left');
        $this->db->join('bl_issuedblood_inq inq', 'inq.cros_id = bl_crossmatch.id', 'left');
        // ✅ NEW: Exclude already handed overfgghf fg
        $this->db->where("bl_crossmatch.id NOT IN (SELECT cros_id FROM bl_stock_handover WHERE status = 'BMW' AND hp_id = {$hospital_id})");

        $this->db->where('bl_masters.master_type_name', 'Components Types');
        $this->db->where('bl_crossmatch.status', 'issued');
        $this->db->order_by('bl_crossmatch.id', 'DESC');
        $this->db->where('bl_crossmatch.hospital_id', $hospital_id);
        $query =  $this->db->get()->result();
        
        $this->data['requests'] = $query;
        // print_r($this->data['requests'] );die();
        $this->data['master'] = $this->db->query("SELECT * FROM bl_masters  WHERE master_type_name = 'Components Types'")->result();
        // print_r($this->data['requests'] );die();
        // Load view
        $this->data['page_title'] = "Blood Request History";
        $this->theme->title($this->data['page_title'])->load('Request/blood_request_issued', $this->data);
    }
    function handover_to_bmw_overview()
    {
        $this->data['page_title'] = 'OverView';
        $this->data['bredcrumbs'] = array(
            'Dashboard' => $this->data['base_url'],
            'Blood Group' => '',
        );
        $this->theme->title($this->data['page_title'])->load('dashboards/vw_stock_overview', $this->data);
       
    }
    public function Blood_request_issued_rec(){
        $id     = $this->input->post('id');
        $is_rec = $this->input->post('is_rec');
        $hospital_id = session_userdata('customer_id');
        // Check if record exists
        $exists = $this->db->get_where('bl_issuedblood_inq', ['cros_id' => $id])->row();
        
        if ($exists) {
            // Update
            $this->db->where('cros_id', $id)
                     ->update('bl_issuedblood_inq', ['is_rec' => $is_rec]);
        } else {
            // Insert
            $this->db->insert('bl_issuedblood_inq', [
                'hospital_id' => $hospital_id,
                'cros_id'     => $id,
                'is_rec' => $is_rec,
                'res_by'=>session_userdata('auth_id')
            ]);
        }
        echo "success";

    }
    public function Blood_request_update_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
    
        $this->db->where('cros_id', $id)
                 ->update('bl_issuedblood_inq', ['status' => $status]);
    
        echo "success";
    }
    
    public function Blood_request_discard_blood()
    {
        $id           = $this->input->post('id');
        $discard_date = $this->input->post('discard_date');
        $reason       = $this->input->post('reason');
        $hospital_id = session_userdata('customer_id');
        
        $this->db->where('cros_id', $id)
                 ->update('bl_issuedblood_inq', [
                     'status'        => 'Discard',
                     'dis_date'  => $discard_date,
                     'dis_res'=> $reason,
                     'dis_by'=>session_userdata('auth_id'),
                     'dis_no'=>$this->input->post('dis_no')
                 ]);
    
        echo "success";
    }
    function my_bmw()
    {


        $this->data['page_title'] = 'Blood Bank BMW';
        $this->data['bmws'] = $this->dm->get_all_bmw(); 
        $this->data['assigned_bmws'] = $this->dm->get_assigned_bmw(session_userdata('customer_id')); 
        // $DT = $this->session->userdata();
        // print_r($DT);
        $this->theme->title($this->data['page_title'])->load('donations/vw_bloodbank_bmw', $this->data);
       
    }
    
    public function assign_bmw_to_user()
    {
        $bmw_ids = $this->input->post('bmw_ids');
        $user_id = $this->session->userdata('customer_id'); // current logged-in user
    
        if (!empty($bmw_ids)) {
            $data = [];
    
            foreach ($bmw_ids as $bmw_id) {
                // Check if this BMW is already assigned to the user
                $exists = $this->db->where('user_id', $user_id)
                                   ->where('bmw_id', $bmw_id)
                                   ->get('user_bmw_assignments')
                                   ->row();
    
                if (!$exists) {
                    $data[] = [
                        'user_id' => $user_id,
                        'bmw_id' => $bmw_id,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                }
            }
    
            if (!empty($data)) {
                $this->db->insert_batch('user_bmw_assignments', $data);
            }
    
            // Reload page after success
            echo json_encode(['status' => 'success', 'reload' => true]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No BMW selected']);
        }
    }



}