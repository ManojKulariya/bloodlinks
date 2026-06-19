<?php
$bank_id = $_SESSION['bank_id'];
if (!empty($_POST['name'])) {
   $sign = "";

   $name = $_POST['name'];
   $email = $_POST['email'];
   $mobile = $_POST['mobile'];
   $user_role = $_POST['role_type'];
   $cust_password = $_POST['password'];
   // print_r($_POST); die;
   foreach ($_POST as $key => $value) {
      if (strpos($key, "permission")) {
         $unit[$key] = $value;
      }
      if (strpos($key, "servies")) {
         $test[$key] = $value;
      }
   }

   $service = json_encode($test);
   $service_permission = json_encode($unit);

   $sql = "SELECT * FROM bl_users WHERE email = '$email' ";
   $user = $this->db->query($sql)->result_array();

   if (count($user) > 0) { ?>

      <script type="text/javascript">
         alert("Email already exists");
      </script>
<?php  } else {
      $filename = $_FILES['sign']['name'];
      if ($filename != "") {
         $file_tmp_name = $_FILES['sign']['tmp_name'];
         $ext = pathinfo($filename, PATHINFO_EXTENSION);
         $uniquename = date('ymdHis') . rand(11111, 99999);
         move_uploaded_file($file_tmp_name, "uploads/sign/$uniquename.$ext");
         $file = "uploads/sign/$uniquename.$ext";
         $sign = $file;
      }
      $password = password_hash($cust_password, PASSWORD_BCRYPT);
      $insert = $this->db->query("INSERT INTO bl_users (sign,role_id, email, password, user_status, user_verified) 
      VALUES ('$sign','0', '$email','$password', 'active', 'yes')");
      $last_id = $this->db->insert_id();
      if ($insert == true) {
         $insert1 = $this->db->query("INSERT INTO bl_bloodbank_user (bloodbank_id, user_id, name, role, email, mobile, servies, servies_permission) VALUES ('$bank_id','$last_id', '$name','$user_role', '$email', '$mobile', '$service', '$service_permission')");
         if ($insert1) {
            redirect('admin/donations/bloodbank_user');
         } else {
            echo "fail";
         }
      } else {
         echo "fail";
      }
   }
}
?>


<style>
   label {
      font-size: 0.8rem;
      font-weight: 700;
      margin-bottom: 0;
   }

   .form-control {
      height: 1.5rem;
      padding: 0;
   }

   .content-header h1 {
      font-weight: 700;
      font-size: 1.2rem;
      margin: 0;
   }
</style>

<div class="container">
   <form action="<?php $_PHP_SELF ?>" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

      <div class="timeline">

         <div class="card">
            <div class="card-header">
               <!-- <h3 class="card-title">Register Blood Bank</h3> -->
               <div class="btn-group" style="float: right;">
                  <a href="<?php echo $base_url; ?>/donations/bloodbank_user" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
               </div>
            </div>
            <div class="card-body">
               <div class="row">

                  <div class="col-6">
                     <div class="form-group">
                        <label for="vender">User Name</label>
                        <input type="text" class="form-control" id="price" name="name">
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label for="vender">Role Types</label>
                        <select name="role_type" id="vender" class="form-control">
                           <?php
                           $query1 = $this->db->query("SELECT * FROM bl_bloodbank_master where master_type_key = 'user_role' AND bloodbank_id = '$bank_id'");
                           foreach ($query1->result() as $type) {
                           ?>
                              <option value="<?= $type->master_type_key_value; ?>"><?= $type->master_type_key_value; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        <label for="price">Mobile</label>
                        <input type="tel" class="form-control" id="price" name="mobile">

                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label for="price">Sign</label>
                        <input type="file" class="form-control" name="sign">

                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-3">
                        <label>Servies : </label>
                     </div>
                     <div class="col-md-3">
                        <label>Permission</label>
                     </div>
                     <div class="col-md-6">
                        <label>Read/Write : </label>
                     </div>


                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Donation :</label>
                  </div>
                  <div class="col-md-1">
                     <input type="checkbox" name="Donation_servies" value="3" id="myCheck1" onclick="myFunction1()">
                  </div>
                  <div class="col-md-7" id="text1" style="display:none">
                     <input type="radio" name="Donation_permission" value="Write" checked> Write
                     <input type="radio" name="Donation_permission" value="Read"> Read
                     <input type="checkbox" name="Donation_permission" value="Delete"> Delete
                  </div>
               </div>
               <script>
                  function myFunction1() {
                     var checkBox = document.getElementById("myCheck1");
                     var text = document.getElementById("text1");
                     if (checkBox.checked == true) {
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
                     <input type="checkbox" name="DeferredDonor_servies" value="4" id="myCheck2" onclick="myFunction2()">
                  </div>
                  <div class="col-md-7" id="text2" style="display:none">

                     <input type="radio" name="DeferredDonor_permission" value="Write" checked> Write
                     <input type="radio" name="DeferredDonor_permission" value="Read"> Read
                     <input type="checkbox" name="DeferredDonor_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction2() {
                     var checkBox = document.getElementById("myCheck2");
                     var text = document.getElementById("text2");
                     if (checkBox.checked == true) {
                        text.style.display = "block";
                     } else {
                        text.style.display = "none";
                     }
                  }
               </script>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Donor Register :</label>
                  </div>
                  <div class="col-md-1">
                     <input type="checkbox" name="DonorRegister_servies" value="5" id="myCheck3" onclick="myFunction3()">
                  </div>
                  <div class="col-md-7" id="text3" style="display:none">

                     <input type="radio" name="DonorRegister_permission" value="Write" checked> Write
                     <input type="radio" name="DonorRegister_permission" value="Read"> Read
                     <input type="checkbox" name="DonorRegister_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction3() {
                     var checkBox = document.getElementById("myCheck3");
                     var text = document.getElementById("text3");
                     if (checkBox.checked == true) {
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
                     <input type="checkbox" name="TTITest_servies" value="6" id="myCheck4" onclick="myFunction4()">
                  </div>
                  <div class="col-md-7" id="text4" style="display:none">

                     <input type="radio" name="TTITest_permission" value="Write" checked> Write
                     <input type="radio" name="TTITest_permission" value="Read"> Read
                     <input type="checkbox" name="TTITest_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction4() {
                     var checkBox = document.getElementById("myCheck4");
                     var text = document.getElementById("text4");
                     if (checkBox.checked == true) {
                        text.style.display = "block";
                     } else {
                        text.style.display = "none";
                     }
                  }
               </script>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Blood Fraction :</label>
                  </div>
                  <div class="col-md-1">
                     <input type="checkbox" name="BloodFraction_servies" value="7" id="myCheck5" onclick="myFunction5()">
                  </div>
                  <div class="col-md-7" id="text5" style="display:none">

                     <input type="radio" name="BloodFraction_permission" value="Write" checked> Write
                     <input type="radio" name="BloodFraction_permission" value="Read"> Read
                     <input type="checkbox" name="BloodFraction_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction5() {
                     var checkBox = document.getElementById("myCheck5");
                     var text = document.getElementById("text5");
                     if (checkBox.checked == true) {
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
                     <input type="checkbox" name="BloodStock_servies" value="9" id="myCheck6" onclick="myFunction6()">
                  </div>
                  <div class="col-md-7" id="text6" style="display:none">

                     <input type="radio" name="BloodStock_permission" value="Write" checked> Write
                     <input type="radio" name="BloodStock_permission" value="Read"> Read
                     <input type="checkbox" name="BloodStock_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction6() {
                     var checkBox = document.getElementById("myCheck6");
                     var text = document.getElementById("text6");
                     if (checkBox.checked == true) {
                        text.style.display = "block";
                     } else {
                        text.style.display = "none";
                     }
                  }
               </script>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Consumables:</label>
                  </div>
                  <div class="col-md-1">
                     <input type="checkbox" name="Consumables_servies" value="10" id="myCheck7" onclick="myFunction7()">
                  </div>
                  <div class="col-md-7" id="text7" style="display:none">

                     <input type="radio" name="Consumables_permission" value="Write" checked> Write
                     <input type="radio" name="Consumables_permission" value="Read"> Read
                     <input type="checkbox" name="Consumables_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction7() {
                     var checkBox = document.getElementById("myCheck7");
                     var text = document.getElementById("text7");
                     if (checkBox.checked == true) {
                        text.style.display = "block";
                     } else {
                        text.style.display = "none";
                     }
                  }
               </script>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Return :</label>
                  </div>
                  <div class="col-md-1">
                     <input type="checkbox" name="Return_servies" value="11" id="myCheck8" onclick="myFunction8()">
                  </div>
                  <div class="col-md-7" id="text8" style="display:none">

                     <input type="radio" name="Return_permission" value="Write" checked> Write
                     <input type="radio" name="Return_permission" value="Read"> Read
                     <input type="checkbox" name="Return_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction8() {
                     var checkBox = document.getElementById("myCheck8");
                     var text = document.getElementById("text8");
                     if (checkBox.checked == true) {
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
                     <input type="checkbox" name="Discard_servies" value="12" id="myCheck9" onclick="myFunction9()">
                  </div>
                  <div class="col-md-7" id="text9" style="display:none">

                     <input type="radio" name="Discard_permission" value="Write" checked> Write
                     <input type="radio" name="Discard_permission" value="Read"> Read
                     <input type="checkbox" name="Discard_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction9() {
                     var checkBox = document.getElementById("myCheck9");
                     var text = document.getElementById("text9");
                     if (checkBox.checked == true) {
                        text.style.display = "block";
                     } else {
                        text.style.display = "none";
                     }
                  }
               </script>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Request :</label>
                  </div>
                  <div class="col-md-1">
                     <input type="checkbox" name="Request_servies" value="14" id="myCheck10" onclick="myFunction10()">
                  </div>
                  <div class="col-md-7" id="text10" style="display:none">

                     <input type="radio" name="Request_permission" value="Write" checked> Write
                     <input type="radio" name="Request_permission" value="Read"> Read
                     <input type="checkbox" name="Request_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction10() {
                     var checkBox = document.getElementById("myCheck10");
                     var text = document.getElementById("text10");
                     if (checkBox.checked == true) {
                        text.style.display = "block";
                     } else {
                        text.style.display = "none";
                     }
                  }
               </script>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Deferred Request :</label>
                  </div>
                  <div class="col-md-1">
                     <input type="checkbox" name="DeferredRequest_servies" value="15" id="myCheck11" onclick="myFunction11()">
                  </div>
                  <div class="col-md-7" id="text11" style="display:none">

                     <input type="radio" name="DeferredRequest_permission" value="Write" checked> Write
                     <input type="radio" name="DeferredRequest_permission" value="Read"> Read
                     <input type="checkbox" name="DeferredRequest_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction11() {
                     var checkBox = document.getElementById("myCheck11");
                     var text = document.getElementById("text11");
                     if (checkBox.checked == true) {
                        text.style.display = "block";
                     } else {
                        text.style.display = "none";
                     }
                  }
               </script>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Request Register :</label>
                  </div>
                  <div class="col-md-1">
                     <input type="checkbox" name="RequestRegister_servies" value="16" id="myCheck12" onclick="myFunction12()">
                  </div>
                  <div class="col-md-7" id="text12" style="display:none">

                     <input type="radio" name="RequestRegister_permission" value="Write" checked> Write
                     <input type="radio" name="RequestRegister_permission" value="Read"> Read
                     <input type="checkbox" name="RequestRegister_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction12() {
                     var checkBox = document.getElementById("myCheck12");
                     var text = document.getElementById("text12");
                     if (checkBox.checked == true) {
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
                     <input type="checkbox" name="CrossMatch_servies" value="17" id="myCheck13" onclick="myFunction13()">
                  </div>
                  <div class="col-md-7" id="text13" style="display:none">

                     <input type="radio" name="CrossMatch_permission" value="Write" checked> Write
                     <input type="radio" name="CrossMatch_permission" value="Read"> Read
                     <input type="checkbox" name="CrossMatch_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction13() {
                     var checkBox = document.getElementById("myCheck13");
                     var text = document.getElementById("text13");
                     if (checkBox.checked == true) {
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
                     <input type="checkbox" name="IssueBlood_servies" value="18" id="myCheck14" onclick="myFunction14()">
                  </div>
                  <div class="col-md-7" id="text14" style="display:none">

                     <input type="radio" name="IssueBlood_permission" value="Write" checked> Write
                     <input type="radio" name="IssueBlood_permission" value="Read"> Read
                     <input type="checkbox" name="IssueBlood_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction14() {
                     var checkBox = document.getElementById("myCheck14");
                     var text = document.getElementById("text14");
                     if (checkBox.checked == true) {
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
                     <input type="checkbox" name="CampRegister_servies" value="20" id="myCheck15" onclick="myFunction15()">
                  </div>
                  <div class="col-md-7" id="text15" style="display:none">

                     <input type="radio" name="CampRegister_permission" value="Write" checked> Write
                     <input type="radio" name="CampRegister_permission" value="Read"> Read
                     <input type="checkbox" name="CampRegister_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction15() {
                     var checkBox = document.getElementById("myCheck15");
                     var text = document.getElementById("text15");
                     if (checkBox.checked == true) {
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
                     <input type="checkbox" name="CampDonor_servies" value="21" id="myCheck16" onclick="myFunction16()">
                  </div>
                  <div class="col-md-7" id="text16" style="display:none">

                     <input type="radio" name="CampDonor_permission" value="Write" checked> Write
                     <input type="radio" name="CampDonor_permission" value="Read"> Read
                     <input type="checkbox" name="CampDonor_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction16() {
                     var checkBox = document.getElementById("myCheck16");
                     var text = document.getElementById("text16");
                     if (checkBox.checked == true) {
                        text.style.display = "block";
                     } else {
                        text.style.display = "none";
                     }
                  }
               </script>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Master Record :</label>
                  </div>
                  <div class="col-md-1">
                     <input type="checkbox" name="MasterRecord_servies" value="23" id="myCheck17" onclick="myFunction17()">
                  </div>
                  <div class="col-md-7" id="text17" style="display:none">

                     <input type="radio" name="MasterRecord_permission" value="Write" checked> Write
                     <input type="radio" name="MasterRecord_permission" value="Read"> Read
                     <input type="checkbox" name="MasterRecord_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction17() {
                     var checkBox = document.getElementById("myCheck17");
                     var text = document.getElementById("text17");
                     if (checkBox.checked == true) {
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
                     <input type="checkbox" name="DonorRecords_servies" value="24" id="myCheck18" onclick="myFunction18()">
                  </div>
                  <div class="col-md-7" id="text18" style="display:none">

                     <input type="radio" name="DonorRecords_permission" value="Write" checked> Write
                     <input type="radio" name="DonorRecords_permission" value="Read"> Read
                     <input type="checkbox" name="DonorRecords_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction18() {
                     var checkBox = document.getElementById("myCheck18");
                     var text = document.getElementById("text18");
                     if (checkBox.checked == true) {
                        text.style.display = "block";
                     } else {
                        text.style.display = "none";
                     }
                  }
               </script>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Camp Records :</label>
                  </div>
                  <div class="col-md-1">
                     <input type="checkbox" name="CampRecords_servies" value="25" id="myCheck19" onclick="myFunction19()">
                  </div>
                  <div class="col-md-7" id="text19" style="display:none">

                     <input type="radio" name="CampRecords_permission" value="Write" checked> Write
                     <input type="radio" name="CampRecords_permission" value="Read"> Read
                     <input type="checkbox" name="CampRecords_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction19() {
                     var checkBox = document.getElementById("myCheck19");
                     var text = document.getElementById("text19");
                     if (checkBox.checked == true) {
                        text.style.display = "block";
                     } else {
                        text.style.display = "none";
                     }
                  }
               </script>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Blood Record :</label>
                  </div>
                  <div class="col-md-1">
                     <input type="checkbox" name="BloodRecord_servies" value="26" id="myCheck20" onclick="myFunction20()">
                  </div>
                  <div class="col-md-7" id="text20" style="display:none">

                     <input type="radio" name="BloodRecord_permission" value="Write" checked> Write
                     <input type="radio" name="BloodRecord_permission" value="Read"> Read
                     <input type="checkbox" name="BloodRecord_permission" value="Delete"> Delete
                  </div>
               </div>



               <script>
                  function myFunction20() {
                     var checkBox = document.getElementById("myCheck20");
                     var text = document.getElementById("text20");
                     if (checkBox.checked == true) {
                        text.style.display = "block";
                     } else {
                        text.style.display = "none";
                     }
                  }
               </script>

               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Cross Match Record :</label>
                  </div>
                  <div class="col-md-1">
                     <input type="checkbox" name="CrossMatchrecord_servies" value="27" id="myCheck21" onclick="myFunction21()">
                  </div>
                  <div class="col-md-7" id="text21" style="display:none">

                     <input type="radio" name="CrossMatchrecord_permission" value="Write" checked> Write
                     <input type="radio" name="CrossMatchrecord_permission" value="Read"> Read
                     <input type="checkbox" name="CrossMatchrecord_permission" value="Delete"> Delete
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Approve donation Registers donors :</label>
                  </div>
                  <div class="col-md-1">
                     <input type="checkbox" name="Donation_servies" value="28" id="myCheck28" onclick="myFunction28()">
                  </div>
                  <div class="col-md-7" id="text28" style="display:none">

                     <input type="radio" name="ex_permission" value="Write" checked> Write
                     <input type="radio" name="ex_permission" value="Read"> Read
                  </div>
               </div>

               <script>
                  function myFunction21() {
                     var checkBox = document.getElementById("myCheck21");
                     var text = document.getElementById("text21");
                     if (checkBox.checked == true) {
                        text.style.display = "block";
                     } else {
                        text.style.display = "none";
                     }
                  }
                  function myFunction28() {
                     var checkBox = document.getElementById("myCheck28");
                     var text = document.getElementById("text28");
                     if (checkBox.checked == true) {
                        text.style.display = "block";
                     } else {
                        text.style.display = "none";
                     }
                  }
               </script>
               <div class="row">

                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="description">Email</label>
                        <input type="email" class="form-control" id="price" name="email">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <label for="price">Password</label>
                     <input type="password" class="form-control" id="password" onkeyup="validatePassword()" name="password">
                     <span id="passwordMessage" style="color:red;"></span>

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   function validatePassword() {
      var passwordInput = document.getElementById('password');
      var passwordMessage = document.getElementById('passwordMessage');
      var password = passwordInput.value;

      var passwordPattern = /^(?=.*\d)(?=.*[!@#$%^&*]+)(?=.*[A-Z])(?=.*[a-z]).{8,}$/;

      if (passwordPattern.test(password)) {
         passwordMessage.innerHTML = '';
         $('#subbutton').prop('disabled', false);

      } else {
         $('#subbutton').prop('disabled', true);

         passwordMessage.innerHTML = 'Password must contain at least one digit, one lowercase letter, one uppercase letter, and one special character(!@#$%^&amp;) and be at least 8 characters long.';
      }
   }
</script>