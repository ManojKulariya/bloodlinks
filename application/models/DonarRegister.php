<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DonarRegister extends CI_Model
{
    protected $table = 'bl_bb_donatioform';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 #=========================
     public function getInvComp($limit, $offset, $bank_id, $filters = [])
    {

        $this->db->from('bl_bb_donatioform');
        if($bank_id != 0){
            $this->db->where('bl_bb_donatioform.bloodbank_id', $bank_id);
        }
        
        $this->db->where('bl_bb_donatioform.status', 'Test Done');
        $this->db->limit($limit, $offset);
         // Apply filters
         if (!empty($filters['start_date'])) {
            $this->db->where('bl_bb_donatioform.donation_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_bb_donatioform.donation_date <=', $filters['end_date']);
        }
        if (!empty($filters['unit_no'])) {
            $this->db->LIKE('bl_bb_donatioform.unit_no', $filters['unit_no']);
        }
        if (!empty($filters['blood_group'])) {
            $this->db->where('bl_bb_donatioform.blood_group', $filters['blood_group']);
        }
        if (!empty($filters['storage_type'])) {
            $this->db->where('bl_bb_donatioform.storge_type', $filters['storage_type']);
        }
        if (!empty($filters['user'])) {
            $this->db->like('bl_bb_donatioform.component_user', $filters['user']);
        }
        if (!empty($filters['component'])) {
            $this->db->like('bl_bb_donatioform.component', $filters['component']);
        }
       $this->db->order_by('bl_bb_donatioform.id', 'desc'); 
       $query = $this->db->get();

        return $query->result_array();
    }
    public function getInvComptotal($bank_id, $filters = [])
    {

        $this->db->from('bl_bb_donatioform');
        if($bank_id != 0){
            $this->db->where('bl_bb_donatioform.bloodbank_id', $bank_id);
        }
        $this->db->where('bl_bb_donatioform.status', 'Test Done');
         // Apply filters
         if (!empty($filters['start_date'])) {
            $this->db->where('bl_bb_donatioform.donation_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_bb_donatioform.donation_date <=', $filters['end_date']);
        }
        if (!empty($filters['unit_no'])) {
            $this->db->LIKE('bl_bb_donatioform.unit_no', $filters['unit_no']);
        }
        if (!empty($filters['blood_group'])) {
            $this->db->where('bl_bb_donatioform.blood_group', $filters['blood_group']);
        }
        if (!empty($filters['storage_type'])) {
            $this->db->where('bl_bb_donatioform.storge_type', $filters['storage_type']);
        }
        if (!empty($filters['user'])) {
            $this->db->like('bl_bb_donatioform.component_user', $filters['user']);
        }
        if (!empty($filters['component'])) {
            $this->db->like('bl_bb_donatioform.component', $filters['component']);
        }
       $this->db->order_by('bl_bb_donatioform.id', 'desc'); 

        return $this->db->count_all_results();
    }
    #==================================
    // Define the method to get bl_bb_donatioform and related blood_records with pagination
    public function getDonationDetails($limit, $offset, $bank_id, $filters = [])
    {
        $this->db->select('bl_blood_record.*,bl_qc_component.sterllty,bl_qc_component.factor_8_fibrinogen,bl_qc_component.platelet,bl_qc_component.pcv,bl_agency.phon,bl_crossmatch.issue_no as c_issue_no,bl_agency.a_name,bl_agency.address as a_address');
        $this->db->join('bl_agency', 'bl_blood_record.blood_from_bank = bl_agency.id', 'LEFT');
        // $this->db->join('bl_crossmatch', 'bl_blood_record.crossmatch_no = bl_crossmatch.cross_match', 'LEFT');
        $this->db->join('bl_crossmatch', 'bl_blood_record.crossmatch_no = bl_crossmatch.cross_match AND bl_crossmatch.bloodbank_id = \'$bank_id\'', 'LEFT');

        $this->db->join('bl_qc_component', 'bl_blood_record.unit_no = bl_qc_component.unit_no', 'LEFT');
        $this->db->from('bl_blood_record');
        $this->db->limit($limit, $offset);
        // $this->db->where('bl_crossmatch.bloodbank_id', $bank_id);
        if($bank_id != 0){
            $this->db->where('bl_blood_record.bloodbank_id', $bank_id);
        }
         // Apply filters
        if (!empty($filters['start_date'])) {
            $this->db->where('bl_blood_record.collection_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_blood_record.collection_date <=', $filters['end_date']);
        }
        if (!empty($filters['start_id'])) {
            $this->db->where('bl_blood_record.id >=', $filters['start_id']);
        }
        if (!empty($filters['end_id'])) {
            $this->db->where('bl_blood_record.id <=', $filters['end_id']);
        }
        if (!empty($filters['unit_from'])) {
            $this->db->where('bl_blood_record.unit_no >=', $filters['unit_from']);
        }
        if (!empty($filters['unit_to'])) {
            $this->db->where('bl_blood_record.unit_no <=', $filters['unit_to']);
        }
        // if (!empty($filters['request_from'])) {
        //     $this->db->where('bl_blood_record.request_date >=', $filters['request_from']);
        // }
        // if (!empty($filters['request_to'])) {
        //     $this->db->where('bl_blood_record.request_date <=', $filters['request_to']);
        // }
        if (!empty($filters['name'])) {
            $this->db->like('bl_agency.a_name', $filters['name']);
        }

        $this->db->order_by('bl_blood_record.id', 'desc');
        $this->db->group_by('bl_blood_record.donor_unit_no');
        $query = $this->db->get();
        $result = $query->result_array();
        $result1 = [];
        foreach ($result as $key => $value) {
            $rec = [];
            if ($value['donation_id'] != 0) {
                // Fetch donation form details
                $this->db->select('bl_bb_donatioform.*');
                $this->db->from('bl_bb_donatioform');
                
                $this->db->where('bl_bb_donatioform.bloodbank_id', $bank_id);
                $this->db->where('bl_bb_donatioform.id', $value['donation_id']);
                $query1 = $this->db->get();
                $rec = $query1->row_array();
                // Fetch related blood records
                $this->db->select('bl_blood_record.*,bl_qc_component.sterllty,bl_qc_component.factor_8_fibrinogen,bl_qc_component.platelet,bl_qc_component.pcv,bl_crossmatch.issue_no as c_issue_no');
                $this->db->from('bl_blood_record');
                $this->db->join('bl_crossmatch', 'bl_blood_record.crossmatch_no = bl_crossmatch.cross_match AND bl_crossmatch.bloodbank_id = \'$bank_id\'', 'LEFT');
                $this->db->join('bl_qc_component', 'bl_blood_record.unit_no = bl_qc_component.unit_no', 'LEFT');
                $this->db->where('bl_blood_record.donation_id', $value['donation_id']);
                $this->db->where('bl_blood_record.bag_config', "Mother");
                $this->db->order_by('bl_blood_record.id', 'asc');
                $query2 = $this->db->get();
                $rec['bloodRecord'] = $query2->result_array();

                $result1[] = $rec;
            } else {
                $data = [
                    "donor_type" => "Regular",
                    "wb"=>'',
                    "rep_request" => "",
                    "hemoglobin" => "",
                    "unit_no" => $value['unit_no'],
                    "mobile" => $value['phon'],
                    "donor_name" => $value['a_name'],
                    "father" => "",
                    "blood_group" => $value['blood_group'],
                    "age" => "",
                    "sex" => "",
                    "address" => $value['a_address'],
                    "donation_date" => $value['collection_date'],
                    "bag" => "--",
                    "tube" => $value['tube_no'],
                    "bp" => "",
                    "weight" => "",
                    "hct" => "",
                    "pet" => "",
                    "patient_name" => "",
                    "hospital" => "",
                    "registration_no" => "",
                    "hiv" => "",
                    "hbsag" => "",
                    "hcv" => "",
                    "vdrl" => "",
                    "malaria" => "",
                    "anti_hbc" => "",
                ];
                $rec = $data;
                $rec['bloodRecord'] = [$value];
                $result1[] = $rec;
            }
        }
        return $result1;
    }

    public function getDonationDetailstotal($bank_id, $filters = [])
    {
        $this->db->from('bl_blood_record');
        if($bank_id != 0){
            $this->db->where('bloodbank_id', $bank_id);
        }
         // Apply filters
        if (!empty($filters['start_date'])) {
            $this->db->where('bl_blood_record.collection_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_blood_record.collection_date <=', $filters['end_date']);
        }
        if (!empty($filters['start_id'])) {
            $this->db->where('bl_blood_record.id >=', $filters['start_id']);
        }
        if (!empty($filters['end_id'])) {
            $this->db->where('bl_blood_record.id <=', $filters['end_id']);
        }
        if (!empty($filters['unit_from'])) {
            $this->db->where('bl_blood_record.unit_no >=', $filters['unit_from']);
        }
        if (!empty($filters['unit_to'])) {
            $this->db->where('bl_blood_record.unit_no <=', $filters['unit_to']);
        }
        // if (!empty($filters['request_from'])) {
        //     $this->db->where('bl_blood_record.request_date >=', $filters['request_from']);
        // }
        // if (!empty($filters['request_to'])) {
        //     $this->db->where('bl_blood_record.request_date <=', $filters['request_to']);
        // }
        if (!empty($filters['name'])) {
            $this->db->like('bl_agency.a_name', $filters['name']);
        }

        $this->db->group_by('donor_unit_no');
        

        return $this->db->count_all_results();
    }

    //         Donor master records
    public function getDonorrecord($limit, $offset, $bank_id, $filters = [])
    {
        $this->db->select('bl_bb_donatioform.*,bl_donor_examination.examiner_id,bl_bloodbank_user.name as ex_name,bl_users.sign');
        $this->db->join('bl_donor_examination', 'bl_bb_donatioform.id = bl_donor_examination.donation_id', 'LEFT');
        $this->db->join('bl_users', 'bl_donor_examination.auth_id = bl_users.id', 'LEFT');
        $this->db->join('bl_bloodbank_user', 'bl_donor_examination.examiner_id = bl_bloodbank_user.id', 'LEFT');
         // Apply filters
        if (!empty($filters['start_date'])) {
            $this->db->where('bl_bb_donatioform.donation_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_bb_donatioform.donation_date <=', $filters['end_date']);
        }
        if (!empty($filters['start_id'])) {
            $this->db->where('bl_bb_donatioform.id >=', $filters['start_id']);
        }
        if (!empty($filters['end_id'])) {
            $this->db->where('bl_bb_donatioform.id <=', $filters['end_id']);
        }
        if (!empty($filters['name'])) {
            $this->db->like('bl_bb_donatioform.donor_name', $filters['name']);
        }
        
        $this->db->from('bl_bb_donatioform');
        $this->db->limit($limit, $offset); // Apply pagination limit and offset
        if($bank_id != 0){
            $this->db->where('bl_bb_donatioform.bloodbank_id', $bank_id);
        }
        $this->db->where('bl_bb_donatioform.status !=','Test Not Done');
        $this->db->order_by('bl_bb_donatioform.id', 'desc'); // Optional: Order by bl_bb_donatioform.id if needed
        $query = $this->db->get();
        $result = $query->result_array();
        foreach($result as &$row){
            $selectedFor = 'Donation';
            $DeferReason = '';
            
            if($row['hiv'] != '' && $row['hiv'] == 'Positive'){
               $selectedFor = 'Deffered'; 
               $DeferReason= 'TTI Test Positive';
            }
            if($row['hbsag'] != '' && $row['hbsag'] == 'Positive'){
               $selectedFor = 'Deffered'; 
               $DeferReason= 'TTI Test Positive';
            }
            if($row['hcv'] != '' && $row['hcv'] == 'Positive'){
               $selectedFor = 'Deffered'; 
               $DeferReason= 'TTI Test Positive';
            }
            if($row['vdrl'] != '' && $row['vdrl'] == 'Positive'){
               $selectedFor = 'Deffered'; 
               $DeferReason= 'TTI Test Positive';
            }
            if($row['malaria'] != '' && $row['malaria'] == 'Positive'){
               $selectedFor = 'Deffered'; 
               $DeferReason= 'TTI Test Positive';
            }
            $row['DeferReason'] = $DeferReason;
            $row['selectedFor'] = $selectedFor;
        }

        return $result;
    }
    public function getDonorrecordtotal($bank_id,$filters=[])
    {
        $this->db->from($this->table);
        if (!empty($filters['start_date'])) {
            $this->db->where('bl_bb_donatioform.donation_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_bb_donatioform.donation_date <=', $filters['end_date']);
        }
        if (!empty($filters['start_id'])) {
            $this->db->where('bl_bb_donatioform.id >=', $filters['start_id']);
        }
        if (!empty($filters['end_id'])) {
            $this->db->where('bl_bb_donatioform.id <=', $filters['end_id']);
        }
        if (!empty($filters['name'])) {
            $this->db->like('bl_bb_donatioform.donor_name', $filters['name']);
        }
        if($bank_id != 0){
        $this->db->where('bloodbank_id', $bank_id);
        }
        $this->db->where('bl_bb_donatioform.status !=','Test Not Done');
        
        return $this->db->count_all_results();
    }
    //         Request master records
    public function getreq_record($limit, $offset, $bank_id,$filters=[])
    {
        $this->db->select('bl_requestblood.*');
         if (!empty($filters['start_date'])) {
            $this->db->where('bl_requestblood.created_at >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_requestblood.created_at <=', $filters['end_date']);
        }
        if (!empty($filters['start_id'])) {
            $this->db->where('bl_requestblood.id >=', $filters['start_id']);
        }
        if (!empty($filters['end_id'])) {
            $this->db->where('bl_requestblood.id <=', $filters['end_id']);
        }
        if (!empty($filters['name'])) {
            $this->db->like('bl_requestblood.p_name', $filters['name']);
        }
        
        $this->db->from('bl_requestblood');
        $this->db->limit($limit, $offset); // Apply pagination limit and offset
        if($bank_id != 0){
            $this->db->where('bl_requestblood.bloodbank_id', $bank_id);
        }
        $this->db->order_by('bl_requestblood.id', 'desc'); // Optional: Order by bl_bb_donatioform.id if needed
        $query = $this->db->get();
        $result = $query->result_array();
        foreach($result as &$row){
            $this->db->select('bl_crossmatch.*');
            $this->db->from('bl_crossmatch');
            $this->db->where('bl_crossmatch.status','issued');
            $this->db->where('bl_crossmatch.request',$row['request']);
            $this->db->where('bl_crossmatch.bloodbank_id', $bank_id);
            $query = $this->db->get();
            $resultcross = $query->result_array();
            $row['cromatchdata'] = $resultcross;
        }

        return $result;
    }
    public function getreq_recordtotal($bank_id,$filters=[])
    {
        $this->db->from('bl_requestblood');
        // -----------------------
         if (!empty($filters['start_date'])) {
            $this->db->where('bl_requestblood.created_at >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_requestblood.created_at <=', $filters['end_date']);
        }
        if (!empty($filters['start_id'])) {
            $this->db->where('bl_requestblood.id >=', $filters['start_id']);
        }
        if (!empty($filters['end_id'])) {
            $this->db->where('bl_requestblood.id <=', $filters['end_id']);
        }
        if (!empty($filters['name'])) {
            $this->db->like('bl_requestblood.p_name', $filters['name']);
        }
        if($bank_id != 0){
        $this->db->where('bloodbank_id', $bank_id);
        }
        return $this->db->count_all_results();
    }
    //         TTI master records
    public function get_tti_record($limit, $offset, $bank_id,$filters=[])
    {
        $this->db->select('bl_bb_donatioform.*,bl_users.sign');
        $this->db->join('bl_users', 'bl_bb_donatioform.ttitest_by_id = bl_users.id', 'LEFT');
        $this->db->from('bl_bb_donatioform');
        $this->db->limit($limit, $offset); // Apply pagination limit and offset
        if($bank_id != 0){
        $this->db->where('bl_bb_donatioform.bloodbank_id', $bank_id);
        }
         // -----------------------
         if (!empty($filters['start_date'])) {
            $this->db->where('bl_bb_donatioform.donation_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_bb_donatioform.donation_date <=', $filters['end_date']);
        }
        if (!empty($filters['start_id'])) {
            $this->db->where('bl_bb_donatioform.id >=', $filters['start_id']);
        }
        if (!empty($filters['end_id'])) {
            $this->db->where('bl_bb_donatioform.id <=', $filters['end_id']);
        }
        
        // ---------
        $this->db->order_by('bl_bb_donatioform.id', 'desc'); // Optional: Order by bl_bb_donatioform.id if needed
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }
    public function get_tti_record_total($bank_id,$filters=[])
    {
        $this->db->from($this->table);
        if($bank_id != 0){
        $this->db->where('bloodbank_id', $bank_id);
        }
        // -----------------------
         if (!empty($filters['start_date'])) {
            $this->db->where('bl_bb_donatioform.donation_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_bb_donatioform.donation_date <=', $filters['end_date']);
        }
        if (!empty($filters['start_id'])) {
            $this->db->where('bl_bb_donatioform.id >=', $filters['start_id']);
        }
        if (!empty($filters['end_id'])) {
            $this->db->where('bl_bb_donatioform.id <=', $filters['end_id']);
        }
        
        // ---------
        return $this->db->count_all_results();
    }
    //         QCR master records
    public function get_qcr_record($limit, $offset, $bank_id,$filters=[])
    {
        $this->db->select('bl_qc_reagents.*');
        $this->db->from('bl_qc_reagents');
        $this->db->limit($limit, $offset); // Apply pagination limit and offset
        if($bank_id != 0){
        $this->db->where('bl_qc_reagents.bloodbank_id', $bank_id);
        }
        $this->db->order_by('bl_qc_reagents.id', 'desc');
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }
    public function get_qcr_record_total($bank_id,$filters=[])
    {
        $this->db->from('bl_qc_reagents');
        if($bank_id != 0){
        $this->db->where('bloodbank_id', $bank_id);
        }
        return $this->db->count_all_results();
    }
    //         Return master records
    public function get_return_record($limit, $offset, $bank_id,$filters=[])
    {
        $this->db->select('bl_crossmatch.*');
        $this->db->from('bl_crossmatch');
        $this->db->limit($limit, $offset); // Apply pagination limit and offset
        if($bank_id != 0){
        $this->db->where('bl_crossmatch.bloodbank_id', $bank_id);
        }
        $this->db->where('bl_crossmatch.status', 'return');
        // -----------------------
         if (!empty($filters['start_date'])) {
            $this->db->where('bl_crossmatch.crossmatch_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_crossmatch.crossmatch_date <=', $filters['end_date']);
        }
        if (!empty($filters['start_id'])) {
            $this->db->where('bl_crossmatch.id >=', $filters['start_id']);
        }
        if (!empty($filters['end_id'])) {
            $this->db->where('bl_crossmatch.id <=', $filters['end_id']);
        }
        if (!empty($filters['req_no'])) {
            $this->db->where('bl_crossmatch.request <=', $filters['req_no']);
        }
        if (!empty($filters['res'])) {
            $this->db->like('bl_crossmatch.reason_return', $filters['res']);
        }
        $this->db->order_by('bl_crossmatch.id', 'desc');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_return_record_total($bank_id,$filters=[])
    {
        $this->db->from('bl_crossmatch');
        if($bank_id != 0){
        $this->db->where('bloodbank_id', $bank_id);
        }
        $this->db->where('bl_crossmatch.status', 'return');
          // -----------------------
         if (!empty($filters['start_date'])) {
            $this->db->where('bl_crossmatch.crossmatch_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_crossmatch.crossmatch_date <=', $filters['end_date']);
        }
        if (!empty($filters['start_id'])) {
            $this->db->where('bl_crossmatch.id >=', $filters['start_id']);
        }
        if (!empty($filters['end_id'])) {
            $this->db->where('bl_crossmatch.id <=', $filters['end_id']);
        }
        if (!empty($filters['req_no'])) {
            $this->db->where('bl_crossmatch.request <=', $filters['req_no']);
        }
        if (!empty($filters['res'])) {
            $this->db->like('bl_crossmatch.reason_return', $filters['res']);
        }
        return $this->db->count_all_results();
    }
    //         Issue  master records
    public function get_issue_record($limit, $offset, $bank_id,$filters=[])
    {
        $this->db->select('bl_crossmatch.*');
        $this->db->from('bl_crossmatch');
        $this->db->limit($limit, $offset); // Apply pagination limit and offset
        if($bank_id != 0){
        $this->db->where('bl_crossmatch.bloodbank_id', $bank_id);
        }
        $this->db->where('bl_crossmatch.status', 'issued');
        // Apply filters
        if (!empty($filters['start_date'])) {
            $this->db->where('bl_crossmatch.issue_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_crossmatch.issue_date <=', $filters['end_date']);
        }
        if (!empty($filters['start_id'])) {
            $this->db->where('bl_crossmatch.id >=', $filters['start_id']);
        }
        if (!empty($filters['end_id'])) {
            $this->db->where('bl_crossmatch.id <=', $filters['end_id']);
        }
        // $this->db->order_by('bl_crossmatch.id', 'desc');
        $this->db->order_by('bl_crossmatch.issue_date', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_issue_record_total($bank_id,$filters=[])
    {
        $this->db->from('bl_crossmatch');
        if($bank_id != 0){
        $this->db->where('bloodbank_id', $bank_id);
        }
        $this->db->where('bl_crossmatch.status', 'issued');
         if (!empty($filters['start_date'])) {
            $this->db->where('bl_crossmatch.issue_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_crossmatch.issue_date <=', $filters['end_date']);
        }
        if (!empty($filters['start_id'])) {
            $this->db->where('bl_crossmatch.id >=', $filters['start_id']);
        }
        if (!empty($filters['end_id'])) {
            $this->db->where('bl_crossmatch.id <=', $filters['end_id']);
        }
        return $this->db->count_all_results();
    }
    //         consumble  master records
    public function get_consumble_record($limit, $offset, $bank_id,$filters=[])
    {
        $this->db->select('bl_consumable.*');
        $this->db->from('bl_consumable');
        $this->db->limit($limit, $offset); // Apply pagination limit and offset
        if($bank_id != 0){
        $this->db->where('bl_consumable.bloodbank_id', $bank_id);
        }
        $this->db->order_by('bl_consumable.id', 'desc');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_consumble_record_total($bank_id,$filters=[])
    {
        $this->db->from('bl_consumable');
        if($bank_id != 0){
        $this->db->where('bloodbank_id', $bank_id);
        }
        return $this->db->count_all_results();
    }
    //         Component  master records
    public function get_comp_record($limit, $offset, $bank_id,$filters=[])
    {
        $this->db->select('bl_qc_component.platelet,bl_qc_component.pcv,bl_qc_component.frbrinogen,bl_blood_record.*,bl_bb_donatioform.bag,bl_users.sign,
        bl_bb_donatioform.donation_date as d_d ,,bl_bb_donatioform.time as d_time');
        $this->db->join('bl_bb_donatioform', 'bl_bb_donatioform.id = bl_blood_record.donation_id', 'LEFT');
        $this->db->join('bl_users', 'bl_bb_donatioform.component_user_id = bl_users.id', 'LEFT');
        $this->db->join('bl_qc_component', 'bl_qc_component.unit_no = bl_blood_record.unit_no', 'LEFT');
        $this->db->from('bl_blood_record');
        $this->db->limit($limit, $offset); // Apply pagination limit and offset
        if($bank_id != 0){
        $this->db->where('bl_blood_record.bloodbank_id', $bank_id);
        }
        $this->db->order_by('bl_blood_record.id', 'desc');
        $this->db->group_by('bl_blood_record.donor_unit_no');
        // $this->db->group_by("TRIM(UPPER(bl_blood_record.donor_unit_no))");
        $query = $this->db->get();
        $results = $query->result_array();
        // echo $query->num_rows(); die();
        $result = array();
        foreach($results as &$res){
            
            $this->db->select('bl_crossmatch.final_cross,bl_bb_donatioform.component_user as iss_by,bl_bb_donatioform.patient_name as p_name,bl_users.sign,
            bl_bb_donatioform.patient_requestno as req,bl_qc_component.platelet,bl_qc_component.pcv,bl_qc_component.frbrinogen,bl_blood_record.*,
            bl_bb_donatioform.bag,bl_bb_donatioform.donation_date as d_d ,bl_bb_donatioform.time as d_time');
            $this->db->join('bl_bb_donatioform', 'bl_bb_donatioform.id = bl_blood_record.donation_id', 'LEFT');
            $this->db->join('bl_users', 'bl_bb_donatioform.component_user_id = bl_users.id', 'LEFT');
            $this->db->join('bl_qc_component', 'bl_qc_component.unit_no = bl_blood_record.unit_no', 'LEFT');
            $this->db->join('bl_crossmatch', 'bl_crossmatch.cross_match = bl_blood_record.crossmatch_no AND bl_crossmatch.bloodbank_id = \'$bank_id\'', 'LEFT');
            $this->db->from('bl_blood_record');
            $this->db->where('bl_blood_record.donor_unit_no', $res['donor_unit_no']);
            $this->db->where('bl_blood_record.bloodbank_id', $bank_id);
            $this->db->order_by('bl_blood_record.id', 'desc');
            $query = $this->db->get();
            if($query->num_rows() > 0 ){
            $res_data = $query->result_array();
            
            $result[] = $res_data;
            }else{
                $extbank = [
                    
                    ];
             $result[] =  $extbank;  
            }
        }
        return $result;
    }
    public function get_comp_record_total($bank_id,$filters=[])
    {
        $this->db->from('bl_blood_record');
        if($bank_id != 0){
        $this->db->where('bloodbank_id', $bank_id);
        }
        $this->db->group_by('bl_blood_record.donor_unit_no');
        return $this->db->count_all_results();
    }
    //         Register for Diagnostic Kits & Reagents Used  master records
    public function get_reg_dia_reag($limit, $offset, $bank_id,$filters=[])
    {
        $this->db->select('bl_consumable.*');
        $this->db->from('bl_consumable');
        $this->db->limit($limit, $offset); // Apply pagination limit and offset
        if($bank_id != 0){
        $this->db->where('bl_consumable.bloodbank_id', $bank_id);
        }
        $this->db->order_by('bl_consumable.id', 'desc');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_reg_dia_reag_total($bank_id,$filters=[])
    {
        $this->db->from('bl_consumable');
        if($bank_id != 0){
        $this->db->where('bloodbank_id', $bank_id);
        }
        return $this->db->count_all_results();
    }
    //      Blood Grouping Record  master records
    public function get_bb_rec($limit, $offset, $bank_id,$filters=[])
    {
        $this->db->select('bl_blood_group.*,bl_bb_donatioform.donor_name');
        $this->db->from('bl_blood_group');
        $this->db->join('bl_bb_donatioform', 'bl_bb_donatioform.id = bl_blood_group.donor_id');
        $this->db->limit($limit, $offset); // Apply pagination limit and offset
        if($bank_id != 0){
        $this->db->where('bl_blood_group.bloodbank_id', $bank_id);
        }
        $this->db->order_by('bl_blood_group.id', 'desc');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function get_bb_rec_total($bank_id,$filters=[])
    {
        $this->db->from('bl_blood_group');
        if($bank_id != 0){
        $this->db->where('bloodbank_id', $bank_id);
        }
        return $this->db->count_all_results();
    }
    //      Discard master records
    public function get_discard_rec($limit, $offset, $bank_id,$filters=[])
    {
        $this->db->select('bl_discard.*,bl_users.sign as dsign,bl_bb_donatioform.unit_no as dunitno,bl_bb_donatioform.blood_group as blood_group,bl_blood_record.component as com_p, bl_crossmatch.component as comp, bl_blood_record.unit_no as unit_no, bl_crossmatch.unit_no as unitno, bl_blood_record.blood_group as b_g, bl_crossmatch.groups as bg');
        $this->db->from('bl_discard');
        $this->db->where('bl_discard.bloodbank_id', $_SESSION['bank_id']);
        $this->db->join('bl_crossmatch', 'bl_crossmatch.id = bl_discard.type_id AND bl_discard.type = "3"', 'left'); 
        $this->db->join('bl_blood_record', 'bl_blood_record.id = bl_discard.type_id AND bl_discard.type = "2"', 'left'); 
        $this->db->join('bl_bb_donatioform', 'bl_bb_donatioform.id = bl_discard.type_id AND bl_discard.type = "1"', 'left');
        // --------sign bl_bb_donatioform-----------------
        $this->db->join('bl_users', 'bl_discard.discard_by_id = bl_users.id','LEFT');
        // --------sign bl_blood_record-----------------
        // $this->db->join('bl_donor_examination as r_table', 'bl_blood_record.donation_id = r_table.donation_id AND bl_discard.type = "2"', 'LEFT');
        // $this->db->join('bl_users as bluser', 'r_table.auth_id = bluser.id AND bl_discard.type = "2"', 'LEFT');
        // $this->db->join('bl_bloodbank_user as bl_bloodbank_user_2', 'r_table.examiner_id = bl_bloodbank_user_2.id AND bl_discard.type = "2"', 'LEFT');
        // // --------sign bl_crossmatch-----------------
        // $this->db->join('bl_blood_record as cr_table', 'bl_crossmatch.cross_match = bl_blood_record.crossmatch_no AND bl_discard.type = "3"', 'LEFT');
        // $this->db->join('bl_donor_examination as c_table', 'cr_table.donation_id = c_table.donation_id AND bl_discard.type = "3"', 'LEFT');
        // $this->db->join('bl_users as bluserc', 'c_table.auth_id = bluserc.id AND bl_discard.type = "2"', 'LEFT');
        // $this->db->join('bl_bloodbank_user as bl_bloodbank_user_3', 'c_table.examiner_id = bl_bloodbank_user_3.id AND bl_discard.type = "3"', 'LEFT');
        // -------------------------------------
        if (!empty($filters['start_date'])) {
            $this->db->where('bl_discard.donation_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_discard.donation_date <=', $filters['end_date']);
        }
        if (!empty($filters['start_id'])) {
            $this->db->where('bl_discard.id >=', $filters['start_id']);
        }
        if (!empty($filters['end_id'])) {
            $this->db->where('bl_discard.id <=', $filters['end_id']);
        }
        if (!empty($filters['reason'])) {
            $this->db->like('bl_discard.discard_res', $filters['reason']);
        }
        if (!empty($filters['auto_clave'])) {
            $this->db->like('bl_discard.autoclaved', $filters['auto_clave']);
        }
        $this->db->order_by('bl_discard.id', 'desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }


    public function get_discard_rec_total($bank_id,$filters=[])
    {
        $this->db->from('bl_discard');
        if($bank_id != 0){
        $this->db->where('bloodbank_id', $bank_id);
        }
        // -------------------------------------
        if (!empty($filters['start_date'])) {
            $this->db->where('bl_discard.donation_date >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('bl_discard.donation_date <=', $filters['end_date']);
        }
        if (!empty($filters['start_id'])) {
            $this->db->where('bl_discard.id >=', $filters['start_id']);
        }
        if (!empty($filters['end_id'])) {
            $this->db->where('bl_discard.id <=', $filters['end_id']);
        }
        if (!empty($filters['reason'])) {
            $this->db->like('bl_discard.discard_res', $filters['reason']);
        }
        if (!empty($filters['auto_clave'])) {
            $this->db->like('bl_discard.autoclaved', $filters['auto_clave']);
        }
        return $this->db->count_all_results();
    }
}
