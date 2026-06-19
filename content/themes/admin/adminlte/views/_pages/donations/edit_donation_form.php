<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="image-contactus-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="lg-text text-dark">Edit Donation Form</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="bread-bar">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-6 col-xs-8">
          <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">Edit Donation Form</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!--request form-->
  <!--request form-- end-->
  <section class="request-form" id="donate-request-form-2">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
  #accordion {
    margin-top: 60px;
  }
  table,
  th,
  td {
    border: 1px solid black;
  }
  .panel-default>.panel-heading {

    color: #fff;
    background-color: #b40028;
    border-color: #b40028;
  }
  form{
    padding-bottom: 50px !important;
  }
  #locations{
    height: 44px;
    font-size: 15px;
    margin-left: 15px !important;
}
#sdmh_bank span {
    float: left !important;
    width: 140px;
}
.t-3678{
  display: none;
}
</style>
  <?php
  
    $protocol = $base_url;
    $user_id = $_GET["donor-id"];
    $protocol = $protocol . "://" . $_SERVER['HTTP_HOST'] ."/";
    
    $suffers_s1q9       = mysqli_query($conn,"SELECT * FROM donation_form_data WHERE q_key='suffers_s1q9'");
    $medicine_last_72h  = mysqli_query($conn,"SELECT * FROM donation_form_data WHERE q_key='medicine_last_72h'");
    $vaccinated_last_2w = mysqli_query($conn,"SELECT * FROM donation_form_data WHERE q_key='vaccinated_last_2w'");
    $suffers_last_2w    = mysqli_query($conn,"SELECT * FROM donation_form_data WHERE q_key='suffers_last_2w'");
    $had_last_3m        = mysqli_query($conn,"SELECT * FROM donation_form_data WHERE q_key='had_last_3m'");
    $had_last_6m        = mysqli_query($conn,"SELECT * FROM donation_form_data WHERE q_key='had_ast_6m'");
    $had_last_12m       = mysqli_query($conn,"SELECT * FROM donation_form_data WHERE q_key='had_last_12m'");
    $permanent_defers   = mysqli_query($conn,"SELECT * FROM permanent_defers");
    // echo $base_url;
    $get_donar_query = "SELECT * FROM users WHERE id='$user_id'";
      $user_data_res = mysqli_query($conn, $get_donar_query);
      while ($row = mysqli_fetch_array($user_data_res, MYSQLI_ASSOC)) {
            $name         = $row['name'];
            $email        = $row['email'];
            $phone_number = $row['phone_number'];
            $age          = $row['age'];
            $blood_group  = $row['blood_group'];
            $state        = $row['state'];
            $distict      = $row['district'];
            $address      = $row['address'];
            echo $gender       = $row['gender'];
            $occupation   = $row['occupation'];
      }
      
      $get_donation_form_details = "SELECT * FROM donor_form_info WHERE id=".$_GET['df-id'];
      $donation_form_query_res = mysqli_query($conn, $get_donation_form_details);
      while ($form_details_res = mysqli_fetch_array($donation_form_query_res, MYSQLI_ASSOC)) {
        //   echo "<pre>";
        $donor_det    = json_decode($form_details_res['detail'], true);
        // print_r($donor_det);
        $donor_det['step_1']['donated_blood'];
        $donation_day               = $donor_det['step_1']['donation_day'];
        $donated_blood              = $donor_det['step_1']['donated_blood'];
        $last_donated_date          = $donor_det['step_1']['last_donated_date'];
        // $donation_at_sdmh_status    = $donor_det['step_1']['donation_at_sdmh_status'];
        $recieved_organisation_name = $donor_det['step_1']['recieved_organisation_name'];
        $recieved_organisation_city = $donor_det['step_1']['recieved_organisation_city'];
        $donation_count_sdmh        = $donor_det['step_1']['donation_count_sdmh'];
        $basic_health_well_being    = $donor_det['step_1']['basic_health_well_being'];
        $DDOA_discomfort            = $donor_det['step_1']['DDOA_discomfort'];
        $reason_to_BDSIY            = $donor_det['step_1']['reason_to_BDSIY'];
        $last_4H_eat                = $donor_det['step_1']['last_4H_eat'];
        $well_today                 = $donor_det['step_1']['well_today'];
        $last_sleep_status          = $donor_det['step_1']['last_sleep_status'];
        $suffer_type_status         = $donor_det['step_1']['suffer_type_status'];
        $suffering_type             = $donor_det['step_1']['suffering_type'];
        $last_72H_med_status        = $donor_det['step_1']['last_72H_med_status'];
        $last_72H_med               = $donor_det['step_1']['last_72H_med'];
        $immunized_for_status       = $donor_det['step_1']['immunized_for_status'];
        $immunized_for              = $donor_det['step_1']['immunized_for'];
        $last_2w_suffer_type_status = $donor_det['step_1']['last_2w_suffer_type_status'];
        $last_2w_suffer_type        = $donor_det['step_1']['last_2w_suffer_type'];
        $last_three_ill_type_status = $donor_det['step_1']['last_three_ill_type_status'];
        $last_three_ill_type        = $donor_det['step_1']['last_three_ill_type'];
        $last_six_ill_type_status   = $donor_det['step_1']['last_six_ill_type_status'];
        $last_six_ill_type          = $donor_det['step_1']['last_six_ill_type'];
        $last_tewlve_ill_type_status= $donor_det['step_1']['last_tewlve_ill_type_status'];
        $last_tewlve_ill_type       = $donor_det['step_1']['last_tewlve_ill_type'];
        $Permanent_defer_status     = $donor_det['step_1']['Permanent_defer_status'];
        $Permanent_defer            = $donor_det['step_1']['Permanent_defer'];
        
        $ps_pregnancy_delivered = $donor_det['step_2']['ps_pregnancy_delivered'];
        $ps_abortion            = $donor_det['step_2']['ps_abortion'];
        $ps_menstrual           = $donor_det['step_2']['ps_menstrual'];
        $ps_breast_feeding      = $donor_det['step_2']['ps_breast_feeding'];
        $ps_have_child          = $donor_det['step_2']['ps_have_child'];
    
        $safe_sex            =  $donor_det['step_3']['safe_sex'];
        $hiv_positive        =  $donor_det['step_3']['hiv_positive'];
        $hiv_test            =  $donor_det['step_3']['hiv_test'];
        $sexcul_activity     =  $donor_det['step_3']['sexcul_activity'];
        $sex_partners        =  $donor_det['step_3']['sex_partners'];
        $sex_assult          =  $donor_det['step_3']['sex_assult'];
        $sex_someone         =  $donor_det['step_3']['sex_someone'];
        $transmitted_disease =  $donor_det['step_3']['transmitted_disease'];
        $over_injected       =  $donor_det['step_3']['over_injected'];
        $sex_partner         =  $donor_det['step_3']['sex_partner'];
        $transfusion         =  $donor_det['step_3']['transfusion'];

        $aiul              = $donor_det['step_4']['aiul'];
        $OTR_blood         = $donor_det['step_4']['OTR_blood'];
        $voluntary_donor   = $donor_det['step_4']['voluntary_donor'];
        $voluntary_type    = $donor_det['step_4']['volunteer_type'];
        $weight            = $donor_det['step_4']['weight'];
        $hemoglobin        = $donor_det['step_4']['hemoglobin'];
        $BP                = $donor_det['step_4']['BP'];
        $temperature       = $donor_det['step_4']['temperature'];
        $pulse             = $donor_det['step_4']['pulse'];
        $health_examination= $donor_det['step_4']['health_examination'];
        
      }
      // echo $_GET['df-id'];
  ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- onkeydown="return event.key != 'Enter';"  onKeyPress="return keyPressed(event)"-->

    <!-- <input type="hidden" id="get_gender" value="Female" name=""> -->
    <!-- <input type="text" id="defer-status" value="0"> -->
    <input type="hidden" id="user-role" name="" value="<?php echo $_SESSION['role'];?>">
    <form action="update-donation-form.php"  onkeydown="return event.key != 'Enter';"   id="donation-form" method="post" class="donr-out">
      <input type="hidden" name="" id="protocol" value="<?php echo $protocol;?>">
      <input type="hidden" name="df-id" value="<?php echo $_GET['df-id']; ?>" >
      <input type="hidden" value="0" name="defer-type" id="defer_type">
      <input type="hidden" value="0" name="defer-status" id="defer_status">
      <input type="hidden" name="" id="donate_today_status" value="<?php echo $donation_day; ?>">
       <input type="hidden" id="get_gender" value="<?php echo $gender; ?>" name="u-gender">
      <div class="panel-group panel-contant" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a class="default" data-parent="#accordion" href="#collapseDefault">Criteria For Blood Donation</a>
            </h4>
            <input type="hidden" id="collapseDefaultFocus" name="">
          </div>

          <div id="collapseDefault" class="panel-collapse collapse show collapseDefault-temp">
            <div id=""></div>
            <div class="panel-body">
              <div class="row">

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title=""> When you'll donate the blood </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id="today" class="toggle-sl" name="donation-day" <?php echo $donation_day == "td" ? "checked" : ""; ?> value="td" onclick="$('.t-3678').show()" >
                        <label class="fieldlabels" for="well_being_yes">Today</label></span>
                      <span>
                        <input type="radio" id="s-o-day" class="toggle-sl" name="donation-day" <?php echo $donation_day == "sod" ? "checked" : ""; ?> value="sod" >
                        <label class="fieldlabels" for="well_being_no"> Some Other Day </label>
                      </span>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="donated blood previously ">
                      <span id="q-1" class="step1-sl"> 1.</span> Have you donated blood previously ?
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id="pre_db_yes" class="toggle-sl" <?php echo $donated_blood == "yes" ? "checked" : ""; ?> name="donated_blood" value="yes" onclick="$('#pre_donated').show();$('#s1-q4').show();$('#s1-q2').show();">
                        <label class="fieldlabels" for="pre_db_yes">Yes</label>
                      </span>
                      <span>
                        <input type="radio" id="pre_db_no" class="toggle-sl" <?php echo $donated_blood == "no" ? "checked" : ""; ?> name="donated_blood" value="no" onclick="$('#pre_donated').hide();$('#s1-q4').hide();$('#s1-q2').hide();">
                        <label class="fieldlabels" for="pre_db_no"> No </label>
                      </span>
                    </div>
                  </div>
                  <div id="pre_donated" style="display: <?php echo $donated_blood == "yes" ? "block" : "none"; ?>;">
                    <div class="row pl-4"><span id="pre_bd_date_err" class="text-danger"></span></div>

                    When Last
                    <input type="text" value="" placeholder="" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'"  onchange="donationInterval(this)" id="pre_bd_date" name="last-donated-date" value="">
                  </div>
                </div>

                <div class="col-md-12" id="s1-q2">
                  <div class="form-group">
                    <label class="fieldlabels" title="Have you donated blood at SDMH Blood Bank.">
                      <span id="q-2" class="step1-sl">2.</span> In which Blood Bank you donated Previously?
                    </label>
                    <div class="doneted_out">
                     <!--  <span>
                        <input type="radio" id="no_bdt_yes" name="donation-at-sdmh-status" value="yes" onclick="$('#sdmh_bank').show()">
                        <label class="fieldlabels" for="no_bdt_yes">Yes</label>
                      </span>
                      <span>
                        <input type="radio" id="no_bdt_no" name="donation-at-sdmh-status" value="no" checked onclick="$('#sdmh_bank').hide()">
                        <label class="fieldlabels" for="no_bdt_no"> No </label>
                      </span> -->
                    </div>
                  </div>
                  <span id="sdmh_bank" >
                    <div class="row pl-4"> 
                      <span id="no_bdt_date_err" class="text-danger"></span>
                    </div>
                    <span>blood bank name </span>
                    <input type="text" class="col-md-10 blood__bank--info" value="" style="width:250px !important" name="recieved-organisation-name"><br>
                    <br>
                    <span>city </span>
                    <input type="text" class="col-md-10 blood__bank--info" value="" style="width:250px !important" name="recieved-organisation-city"><br>
                    <br>
                    <span> how many times  </span> 
                    <input type="number" class="blood__bank--info" value="" id="no_bdt_date" name="donation-count-sdmh" value="">
                  </span>
                </div>

                <div class="col-md-12 t-3678" >
                  <div class="form-group">
                    <label class="fieldlabels" title="The donor shall be in good health, mentally alert">
                      <span id="q-3" class="step1-sl">3.</span> Are you feeling well to donate blood ?
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id="well_being_yes"  name="basic-health-well-being"  value="yes" > <label class="fieldlabels" for="well_being_yes">Yes</label>
                      </span>
                      <span>
                        <input type="radio" id="well_being_no" name="basic-health-well-being" value="no"><label class="fieldlabels" for="well_being_no"> No </label>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="col-md-12" id="s1-q4" style="display: none;">
                  <div class="form-group">
                    <label class="fieldlabels" title="Did you have any discomfort during or alter donation">
                      <span id="q-4" class="step1-sl">4.</span> Did you have any discomfort during or after donation ?
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id="" name="DDOA-discomfort" value="yes" > <label class="fieldlabels">Yes</label>
                      </span>
                      <span>
                        <input type="radio" id=""  name="DDOA-discomfort" value="no"  ><label class="fieldlabels"> No </label>
                      </span>
                    </div>
                  </div>
                </div>
               
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="Have you any reason to believe that donation shall infect you">
                      <span id="q-5" class="step1-sl">5.</span> Have you any reason to believe that donation shall infect you ?
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id=""  name="reason-to-BDSIY" value="yes" > <label class="fieldlabels">Yes</label>
                      </span>
                      <span>
                        <input type="radio" id="" name="reason-to-BDSIY" value="no"  ><label class="fieldlabels"> No </label>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 t-3678">
                  <div class="form-group">
                    <label class="fieldlabels" title="Did you have anything to eat In last 4 hours">
                      <span class="step1-sl">6.</span> Did you have anything to eat In last 4 hours
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id=""  name="last-4H-eat" value="yes"> 
                        <label class="fieldlabels">Yes</label>
                      </span>
                      <span>
                        <input type="radio" id="" name="last-4H-eat" value="no">
                        <label class="fieldlabels"> No </label>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 t-3678">
                  <div class="form-group">
                    <label class="fieldlabels" title="Do you feel well today">
                      <span class="step1-sl">7.</span> Do you feel well today
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id=""  name="well-today" value="yes" >
                        <label class="fieldlabels">Yes</label>
                      </span>
                      <span>
                        <input type="radio" id=""  name="well-today" value="no">
                        <label class="fieldlabels"> No </label>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 t-3678">
                  <div class="form-group">
                    <label class="fieldlabels" title="Did you sleep well last night">
                      <span class="step1-sl">8.</span> Did you sleep well last night
                    </label>:
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id="" name="last-sleep-status" value="yes" >
                        <label class="fieldlabels">Yes</label>
                      </span>
                      <span>
                        <input type="radio" id=""  name="last-sleep-status" value="no" >
                        <label class="fieldlabels"> No </label>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="Are you suffering from">
                      <span class="step1-sl">9.</span> Are you suffering from :
                    </label>

                    <div class="doneted_out">
                      <span>
                        <input type="radio" id="sufferthr_yes"  name="suffer-type-status" value="yes" onclick="$('#sufferthr').show()" >
                        <label class="fieldlabels">Yes</label>
                      </span>
                      <span>
                        <input type="radio" class="un-check" id="sufferthr_no"  data-child="n_suffer_typ" name="suffer-type-status" value="no"  >
                        <label class="fieldlabels"> No</label>
                      </span>
                    </div>
                  </div>
                  <span id="sufferthr" class="machine-out" >
                    <div class="row pl-4"><span id="n_suffer_typ_err" class="text-danger"></span></div>
                    <div class="machine-inner">
                     
                          <span>
                            <input
                           
                            type="checkbox" 
                            id="" 
                            data-filter="n_suffer_typ" 
                            data-parent-yes="sufferthr_yes" 
                            data-parent-no="sufferthr_no" 
                            data-differ-category="<?php echo $ss1q9['differ_category']; ?>" 
                            data-id="<?php echo $ss1q9['differ_duration']; ?>" 
                            class="n_suffer_typ set_temperal_defer" 
                            name="suffering-type"
                            value="<?php echo $ss1q9['title']; ?>" 
                            > 
                            <label class="fieldlabels"><?php echo $ss1q9['title']; ?></label>
                          </span>
                     
                    </div>
                  </span>
                </div>
                <div class="col-md-12">
                  <div class="form-group"> 
        
                    <label class="fieldlabels" title="Have you taking or have taken medicine in last">
                      <span class="step1-sl">10.</span> Have you taking or have taken medicine in last 72 hours any of the following:</label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio"  id="take_medicine_yes" name="last-72H-med-status" value="yes"> 
                        <label class="fieldlabels">Yes</label>
                    </span>
                      <span>
                          <input type="radio"  class="un-check" data-child="intake_medicine"  id="take_medicine_no" name="last-72H-med-status" value="no" >
                        <label class="fieldlabels"> No </label></span>
                    </div>
                  </div>
                  
                  <span id="take_medicine" class="machine-out" >
                    <div class="row pl-4"><span id="intake_medicine_err" class="text-danger"></span></div>
                    <div class="machine-inner">
                     
                          <span>
                            <input
                           
                            type="checkbox" 
                            id="" 
                            data-filter="intake_medicine" 
                            data-parent-yes="take_medicine_yes" 
                            data-parent-no="take_medicine_no" 
                            data-differ-category="<?php echo $med_l72h['differ_category']; ?>" 
                            data-id="<?php echo $med_l72h['differ_duration']; ?>" 
                            class="intake_medicine set_temperal_defer" 
                            name="last-72H-med" value="<?php echo $med_l72h['title']; ?>" > 
                            <label class="fieldlabels"><?php echo $med_l72h['title']; ?></label>
                          </span>
                     
                    </div>
                  </span>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="In the last 2 weeks have you been vaccinated/immunized for any of the following">
                      <span class="step1-sl">11.</span> In the last 2 weeks have you been vaccinated/immunized for any of the following
                    </label>
       
                    <div class="doneted_out">
                      <span>
                        <input type="radio"  id="vaccinated_yes" name="immunized-for-status" value="yes" onclick="$('#vaccinated').show()">
                        <label class="fieldlabels">Yes</label>
                      </span>
                      <span>
                        <input type="radio"  class="un-check"  data-child="immunized_typ" id="vaccinated_no"  name="immunized-for-status" value="no"  >
                        <label class="fieldlabels"> No</label>
                      </span>
                    </div>
                  </div>
                  <span id="vaccinated" class="machine-out" >
                    <div class="row pl-4"><span id="immunized_typ_err" class="text-danger"></span></div>
                    <div class="machine-inner">
                     
                          <span>
                            <input 
                          
                            type="checkbox" 
                            data-filter="immunized_typ" 
                            data-parent-yes="vaccinated_yes" 
                            data-parent-no="vaccinated_no" 
                            data-id="<?php echo $v_l2w['differ_duration']; ?>" 
                            data-differ-category="<?php echo $v_l2w['differ_category']; ?>" 
                            id="<?php echo $v_l2w['differ_type']; ?>" 
                            class="immunized_typ set_temperal_defer" 
                            name="immunized-for" value="<?php echo $v_l2w['title']; ?>" > 
                            <label class="fieldlabels"><?php echo $v_l2w['title']; ?></label>
                          </span>
                     
                    </div>
                  </span>

                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="In the last 2 weeks did you suffer from any of the following diseases">
                      <span class="step1-sl">12.</span> In the last 2 weeks did you suffer from any of the following diseases
                    </label>
       
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id="lastdisease_yes" name="last-2w-suffer-type-status" value="yes" onclick="$('#lastdisease').show()">
                        <label class="fieldlabels">Yes</label>
                      </span>
                      <span>
                        <input type="radio"  class="un-check" data-child="suffer_typ" id="lastdisease_no" name="last-2w-suffer-type-status" value="no"  >
                        <label class="fieldlabels"> No </label>
                      </span>
                    </div>
                  </div>
                  <span id="lastdisease" class="machine-out" >
                    <div class="row pl-4"><span id="suffer_typ_err" class="text-danger"></span></div>
                    <div class="machine-inner">
                     
                          <span>
                            <input 
                            
                            type="checkbox" 
                            data-filter="suffer_typ" 
                            data-parent-yes="lastdisease_yes" 
                            data-parent-no="lastdisease_no" id="<?php echo $suffers_l2w['differ_type']; ?>" 
                            data-id="<?php echo $suffers_l2w['differ_duration']; ?>" 
                            class="suffer_typ set_temperal_defer" 
                            name="last-2w-suffer-type"
                            data-differ-category="<?php echo $suffers_l2w['differ_category']; ?>" 
                             value="<?php echo $suffers_l2w['title']; ?>" > 
                            <label class="fieldlabels"><?php echo $suffers_l2w['title']; ?></label>
                          </span>
                     
                    </div>
                  </span>

                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="12. In the last 3 months have you had any diseases">
                      <span class="step1-sl">13.</span> In the last 3 months have you had any of the Following :
                    </label>
       
                    <div class="doneted_out">
                      <span>
                        <input type="radio"  id="trimonthdis_yes" name="last-three-ill-type-status" value="yes" onclick="$('#trimonthdis').show()">
                        <label class="fieldlabels">Yes</label>
                      </span>
                      <span>
                        <input type="radio" class="un-check" data-child="ill_typ" id="trimonthdis_no" name="last-three-ill-type-status" value="no"  >
                        <label class="fieldlabels"> No </label>
                      </span>
                    </div>
                  </div>
                  <span id="trimonthdis" class="machine-out" >
                    <div class="row pl-4"><span id="ill_typ_err" class="text-danger"></span></div>
                    <div class="machine-inner">
                     
                          <span>
                            <input 
                            
                            type="checkbox" 
                            data-filter="ill_typ" 
                            data-parent-yes="trimonthdis_yes" 
                            data-parent-no="trimonthdis_no" 
                            id="<?php echo $had_l3m['differ_type']; ?>" 
                            data-id="<?php echo $had_l3m['differ_duration']; ?>" 
                            data-differ-category="<?php echo $had_l3m['differ_category']; ?>" 
                            class="ill_typ set_temperal_defer" 
                            name="last-three-ill-type" 
                            value="<?php echo $had_l3m['title']; ?>" > 
                            <label class="fieldlabels"><?php echo $had_l3m['title']; ?></label>
                          </span>
                     
                     
                    </div>
                  </span>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="In the last 6 months have you had any diseases">
                      <span class="step1-sl">14.</span> In the last 6 months have you had any of the Following :
                    </label>
                    
     
                    <div class="doneted_out">
                      <span>
                        <input type="radio"  id="sixmonthdis_yes" name="last-six-ill-type-status" value="yes" onclick="$('#sixmonthdis').show()">
                        <label class="fieldlabels">Yes</label>
                      </span>
                      <span>
                        <input type="radio" class="un-check" data-child="illsix_typ" id="sixmonthdis_no" name="last-six-ill-type-status" value="no" ><label class="fieldlabels"> No </label>
                      </span>
                    </div>
                  </div>
                  <span id="sixmonthdis" class="machine-out" >
                    <div class="row pl-4"><span id="illsix_typ_err" class="text-danger"></span></div>
                    <div class="machine-inner">
                      
                          <span>
                            <input 
                           
                            type="checkbox" 
                            data-filter="illsix_typ" 
                            data-parent-yes="sixmonthdis_yes" 
                            data-parent-no="sixmonthdis_no" 
                            id="<?php echo $had_l6m['differ_type']; ?>" 
                            data-id="<?php echo $had_l6m['differ_duration']; ?>" 
                            data-differ-category="<?php echo $had_l6m['differ_category']; ?>" 
                            class="illsix_typ set_temperal_defer" 
                            name="last-six-ill-type" 
                            value="<?php echo $had_l6m['title']; ?>" > 
                            <label class="fieldlabels"><?php echo $had_l6m['title']; ?></label>
                          </span>
                     
                    </div>
                  </span>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="In the last 12 months have you had any diseases">
                      <span class="step1-sl">15.</span> In the last 12 months have you had any of the Following :
                    </label>
       
                    <div class="doneted_out">
                      <span>
                        <input type="radio"  id="twelevemonthdis_yes" name="last-tewlve-ill-type-status" value="yes" onclick="$('#twelevemonthdis').show()">
                        <label class="fieldlabels">Yes</label>
                      </span>
                      <span>
                        <input type="radio"  class="un-check" data-child="illtwelve_typ" id="twelevemonthdis_no" name="last-tewlve-ill-type-status" value="no" >
                        <label class="fieldlabels"> No </label>
                      </span>
                    </div>
                  </div>
                  <span id="twelevemonthdis" class="machine-out" >
                    <div class="row pl-4"><span id="illtwelve_typ_err" class="text-danger"></span></div>
                    <div class="machine-inner">
                       
                          <span>
                            <input 
                           
                            type="checkbox" 
                            data-filter="illtwelve_typ" 
                            data-parent-yes="twelevemonthdis_yes" 
                            data-parent-no="twelevemonthdis_no" 
                            id="<?php echo $had_l12m['differ_type']; ?>" 
                            data-id="<?php echo $had_l12m['differ_duration']; ?>" 
                            data-differ-category="<?php echo $had_l12m['differ_category']; ?>" 
                            class="illtwelve_typ set_temperal_defer" 
                            name="last-tewlve-ill-type" 
                            value="<?php echo $had_l12m['title']; ?>" > 
                            <label class="fieldlabels"><?php echo $had_l12m['title']; ?></label>
                          </span>
                     
                    </div>
                  </span>

                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="Have you ever had any of the following (Permanent Defer) :">
                      <span class="step1-sl">16.</span> Have you ever had any of the following (Permanent Defer) :
                    </label>
                    
       
                    <div class="doneted_out">
                      <span>
                        <input type="radio"  id="perma_defer_yes" name="Permanent-defer-status" value="yes" onclick="$('#perma_defer').show()">
                        <label class="fieldlabels">Yes</label>
                      </span>
                      <span>
                        <input type="radio"  class="un-check" data-child="perma_defer" id="perma_defer_no" name="Permanent-defer-status" value="no" checked >
                        <label class="fieldlabels"> No </label>
                      </span>
                    </div>
                  </div>
                  <span id="perma_defer"  class="machine-out">
                    <div class="row pl-4"><span id="Permanent_defer_typ_err" class="text-danger"></span></div>
                    <div class="machine-inner">
                     
                          <span>
                            <input 
                           
                            type="checkbox" 
                            data-filter="Permanent_defer_typ" 
                            data-parent-yes="perma_defer_yes" 
                            data-parent-no="perma_defer_no" 
                            id="<?php echo $permnt_defer['differ_type']; ?>" 
                            class="perma_defer Permanent_defer_typ" 
                            name="Permanent-defer" 
                            value="<?php echo $permnt_defer['title']; ?>" > 
                            <label class="fieldlabels"><?php echo $permnt_defer['title']; ?></label>
                          </span>
                     
                    </div>
                  </span>
                </div>
              </div>
              <a class="btn btn-success btn-md pull-right" id="defaultNextBtn">Next</a>
            </div>
          </div>
        </div> <!-- default -->
        <?php
        if ($gender== 'Male') {
          $dis_sts = 'display: none;';
        }
        if ($gender == 'Female') {
          $dis_sts = 'display: block;';
        }
        ?>

        <div class="panel panel-default">
          <div class="panel-heading" style="<?php echo $dis_sts; ?>">
            <h4 class="panel-title">
              <a class="primary" data-parent="#accordion" href="#collapsePrimary">Physiological Status for Women</a>
              
            </h4>
            <input type="hidden" id="collapsePrimaryFocus" name="">
          </div>
          <div id="collapsePrimary" class="panel-collapse collapse">
           <!--  <div id=""></div> -->
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group" title="Defer for 12 Months after delivery">
                    <label class="fieldlabels">
                      1. Are you pregnant or have you been pregnant within last six months:
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id=""  data-value="pregnancy" name="ps-pregnancy-delivered" value="yes" data-id="12 Months" class="female_defer" > 
                        <label class="fieldlabels">Yes</label>
                    </span>
                    <span>
                          <input type="radio"   class="female_defer_no" id="" name="ps-pregnancy-delivered" value="no" checked >
                          <label class="fieldlabels"> No </label>
                    </span>
                    </div>
                  </div>
                  <div id="pre_duration"></div>
                </div>
                <div class="col-md-12">
                  <div class="form-group ">
                    <label class="fieldlabels" title="Defer for 6 Months after delivery">
                      2. Abortion (6 months)?:
                    </label>
                    <div class="doneted_out">
                      <span?>
                        <input type="radio"  data-value="abortion" id="abortion" name="ps-abortion"  data-id="6 Months" value="yes" class="female_defer" > <label class="fieldlabels">Yes</label></span>
                        <span>
                          <input type="radio"  id="abortion" class="female_defer_no"  name="ps-abortion" value="no" checked ><label class="fieldlabels"> No </label></span>
                    </div>
                  </div>
                  <div id="" class="form-group mt-5">
                   <label class="fieldlabels">3. When did you have last menstrual period 
                    <input type="date" id=""  name="ps-menstrual" value=""> 
                    </div>
                  </label>          

                </div>
                <div class="col-md-12">
                  <div class="form-group ">
                    <label class="fieldlabels" title="Defer for total period of lactation">
                      4. Are you breast feeding (12 months)?:
                    </label> 
                    <div class="doneted_out">
                      <span>
                        <input type="radio"  id="gender"  data-value="breast feeding" data-id="completion of lactation period" name="ps-breast-feeding" value="yes" class="female_defer" > <label class="fieldlabels">Yes</label></span>
                      <span>
                        <input type="radio" class="female_defer_no" id="gender" name="ps-breast-feeding" value="no" checked ><label class="fieldlabels"> No </label></span>
                    </div>
                  </div>
                  <div id="breast_duration"></div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="  Do you have child less than 1 year old">
                      5. Do you have child less than 1 year old
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id="gender" name="ps-have-child" value="yes" class="female_defer" > <label class="fieldlabels">Yes</label></span>
                      <span><input type="radio" id="gender" class="female_defer_no" name="ps-have-child" value="no" checked ><label class="fieldlabels"> No </label></span>
                    </div>
                  </div>
                </div>
              </div>
              <a class="btn btn-warning btn-md pull-left" id="primaryPrevBtn">Prev</a>
              <a class="btn btn-success btn-md pull-right" id="primaryNextBtn">Next</a>
            </div>
          </div>
        </div> <!-- primary -->

        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a class="primary" data-parent="#accordion" href="#collapseSuccess">SELF EXCLUSION QUESTIONNAIRE - RISK BEHAVIOR
                (Please answer all question honestly Your answers will be confidential)</a>
            </h4>
             <input type="hidden" id="collapseSuccessFocus" name="">
          </div>
          <div id="collapseSuccess" class="panel-collapse collapse">
            <div id=""></div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="Defer for the period of menstruation">
                      Do you practice safe sex?
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio"  id="" data-id="default-check" class="permanent_defer_no" name="safe-sex" value="yes" > 
                        <label class="fieldlabels">Yes</label>
                      </span>
                      <span>
                        <input type="radio" id=""  class="permanent_defer" name="safe-sex" data-value="practice safe sex" >
                        <label class="fieldlabels"> No </label></span>
                      <span>
                        <input type="radio"  id="" name="safe-sex" value="na">
                        <label class="fieldlabels"> N/A </label>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="Defer for the period of menstruation">
                      Are you HIV Positive or do you think you may be HIV Positive?
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id="" data-value="HIV Positive" class="permanent_defer" name="hiv-positive" value="yes">
                        <label class="fieldlabels">Yes</label>
                      </span>
                      <span>
                        <input type="radio"  id="" data-id="default-check" class="permanent_defer_no" name="hiv-positive" value="no" >
                        <label class="fieldlabels"> No </label>
                      </span>
                    </div>

                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="Is your reason for donating blood to undergo an HIV test">
                      Is your reason for donating blood to undergo an HIV test ?
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id="gender" name="hiv-test" value="yes"> <label class="fieldlabels">Yes</label></span>
                      <span>
                        <input type="radio"  id="gender" name="hiv-test" value="no" ><label class="fieldlabels"> No </label></span>
                      <span>
                        <input type="radio" id="gender" name="hiv-test" value="None of these"><label class="fieldlabels"> None of these </label></span>
                    </div>
                  </div>
                </div>
                  
                <div class="col-md-12">
                  <div class="form-group ">
                    <label class="fieldlabels" title="IN THE PAST 6 MONTHS :">
                      IN THE PAST 6 MONTHS :
                    </label> <br>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="Have you had sexual activity by paying money or vise versa?">
                      1 Have you had sexual activity by paying money or vise versa?
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id="" data-value="sexual activity by paying money or vise versa" class="permanent_defer" name="sexcul-activity" value="yes"> <label class="fieldlabels">Yes</label></span>
                      <span>
                        <input type="radio" data-id="default-check" class="permanent_defer_no" id="" name="sexcul-activity" value="no" ><label class="fieldlabels"> No </label></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="Have you had multiple sex partners?">
                      2. Have you had multiple sex partners?
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio"  id="gender" data-value="multiple sex partners" class="permanent_defer" name="sex-partners" value="yes"> <label class="fieldlabels">Yes</label></span>
                      <span>
                        <input type="radio" data-id="default-check" class="permanent_defer_no" id="gender" name="sex-partners" value="no"  ><label class="fieldlabels"> No </label></span>
                    </div>
                  </div>
                </div>
                 
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="Victim of sexual assault?">
                      3. Victim of sexual assault?
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id="gender" name="sex-assult" value="yes"> <label class="fieldlabels">Yes</label></span><span>
                        <input type="radio"  id="gender" name="sex-assult" value="no" ><label class="fieldlabels"> No </label></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="Sex with someone whose background you do not know?">
                      4. Sex with someone whose background you do not know?
                    </label>
                    <div class="doneted_out">
                      <span><input type="radio"  id="gender" name="sex-someone" value="yes"> <label class="fieldlabels">Yes</label></span>
                      <span><input type="radio"  id="gender" name="sex-someone" value="no" ><label class="fieldlabels"> No </label></span>
                      <span><input type="radio"  id="gender" name="sex-someone" value="not"><label class="fieldlabels"> None of these </label></span>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="IN THE PAST 12 MONTHS :">
                      IN THE PAST 12 MONTHS :
                    </label> <br>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="Have you suffered from sexually Transmitted disease?">
                      Have you suffered from sexually Transmitted disease?
                    </label>
                    <div class="doneted_out">
                      <span><input type="radio" data-value="sexually Transmitted disease" class="permanent_defer" id="" name="transmitted-disease" value="yes"> <label class="fieldlabels">Yes</label></span>
                      <span><input type="radio"  data-id="default-check" class="permanent_defer_no" id="" name="transmitted-disease" value="no" ><label class="fieldlabels"> No </label></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="Have you over injected yourself with drugs not prescribed by doctor?">
                      Have you over injected yourself with drugs not prescribed by doctor?
                    </label>
                    <div class="doneted_out">
                      <span><input type="radio"  id="" data-value="injected drugs not prescribed by doctor" class="permanent_defer" name="over-injected" value="yes"> <label class="fieldlabels">Yes</label></span>
                      <span><input type="radio" data-id="default-check" class="permanent_defer_no" id="" name="over-injected" value="no" ><label class="fieldlabels"> No </label></span>
                    </div>

                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title="3. Do you think any of the above questions may be true for your sex partner? doctor?">
                      3. Do you think any of the above questions may be true for your sex partner?
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio"  data-value="sex partner" class="permanent_defer" id="gender" name="sex-partner" value="yes"> <label class="fieldlabels">Yes</label></span><span>
                        <input type="radio"  data-id="default-check" class="permanent_defer_no" id="gender" name="sex-partner" value="no" ><label class="fieldlabels"> No </label></span>
                    </div>

                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="fieldlabels" title=" Do you consider your blood safe for transfusion to a patient">
                      4. Do you consider your blood safe for transfusion to a patient
                    </label>
                    <div class="doneted_out">
                      <span>
                        <input type="radio"  id="" data-id="default-check" class="permanent_defer_no" name="transfusion" value="yes" > 
                        <label class="fieldlabels">Yes</label>
                      </span>
                        <span>
                        <input type="radio"  data-value="blood safe for transfusion to a patient"  class="permanent_defer" id="" name="transfusion" value="no">
                        <label class="fieldlabels"> No </label>
                      </span>
                        <span>
                        <input type="radio"  id="" name="transfusion" value="not">
                        <label class="fieldlabels"> None of those </label>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <ol>
                    <li>The test done on your donated Blood are follows :<br>• HBsAg • Anti HIV • Anti HCV • Syphilis •Malaria Parasite</li>
                    <li> These tests are also done free of cost at ICTC Centre. If you are looking to get the test done, please contact Department of Microbiology,SMS Medical College. Jaipur.</li>
                    <li>.All the test results are kept highly confidential.Danger :The window period • It refers to the time from when a person is first infected till the person tests positive. </li>
                    <li> <strong>Danger:</strong> the window period,laboratory tests are negative but the person is still capable of infecting others. Help keep the blood supply as safe as possible by lookingHONESTLY at your lifestyle & answering the question truthfully.</li>
                  </ol>
                </div>
              </div>
              <a class="btn btn-warning btn-md pull-left" id="successPrevBtn">Prev</a>
              <a class="btn btn-success btn-md pull-right" id="successNextBtn">Next</a>
            </div>
          </div>
        </div> <!-- success -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a class="info" data-parent="#accordion" href="#collapseInfo">INFORMED CONSENT:</a>
            </h4>
            <input type="hidden" id="collapseInfoFocus" name="">
          </div>
          <div id="collapseInfo" class="panel-collapse collapse">
            <div id=""></div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <h2>INFORMED CONSENT:</h2>
                  <ol>
                    <li>I have read and understood the intormati on in the donor form and education material.</li>
                    <li>.I confirm, that to my knowledge. I have answered all the questions accurately and truth fully and do not consider myself to be a person involved in any of thedescribed activities that could please me at the risk of spreading HIV or Hepatitis.</li>
                    <li>I understand that any willful misrepresentation of the facts could endanger the patients receiving my blood.</li>
                    <li>I am aware that my blood will be screened for HIV. Hepatitis B. Hepatitis C. Malaria & Syphilis in addition to any other screening tests required to ensureblood safety</li>
                    <li>I understand that screening test are not diagnostics and may yield false pas :live resoults.klt,awlsNooulnderstand further confirmatory test would be required incase of oostve results and that for any positive results❑ I MaY❑ be contacted
                    </li>
                    <li>I understand that my blood will be utlized in accordance with regulatory guide'mesinclud,ng NBTC and drug and cosmetic act and regulations pertaining toit or its future replacements</li>
                    <li>I understand the blood donation procedure and possible risk (vaso-vagal re act on. hematoma. etc.) involved as explained.</li>
                    <li>I confirm that I am over the age of 18 years</li>
                    <li>.I understand that blood donation is totally voluntary act and no inducement or remunerat on in cash or hind has been offered to me.</li>
                    <li>I prohibit any personal details (except demographic details) provided by me or about my donation to be disclosed to any individual or agency except askedby government.</li>
                    <li>I hereby declare that I am donating blood voluntarily without any pressure lone cchesionthreatlalse misconception from the Blood Bank.</li>
                    <li> I hereby volume-et to donate my Blood Blood components which may be used for pat,ent'scientific researchlfractionation (surplus plasma).</li>
                    <li> My donatea blood/ components may be utilized beyond this Blood Bank</li>
                    <li> You would liked to be informed about any abnormal test results (HIV, HBsAg, HCV, Syphilis, Malaria parasite) at the address furnished by you</li>
                  </ol>
                  <ul>
       
        
                    <li> I have been give in the opportunity to ask question and they have been answered in the language understand. by me.
                      <div class="doneted_out">
                        <span>
                          <input type="radio"  id="" name="AIUL" value="yes" >
                          <label class="fieldlabels">Yes</label>
                        </span>
                        <span>
                          <input type="radio"  id="" name="AIUL" value="no">
                          <label class="fieldlabels">No</label> 
                        </span>
                      </div>
                    </li>
  
                    <li>
                      I have given the opportunity to refuse the blood donation
                      <div class="doneted_out">
                        <span>
                          <input type="radio"  id="gender" name="OTR-blood-donation" value="yes">
                          <label class="fieldlabels">Yes</label>
                        </span>
                        <span>
                          <input type="radio"  id="gender" name="OTR-blood-donation" value="no" >
                          <label class="fieldlabels">No</label>
                        </span>
                    </li>
                    <li>
                      I would like to be regular voluntary donor :
                      <br>
                      <div class="doneted_out">
                        <span>
                          <input type="radio"  id="regularvoluntary_yes" name="voluntary-donor" value="yes" onclick="$('#reg_voluntary').show()">
                          <label class="fieldlabels">Yes</label>
                        </span>
                        <span>
                          <input type="radio"  id="regularvoluntary_no" name="voluntary-donor" value="no" onclick="$('#reg_voluntary').hide()">
                          <label class="fieldlabels">No</label>
                        </span>
                      </div>
                    </li>
                  </ul>
                  <div class="doneted_out">
                    
                    <div id="reg_voluntary" class='regularvoluntary' >
                      <span>
                        <input type="checkbox"  class='regularvoluntary' id="Birthday" name="volunteer-type" value="Birthday">
                        <label class="fieldlabels">Birthday</label>
                      </span>
                      </span>
                        <input type="checkbox"  class='regularvoluntary' id="Marriage Anniversary" name="volunteer-type" value="Marriage Anniversary">
                        <label class="fieldlabels">Marriage Anniversary</label>
                      </span>
                      <span>
                        <input type="checkbox"  class='regularvoluntary' id="month" name="volunteer-type" value="After 6 month">
                        <label class="fieldlabels">After 6 months</label></span>
                      <sapn>
                        <input type="checkbox"  class='regularvoluntary' id="Once a year" name="volunteer-type" value="Once a year">
                        <label class="fieldlabels">Once a year</label>
                      </span>
                      <span>
                        <input type="checkbox"   class='regularvoluntary' id="Emergency" name="volunteer-type" value="In Emergency Requirement">
                        <label class="fieldlabels">In Emergency Requirement</label>
                      </span>
                    </div>
                    <div id="regularvoluntary_err"></div>
                  </div>
                  <h3>GENERAL PHYSICAL EXAMINATION</h3>
                    <div class="row">
                      <div class="col-md-4">
                        weight :<input type="text" id="d_weight" value="" name="weight">
                      </div>
                      <div class="col-md-4">
                        Hemoglobin :<input type="text" id="d_hemoglobin" value="" name="hemoglobin">
                      </div>
                      <div class="col-md-4">
                        BP :<input type="text" id="d_bp" value="" name="BP">
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-md-4" id="d_weight_err"></div>
                    <div class="col-md-4" id="d_hemoglobin_err"></div>
                    <div class="col-md-4" id="d_bp_err"></div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 Temperature_cls form-group">
                      <label class="fieldlabels">* Temperature :</label>
                      <div class="doneted_out">
                        <span>
                          <input type="radio"  id="pre_donated_yes" name="temperature" value="normal" checked>
                          <label class="fieldlabels">Normal</label>
                        </span>
                        <span>
                          <input type="radio"  id="pre_donated_no" name="temperature" value="abnormal">
                          <label class="fieldlabels">Abnormal</label> 
                        </span>
                      </div>
                    </div>
                    <div class="col-md-12 pulse_cls form-group">
                      <label class="fieldlabels"> * Pulse :</label>
                      <div class="doneted_out">
                        <span>
                          <input type="radio"  id="pre_donated_yes" name="pulse" value="normal" checked>
                          <label class="fieldlabels">Normal</label>
                        </span>
                        <span>
                          <input type="radio"  id="pre_donated_no" name="pulse" value="abnormal"> 
                          <label class="fieldlabels">Abnormal</label> 
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="hf-temp-perm-d">
                  <table style="width:100%" >
                    <tr>
                      <th>MEDICAL & SYSTEMIC EXAMINATION :</th>
                      <th> 
                        <!-- $health_examination -->
                        <input type="radio" id="pre_donated_yes" name="health_examination" checked value="accept">
                        <label class="fieldlabels">Accept</label>
                      </th>
                      <th> 
                        <input type="radio" id="pre_donated_yes" name="health_examination" value="defer"> <label class="fieldlabels">Defer</label></th>
                    </tr>
                  </table>
                  <div id="health_examination_err"></div>
                  <br>
                  <table style="width:100%">
                    <tr>
                      <th></th>
                      <th>Donor</th>
                      <th>Interpreter (if applicable)</th>
                      <th>Counselor / Doctor</th>
                    </tr>
                    <tr>
                      <td>Signature orThumb Impression</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </table>
                  </div>
                  <div>
                    <h3></h3>
                  </div>
                </div>
              </div>
              <a class="btn btn-warning btn-md pull-left" id="infoPrevBtn">Prev</a>
              <a class="btn btn-success btn-md pull-right" id="infoNextBtn">Next</a>
              <!-- <a id="ic-temp-submit" style="display: none;" name="submit" class="btn btn-success btn-md pull-right" >Submit</a> -->
              
            </div>
          </div>
        </div> <!-- info -->

        <!-- <div class="panel panel-default hf-temp-perm-d">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a class="primary" data-parent="#accordion" href="#collapseSuccessLast">Reason of Defer</a>
            </h4>
          </div>
          <div id="collapseSuccessLast" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id="Permanent_defer_yes" name="defer-type" value="yes" > 
                        <label class="fieldlabels">Permanent Deferral</label>
                      </span>
                      <span>
                        <input type="radio" id="temporary_defer_yes" name="defer-type" value="no" >
                        <label class="fieldlabels"> Temporary Deferral </label>
                      </span>
                    </div>
                  </div>
                  <span id="" class="machine-out">
                    <div class="machine-inner">
                      
                  </span>
                </div>
              </div>
            </div>
            <a class="btn btn-warning btn-md pull-left" id="successPrevLastBtn">Prev</a>
            <a class="btn btn-success btn-md pull-right" id="book-appointment-nxt">Next</a>
          </div>
        </div>
        </div> -->

       <div class="panel panel-default hf-temp-perm-d" >
          <div class="panel-heading" >
            <h4 class="panel-title">
              <a class="primary" data-parent="#accordion" href="#book-appointment-blk">Reason of Defer</a>
            </h4>
          </div>
          <div id="book-appointment-blk" class="panel-collapse collapse" >
            <div class="panel-body">
              <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                    <div class="doneted_out">
                      <span>
                        <input type="radio" id="Permanent_defer_yes" name="defer-type" value="yes" > 
                        <label class="fieldlabels">Permanent Deferral</label>
                      </span>
                      <span>
                        <input type="radio" id="temporary_defer_yes" name="defer-type" value="no" >
                        <label class="fieldlabels"> Temporary Deferral </label>
                      </span>
                    </div>
                  </div>
                  <span id="" class="machine-out">
                    <div class="machine-inner">
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Abnormal Bleeding Tendency" >
                        <label class="fieldlabels">Abnormal Bleeding Tendency</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Abrotion" > 
                        <label class="fieldlabels">Abrotion</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Breast Feeding" > 
                        <label class="fieldlabels">Breast Feeding</label>
                      </span>
                      <span>
                        <input type="checkbox" id=" " name="defer-cat-type" value="Gonorrhea" > 
                        <label class="fieldlabels"> Gonorrhea</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Medication History" >
                       <label class="fieldlabels">Medication History</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Seizures" >
                         <label class="fieldlabels">Seizures </label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Cancer" >
                        <label class="fieldlabels">Cancer</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Heart Disease" > 
                        <label class="fieldlabels">Heart Disease</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Occupational Hazard" >
                        <label class="fieldlabels">Occupational Hazard</label>
                      </span>
                      <span><input type="checkbox" id="" name="defer-cat-type" value="Surgical Procedures" >
                       <label class="fieldlabels">Surgical Procedures</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Chikungunya" > 
                        <label class="fieldlabels">Chikungunya</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Jaundice" > 
                        <label class="fieldlabels">Jaundice</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Pregnancy" > 
                        <label class="fieldlabels">Pregnancy</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Tuberculosis" >
                        <label class="fieldlabels">Tuberculosis</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Age (Below 18 yrs)" >
                        <label class="fieldlabels">Age (Below 18 yrs)</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Dengue" >
                        <label class="fieldlabels">Dengue</label></span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Kidney Disease" >
                        <label class="fieldlabels">Kidney Disease</label></span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Pulse (Abnormal)" > 
                        <label class="fieldlabels">Pulse (Abnormal)</label></span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Ulcer" >
                        <label class="fieldlabels">Ulcer</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Age (Above 65 yrs)" >
                        <label class="fieldlabels">Age (Above 65 yrs)</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Donation Interval" >
                        <label class="fieldlabels">Donation Interval</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Leprosy" >
                        <label class="fieldlabels">Leprosy</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Respiratory Infection" >
                       <label class="fieldlabels">Respiratory Infection</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Unexplained weight loss" > 
                        <label class="fieldlabels">Unexplained weight loss</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Blood Transfusion History" > 
                        <label class="fieldlabels">Blood Transfusion History</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Fever" > 
                        <label class="fieldlabels">Fever</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Liver Disease" > 
                        <label class="fieldlabels"> Liver Disease</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Schizophrenia" >
                        <label class="fieldlabels">Schizophrenia</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Vaccination" > 
                        <label class="fieldlabels">Vaccination</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Blood Pressure" >
                        <label class="fieldlabels">Blood Pressure</label>
                       </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Genital sore or generalized skin rashes" > 
                        <label class="fieldlabels"> Genital sore or generalized skin rashes</label>
                      </span>
                      <span>
                        <input type="checkbox" id=" defer-cat-typeth[LBreast]" value="Low Haemoglobin" > 
                        <label class="fieldlabels"> Low Haemoglobin</label></span>
                      <span>
                        <input type="checkbox" id=" " name="defer-cat-type" value="Severe Allergic Disorders" > 
                        <label class="fieldlabels"> Severe Allergic Disorders</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Viral Hepatitis (B & C)" >
                        <label class="fieldlabels">Viral Hepatitis (B & C)</label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Malaria" >
                        <label class="fieldlabels">Malaria </label>
                      </span>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Weight (Less than 50 Kg)" > 
                        <label class="fieldlabels">Weight (Less than 50 Kg)</label>
                      </span><br>
                      <span>
                        <input type="checkbox" id="" name="defer-cat-type" value="Active symptom (Chest Pain. Shortness of breath. Swelling of feet )" >
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
              
              <a class="btn btn-warning btn-md pull-left" id="appointmentPrevBtn">Prev</a>
              <input type="submit" name="submit" id="fin-submit" class="btn btn-success btn-md pull-right" value="Update">
              <!-- <a class="btn btn-success btn-md pull-right" id="primaryNextBtn">Next</a> -->
            </div>
          </div>
        </div> <!-- primary -->
      </div> 
      </div>
    </form>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="permanent_defer_modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header p-3">
        <h5 class="modal-title" id="exampleModalLabel">Permanent Defer</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
        <span>
          Sorry you are not eligible to donate blood for the following reason <br>
          Reason : <span class="perm_diff_des text-info"></span>.<br>
          You can refer someone else to donate blood.
        </span>
      </div>
      <div class="modal-footer p-1">
        <button type="button" class="btn btn-secondary" id="pd-modify" data-dismiss="modal">Modify</button>
        <button type="button" id="ic-perm-submit" class="btn btn-primary">submit</button>
        <!-- <button type="button" class="btn btn-primary">modify</button> -->
      </div>
    </div>
  </div>
