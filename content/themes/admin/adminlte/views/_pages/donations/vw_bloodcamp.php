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

        if ($per->CampRegister_permission  =='Write') {
             
   ?>
 <div class="btn-group" style="float: right;">
  <h6>Add Blood Camp</h6>
          <a href="<?php echo $base_url;?>/donations/bloodcamps/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div><br><br>
<?php }
}else{?>
<div class="btn-group" style="float: right;">
    <h6>Add Blood Camp</h6>
          <a href="<?php echo $base_url;?>/donations/bloodcamps/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div><br><br>
<?php } ?>
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Camp Code</label>
                                <input type="text" class="form-control" id="price" name="camp_code" value="<?php if(isset($_POST) && isset($_POST['camp_code'])){ echo $_POST['camp_code']; } ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                           <div class="form-group">
                                <label for="description">Camp Type</label>
                                 <select name="camp_Type" id="vender" class="form-control">
                                                <?php 
            $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'camp_codes'");
           foreach ($query1->result() as $types)
           {
              ?>
          <option disabled="disabled" selected="selected" value="">Select</option>
          <option value="<?= $types->master_type_key_value; ?>" <?php if(isset($_POST) && isset($_POST['camp_type'])){  if($_POST['user'] == $types->master_type_key_value) {echo"selected='selected'";} } ?>><?= $types->master_type_key_value; ?></option>
            <?php } ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                 <label for="description">Camp Name</label>
                                <input type="text" class="form-control" id="price" name="name" value="<?php if(isset($_POST) && isset($_POST['name'])){ echo $_POST['name']; } ?>">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                 <label for="description">Address</label>
                                <input type="text" class="form-control" id="price" name="city" value="<?php if(isset($_POST) && isset($_POST['city'])){ echo $_POST['city']; } ?>">
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
  <div style="overflow-x:auto;box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);padding: 12px;border-radius: 4px;margin-left: -6px;">
<table class="table table-fluid" id="myTable">
<thead>
<tr>
  <th>S No</th>
  <th>Camp Code</th>
  <th>Camp Type</th>
  <th>Camp Name</th>
  <th>City</th>
  <th>Venue</th>
  <th>Start Date</th>
  <th>End Date</th>
  <?php 
   if ($_SESSION['admin_type'] =='0') {
$servies_per = $_SESSION['bloodbank_user_servies_permission'];
        $per = json_decode($servies_per);

        if ($per->CampRegister_permission =='Write') {          
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
        if (isset($_POST['name'])) {
          $name = $_POST['name']; 
        }
     $camp_code = $_POST['camp_code']; 
     $camp_Type = $_POST['camp_Type']; 
     
     $city = $_POST['city']; 
     $start_date = $_POST['start_date']; 
     $end_date = $_POST['end_date']; 
    
        if (!empty($name) && !empty($camp_code) && !empty($camp_code) && !empty($start_date) && !empty($start_date)) {

          $query = $this->db->query("SELECT * FROM bl_bloodcamp WHERE bl_bloodcamp.bloodbank_id = '$bank_id' And bl_bloodcamp.blood_name = '$name' And bl_bloodcamp.camp_code = '$camp_code' And bl_bloodcamp.address = '$city' And bl_bloodcamp.start_date = '$start_date' And bl_bloodcamp.end_date = '$end_date' And bl_bloodcamp.camp_code = '$camp_Type' ORDER BY ID DESC");
  
      }else{
$search='';
        if(!empty($name)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_bloodcamp.blood_name = '$name'";
        }
		if(!empty($camp_code)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_bloodcamp.camp_code = '$camp_code'";
        }
		if(!empty($camp_Type)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_bloodcamp.camp_code = '$camp_Type'";
        }
		if(!empty($city)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .="bl_bloodcamp.address = '$city'";
        }
		if(!empty($start_date)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_bloodcamp.start_date = '$start_date'";
         }
		 if(!empty($end_date)){
          if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_bloodcamp.end_date = '$end_date'";
        }
$querySearch='';
			if(!empty($search)){
			$querySearch='And '. $search;
			}
         $query = $this->db->query("SELECT * FROM bl_bloodcamp WHERE bl_bloodcamp.bloodbank_id = '$bank_id' $querySearch ORDER BY ID DESC");

      }
    }else{
       $query = $this->db->query("SELECT * FROM bl_bloodcamp WHERE bl_bloodcamp.bloodbank_id = '$bank_id' ORDER BY ID DESC"); }
             foreach ($query->result() as $row) {
           
               
                $no++;
              //  print_r($row);
         ?>

              <tr>
                  <th scope="row"><?=$no ?></th>
                  <td class="capitalize"><?=$row->camp_code ?></td>
                  <td class="capitalize"><?=$row->camp_type ?></td>
                  <td class="capitalize"><?=$row->blood_name ?></td>                 
                  <td class="capitalize"><?=$row->address ?></td>
                  <td class="capitalize"><?=$row->venue ?></td>
                  <td class="capitalize"><?=$row->start_date ?></td>
                  <td class="capitalize"><?=$row->end_date ?></td>
 <?php 
   if ($_SESSION['admin_type'] =='0') {
$servies_per = $_SESSION['bloodbank_user_servies_permission'];
        $per = json_decode($servies_per);

        if ($per->CampRegister_permission =='Write') {
             
   ?>
   <td><?php echo '<a href="'.$this->data['base_url'].'/donations/bloodcamps/edit/'.$row->id.'" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$row->id.');" ><i class="fa fa-trash"></i></button>'; ?></td>
<?php }
}else{?>
 <td><?php echo '<a href="'.$this->data['base_url'].'/donations/bloodcamps/edit/'.$row->id.'" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$row->id.');" ><i class="fa fa-trash"></i></button>'; ?></td>
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

<!-- <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Blood Camp</h3>
         <div class="btn-group" style="float: right;">
          <a href="<?php echo $base_url;?>/donations/bloodcamps/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div>
      </div>

      <div class="card-body">
        <table id="table_bloodcamp" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Blood Camp Name</th>
            <th>Camp Code</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Venue</th>
            <th>Address</th>
            <th>Mobile</th>
            <th>Sponsored By</th>
            <th>Action</th>
          </tr>
          </thead>
        
        </table>
      </div>

    </div>

  </div>

  <script type="text/javascript">
    var apppointment_search='<?php echo $base_url;?>/donations/bloodcamps_search';
    // var deleteSingleData='<?php echo $base_url;?>/donations/deleteSingleData';
  </script> -->
<script type="text/javascript">

  function deleteFun(id){
// alert(id);


    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/donations/bloodcamps_delete',
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