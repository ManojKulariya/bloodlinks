<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
if (!empty($_POST['org_name'])) {
   
if (isset($_POST['captcha']) && $_POST['captcha'] == $_POST['captcha_word']) {
         $org_name = $_POST['org_name'];
         $org_short_name = $_POST['org_short_name'];
         $org_contact_name = $_POST['org_contact_name'];
         $org_email = $_POST['org_email'];
         $org_ph_no = $_POST['org_ph_no'];
         $org_help_line_no = $_POST['org_help_line_no'];
         $org_category = $_POST['org_category'];
         $org_districs = $_POST['cust_districts'];
         $org_state = $_POST['cust_states'];
         $org_city = $_POST['cust_cities'];
         $org_pincode = $_POST['org_pincode'];
         $org_address1 = $_POST['org_address1'];
         $org_lic_no = $_POST['org_lic_no'];
         $org_lic_valid_from = date('Y-m-d', strtotime($_POST['org_lic_valid_from']));
         $org_lic_valid_to = date('Y-m-d', strtotime($_POST['org_lic_valid_to']));
         $latitude = $_POST['latitude'];
         $longitude = $_POST['longitude'];

         $insert = $this->db->query("INSERT INTO bl_users (role_id, email, password, user_status, user_verified) VALUES ('5', '$org_email','', 'active', 'yes')");
         $last_id = $this->db->insert_id();
         if ($insert == true) {
            $insert1 = $this->db->query("INSERT INTO bl_blood_banks (user_id , name , short_name , org_type , latitude , longitude , state_id , city_id , district_id, pincode, address_1 , category_id , contact_person , contact_email , contact_ph_no , lic_no , lic_valid_from , lic_valid_to , boarding_type) VALUES ('$last_id','$org_name','$org_short_name','Lab', '$latitude', '$longitude' , '$org_state','$org_city' , '$org_districs' , '$org_pincode' , '$org_address1' , '$org_category' , '$org_contact_name', '$org_email' , '$org_ph_no' , '$org_lic_no' , '$org_lic_valid_from' , '$org_lic_valid_to' , 'Offboarding')");

            if ($insert1 == true) {

               echo '<script>alert("You Form submitted successfully")</script>';
            } else {
               echo "fail";
            }
         } else {
            echo "fail";
         }
} else {
        echo '<script>alert("Incorrect CAPTCHA. Please try again.");</script>';
    }
     
}
?>
<?php defined('BASEPATH') or exit('No direct script access allowed');
$base_url = 'https://bloodlinks.in';
?>
<style type="text/css">
   .hide {
      display: none;
   }

   .form-control {
      padding: 0 10px;
      font-size: 14px;
   }
