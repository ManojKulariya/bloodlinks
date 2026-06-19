<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" type="text/css" href="https://codepen.io/skjha5993/pen/bXqWpR.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" crossorigin="anonymous">

<style>
   .row {
      margin-bottom: -11px;
   }

   .form-control {
      height: 1.5rem !important;
      padding: 0 !important;
   }

   .hide {
      display: none;
   }

   .card-footer {
      background-color: white !important;
   }

   label {
      margin-bottom: 0 !important;
      font-size: 0.8rem !important
   }

   .btn-danger {
      font-size: 13px !important;
      padding: 3px 17px !important;
   }

   .content-header h1 {
      font-weight: 700 !important;
      font-size: 1.2rem !important;
   }
</style>
<?php
$id = $this->uri->segment(4);
$bank_id = $_SESSION['bank_id'];
$auth_id = $_SESSION['auth_id'];
$components_available = array();
if ($_SESSION['admin_type'] == '0') {
    $query1com = $this->db->query("SELECT * FROM bl_blood_banks where blood_bank_id = '$bank_id'")->row();
  $components_available = explode(',', $query1com->components_available);
 
}else{
$query31 = $this->db->query("SELECT * FROM bl_blood_banks where user_id = '$auth_id'")->row();
 if($query31){ 
     $components_available = explode(',', $query31->components_available); 
     
 }    
}


function isComponentAvailable($component_id, $available_components)
{
   return in_array($component_id, $available_components);
}

if (!empty($_POST['registration'])) {

   $request = $_POST['request'];
   $date = $_POST['date'];
   $time = $_POST['time'];
   $hospital = $_POST['hospital'];
   $status = $_POST['status'];
   $registration = $_POST['registration'];
   $p_name = $_POST['p_name'];
   $f_name = $_POST['f_name'];
   $address = $_POST['address'];
   $age = $_POST['age'];
   $dob = $_POST['dob'];
   $blood_group = $_POST['blood_group'];
   $gender = $_POST['gender'];
   $mobile = $_POST['mobile'];
   $phone = $_POST['phone'];
   $consultant = $_POST['consultant'];
   $required_date = $_POST['required_date'];
   $required_time = $_POST['required_time'];
   $request_by = $_POST['request_by'];
   $attendent_mobile = $_POST['attendent_mobile'];
   $ward = $_POST['ward'];
   $bed = $_POST['bed'];
   $diagnosis = $_POST['diagnosis'];
   foreach ($_POST as $key => $value) {
      if (strpos($key, "unit")) {
         $unit[$key] = $value;
      }
   }
   //print_r($unit);
   //die;                                                                                                    
   $components_unit = json_encode($unit);
   $update = $this->db->query("UPDATE bl_requestblood SET bloodbank_id = '$bank_id',request = '$request',dates = '$date', timess = '$time' ,hospital = '$hospital',status = '$status',registration = '$registration', p_name = '$p_name' ,f_name = '$f_name',address = '$address',age = '$age', dob = '$dob' ,blood_group = '$blood_group',gender = '$gender',mobile = '$mobile', phone = '$phone' ,consultant = '$consultant',required_date = '$required_date',required_time = '$required_time', request_by = '$request_by' ,attendent_mobile = '$attendent_mobile',ward = '$ward',bed = '$bed', diagnosis = '$diagnosis', components_unit = '$components_unit' WHERE id = '$id' ");
   //echo $this->db->insert_id();die;
   if ($update == true) {
      // echo 'hiii';
      // die();

      redirect('admin/request/request_form');
      // echo '<script>alert("Your Appointment Booked")</script>';
   } else {
      echo "fail";
   }
}


$row = $this->db->query("SELECT * FROM  bl_requestblood WHERE id = '$id'")->row();
$form_data1 = [];
if($row->components_unit != ""){
     $form_data1 = json_decode($row->components_unit);
}


?>

