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
    padding: 8px 10px 0;
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
    padding: 0 0 8px;
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
    padding: 0;
  }

  .form-group {
    margin-bottom: 0;
  }

  .btn-group h6 {
    font-weight: 500;
    margin: 5px 10px 0;
  }

  .capitalize {
    text-transform: capitalize;
  }
</style>

<?php defined('BASEPATH') or exit('No direct script access allowed');

// $bank_id = $_SESSION['bank_id'];
?>
<div class="container">
  <form action="<?php $_PHP_SELF ?>" method="POST">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

    <div class="timeline">
      <!-- <div class="time-label">
                <span class="bg-red">Consumables Items</span>
              </div> -->
      <div class="card">

        <div class="card-body">

          <!--                      <?php
                                    if ($_SESSION['admin_type'] == '0') {
                                      $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                                      $per = json_decode($servies_per);

                                      if ($per->Consumables_permission  == 'Write') {

                                    ?>
 
   <div class="btn-group" style="float: right;">
      <h6>Add QC for Reagents</h6>
          <a href="<?php echo $base_url; ?>/donations/qc_reagents/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div><br><br>
<?php }
                                    } else { ?>

 <div class="btn-group" style="float: right;">
      <h6>Add QC for Reagents</h6>
          <a href="<?php echo $base_url; ?>/donations/qc_reagents/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div><br><br>
<?php } ?> -->
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Date</label>
                <input type="date" class="form-control" id="price" name="date">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Name Reagent</label>
                <input type="text" class="form-control" id="price" name="reagent">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="price">Lot No./Batch No.</label>
                <input type="text" class="form-control" id="price" name="lot_no">

              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Manufactures Date</label>
                <input type="date" class="form-control" id="price" name="manufactures_date">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="price">Expiry Date</label>
                <input type="date" class="form-control" id="price" name="expiry_date">

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
          </div>


          <div class="card-footer col-md-12">
            <div class="btn-group" style="float: right;">
              <button type="submit" name="submit" class="btn btn-sm btn-danger">Filter</button>
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

