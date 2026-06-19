<?php 
if(!empty($_POST['name'])){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $mobile = $_POST['mobile'];
   $user_role = $_POST['role_type'];
   $cust_password = $_POST['password'];
	  // print_r($_POST); die;
          foreach($_POST as $key=>$value){
         if(strpos($key,"permission")){
               $unit[$key] = $value;
         } 
         if(strpos($key,"servies")){
               $test[$key] = $value;
         }       
     }
                                                                                                       
     $service = json_encode($test);
     $service_permission = json_encode($unit);

	      $sql = "SELECT * FROM bl_users WHERE email = '$email' ";
         $user = $this->db->query($sql)->result_array();

                 if(count($user)>0){?>
                    
                        <script type="text/javascript">
                        alert("Email already exists");
                         </script>
                           <?php  }else{
                            $password=password_hash($cust_password, PASSWORD_BCRYPT);
                           $insert = $this->db->query("INSERT INTO bl_users (role_id, email, password, user_status, user_verified) VALUES ('0', '$email','$password', 'active', 'yes')");
                           $last_id = $this->db->insert_id();
                           // return json_headers($last_id);

                           if($insert==true){
                              
                              $insert1 = $this->db->query("INSERT INTO bl_bloodbank_user (bloodbank_id, user_id, name, role, email, mobile, servies, servies_permission) VALUES ('0','$last_id', '$name','$user_role', '$email', '$mobile', '$service', '$service_permission')");
                              //echo $this->db->insert_id();die();
                              // return json_headers($insert1);
                              if($insert1){
                                redirect('admin/user');
                              }else{
                              echo "fail";
                              } 

	                        } else{
		                      echo "fail";
	                        }
                        }
}
?>

<div class="container">
	<form action = "<?php $_PHP_SELF ?>" method = "POST">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

		<div class="timeline">
  			<!-- <div class="time-label">
                <span class="bg-red">Consumables Items</span>
              </div> -->
              <div class="card">
              	<div class="card-header">
              		<!-- <h3 class="card-title">Register Blood Bank</h3> -->
              		<div class="btn-group" style="float: right;">
              			<a href="<?php echo $base_url;?>/admin/user" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
              		</div>
              	</div>
              	<div class="card-body">
              		<div class="row">

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="vender" >User Name</label>
              				<input type="text" class="form-control" id="price" name="name">
              				</div>
              			</div>
<div class="col-md-6">
              				<div class="form-group">
              					<label for="vender" >Role Types</label>
              					<select name="role_type" id="vender" class="form-control">
              									<?php 
            $query1 = $this->db->query("SELECT * FROM bl_bloodbank_master where master_type_key = 'user_role' AND bloodbank_id = '0'");
           foreach ($query1->result() as $type)
           {
              ?>
          <option value="<?= $type->master_type_key_value; ?>"><?= $type->master_type_key_value; ?></option>
            <?php } ?>
              					</select>
              				</div>
              			</div>
              			
              		</div>
       
              		<div class="row">

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="price">Mobile</label>
              					<input type="tel" class="form-control" id="price" name="mobile">

              				</div>
              			</div>

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="description">Email</label>
              					<input type="email" class="form-control" id="price" name="email">
              				</div>
              			</div>

              		</div>
              	
              		
                       <div class="form-group">
                           <div class="row">
                              <div class="col-md-4">
                                 <label>Servies : </label>
                              </div>
                              <div class="col-md-1">
                                <label>Permission</label>
                              </div>
                              <div class="col-md-7" >
                                 <label>Read/Write : </label>
                              </div>
                              
                           </div>
                        </div>
                        <div class="row">
                          
 <div class="col-md-4">
                                 <label for="myCheck">Blood Banks :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="BloodBanks_servies" value="41" id="myCheck18" onclick="myFunction18()">
                              </div>
                              <div class="col-md-7" id="text18" style="display:none">
                                
                                       <input type="radio" name="BloodBanks_permission" value="Write" checked> Write
                                 <input type="radio" name="BloodBanks_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction18() {
  var checkBox = document.getElementById("myCheck18");
  var text = document.getElementById("text18");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
<div class="row">
 <div class="col-md-4">
                                 <label for="myCheck">Hospital :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="Hospital_servies" value="42" id="myCheck19" onclick="myFunction19()">
                              </div>
                              <div class="col-md-7" id="text19" style="display:none">
                                
                                       <input type="radio" name="Hospital_permission" value="Write" checked> Write
                                 <input type="radio" name="Hospital_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction19() {
  var checkBox = document.getElementById("myCheck19");
  var text = document.getElementById("text19");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
