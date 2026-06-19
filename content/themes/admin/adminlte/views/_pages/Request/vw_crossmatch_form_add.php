<?php
$bank_id = $_SESSION['bank_id'];
$failpath = $base_url.'/request/cross_match_add';
$pw_verify = $base_url.'/donations/verify_pw';

$bloodData = $this->db->query("SELECT * FROM blood_accept_group")->result_array();
function isBloodAvailable($bloodData, $donorType, $patientType)
{
   foreach ($bloodData as $entry) {
      if ($entry['rec'] == $patientType) {
         if (isset($entry[$donorType]) && $entry[$donorType] == 'Y') {
            return 1;
         } else {
            return 0;
         }
      }
   }
}
$master_data = $this->db->query("SELECT * FROM bl_masters  WHERE master_type_name = 'Components Types'");
$master = $master_data->result();
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
<?php
if (!empty($_POST['request'])) {
  
   if ($_POST['balance_vol'] >= $_POST['part']) {
      if ($_POST['blood_group'] != $_POST['group']) {
    //   if ($_POST['component'] == 22  && $_POST['blood_group'] != $_POST['group']) {
         $group_matching =  isBloodAvailable($bloodData, $_POST['group'], $_POST['blood_group']);
       
      } else {
         if ($_POST['blood_group'] == $_POST['group']) {
            $group_matching = 1;
            
         } else {
            $group_matching = 0;
         }
      }
      if ($group_matching == 1) {
         

         if ($_POST['tab'] == "one") {
            $part = $_POST['balance_vol'];
         } else {
            $part = $_POST['part'];
         }
         $request = $_POST['request'];
         $p_name = $_POST['p_name'];
         $registration = $_POST['registration'];
         $f_name = $_POST['f_name'];
         $hospital = $_POST['hospital'];
         $required_time = $_POST['required_time'];
         $crossmatch_date = $_POST['crossmatch_date'];
         $ward = $_POST['ward'];
         $blood_group = $_POST['blood_group'];
         $unit_no = $_POST['unit_no_id'];
         $tube_no = $_POST['tube_no'];
         $component = $_POST['component'];
         $crossmatch_by = $_POST['crossmatch_by'];
         $tag_genrate_by = $_POST['tag_genrate_by'];
         $nat = $_POST['nat'];
         $major_seller = $_POST['major_seller'];
         $major_alumin = $_POST['major_alumin'];
         $major_comb = $_POST['major_comb'];
         $minnor_cross = $_POST['minnor_cross'];
         $final_cross = $_POST['final_cross'];
         $group = $_POST['group'];
         $bleeding_date = $_POST['bleeding_date'];
         $expire_date = $_POST['expire_date'];
         $balance_vol = $_POST['balance_vol'];
         $cross_match = $_POST['cross_match'];
         $n1 = 6;
         if ($component == 22) {
            $final_cross = "";
            $minnor_cross = "";
         } else {
            $major_alumin = "";
            $major_comb = "";
            $major_seller = "";
         }
         function regs($n1)
         {
            $characters = '0123456789';
            $randomString = '';
            for ($i = 0; $i < $n1; $i++) {
               $index = rand(0, strlen($characters) - 1);
               $randomString .= $characters[$index];
            }
            return $randomString;
         }
         $sub = regs($n1);
         $sub_unit = 'SB' . $sub;
         $insert = $this->db->query("INSERT INTO bl_crossmatch (bloodbank_id,request ,p_name , registration, f_name , hospital ,
         required_time ,crossmatch_date , ward , blood_group, tube_no , unit_no , component , part , crossmatch_by, tag_genrate_by,nat,
          major_seller, major_alumin,major_comb ,minnor_cross, final_cross , groups, bleeding_date, expire_date, balance_vol, cross_match, 
          status) VALUES ('$bank_id','$request','$p_name' , '$registration' ,'$f_name' ,'$hospital' ,'$required_time' ,'$crossmatch_date' ,
          '$ward','$blood_group', '$tube_no','$unit_no','$component','$part','$crossmatch_by','$tag_genrate_by','$nat','$major_seller',
          '$major_alumin','$major_comb','$minnor_cross','$final_cross','$group','$bleeding_date','$expire_date','$balance_vol','$cross_match',
          'crossmatch')");
         if ($insert == true) {

            $queryS = $this->db->query("SELECT * FROM bl_blood_record WHERE unit_no = '$unit_no' and bag_config = 'Mother'");
            foreach ($queryS->result() as $data) {
            }

            if ($_POST['tab'] == 'one') {

               $update = $this->db->query("UPDATE bl_blood_record SET cross_match = 'Yes', crossmatch_no = '$cross_match'  
                  WHERE unit_no = '$unit_no' AND  bag_config = 'Mother'");
            }
            if ($_POST['tab'] == 'two') {

               $this->db->query("INSERT INTO bl_blood_record (donor_unit_no,expiry_date,donation_id ,bloodbank_id , unit_no,
                   sub_unit ,crossmatch_no ,tube_no , component , bag_config 
                  ,blood_group , blood_volume , tti_test ,  cross_match , issue_status , issued_vol , final_vol)
                   VALUES ('$data->donor_unit_no','$data->expiry_date','$data->donation_id','$data->bloodbank_id' , '$unit_no' 
                  ,'$sub_unit' , '$cross_match','$tube_no' ,'$component' ,'Satellite' ,'$blood_group' ,'$part','$data->tti_test' , 
                  'Yes', 'No','0','$part')");
               $final = $balance_vol - $part;
               $update = $this->db->query("UPDATE bl_blood_record SET issued_vol = '$part', final_vol = '$final'WHERE unit_no = 
                  '$unit_no' and bag_config = 'Mother'");
            }
            redirect('/admin/request/cross_match');
         } else {
            echo "fail";
         }
      } else { ?>
         <script type="text/javascript">
            alert("Blood Group do Not Match");
         </script>
      <?php  }
   } else { ?>
      <script type="text/javascript">
         alert("Blood Not Available");
      </script>
<?php  }
}
?>
<style type="text/css">
   table th {
      background: yellow;
   }

   table {
      border-style: solid;
   }

   .radio {
      width: 10%;
      margin: -5px 0;
   }

   /* .choose-box {
      width: 10%;
      margin: -5px 0;
   } */
   .choose-box {
      width: 17px;
      height: 17px;
      transform: scale(0.8);
      /* Adjust the scale value to resize */
      margin: 0 5px;
   }

   .hide {
      display: none;
   }



   label:not(.form-check-label):not(.custom-file-label) {
      font-size: 13px;
   }

   .form-control {
      height: 1.4rem;
      font-size: 0.8rem;
      padding: 0px;
   }

   label {
      margin-bottom: 0rem;
   }


   input[type=checkbox],
   input[type=radio] {
      margin: 0;

   }

   .part-span {
      font-size: 13px;
   }

   .form-group {
      margin-bottom: 0.2rem;
   }

   .content-header h1 {
      font-size: 1.5rem;
      margin: 0;
      padding: 0px 0px;
   }

   .content-header {
      padding: 6px 0.5rem;
   }

   .select-font {
      height: 1.5rem;
      font-size: 0.8rem;
   }

   [type=button]:not(:disabled),
   [type=reset]:not(:disabled),
   [type=submit]:not(:disabled),
   button:not(:disabled) {
      cursor: pointer;
      height: 26px;
      font-size: 14px;
      width: 64px;

      padding-top: 2px;
   }

   table {
      font-size: 13px;
   }

   .content-header {
      display: none;
   }
</style>
<div class="crossmatch-new-form bg-white">
   <div class="container-fluid pg-white">
      <div class="row ">
         <div class="col-xl-12 p-4 mb-2 rounded shadow">
            <!-- <div class="container"> -->
            <!-- <h2 class="text-center text-danger" style="font-weight: bold;font-size: 22px;">
               Patient Profile Information
            </h2> -->
            <!-- <div class="jumbotron" style="background-color:aqua;"> -->
            <form action="<?php $_PHP_SELF ?>" method="POST" id="cromatch" autocomplete="off">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
               <input type="hidden" class="form-control" name="unit_no_id" id="unit_no_id" required />
               <input type="hidden" class="form-control" name="bag_config" id="bag_config" required />
               <input type="hidden" class="form-control" name="donation_id" id="donation_id" required />
               <h2 style="font-weight: bold;font-size: 20px;color:#ad1e1d;">Patient Profile</h2>
               <div class="row">
                  <div class="col-sm-3">

                     <label for="colFormLabel">Request No</label>

                     <input type="text" class="form-control" name="request" id="request" required />

                  </div>
                  <div class="col-sm-3">

                     <label for="colFormLabel">Patient Name</label>

                     <input type="text" class="form-control" name="p_name" id="p_name" required />

                  </div>
                  <div class="col-sm-3">

                     <label for="colFormLabel">Father's Name</label>

                     <input type="text" class="form-control" name="f_name" id="f_name" placeholder="" required />

                  </div>
                  <div class="col-sm-3">

                     <label for="colFormLabel">Hospital Name</label>

                     <input type="text" class="form-control" name="hospital" id="hospital" placeholder="" required />

                  </div>
               </div>
               <div class="row">

                  
                  <div class="col-sm-3">

                     <label for="colFormLabel">Registration No</label>

                     <input type="text" class="form-control" name="registration" id="registration" required />

                  </div>
                  <div class="col-sm-3">

                     <label for="colFormLabel"> Time</label>

                     <input type="time" class="form-control" name="required_time" id="time" placeholder="" required />

                  </div>

                  <div class="col-sm-3">

                     <label for="colFormLabel">Cross Match Date</label>

                     <input type="date" class="form-control" name="crossmatch_date" id="required_date" placeholder="" required />

                  </div>
                  <div class="col-sm-3">

                     <label for="colFormLabel">Ward No</label>

                     <input type="text" class="form-control" name="ward" id="ward" placeholder="" />

                  </div>


               </div>
               <div class="row">

                  <div class="col-sm-3">

                     <label for="colFormLabel">Request Blood Group</label>

                     <input type="text" class="form-control" name="blood_group" id="blood_group" placeholder="" required />
                  </div>


                  <div class="col-sm-3 ">

                     <label for="colFormLabel">Status</label>


                     <select class="form-control select-font" name="statuss" id="statusreq" required>

                        <option disabled="disabled" selected="selected" value="">Select</option>
                        <?php
                        $query2 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'request_date_status'");
                        foreach ($query2->result() as $request_date_status) {
                        ?>
                           <option value="<?= $request_date_status->master_type_key_value; ?>"><?= $request_date_status->master_type_key_value; ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="col-sm-3 ">
                     <label for="colFormLabel">Required Component</label>
                    <ul  id="req_com">

                     </ul>
                  </div>
                  <div class="col-sm-3 ">
                    <label for="colFormLabel">Disease</label>
                    <ul  id="req_disease">

                    </ul>
                  </div>

               </div>
               <h2 style="font-weight: bold;font-size: 20px;padding-top:18px;color:#ad1e1d">Blood Unit Details</h2>
               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="description">Unit No</label>
                        <input type="text" class="form-control" name="unit_no" id="unit_no" required>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="description">Tube No</label>
                        <input type="text" class="form-control" name="tube_no" id="tube_no" required>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="description">Component</label>
                        <select class="form-control  select-font" name="component" id="componentselect" required>

                        </select>

                     </div>
                  </div>


                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="description">Fresh Blood</label>
                        <select class="form-control  select-font" name="fresh_blood" id="inputEmail3" required>
                           <!-- <option value="" disabled selected>Select</option> -->
                           <option value="Yes" selected>Yes</option>
                           <option value="No">No</option>

                        </select>
                     </div>
                  </div>



               </div>
               <!-- row second -->
               <div class="row">

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="description">Cross Match by</label>
                        <input type="text" class="form-control" name="crossmatch_by" value="<?= $type->name ?>" id="inputEmail3" required>
                     </div>
                  </div>

                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Tag Genrate by</label>
                        <input type="text" class="form-control" name="tag_genrate_by" value="<?= $type->name ?>" id="inputEmail3" required>
                     </div>
                  </div>


                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Coombs Meth</label>

                        <select class="form-control  select-font" name="coomb_meth" id="address">
                           <option value="" disabled selected>Select</option>
                           <option value="CAT">CAT</option>
                           <option value="GEL">GEL</option>
                           <option value="SOLID PHASE">SOLID PHASE</option>

                        </select>
                     </div>
                  </div>


                  <div class="col-md-3">
                     <div class="form-group">
                        <label for="description">Nat</label>
                        <input type="text" name="nat" class="form-control" id="inputEmail3">
                     </div>
                  </div>
               </div>
               <!-- row3 -->

               <div class="row pl-2">

                  <div class="col-md-3 form-group part">
                     <div>
                        <span class="col-sm-4 col-form-label"><b>Part</b></span>
                        <input type="radio" name="tab" value="one" onclick="show1();" checked />
                        <span class="part-span">One</span>
                        <input type="radio" name="tab" value="two" onclick="show2();" />
                        <span class="part-span">Two</span>
                     </div>

                     <div style="text-align: center;">
                        <div class="hide" id="div1">
                           <input type="text" class="form-control" name="part" placeholder="">
                        </div>
                     </div>

                  </div>

                  <div class="col-md-3 prbc" style="font-size :12px;">
                     <div class="form-group">

                        <label for="description">Major Saline Cross Match</label>
                        <div class="row pl-2" style="font-size :11px;">
                           Compatible<input type="checkbox" name="major_seller" value="Compatible" class="form-control choose-box mr-2 ml-2" id="inputEmail3">
                           InCompatible<input type="checkbox" name="major_seller" value="InCompatible" class="form-control choose-box ml-2" id="inputEmail3" checked>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 prbc" style="font-size :12px;">
                     <div class="form-group">
                        <label for="description">Major Albumin 37</label>
                        <div class="row pl-2">
                           Compatible<input type="checkbox" name="major_alumin" value="Compatible" class="form-control choose-box mr-2 ml-2" id="inputEmail3">
                           InCompatible<input type="checkbox" name="major_alumin" value="InCompatible" class="form-control choose-box ml-2" id="inputEmail3" checked>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 prbc" style="font-size :12px;">
                     <div class="form-group">
                        <label for="description">Major Coombs</label>
                        <div class="row pl-2">
                           Compatible<input type="checkbox" name="major_comb" value="Compatible" class="form-control choose-box mr-2 ml-2" id="inputEmail3">
                           InCompatible<input type="checkbox" name="major_comb" value="InCompatible" class="form-control choose-box ml-2" id="inputEmail3" checked>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 other" style="font-size :12px;">
                     <div class="form-group">
                        <label for="description">Final Cross Match</label>
                        <div class="row pl-2">
                           Compatible<input type="checkbox" name="minnor_cross" value="Compatible" class="form-control choose-box mr-2 ml-2" id="inputEmail3">
                           InCompatible<input type="checkbox" name="minnor_cross" value="InCompatible" class="form-control choose-box ml-2" id="inputEmail3" checked>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 other" style="font-size :12px;">
                     <div class="form-group">
                        <label for="description">Final Cross Match</label>
                        <div class="row pl-2">
                           Compatible<input type="checkbox" name="final_cross" value="Compatible" class="form-control radio mr-2 ml-2 choose-box" id="inputEmail3">
                           InCompatible<input type="checkbox" name="final_cross" value="InCompatible" class="form-control radio ml-2 choose-box" id="inputEmail3" checked>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="description">Unit No</label>
                        <input type="text" name="unit_no" class="form-control" id="unit" required>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="description">Tube No</label>
                        <input type="text" name="tube_no" class="form-control" id="tube" required>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="description">Blood Group</label>
                        <input type="text" name="group" class="form-control" id="group" required>
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="description">Bleeding Date</label>
                        <input type="date" name="bleeding_date" class="form-control" id="bl_date" required>
                     </div>
                  </div>

               </div>

               <!-- row4 -->
               <div class="row">

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="description">Expire Date</label>
                        <input type="date" name="expire_date" class="form-control" id="expiry_date" required>
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="description">Volume</label>
                        <input type="text" name="unit_no" class="form-control" id="unit" required>
                     </div>
                  </div>

                  <div class="col-sm-3">
                     <div class="form-group">
                        <label for="description">Balance Vol.</label>
                        <input type="text" name="balance_vol" class="form-control" id="final_vol" required>
                     </div>
                  </div>


                  <div class="col-sm-3">
                     <?php
                     $n = 3;
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

                     $cross = date('ymHs') . reg($n);
                     $cross_match = 'CR' . $cross;
                     ?>
                     <div class="form-group">
                        <label for="description">Cross Match No.</label>
                        <input type="text" name="cross_match" class="form-control" value="<?= $cross_match ?>" readonly>
                     </div>

                  </div>


               </div>




               <div class="row button bg-light" style="float: right;margin: 15px 0;">
                  <div class="col-sm-6">
                     <button type="reset" class="btn btn-danger float-right btn_res">Reset</button>
                  </div>
                  <div class="col-sm-6">
                     <button type="submit" id="submitBtn" class="btn btn-danger float-right btn_sub">Submit</button>

                  </div>
               </div>



            </form>
            <br>
            <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
            <h2 style="text-align:center;"></h2>
            <table id="customersTable" class="display" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <!-- <th id="th" scope="col">#</th> -->
                     <th id="th" scope="col">Unit No</th>
                     <th id="th" scope="col">component</th>
                     <th id="th" scope="col">Tube no</th>
                     <th id="th" scope="col">Group</th>
                     <th id="th" scope="col">Bleeding Date</th>
                     <th id="th" scope="col">Expirty Date</th>
                     <th id="th" scope="col">Cross matchNo</th>
                     <th id="th" scope="col">Cross matchBy</th>
                     <th id="th" scope="col">Core</th>
                     <th id="th" scope="col">Nat</th>
                  </tr>
               </thead>
               <tbody id="mytable">
               </tbody>
            </table>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
            <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js" charset="utf8" type="text/javascript"></script>

         </div>
      </div>
   </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
        $(document).ready(function() {
            $('#cromatch').on('submit', function(event) {
                var selectedComponent = $('#componentselect').val();
                var blood_group = $('#blood_group').val();
                var group = $('#group').val();

                if (selectedComponent == 22 && group != blood_group) {
                event.preventDefault(); // Prevent the default form submission

                var userPassword = prompt("Please enter the access password:");
                if (userPassword !== null) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $pw_verify;?>",
                        data: { password: userPassword },
                        success: function(response) {
                            var result = response;
                            if (result.success) {
                                alert("Access Done.");
                                $('#cromatch')[0].submit(); // Submit the form if the password is correct
                            } else {
                                alert("Access Denied: Incorrect Password");
                                window.location.href = "<?php echo $failpath;?>"; // Redirect if access is denied
                            }
                        },
                        error: function() {
                            alert("Error verifying password");
                            window.location.href = "<?php echo $failpath;?>"; // Redirect on error
                        }
                    });
                } else {
                    alert("Access Denied: No Password Entered");
                    window.location.href = "<?php echo $failpath;?>"; // Redirect if no password entered
                }
            }else{
                    
                }
            });
        });
    </script>
