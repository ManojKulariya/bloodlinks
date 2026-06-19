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
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Define the number of records per page
$perPage = 10;

// Calculate the starting serial number
$sr_no = ($currentPage - 1) * $perPage + 1;
?>

<style type="text/css">
.pagination {
    list-style: none;
    padding: 0;
  }

  .pagination li {
    display: inline;
    margin-right: 5px;
  }

  .pagination li a {
    text-decoration: none;
    padding: 5px 10px;
    border: 1px solid #ddd;
  }

  .pagination li.active a {
    background-color: #007bff;
    color: white;
  }
    .no-spin::-webkit-inner-spin-button,
    .no-spin::-webkit-outer-spin-button {
        -webkit-appearance: none !important;
        margin: 0 !important;
    }

    .no-spin {
        -moz-appearance: textfield !important;
    }

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
        text-transform: capitalize;
    }

    .card-footer {
        padding: 6px 0 8px;
        background-color: #fff;
    }

    table.dataTable tbody th,
    table.dataTable tbody td {
        padding: 5px 0 !important;
    }

    .form-group {
        margin-bottom: 0;
    }

    table.dataTable thead th,
    table.dataTable thead td {
        padding: 0 10px !important;
        font-size: 12px;
    }

    table.dataTable tbody th,
    table.dataTable tbody td {
        padding: 8px 0;
        font-size: 14px;
    }

    tbody {
        text-transform: capitalize;
    }

    .page-item.active .page-link {
        background-color: #ad1e1d;
        border-color: #ad1e1d;
    }

    .capitalize {
        text-transform: capitalize;
    }
</style>

<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
//print_r($_POST[]);die();
$bank_id = $_SESSION['bank_id'];
if (!empty($_POST['donationform_id'])) {
    $wb = $_POST['wb'];
    $storge_type = $_POST['chk'];
    if ($storge_type == 'components') {
        foreach ($_POST as $key => $value) {
            if (strpos($key, "component")) {
                $comp[str_replace('component', '', $key)] = $value;
            }
        }
        $component = json_encode($comp);
    } else {
        $component = '';
    }
    $donationform_id = $_POST['donationform_id'];
    $update = $this->db->query("UPDATE bl_bb_donatioform SET component_user_id = '$auth_id',storge_type = '$storge_type' , wb = '$wb' , component = '$component' , component_user = '$type->name'  WHERE id = '$donationform_id'");
    if ($update == true) {
        $query = $this->db->query("SELECT * FROM bl_bb_donatioform WHERE id = '$donationform_id'");
        foreach ($query->result() as $bloodgroup) {
            // print_r($bloodgroup);die();
        }
        $this->db->query("DELETE FROM bl_blood_record WHERE donation_id = '$donationform_id'");

        $queryS = $this->db->query("SELECT * FROM bl_blood_record WHERE donation_id = '$donationform_id'");
        foreach ($queryS->result() as $data) {
        }
        if ($storge_type == 'components') {
            $comp = json_decode($component);
            //print_r($comp); die;
            $i = 1;
            foreach ($comp as $key => $blood_record) {
                $blood_type = $key;
                $blood_unitno = $bloodgroup->unit_no . '-' . $i++;

                $master_days = $this->db->query("SELECT * FROM bl_masters WHERE master_id  = $key");
                $rc = $master_days->result();
                $expiry_dt = date('Y-m-d', strtotime($bloodgroup->donation_date . ' + ' . $rc[0]->expiry_day  . ' days'));

                $insert1 = $this->db->query("INSERT INTO bl_blood_record (donation_id ,bloodbank_id ,donor_unit_no, unit_no, tube_no ,
            component , collection_date , expiry_date, bag_config ,blood_group , blood_volume , tti_test ,  cross_match , issue_status ,
            issued_vol , final_vol) VALUES ('$donationform_id','$bank_id' , '$bloodgroup->unit_no', '$blood_unitno' ,'$bloodgroup->tube' ,
            '$blood_type', '$bloodgroup->donation_date', '$expiry_dt' ,'Mother' ,'$bloodgroup->blood_group' ,'$blood_record',
            '$bloodgroup->status' , 'No', 'No','0','$blood_record')");
            }
        } else {
            $blood_type = 'wholeblood';
            $blood_unitno = $bloodgroup->unit_no . '-6';
            $expiry_wholeblood = date('Y-m-d', strtotime($bloodgroup->donation_date . ' + 42 days'));

            $insert1 = $this->db->query("INSERT INTO bl_blood_record (donation_id ,bloodbank_id , donor_unit_no, unit_no, tube_no , component ,
         collection_date, expiry_date, bag_config ,blood_group , blood_volume , tti_test ,  cross_match , issue_status , issued_vol , 
         final_vol) VALUES ('$donationform_id','$bank_id' , '$bloodgroup->unit_no', '$blood_unitno' ,'$bloodgroup->tube' ,'$blood_type' , 
         '$bloodgroup->donation_date' , '$expiry_wholeblood' ,'Mother' ,'$bloodgroup->blood_group' ,'$bloodgroup->wb','$bloodgroup->status' 
         , 'No', 'No','0','$bloodgroup->wb')");
        }
        redirect('/admin/donations/invcomponents');
        exit;
    }
} ?>


