<style type="text/css">
   .reset-password p {
      font-size: 14px;
   }

   .signin-hr {
      width: 10%;
      margin: auto;
      border-bottom: 2px solid red;
   }

   .login-ctaa {
      padding: 35px 10px;
      background: #faf9fb;
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
               <header class="login-ctaa">
                  <h2 class="text-center">Hospital Sign In</h2>
                  <hr class="signin-hr">
                  <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger mx-5">
                        <?= $this->session->flashdata('error'); ?>
                        <?php $this->session->unset_userdata('error'); ?>
                    </div>
                 <?php endif; ?>
               </header>
               <form action="<?php echo base_url('otp_hospital'); ?>" method="POST" class="new-register">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Registered Mobile <span> *</span></label>
                     <div class="col-sm-8">
                        <input class="form-control" type="tel" name="cust_phone" placeholder="Enter Mobile No." required>
                     </div>
                  </div>
                  
                  <div class="row mb-3">
                     <div class="col-sm-4">
                        <div class="reset-password">
                           <h5>Not a member? <a href="<?php echo base_url('add_hospital'); ?>">Register</a></h5>
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
            </div>
         </div>
      </div>
   </div>
</section>