</style>
<div class="row justify-content-center">
   <div class="col-xl-6">
      <div class="card">
         <div class="card-header text-center">
            <h3 class="card-title">Register Lab </h3>
            <!-- <div class="btn-group" style="float: right;">
               <a href="<?php echo $base_url; ?>/labs" data-toggle="tooltip" title="" class="btn btn-sm btn-default" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
               </div> -->
         </div>
         <div class="card-body">

            <div class="tab-content" id="custom-tabs-one-tabContent">
               <div class="tab-pane fade <?php echo (!session_userdata('next_step')) ? 'show active' : ''; ?>" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                  <form action="<?php $_PHP_SELF ?>" method="POST" class="login-box">
                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                     <div class="row">
                        <div class="col-md-12" style="padding: 20px;">
                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">Lab Name</label>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control" name="org_name" id="org_name" pattern="[a-zA-Z-' ]+" placeholder="Enter Name" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->name : ''; ?>">
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">Short Name</label>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control" name="org_short_name" id="org_short_name" placeholder="Enter short name" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->short_name : ''; ?>">
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">Contact Person</label>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control" name="org_contact_name" id="org_contact_name" placeholder="Enter contact person name" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->contact_person : ''; ?>">
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">Email</label>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control" name="org_email" id="org_email" placeholder="Enter Email address" oninput="$('#org_username').val($('#org_email').val())" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->contact_email : ''; ?>">
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">Contact No</label>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control" name="org_ph_no" id="org_ph_no" placeholder="Enter Contact no." value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->contact_ph_no : ''; ?>">
                              </div>
                           </div>

                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">Helpline No</label>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control" name="org_help_line_no" id="org_help_line_no" placeholder="Enter Helpline No" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->help_line_no : ''; ?>">
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">Category</label>
                              <div class="col-sm-8">
                                 <select class="form-control" id="org_category" name="org_category">
                                    <option value="0">Select category</option>
                                    <?php
                                    $query1 = $this->db->query("SELECT * FROM  bl_categories");
                                    foreach ($query1->result() as $row) {
                                    ?>
                                       }
                                       <option value="<?php echo $row->id; ?>"><?php echo $row->category_name; ?></option>
                                    <?php
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
                              <label for="colFormLabel" class="col-sm-4 col-form-label">District <span> *</span></label>
                              <div class="col-sm-8">
                                 <select class="form-control" id="select_districts" name="cust_districts" style="padding: 0px;margin: 5px;">
                                    <option value="0">Select District</option>
                                 </select>
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">City <span> *</span></label>
                              <div class="col-sm-8">
                                 <select class="form-control" id="select_cities" name="cust_cities" style="padding: 0px;margin: 5px;">
                                    <option value="0">Select City</option>
                                 </select>
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">Pincode</label>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control" name="org_pincode" id="org_pincode" placeholder="Enter Pincode" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->pincode : ''; ?>">
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">Address</label>
                              <div class="col-sm-8">
                                 <textarea class="form-control" name="org_address1" id="org_address1" placeholder="Enter Address" rows="4"><?php echo (isset($blood_bank_data)) ? $blood_bank_data->address_1 : ''; ?></textarea>
                              </div>
                           </div>

                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">Licence No</label>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control" name="org_lic_no" id="org_lic_no" placeholder="Enter Licence No" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->lic_no : ''; ?>">
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">Licence Valid From</label>
                              <div class="col-sm-8">
                                 <input type="date" class="form-control datetimepicker-input" name="org_lic_valid_from" id="org_lic_valid_from" data-target="#org_lic_valid_from_date" placeholder="Enter Licence Valid From" value="<?php echo (isset($blood_bank_data)) ? date('d-m-Y', strtotime($blood_bank_data->lic_valid_from)) : ''; ?>" />
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">Licence Valid To</label>
                              <div class="col-sm-8">
                                 <input type="date" class="form-control datetimepicker-input" name="org_lic_valid_to" id="org_lic_valid_to" data-target="#org_lic_valid_to_date" placeholder="Enter Licence Valid From" placeholder="Enter Licence Valid To" value="<?php echo (isset($blood_bank_data)) ? date('d-m-Y', strtotime($blood_bank_data->lic_valid_to)) : ''; ?>" />
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">Latitude</label>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Enter Latitude" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->help_line_no : ''; ?>">
                              </div>
                           </div>
                           <div class="row mb-3">
                              <label for="colFormLabel" class="col-sm-4 col-form-label">Longitude</label>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Enter Longitude" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->help_line_no : ''; ?>">
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
                              <div class="col-md-12">
                                 <div class="btn-group" style="float: right;">
                                    <button type="submit" class="btn btn-sm btn-danger">Save</button>
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
   </div>
</div>
</div>
</div>
<script type="text/javascript">
   var states_get_url = '<?php echo base_url('get_states'); ?>';
   var districts_get_url = '<?php echo base_url('get_districts'); ?>';
   var cities_get_url = '<?php echo base_url('get_cities'); ?>';
</script>
<script type="text/javascript">
   function show1() {
      document.getElementById('div1').style.display = 'block';
   }

   function show2() {
      document.getElementById('div1').style.display = 'none';
   }
</script>
<script type="text/javascript" src="https://bloodlinks.in/content/themes/front/default/assets/scripts/common.js"></script>
<script type="text/javascript" src="https://bloodlinks.in/content/themes/front/default/assets/scripts/register.js"></script>