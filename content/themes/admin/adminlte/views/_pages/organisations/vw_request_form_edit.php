<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<link
   rel="stylesheet"
   type="text/css"
   href="https://codepen.io/skjha5993/pen/bXqWpR.css"
   />
<style>
  .hide {
   display: none;
   }

   .form-control{
      height: 1.6rem !important;
    font-size: 0.9rem;
    padding: 0
	}
   .row{
      margin-bottom:-9px !important;
   }
   label:not(.form-check-label):not(.custom-file-label)
   
   
   {
      font-weight: 700 !important;
    font-size: 0.8rem !important;
    margin-bottom:0 !important;
   }

   .content-header h1{
      font-size: 1.2rem;
    margin: 0;
    font-weight: 700;
    padding-bottom: 10px
   }

   .btn-danger{
      font-size: 15px !important;
    margin-left: 28px !important;
    padding: 2px 17px !important;
   }

   /* <!-- .table td, .table th {
   padding: 0.25rem;
   vertical-align: top;
   border-top: 1px solid #dee2e6;
   }
   .table td, .table th { */
   /* padding: 0.75rem; */
   /* vertical-align: top; */
   /* border: 1px solid black !important;
   font-size: 14px;
   text-align: center;
   }
   .table {
   margin-top: 5px;
   width: 100%; */
   /* margin-bottom: 1rem; */
   /* color: #212529;
   margin-bottom: 2px!important;
   }
   .header {
   padding-top: 3px; */
   /* padding-bottom: 25px; */
   }
   /* .first-column {
   /* background: green; */
   /* color: white;
   font-size: 2rem; */ 
   /* border-width: 2px; */
   /* border-color: red; */
   /* border: 2px solid black; */
   /* background: #5851ff; */
   /*margin-top: 5px;*/
   /* box-shadow: 0 2px 5px 0 rgb(0 0 0 / 26%); */
   /* align-items: center;
   } */
   /* .float-right {
   float:none!important;
   } */
   /* .second-column { */
   /* background: green; */
   /* color: white;
   font-size: 2rem; */
   /* border-width: 2px; */
   /* border-color: red; */
   /* border: 2px solid black; */
   /* background: #5851ff; */
   /*margin-top: 5px;*/
   /* box-shadow: 0 2px 5px 0 rgb(0 0 0 / 26%); */
   /* align-items: center;
   }
   .jumbotron {
   padding: 0rem 0rem;
   background-color: unset !important;
   }
   .h2,
   h2 {
   font-size: 1rem;
   }
   .table td,
   .table th { */
   /* padding: 0.75rem; */
   /* vertical-align: top; */
   /* border: 1px solid black !important;
   font-size: 10px;
   color: black;
   }
   label {
   font-weight: 600;
   color: #555;
   }
   body { */
   /* background: red; */
   /* }
   .col-form-label {
   font-size: 10px; */
   /* line-height: 2.5; */
   /* }
   .container {
   font-size: 10px;
   }
   .mb-0 {
   padding: 26px;
   }
   .form-control {
   padding: 0px 0px;
   height: 20px;
   margin-top: 10px;
   }
   .form-group {
   margin-bottom: 0px !important;
   }
   .btn{
   padding: 2px 5px;
   }
   .hide {
   display: none;
   }
   .col{
    max-width: 50%;
   } */
</style>
<?php
$id= $this->uri->segment(3);
   // $bank_id = $_SESSION['bank_id'];
   if(!empty($_POST['registration'])){
   
       //print_r($_POST); die;

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
      foreach($_POST as $key=>$value){
         if(strpos($key,"unit")){
               $unit[$key] = $value;
         }        
     }
 //print_r($unit);
  //die;                                                                                                    
     $components_unit = json_encode($unit);
    $update = $this->db->query("UPDATE bl_requestblood SET request = '$request',dates = '$date', timess = '$time' ,hospital = '$hospital',status = '$status',registration = '$registration', p_name = '$p_name' ,f_name = '$f_name',address = '$address',age = '$age', dob = '$dob' ,blood_group = '$blood_group',gender = '$gender',mobile = '$mobile', phone = '$phone' ,consultant = '$consultant',required_date = '$required_date',required_time = '$required_time', request_by = '$request_by' ,attendent_mobile = '$attendent_mobile',ward = '$ward',bed = '$bed', diagnosis = '$diagnosis', components_unit = '$components_unit' WHERE id = '$id' ");
   //echo $this->db->insert_id();die;
    if($update==true){
   // echo 'hiii';
   // die();
   
      redirect('admin/request/request_form');
   // echo '<script>alert("Your Appointment Booked")</script>';
   } else{
    echo "fail";
   }
   }


   $query = $this->db->query("SELECT * FROM  bl_requestblood WHERE id = '$id'");
   foreach ($query->result() as $row)

   {
      //print_r($row);die();
      $form_data1 = json_decode($row->components_unit);
      //print_obj($form_data1);die();
  foreach ($form_data1 as $key => $value) {
    # code...
      //print_obj($form_data1);die()
  }
      //$user_id = $row->user_id;   
   }

   ?>

