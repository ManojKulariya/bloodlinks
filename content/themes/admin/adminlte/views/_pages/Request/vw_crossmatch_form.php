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

    table.dataTable thead th,
    table.dataTable thead td {
        font-size: 12px;
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

                        if ($per->CrossMatch_permission  == 'Write') {

                    ?>
                            <div class="btn-group" style="float: right;">
                                <h6>Add Cross Match Form</h6>
                                <a href="<?php echo $base_url; ?>/request/cross_match_add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
                            </div><br><br>
                        <?php }
                    } else { ?>
                        <div class="btn-group" style="float: right;">
                            <h6>Add Cross Match Form</h6>
                            <a href="<?php echo $base_url; ?>/request/cross_match_add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
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
                                <label for="description">Cross Match No</label>
                                <input type="text" class="form-control" id="price" name="cross_match" value="<?php if (isset($_POST) && isset($_POST['cross_match'])) {
                                                                                                                    echo $_POST['cross_match'];
                                                                                                                } ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Components Required</label>
                                <input type="tel" class="form-control" id="price" name="Component_required" value="<?php if (isset($_POST) && isset($_POST['Component_required'])) {
                                                                                                                        echo $_POST['Component_required'];
                                                                                                                    } ?>">
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
                    <th>Unit NO</th>
                    <th>Cross Match No</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Request No</th>
                    <th>Blood Group</th>
                    <th>Componets Required</th>
                    <!--   <th>Mobile No</th>
  <th>Issue Pending</th> -->
                    <th>User</th>
                    <!-- <?php
                            if ($_SESSION['admin_type'] == '0') {
                                $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                                $per = json_decode($servies_per);

                                if ($per->CrossMatch_permission  == 'Write') {

                            ?>
   <th>Action</th>
<?php }
                            } else { ?>
 <th>Action</th>
<?php } ?> -->

                </tr>
            </thead>
            <tbody>
                <?php
                $master_data = $this->db->query("SELECT * FROM bl_masters  WHERE master_type_name = 'Components Types'");
                $master = $master_data->result();
                $no = 0;
                
                foreach ($crossmatches as $row) {
                    $no++;
                ?>

                    <tr>
                        <th scope="row"><?= $no ?></th>
                        <td class="capitalize"><?= $row->unit_no ?></td>
                        <td class="capitalize"><?= $row->cross_match ?></td>
                        <td class="capitalize"><?= date('d-m-Y', strtotime($row->crossmatch_date)) ?></td>
                        <td class="capitalize"><?= $row->p_name ?></td>
                        <td class="capitalize"><?= $row->request ?></td>
                        <td class="capitalize"><?= $row->blood_group ?></td>

                        <td class="capitalize">
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
                        <td class="capitalize"><?= $row->crossmatch_by ?></td>

                        <!--        <?php
                                    if ($_SESSION['admin_type'] == '0') {
                                        $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                                        $per = json_decode($servies_per);

                                        if ($per->CrossMatch_permission  == 'Write') {

                                    ?>
   <td><?php echo '<a href="' . $this->data['base_url'] . '/donations/donationform/' . $row->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
<?php }
                                    } else { ?>
 <td><?php echo '<a href="' . $this->data['base_url'] . '/donations/donationform/' . $row->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $row->id . ');" ><i class="fa fa-trash"></i></button>'; ?></td>
<?php } ?> -->


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
        <h3 class="card-title">Cross Match</h3>
         <div class="btn-group" style="float: right;">
          <a href="<?php echo $base_url; ?>/request/cross_match_add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div>
      </div>

      <div class="card-body">
        <table id="table_crossmatch" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Unit No.</th>
            <th>Component</th>
            <th>Tube No.</th>
            <th>Blood Group</th>
            <th>Bleeding Date</th>
            <th>Expiry Date</th>
            <th>Crossmatch No.</th>
            <th>Crossmatch By</th>
            <th>Core</th>
            <th>Nat</th>
          </tr>
          </thead>
        
        </table>
      </div>

    </div>

  </div>

  <script type="text/javascript">
    var apppointment_search='<?php echo $base_url; ?>/request/cross_match_search';
    // var deleteSingleData='<?php echo $base_url; ?>/donations/deleteSingleData';
  </script> -->
    <script type="text/javascript">
        function deleteFun(id) {
            // alert(id);

            if (confirm('Are you sure') == true) {

                $.ajax({

                    url: '<?php echo $base_url; ?>/request/cross_match_delete',
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