</div>
<!-- temporary defer -->
<div class="modal fade" id="temporary_defer_modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"          aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header p-3">
        <h5 class="modal-title" id="exampleModalLabel">Temporary Defer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <span>
          You are not eligible to donate blood for Following reason <br>
          Reason : <span class="temp_diff_des  text-info"></span>.<br>
          You can donate after <span id="temp_differ_time">Time in Months </span>.
        </span> -->
        <div id="testing-text">
            You are not eligible to donate blood for Following reason <br>
            Reason : <span id="upd_temp_diff_des"></span>.<br>
            You can donate after <span id="upd_temp_differ_time">Time in Months </span>.
        </div>
      </div>
      <div class="modal-footer p-1">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="ic-temp-submit" class="btn btn-primary">submit</button>
      </div>
    </div>
  </div>
</div>
<input type="hidden" name="" id="lat" >
<input type="hidden" name="" id="long" >
<input type="hidden" id="temp_diff_status" value="0" name="">
<input type="hidden" id="self_ex_perm_diff_id" value="" name="">
<div id="modal-containter"></div>

<!-- edit form script  -->
<script language="javascript" type="text/javascript">
    $( document ).ready(function() {
        // $('input[type=radio]').attr("disabled",true);
        // for set_temperal_defer class
        if($('#donate_today_status').val() == 'td'){
          $('.t-3678').show();
        }
        if($('#donate_today_status').val() == 'sod'){
          $('.t-3678').show();
        }
        $('.set_temperal_defer').each(function(){
        if ($(this).is(':checked') == true) {
          /*appending differ details to pop up modal*/
          $(this).attr('data-differ-category');
          var differ_category = $(this).attr('data-differ-category');
          $('#upd_temp_diff_des').html( differ_category + "  ["+$(this).attr('value')+"]");
          $('#upd_temp_differ_time').html($(this).attr('data-id'));
          $('#temp_diff_status').val('1');
        //   var differ_category = $(this).attr('data-differ-category');
          var differ_reasons = [];
          var differ_durations = [];
          $(this).attr('data-differ-category')
          $('.hf-temp-perm-d').css('display','none');
          $('#temp_diff_status').val('1');
          $('#ic-temp-submit').css('display','block');
          $('#'+$(this).attr('data-parent-yes')).prop('checked','true');
        }
        if ($(this).is(':checked') == false) {
          // alert($(this).attr('data-filter'));
          if($('.'+$(this).attr('data-filter')).filter(':checked').length < 1){
            $('#'+$(this).attr('data-parent-no')).prop('checked','true');
          }
        }
        })
       
        // for perma_defer class
        if ($('.perma_defer').is(':checked') == true) {
            jQuery.noConflict();
            $('.hf-temp-perm-d').css('display','none');
            $('.perm_diff_des').html($(this).attr('value'));
            $('#permanent_defer_modal').appendTo("#modal-containter").modal('show');
        }
        // for permanent_defer class
        if ($('.permanent_defer').is(':checked')) {
            jQuery.noConflict();
            // alert($(this).attr('data-value'));
            $('.hf-temp-perm-d').css('display','none');
            $('.perm_diff_des').html($(this).attr('data-value'));
            $('#permanent_defer_modal').appendTo("#modal-containter").modal('show');
        }
        // for female_defer class
        $('#temp_differ_time').html('');
        $('.temp_diff_des').html('');
        if ($('.female_defer').is(':checked')) {
            $('.hf-temp-perm-d').css('display','none');
            // alert($(this).attr('data-id'));
            $('#temp_differ_time').html($(this).attr('data-id'));
            $('.temp_diff_des').html($(this).attr('data-value'));
            $('#temp_diff_status').val('1');
        }
    });

