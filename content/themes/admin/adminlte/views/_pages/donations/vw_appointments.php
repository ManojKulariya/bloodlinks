<style type="text/css">
   .body {
      font-family: Jost, sans-serif !important;
   }

   .btn-success:not(:disabled):not(.disabled).active,
   .btn-success:not(:disabled):not(.disabled):active,
   .show>.btn-success.dropdown-toggle {
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

   table.dataTable thead>tr>th.sorting_asc,
   table.dataTable thead>tr>th.sorting_desc,
   table.dataTable thead>tr>th.sorting,
   table.dataTable thead>tr>td.sorting_asc,
   table.dataTable thead>tr>td.sorting_desc,
   table.dataTable thead>tr>td.sorting {
      font-size: 12px;
   }

   table.dataTable thead th,
   table.dataTable thead td {
      padding: 0 16px;
   }

   div.dataTables_wrapper div.dataTables_filter input {
      margin-left: 6px;
      display: inline-block;
      width: 100px;
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
<?php defined('BASEPATH') or exit('No direct script access allowed');

$bank_id = $_SESSION['bank_id'];
?>
<div class="container">
   <form action="<?php $_PHP_SELF ?>" method="POST" id="filter_form">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      <div class="timeline">

         <div class="card">
            <div class="card-body">
               <div class="row" style="box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%); border-radius: 2px; width: 100%; margin-bottom: 25px; padding: 8px;">
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Appointment Id:</label>
                        <input type="text" class="form-control" id="price" name="app_id" value="<?php if (isset($_POST) && isset($_POST['app_id'])) {
                                                                                                   echo $_POST['app_id'];
                                                                                                } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">User Id:</label>
                        <input type="text" class="form-control" id="price" name="user_id" value="<?php if (isset($_POST) && isset($_POST['user_id'])) {
                                                                                                      echo $_POST['user_id'];
                                                                                                   } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Name:</label>
                        <input type="text" class="form-control" id="price" name="name" value="<?php if (isset($_POST) && isset($_POST['name'])) {
                                                                                                   echo $_POST['name'];
                                                                                                } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Status:</label>
                        <select name="status" id="vender" class="form-control">
                           <option value="donated" selected disabled="disabled">Select</option>
                           <option value="donated" <?php if (isset($_POST) && isset($_POST['status'])) {
                                                      if ($_POST['status'] == 'donated') {
                                                         echo "selected='selected'";
                                                      }
                                                   } ?>>Donated</option>
                           <option value="not donated" <?php if (isset($_POST) && isset($_POST['status'])) {
                                                            if ($_POST['status'] == 'not donated') {
                                                               echo "selected='selected'";
                                                            }
                                                         } ?>>Not Donated</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?php if (isset($_POST) && isset($_POST['start_date'])) {
                                                                                                            echo $_POST['start_date'];
                                                                                                         } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?php if (isset($_POST) && isset($_POST['end_date'])) {
                                                                                                         echo $_POST['end_date'];
                                                                                                      } ?>">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Application Id</label>
                        <input type="text" class="form-control" id="price" name="application_id" value="<?php if (isset($_POST) && isset($_POST['application_id'])) {
                                                                                                            echo $_POST['application_id'];
                                                                                                         } ?>">
                     </div>
                  </div>

                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">City</label>
                        <select name="city" id="vender" class="form-control">
                           <option value="#" selected disabled>Select</option>
                           <?php
                           $query1 = $this->db->query("SELECT * FROM bl_districts");
                           foreach ($query1->result() as $type) {
                           ?>
                              <option value="<?= $type->district_name; ?>" <?php if (isset($_POST) && isset($_POST['city'])) {
                                                                              if ($_POST['city'] == $type->district_name) {
                                                                                 echo "selected='selected'";
                                                                              }
                                                                           } ?>><?= $type->district_name; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>

                  <div class="col-md-12">
                     <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                           <button type="submit" name="submit" class="btn btn-sm btn-danger">Filter</button> <button class="btn btn-sm btn-warning mx-2 text-white" id="reset" name="reset" type="submit" /> Reset</button>
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
   <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
   <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <div class="container" style="
   box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%); padding: 20px; border-radius: 2px; background: #fff; margin-left: -7px;">
      <table class="table table-fluid table-responsive" id="myTable">
         <thead>
            <tr>
               <th>S No</th>
               <th>Appointment Id</th>
               <th>Application No</th>
               <th>Name</th>
               <th>Mobile No</th>
               <th>Date</th>
               <th>Donor Type</th>
               <th>Donation Status</th>
               <!-- <th>Checking Pending</th> -->
               <?php
               if ($_SESSION['admin_type'] == '0') {
                  $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                  $per = json_decode($servies_per);

                  if ($per->Donation_permission  == 'Write') {

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
            foreach ($appointments as $row) {
               if (!empty($row->mid_name)) {
                  $name = $row->first_name . ' ' . $row->mid_name . ' ' . $row->last_name;
               } else {
                  $name = $row->first_name . ' ' . $row->last_name;
               }

               $no++;
               // print_r($row);
            ?>
               <tr>
                  <th scope="row"><?= $no ?></th>
                  <td><?= $row->id ?></td>
                  <td><?= $row->application_no ?></td>
                  <td style="text-transform: capitalize;"><?= $name ?></td>
                  <td><?= $row->ph_no ?></td>
                  <td><?= date('d-m-Y', strtotime($row->requested_schedule_date)) ?></td>
                  <td></td>
                  <td style="text-transform: capitalize;"><?= $row->donation_status ?><br>
                  <?php
                      if($row->donation_status == 'defer'){ ?>
                         <b>(<?= $row->deffer_type ?>)</b>
                    <?php  }  ?>
                  </td>
                  <!-- <td></td> -->
                  <?php if ($row->donation_status == 'not donated') {
                     $checkin = '<a href="' . $this->data['base_url'] . '/donations/check_in/' . $row->donation_form_id . '/' . $row->user_id . '" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-check"></i></a> <a href="' . $this->data['base_url'] . '/donations/donation_form/' . $row->donation_form_id . '/' . $row->user_id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>';
                  } else {
                     $checkin = '<a href="' . $this->data['base_url'] . '/donations/download/' . $row->donation_form_id . '/' . $row->user_id . '" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>';
                  }
                  ?>
                  <?php
                  if ($_SESSION['admin_type'] == '0') {
                     $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                     $per = json_decode($servies_per);

                     if ($per->Donation_permission == 'Delete') {

                  ?>
                        <td><?php echo $checkin . '   <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
                     <?php }
                  } else { ?>
                     <td><?php echo $checkin . '   <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
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
      var apppointment_search = '<?php echo $base_url; ?>/donations/appointments_search';
   </script>
   <script type="text/javascript">
      function deleteFun(id) {
         // alert(id);


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
      $("#reset").click(function() {
         $("input,select").val("");
         window.location.href = window.location.href;
      });
   </script>