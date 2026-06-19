<?php defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class User_model extends BaseModel
{


    
    public function get_user($param=array(),$type='1',$return_query=FALSE){

        if($type=='1'){
            $this->db->select('users.*');
        }else if($type=='3'){
            $this->db->select('users.*,customers.*');
            $this->db->join('customers','customers.user_id=users.id','LEFT');
        }
        else if($type=='5'){
            $this->db->select('users.*,blood_banks.*');
            $this->db->join('blood_banks','blood_banks.user_id=users.id','LEFT');
        }else if($type=='6'){
            $this->db->select('users.*,hospitals.*');
            $this->db->join('hospitals','hospitals.user_id=users.id','LEFT');
        }
        

        $this->db->where($param);
        
        $query = $this->db->get('users');

        if($return_query==FALSE){
            return $query->first_row();
        }else if($return_query==TRUE){
            return $this->db->last_query();
        }   
    }
     public function _get_bb_inv_hp($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
        $txt = "No";
        $current_date = date('Y-m-d'); 
        $userLat = isset($post['lat']) ? $post['lat'] : 28.6139;   // fallback: Delhi
        $userLng = isset($post['lng']) ? $post['lng'] : 77.2090;
        // $this->db->select('bl_blood_banks.blood_bank_id, bl_blood_banks.short_name, 
        //     SUM(CASE WHEN component IN (18, "wholeblood") THEN 1 ELSE 0 END) AS whole_blood_unit_count,
        //     SUM(CASE WHEN component = 20 THEN 1 ELSE 0 END) AS Fresh_Frozen_Plasma_unit_count,
        //     SUM(CASE WHEN component IN (21,886) THEN 1 ELSE 0 END) AS Red_blood_cell_unit_count,
        //     SUM(CASE WHEN component = 22 THEN 1 ELSE 0 END) AS Platelet_rich_concentrate_unit_count,
        //     SUM( CASE WHEN component = "wholeblood" THEN 1 ELSE 0 END + 
        //          CASE WHEN component = 18 THEN 1 ELSE 0 END +
        //          CASE WHEN component = 20 THEN 1 ELSE 0 END +
        //          CASE WHEN component = 21 THEN 1 ELSE 0 END + 
        //          CASE WHEN component =886 THEN 1 ELSE 0 END + 
        //          CASE WHEN component = 22 THEN 1 ELSE 0 END
        //     ) AS total_component_count');
        // Add distance calculation in SELECT
        $this->db->select("bl_blood_banks.blood_bank_id, bl_blood_banks.short_name,
            SUM(CASE WHEN component IN (18, 'wholeblood') THEN 1 ELSE 0 END) AS whole_blood_unit_count,
            SUM(CASE WHEN component = 20 THEN 1 ELSE 0 END) AS Fresh_Frozen_Plasma_unit_count,
            SUM(CASE WHEN component IN (21,886) THEN 1 ELSE 0 END) AS Red_blood_cell_unit_count,
            SUM(CASE WHEN component = 22 THEN 1 ELSE 0 END) AS Platelet_rich_concentrate_unit_count,
            SUM(
                CASE WHEN component = 'wholeblood' THEN 1 ELSE 0 END + 
                CASE WHEN component = 18 THEN 1 ELSE 0 END +
                CASE WHEN component = 20 THEN 1 ELSE 0 END +
                CASE WHEN component = 21 THEN 1 ELSE 0 END + 
                CASE WHEN component = 886 THEN 1 ELSE 0 END + 
                CASE WHEN component = 22 THEN 1 ELSE 0 END
            ) AS total_component_count,
        
            -- Haversine formula for distance (in KM)
            ( 6371 * acos(
                cos(radians(".$userLat.")) * cos(radians(latitude)) * cos(radians(longitude) - radians(".$userLng."))
                + sin(radians(".$userLat.")) * sin(radians(latitude))
            )) AS distance_km
        ");
        $this->db->where_In('bl_blood_record.component',[18,20,21,22,886,'wholeblood']);

            if(empty($post['start_date']) || empty($post['end_date'])) {
                $days_filter = $post['days_filter'];
                if($days_filter == 0) {
                    $this->db->join('bl_blood_record', 'bl_blood_banks.blood_bank_id = bl_blood_record.bloodbank_id
                    AND bl_blood_record.cross_match = "'.$txt.'" 
                    AND DATE(bl_blood_record.expiry_date) > "' . $current_date . '" 
                    AND bl_blood_record.status IS NULL AND 
                    DATE(bl_blood_record.created_at) = "' . $current_date . '"', 'left');
    
                } else {  
                    $this->db->join('bl_blood_record', 'bl_blood_banks.blood_bank_id = bl_blood_record.bloodbank_id
                    AND bl_blood_record.cross_match = "'.$txt.'" AND bl_blood_record.status IS NULL 
                    AND DATE(bl_blood_record.expiry_date) > "' . $current_date . '" 
                    AND bl_blood_record.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"', 'left');
                 } 
            }
            if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
                $start_date = date('Y-m-d', strtotime($post['start_date']));
                $end_date = date('Y-m-d', strtotime($post['end_date']));
                $this->db->join('bl_blood_record', 'bl_blood_banks.blood_bank_id = bl_blood_record.bloodbank_id
                AND bl_blood_record.issue_status = "'.$txt.'" AND bl_blood_record.status IS NULL 
                AND DATE(bl_blood_record.expiry_date) > "' . $current_date . '" 
                AND bl_blood_record.created_at >= "'.$start_date.'"  AND bl_blood_record.created_at <= "'.$end_date.'"', 'left');
            } 
            $this->db->group_by('bl_blood_banks.blood_bank_id');
            if($_SESSION['admin_type'] == 5){
                $B_id = $_SESSION['bank_id'];
                $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }else{
                
                if(isset($post['bb_over']) && $post['bb_over'] != ""){
                  $this->db->where('bl_blood_banks.blood_bank_id = "' . $post['bb_over'] . '"');  
                }
            }
            $this->db->where('bl_blood_banks.org_type', 'Blood Bank');
        // $this->db->order_by('whole_blood_unit_count', 'DESC');
        // $this->db->order_by('Fresh_Frozen_Plasma_unit_count', 'DESC');
        // $this->db->order_by('Red_blood_cell_unit_count', 'DESC');
        // $this->db->order_by('Platelet_rich_concentrate_unit_count', 'DESC');
        $this->db->order_by('distance_km', 'ASC');
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function get_lat_long_by_id($id)
    {
        $this->db->select('latitude,longitude');
        $this->db->from('bl_hospital_onboard');
        $this->db->where('user_id', $id);
        $query = $this->db->get();

        return $query->row_array(); // returns ['latitude' => ..., 'longitude' => ...]
    }


    public function store_blood_bank_data($data,$return_query=FALSE){
        $this->table='blood_banks';
        return $this->store($data,FALSE,$return_query);
    }

    public function update_blood_bank_data($data,$param,$batch=FALSE,$return_query=FALSE){
        $this->table='blood_banks';
        return $this->modify($data,$param,$batch,$return_query);
    }

    public function delete_blood_bank_datas($param,$return_query=FALSE){
        $this->table='blood_banks';
        return $this->remove($param,0,$return_query);
    }

    public function store_hospital_data($data,$return_query=FALSE){
        $this->table='hospitals';
        return $this->store($data,FALSE,$return_query);
    }

    public function update_hospital_data($data,$param,$batch=FALSE,$return_query=FALSE){
        $this->table='hospitals';
        return $this->modify($data,$param,$batch,$return_query);
    }

    public function delete_hospital_datas($param,$return_query=FALSE){
        $this->table='hospitals';
        return $this->remove($param,0,$return_query);
    }
    public function store_lab_data($data,$return_query=FALSE){
        $this->table='labs';
        return $this->store($data,FALSE,$return_query);
    }

    public function update_lab_data($data,$param,$batch=FALSE,$return_query=FALSE){
        $this->table='labs';
        return $this->modify($data,$param,$batch,$return_query);
    }

    public function delete_lab_datas($param,$return_query=FALSE){
        $this->table='labs';
        return $this->remove($param,0,$return_query);
    }

    public function store_users($data,$return_query=FALSE){
        $this->table='users';
        return $this->store($data,FALSE,$return_query);
    }

    public function update_users($data,$param,$batch=FALSE,$return_query=FALSE){
        $this->table='users';
        return $this->modify($data,$param,$batch,$return_query);
    }

    public function delete_users($param,$return_query=FALSE){
        $this->table='users';
        return $this->remove($param,0,$return_query);
    }

    public function _get_user($param,$single_row=TRUE,$return_query=FALSE){
        $this->table='users';
        if($single_row==TRUE){
            return $this->get_one($param,'',$return_query);
        }else if($single_row==FALSE){
            return $this->get_many($param,null,null,$return_query);
        }       
    }

    public function get_duplicate_user($param=array(),$param_or=array(),$group_field=null,$field=null,$return_query=FALSE){
        $this->table='users';
        return $this->um->_get_duplicates($param,$param_or,$group_field,$field,$return_query);
    }

    public function get_duplicate_blood_banks_data($param=array(),$param_or=array(),$group_field=null,$field=null,$return_query=FALSE){
        $this->table='blood_banks';
        return $this->um->_get_duplicates($param,$param_or,$group_field,$field,$return_query);
    }
 public function get_duplicate_hospital_data($param=array(),$param_or=array(),$group_field=null,$field=null,$return_query=FALSE){
        $this->table='hospital';
        return $this->um->_get_duplicates($param,$param_or,$group_field,$field,$return_query);
    }

    //Customers
    public function store_customers($data,$return_query=FALSE){
        $this->table='customers';
        return $this->store($data,FALSE,$return_query);
    }

    public function update_customers($data,$param,$batch=FALSE,$return_query=FALSE){
        $this->table='customers';
        return $this->modify($data,$param,$batch,$return_query);
    }

    public function delete_customerss($param,$return_query=FALSE){
        $this->table='customers';
        return $this->remove($param,0,$return_query);
    }

    public function _get_customers($param,$single_row=TRUE,$return_query=FALSE){
        $this->table='customers';
        if($single_row==TRUE){
            return $this->get_one($param,'',$return_query);
        }else if($single_row==FALSE){
            return $this->get_many($param,null,null,$return_query);
        }       
    }

    public function get_duplicate_customers($param=array(),$param_or=array(),$group_field=null,$field=null,$return_query=FALSE){
        $this->table='customers';
        return $this->um->_get_duplicates($param,$param_or,$group_field,$field,$return_query);
    }
    public function _search_hp_stock_handover($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
        
        $hospital_id = session_userdata('customer_id');
        $current_date = date('Y-m-d');
        // $start_date = date('Y-m-d', strtotime($post['start_date']));
        // $end_date = date('Y-m-d', strtotime($post['end_date']));
        
        $this->db->select('bl_crossmatch.*, bl_masters.master_type_key_short_value,bb.name as bb_name,
                        inq.is_rec,inq.res_by,inq.status inq_status,inq.dis_res,inq.dis_date,inq.dis_no,inq.dis_by');
        $this->db->from('bl_crossmatch');
        $this->db->join('bl_masters', 'bl_masters.master_id = bl_crossmatch.component');
        $this->db->join('bl_blood_banks bb', 'bb.blood_bank_id = bl_crossmatch.bloodbank_id', 'left');
        $this->db->join('bl_issuedblood_inq inq', 'inq.cros_id = bl_crossmatch.id');
        
        // ✅ NEW: Exclude already handed over
        $this->db->where("bl_crossmatch.id NOT IN (SELECT cros_id FROM bl_stock_handover WHERE status = 'BMW' AND hp_id = {$hospital_id})");

        
        $this->db->where('bl_masters.master_type_name', 'Components Types');
        $this->db->where('bl_crossmatch.status', 'issued');
        $this->db->where('inq.status', 'Discard');
        $this->db->order_by('bl_crossmatch.id', 'DESC');
        $this->db->where('bl_crossmatch.hospital_id', $hospital_id);
        // $this->db->where('DATE(bl_crossmatch.issue_date) >=', $start_date);
        // $this->db->where('DATE(bl_crossmatch.issue_date) <=', $end_date);
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
             $query = $this->db->get();  
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
        
             $query = $this->db->get();  
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _get_hp_blood_stock_overview($post = array(), $param = array(), $count = FALSE, $return_query = FALSE) {
        $this->db->select('bl_stock_handover.*,bl_bmw_users.name as a_name');
        $this->db->join('bl_bmw_users', 'bl_stock_handover.bmw_id = bl_bmw_users.id');
        $this->db->join('bl_hospital_onboard', 'bl_stock_handover.hp_id = bl_hospital_onboard.user_id');
        $this->db->where('bl_stock_handover.status', $post['status']);
        if(isset($post['hp_id'])){
            $this->db->where('bl_hospital_onboard.user_id', $post['hp_id']);
        }
        
        
        // Execute query
        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }
            $query = $this->db->get('bl_stock_handover');
            if ($return_query == FALSE) {
                return $query->result();
            } else {
                return $this->db->last_query();
            }
        } else {
            $query = $this->db->get('bl_stock_handover');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else {
                return $this->db->last_query();
            }
        }
    }
    

    public function _get_hp_blood_stock_overview_bmw($post = array(), $param = array(), $count = FALSE, $return_query = FALSE) {
        
        // $this->db->select('bl_stock_handover.*,bl_hospital_onboard.name as a_name');
        // $this->db->join('bl_hospital_onboard', 'bl_stock_handover.hp_id = bl_hospital_onboard.user_id');
        $this->db->select('bl_stock_handover.*');

    // If hospital request (hp_id)
    $this->db->select('bl_hospital_onboard.name as hospital_name');
    $this->db->join('bl_hospital_onboard', 'bl_stock_handover.hp_id = bl_hospital_onboard.user_id', 'left');

    // If blood bank request (bb_id)
    $this->db->select('bl_blood_banks.name as bloodbank_name,
                       bl_stock_handover.cros_id,
                       bl_stock_handover.blood_record_id,
                       bl_stock_handover.donatioform_id');
    $this->db->join('bl_blood_banks', 'bl_stock_handover.bb_id = bl_blood_banks.blood_bank_id', 'left');

        $this->db->where('bl_stock_handover.status', $post['status']);
       
        if(isset($post['bmw_id'])){
            $this->db->where('bl_stock_handover.bmw_id', $post['bmw_id']);
        }
        
        // Execute query
        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }
            $query = $this->db->get('bl_stock_handover');
            if ($return_query == FALSE) {
                return $query->result();
            } else {
                return $this->db->last_query();
            }
        } else {
            $query = $this->db->get('bl_stock_handover');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else {
                return $this->db->last_query();
            }
        }
    }
    
    //Roles
    public function get_user_roles($param,$single_row=TRUE,$return_query=FALSE){
        $this->table='roles';
        if($single_row==TRUE){
            return $this->get_one($param,'',$return_query);
        }else if($single_row==FALSE){
            return $this->get_many($param,null,null,$return_query);
        }       
    }



    //labs
    public function _get_labs($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){
             $type= 'Lab';
        $this->db->select('blood_banks.*,users.*,states.state_name,cities.city_name,districts.district_name');
        $this->db->join('users','blood_banks.user_id=users.id','LEFT');
        $this->db->join('states','blood_banks.state_id=states.id','LEFT');
        $this->db->join('cities','blood_banks.city_id=cities.id','LEFT');
        $this->db->join('districts','blood_banks.district_id=districts.id','LEFT');
        $this->db->where('blood_banks.org_type', $type);

        $i = 0;

        if(isset($param['state_id'])){
            $this->db->where('state_id',$param['state_id']);
        }

        if(isset($param['city_id'])){
            $this->db->where('city_id',$param['city_id']);
        }

        if(isset($param['column_search'])){
            foreach ($param['column_search'] as $item)
            {
                if(isset($post['search']['value']) && $post['search']['value'])
                {
                    
                    if($i===0)
                    {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if(count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }
                
                $i++;
            }
        }

            
        if(isset($post['order']))
        {
            $column_order=$param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } 
        else if(isset($param['order']))
        {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if($count==FALSE){
            if(isset($post['length']) && $post['length'] != -1){
                $this->db->limit($post['length'],$post['start']);   
            }
            
            $query = $this->db->get('blood_banks');

            if($return_query==FALSE){
                return $query->result();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }       
            
        }else if($count==TRUE){
            $query = $this->db->get('blood_banks');
            if($return_query==FALSE){
                return $query->num_rows();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }           
        }
    }
    public function _get_bb_detail($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
      
        $current_date = date('Y-m-d'); 
        
        $this->db->select('bl_blood_banks.blood_bank_id, bl_blood_banks.short_name, bl_blood_banks.short_name, 
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "A+" THEN 1 ELSE 0 END) AS A_pos,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "B+" THEN 1 ELSE 0 END) AS B_pos,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "A-" THEN 1 ELSE 0 END) AS A_neg,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "B-" THEN 1 ELSE 0 END) AS B_neg,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "AB+" THEN 1 ELSE 0 END) AS AB_pos,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "AB-" THEN 1 ELSE 0 END) AS AB_neg,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "O+" THEN 1 ELSE 0 END) AS O_pos,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "O-" THEN 1 ELSE 0 END) AS O_neg,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "A+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "B+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "A-" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "B-" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "AB+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "AB-" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "O+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "O-" THEN 1 ELSE 0 END) AS total_count');

        $this->db->where('bl_blood_banks.org_type','Blood Bank');
   
        if(empty($post['start_date']) || empty($post['end_date'])) {
            $days_filter = $post['days_filter'];
            if($days_filter == 0) {
                $this->db->join('bl_bb_donatioform', 'bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id
                 AND DATE(bl_bb_donatioform.created_at) = "'.$current_date.'"', 'left');

            } else {
                
                $this->db->join('bl_bb_donatioform', 'bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id 
                AND bl_bb_donatioform.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"', 'left');
             } 
        }
    
        if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->join('bl_bb_donatioform', 'bl_blood_banks.blood_bank_id = 
                bl_bb_donatioform.bloodbank_id AND bl_bb_donatioform.created_at >= "'.$start_date.'" 
                AND bl_bb_donatioform.created_at <= "'.$end_date.'"', 'left');  
           
        }     
        $this->db->group_by('bl_blood_banks.blood_bank_id');
        if($_SESSION['admin_type'] == 5){
            $B_id = $_SESSION['bank_id'];
            $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }
        $this->db->order_by('A_pos', 'DESC');
        $this->db->order_by('B_pos', 'DESC');
        $this->db->order_by('A_neg', 'DESC');
        $this->db->order_by('B_neg', 'DESC');
        $this->db->order_by('AB_pos', 'DESC');
        $this->db->order_by('AB_neg', 'DESC');
        $this->db->order_by('O_pos', 'DESC');
        $this->db->order_by('O_neg', 'DESC');
    
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _get_bb_excel_deffer($post=array()) {
      
        $current_date = date('Y-m-d'); 
        $this->db->select('bl_blood_banks.short_name, bl_blood_banks.short_name, 
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "A+" THEN 1 ELSE 0 END) AS A_pos,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "B+" THEN 1 ELSE 0 END) AS B_pos,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "A-" THEN 1 ELSE 0 END) AS A_neg,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "B-" THEN 1 ELSE 0 END) AS B_neg,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "AB+" THEN 1 ELSE 0 END) AS AB_pos,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "AB-" THEN 1 ELSE 0 END) AS AB_neg,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "O+" THEN 1 ELSE 0 END) AS O_pos,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "O-" THEN 1 ELSE 0 END) AS O_neg,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "A+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "B+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "A-" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "B-" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "AB+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "AB-" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "O+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "O-" THEN 1 ELSE 0 END) AS total_count');

        $this->db->where('bl_blood_banks.org_type','Blood Bank');
   
        if(empty($post['start_date']) || empty($post['end_date'])) {
            $days_filter = $post['days_filter'];
            if($days_filter == 0) {
                $this->db->join('bl_bb_donatioform', 'bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id
                 AND DATE(bl_bb_donatioform.created_at) = "'.$current_date.'" AND bl_bb_donatioform.status = "Pending"' , 'left');
            } else {                
                $this->db->join('bl_bb_donatioform', 'bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id 
                AND bl_bb_donatioform.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '" AND bl_bb_donatioform.status = "Pending"', 'left');
             } 
        }
    
        if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->join('bl_bb_donatioform', 'bl_blood_banks.blood_bank_id = 
                bl_bb_donatioform.bloodbank_id AND bl_bb_donatioform.created_at >= "'.$start_date.'" 
                AND bl_bb_donatioform.created_at <= "'.$end_date.'" AND bl_bb_donatioform.status = "Pending"', 'left');  
           
        }     
        $this->db->group_by('bl_blood_banks.blood_bank_id');
        if($_SESSION['admin_type'] == 5){
            $B_id = $_SESSION['bank_id'];
            $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }
        $this->db->order_by('A_pos', 'DESC');
        $this->db->order_by('B_pos', 'DESC');
        $this->db->order_by('A_neg', 'DESC');
        $this->db->order_by('B_neg', 'DESC');
        $this->db->order_by('AB_pos', 'DESC');
        $this->db->order_by('AB_neg', 'DESC');
        $this->db->order_by('O_pos', 'DESC');
        $this->db->order_by('O_neg', 'DESC');
        $query = $this->db->get('bl_blood_banks');
        return $query->result();
        
    }
    public function _get_bb_excel_detail($post=array()) {
      
        $current_date = date('Y-m-d'); 
        $this->db->select('bl_blood_banks.short_name, bl_blood_banks.short_name, 
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "A+" THEN 1 ELSE 0 END) AS A_pos,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "B+" THEN 1 ELSE 0 END) AS B_pos,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "A-" THEN 1 ELSE 0 END) AS A_neg,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "B-" THEN 1 ELSE 0 END) AS B_neg,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "AB+" THEN 1 ELSE 0 END) AS AB_pos,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "AB-" THEN 1 ELSE 0 END) AS AB_neg,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "O+" THEN 1 ELSE 0 END) AS O_pos,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "O-" THEN 1 ELSE 0 END) AS O_neg,
        SUM(CASE WHEN bl_bb_donatioform.blood_group = "A+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "B+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "A-" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "B-" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "AB+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "AB-" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "O+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "O-" THEN 1 ELSE 0 END) AS total_count');

        $this->db->where('bl_blood_banks.org_type','Blood Bank');
   
        if(empty($post['start_date']) || empty($post['end_date'])) {
            $days_filter = $post['days_filter'];
            if($days_filter == 0) {
                $this->db->join('bl_bb_donatioform', 'bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id
                 AND DATE(bl_bb_donatioform.created_at) = "'.$current_date.'"', 'left');

            } else {
                
                $this->db->join('bl_bb_donatioform', 'bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id 
                AND bl_bb_donatioform.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"', 'left');
             } 
        }
    
        if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->join('bl_bb_donatioform', 'bl_blood_banks.blood_bank_id = 
                bl_bb_donatioform.bloodbank_id AND bl_bb_donatioform.created_at >= "'.$start_date.'" 
                AND bl_bb_donatioform.created_at <= "'.$end_date.'"', 'left');  
           
        }     
        $this->db->group_by('bl_blood_banks.blood_bank_id');
        if($_SESSION['admin_type'] == 5){
            $B_id = $_SESSION['bank_id'];
            $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }
        $this->db->order_by('A_pos', 'DESC');
        $this->db->order_by('B_pos', 'DESC');
        $this->db->order_by('A_neg', 'DESC');
        $this->db->order_by('B_neg', 'DESC');
        $this->db->order_by('AB_pos', 'DESC');
        $this->db->order_by('AB_neg', 'DESC');
        $this->db->order_by('O_pos', 'DESC');
        $this->db->order_by('O_neg', 'DESC');
        $query = $this->db->get('bl_blood_banks');
        return $query->result();
        
    }
    public function _get_bb_donar_app($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
      
        $current_date = date('Y-m-d'); 
        $this->db->select('bl_blood_banks.blood_bank_id, bl_blood_banks.short_name, bl_blood_banks.short_name, 
        SUM(CASE WHEN bl_customers.blood_group = "1" THEN 1 ELSE 0 END) AS A_pos,
        SUM(CASE WHEN bl_customers.blood_group = "5" THEN 1 ELSE 0 END) AS B_pos,
        SUM(CASE WHEN bl_customers.blood_group = "2" THEN 1 ELSE 0 END) AS A_neg,
        SUM(CASE WHEN bl_customers.blood_group = "6" THEN 1 ELSE 0 END) AS B_neg,
        SUM(CASE WHEN bl_customers.blood_group = "3" THEN 1 ELSE 0 END) AS AB_pos,
        SUM(CASE WHEN bl_customers.blood_group = "4" THEN 1 ELSE 0 END) AS AB_neg,
        SUM(CASE WHEN bl_customers.blood_group = "7" THEN 1 ELSE 0 END) AS O_pos,
        SUM(CASE WHEN bl_customers.blood_group = "8" THEN 1 ELSE 0 END) AS O_neg,
        SUM(CASE WHEN bl_customers.blood_group = "1" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "5" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "2" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "6" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "3" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "4" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "7" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "8" THEN 1 ELSE 0 END) AS total_count');

        $this->db->where('bl_blood_banks.org_type','Blood Bank');
        if(empty($post['start_date']) || empty($post['end_date'])) {
            $days_filter = $post['days_filter'];
            if($days_filter == 0) {
                $this->db->join('bl_blood_donation_requests', 'bl_blood_banks.blood_bank_id = bl_blood_donation_requests.org_id
                 AND DATE(bl_blood_donation_requests.created_at) = "'.$current_date.'"', 'left');

            } else {
                
                $this->db->join('bl_blood_donation_requests', 'bl_blood_banks.blood_bank_id = bl_blood_donation_requests.org_id
                AND bl_blood_donation_requests.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"', 'left');
             } 
        }
         if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->join('bl_blood_donation_requests', 'bl_blood_banks.blood_bank_id = bl_blood_donation_requests.org_id
            AND bl_blood_donation_requests.created_at >= "'.$start_date.'" 
                AND bl_blood_donation_requests.created_at <= "'.$end_date.'"', 'left');  
           
        }  
        $this->db->join('bl_customers', 'bl_blood_donation_requests.user_id = bl_customers.user_id', 'left');
        $this->db->group_by('bl_blood_banks.blood_bank_id');
        if($_SESSION['admin_type'] == 5){
            $B_id = $_SESSION['bank_id'];
            $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }
        $this->db->order_by('A_pos', 'DESC');
        $this->db->order_by('B_pos', 'DESC');
        $this->db->order_by('A_neg', 'DESC');
        $this->db->order_by('B_neg', 'DESC');
        $this->db->order_by('AB_pos', 'DESC');
        $this->db->order_by('AB_neg', 'DESC');
        $this->db->order_by('O_pos', 'DESC');
        $this->db->order_by('O_neg', 'DESC');
    
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _get_bb_donar_app_excel($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
      
        $current_date = date('Y-m-d'); 
        $this->db->select('bl_blood_banks.short_name, 
        SUM(CASE WHEN bl_customers.blood_group = "1" THEN 1 ELSE 0 END) AS A_pos,
        SUM(CASE WHEN bl_customers.blood_group = "5" THEN 1 ELSE 0 END) AS B_pos,
        SUM(CASE WHEN bl_customers.blood_group = "2" THEN 1 ELSE 0 END) AS A_neg,
        SUM(CASE WHEN bl_customers.blood_group = "6" THEN 1 ELSE 0 END) AS B_neg,
        SUM(CASE WHEN bl_customers.blood_group = "3" THEN 1 ELSE 0 END) AS AB_pos,
        SUM(CASE WHEN bl_customers.blood_group = "4" THEN 1 ELSE 0 END) AS AB_neg,
        SUM(CASE WHEN bl_customers.blood_group = "7" THEN 1 ELSE 0 END) AS O_pos,
        SUM(CASE WHEN bl_customers.blood_group = "8" THEN 1 ELSE 0 END) AS O_neg,
        SUM(CASE WHEN bl_customers.blood_group = "1" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "5" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "2" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "6" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "3" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "4" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "7" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "8" THEN 1 ELSE 0 END) AS total_count');

        $this->db->where('bl_blood_banks.org_type','Blood Bank');
        if(empty($post['start_date']) || empty($post['end_date'])) {
            $days_filter = $post['days_filter'];
            if($days_filter == 0) {
                $this->db->join('bl_blood_donation_requests', 'bl_blood_banks.blood_bank_id = bl_blood_donation_requests.org_id
                 AND DATE(bl_blood_donation_requests.created_at) = "'.$current_date.'"', 'left');

            } else {
                
                $this->db->join('bl_blood_donation_requests', 'bl_blood_banks.blood_bank_id = bl_blood_donation_requests.org_id
                AND bl_blood_donation_requests.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"', 'left');
             } 
        }
         if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->join('bl_blood_donation_requests', 'bl_blood_banks.blood_bank_id = bl_blood_donation_requests.org_id
            AND bl_blood_donation_requests.created_at >= "'.$start_date.'" 
                AND bl_blood_donation_requests.created_at <= "'.$end_date.'"', 'left');  
           
        }  
        $this->db->join('bl_customers', 'bl_blood_donation_requests.user_id = bl_customers.user_id', 'left');
        $this->db->group_by('bl_blood_banks.blood_bank_id');
        if($_SESSION['admin_type'] == 5){
            $B_id = $_SESSION['bank_id'];
            $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }
        $this->db->order_by('A_pos', 'DESC');
        $this->db->order_by('B_pos', 'DESC');
        $this->db->order_by('A_neg', 'DESC');
        $this->db->order_by('B_neg', 'DESC');
        $this->db->order_by('AB_pos', 'DESC');
        $this->db->order_by('AB_neg', 'DESC');
        $this->db->order_by('O_pos', 'DESC');
        $this->db->order_by('O_neg', 'DESC');
    
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _get_bb_req_app($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
      
        $current_date = date('Y-m-d'); 
        $this->db->select('bl_blood_banks.blood_bank_id, bl_blood_banks.short_name, bl_blood_banks.short_name, 
        SUM(CASE WHEN bl_blood_request.blood_group = "A+" THEN 1 ELSE 0 END) AS A_pos,
        SUM(CASE WHEN bl_blood_request.blood_group = "B+" THEN 1 ELSE 0 END) AS B_pos,
        SUM(CASE WHEN bl_blood_request.blood_group = "A-" THEN 1 ELSE 0 END) AS A_neg,
        SUM(CASE WHEN bl_blood_request.blood_group = "B-" THEN 1 ELSE 0 END) AS B_neg,
        SUM(CASE WHEN bl_blood_request.blood_group = "AB+" THEN 1 ELSE 0 END) AS AB_pos,
        SUM(CASE WHEN bl_blood_request.blood_group = "AB-" THEN 1 ELSE 0 END) AS AB_neg,
        SUM(CASE WHEN bl_blood_request.blood_group = "O+" THEN 1 ELSE 0 END) AS O_pos,
        SUM(CASE WHEN bl_blood_request.blood_group = "O-" THEN 1 ELSE 0 END) AS O_neg,
        SUM(CASE WHEN bl_blood_request.blood_group = "A+" THEN 1 ELSE 0 END +
            CASE WHEN bl_blood_request.blood_group = "B+" THEN 1 ELSE 0 END +
            CASE WHEN bl_blood_request.blood_group = "A-" THEN 1 ELSE 0 END +
            CASE WHEN bl_blood_request.blood_group = "B-" THEN 1 ELSE 0 END +
            CASE WHEN bl_blood_request.blood_group = "AB+" THEN 1 ELSE 0 END +
            CASE WHEN bl_blood_request.blood_group = "AB-" THEN 1 ELSE 0 END +
            CASE WHEN bl_blood_request.blood_group = "O+" THEN 1 ELSE 0 END +
            CASE WHEN bl_blood_request.blood_group = "O-" THEN 1 ELSE 0 END) AS total_count');

        $this->db->where('bl_blood_banks.org_type','Blood Bank');
        if(empty($post['start_date']) || empty($post['end_date'])) {
            $days_filter = $post['days_filter'];
            if($days_filter == 0) {
                $this->db->join('bl_blood_request', 'bl_blood_banks.blood_bank_id = bl_blood_request.org_id
                 AND DATE(bl_blood_request.created_at) = "'.$current_date.'"', 'left');

            } else {
                
                $this->db->join('bl_blood_request', 'bl_blood_banks.blood_bank_id = bl_blood_request.org_id
                AND bl_blood_request.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"', 'left');
             } 
        }
         if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->join('bl_blood_request', 'bl_blood_banks.blood_bank_id = bl_blood_request.org_id
            AND bl_blood_request.created_at >= "'.$start_date.'" 
                AND bl_blood_request.created_at <= "'.$end_date.'"', 'left');  
           
        }  
      
        $this->db->group_by('bl_blood_banks.blood_bank_id');
        if($_SESSION['admin_type'] == 5){
            $B_id = $_SESSION['bank_id'];
            $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }
        $this->db->order_by('A_pos', 'DESC');
        $this->db->order_by('B_pos', 'DESC');
        $this->db->order_by('A_neg', 'DESC');
        $this->db->order_by('B_neg', 'DESC');
        $this->db->order_by('AB_pos', 'DESC');
        $this->db->order_by('AB_neg', 'DESC');
        $this->db->order_by('O_pos', 'DESC');
        $this->db->order_by('O_neg', 'DESC');
    
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _get_bb_req_app_excel($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
      
        $current_date = date('Y-m-d'); 
        $this->db->select('bl_blood_banks.short_name, 
        SUM(CASE WHEN bl_blood_request.blood_group = "A+" THEN 1 ELSE 0 END) AS A_pos,
        SUM(CASE WHEN bl_blood_request.blood_group = "B+" THEN 1 ELSE 0 END) AS B_pos,
        SUM(CASE WHEN bl_blood_request.blood_group = "A-" THEN 1 ELSE 0 END) AS A_neg,
        SUM(CASE WHEN bl_blood_request.blood_group = "B-" THEN 1 ELSE 0 END) AS B_neg,
        SUM(CASE WHEN bl_blood_request.blood_group = "AB+" THEN 1 ELSE 0 END) AS AB_pos,
        SUM(CASE WHEN bl_blood_request.blood_group = "AB-" THEN 1 ELSE 0 END) AS AB_neg,
        SUM(CASE WHEN bl_blood_request.blood_group = "O+" THEN 1 ELSE 0 END) AS O_pos,
        SUM(CASE WHEN bl_blood_request.blood_group = "O-" THEN 1 ELSE 0 END) AS O_neg,
        SUM(CASE WHEN bl_blood_request.blood_group = "A+" THEN 1 ELSE 0 END +
            CASE WHEN bl_blood_request.blood_group = "B+" THEN 1 ELSE 0 END +
            CASE WHEN bl_blood_request.blood_group = "A-" THEN 1 ELSE 0 END +
            CASE WHEN bl_blood_request.blood_group = "B-" THEN 1 ELSE 0 END +
            CASE WHEN bl_blood_request.blood_group = "AB+" THEN 1 ELSE 0 END +
            CASE WHEN bl_blood_request.blood_group = "AB-" THEN 1 ELSE 0 END +
            CASE WHEN bl_blood_request.blood_group = "O+" THEN 1 ELSE 0 END +
            CASE WHEN bl_blood_request.blood_group = "O-" THEN 1 ELSE 0 END) AS total_count');

        $this->db->where('bl_blood_banks.org_type','Blood Bank');
        if(empty($post['start_date']) || empty($post['end_date'])) {
            $days_filter = $post['days_filter'];
            if($days_filter == 0) {
                $this->db->join('bl_blood_request', 'bl_blood_banks.blood_bank_id = bl_blood_request.org_id
                 AND DATE(bl_blood_request.created_at) = "'.$current_date.'"', 'left');

            } else {
                
                $this->db->join('bl_blood_request', 'bl_blood_banks.blood_bank_id = bl_blood_request.org_id
                AND bl_blood_request.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"', 'left');
             } 
        }
         if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->join('bl_blood_request', 'bl_blood_banks.blood_bank_id = bl_blood_request.org_id
            AND bl_blood_request.created_at >= "'.$start_date.'" 
                AND bl_blood_request.created_at <= "'.$end_date.'"', 'left');  
           
        }  
      
        $this->db->group_by('bl_blood_banks.blood_bank_id');
        if($_SESSION['admin_type'] == 5){
            $B_id = $_SESSION['bank_id'];
            $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }
        $this->db->order_by('A_pos', 'DESC');
        $this->db->order_by('B_pos', 'DESC');
        $this->db->order_by('A_neg', 'DESC');
        $this->db->order_by('B_neg', 'DESC');
        $this->db->order_by('AB_pos', 'DESC');
        $this->db->order_by('AB_neg', 'DESC');
        $this->db->order_by('O_pos', 'DESC');
        $this->db->order_by('O_neg', 'DESC');
    
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _get_bb_deffer($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
        $current_date = date('Y-m-d'); 
        $this->db->select('bl_blood_banks.blood_bank_id, bl_blood_banks.short_name, bl_blood_banks.short_name, 
    SUM(CASE WHEN bl_bb_donatioform.blood_group = "A+" THEN 1 ELSE 0 END) AS A_pos,
    SUM(CASE WHEN bl_bb_donatioform.blood_group = "B+" THEN 1 ELSE 0 END) AS B_pos,
    SUM(CASE WHEN bl_bb_donatioform.blood_group = "A-" THEN 1 ELSE 0 END) AS A_neg,
    SUM(CASE WHEN bl_bb_donatioform.blood_group = "B-" THEN 1 ELSE 0 END) AS B_neg,
    SUM(CASE WHEN bl_bb_donatioform.blood_group = "AB+" THEN 1 ELSE 0 END) AS AB_pos,
    SUM(CASE WHEN bl_bb_donatioform.blood_group = "AB-" THEN 1 ELSE 0 END) AS AB_neg,
    SUM(CASE WHEN bl_bb_donatioform.blood_group = "O+" THEN 1 ELSE 0 END) AS O_pos,
    SUM(CASE WHEN bl_bb_donatioform.blood_group = "O-" THEN 1 ELSE 0 END) AS O_neg,
    SUM(CASE WHEN bl_bb_donatioform.blood_group = "A+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "B+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "A-" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "B-" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "AB+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "AB-" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "O+" THEN 1 ELSE 0 END +
        CASE WHEN bl_bb_donatioform.blood_group = "O-" THEN 1 ELSE 0 END) AS total_count');

      //  $this->db->where('bl_bb_donatioform.status','Pending');
        $this->db->where('bl_blood_banks.org_type','Blood Bank');
        if(empty($post['start_date']) || empty($post['end_date'])) {
            $days_filter = $post['days_filter'];
            if($days_filter == 0) {
                $this->db->join('bl_bb_donatioform', 'bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id
                 AND DATE(bl_bb_donatioform.created_at) = "'.$current_date.'" AND bl_bb_donatioform.status = "Pending"' , 'left');
            } else {                
                $this->db->join('bl_bb_donatioform', 'bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id 
                AND bl_bb_donatioform.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '" AND bl_bb_donatioform.status = "Pending"', 'left');
             } 
        }
    
        if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->join('bl_bb_donatioform', 'bl_blood_banks.blood_bank_id = 
                bl_bb_donatioform.bloodbank_id AND bl_bb_donatioform.created_at >= "'.$start_date.'" 
                AND bl_bb_donatioform.created_at <= "'.$end_date.'" AND bl_bb_donatioform.status = "Pending"', 'left');  
           
        }    
        if($_SESSION['admin_type'] == 5){
            $B_id = $_SESSION['bank_id'];
            $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }
        $this->db->group_by('bl_blood_banks.blood_bank_id');
        // Sorting by blood group counts
        $this->db->order_by('A_pos', 'DESC');
        $this->db->order_by('B_pos', 'DESC');
        $this->db->order_by('A_neg', 'DESC');
        $this->db->order_by('B_neg', 'DESC');
        $this->db->order_by('AB_pos', 'DESC');
        $this->db->order_by('AB_neg', 'DESC');
        $this->db->order_by('O_pos', 'DESC');
        $this->db->order_by('O_neg', 'DESC');
    
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }

    public function _get_bb_reqest($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
        $days_filter = $post['days_filter'];        
        $this->db->select('bl_blood_banks.blood_bank_id, bl_blood_banks.short_name, 
        SUM(CASE WHEN component IN (18, "wholeblood") THEN 1 ELSE 0 END) AS whole_blood_unit_count,
        SUM(CASE WHEN component = 20 THEN 1 ELSE 0 END) AS Fresh_Frozen_Plasma_unit_count,
        SUM(CASE WHEN component IN (21,886) THEN 1 ELSE 0 END) AS Red_blood_cell_unit_count,
        SUM(CASE WHEN component = 22 THEN 1 ELSE 0 END) AS Platelet_rich_concentrate_unit_count,
        SUM( CASE WHEN component = "wholeblood" THEN 1 ELSE 0 END + 
             CASE WHEN component = 18 THEN 1 ELSE 0 END +
             CASE WHEN component = 20 THEN 1 ELSE 0 END +
             CASE WHEN component = 21 THEN 1 ELSE 0 END + 
             CASE WHEN component = 886 THEN 1 ELSE 0 END +
             CASE WHEN component = 22 THEN 1 ELSE 0 END
        ) AS total_component_count');
        
         if(empty($post['start_date']) || empty($post['end_date'])) {
            $current_date = date('Y-m-d');
            $days_filter = $post['days_filter']; 
            if($days_filter == 0) {
                $this->db->join('bl_crossmatch', 'bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id 
                AND bl_crossmatch.status = "crossmatch" AND DATE(bl_crossmatch.created_at) = "' . $current_date . '"', 'left');
            }else{          
                $this->db->join('bl_crossmatch', 'bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id 
                AND bl_crossmatch.status = "crossmatch" AND bl_crossmatch.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"', 'left');
            } 
        }
         if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->join('bl_crossmatch',  'bl_blood_banks.blood_bank_id= bl_crossmatch.bloodbank_id 
            AND bl_crossmatch.status = "crossmatch"  AND bl_crossmatch.created_at >= "'.$start_date.'"  AND bl_crossmatch.created_at <= "'.$end_date.'" ', 'left');  
        } 
        
        $this->db->where('bl_blood_banks.org_type', 'Blood Bank');
        if($_SESSION['admin_type'] == 5){
            $B_id = $_SESSION['bank_id'];
            $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }
        $this->db->group_by('bl_blood_banks.blood_bank_id');
        // Sorting by blood group counts
        $this->db->order_by('whole_blood_unit_count', 'DESC');
        $this->db->order_by('Fresh_Frozen_Plasma_unit_count', 'DESC');
        $this->db->order_by('Red_blood_cell_unit_count', 'DESC');
        $this->db->order_by('Platelet_rich_concentrate_unit_count', 'DESC');
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _get_bb_reqest_excel($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
        $days_filter = $post['days_filter'];
        $current_date = date('Y-m-d'); 
        $this->db->select('bl_blood_banks.short_name, 
        SUM(CASE WHEN component IN (18, "wholeblood") THEN 1 ELSE 0 END) AS whole_blood_unit_count,
        SUM(CASE WHEN component = 22 THEN 1 ELSE 0 END) AS Platelet_rich_concentrate_unit_count,
        SUM(CASE WHEN component IN (21,886) THEN 1 ELSE 0 END) AS Red_blood_cell_unit_count,
        SUM(CASE WHEN component = 20 THEN 1 ELSE 0 END) AS Fresh_Frozen_Plasma_unit_count,
        SUM( CASE WHEN component = "wholeblood" THEN 1 ELSE 0 END + 
             CASE WHEN component = 18 THEN 1 ELSE 0 END +
             CASE WHEN component = 886 THEN 1 ELSE 0 END +
             CASE WHEN component = 20 THEN 1 ELSE 0 END +
             CASE WHEN component = 21 THEN 1 ELSE 0 END + 
             CASE WHEN component = 22 THEN 1 ELSE 0 END
        ) AS total_component_count');
        
        if(empty($post['start_date']) || empty($post['end_date'])) {
            $current_date = date('Y-m-d');
            $days_filter = $post['days_filter']; 
            if($days_filter == 0) {
                $this->db->join('bl_crossmatch', 'bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id 
                AND bl_crossmatch.status = "crossmatch" AND DATE(bl_crossmatch.created_at) = "' . $current_date . '"', 'left');
            }else{          
                $this->db->join('bl_crossmatch', 'bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id 
                AND bl_crossmatch.status = "crossmatch" AND bl_crossmatch.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"', 'left');
            } 
        }
         if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->join('bl_crossmatch',  'bl_blood_banks.blood_bank_id= bl_crossmatch.bloodbank_id 
            AND bl_crossmatch.status = "crossmatch" AND bl_crossmatch.created_at >= "'.$start_date.'"  AND bl_crossmatch.created_at <= "'.$end_date.'" ', 'left');  
        } 
        $this->db->where('bl_blood_banks.org_type', 'Blood Bank');
        $this->db->group_by('bl_blood_banks.blood_bank_id');
        // Sorting by blood group counts
        $this->db->order_by('whole_blood_unit_count', 'DESC');
        $this->db->order_by('Fresh_Frozen_Plasma_unit_count', 'DESC');
        $this->db->order_by('Red_blood_cell_unit_count', 'DESC');
        $this->db->order_by('Platelet_rich_concentrate_unit_count', 'DESC');
        
          
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _get_bb_reqest_issued($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
        $current_date = date('Y-m-d');  
        $txt = 'issued';
        $this->db->select('bl_blood_banks.blood_bank_id, bl_blood_banks.short_name, 
        SUM(CASE WHEN bl_crossmatch.component IN (18, "wholeblood") THEN 1 ELSE 0 END) AS whole_blood_unit_count,
        SUM(CASE WHEN bl_crossmatch.component = 20 THEN 1 ELSE 0 END) AS Fresh_Frozen_Plasma_unit_count,
        SUM(CASE WHEN component IN (21,886) THEN 1 ELSE 0 END) AS Red_blood_cell_unit_count,
        SUM(CASE WHEN bl_crossmatch.component = 22 THEN 1 ELSE 0 END) AS Platelet_rich_concentrate_unit_count,
        SUM( CASE WHEN bl_crossmatch.component = 18 THEN 1 ELSE 0 END + 
        CASE WHEN bl_crossmatch.component = "wholeblood" THEN 1 ELSE 0 END + 
             CASE WHEN bl_crossmatch.component = 20 THEN 1 ELSE 0 END +
             CASE WHEN component = 21 THEN 1 ELSE 0 END + CASE WHEN component =886 THEN 1 ELSE 0 END + 
             CASE WHEN bl_crossmatch.component = 22 THEN 1 ELSE 0 END
        ) AS total_component_count');

        if(empty($post['start_date']) || empty($post['end_date'])) {
            $days_filter = $post['days_filter'];
            if($days_filter == 0) {
                $this->db->join('bl_crossmatch', 'bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id AND bl_crossmatch.status="'.$txt.'" 
                AND DATE(bl_crossmatch.created_at) = "' . $current_date . '"', 'left');
            } else {          
                $this->db->join('bl_crossmatch', 'bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id AND bl_crossmatch.status="'.$txt.'"
                AND bl_crossmatch.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"', 'left');
             } 
        }
         if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->join('bl_crossmatch','bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id AND bl_crossmatch.status="'.$txt.'"
             AND bl_crossmatch.created_at >= "'.$start_date.'"  AND bl_crossmatch.created_at <= "'.$end_date.'" ', 'left');  
        } 

        $this->db->where('bl_blood_banks.org_type', 'Blood Bank');
            if($_SESSION['admin_type'] == 5){
                $B_id = $_SESSION['bank_id'];
                $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }else{
                if(isset($post['bb_over']) && $post['bb_over'] != ""){
                  $this->db->where('bl_blood_banks.blood_bank_id = "' . $post['bb_over'] . '"');  
                }
            }
        $this->db->group_by('bl_blood_banks.blood_bank_id');
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
     public function _get_bb_pending_app($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
         $txt = "not donated";
        $current_date = date('Y-m-d'); 
        $this->db->select('bl_blood_banks.blood_bank_id, bl_blood_banks.short_name, bl_blood_banks.short_name, 
    SUM(CASE WHEN bl_customers.blood_group = "1" THEN 1 ELSE 0 END) AS A_pos,
    SUM(CASE WHEN bl_customers.blood_group = "5" THEN 1 ELSE 0 END) AS B_pos,
    SUM(CASE WHEN bl_customers.blood_group = "2" THEN 1 ELSE 0 END) AS A_neg,
    SUM(CASE WHEN bl_customers.blood_group = "6" THEN 1 ELSE 0 END) AS B_neg,
    SUM(CASE WHEN bl_customers.blood_group = "3" THEN 1 ELSE 0 END) AS AB_pos,
    SUM(CASE WHEN bl_customers.blood_group = "4" THEN 1 ELSE 0 END) AS AB_neg,
    SUM(CASE WHEN bl_customers.blood_group = "7" THEN 1 ELSE 0 END) AS O_pos,
    SUM(CASE WHEN bl_customers.blood_group = "8" THEN 1 ELSE 0 END) AS O_neg,
    SUM(CASE WHEN bl_customers.blood_group = "1" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "5" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "2" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "6" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "3" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "4" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "7" THEN 1 ELSE 0 END +
        CASE WHEN bl_customers.blood_group = "8" THEN 1 ELSE 0 END) AS total_count');
        $this->db->where('bl_blood_banks.org_type','Blood Bank');

        if(empty($post['start_date']) || empty($post['end_date'])) {
            $days_filter = $post['days_filter'];
            if($days_filter == 0) {
                
                $this->db->join('bl_blood_donation_requests', 'bl_blood_banks.blood_bank_id = bl_blood_donation_requests.org_id
                 AND DATE(bl_blood_donation_requests.created_at) = "'.$current_date.'"', 'left');
            } else {                
                $this->db->join('bl_blood_donation_requests', 'bl_blood_banks.blood_bank_id = bl_blood_donation_requests.org_id 
                AND bl_blood_donation_requests.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"', 'left');
             } 
        }
    
        if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->join('bl_blood_donation_requests', 'bl_blood_banks.blood_bank_id = bl_blood_donation_requests.org_id AND bl_blood_donation_requests.created_at >= "'.$start_date.'" 
                AND bl_blood_donation_requests.created_at <= "'.$end_date.'"', 'left');  
           
        }    
        // $this->db->join('bl_customers', 'bl_customers.user_id = bl_blood_donation_requests.user_id AND bl_blood_donation_requests.donation_status = "not donated"', 'left');
        $this->db->join('bl_customers', 'bl_customers.user_id = bl_blood_donation_requests.user_id', 'left');
        
        $this->db->where('bl_blood_donation_requests.donation_status', 'not donated');


        if($_SESSION['admin_type'] == 5){
            $B_id = $_SESSION['bank_id'];
            $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }
        $this->db->group_by('bl_blood_banks.blood_bank_id');
        // Sorting by blood group counts
        $this->db->order_by('A_pos', 'DESC');
        $this->db->order_by('B_pos', 'DESC');
        $this->db->order_by('A_neg', 'DESC');
        $this->db->order_by('B_neg', 'DESC');
        $this->db->order_by('AB_pos', 'DESC');
        $this->db->order_by('AB_neg', 'DESC');
        $this->db->order_by('O_pos', 'DESC');
        $this->db->order_by('O_neg', 'DESC');
    
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }

    
    public function _get_bb_reqest_met($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
        $current_date = date('Y-m-d');  
        $this->db->select('bl_blood_banks.blood_bank_id, bl_blood_banks.short_name, 
        SUM(CASE WHEN bl_crossmatch.component IN (18, "wholeblood") THEN 1 ELSE 0 END) AS whole_blood_unit_count,
        SUM(CASE WHEN bl_crossmatch.component = 20 THEN 1 ELSE 0 END) AS Fresh_Frozen_Plasma_unit_count,
        SUM(CASE WHEN bl_crossmatch.component IN (21,886) THEN 1 ELSE 0 END) AS Red_blood_cell_unit_count,
        SUM(CASE WHEN bl_crossmatch.component = 22 THEN 1 ELSE 0 END) AS Platelet_rich_concentrate_unit_count,
        SUM( CASE WHEN bl_crossmatch.component = 18 THEN 1 ELSE 0 END +  
            CASE WHEN bl_crossmatch.component = "wholeblood" THEN 1 ELSE 0 END + 
             CASE WHEN bl_crossmatch.component = 20 THEN 1 ELSE 0 END +
             CASE WHEN bl_crossmatch.component = 21 THEN 1 ELSE 0 END + 
             CASE WHEN bl_crossmatch.component = 886 THEN 1 ELSE 0 END + 
             CASE WHEN bl_crossmatch.component = 22 THEN 1 ELSE 0 END
        ) AS total_component_count');

        if(empty($post['start_date']) || empty($post['end_date'])) {
            $days_filter = $post['days_filter'];
            if($days_filter == 0) {
                $this->db->join('bl_crossmatch', 'bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id AND 
                DATE(bl_crossmatch.created_at) = "' . $current_date . '" AND bl_crossmatch.status IN ("issued","crossmatch")', 'left');
            } else {          
                $this->db->join('bl_crossmatch', 'bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id 
                AND bl_crossmatch.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '" AND bl_crossmatch.status IN ("issued","crossmatch")', 'left');
             } 
        }
         if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->join('bl_crossmatch','bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id 
             AND bl_crossmatch.created_at >= "'.$start_date.'"  AND bl_crossmatch.created_at <= "'.$end_date.'" AND bl_crossmatch.status IN ("issued","crossmatch")', 'left');  
        } 

        $this->db->where('bl_blood_banks.org_type', 'Blood Bank');
            if($_SESSION['admin_type'] == 5){
                $B_id = $_SESSION['bank_id'];
                $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }
        $this->db->group_by('bl_blood_banks.blood_bank_id');
        $this->db->order_by('whole_blood_unit_count', 'DESC');
        $this->db->order_by('Fresh_Frozen_Plasma_unit_count', 'DESC');
        $this->db->order_by('Red_blood_cell_unit_count', 'DESC');
        $this->db->order_by('Platelet_rich_concentrate_unit_count', 'DESC');
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _get_bb_reqest_met_excel($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
        $current_date = date('Y-m-d'); 
        $this->db->select('bl_blood_banks.short_name, 
        SUM(CASE WHEN bl_crossmatch.component IN (18, "wholeblood") THEN 1 ELSE 0 END) AS whole_blood_unit_count,
        SUM(CASE WHEN bl_crossmatch.component = 20 THEN 1 ELSE 0 END) AS Fresh_Frozen_Plasma_unit_count,
        SUM(CASE WHEN bl_crossmatch.component IN (21,886) THEN 1 ELSE 0 END) AS Red_blood_cell_unit_count,
        SUM(CASE WHEN bl_crossmatch.component = 22 THEN 1 ELSE 0 END) AS Platelet_rich_concentrate_unit_count,
        SUM( CASE WHEN bl_crossmatch.component = 18 THEN 1 ELSE 0 END +
            CASE WHEN bl_crossmatch.component = "wholeblood" THEN 1 ELSE 0 END + 
             CASE WHEN bl_crossmatch.component = 20 THEN 1 ELSE 0 END +
             CASE WHEN bl_crossmatch.component = 886 THEN 1 ELSE 0 END +
             CASE WHEN bl_crossmatch.component = 21 THEN 1 ELSE 0 END + 
             CASE WHEN bl_crossmatch.component = 22 THEN 1 ELSE 0 END
        ) AS total_component_count');
       if(empty($post['start_date']) || empty($post['end_date'])) {
            $days_filter = $post['days_filter'];
            if($days_filter == 0) {
                $this->db->join('bl_crossmatch', 'bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id 
                AND DATE(bl_crossmatch.created_at) = "' . $current_date . '"', 'left');

            } else {          
                $this->db->join('bl_crossmatch', 'bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id 
                AND bl_crossmatch.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"', 'left');

             } 
        }
         if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->join('bl_crossmatch',  'bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id 
             AND bl_crossmatch.created_at >= "'.$start_date.'"  AND bl_crossmatch.created_at <= "'.$end_date.'" ', 'left');  
           
        } 
        
        $this->db->where('bl_blood_banks.org_type', 'Blood Bank');
            if($_SESSION['admin_type'] == 5){
            $B_id = $_SESSION['bank_id'];
            $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }

        $this->db->group_by('bl_blood_banks.blood_bank_id');
        $this->db->order_by('whole_blood_unit_count', 'DESC');
        $this->db->order_by('Fresh_Frozen_Plasma_unit_count', 'DESC');
        $this->db->order_by('Red_blood_cell_unit_count', 'DESC');
        $this->db->order_by('Platelet_rich_concentrate_unit_count', 'DESC');
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    
    public function _get_bb_issue($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
        // Calculate financial year start and end dates
        $currentYear = date('Y');
        $currentMonth = date('m');
    
        if ($currentMonth >= 4) {
            // Financial year is from April of current year to March of next year
            $start_date = "$currentYear-04-01";
            $end_date = ($currentYear + 1) . "-03-31";
        } else {
            // Financial year is from April of the previous year to March of current year
            $start_date = ($currentYear - 1) . "-04-01";
            $end_date = "$currentYear-03-31";
        }
    
       
        $this->db->select('bl_blood_banks.blood_bank_id, bl_blood_banks.short_name, 
        SUM(CASE WHEN component IN (18, "wholeblood") THEN 1 ELSE 0 END) AS whole_blood_unit_count,
        SUM(CASE WHEN component = 20 THEN 1 ELSE 0 END) AS Fresh_Frozen_Plasma_unit_count,
        SUM(CASE WHEN component IN (21,886) THEN 1 ELSE 0 END) AS Red_blood_cell_unit_count,
        SUM(CASE WHEN component = 22 THEN 1 ELSE 0 END) AS Platelet_rich_concentrate_unit_count,
        SUM( CASE WHEN component = "wholeblood" THEN 1 ELSE 0 END + 
             CASE WHEN component = 18 THEN 1 ELSE 0 END +
             CASE WHEN component = 20 THEN 1 ELSE 0 END +
             CASE WHEN component = 21 THEN 1 ELSE 0 END + 
             CASE WHEN component = 886 THEN 1 ELSE 0 END +
             CASE WHEN component = 22 THEN 1 ELSE 0 END
        ) AS total_component_count');
        
            $this->db->join('bl_crossmatch',  'bl_blood_banks.blood_bank_id= bl_crossmatch.bloodbank_id 
            AND bl_crossmatch.status = "issued"  AND bl_crossmatch.created_at >= "'.$start_date.'"  AND bl_crossmatch.created_at <= "'.$end_date.'" ', 'left');  
            
            
        $this->db->where('bl_blood_banks.org_type', 'Blood Bank');
        if($_SESSION['admin_type'] == 5){
            $B_id = $_SESSION['bank_id'];
            $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }
        $this->db->group_by('bl_blood_banks.blood_bank_id');
        // Sorting by blood group counts
        $this->db->order_by('whole_blood_unit_count', 'DESC');
        $this->db->order_by('Fresh_Frozen_Plasma_unit_count', 'DESC');
        $this->db->order_by('Red_blood_cell_unit_count', 'DESC');
        $this->db->order_by('Platelet_rich_concentrate_unit_count', 'DESC');
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _get_bb_inv($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
        $txt = "No";
        $current_date = date('Y-m-d'); 
        $this->db->select('bl_blood_banks.blood_bank_id, bl_blood_banks.short_name, 
            SUM(CASE WHEN component IN (18, "wholeblood") THEN 1 ELSE 0 END) AS whole_blood_unit_count,
            SUM(CASE WHEN component = 20 THEN 1 ELSE 0 END) AS Fresh_Frozen_Plasma_unit_count,
            SUM(CASE WHEN component IN (21,886) THEN 1 ELSE 0 END) AS Red_blood_cell_unit_count,
            SUM(CASE WHEN component = 22 THEN 1 ELSE 0 END) AS Platelet_rich_concentrate_unit_count,
            SUM( CASE WHEN component = "wholeblood" THEN 1 ELSE 0 END + 
                 CASE WHEN component = 18 THEN 1 ELSE 0 END +
                 CASE WHEN component = 20 THEN 1 ELSE 0 END +
                 CASE WHEN component = 21 THEN 1 ELSE 0 END + 
                 CASE WHEN component =886 THEN 1 ELSE 0 END + 
                 CASE WHEN component = 22 THEN 1 ELSE 0 END
            ) AS total_component_count');
        $this->db->where_In('bl_blood_record.component',[18,20,21,22,886,'wholeblood']);

            if(empty($post['start_date']) || empty($post['end_date'])) {
                $days_filter = $post['days_filter'];
                if($days_filter == 0) {
                    $this->db->join('bl_blood_record', 'bl_blood_banks.blood_bank_id = bl_blood_record.bloodbank_id
                    AND bl_blood_record.cross_match = "'.$txt.'" 
                    AND DATE(bl_blood_record.expiry_date) > "' . $current_date . '" 
                    AND bl_blood_record.status IS NULL AND 
                    DATE(bl_blood_record.created_at) = "' . $current_date . '"', 'left');
    
                } else {  
                    $this->db->join('bl_blood_record', 'bl_blood_banks.blood_bank_id = bl_blood_record.bloodbank_id
                    AND bl_blood_record.cross_match = "'.$txt.'" AND bl_blood_record.status IS NULL 
                    AND DATE(bl_blood_record.expiry_date) > "' . $current_date . '" 
                    AND bl_blood_record.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"', 'left');
                 } 
            }
            if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
                $start_date = date('Y-m-d', strtotime($post['start_date']));
                $end_date = date('Y-m-d', strtotime($post['end_date']));
                $this->db->join('bl_blood_record', 'bl_blood_banks.blood_bank_id = bl_blood_record.bloodbank_id
                AND bl_blood_record.issue_status = "'.$txt.'" AND bl_blood_record.status IS NULL 
                AND DATE(bl_blood_record.expiry_date) > "' . $current_date . '" 
                AND bl_blood_record.created_at >= "'.$start_date.'"  AND bl_blood_record.created_at <= "'.$end_date.'"', 'left');
            } 
            $this->db->group_by('bl_blood_banks.blood_bank_id');
            if($_SESSION['admin_type'] == 5){
                $B_id = $_SESSION['bank_id'];
                $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }else{
                
                if(isset($post['bb_over']) && $post['bb_over'] != ""){
                  $this->db->where('bl_blood_banks.blood_bank_id = "' . $post['bb_over'] . '"');  
                }
            }
            $this->db->where('bl_blood_banks.org_type', 'Blood Bank');
        $this->db->order_by('whole_blood_unit_count', 'DESC');
        $this->db->order_by('Fresh_Frozen_Plasma_unit_count', 'DESC');
        $this->db->order_by('Red_blood_cell_unit_count', 'DESC');
        $this->db->order_by('Platelet_rich_concentrate_unit_count', 'DESC');
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _search_bb_stock_handover($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
        $txt = "No";
        $B_id = $_SESSION['bank_id'];
        $current_date = date('Y-m-d');
        
        $this->db->select('bl_blood_record.*');
        $this->db->where('bl_blood_record.cross_match','No');
        $this->db->where('bl_blood_record.status IS NULL');
        $this->db->where('bl_blood_record.component',20);
        $this->db->where('bl_blood_record.expiry_date > "'.$current_date.'"');
        $start_date = date('Y-m-d', strtotime($post['start_date']));
        $end_date = date('Y-m-d', strtotime($post['end_date']));
        $this->db->where('DATE(bl_blood_record.created_at) >=', $start_date);
        $this->db->where('DATE(bl_blood_record.created_at) <=', $end_date);
        
        $this->db->where('bl_blood_record.bloodbank_id', $B_id);
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_record');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_record');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _search_bb_stock_prc($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
        $txt = "No";
        $B_id = $_SESSION['bank_id'];
        $current_date = date('Y-m-d');
        
        $this->db->select('bl_blood_record.*');
        $this->db->where('bl_blood_record.cross_match','No');
        $this->db->where('bl_blood_record.status IS NULL');
        $this->db->where('bl_blood_record.component',22);
        $this->db->where('bl_blood_record.expiry_date > "'.$current_date.'"');        
        $this->db->where('bl_blood_record.bloodbank_id', $B_id);
        $this->db->where('bl_blood_record.donor_unit_no = "'.$post['unit_no'].'"');
        $this->db->or_where('bl_blood_record.unit_no', $post['unit_no']);
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_record');
                
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_record');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _get_blood_stock_overview($post = array(), $param = array(), $count = FALSE, $return_query = FALSE) {
        $this->db->select('bl_stock_handover.*,bl_agency.a_name');
        $this->db->join('bl_agency', 'bl_stock_handover.aj_id = bl_agency.id');
        $this->db->where('bl_stock_handover.status', $post['status']);
        if ($_SESSION['admin_type'] == 5) {
            $B_id = $_SESSION['bank_id'];
            $this->db->where('bl_stock_handover.bb_id', $B_id);
        }
        // Execute query
        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }
            $query = $this->db->get('bl_stock_handover');
            if ($return_query == FALSE) {
                return $query->result();
            } else {
                return $this->db->last_query();
            }
        } else {
            $query = $this->db->get('bl_stock_handover');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else {
                return $this->db->last_query();
            }
        }
    }
    
    public function _get_blood_stock_detail($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
        $txt = "No";
        $current_date = date('Y-m-d'); 
        $this->db->select('bl_bb_donatioform.*,bl_blood_record.blood_from_bank,bl_blood_record.component,bl_blood_record.final_vol,bl_blood_record.expiry_date,bl_blood_banks.name as bl_name');
        $this->db->join('bl_agency','bl_blood_record.blood_from_bank = bl_agency.id','left');
        $this->db->join('bl_blood_banks','bl_blood_record.bloodbank_id = bl_blood_banks.blood_bank_id'); 
        $this->db->join('bl_bb_donatioform', 'bl_blood_record.donation_id = bl_bb_donatioform.id','left');
        $this->db->where_In('bl_blood_record.component',[18,20,21,22,886,'wholeblood']);
        // $this->db->where('bl_blood_record.expiry_date > "'.$current_date.'"');
        if(isset($post['blood_group']) && $post['blood_group'] != "") {
            $this->db->where('bl_blood_record.blood_group',$post['blood_group']);
        }
        if(isset($post['name']) && $post['name'] != "") {
            $this->db->where('bl_bb_donatioform.donor_name', $post['name']);
            $this->db->or_where('bl_agency.a_name', $post['name']);
        }
            if(empty($post['start_date']) || empty($post['end_date'])) {
                $days_filter = $post['days_filter'];
                if($days_filter == 0) {
                    $this->db->where('bl_blood_record.cross_match = "'.$txt.'" AND bl_blood_record.status IS NULL 
                    AND DATE(bl_blood_record.expiry_date) > "' . $current_date . '" 
                    AND DATE(bl_blood_record.created_at) = "' . $current_date . '"');
                } else {  
                    $this->db->where('bl_blood_record.cross_match = "'.$txt.'" AND bl_blood_record.status IS NULL 
                    AND DATE(bl_blood_record.expiry_date) > "' . $current_date . '" 
                    AND bl_blood_record.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"');
                 } 
            }
             if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
                $start_date = date('Y-m-d', strtotime($post['start_date']));
                $end_date = date('Y-m-d', strtotime($post['end_date']));
                $this->db->where('bl_blood_record.issue_status = "'.$txt.'" AND bl_blood_record.status IS NULL 
                AND DATE(bl_blood_record.expiry_date) > "' . $current_date . '" 
                AND bl_blood_record.created_at >= "'.$start_date.'"  AND bl_blood_record.created_at <= "'.$end_date.'"');
            } 
            if( $post['b_stock_type'] != "All"){
                $this->db->where('bl_blood_record.bloodbank_id = "' . $post['bb_id'] . '"');
            }
            $this->db->group_by('bl_blood_record.id');
            if($_SESSION['admin_type'] == 5){
                $B_id = $_SESSION['bank_id'];
                $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }else{
                $this->db->where('bl_blood_record.bloodbank_id = "' . $post['bb_id'] . '"');   
            }
            $this->db->where('bl_blood_banks.org_type', 'Blood Bank');     
          
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_record');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_record');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _get_bb_inv_excel($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
        $txt = "No";
        $current_date = date('Y-m-d'); 
        $this->db->select('bl_blood_banks.short_name, 
            SUM(CASE WHEN component IN (18, "wholeblood") THEN 1 ELSE 0 END) AS whole_blood_unit_count,
            SUM(CASE WHEN component = 22 THEN 1 ELSE 0 END) AS Platelet_rich_concentrate_unit_count,
            SUM(CASE WHEN component IN (21,886) THEN 1 ELSE 0 END) AS Red_blood_cell_unit_count,
            SUM(CASE WHEN component = 20 THEN 1 ELSE 0 END) AS Fresh_Frozen_Plasma_unit_count,
            SUM( CASE WHEN component = "wholeblood" THEN 1 ELSE 0 END + 
                 CASE WHEN component = 18 THEN 1 ELSE 0 END +
                 CASE WHEN component = 20 THEN 1 ELSE 0 END +
                 CASE WHEN component = 886 THEN 1 ELSE 0 END +
                 CASE WHEN component = 21 THEN 1 ELSE 0 END + 
                 CASE WHEN component = 22 THEN 1 ELSE 0 END
            ) AS total_component_count');
        $this->db->where_In('bl_blood_record.component',[18,20,21,22,'wholeblood',886]);

            if(empty($post['start_date']) || empty($post['end_date'])) {
                $days_filter = $post['days_filter'];
                if($days_filter == 0) {
                    $this->db->join('bl_blood_record', 'bl_blood_banks.blood_bank_id = bl_blood_record.bloodbank_id
                    AND bl_blood_record.cross_match = "'.$txt.'" AND bl_blood_record.status IS NULL AND 
                    AND DATE(bl_blood_record.expiry_date) > "' . $current_date . '" 
                    DATE(bl_blood_record.created_at) = "' . $current_date . '"', 'left');
    
                } else {  
                    $this->db->join('bl_blood_record', 'bl_blood_banks.blood_bank_id = bl_blood_record.bloodbank_id
                    AND bl_blood_record.cross_match = "'.$txt.'" AND bl_blood_record.status IS NULL 
                    AND DATE(bl_blood_record.expiry_date) > "' . $current_date . '" 
                    AND bl_blood_record.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"', 'left');
    
                 } 
            }
             if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
                $start_date = date('Y-m-d', strtotime($post['start_date']));
                $end_date = date('Y-m-d', strtotime($post['end_date']));
                $this->db->join('bl_blood_record', 'bl_blood_banks.blood_bank_id = bl_blood_record.bloodbank_id
                AND bl_blood_record.issue_status = "'.$txt.'" AND bl_blood_record.status IS NULL
                AND DATE(bl_blood_record.expiry_date) > "' . $current_date . '" 
                AND bl_blood_record.created_at >= "'.$start_date.'"  AND bl_blood_record.created_at <= "'.$end_date.'"', 'left');
               
            } 
            $this->db->group_by('bl_blood_banks.blood_bank_id');
            if($_SESSION['admin_type'] == 5){
                $B_id = $_SESSION['bank_id'];
                $this->db->where('bl_blood_banks.blood_bank_id = "' . $B_id . '"');
            }
            $this->db->where('bl_blood_banks.org_type', 'Blood Bank');
        
        $this->db->order_by('whole_blood_unit_count', 'DESC');
        $this->db->order_by('Fresh_Frozen_Plasma_unit_count', 'DESC');
        $this->db->order_by('Red_blood_cell_unit_count', 'DESC');
        $this->db->order_by('Platelet_rich_concentrate_unit_count', 'DESC');
        
          
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
    
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _get_bb_camp($post=array(),$param=array(),$count=FALSE,$return_query=FALSE) {
       
        $current_date = date('Y-m-d'); 
        $this->db->select('bl_blood_banks.short_name,bl_bloodcamp.blood_name,bl_bloodcamp.start_date,bl_bloodcamp.end_date,
        bl_districts.district_name as city_name,bl_bloodcamp.venue');
        $this->db->join('bl_bloodcamp', 'bl_blood_banks.blood_bank_id = bl_bloodcamp.bloodbank_id');
        $this->db->join('bl_districts', 'bl_bloodcamp.city = bl_districts.id');
        if(isset($post['name']) && $post['name'] != "") {
            $this->db->like('bl_bloodcamp.blood_name', $post['name']);
        }
        if(isset($post['venue']) && $post['venue'] != "") {
            $this->db->like('bl_bloodcamp.venue', $post['venue']);
        }
        if(isset($post['bloodbank_id']) && $post['bloodbank_id'] != "") {
            $this->db->where('bl_bloodcamp.bloodbank_id', $post['bloodbank_id']);
        }
        if(isset($post['city']) && $post['city'] != "") {
            $this->db->where('bl_bloodcamp.city', $post['city']);
        }
        
        if($_SESSION['admin_type'] == 5){
            $B_id = $_SESSION['bank_id'];
            $this->db->where('bl_bloodcamp.bloodbank_id = "' . $B_id . '"');

        }
         
            if (empty($post['start_date']) || empty($post['end_date'])) {
                $current_date = date('Y-m-d');
                $days_filter = $post['days_filter'];
                if ($days_filter == 0) {
                    $this->db->where('bl_bloodcamp.start_date >= "' . $current_date . '"');
                } else {
                    $end_date = date('Y-m-d', strtotime('+' . $days_filter . ' days', strtotime($current_date)));
                    $this->db->where('bl_bloodcamp.start_date >= "'.$current_date.'"  AND bl_bloodcamp.start_date <= "'.$end_date.'"');
                }
            }
            if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
                $start_date = date('Y-m-d', strtotime($post['start_date']));
                $end_date = date('Y-m-d', strtotime($post['end_date']));
                $this->db->where('bl_bloodcamp.start_date >= "'.$start_date.'"  AND bl_bloodcamp.start_date <= "'.$end_date.'"');
            } 
            $this->db->group_by('bl_blood_banks.blood_bank_id');

            $this->db->where('bl_blood_banks.org_type', 'Blood Bank');
          
        // Execute query
        if($count == FALSE) {
            if(isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);   
            }
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->result();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }       
        } else if($count == TRUE) {
            $query = $this->db->get('bl_blood_banks');
            if($return_query == FALSE) {
                return $query->num_rows();
            } else if($return_query == TRUE) {
                return $this->db->last_query();
            }           
        }
    }
    public function _get_bg_req_met($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){

        $this->db->select('bl_crossmatch.*, bl_requestblood.mobile as mobile , bl_requestblood.consultant as doc');
        $this->db->where('bl_crossmatch.bloodbank_id',$post['bb_id']);
        $this->db->join('bl_requestblood', 'bl_crossmatch.request = bl_requestblood.request');
        $this->db->where_In('bl_crossmatch.component',[18,20,21,22,'wholeblood']);
        // $this->db->where('bl_crossmatch.status','issued');
        if(isset($post['blood_group']) && $post['blood_group'] != "") {
            $this->db->where('bl_crossmatch.blood_group',$post['blood_group']);
        }
        if(isset($post['name']) && $post['name'] != "") {
            $this->db->where('bl_crossmatch.p_name',$post['name']);
        }
        if(empty($post['start_date']) || empty($post['end_date'])) {
            $current_date = date('Y-m-d');
            $days_filter = $post['days_filter']; 
            if($days_filter == 0) {
                $this->db->where('DATE(bl_requestblood.created_at) = "' . $current_date . '"');
            } else {          
                $this->db->where('bl_requestblood.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"');
             } 
        }
         if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->where('bl_requestblood.created_at >= "'.$start_date.'"  AND bl_requestblood.created_at <= "'.$end_date.'" ');  
        }
        $i = 0;
        if(isset($param['column_search'])){
        foreach ($param['column_search'] as $item)
        {
        if(isset($post['search']['value']) && $post['search']['value'])
        {

        if($i===0)
        {
        $this->db->group_start();
        $this->db->like($item, $post['search']['value']);
        }
        else
        {
        $this->db->or_like($item, $post['search']['value']);
        }

        if(count($param['column_search']) - 1 == $i)
        $this->db->group_end();
        }

        $i++;
        }
        }
        if(isset($post['order']))
        {
        $column_order=$param['column_order'];
        $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } 
        else if(isset($param['order']))
        {
        $order = $param['order'];
        $this->db->order_by(key($order), $order[key($order)]);
        }

        if($count==FALSE){
        if(isset($post['length']) && $post['length'] != -1){
        $this->db->limit($post['length'],$post['start']);   
        }

        $query = $this->db->get('bl_crossmatch');

        if($return_query==FALSE){
        return $query->result();
        }else if($return_query==TRUE){
        return $this->db->last_query();
        }       

        }else if($count==TRUE){
        $query = $this->db->get('bl_crossmatch');
        if($return_query==FALSE){
        return $query->num_rows();
        }else if($return_query==TRUE){
        return $this->db->last_query();
        }           
        }
    }
    public function _get_bg_req($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){

        $this->db->select('bl_crossmatch.*, bl_requestblood.mobile as mobile ,bl_requestblood.p_name as pname, 
        bl_requestblood.consultant as doc , bl_requestblood.required_date as required_date , bl_requestblood.components_unit as components_unit');
       
        $this->db->join('bl_crossmatch', 'bl_requestblood.request = bl_crossmatch.request', 'left');
        if(isset($post['component']) && $post['component'] != "") {
            if($post['component'] == 18){
                $this->db->where_in('bl_crossmatch.component',[18,'wholeblood']);
            }else{
                $this->db->where('bl_crossmatch.component',$post['component']);
            }
        }
        if(isset($post['blood_group']) && $post['blood_group'] != "") {
            $this->db->where('bl_crossmatch.blood_group',$post['blood_group']);
        }
        if(isset($post['name']) && $post['name'] != "") {
            $this->db->where('bl_crossmatch.p_name',$post['name']);
        }
        if(empty($post['start_date']) || empty($post['end_date'])) {
            $current_date = date('Y-m-d');
            $days_filter = $post['days_filter']; 
            if($days_filter == 0) {
                $this->db->where('DATE(bl_crossmatch.created_at) = "' . $current_date . '"');
            } else {          
                $this->db->where('bl_crossmatch.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"');
             } 
        }
        if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
            $start_date = date('Y-m-d', strtotime($post['start_date']));
            $end_date = date('Y-m-d', strtotime($post['end_date']));
            $this->db->where('bl_crossmatch.created_at >= "'.$start_date.'"  AND bl_crossmatch.created_at <= "'.$end_date.'" ');  
        }         
        $this->db->where('bl_crossmatch.bloodbank_id',$post['bb_id']);
        $this->db->where('bl_crossmatch.status','crossmatch');
        $i = 0;
        if(isset($param['column_search'])){
        foreach ($param['column_search'] as $item)
        {
        if(isset($post['search']['value']) && $post['search']['value'])
        {

        if($i===0)
        {
        $this->db->group_start();
        $this->db->like($item, $post['search']['value']);
        }
        else
        {
        $this->db->or_like($item, $post['search']['value']);
        }

        if(count($param['column_search']) - 1 == $i)
        $this->db->group_end();
        }

        $i++;
        }
        }
        if(isset($post['order']))
        {
        $column_order=$param['column_order'];
        $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } 
        else if(isset($param['order']))
        {
        $order = $param['order'];
        $this->db->order_by(key($order), $order[key($order)]);
        }

        if($count==FALSE){
        if(isset($post['length']) && $post['length'] != -1){
        $this->db->limit($post['length'],$post['start']);   
        }

        $query = $this->db->get('bl_requestblood');

        if($return_query==FALSE){
        return $query->result();
        }else if($return_query==TRUE){
        return $this->db->last_query();
        }       

        }else if($count==TRUE){
        $query = $this->db->get('bl_requestblood');
        if($return_query==FALSE){
        return $query->num_rows();
        }else if($return_query==TRUE){
        return $this->db->last_query();
        }           
        }
    }
    public function _get_bg($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){
            $this->db->select('bl_bb_donatioform.*');
            if($post['g_type'] == 'A_pos'){
            $bloodtype = "A+";
            }elseif($post['g_type'] == 'B_pos'){
            $bloodtype = "B+";
            }elseif($post['g_type'] == 'A_neg'){
            $bloodtype = "A-";
            }elseif($post['g_type'] == 'B_neg'){
            $bloodtype = "B-";
            }elseif($post['g_type'] == 'AB_pos'){
            $bloodtype = "AB+";
            }elseif($post['g_type'] == 'AB_neg'){
            $bloodtype = "AB-";
            }elseif($post['g_type'] == 'O_pos'){
            $bloodtype = "O+";
            }else{
            $bloodtype = "O-";
            }
            if($post['g_type'] != "All"){
            $this->db->where('blood_group',$bloodtype);
            }
            $this->db->where('bloodbank_id',$post['bb_id']);
            if($post['d_type'] == "defer"){
            $this->db->where('status','Pending');
            }
            $i = 0;
            if(empty($post['start_date']) || empty($post['end_date'])) {
                $current_date = date('Y-m-d'); 
                $days_filter = $post['days_filter'];
                if($days_filter == 0) {
                    $this->db->where('DATE(bl_bb_donatioform.created_at) = "'.$current_date.'"');
                } else {
                    $this->db->where('bl_bb_donatioform.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"');
                 } 
            }
            // if(isset($post['donation_type']) && $post['donation_type'] != "") {
            //     $this->db->where('bl_bb_donatioform.donation_type',$post['donation_type']);
            // }
            if(isset($post['name']) && $post['name'] != "") {
                $this->db->where('bl_bb_donatioform.donor_name',$post['name']);
            }
            if(isset($post['blood_group']) && $post['blood_group'] != "") {
                $this->db->where('bl_bb_donatioform.blood_group',$post['blood_group']);
            }
            if(isset($post['status']) && $post['status'] != "") {
                $this->db->where('bl_bb_donatioform.status',$post['status']);
            }
            if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
                $start_date = date('Y-m-d', strtotime($post['start_date']));
                $end_date = date('Y-m-d', strtotime($post['end_date']));
                $this->db->where('bl_bb_donatioform.created_at >= "'.$start_date.'" AND bl_bb_donatioform.created_at <= "'.$end_date.'"');  
            }

            if(isset($param['column_search'])){
            foreach ($param['column_search'] as $item)
            {
            if(isset($post['search']['value']) && $post['search']['value'])
            {

            if($i===0)
            {
            $this->db->group_start();
            $this->db->like($item, $post['search']['value']);
            }
            else
            {
            $this->db->or_like($item, $post['search']['value']);
            }

            if(count($param['column_search']) - 1 == $i)
            $this->db->group_end();
            }

            $i++;
            }
            }


            if(isset($post['order']))
            {
            $column_order=$param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
            } 
            else if(isset($param['order']))
            {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
            }

            if($count==FALSE){
            if(isset($post['length']) && $post['length'] != -1){
            $this->db->limit($post['length'],$post['start']);   
            }

            $query = $this->db->get('bl_bb_donatioform');

            if($return_query==FALSE){
            return $query->result();
            }else if($return_query==TRUE){
            return $this->db->last_query();
            }       

            }else if($count==TRUE){
            $query = $this->db->get('bl_bb_donatioform');
            if($return_query==FALSE){
            return $query->num_rows();
            }else if($return_query==TRUE){
            return $this->db->last_query();
            }           
            }
}

public function _get_bg_app($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){
    
        if($post['g_type'] == 'A_pos'){
        $bloodtype = 1;
        }elseif($post['g_type'] == 'B_pos'){
        $bloodtype = 5;
        }elseif($post['g_type'] == 'A_neg'){
        $bloodtype = 2;
        }elseif($post['g_type'] == 'B_neg'){
        $bloodtype = 6;
        }elseif($post['g_type'] == 'AB_pos'){
        $bloodtype = 3;
        }elseif($post['g_type'] == 'AB_neg'){
        $bloodtype = 4;
        }elseif($post['g_type'] == 'O_pos'){
        $bloodtype = 7;
        }else{
        $bloodtype = 8;
        }        
    $this->db->select('bl_customers.first_name as donor_name,bl_customers.ph_no as mobile,
    bl_blood_donation_requests.requested_schedule_date as donation_date,bl_masters.master_type_key_value as blood_group');
    
    $this->db->join('bl_customers', 'bl_customers.user_id = bl_blood_donation_requests.user_id');
    $this->db->join('bl_masters', 'bl_masters.master_id = bl_customers.blood_group');
    if(isset($post['blood_group']) && $post['blood_group'] != "") {
        $this->db->where('bl_customers.blood_group',$post['blood_group']);
    }
    if(isset($post['name']) && $post['name'] != "") {
        $this->db->where('bl_customers.first_name',$post['name']);
    }
    if(isset($post['approved_status']) && $post['approved_status'] != "") {
        $this->db->where('bl_blood_donation_requests.approved_status',$post['approved_status']);
    }
    if(isset($post['donation_status']) && $post['donation_status'] != "") {
        $this->db->where('bl_blood_donation_requests.donation_status',$post['donation_status']);
    }
    if(empty($post['start_date']) || empty($post['end_date'])) {
        $current_date = date('Y-m-d'); 

        $days_filter = $post['days_filter'];
        if($days_filter == 0) {
            $this->db->where('DATE(bl_blood_donation_requests.created_at) = "'.$current_date.'"');
        } else {
            $this->db->where('bl_blood_donation_requests.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"');
         } 
    }
     if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
        $start_date = date('Y-m-d', strtotime($post['start_date']));
        $end_date = date('Y-m-d', strtotime($post['end_date']));
        $this->db->where('bl_blood_donation_requests.created_at >= "'.$start_date.'" 
            AND bl_blood_donation_requests.created_at <= "'.$end_date.'"');  
    }
    if($post['g_type'] != "All"){
    $this->db->where('bl_customers.blood_group',$bloodtype);
    }
    $this->db->where('bl_blood_donation_requests.org_id',$post['bb_id']);
    $i = 0;

    if(isset($param['column_search'])){
    foreach ($param['column_search'] as $item)
    {
    if(isset($post['search']['value']) && $post['search']['value'])
    {

    if($i===0)
    {
    $this->db->group_start();
    $this->db->like($item, $post['search']['value']);
    }
    else
    {
    $this->db->or_like($item, $post['search']['value']);
    }

    if(count($param['column_search']) - 1 == $i)
    $this->db->group_end();
    }

    $i++;
    }
    }

        if(isset($post['order']))
        {
        $column_order=$param['column_order'];
        $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } 
        else if(isset($param['order']))
        {
        $order = $param['order'];
        $this->db->order_by(key($order), $order[key($order)]);
        }

        if($count==FALSE){
        if(isset($post['length']) && $post['length'] != -1){
        $this->db->limit($post['length'],$post['start']);   
        }

    $query = $this->db->get('bl_blood_donation_requests');

        if($return_query==FALSE){
        return $query->result();
        }else if($return_query==TRUE){
        return $this->db->last_query();
        }       

    }else if($count==TRUE){
        $query = $this->db->get('bl_blood_donation_requests');
        if($return_query==FALSE){
        return $query->num_rows();
        }else if($return_query==TRUE){
        return $this->db->last_query();
        }           
    }
}
public function _get_bg_app_req($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){
    
    if($post['g_type'] == 'A_pos'){
    $bloodtype = 'A+';
    }elseif($post['g_type'] == 'B_pos'){
    $bloodtype = 'B+';
    }elseif($post['g_type'] == 'A_neg'){
    $bloodtype = 'A-';
    }elseif($post['g_type'] == 'B_neg'){
    $bloodtype = 'B-';
    }elseif($post['g_type'] == 'AB_pos'){
    $bloodtype = 'AB+';
    }elseif($post['g_type'] == 'AB_neg'){
    $bloodtype = 'AB-';
    }elseif($post['g_type'] == 'O_pos'){
    $bloodtype = 'O+';
    }else{
    $bloodtype = 'O-';
    }
    
$this->db->select('bl_blood_request.p_name as donor_name,bl_blood_request.phone as mobile,
bl_blood_request.requested_schedule_date as donation_date,bl_blood_request.blood_group as blood_group');

if(empty($post['start_date']) || empty($post['end_date'])) {
    $current_date = date('Y-m-d'); 

    $days_filter = $post['days_filter'];
    if($days_filter == 0) {
        $this->db->where('DATE(bl_blood_request.created_at) = "'.$current_date.'"');

    } else {
        
        $this->db->where('bl_blood_request.created_at >= "' . date('Y-m-d', strtotime('-' . $days_filter . ' days')) . '"');
     } 
}
 if(isset($post['start_date']) && !empty($post['start_date']) && isset($post['end_date']) && !empty($post['end_date'])) {
    $start_date = date('Y-m-d', strtotime($post['start_date']));
    $end_date = date('Y-m-d', strtotime($post['end_date']));
    $this->db->where('bl_blood_request.created_at >= "'.$start_date.'" 
        AND bl_blood_request.created_at <= "'.$end_date.'"');  
   
}
if($post['g_type'] != "All"){
$this->db->where('bl_blood_request.blood_group',$bloodtype);
}
$this->db->where('bl_blood_request.org_id',$post['bb_id']);
$i = 0;

if(isset($param['column_search'])){
foreach ($param['column_search'] as $item)
{
if(isset($post['search']['value']) && $post['search']['value'])
{

if($i===0)
{
$this->db->group_start();
$this->db->like($item, $post['search']['value']);
}
else
{
$this->db->or_like($item, $post['search']['value']);
}

if(count($param['column_search']) - 1 == $i)
$this->db->group_end();
}

$i++;
}
}

    if(isset($post['order']))
    {
    $column_order=$param['column_order'];
    $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
    } 
    else if(isset($param['order']))
    {
    $order = $param['order'];
    $this->db->order_by(key($order), $order[key($order)]);
    }

    if($count==FALSE){
    if(isset($post['length']) && $post['length'] != -1){
    $this->db->limit($post['length'],$post['start']);   
    }

    $query = $this->db->get('bl_blood_request');

    if($return_query==FALSE){
    return $query->result();
    }else if($return_query==TRUE){
    return $this->db->last_query();
    }       

}else if($count==TRUE){
    $query = $this->db->get('bl_blood_request');
    if($return_query==FALSE){
    return $query->num_rows();
    }else if($return_query==TRUE){
    return $this->db->last_query();
    }           
}
}
  //Hospitals
    public function _get_hospitals($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){
            $type= 'Hospital';
        $this->db->select('blood_banks.*,users.*,states.state_name,cities.city_name,districts.district_name');
        $this->db->join('users','blood_banks.user_id=users.id','LEFT');
        $this->db->join('states','blood_banks.state_id=states.id','LEFT');
        $this->db->join('cities','blood_banks.city_id=cities.id','LEFT');
        $this->db->join('districts','blood_banks.district_id=districts.id','LEFT');
        $this->db->where('blood_banks.org_type', $type);
        $i = 0;

        if(isset($param['state_id'])){
            $this->db->where('state_id',$param['state_id']);
        }

        if(isset($param['city_id'])){
            $this->db->where('city_id',$param['city_id']);
        }

        if(isset($param['column_search'])){
            foreach ($param['column_search'] as $item)
            {
                if(isset($post['search']['value']) && $post['search']['value'])
                {
                    
                    if($i===0)
                    {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if(count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }
                
                $i++;
            }
        }

            
        if(isset($post['order']))
        {
            $column_order=$param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } 
        else if(isset($param['order']))
        {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if($count==FALSE){
            if(isset($post['length']) && $post['length'] != -1){
                $this->db->limit($post['length'],$post['start']);   
            }
            
            $query = $this->db->get('blood_banks');

            if($return_query==FALSE){
                return $query->result();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }       
            
        }else if($count==TRUE){
            $query = $this->db->get('blood_banks');
            if($return_query==FALSE){
                return $query->num_rows();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }           
        }

    }


    //Blood Banks
    public function _get_blood_banks($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){
        $type= 'Blood Bank';
        $this->db->select('blood_banks.*,users.*,states.state_name,cities.city_name,districts.district_name');
        $this->db->join('users','blood_banks.user_id=users.id','LEFT');
        $this->db->join('states','blood_banks.state_id=states.id','LEFT');
        $this->db->join('cities','blood_banks.city_id=cities.id','LEFT');
        $this->db->join('districts','blood_banks.district_id=districts.id','LEFT');
        $this->db->where('blood_banks.org_type', $type);
        $i = 0;

        if(isset($param['state_id'])){
            $this->db->where('state_id',$param['state_id']);
        }

        if(isset($param['city_id'])){
            $this->db->where('city_id',$param['city_id']);
        }

        if(isset($param['column_search'])){
            foreach ($param['column_search'] as $item)
            {
                if(isset($post['search']['value']) && $post['search']['value'])
                {
                    
                    if($i===0)
                    {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if(count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }
                
                $i++;
            }
        }

            
        if(isset($post['order']))
        {
            $column_order=$param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } 
        else if(isset($param['order']))
        {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if($count==FALSE){
            if(isset($post['length']) && $post['length'] != -1){
                $this->db->limit($post['length'],$post['start']);   
            }
            
            $query = $this->db->get('blood_banks');

            if($return_query==FALSE){
                return $query->result();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }       
            
        }else if($count==TRUE){
            $query = $this->db->get('blood_banks');
            if($return_query==FALSE){
                return $query->num_rows();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }           
        }
    }
    public function store_mics_data($data,$return_query=FALSE){
        $this->table='misc_infos';
        return $this->store($data,FALSE,$return_query);
    }

    public function update_mics_data($data,$param,$batch=FALSE,$return_query=FALSE){
        $this->table='misc_infos';
        return $this->modify($data,$param,$batch,$return_query);
    }

    public function delete_mics_datas($param,$return_query=FALSE){
        $this->table='misc_infos';
        return $this->remove($param,0,$return_query);
    }

    public function get_mics_data($param,$single_row=TRUE,$return_query=FALSE){
        $this->table='misc_infos';
        if($single_row==TRUE){
            return $this->get_one($param,'',$return_query);
        }else if($single_row==FALSE){
            return $this->get_many($param,null,null,$return_query);
        }       
    }

}