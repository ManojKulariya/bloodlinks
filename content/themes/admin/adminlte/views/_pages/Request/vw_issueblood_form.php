<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// print_r($_SESSION);
$auth_id = $_SESSION['auth_id'];
if ($_SESSION['admin_type'] == '0') {
  $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user where user_id = '$auth_id'");
  foreach ($query1->result() as $type) {
  }
} else {
  $query1 = $this->db->query("SELECT * FROM bl_blood_banks where user_id = '$auth_id'");
  foreach ($query1->result() as $type) {
  }
}

$bank_id = $_SESSION['bank_id'];
if (!empty($_POST['issue_no'])) {

  $slip_no = $_POST['slip_no'];
  $type = $_POST['type'];
  $payment = $_POST['payment'];
  $res_wr = $_POST['res_wr'];
  $issue_by = $_POST['issue_by'];
  $issue_no = $_POST['issue_no'];
  $issue_date = $_POST['issue_date'];
  $issue_time = $_POST['issue_time'];
  $cross_match = $_POST['cross_match'];
  $crossmatch = $_POST['crossmatch'];
  $update = $this->db->query("UPDATE bl_crossmatch SET payment = '$payment', res_wr = '$res_wr' , status = 'issued' , slip_no = '$slip_no' , type = '$type' ,issue_by = '$issue_by' ,issue_no = '$issue_no' ,issue_date = '$issue_date' ,issue_time = '$issue_time'  WHERE id = '$cross_match'");

  if ($update == true) {
    $queryS = $this->db->query("SELECT * FROM bl_blood_record WHERE crossmatch_no = '$crossmatch'");
    foreach ($queryS->result() as $data) {
      //print_r($data);die();
    }
    $update1 = $this->db->query("UPDATE bl_blood_record SET issue_status = 'Yes', issued_vol = '$data->final_vol',final_vol = '0' WHERE crossmatch_no = '$crossmatch'");

    if ($update1 == true) {
      redirect('/admin/request/issue_blood');
      // echo '<script>alert("Your Appointment Booked")</script>';
    } else {
      echo "fail";
    }
  } else {
    echo "fail";
  }
  //}
}
?>
<style type="text/css">
  .col-form-label {
    font-size: 12px;

  }

  .form-label {
    font-size: 12px;
  }

  .btn-primary {
    background-color: #ad1e1d !important;
    border-color: #ad1e1d !important;
    height: 30px;
    padding: 0 10px;
    margin-top: -5px;
  }

  .btn-success {
    background-color: #ad1e1d;
    border-color: #ad1e1d;
  }

  .btn-success:hover {
    background-color: #ad1e1d;
    border-color: #ad1e1d;
  }

  .btn-success.focus,
  .btn-success:focus {
    background-color: #ad1e1d;
    border-color: #ad1e1d;
  }

  .btn-success:not(:disabled):not(.disabled).active,
  .btn-success:not(:disabled):not(.disabled):active,
  .show>.btn-success.dropdown-toggle {
    background-color: none !important;
    border-color: none !important;
  }

  .form-control {
    height: 28px;
  }

  .btn-secondary {
    height: 30px;
    padding: 0 10px;
    margin-top: -5px;
  }

  .btn-success {
    background-color: #ad1e1d !important;
    border-color: #ad1e1d !important;
  }
</style>
<!-- Example Code -->

<div style="text-align: center;margin-bottom: 10px;">
  <form action="<?php $_PHP_SELF ?>" method="POST">
    <div class="L9">
      <div class="hide" id="div1">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Request No:</label>
        <input type="text" id="Registration" name="request" placeholder="">

        <button type="submit" class="btn btn-primary">Search</button>
      </div>

    </div>
  </form>
</div>

