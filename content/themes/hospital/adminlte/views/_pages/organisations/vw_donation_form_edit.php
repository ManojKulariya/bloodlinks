<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://codepen.io/skjha5993/pen/bXqWpR.css">
<style>
   .hide {
   display: none;
   }
   .form-control {
   height: 28px;
   font-size: 13px;
   }
   .row{
   margin-bottom:-9px !important;
   }
   label {
   margin-bottom: 0;
   font-size: 12px;
   }
   .content-header h1 {
    font-size: 18px;
    margin: 0 6px;
    font-weight: bold;
}
.form-group {
    margin-bottom: 5px;
}
.col-form-label {
    padding-top: 0;
    padding-bottom: 0;
    font-size: 12px;
  }
  .btn-danger {
    padding: 2px 10px;
}

</style>
<?php
   $id= $this->uri->segment(3);
   
      if(!empty($_POST['registration'])){
   
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
        $awaited = $_POST['awaited'];
        $office_phone = $_POST['office_phone'];
        $sp_volume = $_POST['sp_volume'];
        $previous = $_POST['previous'];
        $date = $_POST['date'];
        $donation_place = $_POST['donation_place'];
        $due_date = $_POST['due_date'];
        $camp = $_POST['camp'];
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
             
                $update = $this->db->query("UPDATE bl_bb_donatioform SET registration = '$registration' , donor_type = '$donor_type', hemoglobin = '$hemoglobin', unit_no = '$unit', mobile = '$mobile', donor_name = '$donor_name', father = '$father', blood_group = '$blood', birth = '$birth', age = '$age', sex = '$sex', address = '$address', place = '$place', city = '$city', awaited = '$awaited', office_phone = '$office_phone', sp_volume = '$sp_volume', previous = '$previous', date = '$date' , donation_place = '$donation_place', due_date = '$due_date', camp = '$camp', donation_date = '$donation',  time = '$time', bag = '$bag', tube = '$tube', bp = '$bp', weight = '$weight', hct = '$hct', pet = '$pet', patient_requestno = '$patient_requestno', patient_name = '$patient_name', hospital = '$hospital', registration_no = '$registration_no'  WHERE id = '$id'");
                   if($update==true){
       // echo 'hiii';
       // die();
       
        redirect('admin/donation_forms');
     // echo '<script>alert("Your Appointment Booked")</script>';
      } else{
      echo "fail";
      }
   }
   
    $query = $this->db->query("SELECT * FROM  bl_bb_donatioform WHERE id = $id");
   foreach ($query->result() as $row)
   {
     //print_r($row);die();
   }
   
    ?>
