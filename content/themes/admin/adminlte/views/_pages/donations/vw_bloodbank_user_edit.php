<?php
$bank_id = $_SESSION['bank_id'];
$id = $this->uri->segment(5);
if (!empty($_POST['name'])) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $mobile = $_POST['mobile'];
   $user_role = $_POST['role_type'];
   $user_id = $_POST['user_id'];
   $cust_password = $_POST['password'];
   $sign = $_POST['sign_old'];
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
   $update = $this->db->query("UPDATE bl_bloodbank_user SET name = '$name', role = '$user_role' ,mobile = '$mobile',servies = '$service',
   servies_permission = '$service_permission' WHERE id = '$id'");
   if ($update) {
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
      $update1 = $this->db->query("UPDATE bl_users SET sign = '$sign',email = '$email', password = '$password' WHERE id = '$user_id'");
      if ($update1) {
         redirect('admin/donations/bloodbank_user');
      } else {
         echo "fail";
      }
   } else {
      echo "fail";
   }
}

$query1 = $this->db->query("SELECT * FROM bl_bloodbank_user WHERE id = $id");

foreach ($query1->result() as $row) {
$query2 = $this->db->query("SELECT * FROM bl_users WHERE id = $row->user_id")->row();

}
$result = $query1->result();
$serviess = json_decode($result[0]->servies);
$serviess_per = json_decode($result[0]->servies_permission);