<div class="col-sm-12 p-1" style="border: 1px solid #adadad">
  <div class="col-sm-12 text-center text-danger" style="font-weight: bold;padding: 5px;">Ready cross date</div>
  <table class="table">
    <thead style="border: 1px solid #adadad">
      <tr class="bg-warning text-white">
        <th scope="col" style="border: 1px solid #adadad">#</th>
        <th scope="col" style="border: 1px solid #adadad">Unit No.</th>
        <th scope="col" style="border: 1px solid #adadad">Blood Group</th>
        <th scope="col" style="border: 1px solid #adadad">Component</th>
        <th scope="col" style="border: 1px solid #adadad">Bleeding Date</th>
        <th scope="col" style="border: 1px solid #adadad">Expiry Date</th>
        <th scope="col" style="border: 1px solid #adadad">Status</th>
        <th scope="col" style="border: 1px solid #adadad">Core</th>
        <th scope="col" style="border: 1px solid #adadad">Part</th>
        <th scope="col" style="border: 1px solid #adadad">NAT</th>
        <th scope="col" style="border: 1px solid #adadad">Action</th>

      </tr>
    </thead>
    <tbody class="table-group-divider">
      <?php
      $master_data = $this->db->query("SELECT * FROM bl_masters  WHERE master_type_name = 'Components Types'");
      $master = $master_data->result();
      $n = 6;
      function reg($n)
      {
        $characters = '0123456789';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
          $index = rand(0, strlen($characters) - 1);
          $randomString .= $characters[$index];
        }

        return $randomString;
      }

      $issue = reg($n);
      $issue_no = 'BI' . $issue;
      
      $no = "0";
      if (!empty($_POST['request'])) {
        $request = $_POST['request'];
        $diagnosis = "";
        $queryreq = $this->db->query("SELECT * FROM  bl_requestblood WHERE request = '$request'")->row();
        if($queryreq){
        $diagnosis = $queryreq->diagnosis;
        }
        $queryiss_no = $this->db->query("SELECT * FROM  bl_crossmatch WHERE status = 'issued' and request = '$request' and issue_no != ''")->row();
        // print_r($queryiss_no);die();
        if($queryiss_no && $queryiss_no->issue_no != ""){
          $issue_no = $queryiss_no->issue_no;
        }
        $query = $this->db->query("SELECT * FROM  bl_crossmatch WHERE status = 'crossmatch' and request = '$request'");
        foreach ($query->result() as $row) {
          $no++;
          ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $row->unit_no ?></td>
            <td><?= $row->blood_group ?></td>
            <td>
              <?php
              if ($row->component == "wholeblood") {
                echo $row->component;
              } else {
                foreach ($master as $mdata) {
                  if ($row->component == $mdata->master_id) {
                    echo $mdata->master_type_key_short_value;
                  }
                }
              }
              ?>
            </td>
            <td><?= $row->bleeding_date ?></td>
            <td><?= $row->expire_date ?></td>
            <td><?= $row->status ?></td>
            <td><?= $row->major_comb ?></td>
            <td><?= $row->part ?></td>
            <td><?= $row->nat ?></td>
            <td><button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModalScrollable<?= $row->id ?>" style="color:white;"><i class="fa fa-check"></i></button></td>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalScrollable<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Issue Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="scheduling-confirm" action="<?php $_PHP_SELF ?>" method="POST" style="padding-bottom: 0px!important; margin: 0px!important;">
                    <div class="modal-body">

                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                      <div class="row">
                        <?php if ($diagnosis != "Thalassemia") { ?>

                          <div class="col-sm-12">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-4 col-form-label">Slip_no</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" name="slip_no">
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                        <div class="col-sm-12">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-4 col-form-label">Payment Amount</label>
                              <div class="col-sm-8">
                                <input type="number" class="form-control" name="payment">
                              </div>
                            </div>
                          </div>
                        <div class="col-sm-3">
                          <div class="form-group row">
                            <input type="radio" name="type" value="Replacement"> <label for="inputEmail3" class="col-sm-4 col-form-label">Replacement</label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group row">
                            <input type="radio" name="type" value="Voluntary Card"> <label for="inputEmail3" class="col-sm-4 col-form-label">Voluntary Card
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group row">
                            <input type="radio" name="type" value="Without Replacement" id="aprRadio"> <label for="inputEmail3" class="col-sm-4 col-form-label">Without Replacement
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group row">
                            <input type="radio" name="type" value="APR"> <label for="inputEmail3" class="col-sm-4 col-form-label">APR</label>
                          </div>
                        </div>
                        <!-- Hidden Reason for WR input field -->
                        <div class="col-sm-12" id="reasonForWrContainer" style="display:none;">
                            <div class="form-group row">
                                <label for="reasonForWr" class="col-sm-4 col-form-label">Reason for WR:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="reasonForWr" name="res_wr" placeholder="Enter Reason for WR">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Issue By</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="issue_by" value="<?= $type->name ?>">

                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group row">

                            <label for="inputEmail3" class="col-sm-4 col-form-label">Issue No.
                            </label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="issue_no" value="<?= $issue_no ?>">

                            </div>
                          </div>
                        </div>


                        <div class="col-sm-6">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Issue Date
                            </label>
                            <div class="col-sm-8">
                              <input type="date" class="form-control" name="issue_date" id="date">

                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Issue Time
                            </label>
                            <div class="col-sm-8">
                              <input type="time" class="form-control" name="issue_time" id="time">

                            </div>
                          </div>
                        </div>
                        <input type="hidden" value="<?php echo $row->id; ?>" id="cross_match" name="cross_match">
                        <input type="hidden" value="<?php echo $row->cross_match; ?>" id="cross_match" name="crossmatch">

                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </tr>
      <?php }
      } ?>

    </tbody>
  </table>
</div>
</div>
<!-- <div class="col-3">col-4</div>
      </div> -->
</div>
<script>
  const [date, time] = formatDate(new Date()).split(' ');
   // ✅ Set Date input Value
  const dateInput = document.getElementById('date');
  dateInput.value = date;


  // ✅ Set time input value
  const timeInput = document.getElementById('time');
  timeInput.value = time;
  // ✅ Set datetime-local input value
  const datetimeLocalInput = document.getElementById('datetime-local');
  datetimeLocalInput.value = date + 'T' + time;
  // 👇️👇️👇️ Format Date as yyyy-mm-dd hh:mm:ss
  // 👇️ (Helper functions)
  function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
  }

  function formatDate(date) {
    return (
      [
        date.getFullYear(),
        padTo2Digits(date.getMonth() + 1),
        padTo2Digits(date.getDate()),
      ].join('-') +
      ' ' + [
        padTo2Digits(date.getHours()),
        padTo2Digits(date.getMinutes()),
        // padTo2Digits(date.getSeconds()),  // 👈️ can also add seconds
      ].join(':')
    );
  }

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Listen for change event on radio buttons
        $('input[name="type"]').change(function() {
            if ($('#aprRadio').is(':checked')) {
                $('#reasonForWrContainer').show(); // Show the reason input
            } else {
                $('#reasonForWrContainer').hide(); // Hide the reason input
            }
        });
    });
</script>