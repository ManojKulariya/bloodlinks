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
    padding: 0 10px;
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

  .btn-success {
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

  .form-group {
    margin-bottom: 0;
  }

  .capitalize {
    text-transform: capitalize;
  }
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed');

//$bank_id = $_SESSION['bank_id'];
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


          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Issue No</label>
                <input type="text" class="form-control" id="price" name="issue_no">
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
                <label for="description">Request No</label>
                <input type="text" class="form-control" id="price" name="request">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Name</label>
                <input type="text" class="form-control" id="price" name="name">
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Mobile No</label>
                <input type="tel" class="form-control" id="price" name="mobile">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Components</label>
                <input type="text" class="form-control" id="price" name="Component">
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
            <div class="col-md-6">
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

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
  <div style="overflow-x:auto;box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);padding: 12px;border-radius: 4px;margin-left: -6px;">
    <table class="table table-fluid" id="myTable">
      <thead>
        <tr>
          <th>S No</th>
          <th>Unit No</th>
          <th>Blood Bank Name</th>
          <th>Blood Bank Code</th>
          <th>Blood Bank City</th>
          <th>Issue No</th>
          <th>Request No</th>
          <th>Tube No</th>
          <th>Name</th>
          <th>Mobile No</th>
          <th>Blood Group</th>
          <th>Components</th>
          <th>Date</th>
          <th>User</th>

          <?php
          if ($_SESSION['admin_type'] == '0') {
            $servies_per = $_SESSION['bloodbank_user_servies_permission'];
            $per = json_decode($servies_per);

            if ($per->IssueBlood_permission == 'Write') {

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

          if (isset($_POST['user'])) {
            $user = $_POST['user'];
          }
          if (isset($_POST['blood_group'])) {
            $blood_group = $_POST['blood_group'];
          }
          if (isset($_POST['blood_bank'])) {
            $blood_bank = $_POST['blood_bank'];
          }
          $name = $_POST['name'];

          $issue_no = $_POST['issue_no'];
          $request = $_POST['request'];
          $mobile = $_POST['mobile'];
          $Component = $_POST['Component'];
          $start_date = $_POST['start_date'];
          $end_date = $_POST['end_date'];

          if (!empty($name) && !empty($issue_no) && !empty($request) && !empty($Component) && !empty($blood_bank) && !empty($blood_group) && !empty($user) && (!empty($start_date) && !empty($end_date))) {

            $query = $this->db->query("SELECT bl_crossmatch.*, bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name FROM bl_crossmatch INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id WHERE issue_date BETWEEN '$start_date' AND '$end_date' And bl_crossmatch.status = 'issued' And bl_crossmatch.p_name = '$name' And bl_crossmatch.issue_no = '$issue_no' And bl_crossmatch.blood_group = '$blood_group' And bl_crossmatch.request = '$request' And bl_crossmatch.component = '$Component' And bl_crossmatch.issue_by = '$user'And bl_blood_banks.name = '$blood_bank' ORDER BY ID DESC");
          } else {

            if (!empty($name)) {
              $search = "bl_crossmatch.p_name = '$name'";
            } elseif (!empty($issue_no)) {
              $search = "bl_crossmatch.issue_no = '$issue_no'";
            } elseif (!empty($request)) {
              $search = "bl_crossmatch.request = '$request'";
            } elseif (!empty($blood_group)) {
              $search = "bl_crossmatch.blood_group = '$blood_group'";
            } elseif (!empty($Component)) {
              $search = "bl_crossmatch.component = '$Component'";
            } elseif (!empty($user)) {
              $search = "bl_crossmatch.issue_by = '$user'";
            } elseif (!empty($blood_bank)) {
              $search = "bl_blood_banks.name = '$blood_bank'";
            } elseif (!empty($start_date) && !empty($end_date)) {
              $search = "issue_date BETWEEN '$start_date' AND '$end_date'";
            }

            $query = $this->db->query("SELECT bl_crossmatch.*, bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name FROM bl_crossmatch INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id WHERE bl_crossmatch.status = 'issued' And $search ORDER BY ID DESC");
          }
        } else {
          $query = $this->db->query("SELECT bl_crossmatch.*, bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name FROM bl_crossmatch INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id WHERE bl_crossmatch.status = 'issued' ORDER BY ID DESC");
        }
        foreach ($query->result() as $row) {
          $no++;
        ?>

          <tr>
            <th scope="row"><?= $no ?></th>
            <td class="capitalize"><?= $row->unit_no ?></td>
            <td class="capitalize"><?= $row->name ?></td>
            <td class="capitalize"><?= $row->blood_bank_id ?></td>
            <td class="capitalize"><?= $row->city_name ?></td>
            <td class="capitalize"><?= $row->issue_no ?></td>
            <td class="capitalize"><?= $row->request ?></td>
            <td class="capitalize"><?= $row->tube_no ?></td>
            <td class="capitalize"><?= $row->p_name ?></td>
            <td class="capitalize"></td>
            <td class="capitalize"><?= $row->blood_group ?></td>
            <td class="capitalize"><?= $row->component ?></td>
            <td class="capitalize"><?= $row->issue_date ?></td>
            <td class="capitalize"><?= $row->issue_by ?></td>


            <?php
            if ($_SESSION['admin_type'] == '0') {
              $servies_per = $_SESSION['bloodbank_user_servies_permission'];
              $per = json_decode($servies_per);

              if ($per->IssueBlood_permission  == 'Write') {

            ?>
                <td class="capitalize"><?php echo '<a href="' . $this->data['base_url'] . '/issue_blood_download/' . $row->id . '" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>'; ?></td>
              <?php }
            } else { ?>
              <td class="capitalize"><?php echo '<a href="' . $this->data['base_url'] . '/issue_blood_download/' . $row->id . '" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>'; ?></td>
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
        <h3 class="card-title">Blood Issue</h3>
         <div class="btn-group" style="float: right;">
          <a href="<?php echo $base_url; ?>/request/issue_blood_form" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div>
      </div>
      <div class="card-body">
        <table id="table_issueblood" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Unit No.</th>
            <th>Blood Group</th>
            <th>Component</th>
            <th>Tube No.</th>
            <th>Bleeding Date</th>
            <th>Expiry Date</th>
            <th>Status</th>
            <th>Core</th>
            <th>Part</th>
            <th>NAT</th>
            <th>Action</th>
            
          </tr>
          </thead>
        
        </table>
      </div>

    </div>

  </div>

  <script type="text/javascript">
    var apppointment_search='<?php echo $base_url; ?>/request/issue_bloodform_search';
    // var deleteSingleData='<?php echo $base_url; ?>/donations/deleteSingleData';
  </script> -->
  <script type="text/javascript">
    function deleteFun(id) {
      // alert(id);

      if (confirm('Are you sure') == true) {

        $.ajax({

          url: '<?php echo $base_url; ?>/request/issue_bloodform_delete',
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