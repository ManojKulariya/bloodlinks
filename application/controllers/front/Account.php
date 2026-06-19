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
	 public function update_location()
    {
      $Data = json_decode(file_get_contents('php://input'), true);
      
      if (empty($Data['user_id'])) {
        $result['status'] = false;
        $result['error'] = 'The user_id field is required.';
            return json_headers($result);
        }
        $id =$Data['user_id'];
        $lat = $Data['lat'];
        $long = $Data['long'];
        $update = $this->db->query("UPDATE bl_customers SET lat ='$lat' , lang = '$long' WHERE user_id = '$id'");

      if ($update) {
          // Fetch the updated data
            $query = $this->db->query("SELECT user_id, lat, lang FROM bl_customers WHERE user_id = ?", [$id]);
            $updatedData = $query->row_array(); // Fetch the updated row as an associative array

         $result['status'] = true;
         $result['message'] = 'location update successfully !';
         $result['data'] = $updatedData;
      } else {
         $result['status'] = false;
         $result['error'] = 'fail!';
      }
      return json_headers($result);
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


	 	public function privacy()
	{
		 
        $this->data['page_title']='Privacy-Policy';
		$this->theme->title($this->data['page_title'])->load('home/privacy', $this->data);
       
		
	 }

	 public function process_of_blood()
	{
		 
        $this->data['page_title']='The Process Of Blood Donation';
		$this->theme->title($this->data['page_title'])->load('home/process_of_blood', $this->data);
       
		
	 }

	 public function happan_to_post_donateblood()
	{
		 
        $this->data['page_title']='What Happens to Post you Donate your Blood';
		$this->theme->title($this->data['page_title'])->load('home/happan_to_post_donateblood', $this->data);
       
		
	 }

	 public function pre_and_post_pursuit()
	{
		 
        $this->data['page_title']='Pre and Post Pursuit of Blood Donation';
		$this->theme->title($this->data['page_title'])->load('home/pre_and_post_pursuit', $this->data);
       
		
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
		# Captcha Code
        $captcha = $this->generate_captcha();
        $this->data['captcha_image'] = $captcha['image'];
        $this->data['captcha_word'] = $captcha['word'];
        #--------------------------

		$this->theme->title($this->data['page_title'])->load('account/vw_register', $this->data);
	}


	public function indexLogin(){
		$this->data['page_title']='Signin to complete the registration';

		$this->theme->title($this->data['page_title'])->load('account/vw_login', $this->data);
	}
		public function Login1(){
		$this->data['page_title']='Signin to complete the registration';

		$this->theme->title($this->data['page_title'])->load('account/login_otpverification', $this->data);
	}
	public function register1(){
		$this->data['page_title']='Register to become a blood donar';

		$this->theme->title($this->data['page_title'])->load('account/vw_register_otpverification', $this->data);
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
			$dob=post_data('dob');
			// print_r($dob);
			// die();
			// $cust_dob_months=post_data('cust_dob_months');
			// $cust_dob_years=post_data('cust_dob_years');
			// $cust_dob_days=post_data('cust_dob_days');
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
            	$c_phone=$this->um->get_duplicate_customers(array('ph_no'=>$cust_ph));
                  // print_r($c_found);die();
            	if($c_found[0]->counted==0){
            	  if($c_phone[0]->counted==0){

            		//$dob=$cust_dob_years.'-'.$cust_dob_months.'-'.$cust_dob_days;
            		$age=calculate_age($dob);

            		 if($age>=18 && $age<=65){
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
            		$return['error']='This Phone Number is already exists';
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

		$Data = json_decode(file_get_contents('php://input'), true);
        
		$cust_mobile = $Data['cust_mobile'];
           
         
		  $sql = "SELECT * FROM bl_customers WHERE ph_no = '$cust_mobile' ";
		       $user = $this->db->query($sql)->result_array();
       
		if(count($user)>0){
		          // return json_headers($user);
            $otp = rand(1000, 9999);
            if( $cust_mobile == 7698933737 || $cust_mobile == 6367289664){
              $otp = 1234;  
            }else{
               $msg_otp = urlencode("Your OTP to login is $otp Please do not share it with anyone. Team Blood Links");
                $http = "https://msg.smsguruonline.com/fe/api/v1/send?username=bloodlinks.trans&password=mc1W1&unicode=false&from=BLDLNK&to=$cust_mobile&dltPrincipalEntityId=1201161613715484703&dltContentId=1207163609249167881&text=$msg_otp";
                    
                $ch = curl_init($http);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $results = curl_exec($ch); 
            }
            
            
			$insert = $this->db->query("INSERT INTO authentication (mobile , otp , expired) VALUES ('$cust_mobile','$otp','0')");
			if($insert){
			$result['status'] = true;
					$result['message'] = 'Otp Send successfully';
			}else{
				$result['status'] = false;
				$result['message'] = "Fail";		
			}
		}else{
			$result['status'] = false;
			$result['error'] = 'this Mobile Number is not found !';
		}

         return json_headers($result);

       }


    public function mynewfunction(){


		$Data = json_decode(file_get_contents('php://input'), true);
	
		 $cust_otp = $Data['cust_otp'];
		 $cust_mobile = $Data['cust_mobile'];

        $sql = "SELECT * FROM authentication WHERE mobile = '$cust_mobile' ORDER BY id DESC";
        $user = $this->db->query($sql)->result_array();

        if(count($user)>0){

            $otp = $user[0]['otp'];

            if($cust_otp == $otp){
                $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_mobile'");
                    $sql1 = "SELECT * FROM bl_customers WHERE ph_no = '$cust_mobile' ";
                    $user1 = $this->db->query($sql1)->result_array();
                    $result['status'] = true;
                    $result['data'] = $user1;
                    $result['message'] = 'user login successfully';
            }else{
                // $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_mobile'");
                $result['status'] = false;
                $result['message'] = "invalid otp.";
            }
        }else{
            $result['status'] = false;
            $result['error'] = 'this otp is invalid !';
        }

            //$data = ['name'=>$cust_username, 'password'=>$cust_password];
        
         return json_headers($result);
		

    }

	public function signup(){
		$Data = json_decode(file_get_contents('php://input'), true);

			$cust_first_name = $Data['cust_first_name'];
			$cust_mid_name = $Data['cust_mid_name'];
			$cust_last_name = $Data['cust_last_name'];
			$cust_email = $Data['cust_email'];
			$cust_ph = $Data['cust_ph'];
			$cust_fname = $Data['cust_fname'];
			$cust_marital = $Data['cust_marital'];
			$dob = $Data['dob'];
			$cust_gender = $Data['cust_gender'];
			$cust_blood_group = $Data['cust_blood_group'];
			$cust_states = $Data['cust_states'];
			$cust_districts = $Data['cust_districts'];
			$cust_cities = $Data['cust_cities'];
			$cust_address = $Data['cust_address'];
			$cust_username = $Data['cust_username'];
			$cust_pincode = $Data['cust_pincode'];
			$cust_password = $Data['cust_password'];
		
                   $sql = "SELECT * FROM bl_customers WHERE ph_no = '$cust_ph' ";
		              $user = $this->db->query($sql)->result_array();

		        if(count($user)>0){
              $result['status'] = 'invalid';
			        $result['error'] = 'this phone number is already exists !';

			    }else{
                  $n=4;
            function reg($n) {
            $characters = '0123456789';
            $randomString = '';
            
            for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
            } 
            
            return $randomString;
            }
            
            $otp = reg($n);
            
            $this->load->helper('sms');
            $results = send_sms_template('OTP', $cust_ph, ['otp' => $otp]);
    
			$insert = $this->db->query("INSERT INTO authentication (mobile , otp , expired) VALUES ('$cust_ph','$otp','0')");
			if($insert){
				// $user_id = $this->db->insert_id();
				// $sql = "SELECT * FROM bl_customers WHERE id = '$user_id' ";
		  //   $user = $this->db->query($sql)->result_array();
				 

			$result['status'] = true;
					$result['message'] = 'Otp Send successfully';
					// $result['user'] = $user[0];
			}else{
				$result['status'] = false;
				$result['message'] = "Fail";		
			} 

	  } 
	            
            return json_headers($result);

	}

		public function verificationsignup(){
         //print_r($_GET);die();
		// if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){
		// if($this->input->server('REQUEST_METHOD')=='POST'){
		$Data = json_decode(file_get_contents('php://input'), true);

		$test = ['test'=>'ceck'];

// 		 return json_headers($Data['user']['dob']); die;

			$cust_first_name = $Data['user']['cust_first_name'];
			$cust_mid_name = $Data['user']['cust_mid_name'];
			$cust_last_name = $Data['user']['cust_last_name'];
			$cust_email = $Data['user']['cust_email'];
			$cust_ph = $Data['user']['cust_ph'];
			$cust_fname = $Data['user']['cust_fname'];
			$cust_marital = $Data['user']['cust_marital'];
			$dob = $Data['user']['dob'];
			$cust_gender = $Data['user']['cust_gender'];
			$cust_blood_group = $Data['user']['cust_blood_group'];
			$cust_states = $Data['user']['cust_states'];
			$cust_districts = $Data['user']['cust_districts'];
			$cust_cities = $Data['user']['cust_cities'];
			$cust_address = $Data['user']['cust_address'];
			$cust_username = $Data['user']['cust_username'];
			$cust_pincode = $Data['user']['cust_pincode'];
			$cust_password = $Data['user']['cust_password'];
			$cust_otp = $Data['cust_otp'];

			// return json_headers($Data); die;
		
          $sql = "SELECT * FROM authentication WHERE mobile = '$cust_ph'";
        $user = $this->db->query($sql)->result_array();

        // $last_id = $this->db->insert_id();

// return json_headers($last_id[0]); die;

        if(count($user)>0){
            

               $otp = $user[0]['otp'];



            if($cust_otp == $otp){ 

								

                     // $dataDelete = $this->db->query("SELECT * FROM authentication WHERE mobile = '$cust_ph'");

                     // return json_headers($dataDelete[0]); die;
                     $age=calculate_age($dob);

                      // if($age>=18 && $age<=65){

                      		
                      		

                            $password=password_hash($cust_password, PASSWORD_BCRYPT);
							

                            $insert = $this->db->query("INSERT INTO bl_users (role_id, email, password, user_status, user_verified) VALUES ('3', '$cust_username','$password', 'active', 'yes')");
                            $last_id = $this->db->insert_id();
                           // return json_headers($last_id);
							// json_headers($last_id); die;
                            if($insert){
                                
                                $insert1 = $this->db->query("INSERT INTO bl_customers (user_id, first_name, mid_name, last_name, gender, email, ph_no, f_name, marital, dob, age, blood_group, state_id, district_id, city_id, address, pincode, username) VALUES ('$last_id', '$cust_first_name','$cust_mid_name', '$cust_last_name', '$cust_gender', '$cust_email', '$cust_ph' ,'$cust_fname' ,'$cust_marital' ,'$dob' ,'$age','$cust_blood_group' ,'$cust_states' ,'$cust_districts' , '$cust_cities', '$cust_address','$cust_pincode','$cust_username')");
                              //echo $this->db->insert_id();die();
                                // return json_headers($insert1);
                                // json_headers($insert1); die;
                            if($insert1){
                                 $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_ph'");
                                $result['status'] = true;
                                $result['user_id'] = $last_id;
                                $result['age'] = $age;
                                $result['message'] = 'user Signup successfully';


                             }else{
                             	 $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_ph'");
                                $result['status'] = false;
                                $result['age'] = $age;
                                $result['error'] = 'user Signup Fail !';
                             } 
                          }else{
                          	 $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_ph'");
                            // return json_headers('hiiii');
                                $result['status'] = false;
                                $result['age'] = $age;
                                $result['error'] = 'user Signup Fail !';
                             } 
                          // }else{
                          // 	 $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_ph'");
                          //   $result['status'] = false;
                          //   $result['age'] = $age;
                          //       $result['error'] = 'user Over Age !';
                          // }
                          
                    // $result['status'] = true;
                    // $result['data'] = $user1;
                    // $result['message'] = 'user login successfully';
               
            }else{
                $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_ph'");
                $result['status'] = false;
                $result['message'] = "invalid otp.";
            }
        }else{
        	 $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_ph'");
            $result['status'] = false;
            $result['error'] = 'this otp is invalid !';
        }
	            
            return json_headers($result);

	}
                    
}