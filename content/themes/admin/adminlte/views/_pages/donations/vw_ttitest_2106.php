<?php
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
?>
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

  .btn-primary {
    background-color: #ad1e1d !important;
    border-color: #ad1e1d !important;
  }

  .btn-success {
    background-color: #ad1e1d !important;
    border-color: #ad1e1d !important;
  }

  .content-wrapper {
    background: #fff;
  }

  .card-footer {
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
</style>

<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
if (!empty($_POST['donationform_id'])) {

  $hiv = $_POST['hiv'];
  $hbsag = $_POST['hbsag'];
  $hcv = $_POST['hcv'];
  $vdrl = $_POST['vdrl'];
  $malaria = $_POST['malaria'];
  $ddate = date('Y-m-d');

  $donationform_id = $_POST['donationform_id'];
  if (($hiv == 'Negative') && ($hbsag == 'Negative') && ($hcv == 'Negative') && ($vdrl == 'Negative') && ($malaria == 'Negative')) {
    $status = 'Test done';
    $update = $this->db->query("UPDATE bl_bb_donatioform SET 
                            discard_no ='', discard_date ='', hiv = '$hiv',hbsag = '$hbsag',hcv = '$hcv',malaria = '$malaria',vdrl = '$vdrl' , status ='$status', ttitest_by='$type->name' WHERE id = '$donationform_id'");
  } else {
    $status = 'discard';

    $discard = date('ymd') . time() . rand(1000, 9999);
    $blood_discard = 'DB' . $discard;
    $update = $this->db->query("UPDATE bl_bb_donatioform SET hiv = '$hiv',hbsag = '$hbsag',hcv = '$hcv',malaria = '$malaria',vdrl = '$vdrl',
    status ='$status',
    discard_no ='$blood_discard', 
    discard_date ='$ddate', 
    ttitest_by='$type->name' 
    WHERE id = '$donationform_id'");
  }
}


?>
<?php defined('BASEPATH') or exit('No direct script access allowed');

$bank_id = $_SESSION['bank_id'];
?>
<div class="container">
  <form action="<?php $_PHP_SELF ?>" method="POST">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

    <div class="timeline">

      <div class="card">

        <div class="card-body">


          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php if(isset($_POST) && isset($_POST['name'])){ echo $_POST['name']; } ?>">
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
                <input type="text" class="form-control" id="unit_no" name="unit_no" value="<?php if(isset($_POST) && isset($_POST['unit_no'])){ echo $_POST['unit_no']; } ?>">
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
                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php if(isset($_POST) && isset($_POST['start_date'])){ echo $_POST['start_date']; } ?>">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="<?php if(isset($_POST) && isset($_POST['end_date'])){ echo $_POST['end_date']; } ?>">
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
            <div class="col-md-6">
              <div class="card-footer">
                <div class="btn-group" style="float: right;">
                  <button type="submit" name="submit" class="btn btn-sm btn-danger">Filter</button>
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
  <div style="box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);overflow-x:auto;padding: 10px;border-radius: 5px;margin: 0 -6px;">
    <table class="table table-fluid" id="myTable">
      <thead>
        <tr>
          <th>S No</th>
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
          <!-- <th>Discard Status</th> -->
          <th>Date</th>
          <th>User</th>
          <th>Examination BY</th>

          <?php
          if ($_SESSION['admin_type'] == '0') {
            $servies_per = $_SESSION['bloodbank_user_servies_permission'];
            $per = json_decode($servies_per);

            if ($per->TTITest_permission == 'Write') {

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
		if(isset($_POST['reset'])){
  unset($_POST);
}
        if (!empty($_POST)) {

          //print_r($_POST); die;
          if (isset($_POST['blood_group'])) {
            $blood_group = $_POST['blood_group'];
          }
          if (isset($_POST['status'])) {
            $status = $_POST['status'];
          }

          if (isset($_POST['test_result'])) {
            $test_result = $_POST['test_result'];
          }

          if (isset($_POST['donation_type'])) {
            $donation_type = $_POST['donation_type'];
          }

          if (isset($_POST['discard_type'])) {
            $discard_type = $_POST['discard_type'];
          }

          if (isset($_POST['user'])) {
            $user = $_POST['user'];
          }

          $name = $_POST['name'];
          $unit_no = $_POST['unit_no'];
          $start_date = $_POST['start_date'];
          $end_date = $_POST['end_date'];


          if (
            !empty($name) && !empty($status) && !empty($test_result) && !empty($unit_no)
            && !empty($blood_group) && !empty($donation_type) && !empty($city)
            && (!empty($start_date) && !empty($end_date))
          ) {

            $query = $this->db->query("SELECT * FROM bl_bb_donatioform WHERE donation_date BETWEEN '$start_date' AND '$end_date' AND bl_bb_donatioform.bloodbank_id = '$bank_id' And bl_bb_donatioform.donor_name = '$name' And bl_bb_donatioform.unit_no = '$unit_no' And  bl_bb_donatioform.ttitest_by = $user And bl_bb_donatioform.status = '$status' And bl_bb_donatioform.blood_group = '$blood_group' And bl_bb_donatioform.camp_status = '$donation_type' And (bl_bb_donatioform.hiv = 'test_result' OR bl_bb_donatioform.hbsag = 'test_result'OR bl_bb_donatioform.hcv = 'test_result'OR bl_bb_donatioform.vdrl = 'test_result'OR bl_bb_donatioform.malaria = 'test_result'OR bl_bb_donatioform.anti_hbc = 'test_result' ORDER BY ID DESC");
          } else {
$search='';
            if (!empty($name)) {
              $search = "bl_bb_donatioform.donor_name = '$name'";
            } if (!empty($unit_no)) {
				if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_bb_donatioform.unit_no = '$unit_no'";
            } if (!empty($status)) {
				if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_bb_donatioform.status = '$status'";
            } if (!empty($blood_group)) {
				if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_bb_donatioform.blood_group = '$blood_group'";
            } if (!empty($donation_type)) {
				if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_bb_donatioform.camp_status = '$donation_type'";
            } if (!empty($test_result)) {
				if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_bb_donatioform.hiv = 'test_result' OR bl_bb_donatioform.hbsag = 'test_result'OR bl_bb_donatioform.hcv = 'test_result'OR bl_bb_donatioform.vdrl = 'test_result'OR bl_bb_donatioform.malaria = 'test_result'OR bl_bb_donatioform.anti_hbc = 'test_result'";
            } if (!empty($user)) {
				if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_bb_donatioform.ttitest_by = $user";
            } if (!empty($start_date) && empty($end_date)) {
				if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "donation_date = '$start_date'";
            } 
			
			if (empty($start_date) && !empty($end_date)) {
				if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "donation_date = '$end_date'";
            } 
			
			if (!empty($start_date) && !empty($end_date)) {
				if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "donation_date BETWEEN '$start_date' AND '$end_date'";
            }
$querySearch='';
			if(!empty($search)){
			$querySearch='And '. $search;
			}
            $query = $this->db->query("SELECT bl_bb_donatioform.*,bl_donor_examination.examiner_id,bl_bloodbank_user.name as ex_name,bl_users.sign,bl_users.sign FROM bl_bb_donatioform  
            LEFT JOIN bl_donor_examination ON bl_bb_donatioform.id = bl_donor_examination.donation_id
                     LEFT JOIN bl_users ON bl_donor_examination.auth_id = bl_users.id 
                     LEFT JOIN bl_bloodbank_user ON bl_donor_examination.examiner_id = bl_bloodbank_user.id 
                     WHERE bl_bb_donatioform.bloodbank_id = '$bank_id' $querySearch ORDER BY ID DESC");
          }
        } else {
          $query = $this->db->query("SELECT bl_bb_donatioform.*,bl_donor_examination.examiner_id,bl_bloodbank_user.name as ex_name,bl_users.sign,bl_users.sign FROM bl_bb_donatioform  
          LEFT JOIN bl_donor_examination ON bl_bb_donatioform.id = bl_donor_examination.donation_id
                     LEFT JOIN bl_users ON bl_donor_examination.auth_id = bl_users.id 
                     LEFT JOIN bl_bloodbank_user ON bl_donor_examination.examiner_id = bl_bloodbank_user.id 
          WHERE bl_bb_donatioform.bloodbank_id = '$bank_id' ORDER BY ID DESC");
        }
        $base_url = str_replace('/admin', '', $this->data['base_url']);
        foreach ($query->result() as $row) {
          $no++;
        ?>

          <tr>
            <th scope="row"><?= $no ?></th>
            <td style="text-transform: capitalize;"><?= $row->donor_name ?></td>
            <td style="text-transform: capitalize;"><?= $row->unit_no ?></td>
            <td style="text-transform: capitalize;"><?= $row->tube ?></td>
            <td style="text-transform: capitalize;"><?= $row->blood_group ?></td>
            <td style="text-transform: capitalize;"><?= $row->hiv ?></td>
            <td style="text-transform: capitalize;"><?= $row->hbsag ?></td>
            <td style="text-transform: capitalize;"><?= $row->hcv ?></td>
            <td style="text-transform: capitalize;"><?= $row->vdrl ?></td>
            <td style="text-transform: capitalize;"><?= $row->malaria ?></td>
            <td style="text-transform: capitalize;"><?= $row->status ?></td>
            <!-- <td style="text-transform: capitalize;"><?= $row->donation_date ?></td> -->
            <td style="text-transform: capitalize;"><?= $row->donation_date ?></td>
            <td style="text-transform: capitalize;"><?= $row->ttitest_by ?></td>
            <td style="text-transform: capitalize;">
              <?php if ($row->ex_name != "") {
                echo "<strong>" . $row->ex_name . "</strong>";
                echo '<img src="' . $base_url . '/' . $row->sign . '" width="70px" height="70px" />';
              } ?>
            </td>
            <?php
            if ($_SESSION['admin_type'] == '0') {
              $servies_per = $_SESSION['bloodbank_user_servies_permission'];
              $per = json_decode($servies_per);

              if ($per->TTITest_permission  == 'Write') {

            ?>
                <td>

                  <?php echo
                  '<button type="button" class="btn btn-xs btn-success open-dynamic-modal" data-toggle="modal" data-target="#dynamicModal" 
       data-id="' . $row->id . '" data-hiv="' . $row->hiv . '" data-hbsag="' . $row->hbsag . '" data-hcv="' . $row->hcv . '" 
       data-vdrl="' . $row->vdrl . '" data-malaria="' . $row->malaria . '"><i class="fa fa-check"></i></button>'; ?>


                </td>
              <?php }


              if ($per->TTITest_permission  == 'Delete') {

              ?>
                <td>
                  <?php echo
                  '<button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?>


                </td>
              <?php }
            } else { ?>
              <td>
                <?php echo
                '<button type="button" class="btn btn-xs btn-success open-dynamic-modal" data-toggle="modal" data-target="#dynamicModal" 
    data-id="' . $row->id . '" data-hiv="' . $row->hiv . '" data-hbsag="' . $row->hbsag . '" data-hcv="' . $row->hcv . '" 
    data-vdrl="' . $row->vdrl . '" data-malaria="' . $row->malaria . '"><i class="fa fa-check"></i></button>
    
    <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
            <?php } ?>


          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
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
            <button type="submit" name="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
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

          url: '<?php echo $base_url; ?>/donations/deleteSingleData',
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
  /*
  <script>
    $(document).ready(function() {
      // Function to update the modal content
      function updateModalContent(id, hiv, hbsag, hcv, vdrl, malaria) {
        console.log('model=>');
        $('#dynamicModalTitle').text('TTItest Form');
        $('#dynamicModalBody').html('
                <input type="hidden" name="donationform_id" value="${id}">
                
                <div class="form-group">
                    <label for="hiv">HIV</label>
                    <select id="hiv" name="hiv" class="form-control">
                    <option >Choose...</option>
                        <option value="Positive" ${hiv === 'Positive' ? 'selected' : ''}>Positive</option>
                        <option value="Negative" ${hiv === 'Negative' ? 'selected' : ''}>Negative</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="hbsag">HBSAG</label>
                    <select id="hbsag" name="hbsag" class="form-control">
                    <option >Choose...</option>
                        <option value="Positive" ${hbsag === 'Positive' ? 'selected' : ''}>Positive</option>
                        <option value="Negative" ${hbsag === 'Negative' ? 'selected' : ''}>Negative</option>
                    </select>
                </div>
                <div class="form-row">
                 <div class="form-group col-md-6">
                  <label for="inputEmail4">HCV</label>
                     <select id="inputState" name="hcv" class="form-control">
                    <option >Choose...</option>
                    
                        <option value="Positive" ${hcv === 'Positive' ? 'selected' : ''}>Positive</option>
                        <option value="Negative" ${hcv === 'Negative' ? 'selected' : ''}>Negative</option>
                  </select>
                </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">VDRL</label>
        <select id="inputState" name="vdrl" class="form-control">
        <option>Choose...</option>
    
                        <option value="Positive" ${vdrl === 'Positive' ? 'selected' : ''}>Positive</option>
                        <option value="Negative" ${vdrl === 'Negative' ? 'selected' : ''}>Negative</option>   
                        </select>
    </div>
  </div>
  <div class="form-row">
     <div class="form-group col-md-6">
      <label for="inputEmail4">Malaria</label>
          <select id="inputState" name="malaria" class="form-control">
        <option >Choose...</option>
        
                        <option value="Positive" ${malaria === 'Positive' ? 'selected' : ''}>Positive</option>
                        <option value="Negative" ${malaria === 'Negative' ? 'selected' : ''}>Negative</option> 
      </select>
    </div>
  </div>
 
  
            ');
      }

      $(document).on('click', '.open-dynamic-modal', function() {
        console.log('id=>');
        // Your code to open the modal here
        // You can access data attributes using $(this).data('attribute-name')
        var id = $(this).data('id');
        console.log(id);
        var hiv = $(this).data('hiv');
        var hbsag = $(this).data('hbsag');
        var hcv = $(this).data('hcv');
        var vdrl = $(this).data('vdrl');
        var malaria = $(this).data('malaria');

        // Open the modal and pass data as needed
        updateModalContent(id, hiv, hbsag, hcv, vdrl, malaria);
      });


      // Handle the "Save" button click if needed
      $('#saveModalButton').on('click', function() {
        // Handle form submission or data saving here
        // You can access the selected values with $('#hiv').val(), $('#hbsag').val(), etc.
        // and the corresponding donationform_id with $('#dynamicModalBody input[name="donationform_id"]').val()
      });
    });
  </script>*/
  
    <script>
   $("#reset").click(function(){
$("input").val("");
window.location.href = window.location.href;
});</script>
 