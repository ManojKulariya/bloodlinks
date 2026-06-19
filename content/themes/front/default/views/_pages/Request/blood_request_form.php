<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php

    $id = $_SESSION['customer_id'];
    if(!empty($_POST['p_name'])){
         // print_r($_POST); die();
        
     $user_id = $id;
     $p_name = $_POST['p_name'];
     $age = $_POST['age']; 
     $gender = $_POST['gender'];
     $registration = $_POST['registration'];
     $ward = $_POST['ward'];
     $bed = $_POST['bed'];
     $f_name = $_POST['f_name'];
     $hospital = $_POST['hospital'];
     $phone = $_POST['phone'];
     $consultant = $_POST['consultant'];
     $consultant_phone = $_POST['consultant_phone'];
     $clinical_history = $_POST['clinical_history'];
     $diagnosis = $_POST['diagnosis'];
     $hb = $_POST['hb'];
     $platelet = $_POST['platelet'];
     $reasons = $_POST['reasons'];
     $history_previous = $_POST['history_previous'];
     $blood_group = $_POST['blood_group'];
     $female = $_POST['female'];

     foreach($_POST as $key=>$value){
         if(strpos($key,"unit")){
               $unit[$key] = $value;
         } 
         if(strpos($key,"test")){
               $test[$key] = $value;
         }       
     }
 //print_r($unit);
 //print_r($test);
  //die;
                                                                                                       
     $components_unit = json_encode($unit);
     $components_test = json_encode($test);
     $required_date = $_POST['required_date'];
     $required_time = $_POST['required_time'];
     $stat = $_POST['stat'];
     $urgent = $_POST['urgent'];
     $routine = $_POST['routine'];
     $reserved = $_POST['reserved'];
     $patient = $_POST['patient'];
     $identity = $_POST['identity'];
     $medical = $_POST['medical'];
     $completely = $_POST['completely'];
     $sample = $_POST['sample'];
     $match = $_POST['match'];
     $sample_tube = $_POST['sample_tube'];

     $insert = $this->db->query("INSERT INTO bl_blood_request (user_id , p_name , age , gender , registration , ward , bed , f_name, hospital, phone , consultant , consultant_phone , clinical_history , diagnosis , hb , platelet , reasons , history_previous , blood_group , female , components_unit , components_test , required_date , required_time , stat , urgent , routine , reserved , patient , identity , medical , completely  , sample , matchs , sample_tube ) VALUES ('$user_id','$p_name','$age', '$gender', '$registration' , '$ward','$bed' , '$f_name' , '$hospital' , '$phone' , '$consultant' , '$consultant_phone' , '$clinical_history' , '$diagnosis' , '$hb' , '$platelet' , '$reasons' , '$history_previous' , '$blood_group' , '$female' , '$components_unit' , '$components_test' , '$required_date' , '$required_time' , '$stat' , '$urgent' , '$routine' , '$reserved' , '$patient' , '$identity' , '$medical' , '$completely' , '$sample' , '$match' , '$sample_tube')");
        $_SESSION['last_id'] = $this->db->insert_id();

        if($insert==true){
       // echo 'hiii';
       // die();

       redirect('blood_request_appointment');
      // echo '<script>alert("Your Appointment Booked")</script>';
       } else{
       echo "fail";
      }
   }?>
 <div class="image-contactus-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <h1 class="lg-text text-dark">Request for Blood</h1>
              <h6><a href="<?php echo base_url();?>">Home /</a> Request for Blood</h6>
            </div>
        </div>
    </div>
</div>

