<?php 
    if (!empty($_POST['cust_first_name'])) {
   
if (isset($_POST['captcha']) && $_POST['captcha'] == $_POST['captcha_word']) {
   $cust_first_name = $_POST['cust_first_name'];
   $cust_mid_name = $_POST['cust_mid_name'];
   $cust_last_name = $_POST['cust_last_name'];
   $cust_fname = $_POST['cust_fname'];
   $cust_marital = $_POST['cust_marital'];
   $cust_ph = $_POST['cust_ph'];
   $dob = $_POST['dob'];
   $cust_gender = $_POST['cust_gender'];
   $cust_email = $_POST['cust_email'];
   $cust_blood_group = $_POST['cust_blood_group'];
   $cust_states = $_POST['cust_states'];
   $cust_districts = $_POST['cust_districts'];
   $cust_cities = '';
   $cust_address = $_POST['cust_address'];
   $cust_pincode = $_POST['cust_pincode'];
   $aadhaar = $_POST['aadhaar'];

   $sql = "SELECT * FROM bl_customers WHERE ph_no = '$cust_ph' ";
   $user = $this->db->query($sql)->result_array();
   $_SESSION['cust_first_name'] = $cust_first_name;
   $_SESSION['cust_mid_name'] = $cust_mid_name;
   $_SESSION['cust_last_name'] = $cust_last_name;
   $_SESSION['cust_fname'] = $cust_fname;
   $_SESSION['cust_marital'] = $cust_marital;
   $_SESSION['cust_ph'] = $cust_ph;
   $_SESSION['dob'] = $dob;
   $_SESSION['cust_gender'] = $cust_gender;
   $_SESSION['cust_email'] = $cust_email;
   $_SESSION['cust_blood_group'] = $cust_blood_group;
   $_SESSION['cust_states'] = $cust_states;
   $_SESSION['cust_districts'] = $cust_districts;
   $_SESSION['cust_cities'] = $cust_cities;
   $_SESSION['cust_address'] = $cust_address;
   $_SESSION['cust_pincode'] = $cust_pincode;
   $_SESSION['aadhaar'] = $aadhaar;
   if (count($user) > 0) {
      $result['status'] = 'invalid';
      $result['error'] = 'this phone number is already exists !';
   } else {
      $n = 4;
      function reg($n)
      {
         $characters = '0123456789';
         $randomString = '';

         for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
         }

         return $randomString;
      }

      $otp = reg($n);
      $http = "https://alerts.prioritysms.com/api/web2sms.php?workingkey=A90584d6e78b250597cbfa77775ab2ba9&to=" . $cust_ph . "&sender=BLDLNK&message=" . urlencode("Your OTP to login is {" . $otp . "} Please do not share it with anyone. Team Blood Links") . "";

      // $http = "https://alerts.prioritysms.com/api/web2sms.php?workingkey=A90584d6e78b250597cbfa77775ab2ba9&to=".$cust_ph."&sender=BLDLNK&message=".urlencode("Your request to add {".$otp."} is successfully received. You will be able to login to your dashboard once admin will approve your registration request. Team BloodLinks")."" ;

      $ch = curl_init($http);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $results = curl_exec($ch);

      $insert = $this->db->query("INSERT INTO authentication (mobile , otp , expired) VALUES ('$cust_ph','$otp','0')");
      if ($insert) {
         redirect('register1');
      } else {
         $result['status'] = false;
         $result['message'] = "Fail";
      }
   }
   
   }echo '<script>alert("Incorrect CAPTCHA. Please try again.");</script>';
}


?>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<style>
   .organisation-hr {
      width: 22%;
      margin: auto;
      border-bottom: 2px solid red;
   }

   .login-cta {
      padding: 41px 35px;
   }

   .login-cta>h2 {
      font-size: 2rem;
   }