</script>

<script type="text/javascript">
  //Default as
  $("#defaultNextBtn").on("click", function() {
    $('#intake_medicine_err').html('');
    $('#immunized_typ_err').html('');
    $('#suffer_typ_err').html('');
    $('#ill_typ_err').html('');
    $('#illsix_typ_err').html('');
    $('#illtwelve_typ_err').html('');
    $('#pre_bd_date_err').html('');
    $('#no_bdt_date_err').html('');
    $('#n_suffer_typ_err').html('');
    const err_block_ids = [];
    var b1ErrorCount = 0;
    var b1FocusElement = "";
    if ($('#pre_db_yes').prop('checked') == true) {
    //   if ($('#pre_bd_date').val() == "") {
    //     $('#pre_bd_date_err').html('please select the date');
    //     err_block_ids.push("pre_db_yes");
    //     b1ErrorCount++;
    //   }
    }
    if ($('#no_bdt_yes').prop('checked') == true) {
      if ($('#no_bdt_date').val() == "") {
        $('#no_bdt_date_err').html('please fill the field');
        err_block_ids.push("no_bdt_yes");
        b1ErrorCount++;
      }
    }
    if ($('#sufferthr_yes').prop('checked') == true) {
      if ($('.n_suffer_typ').filter(':checked').length < 1) {
        $('#n_suffer_typ_err').html('Please Check at least one checkbox');
        b1ErrorCount++;
        err_block_ids.push("n_suffer_typ_err");
      }
    }
    if ($('#take_medicine_yes').prop('checked') == true) {
      if ($('.intake_medicine').filter(':checked').length < 1) {
        $('#intake_medicine_err').html('Please Check at least one checkbox');
        b1ErrorCount++;
        err_block_ids.push("take_medicine_yes");
      }
    }
    if ($('#take_medicine_no').prop('checked') == true) {
    }
    if ($('#vaccinated_yes').prop('checked') == true) {
      if ($('.immunized_typ').filter(':checked').length < 1) {
        $('#immunized_typ_err').html('Please Check at least one checkbox');
        err_block_ids.push("vaccinated_yes");
        b1ErrorCount++;
      }
    }
    if ($('#lastdisease_yes').prop('checked') == true) {
      if ($('.suffer_typ').filter(':checked').length < 1) {
        $('#suffer_typ_err').html('Please Check at least one checkbox');
        err_block_ids.push("lastdisease_yes");
        b1ErrorCount++;
      }
    }
    if ($('#trimonthdis_yes').prop('checked') == true) {
      if ($('.ill_typ').filter(':checked').length < 1) {
        $('#ill_typ_err').html('Please Check at least one checkbox');
        err_block_ids.push("trimonthdis_yes");
        b1ErrorCount++;
      }
    }
    if ($('#sixmonthdis_yes').prop('checked') == true) {
      if ($('.illsix_typ').filter(':checked').length < 1) {
        $('#illsix_typ_err').html('Please Check at least one checkbox');
        err_block_ids.push("sixmonthdis_yes");
        b1ErrorCount++;
      }
    }
    if ($('#twelevemonthdis_yes').prop('checked') == true) {
      if ($('.illtwelve_typ').filter(':checked').length < 1) {
        $('#illtwelve_typ_err').html('Please Check at least one checkbox');
        err_block_ids.push("twelevemonthdis_yes");
        b1ErrorCount++;
      }
    }
    if ($('#perma_defer_yes').prop('checked') == true) {
      if ($('.Permanent_defer_typ').filter(':checked').length < 1) {
        $('#Permanent_defer_typ_err').html('Please Check at least one checkbox');
        err_block_ids.push("perma_defer_yes");
        b1ErrorCount++;
      }
    }
    if (b1ErrorCount != 0) {
      var err_blk_id = err_block_ids[0];
      $('#' + err_blk_id).attr('tabindex', -1).focus();
    }
    if (b1ErrorCount == 0) {
      var gender = $('#get_gender').val();
      gender = gender.toLowerCase();

      if (gender == 'male') {
        $("#collapseSuccess").collapse('show');
      } else {
        $("#collapsePrimary").collapse('show');
      }
      $('#collapseDefault').removeClass('collapse');
      $('#collapseDefault').removeClass('in');
      $('#collapseDefault').addClass('collapse ');
      $('#collapseDefault').removeClass('show');
    }
  });

  //Primary as
  $("#primaryNextBtn").on("click", function() {
    $("#collapseSuccess").collapse('show');
    $("#collapsePrimary").collapse('hide');
  });
  $("#primaryPrevBtn").on("click", function() {

    $("#collapseDefault").collapse('show');
    $("#collapsePrimary").collapse('hide');
  });
   $("#appointmentPrevBtn").on("click", function() {
     $("#collapseInfo").collapse('show');
     $("#book-appointment-blk").collapse('hide');
  });
  //Success as
  $("#successNextBtn").on("click", function() {
    $("#collapseInfo").collapse('show');
    $("#collapseSuccess").collapse('hide');
    $("#collapseSuccess").removeClass('show');
  });
  $("#successPrevBtn").on("click", function() {
    var gender = $('#get_gender').val();
    gender = gender.toLowerCase();
    if (gender == 'male') {
      $("#collapseDefault").collapse('show');
    } else {
      $("#collapsePrimary").collapse('show');
    }
    $("#collapseSuccess").collapse('hide');
  });
  //Info as
  $("#infoNextBtn").on("click", function() {
    var b2_err_cnt = 0;
    const ic_err_ids = [];
    $('#regularvoluntary_err').html('');
    if ($('#regularvoluntary_yes').prop('checked') == true) {
      if ($('.regularvoluntary').filter(':checked').length < 1) {
        $('#regularvoluntary_err').html('<span class="row" style="color:red;padding-left:18px;">Please Check at least one checkbox</span>');
        b2_err_cnt++;
        ic_err_ids.push("regularvoluntary_err");
      }
    }

    $('#d_weight_err').html('')
    $('#d_hemoglobin_err').html('');
    $('#d_bp_err').html('');
    $('#health_examination_err').html('');
    // if ($('#d_weight').val() == '') {
    //   $('#d_weight_err').html('<span class="row ml-4" style="color:red;padding-left:38px;">Please Enter Weight</span>');
    //   b2_err_cnt++;
    //   ic_err_ids.push("regularvoluntary_err");

    // }
    // if ($('#d_bp').val() == '') {
    //   $('#d_bp_err').html('<span class="row ml-4" style="color:red;padding-left:18px;">Please Enter BP </span>');
    //   b2_err_cnt++;
    //   ic_err_ids.push("d_bp_err");
    // }
    // if ($('#d_hemoglobin').val() == '') {
    //   $('#d_hemoglobin_err').html('<span class="row ml-4" style="color:red;padding-left:68px;">Please Enter Hemoglobin</span>');
    //   b2_err_cnt++;
    //   ic_err_ids.push("d_hemoglobin_err");
    // }
    var isValid = $("input[name=health_examination]").is(":checked");
    if (isValid == false) {
      $('#health_examination_err').html('<span class="row ml-4" style="color:red;padding-left:68px;">Required*</span>');
      b2_err_cnt++;
      ic_err_ids.push("health_examination_err");
    }
    if (b2_err_cnt != 0) {
      var ic_err_id = ic_err_ids[0];
      $('#' + ic_err_id).attr('tabindex', -1).focus();
    }

    if (b2_err_cnt == 0) {
      if($('#temp_diff_status').val() == '1'){
          jQuery.noConflict();
          $('#temporary_defer_modal').appendTo("#modal-containter").modal('show');
      }
      $("#collapseSuccessLast").collapse('show');
      $("#collapseInfo").collapse('hide');
      $("#book-appointment-blk").collapse('show');
    }
  });
  
  $("#infoPrevBtn").on("click", function() {
    $("#collapseSuccess").collapse('show');
    $("#collapseInfo").removeClass('show');
    $("#collapseInfo").collapse('hide');
  });
   $("#book-appointment-nxt").on("click", function() {
    getLocation();
    $("#book-appointment-blk").collapse('show');
    $("#collapseSuccessLast").collapse('hide');
  });
  //Warning as
  $("#warningNextBtn").on("click", function() {
    $("#collapseDanger").collapse('show');
    $("#collapseWarning").collapse('hide');
  });
  $("#warningPrevBtn").on("click", function() {
    $("#collapseInfo").collapse('show');
    $("#collapseWarning").collapse('hide');
  });
  //Dangeras
  $("#dangerPrevBtn").on("click", function() {
    $("#collapseWarning").collapse('show');
    $("#collapseDanger").collapse('hide');
  });
  $("#successPrevLastBtn").on("click", function() {
    $("#collapseSuccessLast").collapse('hide');
    $("#collapseInfo").collapse('show');
  });
  $('.perma_defer').on('click', function() {
    
    if ($(this).is(':checked') == true) {
      jQuery.noConflict();
      $('.hf-temp-perm-d').css('display','none');
      $('.perm_diff_des').html($(this).attr('value'));
      $('#permanent_defer_modal').appendTo("#modal-containter").modal('show');
    }

  });
  $('.permanent_defer').on('click', function() {

    if ($(this).is(':checked')) {
      jQuery.noConflict();
      // alert($(this).attr('data-value'));
      $('.hf-temp-perm-d').css('display','none');
      $('.perm_diff_des').html($(this).attr('data-value'));
      $('#permanent_defer_modal').appendTo("#modal-containter").modal('show');
    }
  });
  $('.permanent_defer_no').on('click', function() {

    if ($(this).is(':checked')) {
      // jQuery.noConflict();
      // alert($(this).attr('data-value'));
      // alert($('.perm_diff_des').html());
      $('.hf-temp-perm-d').css('display','block');
      // $('body').find("[data-value='" + $('.perm_diff_des').html() + "']").prop('checked',false);
    }
  });
  $('.set_temperal_defer').on('click', function() {

    $('.temp_diff_des').html('');
    $('#temp_differ_time').html('');
    if ($(this).is(':checked') == true) {
      /*appending differ details to pop up modal*/
      // alert($(this).attr('data-differ-category'))
      var differ_category = $(this).attr('data-differ-category');
      var differ_reasons = [];
      var differ_durations = [];
      $(this).attr('data-differ-category')
      $('#upd_temp_differ_time').html($(this).attr('data-id'));
      $('.hf-temp-perm-d').css('display','none');
      $('#upd_temp_diff_des').html( differ_category + "  ["+$(this).attr('value')+"]");
      //check every question having temporary defer options checked or not 
      $('.set_temperal_defer').each(function(){
        //if checked set temp_diff_status value to 1
        if ($(this).is(':checked') == true) {
          $('#temp_diff_status').val('1');    
        }
      })
      //if temp_diff_status value is 1 then hide outers having class hf-temp-perm-d
      if ( $('#temp_diff_status').val() == '1') {
        $('.hf-temp-perm-d').css('display','none');   
      }
      $('.hf-temp-perm-d').css('display','none');
      $('#ic-temp-submit').css('display','block');
      // alert($(this).attr('data-parent-yes'));
      $('#'+$(this).attr('data-parent-yes')).prop('checked','true');

    }
    if ($(this).is(':checked') == false) {
    //   alert($(this).attr('data-filter'));
      if($('.'+$(this).attr('data-filter')).filter(':checked').length < 1){
        $('.hf-temp-perm-d').css('display','block');
        $('#'+$(this).attr('data-parent-no')).prop('checked','true');
        $('#temp_diff_status').val('0');
        checkTempDefer()
        $('#book-appointment-blk').collapse('hide');
        $('#book-appointment-blk').removeClass('in');
      }
    }
  });
  $('#pd-modify').on('click',function(){
    // closing appointment step
    $('#book-appointment-blk').collapse('hide');
    $('#book-appointment-blk').removeClass('in');
    alert($('#temp_diff_status').val())
    $('.hf-temp-perm-d').css('display','block');
    $('.perma_defer').each(function(){
      $(this).prop('checked',false)
    });
    $('body').find("[data-value='" + $('.perm_diff_des').html() + "']").prop('checked',false);
    /*checking default radio option*/
    var optname = $('body').find("[data-value='" + $('.perm_diff_des').html() + "']").prop('name');
    $('input[name="'+optname+'"]').each(function(){
      if($(this).attr('data-id') == "default-check"){
        $(this).prop('checked',true);
      }
    });
    //check every question having temporary defer options checked or not 
    $('.set_temperal_defer').each(function(){
      if ($(this).is(':checked') == true) {
        $('#temp_diff_status').val('1');
      }
    })
    //if temp_diff_status value is 1 then hide outers having class hf-temp-perm-d
    if ( $('#temp_diff_status').val() == '1') {
      $('.hf-temp-perm-d').css('display','none');   
    }
  })
  $('.female_defer').click(function() {
    // $('#temp_differ_time').html('');
    // $('#upd_temp_diff_des').html('');
    if ($(this).is(':checked')) {
      $('.hf-temp-perm-d').css('display','none');
      // alert($(this).attr('data-id'));
      $('#temp_differ_time').html($(this).attr('data-id'));
      $('#upd_temp_diff_des').html($(this).attr('data-value'));
      $('#temp_diff_status').val('1');
      checkTempDefer()
    }
  });
  $('.female_defer_no').click(function() {

    if ($(this).is(':checked')) {
      $('.hf-temp-perm-d').css('display','block');
      $('#temp_differ_time').html($(this).attr('data-id'));
      $('#upd_temp_diff_des').html($(this).attr('data-value'));
      $('#temp_diff_status').val('0');
      $("#book-appointment-blk").collapse('hide');
    }
    checkTempDefer();
  });
  $('#pre_db_no').on('click', function(){
    $('.blood__bank--info').each(function(){
      $(this).val('');
    });
    $('#pre_bd_date').val('');
    $('#pre_bd_date').attr('placeholder', 'mm/dd/yyyy');
  })
