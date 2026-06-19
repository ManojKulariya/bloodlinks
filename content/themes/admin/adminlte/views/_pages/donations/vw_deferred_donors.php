<style type="text/css">
   .body {
   font-family: Jost, sans-serif !important;
   }
   .btn-success:not(:disabled):not(.disabled).active, .btn-success:not(:disabled):not(.disabled):active, .show>.btn-success.dropdown-toggle {
   color: #fff;
   background-color: #ad1e1d !important;
   border-color: #ad1e1d !important;
   }
   .btn-success {
   background-color: #ad1e1d !important;
   border-color: #ad1e1d !important;
   }
   .btn-danger {
   background-color: #ad1e1d !important;
   border-color: #ad1e1d !important;
   }
   .page-item.active .page-link {
   background-color: #ad1e1d !important;
   border-color: #ad1e1d !important;
   color: #fff !important;
   }
   .page-link {
   color: #000 !important;
   }
   .form-control {
   height: 25px !important;
   padding: 0 14px !important;
   font-size: 14px !important;
   }
   label {
   margin-bottom: -4px;
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
   .content-wrapper {
   background: #fff;
   }
   .card-footer {
   background-color: #fff;
   }
   .form-group {
   margin-bottom: 2px;
   }
   label {
   margin-bottom: 0;
   }
   table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
    font-size: 12px;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 0 16px;
    }
div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 6px;
    display: inline-block;
    width: 100%;
}
td {
    font-size: 14px;
}
.btn-xs {
    padding: 5px;
    font-size: 7px;
    }
    div.dataTables_wrapper div.dataTables_info {
    font-size: 15px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 2px;
    }
    .card {
    box-shadow: none;
}
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed');
   //  $query = $this->db->get('bl_customers');
   //  foreach ($query->result() as $row)
   // {
   
   //     print_r($row);
   
   // } 
   // $auth = $_SESSION['auth_id'];
   // print_r($_SESSION);
   // die();
   $bank_id = $_SESSION['bank_id'];
   ?>