</style>


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
                  <h2>Registration Form</h2>
                  <hr class="organisation-hr">
               </header>
               <form action="<?php $_PHP_SELF ?>" method="POST" class="new-register">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Full Name <span> *</span></label>
                     <div class="col-sm-8">
                        <div class="row">
                           <div class="col-lg-4">
                              <input type="text" class="form-control" name="cust_first_name" autocomplete="off" id="colFormLabel" placeholder="First Name">
                           </div>
                           <div class="col-lg-4">
                              <input class="form-control" type="text" name="cust_mid_name" autocomplete="off" placeholder="Mid Name">
                           </div>
                           <div class="col-lg-4">
                              <input type="text" class="form-control" name="cust_last_name" autocomplete="off" id="colFormLabel" placeholder="Last Name">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Father/Hasband Name <span> *</span></label>
                     <div class="col-sm-8">
                        <input class="form-control" type="text" name="cust_fname" autocomplete="off" placeholder="Father/Hasband Name">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Marital Status <span> *</span></label>
                     <div class="col-sm-8">
                        <select class="form-control" name="cust_marital" style="padding: 0px;margin: 5px;">
                           <option value="0">Select Marital Status</option>
                           <option value="Married">Married</option>
                           <option value="unmarried">unmarried</option>
                        </select>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Email <span> *</span></label>
                     <div class="col-sm-8">
                        <input class="form-control" type="email" name="cust_email" autocomplete="off" placeholder="Enter Email">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Phone Number <span> *</span></label>
                     <div class="col-sm-8">
                        <input class="form-control" type="tel" name="cust_ph" autocomplete="off" minlength="10" maxlength="10" placeholder="Enter Phone">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Date Of Birth <span> *</span></label>
                     <div class="col-sm-8">
                        <input class="form-control" type="date" name="dob" autocomplete="off" placeholder="Enter Date of Birth">
                        <!-- <div class="row">
                           <div class="col-lg-4">
                              <select class="form-control" name="cust_dob_days" style="padding: 0px;margin: 5px;">
                        <option value="0">Day</option>
                        <?php
                        if (!empty($days)) {
                           foreach ($days as $key => $value) {
                        ?>
                              <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                              <?php
                           }
                        }
                              ?>
                     </select>
                           </div>
                           <div class="col-lg-4">
                               <select class="form-control" name="cust_dob_months" style="padding: 0px;margin: 5px;">
                        <option value="0">Month</option>
                        <?php
                        if (!empty($months)) {
                           $i = 1;
                           foreach ($months as $key => $value) {

                        ?>
                              <option value="<?php echo $i; ?>"><?php echo $value; ?></option>
                              <?php
                              $i++;
                           }
                        }
                              ?>
                     </select>
                    
                           </div>
                           <div class="col-lg-4">
                              <select class="form-control" name="cust_dob_years" style="padding: 0px;margin: 5px;">
                        <option value="0">Year</option>
                        <?php
                        if (!empty($years)) {
                           foreach ($years as $key => $value) {
                        ?>
                              <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                              <?php
                           }
                        }
                              ?>
                     </select>
                           </div> 
                        </div>-->
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Gender <span> *</span></label>
                     <div class="col-sm-8">
                        <select class="form-control" name="cust_gender" style="padding: 0px;margin: 5px;">
                           <option value="0">Select Gender</option>
                           <option value="male">Male</option>
                           <option value="female">Female</option>
                        </select>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Blood Group <span> *</span></label>
                     <div class="col-sm-8">
                        <select class="form-control" name="cust_blood_group" style="padding: 0px;margin: 5px;">
                           <option value="0">Select Blood Group</option>
                           <?php
                           if (!empty($blood_groups)) {
                              foreach ($blood_groups as $key => $value) {
                           ?>
                                 <option value="<?php echo $value->master_id; ?>"><?php echo $value->master_type_key_value; ?></option>
                           <?php
                              }
                           }
                           ?>
                        </select>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">State <span> *</span></label>
                     <div class="col-sm-8">
                        <select class="form-control" id="select_states" name="cust_states" style="padding: 0px;margin: 5px;">
                           <option value="0">Select State</option>
                        </select>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">City <span> *</span></label>
                     <div class="col-sm-8">
                        <select class="form-control" id="select_districts" name="cust_districts" style="padding: 0px;margin: 5px;">
                           <option value="0">Select City</option>
                        </select>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Aadhaar Number <span> *</span></label>
                     <div class="col-sm-8">
                        <input class="form-control" type="text" minlength="12" maxlength="12" name="aadhaar" autocomplete="off" placeholder="Enter Aadhaar No">
                     </div>
                  </div>
                  
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Address <span> *</span></label>
                     <div class="col-sm-8">
                        <textarea class="form-control" rows="3" name="cust_address" autocomplete="off" placeholder="Enter Address"></textarea>
                        </select>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Pincode <span> *</span></label>
                     <div class="col-sm-8">
                        <input class="form-control" type="text" name="cust_pincode" id="cust_pincode" autocomplete="off" placeholder="Enter Pincode">
                     </div>
                  </div>
                  <div class="row mb-3">
                      <label for="colFormLabel" class="col-sm-4 col-form-label">Captcha</label>
                      <div class="col-md-12 text-center">
                         <?php echo $captcha_image; ?></br></br>
                         <input type="text" name="captcha" id="captcha" required />
                         <input type="hidden" value="<?php echo $captcha_word; ?>" name="captcha_word" />
                      </div>
                   </div>
                  <div class="row mb-3">
                     <div class="col-sm-4"></div>
                     <div class="col-sm-8">
                        <div class="row">
                           <div class="col-xl-4">
                              <div class="regi-btn">
                                 <button type="submit">Sign UP</button>
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
   var register_url = '<?php echo base_url('account_registration'); ?>';
   var login_url = '<?php echo base_url('account_login'); ?>';
   var states_get_url = '<?php echo base_url('get_states'); ?>';
   var districts_get_url = '<?php echo base_url('get_districts'); ?>';
   var cities_get_url = '<?php echo base_url('get_cities'); ?>';
</script>

<style type="text/css">
   .nice-select .list {
      border-radius: 0px;
      height: 150px;
      overflow-y: auto;
   }

   #select_states.nice-select .option:hover,
   #select_states.nice-select #select_states.option.focus,
   #select_states.nice-select .option.selected.focus {
      color: red;
      background: none;
   }
</style>
<script type="text/javascript">
   var register_url = '<?php echo base_url('account_registration'); ?>';
   var login_url = '<?php echo base_url('account_login'); ?>';
   var states_get_url = '<?php echo base_url('get_states'); ?>';
   var districts_get_url = '<?php echo base_url('get_districts'); ?>';
   var cities_get_url = '<?php echo base_url('get_cities'); ?>';
</script>

<style type="text/css">
   .nice-select .list {
      border-radius: 0px;
      height: 150px;
      overflow-y: auto;
   }

   #select_states.nice-select .option:hover,
   #select_states.nice-select #select_states.option.focus,
   #select_states.nice-select .option.selected.focus {
      color: red;
      background: none;
   }
</style>
<script type="text/javascript" src="https://bloodlinks.in/content/themes/front/default/assets/scripts/signin.js"></script>
