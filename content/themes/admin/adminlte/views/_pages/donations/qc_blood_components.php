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

            if ($per->Consumables_permission  == 'Write') {

          ?>

              <div class="btn-group" style="float: right;">
                <h6>Add QC For Blood & Components</h6>
                <a href="<?php echo $base_url; ?>/donations/qc_blood_components/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
              </div><br><br>
            <?php }
          } else { ?>

            <div class="btn-group" style="float: right;">
              <h6>Add QC For Blood & Components</h6>
              <a href="<?php echo $base_url; ?>/donations/qc_blood_components/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
            </div><br><br>
          <?php } ?>
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="price"> Unit No</label>
                <input type="text" class="form-control" id="price" name="unit_no" value="<?php if(isset($_POST) && isset($_POST['unit_no'])){ echo $_POST['unit_no']; } ?>">

              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="price">QC Id</label>
                <input type="text" class="form-control" id="price" name="qc_id" value="<?php if(isset($_POST) && isset($_POST['qc_id'])){ echo $_POST['qc_id']; } ?>">

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
                <label for="price">Expiry Date</label>
                <input type="date" class="form-control" id="price" name="expiry" value="<?php if(isset($_POST) && isset($_POST['expiry'])){ echo $_POST['expiry']; } ?>">

              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Date Of Collection</label>
                <input type="date" class="form-control" id="price" name="collection_date" value="<?php if(isset($_POST) && isset($_POST['collection_date'])){ echo $_POST['collection_date']; } ?>">
              </div>
            </div>


          </div>


          <div class="card-footer col-md-12">
            <div class="btn-group" style="float: right;">
              <button type="submit" name="submit" class="btn btn-sm btn-danger">Filter</button>
              <button class="btn btn-sm btn-warning mx-2 text-white" id="reset" name="reset" type="submit"/>         Reset</button>              

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
  <div style="overflow-x:auto;box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);padding: 12px;border-radius: 4px;margin-left: -6px;">
    <table class="table table-fluid" id="myTable" style="font-size: 12px;">
      <thead>
        <tr>
          <th>S No</th>
          <th>QC Id</th>
          <th>QC Date</th>
          <th>Unit No </th>
          <th>Component</th>
          <th>Collection Date</th>
          <th>Expiry Date</th>
          <th>Volume</th>
          <th>HB</th>
          <th>HCT (PCV)</th>
          <th>Platelet Count</th>
          <th>Factor-8 Fibrinogen</th>
          <th>Sterlity</th>
          <!-- <th>Anticoagulants</th> -->
          <th>QC Done by</th>
          <!-- <th>Fibrinogen</th> -->
          <!-- <th>Factor Vill</th> -->
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
          $unit_no = $_POST['unit_no'];
          $qc_id = $_POST['qc_id'];
          $expiry = $_POST['expiry'];
          $start_date = $_POST['start_date'];
          $end_date = $_POST['end_date'];
          $collection_date = $_POST['collection_date'];
          if (!empty($collection_date) && !empty($qc_id) && !empty($unit_no) && !empty($expiry) && (!empty($start_date) && !empty($end_date))) {
            $query = $this->db->query("SELECT * FROM bl_qc_component WHERE bl_qc_component.qc_date BETWEEN '$start_date' AND '$end_date' AND bl_qc_component.bloodbank_id = '$bank_id' And bl_qc_component.collection_date = '$collection_date' And bl_qc_component.expiry_date = '$expiry' And bl_qc_component.unit_no = '$unit_no' And bl_qc_component.qc_id = '$qc_id' ORDER BY ID DESC");
          } else {
$search='';
            if (!empty($unit_no)) {
              if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_qc_component.unit_no = '$unit_no'";
            } 
			if (!empty($qc_id)) {
              if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= " bl_qc_component.qc_id = '$qc_id'";
            } 
			if (!empty($collection_date)) {
              if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_qc_component.collection_date = '$collection_date'";
            } 
			if (!empty($expiry)) {
              if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_qc_component.expiry_date = '$expiry'";
            } 
			if (!empty($start_date) && empty($end_date)) {
              if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_qc_component.created_at = '$start_date' ";
            }
			
			if (empty($start_date) && !empty($end_date)) {
              if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_qc_component.created_at = '$end_date'";
            }
			
			if (!empty($start_date) && !empty($end_date)) {
              if(!empty( $search)) {
						 $search .=' And ';
					}
              $search .= "bl_qc_component.created_at BETWEEN '$start_date' AND '$end_date'";
            }
			$querySearch='';
			if(!empty($search)){
			$querySearch='And '. $search;
			}
            $query = $this->db->query("SELECT * FROM bl_qc_component  WHERE bl_qc_component.bloodbank_id = '$bank_id' $querySearch ORDER BY ID DESC");
          }
        } else {
          $query = $this->db->query("SELECT * FROM bl_qc_component WHERE bl_qc_component.bloodbank_id = '$bank_id' ORDER BY ID DESC");
        }
        foreach ($query->result() as $row) {
          $no++;
          if ($row->component == 18) {
            $component = "wholeblood";
          } elseif ($row->component == 19) {
            $component = "CRYO";
          } elseif ($row->component == 20) {
            $component = "FFP";
          } elseif ($row->component == 21) {
            $component = "RDP";
          } elseif ($row->component == 22) {
            $component = "PRBC";
          } else {
            $component = $row->component;
          }
          $hb = '';
          $queryhb = $this->db->query("SELECT * FROM  bl_blood_record WHERE unit_no = '$row->unit_no' And bag_config = 'Mother'")->row();
          //echo "<pre>"; print_r($queryhb) ; die;
			if(!empty($queryhb)){
		 $donation_id = $queryhb->donation_id;
          if ($donation_id != 0 ) {
            $queryhb_data = $this->db->query("SELECT * FROM  bl_bb_donatioform WHERE id = '$donation_id'")->row();
            $hb = $queryhb_data->hemoglobin;
          }
			}
        ?>

          <tr>
            <th scope="row"><?= $no ?></th>
            <td class="capitalize"><?= $row->qc_id ?></td>
            <td class="capitalize"><?= $row->qc_date ?></td>
            <td class="capitalize"><?= $row->unit_no ?></td>
            <td class="capitalize"><?= $component ?></td>
            <td class="capitalize"><?= $row->collection_date ?></td>
            <td class="capitalize"><?= $row->expiry_date ?></td>
            <td class="capitalize"><?= $row->volume ?></td>
            <td class="capitalize"><?= $hb ?></td>
            <td class="capitalize"><?= $row->pcv ?></td>
            <td class="capitalize"><?= $row->platelet ?></td>
            <td class="capitalize"><?= $row->factor_8_fibrinogen ?></td>
            <td class="capitalize"><?= $row->sterllty ?></td>
            <td class="capitalize"><?= $row->done_by ?></td>
            <?php
            if ($_SESSION['admin_type'] == '0') {
              $servies_per = $_SESSION['bloodbank_user_servies_permission'];
              $per = json_decode($servies_per);

              if ($per->Consumables_permission  == 'Write') {

            ?>
                <td><?php echo '<button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
              <?php }
            } else { ?>
              <td><?php echo '<button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
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

          url: '<?php echo $base_url; ?>/donations/qc_blood_components_delete',
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
   $("#reset").click(function(){
$("input,select").val("");
window.location.href = window.location.href;
});</script>