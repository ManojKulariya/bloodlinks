<?php 
$id = $this->uri->segment(5);
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
if(!empty($_POST['blood_name'])){
     //print_r($_POST); die;
    $blood_name = $_POST['blood_name'];
    $camp_code = $_POST['camp_code'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $venue = $_POST['venue'];
    $sponsored = $_POST['sponsored'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $expected_no = $_POST['expected_no'];
    $permission = $_POST['permission'];    
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $vehicale_no = $_POST['vehicale_no'];
    $counselor_name = $_POST['counselor_name'];
    $storage_facility = $_POST['storage_facility'];
    $tentative_blood_units = $_POST['tentative_blood_units'];
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
    $campfile = $_POST['user_record_old'];
 
    $filename = $_FILES['user_record']['name'];
    
    if ($filename != "") {
       $file_tmp_name = $_FILES['user_record']['tmp_name'];
       $ext = pathinfo($filename, PATHINFO_EXTENSION);
       $uniquename = date('ymdHis') . rand(11111, 99999);
       move_uploaded_file($file_tmp_name, "uploads/camp/$uniquename.$ext");
       $campfile = "uploads/camp/$uniquename.$ext";
    }
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
    $update = $this->db->query("UPDATE bl_bloodcamp SET blood_name = '$blood_name' , camp_code = '$camp_code' , start_date = '$start_date' , end_date = '$end_date' ,
                                venue = '$venue' , sponsored = '$sponsored' , address = '$address' , mobile = '$mobile' , latitude = '$latitude' , 
                                longitude = '$longitude' , state = '$state' , city = '$city' ,expected_no ='$expected_no' ,permission ='$permission' ,
                                start_time = '$start_time' , end_time = '$end_time' ,status = 2,
                                equipment_list = '$equipment_json', facilities_list = '$facilities_json', components_permission = '$components_json',
                                inter_district_notice = '$inter_district_notice', file = '$campfile', vehicale_no = '$vehicale_no',tentative_blood_units = '$tentative_blood_units',
                                storage_facility = '$storage_facility',counselor_name = '$counselor_name',
                                approved_technician ='$approved_technicians',regd_nurse ='$approved_nurses',moic_mo ='$approved_moic',technical_staff ='$approved_staff'
                                WHERE id = '$id'");
// echo $this->db->insert_id();die;
    if($update==true){
    redirect('admin/donations/bloodcamps');

    } else{
        echo "fail";
    }
}
?>
<?php 

$query1 = $this->db->query("SELECT * FROM bl_bloodcamp INNER JOIN bl_states ON bl_bloodcamp.state = bl_states.id WHERE bl_bloodcamp.id = '$id'");
foreach ($query1->result() as $row)
{}
// ✅ Decode JSON fields safely (avoid errors if null)
$equipment_list = !empty($row->equipment_list) ? json_decode($row->equipment_list, true) : [];
$facilities_list = !empty($row->facilities_list) ? json_decode($row->facilities_list, true) : [];
$components_list = !empty($row->components_permission) ? json_decode($row->components_permission, true) : [];
$inter_notice = isset($row->inter_district_notice) ? $row->inter_district_notice : 'No';
$approved_staff = json_decode($row->technical_staff ?? '[]', true);
$approved_moic = json_decode($row->moic_mo ?? '[]', true);
$approved_nurses = json_decode($row->regd_nurse ?? '[]', true);
$approved_technicians = json_decode($row->approved_technician ?? '[]', true);
 ?>


<style>

label{
    font-size:0.8rem;
    font-weight:700;
    margin-bottom:0;
}
.form-control{
    height: 1.5rem !important;
    padding: 0 !important;
    font-weight:400;
}
.content-header h1{
    font-size: 1.2rem;
    margin: 0;
    font-weight: 700;
}

</style>



<div class="container">
    <form action = "<?php $_PHP_SELF ?>" method = "POST" enctype="multipart/form-data">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

        <div class="timeline">
            <!-- <div class="time-label">
                <span class="bg-red">Consumables Items</span>
              </div> -->
              <div class="card">
                <div class="card-header">
                    <!-- <h3 class="card-title">Register Blood Bank</h3> -->
                    <div class="btn-group" style="float: right;">
                        <a href="<?php echo $base_url;?>/all_bloodcamp" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
                    </div>
                </div>
                <div class="card-body">
  
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Blood Camp Name</label>
                                <input type="text" class="form-control" id="price" value="<?php if(isset($row->blood_name)) { echo $row->blood_name;  } ?>" name="blood_name">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="vender" >Camp Code</label>
                                <select name="camp_code" id="vender" class="form-control">
                                        <option value="<?= $row->camp_code; ?>"><?= $row->camp_code; ?></option>
                                                <?php 
            $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'camp_codes'");
           foreach ($query1->result() as $type)
           {
              ?>
          <option value="<?= $type->master_type_key_value; ?>"><?= $type->master_type_key_value; ?></option>
            <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Start Date</label>
                                <input type="date" class="form-control" id="price" name="start_date" value="<?php if(isset($row->start_date)) { echo $row->start_date;  } ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">End Date</label>
                                <input type="date" class="form-control" id="price" name="end_date" value="<?php if(isset($row->end_date)) { echo $row->end_date;  } ?>">

                            </div>
                        </div>


                    </div>


                   

                       

                    <div class="row">

                        
                    </div>
                    <div class="row">

                    <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Venue</label>
                                <input type="text" class="form-control" id="price" name="venue" value="<?php if(isset($row->venue)) { echo $row->venue;  } ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Sponsored By</label>
                                <input type="text" class="form-control" id="price" name="sponsored" value="<?php if(isset($row->sponsored)) { echo $row->sponsored;  } ?>">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="price">Address</label>
                            <input type="text" class="form-control" id="price" name="address" value="<?php if(isset($row->address)) { echo $row->address;  } ?>">

                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Contact No.</label>
                                <input type="text" class="form-control" id="price" name="mobile" value="<?php if(isset($row->mobile)) { echo $row->mobile;  } ?>">

                            </div>
                        </div>

                    </div>




                    <!-- 1fab -->

                    <div class="row">

                       

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="per" >Permission Status</label>
                               <select name="permission" id="per" class="form-control">
                               <option value="<?php $row->permission; ?>"><?php echo $row->permission; ?></option>
                                <option value="Applied">Applied</option>
                                <option value="Granted">Granted</option>
                               </select>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description" style="font-size:13px;">Expected no.of donor in blood camp</label>
                                <input type="text" class="form-control" id="price" name="expected_no" value="<?php if(isset($row->expected_no)) { echo $row->expected_no;  } ?>">
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Start Time</label>
                                <input type="time" class="form-control" id="price" name="start_time" value="<?php if(isset($row->start_time)) { echo $row->start_time;  } ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">End Time</label>
                                <input type="time" class="form-control" id="price" name="end_time" value="<?php if(isset($row->end_time)) { echo $row->end_time;  } ?>">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Name of Counselor<br>Use (,) for multiple name</label>
                                <input type="text" class="form-control" id="counselor_name" name="counselor_name" value="<?php if(isset($row->counselor_name)) { echo $row->counselor_name;  } ?>">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Storage facility of Blood units provided for VBDC </label>
                                <input type="text" class="form-control" id="storage_facility" name="storage_facility" value="<?php if(isset($row->storage_facility)) { echo $row->storage_facility;  } ?>">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Tentative Blood Units Collection quantity (Expected) </label>
                                <input type="text" class="form-control" id="tentative_blood_units" name="tentative_blood_units" value="<?php if(isset($row->tentative_blood_units)) { echo $row->tentative_blood_units;  } ?>">

                            </div>
                        </div>
                    </div>
<!-- end -->

                   <div class="row">

                        <div class="col-md-3">
                            <label for="price">Latitude</label>
                            <input type="text" class="form-control" id="price" name="latitude" value="<?php if(isset($row->latitude)) { echo $row->latitude;  } ?>">

                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Longitude</label>
                                <input type="text" class="form-control" id="price" name="longitude" value="<?php if(isset($row->longitude)) { echo $row->longitude;  } ?>">

                            </div>
                        </div>



                        <div class="col-md-3">
                            <label for="price">Select State</label>
                             <select class="form-control" id="select_states" name="state">
                                 
                                <option value="<?= $row->state; ?>"><?= $row->state_name; ?></option>
                                  <?php 
                                    $query1 = $this->db->query("SELECT * FROM bl_states");
                                   foreach ($query1->result() as $type)
                                   {
                                      ?>
                                  <option value="<?= $type->id; ?>"><?= $type->state_name; ?></option>
                                    <?php } ?>
                                </select>
                        
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Select City</label>
                               <select class="form-control" id="select_districts" name="city" >
                                    <option value="0">Select City</option>
                                    <!-- <option value="<?= $row->city; ?>"><?= $row->district_name; ?></option> -->
                                 </select>
                            </div>
                        </div>
                        


                    </div>
                    <div class="row ">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price">Vehicle/Ambulance No. </label>
                                <input type="text" class="form-control" id="vehicale_no" name="vehicale_no" value="<?php if(isset($row->vehicale_no)) { echo $row->vehicale_no;  } ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="file">Upload file (Excel/CSV)</label>
                                <input type="file" class="form-control" id="file" name="user_record"  accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                <input type="hidden" class="form-control" value="<?php if(isset($row->file)) { echo $row->file;  } ?>" name="user_record_old">
                            </div>
                        </div>
                    </div>
                    <!-- Approved Technicians Section -->
                    <div id="technicians_wrapper">
                          <h5 class="mb-3">Approved Technicians</h5>
                          <!-- Default empty row -->
                            <div class="form-row technician-row mb-2">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="tech_name[]" placeholder="Technician Name">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success btn-sm add-tech">+</button>
                                </div>
                            </div>
                        <?php if (!empty($approved_technicians)) { 
                            foreach ($approved_technicians as $tech) { ?>
                            
                                <div class="form-row technician-row mb-2">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="tech_name[]" value="<?= $tech['name']; ?>" placeholder="Technician Name">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm remove-tech">-</button>
                                    </div>
                                </div>
                        <?php } } ?>
                         <input type="hidden" name="approved_technicians" id="approved_technicians">
                    </div>
                    <div id="nurses_wrapper">
                         <h5 class="mb-3">Approved Registered Nurses</h5>
                         <div class="form-row nurse-row mb-2">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="nurse_name[]" placeholder="Nurse Name">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success btn-sm add-nurse">+</button>
                                </div>
                            </div>
                        <?php if (!empty($approved_nurses)) { 
                            foreach ($approved_nurses as $nurse) { ?>
                                <div class="form-row nurse-row mb-2">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="nurse_name[]" value="<?= $nurse['name']; ?>" placeholder="Nurse Name">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm remove-nurse">-</button>
                                    </div>
                                </div>
                        <?php } } ?>
                        <input type="hidden" name="approved_nurses" id="approved_nurses">
                    </div>

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
                                 <?php if (!empty($approved_moic)) { 
                                    $i=1;
                                    foreach ($approved_moic as $moic) { ?>
                                        <div class="form-row moic-row mb-2">
                                            <div class="col-md-1">
                                                <input type="text" class="form-control s-no" value="<?= $i++; ?>" readonly>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="moic_name[]" value="<?= $moic['name']; ?>" placeholder="Doctor Name">
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" name="moic_role[]">
                                                    <option value="MOIC" <?= $moic['role']=="MOIC" ? "selected" : ""; ?>>MOIC</option>
                                                    <option value="M.O." <?= $moic['role']=="M.O." ? "selected" : ""; ?>>M.O.</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger btn-sm remove-moic">-</button>
                                            </div>
                                        </div>
                                <?php } }  ?>
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
                                <?php if (!empty($approved_staff)) { 
                                    foreach ($approved_staff as $staff) { ?>
                                        <div class="form-row staff-row mb-2">
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="staff_name[]" value="<?= $staff['name']; ?>" placeholder="Staff Name">
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="staff_position[]" value="<?= $staff['position']; ?>" placeholder="Position">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger btn-sm remove-staff">-</button>
                                            </div>
                                        </div>
                                <?php } } ?>
                            </div>
                            <!-- hidden field to store JSON -->
                            <input type="hidden" name="approved_staff" id="approved_staff">
                        </div>
                    </div>

                    <!-- Equipment -->
                    <h6>Equipment</h6>
                     <?php
                       foreach ($equipmentss as $key => $item) { 
                       $checked = isset($equipment_list[$item]['status']) && $equipment_list[$item]['status'] === 'YES' ? 'checked' : '';
                       $qty = isset($equipment_list[$item]['qty']) ? $equipment_list[$item]['qty'] : '';
                       ?>
                        <div class="form-group row align-items-center">
                            <label class="col-md-5"><?php echo $item; ?></label>
                            <div class="col-md-2">
                                <input type="checkbox" name="equipment[<?php echo $key; ?>][status]" value="YES" <?= $checked; ?>
                                <small>Yes</small>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control form-control-sm" value="<?= $qty; ?>" 
                                       name="equipment[<?php echo $key; ?>][qty]" 
                                       placeholder="Qty" min="0">
                            </div>
                        </div>
                    <?php } ?>
            
                    <!-- Facilities -->
                    <h6 class="mt-4">Facilities</h6>
                    <div class="d-flex flex-wrap">
                    
                        <?php foreach ($facilities as $key => $item) {
                         $checked = isset($facilities_list[$item]) && $facilities_list[$item] === 'YES' ? 'checked' : ''; ?>
                            <div class="form-check col-md-3 mb-2">
                                <input type="checkbox" class="form-check-input" name="facilities[<?php echo $key; ?>]" value="YES" <?= $checked; ?>>
                                <label class="form-check-label"><?php echo $item; ?></label>
                            </div>
                        <?php } ?>
                    </div>
            
                    <!-- Components -->
                    <h6 class="mt-4">Blood Component Permission</h6>
                    <div class="d-flex flex-wrap">
                        <?php foreach ($components as $key => $item) { 
                             $checked = isset($components_list[$item]) && $components_list[$item] === 'YES' ? 'checked' : ''; ?>
                            <div class="form-check col-md-4 mb-2">
                                <input type="checkbox" class="form-check-input" name="components[<?php echo $key; ?>]" value="YES" <?= $checked; ?>>
                                <label class="form-check-label"><?php echo $item; ?></label>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Inter District Notice -->
                    <h6 class="mt-3">Inter District Notice</h6>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="inter_district_notice" value="Yes" <?= $inter_notice === 'Yes' ? 'checked' : ''; ?>>
                        <label class="form-check-label">Inter District Notice Submitted</label>
                    </div>

                    
                    <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                            <button type="submit" name="submit" class="btn btn-sm btn-danger" ><i class="fas fa-save fw"></i> Update </button>
                        </div>
                    </div>
                </div>
              </div>
            </form>
          </div>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" ></script>
<script type="text/javascript">
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
   var url ='<?php echo $base_url;?>/donations/my_city';
   $(document).ready(function(){
       $('#select_states').on('change',function(){
         // alert('hiii')
         var req_no3 = $('#select_states').val();
   
         var csrf_token = $('#token_id').val();
         var csrf_name = $('#token_id').attr('name');
   
         // console.log(token);
         if(req_no3){
           $.ajax({
             url:url,
             // headers: {"X-Test-Header": "test-value"},
             method:'POST',
             data:{req_no3:req_no3,[csrf_name]: csrf_token},
             success: function(res){
                   if(res){
                   
                     $('#select_districts').html('');
                     
                       for(var i=0; i<res.length; i++){
                        
                         $('#select_districts').append(`
                             <option value="${res[i].id}">${res[i].district_name}</option>
                         `);
                       }
                   }
             
             
               console.log(res);
               
             }
           })
         }else{
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