<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
  <div style="overflow-x:auto;">
    <table class="table table-fluid" id="myTable">
      <thead>
        <tr>
          <th>S No</th>
          <th>Blood Bank Name</th>
          <th>Blood Bank Code</th>
          <th>Blood Bank City</th>
          <th>Date</th>
          <th>Name of Reagent</th>
          <th>Lot No./Batch No.</th>
          <th>Manufactures Date</th>
          <th>Expiry Date</th>
          <th>Physical Appearance</th>
          <th>Colour Appearance</th>
          <th>Agglutination with 50% Cell suspension of A-cell</th>
          <th>Agglutination with 50% Cell suspension of B-cell</th>
          <th>Agglutination with 50% Cell suspension of Rh +ive Cell</th>
          <th>Agglutination with 50% Cell suspension of Rh -ve Cell</th>
          <th>Clump size at 2 Mints Total Protein</th>
          <th>Time of commencing Agglutination Total Albumin</th>
          <th>Quality</th>

          <?php
          if ($_SESSION['admin_type'] == '0') {
            $servies_per = $_SESSION['bloodbank_user_servies_permission'];
            $per = json_decode($servies_per);

            if ($per->Consumables_permission == 'Write') {

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

          // print_r($_POST); die;
          if (isset($_POST['blood_bank'])) {
            $blood_bank = $_POST['blood_bank'];
          }
          $date = $_POST['date'];
          $reagent = $_POST['reagent'];
          $lot_no = $_POST['lot_no'];
          $manufactures_date = $_POST['manufactures_date'];
          $expiry_date = $_POST['expiry_date'];

          if (!empty($date) && !empty($reagent) && !empty($lot_no) && !empty($blood_bank) && !empty($manufactures_date) && !empty($expiry_date)) {

            $query = $this->db->query("SELECT bl_qc_reagents.*,bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name FROM bl_qc_reagents INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_qc_reagents.bloodbank_id INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id WHERE bl_qc_reagents.date = '$date' And bl_qc_reagents.name_reagent = '$reagent' And bl_qc_reagents.received_by = '$lot_no' And bl_qc_reagents.supply_date = '$manufactures_date' And bl_qc_reagents.expiry = '$expiry_date' And bl_blood_banks.name = '$blood_bank' ORDER BY ID DESC");
          } else {

            if (!empty($date)) {
              $search = "bl_qc_reagents.date = '$date'";
            } elseif (!empty($reagent)) {
              $search = " bl_qc_reagents.name_reagent = '$reagent'";
            } elseif (!empty($lot_no)) {
              $search = "bl_qc_reagents.received_by = '$lot_no'";
            } elseif (!empty($manufactures_date)) {
              $search = "bl_qc_reagents.supply_date = '$manufactures_date'";
            } elseif (!empty($expiry_date)) {
              $search = "bl_qc_reagents.expiry = '$expiry_date'";
            } elseif (!empty($blood_bank)) {
              $search = "bl_blood_banks.name = '$blood_bank'";
              // }elseif(!empty($start_date) && !empty($end_date)){
              //   $search = "bl_qc_reagents.created_at BETWEEN '$start_date' AND '$end_date'";
            }

            $query = $this->db->query("SELECT bl_qc_reagents.*,bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name FROM bl_qc_reagents INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_qc_reagents.bloodbank_id INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id WHERE $search ORDER BY ID DESC");
          }
        } else {
          $query = $this->db->query("SELECT bl_qc_reagents.*,bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name FROM bl_qc_reagents INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_qc_reagents.bloodbank_id INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id ORDER BY ID DESC");
        }
        foreach ($query->result() as $row) {


          $no++;
          //print_r($row);

        ?>

          <tr>
            <th scope="row"><?= $no ?></th>
            <td class="capitalize"><?= $row->name ?></td>
            <td class="capitalize"><?= $row->blood_bank_id ?></td>
            <td class="capitalize"><?= $row->city_name ?></td>
            <td class="capitalize"><?= $row->date; ?></td>
            <td class="capitalize"><?= $row->name_reagent; ?></td>
            <td class="capitalize"><?= $row->lot_no; ?></td>
            <td class="capitalize"><?= date('d-m-Y', strtotime($row->manufactures_date)); ?></td>
            <td class="capitalize"><?= date('d-m-Y', strtotime($row->expiry_date)); ?></td>
            <td class="capitalize"><?= $row->Physical; ?></td>
            <td class="capitalize"><?= $row->color_appearance; ?></td>
            <td class="capitalize"><?= $row->suspension_cell; ?></td>            
            <td class="capitalize"><?= $row->suspension_b_cell; ?></td>
            <td class="capitalize"><?= $row->suspension_Rh_pos_cell; ?></td>
            <td class="capitalize"><?= $row->suspension_Rh_neg_cell; ?></td>
            <td class="capitalize"><?= $row->total_protein; ?></td>
            <td class="capitalize"><?= $row->total_albumin; ?></td>
            <td class="capitalize"><?= $row->Quality; ?></td>

            <?php
            if ($_SESSION['admin_type'] == '0') {
              $servies_per = $_SESSION['bloodbank_user_servies_permission'];
              $per = json_decode($servies_per);

              if ($per->Consumables_permission  == 'Write') {

            ?>
                <td><?php echo '<a href="' . $this->data['base_url'] . '/all_qc_reagents/edit/' . $row->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
              <?php }
            } else { ?>
              <td><?php echo '<a href="' . $this->data['base_url'] . '/all_qc_reagents/edit/' . $row->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
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

  <!-- <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Consumables</h3>
         <div class="btn-group" style="float: right;">
          <a href="<?php echo $base_url; ?>/donations/consumable/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div>
      </div>
      <div class="card-body">
        <table id="table_consumable" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Item Name</th>
            <th>Manufacturing Name</th>
            <th>Consumable Types</th>
            <th>Recived Condition</th>
            <th>Total Quantity</th>
            <th>Result Of Testing</th>
            <th>Received By</th>
            <th>Action</th>
          </tr>
          </thead>
        
        </table>
      </div>
    </div>

  </div>

  <script type="text/javascript">
    var apppointment_search='<?php echo $base_url; ?>/donations/consumable_search';
    // var deleteSingleData='<?php echo $base_url; ?>/donations/deleteSingleData';
  </script> -->
  <script type="text/javascript">
    function deleteFun(id) {
      // alert(id);


      if (confirm('Are you sure') == true) {

        $.ajax({

          url: '<?php echo $base_url; ?>/all_qc_reagents_delete',
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