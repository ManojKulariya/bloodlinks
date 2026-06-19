<style type="text/css">
  .form-control {
    height: 25px !important;
    padding: 0 14px !important;
    font-size: 14px !important;
}
label {
    margin-bottom: 0;
    font-size: 12px;
}
.card-body {
    padding: 10px 20px 0;
}
.content-header h1 {
    font-size: 18px;
    margin: 0 6px;
    font-weight: bold;
}
.page-item.active .page-link {
    background-color: #ad1e1d !important;
    border-color: #ad1e1d !important;
}
.content-wrapper {
    background: #fff;
        text-transform: capitalize;
}
.card-footer {
    padding: 18px 0 10px;
    background-color: #fff;
  }
  table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
     padding-right: 15px; 
    font-size: 12px;
}
table.dataTable tbody th, table.dataTable tbody td {
    padding: 6px !important;
    font-size: 14px;
}
.btn-xs {
    padding: 2px;
    font-size: 10px;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 0 15px !important;
}
.form-group {
    margin-bottom: 0;
}
.page-link {
    color: #000000;
}
.capitalize{
  text-transform: capitalize;
}
.card-body {
    padding: 0 10px;
}
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed');

$master_data = $this->db->query("SELECT * FROM bl_masters  WHERE master_type_name = 'Components Types'");
$master = $master_data->result();
?>
<div class="container">
    <form action = "<?php $_PHP_SELF ?>" method = "POST">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

        <div class="timeline">
            <!-- <div class="time-label">
                <span class="bg-red">Consumables Items</span>
              </div> -->
              <div class="card">
             
                <div class="card-body">
 
    
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Appointment Id</label>
                                <input type="text" class="form-control" id="price" name="appointment_id" value="<?php if(isset($_POST) && isset($_POST['appointment_id'])){ echo $_POST['appointment_id']; } ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">User Id</label>
                                <input type="text" class="form-control" id="price" name="user_id" value="<?php if(isset($_POST) && isset($_POST['user_id'])){ echo $_POST['user_id']; } ?>">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Name</label>
                                <input type="text" class="form-control" id="price" name="name" value="<?php if(isset($_POST) && isset($_POST['name'])){ echo $_POST['name']; } ?>">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                 <label for="description">Form Status</label>
                                <select name="form_status" id="vender" class="form-control">
                                <option disabled="disabled" selected="selected" value="">Select</option>          
			<option value="accepted" <?php if(isset($_POST) && isset($_POST['form_status'])){  if($_POST['form_status'] == 'accepted') {echo"selected='selected'";} } ?>>Accepted</option>
          <option value="not accepted"  <?php if(isset($_POST) && isset($_POST['form_status'])){  if($_POST['form_status'] == 'not accepted') {echo"selected='selected'";} } ?>>Not Accepted</option>
        
                                </select>
                            </div>
                        </div>
                    </div>
                         <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Mobile No</label>
                                <input type="tel" class="form-control" id="price" name="mobile" value="<?php if(isset($_POST) && isset($_POST['mobile'])){ echo $_POST['mobile']; } ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Blood Group</label>
                                <select name="blood_group" id="vender" class="form-control">
                                <option disabled="disabled" selected="selected" value="">Select</option>            
					<option value="A+" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'A+') {echo"selected='selected'";} } ?>>A+</option>
                    <option value="A-" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'A-') {echo"selected='selected'";} } ?>>A-</option>
                    <option value="B+" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'B+') {echo"selected='selected'";} } ?>>B+</option>
                    <option value="B-" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'B-') {echo"selected='selected'";} } ?>>B-</option>
                    <option value="AB+" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'AB+') {echo"selected='selected'";} } ?>>AB+</option>
                    <option value="AB-" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'AB-') {echo"selected='selected'";} } ?>>AB-</option>
                    <option value="O+" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'O+') {echo"selected='selected'";} } ?>>O+</option>
                    <option value="O-" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'O-') {echo"selected='selected'";} } ?>>O-</option>
              

        
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Start Date</label>
                                <input type="date" class="form-control" id="price" name="start_date" value="<?php if(isset($_POST) && isset($_POST['start_date'])){ echo $_POST['start_date']; } ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">End Date</label>
                                <input type="date" class="form-control" id="price" name="end_date" value="<?php if(isset($_POST) && isset($_POST['end_date'])){ echo $_POST['end_date']; } ?>">
                            </div>
                        </div>
                    </div>
                                        <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Donor Type</label>
                                <select name="donor_type" id="vender" class="form-control">
                                <option disabled="disabled" selected="selected" value="">Select</option>           
          <option value="Regular" <?php if(isset($_POST) && isset($_POST['donor_type'])){  if($_POST['donor_type'] == 'Regular') {echo"selected='selected'";} } ?>>Regular</option>
          <option value="Replacement" <?php if(isset($_POST) && isset($_POST['donor_type'])){  if($_POST['donor_type'] == 'Replacement') {echo"selected='selected'";} } ?>>Replacement</option>
        
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                               
                                 <label for="description">Application Id</label>
