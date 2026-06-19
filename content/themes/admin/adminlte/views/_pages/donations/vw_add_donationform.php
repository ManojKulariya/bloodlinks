<style>
   h1 {
      font-size: 1.2rem !important;
      font-weight: 700 !important;

   }

   label:not(.form-check-label):not(.custom-file-label) {
      margin-bottom: 0;
      font-size: 0.7rem;
      font-weight: 799;
   }

   .form-control {
      height: 1.5rem !important;
      padding: 0 !important;
   }

   .h5-most {
      font-size: 1.15rem !important;
      font-weight: 500 !important;
   }

   .form-group {
      margin: 0 !important;
   }

   .appli-new {
      height: 1.5rem !important;
      padding: 0 !important
   }

   .btn-danger {
      height: 1.5rem !important;
      padding: 0 12px !important;
      margin-bottom: 4px !important;

      font-size: 14px !important;
   }

   .card-footer {
      background: none !important;
      border-top: none !important;
   }

   .btn-last {
      margin-right: 10px !important;
   }

   .content-header {
      padding: 5px 0.5rem !important;
   }

   .nav-sidebar .nav-item>.nav-link {
      position: relative;
      font-size: 14px;
   }
</style>
<?php
$auth_id = $_SESSION['auth_id'];
if ($_SESSION['admin_type'] == '0') {
   $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user where user_id = '$auth_id'");
   foreach ($query1->result() as $type) {
   }
} else {
   $query1 = $this->db->query("SELECT * FROM bl_blood_banks where user_id = '$auth_id'");
   foreach ($query1->result() as $type) {
   }
}
?>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://codepen.io/skjha5993/pen/bXqWpR.css">
<style>
   .hide {
      display: none;
   }

   /* label{
      margin-bottom:0rem !important;
   } */
