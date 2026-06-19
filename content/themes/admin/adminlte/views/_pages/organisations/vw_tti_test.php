<style type="text/css">
   .form-control {
      height: 1.6rem !important;
      padding: 0 !important;
      font-size: 0.9rem !important;
   }

   .content-header h1 {
      font-size: 18px;
      /* margin: 0 20px; */
      font-weight: bold;
   }

   label {
      margin-bottom: 0;
      font-size: 12px;
   }

   .form-group {
      margin-bottom: 0;
   }

   .content-wrapper {
      background: #fff;
      text-transform: capitalize;
   }

   .card-footer {
      padding: 10px 0 0;
      background-color: #fff;
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
      background-color: #ad1e1d !important;
      border-color: #ad1e1d !important;
   }

   .page-link {
      color: #000;
   }

   .btn-success {
      background-color: #ad1e1d !important;
      border-color: #ad1e1d !important;
   }

   .capitalize {
      text-transform: capitalize;
   }

   .card-body {
      padding: 18px 10px;
   }
</style>

<style>
   .pagination a {
      display: inline-block;
      padding: 5px 10px;
      margin-right: 5px;
      background-color: #f0f0f0;
      color: #333;
      text-decoration: none;
      border-radius: 3px;
   }

   .pagination a:hover {
      background-color: #ccc;
   }

   .pagination a:active,
   .pagination a.active {
      background-color: #333;
      color: #fff;
   }

   .pagination a.current {
      background-color: #333;
      color: #fff;
   }
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$base_url = str_replace('/admin', '', $this->data['base_url']);
if (!empty($_POST['donationform_id'])) {
   $hiv = $_POST['hiv'];
   $hbsag = $_POST['hbsag'];
   $hcv = $_POST['hcv'];
   $vdrl = $_POST['vdrl'];
   $malaria = $_POST['malaria'];
   $anti_hbc = $_POST['anti_hbc'];
   $donationform_id = $_POST['donationform_id'];
   if (($hiv == 'Negative') && ($hbsag == 'Negative') && ($hcv == 'Negative') && ($vdrl == 'Negative') && ($malaria == 'Negative') && ($anti_hbc == 'Negative')) {
      $status = 'Test done';
      $update = $this->db->query("UPDATE bl_bb_donatioform SET hiv = '$hiv',hbsag = '$hbsag',hcv = '$hcv',malaria = '$malaria',vdrl = '$vdrl',anti_hbc = '$anti_hbc', status ='$status' WHERE id = '$donationform_id'");
   } else {
      $status = 'Pending';
      $n = 5;
      function reg($n)
      {
         $characters = '0123456789qwertyuiopasdfghjklzxcvbnm';
         $randomString = '';

         for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
         }

         return $randomString;
      }

      $discard = reg($n);

      $update = $this->db->query("UPDATE bl_bb_donatioform SET hiv = '$hiv',hbsag = '$hbsag',hcv = '$hcv',malaria = '$malaria',vdrl = '$vdrl',anti_hbc = '$anti_hbc', status ='$status', discard_no ='$discard' WHERE id = '$donationform_id'");
   }
}


