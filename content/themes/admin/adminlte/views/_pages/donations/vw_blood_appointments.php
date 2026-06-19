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

  .btn-success {
    background-color: #ad1e1d !important;
    border-color: #ad1e1d !important;
  }

  .capitalize {
    text-transform: capitalize;
  }

  #pickdate {
    display: none;
  }
</style>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
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


          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Appointment Id</label>
                <input type="text" class="form-control" id="price" name="appointment_id" value="<?php if(isset($_POST) && isset($_POST['appointment_id'])){ echo $_POST['appointment_id']; } ?>">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">User Id</label>
                <input type="text" class="form-control" id="price" name="user_id" value="<?php if(isset($_POST) && isset($_POST['user_id'])){ echo $_POST['user_id']; } ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Name</label>
                <input type="text" class="form-control" id="price" name="name" value="<?php if(isset($_POST) && isset($_POST['name'])){ echo $_POST['name']; } ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Form Status</label>
                <select name="form_status" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
                  <option value="accepted" <?php if(isset($_POST) && isset($_POST['form_status'])){  if($_POST['form_status'] == 'accepted') {echo"selected='selected'";} } ?>>Accepted</option>
                  <option value="not accepted" <?php if(isset($_POST) && isset($_POST['form_status'])){  if($_POST['form_status'] == 'not accepted') {echo"selected='selected'";} } ?>>Not Accepted</option>

                </select>
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Mobile No</label>
                <input type="tel" class="form-control" id="price" name="mobile" value="<?php if(isset($_POST) && isset($_POST['mobile'])){ echo $_POST['mobile']; } ?>">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Blood Group</label>
                <select name="blood_group" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
                  <option value="A+" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'A+') {echo"selected='selected'";} } ?>>A+</option>
                    <option value="A-" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'A-') {echo"selected='selected'";} } ?>>A-</option>
                    <option value="B+" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'B+') {echo"selected='selected'";} } ?>>B+</option>
                    <option value="B-" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'B-') {echo"selected='selected'";} } ?>>B-</option>
                    <option value="AB+" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'AB+') {echo"selected='selected'";} } ?>>AB+</option>
                    <option value="AB-" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'AB-') {echo"selected='selected'";} } ?>>AB-</option>
                    <option value="O+" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'O+') {echo"selected='selected'";} } ?>>O+</option>
                    <option value="O-" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'O-') {echo"selected='selected'";} } ?>>O-</option>
              


                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Start Date</label>
                <input type="date" class="form-control" id="price" name="start_date" value="<?php if(isset($_POST) && isset($_POST['start_date'])){ echo $_POST['start_date']; } ?>">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">End Date</label>
                <input type="date" class="form-control" id="price" name="end_date" value="<?php if(isset($_POST) && isset($_POST['end_date'])){ echo $_POST['end_date']; } ?>">
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Donor Type</label>
                <select name="donor_type" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
                  <option value="Regular" <?php if(isset($_POST) && isset($_POST['donor_type'])){  if($_POST['donor_type'] == 'Regular') {echo"selected='selected'";} } ?>>Regular</option>
                  <option value="Replacement" <?php if(isset($_POST) && isset($_POST['donor_type'])){  if($_POST['donor_type'] == 'Replacement') {echo"selected='selected'";} } ?>>Replacement</option>

                </select>
              </div>
            </div>



            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Components Required</label>
                <input type="text" class="form-control" id="price" name="Components" value="<?php if(isset($_POST) && isset($_POST['Components'])){ echo $_POST['Components']; } ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Hospital</label>
                <select class="form-control" name="hospital">
                  <option disabled="disabled" selected="selected" value="" style="margin:0px !important;">Select</option>

                  <?php
                  $query3 = $this->db->query("SELECT * FROM bl_blood_banks where org_type = 'Hospital'");
                  foreach ($query3->result() as $hospitals) { ?>
                    <option value="<?= $hospitals->name; ?>" <?php if(isset($_POST) && isset($_POST['hospital'])){  if($_POST['hospital'] == $hospitals->name) {echo"selected='selected'";} } ?>><?= $hospitals->name; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>


            <div class="col-md-3">


              <div class="card-footer " style="background-color:unset;">
                <div class="btn-group" style="float: right;">
                  <button type="submit" name="submit1" class="btn btn-sm btn-danger">Filter</button>
                 <button class="btn btn-sm btn-warning mx-2 text-white" id="reset" name="reset" type="submit"/>         Reset</button>              

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
<div class="container">
  <div style="overflow-x:auto;box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);padding: 12px;border-radius: 4px;margin-left: -6px;">
    <table class="table table-fluid" id="myTable">
      <thead>
        <tr>
          <th>S No</th>
          <th>Appointment Id</th>
          <th>User Id</th>
          <th>Name</th>
          <th>Date</th>
          <th>Status</th>
          <th>Mobile No</th>
          <th>Application Id</th>
          <th>Donar Type</th>
          <th>Blood Group</th>
          <th>City</th>
          <th>Components Required</th>
          <th>Hospital</th>
          <?php
          if ($_SESSION['admin_type'] == '0') {
            $servies_per = $_SESSION['bloodbank_user_servies_permission'];
            $per = json_decode($servies_per);

            if ($per->Request_permission  == 'Write') {

          ?>
              <th>Action</th>
            <?php }
          } else { ?>
            <th>Action</th>
          <?php } ?>

        </tr>
      </thead>
      <tbody>
        <?php        $no = 0;
        foreach($appointments as $row){
          $no++;
        ?>

          <tr>
            <th scope="row"><?= $no ?></th>
            <td class="capitalize"><?= $row->id ?></td>
            <td class="capitalize"><?= $row->user_id ?></td>
            <td class="capitalize"><?= $row->p_name ?></td>
            <td class="capitalize"><?= $row->required_date ?></td>
            <td class="capitalize"><?= $row->approved_status ?></td>
            <td class="capitalize"><?= $row->phone ?></td>
            <td class="capitalize"><?= $row->application_no ?></td>
            <td></td>
            <td class="capitalize"><?= $row->blood_group ?></td>
            <td></td>
            <?php $components_unit = json_decode($row->components_unit); ?>

            <td class="capitalize">
              <?php if (isset($components_unit->whole_blood_unit) && $components_unit->whole_blood_unit) { ?>
                WB:<?= $components_unit->whole_blood_unit ?>,
              <?php  } ?>
              <?php if (isset($components_unit->Cryo_Poor_Plasma_unit) && $components_unit->Cryo_Poor_Plasma_unit) { ?>
                CPP:<?= $components_unit->Cryo_Poor_Plasma_unit ?>,
              <?php  } ?>
              <?php if (isset($components_unit->Cryoprecipitate_unit) && $components_unit->Cryoprecipitate_unit) { ?>
                CRYO:<?= $components_unit->Cryoprecipitate_unit ?>,
              <?php  } ?>
              <?php if (isset($components_unit->Fresh_Frozen_Plasma_unit) && $components_unit->Fresh_Frozen_Plasma_unit) { ?>
                FFP:<?= $components_unit->Fresh_Frozen_Plasma_unit ?>,
              <?php  } ?>
              <?php if (isset($components_unit->Red_blood_cell_unit) && $components_unit->Red_blood_cell_unit) { ?>
                RBC:<?= $components_unit->Red_blood_cell_unit ?>,
              <?php  } ?>
              <?php if (isset($components_unit->Platelet_rich_concentrate_unit) && $components_unit->Platelet_rich_concentrate_unit) { ?>
                PRC:<?= $components_unit->Platelet_rich_concentrate_unit ?>
              <?php  } ?>

              <!--  WB:<?= $components_unit->whole_blood_unit ?>, CPP:<?= $components_unit->Cryo_Poor_Plasma_unit ?>, CRYO:<?= $components_unit->Cryoprecipitate_unit ?>, FFP:<?= $components_unit->Fresh_Frozen_Plasma_unit ?>, RBC:<?= $components_unit->Red_blood_cell_unit ?>, PRC:<?= $components_unit->Platelet_rich_concentrate_unit ?> -->
            </td>
            <td class="capitalize"><?= $row->hospital ?></td>
            <!-- <td class="capitalize"><?= $row->issuer_name ?></td> -->
            <?php
            if (!empty($row->application_no)) {
              $checkin = '<a href="' . $this->data['base_url'] . '/request/request_pdf_download/' . $row->id . '/' . $row->user_id . '" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>';
            } else {
              $checkin = '<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModalScrollable' . $row->id . '" style="color:white;"><i class="fa fa-check"></i></button>';
            } //<a href="'.$this->data['base_url'].'/request/blood_request_checkin/'.$row->id.'/'.$row->user_id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-check"></i></a>
            if ($_SESSION['admin_type'] == '0') {
              $servies_per = $_SESSION['bloodbank_user_servies_permission'];
              $per = json_decode($servies_per);

              if ($per->Request_permission  == 'Write') {

            ?>
                <td><?php echo $checkin . ' <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
              <?php }
            } else { ?>
              <td><?php echo $checkin . ' <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
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
  <?php
  $query1 = $this->db->query("SELECT * FROM bl_blood_request");
  foreach ($appointments as $row) {
  ?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalScrollable<?= $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title pl-3" style="font-weight:bold !important;" id="exampleModalScrollableTitle">Check In</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="scheduling-confirm" action="<?php $_PHP_SELF ?>" method="POST" style="padding-bottom: 0px!important; margin: 0px!important;">
            <div class="modal-body">

              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <h5 class="pl-2" style="font-size: 1rem;font-weight: bold;">*. GENERAL QUESTION :-</h5>
                    <div class="row">
                      <div class="col-md-12 pl-3 pr-3 " style="padding: 5px;">
                        1. Patient unable to give consent Reason : </br><input type="text" class="rounded-lg col-md-12" id="d_weight" value="" name="reason" required="">
                      </div><br>
                      <div class="col-md-12 pl-3 pr-3" style="padding: 5px;">
                        2. Name of Blood Issuer :</br> <input type="text" class="rounded-lg col-md-12" id="d_hemoglobin" value="" name="issuer_name" required="">
                      </div><br>
                      <div class="col-md-12 pl-3 pr-3" style="padding: 5px;">
                        3. Relationship with patient :</br> <input type="text" class="rounded-lg col-md-12" id="d_bp" value="" name="relationship" required="">
                      </div>
                      <div class="col-md-12 pl-3 pr-3" style="padding: 5px;">
                        4. Request : </br> <select class="rounded-lg col-md-12 form-select-lg mb-3" name="request" id="limitedtime" required>

                          <option value="Accept">Accept</option>
                          <option value="Reject">Reject</option>
                        </select>
                      </div>

                      <div class="col-md-12 pl-3 pr-3" id="pickdate">
                        5. Reason :<br> <input type="text" class="rounded-lg col-md-12" id="d_bp" value="" name="reject_reason">
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <input type="hidden" value="<?php echo $row->id; ?>" id="blood_bank_id" name="donationform_id">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" style="background-color:#ad1e1d !important" name="submit" class="btn btn-danger">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php } ?>

  <?php
  if (!empty($_POST['request'])) {
    // print_r($_POST);die();
    $consent_reason = $_POST['reason'];
    $issuer_name = $_POST['issuer_name'];
    $relationship = $_POST['relationship'];
    $reject_reason = $_POST['reject_reason'];
    $request = $_POST['request'];
    $donationform_id = $_POST['donationform_id'];

    $n = 6;
    function getName($n)
    {
      $characters = '0123456789';
      $randomString = '';

      for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
      }

      return $randomString;
    }

    $app = getName($n);
    $application = 'RA' . $app;

    $update = $this->db->query("UPDATE bl_blood_request SET consent_reason = '$consent_reason',issuer_name = '$issuer_name', relationship = '$relationship', application_no = '$application' ,request = '$request' ,reject_reason = '$reject_reason'WHERE id = '$donationform_id'");

    if ($update == true) {
      redirect('admin/request/blood_appointment');
      //echo "donated";

    } else {
      //echo "fail";
    }
  }
  ?>
  
  <script type="text/javascript">
    function deleteFun(id) {
      if (confirm('Are you sure') == true) {
        $.ajax({
          url: '<?php echo $base_url; ?>/Request_appointments_delete',
          method: "POST",
          datatype: "json",
          data: {
            [csrf_name]: csrf_hash,
            id: id
          },
          success: function(d) {
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

  <script type="text/javascript">
    $('#limitedtime').on('change', function() {

      if (this.value == 1) {
        $('#pickdate').show();
      } else if (this.value == 0) {
        $('#pickdate').hide();
      }
    });
  </script>
  
  <script>
   $("#reset").click(function(){
$("input,select").val("");
window.location.href = window.location.href;
});</script>