<!--request form-->
<!--request form-- end-->
<section class="request-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-12  text-center ">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2 id="heading">Request for Blood</h2>
                    <p>Fill all form field to go to next step</p>

                        <div id="step_forms">

                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style type="text/css">
   @import url('https://fonts.googleapis.com/css?family=Roboto');
   body{
   font-family: 'Roboto', sans-serif;
   }
   * {
   margin: 0;
   padding: 0;
   }
   i {
   margin-right: 10px;
   }
   label{
    text-transform: unset!important;
   }
   .form-group label {
   color: black!important;
   font-size: 14px!important;
   padding-bottom: 0px!important;
   margin-bottom: 0px!important;
   }
   /*------------------------*/
   input:focus,
   button:focus,
   .form-control:focus{
   outline: none;
   box-shadow: none;
   }
   .form-control:disabled, .form-control[readonly]{
   background-color: #fff;
   }
   /*----------step-wizard------------*/
   .d-flex{
   display: flex;
   }
   .justify-content-center{
   justify-content: center;
   }
   .align-items-center{
   align-items: center;
   }
   /*---------signup-step-------------*/
   .bg-color{
   background-color: #333;
   }
   .signup-step-container{
   padding: 0px 0px;
   padding-bottom: 60px;
   }
   .wizard .nav-tabs {
   position: relative;
   margin-bottom: 0;
   border-bottom-color: transparent;
   }
   .wizard > div.wizard-inner {
   position: relative;
   /*  margin-bottom: 50px;*/
   text-align: center;
   }
   .connecting-line {
   height: 2px;
   background: #e0e0e0;
   position: absolute;
   width: 75%;
   margin: 0 auto;
   left: 0;
   right: 0;
   top: 52px;
   z-index: 1;
   }
   .wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
   color: #555555;
   cursor: default;
   border: 0;
   border-bottom-color: transparent;
   }
   span.round-tab {
   width: 30px;
   height: 30px;
   line-height: 30px;
   display: inline-block;
   border-radius: 50%;
   background: #fff;
   z-index: 2;
   position: absolute;
   left: 0;
   text-align: center;
   font-size: 16px;
   color: #0e214b;
   font-weight: 500;
   border: 1px solid #ddd;
   }
   span.round-tab i{
   color:#555555;
   }