?>
<div class="container">
   <form action="<?php echo base_url(); ?>admin/tti_test" method="get">
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
                        <input type="text" class="form-control" id="price" name="name">

                        <input type="hidden" class="form-control" id="price" name="page" value="1">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Blood Group</label>
                        <select name="blood_group" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
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
                        <label for="description">Test Status</label>
                        <select name="status" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
                           <option value="Test done">Test done</option>
                           <option value="Pending">Pending</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Test Result</label>
                        <select name="test_result" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
                           <option value="Postive">Postive</option>
                           <option value="Negative">Negative</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Unit No</label>
                        <input type="text" class="form-control" id="price" name="unit_no">
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
               </div>
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Discard Type</label>
                        <select name="discard_type" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
                           <option value="discard">Discard</option>
                           <option value="no discard">No Discard</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">User</label>
                        <select name="user" id="vender" class="form-control">
                           <option disabled="disabled" selected="selected" value="">Select</option>
                           <?php
                           $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user");
                           foreach ($query1->result() as $type) {
                           ?>
                              <option value="<?= $type->name; ?>"><?= $type->name; ?></option>
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
                           foreach ($query12->result() as $type) {
                           ?>

                              <option value="<?= $type->name; ?>"><?= $type->name; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
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
<!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>-->

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
   <div style="overflow-x:auto;box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);padding: 12px;border-radius: 4px;margin-left: -6px;">
      <table class="table table-fluid" id="myTable">
         <thead>
            <tr>
               <th>S No</th>
               <th>Blood Bank Name</th>
               <th>Blood Bank Code</th>
               <th>Blood Bank City</th>
               <th>Name</th>
               <th>Unit No</th>
               <th>Tube No</th>
               <th>Blood Group</th>
               <th>HIV</th>
               <th>HBSAG</th>
               <th>HCV</th>
               <th>VDRL</th>
               <th>Malaria</th>
               <th>Status</th>
               <th>Date</th>
               <th>User</th>
               <th>Examination BY</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $no = 0;
            foreach ($query->result() as $row) {
               $no++;    ?>
               <tr>
                  <th scope="row"><?= $no ?></th>
                  <td class="capitalize"><?= $row->name ?></td>
                  <td class="capitalize"><?= $row->blood_bank_id ?></td>
                  <td class="capitalize"><?= $row->city_name ?></td>
                  <td class="capitalize"><?= $row->donor_name ?></td>
                  <td class="capitalize"><?= $row->unit_no ?></td>
                  <td class="capitalize"><?= $row->tube ?></td>
                  <td class="capitalize"><?= $row->blood_group ?></td>
                  <td class="capitalize"><?= $row->hiv ?></td>
                  <td class="capitalize"><?= $row->hbsag ?></td>
                  <td class="capitalize"><?= $row->hcv ?></td>
                  <td class="capitalize"><?= $row->vdrl ?></td>
                  <td class="capitalize"><?= $row->malaria ?></td>
                  <td class="capitalize"><?= $row->status ?></td>
                  <!-- <td style="text-transform: capitalize;"><?= $row->donation_date ?></td> -->
                  <td style="text-transform: capitalize;"><?= $row->donation_date ?></td>
                  <td style="text-transform: capitalize;"><?= $row->ttitest_by ?></td>
                  <td style="text-transform: capitalize;">
                     <?php if ($row->ex_name != "") {
                        echo "<strong>".$row->ex_name."</strong>";
                        echo '<img src="'.$base_url.'/' . $row->sign . '" width="70px" height="70px" />';
                     } ?>
                  </td>
                  <!--   <?php
                           if ($_SESSION['admin_type'] == '0') {
                              $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                              $per = json_decode($servies_per);

                              if ($per->TTITest_permission  == 'Write') {

                           ?>
            <td><?php echo '<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModalScrollable' . $row->id . '" style="color:white;"><i class="fa fa-check"></i></button> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
            <?php }
                           } else { ?>
            <td><?php echo '<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModalScrollable' . $row->id . '" style="color:white;"><i class="fa fa-check"></i></button> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
            <?php } ?>-->
               </tr>
            <?php } ?>
         </tbody>
      </table>
      <?php
      $total_pages = ceil($total_rows / $limit); // Total number of pages
      $num_links = 8; // Number of page links to display

      // Calculate the range of page links to display
      $start = max($page - floor($num_links / 2), 1);
      $end = min($start + $num_links - 1, $total_pages);
      $start = max($end - $num_links + 1, 1);
      ?>
      <div class="pagination" style="margin-top: 10px;">
         <?php
         if ($page > 1) {

            $query_params['page'] = $page - 1;

            $prev_url = http_build_query($query_params);
            echo '<a href="?' . $prev_url . '">Previous</a>';
         }
         for ($i = $start; $i <= $end; $i++) {
            $query_params['page'] = $i;
            $page_url = http_build_query($query_params);
            if ($i == $page) {
               echo '<a href="?' . $page_url . '" class="current">' . $i . '</a>';
            } else {
               echo '<a href="?' . $page_url . '">' . $i . '</a>';
            }
         }
         if ($page < $total_pages) {

            $query_params['page'] = $page + 1;
            $next_url = http_build_query($query_params);
            echo '<a href="?' . $next_url . '">Next</a>';
         }
         ?>
      </div>
   </div>
   <script>
      $(document).ready(function() {
         $('#myTable').DataTable({
            "paging": false
         });
      });
   </script>
   <script type="text/javascript">
      function deleteFun(id) {
         // alert(id);


         if (confirm('Are you sure') == true) {

            $.ajax({

               url: '<?php echo $base_url; ?>/tti_test_delete',
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