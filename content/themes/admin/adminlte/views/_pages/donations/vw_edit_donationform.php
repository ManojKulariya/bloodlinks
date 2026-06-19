<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://codepen.io/skjha5993/pen/bXqWpR.css">
<style>
   .form-control {
      height: 1.5rem !important;
      padding: 0 !important;
   }

   .row {
      /* margin-bottom:-11px; */
   }

   .card-footer {
      background-color: white !important;
      border-top: none !important;

   }

   .content-header {
      padding: 7px 0.5rem;
   }

   label {
      margin-bottom: 0;
      font-size: 0.7rem;
      font-weight: 799;
   }

   .form-group {
      margin-bottom: 0rem;
   }

   .btn-danger {
      height: 1.5rem !important;
      padding: 0 12px !important;
      margin-bottom: 4px !important;
      margin-right: 10px !important;
      font-size: 14px !important;
   }

   .content-header h1 {
      font-size: 1.2rem !important;
      font-weight: 700 !important;
   }

   .h5-most {
      font-size: 1.15rem !important;
      font-weight: 500 !important;
   }

   .nav-sidebar .nav-item>.nav-link {
      font-size: 14px;
   }
</style>
<?php
$id = $this->uri->segment(4);

if (!empty($_POST['registration'])) {

   // print_r($_POST); die;
   $registration = $_POST['registration'];
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
   $previous = $_POST['previous'];
   $donation = $_POST['donation'];
   $time = $_POST['time'];
   $bag = $_POST['bag'];
   $tube = $_POST['tube'];
   $bp = $_POST['bp'];
   $weight = $_POST['weight'];
   $patient_requestno = $_POST['patient_requestno'];
   $patient_name = $_POST['patient_name'];
   $hospital = $_POST['hospital'];
   $registration_no = $_POST['registration_no'];

   $update = $this->db->query("UPDATE bl_bb_donatioform SET registration = '$registration' , donor_type = '$donor_type', hemoglobin = '$hemoglobin', unit_no = '$unit', mobile = '$mobile', donor_name = '$donor_name', father = '$father', blood_group = '$blood', birth = '$birth', age = '$age', sex = '$sex', address = '$address', place = '$place', city = '$city', previous = '$previous',  donation_date = '$donation',  time = '$time', bag = '$bag', tube = '$tube', bp = '$bp', weight = '$weight', patient_requestno = '$patient_requestno', patient_name = '$patient_name', hospital = '$hospital', registration_no = '$registration_no'  WHERE id = '$id'");
   if ($update == true) {
      // echo 'hiii';
      // die();

      redirect('admin/donations/forms');
      // echo '<script>alert("Your Appointment Booked")</script>';
   } else {
      echo "fail";
   }
}

$query = $this->db->query("SELECT * FROM  bl_bb_donatioform WHERE id = $id");
foreach ($query->result() as $row) {
   //print_r($row);die();
}

