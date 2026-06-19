
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
                  <h2>Sign In:otp verify</h2>
                  <hr class="login3-hr">
                  <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger mx-5">
                        <?= $this->session->flashdata('error'); ?>
                        <?php $this->session->unset_userdata('error'); ?>
                    </div>
                 <?php endif; ?>
               </header>
             
               <form action="<?= site_url('bmw_verify_otp'); ?>" method="POST" class="new-register">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">OTP Verification <span> *</span></label>
                     <div class="col-sm-8">
                         <input type="hidden" name="phone" value="<?php echo $phone ?>">
                        <input class="form-control" type="text" name="otp" autocomplete="off">
                     </div>
                  </div>

                  <div class="row mb-3">
                     
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