<script type="text/javascript">
   function show1() {
      document.getElementById('div1').style.display = 'none';
   }

   function show2() {
      document.getElementById('div1').style.display = 'block';
   }
   function check_grouping(unit_no){
            var csrf_token = $('#token_id').val();
         var csrf_name = $('#token_id').attr('name');
         console.log(unit_no);
        $.ajax({
            type: "POST",
            url: check_grouping_url,
            data: {
              unit_no: unit_no,
              [csrf_name]: csrf_token
           },
            success: function(response) {
                // console.log(response);
                if(response == 0){
                    alert('Blood Grouping Not Done. Crossmatch can not be Done!')
                    $('#submitBtn').prop('disabled', true);
                }else{
                    $('#submitBtn').prop('disabled', false);
                }
                
            },
            error: function() {
                alert("Error verifying!");
            }
        });
   }
</script>
<script type="text/javascript">
   $('.prbc').hide();
   $('.other').hide();
   var url2 = '<?php echo $base_url; ?>/donations/my_crossmatch';
   $(document).ready(function() {
      $('#componentselect').on('change', function() {
         var val1 = $('#componentselect').val();
         if (val1 == 22) {
            $('.prbc').show();
            $('.other').hide();
         } else {
            $('.other').show();
            $('.prbc').hide();
         }
         var bag_config = $('#bag_config').val();
         var donation_id = $('#donation_id').val();
         var url3 = '<?php echo $base_url; ?>/donations/my_unit_no_data';
         var csrf_token = $('#token_id').val();
         $.ajax({
            url: url3,
            method: 'POST',
            data: {
               bag_config: bag_config,
               val1: val1,
               donation_id: donation_id,
               [csrf_name]: csrf_token
            },
            success: function(res) {
               if (res[0].cross_match == "Yes") {
                  alert('blood Not Available! ');
                  $('#submitBtn').prop('disabled', true);
               }
               if (res[0].cross_match == "No") {
                  $('#submitBtn').prop('disabled', false);
               }

               $('#final_vol').val(res[0].final_vol);
               $('#blood_volume').val(res[0].blood_volume);
               $('#unit_no_id').val(res[0].unit_no);
               $('#expiry_date').val(res[0].expiry_date);
                //   ----------------------------
               check_grouping(res[0].unit_no);

            }
         })
      });
   })