<?php defined('BASEPATH') or exit('No direct script access allowed');

$bank_id = $_SESSION['bank_id'];
?>
<div class="container">
    <form action="<?php echo base_url('admin/donations/invcomponents'); ?>" method="GET" id="filter_form">
        <!--<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">-->

        <div class="timeline">

            <div class="card">

                <div class="card-body">


                    <div class="row">


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
                                <label for="description">Unit No</label>
                                <input type="text" class="form-control" id="unit_no" name="unit_no" value="<?php if (isset($_POST) && isset($_POST['unit_no'])) {
                                                                                                                echo $_POST['unit_no'];
                                                                                                            } ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Storage Type</label>
                                <select name="storage_type" id="vender" class="form-control">
                                    <option disabled="disabled" selected="selected" value="">Select</option>
                                    <option value="wholeblood" <?php if (isset($_POST) && isset($_POST['storage_type'])) {
                                                                    if ($_POST['storage_type'] == 'wholeblood') {
                                                                        echo "selected='selected'";
                                                                    }
                                                                } ?>>Wholeblood</option>
                                    <option value="components" <?php if (isset($_POST) && isset($_POST['storage_type'])) {
                                                                    if ($_POST['storage_type'] == 'components') {
                                                                        echo "selected='selected'";
                                                                    }
                                                                } ?>>Components</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php if (isset($_POST) && isset($_POST['start_date'])) {
                                                                                                                        echo $_POST['start_date'];
                                                                                                                    } ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="<?php if (isset($_POST) && isset($_POST['end_date'])) {
                                                                                                                    echo $_POST['end_date'];
                                                                                                                } ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Component</label>
                                <input type="text" class="form-control" id="price" name="component">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">User</label>
                                <select name="user" id="vender" class="form-control">
                                    <option value="#" selected disabled>Select</option>
                                    <?php
                                    $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user");
                                    foreach ($query1->result() as $type) {
                                    ?>
                                        <option value="<?= $type->name; ?>" <?php if (isset($_POST) && isset($_POST['user'])) {
                                                                                if ($_POST['user'] == $type->name) {
                                                                                    echo "selected='selected'";
                                                                                }
                                                                            } ?>><?= $type->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                            <button type="submit" name="submit" class="btn btn-sm btn-danger">Filter</button> <button class="btn btn-sm btn-warning mx-2 text-white" id="reset"type="submit" /> Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    <div class="container">
        <div style="box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);overflow-x:auto;padding: 10px;border-radius: 5px;margin: 0 -6px;">
            <table class="table table-fluid" id="myTable">
                <thead>
                    <tr>
                        <th>S No</th>
                        <!-- <th>Name</th> -->
                        <th>Unit No</th>
                        <th>Tube No</th>
                        <th>Blood Group</th>
                        <th>Storage Type</th>
                        <th>Componets</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>User</th>

                        <?php
                        if ($_SESSION['admin_type'] == '0') {
                            $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                            $per = json_decode($servies_per);

                            if ($per->BloodFraction_permission == 'Write') {

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
                    $getmaster_comp_data = $this->db->query("SELECT * FROM bl_masters WHERE master_type_name = 'Components Types' ");
                    $master_comp_data = $getmaster_comp_data->result();
                    // $sr_no = 1; 
                    foreach($record as $row) {
                    ?>
                        <tr> 
                            <th scope="row"><?= $sr_no++; ?></th>
                            <td class="capitalize"><?= $row['unit_no'] ?> </td>
                            <td class="capitalize"><?= $row['tube']  ?></td>
                            <td class="capitalize"><?= $row['blood_group']  ?></td>
                            <td class="capitalize"><?= $row['storge_type']  ?></td>
                            <td>
                                <?php
                                if ($row['component']  == '') {
                                } else {
                                    $comp = json_decode($row['component'] );
                                    foreach ($comp as $key => $rowdata) {
                                        foreach ($master_comp_data as $m_data) {
                                            if ($m_data->master_id == $key) {
                                                echo $m_data->master_type_key_short_value . '(' . $rowdata . 'ml)';
                                            }
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td><?= $row['wb']  ?></td>
                            <td><?= date('d-m-Y', strtotime($row['donation_date'])) ?></td>
                            <td><?= $row['component_user']  ?></td>
                            <?php
                            if ($_SESSION['admin_type'] == '0') {
                                $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                                $per = json_decode($servies_per);

                                if ($per->BloodFraction_permission  == 'Write') {

                            ?>
                                    <td><?php echo '
                <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModalScrollable' . $row['id']  . '" style="color:white;"><i class="fa fa-check"></i></button>
        '; ?></td>
                                <?php }


                                if ($per->BloodFraction_permission  == 'Delete') {

                                ?>
                                    <td><?php echo '
                   <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row['id']  . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
                                <?php }
                            } else { ?>
                                <td><?php echo '<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModalScrollable' . $row['id']  . '" style="color:white;"><i class="fa fa-check"></i></button> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row['id']  . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
                            <?php } ?>


                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <br>
          <div class="pagination-links">
    <?php echo $pagination; ?>
  </div>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
    "ordering": false,
    "info": false,
    "searching": false,
    "paging": false,
    "lengthChange": false,
    "filter": false
  });
            });
        </script>

        <script type="text/javascript">
            function deleteFun(id) {
                // alert(id);
                if (confirm('Are you sure') == true) {

                    $.ajax({

                        url: '<?php echo $base_url; ?>/donations/invcomponents_delete',
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
        <?php
        $query1 = $this->db->query("SELECT * FROM bl_bb_donatioform WHERE bl_bb_donatioform.bloodbank_id = '$bank_id'And bl_bb_donatioform.status = 'Test Done' ");
        foreach ($query1->result() as $row) {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalScrollable<?= $row->id ; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">Entry Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="scheduling-confirm" action="<?php $_PHP_SELF ?>" method="POST" style="padding-bottom: 0px!important; margin: 0px!important;">
                            <div class="modal-body">

                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <?php
                                // $login = $_SESSION['bank_id'];
                                $querywb = $this->db->query("SELECT * FROM bl_masters WHERE master_id  = 18 LIMIT 1");
                                $rowwb = $querywb->row();
                                $query = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id= '$bank_id'");
                                foreach ($query->result() as $data) {
                                }
                                $ids = explode(',', $data->components_available);
                                $array = []; ?>

                                <div class="form-group col-md-12" style="font-weight: bold;">
                                    Total Blood Volume:
                                    <input type="number" name="wb" min="<?= $rowwb->min_volume ?>" max="<?= $rowwb->max_volume ?>" required class="form-control" value="<?php if (isset($row->wb )) {echo $row->wb ;  } ?>">
                                </div>
                                <?php if (($data->component_facillity == 'component') || ($data->component_facillity == 'both')) {    ?>
                                    <label for="chkYes">
                                        <input type="radio" id="<?= $row->id ; ?>" name="chk" value="components" onclick="ShowHideDiv(<?= $row->id ; ?>)" />
                                        Components
                                    </label>
                                    <label for="chkNo">
                                        <input type="radio" id="chkNo<?= $row->id ; ?>" name="chk" value="wholeblood" onclick="ShowHideDiv(<?= $row->id ; ?>)" />
                                        Whole Blood
                                    </label>

                                <?php  } ?>

                                <?php
                                
                                if (($data->component_facillity == 'component') || ($data->component_facillity == 'both')) {
                                    foreach ($ids as $v) {
                                        $query = $this->db->query("SELECT * FROM bl_masters WHERE master_id  = '$v'");
                                        foreach ($query->result() as $components) {
                                            $array[] = $components;
                                        }
                                    } ?>
                                    <div id="dvtext<?= $row->id ; ?>" style="display: none">
                                        <!--  <p style="border-bottom: 1px solid black;padding: 10px;font-weight: bold;">Components :-</p> -->
                                        <?php if (($data->component_facillity == 'component') || ($data->component_facillity == 'both')) { ?>
                                            <div class="form-row mt-3">
                                                <?php foreach ($array as $ms_data) {  ?>
                                                    <div class="form-group col-md-6" style="font-size: 15px;">
                                                        <?= $ms_data->master_type_key_short_value ?>:
                                                        <input type="number" name="<?= $ms_data->master_id ?>component" min="<?= $ms_data->min_volume ?>"  max="<?= $ms_data->max_volume ?>" class="no-spin" value="">
                                                    </div>
                                                <?php  } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <input type="hidden" value="<?php echo $row->id ; ?>" id="blood_bank_id" name="donationform_id">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                function ShowHideDiv(id) {
                    // alert(id)
                    var chkYes = document.getElementById(id);
                    var dvtext = document.getElementById('dvtext' + id);

                    // console.log(chkYes.checked);

                    dvtext.style.display = chkYes.checked ? "block" : "none";
                }
            </script>
        <?php } ?> <script>
            $("#reset").click(function() {
                $("input,select").val("");
                window.location.href = window.location.href;
            });
        </script>