<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" crossorigin="anonymous">

<style>
  .form-control {
    height: 1.6rem;
    font-size: 0.9rem;
    padding: 0px;
  }

  .row {
    margin-bottom: -11px !important;
  }

  .card-footer {
    background-color: white !important;
  }

  label:not(.form-check-label):not(.custom-file-label) {
    font-size: 0.8rem !important;
    font-weight: 700 !important;
  }

  button,
  input {
    font-size: 13px;
  }


  label {
    margin-bottom: 0;
  }

  button.btn.btn-danger.float-right {
    padding: 2px 12px;
    font-size: 15px;
  }

  .card-footer {
    padding: 0.23rem 1.25rem;
  }

  .card-header {
    padding: 0.2rem;
  }

  .timeline {
    margin: 0 0 22px;
  }

  .content-header {
    display: none;
  }
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$bank_id = $_SESSION['bank_id'];
// print_r($_SESSION);exit();
if(isset($_SESSION['bloodbank_user_name'])){
    $done_by = $_SESSION['bloodbank_user_name'];
}else{
    $done_by = '';
}

$auth_id = $_SESSION['auth_id'];
$components_available = array();
if ($_SESSION['admin_type'] == '0') {
    
  $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user where id = '$auth_id'");
  $query1com = $this->db->query("SELECT * FROM bl_blood_banks where blood_bank_id = '$bank_id'")->row();
  $components_available = explode(',', $query1com->components_available);
 
  foreach ($query1->result() as $type) {
  }
} else {
  $query1 = $this->db->query("SELECT * FROM bl_blood_banks where user_id = '$auth_id'");
  foreach ($query1->row() as $type) {
  }
  $components_available = explode(',', $query1->row()->components_available);
}
function isComponentAvailable($component_id, $available_components)
{
  return in_array($component_id, $available_components);
}
?>
<link rel="stylesheet" type="text/css" href="https://codepen.io/skjha5993/pen/bXqWpR.css" />
<style type="text/css">
  .hide {
    display: none;
  }

  .content-header {
    display: none;
  }
</style>
<?php

