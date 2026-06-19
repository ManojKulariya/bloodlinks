<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminDonarRegister extends CI_Model
{
    protected $table = 'bl_bb_donatioform';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 #=========================
    
    // Define the method to get bl_bb_donatioform and related blood_records with pagination
    public function getDonationDetails($limit, $offset, $filters = [])
    {
        $this->db->select('bl_blood_record.*,bl_qc_component.sterllty,bl_qc_component.factor_8_fibrinogen,bl_qc_component.platelet,bl_qc_component.pcv,bl_agency.phon,bl_crossmatch.issue_no as c_issue_no,bl_agency.a_name,bl_agency.address as a_address');
        $this->db->join('bl_agency', 'bl_blood_record.blood_from_bank = bl_agency.id', 'LEFT');
        $this->db->join('bl_crossmatch', 'bl_blood_record.crossmatch_no = bl_crossmatch.cross_match AND bl_crossmatch.bloodbank_id = bl_blood_record.bloodbank_id', 'LEFT');

        $this->db->join('bl_qc_component', 'bl_blood_record.unit_no = bl_qc_component.unit_no', 'LEFT');
        $this->db->from('bl_blood_record');
        $this->db->limit($limit, $offset);
       
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
                
                $this->db->where('bl_bb_donatioform.id', $value['donation_id']);
                $query1 = $this->db->get();
                $rec = $query1->row_array();
                // Fetch related blood records
                $this->db->select('bl_blood_record.*,bl_qc_component.sterllty,bl_qc_component.factor_8_fibrinogen,bl_qc_component.platelet,bl_qc_component.pcv,bl_crossmatch.issue_no as c_issue_no');
                $this->db->from('bl_blood_record');
                $this->db->join('bl_crossmatch', 'bl_blood_record.crossmatch_no = bl_crossmatch.cross_match AND bl_crossmatch.bloodbank_id = bl_blood_record.bloodbank_id', 'LEFT');
                $this->db->join('bl_qc_component', 'bl_blood_record.unit_no = bl_qc_component.unit_no', 'LEFT');
                $this->db->where('bl_blood_record.donation_id', $value['donation_id']);
                $this->db->where('bl_blood_record.bag_config', "Mother");
                $this->db->order_by('bl_blood_record.id', 'asc');
                $query2 = $this->db->get();
                $rec['bloodRecord'] = $query2->result_array();

                $result1[] = $rec;
            } else {
                $data = [
                    'bloodbank_id'=> $value['bloodbank_id'],
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

    public function getDonationDetailstotal($filters = [])
    {
        $this->db->select('bl_blood_record.id as record_id');
        $this->db->from('bl_blood_record');
        
        $this->db->join('bl_agency', 'bl_blood_record.blood_from_bank = bl_agency.id', 'LEFT');
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
        
        if (!empty($filters['name'])) {
            $this->db->like('bl_agency.a_name', $filters['name']);
        }

        $this->db->group_by('donor_unit_no');

        return $this->db->count_all_results();
    }
    public function getDonorrecordtotal($filters=[])
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
       
        $this->db->where('bl_bb_donatioform.status !=','Test Not Done');
        
        return $this->db->count_all_results();
    }
    public function getDonorrecord($limit, $offset, $filters = [])
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

  
}