?>
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
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="vender">User Name</label>
                        <input type="text" class="form-control" value="<?php if (isset($row->name)) {
                                                                           echo $row->name;
                                                                        } ?>" id="price" name="name">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="vender">Role Types</label>
                        <select name="role_type" id="vender" class="form-control">
                           <option value="<?= $row->role ?>"><?= $row->role ?></option>
                           <?php
                           $query1 = $this->db->query("SELECT * FROM bl_bloodbank_master where master_type_key = 'user_role'");
                           foreach ($query1->result() as $type) {
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
                        <input type="tel" class="form-control" value="<?php if (isset($row->mobile)) {
                                                                           echo $row->mobile;
                                                                        } ?>" id="price" name="mobile">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="description">Email</label>
                        <input type="email" class="form-control" id="price" value="<?php if (isset($row->email)) {
                                                                                       echo $row->email;
                                                                                    } ?>" name="email">
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label for="price">Sign</label>
                        <input type="file" class="form-control" name="sign">
                        <input type="hidden" class="form-control" name="sign_old"  value="<?php if (isset($query2->sign)) {
                                                                                 echo $query2->sign;
                                                                              } ?>">

                     </div>
                  </div>
                  <input type="hidden" class="form-control" id="price" value="<?php if (isset($row->user_id)) {
                                                                                 echo $row->user_id;
                                                                              } ?>" name="user_id">
               </div>
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-4">
                        <label>Servies : </label>
                     </div>
                     <div class="col-md-1">
                        <label>Permission</label>
                     </div>
                     <div class="col-md-7">
                        <label>Read/Write : </label>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Donation :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->Donation_servies) && $serviess->Donation_servies == "3")) { ?>
                        <input type="checkbox" name="Donation_servies" value="3" checked><?php } else { ?>
                           <input type="checkbox" name="Donation_servies" value="3"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text1">
                     <?php if ((!empty($serviess) && isset($serviess->Donation_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->Donation_permission) && $serviess_per->Donation_permission == "Write")) { ?>
                            <input type="radio" name="Donation_permission" value="Write" checked> Write 
                            <input type="radio" name="Donation_permission" value="Read"> Read<?php } else { ?>
                              <input type="radio" name="Donation_permission" value="Write"> Write
                               <input type="radio" name="Donation_permission" value="Read" checked> Read <?php } ?>
                                 

                     <?php } else { ?>
                        <input type="radio" name="Donation_permission" value="Write"> Write
                        <input type="radio" name="Donation_permission" value="Read"> Read
                        <input type="checkbox" name="Donation_permission" value="Delete"> Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Deferred Donor :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->DeferredDonor_servies) && $serviess->DeferredDonor_servies == "4")) { ?><input type="checkbox" name="DeferredDonor_servies" value="4" checked><?php } else { ?><input type="checkbox" name="DeferredDonor_servies" value="4"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text2">
                     <?php if ((!empty($serviess) && isset($serviess->DeferredDonor_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->DeferredDonor_permission) && $serviess_per->DeferredDonor_permission == "Write")) { ?> <input type="radio" name="DeferredDonor_permission" value="Write" checked> Write <input type="radio" name="DeferredDonor_permission" value="Read">Read <?php } else { ?><input type="radio" name="DeferredDonor_permission" value="Write">Write <input type="radio" name="DeferredDonor_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="DeferredDonor_permission" value="Write">Write
                        <input type="radio" name="DeferredDonor_permission" value="Read">Read
                        <input type="checkbox" name="DeferredDonor_permission" value="Delete"> Delete

                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Donor Register :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->DonorRegister_servies) && $serviess->DonorRegister_servies == "5")) { ?><input type="checkbox" name="DonorRegister_servies" value="5" checked><?php } else { ?><input type="checkbox" name="DonorRegister_servies" value="5"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text3">
                     <?php if ((!empty($serviess) && isset($serviess->DonorRegister_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->DonorRegister_permission) && $serviess_per->DonorRegister_permission == "Write")) { ?> <input type="radio" name="DonorRegister_permission" value="Write" checked> Write <input type="radio" name="DonorRegister_permission" value="Read">Read <?php } else { ?><input type="radio" name="DonorRegister_permission" value="Write">Write <input type="radio" name="DonorRegister_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="DonorRegister_permission" value="Write">Write
                        <input type="radio" name="DonorRegister_permission" value="Read">Read
                        <input type="checkbox" name="DonorRegister_permission" value="Delete">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">TTI Test :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->TTITest_servies) && $serviess->TTITest_servies == "6")) { ?><input type="checkbox" name="TTITest_servies" value="6" checked><?php } else { ?><input type="checkbox" name="TTITest_servies" value="6"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text4">
                     <?php if ((!empty($serviess) && isset($serviess->TTITest_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->TTITest_permission) && $serviess_per->TTITest_permission == "Write")) { ?> <input type="radio" name="TTITest_permission" value="Write" checked> Write <input type="radio" name="TTITest_permission" value="Read">Read <?php } else { ?><input type="radio" name="TTITest_permission" value="Write">Write <input type="radio" name="TTITest_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="TTITest_permission" value="Write">Write
                        <input type="radio" name="TTITest_permission" value="Read">Read
                        <input type="checkbox" name="TTITest_permission" value="Delete">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Blood Fraction :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->BloodFraction_servies) && $serviess->BloodFraction_servies == "7")) { ?><input type="checkbox" name="BloodFraction_servies" value="7" checked><?php } else { ?><input type="checkbox" name="BloodFraction_servies" value="7"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text5">
                     <?php if ((!empty($serviess) && isset($serviess->BloodFraction_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->BloodFraction_permission) && $serviess_per->BloodFraction_permission == "Write")) { ?> <input type="radio" name="BloodFraction_permission" value="Write" checked> Write <input type="radio" name="BloodFraction_permission" value="Read">Read <?php } else { ?><input type="radio" name="BloodFraction_permission" value="Write">Write <input type="radio" name="BloodFraction_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="BloodFraction_permission" value="Write">Write
                        <input type="radio" name="BloodFraction_permission" value="Read">Read
                        <input type="checkbox" name="BloodFraction_permission" value="Delete">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Blood Stock :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->BloodStock_servies) && $serviess->BloodStock_servies == "9")) { ?><input type="checkbox" name="BloodStock_servies" value="9" checked><?php } else { ?><input type="checkbox" name="BloodStock_servies" value="9"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text6">
                     <?php if ((!empty($serviess) && isset($serviess->BloodStock_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->BloodStock_permission) && $serviess_per->BloodStock_permission == "Write")) { ?> <input type="radio" name="BloodStock_permission" value="Write" checked> Write <input type="radio" name="BloodStock_permission" value="Read">Read <?php } else { ?><input type="radio" name="BloodStock_permission" value="Write">Write <input type="radio" name="BloodStock_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="BloodStock_permission" value="Write">Write
                        <input type="radio" name="BloodStock_permission" value="Read">Read
                        <input type="checkbox" name="BloodStock_permission" value="Delete">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Consumables :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->Consumables_servies) && $serviess->Consumables_servies == "10")) { ?><input type="checkbox" name="Consumables_servies" value="10" checked><?php } else { ?><input type="checkbox" name="Consumables_servies" value="10"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text7">
                     <?php if ((!empty($serviess) && isset($serviess->Consumables_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->Consumables_permission) && $serviess_per->Consumables_permission == "Write")) { ?> <input type="radio" name="Consumables_permission" value="Write" checked> Write <input type="radio" name="Consumables_permission" value="Read">Read <?php } else { ?><input type="radio" name="Consumables_permission" value="Write">Write <input type="radio" name="Consumables_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="Consumables_permission" value="Write">Write
                        <input type="radio" name="Consumables_permission" value="Read">Read
                        <input type="checkbox" name="Consumables_permission" value="Delete">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Return :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->Return_servies) && $serviess->Return_servies == "11")) { ?><input type="checkbox" name="Return_servies" value="11" checked><?php } else { ?><input type="checkbox" name="Return_servies" value="11"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text8">
                     <?php if ((!empty($serviess) && isset($serviess->Return_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->Return_permission) && $serviess_per->Return_permission == "Write")) { ?> <input type="radio" name="Return_permission" value="Write" checked> Write <input type="radio" name="Return_permission" value="Read">Read <?php } else { ?><input type="radio" name="Return_permission" value="Write">Write <input type="radio" name="Return_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="Return_permission" value="Write">Write
                        <input type="radio" name="Return_permission" value="Read">Read
                        <input type="checkbox" name="Return_permission" value="Delete">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Discard :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->Discard_servies) && $serviess->Discard_servies == "12")) { ?><input type="checkbox" name="Discard_servies" value="12" checked><?php } else { ?><input type="checkbox" name="Discard_servies" value="12"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text9">
                     <?php if ((!empty($serviess) && isset($serviess->Discard_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->Discard_permission) && $serviess_per->Discard_permission == "Write")) { ?> <input type="radio" name="Discard_permission" value="Write" checked> Write <input type="radio" name="Discard_permission" value="Read">Read <?php } else { ?><input type="radio" name="Discard_permission" value="Write">Write <input type="radio" name="Discard_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="Discard_permission" value="Write">Write
                        <input type="radio" name="Discard_permission" value="Read">Read
                        <input type="checkbox" name="Discard_permission" value="Delete">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Request :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->Request_servies) && $serviess->Request_servies == "14")) { ?><input type="checkbox" name="Request_servies" value="14" checked><?php } else { ?><input type="checkbox" name="Request_servies" value="14"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text10">
                     <?php if ((!empty($serviess) && isset($serviess->Request_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->Request_permission) && $serviess_per->Request_permission == "Write")) { ?> <input type="radio" name="Request_permission" value="Write" checked> Write <input type="radio" name="Request_permission" value="Read">Read <?php } else { ?><input type="radio" name="Request_permission" value="Write">Write <input type="radio" name="Request_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="Request_permission" value="Write">Write
                        <input type="radio" name="Request_permission" value="Read">Read
                        <input type="checkbox" name="Request_permission" value="Delete">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Deferred Request :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->DeferredRequest_servies) && $serviess->DeferredRequest_servies == "15")) { ?><input type="checkbox" name="DeferredRequest_servies" value="15" checked><?php } else { ?><input type="checkbox" name="DeferredRequest_servies" value="15"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text11">
                     <?php if ((!empty($serviess) && isset($serviess->DeferredRequest_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->DeferredRequest_permission) && $serviess_per->DeferredRequest_permission == "Write")) { ?> <input type="radio" name="DeferredRequest_permission" value="Write" checked> Write <input type="radio" name="DeferredRequest_permission" value="Read">Read <?php } else { ?><input type="radio" name="DeferredRequest_permission" value="Write">Write <input type="radio" name="DeferredRequest_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="DeferredRequest_permission" value="Write">Write
                        <input type="radio" name="DeferredRequest_permission" value="Read">Read
                        <input type="checkbox" name="DeferredRequest_permission" value="Delete">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Request Register :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->RequestRegister_servies) && $serviess->RequestRegister_servies == "16")) { ?><input type="checkbox" name="RequestRegister_servies" value="16" checked><?php } else { ?><input type="checkbox" name="RequestRegister_servies" value="16"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text12">
                     <?php if ((!empty($serviess) && isset($serviess->RequestRegister_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->RequestRegister_permission) && $serviess_per->RequestRegister_permission == "Write")) { ?> <input type="radio" name="RequestRegister_permission" value="Write" checked> Write <input type="radio" name="RequestRegister_permission" value="Read">Read <?php } else { ?><input type="radio" name="RequestRegister_permission" value="Write">Write <input type="radio" name="RequestRegister_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="RequestRegister_permission" value="Write">Write
                        <input type="radio" name="RequestRegister_permission" value="Read">Read
                        <input type="checkbox" name="RequestRegister_permission" value="Delete">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Cross Match :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->CrossMatch_servies) && $serviess->CrossMatch_servies == "17")) { ?><input type="checkbox" name="CrossMatch_servies" value="17" checked><?php } else { ?><input type="checkbox" name="CrossMatch_servies" value="17"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text13">
                     <?php if ((!empty($serviess) && isset($serviess->CrossMatch_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->CrossMatch_permission) && $serviess_per->CrossMatch_permission == "Write")) { ?> <input type="radio" name="CrossMatch_permission" value="Write" checked> Write <input type="radio" name="CrossMatch_permission" value="Read">Read <?php } else { ?><input type="radio" name="CrossMatch_permission" value="Write">Write <input type="radio" name="CrossMatch_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="CrossMatch_permission" value="Write">Write
                        <input type="radio" name="CrossMatch_permission" value="Read">Read
                        <input type="checkbox" name="CrossMatch_permission" value="Delete">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Issue Blood :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->IssueBlood_servies) && $serviess->IssueBlood_servies == "18")) { ?><input type="checkbox" name="IssueBlood_servies" value="18" checked><?php } else { ?><input type="checkbox" name="IssueBlood_servies" value="18"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text14">
                     <?php if ((!empty($serviess) && isset($serviess->IssueBlood_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->IssueBlood_permission) && $serviess_per->IssueBlood_permission == "Write")) { ?> <input type="radio" name="IssueBlood_permission" value="Write" checked> Write <input type="radio" name="IssueBlood_permission" value="Read">Read <?php } else { ?><input type="radio" name="IssueBlood_permission" value="Write">Write <input type="radio" name="IssueBlood_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="IssueBlood_permission" value="Write">Write
                        <input type="radio" name="IssueBlood_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Camp Register :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->CampRegister_servies) && $serviess->CampRegister_servies == "20")) { ?><input type="checkbox" name="CampRegister_servies" value="20" checked><?php } else { ?><input type="checkbox" name="CampRegister_servies" value="20"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text15">
                     <?php if ((!empty($serviess) && isset($serviess->CampRegister_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->CampRegister_permission) && $serviess_per->CampRegister_permission == "Write")) { ?> <input type="radio" name="CampRegister_permission" value="Write" checked> Write <input type="radio" name="CampRegister_permission" value="Read">Read <?php } else { ?><input type="radio" name="CampRegister_permission" value="Write">Write <input type="radio" name="CampRegister_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="CampRegister_permission" value="Write">Write
                        <input type="radio" name="CampRegister_permission" value="Read">Read
                        <input type="checkbox" name="CampRegister_permission" value="Delete">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Camp Donor :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->CampDonor_servies) && $serviess->CampDonor_servies == "21")) { ?><input type="checkbox" name="CampDonor_servies" value="21" checked><?php } else { ?><input type="checkbox" name="CampDonor_servies" value="21"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text16">
                     <?php if ((!empty($serviess) && isset($serviess->CampDonor_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->CampDonor_permission) && $serviess_per->CampDonor_permission == "Write")) { ?> <input type="radio" name="CampDonor_permission" value="Write" checked> Write <input type="radio" name="CampDonor_permission" value="Read">Read <?php } else { ?><input type="radio" name="CampDonor_permission" value="Write">Write <input type="radio" name="CampDonor_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="CampDonor_permission" value="Write">Write
                        <input type="radio" name="CampDonor_permission" value="Read">Read
                        <input type="checkbox" name="CampDonor_permission" value="Delete">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Master Record :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->MasterRecord_servies) && $serviess->MasterRecord_servies == "23")) { ?><input type="checkbox" name="MasterRecord_servies" value="23" checked><?php } else { ?><input type="checkbox" name="MasterRecord_servies" value="23"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text17">
                     <?php if ((!empty($serviess) && isset($serviess->MasterRecord_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->MasterRecord_permission) && $serviess_per->MasterRecord_permission == "Write")) { ?> <input type="radio" name="MasterRecord_permission" value="Write" checked> Write <input type="radio" name="MasterRecord_permission" value="Read">Read <?php } else { ?><input type="radio" name="MasterRecord_permission" value="Write">Write <input type="radio" name="MasterRecord_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="MasterRecord_permission" value="Write">Write
                        <input type="radio" name="MasterRecord_permission" value="Read">Read
                        <input type="checkbox" name="MasterRecord_permission" value="Delete">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Donor Records :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->DonorRecords_servies) && $serviess->DonorRecords_servies == "24")) { ?><input type="checkbox" name="DonorRecords_servies" value="24" checked><?php } else { ?><input type="checkbox" name="DonorRecords_servies" value="24"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text18">
                     <?php if ((!empty($serviess) && isset($serviess->DonorRecords_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->DonorRecords_permission) && $serviess_per->DonorRecords_permission == "Write")) { ?> <input type="radio" name="DonorRecords_permission" value="Write" checked> Write <input type="radio" name="DonorRecords_permission" value="Read">Read <?php } else { ?><input type="radio" name="DonorRecords_permission" value="Write">Write <input type="radio" name="DonorRecords_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="DonorRecords_permission" value="Write">Write
                        <input type="radio" name="DonorRecords_permission" value="Read">Read
                        <input type="checkbox" name="DonorRecords_permission" value="Read">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Camp Records :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->CampRecords_servies) && $serviess->CampRecords_servies == "25")) { ?><input type="checkbox" name="CampRecords_servies" value="25" checked><?php } else { ?><input type="checkbox" name="CampRecords_servies" value="25"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text19">
                     <?php if ((!empty($serviess) && isset($serviess->CampRecords_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->CampRecords_permission) && $serviess_per->CampRecords_permission == "Write")) { ?> <input type="radio" name="CampRecords_permission" value="Write" checked> Write <input type="radio" name="CampRecords_permission" value="Read">Read <?php } else { ?><input type="radio" name="CampRecords_permission" value="Write">Write <input type="radio" name="CampRecords_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="CampRecords_permission" value="Write">Write
                        <input type="radio" name="CampRecords_permission" value="Read">Read
                        <input type="checkbox" name="CampRecords_permission" value="Read">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Blood Record :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->BloodRecord_servies) && $serviess->BloodRecord_servies == "26")) { ?><input type="checkbox" name="BloodRecord_servies" value="26" checked><?php } else { ?><input type="checkbox" name="BloodRecord_servies" value="26"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text20">
                     <?php if ((!empty($serviess) && isset($serviess->BloodRecord_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->BloodRecord_permission) && $serviess_per->BloodRecord_permission == "Write")) { ?> <input type="radio" name="BloodRecord_permission" value="Write" checked> Write <input type="radio" name="BloodRecord_permission" value="Read">Read <?php } else { ?><input type="radio" name="BloodRecord_permission" value="Write">Write <input type="radio" name="BloodRecord_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="BloodRecord_permission" value="Write">Write
                        <input type="radio" name="BloodRecord_permission" value="Read">Read
                        <input type="checkbox" name="BloodRecord_permission" value="Read">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Cross Match Record :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->CrossMatch_servies) && $serviess->CrossMatch_servies == "27")) { ?><input type="checkbox" name="CrossMatch_servies" value="27" checked><?php } else { ?><input type="checkbox" name="CrossMatch_servies" value="26"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text20">
                     <?php if ((!empty($serviess) && isset($serviess->CrossMatch_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->CrossMatch_permission) && $serviess_per->CrossMatch_permission == "Write")) { ?> <input type="radio" name="CrossMatch_permission" value="Write" checked> Write <input type="radio" name="CrossMatch_permission" value="Read">Read <?php } else { ?><input type="radio" name="CrossMatch_permission" value="Write">Write <input type="radio" name="CrossMatch_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="CrossMatch_permission" value="Write">Write
                        <input type="radio" name="CrossMatch_permission" value="Read">Read
                        <input type="checkbox" name="CrossMatch_permission" value="Read">Delete
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Approve donation Registers donors :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if ((!empty($serviess) && isset($serviess->Donation_servies) && $serviess->Donation_servies == "28")) { ?>
                        <input type="checkbox" name="Donation_servies" value="28" checked><?php } else { ?>
                           <input type="checkbox" name="Donation_servies" value="28"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text20">
                     <?php if ((!empty($serviess) && isset($serviess->Donation_servies))) { ?>
                        <?php if ((!empty($serviess_per) && isset($serviess_per->ex_permission) && $serviess_per->ex_permission == "Write")) { ?> <input type="radio" name="ex_permission" value="Write" checked> Write <input type="radio" name="ex_permission" value="Read">Read <?php } else { ?><input type="radio" name="ex_permission" value="Write">Write <input type="radio" name="ex_permission" value="Read" checked> Read <?php } ?>
                     <?php } else { ?>
                        <input type="radio" name="ex_permission" value="Write">Write
                        <input type="radio" name="ex_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="col-md-12">
                  <label for="price">Password</label>
                  <input type="password" class="form-control" id="password" onkeyup="validatePassword()" name="password">
                  <span id="passwordMessage" style="color:red;"></span>
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