</style>
<?php
$bank_id = $_SESSION['bank_id'];
if (!empty($_POST['registration'])) {

   //print_r($_POST); die;
   $registration = $_POST['registration'];
   $by = $_POST['by'];
   if ($by == 'camp') {
      $camp_name = $_POST['camp_name'];
      $camp_code = $_POST['camp_code'];
   } else {
      $camp_name = '';
      $camp_code = '';
   }

   $donor_type = $_POST['donor_type'];
   $hemoglobin = $_POST['hemoglobin'];
   $mobile = $_POST['mobile'];
   $donor_name = $_POST['donor_name'];
   $unit = $_POST['unit'];
   $father = $_POST['father'];
   $blood = $_POST['blood'];
   $birth = $_POST['birth'];
   $age = $_POST['age'];
   $sex = $_POST['sex'];
   $address = $_POST['address'];
   $place = $_POST['place'];
   $city = $_POST['city'];
   //$awaited = $_POST['awaited'];
   //$office_phone = $_POST['office_phone'];
   //$sp_volume = $_POST['sp_volume'];
   $previous = $_POST['previous'];
   
//   $date = $_POST['date'];
//   $donation_place = $_POST['donation_place'];
//   $due_date = $_POST['due_date'];
//   $camp = $_POST['camp'];
    $date = $_POST['date'] ?? '';
    $donation_place = $_POST['donation_place'] ?? '';
    $due_date = $_POST['due_date'] ?? '';
    $camp = $_POST['camp'] ?? '';

   $donation = $_POST['donation'];
   $time = $_POST['time'];
   $bag = $_POST['bag'];
   $tube = $_POST['tube'];
   $bp = $_POST['bp'];
   $weight = $_POST['weight'];
   $hct = $_POST['hct'];
   $pet = $_POST['pet'];
   $patient_requestno = $_POST['patient_requestno'];
   $patient_name = $_POST['patient_name'];
   $hospital = $_POST['hospital'];
   $registration_no = $_POST['registration_no'];
   $application_no = $_POST['application_no'];
   $rep_request = $_POST['rep_request'];
   $donation_by =  $type->name;

   $insert = $this->db->query("INSERT INTO bl_bb_donatioform (rep_request,bloodbank_id , registration , application_no, donation_by, donor_type , hemoglobin , unit_no , mobile , donor_name , father, blood_group, birth , age , sex , address , place , city , previous , date , donation_place , due_date , camp , donation_date , time , bag , tube , bp , weight , hct , pet , patient_requestno  , patient_name , hospital , registration_no , camp_status , camp_name , camp_code ) 
   VALUES ('$rep_request','$bank_id','$registration', '$application_no','$type->name','$donor_type', '$hemoglobin', '$unit' , '$mobile','$donor_name' , '$father' , '$blood' , '$birth' , '$age' , '$sex' , '$address' , '$place' , '$city' , '$previous' , '$date' , '$donation_place' , '$due_date' , '$camp' , '$donation' , '$time' , '$bag' , '$tube' , '$bp' , '$weight' , '$hct' , '$pet' , '$patient_requestno' , '$patient_name' , '$hospital' , '$registration_no' , '$by' , '$camp_name' , '$camp_code')");
   if ($insert == true) {
        // -------- Increment Request Count --------
        $this->db->set('used_requests', 'used_requests+1', FALSE)
         ->where('blood_bank_id ', $bank_id)
         ->update('blood_banks');

        // ----------------
      redirect('/admin/donations/forms');
   } else {
      echo "fail";
   }
}
if (!empty($_POST['application_no'])) {
   $application = $_POST['application_no'];

   $bankID = $_SESSION['bank_id'];

   $query = $this->db->query("SELECT * FROM  bl_blood_donation_requests WHERE org_id=$bankID AND  application_no = '$application'");

   if ($query->num_rows() == 0) {
      redirect('/admin/donations/forms/add');
      exit;
   }

   foreach ($query->result() as $row) {
      $user_id = $row->user_id;
      $org_id = $row->org_id;
   }
   $query = $this->db->query("SELECT * FROM  bl_customers WHERE user_id = $user_id");
   foreach ($query->result() as $user) {
   }

   $id = $row->donation_form_id;
   $query6 = $this->db->query("SELECT * FROM bl_donar_form_info WHERE form_step = 'step_4' AND form_id = '$id'");

   foreach ($query6->result() as $row3) {

      $form_data3 = json_decode($row3->detail);
   }

   $city_id = $user->city_id;
   $query1 = $this->db->query("SELECT * FROM bl_cities where id = $city_id");
   foreach ($query1->result() as $city) {
   }

   $query3 = $this->db->query("SELECT * FROM bl_blood_banks where blood_bank_id = $org_id");
   foreach ($query3->result() as $bank) {
   }
   $blood_id = $user->blood_group;
   $query2 = $this->db->query("SELECT * FROM bl_masters where master_id = $blood_id");
   foreach ($query2->result() as $blood) {
   }
}
?>

<!-- 30jan left-part -->

<div class="container" style="padding-bottom:10px;">

   <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
         <div style="text-align:center;;padding: 6px 0px;"><span style="font-size:16px; font-weight:bold !important;">User Register :</span>
            <input type="radio" name="tab" value="igotnone" onclick="show1();" />
            Offline
            <input type="radio" name="tab" value="igottwo" onclick="show2();" checked />
            Online
         </div>
         <div style="">
            <form action="<?php $_PHP_SELF ?>" method="POST">
               <div class="L9">
                  <div id="div1" style="text-align:center;">
                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                     <label for="inputEmail3" class=" col-form-label">Application No:</label>
                     <input type="text" id="Registration" class="appli-new" name="application_no" placeholder="">
                     <button type="submit" class="btn btn-danger Search-new-btn" style="padding:4px 26px;">Search</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">

         <form class="main1" action="<?php $_PHP_SELF ?>" method="POST">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div style="text-align: center;padding: 6px 0px;"><span style="font-size:16px; font-weight:bold !important;">By :</span>
               <input type="radio" name="by" value="direct" onclick="show3();" checked />
               Direct
               <input type="radio" name="by" value="camp" onclick="show4();" />
               Camp
            </div>

            <div class="L9 myl9">
               <div class="hide" id="div2">
                  <div class="row">
                     <div class="col-sm-6 form-group">
                        <div class="form-group row">
                           <label for="inputEmail3" class="col-form-label label-55 col-lg-6" style="padding:0;">Blood Camp Name:</label>
                           <div class="col-lg-6">
                              <select id="campName" class="form-control" name="camp_name" style="font-size:0.78rem;">
                                 <?php
                                 $query1 = $this->db->query("SELECT bl_bloodcamp.*, bl_cities.city_name as city 
                          FROM bl_bloodcamp  
                          LEFT JOIN bl_cities ON bl_bloodcamp.city = bl_cities.id");

                                 foreach ($query1->result() as $camp) {
                                 ?>
                                    <option value="<?= $camp->blood_name; ?>" data-code="<?= $camp->camp_code; ?>" data-venue="<?= $camp->venue; ?>" data-city="<?= $camp->city; ?>"><?= $camp->blood_name; ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 form-group row">
                        <label for="inputEmail3" class=" col-form-label label-55 col-lg-6 " style="padding:0;">Blood Camp Code: </label>
                        <div class="col-lg-6">
                           <input class="form-control" id="camp_code" name="camp_code" style="font-size:0.78rem;" />

                        </div>
                     </div>

                  </div>



               </div>
            </div>


      </div>





   </div>
</div>

<div class="L1">
   <?php $n = 5;
   function reg($n)
   {
      $characters = '0123456789qwertyuiopasdfghjklzxcvbnm';
      $randomString = '';

      for ($i = 0; $i < $n; $i++) {
         $index = rand(0, strlen($characters) - 1);
         $randomString .= $characters[$index];
      }

      return $randomString;
   }

   $registration = reg($n) . date('ym');
   ?>
   <div class="row header pl-4 pr-4 mb-3 shadow rounded" style="background-color:white; margin:0 2px;">
      <div class="col-sm-3 pt-3">
         <div class="form-group row mr-2">
            <label for="inputEmail3">Registration No: </label>
            <input type="text" class="form-control" id="reg_no" placeholder="" name="registration" value="<?php if (isset($registration)) {
                                                                                                               echo $registration;
                                                                                                            } ?>">
         </div>
      </div>
      <div class="col-sm-3 pt-3">
         <div class="form-group row mr-2">
            <label for="inputEmail3">Donor Type : </label>

            <select class="form-control" id="donor_type" onchange="isrep()" name="donor_type" style="padding:0px !important;">
               <?php
               $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'donar_types'");
               foreach ($query1->result() as $reasion) {
               ?>
                  <option value="<?= $reasion->master_type_key_value; ?>"><?= $reasion->master_type_key_value; ?></option>
               <?php } ?>
            </select>

         </div>
      </div>
      <div class="col-sm-3 pt-3">
         <div class="form-group row mr-2">
            <label for="inputEmail3">Hemoglobin: </label>
            <input type="text" class="form-control" id="inputEmail3" name="hemoglobin" placeholder="" value="<?php if (isset($form_data3->hemoglobin)) {
                                                                                                                  echo $form_data3->hemoglobin;
                                                                                                               } ?>">

         </div>
      </div>
      <?php $n = 6;
      function unit($n)
      {
         $characters = '0123456789';
         $randomString = '';

         for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
         }

         return $randomString;
      }

      $unit = unit($n);
      $unit_no = 'DU' . $unit;
      ?>
      <div class="col-sm-3 pt-3">
         <div class="form-group row">
            <label for="inputEmail3">Unit No: </label>

            <input type="text" class="form-control" id="unit_no" onblur="validation_blood()" name="unit" value="<?php if (isset($unit_no)) {
                                                                                                                     echo $unit_no;
                                                                                                                  } ?>" placeholder="">

         </div>
      </div>
      <div class="col-sm-3 pt-3" id="reg_div" style="display:none;">
         <div class="form-group row mr-2">
            <label for="inputEmail3">Request no : </label>
            <input type="text" class="form-control" id="req_val" onblur="get_req_data()" placeholder="">
            <input type="hidden" class="form-control" id="rep_request" name="rep_request" placeholder="">
         </div>
      </div>
      <div class="col-12" id="reg_div_t" style="display:none;">
         <br>
         <table style="width: 100%;font-size:12px;border: solid #000 1px;">
            <thead>
               <tr>
                  <!-- <th id="th" scope="col">#</th> -->
                  <th id="th" scope="col">Request No</th>
                  <th id="th" scope="col">Name</th>
                  <th id="th" scope="col">Blood Group</th>
                  <th id="th" scope="col">Mobile</th>
                  <th id="th" scope="col">DOB</th>
                  <th id="th" scope="col">Date Time</th>
                  <th id="th" scope="col">Ward/bed</th>
                  <th id="th" scope="col">Hospital</th>
                  <th id="th" scope="col">Diagnosis</th>
                  <th id="th" scope="col">Status</th>
                  <th id="th" scope="col">Action</th>
               </tr>
            </thead>
            <tbody id="mytable">
            </tbody>
         </table>
      </div>


      <div class="col-md-12 bg-white pl-4 pr-4">
         <div class="donor-profile mt-2">

            <h5 class="text-center text-danger h5-most">Donor Profile Information</h5>
         </div>
         <input type="hidden" name="application_no" value="<?php if (isset($row->application_no)) {
                                                               echo $row->application_no;
                                                            } ?>">

         <div class="row">
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Donor Name</label>
                  <input type="text" class="form-control" required id="inputEmail3" name="donor_name" value="<?php if (isset($user->first_name)) {
                                                                                                                  echo $user->first_name;
                                                                                                                  echo $user->mid_name;
                                                                                                                  echo $user->last_name;
                                                                                                               } ?>">
               </div>
            </div>
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Father's Name</label>
                  <input type="text" class="form-control" required id="inputEmail3" placeholder="" name="father" value="<?php if (isset($user->f_name)) {
                                                                                                                           echo $user->f_name;
                                                                                                                        } ?>">
               </div>
            </div>
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Address</label>
                  <input type="text" class="form-control" required id="inputEmail3" placeholder="" name="address" value="<?php if (isset($user->address)) {
                                                                                                                              echo $user->address;
                                                                                                                           } ?>">
               </div>
            </div>
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Mobile No</label>
                  <input type="tel" pattern="\d{10}" title="Please enter 10 digits" maxlength="10" class="form-control" required id="inputEmail3" name="mobile" value="<?php if (isset($user->ph_no)) {
                                                                                                                                                                           echo $user->ph_no;
                                                                                                                                                                        } ?>">
               </div>
            </div>
         </div>

         <!-- first row end -->
         <div class="row">
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Blood Group</label>
                  <select class="form-control" required id="inputEmail3" name="blood">
                     <option value="select" disabled>select</option>
                     <option value="<?php if (isset($blood->master_type_key_value)) {
                                       echo $blood->master_type_key_value;
                                    } ?>"><?php if (isset($blood->master_type_key_value)) {
                                             echo $blood->master_type_key_value;
                                          } ?></option>
                     <option value="A+">A+</option>
                     <option value="A-">A-</option>
                     <option value="B+">B+</option>
                     <option value="B-">B-</option>
                     <option value="O+">O+</option>
                     <option value="O-">O-</option>
                     <option value="AB-">AB-</option>
                     <option value="AB+">AB+</option>
                  </select>
               </div>
            </div>

            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Birth Date</label>
                  <input type="date" class="form-control" required id="Date" name="birth" value="<?php if (isset($user->dob)) {
                                                                                                      echo $user->dob;
                                                                                                   } ?>">
               </div>
            </div>
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Age</label>
                  <input type="number" class="form-control p-1" id="inputEmail3" name="age" value="<?php if (isset($user->age)) {
                                                                                                      echo $user->age;
                                                                                                   } ?>" placeholder="">
               </div>
            </div>
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Sex</label>
                  <select class="form-control" required id="inputEmail3" name="sex">
                     <option value="select" <?php if (!isset($user->gender)) echo 'selected="selected"'; ?> disabled>Select</option>
                     <option value="male" <?php if (isset($user->gender) && $user->gender == "male") echo 'selected="selected"'; ?>>Male</option>
                     <option value="female" <?php if (isset($user->gender) && $user->gender == "female") echo 'selected="selected"'; ?>>Female</option>
                     <option value="other" <?php if (isset($user->gender) && $user->gender == "other") echo 'selected="selected"'; ?>>Other</option>
                  </select>

               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Place of Donation</label>
                  <input type="text" class="form-control" required id="p_o_d" name="place" value="<?php if (isset($bank->address_1)) {
                                                                                                      echo $bank->address_1;
                                                                                                   } ?>" placeholder="">
               </div>
            </div>

            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Donation City </label>
                  <input type="text" class="form-control" required id="d_c" name="city" value="<?php if (isset($city->city_name)) {
                                                                                                   echo $city->city_name;
                                                                                                } ?>" placeholder="">
               </div>
            </div>

            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price"> Previous Donated</label>
                  <input type="number" class="form-control" required name="previous" value="<?php if (isset($bank->previous)) {
                                                                                                echo $bank->previous;
                                                                                             } ?>" placeholder="" step="1">

               </div>
            </div>
         </div>

         <div class="mt-2">
            <h5 class="text-center text-danger h5-most">Bag and Replacement Details</h5>
         </div>
         <div class="row">

            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Donation Date</label>
                  <input type="date" class="form-control" required id="inputEmail3" name="donation" value="<?php if (isset($row->requested_schedule_date)) {
                                                                                                               echo $row->requested_schedule_date;
                                                                                                            } ?>">
               </div>
            </div>

            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Time </label>
                  <input type="time" class="form-control" required id="inputEmail3" name="time">
               </div>
            </div>

            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Bag Type</label>
                  <select id="Bag" class="form-control" required id="inputEmail3" name="bag" style="padding:0px !important;">
                     <option value="Previous Donated">Select</option>
                     <?php
                     $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'bag_types'");
                     foreach ($query1->result() as $bag) {
                     ?>
                        <option value="<?= $bag->master_type_key_value; ?>"><?= $bag->master_type_key_value; ?></option>
                     <?php } ?>
                  </select>
               </div>
            </div>


            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Tube no </label>
                  <input type="text" class="form-control" onblur="validation_blood()" required id="tube_no" name="tube" placeholder="">
               </div>
            </div>


         </div>

         <div class="row">

            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">BP</label>
                  <input type="text" class="form-control" id="inputEmail3" name="bp" placeholder="" value="<?php if (isset($form_data3->BP)) {
                                                                                                               echo $form_data3->BP;
                                                                                                            } ?>">
               </div>
            </div>

            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price"> Weight </label>
                  <input type="text" class="form-control" id="inputEmail3" name="weight" placeholder="" value="<?php if (isset($form_data3->weight)) {
                                                                                                                  echo $form_data3->weight;
                                                                                                               } ?>">
               </div>
            </div>

            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">HCT </label>
                  <input type="text" class="form-control" id="inputEmail3" name="hct" placeholder="">
               </div>
            </div>

            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">PET </label>
                  <input type="text" class="form-control" id="inputEmail3" name="pet" placeholder="">
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Patient Request No.</label>
                  <input type="text" class="form-control" id="p_r_n" name="patient_requestno" placeholder="">
               </div>
            </div>
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price"> Patient Name</label>
                  <input type="text" class="form-control" id="p_n" name="patient_name" placeholder="">
               </div>
            </div>
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Hospital</label>
                  <input type="text" class="form-control" id="p_hos" name="hospital" placeholder="">
               </div>
            </div>
            <div class="col-sm-3">
               <div class="form-group">
                  <label for="price">Registration No.</label>
                  <input type="text" class="form-control" id="p_reg" name="registration_no" placeholder="">
               </div>
            </div>
         </div>
         <div class="card-footer">
            <div class="btn-group" style="float: right;">
               <div class=" btn-last">
                  <button type="cancel" class="btn btn-danger"><span>Reset</span></button>
               </div>
               <div class=" btn-last">
                  <button type="submit" id="submitBtn" class="btn btn-danger"><span>Submit</span></button>
               </div>
               <div>
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
   function isrep() {
      var donor_type = $("#donor_type").val();
      if (donor_type != "Replacement") {
         document.getElementById('reg_div').style.display = 'none';
         document.getElementById('reg_div_t').style.display = 'none';
      } else {
         document.getElementById('reg_div_t').style.display = 'block';
         document.getElementById('reg_div').style.display = 'block';
      }
   }

   function show1() {
      document.getElementById('div1').style.display = 'none';
   }

   function show2() {
      document.getElementById('div1').style.display = 'block';
   }