</script>

<script type="text/javascript">
  function donationInterval(ele) {
    var last_date = $(ele).val();
    var current_date = new Date();
    var utc = new Date().toJSON().slice(0, 10);
    var dt1 = new Date(last_date);
    var dt2 = new Date(current_date);

    var time_difference = dt2.getTime() - dt1.getTime();
    var diff = time_difference / (1000 * 60 * 60 * 24);

    var gender = $('#get_gender').val();
    gender = gender.toLowerCase();
    if (diff > 90 && gender == "male") {
       $('.hf-temp-perm-d').css('display','none');
      // alert($(this).attr('data-id'));
      $('#upd_temp_differ_time').html('90 days');
      $('#upd_temp_diff_des').html('Donation Interval');
      $('#temp_diff_status').val('1');
      // $("#collapseDefault").collapse('hide');
      $("#collapseSuccessLast").collapse('show');
      $("#DonationInterval").prop('checked', true);
      $('#temporary_defer_yes').attr('checked', true);
    } 
    else if (diff > 120 && gender == "female") {
      $('.hf-temp-perm-d').css('display','none');
      // alert($(this).attr('data-id'));
      $('#upd_temp_differ_time').html('120 days');
      $('#upd_temp_diff_des').html('Donation Interval');
      $('#temp_diff_status').val('1');
      // $("#collapseDefault").collapse('hide');
      $("#collapseSuccessLast").collapse('show');
      $("#DonationInterval").prop('checked', true);
      $('#temporary_defer_yes').attr('checked', true);
    }
  }
  $('#take_medicine_yes').on('click', function() {
    $('#take_medicine').show();

  });
  // $('#take_medicine_no').on('click', function() {
  //   $('#take_medicine').hide();
  // });
