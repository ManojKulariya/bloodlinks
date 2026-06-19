<?php
$phone = $_SESSION['cust_phone'];
if (!empty($_POST['cust_phone'])) {
   $cust_phone = $_POST['cust_phone'];
   $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$cust_phone'");
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

   $http = "https://alerts.prioritysms.com/api/web2sms.php?workingkey=A90584d6e78b250597cbfa77775ab2ba9&to=" . $cust_phone . "&sender=BLDLNK&message=" . urlencode("Your OTP to login is {" . $otp . "} Please do not share it with anyone. Team Blood Links") . "";

   $ch = curl_init($http);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   $results = curl_exec($ch);

   $insert = $this->db->query("INSERT INTO authentication (mobile , otp , expired) VALUES ('$cust_phone','$otp','0')");
   $_SESSION['cust_phone'] = $cust_phone;
   if ($insert) {
      redirect('signin1');
   } else {
      $result['status'] = false;
      $result['message'] = "Fail";
   }
} ?>


<?php if (!empty($_POST['otp'])) {


   $otp = $_POST['otp'];
   $sql = "SELECT * FROM authentication WHERE mobile = '$phone'";

   $user = $this->db->query($sql)->result_array();

   if (count($user) > 0) {


      $otps = $user[0]['otp'];

      if ($otp == $otps) {
         $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$phone'");

         // $sql1 = "SELECT * FROM bl_customers WHERE ph_no = '$cust_phone' ";
         // $user1 = $this->db->query($sql1)->result_array();
         $query1 = $this->db->query("SELECT * FROM bl_customers WHERE ph_no = '$phone'");

         foreach ($query1->result() as $row) {
         }
         $form = uniqid();
         $session_data = array(
            'isUserLoggedin' => true,
            'user_id' => encode_data($row->user_id),
            'customer_id' => $row->user_id,
            'form_id' => $form,
            'user_type' => '3',
            'loggedin_time' => time()
         );
         session_set_userdata($session_data);

         redirect('dashboard');
      } else {
         $dataDelete = $this->db->query("DELETE FROM authentication WHERE mobile = '$phone'");

         echo '<script>alert("invalid otp.")</script>';
      }
   } else {
      echo '<script>alert("this otp is invalid !")</script>';
      //$result['error'] = 'this otp is invalid !';
   }
}

?>
<style type="text/css">
   .reset-password p {
      font-size: 14px;
   }

   .login-cta {
      padding: 38px 35px;
   }

   .login3-hr {
      width: 12%;
      border-bottom: 2px solid red;
      margin: auto;
   }

   .login-cta>h2 {
      font-size: 2rem;
   }
</style>

<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="image-contactus-banner">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1 class="lg-text text-dark">Sign In</h1>
            <h6>Home / <span>Signin</span></h6>
         </div>
      </div>
   </div>
</div>
<!-- <div class="bread-bar">
   <div class="container">
      <div class="row">
         <div class="col-md-8 col-sm-6 col-xs-8">
            <ol class="breadcrumb">
               <li><a href="<?php echo base_url(); ?>;?>">Home</a></li>
               <li class="active">Sign in</li>
            </ol>
         </div>
      </div>
   </div>
</div> -->

<section class="sign-in-page my-5">
   <div class="container">
      <div class="row" id="success_div" style="display:none;">
         <div class="col-md-12">
            <div class="alert alert-success">
               <p><strong>Thank you. Now check your email</strong></p>
               <p>Please use the link in the email to confirm your email address and continue with your registration.<a href="<?php echo base_url('login'); ?>">Click here to Login</a></p>
            </div>
         </div>
      </div>
      <div class="row justify-content-center">
         <div class="col-xl-7">
            <div class="contact-wrapper">
               <header class="login-cta">
                  <h2>Sign In</h2>
                  <hr class="login3-hr">
               </header>
               <!-- <form id="form_login" style="margin-bottom: 0px;">
                  <div class="form-row">
                     <input type="text" name="cust_username" placeholder="Registered Username">
                  </div>
                  <div class="form-row">
                     <input type="password" name="cust_password" placeholder="Password">
                  </div>
                  <div class="form-row"></div>
                  <div class="reset-password">
                     <p  data-toggle="modal" data-target="#exampleModalCenter">Forgot your password ?</p>
                  </div>
                  <div class="form-row">
                     <button type="submit" id="btn_sign_in">Sign IN</button>
                  </div>
               </form> -->
               <form action="<?php $_PHP_SELF ?>" method="POST" class="new-register">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">OTP Verification <span> *</span></label>
                     <div class="col-sm-8">
                        <input class="form-control" type="text" name="otp" autocomplete="off">
                     </div>
                  </div>

                  <div class="row mb-3">
                     <div class="col-sm-4">
                        <div class="reset-password">



                           <h5>Not a member? <a href="<?php echo base_url('register'); ?>">Register</a></h5>
                        </div>
                     </div>
                     <div class="col-sm-8">
                        <div class="row">
                           <div class="col-xl-4">
                              <div class="regi-btn">
                                 <button type="submit">Sign IN</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>

               <div class="socials-wrapper">
                  <ul>
                     <form action="<?php $_PHP_SELF ?>" method="POST">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                        <input class="form-control" type="hidden" name="cust_phone" value="<?= $phone; ?>">

                        <div class="row">
                           <div class="col-xl-12" style="text-align: center;">
                              <div class="regi-btn" style="border-radius: 10px;">
                                 <p><button type="submit" style="border-radius: 10px;">Resend</button></p>
                              </div>
                           </div>
                        </div>

                     </form>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>