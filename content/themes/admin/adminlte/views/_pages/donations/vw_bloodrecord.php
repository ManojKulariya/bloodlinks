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

  .page-link {
    color: #000 !important;
  }

  .page-item.active .page-link {
    color: #fff !important;
  }

  .card-footer {
    background-color: #fff;
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
$master_data = $this->db->query("SELECT * FROM bl_masters  WHERE master_type_name = 'Components Types'");
$master = $master_data->result();

$bank_id = $_SESSION['bank_id'];
$auth_id = $_SESSION['auth_id'];

if(isset($_POST['submit_discard'])) {
        $bloodbank_id = $_POST['bloodbank_id'];
        $date = $_POST['date'];
        $type = $_POST['type'];
        $type_id = $_POST['type_id'];
        $discard_no = $_POST['discard_no'];
        $discard_res = $_POST['discard_res'];
        $discard_by = $_POST['discard_by'];
        $query1 = $this->db->query("SELECT * FROM bl_discard WHERE bloodbank_id=$bloodbank_id AND  type = '$type' AND  type_id = '$type_id'");
    	if($query1->num_rows() == 0){
    	    $insert = $this->db->query("INSERT INTO bl_discard 	(bloodbank_id, date, type, type_id, discard_no,discard_res,discard_by,discard_by_id)
                VALUES('$bloodbank_id','$date', '$type', '$type_id', '$discard_no','$discard_res','$discard_by','$auth_id')");
                if($insert){
                    $this->db->query("UPDATE bl_blood_record SET  status = 'discard',discard_date = '$date',discard_no = '$discard_no',discard_reason = '$discard_res' WHERE id = '$type_id'");
                }
    	}else{
    	    echo "<script>alert('already discarded!')</script>";
    	}
        
    }
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
                <label for="description">Unit No</label>
                <input type="text" class="form-control" id="price" name="unit_no" value="<?php if(isset($_POST) && isset($_POST['unit_no'])){ echo $_POST['unit_no']; } ?>">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Blood Group</label>
                <select name="blood_group" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
                  <option value="A+" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'A+') {echo"selected='selected'";} } ?>>A+</option>                    <option value="A-" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'A-') {echo"selected='selected'";} } ?>>A-</option>                    <option value="B+" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'B+') {echo"selected='selected'";} } ?>>B+</option>                    <option value="B-" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'B-') {echo"selected='selected'";} } ?>>B-</option>                    <option value="AB+" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'AB+') {echo"selected='selected'";} } ?>>AB+</option>                    <option value="AB-" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'AB-') {echo"selected='selected'";} } ?>>AB-</option>                    <option value="O+" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'O+') {echo"selected='selected'";} } ?>>O+</option>                    <option value="O-" <?php if(isset($_POST) && isset($_POST['blood_group'])){  if($_POST['blood_group'] == 'O-') {echo"selected='selected'";} } ?>>O-</option>              
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Components</label>
                <input type="text" class="form-control" id="price" name="Component" value="<?php if(isset($_POST) && isset($_POST['Component'])){ echo $_POST['Component']; } ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Bag Config</label>
                <select name="blood_type" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
                  <option value="Mother" <?php if(isset($_POST) && isset($_POST['blood_type'])){  if($_POST['blood_type'] == 'Mother') {echo"selected='selected'";} } ?>>Mother</option>
                  <option value="Satellite" <?php if(isset($_POST) && isset($_POST['blood_type'])){  if($_POST['blood_type'] == 'Satellite') {echo"selected='selected'";} } ?>>Satellite</option>

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
                  <option value="Test done" <?php if(isset($_POST) && isset($_POST['tti_test'])){  if($_POST['tti_test'] == 'Test done') {echo"selected='selected'";} } ?>>Yes</option>
                  <option value="No" <?php if(isset($_POST) && isset($_POST['tti_test'])){  if($_POST['tti_test'] == 'No') {echo"selected='selected'";} } ?>>No</option>

                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Cross Match</label>
                <select name="cross_match" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
                  <option value="Yes" <?php if(isset($_POST) && isset($_POST['cross_match'])){  if($_POST['cross_match'] == 'Yes') {echo"selected='selected'";} } ?>>Yes</option>
                  <option value="No" <?php if(isset($_POST) && isset($_POST['cross_match'])){  if($_POST['cross_match'] == 'No') {echo"selected='selected'";} } ?>>No</option>

                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Issue</label>
                <select name="issue" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
                  <option value="Yes" <?php if(isset($_POST) && isset($_POST['issue'])){  if($_POST['issue'] == 'Yes') {echo"selected='selected'";} } ?>>Yes</option>
                  <option value="No" <?php if(isset($_POST) && isset($_POST['issue'])){  if($_POST['issue'] == 'No') {echo"selected='selected'";} } ?>>No</option>

                </select>
              </div>
            </div>


            <div class="col-md-3">
              <div class="card-footer">
                <div class="btn-group" style="float: right;">
                  <button type="submit" name="submit" class="btn btn-sm btn-danger">Filter</button>                  <button class="btn btn-sm btn-warning mx-2 text-white" id="reset" name="reset" type="submit"/>         Reset</button>              
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
          <th>Expire Date</th>
          <th>Reverse <br>Blood Grouping</th>
          <th>Discard</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 0;
        if (!empty($_POST) && !isset($_POST['submit_discard'])) {

          //print_r($_POST); die;
          if (isset($_POST['blood_group'])) {
            $blood_group = $_POST['blood_group'];
          }
          if (isset($_POST['blood_type'])) {
            $blood_type = $_POST['blood_type'];
          }
          if (isset($_POST['tti_test'])) {
            $tti_test = $_POST['tti_test'];
          }
          if (isset($_POST['cross_match'])) {
            $cross_match = $_POST['cross_match'];
          }
          if (isset($_POST['issue'])) {
            $issue = $_POST['issue'];
          }
          $unit_no = $_POST['unit_no'];
          $Component = $_POST['Component'];

          if (!empty($blood_type) && !empty($blood_group) && !empty($Component) && !empty($unit_no) && !empty($tti_test) && !empty($cross_match) && !empty($issue)) {

            $query = $this->db->query("SELECT * FROM bl_blood_record WHERE bl_blood_record.bloodbank_id = '$bank_id' And bl_blood_record.bag_config = '$blood_type' And bl_blood_record.unit_no = '$unit_no' And bl_blood_record.blood_group = '$blood_group' And bl_blood_record.component = '$Component' And bl_blood_record.tti_test = '$tti_test' And bl_blood_record.cross_match = '$cross_match' And bl_blood_record.issue_status = '$issue' ORDER BY (CASE WHEN expiry_date < CURDATE() THEN 1 ELSE 0 END), expiry_date ASC");
          } else {
$search='';
            if (!empty($unit_no)) {
               if(!empty( $search)) {						 $search .=' And ';					}              $search .= "bl_blood_record.unit_no = '$unit_no'";
            } 			if (!empty($blood_group)) {
               if(!empty( $search)) {						 $search .=' And ';					}              $search .= "bl_blood_record.blood_group = '$blood_group'";
            } 			if (!empty($Component)) {
               if(!empty( $search)) {						 $search .=' And ';					}              $search .= "bl_blood_record.component = '$Component'";
            } 			if (!empty($blood_type)) {
               if(!empty( $search)) {						 $search .=' And ';					}              $search .= "bl_blood_record.bag_config = '$blood_type'";
            } if (!empty($tti_test)) {
               if(!empty( $search)) {						 $search .=' And ';					}              $search .= "bl_blood_record.tti_test = '$tti_test'";
            } if (!empty($cross_match)) {
               if(!empty( $search)) {						 $search .=' And ';					}              $search .= "bl_blood_record.cross_match = '$cross_match'";
            } 			if (!empty($issue)) {
               if(!empty( $search)) {						 $search .=' And ';					}              $search .= "bl_blood_record.issue_status = '$issue'";
            }$querySearch='';			if(!empty($search)){			$querySearch='And '. $search;			}
            $query = $this->db->query("SELECT * FROM bl_blood_record  WHERE bl_blood_record.bloodbank_id = '$bank_id' $querySearch ORDER BY (CASE WHEN expiry_date < CURDATE() THEN 1 ELSE 0 END), expiry_date ASC");
          }
        } else {
          $query = $this->db->query("SELECT * FROM bl_blood_record  WHERE bl_blood_record.bloodbank_id = '$bank_id' ORDER BY (CASE WHEN expiry_date < CURDATE() THEN 1 ELSE 0 END), expiry_date ASC");
        }
        foreach ($query->result() as $row) {
            if($row->status != 'discard'){
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
            <td class="capitalize"><?= $row->donor_unit_no ?></td>
            <td class="capitalize">
              <?php
              if ($row->component == "wholeblood") {
                echo $row->component;
              } else {
                foreach ($master as $mdata) {
                  if ($row->component  == $mdata->master_id) {
                    echo $mdata->master_type_key_short_value;
                  }
                }
              }

              ?>
            </td>
            <td class="capitalize"><?= $row->bag_config ?></td>
            <td class="capitalize"><?= $row->blood_group ?></td>
            <td class="capitalize"><?= $row->blood_volume ?></td>
            <td class="capitalize"><?= $row->tti_test ?></td>
            <td class="capitalize"><?= $row->cross_match ?></td>
            <td class="capitalize"><?= $row->issue_status ?></td>
            <td class="capitalize"><?= $row->issued_vol ?></td>
            <td class="capitalize"><?= $row->final_vol ?></td>
            <td class="capitalize"><?= date('d-m-Y', strtotime($row->expiry_date)) ?></td>
            <td class="capitalize">
                <select onchange="groupingSelect(<?= $row->id ?>);" data-id="<?= $row->id ?>"> <!-- Replace 1 with the actual ID of the record -->
                    <option  <?php echo ($row->grouping == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                    <option  <?php echo ($row->grouping == 'No') ? 'selected' : ''; ?>>No</option>
                </select>
            </td>
            <td class="capitalize"><?php 
            echo '<button type="button" class="btn btn-xs btn-success open-dynamic-modal" data-toggle="modal" data-target="#dynamicModal" 
                    data-id="' . $row->id.'" data-bankid="'.$bank_id.'"><i class="fa-solid fa-droplet-slash"></i></button>';  ?></td>


          </tr>
        <?php } 
        }
        ?>
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
  <style>
    .expired {
        /* background-color: #f8d7da !important; */
    }

    .expiring-soon {
        background-color: #ED401B !important; /* Red for expiring in 7 days */
        color: #fff;
    }

    .expiring-later {
        background-color: #EDF545 !important; /* Yellow for expiring in 15 days */
    }

    .safe {
        background-color: #91FB58 !important; /* Green for safe */
    }
</style>
<script>   
$("#reset").click(function(){$("input,select").val("");
window.location.href = window.location.href;});
  $(document).on('click', '.open-dynamic-modal', function() {
        var id = $(this).data('id');
        var bankid = $(this).data('bankid');
        
        updateModalContent(id,bankid);
      });
    function updateModalContent(id,bankid) {
        
        $('#dynamicModalTitle').text('Discard Issued Blood');
        $('#dynamicModalBody').html(`
            <input type="hidden" name="type" value="2">
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
 function groupingSelect(recordId) {
        var selectedValue = $("select[data-id='" + recordId + "']").val();
        console.log(recordId);
        
        // Send AJAX request to update the database
        $.ajax({
            url: 'update_grouping', // Replace with your actual controller and method
            method: 'POST',
            data: {
                id: recordId,
                grouping: selectedValue
            },
            success: function(response) {
                // Handle success response (optional)
                alert('Update successful');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle error response (optional)
                alert('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    }
</script>