.wizard li.active span.round-tab {
    background: #b83138;
    color: #fff;
    border-color: #a72d33;
}
   .wizard li.active span.round-tab i{
   color: #5bc0de;
   }
  .wizard .nav-tabs > li.active > a i {
    color: #a72d33;
}
   .wizard .nav-tabs > li {
   width: 25%;
   }
   .wizard li:after {
   content: " ";
   position: absolute;
   left: 46%;
   opacity: 0;
   margin: 0 auto;
   bottom: 0px;
   border: 5px solid transparent;
   border-bottom-color: red;
   transition: 0.1s ease-in-out;
   }
   .wizard .nav-tabs > li a {
   width: 30px;
   height: 30px;
   margin: 20px auto;
   border-radius: 100%;
   padding: 0;
   background-color: transparent;
   position: relative;
   top: 0;
   }
   .wizard .nav-tabs > li a i{
   position: absolute;
   top: -15px;
   font-style: normal;
   font-weight: 400;
   white-space: nowrap;
   left: 50%;
   transform: translate(-50%, -50%);
   font-size: 12px;
   font-weight: 700;
   color: #000;
   }
   .wizard .nav-tabs > li a:hover {
   background: transparent;
   }
   .wizard .tab-pane {
   position: relative;
   /*padding-top: 20px;*/
   }
  .blood-request-line {
    margin: 0 0 25px;
    background: #b23036;
    color: #fff;
    padding: 10px;
}
   .wizard h3 {
   margin-top: 0;
   }
   .prev-step,
   .next-step{
   font-size: 13px;
   padding: 8px 24px;
   border: none;
   border-radius: 4px;
   /*margin-top: 30px;*/
   }
   .next-step{
   background-color: #a72d33;
   }
   .skip-btn{
   background-color: #cec12d;
   }
   .step-head{
   font-size: 20px;
   text-align: center;
   font-weight: 500;
   margin-bottom: 20px;
   }
   .term-check{
   font-size: 14px;
   font-weight: 400;
   }
   .custom-file {
   position: relative;
   display: inline-block;
   width: 100%;
   height: 40px;
   margin-bottom: 0;
   }
   .custom-file-input {
   position: relative;
   z-index: 2;
   width: 100%;
   height: 40px;
   margin: 0;
   opacity: 0;
   }
   .custom-file-label {
   position: absolute;
   top: 0;
   right: 0;
   left: 0;
   z-index: 1;
   height: 40px;
   padding: .375rem .75rem;
   font-weight: 400;
   line-height: 2;
   color: #495057;
   background-color: #fff;
   border: 1px solid #ced4da;
   border-radius: .25rem;
   }
   .custom-file-label::after {
   position: absolute;
   top: 0;
   right: 0;
   bottom: 0;
   z-index: 3;
   display: block;
   height: 38px;
   padding: .375rem .75rem;
   line-height: 2;
   color: #495057;
   content: "Browse";
   background-color: #e9ecef;
   border-left: inherit;
   border-radius: 0 .25rem .25rem 0;
   }
   .footer-link{
   margin-top: 30px;
   }
   .all-info-container{
   }
   .list-content{
   margin-bottom: 10px;
   }
   .list-content a{
   padding: 10px 15px;
   width: 100%;
   display: inline-block;
   background-color: #f5f5f5;
   position: relative;
   color: #565656;
   font-weight: 400;
   border-radius: 4px;
   }
   .list-content a[aria-expanded="true"] i{
   transform: rotate(180deg);
   }
   .list-content a i{
   text-align: right;
   position: absolute;
   top: 15px;
   right: 10px;
   transition: 0.5s;
   }
   .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
   background-color: #fdfdfd;
   }
   .list-box{
   padding: 10px;
   }
   .signup-logo-header .logo_area{
   width: 200px;
   }
   .signup-logo-header .nav > li{
   padding: 0;
   }
   .signup-logo-header .header-flex{
   display: flex;
   justify-content: center;
   align-items: center;
   }
   .list-inline li{
   display: inline-block;
   padding: 20px
   }
   .pull-right{
   float: right;
   }
   /*-----------custom-checkbox-----------*/
   /*----------Custom-Checkbox---------*/
   input[type="checkbox"]{
   position: relative;
   display: inline-block;
   margin-right: 5px;
   }
   input[type="checkbox"]::before,
   input[type="checkbox"]::after {
   position: absolute;
   content: "";
   display: inline-block;   
   }
   input[type="checkbox"]::before{
   height: 16px;
   width: 16px;
   border: 1px solid #999;
   left: 0px;
   top: 0px;
   background-color: #fff;
   border-radius: 2px;
   }
   input[type="checkbox"]::after{
   height: 5px;
   width: 9px;
   left: 4px;
   top: 4px;
   }
   input[type="checkbox"]:checked::after{
   content: "";
   border-left: 1px solid #fff;
   border-bottom: 1px solid #fff;
   transform: rotate(-45deg);
   }
   input[type="checkbox"]:checked::before{
   background-color: #a72d33;
    border-color: #b73138;
   }
   @media (max-width: 767px){
   .sign-content h3{
   font-size: 40px;
   }
   .wizard .nav-tabs > li a i{
   display: none;
   }
   .signup-logo-header .navbar-toggle{
   margin: 0;
   margin-top: 8px;
   }
   .signup-logo-header .logo_area{
   margin-top: 0;
   }
   .signup-logo-header .header-flex{
   display: block;
   }
   }
   .form-control {
    padding: 0px;
   }
