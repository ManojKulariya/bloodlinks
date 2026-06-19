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

  .page-link {
    color: #000 !important;
  }

  .page-item.active .page-link {
    color: #fff !important;
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
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
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
                <label for="description">Unit No</label>
                <input type="text" class="form-control" id="price" name="unit_no">
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
                <label for="description">Components</label>
                <input type="text" class="form-control" id="price" name="Component">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Bag Config</label>
                <select name="blood_type" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
                  <option value="Mother">Mother</option>
                  <option value="Satellite">Satellite</option>

                </select>
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">TTI Test</label>
                <select name="tti_test" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
                  <option value="Test done">Yes</option>
                  <option value="No">No</option>

                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Cross Match</label>
                <select name="cross_match" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>

                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Issue</label>
                <select name="issue" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>

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
          <th>Unit No.</th>
          <th>Component</th>
          <th>Bag Config</th>
          <th>Blood Group</th>
          <th>Blood Vol.</th>
          <th>TTI Tested (Yes/No)</th>
          <th>Cross Match</th>
          <th>Issued Status</th>
          <th>Issued Vol.</th>
          <th>Final Volume</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $no = 0;
        if (!empty($_POST)) {

          //print_r($_POST); die;

          $unit_no = $_POST['unit_no'];
          if (isset($_POST['blood_group'])) {
            $blood_group = $_POST['blood_group'];
          }
          if (isset($_POST['blood_type'])) {
            $blood_type = $_POST['blood_type'];
          }
          if (isset($_POST['tti_test'])) {
            $tti_test = $_POST['tti_test'];
          }
          if (isset($_POST['issue'])) {
            $issue = $_POST['issue'];
          }
          if (isset($_POST['cross_match'])) {
            $cross_match = $_POST['cross_match'];
          }
          $Component = $_POST['Component'];

          if (!empty($blood_type) && !empty($blood_group) && !empty($Component) && !empty($unit_no) && !empty($tti_test) && !empty($cross_match) && !empty($issue)) {

            $query = $this->db->query("SELECT * FROM bl_blood_record WHERE bl_blood_record.bag_config = '$blood_type' And bl_blood_record.unit_no = '$unit_no' And bl_blood_record.blood_group = '$blood_group' And bl_blood_record.component = '$Component' And bl_blood_record.tti_test = '$tti_test' And bl_blood_record.cross_match = '$cross_match' And bl_blood_record.issue_status = '$issue' ORDER BY (CASE WHEN expiry_date < CURDATE() THEN 1 ELSE 0 END), expiry_date ASC");
          } else {

            if (!empty($unit_no)) {
              $search = "bl_blood_record.unit_no = '$unit_no'";
            } elseif (!empty($blood_group)) {
              $search = "bl_blood_record.blood_group = '$blood_group'";
            } elseif (!empty($Component)) {
              $search = "bl_blood_record.component = '$Component'";
            } elseif (!empty($blood_type)) {
              $search = "bl_blood_record.bag_config = '$blood_type'";
            } elseif (!empty($tti_test)) {
              $search = "bl_blood_record.tti_test = '$tti_test'";
            } elseif (!empty($cross_match)) {
              $search = "bl_blood_record.cross_match = '$cross_match'";
            } elseif (!empty($issue)) {
              $search = "bl_blood_record.issue_status = '$issue'";
            }
            $query = $this->db->query("SELECT * FROM bl_blood_record  WHERE $search ORDER BY (CASE WHEN expiry_date < CURDATE() THEN 1 ELSE 0 END), expiry_date ASC");
          }
        } else {
          $query = $this->db->query("SELECT * FROM bl_blood_record ORDER BY (CASE WHEN expiry_date < CURDATE() THEN 1 ELSE 0 END), expiry_date ASC");
        }
        foreach ($query->result() as $row) {
          $no++;
          $expiry_date = new DateTime($row->expiry_date);
          $today = new DateTime();
          $expiry_date_only = $expiry_date->format('Y-m-d');
          $today_only = $today->format('Y-m-d');
          $days_to_expiry = $expiry_date->diff($today)->days;

          $class = '';
          if ($expiry_date_only < $today_only) {
            $class = 'expired'; // expired
          } elseif ($days_to_expiry <= 7 || $days_to_expiry == 0) {
            $class = 'expiring-soon'; // red
          } elseif ($days_to_expiry <= 15) {
            $class = 'expiring-later'; // yellow
          } else {
            $class = 'safe'; // green
          }
        ?>
          <tr class="<?= $class ?>">
            <th scope="row"><?= $no ?></th>
            <td class="capitalize"><?= $row->unit_no ?></td>
            <td class="capitalize"><?= $row->component ?></td>
            <td class="capitalize"><?= $row->bag_config ?></td>
            <td class="capitalize"><?= $row->blood_group ?></td>
            <td class="capitalize"><?= $row->blood_volume ?></td>
            <td class="capitalize"><?= $row->tti_test ?></td>
            <td class="capitalize"><?= $row->cross_match ?></td>
            <td class="capitalize"><?= $row->issue_status ?></td>
            <td class="capitalize"><?= $row->issued_vol ?></td>
            <td class="capitalize"><?= $row->final_vol ?></td>
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
  <style>
    .expired {
      background-color: #fff !important;
    }

    .expiring-soon {
      background-color: #ED401B !important;
      /* Red for expiring in 7 days */
      color: #fff;
    }

    .expiring-later {
      background-color: #EDF545 !important;
      /* Yellow for expiring in 15 days */
    }

    .safe {
      background-color: #91FB58 !important;
      /* Green for safe */
    }
  </style>