<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="image-contactus-banner">
  
<section class="sign-in-page my-5">
   <div class="container">
   
      <div class="row">
                  <div class="col-md-12">
            <div class="contact-wrapper">
               <header class="login-cta">

               </header>
               <form id="fomr_register">
                  <div class="form-row" style="flex-wrap: unset!important;">

                     <input class="form-control" type="text" name="user_first_name" autocomplete="off" placeholder="First Name"style="padding: 0px;margin: 5px; font-weight: unset;border-radius: 3px;padding-left: 5px;">
               
                     <input class="form-control" type="text" name="user_mid_name" autocomplete="off" placeholder="Mid Name"style="padding: 0px;margin: 5px; font-weight: unset;border-radius: 3px;padding-left: 5px;">
                  
                     <input class="form-control" type="text" name="user_last_name" autocomplete="off" placeholder="Last Name"style="padding: 0px;margin: 5px; font-weight: unset;border-radius: 3px;padding-left: 5px;">
                 </div>
                     <div class="form-row" style="flex-wrap: unset!important;">

                     <input class="form-control" type="date" name="dob" autocomplete="off" placeholder="Father/Hasband Name" style="font-weight: unset;padding: 0px;border-radius: 3px;margin: 5px;padding-left: 5px;">
                     
                 
                    <select class="form-control" name="user_marital"style="padding: 0px;margin: 5px;">
                        <option value="0">Select Marital Status</option>
                        <option value="Married">Married</option>
                        <option value="unmarried">unmarried</option>
                     </select>
                     <!-- <div class=" send-otp-text text-right"><a href="#">Send Otp</a></div> -->
                 
                   </div>
                  <div class="form-row" style="flex-wrap: unset!important;">

                     <input class="form-control" type="text" name="user_email" autocomplete="off" placeholder="Email" style="font-weight: unset;padding: 0px;border-radius: 3px;margin: 5px;padding-left: 5px;">
                     
                 
                     <input class="form-control" type="tel" name="user_ph" autocomplete="off" placeholder="Phone Number"style="font-weight: unset;padding: 0px;margin: 5px;border-radius: 3px;padding-left: 5px;">
                     <!-- <div class=" send-otp-text text-right"><a href="#">Send Otp</a></div> -->
                 
                 
                  </div>
                  <div class="form-row"  style="flex-wrap: unset!important;">
                     <select class="form-control" name="user_gender"style="padding: 0px;margin: 5px;">
                        <option value="0">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                     </select>
                 
                     <select class="form-control" name="user_roles"style="padding: 0px;margin: 5px;">
                        <option value="0">Select Roles</option>
						<option value="Roles-1">Roles-1</option>
                        <option value="Roles-2">Roles-2</option>
                        <option value="Roles-3">Roles-3</option>
                        <option value="Roles-4">Roles-4</option>
                        
                     </select>
                  </div>
                 
				  <div class="form-row" style="flex-wrap: unset!important;">

                     <input class="form-control" type="password" name="user_password" autocomplete="off" placeholder="password" style="font-weight: unset;padding: 0px;border-radius: 3px;margin: 5px;padding-left: 5px;">
                     
                 
                     <input class="form-control" type="password" name="user_conf_password" autocomplete="off" placeholder="confirm Password"style="font-weight: unset;padding: 0px;margin: 5px;border-radius: 3px;padding-left: 5px;">
                     <!-- <div class=" send-otp-text text-right"><a href="#">Send Otp</a></div> -->
                 
				</div>                  
                     <button type="submit" id="btn_sign_up">Register</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>


<script type="text/javascript">
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

</style>