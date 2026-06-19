<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- progressbar -->
<!-- <ul id="progressbar">
   <li class="active" id="account"><strong>Step 1</strong></li>
   <li id="personal"><strong>Step 2</strong></li>
   <li id="payment"><strong>Step 3</strong></li>
   <li id="payment"><strong>Step 4</strong></li>
   <li id="payment"><strong>Step 5</strong></li>
   <li id="payment"><strong>Step 6</strong></li>
   <li id="confirm"><strong>Finish</strong></li>
</ul>
<div class="progress">
   <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
 </div> -->
 <br> 
 <!-- fieldsets -->
<!-- 
<style type="text/css">
  #Permanent_defer_yes {
    display: none;
   
}

input[value="yes"]:checked ~ #Permanent_defer_yes {
    display: block;
}

/*input[value="red"]:checked ~ #red {
    display: block;
}*/
</style> -->

<?php 

$id= $this->uri->segment(4);
$userid= $this->uri->segment(5);
 $query = $this->db->query("SELECT * FROM bl_donar_form_info WHERE form_id = '$id
' AND form_step = 'step_5'");
 //print_r(json_encode($query));

 foreach ($query->result() as $row)
{

  //  foreach ($row->detail as $data)
  // {

   // print_r($row);
   // die();
  // }
   // $details=json_encode($data_to_store);
  $form_data = json_decode($row->detail);
  // print_obj($form_data);
  foreach ($form_data as $key => $value) {
    # code...
      //print_obj($value->ans);
  }
  // die;
  // print_r($row->detail);
}
 
 ?>
<div class="panel panel-default hf-temp-perm-d" >
          <!-- <div class="panel-heading" >
            <h4 class="panel-title">
              <a class="primary" data-parent="#accordion" href="#book-appointment-blk">Appointment Booking</a>
            </h4>
          </div> -->

          <div class="form-card">
           <div class="row">
             <div class="col-7">
               <h2 class="fs-title">Reason of Defer</h2>
             </div>

             <div class="col-5">
               <h2 class="steps">Step.5 </h2>
             </div>
           </div>
           <hr>


           <form action = "<?php $_PHP_SELF ?>" method = "POST">
            <div id="book-appointment-blk"  >
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="doneted_out">
                        <span>
                          <input type="radio"  name="defer-type" value="yes" > 
                          <label class="fieldlabels">Permanent Deferral</label>
                        </span>
                        <span>
                          <input type="radio"  name="defer-type" value="no" >
                          <label class="fieldlabels"> Temporary Deferral </label>
                        </span>
                      </div>
                    </div>


<!--                   <input name="file" type="radio" value="file" checked>File<input type="file" name="file" class='type'>
<br>    
    
<input name="file" type="radio" value="url">URL<input type="text" name="url" style='display: none;' class='type'> -->



<span id="Permanent_defer_yes" class="machine-out">
  <div class="machine-inner">
    <span>
      <input type="checkbox" id="" name="defer-cat-type[]" value="Abnormal Bleeding Tendency" >
      <label class="fieldlabels">Abnormal Bleeding Tendency</label>
    </span>
    <span>
      <input type="checkbox" id="" name="defer-cat-type[]" value="Abrotion" > 
      <label class="fieldlabels">Abrotion</label>
    </span>
    <span>
      <input type="checkbox" id="" name="defer-cat-type[]" value="Breast Feeding" > 
      <label class="fieldlabels">Breast Feeding</label>
    </span>
    <span>
      <input type="checkbox" id=" " name="defer-cat-type[]" value="Gonorrhea" > 
      <label class="fieldlabels"> Gonorrhea</label>
    </span>
    <span>
      <input type="checkbox" id="" name="defer-cat-type[]" value="Medication History" >
      <label class="fieldlabels">Medication History</label>
    </span>
    <span>
      <input type="checkbox" id="" name="defer-cat-type[]" value="Seizures" >
      <label class="fieldlabels">Seizures </label>
    </span>
    <span>
      <input type="checkbox" id="" name="defer-cat-type[]" value="Cancer" >
      <label class="fieldlabels">Cancer</label>
    </span>
    <span>
      <input type="checkbox" id="" name="defer-cat-type[]" value="Heart Disease" > 
      <label class="fieldlabels">Heart Disease</label>
    </span>
    <span>
      <input type="checkbox" id="" name="defer-cat-type[]" value="Occupational Hazard" >
      <label class="fieldlabels">Occupational Hazard</label>
    </span>
    <span><input type="checkbox" id="" name="defer-cat-type[]" value="Surgical Procedures" >
     <label class="fieldlabels">Surgical Procedures</label>
   </span>
   <span>
    <input type="checkbox" id="" name="defer-cat-type[]" value="Chikungunya" > 
    <label class="fieldlabels">Chikungunya</label>
  </span>
  <span>
    <input type="checkbox" id="" name="defer-cat-type[]" value="Jaundice" > 
    <label class="fieldlabels">Jaundice</label>
  </span>
  <span>
    <input type="checkbox" id="" name="defer-cat-type[]" value="Pregnancy" > 
    <label class="fieldlabels">Pregnancy</label>
  </span>
  <span>
    <input type="checkbox" id="" name="defer-cat-type[]" value="Tuberculosis" >
    <label class="fieldlabels">Tuberculosis</label>
  </span>
  <span>
    <input type="checkbox" id="" name="defer-cat-type[]" value="Age (Below 18 yrs)" >
    <label class="fieldlabels">Age (Below 18 yrs)</label>
  </span>
  <span>
    <input type="checkbox" id="" name="defer-cat-type[]" value="Dengue" >
    <label class="fieldlabels">Dengue</label></span>
    <span>
      <input type="checkbox" id="" name="defer-cat-type[]" value="Kidney Disease" >
      <label class="fieldlabels">Kidney Disease</label></span>
      <span>
        <input type="checkbox" id="" name="defer-cat-type[]" value="Pulse (Abnormal)" > 
        <label class="fieldlabels">Pulse (Abnormal)</label></span>
        <span>
          <input type="checkbox" id="" name="defer-cat-type[]" value="Ulcer" >
          <label class="fieldlabels">Ulcer</label>
        </span>
        <span>
          <input type="checkbox" id="" name="defer-cat-type[]" value="Age (Above 65 yrs)" >
          <label class="fieldlabels">Age (Above 65 yrs)</label>
        </span>
        <span>
          <input type="checkbox" id="" name="defer-cat-type[]" value="Donation Interval" >
          <label class="fieldlabels">Donation Interval</label>
        </span>
        <span>
          <input type="checkbox" id="" name="defer-cat-type[]" value="Leprosy" >
          <label class="fieldlabels">Leprosy</label>
        </span>
        <span>
          <input type="checkbox" id="" name="defer-cat-type[]" value="Respiratory Infection" >
          <label class="fieldlabels">Respiratory Infection</label>
        </span>
        <span>
          <input type="checkbox" id="" name="defer-cat-type[]" value="Unexplained weight loss" > 
          <label class="fieldlabels">Unexplained weight loss</label>
        </span>
        <span>
          <input type="checkbox" id="" name="defer-cat-type[]" value="Blood Transfusion History" > 
          <label class="fieldlabels">Blood Transfusion History</label>
        </span>
        <span>
          <input type="checkbox" id="" name="defer-cat-type[]" value="Fever" > 
          <label class="fieldlabels">Fever</label>
        </span>
        <span>
          <input type="checkbox" id="" name="defer-cat-type[]" value="Liver Disease" > 
          <label class="fieldlabels"> Liver Disease</label>
        </span>
        <span>
          <input type="checkbox" id="" name="defer-cat-type[]" value="Schizophrenia" >
          <label class="fieldlabels">Schizophrenia</label>
        </span>
        <span>
          <input type="checkbox" id="" name="defer-cat-type[]" value="Vaccination" > 
          <label class="fieldlabels">Vaccination</label>
        </span>
        <span>
          <input type="checkbox" id="" name="defer-cat-type[]" value="Blood Pressure" >
          <label class="fieldlabels">Blood Pressure</label>
        </span>
        <span>
          <input type="checkbox" id="" name="defer-cat-type[]" value="Genital sore or generalized skin rashes" > 
          <label class="fieldlabels"> Genital sore or generalized skin rashes</label>
        </span>
        <span>
          <input type="checkbox" id=" defer-cat-type[]th[LBreast]" value="Low Haemoglobin" > 
          <label class="fieldlabels"> Low Haemoglobin</label></span>
          <span>
            <input type="checkbox" id=" " name="defer-cat-type[]" value="Severe Allergic Disorders" > 
            <label class="fieldlabels"> Severe Allergic Disorders</label>
          </span>
          <span>
            <input type="checkbox" id="" name="defer-cat-type[]" value="Viral Hepatitis (B & C)" >
            <label class="fieldlabels">Viral Hepatitis (B & C)</label>
          </span>
          <span>
            <input type="checkbox" id="" name="defer-cat-type[]" value="Malaria" >
            <label class="fieldlabels">Malaria </label>
          </span>
          <span>
            <input type="checkbox" id="" name="defer-cat-type[]" value="Weight (Less than 50 Kg)" > 
            <label class="fieldlabels">Weight (Less than 50 Kg)</label>
          </span><br>
          <span>
            <input type="checkbox" id="" name="defer-cat-type[]" value="Active symptom (Chest Pain. Shortness of breath. Swelling of feet )" >
            <label class="fieldlabels"> Active symptom <br>(Chest Pain. Shortness of breath. Swelling of feet )</label>
          </span>
          <span>
            <label class="fieldlabels">Any Other</label>
            <input type="checkbox" id="" >
            <input type="textbox" id="" name="defer-cat-ctype" value=""> 
          </span>
        </span>
      </div>
    </div>
    <div style="text-align: center;">
     <!--  <a class="btn btn-warning btn-md pull-left" id="appointmentPrevBtn">Prev</a> -->
     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
     <input type="submit"  id="fin-submit" class="btn btn-success btn-md pull-right">
   </div>
   <!-- <a class="btn btn-success btn-md pull-right" id="primaryNextBtn">Next</a> -->
 </div>
</div>
</div> <!-- primary -->
</form>
<?php  
if (!empty($_POST)) {
 $details=json_encode($_POST);
                  // print_r($details);
                  // die();
 $insert = $this->db->query("INSERT INTO bl_donar_form_info (form_id, user_id, form_step, detail) VALUES ('$id', '$userid', 'step_5', '$details')");
// echo $this->db->insert_id();die;
  if($insert==true){
  redirect('admin/donations/appointments');
  } else{
  echo "fail";
  } 

} ?>

                <!--  <center>
                    <span style="font-size: 24px;">
                      <strong>Thanks for filling up the form </strong>
                    </span>
                    <br>
                    <input type="hidden" value="0" id="schedule_appointment" name="schedule-appointment">
                    Please click here to <a class="back action-button" href="<?php echo base_url('schedule-appointment');?>"  id="set_schedule_appointment" style="float: none;" >schedule appointment</a>
                    
                  </center> -->
                      <!-- <div class="doneted_out">
                        <span>
                          <input type="radio" checked id="hosp" name="loc" value="hospital" >
                          <label class="fieldlabels" for="hosp" >hospital</label>
                        </span>
                        <span>
                          <input type="radio" id="b-bank" name="loc" value="blood_bank" >
                          <label class="fieldlabels" for="b-bank">blood bank</label>
                        </span>

                        <span>
                          <span class="btn btn-secondary" id="get-nearby-HBBC">check</span>
                        </span>
                        
                      </div>  -->
                    </li>

                  </ul>

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
     <script type="text/javascript">
       $("input:radio").change(function() {
        $(".type").hide();
        $(this).next("input").show();
      });
    </script>