if (!empty($_POST['registration'])) {
  if (!empty($_POST['application_no'])) {
    $request_type = 'Online';
  } else {
    $request_type = 'Offline';
  }
  $request = $_POST['request'];
  $application_no = $_POST['application_no'];
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
  // $city = $_POST['city'];
  $diagnosis = $_POST['diagnosis'];
  foreach ($_POST as $key => $value) {
    if (strpos($key, "unit")) {
      $unit[$key] = $value;
    }
  }
  //   print_r($unit);
  // die();
  $components_unit = json_encode($unit);
  // print_r($components_unit);die();
  if (empty($application_no)) {
    $data1 = '';
  } else {
    $query20 = $this->db->query("SELECT * FROM bl_requestblood WHERE application_no = '$application_no'");
    foreach ($query20->result() as $data1) {
      // print_r($data1);die();
    }
  }
  if (empty($data1)) {

    $insert = $this->db->query("INSERT INTO bl_requestblood (bloodbank_id , request , application_no ,  dates , timess , hospital , status , registration , p_name, f_name, address , age , dob , blood_group , gender , mobile , phone , consultant , required_date , required_time , request_by , attendent_mobile , ward , bed , diagnosis , components_unit , user , request_type) 
    VALUES ('$bank_id','$request', '$application_no', '$date', '$time', '$hospital' , '$status','$registration' , '$p_name' , '$f_name' , '$address' , '$age' , '$dob' , '$blood_group' , '$gender' , '$mobile' , '$phone' , '$consultant' , '$required_date' , '$required_time' , '$request_by' , '$attendent_mobile' , '$ward' , '$bed' , '$diagnosis' , '$components_unit' , '$type->name' , '$request_type')");
    //echo $this->db->insert_id();die;
    if ($insert == true) {
      // echo 'hiii';
      // die();

      redirect('admin/request/request_form');
      // echo '<script>alert("Your Appointment Booked")</script>';
    } else {
      echo "fail";
    }
  } else {
    echo '<script>alert("This Application Already Register !")</script>';
  }
}


if (!empty($_POST['application_no'])) {

    $application = $this->db->escape($_POST['application_no']);

    // 1. Fetch request
    $row = $this->db
        ->where('application_no', $_POST['application_no'])
        ->get('bl_blood_request')
        ->row();

    if (!$row) {
        return; // no data
    }

    // Extract request data
    $components   = json_decode($row->components_unit);
    $user_id      = $row->user_id;
    $blood_id     = $row->blood_group;


    // 2. Fetch customer
    $customer = $this->db
        ->where('user_id', $user_id)
        ->get('bl_customers')
        ->row();


    // 3. Fetch blood group (ID or key)
    $blood = $this->db
        ->where('master_id', $blood_id)
        ->get('bl_masters')
        ->row();
        

    if (!$blood) {
        $blood = $this->db
            ->where('master_type_key_value', $blood_id)
            ->get('bl_masters')
            ->row();
    }
    // print_r($components);die();
}

?>

<h1 style="font-size:1.2rem; font-weight:700; padding-top:9px;">Add Request Form</h1>

<div style="text-align: center;font-size: 16px;padding:6px 10px;"><span style="font-weight: bold;">User Register :</span>
  <input type="radio" name="tab" value="igotnone" onclick="show1();" />
  Offline
  <input type="radio" name="tab" value="igottwo" onclick="show2();" checked />
  Online
</div>
<div style="text-align:center;" id="div1">
  <form action="<?php $_PHP_SELF ?>" method="POST">
    <div style="display:flex; align-items:center; justify-content:center; gap:10px;">

      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" 
             value="<?php echo $this->security->get_csrf_hash(); ?>">

      <label class="col-form-label" style="margin:0;">Application No:</label>

      <select id="app_no" name="application_no" style="width:300px; height:35px;">
        <option value="">Select Application No</option>
        <?php foreach($pendingapplication as $p){ ?>
        <option value="<?php echo $p->application_no; ?>">
          <?php echo $p->application_no; ?>
        </option>
        <?php } ?>
      </select>

      <button type="submit" class="btn btn-danger" 
              style="padding:4px 14px; height:35px;">
        Search
      </button>

    </div>
  </form>
</div>

<!--<div style="text-align: center;">-->
<!--  <form action="<?php $_PHP_SELF ?>" method="POST">-->
<!--    <div class="L9">-->
<!--      <div id="div1">-->
<!--        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">-->
<!--        <label for="" class="col-sm-2 col-form-label">Application No:</label>-->
<!--        <select id="app_no" name="application_no" style="width:300px;">-->
<!--            <option value="">Select Application No</option>-->
<!--            <?php foreach($pendingapplication as $p){ ?>-->
<!--                <option value="<?php echo $p->application_no; ?>">-->
<!--                    <?php echo $p->application_no; ?>-->
<!--                </option>-->
<!--            <?php } ?>-->
<!--        </select>-->
        <!--<input type="text" id="Registration" name="application_no" placeholder="">-->
<!--        <button type="submit" class="btn btn-danger mb-2" style="padding:0px 14px; margin-top:8px;">Search</button>-->
<!--      </div>-->
<!--    </div>-->
<!--  </form>-->
<!--</div>-->
<div class="container-fluid">
  <form action="<?php $_PHP_SELF ?>" method="POST">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="row header" style="padding-bottom: 10px;">
      <div class="col-sm-4">
        <?php $registration = 'BR' . date('yms') . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT); ?>
      </div>

      <div class="container">
        <div class="timeline">
          <div class="card">
            <div class="card-header">
              <div class="btn-group" style="float: right;">
                <a href="<?php echo $base_url; ?>/request/request_form" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="price">Request No</label>
                    <input type="text" name="request" onblur="validation_reg()" class="form-control" value="<?= $registration; ?>" id="reg_val" placeholder="" />

                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="price"> Date</label>
                    <input type="hidden" id="Registration" name="application_no" value="<?php if (isset($row->application_no)) {
                                                                                          echo $row->application_no;
                                                                                        } ?>">
                    <input type="date" name="date" class="form-control " id="date" value="" required="" />
                  </div>
                  <script>
                    document.getElementById('today').value = moment().format('YYYY-MM-DD');
                  </script>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="price"> Time :
                    </label>
                    <input type="time" name="time" class="form-control" id="time" value="<?php if (isset($row->required_time)) {
                                                                                            echo $row->required_time;
                                                                                          } ?>" required="" />
                  </div>
                </div>
              </div>
              <div class="container pl-3 pr-3">
                <h5 class="text-center text-danger">
                  Patient Profile Information
                </h5>
                <div class="row">
                <!---->
                    <div class="col-5">
                        <div class="form-group">
                          <label for="vender">Select Hospital:</label>
                          <select class="form-control " id="hospitalSelect">
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
                  
                  <!---->
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
                      <label for="vender">Status</label>
                      <select class="form-control" name="status">

                        <?php if (!empty($row->stat)) { ?>
                          <option value="stat">stat</option>
                        <?php } elseif (!empty($row->urgent)) { ?>
                          <option value="urgent">urgent</option>
                        <?php } elseif (!empty($row->routine)) { ?>
                          <option value="routine">routine</option>
                        <?php } elseif (!empty($row->reserved)) { ?>
                          <option value="urgent">reserved</option>
                        <?php } else { ?>
                          <option selected disabled hidden style="padding:0px !important;">Select</option>
                        <?php } ?>


                        <?php
                        $query2 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'request_date_status'");
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
                      <label for="price">Patient Name</label>
                      <input type="text" name="p_name" onkeyup="validation_reg()" value="<?php if (isset($row->p_name)) {
                                                                                            echo $row->p_name;
                                                                                          } ?>" class="form-control" id="" required />

                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="description">Father's Name :</label>
                      <input type="text" name="f_name" value="<?php if (isset($row->f_name)) {
                                                                echo $row->f_name;
                                                              } ?>" class="form-control" id="" placeholder="" />
                    </div>
                  </div>




                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="price">Address</label>
                      <input type="text" name="address" value="<?php if (isset($user->address)) {
                                                                  echo $user->address;
                                                                } ?>" class="form-control" id="" placeholder="" />

                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="description">Age</label>
                      <input type="text" name="age" value="<?php if (isset($row->age)) {
                                                              echo $row->age;
                                                            } ?>" class="form-control" id="" required />
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="price">Date of Birth</label>
                      <input type="date" name="dob" value="<?php if (isset($user->dob)) {
                                                              echo $user->dob;
                                                            } ?>" class="form-control" id="" placeholder="" />

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="vender">Blood Group</label>
                      <select class="form-control" name="blood_group" required>
                        <?php if (!empty($blood->master_type_key_value)) { ?>
                          <option value="<?php if (isset($blood->master_type_key_value)) {
                                            echo $blood->master_type_key_value;
                                          } ?>" selected><?php if (isset($blood->master_type_key_value)) {
                                                            echo $blood->master_type_key_value;
                                                          } ?></option>
                        <?php } else { ?>
                          <option value="" selected disabled hidden>select</option>
                        <?php } ?>

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
                       <div class="form-group">
                            <label for="gender">Gender</label>
                        
                            <select class="form-control" name="gender" required>
                                <option value="" disabled <?= empty($row->gender) ? 'selected' : '' ?>>Select</option>
                        
                                <option value="Male"   <?= (isset($row->gender) && $row->gender == 'Male') ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= (isset($row->gender) && $row->gender == 'Female') ? 'selected' : '' ?>>Female</option>
                                <option value="Other"  <?= (isset($row->gender) && $row->gender == 'Other') ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>

                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="vender">Mobile</label>
                      <input type="tel" name="mobile" pattern="\d{10}" title="Please enter 10 digits" maxlength="10" value="<?php if (isset($row->phone)) {
                                                                                                                              echo $row->phone;
                                                                                                                            } ?>" class="form-control" id="" required />
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <label for="price">Consaltant Name</label>
                    <input type="text" name="consultant" value="<?php if (isset($row->consultant)) {
                                                                  echo $row->consultant;
                                                                } ?>" class="form-control" id="" required />

                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="vender">Consaltant Phone</label>
                      <input type="tel" name="phone" class="form-control" id="" value="<?php if (isset($row->consultant_phone)) { echo $row->consultant_phone;  } ?>" />
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="price">Required date</label>
                      <input type="date" name="required_date" class="form-control" value="<?php if (isset($row->required_date)) {
                                                                                            echo $row->required_date;
                                                                                          } ?>" />

                    </div>
                  </div>
                  <div class="col-sm-3">
                    <label for="price">Required Time</label>
                    <input type="time" name="required_time" class="form-control" value="<?php if (isset($row->required_time)) {
                                                                                          echo $row->required_time;
                                                                                        } ?>" />
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="price">Request Entry Done by</label>
                      <input type="text" name="request_by" class="form-control" value="<?= $done_by ?>" id="" placeholder="" />

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label for="price">Mobile no.(Attendent)</label>
                    <input type="tel" name="attendent_mobile" class="form-control" id="" placeholder="" />
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="price">Ward No.</label>
                      <input type="text" name="ward" class="form-control" value="<?php if (isset($row->ward)) {
                                                                                    echo $row->ward;
                                                                                  } ?>" id="" placeholder="" />

                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="price">Bed no.</label>
                      <input type="text" name="bed" class="form-control" value="<?php if (isset($row->bed)) {
                                                                                  echo $row->bed;
                                                                                } ?>" id="" placeholder="" />
                    </div>
                  </div>


                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="price">Diagnosis</label>
                      <select class="form-control" name="diagnosis" style="padding:0px !important;">
                        <?php if (!empty($row->diagnosis)) { ?>
                          <option value="<?php if (isset($row->diagnosis)) {
                                            echo $row->diagnosis;
                                          } ?>"><?php if (isset($row->diagnosis)) {
                                                  echo $row->diagnosis;
                                                } ?></option>
                        <?php } else { ?>
                          <option selected disabled hidden style="padding:0px !important;">Select</option>
                        <?php } ?>


                        <?php
                        $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'diagnosis_types'");
                        foreach ($query1->result() as $diagnosis_types) {
                        ?>
                          <option value="<?= $diagnosis_types->master_type_key_value; ?>"><?= $diagnosis_types->master_type_key_value; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <!--  <div class="col-sm-4">
                      <div class="form-group">
                        <label for="description">City</label>
                        <select class="form-control" name="city">
                       <?php
                        $query4 = $this->db->query("SELECT * FROM bl_cities");
                        foreach ($query4->result() as $city) {
                        ?>
                       <option value="<?= $city->city_name; ?>"><?= $city->city_name; ?></option>
                   <?php } ?>
                     </select>
                      </div>
                    </div> -->


                  <!-- stop -->
                </div>



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
              </div>


              <div class="card-footer">
                <div class="btn-group" style="float: right;">

                  <div class="col-sm-6 form-group mb-0">
                    <button type="cancel" class="btn btn-danger float-right">Reset</button>
                  </div>
                  <div class="col-sm-6 form-group mb-0">
                    <button type="submit" id="submitBtn" class="btn btn-danger float-right">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </form>
</div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap JavaScript (optional, only required if you're using Bootstrap JavaScript components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#app_no').select2({
            placeholder: "Search Application No",
            allowClear: true
        });
    });
  var url2 = '<?php echo $base_url; ?>/donations/donation_validation_reg';

  function validation_reg() {
    var request = $('#reg_val').val();
    var csrf_token = $('#token_id').val();
    $.ajax({
      url: url2,
      method: 'POST',
      data: {
        request: request,
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
<script>
  const [date, time] = formatDate(new Date()).split(' ');
  const dateInput = document.getElementById('date');
  dateInput.value = date;

  const timeInput = document.getElementById('time');
  timeInput.value = time;

  const datetimeLocalInput = document.getElementById('datetime-local');
  datetimeLocalInput.value = date + 'T' + time;

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
</script>