<div class="container bg-white shadow rounded mb-3 p-3">
<div class="container-fluid">
<form action = "<?php $_PHP_SELF ?>" method = "POST" >
   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
   <div class="row header">
      <!-- <div class="col-sm-4">
        <?php $n=6;
      function reg($n) {
        $characters = '0123456789qwertyuiopasdfghjklzxcvbnm';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    $registration = reg($n);
    ?> -->
    <div class="col-md-4">
         <div class="form-group">
            <label for="inputEmail3" 
               >Request No :
            </label>
          
               <input
                  type="text" name="request" value="<?php if(isset($row->request)) { echo $row->request;  } ?> "readonly
                  class="form-control"
                  id="inputEmail3"
                  placeholder=""
                  />
            </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
            <label for="inputEmail3" 
               >Date :</label>
               <input
                  type="date"
                  name="date"
                  value="<?php if(isset($row->dates)) { echo $row->dates;  } ?>"
                  class="form-control"
                  id="Date"
                  required=""
                  
                  />
            </div>
         </div>
      <div class="col-md-4">
         <div class="form-group">
            <label for="inputEmail3">
            Time:
            </label>
               <input
                  type="time"
                  name="time"
                  value="<?php if(isset($row->timess)) { echo $row->timess;  } ?>"
                  class="form-control"
                  id="Date"
                  placeholder=""
                  required=""
                  />
            </div>
         </div>
   </div>
      <!-- <div class="col-sm-4">
         <div class="form-group row">
           <label for="inputEmail3" class="col-sm-4 col-form-label"
             >Donor Type :
           </label>
           <div class="col-sm-8">
             <input
               type="text"
               name="donor_type"
               class="form-control"
               id="inputEmail3"
               placeholder=""
             />
           </div>
           <label for="inputEmail3" class="col-sm-4 col-form-label"
             >Patinet name:
           </label>
           <div class="col-sm-8">
             <input
               type="text"
               name="patinet"
               class="form-control"
               id="inputEmail3"
               placeholder=""
             />
           </div>
           <label for="inputEmail3" class="col-sm-4 col-form-label">
             Reg No:
           </label>
           <div class="col-sm-8">
             <input
               type="text"
               name="reg_no"
               class="form-control"
               id="inputEmail3"
               placeholder=""
             />
           </div>
         </div>
         </div>
         
         <div class="col-sm-4">
         <div class="form-group row">
           <label for="inputEmail3" class="col-sm-4 col-form-label"
             >Father's Name:
           </label>
           <div class="col-sm-8">
             <input
               type="text"
               name="f_name"
               class="form-control"
               id="inputEmail3"
               placeholder=""
             />
           </div>
           <label for="inputEmail3" class="col-sm-4 col-form-label"
             >Hospital:
           </label>
           <div class="col-sm-8">
             <input
               type="text"
               name="hospital"
               class="form-control"
               id="inputEmail3"
               placeholder=""
             />
           </div>
           <label for="inputEmail3" class="col-sm-4 col-form-label"
             >Hemoglobin:
           </label>
           <div class="col-sm-8">
             <input
               type="text"
               name="hemoglobin"
               class="form-control"
               id="inputEmail3"
               placeholder=""
             />
           </div>
         </div>
         </div> -->
   </div>
   <div class="row">
   <div class="col-md-12">
      <div class="container">
         <h5 class="text-center text-danger " style="font-size:1.25rem; font-weight:500;">
            Patient Profile Information
         </h5>
         <div class="row">
            <div class="col-sm-3 form-group">
               <label for="inputEmail3" 
                  >Hospital :
               </label>
                  <select class="form-control" name="hospital">
                      <option value="<?php if(isset($user->hospital)) { echo $user->hospital;  } ?>"><?php if(isset($row->hospital)) { echo $row->hospital;  } ?></option>
                     <option>option 1</option>

                  </select>
            </div>
               <div class="col-sm-3 form-group ">
                  <label for="inputEmail3">Status :</label>
                  
                     <select class="form-control" name="status">
                         <option value="<?php if(isset($row->status)) { echo $row->status;  } ?>"><?php if(isset($row->status)) { echo $row->status;  } ?></option>
                         <?php  $query2 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'request_date_status'");
                   foreach ($query2->result() as $request_date_status)
                   {
                       ?>
                       <option value="<?= $request_date_status->master_type_key_value; ?>"><?= $request_date_status->master_type_key_value; ?></option>
                   <?php } ?>
                     </select>
               </div>
            
               <div class="col-sm-3 form-group">
                 
                     <label for="inputEmail3"
                        >Registration No :
                     </label>
                     
                        <input
                           type="text"
                           name="registration"
                            value="<?php if(isset($row->registration)) { echo $row->registration;  } ?>"
                           class="form-control"
                           id="inputEmail3"
                           placeholder=""
                           />
                     </div>
                     <div class="col-sm-3 form-group">
               <label for="inputEmail3" 
                  >Patient Name :
               </label>
                  <input
                     type="text"
                     name="p_name"
                      value="<?php if(isset($row->p_name)) { echo $row->p_name;  } ?>"
                     class="form-control"
                     id="inputEmail3"
                     placeholder=""
                     />
               </div>
                   </div>
                   <div class="row">
            
           
            <div class="col-sm-3 form-group">
               <label for="inputEmail3"
                  >Father's Name :
               </label>
                  <input
                     type="text"
                     name="f_name"
                      value="<?php if(isset($row->f_name)) { echo $row->f_name;  } ?>"
                     class="form-control"
                     id="inputEmail3"
                     placeholder=""
                     />
               </div>
         
            <div class=" col-sm-3 form-group ">
               <label for="inputEmail3"
                  >Address :</label
                  >
                  <input
                     type="text"
                     name="address"
                      value="<?php if(isset($row->address)) { echo $row->address;  } ?>"
                     class="form-control"
                     id="inputEmail3"
                     placeholder=""
                     />
               </div>
               <div class="col-sm-3 form-group">
                     <label for="inputEmail3"
                        >Age :
                     </label>
                     
                        <input
                           type="text"
                           name="age"
                            value="<?php if(isset($row->age)) { echo $row->age;  } ?>"
                           class="form-control"
                           id="inputEmail3"
                           placeholder=""
                           />
               </div>
               <div class="col-sm-3 form-group">
                  <label for="inputEmail3"
                     >Date of Birth :
                  </label>
                 
                     <input
                        type="date"
                        name="dob"
                         value="<?php if(isset($row->dob)) { echo $row->dob;  } ?>"
                        class="form-control"
                        id="inputEmail3"
                        placeholder=""
                        />
                  </div>
                   </div>
                   <div class="row">
              
               
              
                   </div>
              <div class="row">
              <div class="col-sm-3 form-group">
                  <label for="inputEmail3" 
                     >Blood Group :</label
                     >
                 
                     <select class="form-control" name="blood_group">
                         <option value="<?php if(isset($row->blood_group)) { echo $row->blood_group;  } ?>"><?php if(isset($row->blood_group)) { echo $row->blood_group;  } ?></option>
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
               <div class="col-sm-3 form-group">
                  <label for="inputEmail3"
                     >Gender :</label
                     >
                 
                     <select class="form-control" name="gender">
                      <option value="<?php if(isset($row->gender)) { echo $row->gender;  } ?>"><?php if(isset($row->gender)) { echo $row->gender;  } ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                     </select>
               </div>
           
            <div class="col-sm-3 form-group">
               <label for="inputEmail3"
                  >Mobile :
               </label>
                  <input
                     type="tel"
                     name="mobile"
                      value="<?php if(isset($row->mobile)) { echo $row->mobile;  } ?>"
                     class="form-control"
                     id="inputEmail3"
                     placeholder=""
                     />
               </div>
               <div class="form-group col-sm-3">
               <label for="inputEmail3"
                  >Consaltant Name:</label
                  >
                  <input
                     type="text"
                     name="consultant"
                     value="<?php if(isset($row->consultant)) { echo $row->consultant;  } ?>"
                     class="form-control"
                     id="inputEmail3"
                     placeholder=""
                     />
               </div>
           
               </div>
               <div class="row">
               <div class="form-group col-sm-3">
               <label for="inputEmail3"
                  >Consaltant Phone :</label
                  >
                  <input
                     type="tel"
                     name="phone"
                      value="<?php if(isset($row->phone)) { echo $row->phone;  } ?>"
                     class="form-control"
                     id="inputEmail3"
                     placeholder=""
                     />
               </div>
               
               <div class="col-sm-3 form-group">
                  <label for="inputEmail3"
                     >Required date :</label
                     >
                     <input
                        type="date"
                        name="required_date"
                        class="form-control"
                        value="<?php if(isset($row->required_date)) { echo $row->required_date; } ?>"
                        id="inputEmail3"
                        placeholder=""
                        />
               </div>
                 
               <div class="col-sm-3 form-group">
                  <label for="inputEmail3"
                     >Required Time:</label
                     >
                     <input
                        type="time"
                        name="required_time"
                        class="form-control"
                        value="<?php if(isset($row->required_time)) { echo $row->required_time; } ?>"
                        id="inputEmail3"
                        placeholder=""
                        />
                  </div>
                  <div class="form-group col-sm-3">
               <label for="inputEmail3"
                  >Request Entry Done by :</label
                  >
                  <input
                     type="text"
                     name="request_by"
                      value="<?php if(isset($row->request_by)) { echo $row->request_by; } ?>"
                     class="form-control"
                     id="inputEmail3"
                     placeholder=""
                     />
               </div>
                  </div>
                  <div class="row">
            
           
            <div class="form-group col-sm-3">
               <label for="inputEmail3"
                  >Mobile no.(Attendent) :</label
                  >
                  <input
                     type="tel"
                     name="attendent_mobile"
                     value="<?php if(isset($row->attendent_mobile)) { echo $row->attendent_mobile; } ?>"
                     class="form-control"
                     id="inputEmail3"
                     placeholder=""
                     />
               </div>
               <div class="col-sm-3 form-group">
                  <label for="inputEmail3"
                     >Ward No.:</label
                     >
                     <input
                        type="text"
                        name="ward"
                        class="form-control"
                        value="<?php if(isset($row->ward)) { echo $row->ward;  } ?>"
                        id="inputEmail3"
                        placeholder=""
                        />
                  </div>
                  <div class="col-sm-3 form-group">
                  <label for="inputEmail3">
                  Bed no.:
                  </label>
                     <input
                        type="text" name="bed"
                        class="form-control"
                        value="<?php if(isset($row->bed)) { echo $row->bed;  } ?>"
                        id="inputEmail3"
                        placeholder=""
                        />
               </div>
            <div class="col-sm-3 form-group">
                  <label for="inputEmail3"
                     >Diagnosis:
                  </label>
                     <select class="form-control" name="diagnosis" >
                          <option value="<?php if(isset($row->diagnosis)) { echo $row->diagnosis;  } ?>"><?php if(isset($row->diagnosis)) { echo $row->diagnosis;  } ?></option>
                       <?php 
                   $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'diagnosis_types'");
                   foreach ($query1->result() as $diagnosis_types)
                   {
                       ?>
                       <option value="<?= $diagnosis_types->master_type_key_value; ?>"><?= $diagnosis_types->master_type_key_value; ?></option>
                   <?php } ?>
                     </select>
            </div>
            </div>
        
   
     
         
                       
         </div>
      </div>
   </div>
                   <div class="col-md-12 pb-5">
   <div class="container">
                   <h5 class="text-danger pt-2" style="font-size:1.25rem; font-weight:500;text-align: center;">Component</h5>
                   <div class="row">
                   <div class="form-group col-sm-4">
                              <label
                                 for="inputEmail3"
                                 >Whole Blood
                              </label>
                              <input
                                    type="number" name="whole_blood_unit" class="form-control"  value="<?php if(isset($form_data1->whole_blood_unit)) { echo $form_data1->whole_blood_unit;  } ?>"
                                    id="inputEmail3"
                                    placeholder=""
                                    />
                   </div>
                   <div class="form-group col-sm-4">
                              <label
                                 for="inputEmail3"
                                 >Cryo Poor Plasma
                              </label>
                              <input
                                    type="number" name="Cryo_Poor_Plasma_unit" class="form-control"  value="<?php if(isset($form_data1->Cryo_Poor_Plasma_unit)) { echo $form_data1->Cryo_Poor_Plasma_unit;  } ?>"
                                    id="inputEmail3"
                                    placeholder=""
                                    />
                   </div>
                   
                   <div class="form-group col-sm-4">
                              <label
                                 for="inputEmail3"
                                 >Cryoprecipitate
                              </label>
                              <input
                                    type="number" name="Cryoprecipitate_unit" class="form-control"  value="<?php if(isset($form_data1->Cryoprecipitate_unit)) { echo $form_data1->Cryoprecipitate_unit;  } ?>"
                                    id="inputEmail3"
                                    placeholder=""
                                    />
                   </div>
                   </div>
                   <div class="row">
                   <div class="form-group col-sm-4">
                              <label
                                 for="inputEmail3"
                                 >Fresh Frozen Plasma
                              </label>
                              <input
                                    type="number" name="Fresh_Frozen_Plasma_unit" class="form-control"  value="<?php if(isset($form_data1->Fresh_Frozen_Plasma_unit)) { echo $form_data1->Fresh_Frozen_Plasma_unit;  } ?>"
                                    id="inputEmail3"
                                    placeholder=""
                                    />
                   </div>
                 
                   <div class="form-group col-sm-4">
                              <label
                                 for="inputEmail3"
                                 >Red blood cell
                              </label>
                              <input
                                    type="number" name="Red_blood_cell_unit" class="form-control"  value="<?php if(isset($form_data1->Red_blood_cell_unit)) { echo $form_data1->Red_blood_cell_unit;  } ?>"
                                    id="inputEmail3"
                                    placeholder=""
                                    />
                   </div>
                   <div class="form-group col-sm-4">
                              <label
                                 for="inputEmail3"
                                 >Platelet rich concentrate
                              </label>
                              <input
                                    type="number" name="Platelet_rich_concentrate_unit" class="form-control"  value="<?php if(isset($form_data1->Platelet_rich_concentrate_unit)) { echo $form_data1->Platelet_rich_concentrate_unit;  } ?>"
                                    id="inputEmail3"
                                    placeholder=""
                                    />
                   </div>
                   </div>



            <!-- <table class="table">
               <thead>
                  <tr>
                     <th scope="col" class="col">Component</th>
                     <th scope="col" class="col">unit</th>
                  </tr>
               </thead>
 <tbody>   
                  <tr>
                     
                     <td>
                        <div class="col-sm-12 form-group">
                           <div class="form-group row">
                              <label
                                 for="inputEmail3"
                                 class="col-sm-4 col-form-label" style="text-align: center;"
                                 >Whole Blood
                              </label>
                           </div>
                        </div>
                     </td>
                     <td>
                        <div class="col-sm-12 form-group">
                           <div class="form-group row">
                              <div class="col-sm-4" style="text-align: center;">
                                 <input
                                    type="number" name="whole_blood_unit" class="form-control"  value="<?php if(isset($form_data1->whole_blood_unit)) { echo $form_data1->whole_blood_unit;  } ?>"
                                    id="inputEmail3"
                                    placeholder=""
                                    />
                              </div>
                           </div>
                        </div>
                     </td>
                    
                  </tr> 
                                    <tr>
                     
                     <td>
                        <div class="col-sm-12 form-group">
                           <div class="form-group row">
                              <label
                                 for="inputEmail3"
                                 class="col-sm-4 col-form-label" style="text-align: center;"
                                 >Cryo Poor Plasma
                              </label>
                           </div>
                        </div>
                     </td>
                     <td>
                        <div class="col-sm-12 form-group">
                           <div class="form-group row">
                              <div class="col-sm-4" style="text-align: center;">
                                 <input
                                    type="number" name="Cryo_Poor_Plasma_unit" class="form-control"  value="<?php if(isset($form_data1->Cryo_Poor_Plasma_unit)) { echo $form_data1->Cryo_Poor_Plasma_unit;  } ?>"
                                    id="inputEmail3"
                                    placeholder=""
                                    />
                              </div>
                           </div>
                        </div>
                     </td>
                    
                  </tr>
                                    <tr>
                     
                     <td>
                        <div class="col-sm-12 form-group">
                           <div class="form-group row">
                              <label
                                 for="inputEmail3"
                                 class="col-sm-4 col-form-label" style="text-align: center;"
                                 >Cryoprecipitate
                              </label>
                           </div>
                        </div>
                     </td>
                     <td>
                        <div class="col-sm-12 form-group">
                           <div class="form-group row">
                              <div class="col-sm-4" style="text-align: center;">
                                 <input
                                    type="number" name="Cryoprecipitate_unit" class="form-control"  value="<?php if(isset($form_data1->Cryoprecipitate_unit)) { echo $form_data1->Cryoprecipitate_unit;  } ?>"
                                    id="inputEmail3"
                                    placeholder=""
                                    />
                              </div>
                           </div>
                        </div>
                     </td>
                    
                  </tr>
                                    <tr>
                     
                     <td>
                        <div class="col-sm-12 form-group">
                           <div class="form-group row">
                              <label
                                 for="inputEmail3"
                                 class="col-sm-4 col-form-label" style="text-align: center;"
                                 >Fresh Frozen Plasma
                              </label>
                           </div>
                        </div>
                     </td>
                     <td>
                        <div class="col-sm-12 form-group">
                           <div class="form-group row">
                              <div class="col-sm-4" style="text-align: center;">
                                 <input
                                    type="number" name="Fresh_Frozen_Plasma_unit" class="form-control"  value="<?php if(isset($form_data1->Fresh_Frozen_Plasma_unit)) { echo $form_data1->Fresh_Frozen_Plasma_unit;  } ?>"
                                    id="inputEmail3"
                                    placeholder=""
                                    />
                              </div>
                           </div>
                        </div>
                     </td>
                    
                  </tr>
                                    <tr>
                     
                     <td>
                        <div class="col-sm-12 form-group">
                           <div class="form-group row">
                              <label
                                 for="inputEmail3"
                                 class="col-sm-4 col-form-label" style="text-align: center;"
                                 >Red blood cell
                              </label>
                           </div>
                        </div>
                     </td>
                     <td>
                        <div class="col-sm-12 form-group">
                           <div class="form-group row">
                              <div class="col-sm-4" style="text-align: center;">
                                 <input
                                    type="number" name="Red_blood_cell_unit" class="form-control"  value="<?php if(isset($form_data1->Red_blood_cell_unit)) { echo $form_data1->Red_blood_cell_unit;  } ?>"
                                    id="inputEmail3"
                                    placeholder=""
                                    />
                              </div>
                           </div>
                        </div>
                     </td>
                    
                  </tr>
                                    <tr>
                     
                     <td>
                        <div class="col-sm-12 form-group">
                           <div class="form-group row">
                              <label
                                 for="inputEmail3"
                                 class="col-sm-4 col-form-label" style="text-align: center;"
                                 >Platelet rich concentrate
                              </label>
                           </div>
                        </div>
                     </td>
                     <td>
                        <div class="col-sm-12 form-group">
                           <div class="form-group row">
                              <div class="col-sm-4" style="text-align: center;">
                                 <input
                                    type="number" name="Platelet_rich_concentrate_unit" class="form-control"  value="<?php if(isset($form_data1->Platelet_rich_concentrate_unit)) { echo $form_data1->Platelet_rich_concentrate_unit;  } ?>"
                                    id="inputEmail3"
                                    placeholder=""
                                    />
                              </div>
                           </div>
                        </div>
                     </td>
                    
                  </tr>

               </tbody>
            </table> -->
            <!--  <table class="table">
               <thead>
                 <tr>
                   <th scope="col">#</th>
                   <th scope="col">First</th>
                   <th scope="col">Last</th>
                   <th scope="col">Handle</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <th scope="row">1</th>
                   <td>Mark</td>
                   <td>Otto</td>
                   <td>@mdo</td>
                 </tr>
                 <tr>
                   <th scope="row">2</th>
                   <td>Jacob</td>
                   <td>Thornton</td>
                   <td>@fat</td>
                 </tr>
                 <tr>
                   <th scope="row">3</th>
                   <td colspan="2">Larry the Bird</td>
                   <td>@twitter</td>
                 </tr>
               </tbody>
               </table> -->
            <div class="row float-right">
               <div class="col-sm-4 form-group">
                  <button  type="cancel" class="btn btn-danger">Reset</button>
               </div>
               <div class="col-sm-4 form-group">
                  <button type="submit" class="btn btn-danger ">Submit</button>
               </div>
            </div>
         </div>
                   </div>
</form>
</div>
</div>
</div>