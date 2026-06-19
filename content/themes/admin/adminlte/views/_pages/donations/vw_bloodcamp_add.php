<?php
$bank_id = $_SESSION['bank_id'];
$equipmentss = [
        "BP apparatus",
        "Stethoscope",
        "Blood Bags",
        "Donor questionnaire",
        "Weighing device (Donor)",
        "Weighing device (Blood Bags)",
        "Artery forceps, scissors",
        "Stripper for blood tubing",
        "Bed sheets, blankets/mattress",
        "Lancets, swab stick/toothpicks",
        "Glass slides",
        "Portable Hb meter",
        "Test tubes",
        "Test tube stand",
        "Anti sera (A,B,AB,D)",
        "Test tube sealer film",
        "Medicated adhesive tape",
        "Plastic waste basket",
        "Donor cards & refreshments",
        "Emergency medical kit",
        "Insulated blood bags container",
        "Dielectric/Portable tube sealer",
        "Needle destroyer"
    ];
$facilities = [
        "Electricity", "Water", "Bed", "Furniture",
        "Emergency Medicine", "Hand Washing/Sanitation",
        "Medical Examination Facility", "Disposal of Waste"
    ];
$components = [
        "Packed Red Blood Cells", "Platelet Concentrate", "Granulocyte Concentrate",
        "Fresh Frozen Plasma", "Cryoprecipitate",
        "Plasma aphaeresis", "Platelet aphaeresis",
        "Leuk aphaeresis", "Other"
    ];
