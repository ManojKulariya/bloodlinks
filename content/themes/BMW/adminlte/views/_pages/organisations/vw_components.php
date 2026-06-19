<style type="text/css">
    .form-control {
        height: 1.6rem !important;
        padding: 0 !important;
        font-size: 0.9rem !important;
    }

    label {
        margin-bottom: 0;
        font-size: 12px;
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

    .btn-success {
        background-color: #ad1e1d;
        border-color: #ad1e1d;
    }

    table.dataTable thead th,
    table.dataTable thead td {
        padding: 0 12px !important;
    }

    .content-header h1 {
        font-size: 1.2rem;
        margin: 0 8px;
        font-weight: bold;
    }

    .form-control {
        height: 30px;
        font-size: 14px;
    }

    .card-footer {
        padding: 10px 0 0;
        background-color: #fff;
    }

    .capitalize {
        text-transform: capitalize;
    }

    .btn-success:hover {
        background-color: #ad1e1d;
        border-color: #ad1e1d;
    }

    .page-link:hover {
        color: #ad1e1d;
    }

    .card-body {
        padding: 0 10px 6px;
    }
</style>

<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
if (!empty($_GET['donationform_id'])) {

    //        print_r($_GET); die;
    // Array ( [ci_csrf_token] => [wb] => 500 [chk] => components [CPP_component] => 100 [CRYO_component] => 100 [FFP_component] => 200 [RBC_component] => 100 [donationform_id] => 11 [submit] => )
    $wb = $_GET['wb'];

    $storge_type = $_GET['chk'];
    if ($storge_type == 'components') {

        foreach ($_GET as $key => $value) {
            if (strpos($key, "component")) {
                $component[$key] = $value;
            }
        }
        // print_r($component);                                                                                             
        $component = json_encode($component);
    } else {
        $component = '';
    }

    $donationform_id = $_GET['donationform_id'];

    // print_r($donationform_id);


    $update = $this->db->query("UPDATE bl_bb_donatioform SET storge_type = '$storge_type' , wb = '$wb' , component = '$component'  WHERE id = '$donationform_id'");

    if ($update == true) {

        $query = $this->db->query("SELECT * FROM bl_bb_donatioform WHERE id = '$donationform_id'");
        foreach ($query->result() as $bloodgroup) {
            //print_r($bloodgroup);die();
        }
        
        $queryS = $this->db->query("SELECT * FROM bl_blood_record WHERE donation_id = '$donationform_id'");
        foreach ($queryS->result() as $data) {
        }
        if ($storge_type == 'components') {
            $comp = json_decode($component);
            if (!empty($comp->CPP_component)) {
                $blood_type = 'CPP';
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

                $blood_unit = reg($n);
                $blood_unitno = 'BU' . $blood_unit;
                if (empty($data)) {

                    $insert1 = $this->db->query("INSERT INTO bl_blood_record (donation_id ,bloodbank_id , unit_no, tube_no , component ,bag_config ,blood_group , blood_volume , tti_test ,  cross_match , issue_status , issued_vol , final_vol) VALUES ('$donationform_id','$bank_id' , '$blood_unitno' ,'$bloodgroup->tube' ,'$blood_type' ,'Mother' ,'$bloodgroup->blood_group' ,'$comp->CPP_component','$bloodgroup->status' , 'No', 'No','0','$comp->CPP_component')");
                } else {
                    $update1 = $this->db->query("UPDATE bl_blood_record SET component = '$blood_type',blood_volume = '$bloodgroup->wb',tti_test = '$bloodgroup->status',final_vol = '$bloodgroup->wb' WHERE donation_id = '$donationform_id'");
                }
            }
           
            if (!empty($comp->CRYO_component)) {
                $blood_type = 'CRYO';
                $n2 = 6;
                function reg2($n2)
                {
                    $characters = '0123456789';
                    $randomString = '';

                    for ($i = 0; $i < $n2; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                    }

                    return $randomString;
                }

                $blood_unit2 = reg2($n2);
                $blood_unitno = 'BU' . $blood_unit2;
                if (empty($data)) {

                    $insert1 = $this->db->query("INSERT INTO bl_blood_record (donation_id ,bloodbank_id , unit_no, tube_no , component ,bag_config ,blood_group , blood_volume , tti_test ,  cross_match , issue_status , issued_vol , final_vol) VALUES ('$donationform_id','$bank_id' , '$blood_unitno' ,'$bloodgroup->tube' ,'$blood_type' ,'Mother' ,'$bloodgroup->blood_group' ,'$comp->CRYO_component','$bloodgroup->status' , 'No', 'No','0','$comp->CRYO_component')");
                } else {
                    $update1 = $this->db->query("UPDATE bl_blood_record SET component = '$blood_type',blood_volume = '$bloodgroup->wb',tti_test = '$bloodgroup->status',final_vol = '$bloodgroup->wb' WHERE donation_id = '$donationform_id'");
                }
            }
            if (!empty($comp->FFP_component)) {
                $blood_type = 'FFP';
                $n3 = 6;
                function reg3($n3)
                {
                    $characters = '0123456789';
                    $randomString = '';

                    for ($i = 0; $i < $n3; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                    }

                    return $randomString;
                }

                $blood_unit3 = reg3($n3);
                $blood_unitno = 'BU' . $blood_unit3;
                if (empty($data)) {

                    $insert1 = $this->db->query("INSERT INTO bl_blood_record (donation_id ,bloodbank_id , unit_no, tube_no , component ,bag_config ,blood_group , blood_volume , tti_test ,  cross_match , issue_status , issued_vol , final_vol) VALUES ('$donationform_id','$bank_id' , '$blood_unitno' ,'$bloodgroup->tube' ,'$blood_type' ,'Mother' ,'$bloodgroup->blood_group' ,'$comp->FFP_component','$bloodgroup->status' , 'No', 'No','0','$comp->FFP_component')");
                } else {
                    $update1 = $this->db->query("UPDATE bl_blood_record SET component = '$blood_type',blood_volume = ' $comp->FFP_component',tti_test = '$bloodgroup->status',final_vol = '$comp->FFP_component' WHERE donation_id = '$donationform_id'");
                }
            }
            if (!empty($comp->RBC_component)) {
                $blood_type = 'RBC';
                $n4 = 6;
                function reg4($n4)
                {
                    $characters = '0123456789';
                    $randomString = '';

                    for ($i = 0; $i < $n4; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                    }

                    return $randomString;
                }

                $blood_unit4 = reg4($n4);
                $blood_unitno = 'BU' . $blood_unit4;
                if (empty($data)) {

                    $insert1 = $this->db->query("INSERT INTO bl_blood_record (donation_id ,bloodbank_id , unit_no, tube_no , component ,bag_config ,blood_group , blood_volume , tti_test ,  cross_match , issue_status , issued_vol , final_vol) VALUES ('$donationform_id','$bank_id' , '$blood_unitno' ,'$bloodgroup->tube' ,'$blood_type' ,'Mother' ,'$bloodgroup->blood_group' ,'$comp->RBC_component','$bloodgroup->status' , 'No', 'No','0','$comp->RBC_component')");
                } else {
                    $update1 = $this->db->query("UPDATE bl_blood_record SET component = '$blood_type',blood_volume = '$comp->RBC_component',tti_test = '$bloodgroup->status',final_vol = '$comp->RBC_component' WHERE donation_id = '$donationform_id'");
                }
            }
            if (!empty($comp->PRC_component)) {
                $blood_type = 'PRC';
                $n5 = 6;
                function reg5($n5)
                {
                    $characters = '0123456789';
                    $randomString = '';

                    for ($i = 0; $i < $n5; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                    }

                    return $randomString;
                }

                $blood_unit5 = reg5($n5);
                $blood_unitno = 'BU' . $blood_unit5;
                if (empty($data)) {

                    $insert1 = $this->db->query("INSERT INTO bl_blood_record (donation_id ,bloodbank_id , unit_no, tube_no , component ,bag_config ,blood_group , blood_volume , tti_test ,  cross_match , issue_status , issued_vol , final_vol) VALUES ('$donationform_id','$bank_id' , '$blood_unitno' ,'$bloodgroup->tube' ,'$blood_type' ,'Mother' ,'$bloodgroup->blood_group' ,'$comp->PRC_component','$bloodgroup->status' , 'No', 'No','0','$comp->PRC_component')");
                } else {
                    $update1 = $this->db->query("UPDATE bl_blood_record SET component = '$blood_type',blood_volume = '$comp->PRC_component',tti_test = '$bloodgroup->status',final_vol = '$comp->PRC_component' WHERE donation_id = '$donationform_id'");
                }
            }
        } else {
            $blood_type = 'wholeblood';
            $n6 = 6;
            function reg6($n6)
            {
                $characters = '0123456789';
                $randomString = '';

                for ($i = 0; $i < $n6; $i++) {
                    $index = rand(0, strlen($characters) - 1);
                    $randomString .= $characters[$index];
                }

                return $randomString;
            }

            $blood_unit6 = reg6($n6);
            $blood_unitno = 'BU' . $blood_unit6;
            if (empty($data)) {

                $insert1 = $this->db->query("INSERT INTO bl_blood_record (donation_id ,bloodbank_id , unit_no, tube_no , component ,bag_config ,blood_group , blood_volume , tti_test ,  cross_match , issue_status , issued_vol , final_vol) VALUES ('$donationform_id','$bank_id' , '$blood_unitno' ,'$bloodgroup->tube' ,'$blood_type' ,'Mother' ,'$bloodgroup->blood_group' ,'$bloodgroup->wb','$bloodgroup->status' , 'No', 'No','0','$bloodgroup->wb')");
            } else {
                $update1 = $this->db->query("UPDATE bl_blood_record SET component = '$blood_type',blood_volume = '$bloodgroup->wb',tti_test = '$bloodgroup->status',final_vol = '$bloodgroup->wb' WHERE donation_id = '$donationform_id'");
            }
        }
    }
} ?>

<div class="container">
    <form action="<?= base_url('admin/components'); ?>" method="GET">

        <div class="timeline">
           
            <div class="card">

                <div class="card-body">


                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Name</label>
                                <input type="text" class="form-control" id="price" name="name">
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
                                <label for="description">Unit No</label>
                                <input type="text" class="form-control" id="price" name="unit_no">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Storage Type</label>
                                <select name="storage_type" id="vender" class="form-control">
                                    <option disabled="disabled" selected="selected" value="">Select</option>
                                    <option value="wholeblood">Wholeblood</option>
                                    <option value="components">Components</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Start Date</label>
                                <input type="date" class="form-control" id="price" name="start_date">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">End Date</label>
                                <input type="date" class="form-control" id="price" name="end_date">
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
                                        <option value="<?= $type->name; ?>"><?= $type->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Blood Bank</label>
                                <select name="blood_bank" id="vender" class="form-control">
                                    <option value="#" selected disabled>Select</option>
                                    <?php
                                    $query12 = $this->db->query("SELECT * FROM bl_blood_banks");
                                    foreach ($query12->result() as $type) {
                                    ?>

                                        <option value="<?= $type->name; ?>"><?= $type->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                            <button type="submit" name="submit" class="btn btn-sm btn-danger">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

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
                    <th>Blood Bank Name</th>
                    <th>Blood Bank Code</th>
                    <th>Blood Bank City</th>
                    <th>Name</th>
                    <th>Unit No</th>
                    <th>Tube No</th>
                    <th>Blood Group</th>
                    <th>Storage Type</th>
                    <th>Componets</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>User</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $current_page = $current_page== 0?$current_page:$current_page-1;
                $start = ($current_page) * $limit;
                foreach ($componentsdata as $index=>$row) {
                 $sr_no = $start + $index + 1;
                ?>

                    <tr>
                        <th scope="row"><?= $sr_no ?></th>
                        <td class="capitalize"><?= $row->name ?></td>
                        <td class="capitalize"><?= $row->blood_bank_id ?></td>
                        <td class="capitalize"><?= $row->city_name ?></td>
                        <td class="capitalize"><?= $row->donor_name ?></td>
                        <td class="capitalize"><?= $row->unit_no ?></td>
                        <td class="capitalize"><?= $row->tube ?></td>
                        <td class="capitalize"><?= $row->blood_group ?></td>
                        <td class="capitalize"><?= $row->storge_type ?></td>
                        <?php
                        $comp = json_decode($row->component);

                        if ((!empty($comp) && isset($comp->CPP_component))) {
                            if ($comp->CPP_component == '') {
                                $CPP = '';
                            } else {
                                $CPP  =   'CPP' . '(' . $comp->CPP_component . 'ml)';
                            }
                        } else {
                            $CPP = '';
                        }
                        if ((!empty($comp) && isset($comp->CRYO_component))) {
                            if ($comp->CRYO_component == '') {
                                $CRYO = '';
                            } else {
                                $CRYO  =   'CRYO' . '(' . $comp->CRYO_component . 'ml)';
                            }
                        } else {
                            $CRYO = '';
                        }

                        if ((!empty($comp) && isset($comp->FFP_component))) {
                            if ($comp->FFP_component == '') {
                                $FFP = '';
                            } else {
                                $FFP  =   'FFP' . '(' . $comp->FFP_component . 'ml)';
                            }
                        } else {
                            $FFP = '';
                        }

                        if ((!empty($comp) && isset($comp->RBC_component))) {
                            if ($comp->RBC_component == '') {
                                $RBC = '';
                            } else {
                                $RBC  =   'RBC' . '(' . $comp->RBC_component . 'ml)';
                            }
                        } else {
                            $RBC = '';
                        }

                        if ((!empty($comp) && isset($comp->PRC_component))) {
                            if ($comp->PRC_component == '') {
                                $PRC = '';
                            } else {
                                $PRC  =   'PRC' . '(' . $comp->PRC_component . 'ml)';
                            }
                        } else {
                            $PRC = '';
                        }

                        ?>
                        <td class="capitalize"><?= $CPP ?> <?= $CRYO ?> <?= $FFP ?> <?= $RBC ?> <?= $PRC ?></td>
                        <td class="capitalize"><?= $row->wb ?></td>
                        <td class="capitalize"><?= $row->donation_date ?></td>
                        <td><?= $row->component_user ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?= $pagination; ?>
    </div>
    <script>
        $(document).ready(function() {
             $('#myTable').DataTable({
                        "paging": false,     // Disable default pagination
                        "info": false,       // Disable "Showing X to Y of Z entries"
                        "searching": false   // Disable the search box
                    });
        });
    </script>
   
    
    