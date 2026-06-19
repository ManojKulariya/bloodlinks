<style type="text/css">
   .btn-outline-danger {
      /*color: #ad1e1d !important;*/
      border-color: #ad1e1d !important;
   }

   .page-item.active .page-link {
      background-color: #ad1e1d !important;
      border-color: #ad1e1d !important;
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
      font-size: 1.2rem !important;
      margin: 0 6px;
      font-weight: 700 !important;
   }

   .content-wrapper {
      background: #fff;
   }

   .form-group {
      margin-bottom: 0;
   }

   .card-footer {
      background-color: #fff;
   }

   .card-body {
      padding: 10px 10px 0;
   }

   th.sorting {
      font-size: 12px;
   }

   table.dataTable thead>tr>th.sorting_asc,
   table.dataTable thead>tr>th.sorting_desc,
   table.dataTable thead>tr>th.sorting,
   table.dataTable thead>tr>td.sorting_asc,
   table.dataTable thead>tr>td.sorting_desc,
   table.dataTable thead>tr>td.sorting {
      padding-right: 2px;
   }

   table.dataTable thead th,
   table.dataTable thead td {
      padding: 0 10px;
   }

   .card-body h6 {
      font-weight: 500;
      margin: 5px 10px 0;
   }

   .btn-xs {
      padding: 3px;
      font-size: 10px;
   }

   table.dataTable tbody th,
   table.dataTable tbody td {
      padding: 6px !important;
      font-size: 14px;
   }

   label {
      font-size: 12px;
   }

   .form-group {
      margin-bottom: 0;
   }
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed');

