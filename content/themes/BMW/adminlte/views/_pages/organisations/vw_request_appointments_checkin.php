<?php defined('BASEPATH') OR exit('No direct script access allowed');
   $id= $this->uri->segment(4);
   $userid= $this->uri->segment(5); 
   // print_r($id);die();
   ?>
<div class="panel panel-default hf-temp-perm-d" >
   <!-- <div class="panel-heading" >
      <h4 class="panel-title">
        <a class="primary" data-parent="#accordion" href="#book-appointment-blk">Appointment Booking</a>
      </h4>
      </div> -->
   <div class="form-card">
      <hr>
      <form action = "<?php $_PHP_SELF ?>" method = "POST">
         <div id="book-appointment-blk"  >
            <div class="panel-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <h5 style="font-size: 1rem;font-weight: bold;">*. GENERAL QUESTION :-</h5>
                        <div class="row">
                           <div class="col-md-12" style="padding: 10px;">
                              1. Patient unable to give consent Reason : <input type="text" id="d_weight" value="" name="reason" required="">
                           </div><br>
                           <div class="col-md-12" style="padding: 10px;">
                             2. Name of Blood Issuer : <input type="text" id="d_hemoglobin" value="" name="issuer_name" required="">
                           </div><br>
                           <div class="col-md-12" style="padding: 10px;">
                             3. Relationship with patient : <input type="text" id="d_bp" value="" name="relationship" required="">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div style="text-align: center;">
                  <!--  <a class="btn btn-warning btn-md pull-left" id="appointmentPrevBtn">Prev</a> -->
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <button type="cancel"   class="btn btn-danger btn-md pull-right">Cancel</button>
                  <input type="submit"  id="fin-submit" class="btn btn-success btn-md pull-right">
               </div>
               <!-- <a class="btn btn-success btn-md pull-right" id="primaryNextBtn">Next</a> -->
            </div>
         </div>
   </div>
   <!-- primary -->
   </form>
   <?php
      if(!empty($_POST['reason'])){ 

         $consent_reason = $_POST['reason'];
    $issuer_name = $_POST['issuer_name']; 
    $relationship = $_POST['relationship'];

         $n=6;
         function getName($n) {
           $characters = '0123456789';
           $randomString = '';
           
           for ($i = 0; $i < $n; $i++) {
             $index = rand(0, strlen($characters) - 1);
             $randomString .= $characters[$index];
          }
          
          return $randomString;
       }
       
       $app = getName($n);
       $application = 'RA'.$app;
      
       $update = $this->db->query("UPDATE bl_blood_request SET consent_reason = '$consent_reason',issuer_name = '$issuer_name',relationship = '$relationship', application_no = '$application' WHERE id = '$id' AND user_id = '$userid'");
       if($update==true){
         redirect('admin/request/blood_appointment');
                           // echo "donated";
      } else{
         echo "fail";
      }         
   } 
      ?>
</div>
</div>
<!--    <input type="submit" name="back" class="back action-button" data-form_type="step_<?php echo $step_back;?>" value="Back"/> 
   <input type="submit" name="submit" id="fin-submit" class="back action-button" value="Submit" style="
   float: right;"> -->
<!-- <a class="btn btn-warning btn-md pull-left" id="appointmentPrevBtn">Prev</a> -->
<!-- <a class="btn btn-success btn-md pull-right" id="primaryNextBtn">Next</a> -->
</div>
</div>
</div> <!-- primary -->
</div>