</script>

<script>
  var x = document.getElementById("demo");

  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
      x.innerHTML = "Geolocation is not supported by this browser.";
    }
  }

  function showPosition(position) {
    alert(position.coords.latitude)
    $('#lat').val(position.coords.latitude);
    $('#long').val(position.coords.longitude);
  }
    $('#get-nearby-HBBC').on('click', function(){
      
      var latitude = $('#lat').val();
      var longitude = $('#long').val();
     var pltf_type = $('input[name="loc"]:checked').val();
      var base_url = $('#protocol').val();
      var set_url = "";
      if(pltf_type == 'hospital'){
        set_url = base_url+"nearby-centers/nearby-hospitals.php";
        // alert(set_url);
        $.ajax({
            url: set_url,
            type: "post",
            data: {lat:latitude, long:longitude} ,
            success: function (response) {
              // alert(response);
              var result = JSON.parse(response);
              // console.log(result);
              // alert(result[0]['id']);
              var text="";
              var options = " <option style='display:none;' selected >choose hospital</option>";
              var option = "";
              $.each(result, function (key, val) {
                  //console.log(JSON.parse(val['details']));
                  text = JSON.parse(val['details']);
                  console.log(text['BB_info']['BloodBankName']);
                  option = "<option value='"+val['id']+"'>"+text['BB_info']['BloodBankName']+"</option>";
                  options = option+options;
              });
              console.log(options);
              $('#locations').html(options)
              // $('#location-blk').html('<select id="locations" name="locations"  class="col-md-5 form-control select2" >'+options+'</select>');
            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
            }
        });
      }
      if(pltf_type == 'blood_bank'){
        // alert(set_url);
        set_url = base_url+"nearby-centers/nearby-blood-banks.php";
        // alert(set_url);
        $.ajax({
            url: set_url,
            type: "post",
            data: {lat:latitude, long:longitude} ,
            success: function (response) {
              //  alert(response);
              var result = JSON.parse(response);
              // console.log(result);
              // alert(result[0]['id']);
              var text="";
              var options = "<option value='' style='display:none;' selected >choose blood bank</option>";
              var option = "";
              $.each(result, function (key, val) {
                  //console.log(JSON.parse(val['details']));
                  text = val['campname'];
                  // console.log(text['BB_info']['BloodBankName']);
                  option = "<option value='"+val['id']+"'>"+val['camp_name']+"</option>";
                  options = option+options;
              });
              console.log(options);
              $('#locations').html(options)
              // $('#location-blk').html('<select id="locations" name="locations"  class="col-md-5 form-control select2" >'+options+'</select>');
            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
            }
        });
      }
      // alert(set_url);
     
    });