<div class="container">
<form action = "<?php $_PHP_SELF ?>" method = "POST" id="filter_form">
   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
   <div class="timeline">
   <!-- <div class="time-label">
      <span class="bg-red">Consumables Items</span>
      </div> -->
   <div class="card">
   <div class="card-body">
   <div class="row" style="box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%); border-radius: 2px; width: 100%; margin-bottom: 25px; padding: 8px;">
      <div class="col-md-3">
         <div class="form-group">
            <label for="description">Appointment Id:</label>
            <input type="text" class="form-control" id="app_id" name="app_id" value="<?php if(isset($_POST) && isset($_POST['app_id'])){ echo $_POST['app_id']; } ?>">
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group">
            <label for="description">Reason:</label>
            <input type="text" class="form-control" id="reason" name="reason" value="<?php if(isset($_POST) && isset($_POST['reason'])){ echo $_POST['reason']; } ?>">
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
               <input type="date" class="form-control" id="start_date" name="start_date" value="<?php if(isset($_POST) && isset($_POST['start_date'])){ echo $_POST['start_date']; } ?>">
            </div>
         </div>
         <div class="col-md-3">
            <div class="form-group">
               <label for="description">End Date</label>
               <input type="date" class="form-control" id="end_date" name="end_date" value="<?php if(isset($_POST) && isset($_POST['end_date'])){ echo $_POST['end_date']; } ?>">
            </div>
         </div>

         <div class="col-md-3">
            <div class="form-group">
               <label for="description">City</label>
              <select name="city" id="vender" class="form-control">
                               <option value="#" selected disabled>Select</option>       
                                                <?php 
            $query1 = $this->db->query("SELECT * FROM bl_districts");
           foreach ($query1->result() as $types)
           {
              ?>
          <option value="<?= $types->district_name; ?>"><?= $types->district_name; ?></option>
            <?php } ?>
                                </select>
            </div>
         </div>
        <!--  <div class="col-md-3">
            <div class="form-group">
               <label for="price">User</label>
               <input type="text" class="form-control" id="price" name="user">
            </div>
         </div> -->
         <div class="col-md-12">
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
</div>
</form>
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
<div class="container" style="
   box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%); padding: 20px; border-radius: 2px; background: #fff; margin-left: -7px;">
   <table class="table table-fluid table-responsive" id="myTable">
      <thead>
         <tr>
            <th>S No.</th>
            <th>Appointment Id</th>
            <th>Donar Name</th>
            <th>Blood Group</th>
            <th>Mobile No</th>
            <th>Date</th>
            <th>Deffer Type</th>
            <th>Reason</th>
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
         <?php 
		 	if(isset($_POST['reset'])){
  unset($_POST);
}
		 
		 //if(!empty($_POST['request'])){
            //$request = $_POST['request'];
            
              $no=0;
            if(!empty($_POST)){
            
             // print_r($_POST); die;
            if (isset($_POST['blood_group'])) {
               $blood_group = $_POST['blood_group']; 
            }
			
			if (isset($_POST['city'])) {
               $city = $_POST['city']; 
            }
            $app_id = $_POST['app_id']; 
            $reason = $_POST['reason']; 
            $start_date = $_POST['start_date']; 
            $end_date = $_POST['end_date']; 
            
            // $user = $_POST['user'];
            
            if (!empty($app_id) && !empty($reason) && !empty($blood_group) && !empty($city)  && (!empty($start_date) && !empty($end_date))) {
            
            $query = $this->db->query("SELECT bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.blood_group,bl_customers.ph_no ,bl_masters.master_type_key_value , bl_districts.district_name FROM bl_blood_donation_requests INNER JOIN bl_customers ON bl_customers.user_id = bl_blood_donation_requests.user_id INNER JOIN bl_districts ON bl_districts.id = bl_customers.district_id INNER JOIN bl_masters ON bl_masters.master_id = bl_customers.blood_group WHERE requested_schedule_date BETWEEN '$start_date' AND '$end_date' AND bl_blood_donation_requests.org_id = '$bank_id' AND bl_blood_donation_requests.donation_status = 'defer' And bl_blood_donation_requests.id = '$app_id' And bl_blood_donation_requests.defer_reason = '$reason'  And bl_districts.district_name = '$city' ORDER BY ID DESC");
            
            }else{
            $search='';
            if(!empty($app_id)){
            if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .=  "bl_blood_donation_requests.id = '$app_id'";
            }
			if(!empty($reason)){
            if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .=  "bl_blood_donation_requests.defer_reason = '$reason'";
            }
			if(!empty($blood_group)){
            if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .=  "bl_blood_donation_requests.donation_status = '$blood_group'";
            }
			if(!empty($city)){
            if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .=  "bl_districts.district_name = '$city'";
                 $query = $this->db->query("SELECT bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.blood_group,bl_customers.ph_no ,bl_masters.master_type_key_value , bl_districts.district_name FROM bl_blood_donation_requests INNER JOIN bl_customers ON bl_customers.user_id = bl_blood_donation_requests.user_id INNER JOIN bl_districts ON bl_districts.id = bl_customers.district_id INNER JOIN bl_masters ON bl_masters.master_id = bl_customers.blood_group  WHERE bl_blood_donation_requests.org_id = '$bank_id' And bl_blood_donation_requests.donation_status = 'defer' And bl_districts.district_name = '$city' ORDER BY ID DESC");
            
            
            // if(!empty($user)){
            //   $search = "bl_blood_donation_requests.id = $user";
            // }
            
            }
			
			if(!empty($start_date) && !empty($end_date)){
            if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .=  "requested_schedule_date BETWEEN '$start_date' AND '$end_date'";
            }
            
$querySearch='';
			if(!empty($search)){
			$querySearch='And '. $search;
			}
            $query = $this->db->query("SELECT bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.blood_group,bl_customers.ph_no ,bl_masters.master_type_key_value , bl_districts.district_name FROM bl_blood_donation_requests INNER JOIN bl_customers ON bl_customers.user_id = bl_blood_donation_requests.user_id INNER JOIN bl_districts ON bl_districts.id = bl_customers.district_id INNER JOIN bl_masters ON bl_masters.master_id = bl_customers.blood_group WHERE bl_blood_donation_requests.org_id = '$bank_id' And bl_blood_donation_requests.donation_status = 'defer' $querySearch ORDER BY ID DESC");

            }
          }else{
            $query = $this->db->query("SELECT bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.blood_group,bl_customers.ph_no ,bl_masters.master_type_key_value , bl_districts.district_name FROM bl_blood_donation_requests INNER JOIN bl_customers ON bl_customers.user_id = bl_blood_donation_requests.user_id INNER JOIN bl_districts ON bl_districts.id = bl_customers.district_id INNER JOIN bl_masters ON bl_masters.master_id = bl_customers.blood_group WHERE bl_blood_donation_requests.org_id = '$bank_id' And bl_blood_donation_requests.donation_status = 'defer' ORDER BY ID DESC"); }
            // SELECT bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.blood_group,bl_customers.ph_no ,bl_masters.master_type_key_value FROM bl_blood_donation_requests INNER JOIN bl_customers ON bl_customers.user_id = bl_blood_donation_requests.user_id INNER JOIN bl_masters ON bl_masters.master_id = bl_customers.blood_group WHERE bl_blood_donation_requests.donation_status = 'defer'
            foreach ($query->result() as $row) {
             if(!empty($row->mid_name)){
                   $name = $row->first_name.' '.$row->mid_name.' '.$row->last_name;
               }else{
                   $name = $row->first_name.' '.$row->last_name;
               }

               $reason = $row->defer_reason;


               $no++;
               // print_r($row); die();
            ?>
         <tr>
      
            <th scope="row"><?=$no ?></th>
            <td><?=$row->id ?></td>
            <td style="text-transform: capitalize;"><?=$name ?></td>
            <td style="text-transform: capitalize;"><?=$row->master_type_key_value ?></td>
            <td><?=$row->ph_no ?></td>
            <td><?=$row->defer_date ?></td>
            <td><?= $row->deffer_type ?></td>
            <td><?=$reason ?></td>
            <!-- <td></td> -->
         
            <?php 
               if ($_SESSION['admin_type'] =='0') {
         $servies_per = $_SESSION['bloodbank_user_servies_permission'];
        $per = json_decode($servies_per);

        if ($per->DeferredDonor_permission  =='Write') {
             
                         
               ?>
            <td><?php echo '<button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$row->id.');" ><i class="fa fa-trash"></i></button>'; ?></td>
            <?php }
               }else{?>
            <td><?php echo '<button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$row->id.');" ><i class="fa fa-trash"></i></button>'; ?></td>
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

<!-- <style type="text/css">
  table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child:before {
    background-color: #ad1e1d !important;
}
.page-item.active .page-link {
    background-color: #ad1e1d !important;
    border-color: #ad1e1d !important;
}
.content-header h1 {
    font-size: 18px;
    margin: 0 6px;
    font-weight: bold;
}
.content-wrapper {
    background: #f4f6f9;
}
th.sorting {
    font-size: 12px;
}
</style>


<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Deferred Donors</h3>
      </div>
      /.card-header
      <div class="card-body">
        <table id="table_deferred_donor" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Appointment Id</th>
            <th>Donar Name</th>
            <th>Blood Group</th>
            <th>Mobile No</th>
            <th>Date</th>
            <th>Reason</th>

            <th>Action</th>
          </tr>
          </thead>
        
        </table>
      </div>

    </div>

  </div>

  <script type="text/javascript">
    var apppointment_search='<?php echo $base_url;?>/donations/deferred_search';
    // var deleteSingleData='<?php echo $base_url;?>/donations/deleteSingleData';
  </script> -->
<script type="text/javascript">

  function deleteFun(id){
// alert(id);


    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/donations/deferred_delete',
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