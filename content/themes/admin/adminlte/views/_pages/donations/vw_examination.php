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

   #myTable {
      font-size: 14px;
   }
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed');
$bank_id = $_SESSION['bank_id'];
// echo "<pre>";
// print_r($_SESSION);die();
?>
<div class="container">
   <form action="<?php $_PHP_SELF ?>" method="POST">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      <div class="timeline">
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Name</label>
                        <input type="text" class="form-control" id="price" name="name">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Unit No</label>
                        <input type="text" class="form-control" id="price" name="user_no">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Application No</label>
                        <input type="text" class="form-control" id="price" name="application_no">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Donor Type</label>
                        <select name="donor_type" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
                           <option value="Volunter">Volunter</option>
                           <option value="replacement">Replacement</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Mobile No</label>
                        <input type="tel" class="form-control" id="price" name="mobile">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Blood Group</label>
                        <select name="blood_group" id="vender" class="form-control">
                           <option value="" disabled="disabled" selected="selected">Select</option>
                           <option value="A+">A+</option>
                           <option value="A-">A-</option>
                           <option value="B+">B+</option>
                           <option value="B-">B-</option>
                           <option value="AB+">AB+</option>
                           <option value="AB-">AB-</option>
                           <option value="O+">O+</option>
                           <option value="O-">O-</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Start Date</label>
                        <input type="date" class="form-control" id="price" name="start_date">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">End Date</label>
                        <input type="date" class="form-control" id="price" name="end_date">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Donation Type</label>
                        <select name="donation_type" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
                           <option value="direct">Direct</option>
                           <option value="camp">Camp</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Type</label>
                        <select name="type" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
                           <option value="Online">Online</option>
                           <option value="Offline">Offline</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">City</label>
                        <input type="text" class="form-control" id="price" name="city">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">User</label>
                        <select name="user" id="vender" class="form-control">
                           <option value="#" selected disabled>Select</option>
                           <?php
                           $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user");
                           foreach ($query1->result() as $type) {
                           ?>

                              <option value="<?= $type->name; ?>"><?= $type->name; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                           <button type="submit" name="submit" class="btn btn-sm btn-danger">Filter</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
   </form>
</div>
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
               <?php
               if ($_SESSION['admin_type'] == '0') {
                  $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                  $per = json_decode($servies_per);
                  if ($per->ex_permission  == 'Write') {
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
            $no = 0;
            if (!empty($_POST)) {
               if (isset($_POST['donor_type'])) {
                  $donor_type = $_POST['donor_type'];
               }
               if (isset($_POST['blood_group'])) {
                  $blood_group = $_POST['blood_group'];
               }
               if (isset($_POST['donation_type'])) {
                  $donation_type = $_POST['donation_type'];
               }
               if (isset($_POST['type'])) {
                  $type = $_POST['type'];
               }
               if (isset($_POST['user'])) {
                  $user = $_POST['user'];
               }
               $name = $_POST['name'];
               $user_no = $_POST['user_no'];
               $application_no = $_POST['application_no'];

               $mobile = $_POST['mobile'];

               $start_date = $_POST['start_date'];
               $end_date = $_POST['end_date'];


               $city = $_POST['city'];


               if (
                  !empty($name) && !empty($user_no) && !empty($donor_type) && !empty($mobile) && !empty($application_no)
                  && !empty($blood_group) && !empty($donation_type) && !empty($city) && !empty($user)
                  && (!empty($start_date) && !empty($end_date))
               ) {

                  $query = $this->db->query("SELECT * FROM ` WHERE donation_date BETWEEN '$start_date' AND '$end_date' AND bl_bb_donatioform.bloodbank_id = '$bank_id' And bl_bb_donatioform.donor_name = '$name' And bl_bb_donatioform.unit_no = '$user_no' And bl_bb_donatioform.donor_type = '$donor_type' And bl_bb_donatioform.mobile = '$mobile' And bl_bb_donatioform.blood_group = '$blood_group' And bl_bb_donatioform.camp_status = '$donation_type' And bl_bb_donatioform.city = '$city' And bl_bb_donatioform.application_no = '$application_no' And bl_bb_donatioform.donation_by = '$user' ORDER BY ID DESC");
               } else {

                  if (!empty($name)) {
                     $search = "bl_bb_donatioform.donor_name = '$name'";
                  } elseif (!empty($mobile)) {
                     $search = "bl_bb_donatioform.mobile = '$mobile'";
                  } elseif (!empty($start_date)) {
                     $search = "bl_bb_donatioform.donation_date = '$start_date'";
                  } elseif (!empty($end_date)) {
                     $search = "bl_bb_donatioform.donation_date = '$end_date'";
                  } elseif (!empty($user_no)) {
                     $search = "bl_bb_donatioform.unit_no = '$user_no'";
                  } elseif (!empty($donor_type)) {
                     $search = "bl_bb_donatioform.donor_type = '$donor_type'";
                  } elseif (!empty($blood_group)) {
                     $search = "bl_bb_donatioform.blood_group = '$blood_group'";
                  } elseif (!empty($donation_type)) {
                     $search = "bl_bb_donatioform.camp_status = '$donation_type'";
                  } elseif (!empty($application_no)) {
                     $search = "bl_bb_donatioform.application_no = '$application_no'";
                  } elseif (!empty($city)) {
                     $search = "bl_bb_donatioform.city = '$city'";
                  } elseif (!empty($user)) {
                     $search = "bl_bb_donatioform.donation_by = '$user'";
                  } elseif (!empty($start_date) && !empty($end_date)) {
                     $search = "donation_date BETWEEN '$start_date' AND '$end_date'";
                  }

                  $query = $this->db->query("SELECT bl_bb_donatioform.*,bl_donor_examination.examiner_id FROM bl_bb_donatioform  LEFT JOIN bl_donor_examination ON bl_bb_donatioform.id = bl_donor_examination.donation_id WHERE bl_bb_donatioform.bloodbank_id = '$bank_id' And $search ORDER BY ID DESC");
               }
            } else {
               $query = $this->db->query("SELECT bl_bb_donatioform.*,bl_donor_examination.examiner_id FROM bl_bb_donatioform  LEFT JOIN bl_donor_examination ON bl_bb_donatioform.id = bl_donor_examination.donation_id WHERE bl_bb_donatioform.bloodbank_id = '$bank_id' ORDER BY ID DESC");
            }
            foreach ($query->result() as $row) {
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
                  <?php
                  if ($_SESSION['admin_type'] == '0') {
                     $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                     $per = json_decode($servies_per);
                     if ($per->ex_permission  == 'Write') {
                        if ($row->examiner_id == "") { ?>
                           <td><?php echo '<button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-check"></i></button>'; ?></td>

                        <?php } else { ?>
                           <td>Examination Done</td>
                        <?php }
                        ?>
                  <?php }
                  } else {
                  } ?>
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
         if (confirm('Are you sure? After exmination done this entery will remove from list!') == true) {

            $.ajax({
               url: '<?php echo $base_url; ?>/donations/Examination_done',
               method: "POST",
               datatype: "json",
               data: {
                  [csrf_name]: csrf_hash,
                  id: id
               },
               success: function(d) {
                  if (d == 1) {
                     alert('Examination Done Successfully');
                     location.reload();
                  } else {
                     alert('Examination already done or Fail!');
                  }
               }
            })
         }
      }
   </script>