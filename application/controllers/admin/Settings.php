<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Settings  extends BaseAdminController
{
    function __construct()
    {
        parent::__construct();
    }


    //Masters

    function indexSettingsBloodGroups(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Blood Groups';

            $this->theme->title($this->data['page_title'])->load('settings/vw_blood_groups', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }


    function indexSettingsBagsTypes(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Bag Types';

            $this->theme->title($this->data['page_title'])->load('settings/vw_bag_types', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }


    function indexSettingsTTLTypes(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='TTL Types';

            $this->theme->title($this->data['page_title'])->load('settings/vw_ttl_types', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }

    function indexSettingsComponentTypes(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Components Types';

            $this->theme->title($this->data['page_title'])->load('settings/vw_component_types', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }


    function indexSettingsDonationTypes(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Donation Types';

            $this->theme->title($this->data['page_title'])->load('settings/vw_donation_types', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }

    function indexSettingsDonarTypes(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Donar Types';

            $this->theme->title($this->data['page_title'])->load('settings/vw_donar_types', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }


    function indexSettingsOrganisationTypes(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Organisation Types';

            $this->theme->title($this->data['page_title'])->load('settings/vw_organisation_types', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }


    function indexSettingsDiagnosisTypes(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Diagnosis Types';

            $this->theme->title($this->data['page_title'])->load('settings/vw_diagnosis_types', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }


    function indexSettingsCoombsMethods(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Coombs Methods';

            $this->theme->title($this->data['page_title'])->load('settings/vw_coombs_methods', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }

    function indexSettingsCampCodes(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Camp Codes';

            $this->theme->title($this->data['page_title'])->load('settings/vw_camp_codes', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }
    function indexagency(){
       
        if(session_userdata('isAdminLoggedin')){ 

            $this->data['page_title']='Agency';

            $this->theme->title($this->data['page_title'])->load('settings/vw_agency', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }

    function indexSettingsReturnReason(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Return Reason';

            $this->theme->title($this->data['page_title'])->load('settings/vw_return_reason', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }


    function indexSettingsDiscardReason(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Discard Reason';

            $this->theme->title($this->data['page_title'])->load('settings/vw_discard_reason', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }

    function indexSettingsRequestDateStatus(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Request Date Status';

            $this->theme->title($this->data['page_title'])->load('settings/vw_request_date_status', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }


    public function onSearchMasters(){
        if(session_userdata('isAdminLoggedin')==TRUE && session_userdata('admin_id')){
            if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){
                $param['column_order'] = array(
                    null,
                    'master_type_name',
                    'master_type_key_value'
                );

                $param['column_search'] = array('master_type_name','master_type_key_value');
                $param['order'] = array('master_id' => 'ASC');
                $posts=$this->input->post();

                //$param['type_key']='blood_groups';

                $list = $this->sm->_get_masters($posts,$param,FALSE,FALSE);

                //print_obj($list);die;
                
                $data = array();
                $no = isset($posts['start'])?$posts['start']:0;

                $action='';

                foreach ($list as $master){
                    $no++;

                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $master->master_type_key_value;    
                    if(isset($posts['show_short_code']) && $posts['show_short_code']=='yes'){
                        $row[]  =   $master->master_type_key_short_value;
                    }                
                    $row[]  =   '<a href="'.$this->data['base_url'].'/settings/masters_edit/'.$master->master_id.'" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$master->master_id.');" ><i class="fa fa-trash"></i></button> ';

                    $data[] = $row; 
                }

                $output = array(
                    "draw" => isset($posts['draw'])?$posts['draw']:'',
                    "recordsTotal" => $this->sm->_get_masters($posts,$param,TRUE),
                    "recordsFiltered" => $this->sm->_get_masters($posts,$param,TRUE),
                    "data" => $data,
                );
                
                echo json_encode($output);

            }else{
                redirect($this->data['base_url']);
            }
        }else{
            redirect($this->data['base_url']);
        }
    }
    public function agency_search(){
        if(session_userdata('isAdminLoggedin')==TRUE && session_userdata('admin_id')){
            if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){
                $param['column_order'] = array(
                    null,
                    'a_name',
                );
                $param['column_search'] = array('a_name');
                $param['order'] = array('id' => 'ASC');
                $posts=$this->input->post();
                $list = $this->sm->_get_agency($posts,$param,FALSE,FALSE);
                $data = array();
                $no = isset($posts['start'])?$posts['start']:0;
                $action='';

                foreach ($list as $master){
                    $no++;
                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $master->type;    
                    $row[]  =   $master->a_name;    
                    $row[]  =   $master->email;    
                    $row[]  =   $master->phon;    
                    $row[]  =   $master->address;    
                    $row[] = '<a href="#" class="btn btn-xs btn-danger btn_edit_data" 
                    onclick="editMaster(' . $master->id . ', \'' . addslashes($master->type) . '\', \'' . addslashes($master->a_name) . '\', \'' . addslashes($master->email) . '\', \'' . addslashes($master->phon) . '\', \'' . addslashes($master->address) . '\')">
                    <i class="fa fa-pen"></i></a>
                    <button type="button" class="btn btn-xs btn-dark" onclick="deleteagency(' . $master->id . ');"><i class="fa fa-trash"></i></button>';
                    $data[] = $row; 
                }

                $output = array(
                    "draw" => isset($posts['draw'])?$posts['draw']:'',
                    "recordsTotal" => $this->sm->_get_agency($posts,$param,TRUE),
                    "recordsFiltered" => $this->sm->_get_agency($posts,$param,TRUE),
                    "data" => $data,
                );
                
                echo json_encode($output);

            }else{
                redirect($this->data['base_url']);
            }
        }else{
            redirect($this->data['base_url']);
        }
    }
    public function agency_add(){
        if(session_userdata('isAdminLoggedin')==TRUE && session_userdata('admin_id')){
            if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){
                $masters_id=post_data('masters_id');
                $a_name=post_data('a_name');
                $email=post_data('email');
                $address=post_data('address');
                $phon=post_data('phon');
                $type=post_data('type');
                $b_id=$_SESSION['bank_id'];
                if(empty($masters_id)){
                    $added= $this->db->query("INSERT INTO bl_agency (a_name,email,phon,address,type,created_by)
                     VALUES ('$a_name','$email','$phon','$address','$type','$b_id')");
                    if($added){
                        $return['success']=$a_name.' added successfully';
                    }else{
                        $return['error']='Data not saved';
                    }
                }else{
                    $updated = $this->db->query("UPDATE bl_agency 
                        SET a_name = '$a_name', email = '$email', phon = '$phon', address = '$address', type = '$type', created_by = '$b_id' 
                        WHERE id = $masters_id
                    ");
                    if($updated){
                        $return['success']=$a_name.' updated successfully';
                    }else{
                        $return['error']='Data not saved';
                    }
                }
                return json_headers($return);
            }else{
                redirect($this->data['base_url']);
            }
        }else{
            redirect($this->data['base_url']);
        }
    }
    public function onAddEditMaters(){
        if(session_userdata('isAdminLoggedin')==TRUE && session_userdata('admin_id')){
            if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){
                        // print_r($_POST);die();
                $masters_id=post_data('masters_id');
                $masters_type=post_data('masters_type');
                $masters_type_name=post_data('masters_type_name');
                $masters_status=post_data('masters_status');
                $masters_value=post_data('masters_value');

                if (!empty(post_data('expiry_day'))) {
                    $expiry_day=post_data('expiry_day');
                    $min_volume=post_data('min_volume');
                    $max_volume=post_data('max_volume');
                }else{
                    $expiry_day='';
                    $min_volume='';
                    $max_volume='';
                }
                
                
                if($this->input->post('masters_short_value')){
                    $masters_short_value=post_data('masters_short_value');
                }else{
                    $masters_short_value=null;
                }

                $master_data=array(
                    'master_type_name'=>$masters_type_name,
                    'master_type_key'=>$masters_type,
                    'master_type_key_value'=>$masters_value,
                    'master_type_key_short_value'=>$masters_short_value,
                    'master_type_key_status'=>$masters_status,
                    'expiry_day'=>$expiry_day,
                    'min_volume'=>$min_volume,
                    'max_volume'=>$max_volume,
                    'master_type_created_at'=>date('Y-m-d'),
                    'master_type_created_by'=>$this->data['userdata']->id
                );

                if(empty($masters_id)){

                    $_data_to_add=array_merge($master_data,array('master_type_created_at'=>date('Y-m-d'),
                        'master_type_created_by'=>$this->data['userdata']->id));

                    $added=$this->sm->store_master($_data_to_add);

                    if($added){
                        $return['success']=$masters_type_name.' added successfully';
                        if($masters_type == "component_types"){

                            $id = $this->db->insert_id();
                            //print_r($id);die();
                            $com_insert = $this->db->query("INSERT INTO bl_bloodstock (component_id, a+, a-, ab+, ab-, b+, b-, o+, o- ) VALUES ('$id','0', '0', '0','0' , '0','0', '0','0')");
                        }
                    }else{
                        $return['error']='Data not saved';
                    }

                }else{
                    $master_id=decode_data($masters_id);

                    $get_masters=$this->sm->get_masters(array('master_id'=>$master_id));

                    if(!empty($get_masters)){
                        $_data_to_add=array_merge($master_data,array('master_type_updated_at'=>date('Y-m-d'),
                        'master_type_updated_by'=>$this->data['userdata']->id));

                        $updated=$this->sm->update_master($_data_to_add,array('master_id'=>$master_id));

                        if($updated){
                            $return['success']=$masters_type_name.' updated successfully';
                        }else{
                            $return['error']='Data not saved';
                        }
                    }else{
                        $return['error']='No data fopund to update';
                    }
                }


                return json_headers($return);


            }else{
                redirect($this->data['base_url']);
            }
        }else{
            redirect($this->data['base_url']);
        }
    }


    function masters_edit(){

    if(session_userdata('isAdminLoggedin')){

        $this->data['page_title']='Master Edit';

        $this->theme->title($this->data['page_title'])->load('settings/vw_master_edit', $this->data);
    }else{

        redirect($this->data['base_url']);
    }
}
public function ajency_delete(){
   $id=$this->input->post('id');
   $dataDelete = $this->db->query("UPDATE bl_agency SET isdeleted = 1  WHERE id = $id");
   if ($dataDelete==true) {
 
       echo "1";
 
    }else{
      echo "2";
    }
  }
 public function masters_delete(){
   // echo 'hiiii'; die;
 // alert('sdadassad'); die();
  $id=$this->input->post('id');
  $dataDelete = $this->db->query("DELETE FROM bl_masters WHERE master_id = '$id'");
     // echo $dataDelete; die;
  if ($dataDelete==true) {

      echo "1";

   }else{
     echo "2";
   }
 }

    //Google Api 
    function indexSettingsGoogle_api(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Google API';

            $this->theme->title($this->data['page_title'])->load('settings/vw_googleapi', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }

public function onSearchGoogle_api(){
        if(session_userdata('isAdminLoggedin')==TRUE && session_userdata('admin_id')){
            if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){
                $param['column_order'] = array(
                    null,
                    'api_link'
                );

                $param['column_search'] = array('api_link');
                $param['order'] = array('id' => 'ASC');
                $posts=$this->input->post();

                //$param['type_key']='blood_groups';

                $list = $this->sm->_get_googleapi($posts,$param,FALSE,FALSE);

                //print_obj($list);die;
                
                $data = array();
                $no = isset($posts['start'])?$posts['start']:0;

                $action='';

                foreach ($list as $state){
                    $no++;

                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $state->api_link;    
              
                    $row[]  =   '<button type="button" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type=""><i class="fa fa-pen"></i></button>
                    <button type="button" class="btn btn-xs btn-dark btn_del_data" data-master_id=""><i class="fa fa-trash"></i></button>';

                    $data[] = $row; 
                }

                $output = array(
                    "draw" => isset($posts['draw'])?$posts['draw']:'',
                    "recordsTotal" => $this->sm->_get_googleapi($posts,$param,TRUE),
                    "recordsFiltered" => $this->sm->_get_googleapi($posts,$param,TRUE),
                    "data" => $data,
                );
                
                echo json_encode($output);

            }else{
                redirect($this->data['base_url']);
            }
        }else{
            redirect($this->data['base_url']);
        }
    }


    //States
    function indexSettingsStates(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='States';

            $this->theme->title($this->data['page_title'])->load('settings/vw_states', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }


    function indexSettingsDistricts(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Districts';

            $this->theme->title($this->data['page_title'])->load('settings/vw_districts', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }


    function indexSettingsCities(){
       
        if(session_userdata('isAdminLoggedin')){

            $this->data['page_title']='Cities';

            $this->theme->title($this->data['page_title'])->load('settings/vw_cities', $this->data);
        }else{

            redirect($this->data['base_url']);
        }
    }


    public function onSearchStates(){
        if(session_userdata('isAdminLoggedin')==TRUE && session_userdata('admin_id')){
            if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){
                $param['column_order'] = array(
                    null,
                    'state_name'
                );

                $param['column_search'] = array('state_name');
                $param['order'] = array('id' => 'ASC');
                $posts=$this->input->post();

                //$param['type_key']='blood_groups';

                $list = $this->sm->_get_states($posts,$param,FALSE,FALSE);

                //print_obj($list);die;
                
                $data = array();
                $no = isset($posts['start'])?$posts['start']:0;

                $action='';

                foreach ($list as $state){
                    $no++;

                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $state->state_name;    
              
                    $row[]  =   '<button type="button" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type=""><i class="fa fa-pen"></i></button>
                    <button type="button" class="btn btn-xs btn-dark btn_del_data" data-master_id=""><i class="fa fa-trash"></i></button>';

                    $data[] = $row; 
                }

                $output = array(
                    "draw" => isset($posts['draw'])?$posts['draw']:'',
                    "recordsTotal" => $this->sm->_get_states($posts,$param,TRUE),
                    "recordsFiltered" => $this->sm->_get_states($posts,$param,TRUE),
                    "data" => $data,
                );
                
                echo json_encode($output);

            }else{
                redirect($this->data['base_url']);
            }
        }else{
            redirect($this->data['base_url']);
        }
    }

    //States


    //Districts

    public function onSearchDistricts(){
        if(session_userdata('isAdminLoggedin')==TRUE && session_userdata('admin_id')){
            if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){
                $param['column_order'] = array(
                    null,
                    'district_name',
                    'state_name'
                );

                $param['column_search'] = array('district_name','state_name');
                $param['order'] = array('id' => 'ASC');
                $posts=$this->input->post();

                //$param['type_key']='blood_groups';

                $list = $this->sm->_get_districts($posts,$param,FALSE,FALSE);

                //print_obj($list);die;
                
                $data = array();
                $no = isset($posts['start'])?$posts['start']:0;

                $action='';

                foreach ($list as $state){
                    $no++;

                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $state->district_name;    
                    $row[]  =   $state->state_name;
                    $row[]  =   '<button type="button" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type=""><i class="fa fa-pen"></i></button>
                    <button type="button" class="btn btn-xs btn-dark btn_del_data" data-master_id=""><i class="fa fa-trash"></i></button>';

                    $data[] = $row; 
                }

                $output = array(
                    "draw" => isset($posts['draw'])?$posts['draw']:'',
                    "recordsTotal" => $this->sm->_get_districts($posts,$param,TRUE),
                    "recordsFiltered" => $this->sm->_get_districts($posts,$param,TRUE),
                    "data" => $data,
                );
                
                echo json_encode($output);

            }else{
                redirect($this->data['base_url']);
            }
        }else{
            redirect($this->data['base_url']);
        }
    }


    //Districts


    //Cities

    public function onSearchCities(){
        if(session_userdata('isAdminLoggedin')==TRUE && session_userdata('admin_id')){
            if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){
                $param['column_order'] = array(
                    null,
                    'city_name',
                    'district_name',
                    'state_name'
                );

                $param['column_search'] = array('city_name','district_name','state_name');
                $param['order'] = array('id' => 'ASC');
                $posts=$this->input->post();

                //$param['type_key']='blood_groups';

                $list = $this->sm->_get_cities($posts,$param,FALSE,FALSE);

                //print_obj($list);die;
                
                $data = array();
                $no = isset($posts['start'])?$posts['start']:0;

                $action='';

                foreach ($list as $city){
                    $no++;

                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $city->city_name;
                    $row[]  =   $city->district_name;    
                    $row[]  =   $city->state_name;
                    $row[]  =   '<button type="button" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type=""><i class="fa fa-pen"></i></button>
                    <button type="button" class="btn btn-xs btn-dark btn_del_data" data-master_id=""><i class="fa fa-trash"></i></button>';

                    $data[] = $row; 
                }

                $output = array(
                    "draw" => isset($posts['draw'])?$posts['draw']:'',
                    "recordsTotal" => $this->sm->_get_cities($posts,$param,TRUE),
                    "recordsFiltered" => $this->sm->_get_cities($posts,$param,TRUE),
                    "data" => $data,
                );
                
                echo json_encode($output);

            }else{
                redirect($this->data['base_url']);
            }
        }else{
            redirect($this->data['base_url']);
        }
    }

    //Cities

}