$bank_id = $_SESSION['bank_id'];
?>
<div class="container">
   <form action="<?php $_PHP_SELF ?>" method="POST" id="filter_form">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      <div class="timeline">
         <!-- <div class="time-label">
         <span class="bg-red">Consumables Items</span>
         </div> -->
         <div class="card">

            <div class="card-body">

               <?php
               if ($_SESSION['admin_type'] == '0') {
                  $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                  $per = json_decode($servies_per);

                  if ($per->DonorRegister_permission  == 'Write') {

               ?>
                     <div class="btn-group" style="float: right;">
                        <h6>Add Donation Form</h6>
                        <a href="<?php echo $base_url; ?>/donations/forms/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
                     </div>
                     <br><br>
                  <?php }
               } else { ?>
                  <div class="btn-group" style="float: right;">
                     <h6>Add Donation Form</h6>
                     <a href="<?php echo $base_url; ?>/donations/forms/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
                  </div>
                  <br><br>
               <?php } ?>
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Name</label>
                        <input type="text" class="form-control" id="price" name="name" value="<?php if(isset($_POST) && isset($_POST['name'])){ echo $_POST['name']; } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Unit No</label>
                        <input type="text" class="form-control" id="price" name="user_no" value="<?php if(isset($_POST) && isset($_POST['user_no'])){ echo $_POST['user_no']; } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Application No</label>
                        <input type="text" class="form-control" id="price" name="application_no"  value="<?php if(isset($_POST) && isset($_POST['application_no'])){ echo $_POST['application_no']; } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Donor Type</label>
                        <select name="donor_type" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
                           <option value="Volunter"  <?php if(isset($_POST) && isset($_POST['donor_type'])){  if($_POST['donor_type'] == 'Volunter') {echo"selected='selected'";} } ?>>Volunter</option>
                           <option value="replacement" <?php if(isset($_POST) && isset($_POST['donor_type'])){  if($_POST['donor_type'] == 'replacement') {echo"selected='selected'";} } ?>>Replacement</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Mobile No</label>
                        <input type="tel" class="form-control" id="price" name="mobile"  value="<?php if(isset($_POST) && isset($_POST['mobile'])){ echo $_POST['mobile']; } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Blood Group</label>
                        <select name="blood_group" id="vender" class="form-control">
                           <option value="" disabled="disabled" selected="selected">Select</option>
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
                        <input type="date" class="form-control" id="price" name="start_date"  value="<?php if(isset($_POST) && isset($_POST['start_date'])){ echo $_POST['start_date']; } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">End Date</label>
                        <input type="date" class="form-control" id="price" name="end_date"  value="<?php if(isset($_POST) && isset($_POST['end_date'])){ echo $_POST['end_date']; } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Donation Type</label>
                        <select name="donation_type" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
                           <option value="direct" <?php if(isset($_POST) && isset($_POST['donation_type'])){  if($_POST['donation_type'] == 'direct') {echo"selected='selected'";} } ?>>Direct</option>
                           <option value="camp" <?php if(isset($_POST) && isset($_POST['donation_type'])){  if($_POST['donation_type'] == 'camp') {echo"selected='selected'";} } ?>>Camp</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Type</label>
                        <select name="type" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
                           <option value="Online" <?php if(isset($_POST) && isset($_POST['type'])){  if($_POST['type'] == 'Online') {echo"selected='selected'";} } ?>>Online</option>
                           <option value="Offline" <?php if(isset($_POST) && isset($_POST['type'])){  if($_POST['type'] == 'Offline') {echo"selected='selected'";} } ?>>Offline</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">City</label>
                        <input type="text" class="form-control" id="city" name="city"  value="<?php if(isset($_POST) && isset($_POST['city'])){ echo $_POST['city']; } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">User</label>
                        <select name="user" id="vender" class="form-control">
                           <option value="" selected disabled>Select</option>
                           <?php
                           $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user");
                           foreach ($query1->result() as $type) {
                           ?>

                              <option value="<?= $type->name; ?>" <?php if(isset($_POST) && isset($_POST['user'])){  if($_POST['user'] == $type->name) {echo"selected='selected'";} } ?>><?= $type->name; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                           <button type="submit" name="submit" class="btn btn-sm btn-danger">Filter</button>
                            <button class="btn btn-sm btn-warning mx-2 text-white" id="reset" name="reset" type="submit"/>         Reset</button>              
					   </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
</div><!---timeline-->
   </form>
<!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>-->
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
   <div style="overflow-x:auto;box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);padding: 12px;border-radius: 4px;margin-left: -6px;">
      <table class="table table-fluid" id="myTable">
         <thead>
            <tr>
               <th>S No</th>
               <th>Name</th>
               <th>Application No</th>
               <th>Unit No</th>
               <th>Tube No</th>
               <th>Mobile No</th>
               <th>Donor Type</th>
               <th>Blood Group</th>
               <th>Date</th>
               <th>Donation Type</th>
               <th>Place</th>
               <th>Type</th>
               <th>User</th>
               <th>Examination BY</th>
               <?php
               if ($_SESSION['admin_type'] == '0') {
                  $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                  $per = json_decode($servies_per);

                  if ($per->DonorRegister_permission  == 'Write') {

               ?>
                     <th>Action</th>
                  <?php }
               } else { ?>
                  <th>Action</th>
               <?php } ?>
            </tr>
         </thead>
         <tbody>
            <?php
			if(isset($_POST['reset'])){
              unset($_POST);
            }
                        $base_url = str_replace('/admin', '', $this->data['base_url']);
                        $no = 0;
			
            foreach ($donations as $row) {
               $no++;
            ?>
               <tr>
                  <th scope="row"><?= $no ?></th>
                  <td style="text-transform: capitalize;"><?= $row->donor_name ?></td>
                  <td style="text-transform: capitalize;"><?= $row->application_no ?></td>
                  <td style="text-transform: capitalize;"><?= $row->unit_no ?></td>
                  <td><?= $row->tube ?></td>
                  <td><?= $row->mobile ?></td>
                  <td style="text-transform: capitalize;"><?= $row->donor_type ?></td>
                  <td style="text-transform: capitalize;"><?= $row->blood_group ?></td>
                  <td style="text-transform: capitalize;"><?= date('d-m-Y', strtotime($row->donation_date)) ?></td>
                  <td style="text-transform: capitalize;"><?= $row->camp_status ?></td>
                  <td><?= $row->place ?></td>
                  <td style="text-transform: capitalize;"><?= $row->donor_type ?></td>
                  <td style="text-transform: capitalize;"><?= $row->donation_by ?></td>
                  <td style="text-transform: capitalize;">
                     <?php if ($row->ex_name != "") {
                        echo "<strong>".$row->ex_name."</strong>";
                        echo '<img src="'.$base_url.'/' . $row->sign . '" width="70px" height="70px" />';
                     } ?>
                  </td>
                  <?php
                  if ($_SESSION['admin_type'] == '0') {
                     $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                     $per = json_decode($servies_per);
                     if ($per->DonorRegister_permission  == 'Write') {
                  ?>
                        <td><?php echo '<a href="' . $this->data['base_url'] . '/donations/donationform/' . $row->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>'; ?></td>
                     <?php }
                     if ($per->DonorRegister_permission  == 'Delete') {

                     ?>
                        <td><?php echo '<button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
                     <?php }
                  } else { ?>
                     <td><?php echo '<a href="' . $this->data['base_url'] . '/donations/donationform/' . $row->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
                  <?php } ?>
               </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
   <script>
      $(document).ready(function() {
         $('#myTable').DataTable();
      });
   </script>

   <script type="text/javascript">
      function deleteFun(id) {
         if (confirm('Are you sure') == true) {
            $.ajax({
               url: '<?php echo $base_url; ?>/donations/form_delete',
               method: "POST",
               datatype: "json",
               data: {
                  [csrf_name]: csrf_hash,
                  id: id
               },
               success: function(d) {
                  if (d == 1) {
                     alert('Data Delete Successfully');
                     location.reload();
                  } else {
                     alert('Delete Fail');
                  }
               }
            })
         }
      }
  
  $("#reset").click(function(){
$("input,select").val("");
window.location.href = window.location.href;
})
</script>