</script>
<script language="javascript" type="text/javascript">
   $( document ).ready(function() {
      // $('#collapseDefault').attr('tabindex', -1).focus();

      // $('html, body').animate({ scrollTop: $('#collapseDefault').offset().top }, 'slow');
        //$('.t-3678').css('display','none');
        var j = 1;
        $('.step1-sl').each(function() {
           if($(this).is(":visible") == true){
            $(this).html(j+".");
              j++;
            }
           
        });

      $('.toggle-sl').on("click", function() {
        var k = 1;
        $('.step1-sl').each(function() {
           if($(this).is(":visible") == true){
            $(this).html(k+".");
              k++;
            }
           
        });
      });
      $('.panel-collapse').on('shown.bs.collapse', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var $panel = $(this).closest('.panel');
                      $('html,body').animate({
                        scrollTop: $panel.offset().top -120
                      }, 10);
    });

    });
   
    $('#ic-temp-submit').on("click", function() {
      $('#defer_type').val('temporary defer');
      $('#defer_status').val('1');
       // $("#donation-form").submit();
      $("#fin-submit").trigger('click');

       
    });
     $('#ic-perm-submit').on("click", function() {
      $('#defer_type').val('permanent defer');
      $('#defer_status').val('1');
       // $("#donation-form").submit();
      $("#fin-submit").trigger('click');
       
    })
     $('#set_schedule_appointment').on('click', function(){
      $('#schedule_appointment').val('1');
      $("#fin-submit").trigger('click');
     })
     $('#s-o-day').on('click', function(){
         alert();
      var role = $('#user-role').val();
        if(role == "super-admin"){
            alert()
          $('.t-3678').show();
        }
        else{
          $('.t-3678').hide();
        }
     });
     $('.un-check').on('click',function(){
        $('.'+$(this).attr('data-child')).each(function(child){
          $(this).attr('checked', false);
        })
     })
      $('#temporary_defer_modal').on('hidden.bs.modal', function (e) {
         $("#collapseInfo").collapse('show');
      })
      $('#permanent_defer_modal').on('hidden.bs.modal', function (e) {
         $("#collapseInfo").collapse('hide');
      })
      function checkTempDefer(){
        //check every question having temporary defer options checked or not 
        $('.set_temperal_defer').each(function(){
            //if checked set temp_diff_status value to 1
            if ($(this).is(':checked') == true) {
              $('#temp_diff_status').val('1');    
            }
          })
          //if temp_diff_status value is 1 then hide outers having class hf-temp-perm-d
          if ( $('#temp_diff_status').val() == '1') {
            $('.hf-temp-perm-d').css('display','none');   
          }
      }