</script>
<script type="text/javascript">
   function show3() {
      document.getElementById('div2').style.display = 'none';

      $("#p_o_d").val('');
      $("#d_c").val('');
   }

   function show4() {
      var selectedOption = $("#campName").find('option:selected');

      $("#p_o_d").val(selectedOption.data('venue'));
      $("#d_c").val(selectedOption.data('city'));
      document.getElementById('div2').style.display = 'block';
   }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
   var url = '<?php echo $base_url; ?>/donations/my_records_request';

   function get_req_data() {
      var req_no = $('#req_val').val();
      var csrf_token = $('#token_id').val();
      $('#mytable').html('');
      $('#rep_request').val('');
      $.ajax({
         url: url,
         method: 'POST',
         data: {
            req_no: req_no,
            [csrf_name]: csrf_token
         },
         success: function(res) {
            if (res != null) {
               $('#mytable').html(`
                             <tr>                            
                              <td>${res.request}</td>
                              <td>${res.p_name}</td>
                              <td>${res.blood_group}</td>
                              <td>${res.mobile}</td>
                              <td>${res.dob}</td>
                              <td>${res.dates} ${res.timess}</td>
                              <td>${res.ward}/${res.bed}</td>
                              <td>${res.hospital}</td>
                              <td>${res.diagnosis}</td>
                              <td>${res.status}</td>
                              <td><input type="checkbox" id="row_check"></td>
                             </tr>
                         `);
               $('#row_check').on('change', function() {
                  if (this.checked) {
                     $('#rep_request').val(req_no);
                     $('#p_r_n').val(res.request);
                     $('#p_n').val(res.p_name);
                     $('#p_hos').val(res.hospital);
                     $('#p_reg').val(res.registration);

                  } else {
                     $('#rep_request').val('');
                     $('#p_r_n').val('');
                     $('#p_n').val('');
                     $('#p_hos').val('');
                     $('#p_reg').val('');

                  }
               });
            } else {
               $('#mytable').html(`
                           <tr>                            
                              <td colspan="10">Not found!</td>
                           </tr>
                         `);
            }
         }

      })
   }
