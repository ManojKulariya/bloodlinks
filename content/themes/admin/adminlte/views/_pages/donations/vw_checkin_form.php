<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<br>
<style type="text/css">
   .hide {
      display: none;
   }

   .content-header h1 {
      align-items: center !important;
   }

   .content-header {
      padding: 0px 0.5rem !important;
   }

   .weight-span {
      margin-right: 7px;
   }

   .form-group {
      margin-bottom: 0 !important;
   }

   .number-span {
      margin-right: 7px;
   }
</style>
<?php
$id = $this->uri->segment(4);
$userid = $this->uri->segment(5);
$query = $this->db->query("SELECT * FROM bl_donar_form_info WHERE form_id = '$id' AND form_step = 'step_1'");
//print_r(json_encode($query));

foreach ($query->result() as $row) {

   // $details=json_encode($data_to_store);
   $form_data = json_decode($row->detail);
   // print_obj($form_data);

}

?>
<div class="panel panel-default hf-temp-perm-d">
   <!-- <div class="panel-heading" >
      <h4 class="panel-title">
        <a class="primary" data-parent="#accordion" href="#book-appointment-blk">Appointment Booking</a>
      </h4>
      </div> -->
   <div class="form-card">
      <hr>
      <form action="<?php $_PHP_SELF ?>" method="POST">
         <div id="book-appointment-blk">
            <div class="panel-body">
               <div class="row">


                  <div class="col-md-12">
                     <div class="form-group">

                        <?php if ((!empty($form_data) && isset($form_data->donation_time_selection->ans) && $form_data->donation_time_selection->ans == 'other_day')) { ?>

                           <input type="hidden" name="ans" value="today">
                           <div class="col-md-12 well_feeling_div">
                              <label class="fieldlabels"><span class="number-span">a)</span> Are You Feeling Well Today To Donate Blood?</label>



                              <div>
                                 <span>
                                    <input type="radio" class="rad-input" name="well_feeling" value="yes" checked="">
                                    <label class="rad-label">yes</label>

                                 </span>

                                 <span>
                                    <input type="radio" class="rad-input" name="well_feeling" value="no">
                                    <label class="rad-label">No</label>

                                 </span>

                              </div>

                           </div>

                           <!-- 30jan end -->

                           <div class="col-md-12 well_feeling_div">
                              <label class="fieldlabels"><span class="number-span">b)</span> Did you have anything to eat in last 4 hours?</label>


                              <div>
                                 <span>
                                    <input type="radio" class="rad-input" name="fed_in_last_4_hrs" value="yes" checked="">
                                    <label class="rad-label">Yes</label>
                                 </span>

                                 <span>
                                    <input type="radio" class="rad-input" name="fed_in_last_4_hrs" value="no">
                                    <label class="rad-label">No</label>
                                 </span>
                              </div>





                           </div>





                           <div class="col-md-12 well_feeling_div">
                              <label class="fieldlabels"><span class="number-span">c)</span> Did you sleep well last night?</label>


                              <div>
                                 <span>
                                    <input type="radio" class="rad-input" name="well_slept_last_night" value="yes" checked="">
                                    <label class="rad-label">Yes</label>
                                 </span>

                                 <span>
                                    <input type="radio" class="rad-input" name="well_slept_last_night" value="no">
                                    <label class="rad-label">No</label>

                                 </span>

                              </div>


                           </div>

                        <?php } ?>

                        <h5 style="font-size: 1rem;font-weight: bold;"><span class="number-span">d)</span> General Physical Examination</h5>
                        <div class="row">
                           <div class="col-md-4">
                              <span class="weight-span"> weight :</span> <input type="text" id="d_weight" value="" name="weight" required="">
                           </div>
                           <div class="col-md-4">
                              <span class="weight-span">Hemoglobin :</span> <input type="text" id="d_hemoglobin" value="" name="hemoglobin" required="">
                           </div>
                           <div class="col-md-4">
                              <span class="weight-span"> BP :</span><input type="text" id="d_bp" value="" name="BP" required="">
                              <input type="hidden" id="date" value="" name="defer_date" required="">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4" id="d_weight_err"></div>
                           <div class="col-md-4" id="d_hemoglobin_err"></div>
                           <div class="col-md-4" id="d_bp_err"></div>
                        </div>
                        <div class="row">
                           <div class="col-md-12 Temperature_cls form-group">
                              <label class="fieldlabels"><span class="number-span">e)</span>Temperature :</label>
                              <div class="doneted_out">
                                 <span>
                                    <input type="radio" id="pre_donated_yes" name="temperature" value="normal" checked>
                                    <label class="fieldlabels">Normal</label>
                                 </span>
                                 <span>
                                    <input type="radio" id="pre_donated_no" name="temperature" value="no">
                                    <label class="fieldlabels">Abnormal</label>
                                 </span>
                              </div>
                           </div>

                           <div class="col-md-12 pulse_cls form-group">
                              <label class="fieldlabels"><span class="number-span">f)</span>Pulse :</label>
                              <div class="doneted_out">
                                 <span>
                                    <input type="radio" id="pre_donated_yes" name="pulse" value="normal" checked>
                                    <label class="fieldlabels">Normal</label>
                                 </span>
                                 <span>
                                    <input type="radio" id="pre_donated_no" name="pulse" value="no">
                                    <label class="fieldlabels">Abnormal</label>
                                 </span>
                              </div>
                           </div>



                           <div class="col-md-12 pulse_cls form-group">
                              <label class="fieldlabels"><span class="number-span"> g)</span>Medical and Systemic Examination :</label>
                              <div class="doneted_out">
                                 <span>
                                    <input type="radio" class="rad-input has_accepted_defer" name="has_accepted_defer" value="accept" onclick="show1();" checked>
                                    <label class="rad-label">Accept</label>
                                 </span>
                                 <span>
                                    <input type="radio" class="rad-input has_accepted_defer" name="has_accepted_defer" onclick="show2();" value="defer">
                                    <label class="rad-label">Defer</label>
                                 </span>
                              </div>
                           </div>







                        </div>

                        <span id="div1" class="hide machine-out">
                           <div class="machine-inner">
                              <div class="col-md-12 pulse_cls form-group">
                                  <label class="fieldlabels"><span class="number-span"></span>Defer Type :</label>
                                  <select name="deffer_type" class="form-group">
                                      <option>Temporary</option>
                                      <option>Permanent</option>
                                  </select>
                              </div>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Abnormal Bleeding Tendency">
                                 <label class="fieldlabels">Abnormal Bleeding Tendency</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Abrotion">
                                 <label class="fieldlabels">Abrotion</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Breast Feeding">
                                 <label class="fieldlabels">Breast Feeding</label>
                              </span>
                              <span>
                                 <input type="checkbox" id=" " name="defer-cat-type[]" value="Gonorrhea">
                                 <label class="fieldlabels"> Gonorrhea</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Medication History">
                                 <label class="fieldlabels">Medication History</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Seizures">
                                 <label class="fieldlabels">Seizures </label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Cancer">
                                 <label class="fieldlabels">Cancer</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Heart Disease">
                                 <label class="fieldlabels">Heart Disease</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Occupational Hazard">
                                 <label class="fieldlabels">Occupational Hazard</label>
                              </span>
                              <span><input type="checkbox" id="" name="defer-cat-type[]" value="Surgical Procedures">
                                 <label class="fieldlabels">Surgical Procedures</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Chikungunya">
                                 <label class="fieldlabels">Chikungunya</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Jaundice">
                                 <label class="fieldlabels">Jaundice</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Pregnancy">
                                 <label class="fieldlabels">Pregnancy</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Tuberculosis">
                                 <label class="fieldlabels">Tuberculosis</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Age (Below 18 yrs)">
                                 <label class="fieldlabels">Age (Below 18 yrs)</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Dengue">
                                 <label class="fieldlabels">Dengue</label></span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Kidney Disease">
                                 <label class="fieldlabels">Kidney Disease</label></span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Pulse (Abnormal)">
                                 <label class="fieldlabels">Pulse (Abnormal)</label></span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Ulcer">
                                 <label class="fieldlabels">Ulcer</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Age (Above 65 yrs)">
                                 <label class="fieldlabels">Age (Above 65 yrs)</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Donation Interval">
                                 <label class="fieldlabels">Donation Interval</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Leprosy">
                                 <label class="fieldlabels">Leprosy</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Respiratory Infection">
                                 <label class="fieldlabels">Respiratory Infection</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Unexplained weight loss">
                                 <label class="fieldlabels">Unexplained weight loss</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Blood Transfusion History">
                                 <label class="fieldlabels">Blood Transfusion History</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Fever">
                                 <label class="fieldlabels">Fever</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Liver Disease">
                                 <label class="fieldlabels"> Liver Disease</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Schizophrenia">
                                 <label class="fieldlabels">Schizophrenia</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Vaccination">
                                 <label class="fieldlabels">Vaccination</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Blood Pressure">
                                 <label class="fieldlabels">Blood Pressure</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Genital sore or generalized skin rashes">
                                 <label class="fieldlabels"> Genital sore or generalized skin rashes</label>
                              </span>
                              <span>
                                 <input type="checkbox" id=" defer-cat-type[]th[LBreast]" value="Low Haemoglobin">
                                 <label class="fieldlabels"> Low Haemoglobin</label></span>
                              <span>
                                 <input type="checkbox" id=" " name="defer-cat-type[]" value="Severe Allergic Disorders">
                                 <label class="fieldlabels"> Severe Allergic Disorders</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Viral Hepatitis (B & C)">
                                 <label class="fieldlabels">Viral Hepatitis (B & C)</label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Malaria">
                                 <label class="fieldlabels">Malaria </label>
                              </span>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Weight (Less than 50 Kg)">
                                 <label class="fieldlabels">Weight (Less than 50 Kg)</label>
                              </span><br>
                              <span>
                                 <input type="checkbox" id="" name="defer-cat-type[]" value="Active symptom (Chest Pain. Shortness of breath. Swelling of feet )">
                                 <label class="fieldlabels"> Active symptom <br>(Chest Pain. Shortness of breath. Swelling of feet )</label>
                              </span>
                              <span>
                                 <label class="fieldlabels">Any Other</label>
                                 <input type="checkbox" id="">
                                 <input type="textbox" id="" name="defer-cat-ctype[]" value="">
                              </span>
                        </span>
                     </div>
                  </div>
               </div>
               <div style="text-align: center; margin-left:15px;">
                  <!--  <a class="btn btn-warning btn-md pull-left" id="appointmentPrevBtn">Prev</a> -->
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <button type="cancel" class="btn btn-danger btn-md pull-right">Cancel</button>
                  <input type="submit" id="fin-submit" class="btn btn-success btn-md pull-right">
               </div>
               <!-- <a class="btn btn-success btn-md pull-right" id="primaryNextBtn">Next</a> -->
            </div>
         </div>
   </div>
   <!-- primary -->
   </form>
   <?php
   // $ans= {"ans":"today","ans_data":{"well_feeling":"yes","fed_in_last_4_hrs":"yes","well_slept_last_night":"yes"}};
   if (isset($_POST["well_feeling"]) == 'yes') {

      // $ans= '{"ans":$_POST["ans"],"ans_data":{"well_feeling":$_POST["well_feeling"],"fed_in_last_4_hrs": $_POST["fed_in_last_4_hrs"],"well_slept_last_night":$_POST["well_slept_last_night"]}}';

      // print_r($ans);
      // die();
      $data = array('well_feeling' => clean_data($_POST['well_feeling']), 'fed_in_last_4_hrs' => clean_data($_POST['fed_in_last_4_hrs']), 'well_slept_last_night' => clean_data($_POST['well_slept_last_night']));
      // print_r($data); 
      // die();
      $aa = json_encode($data);
      $update = $this->db->query("UPDATE bl_donar_form_info SET detail = JSON_SET(detail, '$.donation_time_selection.ans', 'today', '$.donation_time_selection.ans_data', '$aa') WHERE form_id = '$id' AND form_step = 'step_1'");


      // print_r($update);
      // echo $this->db->last_query();
      //     die();
   }
   // die();
   if (!empty($_POST)) {
      // print_r($_POST);die();
      // die();


      // print_r($details);
      $ss = json_encode($_POST);
      $insert = $this->db->query("INSERT INTO bl_donar_form_info (form_id, user_id, form_step, detail) VALUES ('$id', '$userid', 'step_5', '$ss')");

      // print_r($insert);die();
      // echo $this->db->insert_id();die;




      $n = 6;
      function getName($n)
      {
         $characters = '0123456789';
         $randomString = '';

         for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
         }

         return $randomString;
      }

      $app = getName($n);
      $application = 'DA' . $app;

      if ($insert == true) {

         if ($_POST["has_accepted_defer"] == 'accept') {
            $update = $this->db->query("UPDATE bl_blood_donation_requests SET donation_status = 'donated', application_no = '$application' WHERE donation_form_id = '$id' AND user_id = '$userid'");
            if ($update == true) {
               redirect('admin/donations/appointments');
               // echo "donated";
            } else {
               echo "fail";
            }
         } else {
            $reason = $_POST["defer-cat-type"];
            $defer_date = $_POST["defer_date"];
            $deffer_type = $_POST["deffer_type"];
            $rea = json_encode($reason);
            $update = $this->db->query("UPDATE bl_blood_donation_requests SET deffer_type='$deffer_type' , donation_status = 'defer',application_no = '$application',defer_reason = '$rea',defer_date = '$defer_date' WHERE donation_form_id = '$id'  AND user_id = '$userid'");
            
            if ($update == true) {
               redirect('admin/donations/appointments');
               // echo "Defer";
            } else {
               echo "fail";
            }
         }
         // redirect('admin/donations/appointments');
         // echo "donated";
      } else {
         echo "fail";
      }
      // print_r($_POST);die();
      // $details=json_encode($_POST);
      // print_r($details);                           // die();


   }
   ?>

   </li>
   </ul>