</script>
<script type="text/javascript">
   $(document).ready(function() {
      $('#request').on('blur', function() {
         var req_no2 = $('#request').val();
         var csrf_token = $('#token_id').val();
         var csrf_name = $('#token_id').attr('name');
         if (req_no2) {
            $.ajax({
               url: url2,
               // headers: {"X-Test-Header": "test-value"},
               method: 'POST',
               data: {
                  req_no2: req_no2,
                  [csrf_name]: csrf_token
               },
               success: function(responseData) {
                  $('#mytable').html('');
                  var res = JSON.parse(responseData);
                  $.each(res, function(key, data) {
                     $('#mytable').append(`
                             <tr>                            
                             <td>${data.unit_no}</td>
                             <td>${data.component}</td>
                             <td>${data.tube_no}</td>
                             <td>${data.groups}</td>
                             <td>${data.bleeding_date}</td>
                             <td>${data.expire_date}</td>
                             <td>${data.cross_match}</td>
                             <td>${data.crossmatch_by}</td>
                             <td>${data.coomb_meth}</td>
                             <td>${data.nat}</td>
                             </tr>
                         `);
                  });

               }
            })
         } else {}

      });
   })
</script>
<script type="text/javascript">
   var url = '<?php echo $base_url; ?>/donations/my_records';
   $(document).ready(function() {
      $('#request').on('blur', function() {
         var req_no = $('#request').val();
         var csrf_token = $('#token_id').val();
         var csrf_name = $('#token_id').attr('name');

         if (req_no) {
            $.ajax({
               url: url,
               method: 'POST',
               data: {
                  req_no: req_no,
                  [csrf_name]: csrf_token
               },
               success: function(res) {
                  let list = $('#req_com');
                    list.empty();
                    // Loop through the data and add options to the select
                    $.each(res.components_unit, function(key, value) {
                        list.append($('<li>').text(`${key}`));
                       
                    });
                    let lists = $('#req_disease');
                    lists.empty();
                    lists.append($('<li>').text(`${res.diagnosis}`));
                       
                  $('#p_name').val(res.p_name);
                  $('#time').val(res.timess);
                  $('#request').val(res.request);
                  $('#registration').val(res.registration);
                  $('#f_name').val(res.f_name);
                  $('#hospital').val(res.hospital);
                  $('#statusreq').val(res.status);
                  $('#ward').val(res.ward);
                  $('#blood_group').val(res.blood_group);
                  $('#required_time').val(res.required_time);
                  $('#required_date').val(res.required_date);
                  $('#address').val(res.address);


               }
            })
         } else {}

      });
   })