<div class="row">
 <div class="col-md-4">
                                 <label for="myCheck">Labs :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="Labs_servies" value="43" id="myCheck20" onclick="myFunction20()">
                              </div>
                              <div class="col-md-7" id="text20" style="display:none">
                                
                                       <input type="radio" name="Labs_permission" value="Write" checked> Write
                                 <input type="radio" name="Labs_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction20() {
  var checkBox = document.getElementById("myCheck20");
  var text = document.getElementById("text20");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>                      <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">Donation Appointments :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="DonationAppointments_servies" value="45" id="myCheck1" onclick="myFunction1()">
                              </div>
                              <div class="col-md-7" id="text1" style="display:none">
                                
                                       <input type="radio" name="DonationAppointments_permission" value="Write" checked> Write
                                 <input type="radio" name="DonationAppointments_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction1() {
  var checkBox = document.getElementById("myCheck1");
  var text = document.getElementById("text1");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
 <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">Donation Form :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="DonationForm_servies" value="46" id="myCheck2" onclick="myFunction2()">
                              </div>
                              <div class="col-md-7" id="text2" style="display:none">
                                
                                       <input type="radio" name="DonationForm_permission" value="Write" checked> Write
                                 <input type="radio" name="DonationForm_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction2() {
  var checkBox = document.getElementById("myCheck2");
  var text = document.getElementById("text2");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
 <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">Deferred Donor :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="Deferreddonor_servies" value="47" id="myCheck3" onclick="myFunction3()">
                              </div>
                              <div class="col-md-7" id="text3" style="display:none">
                                
                                       <input type="radio" name="Deferred_Donor_permission" value="Write" checked> Write
                                 <input type="radio" name="Deferred_Donor_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction3() {
  var checkBox = document.getElementById("myCheck3");
  var text = document.getElementById("text3");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
 <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">TTI Test :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="TTI_Test_servies" value="48" id="myCheck4" onclick="myFunction4()">
                              </div>
                              <div class="col-md-7" id="text4" style="display:none">
                                
                                       <input type="radio" name="TTITest_permission" value="Write" checked> Write
                                 <input type="radio" name="TTITest_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction4() {
  var checkBox = document.getElementById("myCheck4");
  var text = document.getElementById("text4");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
 <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">Components :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="Blood_Fraction_servies" value="49" id="myCheck5" onclick="myFunction5()">
                              </div>
                              <div class="col-md-7" id="text5" style="display:none">
                                
                                       <input type="radio" name="BloodFraction_permission" value="Write" checked> Write
                                 <input type="radio" name="BloodFraction_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction5() {
  var checkBox = document.getElementById("myCheck5");
  var text = document.getElementById("text5");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
 <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">Blood Stock :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="Blood_Stock_servies" value="50" id="myCheck6" onclick="myFunction6()">
                              </div>
                              <div class="col-md-7" id="text6" style="display:none">
                                
                                       <input type="radio" name="BloodStock_permission" value="Write" checked> Write
                                 <input type="radio" name="BloodStock_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction6() {
  var checkBox = document.getElementById("myCheck6");
  var text = document.getElementById("text6");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
 <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">Discard :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="Discard_servies" value="51" id="myCheck7" onclick="myFunction7()">
                              </div>
                              <div class="col-md-7" id="text7" style="display:none">
                                
                                       <input type="radio" name="Discard_permission" value="Write" checked> Write
                                 <input type="radio" name="Discard_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction7() {
  var checkBox = document.getElementById("myCheck7");
  var text = document.getElementById("text7");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
 <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">Request Appointments :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="RequestAppointments_servies" value="53" id="myCheck8" onclick="myFunction8()">
                              </div>
                              <div class="col-md-7" id="text8" style="display:none">
                                
                                       <input type="radio" name="RequestAppointments_permission" value="Write" checked> Write
                                 <input type="radio" name="RequestAppointments_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction8() {
  var checkBox = document.getElementById("myCheck8");
  var text = document.getElementById("text8");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
 <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">Request Form :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="RequestForm_servies" value="54" id="myCheck9" onclick="myFunction9()">
                              </div>
                              <div class="col-md-7" id="text9" style="display:none">
                                
                                       <input type="radio" name="RequestForm_permission" value="Write" checked> Write
                                 <input type="radio" name="RequestForm_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction9() {
  var checkBox = document.getElementById("myCheck9");
  var text = document.getElementById("text9");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
 <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">Cross Match :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="CrossMatch_servies" value="55" id="myCheck10" onclick="myFunction10()">
                              </div>
                              <div class="col-md-7" id="text10" style="display:none">
                                
                                       <input type="radio" name="CrossMatch_permission" value="Write" checked> Write
                                 <input type="radio" name="CrossMatch_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction10() {
  var checkBox = document.getElementById("myCheck10");
  var text = document.getElementById("text10");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
 <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">Issue Blood :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="IssueBlood_servies" value="56" id="myCheck11" onclick="myFunction11()">
                              </div>
                              <div class="col-md-7" id="text11" style="display:none">
                                
                                       <input type="radio" name="IssueBlood_permission" value="Write" checked> Write
                                 <input type="radio" name="IssueBlood_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction11() {
  var checkBox = document.getElementById("myCheck11");
  var text = document.getElementById("text11");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
 <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">Return Blood :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="ReturnBlood_servies" value="57" id="myCheck12" onclick="myFunction12()">
                              </div>
                              <div class="col-md-7" id="text12" style="display:none">
                                
                                       <input type="radio" name="ReturnBlood_permission" value="Write" checked> Write
                                 <input type="radio" name="ReturnBlood_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction12() {
  var checkBox = document.getElementById("myCheck12");
  var text = document.getElementById("text12");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
 <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">Camp Register :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="CampRegister_servies" value="59" id="myCheck13" onclick="myFunction13()">
                              </div>
                              <div class="col-md-7" id="text13" style="display:none">
                                
                                       <input type="radio" name="CampRegister_permission" value="Write" checked> Write
                                 <input type="radio" name="CampRegister_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction13() {
  var checkBox = document.getElementById("myCheck13");
  var text = document.getElementById("text13");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
 <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">Camp Donor :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="CampDonor_servies" value="60" id="myCheck14" onclick="myFunction14()">
                              </div>
                              <div class="col-md-7" id="text14" style="display:none">
                                
                                       <input type="radio" name="CampDonor_permission" value="Write" checked> Write
                                 <input type="radio" name="CampDonor_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction14() {
  var checkBox = document.getElementById("myCheck14");
  var text = document.getElementById("text14");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
 <div class="row">
                              <div class="col-md-4">
                                 <label for="myCheck">Master Records :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="MasterRecord_servies" value="62" id="myCheck15" onclick="myFunction15()">
                              </div>
                              <div class="col-md-7" id="text15" style="display:none">
                                
                                       <input type="radio" name="MasterRecord_permission" value="Write" checked> Write
                                 <input type="radio" name="MasterRecord_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction15() {
  var checkBox = document.getElementById("myCheck15");
  var text = document.getElementById("text15");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
