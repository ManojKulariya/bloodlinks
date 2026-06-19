<style>
	.form-control{
        height: 1.5rem;
    padding: 0;
	}
    .row{
        margin-bottom:-9px !important ;
    }
    .card-footer{
        background-color:white !important;
    }
    label{
        font-weight: 700;
    font-size: 0.8rem;
    margin-bottom: 0; 
    }
    .content-header h1{
        font-size: 1.2rem;
    margin: 0;
    font-weight: 700;
    margin-bottom:12px;
    }
</style>
<?php 
$id= $this->uri->segment(3);
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
    $blood_id = $_POST['blood_bank'];
    $blood_name = $_POST['blood_name'];
    $camp_code = $_POST['camp_code'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $venue = $_POST['venue'];
    $sponsored = $_POST['sponsored'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $state = $_POST['state'];
    $city = $_POST['city']; 
    $expected_no = $_POST['expected_no'];
    $permission = $_POST['permission'];    
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
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
    
    $update = $this->db->query("UPDATE bl_bloodcamp SET bloodbank_id = '$blood_id', blood_name = '$blood_name', camp_code = '$camp_code' ,start_date = '$start_date',end_date = '$end_date',venue = '$venue',sponsored = '$sponsored',address = '$address',mobile = '$mobile' ,latitude = '$latitude' ,longitude = '$longitude'  , state = '$state' , city = '$city' ,expected_no ='$expected_no' ,permission ='$permission' , start_time = '$start_time' , end_time = '$end_time',
                                             equipment_list = '$equipment_json', facilities_list = '$facilities_json', components_permission = '$components_json', inter_district_notice = '$inter_district_notice'
                                             WHERE id = '$id'");

    if($update==true){
    // echo 'hiii';
    // die();
        redirect('admin/all_bloodcamp');

    } else{
        echo "fail";
    }
}
?>
<?php 

$query1 = $this->db->query("SELECT * FROM bl_bloodcamp INNER JOIN bl_states ON bl_bloodcamp.state = bl_states.id WHERE bl_bloodcamp.id = '$id'")->result();
foreach ($query1 as $row)
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
<div class="container">
  <div class="card">
       <div class="card-header">
             <h3 class="card-title">Blood Camp Details</h3> 
            <div class="btn-group" style="float: right;">
                <a href="<?php echo $base_url;?>/all_bloodcamp" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
            </div>
        </div>
   
    <div class="card-body">

      <h6 class="mb-3">General Information</h6>
      <table class="table table-bordered table-sm">
        <tr><th>Blood Bank</th><td><?= $row->blood_name ?? '-' ?></td></tr>
        <tr><th>Camp Code</th><td><?= $row->camp_code ?? '-' ?></td></tr>
        <tr><th>Venue</th><td><?= $row->venue ?? '-' ?></td></tr>
        <tr><th>Sponsored By</th><td><?= $row->sponsored ?? '-' ?></td></tr>
        <tr><th>Address</th><td><?= $row->address ?? '-' ?></td></tr>
        <tr><th>Mobile</th><td><?= $row->mobile ?? '-' ?></td></tr>
        <tr><th>Start Date</th><td><?= $row->start_date ?? '-' ?></td></tr>
        <tr><th>End Date</th><td><?= $row->end_date ?? '-' ?></td></tr>
        <tr><th>Start Time</th><td><?= $row->start_time ?? '-' ?></td></tr>
        <tr><th>End Time</th><td><?= $row->end_time ?? '-' ?></td></tr>
        <tr><th>State</th><td><?= $row->state_name ?? '-' ?></td></tr>
        <tr><th>City</th><td><?= $row->district_name ?? '-' ?></td></tr>
        <tr><th>Latitude</th><td><?= $row->latitude ?? '-' ?></td></tr>
        <tr><th>Longitude</th><td><?= $row->longitude ?? '-' ?></td></tr>
        <tr><th>Permission</th><td><?= $row->permission ?? '-' ?></td></tr>
        <tr><th>Expected Donors</th><td><?= $row->expected_no ?? '-' ?></td></tr>
        <tr><th>Vehicle/Ambulance No.</th><td><?= $row->vehicale_no ?? '-' ?></td></tr>
        <tr><th>Name of Counselor</th><td><?= $row->counselor_name ?? '-' ?></td></tr>
        <tr><th>Storage facility of Blood units provided for VBDC</th><td><?= $row->storage_facility ?? '-' ?></td></tr>
        <tr><th>Tentative Blood Units Collection quantity (Expected)</th><td><?= $row->tentative_blood_units ?? '-' ?></td></tr>
        <tr><th>View File</th><td> <?php if(!empty($row->file)) { ?>
      <a href="<?= 'https://test.bloodlinks.in/'.$row->file ?>" target="_blank" class="btn btn-sm btn-primary">
        <i class="fas fa-file-alt"></i> View File
      </a>
    <?php } else { ?>
      <span class="text-muted">No file uploaded</span>
    <?php } ?></td></tr>
      </table>
      <div class="row">
          <div class="col-6">
              <h6 class="mt-4">Technical Staff</h6>
              <?php if(!empty($approved_staff)) { ?>
                <ul>
                  <?php foreach($approved_staff as $s) { ?>
                    <li><?= $s['name'] ?> (<?= $s['position'] ?>)</li>
                  <?php } ?>
                </ul>
              <?php } else { echo "<p class='text-muted'>No staff added</p>"; } ?>
          </div>
          <div class="col-6">
              <h6 class="mt-4">MOIC & M.O.</h6>
              <?php if(!empty($approved_moic)) { ?>
                <ul>
                  <?php foreach($approved_moic as $m) { ?>
                    <li><?= $m['name'] ?> - <b><?= $m['role'] ?></b></li>
                  <?php } ?>
                </ul>
              <?php } else { echo "<p class='text-muted'>No MOIC/M.O. added</p>"; } ?>
          </div>
      </div>
      <div class="row">
          <div class="col-6">
              <h6 class="mt-4">Registered Nurses</h6>
              <?php if(!empty($approved_nurses)) { ?>
                <ul>
                  <?php foreach($approved_nurses as $n) { ?>
                    <li><?= $n['name'] ?></li>
                  <?php } ?>
                </ul>
              <?php } else { echo "<p class='text-muted'>No nurses added</p>"; } ?>
          </div>
          <div class="col-6">
               <h6 class="mt-4">Technicians</h6>
              <?php if(!empty($approved_technicians)) { ?>
                <ul>
                  <?php foreach($approved_technicians as $t) { ?>
                    <li><?= $t['name'] ?></li>
                  <?php } ?>
                </ul>
              <?php } else { echo "<p class='text-muted'>No technicians added</p>"; } ?>
          </div>
      </div>

      

     

      <h6 class="mt-4">Equipment</h6>
      <table class="table table-bordered table-sm">
        <tr><th>Item</th><th>Status</th><th>Qty</th></tr>
        <?php foreach($equipmentss as $eq) { 
          $status = $equipment_list[$eq]['status'] ?? 'NO';
          $qty = $equipment_list[$eq]['qty'] ?? '-';
        ?>
          <tr>
            <td><?= $eq ?></td>
            <td><?= $status ?></td>
            <td><?= $qty ?></td>
          </tr>
        <?php } ?>
      </table>
        <div class="row">
            <div class="col-6">
                <h6 class="mt-4">Facilities</h6>
                  <ul>
                    <?php foreach($facilities as $f) {
                      $status = $facilities_list[$f] ?? 'NO';
                      echo "<li>$f: <b>$status</b></li>";
                    } ?>
                  </ul>
            </div>
            <div class="col-6">
                <h6 class="mt-4">Blood Components Permission</h6>
              <ul>
                <?php foreach($components as $c) {
                  $status = $components_list[$c] ?? 'NO';
                  echo "<li>$c: <b>$status</b></li>";
                } ?>
              </ul>
            </div>
        </div>
      

    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" ></script>
<script type="text/javascript">
   var url ='<?php echo $base_url;?>/donations/my_city';
   $(document).ready(function(){
       $('#select_states').on('blur',function(){
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
             
              
               
             }
           })
         }else{
           console.log('null');
         }
         
       });    
   })
</script>