<input type="text" class="form-control" id="price" name="application_id" value="<?php if(isset($_POST) && isset($_POST['application_id'])){ echo $_POST['application_id']; } ?>">
                            </div>
                        </div>
                 
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Components Required</label>
                               <input type="text" class="form-control" id="price" name="Components" value="<?php if(isset($_POST) && isset($_POST['Components'])){ echo $_POST['Components']; } ?>">
                            </div>
                        </div>
                          <div class="col-sm-3">
                      <div class="form-group">
                        <label for="vender" >Hospital:</label>
                         <select class="form-control" name="hospital">
                             <option disabled="disabled" selected="selected" value="" style="margin:0px !important;">Select</option>
                    
                     <?php 
                   $query3 = $this->db->query("SELECT * FROM bl_blood_banks where org_type = 'Hospital'");
                   foreach ($query3->result() as $hospitals)
                   {?>
                       <option value="<?= $hospitals->name; ?>" <?php if(isset($_POST) && isset($_POST['hospital'])){  if($_POST['hospital'] == $hospitals->name) {echo"selected='selected'";} } ?>><?= $hospitals->name; ?></option>
                   <?php } ?>
                  </select>
                      </div>
                    </div>

                    </div>
                    
                                                          <div class="row">

              
                 
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">City</label>
                               <input type="text" class="form-control" id="price" name="city" value="<?php if(isset($_POST) && isset($_POST['city'])){ echo $_POST['city']; } ?>">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">User</label>
                                <select name="user" id="vender" class="form-control">
                                <option value="#" selected disabled>Select</option>  
                                       
                                                <?php 
            $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user");
           foreach ($query1->result() as $typeu)
           {
              ?>
          <option value="<?= $typeu->name; ?>"  <?php if(isset($_POST) && isset($_POST['user'])){  if($_POST['user'] == $typeu->name) {echo"selected='selected'";} } ?>><?= $typeu->name; ?></option>
            <?php } ?>
                                </select>
                            </div>
                        </div>
                          <div class="col-md-3">
                  <div class="form-group">
                     <label for="description">Blood Bank</label>
                     <select name="blood_bank" id="vender" class="form-control">
                      <option value="#" selected  disabled>Select</option>
                         <?php 
                           $query12 = $this->db->query("SELECT * FROM bl_blood_banks");
                           foreach ($query12->result() as $types)
                           {
                             ?>
                        
                        <option value="<?= $types->name; ?>" <?php if(isset($_POST) && isset($_POST['blood_bank'])){  if($_POST['blood_bank'] == $types->name) {echo"selected='selected'";} } ?>><?= $types->name; ?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
                                     <div class="col-md-3">
                    <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                            <button type="submit" name="submit" class="btn btn-sm btn-danger" >Filter</button>
                         <button class="btn btn-sm btn-warning mx-2 text-white" id="reset" name="reset" type="submit"/>         Reset</button>              

						</div>
                    </div>
                  </div>
                </div>
                   </div>
              </div>
            </form>
          </div>

         <!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>-->

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
  <div style="overflow-x:auto;">
<table class="table table-fluid" id="myTable">
<thead>
<tr>
  <th>S No</th>
  <th>Appointment Id</th>
  <th>User Id</th>
   <th>Blood Bank Name</th>
  <th>Blood Bank Code</th>
  <th>Blood Bank City</th>
  <th>Name</th>
  <th>Date</th>
  <th>Status</th>
  <th>Mobile No</th>
  <th>Application Id</th>
  <th>Donar Type</th>
  <th>Blood Group</th>
  <th>City</th>
  <th>Components Required</th>
  <th>Hospital</th>
  <th>User</th>
                    <?php 
   if ($_SESSION['admin_type'] =='0') {
$servies_per = $_SESSION['bloodbank_user_servies_permission'];
        $per = json_decode($servies_per);

        if ($per->Request_permission  =='Write') {
             
   ?>
   <th>Action</th>
<?php }
}else{?>
 <th>Action</th>
<?php } ?>
 
</tr>
</thead>
<tbody>
<?php
      $no=0;
   if(!empty($_POST)){

        //print_r($_POST); die;
        if (isset($_POST['user'])) {
          $user = $_POST['user'];
        }
        if (isset($_POST['donor_type'])) {
          $donor_type = $_POST['donor_type']; 
        }
        if (isset($_POST['blood_group'])) {
          $blood_group = $_POST['blood_group'];
        }
        if (isset($_POST['form_status'])) {
          $form_status = $_POST['form_status']; 
        }
        if (isset($_POST['blood_bank'])) {
            $blood_bank = $_POST['blood_bank'];
            }
            if (isset($_POST['hospital'])) {
            $hospital = $_POST['hospital'];
            }
     $appointment_id = $_POST['appointment_id']; 
     $user_id = $_POST['user_id']; 
     $name = $_POST['name']; 
     $mobile = $_POST['mobile']; 
     $start_date = $_POST['start_date']; 
     $end_date = $_POST['end_date']; 
     $application_id = $_POST['application_id']; 
     $Components = $_POST['Components'];  
     $city = $_POST['city']; 
     

        if (!empty($appointment_id) && !empty($user_id) && !empty($donor_type) && !empty($mobile) && !empty($name) && !empty($application_id) && !empty($hospital) && !empty($blood_bank) && !empty($user) && !empty($Components) && !empty($blood_group) && !empty($donation_type) && (!empty($start_date) && !empty($end_date))) {

          $query = $this->db->query("SELECT bl_blood_request.* ,bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name FROM bl_blood_request INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_blood_request.org_id INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id WHERE requested_schedule_date BETWEEN '$start_date' AND '$end_date' AND  bl_blood_request.id = '$appointment_id' And bl_blood_request.user_id = '$user_id' And bl_blood_request.p_name = '$name' And bl_blood_request.approved_status = '$form_status' And bl_blood_request.phone = '$mobile' And bl_blood_request.blood_group = '$blood_group' And bl_blood_request.issuer_name = '$user' And bl_blood_request.hospital = '$hospital' And bl_blood_request.application_no = '$application_id' And bl_blood_banks.name = '$blood_bank' ORDER BY ID DESC");
  
      }else{
$search='';
        if(!empty($appointment_id)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_blood_request.id LIKE '%$appointment_id%'";
        }
		if(!empty($user_id)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_blood_request.unit_no LIKE '%$user_id%'";
        }
		if(!empty($blood_group)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_blood_request.blood_group LIKE '%$blood_group%'";
        }
		if(!empty($name)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_blood_request.p_name LIKE '%$name%'";
        }
		if(!empty($application_id)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_blood_request.application_no LIKE '%$application_id%'";
        }
		if(!empty($user)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_blood_request.issuer_name LIKE '%$user%'";
        }
		
		if(!empty($mobile)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_blood_request.phone LIKE '%$mobile%'";
       }
	   if(!empty($form_status)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_blood_request.approved_status LIKE '%$form_status%'";
        
         }
		 if(!empty($blood_bank)){
            if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .="bl_blood_banks.name LIKE '%$blood_bank%'";
 }
 if(!empty($hospital)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_blood_request.hospital LIKE '%$hospital%'";


        }
		if(!empty($start_date) && empty($end_date)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "requested_schedule_date = '$start_date'";
        }
		
		if(empty($start_date) && !empty($end_date)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "requested_schedule_date = '$end_date'";
        }if(!empty($start_date) && !empty($end_date)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "requested_schedule_date BETWEEN '$start_date' AND '$end_date'";
        }
$querySearch='';
			if(!empty($search)){
			$querySearch=' WHERE '. $search;
			}
         $query = $this->db->query("SELECT bl_blood_request.* ,bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name FROM bl_blood_request INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_blood_request.org_id INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id  $querySearch ORDER BY ID DESC");

      }
    }else{
       $query = $this->db->query("SELECT bl_blood_request.* ,bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name FROM bl_blood_request INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_blood_request.org_id INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id ORDER BY ID DESC"); }
             foreach ($query->result() as $row) {
           
               
                $no++;
              // print_r($row);
         ?>

              <tr>
                  <th scope="row"><?=$no ?></th>
                  <td class="capitalize"><?=$row->id ?></td>
                  <td class="capitalize"><?=$row->user_id ?></td>
                  <td style="text-transform: capitalize;"><?=$row->name ?></td>
                  <td style="text-transform: capitalize;"><?=$row->blood_bank_id ?></td>
                  <td style="text-transform: capitalize;"><?=$row->city_name ?></td>
                  <td class="capitalize"><?=$row->p_name ?></td>
                  <td class="capitalize"><?=$row->required_date ?></td>
                  <td class="capitalize"><?=$row->approved_status ?></td>                 
                  <td class="capitalize"><?=$row->phone ?></td>
                  <td class="capitalize"><?=$row->application_no ?></td>
                  <td></td>
                  <td class="capitalize"><?=$row->blood_group ?></td>
                  <td></td>
                  <!--<?php $components_unit = json_decode($row->components_unit); ?>-->
                  <td class="capitalize">
                      <?php 
                if( $row->components_unit == "wholeblood" ){
                    echo $row->components_unit;
                }else{
                     foreach($master as $mdata) { 
                        if( $row->components_unit  == $mdata->master_id){
                            echo $mdata->master_type_key_short_value;
                    
                        }
                    
                    }
                }
               
                ?>
                      <!--WB:<?=$components_unit->whole_blood_unit ?>, CPP:<?=$components_unit->Cryo_Poor_Plasma_unit ?>, -->
                      <!--CRYO:<?=$components_unit->Cryoprecipitate_unit ?>, FFP:<?=$components_unit->Fresh_Frozen_Plasma_unit ?>,-->
                      <!--RBC:<?=$components_unit->Red_blood_cell_unit ?>, PRC:<?=$components_unit->Platelet_rich_concentrate_unit ?>-->
                </td>
                  <td class="capitalize"><?=$row->hospital ?></td>
                  <td class="capitalize"><?=$row->issuer_name ?></td>
       <?php 
        if(!empty($row->application_no)){  
                    $checkin ='<a href="'.$this->data['base_url'].'/Request_appointments_pdf_download/'.$row->id.'/'.$row->user_id.'" class="btn btn-xs btn-danger" style="color:white;"><i class="fa fa-download"></i></a>';
                 }else{
                     $checkin = '<a href="'.$this->data['base_url'].'/Request_appointments_checkin/'.$row->id.'/'.$row->user_id.'" class="btn btn-xs btn-danger" style="color:white;"><i class="fa fa-check"></i></a>';
                 }
   if ($_SESSION['admin_type'] =='0') {
$servies_per = $_SESSION['bloodbank_user_servies_permission'];
        $per = json_decode($servies_per);

        if ($per->Request_permission  =='Write') {
             
?>
   <td class="capitalize"><?php echo $checkin.' <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$row->id.');" ><i class="fa fa-trash"></i></button>' ;?></td>
<?php }
}else{?>
<td class="capitalize"><?php echo $checkin.' <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$row->id.');" ><i class="fa fa-trash"></i></button>' ;?></td>
<?php } ?>
 
                   
</tr>
<?php } ?>
</tbody>
</table>
</div>
<script>
$(document).ready( function () {
$('#myTable').DataTable();
} );
</script>
<?php 
$query1 = $this->db->query("SELECT * FROM bl_blood_request");
foreach ($query1->result() as $row)
{
 ?>
<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable<?= $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title pl-3"  style="font-weight:bold !important;" id="exampleModalScrollableTitle">Check In</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="scheduling-confirm" action = "<?php $_PHP_SELF ?>" method = "POST" style="padding-bottom: 0px!important; margin: 0px!important;">
      <div class="modal-body">
      
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <h5 class="pl-2" style="font-size: 1rem;font-weight: bold;">*. GENERAL QUESTION :-</h5>
                        <div class="row">
                           <div class="col-md-12 pl-3 pr-3 " style="padding: 5px;">
                              1. Patient unable to give consent Reason : </br><input type="text" class="rounded-lg col-md-12" id="d_weight" value="" name="reason" required="">
                           </div><br>
                           <div class="col-md-12 pl-3 pr-3" style="padding: 5px;">
                             2. Name of Blood Issuer :</br> <input type="text" class="rounded-lg col-md-12" id="d_hemoglobin" value="" name="issuer_name" required="">
                           </div><br>
                           <div class="col-md-12 pl-3 pr-3" style="padding: 5px;">
                             3. Relationship with patient :</br> <input type="text" class="rounded-lg col-md-12" id="d_bp" value="" name="relationship" required="">
                           </div>
                            <div class="col-md-12 pl-3 pr-3" style="padding: 5px;">
                             4. Request : </br> <select  class="rounded-lg col-md-12 form-select-lg mb-3" name="request" id="vender" >
                                              
          <option value="Accept">Accept</option>
          <option value="Reject">Reject</option>
                               </select>
                           </div>
                            <div class="col-md-12 pl-3 pr-3" >
                             5. Reasion :<br> <input type="text" class="rounded-lg col-md-12" id="d_bp" value="" name="reject_reason" required="">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
             
    <input type="hidden" value="<?php echo $row->id; ?>" id="blood_bank_id" name="donationform_id">
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" style="background-color:#ad1e1d !important" name="submit" class="btn btn-danger">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php } ?>

 <?php
      if(!empty($_POST['reason'])){ 

         $consent_reason = $_POST['reason'];
    $issuer_name = $_POST['issuer_name']; 
    $relationship = $_POST['relationship'];
    $reject_reason = $_POST['reject_reason'];
    $request = $_POST['request'];
    $donationform_id = $_POST['donationform_id'];

         $n=6;
         function getName($n) {
           $characters = '0123456789';
           $randomString = '';
           
           for ($i = 0; $i < $n; $i++) {
             $index = rand(0, strlen($characters) - 1);
             $randomString .= $characters[$index];
          }
          
          return $randomString;
       }
       
       $app = getName($n);
       $application = 'RA'.$app;
      
       $update = $this->db->query("UPDATE bl_blood_request SET consent_reason = '$consent_reason',issuer_name = '$issuer_name',relationship = '$relationship', application_no = '$application' ,request = '$request' ,reject_reason = '$reject_reason'WHERE id = 'donationform_id'");
       if($update==true){
         redirect('admin/request/blood_appointment');
                           // echo "donated";
      } else{
         echo "fail";
      }         
   } 
      ?>
<!-- <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Appontments</h3>
      </div>

      <div class="card-body">
        <table id="table_blood_appointment" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Patient Name</th>
            <th>Application No.</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Blood Group</th>
            <th>Action</th>
          </tr>
          </thead>
        
        </table>
      </div>

    </div>
  </div>

  <script type="text/javascript">
    var apppointment_search='<?php echo $base_url;?>/request/blood_appointment_search';
    // var deleteSingleData='<?php echo $base_url;?>/donations/deleteSingleData';
  </script> -->
<script type="text/javascript">

  function deleteFun(id){
// alert(id);


    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/Request_appointments_delete',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data Delete Successfully');
                     location.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }


</script>
<script>
   $("#reset").click(function(){
$("input,select").val("");
window.location.href = window.location.href;
});</script>