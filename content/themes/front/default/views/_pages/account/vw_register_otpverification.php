<?php  if (!empty($_POST['otp'])) {
                                
                                  // print_r($_SESSION);
                                  //     die();
                                    $cust_first_name = $_SESSION['cust_first_name'];
                                    $cust_mid_name = $_SESSION['cust_mid_name'];
                                    $cust_last_name = $_SESSION['cust_last_name'];
                                    $cust_fname = $_SESSION['cust_fname'];
                                    $cust_marital = $_SESSION['cust_marital'];
                                    $cust_ph = $_SESSION['cust_ph'];
                                    $dob = $_SESSION['dob'];
                                    $cust_email = $_SESSION['cust_email'];
                                    $cust_gender = $_SESSION['cust_gender'];
                                    $cust_blood_group = $_SESSION['cust_blood_group'];
                                    $cust_states = $_SESSION['cust_states'];
                                    $cust_districts = $_SESSION['cust_districts'];
                                    $cust_cities = $_SESSION['cust_cities'];
                                    $cust_address = $_SESSION['cust_address'];
                                    $cust_pincode = $_SESSION['cust_pincode'];
                                    $aadhaar = $_SESSION['aadhaar'];
                                    $otp = $_POST['otp'];

          $sql = "SELECT * FROM authentication WHERE mobile = '$cust_ph'";
        $user = $this->db->query($sql)->result_array();

        // $last_id = $this->db->insert_id();

// return json_headers($last_id[0]); die;

        if(count($user)>0){
            

               $otps = $user[0]['otp'];



            if($otps == $otp){ 

                

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
                                
                                $insert1 = $this->db->query("INSERT INTO bl_customers (user_id, first_name, mid_name, last_name, gender, email, ph_no, f_name, marital, dob, age, blood_group, state_id, district_id, city_id, address, pincode, username , aadhaar) VALUES ('$last_id', '$cust_first_name','$cust_mid_name', '$cust_last_name', '$cust_gender', '$cust_email', '$cust_ph' ,'$cust_fname' ,'$cust_marital' ,'$dob' ,'$age','$cust_blood_group' ,'$cust_states' ,'$cust_districts' , '$cust_cities', '$cust_address','$cust_pincode','$cust_username' , '$aadhaar')");
                                // print_r($insert1);
                                // die();
                              //echo $this->db->insert_id();die();
                                // return json_headers($insert1);
                                // json_headers($insert1); die;
                            if($insert1){
                                 $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_ph'");
                                 session_destroy();
                                redirect('signin');

                             }else{
                               $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_ph'");
                               session_destroy();
                                echo '<script>alert("user Signup Fail !")</script>';
                                //$result['error'] = 'user Signup Fail !';
                             } 
                          }else{
                             $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_ph'");
                             session_destroy();
                            // return json_headers('hiiii');
                             echo '<script>alert("user Signup Fail !")</script>';
                                // $result['status'] = false;
                                // $result['age'] = $age;
                                // $result['error'] = 'user Signup Fail !';
                             } 
                          // }else{
                          //    $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_ph'");
                          //    session_destroy();
                          //    echo '<script>alert("user Over Age !")</script>';
                            
                          // }
                          
                    // $result['status'] = true;
                    // $result['data'] = $user1;
                    // $result['message'] = 'user login successfully';
               
            }else{
                $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_ph'");
                session_destroy();
                 echo '<script>alert("invalid otp.")</script>';
                // $result['status'] = false;
                // $result['message'] = "invalid otp.";
            }
        }else{
           $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_ph'");
           session_destroy();
            echo '<script>alert("this otp is invalid !")</script>';
            // $result['status'] = false;
            // $result['error'] = 'this otp is invalid !';
        }
            

     } 
                                 
                                     ?>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="image-contactus-banner">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1 class="lg-text text-dark">Register As A Blood Donor</h1>
            <h6>Home / <span>Register Now</span></h6>
         </div>
      </div>
   </div>
</div>

<section class="sign-in-page my-5">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-xl-9 col-lg-7">
             <div class="contact-wrapper">
               <header class="login-cta">
                  <h2>Blood Ai Organization</h2>
               </header>
              <form action = "<?php $_PHP_SELF ?>" method = "POST" class="new-register">
                   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                 
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">OTP Verification <span> *</span></label>
                     <div class="col-sm-8">
                               <input class="form-control" type="text" name="otp" autocomplete="off">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="col-sm-4"></div>
                     <div class="col-sm-8">
                        <div class="row">
                           <div class="col-xl-4">
                               <div class="regi-btn">
                                  <button type="submit" >Submit</button>
                               </div>
                           </div>
                        </div>
                     </div>
                  </div>
                 
                     
                  
               </form>
            </div>
         </div>
      </div>
   </div>
</section>

<script type="text/javascript">
   var register_url='<?php echo base_url('account_registration');?>';
   // var login_url='<?php echo base_url('account_login');?>';
   // var states_get_url='<?php echo base_url('get_states');?>';
   // var districts_get_url='<?php echo base_url('get_districts');?>';
   // var cities_get_url='<?php echo base_url('get_cities');?>';
</script>

<style type="text/css">
   .nice-select .list {
       border-radius: 0px;
       height: 150px;
       overflow-y: auto;
   }

   #select_states.nice-select .option:hover, #select_states.nice-select #select_states.option.focus, #select_states.nice-select .option.selected.focus {
     color:red;
     background: none;
   }

</style>
<!-- <script type="text/javascript">
   var register_url='<?php echo base_url('account_registration');?>';
   var login_url='<?php echo base_url('account_login');?>';
   var states_get_url='<?php echo base_url('get_states');?>';
   var districts_get_url='<?php echo base_url('get_districts');?>';
   var cities_get_url='<?php echo base_url('get_cities');?>';
</script>

<style type="text/css">
   .nice-select .list {
       border-radius: 0px;
       height: 150px;
       overflow-y: auto;
   }

   #select_states.nice-select .option:hover, #select_states.nice-select #select_states.option.focus, #select_states.nice-select .option.selected.focus {
     color:red;
     background: none;
   }

</style> -->
   <script type="text/javascript" src="https://bloodlinks.in/content/themes/front/default/assets/scripts/signin.js"></script>