<div class="row">
 <div class="col-md-4">
                                 <label for="myCheck">Donor Records :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="DonorRecords_servies" value="63" id="myCheck16" onclick="myFunction16()">
                              </div>
                              <div class="col-md-7" id="text16" style="display:none">
                                
                                       <input type="radio" name="DonorRecords_permission" value="Write" checked> Write
                                 <input type="radio" name="DonorRecords_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction16() {
  var checkBox = document.getElementById("myCheck16");
  var text = document.getElementById("text16");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
<div class="row">
 <div class="col-md-4">
                                 <label for="myCheck">Blood Records :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="BloodRecords_servies" value="64" id="myCheck17" onclick="myFunction17()">
                              </div>
                              <div class="col-md-7" id="text17" style="display:none">
                                
                                       <input type="radio" name="BloodRecords_permission" value="Write" checked> Write
                                 <input type="radio" name="BloodRecords_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction17() {
  var checkBox = document.getElementById("myCheck17");
  var text = document.getElementById("text17");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
<div class="row">
 <div class="col-md-4">
                                 <label for="myCheck">Cross Match Records :</label>
                              </div>
                              <div class="col-md-1">
                                 <input type="checkbox" name="CrossMatchrecord_servies" value="65" id="myCheck22" onclick="myFunction22()">
                              </div>
                              <div class="col-md-7" id="text22" style="display:none">
                                
                                       <input type="radio" name="CrossMatchrecord_permission" value="Write" checked> Write
                                 <input type="radio" name="CrossMatchrecord_permission" value="Read" > Read
                                 </div>
                              </div>
                          
                         

<script>
function myFunction22() {
  var checkBox = document.getElementById("myCheck22");
  var text = document.getElementById("text22");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>

                       
              			<div class="col-md-12">
              				<label for="price">Password</label>
              				<input type="password" class="form-control" id="price" name="password">

              			</div>       
              		</div>
              	
              		<div class="card-footer">
              			<div class="btn-group" style="float: right;">
              				<button type="submit" name="submit" class="btn btn-sm btn-danger" ><i class="fas fa-save fw"></i> Save</button>
              			</div>
              		</div>
              	</div>
              </div>
            </form>
          </div>