</div>
</div>
<!--    <input type="submit" name="back" class="back action-button" data-form_type="step_<?php echo $step_back; ?>" value="Back"/> 
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

   function show1() {
      document.getElementById('div1').style.display = 'none';
   }

   function show2() {
      document.getElementById('div1').style.display = 'block';
   }
</script>
<script>
   const [date, time] = formatDate(new Date()).split(' ');
   console.log(date); // 👉️ 2021-12-31
   console.log(time); // 👉️ 09:43

   // ✅ Set Date input Value
   const dateInput = document.getElementById('date');
   dateInput.value = date;

   // 👇️️ "2021-12-31"
   console.log('dateInput value: ', dateInput.value);

   // ✅ Set time input value
   const timeInput = document.getElementById('time');
   timeInput.value = time;

   // 👇️ "09:43"
   console.log('timeInput value: ', timeInput.value);

   // ✅ Set datetime-local input value
   const datetimeLocalInput = document.getElementById('datetime-local');
   datetimeLocalInput.value = date + 'T' + time;

   // 👇️ "2021-12-31T10:09"
   console.log('dateTimeLocalInput value: ', datetimeLocalInput.value);

   // 👇️👇️👇️ Format Date as yyyy-mm-dd hh:mm:ss
   // 👇️ (Helper functions)
   function padTo2Digits(num) {
      return num.toString().padStart(2, '0');
   }

   function formatDate(date) {
      return (
         [
            date.getFullYear(),
            padTo2Digits(date.getMonth() + 1),
            padTo2Digits(date.getDate()),
         ].join('-') +
         ' ' + [
            padTo2Digits(date.getHours()),
            padTo2Digits(date.getMinutes()),
            // padTo2Digits(date.getSeconds()),  // 👈️ can also add seconds
         ].join(':')
      );
   }

   // 👇️ 2022-07-22 08:50:39
   console.log(formatDate(new Date()))

   // 👇️ 2025-05-04 05:24
   console.log(formatDate(new Date('May 04, 2025 05:24:07')))
</script>