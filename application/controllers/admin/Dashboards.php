<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Dashboards  extends BaseAdminController
{
    function __construct()
    {
        parent::__construct();
    }
    function register_donars(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Registered Donors';
          
            $this->data['bredcrumbs']=array(
                'Dashboard'=>$this->data['base_url'],
                'Blood Group'=>''
            );       
          $this->theme->title($this->data['page_title'])->load('dashboards/vw_register_donars', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }
    function defer_donars(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Deferred Donors';
          
            $this->data['bredcrumbs']=array(
                'Dashboard'=>$this->data['base_url'],
                'Blood Group'=>''
            );       
          $this->theme->title($this->data['page_title'])->load('dashboards/vw_deferred_donors', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }
    function donation_appointments_donor(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Donation Appointments';
          
            $this->data['bredcrumbs']=array(
                'Dashboard'=>$this->data['base_url'],
                'Blood Group'=>''
            );       
          $this->theme->title($this->data['page_title'])->load('dashboards/vw_donation_appointments_donor', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }
    function pending_request_blood(){
       
        if(session_userdata('isAdminLoggedin')){
            $this->data['page_title']='Pending Request For Blood';
            $this->data['bredcrumbs']=array(
                'Dashboard'=>$this->data['base_url'],
                'Blood Group'=>''
            );       
          $this->theme->title($this->data['page_title'])->load('dashboards/vw_pending_request_blood', $this->data);
        }else{
            redirect($this->data['base_url']);
        }
    }
    function total_request_met(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Total Request Met';
          
            $this->data['bredcrumbs']=array(
                'Dashboard'=>$this->data['base_url'],
                'Blood Group'=>''
            );       
          $this->theme->title($this->data['page_title'])->load('dashboards/vw_total_request_met', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }
    function total_pending_app(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Total Pending Appointment';
          
            $this->data['bredcrumbs']=array(
                'Dashboard'=>$this->data['base_url'],
                'Blood Group'=>''
            );       
          $this->theme->title($this->data['page_title'])->load('dashboards/vw_total_pending_app', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }
    function blood_inventory(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Blood Inventory';
          
            $this->data['bredcrumbs']=array(
                'Dashboard'=>$this->data['base_url'],
                'Blood Group'=>''
            );       
          $this->theme->title($this->data['page_title'])->load('dashboards/vw_blood_inventory', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }
    function total_blood_issue(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Total Blood Issue';
            $this->data['bredcrumbs']=array(
                'Dashboard'=>$this->data['base_url'],
                'Blood Group'=>''
            );       
          $this->theme->title($this->data['page_title'])->load('dashboards/vw_blood_issue', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }
    function camp_planned(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Camps Planned';
            $this->db->from("bl_blood_banks"); 
            $this->db->where('org_type','Blood Bank');
            $bloodbank = $this->db->get();
            $bloodbank = $bloodbank->result();
            $this->db->from("bl_districts"); 
            $city = $this->db->get();
            $city = $city->result();
            $this->data['bredcrumbs']=array(
                'Dashboard'=>$this->data['base_url'],
                'Blood Group'=>'',
            );  
            $this->data['bloodbank'] = $bloodbank;
            $this->data['city'] = $city;
          $this->theme->title($this->data['page_title'])->load('dashboards/vw_camp_planned', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }
    function overview(){
        if(!session_userdata('isAdminLoggedin')){
            redirect($this->data['base_url']);
        }
        $current_date = date('Y-m-d');
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
                $posts['days_filter'] ='';
                $posts['end_date'] = '';
                $posts['start_date'] = '';
        $BloodStock = $this->um->_get_bb_inv($posts, $param, FALSE, FALSE);
      
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Overview Dashboard';
          
            $this->data['bredcrumbs']=array(
                'Dashboard'=>$this->data['base_url'],
                'Blood Group'=>''
            );           
            #---------------------------------
            $hospital = $this->db->query("SELECT * FROM bl_blood_banks where org_type = 'Hospital'")->num_rows();
            $labs = $this->db->query("SELECT * FROM bl_blood_banks where org_type = 'Lab'")->num_rows();
            
            $bloodbank = $this->db->query("SELECT * FROM bl_blood_banks where org_type = 'Blood Bank'")->result_array();
            
            
            $this->data['BloodStock'] = $BloodStock;
            $this->data['bloodbank'] = $bloodbank;
            $this->data['hospital']=$hospital;
            $this->data['labs']=$labs;
          $this->theme->title($this->data['page_title'])->load('dashboards/vw_overview', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }
    function overview_get(){
        
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
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['days_filter'] ='';
                $posts['end_date'] = '';
                $posts['start_date'] = '';
                $posts['bb_over'] = $this->input->post('blood_bank_id');
                
        $BloodStock = $this->um->_get_bb_inv($posts, $param, FALSE, FALSE);  
        
        $BloodIssuedlist = $this->um->_get_bb_reqest_issued($posts, $param, FALSE, FALSE);
        $BloodIssued = array();
        foreach ($BloodIssuedlist as $lab) {
                    $row = array();
                    $row['whole_blood_unit_count']  =   $lab->whole_blood_unit_count;
                    $row['Platelet_rich_concentrate_unit_count']  =   $lab->Platelet_rich_concentrate_unit_count;
                    $row['Red_blood_cell_unit_count']  =   $lab->Red_blood_cell_unit_count;
                    $row['Fresh_Frozen_Plasma_unit_count']  =   $lab->Fresh_Frozen_Plasma_unit_count;
                    $row['total_component_count']  =   $lab->total_component_count;
                    $BloodIssued[] = $row;
                }
        // -------- Blood Request Data ----------
                
                $this->db->select('bl_requestblood.*,bl_crossmatch.request as c_req');
                $this->db->join('bl_crossmatch', 'bl_requestblood.request = bl_crossmatch.request','left');
                if($_SESSION['admin_type'] == 5){
                    $B_id = $_SESSION['bank_id'];
                    $this->db->where('bl_requestblood.bloodbank_id = "' . $B_id . '"');
                }else{
                    
                  $this->db->where('bl_requestblood.bloodbank_id = "' . $this->input->post('blood_bank_id') . '"');  
                
                }
                $query = $this->db->get('bl_requestblood');
                
                $query_req = $query->result();
               
                $ffp=0;
                $prbc=0;
                $rbc=0;
                $wb=0;
                $ttl=0;
                foreach($query_req as $rw){
                    if($rw->c_req == '' ){
                        $decodes = json_decode($rw->components_unit);
                        // print_r($decodes);die();
                        foreach($decodes as $inx=>$decode){
                            // print_r($inx.'-'.$decode.'<br>');                           
                            if($inx =='whole_blood_unit' && $decode > 0){
                                ++$wb;
                            }
                            if($inx =='Fresh_Frozen_Plasma_unit' && $decode > 0){
                                ++$ffp;
                            }
                            if($inx == 'Red_blood_cell_unit' && $decode > 0){
                                ++$rbc;
                            }
                            if($inx =='Single_Donor_Platellet_unit' && $decode > 0){
                            
                                ++$rbc;
                            }
                            if($inx == 'Platelet_rich_concentrate_unit' && $decode > 0){
                              
                                ++$prbc;
                            }
                        }
                            
                        }
                    }
                $req_dt = [
                        'Fresh_Frozen_Plasma_unit_count'=>$ffp,
                        'Platelet_rich_concentrate_unit_count'=>$prbc,
                        'Red_blood_cell_unit_count'=>$rbc,
                        'whole_blood_unit_count'=>$wb,
                        'total_component_count'=>$rbc+$wb+$prbc+$ffp
                        ];
            // --------------------------------------
        $data['BloodStock'] = $BloodStock; 
        $data['BloodIssued'] = $req_dt; 
        // echo "<pre>";
        echo json_encode($data);
        return;
    }
    function index(){
        if(!session_userdata('isAdminLoggedin')){
            redirect($this->data['base_url']);
        }
        $current_date = date('Y-m-d');
        if($_SESSION['admin_type'] == 5){
        $B_id = $_SESSION['bank_id'];
        }
        // if ($_SESSION['admin_type'] == 5) {
        //         $query6 = $this->db->query("SELECT * 
        //             FROM bl_bb_donatioform AS dform 
        //             JOIN bl_blood_banks AS bb ON dform.bloodbank_id = bb.blood_bank_id 
        //             WHERE dform.bloodbank_id = '$B_id' 
        //             AND dform.blood_group IN ('A+', 'A-', 'B-', 'O+', 'O-', 'B+', 'AB+', 'AB-')
        //             AND dform.status = 'Pending'
        //         ");
        //     } else {
        //         $query6 = $this->db->query("SELECT * FROM bl_bb_donatioform AS dform 
        //             JOIN bl_blood_banks AS bb ON dform.bloodbank_id = bb.blood_bank_id 
        //             WHERE dform.status = 'Pending'
        //              AND dform.blood_group IN ('A+', 'A-', 'B-', 'O+', 'O-', 'B+', 'AB+', 'AB-')
        //         ");
        //     }
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Dashboard';
          
            $this->data['bredcrumbs']=array(
                'Dashboard'=>$this->data['base_url'],
                'Blood Group'=>''
            );           
            $query1 = $this->db->query("SELECT * FROM bl_blood_banks where org_type = 'Blood Bank'");
            $query2 = $this->db->query("SELECT * FROM bl_blood_banks Where org_type = 'Hospital'");
            $query33 = $this->db->query("SELECT * FROM bl_blood_banks Where org_type = 'Lab'"); 
            
            #--------------- Total Donor-------------
            $this->db->from("bl_bb_donatioform"); 
            $this->db->join('bl_blood_banks', 'bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id');
            if($_SESSION['admin_type'] == 5){
                
                $this->db->where('bl_bb_donatioform.bloodbank_id = "' . $B_id . '"');
            }
            $this->db->where('bl_bb_donatioform.blood_group !=',"");
            $TotalDonor = $this->db->get();
            #----------------------------------------
            
            $query4 = $this->db->query("SELECT * FROM bl_blood_donation_requests 
            JOIN bl_blood_banks ON bl_blood_donation_requests.org_id = bl_blood_banks.blood_bank_id 
            JOIN bl_customers ON bl_blood_donation_requests.user_id = bl_customers.user_id 
            ");

            $query6 = $this->db->query("SELECT * FROM bl_bb_donatioform AS dform 
                    JOIN bl_blood_banks AS bb ON dform.bloodbank_id = bb.blood_bank_id 
                    WHERE dform.status = 'Pending' AND dform.blood_group IN ('A+', 'A-', 'B-', 'O+', 'O-', 'B+', 'AB+', 'AB-')
                ");   
            
            $this->db->from('bl_bloodcamp');
            $this->db->join('bl_blood_banks', 'bl_blood_banks.blood_bank_id = bl_bloodcamp.bloodbank_id');
            if($_SESSION['admin_type'] == 5){
                $B_id = $_SESSION['bank_id'];
                $this->db->where('bl_bloodcamp.bloodbank_id = "' . $B_id . '"');
            }
            $this->db->where('bl_bloodcamp.start_date >', date('Y-m-d'));
            $this->db->join('bl_cities', 'bl_cities.id = bl_bloodcamp.city');

            $querycamp = $this->db->get();
            $querycamprec =  $querycamp->num_rows();

            $this->db->from('bl_crossmatch');
            $this->db->join('bl_requestblood', 'bl_crossmatch.request = bl_requestblood.request');
            $this->db->join('bl_blood_banks', 'bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id');
            if($_SESSION['admin_type'] == 5){
                $B_id = $_SESSION['bank_id'];
                $this->db->where('bl_crossmatch.bloodbank_id = "' . $B_id . '"');
            }
            $this->db->where('bl_requestblood.created_at >= "' . date('Y-m-d', strtotime('- 15 days')) . '"');
            $this->db->where('bl_crossmatch.status', 'crossmatch');

            $querypen_b_req = $this->db->get();
            $pen_b_req =  $querypen_b_req->num_rows();
            
            # Pending Appointment
            if($_SESSION['admin_type'] == 5){
                $B_id = $_SESSION['bank_id'];
                $pending_app = $this->db->query("SELECT * FROM bl_blood_donation_requests JOIN bl_blood_banks ON bl_blood_donation_requests.org_id = bl_blood_banks.blood_bank_id 
                JOIN bl_customers ON bl_blood_donation_requests.user_id = bl_customers.user_id 
                WHERE bl_blood_donation_requests.requested_schedule_date < '$current_date' 
                AND bl_blood_donation_requests.org_id = '$B_id' 
                AND bl_blood_donation_requests.donation_status = 'not donated'"); 
            }else{
                $pending_app = $this->db->query("SELECT * FROM bl_blood_donation_requests JOIN bl_blood_banks ON bl_blood_donation_requests.org_id = bl_blood_banks.blood_bank_id 
                JOIN bl_customers ON bl_blood_donation_requests.user_id = bl_customers.user_id 
                WHERE bl_blood_donation_requests.requested_schedule_date < '$current_date' 
                AND bl_blood_donation_requests.donation_status = 'not donated'");
            }
            #--------------------------------
            # schedule Appointment
            if($_SESSION['admin_type'] == 5){
                $B_id = $_SESSION['bank_id'];
                $schedule_app = $this->db->query("SELECT * FROM bl_blood_donation_requests 
                JOIN bl_blood_banks ON bl_blood_donation_requests.org_id = bl_blood_banks.blood_bank_id 
                JOIN bl_customers ON bl_blood_donation_requests.user_id = bl_customers.user_id 
                WHERE bl_customers.blood_group IN (1,2,3,4,5,6,7,8) AND bl_blood_donation_requests.org_id = '$B_id' ");
            }else{
                $schedule_app = $this->db->query("SELECT * FROM bl_blood_donation_requests 
                JOIN bl_blood_banks ON bl_blood_donation_requests.org_id = bl_blood_banks.blood_bank_id 
                JOIN bl_customers ON bl_blood_donation_requests.user_id = bl_customers.user_id WHERE bl_customers.blood_group IN (1,2,3,4,5,6,7,8) " );
            }
            
            #--------------------------------
            # Total Blood Stocks
            $this->db->from('bl_blood_record');
            $this->db->join('bl_blood_banks', 'bl_blood_banks.blood_bank_id = bl_blood_record.bloodbank_id');
            if($_SESSION['admin_type'] == 5){
                $B_id = $_SESSION['bank_id'];
                $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }
            $this->db->where('bl_blood_record.status IS NULL', null, false);
            $this->db->where('bl_blood_record.cross_match', 'No');
            $this->db->where_In('bl_blood_record.component',[18,20,21,22,886,'wholeblood']);
            $this->db->where('bl_blood_record.expiry_date > "'.$current_date.'"');
            $query99inv = $this->db->get();
            $query99inverec =  $query99inv->num_rows();
            
            #--------------------------------
            #   Total Blood Request 

            if($_SESSION['admin_type'] == 5){
               $query_R_T = $this->db->query("SELECT rb.* FROM bl_requestblood rb LEFT JOIN bl_crossmatch cm ON cm.request = rb.request 
                                    WHERE rb.bloodbank_id = '$B_id'  AND (cm.status != 'issued' OR cm.status IS NULL) 
                                    ORDER BY rb.ID DESC
                                ");
            }else{
            $query_R_T = $this->db->query("SELECT rb.* FROM bl_requestblood rb LEFT JOIN bl_crossmatch cm ON cm.request = rb.request 
                                    WHERE (cm.status != 'issued' OR cm.status IS NULL) 
                                    ORDER BY rb.ID DESC
                                ");
            }
            
            $blood_request =  $query_R_T->num_rows();
            
            #---------------------------------
            #------- payment---------------------
            $this->db->select_sum('bl_crossmatch.payment', 'total_payment'); // Add this line
            $this->db->from('bl_crossmatch');
            $this->db->join('bl_blood_banks', 'bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id');
            if ($_SESSION['admin_type'] == 5) {
                $B_id = $_SESSION['bank_id'];
                $this->db->where('bl_crossmatch.bloodbank_id', $B_id);
            }
            $this->db->where('bl_crossmatch.status', 'issued');
            $query = $this->db->get();
            $result = $query->row();
            // To access the sum value
            $total_payment = $result->total_payment;
            #---------------------------------------
            $this->data['query1'] = $query1;
            $this->data['query2'] = $query2;
            $this->data['query33'] = $query33;
            $this->data['TotalDonor'] = $TotalDonor;
            $this->data['query4'] = $query4;
            $this->data['query6'] = $query6;
            $this->data['invsum'] = $query99inverec;
            $this->data['querycamprec'] = $querycamprec;
            $this->data['pen_b_req'] = $pen_b_req;
            $this->data['pending_app'] = $pending_app;
            $this->data['schedule_app'] = $schedule_app;
            $this->data['blood_request'] =$blood_request;
             $this->data['blood_payment'] =$total_payment;
          $this->theme->title($this->data['page_title'])->load('dashboards/vw_superadmin', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }
}