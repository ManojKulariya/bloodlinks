<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Common  extends BaseFrontController
{
    public function onGetStates(){
        // if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){

            $states=$this->sm->get_states(array('state_status'=>'active'),FALSE);


            if(!empty($states)){
                foreach ($states as $key => $value) {
                    $_states[]=array(
                        'state_id'=>$value->id,
                        'state_name'=>$value->state_name,
                        'selected'=>''
                    );
                }
            }else{
                $_states=array();
            }

            return json_headers($_states);

        // }else{
        //     redirect(base_url());
        // }
    }

    public function onGetDistricts(){
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
            redirect(base_url());
        }
    }

    public function onGetCities(){
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
                redirect(base_url());
            }
    }



    public function District(){
       
            $Data = json_decode(file_get_contents('php://input'), true);

            $state_id = $Data['state_id'];
        
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

      
    }

    public function City(){
          $Data = json_decode(file_get_contents('php://input'), true);

            $state_id = $Data['state_id'];
            $district_id = $Data['district_id'];
              
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

           
    }
}