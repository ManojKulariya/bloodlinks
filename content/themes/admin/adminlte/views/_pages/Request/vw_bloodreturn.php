
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
    padding: 10px 10px 6px;
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
    padding: 10px 0;
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

.capitalize{
  text-transform: capitalize;
}
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed');

$bank_id = $_SESSION['bank_id'];
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

                       <?php 
   if ($_SESSION['admin_type'] =='0') {
$servies_per = $_SESSION['bloodbank_user_servies_permission'];
        $per = json_decode($servies_per);

        if ($per->Return_permission  =='Write') {
             
   ?>
  <div class="btn-group" style="float: right;">
    <h6>Add Blood Return</h6>
          <a href="<?php echo $base_url;?>/request/blood_return_form" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div><br><br>
<?php }
}else{?>
<div class="btn-group" style="float: right;">
   <h6>Add Blood Return</h6>
          <a href="<?php echo $base_url;?>/request/blood_return_form" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div><br><br>
<?php } ?>
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Return No</label>
                                <input type="text" class="form-control" id="price" name="return_no" value="<?php if(isset($_POST) && isset($_POST['return_no'])){ echo $_POST['return_no']; } ?>">
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
                                 <label for="description">Request No</label>
                                <input type="text" class="form-control" id="price" name="request" value="<?php if(isset($_POST) && isset($_POST['request'])){ echo $_POST['request']; } ?>">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                 <label for="description">Name</label>
                                <input type="text" class="form-control" id="price" name="name" value="<?php if(isset($_POST) && isset($_POST['name'])){ echo $_POST['name']; } ?>">
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
                                  <label for="description">Components</label>
                               <input type="text" class="form-control" id="price" name="Component" value="<?php if(isset($_POST) && isset($_POST['Component'])){ echo $_POST['Component']; } ?>">
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
                                <label for="description">Return Reason</label>
                               <input type="text" class="form-control" id="price" name="reason">
                               <input type="hidden" class="form-control" value="123" id="price" name="data" value="<?php if(isset($_POST) && isset($_POST['data'])){ echo $_POST['data']; } ?>">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">User</label>
                               <select name="user" id="vender" class="form-control">
                               <option value="#" selected disabled>Select</option>      
                                                <?php 
            $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user");
           foreach ($query1->result() as $type)
           {
              ?>
          <option value="<?= $type->name; ?>" <?php if(isset($_POST) && isset($_POST['user'])){  if($_POST['user'] == $type->name) {echo"selected='selected'";} } ?>><?= $type->name; ?></option>
            <?php } ?>
                                </select>
                            </div>
                        </div>
                  
                    
                  <div class="col-md-6">
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
  <th>Unit No</th>
  <th>Return No</th>
  <th>Request No</th>
  <th>Tube No</th>
  <th>Name</th>
  <th>Mobile No</th>
  <th>Blood Group</th>
  <th>Components</th>
  <th>Date</th>
  <th>Return Reason</th>
  <th>User</th>
               
                  <!--   <?php 
   if ($_SESSION['admin_type'] =='0') {
$servies_per = $_SESSION['bloodbank_user_servies_permission'];
        $per = json_decode($servies_per);

        if ($per->IssueBlood_permission =='Write') {
             
   ?>
   <th>Action</th>
<?php }
}else{?>
 <th>Action</th>
<?php } ?> -->
 