</style>
<section class="signup-step-container">
   <div class="container">
      <div class="row d-flex justify-content-center">
         <div class="col-md-8">
            <div class="wizard">
               <div class="wizard-inner">
                  <div class="connecting-line"></div>
                  <ul class="nav nav-tabs" role="tablist">
                     <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Step 1</i></a>
                     </li>
                     <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Step 2</i></a>
                     </li>
                     <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>Step 3</i></a>
                     </li>
                     <li role="presentation" class="disabled">
                        <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab">4</span> <i>Step 4</i></a>
                     </li>
                  </ul>
               </div>
              <form action = "<?php $_PHP_SELF ?>" method = "POST" class="login-box">
                 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <div class="tab-content" id="main_form">
                     <div class="tab-pane active" role="tabpanel" id="step1">
                      <div class="blood-request-line">
                        <h4 class="text-center">Step 1</h4>
                        <h4 class="text-center">Patient Information</h4>
                      </div>
                        <div class="row p-4">
                          <div class="col-md-12">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                    <label>Patient Name <span>*</span></label> 
                                  </div>
                                <div class="col-sm-8">
                                  <input class="form-control" type="text" name="p_name" placeholder=""> 
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                 <div class="row">
                                  <div class="col-sm-4">
                                    <label>Age <span>*</span></label> 
                                  </div>
                                  <div class="col-sm-8">
                                    <input class="form-control" type="text" name="age" placeholder="">
                                  </div> 
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                 <div class="row">
                                  <div class="col-sm-4">
                                    <label>Gender <span>*</span></label> 
                                  </div>
                                  <div class="col-sm-8">
                                    <select name="gender" class="form-control" id="country">
                                    <option value="Male" selected="selected">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                 </select>
                                  </div> 
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                 <div class="row">
                                  <div class="col-sm-4">
                                    <label>Hospital Registration No. <span>*</span></label> 
                                  </div>
                                  <div class="col-sm-8">
                                    <input class="form-control" type="text" name="registration" placeholder=""> 
                                  </div> 
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                 <div class="row">
                                  <div class="col-sm-4">
                                    <label>Ward No.<span>*</span></label> 
                                  </div>
                                  <div class="col-sm-8">
                                    <input class="form-control" type="text" name="ward" placeholder=""> 
                                  </div> 
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                 <div class="row">
                                  <div class="col-sm-4">
                                    <label>Bed No.<span>*</span></label> 
                                  </div>
                                  <div class="col-sm-8">
                                   <input class="form-control" type="text" name="bed" placeholder=""> 
                                  </div> 
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                 <div class="row">
                                  <div class="col-sm-4">
                                    <label>Father's Name <span>*</span></label> 
                                  </div>
                                  <div class="col-sm-8">
                                   <input class="form-control" type="text" name="f_name" placeholder=""> 
                                  </div> 
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                 <div class="row">
                                  <div class="col-sm-4">
                                    <label>Name of Hospital <span>*</span></label> 
                                  </div>
                                  <div class="col-sm-8">
                                  <input class="form-control" type="text" name="hospital" placeholder=""> 
                                  </div> 
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                 <div class="row">
                                  <div class="col-sm-4">
                                    <label>Phone No. <span>*</span></label> 
                                  </div>
                                  <div class="col-sm-8">
                                    <input class="form-control" type="tel" name="phone" placeholder=""> 
                                  </div> 
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                 <div class="row">
                                  <div class="col-sm-4">
                                    <label>Name of Consultant. <span>*</span></label> 
                                  </div>
                                  <div class="col-sm-8">
                                    <input class="form-control" type="text" name="consultant" placeholder="">  
                                  </div> 
                              </div>
                            </div>
                          </div>
                        </div>
                        <ul class="list-inline pull-right">
                           <li><button type="button" class="default-btn next-step">Next</button></li>
                        </ul>
                     </div>
                     <div class="tab-pane" role="tabpanel" id="step2">
                      <div class="blood-request-line">
                        <h4 class="text-center">Step 2</h4>
                        <h4 class="text-center">Clinical Information</h4>
                      </div>
                        <div class="row p-4">
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                     <label>Clinical History <span>*</span></label> 
                                  </div>
                                  <div class="col-sm-8">
                                     <input class="form-control" type="text" name="clinical_history" placeholder=""> 
                                  </div>
                                </div>
                              </div>
                            </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                 <label>Diagnosis <span>*</span></label> 
                               </div>
                               <div class="col-sm-8">
                                 <input class="form-control" type="text" name="diagnosis" placeholder=""> 
                               </div>
                             </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                 <label>Hb gm% <span>*</span></label> 
                               </div>
                               <div class="col-sm-8">
                                 <input class="form-control" type="text" name="hb" placeholder=""> 
                               </div>
                             </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                 <label>Platelet Count <span>*</span></label> 
                               </div>
                               <div class="col-sm-8">
                                 <input class="form-control" type="text" name="platelet" placeholder=""> 
                               </div>
                               </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                 <label>Reason for Transfusion <span>*</span></label> 
                               </div>
                               <div  class="col-sm-8">
                                 <input class="form-control" type="text" name="reasons" placeholder=""> 
                               </div>
                             </div>
                              </div>
                           </div>
                           <!--  <div class="col-md-6">
                              <div class="form-group">
                                  <label>Country *</label> 
                                  <select name="country" class="form-control" id="country">
                                      <option value="NG" selected="selected">Nigeria</option>
                                      <option value="NU">Niue</option>
                                      <option value="NF">Norfolk Island</option>
                                      <option value="KP">North Korea</option>
                                      <option value="MP">Northern Mariana Islands</option>
                                      <option value="NO">Norway</option>
                                  </select>
                              </div>
                              </div> -->
                           <div class="col-md-12">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                 <label>History of Previous Transfusion</label> 
                               </div>
                               <div class="col-sm-8">
                                 <input type="radio" name="history_previous" value="Yes" placeholder=""> Yes
                                 <input type="radio" name="history_previous" value="No" placeholder=""> No
                              </div>
                            </div>
                          </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                 <label>Blood Group *</label> 
                               </div>
                               <div class="col-sm-8">
                                 <select name="blood_group" class="form-control" id="country">
                                    <option value="A+" selected="selected">A+</option>
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
                          </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-4">
                                 <label>In case of Female (History of Obstetric) *</label> 
                               </div>
                               <div class="col-sm-8">
                                 <input class="form-control" type="text" name="female" placeholder=""> 
                               </div>
                              </div>
                           </div>
                        </div>
                      </div>
                        <ul class="list-inline pull-right">
                           <li><button type="button" class="default-btn prev-step">Back</button></li>
                           <!--  <li><button type="button" class="default-btn next-step skip-btn">Skip</button></li> -->
                           <li><button type="button" class="default-btn next-step">Next</button></li>
                        </ul>
                     </div>
                     <div class="tab-pane" role="tabpanel" id="step3">
                      <div class="blood-request-line">
                        <h4 class="text-center">Step 3</h4>
                        <h4 class="text-center">Blood Component Requested</h4>
                      </div>
                         <div class="form-group">
                           <div class="row p-4">
                              <div class="col-md-4">
                                 <label>Components Name</label>
                              </div>
                              <div class="col-md-1">
                                <label></label>
                              </div>
                              <div class="col-md-3" >
                                 <label>No.of Units Requested</label>
                              </div>
                              <div class="col-md-4" >
                                <label>NAT Tested Product</label>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                              <div class="col-md-4">
                                 <label>Whole Blood</label>
                              </div>
                              <div class="col-md-1">
                                 <input name="chkbox" type="checkbox">
                              </div>
                              <div class="col-md-7" data-box="box" style="display: none;">
                                 <div class="row">
                                    <div class="col-md-6" >
                                        <label>
                                       <input type="number" name="whole_blood_unit" class="form-control">Units</label>
                                    </div>
                                    <div class="col-md-6" >
                                       <input type="radio" name="whole_blood_test" value="Yes" checked> Yes
                                 <input type="radio" name="whole_blood_test" value="No" > No
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php 
                            $query1 = $this->db->query("SELECT * FROM bl_masters WHERE master_type_key = 'component_types'");
                          foreach ($query1->result() as $components)
                        {?>
 
                        <div class="form-group">
                           <div class="row">
                              <div class="col-md-4">
                                 <label><?=$components->master_type_key_value ?></label>
                              </div>
                              <div class="col-md-1">
                                 <input name="chkbox" type="checkbox">
                              </div>
                              <div class="col-md-7" data-box="box" style="display: none;">
                                 <div class="row">
                                    <div class="col-md-6" >
                                        <label>
                                       <input type="number" name="<?=$components->master_type_key_value ?>_unit" class="form-control">Units</label>
                                    </div>
                                    <div class="col-md-6" >
                                       <input type="radio" name="<?=$components->master_type_key_value ?>_test" value="Yes" checked> Yes
                                 <input type="radio" name="<?=$components->master_type_key_value ?>_test" value="No" > No
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php } ?>
                       
                        <ul class="list-inline pull-right">
                           <li><button type="button" class="default-btn prev-step">Back</button></li>
                           <!--  <li><button type="button" class="default-btn next-step skip-btn">Skip</button></li> -->
                           <li><button type="button" class="default-btn next-step">Next</button></li>
                        </ul>
                     </div>
                     <div class="tab-pane" role="tabpanel" id="step4">
                      <div class="blood-request-line">
                        <h4 class="text-center">Step 4</h4>
                        <h4 class="text-center">Product Requirement</h4>
                      </div>
                        <div class="row p-4">
                           <div class="col-md-6">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-6">
                                   <label>Required Date <span>*</span></label> 
                                  </div>
                                  <div class="col-sm-6">
                                    <input class="form-control" type="date" name="required_date" placeholder=""> 
                                  </div>
                                </div>
                              </div>
                            </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-6">
                                 <label>Required Time  <span>*</span></label> 
                               </div>
                                <div class="col-sm-6">
                                 <input class="form-control" type="time" name="required_time" placeholder=""> 
                               </div>
                             </div>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label><input  type="checkbox" name="stat" placeholder=""> STAT <br>(Within 15 mins)</label> 
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label><input  type="checkbox" name="urgent" placeholder=""> Urgent <br>(One Hour)</label> 
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label> <input  type="checkbox" name="routine" placeholder=""> Routine </label> 
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label><input  type="checkbox" name="reserved" placeholder=""> Reserved </label> 
                              </div>
                           </div>
                           <br>
                           <h4 class="text-center mt-3 mb-4 pl-3"> To be Completed by Person Drawing Blood Specimen</h4>
                           <br>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label> <input type="checkbox" name="patient" placeholder=""> Patient (if concious) confirms to his and father's name</label> 
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label> <input type="checkbox" name="identity" placeholder=""> If unconscious Relative(s)/Staff confirm the identity</label> 
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label> <input type="checkbox" name="medical" placeholder=""> The Identity, Reg. No. checks with the medical records and same is written on the requisition form</label> 
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label> <input type="checkbox" name="completely" placeholder="">  Requisition form is properly and completely filled</label> 
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label> <input type="checkbox" name="sample" placeholder=""> Sample tube carries the patient's name, reg. no., ward no.</label> 
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label> <input type="checkbox" name="match" placeholder=""> These match with the medical records</label> 
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label> <input type="checkbox" name="sample_tube" placeholder="">  Phlebotomist has signed the sample tube</label> 
                              </div>
                           </div>
                        </div>
                        <ul class="list-inline pull-right">
                           <li><button type="button" class="default-btn prev-step">Back</button></li>
                           <li><button type="submit" class="default-btn next-step">Submit</button></li>
                        </ul>
                     </div>
                     <div class="clearfix"></div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
   // ------------step-wizard-------------
   $(document).ready(function () {
       $('.nav-tabs > li a[title]').tooltip();
       
   //Wizard
   $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
   
   var target = $(e.target);
   
   if (target.parent().hasClass('disabled')) {
       return false;
   }
   });
   
   $(".next-step").click(function (e) {
   
   var active = $('.wizard .nav-tabs li.active');
   active.next().removeClass('disabled');
   nextTab(active);
   
   });
   $(".prev-step").click(function (e) {
   
   var active = $('.wizard .nav-tabs li.active');
   prevTab(active);
   
   });
   });
   
   function nextTab(elem) {
       $(elem).next().find('a[data-toggle="tab"]').click();
   }
   function prevTab(elem) {
       $(elem).prev().find('a[data-toggle="tab"]').click();
   }
   
   
   $('.nav-tabs').on('click', 'li', function() {
       $('.nav-tabs li.active').removeClass('active');
       $(this).addClass('active');
   });
   
</script>
<script type="text/javascript">
   $('input[type="checkbox"]').click(function(){
     console.log(this);
   // $(this).parent().next().css('display','block');
   $(this).parent().next().toggle('show');
   });
</script>