<div class="container">
<form class="main1" action = "<?php $_PHP_SELF ?>" method = "POST">
   <?php if (!empty($row->camp_name)){?>
   <div class="row">
      <div class="col-sm-6 form-group">
         <div class="form-group row">
            <label for="inputEmail3" class="col-sm-4 col-form-label">Blood Camp Name: </label>
            <div class="col-sm-8">
               <input type="text" class="form-control" id="inputEmail3" name="camp_name" placeholder="" value="<?=$row->camp_name ?>">
            </div>
         </div>
      </div>
      <div class="col-sm-6 form-group row">
         <label for="inputEmail3" class="col-sm-4 col-form-label">Blood Camp Code: </label>
         <div class="col-sm-8">
            <input type="text" class="form-control"  id="inputEmail3" name="camp_code" placeholder="" value="<?=$row->camp_code ?>">
         </div>
      </div>
   </div>
   <?php } ?>
   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
   <div class="contanier bg-white rounded shadow mt-4 mb-4 pt-2 pb-4">
      <div class="row header pl-2 pr-2">
         <div class="col-sm-3">
            <div class="form-group">
               <label for="inputEmail3" >Registration No: </label>
               <input type="text" class="form-control" name="registration" id="inputEmail3" value="<?=$row->registration ?>" placeholder="">
            </div>
         </div>
         <div class="col-sm-3">
            <div class="form-group">
               <label for="inputEmail3" >Donor Type : </label>
               <select class="form-control" id="inputEmail3" name="donor_type" 
                  style="padding:0px !important;">
                  <option value="<?=$row->donor_type ?>"><?=$row->donor_type ?></option>
                  <?php 
                     $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'donar_types'");
                     
                     foreach ($query1->result() as $reasion)
                     {
                      ?>
                  <option value="<?= $reasion->master_type_key_value; ?>"><?= $reasion->master_type_key_value; ?></option>
                  <?php } ?>
               </select>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="form-group">
               <label for="inputEmail3" >Hemoglobin: </label>
               <input type="text" class="form-control" id="inputEmail3" name="hemoglobin" placeholder="" value="<?=$row->hemoglobin ?>">
            </div>
         </div>
         <div class="col-sm-3">
            <div class="form-group">
               <label for="inputEmail3" >Unit No:  </label>
               <input type="text" class="form-control" name="unit" value="<?=$row->unit_no ?>"text id="inputEmail3" placeholder="">
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="container" >
               <h5 class="text-center text-danger mt-2 mb-1">Donor Profile Information</h5>
               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Donor Name:  </label>
                        <input type="text" class="form-control" id="inputEmail3" name="donor_name"  value="<?=$row->donor_name ?>"placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3" >Father's Name: </label>
                        <input type="text" class="form-control" id="inputEmail3" name="father" value="<?=$row->father ?>" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3" >Address</label>
                        <input type="text" class="form-control" id="inputEmail3" placeholder="" name="address" value="<?=$row->address ?>" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Mobile No: </label>
                        <input type="text" class="form-control" id="inputEmail3" name="mobile" value="<?=$row->mobile ?>"placeholder="">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3" >Blood Group:</label>
                        <select class="form-control" id="inputEmail3" name="blood" 
                           style="padding:0px !important;">
                           <option value="<?=$row->blood_group ?>"><?=$row->blood_group ?></option>
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
                        <input type="date" name="birth" value="<?=$row->birth ?>"class="form-control" id="Date" placeholder="" >
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Age: </label>
                        <input type="number" class="form-control" id="inputEmail3" name="age" value="<?=$row->age ?>" placeholder="">
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="inputEmail3">Sex </label>
                        <select class="form-control" id="inputEmail3" name="sex" 
                           style="padding:0px !important;">
                           <option value="<?=$row->sex ?>"><?=$row->sex ?></option>
                           <option value="male">Male</option>
                           <option value="female">Female</option>
                           <option value="other">Other</option>
                           <!--              <option value="male" <?php if($user->gender=="male") echo 'selected="selected"'; ?>>Male</option>
                              <option value="female"<?php if($user->gender=="female") echo 'selected="selected"'; ?>>Female</option>
                              <option value="other"<?php if($user->gender=="other") echo 'selected="selected"'; ?>>Other</option> -->
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3 form-group">
                     <label for="inputEmail3" >Place of Donation</label>
                     <input type="text" class="form-control" id="inputEmail3" name="place" value="<?=$row->place ?>"placeholder="">
                  </div>
                  <div class="col-sm-3 form-group">
                     <label for="inputEmail3" >Donation City</label>
                     <input type="text" class="form-control"  name="city" value="<?=$row->city ?>" id="inputEmail3" placeholder="">
                  </div>
                  <div class="col-sm-3 form-group">
                     <label for="address-2">Previous Donated
                     </label>
                     <select class="form-control" id="inputEmail3" name="previous" 
                        style="padding:0px !important;">
                        <option value="<?=$row->previous ?>"><?=$row->previous ?></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                     </select>
                  </div>
               </div>
               <div class="row justify-content-center">
                  <h5 class="text-danger mt-3 mb-1">
                  Bag and Replacement Details</h4>
               </div>
               <div class="row">
                  <div class="col-sm-3 form-group">
                     <label for="inputEmail3">Donation Date:</label>
                     <input type="date" class="form-control" id="Date" name="donation" value="<?=$row->donation_date ?>">
                  </div>
                  <div class="form-group col-sm-3">
                     <label for="inputEmail3">
                     Time </label>
                     <input type="time" name="time" value="<?=$row->time ?>" class="form-control" id="Date" >
                  </div>
                  <div class="col-sm-3 form-group">
                     <label for="inputEmail3">Bag Type:  </label>
                     <select class="form-control" id="inputEmail3" name="bag" 
                        style="padding:0px !important;">
                        <option value="<?=$row->bag ?>"><?=$row->bag ?></option>
                        <?php 
                           $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'bag_types'");
                           foreach ($query1->result() as $bag)
                           {
                            ?>
                        <option value="<?= $bag->master_type_key_value; ?>"><?= $bag->master_type_key_value; ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="col-sm-3 form-group">
                     <label for="inputEmail3">Tube no: </label>
                     <input type="text" class="form-control" id="inputEmail3" name="tube" placeholder="" value="<?=$row->tube ?>">
                  </div>
               </div>
               <!-- <div class="col-sm-4 form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">Bag Type:  </label>
                  <div class="col-sm-8">
                    <select class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                  </div>
                  </div> -->
               <div class="row">
                  <div class="col-sm-3 form-group">
                     <label for="inputEmail3">BP   </label>
                     <input type="text" class="form-control" id="inputEmail3" name="bp" placeholder="" value="<?=$row->bp ?>">
                  </div>
                  <div class="col-sm-3 form-group">
                     <label for="inputEmail3">Weight  </label>
                     <input type="text" class="form-control" id="inputEmail3" name="weight" placeholder="" value="<?=$row->weight ?>">
                  </div>
                  <div class="col-sm-3 form-group">
                     <label for="inputEmail3">HCT    </label>
                     <input type="text" class="form-control" id="inputEmail3" name="hct" placeholder="" value="<?=$row->hct ?>">
                  </div>
                  <div class="col-sm-3 form-group">
                     <label for="inputEmail3">PET </label>
                     <input type="text" class="form-control" id="inputEmail3" name="pet" placeholder="" value="<?=$row->pet ?>">
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-3 form-group">
                     <label for="inputEmail3">Patient Request No.  </label>
                     <input type="text" class="form-control" id="inputEmail3" name="patient_requestno" placeholder="" value="<?=$row->patient_requestno ?>">
                  </div>
                  <div class="col-sm-3 form-group">
                     <label for="inputEmail3">Patient Name  </label>
                     <input type="text" class="form-control" id="inputEmail3" name="patient_name" placeholder="" value="<?=$row->patient_name ?>">
                  </div>
                  <div class="form-group col-sm-3">
                     <label for="inputEmail3">Hospital  </label>
                     <input type="text" class="form-control" id="inputEmail3" name="hospital" placeholder="" value="<?=$row->hospital ?>">
                  </div>
                  <div class="form-group col-sm-3">
                     <label for="inputEmail3">Registration No. </label>
                     <input type="text" class="form-control" id="inputEmail3" name="registration_no" placeholder="" value="<?=$row->registration_no ?>">
                  </div>
               </div>
               <div class="row float-right mt-2">
                  <div class="col-sm-6 form-group mb-0">
                     <button type="cancel" class="btn btn-danger float-right">Reset</button>
                  </div>
                  <div class="col-sm-6 form-group mb-0">
                     <button type="submit" class="btn btn-danger float-right">Submit</button>
                  </div>
               </div>
               <!-- <div class="row">
                  <div class="col-sm-3 form-group">
                     <label for="Blood">Awaited NAT</label>
                     <select class="form-control" id="inputEmail3" name="awaited" 
                        style="padding:0px !important;">
                        <option value="<?=$row->awaited ?>"><?=$row->awaited ?></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                     </select>
                  </div>
                  <div class="col-sm-3 form-group ">
                     <label for="State">Office Phone</label>
                     <input type="text" class="form-control" name="office_phone" placeholder="" value="<?=$row->office_phone ?>">
                  </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-sm-3 form-group">
                  <label for="zip">
                  Sp.Vol.Donor </label>
                  <input type="text" class="form-control"  name="sp_volume" placeholder="" value="<?=$row->sp_volume ?>">
                  </div>
                  
                  <div class="col-sm-3 form-group">
                  <label for="State">Date </label>
                  <input type="date" class="form-control" id="Date" name="date" value="<?=$row->date ?>">
                  </div>
                  
                  </div>
                  <div class="row">
                  
                  <div class="col-sm-4 ">
                  <div class="form-group ">
                     <label for="inputEmail3">Due Date</label>
                     <input type="date" class="form-control" id="inputEmail3" name="due_date" value="<?=$row->due_date ?>">
                  </div>
                  </div>
                  <div class="col-sm-4 ">
                  <div class="form-group">
                     <label for="inputEmail3">Camp Code:</label>
                     <select class="form-control" id="inputEmail3" name="camp" 
                        style="padding:0px !important;">
                        <option value="<?=$row->camp ?>"><?=$row->camp ?></option>
                        <?php 
                     $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'camp_codes'");
                     foreach ($query1->result() as $camp)
                     {
                      ?>
                        <option value="<?= $camp->master_type_key_value; ?>"><?= $camp->master_type_key_value; ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  </div>
                  </div> -->
</form>
</div>
</div> 
</div>
</div>