</script>
<script>
   $(document).ready(function() {

      // When the "Blood Camp Name" select element changes
      var selectedOption = $("#campName").find('option:selected');

      // Get the value of the data-code attribute from the selected option
      var selectedCode = selectedOption.data('code');
      $("#camp_code").val(selectedCode);


      $('#campName').on('change', function() {

         var selectedOption = $(this).find('option:selected');

         // Get the value of the data-code attribute from the selected option
         var selectedCode = selectedOption.data('code');
         $("#camp_code").val(selectedCode);
         $("#p_o_d").val(selectedOption.data('venue'));
         $("#d_c").val(selectedOption.data('city'));


      });
   });
</script>

<script type="text/javascript">
   var url2 = '<?php echo $base_url; ?>/donations/donation_validation';

   function validation_blood() {
      var tube_no = $('#tube_no').val();
      var unit_no = $('#unit_no').val();
      var reg_no  = $('#reg_no').val();
      var csrf_token = $('#token_id').val();
      $.ajax({
         url: url2,
         method: 'POST',
         data: {
            tube_no: tube_no,
            unit_no: unit_no,
            reg_no: reg_no,
            [csrf_name]: csrf_token
         },
         success: function(responseData) {
            var res = JSON.parse(responseData);
            if (res.status == 1) {
               alert(res.msg);
               $('#submitBtn').prop('disabled', true);
            }
            if (res.status == 0) {
               $('#submitBtn').prop('disabled', false);
            }
         }
      })
   }
</script>