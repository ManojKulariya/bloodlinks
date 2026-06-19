<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Common  extends BaseAdminController
{
    public function onGetDistricts(){
        if(session_userdata('isAdminLoggedin')==TRUE && session_userdata('admin_id')){
            if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){

                $state_id=post_data('state_id');

                $districts=$this->sm->get_districts(array('state_id'=>$state_id),FALSE);


                if(!empty($districts)){
                    foreach ($districts as $key => $value) {
                        $_districts[]=array(
                            'district_id'=>$value->id,
                            'district_name'=>$value->district_name,
                            'selected'=>''
                        );
                    }
                }else{
                    $_districts=array();
                }

                return json_headers($_districts);

            }else{
                redirect($this->data['base_url']);
            }
        }else{
            redirect($this->data['base_url']);
        }
    }

    public function onGetCities(){
        if(session_userdata('isAdminLoggedin')==TRUE && session_userdata('admin_id')){
            if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){

                $state_id=post_data('state_id');
                $district_id=post_data('district_id');

                $cities=$this->sm->get_cities(array('state_id'=>$state_id,'district_id'=>$district_id),FALSE);


                if(!empty($cities)){
                    foreach ($cities as $key => $value) {
                        $_cities[]=array(
                            'city_id'=>$value->id,
                            'city_name'=>$value->city_name,
                            'selected'=>''
                        );
                    }
                }else{
                    $_cities=array();
                }

                return json_headers($_cities);

            }else{
                redirect($this->data['base_url']);
            }
        }else{
            redirect($this->data['base_url']);
        }
    }
}