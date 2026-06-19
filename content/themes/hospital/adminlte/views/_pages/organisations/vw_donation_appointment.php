<style type="text/css">
   .content-wrapper {
   background: #fff;
   text-transform: capitalize;
   }
   .content-header h1 {
   font-size: 18px;
   /* margin: 0 20px; */
   font-weight: bold;
   }
   .form-control {
   height: 25px !important;
   padding: 0 14px !important;
   font-size: 14px !important;
   }
   label {
   margin-bottom: 0;
   font-size: 12px;
   }
   .page-item.active .page-link {
   background-color: #ad1e1d !important;
   border-color: #ad1e1d !important;
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
   .btn-group h6 {
   font-weight: 500;
   margin: 5px 10px 0;
   }
   .btn-success {
   background-color: #ad1e1d;
   border-color: #ad1e1d;
   }
   .page-link {
   z-index: 2;
   color: #000;
   }
   .btn-success:hover {
    background-color: #ad1e1d;
    border-color: #ad1e1d;
}
.page-link:hover {
    color: #ad1e1d;
}
.card-body {
    padding: 0 10px;
}
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
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
                     <input type="text" class="form-control" id="price" name="app_id" value="<?php if(isset($_POST) && isset($_POST['app_id'])){ echo $_POST['app_id']; } ?>">
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
                     <input type="text" class="form-control" id="price" name="name" value="<?php if(isset($_POST) && isset($_POST['nae'])){ echo $_POST['name']; } ?>">
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="description">Status</label>
                     <select name="status" id="vender" class="form-control">
                        <option value="#" selected 	disabled>Select</option>
                        <option value="donated" <?php if(isset($_POST) && isset($_POST['status'])){  if($_POST['status'] == "donated") {echo"selected='selected'";} } ?>>Donated</option>
                        <option value="not donated" <?php if(isset($_POST) && isset($_POST['status'])){  if($_POST['status'] == "not donated") {echo"selected='selected'";} } ?>>Not Donated</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="row">
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
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="description">Application Id</label>
                     <input type="text" class="form-control" id="price" name="application_id" value="<?php if(isset($_POST) && isset($_POST['application_id'])){ echo $_POST['application_id']; } ?>">
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="description">Donor Type</label>
                     <select name="donor_type" id="vender" class="form-control">
                        <option value="#" selected 	disabled>Select</option>
                        <option value="volunteer" <?php if(isset($_POST) && isset($_POST['donor_type'])){  if($_POST['donor_type'] == "volunteer") {echo"selected='selected'";} } ?>>Volunteer</option>
                        <option value="replacement" <?php if(isset($_POST) && isset($_POST['donor_type'])){  if($_POST['donor_type'] == "replacement") {echo"selected='selected'";} } ?>>Replacement</option>
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
                     <label for="price">User</label>
                     <select name="user" id="vender" class="form-control">
                      <option value="#" selected  disabled>Select</option>
                        <?php 
                           $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user");
                           foreach ($query1->result() as $typeuser)
                           {
                             ?>
                        
                        <option value="<?= $typeuser->name; ?>" <?php if(isset($_POST) && isset($_POST['user'])){  if($_POST['user'] == $typeuser->name) {echo"selected='selected'";} } ?>><?= $typeuser->name; ?></option>
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
                           foreach ($query12->result() as $typebank)
                           {
                             ?>
                        
                        <option value="<?= $typebank->name; ?>" <?php if(isset($_POST) && isset($_POST['blood_bank'])){  if($_POST['blood_bank'] == $typebank->name) {echo"selected='selected'";} } ?>><?= $typebank->name; ?></option>
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
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<!--  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
   -->
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
   crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
   <table class="table table-fluid" id="myTable">
      <thead>
         <tr>
            <th>S No</th>
            <th>Appointment Id</th>
            <th>Application No</th>
            <th>Blood Bank Name</th>
            <th>Blood Bank Code</th>
            <th>Blood Bank City</th>
            <th>Name</th>
            <th>Mobile No</th>
            <th>Date</th>
            <th>Donor Type</th>
            <th>Donation Status</th>
            <?php 
               if ($_SESSION['admin_type'] =='0') {
               $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                    $per = json_decode($servies_per);
               
                    if ($per->Donation_permission  =='Write') {
                         
               ?>
            <th>Action</th>
            <?php }
               }else{?>
            <th>Action</th>
            <?php } ?>
         </tr>
      </thead>
      <tbody>
         <?php //if(!empty($_POST['request'])){
            //$request = $_POST['request'];
            
              $no=0;
            if(!empty($_POST) && isset($_POST['submit'])){
            
            // print_r($_POST); die;
            if (isset($_POST['status'])) {
            $status = $_POST['status'];
            }
            if (isset($_POST['donor_type'])) {
            $donor_type = $_POST['donor_type'];
            }
            if (isset($_POST['user'])) {
            $user = $_POST['user'];
            }
            if (isset($_POST['blood_bank'])) {
            $blood_bank = $_POST['blood_bank'];
            }
            $app_id = $_POST['app_id']; 
            $user_id = $_POST['user_id']; 
            $name = $_POST['name']; 
            $start_date = $_POST['start_date']; 
            $end_date = $_POST['end_date']; 
            $application_id = $_POST['application_id']; 
            $city = $_POST['city']; 
            
            
            if (!empty($app_id) && !empty($user_id) && !empty($status) && !empty($name) && !empty($blood_bank)
            && !empty($application_id) && !empty($donor_type) && !empty($city) && !empty($user) 
            && (!empty($start_date) && !empty($end_date))) {
            
            $query = $this->db->query("SELECT bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.email,bl_customers.ph_no, bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name FROM bl_blood_donation_requests INNER JOIN bl_customers ON bl_customers.user_id = bl_blood_donation_requests.user_id INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_blood_donation_requests.org_id INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id WHERE requested_schedule_date BETWEEN '$start_date' AND '$end_date' And bl_blood_donation_requests.id = '$app_id' And bl_blood_donation_requests.user_id = '$user_id' And bl_blood_donation_requests.donation_status = '$status' And bl_blood_donation_requests.application_no = '$application_id'  And bl_cities.id = '$city_id'And bl_customers.first_name = '$name' And bl_blood_banks.name = '$blood_bank' ORDER BY ID DESC");
            
            }else{
            $search='';
            if(!empty($app_id)){
             
              $search .="bl_blood_donation_requests.id  LIKE '%$app_id%'";
            }
			if(!empty($user_id)){
             if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_blood_donation_requests.user_id LIKE '%$user_id%'";
            }
			if(!empty($name)){
             if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_customers.first_name LIKE '%$name%'";
            }
			if(!empty($status)){
             if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_blood_donation_requests.donation_status LIKE '%$status%'";
            }
			if(!empty($application_id)){
             if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_blood_donation_requests.application_no LIKE '%$application_id%'";
             }
			 if(!empty($blood_bank)){
             if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_blood_banks.name LIKE '%$blood_bank%'";
            
            // if(!empty($donor_type)){
            //   $search = "bl_blood_donation_requests.id = $app_id";
            // }
            
            }
			if(!empty($city)){
            if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_cities.city_name LIKE '%$city%' ";
                 
            
            
            // if(!empty($user)){
            //   $search = "bl_blood_donation_requests.id = $user";
            // }
            
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
            }
			if(!empty($start_date) && !empty($end_date)){
             if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "requested_schedule_date BETWEEN '$start_date' AND '$end_date'";
            }
            
            
            $query = $this->db->query("SELECT bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.email,bl_customers.ph_no, bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name FROM bl_blood_donation_requests INNER JOIN bl_customers ON bl_customers.user_id = bl_blood_donation_requests.user_id INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_blood_donation_requests.org_id INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id WHERE $search ORDER BY ID DESC");
            
            }
            
		 }
			else{
            $query = $this->db->query("SELECT bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.email,bl_customers.ph_no, bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name FROM bl_blood_donation_requests INNER JOIN bl_customers ON bl_customers.user_id = bl_blood_donation_requests.user_id INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_blood_donation_requests.org_id INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id ORDER BY ID DESC"); }
            foreach ($query->result() as $row) {
             if(!empty($row->mid_name)){
                   $name = $row->first_name.' '.$row->mid_name.' '.$row->last_name;
               }else{
                   $name = $row->first_name.' '.$row->last_name;
               }
              
               $no++;
              //print_r($row);
            ?>
         <tr>
            <th scope="row"><?=$no ?></th>
            <td><?=$row->id ?></td>
            <td><?=$row->application_no ?></td>
            <td><?=$row->name ?></td>
            <td><?=$row->blood_bank_id ?></td>
            <td><?=$row->city_name ?></td>
            <td><?=$name ?></td>
            <td><?=$row->ph_no ?></td>
            <td><?=$row->requested_schedule_date ?></td>
            <td></td>
            <td><?=$row->donation_status ?></td>
            <?php if($row->donation_status == 'not donated'){
               $checkin = ' <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$row->id.');" ><i class="fa fa-trash"></i></button>';
               }else{
               $checkin ='<button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$row->id.');" ><i class="fa fa-trash"></i></button> <a href="'.$this->data['base_url'].'/donations_download/'.$row->donation_form_id.'/'.$row->user_id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>';
               }
               ?>
            <?php 
               if ($_SESSION['admin_type'] =='0') {
               $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                    $per = json_decode($servies_per);
               
                    if ($per->Donation_permission =='Write') {
                         
               ?>
            <td><?php echo $checkin; ?></td>
            <?php }
               }else{?>
            <td><?php echo $checkin; ?></td>
            <?php } ?>
         </tr>
         <?php }?>
      </tbody>
   </table>
</div>
<script>
   $(document).ready( function () {
   $('#myTable').DataTable();
   } );
</script>
<!-- <div class="row">
   <div class="col-12">
     <div class="card">
       <div class="card-header">
         <h3 class="card-title">Appontments</h3>
       </div>
       <div class="card-body">
         <table id="table_donation_appointments" class="table table-bordered table-hover">
           <thead>
           <tr>
             <th>#</th>
             <th>Donar Name</th>
             <th>Application no.</th>
             <th>Donar Email</th>
             <th>Donar Phone No</th>
             <th>Request Date</th>
             <th>Reason</th>
             <th>Donation Status</th>
             <th>Action</th>
           </tr>
           </thead>
         
         </table>
       </div>
     </div>
   </div>
   
   <script type="text/javascript">
     var apppointment_search='<?php echo $base_url;?>/donations/appointments_search';
   </script>-->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
   <script type="text/javascript">

  function deleteFun(id){
// alert(id);


    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 

               url:'<?php echo $base_url;?>/donation_forms_delete',
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