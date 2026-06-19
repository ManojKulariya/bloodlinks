<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    /* Add padding inside the Select2 input */
.select2-container--default .select2-selection--single {
    padding: 5px 5px;  /* this is what you were trying in JS */
    height: 38px;     /* match your input height */
    line-height: 38px;
    border-radius: 0.25rem; /* optional, to match Bootstrap */
    border: 1px solid #ced4da;
}
.select {
    padding: 5px 5px;  /* this is what you were trying in JS */
    height: 38px;     /* match your input height */
    line-height: 38px;
    border-radius: 0.25rem; /* optional, to match Bootstrap */
    border: 1px solid #ced4da;
}
.select2-container--default .select2-selection__arrow {
    top: 0;
    right: 10px;
    height: 38px;
}

</style>
<div class="find-hospital">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1 class="text-center find-h1-7" style="color: #000;">Register Hospital</h1>
            <hr class="hospital-hr">
         </div>
      </div>
   </div>
</div>

<div class="row justify-content-center addhos-row3 px-4" style="background:#faf9fb !important;">
   <div class="col-12">
      <div class="card">

         <!-- Flash messages -->
         <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success mx-5">
                <?= $this->session->flashdata('success'); ?>
                <?php $this->session->unset_userdata('success'); ?>
            </div>
         <?php endif; ?>

         <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger mx-5">
                <?= $this->session->flashdata('error'); ?>
                <?php $this->session->unset_userdata('error'); ?>
            </div>
         <?php endif; ?>

         <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
               <div class="tab-pane fade <?php echo (!session_userdata('next_step')) ? 'show active' : ''; ?>" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

                  <form action="<?php echo site_url('add_hospital_reg'); ?>" method="POST" class="login-box">
                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                     <div class="row" style="padding:20px;">

                        <!-- Hospital Name & Short Name -->
                        <div class="col-md-6 mb-3">
                           <label for="org_name" class="form-label">Hospital Name</label>
                           <input type="text" class="form-control" name="org_name" id="org_name" placeholder="Enter Name" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->name : ''; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                           <label for="org_short_name" class="form-label">Short Name</label>
                           <input type="text" class="form-control" name="org_short_name" id="org_short_name" placeholder="Enter short name" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->short_name : ''; ?>" required>
                        </div>

                        <!-- Contact Person & Email -->
                        <div class="col-md-6 mb-3">
                           <label for="org_contact_name" class="form-label">Contact Person</label>
                           <input type="text" class="form-control" name="org_contact_name" id="org_contact_name" placeholder="Enter contact person name" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->contact_person : ''; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                           <label for="org_email" class="form-label">Email</label>
                           <input type="email" class="form-control" name="org_email" id="org_email" placeholder="Enter Email address" oninput="$('#org_username').val($('#org_email').val())" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->contact_email : ''; ?>" required>
                        </div>

                        <!-- Contact No & Helpline No -->
                        <div class="col-md-6 mb-3">
                           <label for="org_ph_no" class="form-label">Contact No</label>
                           <input type="tel" class="form-control" pattern="[0-9]{10}" maxlength="10"name="org_ph_no" id="org_ph_no" placeholder="Enter Contact no." required value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->contact_ph_no : ''; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                           <label for="org_help_line_no" class="form-label">Helpline No</label>
                           <input type="text" class="form-control" name="org_help_line_no" id="org_help_line_no" placeholder="Enter Helpline No" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->help_line_no : ''; ?>" required>
                        </div>

                        <!-- Category & Website -->
                        <div class="col-md-6 mb-3">
                           <label for="org_category" class="form-label">Category</label>
                           <select class="form-control select" id="org_category" name="org_category" required>
                              <option value="">Select category</option>
                              <?php
                              $query1 = $this->db->query("SELECT * FROM  bl_categories");
                              foreach ($query1->result() as $row) {
                              ?>
                                 <option value="<?php echo $row->id; ?>"><?php echo $row->category_name; ?></option>
                              <?php } ?>
                           </select>
                        </div>
                        <div class="col-md-6 mb-3">
                           <label for="website" class="form-label">Website</label>
                           <input type="text" class="form-control" name="website" id="website" placeholder="Enter Website URL" >
                        </div>

                        <!-- Have Blood Center & State -->
                        <!--<div class="col-md-6 mb-3">-->
                        <!--   <label for="blood_center" class="form-label">Have Blood Center</label>-->
                        <!--   <select class="form-control" id="blood_center" name="blood_center">-->
                        <!--      <option value="yes" <?php echo (isset($blood_bank_data) && ($blood_bank_data->apheresis_facillity == 'yes')) ? 'selected' : ''; ?>>Yes</option>-->
                        <!--      <option value="no" <?php echo (isset($blood_bank_data) && ($blood_bank_data->apheresis_facillity == 'no')) ? 'selected' : ''; ?>>No</option>-->
                        <!--   </select>-->
                        <!--</div>-->
                        <div class="col-md-6 mb-3">
                           <label for="select_states" class="form-label">State <span>*</span></label>
                           <select class="form-control" id="select_states" name="cust_states" required>
                              <option value="">Select State</option>
                           </select>
                        </div>

                        <!-- District & City -->
                        <div class="col-md-6 mb-3">
                           <label for="select_districts" class="form-label">District <span>*</span></label>
                           <select class="form-control" id="select_districts" name="cust_districts" required>
                              <option value="">Select District</option>
                           </select>
                        </div>
                        <div class="col-md-6 mb-3">
                           <label for="select_cities" class="form-label">City <span>*</span></label>
                           <select class="form-control" id="select_cities" name="cust_cities" required>
                              <option value="">Select City</option>
                           </select>
                        </div>

                        <!-- Pincode & Address -->
                        <div class="col-md-6 mb-3">
                           <label for="org_pincode" class="form-label">Pincode</label>
                           <input type="text" class="form-control" name="org_pincode" id="org_pincode" placeholder="Enter Pincode" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->pincode : ''; ?> " required>
                        </div>
                        <div class="col-md-6 mb-3">
                           <label for="org_address1" class="form-label">Address</label>
                           <textarea class="form-control" name="org_address1" id="org_address1" placeholder="Enter Address" rows="4" required><?php echo (isset($blood_bank_data)) ? $blood_bank_data->address_1 : ''; ?></textarea>
                        </div>

                        <!-- Licence No & Licence Valid From -->
                        <div class="col-md-6 mb-3">
                           <label for="org_lic_no" class="form-label">Licence No</label>
                           <input type="text" class="form-control" name="org_lic_no" id="org_lic_no" placeholder="Enter Licence No" value="<?php echo (isset($blood_bank_data)) ? $blood_bank_data->lic_no : ''; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                           <label for="org_lic_valid_from" class="form-label">Licence Valid From</label>
                           <input type="date" class="form-control" name="org_lic_valid_from" id="org_lic_valid_from" value="<?php echo (isset($blood_bank_data)) ? date('Y-m-d', strtotime($blood_bank_data->lic_valid_from)) : ''; ?>" required>
                        </div>

                        <!-- Licence Valid To & Latitude -->
                        <div class="col-md-6 mb-3">
                           <label for="org_lic_valid_to" class="form-label">Licence Valid To</label>
                           <input type="date" class="form-control" name="org_lic_valid_to" id="org_lic_valid_to" value="<?php echo (isset($blood_bank_data)) ? date('Y-m-d', strtotime($blood_bank_data->lic_valid_to)) : ''; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                           <label for="latitude" class="form-label">Latitude</label>
                           <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Enter Latitude">
                        </div>

                        <div class="col-md-6 mb-3">
                           <label for="longitude" class="form-label">Longitude</label>
                           <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Enter Longitude">
                        </div>
                      
                        <!-- Captcha -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Enter Captcha</label>
                           <?php echo $captcha_image; ?><br><br>
                           <input type="text" name="captcha" id="captcha" required>
                           <input type="hidden" value="<?php echo $captcha_word; ?>" name="captcha_word">
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-12 mb-3 text-end">
                           <button type="submit" class="btn btn-sm btn-danger">Save</button>
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
<!-- jQuery (required by Select2) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript" src="<?php echo base_url('content/themes/front/default/assets/scripts/common.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('content/themes/front/default/assets/scripts/register.js'); ?>"></script>
