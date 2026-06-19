<style type="text/css">
  .form-control {
    height: 25px !important;
    padding: 0 10px !important;
    font-size: 15px !important;
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

  .btn-group h6 {
    font-weight: 500;
    margin: 5px 10px 0;
  }

  .capitalize {
    text-transform: capitalize;
  }
</style>

<?php defined('BASEPATH') or exit('No direct script access allowed');

$bank_id = $_SESSION['bank_id'];
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
          <?php
          if ($_SESSION['admin_type'] == '0') {
            $servies_per = $_SESSION['bloodbank_user_servies_permission'];
            $per = json_decode($servies_per);

            if ($per->RequestRegister_permission  == 'Write') {

          ?>
              <div class="btn-group" style="float: right;">
                <h6>Add Blood Request Form</h6>
                <a href="<?php echo $base_url; ?>/request/request_form_add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
              </div><br><br>
            <?php }
          } else { ?>
            <div class="btn-group" style="float: right;">
              <h6>Add Blood Request Form</h6>
              <a href="<?php echo $base_url; ?>/request/request_form_add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
            </div><br><br>
          <?php } ?>

          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Name</label>
                <input type="text" class="form-control" id="price" name="name" value="<?php if (isset($_POST) && isset($_POST['name'])) {
                                                                                        echo $_POST['name'];
                                                                                      } ?>">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Request No</label>
                <input type="text" class="form-control" id="price" name="request_no" value="<?php if (isset($_POST) && isset($_POST['request_no'])) {
                                                                                              echo $_POST['request_no'];
                                                                                            } ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Mobile No</label>
                <input type="tel" class="form-control" id="price" name="mobile" value="<?php if (isset($_POST) && isset($_POST['mobile'])) {
                                                                                          echo $_POST['mobile'];
                                                                                        } ?>">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">

                <label for="description">Type</label>
                <select name="type" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
                  <option value="Online" <?php if (isset($_POST) && isset($_POST['type'])) {
                                            if ($_POST['type'] == 'Online') {
                                              echo "selected='selected'";
                                            }
                                          } ?>>Online</option>
                  <option value="Offline" <?php if (isset($_POST) && isset($_POST['type'])) {
                                            if ($_POST['type'] == 'Offline') {
                                              echo "selected='selected'";
                                            }
                                          } ?>>Offline</option>

                </select>
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Hospital</label>
                <select class="form-control" name="hospital">
                  <option disabled="disabled" selected="selected" value="" style="margin:0px !important;">Select</option>

                  <?php
                  $query3 = $this->db->query("SELECT * FROM bl_blood_banks where org_type = 'Hospital'");
                  foreach ($query3->result() as $hospitals) { ?>
                    <option value="<?= $hospitals->name; ?>" <?php if (isset($_POST) && isset($_POST['hospital'])) {
                                                                if ($_POST['hospital'] == $hospitals->name) {
                                                                  echo "selected='selected'";
                                                                }
                                                              } ?>><?= $hospitals->name; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Blood Group</label>
                <select name="blood_group" id="vender" class="form-control">
                  <option value="" disabled="disabled" selected="selected">Select</option>
                  <option value="A+" <?php if (isset($_POST) && isset($_POST['blood_group'])) {
                                        if ($_POST['blood_group'] == 'A+') {
                                          echo "selected='selected'";
                                        }
                                      } ?>>A+</option>
                  <option value="A-" <?php if (isset($_POST) && isset($_POST['blood_group'])) {
                                        if ($_POST['blood_group'] == 'A-') {
                                          echo "selected='selected'";
                                        }
                                      } ?>>A-</option>
                  <option value="B+" <?php if (isset($_POST) && isset($_POST['blood_group'])) {
                                        if ($_POST['blood_group'] == 'B+') {
                                          echo "selected='selected'";
                                        }
                                      } ?>>B+</option>
                  <option value="B-" <?php if (isset($_POST) && isset($_POST['blood_group'])) {
                                        if ($_POST['blood_group'] == 'B-') {
                                          echo "selected='selected'";
                                        }
                                      } ?>>B-</option>
                  <option value="AB+" <?php if (isset($_POST) && isset($_POST['blood_group'])) {
                                        if ($_POST['blood_group'] == 'AB+') {
                                          echo "selected='selected'";
                                        }
                                      } ?>>AB+</option>
                  <option value="AB-" <?php if (isset($_POST) && isset($_POST['blood_group'])) {
                                        if ($_POST['blood_group'] == 'AB-') {
                                          echo "selected='selected'";
                                        }
                                      } ?>>AB-</option>
                  <option value="O+" <?php if (isset($_POST) && isset($_POST['blood_group'])) {
                                        if ($_POST['blood_group'] == 'O+') {
                                          echo "selected='selected'";
                                        }
                                      } ?>>O+</option>
                  <option value="O-" <?php if (isset($_POST) && isset($_POST['blood_group'])) {
                                        if ($_POST['blood_group'] == 'O-') {
                                          echo "selected='selected'";
                                        }
                                      } ?>>O-</option>



                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Start Date</label>
                <input type="date" class="form-control" id="price" name="start_date" value="<?php if (isset($_POST) && isset($_POST['start_date'])) {
                                                                                              echo $_POST['start_date'];
                                                                                            } ?>">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">End Date</label>
                <input type="date" class="form-control" id="price" name="end_date" value="<?php if (isset($_POST) && isset($_POST['end_date'])) {
                                                                                            echo $_POST['end_date'];
                                                                                          } ?>">
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Status</label>
                <select class="form-control" name="status">
                  <option disabled="disabled" selected="selected" value="" style="padding:0px !important;">Select</option>
                  <?php
                  $query2 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'request_date_status'");
                  foreach ($query2->result() as $request_date_status) {
                  ?>
                    <option value="<?= $request_date_status->master_type_key_value; ?>" <?php if (isset($_POST) && isset($_POST['status'])) {
                                                                                          if ($_POST['status'] == $request_date_status->master_type_key_value) {
                                                                                            echo "selected='selected'";
                                                                                          }
                                                                                        } ?>><?= $request_date_status->master_type_key_value; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>


            <div class="col-md-3">
              <div class="form-group">
                <label for="description">City</label>
                <input type="text" class="form-control" id="price" name="city" value="<?php if (isset($_POST) && isset($_POST['city'])) {
                                                                                        echo $_POST['city'];
                                                                                      } ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">User</label>
                <select name="user" id="vender" class="form-control">
                  <option value="#" selected disabled>Select</option>
                  <?php
                  $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user");
                  foreach ($query1->result() as $types) {
                  ?>
                    <option value="<?= $types->name; ?>" <?php if (isset($_POST) && isset($_POST['user'])) {
                                                            if ($_POST['user'] == $types->name) {
                                                              echo "selected='selected'";
                                                            }
                                                          } ?>><?= $types->name; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>


          <div class="card-footer">
            <div class="btn-group" style="float: right;">
              <button type="submit" name="submit" class="btn btn-sm btn-danger">Filter</button>
              <button class="btn btn-sm btn-warning mx-2 text-white" id="reset" name="reset" type="submit" /> Reset</button>

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
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
  <div style="overflow-x:auto;box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);padding: 12px;border-radius: 4px;margin-left: -6px;">
    <table class="table table-fluid" id="myTable">
      <thead>
        <tr>
          <th>S No</th>
          <th>Name</th>
          <th>Request No</th>
          <!-- <th>Donor Type</th> -->
          <th>Mobile No</th>
          <th>Blood Group</th>
          <th>Required Date</th>
          <th>Data Requested</th> 
          <th>Hospital</th>
          <th>Status</th>
          <th>CrossMatch Status</th>
          <th>Request Type</th>
          <th>User</th>
          <?php
          if ($_SESSION['admin_type'] == '0') {
            $servies_per = $_SESSION['bloodbank_user_servies_permission'];
            $per = json_decode($servies_per);

            if ($per->RequestRegister_permission  == 'Write') {

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
        foreach ($requestdata as $inx=>$row) {    ?>
          <tr>
            <th scope="row"><?= ++$inx ?></th>
            <td class="capitalize"><?= $row->p_name ?></td>
            <td class="capitalize"><?= $row->request ?></td>
            <td class="capitalize"><?= $row->mobile ?></td>
            <td class="capitalize"><?= $row->blood_group ?></td>
            <td class="capitalize"><?= date('d-m-Y', strtotime($row->required_date)) ?></td>
            <td class="capitalize"><?= date('d-m-Y', strtotime($row->dates)) ?></td>
            <td class="capitalize"><?= $row->hospital ?></td>
            <td class="capitalize"><?= $row->status ?></td>
            <!--<td class="capitalize"><?= $row->crossmatch_status ? $row->crossmatch_status : ''  ?></td>-->
            <td class="capitalize"><?= !empty($row->crossmatch_status) ? ucfirst($row->crossmatch_status) : '-' ?></td>

            <td class="capitalize"><?= $row->request_type ?></td>
            <td class="capitalize"><?= $row->request_by ?></td>
            <?php
            if ($_SESSION['admin_type'] == '0') {
              $servies_per = $_SESSION['bloodbank_user_servies_permission'];
              $per = json_decode($servies_per);

              if ($per->RequestRegister_permission  == 'Write') {

            ?>
                <td><?php echo '<a href="' . $this->data['base_url'] . '/request/request_form_edit/' . $row->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> 
                '; ?></td>
              <?php }

              if ($per->RequestRegister_permission  == 'Delete') {

              ?>
                <td><?php echo '<button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
              <?php }
            } else { ?>
              <td><?php echo '<a href="' . $this->data['base_url'] . '/request/request_form_edit/' . $row->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
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
      // alert(id);

      if (confirm('Are you sure') == true) {

        $.ajax({

          url: '<?php echo $base_url; ?>/request/request_form_delete',
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
    $("#reset").click(function() {
      $("input,select").val("");
      window.location.href = window.location.href;
    });
  </script>