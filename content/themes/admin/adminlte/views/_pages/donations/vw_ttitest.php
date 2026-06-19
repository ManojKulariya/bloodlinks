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
  $ttitest_by_id = $auth_id;

  $donationform_id = $_POST['donationform_id'];
     
  if (($hiv == 'Negative') && ($hbsag == 'Negative') && ($hcv == 'Negative') && ($vdrl == 'Negative') && ($malaria == 'Negative')) {
    $status = 'Test done';
    $update = $this->db->query("UPDATE bl_bb_donatioform SET 
                            discard_no ='', discard_date ='', hiv = '$hiv',hbsag = '$hbsag',hcv = '$hcv',malaria = '$malaria',vdrl = '$vdrl' , 
                            status ='$status', ttitest_by='$type->name',
                            ttitest_by_id='$ttitest_by_id' WHERE id = '$donationform_id'");

  } else {
    $status = 'discard';
    $discard = date('ymd') . time() . rand(1000, 9999);
    $blood_discard = 'DB' . $discard;
    $update = $this->db->query("UPDATE bl_bb_donatioform SET hiv = '$hiv',hbsag = '$hbsag',hcv = '$hcv',malaria = '$malaria',vdrl = '$vdrl',
    status ='$status',
    ttitest_by_id='$ttitest_by_id',
    discard_no ='$blood_discard', 
    discard_date ='$ddate', 
    ttitest_by='$type->name' 
    WHERE id = '$donationform_id'");
  }
  // ✅ redirect after process
    redirect('admin/donations/ttitest');
}

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
                
    	}else{
    	    echo "<script>alert('already discarded!')</script>";
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
                <label for="description">Test Status</label>
                <select name="status" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
                  <option value="Test done" <?php if(isset($_POST) && isset($_POST['status'])){  if($_POST['status'] == 'Test Done') {echo"selected='selected'";} } ?>>Test done</option>
                  <option value="Test Not Done" <?php if(isset($_POST) && isset($_POST['status'])){  if($_POST['status'] == 'Test Not Done') {echo"selected='selected'";} } ?>>Test Not Done</option>
                 
                  <option value="Pending" <?php if(isset($_POST) && isset($_POST['status'])){  if($_POST['status'] == 'Pending') {echo"selected='selected'";} } ?>>Pending</option>

                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Test Result</label>
                <select name="test_result" id="vender" class="form-control">
                  <option disabled="disabled" selected="selected" value="">Select</option>
                  <option value="Postive" <?php if(isset($_POST) && isset($_POST['test_result'])){  if($_POST['test_result'] == 'Postive') {echo"selected='selected'";} } ?>>Postive</option>
                  <option value="Negative" <?php if(isset($_POST) && isset($_POST['test_result'])){  if($_POST['test_result'] == 'Negative') {echo"selected='selected'";} } ?>>Negative</option>

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
                  <option value="direct" <?php if(isset($_POST) && isset($_POST['donation_type'])){  if($_POST['donation_type'] == 'direct') {echo"selected='selected'";} } ?>>Direct</option>
                  <option value="camp" <?php if(isset($_POST) && isset($_POST['donation_type'])){  if($_POST['donation_type'] == 'camp') {echo"selected='selected'";} } ?>>Camp</option>

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
                  <option value="discard" <?php if(isset($_POST) && isset($_POST['discard_type'])){  if($_POST['discard_type'] == 'discard') {echo"selected='selected'";} } ?>>Discard</option>
                  <option value="no discard" <?php if(isset($_POST) && isset($_POST['discard_type'])){  if($_POST['discard_type'] == 'no discard') {echo"selected='selected'";} } ?>>No Discard</option>

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
                    <option value="<?= $type->name; ?>" <?php if(isset($_POST) && isset($_POST['user'])){  if($_POST['user'] == $type->name) {echo"selected='selected'";} } ?>><?= $type->name; ?></option>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

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
          <th>Discard</th>
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

        $base_url = str_replace('/admin', '', $this->data['base_url']);
        foreach ($donations as $row) {
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
            <td style="text-transform: capitalize;"><?= date('d-m-Y', strtotime($row->donation_date)) ?></td>
            <td style="text-transform: capitalize;"><?= $row->ttitest_by ?></td>
            <td class="capitalize"><?php 
            echo '<button type="button" class="btn btn-xs btn-success open-dynamic-modal-discard" data-toggle="modal" data-target="#dynamicModaldiscard" 
                    data-id="' . $row->id.'" data-bankid="'.$bank_id.'"><i class="fa-solid fa-droplet-slash"></i></button>';  ?></td>
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
          <h5 class="modal-title" id="dynamicModalTitle">Discard</h5>
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
 <!-- Modal -->
  <div class="modal fade" id="dynamicModaldiscard" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="dynamicModalTitle">Modal Title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="scheduling-confirm" action="<?php $_PHP_SELF ?>" method="POST" style="padding-bottom: 0px!important; margin: 0px!important;">

          <div class="modal-body" id="dynamicModalBodydiscard">
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
    <script>
    $(document).ready(function() {
      // Function to update the modal content
      function updateModalContent(id, hiv, hbsag, hcv, vdrl, malaria) {
        
        $('#dynamicModalTitle').text('TTItest Form');
        $('#dynamicModalBody').html(`
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
  
            `);
      }

      $(document).on('click', '.open-dynamic-modal', function() {
        
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
      $(document).on('click', '.open-dynamic-modal-discard', function() {
        var id = $(this).data('id');
        var bankid = $(this).data('bankid');
        updateModalContentdiscard(id,bankid);
      });
    function updateModalContentdiscard(id,bankid) {
        
        $('#dynamicModalTitle').text('Discard Issued Blood');
        $('#dynamicModalBodydiscard').html(`
            <input type="hidden" name="type" value="1">
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
  
    <script>
   $("#reset").click(function(){
$("input , select").val("");
window.location.href = window.location.href;
});</script>
 