if (!empty($_POST['camp_name'])) {
    //print_r($_POST); die;

    $camp_name = $_POST['camp_name'];
    $camp_code = $_POST['camp_code'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $venue = $_POST['venue'];
    $sponsored = $_POST['sponsored'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $expected_no = $_POST['expected_no'];
    $permission = $_POST['permission'];
    $counselor_name = $_POST['counselor_name'];
    $storage_facility = $_POST['storage_facility'];
    $tentative_blood_units = $_POST['tentative_blood_units'];
    $vehicale_no = $_POST['vehicale_no'];
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

    $blood_camp = reg($n);
    $blood_campno = 'BC' . $blood_camp;
    // ✅ NEW Checklist fields
    $equipment_post = $_POST['equipment'] ?? [];
    $equipment_data = [];
    foreach ($equipment_post as $key => $data) {
        $name = $equipmentss[$key]; // map numeric key back to equipment name
        $equipment_data[$name] = [
            'status' => $data['status'] ?? 'NO',
            'qty' => $data['qty'] ?? 0
        ];
    }
    $equipment_json = json_encode($equipment_data);
    $facilities_post = $_POST['facilities'] ?? [];
    $facilities_data = [];
    foreach ($facilities as $key => $name) {
        $facilities_data[$name] = isset($facilities_post[$key]) ? 'YES' : 'NO';
    }
    
    $facilities_json = json_encode($facilities_data);
    
    $components_post = $_POST['components'] ?? [];
    $components_data = [];
    foreach ($components as $key => $name) {
        $components_data[$name] = isset($components_post[$key]) ? 'YES' : 'NO';
    }
    
    $components_json = json_encode($components_data);

    $inter_district_notice = isset($_POST['inter_district_notice']) ? $_POST['inter_district_notice'] : 'No';
    
    // -- 
    if ($_POST['approved_technicians']) {
        $approved_technicians = $_POST['approved_technicians'];
    }
    if ($_POST['approved_nurses']) {
        $approved_nurses = $_POST['approved_nurses'];
    }
    if ($_POST['approved_nurses']) {
        $approved_moic = $_POST['approved_moic']; 
    }
    $approved_staff = $_POST['approved_staff'] ?? '[]';
    // print_r($_POST);die();
    // --
    $campfile = null;
 
    $filename = $_FILES['user_record']['name'];
    
    if ($filename != "") {
       $file_tmp_name = $_FILES['user_record']['tmp_name'];
       $ext = pathinfo($filename, PATHINFO_EXTENSION);
       $uniquename = date('ymdHis') . rand(11111, 99999);
       move_uploaded_file($file_tmp_name, "uploads/camp/$uniquename.$ext");
       $campfile = "uploads/camp/$uniquename.$ext";
    }
    // print_r($campfile);die();
    $insert = $this->db->query("INSERT INTO bl_bloodcamp (bloodbank_id, blood_name, camp_code, camp_type, start_date, end_date,  venue, sponsored, address, mobile ,latitude ,longitude, state, city , status, start_time, end_time, permission, expected_no,
                                      equipment_list, facilities_list, components_permission, inter_district_notice,tentative_blood_units,storage_facility,counselor_name,
                                      approved_technician,regd_nurse,moic_mo,technical_staff,vehicale_no,file) 
                                      VALUES ( '$bank_id' , '$camp_name' , '$blood_campno' , '$camp_code' , '$start_date', '$end_date' , '$venue' , '$sponsored' , '$address' , '$mobile' ,'$latitude','$longitude', '$state' , '$city' , '2' , '$start_time','$end_time' ,'$permission','$expected_no',
                                       '$equipment_json', '$facilities_json', '$components_json', '$inter_district_notice','$tentative_blood_units','$storage_facility','$counselor_name',
                                       '$approved_technicians','$approved_nurses','$approved_moic','$approved_staff','$vehicale_no','$campfile')");
    // echo $this->db->insert_id();die;
    if ($insert == true) {
        
        redirect('admin/donations/bloodcamps');
    } else {
        echo "fail";
    }
}
?>


<style>
    label {
        margin-bottom: 0 !important;
        font-size: 0.8rem !important;
        font-weight: 700 !important;
    }

    .form-control {
        height: 1.5rem !important;
        padding: 0 !important;
    }

    .content-header h1 {
        font-size: 1.2rem !important;
        font-weight: 700 !important;
    }
</style>
<div class="container">
    <form action="<?php $_PHP_SELF ?>" method="POST"  enctype="multipart/form-data">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

        <div class="timeline">
            
            <div class="card">
                <div class="card-header">
                    <!-- <h3 class="card-title">Register Blood Bank</h3> -->
                    <div class="btn-group" style="float: right;">
                        <a href="<?php echo $base_url; ?>/donations/bloodcamps" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Blood Camp Name</label>
                                <input type="text" class="form-control" id="price" name="camp_name">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="vender">Camp Type</label>
                                <select name="camp_code" id="vender" class="form-control">
                                    <?php
                                    $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'camp_codes'");
                                    foreach ($query1->result() as $type) {
                                    ?>
                                        <option value="<?= $type->master_type_key_value; ?>"><?= $type->master_type_key_value; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Start Date</label>
                                <input type="date" class="form-control" id="price" name="start_date">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">End Date</label>
                                <input type="date" class="form-control" id="price" name="end_date">

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Venue</label>
                                <input type="text" class="form-control" id="price" name="venue">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Sponsored By</label>
                                <input type="text" class="form-control" id="price" name="sponsored">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="price">Address</label>
                            <input type="text" class="form-control" id="price" name="address">

                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Contact No.</label>
                                <input type="tel" class="form-control" id="price" name="mobile">

                            </div>
                        </div>


                    </div>
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="per">Permission Status</label>
                                <select name="permission" id="per" class="form-control">
                                    <option value="Applied">Applied</option>
                                    <option value="Granted">Granted</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description" style="font-size:13px;">Expected no.of donor in blood camp</label>
                                <input type="text" class="form-control" id="price" name="expected_no">
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Start Time</label>
                                <input type="time" class="form-control" id="price" name="start_time">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">End Time</label>
                                <input type="time" class="form-control" id="price" name="end_time">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Name of Counselor<br>Use (,) for multiple name</label>
                                <input type="text" class="form-control" id="counselor_name" name="counselor_name">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Storage facility of Blood units provided for VBDC </label>
                                <input type="text" class="form-control" id="storage_facility" name="storage_facility">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Tentative Blood Units Collection quantity (Expected) </label>
                                <input type="text" class="form-control" id="tentative_blood_units" name="tentative_blood_units">

                            </div>
                        </div>


                    </div>
                    
                    <div class="row">

                        <div class="col-md-3">
                            <label for="price">Latitude</label>
                            <input type="text" class="form-control" id="price" name="latitude">

                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Longitude</label>
                                <input type="tel" class="form-control" id="price" name="longitude">

                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="price">State</label>
                            <select class="form-control select2" id="select_states" name="state" >
                                <option value="">--Select State--</option>
                                <?php
                                    $query1 = $this->db->query("SELECT * FROM bl_states");
                                    foreach ($query1->result() as $type) { ?>
                                    <option value=" <?= $type->id; ?>"><?= $type->state_name; ?></option>
                                <?php } ?>
                            </select>

                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Select City</label>
                                <select class="form-control" id="select_districts" name="city">
                                    <option value="0">Select City</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price">Vehicle/Ambulance No. </label>
                                <input type="text" class="form-control" id="vehicale_no" name="vehicale_no">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="file">Upload file (Excel/CSV)</label>
                                <input type="file" class="form-control" id="file" name="user_record"  accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">

                            </div>
                        </div>
                    </div>
                    
                        <!-- Approved Technicians Section -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5 class="mb-3">Approved Technicians</h5>
                                <div id="technicians_wrapper">
                                    <div class="form-row technician-row mb-2">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="tech_name[]" placeholder="Technician Name">
                                        </div>
                                        <!--<div class="col-md-5">-->
                                        <!--    <input type="text" class="form-control" name="tech_position[]" placeholder="Position">-->
                                        <!--</div>-->
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-success btn-sm add-tech">+</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- hidden field to store JSON -->
                                <input type="hidden" name="approved_technicians" id="approved_technicians">
                            </div>
                        </div>
                    <!-- Approved Registered Nurses Section -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5 class="mb-3">Approved Registered Nurses</h5>
                            <div id="nurses_wrapper">
                                <div class="form-row nurse-row mb-2">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="nurse_name[]" placeholder="Nurse Name">
                                    </div>
                                    <!--<div class="col-md-5">-->
                                    <!--    <input type="text" class="form-control" name="nurse_position[]" placeholder="Position">-->
                                    <!--</div>-->
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success btn-sm add-nurse">+</button>
                                    </div>
                                </div>
                            </div>
                            <!-- hidden field to store JSON -->
                            <input type="hidden" name="approved_nurses" id="approved_nurses">
                        </div>
                    </div>
                    <!-- MOIC & M.O. of Blood Center (Approved) -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5 class="mb-3">Name of MOIC & M.O. of Blood Center (Approved)</h5>
                            <div id="moic_wrapper">
                                <div class="form-row moic-row mb-2">
                                    <div class="col-md-1">
                                        <input type="text" class="form-control s-no" value="1" readonly>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="moic_name[]" placeholder="Doctor Name">
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="moic_role[]">
                                            <option value="MOIC">MOIC</option>
                                            <option value="M.O.">M.O.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success btn-sm add-moic">+</button>
                                    </div>
                                </div>
                            </div>
                            <!-- hidden field to store JSON -->
                            <input type="hidden" name="approved_moic" id="approved_moic">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5 class="mb-3">List of Technical Staff Participating in VBDC</h5>
                            <div id="staff_wrapper">
                                <div class="form-row staff-row mb-2">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="staff_name[]" placeholder="Staff Name">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="staff_position[]" placeholder="Position">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success btn-sm add-staff">+</button>
                                    </div>
                                </div>
                            </div>
                            <!-- hidden field to store JSON -->
                            <input type="hidden" name="approved_staff" id="approved_staff">
                        </div>
                    </div>



                    <!-- Equipment Checklist -->
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="mb-3">Equipment</h6>
                            <?php
                            
                     foreach ($equipmentss as $key => $item) { ?>
                        <div class="form-group row align-items-center">
                            <label class="col-md-5"><?php echo $item; ?></label>
                            <div class="col-md-2">
                                <input type="checkbox" name="equipment[<?php echo $key; ?>][status]" value="YES">
                                <small>Yes</small>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control form-control-sm" 
                                       name="equipment[<?php echo $key; ?>][qty]" 
                                       placeholder="Qty" min="0">
                            </div>
                        </div>
                        <?php } ?>

                        </div>
                    </div>
                    
                    <!-- Facilities Checklist -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h6 class="mb-3">Facilities</h6>
                            <div class="d-flex flex-wrap">
                                <?php foreach ($facilities as $key => $item) { ?>
                                    <div class="form-check col-md-3 mb-2">
                                        <input type="checkbox" class="form-check-input" name="facilities[<?php echo $key; ?>]" value="YES">
                                        <label class="form-check-label"><?php echo $item; ?></label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Blood Component Permission -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h6 class="mb-3">Blood Component Permission</h6>
                            <div class="d-flex flex-wrap">
                                <?php foreach ($components as $key => $item) { ?>
                                    <div class="form-check col-md-4 mb-2">
                                        <input type="checkbox" class="form-check-input" name="components[<?php echo $key; ?>]" value="YES">
                                        <label class="form-check-label"><?php echo $item; ?></label>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
 
                    <!-- Inter District Notice -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="inter_district_notice" value="Yes">
                                <label class="form-check-label">Inter District Notice Submitted</label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                            <button type="submit" name="submit" class="btn btn-sm btn-danger"><i class="fas fa-save fw"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript">

    var url = '<?php echo $base_url; ?>/donations/my_city';
    $(document).ready(function() {
    // Add new staff row
    $(document).on('click', '.add-staff', function () {
        let row = `
        <div class="form-row staff-row mb-2">
            <div class="col-md-5">
                <input type="text" class="form-control" name="staff_name[]" placeholder="Staff Name">
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="staff_position[]" placeholder="Position">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-staff">-</button>
            </div>
        </div>`;
        $('#staff_wrapper').append(row);
    });

    // Remove staff row
    $(document).on('click', '.remove-staff', function () {
        $(this).closest('.staff-row').remove();
    });

});

    $(document).ready(function () {
    // ====== MOIC ======
    $(document).on('click', '.add-moic', function () {
        let rowCount = $("#moic_wrapper .moic-row").length + 1;
        let row = `
        <div class="form-row moic-row mb-2">
            <div class="col-md-1">
                <input type="text" class="form-control s-no" value="${rowCount}" readonly>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="moic_name[]" placeholder="Doctor Name">
            </div>
            <div class="col-md-4">
                <select class="form-control" name="moic_role[]">
                    <option value="MOIC">MOIC</option>
                    <option value="M.O.">M.O.</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-moic">-</button>
            </div>
        </div>`;
        $('#moic_wrapper').append(row);
        updateMoicSerials();
    });

    $(document).on('click', '.remove-moic', function () {
        $(this).closest('.moic-row').remove();
        updateMoicSerials();
    });

    function updateMoicSerials() {
        $("#moic_wrapper .moic-row").each(function (index) {
            $(this).find(".s-no").val(index + 1);
        });
    }

   
});

    $(document).ready(function () {
    // ====== Technicians ======
    $(document).on('click', '.add-tech', function () {
        let row = `
        <div class="form-row technician-row mb-2">
            <div class="col-md-5">
                <input type="text" class="form-control" name="tech_name[]" placeholder="Technician Name">
            </div>
            
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-tech">-</button>
            </div>
        </div>`;
        $('#technicians_wrapper').append(row);
    });

    $(document).on('click', '.remove-tech', function () {
        $(this).closest('.technician-row').remove();
    });

    // ====== Nurses ======
    $(document).on('click', '.add-nurse', function () {
        let row = `
        <div class="form-row nurse-row mb-2">
            <div class="col-md-5">
                <input type="text" class="form-control" name="nurse_name[]" placeholder="Nurse Name">
            </div>
            
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-nurse">-</button>
            </div>
        </div>`;
        $('#nurses_wrapper').append(row);
    });

    $(document).on('click', '.remove-nurse', function () {
        $(this).closest('.nurse-row').remove();
    });

    // ====== Before submit, collect JSON ======
    $("form").on("submit", function () {
          let staffList = [];
        $("#staff_wrapper .staff-row").each(function () {
            let name = $(this).find("input[name='staff_name[]']").val();
            let position = $(this).find("input[name='staff_position[]']").val();
            if (name && position) {
                staffList.push({ name: name, position: position });
            }
        });
        $("#approved_staff").val(JSON.stringify(staffList));
        let technicians = [];
        $("#technicians_wrapper .technician-row").each(function () {
            let name = $(this).find("input[name='tech_name[]']").val();
            // let position = $(this).find("input[name='tech_position[]']").val();
            if (name) {
                technicians.push({ name: name });
            }
        });
        $("#approved_technicians").val(JSON.stringify(technicians));

        let nurses = [];
        $("#nurses_wrapper .nurse-row").each(function () {
            let name = $(this).find("input[name='nurse_name[]']").val();
            // let position = $(this).find("input[name='nurse_position[]']").val();
            if (name) {
                nurses.push({ name: name });
            }
        });
        $("#approved_nurses").val(JSON.stringify(nurses));
        let moicList = [];
        $("#moic_wrapper .moic-row").each(function () {
            let name = $(this).find("input[name='moic_name[]']").val();
            let role = $(this).find("select[name='moic_role[]']").val();
            if (name && role) {
                moicList.push({ name: name, role: role });
            }
        });
        $("#approved_moic").val(JSON.stringify(moicList));
    });
});

    $(document).ready(function() {
        
        $('#select_states').on('change', function() {
            
            var req_no3 = $('#select_states').val();

            var csrf_token = $('#token_id').val();
            var csrf_name = $('#token_id').attr('name');

            // console.log(token);
            if (req_no3) {
                $.ajax({
                    url: url,
                    // headers: {"X-Test-Header": "test-value"},
                    method: 'POST',
                    data: {
                        req_no3: req_no3,
                        [csrf_name]: csrf_token
                    },
                    success: function(res) {
                        if (res) {

                            $('#select_districts').html('');

                            for (var i = 0; i < res.length; i++) {

                                $('#select_districts').append(`
                             <option value="${res[i].id}">${res[i].district_name}</option>
                         `);
                            }
                        }

                        

                    }
                })
            } else {
                console.log('null');
            }

        });
        $('#select_states').select2({
            placeholder: "Select State",
            allowClear: true
        });
         $('#select_districts').select2({
            placeholder: "Select City",
            allowClear: true
        });
    })

</script>