?>
<div class="container">
   <form class="main1" action="<?php $_PHP_SELF ?>" method="POST">
      <?php if (!empty($row->camp_name)) { ?>
         <div class="row mb-3">

            <div class="col-sm-6 form-group">
               <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label" style="padding:0;">Blood Camp Name: </label>
                  <div class="col-sm-5">
                     <input type="text" class="form-control" id="inputEmail3" name="camp_name" placeholder="" value="<?= $row->camp_name ?>">
                  </div>
               </div>
            </div>

            <div class="col-sm-6 form-group">
               <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label" style="padding:0;">Blood Camp Code: </label>
                  <div class="col-sm-5">
                     <input type="text" class="form-control" id="inputEmail3" name="camp_code" placeholder="" value="<?= $row->camp_code ?>">
                  </div>
               </div>
            </div>
         </div>
      <?php } ?>
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      <div class="row header bg-white pt-5 rounded shadow">
         <div class="col-md-3">
            <div class="form-group">
               <label for="inputEmail3">Registration No: </label>

               <input type="text" class="form-control" name="registration" id="inputEmail3" value="<?= $row->registration ?>" placeholder="">

            </div>
         </div>
         <div class="col-md-3">
            <div class="form-group">
               <label for="inputEmail3">Donor Type : </label>

               <select class="form-control" id="donor_type" onchange="isrep()"  name="donor_type" style="padding:0px !important">
                  <option value="<?= $row->donor_type ?>"><?= $row->donor_type ?></option>
                  <?php
                  $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'donar_types'");

                  foreach ($query1->result() as $reasion) {
                  ?>
                     <option value="<?= $reasion->master_type_key_value; ?>"><?= $reasion->master_type_key_value; ?></option>
                  <?php } ?>
               </select>

            </div>
         </div>
         <div class="col-md-3">
            <div class="form-group">
               <label for="inputEmail3">Hemoglobin: </label>

               <input type="text" class="form-control" id="inputEmail3" name="hemoglobin" placeholder="" value="<?= $row->hemoglobin ?>">

            </div>
         </div>
         <div class="col-md-3">
            <div class="form-group">
               <label for="inputEmail3">Unit No: </label>
               <input type="text" class="form-control" name="unit" value="<?= $row->unit_no ?>" text id="inputEmail3" placeholder="">
            </div>
         </div>
         <div class="col-3 " id="reg_div" style="display:none;">
         <div class="form-group ">
            <label for="inputEmail3">Request no : </label>
            <input type="text" class="form-control" id="req_val" onblur="get_req_data()" value="<?= $row->rep_request ?>"   placeholder="">
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
         


         <div class="col-md-12 ">
            <div class="container bg-white">
               <h5 class="text-center text-danger  h5-most mt-2">Donor Profile Information</h5>

               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Donor Name: </label>

                        <input type="text" class="form-control" id="inputEmail3" name="donor_name" value="<?= $row->donor_name ?>" placeholder="">
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Father's Name: </label>

                        <input type="text" class="form-control" id="inputEmail3" name="father" value="<?= $row->father ?>" placeholder="">
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Address</label>

                        <input type="text" class="form-control" id="inputEmail3" placeholder="" name="address" value="<?= $row->address ?>" placeholder="">
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Mobile No: </label>

                        <input type="text" class="form-control" id="inputEmail3" name="mobile" value="<?= $row->mobile ?>" placeholder="">
                     </div>
                  </div>

               </div>

               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Blood Group:</label>

                        <select class="form-control" id="inputEmail3" name="blood" style="padding:0px !important;">
                           <option value="<?= $row->blood_group ?>"><?= $row->blood_group ?></option>
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
                        <label for="inputEmail3">Birth Date:</label>

                        <input type="date" name="birth" value="<?= $row->birth ?>" class="form-control" id="Date" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Age: </label>

                        <input type="number" class="form-control" id="inputEmail3" name="age" value="<?= $row->age ?>" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Sex</label>

                        <select class="form-control" id="inputEmail3" name="sex">
                           <option value="<?= $row->sex ?>"><?= $row->sex ?></option>
                           <option value="male">Male</option>
                           <option value="female">Female</option>
                           <option value="other">Other</option>
                        </select>
                     </div>
                  </div>

               </div>
               <div class="row">

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Place of Donation </label>

                        <input type="text" class="form-control" id="inputEmail3" name="place" value="<?= $row->place ?>" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group ">
                        <label for="inputEmail3">Donation City </label>

                        <input type="text" class="form-control" name="city" value="<?= $row->city ?>" id="inputEmail3" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group ">
                        <label for="inputEmail3">Previous Donated</label>

                        <input type="number" class="form-control" required name="previous" value="<?php if (isset($row->previous)) {
                                                                                                      echo $row->previous;
                                                                                                   } ?>" placeholder="" step="1">
                     </div>
                  </div>

               </div>
            </div>
         </div>
         <div class="col-md-12 ">
            <div class="container pl-2 pr-2 bg-white">

               <h5 class="text-center text-danger  h5-most mt-2">Bag and Replacement Details</h5>

               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group ">
                        <label for="inputEmail3">Donation Date:</label>

                        <input type="date" class="form-control" id="Date" name="donation" value="<?= $row->donation_date ?>">

                     </div>
                  </div>
                  <div class="col-sm-3 ">
                     <div class="form-group ">
                        <label for="inputEmail3">
                           Time </label>

                        <input type="time" name="time" value="<?= $row->time ?>" class="form-control" id="Date">
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Bag Type: </label>

                        <select class="form-control" id="inputEmail3" name="bag" style="padding:0px !important;">
                           <option value="<?= $row->bag ?>"><?= $row->bag ?></option>
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
                        <label for="inputEmail3">Tube no: </label>

                        <input type="text" class="form-control" id="inputEmail3" name="tube" placeholder="" value="<?= $row->tube ?>">
                     </div>
                  </div>

               </div>
               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">BP </label>

                        <input type="text" class="form-control" id="inputEmail3" name="bp" placeholder="" value="<?= $row->bp ?>">

                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Weight</label>

                        <input type="text" class="form-control" id="inputEmail3" name="weight" placeholder="" value="<?= $row->weight ?>">
                     </div>
                  </div>
                  
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Patient Request No. </label>

                        <input type="text" class="form-control" id="p_r_n" name="patient_requestno" placeholder="" value="<?= $row->patient_requestno ?>">
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Patient Name </label>

                        <input type="text" class="form-control" id="p_n" name="patient_name" placeholder="" value="<?= $row->patient_name ?>">
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Hospital </label>
                        <input type="text" class="form-control" id="p_hos" name="hospital" placeholder="" value="<?= $row->hospital ?>">
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Registration No. </label>
                        <input type="text" class="form-control" id="p_reg" name="registration_no" placeholder="" value="<?= $row->registration_no ?>">
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card-footer">
                     <div class="btn-group" style="float: right;">
                        <div class="btn-last">
                           <button type="cancel" class="btn btn-danger">Reset</button>
                        </div>
                        <div class="btn-last">
                           <button type="submit" class="btn btn-danger">Submit</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
   $(document).ready(function() {
      isrep();
      get_req_data();
   });

</script>
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
               var isChecked = req_no === res.request ? 'checked' : '';
                
                // Update the rep_request input field based on the check
                if (isChecked) {
                    $('#rep_request').val(req_no);
                } else {
                    $('#rep_request').val('');
                }
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
                              <td><input type="checkbox"  ${isChecked} id="row_check"></td>
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