<div class="container-fluid bg-white rounded shadow p-4 mb-4">
   <form action="<?php $_PHP_SELF ?>" method="POST">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      <div class="row header">
         <div class="col-sm-4">
            <?php $n = 6;
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

            $registration = reg($n);
            ?>
            <div class="form-group">
               <label for="inputEmail3">
                  Request No :
               </label>

               <input type="text" name="request" value="<?php if (isset($row->request)) {
                                                            echo $row->request;
                                                         } ?> " readonly class="form-control" id="inputEmail3" placeholder="" />

            </div>
         </div>
         <div class="col-sm-4">
            <div class="form-group">
               <label for="inputEmail3">
                  Date :</label>

               <input type="date" name="date" value="<?php if (isset($row->dates)) {
                                                         echo $row->dates;
                                                      } ?>" class="form-control" id="Date" required="" />

            </div>
         </div>
         <div class="col-sm-4">
            <div class="form-group">
               <label for="inputEmail3">
                  Time :
               </label>

               <input type="time" name="time" value="<?php if (isset($row->timess)) {
                                                         echo $row->timess;
                                                      } ?>" class="form-control" id="Date" placeholder="" required="" />
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-md-12">
            <div class="container pl-3 pr-3">
               <h5 class="text-center text-danger bold">
                  Patient Profile Information
               </h5>
               <div class="row">
                  <div class="col-5">
                     <div class="form-group">
                        <label for="vender">Select Hospital:</label>
                        <select class="form-control " id="hospitalSelect" name="hospital">
                           <option selected="selected" value="" style="margin:0px !important;">Select</option>
                           <?php
                           $query_hp = $this->db->query("SELECT * FROM bl_bb_hospital where bank_id='$bank_id'")->result();
                           foreach ($query_hp as $hospital) { ?>
                              <option value="<?= $hospital->hp_name; ?>" data-regno="<?= $hospital->reg_no; ?>"><?= $hospital->hp_name; ?>-<?= $hospital->reg_no; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <div class="col-7">
                     <div class="form-group">
                        <a href="#" id="openAmalModal">
                           <i class="fas fa-plus-circle" style="margin-top:25px;"></i>
                        </a>

                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="vender">Hospital Name:</label>
                        <input type="text" name="hospital" class="form-control" value="<?php if (isset($row->hospital)) {
                                                                                          echo $row->hospital;
                                                                                       } ?>" id="hospital_bb" required />
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Status :</label>

                        <select class="form-control" name="status" style="padding:0px;">
                           <option value="<?php if (isset($row->status)) {
                                             echo $row->status;
                                          } ?>"><?php if (isset($row->status)) {
                                                   echo $row->status;
                                                } ?></option>
                           <?php $query2 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'request_date_status'");
                           foreach ($query2->result() as $request_date_status) {
                           ?>
                              <option value="<?= $request_date_status->master_type_key_value; ?>"><?= $request_date_status->master_type_key_value; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="description">Registration No :</label>
                        <input type="text" name="registration" value="<?php if (isset($row->registration)) {
                                                                           echo $row->registration;
                                                                        } ?>" class="form-control" id="registrationNohp" placeholder="" />
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Patient Name :
                        </label>

                        <input type="text" name="p_name" value="<?php if (isset($row->p_name)) {
                                                                     echo $row->p_name;
                                                                  } ?>" class="form-control" id="inputEmail3" placeholder="" />
                     </div>
                  </div>

               </div>
               <div class="row">


                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Father's Name :
                        </label>

                        <input type="text" name="f_name" value="<?php if (isset($row->f_name)) {
                                                                     echo $row->f_name;
                                                                  } ?>" class="form-control" id="inputEmail3" placeholder="" />
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Address :</label>

                        <input type="text" name="address" value="<?php if (isset($row->address)) {
                                                                     echo $row->address;
                                                                  } ?>" class="form-control" id="inputEmail3" placeholder="" />
                     </div>
                  </div>


                  <div class="col-sm-3 ">
                     <div class="form-group">
                        <label for="inputEmail3">Age :
                        </label>

                        <input type="text" name="age" value="<?php if (isset($row->age)) {
                                                                  echo $row->age;
                                                               } ?>" class="form-control" id="inputEmail3" placeholder="" />
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Date of Birth :
                        </label>

                        <input type="date" name="dob" value="<?php if (isset($row->dob)) {
                                                                  echo $row->dob;
                                                               } ?>" class="form-control" id="inputEmail3" placeholder="" />
                     </div>
                  </div>

               </div>
               <div class="row">



               </div>


               <div class="row">

                  <div class="col-sm-3 ">
                     <div class="form-group">
                        <label for="inputEmail3">Blood Group :</label>

                        <select class="form-control" name="blood_group">
                           <option value="<?php if (isset($row->blood_group)) {
                                             echo $row->blood_group;
                                          } ?>"><?php if (isset($row->blood_group)) {
                                                   echo $row->blood_group;
                                                } ?></option>
                           <option value="A+">A+</option>
                           <option value="A-">A-</option>
                           <option value="AB+">AB+</option>
                           <option value="AB-">AB-</option>
                           <option value="B+">B+</option>
                           <option value="B-">B-</option>
                           <option value="O+">O+</option>
                           <option value="O-">O-</option>
                        </select>
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div form-group>
                        <label for="inputEmail3">Gender :</label>

                        <select class="form-control" name="gender">
                           <option value="<?php if (isset($row->gender)) {
                                             echo $row->gender;
                                          } ?>"><?php if (isset($row->gender)) {
                                                   echo $row->gender;
                                                } ?></option>
                           <option value="Male">Male</option>
                           <option value="Female">Female</option>
                           <option value="Other">Other</option>
                        </select>
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Mobile :
                        </label>
                        <input type="tel" name="mobile" value="<?php if (isset($row->mobile)) {
                                                                  echo $row->mobile;
                                                               } ?>" class="form-control" id="inputEmail3" placeholder="" />
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group ">
                        <label for="inputEmail3">Consaltant Name:</label>

                        <input type="text" name="consultant" value="<?php if (isset($row->consultant)) {
                                                                        echo $row->consultant;
                                                                     } ?>" class="form-control" id="inputEmail3" placeholder="" />
                     </div>
                  </div>
               </div>
               <div class="row">

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Consaltant Phone :</label>

                        <input type="tel" name="phone" value="<?php if (isset($row->phone)) {
                                                                  echo $row->phone;
                                                               } ?>" class="form-control" id="inputEmail3" placeholder="" />
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Required date :</label>

                        <input type="date" name="required_date" class="form-control" value="<?php if (isset($row->required_date)) {
                                                                                                echo $row->required_date;
                                                                                             } ?>" id="inputEmail3" placeholder="" />
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Required Time:</label>

                        <input type="time" name="required_time" class="form-control" value="<?php if (isset($row->required_time)) {
                                                                                                echo $row->required_time;
                                                                                             } ?>" id="inputEmail3" placeholder="" />

                     </div>
                  </div>


                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Request Entry Done by :</label>

                        <input type="text" name="request_by" value="<?php if (isset($row->request_by)) {
                                                                        echo $row->request_by;
                                                                     } ?>" class="form-control" id="inputEmail3" placeholder="" />
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Mobile no.(Attendent) :</label>

                        <input type="tel" name="attendent_mobile" value="<?php if (isset($row->attendent_mobile)) {
                                                                              echo $row->attendent_mobile;
                                                                           } ?>" class="form-control" id="inputEmail3" placeholder="" />
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="inputEmail3">Ward No.:</label>

                        <input type="text" name="ward" class="form-control" value="<?php if (isset($row->ward)) {
                                                                                       echo $row->ward;
                                                                                    } ?>" id="inputEmail3" placeholder="" />

                     </div>
                  </div>


                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">
                           Bed no.:
                        </label>

                        <input type="text" name="bed" class="form-control" value="<?php if (isset($row->bed)) {
                                                                                       echo $row->bed;
                                                                                    } ?>" id="inputEmail3" placeholder="" />

                     </div>
                  </div>

                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="inputEmail3">Diagnosis:
                        </label>

                        <select class="form-control" name="diagnosis" style="padding:0px !important;">
                           <option value="<?php if (isset($row->diagnosis)) {
                                             echo $row->diagnosis;
                                          } ?>"><?php if (isset($row->diagnosis)) {
                                                   echo $row->diagnosis;
                                                } ?></option>
                           <?php
                           $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'diagnosis_types'");
                           foreach ($query1->result() as $diagnosis_types) {
                           ?>
                              <option value="<?= $diagnosis_types->master_type_key_value; ?>"><?= $diagnosis_types->master_type_key_value; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
               </div>
            </div>


         </div>


         <div class="col-md-12 bg-white">
            <div class="container pl-4 pr-4">
               <h5 class="text-danger" style="text-align: center;">Components</h5>
              
               <div class="row">
                  <?php if (isComponentAvailable(18, $components_available)) { ?>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="price">Whole Blood</label>
                           <input type="number" name="whole_blood_unit" class="form-control" value="<?php if (isset($form_data1->whole_blood_unit)) {
                                                                                                         echo $form_data1->whole_blood_unit;
                                                                                                      } ?>" id="" placeholder="" />
                        </div>
                     </div>
                  <?php } ?>

                  <?php if (isComponentAvailable(885, $components_available)) { ?>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="price">Cryo Poor Plasma</label>
                           <input type="number" name="Cryo_Poor_Plasma_unit" class="form-control" value="<?php if (isset($form_data1->Cryo_Poor_Plasma_unit)) {
                                                                                                            echo $form_data1->Cryo_Poor_Plasma_unit;
                                                                                                         } ?>" id="" placeholder="" />
                        </div>
                     </div>
                  <?php } ?>

                  <?php if (isComponentAvailable(19, $components_available)) { ?>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="price">Cryoprecipitate</label>
                           <input type="number" name="Cryoprecipitate_unit" class="form-control" value="<?php if (isset($form_data1->Cryoprecipitate_unit)) {
                                                                                                            echo $form_data1->Cryoprecipitate_unit;
                                                                                                         } ?>" id="" placeholder="" />
                        </div>
                     </div>
                  <?php } ?>
                  <?php if (isComponentAvailable(886, $components_available)) { ?>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="price">Single Donor Platellet</label>
                           <input type="number" name="Single_Donor_Platellet_unit" class="form-control" value="<?php if (isset($form_data1->Single_Donor_Platellet_unit)) {
                                                                                                                  echo $form_data1->Single_Donor_Platellet_unit;
                                                                                                               } ?>" id="" placeholder="" />
                        </div>
                     </div>
                  <?php } ?>
                  <?php if (isComponentAvailable(20, $components_available)) { ?>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="price">Fresh Frozen Plasma</label>
                           <input type="number" name="Fresh_Frozen_Plasma_unit" class="form-control" value="<?php if (isset($form_data1->Fresh_Frozen_Plasma_unit)) {
                                                                                                               echo $form_data1->Fresh_Frozen_Plasma_unit;
                                                                                                            } ?>" id="" placeholder="" />
                        </div>
                     </div>
                  <?php } ?>

                  <?php if (isComponentAvailable(21, $components_available)) { ?>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="price">Red blood cell</label>
                           <input type="number" name="Red_blood_cell_unit" class="form-control" value="<?php if (isset($form_data1->Red_blood_cell_unit)) {
                                                                                                            echo $form_data1->Red_blood_cell_unit;
                                                                                                         } ?>" id="" placeholder="" />
                        </div>
                     </div>
                  <?php } ?>

                  <?php if (isComponentAvailable(22, $components_available)) { ?>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label for="price">Platelet rich concentrate</label>
                           <input type="number" name="Platelet_rich_concentrate_unit" class="form-control" value="<?php if (isset($form_data1->Platelet_rich_concentrate_unit)) {
                                                                                                                     echo $form_data1->Platelet_rich_concentrate_unit;
                                                                                                                  } ?>" id="" placeholder="" />
                        </div>
                     </div>
                  <?php } ?>
               </div>
               <div class="card-footer">
                  <div class="row float-right">
                     <div class="col-sm-6 form-group mb-0">
                        <button type="cancel" class="btn btn-danger float-right">Reset</button>
                     </div>
                     <div class="col-sm-6 form-group mb-0">
                        <button type="submit" class="btn btn-danger float-right">Submit</button>
                     </div>
                  </div>

               </div>
            </div>
         </div>
   </form>