</script>

  </section>
  <!--footer-->
  <?php //  include('footer.php'); 
  ?>
  <script src="<?php echo $base_url; ?>dist/js/jquery.js"></script>
  <script src="../../unpkg.com/aos%402.3.1/dist/aos.js"></script>
  <script>
    // AOS.init();
  </script>
  <script src="<?php echo $base_url; ?>dist/js/jquery.meanmenu.js"></script>
  <!-- <script src="dist/js/jquery.nice-select.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/superfish/1.7.4/superfish.min.js"></script>
  <script src="<?php echo $base_url; ?>dist/js/bootstrap.min.js"></script>
  <script src="<?php echo $base_url; ?>dist/js/custom.js"></script>
  <script src="<?php echo $base_url; ?>dist/js/slick.min.js"></script>
  <script src="<?php echo $base_url; ?>dist/js/owl.carousel.min.js"></script>
  
 <script src="<?php echo $base_url;?>/dist/js/common.js"></script>
  <script>
    $(document).ready(function() {
      $(".action-button").click(function() {
        var serializedData = $('#msform').serialize();
        $.ajax({
          url: "donor_save.php",
          type: "POST",
          data: serializedData,
          success: function(result) {
            alert('sdfsdf');
          }
        });
      });
    });
    // Mean Menu
    jQuery('.mean-menu').meanmenu({
      meanScreenWidth: "991"
    });
    // Header Sticky
    $(window).on('scroll', function() {
      if ($(this).scrollTop() > 150) {
        $('.navbar-area').addClass("is-sticky");
      } else {
        $('.navbar-area').removeClass("is-sticky");
      }
    });
    $(function() {
      $('.dieases.action-button').click(function() {
        $(this).toggleClass('active');
      })
    })
  </script>

