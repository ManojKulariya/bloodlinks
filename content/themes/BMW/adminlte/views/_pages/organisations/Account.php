<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends BaseFrontController {

	public function indexPreregister()
	{
		$this->data['page_title']='Before Registering to become a blood donar';

		$ans='';

		$questions=$this->sm->get_system_questions(array('ques_type'=>'preregister'),FALSE);

		//print_obj($questions);die;

		if(!empty($questions)){
			foreach ($questions as $key => $value) {
				$_ans[]=$value->ques_ans;
			}

			$ans=char_separated($_ans);
		}

		$this->data['questions']=$questions;
		$this->data['ans']=$ans;

//print_r($ans);die;

		$this->theme->title($this->data['page_title'])->load('account/vw_preregister', $this->data);
	 }

	public function myaccount()
	{
		 if(session_userdata('user_id') && session_userdata('isUserLoggedin')==TRUE){
        $this->data['page_title']='My Account';
		$this->theme->title($this->data['page_title'])->load('account/vw_myaccount', $this->data);
        }else{
          redirect(base_url('signin'));
        }
		
	 }

	public function myappointment()
	{
		 if(session_userdata('user_id') && session_userdata('isUserLoggedin')==TRUE){
        $this->data['page_title']='My Donation Appointment';
		$this->theme->title($this->data['page_title'])->load('account/vw_myappointment', $this->data);
        }else{
          redirect(base_url('signin'));
        }
		
	 }

	 	public function myrequest()
	{
		 if(session_userdata('user_id') && session_userdata('isUserLoggedin')==TRUE){
        $this->data['page_title']='My Request Appointment';
		$this->theme->title($this->data['page_title'])->load('account/vw_myrequest_appointment', $this->data);
        }else{
          redirect(base_url('signin'));
        }
		
	 }

	 	public function about()
	{
		 
        $this->data['page_title']='About Us';
		$this->theme->title($this->data['page_title'])->load('home/about', $this->data);
       
		
	 }

	 	public function contact()
	{
		 
        $this->data['page_title']='Contact Us';
		$this->theme->title($this->data['page_title'])->load('home/contact', $this->data);
      
		
	 }

	public function indexRegister(){
		$this->data['page_title']='Register to become a blood donar';

		$this->data['months']=get_months();

		$accepted_year=date('Y')-16;
		for ($i=1900; $i <=$accepted_year ; $i++) {			
			$years[]=$i;
		}

		$this->data['years']=$years;

		for ($i=1; $i <=31 ; $i++) { 
			$days[]=$i;
		}

		$this->data['days']=$days;


		$this->data['blood_groups']=$this->sm->get_masters(array('master_type_key'=>'blood_groups'),FALSE);

		$this->theme->title($this->data['page_title'])->load('account/vw_register', $this->data);
	}


	public function indexLogin(){
		$this->data['page_title']='Signin to complete the registration';

		$this->theme->title($this->data['page_title'])->load('account/vw_login', $this->data);
	}

// public function mobile(){
	
//    print_r($_GET);die();

//  }
	public function onRegister(){
   //print_r($_GET);die();
		// if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){
		// if($this->input->server('REQUEST_METHOD')=='POST'){
		
			$cust_first_name=post_data('cust_first_name');
			$cust_mid_name=post_data('cust_mid_name');
			$cust_last_name=post_data('cust_last_name');
			$cust_email=post_data('cust_email');
			$cust_ph=post_data('cust_ph');
			$cust_fname=post_data('cust_fname');
			$cust_marital=post_data('cust_marital');
			$cust_dob_months=post_data('cust_dob_months');
			$cust_dob_years=post_data('cust_dob_years');
			$cust_dob_days=post_data('cust_dob_days');
			$cust_gender=post_data('cust_gender');
			$cust_blood_group=post_data('cust_blood_group');
			$cust_states=post_data('cust_states');
			$cust_districts=post_data('cust_districts');
			$cust_cities=post_data('cust_cities');
			$cust_address=post_data('cust_address');
			$cust_username=post_data('cust_username');
			$cust_pincode=post_data('cust_pincode');
			$cust_password=post_data('cust_password');

			$this->form_validation->set_rules('cust_first_name', 'Enter first name', 'trim|required');
            $this->form_validation->set_rules('cust_last_name', 'Enter last name', 'trim|required');
            $this->form_validation->set_rules('cust_email', 'Enter email address', 'trim|required');
            $this->form_validation->set_rules('cust_ph', 'Enter phone no', 'trim|required');
            $this->form_validation->set_rules('cust_password', 'Enter password', 'trim|required');

            if($this->form_validation->run() == true){

            	$c_found=$this->um->get_duplicate_customers(array('username'=>$cust_username));
                  // print_r($c_found);die();
            	if($c_found[0]->counted==0){

            		$dob=$cust_dob_years.'-'.$cust_dob_months.'-'.$cust_dob_days;
            		$age=calculate_age($dob);

            		if($age>=16 && $age<=50){
						$c_data_to_store=array(
	            			'first_name'=>$cust_first_name,
	            			'mid_name'=>$cust_mid_name,
	            			'last_name'=>$cust_last_name,
	            			'gender'=>$cust_gender,
	            			'email'=>$cust_email,
	            			'ph_no'=>$cust_ph,
	            			'f_name'=>$cust_fname,
	            			'marital'=>$cust_marital,
	            			'dob'=>$dob,
	            			'age'=>$age,
	            			'blood_group'=>$cust_blood_group,
	            			'state_id'=>$cust_states,
	            			'district_id'=>$cust_districts,
	            			'city_id'=>$cust_cities,
	            			'address'=>$cust_address,
	            			'username'=>$cust_username,
	            			'pincode'=>$cust_pincode,
	            			'created_at'=>date('Y-m-d')            			
	            		);
                           // print_r($c_data_to_store);die;
	            		$cust_added=$this->um->store_customers($c_data_to_store);

	            		if($cust_added){
	            			$password=password_hash($cust_password, PASSWORD_BCRYPT, array('cost'=>12));

	            			$user_data=array(
	            				'role_id'=>'3',
	            				'email'=>$cust_username,
	            				'password'=>$password,
	            				'user_verified'=>'yes',
	            				'user_status'=>'active',
	            				'created_at'=>date('Y-m-d')
	            			);

	            			$user_id=$this->um->store_users($user_data);

	            			if($user_id){
	            				$this->um->update_users(array('created_by'=>$user_id),array('id'=>$user_id));
	            				$this->um->update_customers(array('user_id'=>$user_id,'created_by'=>$user_id),array('id'=>$cust_added));
	            			}

                        $form = uniqid();
	            			    $session_data=array(
	                        'isUserLoggedin'=>true,
	                        'user_id'=>encode_data($user_id),
	                        'customer_id'=>$user_id,
	                        'form_id'=> $form,
	                        'user_type'=>"3",
	                        'loggedin_time'=>date('Y-m-d')
	                    );

                         // print_r($session_data) ;die();
	                    session_set_userdata($session_data);
	            			
                          $return['redirect'] = base_url('dashboard');
	            			$return['success']='You have registered successfully';
	            
                                
	            		}else{
	            			$return['error']='There was an error occurred';
	            		}
            		}else{
            			$return['error']='You are not eligible to register as blood donar as of your age is '.$age;
            		}

	            		

            	}else{
            		$return['error']='This username is already exists';
            	}

            }else{
            	$return['error']='Error occurred';
            }

            return json_headers($return);

	
	}

	public function onLogin(){
		//if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){

			$cust_username=post_data('cust_username');
		$cust_password=post_data('cust_password');
		//$Data = json_decode(file_get_contents('php://input'), true);

		//$cust_username = $Data['cust_username'];
		//$cust_password = $Data['cust_username'];

		//return json_headers($cust_username);


     // return json_headers($Data['cust_username']

			$this->form_validation->set_rules('cust_username', 'Enter username name', 'trim|required');
            $this->form_validation->set_rules('cust_password', 'Enter password', 'trim|required');

            if($this->form_validation->run() == true){

            	$userdata       =   $this->um->_get_user(array('email'=>$cust_username));

            	if($userdata!='' && ($userdata->user_status=='active' && $userdata->user_verified=='yes')){

            		if(password_verify($cust_password,$userdata->password)){
                      $form = uniqid();
	                    $session_data=array(
	                        'isUserLoggedin'=>true,
	                        'user_id'=>encode_data($userdata->id),
	                        'customer_id'=>$userdata->id,
	                        'form_id'=> $form,
	                        'user_type'=>$userdata->role_id,
	                        'loggedin_time'=>time()
	                    );
	                    

	                    session_set_userdata($session_data);

	                    $return['redirect'] = base_url('dashboard');                    
	                    $return['success']='Loggedin successfully';

	                }else{
	                    $return['error']='Oops, something did not work out';
	                    $return['hash']=$this->security->get_csrf_hash();           
	                } 

            	}else if($userdata!='' && ($userdata->user_status=='active' && $userdata->user_verified=='no')){
	                $return['error']='Your email/phone no is not verified.';
	            }else if($userdata!='' && ($userdata->user_status=='inactive' && $userdata->user_verified=='yes')){
	                $return['error']='Your id is deactivated.';
	            }else{
	                $return['error']='Credentials are invalid'; 
	            }

            }else{
            	$return['error']='Error occurred';
            }

            return json_headers($return);
		// }else{
		// 	redirect(base_url());
		// }
	}

	public function onLogout(){
        if(session_userdata('user_id') && session_userdata('isUserLoggedin')==TRUE){
            $this->session->sess_destroy();
            redirect(base_url());   
        }else{
            redirect(base_url());
        }
    }
       public function login(){

              //    	$email = $this->input->get_post('cust_username', TRUE);
		            // $password = $this->input->get_post('cust_password', TRUE);
		$Data = json_decode(file_get_contents('php://input'), true);

		$cust_username = $Data['cust_username'];
		$cust_password = $Data['cust_password'];


		$sql = "SELECT * FROM bl_users WHERE email = '$cust_username' ";
		$user = $this->db->query($sql)->result_array();

		if(count($user)>0){
			

			$password_hash = $user[0]['password'];

			if(!password_verify($cust_password,$password_hash)){
				$result['status'] = false;
				$result['message'] = "invalid password.";
			}else{
			
					$result['status'] = true;
					$result['data'] = $user;
					$result['message'] = 'user login successfully';

			}
		}else{
			$result['status'] = false;
			$result['error'] = 'this username is not found !';
		}

			//$data = ['name'=>$cust_username, 'password'=>$cust_password];
         return json_headers($result);

       }


	public function signup(){
         //print_r($_GET);die();
		// if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){
		// if($this->input->server('REQUEST_METHOD')=='POST'){
		$Data = json_decode(file_get_contents('php://input'), true);

			$cust_first_name = $Data['cust_first_name'];
			$cust_mid_name = $Data['cust_mid_name'];
			$cust_last_name = $Data['cust_last_name'];
			$cust_email = $Data['cust_email'];
			$cust_ph = $Data['cust_ph'];
			$cust_fname = $Data['cust_fname'];
			$cust_marital = $Data['cust_marital'];
			$cust_dob_months = $Data['cust_dob_months'];
			$cust_dob_years = $Data['cust_dob_years'];
			$cust_dob_days = $Data['cust_dob_days'];
			$cust_gender = $Data['cust_gender'];
			$cust_blood_group = $Data['cust_blood_group'];
			$cust_states = $Data['cust_states'];
			$cust_districts = $Data['cust_districts'];
			$cust_cities = $Data['cust_cities'];
			$cust_address = $Data['cust_address'];
			$cust_username = $Data['cust_username'];
			$cust_pincode = $Data['cust_pincode'];
			$cust_password = $Data['cust_password'];
			// $age = $Data['age'];

	  //return json_headers($cust_last_name);

			 $dob=$cust_dob_years.'-'.$cust_dob_months.'-'.$cust_dob_days;
            
            		$age=calculate_age($dob);
                      
                      		$sql = "SELECT * FROM bl_users WHERE email = '$cust_username' ";
		$user = $this->db->query($sql)->result_array();

		           if(count($user)>0){
                    $result['status'] = 'invalid';
			        $result['error'] = 'this username is already exists !';

			        }else{
			
            		 if($age>=18 && $age<=65){
                            $password=password_hash($cust_password, PASSWORD_BCRYPT);
	                        $insert = $this->db->query("INSERT INTO bl_users (role_id, email, password, user_status, user_verified) VALUES ('3', '$cust_username','$password', 'active', 'yes')");
	                        $last_id = $this->db->insert_id();
                           // return json_headers($last_id);

	                        if($insert){
	                        	
		                   		$insert1 = $this->db->query("INSERT INTO bl_customers (user_id, first_name, mid_name, last_name, gender, email, ph_no, f_name, marital, dob, age, blood_group, state_id, district_id, city_id, address, pincode, username) VALUES ('$last_id', '$cust_first_name','$cust_mid_name', '$cust_last_name', '$cust_gender', '$cust_email', '$cust_ph' ,'$cust_fname' ,'$cust_marital' ,'$dob' ,'$age','$cust_blood_group' ,'$cust_states' ,'$cust_districts' , '$cust_cities', '$cust_address','$cust_pincode','$cust_username')");
                              //echo $this->db->insert_id();die();
		                   		// return json_headers($insert1);
                            if($insert1){

                                $result['status'] = true;
                                $result['age'] = $age;
					       		$result['message'] = 'user Signup successfully';
                             }else{
                             	$result['status'] = false;
                             	$result['age'] = $age;
			                    $result['error'] = 'user Signup Fail !';
                             } 
                          }else{
                          	// return json_headers('hiiii');
                             	$result['status'] = false;
                             	$result['age'] = $age;
			                    $result['error'] = 'user Signup Fail !';
                             } 
	                      }else{
	                      	$result['status'] = false;
	                      	$result['age'] = $age;
			                    $result['error'] = 'user Over Age !';
	                      }
	                }      
            return json_headers($result);

	}
                    
}