</div>
<div id="amalModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hospital Form</h5>
        <button type="button" class="close" data-dismiss="amalModal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="amalForm">
          <div class="form-group">
            <label for="hospitalName">Hospital Name</label>
            <input type="text" class="form-control" id="hospitalName" name="hp_name">
          </div>
          <div class="form-group">
            <label for="registrationNo">Registration Number</label>
            <input type="text" class="form-control" id="registrationNo" name="reg_no">
          </div>
          <input type="hidden" class="form-control" id="bloodBankID" name="bank_id" value="<?= $bank_id ?>">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveAmal">Save</button>
      </div>
    </div>
  </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap JavaScript (optional, only required if you're using Bootstrap JavaScript components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script type="text/javascript">
   $(document).ready(function() {
      $("#hospitalSelect").change(function() {
         var selectedOption = $(this).find("option:selected");
         var hospitalName = selectedOption.val();
         var registrationNo = selectedOption.data("regno");

         // Update the input fields with the selected values
         $("#hospital_bb").val(hospitalName);
         $("#registrationNohp").val(registrationNo);
      });
      $("#openAmalModal").click(function() {
         $("#amalModal").modal('show');
      });

      $("#saveAmal").click(function() {
         var hospitalName = $("#hospitalName").val();
         var registrationNo = $("#registrationNo").val();
         var bloodBankID = $("#bloodBankID").val();
         var url_hp = '<?php echo $base_url; ?>/donations/my_city_hospital';
         $.ajax({
            type: "POST",
            url: url_hp, // Change this to your actual server endpoint
            data: {
               hospitalName: hospitalName,
               registrationNo: registrationNo,
               bloodBankID: bloodBankID
            },
            success: function(response) {
               // Handle success response
               location.reload();
               // $("#amalModal").modal('hide');
            },
            error: function(xhr, status, error) {
               // Handle error response
               console.error("Error:", error);
            }
         });
      });
   });

   function show1() {
      document.getElementById('div1').style.display = 'none';
   }

   function show2() {
      document.getElementById('div1').style.display = 'block';
   }
</script>