</tr>
</thead>
<tbody>
<?php
      $no=0;
   if(!empty($_POST['data'])){

        // print_r($_POST); die;
        if (isset($_POST['blood_group'])) {
          $blood_group = $_POST['blood_group']; 
        }
        if (isset($_POST['user'])) {
          $user = $_POST['user'];
        }
     $name = $_POST['name']; 
   
     $return_no = $_POST['return_no']; 
     $request = $_POST['request']; 
     $mobile = $_POST['mobile']; 
     $Component = $_POST['Component']; 
     $start_date = $_POST['start_date']; 
     $end_date = $_POST['end_date']; 
     $reason = $_POST['reason']; 
    

        if (!empty($name) && !empty($issue_no) && !empty($request) && !empty($Component)
        && !empty($blood_group) && !empty($user) && (!empty($start_date) && !empty($end_date))) {

          $query = $this->db->query("SELECT * FROM bl_crossmatch WHERE created_at BETWEEN '$start_date' AND '$end_date' AND bl_crossmatch.bloodbank_id = '$bank_id' And bl_crossmatch.status = 'return' And bl_crossmatch.p_name = '$name' And bl_crossmatch.return_no = '$return_no' And bl_crossmatch.blood_group = '$blood_group' And bl_crossmatch.request = '$request' And bl_crossmatch.component = '$Component' And bl_crossmatch.reason_return = '$reason' ORDER BY ID DESC");
  
      }else{
$search='';
        if(!empty($name)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_crossmatch.p_name LIKE '%$name%'";
        }
		if(!empty($return_no)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_crossmatch.return_no LIKE '%$return_no%'";
        }
		if(!empty($request)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_crossmatch.request LIKE '%$request%'";
        }
		if(!empty($blood_group)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_crossmatch.blood_group LIKE '%$blood_group%'";
        }
		if(!empty($Component)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_crossmatch.component LIKE '%$Component%'";
        }
		if(!empty($reason)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_crossmatch.reason_return LIKE '%$reason%'";
        // }elseif(!empty($user)){
        //   $search = "bl_crossmatch.issue_by = '$user'";
        }
		if(!empty($start_date) && empty($end_date)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "created_at = '$start_date'";
        }
		
		if(empty($start_date) && !empty($end_date)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "created_at = '$end_date'";
        }if(!empty($start_date) && !empty($end_date)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "created_at BETWEEN '$start_date' AND '$end_date'";
        }
$querySearch='';
			if(!empty($search)){
			$querySearch='And '. $search;
			}
         $query = $this->db->query("SELECT * FROM bl_crossmatch  WHERE bl_crossmatch.bloodbank_id = '$bank_id' AND bl_crossmatch.status = 'return' $querySearch ORDER BY ID DESC");

      }
    }else{
       $query = $this->db->query("SELECT * FROM bl_crossmatch  WHERE bl_crossmatch.bloodbank_id = '$bank_id'AND bl_crossmatch.status = 'return' ORDER BY ID DESC"); }
             foreach ($query->result() as $row) {
                $no++;
            //   print_r($row);die();
         ?>

              <tr>
                  <th scope="row"><?=$no ?></th>
                  <td><?= $row->unit_no ?></td>
                  <td class="capitalize"><?=$row->return_no ?></td>
                  <td class="capitalize"><?=$row->request ?></td>
                  <td class="capitalize"><?=$row->tube_no ?></td>                 
                  <td class="capitalize"><?=$row->p_name ?></td>
                  <td class="capitalize"></td>
                  <td class="capitalize"><?=$row->blood_group ?></td>
                  <td class="capitalize"><?=$row->component ?></td>
                  <td class="capitalize"><?=date('d-m-Y H:i', strtotime($row->created_at)) ?></td>
                  <td class="capitalize"><?=$row->reason_return ?></td>
                  <td class="capitalize"><?=$row->return_by ?></td>


     <!--   <?php 
   if ($_SESSION['admin_type'] =='0') {
$servies_per = $_SESSION['bloodbank_user_servies_permission'];
        $per = json_decode($servies_per);

        if ($per->IssueBlood_permission  =='Write') {
             
   ?>
   <td><?php echo '<a href="'.$this->data['base_url'].'/request/issue_blood_download/'.$row->id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>'; ?></td>
<?php }
}else{?>
 <td><?php echo '<a href="'.$this->data['base_url'].'/request/issue_blood_download/'.$row->id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>'; ?></td>
<?php } ?> -->

                   
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

<!-- <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Blood Return</h3>
         <div class="btn-group" style="float: right;">
          <a href="<?php echo $base_url;?>/request/blood_return_form" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div>
      </div>
      <div class="card-body">
        <table id="table_bloodreturn" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Request No.</th>
            <th>Patinet Name</th>
            <th>Ipd</th>
            <th>Unit No.</th>
            <th>Component</th>
            <th>Tube No.</th>
            <th>Issues Date</th>
            <th>Issue No.</th>
            <th>Hospital</th>
       
          </tr>
          </thead>
        
        </table>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var apppointment_search='<?php echo $base_url;?>/request/blood_returnform_search';
    // var deleteSingleData='<?php echo $base_url;?>/donations/deleteSingleData';
  </script> -->
<script type="text/javascript">

  function deleteFun(id){
// alert(id);

    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/request/blood_returnform_delete',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data Delete Successfully');
                     $('#table_bloodreturn').DataTable().ajax.reload();
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