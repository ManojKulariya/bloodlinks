<style type="text/css">
   .content-wrapper {
      background: #fff;
      text-transform: capitalize;
   }

   .content-header h1 {
      font-size: 1.2rem !important;
      /* margin: 0 20px; */
      font-weight: 700 !important;
   }

   .card-footer {
      padding: 10px 20px;
      background-color: #fff;
   }

   .form-control {
      height: 1.6rem;
      font-size: 0.9rem;
      padding: 0px;
   }

   label {
      font-size: 12px;
   }

   .form-group {
      margin-bottom: 0;
   }

   table.dataTable thead>tr>th.sorting_asc,
   table.dataTable thead>tr>th.sorting_desc,
   table.dataTable thead>tr>th.sorting,
   table.dataTable thead>tr>td.sorting_asc,
   table.dataTable thead>tr>td.sorting_desc,
   table.dataTable thead>tr>td.sorting {
      padding-right: 15px;
      font-size: 12px;
   }

   table.dataTable tbody th,
   table.dataTable tbody td {
      padding: 6px !important;
      font-size: 14px;
   }

   .btn-xs {
      padding: 2px;
      font-size: 10px;
   }

   table.dataTable thead th,
   table.dataTable thead td {
      padding: 0 15px !important;
   }

   .page-item.active .page-link {
      background-color: #dc3545;
      border-color: #dc3545;
   }

   .page-link {
      color: #000;
   }

   .capitalize {
      text-transform: capitalize;
   }

   label {
      margin-bottom: 0;
   }

   .card-body {
      padding: 0 10px;
   }
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container">
   <form action="<?= base_url('admin/donation_forms'); ?>" method="GET">

        <div class="timeline">
         <!-- <div class="time-label">
         <span class="bg-red">Consumables Items</span>
         </div> -->
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Name</label>
                        <input type="text" class="form-control" id="price" name="name" value="<?php if(isset($_GET) && isset($_GET['name'])){ echo $_GET['name']; } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Unit No</label>
                        <input type="text" class="form-control" id="price" name="user_no"  value="<?php if(isset($_GET) && isset($_GET['user_no'])){ echo $_GET['user_no']; } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Application No</label>
                        <input type="text" class="form-control" id="price" name="application_no" value="<?php if(isset($_GET) && isset($_GET['application_no'])){ echo $_GET['application_no']; } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Donor Type</label>
                        <select name="donor_type" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
                           <option value="Volunter" <?php if(isset($_GET) && isset($_GET['donor_type'])){  if($_GET['donor_type'] == "Volunter") {echo"selected='selected'";} } ?>>Volunter</option>
                           <option value="replacement" <?php if(isset($_GET) && isset($_GET['donor_type'])){  if($_GET['donor_type'] == "replacement") {echo"selected='selected'";} } ?>>Replacement</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Mobile No</label>
                        <input type="tel" class="form-control" id="price" name="mobile" value="<?php if(isset($_GET) && isset($_GET['mobile'])){ echo $_GET['mobile']; } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Blood Group</label>
                        <select name="blood_group" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
                           <option value="A+" <?php if(isset($_GET) && isset($_GET['blood_group'])){  if($_GET['blood_group'] == "A+") {echo"selected='selected'";} } ?>>A+</option>
                           <option value="A-" <?php if(isset($_GET) && isset($_GET['blood_group'])){  if($_GET['blood_group'] == "A-") {echo"selected='selected'";} } ?>>A-</option>
                           <option value="B+" <?php if(isset($_GET) && isset($_GET['blood_group'])){  if($_GET['blood_group'] == "B+") {echo"selected='selected'";} } ?>>B+</option>
                           <option value="B-" <?php if(isset($_GET) && isset($_GET['blood_group'])){  if($_GET['blood_group'] == "B-") {echo"selected='selected'";} } ?>>B-</option>
                           <option value="AB+" <?php if(isset($_GET) && isset($_GET['blood_group'])){  if($_GET['blood_group'] == "AB+") {echo"selected='selected'";} } ?>>AB+</option>
                           <option value="AB-" <?php if(isset($_GET) && isset($_GET['blood_group'])){  if($_GET['blood_group'] == "AB-") {echo"selected='selected'";} } ?>>AB-</option>
                           <option value="O+" <?php if(isset($_GET) && isset($_GET['blood_group'])){  if($_GET['blood_group'] == "O+") {echo"selected='selected'";} } ?>>O+</option>
                           <option value="O-" <?php if(isset($_GET) && isset($_GET['blood_group'])){  if($_GET['blood_group'] == "O-") {echo"selected='selected'";} } ?>>O-</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Start Date</label>
                        <input type="date" class="form-control" id="price" name="start_date" value="<?php if(isset($_GET) && isset($_GET['start_date'])){ echo $_GET['start_date']; } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">End Date</label>
                        <input type="date" class="form-control" id="price" name="end_date" value="<?php if(isset($_GET) && isset($_GET['end_date'])){ echo $_GET['end_date']; } ?>">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Donation Type</label>
                        <select name="donation_type" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
                           <option value="direct" <?php if(isset($_GET) && isset($_GET['donation_type'])){  if($_GET['donation_type'] == 'direct') {echo"selected='selected'";} } ?>>Direct</option>
                           <option value="camp" <?php if(isset($_GET) && isset($_GET['donation_type'])){  if($_GET['donation_type'] == "camp") {echo"selected='selected'";} } ?>>Camp</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Type</label>
                        <select name="type" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
                           <option value="Online" <?php if(isset($_GET) && isset($_GET['type'])){  if($_GET['type'] == "Online") {echo"selected='selected'";} } ?>>Online</option>
                           <option value="Offline" <?php if(isset($_GET) && isset($_GET['type'])){  if($_GET['type'] == "'Offline") {echo"selected='selected'";} } ?>>Offline</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">City</label>
                        <input type="text" class="form-control" id="price" name="city" value="<?php if(isset($_GET) && isset($_GET['city'])){ echo $_GET['city']; } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">User</label>
                        <select name="user" id="vender" class="form-control">
                           <option value="#" selected disabled>Select</option>
                           <?php
                           $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user");
                           foreach ($query1->result() as $type_user) {
                           ?>
                              <option value="<?= $type_user->name; ?>" <?php if(isset($_GET) && isset($_GET['user'])){  if($_GET['user'] == $type_user->name) {echo"selected='selected'";} } ?>><?= $type_user->name; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Blood Bank</label>
                        <select name="blood_bank" id="vender" class="form-control">
                           <option value="#" selected disabled>Select</option>
                           <?php
                           $query12 = $this->db->query("SELECT * FROM bl_blood_banks");
                           foreach ($query12->result() as $type_bank) {
                           ?>

                              <option value="<?= $type_bank->name; ?>" <?php if(isset($_GET) && isset($_GET['blood_bank'])){  if($_GET['blood_bank'] == $type_bank->name) {echo"selected='selected'";} } ?>><?= $type_bank->name; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="card-footer">
                  <div class="btn-group" style="float: right;">
                     <button type="submit" name="submit" class="btn btn-sm btn-danger">Filter</button>
					  <button class="btn btn-sm btn-warning mx-2 text-white" id="reset" />Reset</button>
                  </div>
               </div>
            </div>
         </div>
        </div>
   </form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
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
               <th>Blood Bank Name</th>
               <th>Blood Bank Code</th>
               <th>Blood Bank City</th>
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
               <th>Examination</th>
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
            
            $base_url = str_replace('/admin', '', $this->data['base_url']);
            $current_page = $current_page== 0?$current_page:$current_page-1;
            $start = ($current_page) * $limit;
            foreach ($donations as $index=>$row) {
                 $sr_no = $start + $index + 1;
            ?>
               <tr>
                  <th scope="row"><?= $sr_no ?></th>
                  <td style="text-transform: capitalize;"><?= $row->donor_name ?></td>
                  <td style="text-transform: capitalize;"><?= $row->application_no ?></td>
                  <td style="text-transform: capitalize;"><?= $row->name ?></td>
                  <td style="text-transform: capitalize;"><?= $row->blood_bank_id ?></td>
                  <td style="text-transform: capitalize;"><?= $row->city_name ?></td>
                  <td style="text-transform: capitalize;"><?= $row->unit_no ?></td>
                  <td><?= $row->tube ?></td>
                  <td><?= $row->mobile ?></td>
                  <td style="text-transform: capitalize;"><?= $row->donor_type ?></td>
                  <td style="text-transform: capitalize;"><?= $row->blood_group ?></td>
                  <td style="text-transform: capitalize;"><?= $row->donation_date ?></td>
                  <td style="text-transform: capitalize;"><?= $row->camp_status ?></td>
                  <td><?= $row->place ?></td>
                  <td style="text-transform: capitalize;"><?= $row->donor_type ?></td>
                  <td style="text-transform: capitalize;"><?= $row->donation_by ?></td>
                  <td style="text-transform: capitalize;">
                     <?php if ($row->ex_name != "") {
                        echo "DONE BY<br><strong>".$row->ex_name."</strong>";
                        echo '<img src="'.$base_url.'/' . $row->sign . '" width="70px" height="70px" />';
                     } ?>
                  </td>
                  <?php
                  if ($_SESSION['admin_type'] == '0') {
                     $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                     $per = json_decode($servies_per);

                     if ($per->DonorRegister_permission  == 'Write') {

                  ?>
                        <td class="capitalize"><?php echo '<a href="' . $this->data['base_url'] . '/donation_forms_edit/' . $row->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
                     <?php }
                  } else { ?>
                     <td class="capitalize"><?php echo '<a href="' . $this->data['base_url'] . '/donation_forms_edit/' . $row->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
                  <?php } ?>
               </tr>
            <?php } ?>
         </tbody>
      </table>
      <!-- Pagination links -->
      <?= $pagination_links ?>
   </div>
   <script>
      $(document).ready(function() {
          $('#myTable').DataTable({
            "paging": false,     // Disable default pagination
            "info": false,       // Disable "Showing X to Y of Z entries"
            "searching": false   // Disable the search box
        });
      });
   </script>
  
   <script type="text/javascript">
      function deleteFun(id) {
         // alert(id);


         if (confirm('Are you sure') == true) {

            $.ajax({

               url: '<?php echo $base_url; ?>/donation_forms_delete',
               method: "POST",
               datatype: "json",
               data: {
                  [csrf_name]: csrf_hash,
                  id: id
               },

               success: function(d) {
                  // console.log (d);
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
   </script>
 <script>
  $("#reset").click(function(){
   var url ="<?= base_url('admin/donation_forms') ?>";
   $("input,select").val("");
   window.location.href = url;
});

</script>