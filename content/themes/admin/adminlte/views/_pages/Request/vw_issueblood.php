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
      <div class="card">

        <div class="card-body">

          <?php
          if ($_SESSION['admin_type'] == '0') {
            $servies_per = $_SESSION['bloodbank_user_servies_permission'];
            $per = json_decode($servies_per);

            if ($per->IssueBlood_permission  == 'Write') {

          ?>
              <div class="btn-group" style="float: right;">
                <h6>Add Issue Blood</h6>
                <a href="<?php echo $base_url; ?>/request/issue_blood_form" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
              </div><br><br>
            <?php }
          } else { ?>
            <div class="btn-group" style="float: right;">
              <h6>Add Issue Blood</h6>
              <a href="<?php echo $base_url; ?>/request/issue_blood_form" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
            </div><br><br>
          <?php } ?>
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Issue No</label>
                <input type="text" class="form-control" id="price" name="issue_no" value="<?php if (isset($_POST) && isset($_POST['issue_no'])) { echo $_POST['issue_no']; } ?>">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Blood Group</label>
                <select name="blood_group" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
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
                <label for="description">Request No</label>
                <input type="text" class="form-control" id="price" name="request" value="<?php if (isset($_POST) && isset($_POST['request'])) {
                                                                                            echo $_POST['request'];
                                                                                          } ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Name</label>
                <input type="text" class="form-control" id="price" name="name" value="<?php if (isset($_POST) && isset($_POST['name'])) {
                                                                                        echo $_POST['name'];
                                                                                      } ?>">
              </div>
            </div>
          </div>
          <div class="row">

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
                <label for="description">Components</label>
                <input type="text" class="form-control" id="price" name="Component" value="<?php if (isset($_POST) && isset($_POST['Component'])) {
                                                                                              echo $_POST['Component'];
                                                                                            } ?>">
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

            <div class="col-md-6">
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


            <div class="col-md-6">
              <div class="card-footer">
                <div class="btn-group" style="float: right;">
                  <button type="submit" name="submit" class="btn btn-sm btn-danger">Filter</button>
                  <button class="btn btn-sm btn-warning mx-2 text-white" id="reset" name="reset" type="submit" /> Reset</button>

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
    <table class="table table-fluid" id="myTable" style="font-size:12px;">
      <thead>
        <tr>
          <th>S No</th>
          <th>Unit No</th>
          <th>Date</th>
          <th>Issue No</th>
          <th>Request No</th>
          <th>Components</th>
          <th>Blood Group</th>
          <th>Tube No</th>
          <th>Patient Name</th>
          <th>Hospital Name</th>
          <th>Mobile No</th>
          <th>Slip No.</th>
          <th>Issued By</th>
          <th>Discard Blood</th>
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
        $master_data = $this->db->query("SELECT * FROM bl_masters  WHERE master_type_name = 'Components Types'");
        $master = $master_data->result();

        $no = 0;
        if (isset($_POST['submit_discard'])) {
          $bloodbank_id = $_POST['bloodbank_id'];
          $auth_id = $_SESSION['auth_id'];
          $date = $_POST['date'];
          $type = $_POST['type'];
          $type_id = $_POST['type_id'];
          $discard_no = $_POST['discard_no'];
          $discard_res = $_POST['discard_res'];
          $discard_by = $_POST['discard_by'];
          $query1 = $this->db->query("SELECT * FROM bl_discard WHERE bloodbank_id=$bloodbank_id AND  type = '$type' AND  type_id = '$type_id'");
          if ($query1->num_rows() == 0) {
            $insert = $this->db->query("INSERT INTO bl_discard 	(bloodbank_id, date, type, type_id, discard_no,discard_res,discard_by,discard_by_id)
                    VALUES('$bloodbank_id','$date', '$type', '$type_id', '$discard_no','$discard_res','$discard_by','$auth_id')");
            if ($insert) {
              $this->db->query("UPDATE bl_crossmatch SET discard_by='$discard_by', status = 'discard',discard_date = '$date',discard_no = '$discard_no',discard_reason = '$discard_res' WHERE id = '$type_id'");
            }
          }
        }
       
        foreach ($issue_bloodresults as $row) {
          $no++;
        ?>

          <tr>
            <th scope="row"><?= $no ?></th>
            <td class="capitalize"><?= $row->unit_no ?></td>
            <td class="capitalize"><?= date('d-m-Y', strtotime($row->issue_date)) ?></td>
            <td class="capitalize"><?= $row->issue_no ?></td>
            <td class="capitalize"><?= $row->request ?></td>
            <td class="capitalize">
              <?php

              if ($row->component == "wholeblood") {
                echo $row->component;
              } else {

                echo $row->master_type_key_short_value;
              }


              ?>
            </td>
            <td class="capitalize"><?= $row->blood_group ?></td>
            <td class="capitalize"><?= $row->tube_no ?></td>
            <td class="capitalize"><?= $row->p_name ?></td>
            <td class="capitalize"><?= $row->hospital ?></td>
            <td></td>
            <td><?= $row->slip_no ?></td>
            <td class="capitalize"><?= $row->issue_by ?></td>
            <td><?php
                echo '<button type="button" class="btn btn-xs btn-success open-dynamic-modal" data-toggle="modal" data-target="#dynamicModal" 
                    data-id="' . $row->id . '" data-bankid="' . $bank_id . '"><i class="fa-solid fa-droplet-slash"></i></button>';  ?></td>

            <?php
            if ($_SESSION['admin_type'] == '0') {
              $servies_per = $_SESSION['bloodbank_user_servies_permission'];
              $per = json_decode($servies_per);
              if ($per->IssueBlood_permission  == 'Write') { ?>
                <td><?php echo '<a href="' . $this->data['base_url'] . '/request/issue_blood_download/' . $row->id . '" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>'; ?></td>
              <?php }
            } else { ?>
              <td><?php echo '<a href="' . $this->data['base_url'] . '/request/issue_blood_download/' . $row->id . '" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>'; ?></td>
            <?php } ?>


          </tr>
        <?php } ?>
      </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="dynamicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="dynamicModalTitle">Modal Title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="scheduling-confirm" action="<?php $_PHP_SELF ?>" method="POST" style="padding-bottom: 0px!important; margin: 0px!important;">

            <div class="modal-body" id="dynamicModalBody">
              <!-- Dynamic content goes here -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="submit_discard" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
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

    $("#reset").click(function() {
      $("input,select").val("");
      window.location.href = window.location.href;
    });

    $(document).on('click', '.open-dynamic-modal', function() {
      var id = $(this).data('id');
      var bankid = $(this).data('bankid');

      updateModalContent(id, bankid);
    });

    function updateModalContent(id, bankid) {

      $('#dynamicModalTitle').text('Discard Issued Blood');
      $('#dynamicModalBody').html(`
            <input type="hidden" name="type" value="3">
            <input type="hidden" name="type_id" value="${id}">
            <input type="hidden" name="bloodbank_id" value="${bankid}">
            <div class="form-group">
                <label for="hiv">Date</label>
                    <input type='date' required name='date' class="form-control" />
            </div>
            <div class="form-group">
                <label for="hiv">Discard No</label>
                    <input type='text' required name='discard_no' class="form-control" />
            </div>
            <div class="form-group">
                <label for="hiv">Discard Reason</label>
                    <select id="hiv" name="discard_res" required class="form-control">
                        <option value=''>Choose...</option>
                        <option value='Expiry'>Expiry</option>
                        <option value='TTI Reactive'>TTI Reactive</option>
                        <option value='Any other Reason'>Any other Reason</option>
                    </select>
            </div>
            <div class="form-group">
                <label for="hiv">Discard By</label>
                    <input type='text' required name='discard_by' class="form-control" />
            </div>
            
            </div>
            `);
    }
  </script>