</script>
<script type="text/javascript">
   var url1 = '<?php echo $base_url; ?>/donations/my_unit_no';
   var check_grouping_url = '<?php echo $base_url; ?>/donations/check_grouping';
   $(document).ready(function() {
      $('#unit_no').on('blur', function() {
         var req_no1 = $('#unit_no').val();
         var csrf_token = $('#token_id').val();
         var csrf_name = $('#token_id').attr('name');
         if (req_no1) {
            $.ajax({
               url: url1,
               method: 'POST',
               data: {
                  req_no1: req_no1,
                  [csrf_name]: csrf_token
               },
               success: function(responseData) {
                  var res = JSON.parse(responseData);
                  var masterdataid = <?php echo json_encode($master); ?>;
                  var obj = [];
                  if(res.length == 0){
                      alert('For '+req_no1+' No Data found!');
                      $('#unit_no').val('');
                      $('#componentselect').html('')
                      $('#group').val('');
                      $('#bl_date').val('');
                      $('#final_vol').val('');
                      $('#blood_volume').val('');
                      $('#tube_no').val('');
                      $('#tube').val('');
                      $('#unit').val('');
                      $('#unit_no_id').val('');
                      $('#bag_config').val('');
                      $('#donation_id').val('');
                      $('#expiry_date').val('');
                      return;
                  }
                  $.each(res, function(key, data) {

                     if (data.component == 'wholeblood') {

                        obj.push({
                           'component': data.component,
                           'component_name': data.component
                        });

                     }
                     if (data.component != 'wholeblood') {
                        $.each(masterdataid, function(index, value) {
                           if (data.component == value.master_id) {

                              obj.push({
                                 'component': data.component,
                                 'component_name': value.master_type_key_short_value
                              });

                           }
                        });

                     }
                  });
                  let html = '';
                  $.each(obj, function(index, value) {
                     if (index == 0) {
                        if (value.component == 22) {
                           $('.prbc').show();
                           $('.other').hide();

                        } else {
                           $('.other').show();
                           $('.prbc').hide();
                        }
                     }
                     html += `<option value="${value.component}" >${value.component_name}</option>`
                  })
                  if (res[0].cross_match == "Yes") {
                     alert('blood Not Available! ');
                     $('#submitBtn').prop('disabled', true);
                  }
                  if (res[0].cross_match == "No") {
                     $('#submitBtn').prop('disabled', false);
                  }
                  $('#componentselect').html(html)
                  $('#group').val(res[0].blood_group);
                  $('#bl_date').val(res[0].collection_date);
                  $('#final_vol').val(res[0].final_vol);
                  $('#blood_volume').val(res[0].blood_volume);
                  $('#tube_no').val(res[0].tube_no);
                  $('#tube').val(res[0].tube_no);
                  $('#unit').val(res[0].donor_unit_no);
                  $('#unit_no_id').val(res[0].unit_no);
                  $('#bag_config').val(res[0].bag_config);
                  $('#donation_id').val(res[0].donation_id);
                  $('#expiry_date').val(res[0].expiry_date);
                    check_grouping(res[0].unit_no);

               }
            })
         }

      });
   })
</script>

<script>
   $('input[type="checkbox"]').on('change', function() {
      $(this).siblings('input[type="checkbox"]').prop('checked', false);
   });
</script>