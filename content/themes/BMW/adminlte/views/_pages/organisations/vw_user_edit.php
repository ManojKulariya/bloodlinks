<?php 
   $id= $this->uri->segment(5);
   if(!empty($_POST['name'])){
      $name = $_POST['name'];
      $email = $_POST['email'];
      $mobile = $_POST['mobile'];
      $user_role = $_POST['role_type'];
      $user_id = $_POST['user_id'];
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
   
      $update = $this->db->query("UPDATE bl_bloodbank_user SET name = '$name', role = '$role' ,mobile = '$mobile',servies = '$servies',servies_permission = '$servies_permission' WHERE id = '$id'");
      if($update){
         $password=password_hash($cust_password, PASSWORD_BCRYPT);
         $update1 = $this->db->query("UPDATE bl_users SET email = '$email', password = '$password' WHERE id = '$user_id'");
         if($update1){
          redirect('admin/user');   
       }else{
        echo "fail";
     }   
   }else{
      echo "fail";
   } 
   
   
   }
   
   $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user WHERE id = $id");
   // $serviess_p = $query1->result();
   // $serviess_per = json_encode($serviess_p[0]);
   foreach ($query1->result() as $row)
   {
      
      //$data[] = json_encode($row->servies_permission);
         // $data[] = $v;
      
   }
    //print_r($data[0]['Donation_permission']);
    // echo $data[0]->Donation_permission;
   // echo $serviess_per->servies_permission; json_encode($array,JSON_FORCE_OBJECT);
   // print_r($row);
     $serviess = json_decode($row->servies);
    $serviess_per = json_decode($row->servies_permission);
    //echo $serviess_per->Donation_permission ;
     // $serviess_per = json_decode($row->servies_permission);

     // print_r($serviess);
   // echo $serviess22->Donation_permission;
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
                        <input type="text" class="form-control" value="<?php if(isset($row->name)) { echo $row->name;  } ?>" id="price" name="name">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="vender" >Role Types</label>
                        <select name="role_type" id="vender" class="form-control">
                           <option value="<?= $row->role ?>"><?= $row->role ?></option>
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
                        <input type="tel" class="form-control" value="<?php if(isset($row->mobile)) { echo $row->mobile;  } ?>"id="price" name="mobile">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="description">Email</label>
                        <input type="email" class="form-control" id="price" value="<?php if(isset($row->email)) { echo $row->email;  } ?>" name="email">
                     </div>
                  </div>
                  <input type="hidden" class="form-control" id="price" value="<?php if(isset($row->user_id)) { echo $row->user_id;  } ?>" name="user_id">
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
                     <?php if((!empty($serviess) && isset($serviess->BloodBanks_servies) && $serviess->BloodBanks_servies == "41")){ ?><input type="checkbox" name="BloodBanks_servies" value="41" checked><?php }else{ ?><input type="checkbox" name="BloodBanks_servies" value="41"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text1" >
                     <?php if ((!empty($serviess) && isset($serviess->BloodBanks_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->BloodBanks_permission) && $serviess_per->BloodBanks_permission == "Write")){ ?> <input type="radio" name="BloodBanks_permission" value="Write" checked> Write <input type="radio" name="BloodBanks_permission" value="Read"> Read<?php }else{ ?><input type="radio" name="BloodBanks_permission" value="Write"> Write <input type="radio" name="BloodBanks_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="BloodBanks_permission" value="Write"> Write
                     <input type="radio" name="BloodBanks_permission" value="Read"> Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Hospital :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->Hospital_servies) && $serviess->Hospital_servies == "42")){ ?><input type="checkbox" name="Hospital_servies" value="42" checked><?php }else{ ?><input type="checkbox" name="Hospital_servies" value="42"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text2" >
                     <?php if ((!empty($serviess) && isset($serviess->Hospital_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->Hospital_permission) && $serviess_per->Hospital_permission == "Write")){ ?> <input type="radio" name="Hospital_permission" value="Write" checked> Write <input type="radio" name="Hospital_permission" value="Read">Read <?php }else{ ?><input type="radio" name="Hospital_permission" value="Write">Write <input type="radio" name="Hospital_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="Hospital_permission" value="Write">Write
                     <input type="radio" name="Hospital_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Labs :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->Labs_servies) && $serviess->Labs_servies == "43")){ ?><input type="checkbox" name="Labs_servies" value="43" checked><?php }else{ ?><input type="checkbox" name="Labs_servies" value="43"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text3" >
                     <?php if ((!empty($serviess) && isset($serviess->Labs_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->Labs_permission) && $serviess_per->Labs_permission == "Write")){ ?> <input type="radio" name="Labs_permission" value="Write" checked> Write <input type="radio" name="Labs_permission" value="Read">Read <?php }else{ ?><input type="radio" name="Labs_permission" value="Write">Write <input type="radio" name="Labs_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="Labs_permission" value="Write">Write
                     <input type="radio" name="Labs_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Donation Appointments :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->DonationAppointments_servies) && $serviess->DonationAppointments_servies == "45")){ ?><input type="checkbox" name="DonationAppointments_servies" value="45" checked><?php }else{ ?><input type="checkbox" name="DonationAppointments_servies" value="45"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text4">
                     <?php if ((!empty($serviess) && isset($serviess->DonationAppointments_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->DonationAppointments_permission) && $serviess_per->DonationAppointments_permission == "Write")){ ?> <input type="radio" name="DonationAppointments_permission" value="Write" checked> Write <input type="radio" name="DonationAppointments_permission" value="Read">Read <?php }else{ ?><input type="radio" name="DonationAppointments_permission" value="Write">Write <input type="radio" name="DonationAppointments_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="DonationAppointments_permission" value="Write">Write
                     <input type="radio" name="DonationAppointments_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Donation Form :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->DonationForm_servies) && $serviess->DonationForm_servies == "46")){ ?><input type="checkbox" name="DonationForm_servies" value="46" checked><?php }else{ ?><input type="checkbox" name="DonationForm_servies" value="46"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text5">
                     <?php if ((!empty($serviess) && isset($serviess->DonationForm_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->DonationForm_permission) && $serviess_per->DonationForm_permission == "Write")){ ?> <input type="radio" name="DonationForm_permission" value="Write" checked> Write <input type="radio" name="DonationForm_permission" value="Read">Read <?php }else{ ?><input type="radio" name="DonationForm_permission" value="Write">Write <input type="radio" name="DonationForm_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="DonationForm_permission" value="Write">Write
                     <input type="radio" name="DonationForm_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Deferred Donor :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->DeferredDonor_servies) && $serviess->DeferredDonor_servies == "47")){ ?><input type="checkbox" name="DeferredDonor_servies" value="47" checked><?php }else{ ?><input type="checkbox" name="DeferredDonor_servies" value="47"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text6" >
                     <?php if ((!empty($serviess) && isset($serviess->DeferredDonor_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->DeferredDonor_permission) && $serviess_per->DeferredDonor_permission == "Write")){ ?> <input type="radio" name="DeferredDonor_permission" value="Write" checked> Write <input type="radio" name="DeferredDonor_permission" value="Read">Read <?php }else{ ?><input type="radio" name="DeferredDonor_permission" value="Write">Write <input type="radio" name="DeferredDonor_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="DeferredDonor_permission" value="Write">Write
                     <input type="radio" name="DeferredDonor_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">TTI Test :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->TTITest_servies) && $serviess->TTITest_servies == "48")){ ?><input type="checkbox" name="TTITest_servies" value="48" checked><?php }else{ ?><input type="checkbox" name="TTITest_servies" value="48"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text7">
                     <?php if ((!empty($serviess) && isset($serviess->TTITest_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->TTITest_permission) && $serviess_per->TTITest_permission == "Write")){ ?> <input type="radio" name="TTITest_permission" value="Write" checked> Write <input type="radio" name="TTITest_permission" value="Read">Read <?php }else{ ?><input type="radio" name="TTITest_permission" value="Write">Write <input type="radio" name="TTITest_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="TTITest_permission" value="Write">Write
                     <input type="radio" name="TTITest_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Components :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->BloodFraction_servies) && $serviess->BloodFraction_servies == "49")){ ?><input type="checkbox" name="BloodFraction_servies" value="49" checked><?php }else{ ?><input type="checkbox" name="BloodFraction_servies" value="49"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text8" >
                     <?php if ((!empty($serviess) && isset($serviess->BloodFraction_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->BloodFraction_permission) && $serviess_per->BloodFraction_permission == "Write")){ ?> <input type="radio" name="BloodFraction_permission" value="Write" checked> Write <input type="radio" name="BloodFraction_permission" value="Read">Read <?php }else{ ?><input type="radio" name="BloodFraction_permission" value="Write">Write <input type="radio" name="BloodFraction_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="BloodFraction_permission" value="Write">Write
                     <input type="radio" name="BloodFraction_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Blood Stock :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->BloodStock_servies) && $serviess->BloodStock_servies == "50")){ ?><input type="checkbox" name="BloodStock_servies" value="50" checked><?php }else{ ?><input type="checkbox" name="BloodStock_servies" value="50"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text9" >
                     <?php if ((!empty($serviess) && isset($serviess->BloodStock_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->BloodStock_permission) && $serviess_per->BloodStock_permission == "Write")){ ?> <input type="radio" name="BloodStock_permission" value="Write" checked> Write <input type="radio" name="BloodStock_permission" value="Read">Read <?php }else{ ?><input type="radio" name="BloodStock_permission" value="Write">Write <input type="radio" name="BloodStock_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="BloodStock_permission" value="Write">Write
                     <input type="radio" name="BloodStock_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Discard :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->Discard_servies) && $serviess->Discard_servies == "51")){ ?><input type="checkbox" name="Discard_servies" value="51" checked><?php }else{ ?><input type="checkbox" name="Discard_servies" value="51"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text10" >
                     <?php if ((!empty($serviess) && isset($serviess->Discard_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->Discard_permission) && $serviess_per->Discard_permission == "Write")){ ?> <input type="radio" name="Discard_permission" value="Write" checked> Write <input type="radio" name="Discard_permission" value="Read">Read <?php }else{ ?><input type="radio" name="Discard_permission" value="Write">Write <input type="radio" name="Discard_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="Discard_permission" value="Write">Write
                     <input type="radio" name="Discard_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Request Appointments :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->RequestAppointments_servies) && $serviess->RequestAppointments_servies == "53")){ ?><input type="checkbox" name="RequestAppointments_servies" value="53" checked><?php }else{ ?><input type="checkbox" name="RequestAppointments_servies" value="53"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text11" >
                     <?php if ((!empty($serviess) && isset($serviess->RequestAppointments_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->RequestAppointments_permission) && $serviess_per->RequestAppointments_permission == "Write")){ ?> <input type="radio" name="RequestAppointments_permission" value="Write" checked> Write <input type="radio" name="RequestAppointments_permission" value="Read">Read <?php }else{ ?><input type="radio" name="RequestAppointments_permission" value="Write">Write <input type="radio" name="RequestAppointments_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="RequestAppointments_permission" value="Write">Write
                     <input type="radio" name="RequestAppointments_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Request Form :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->RequestForm_servies) && $serviess->RequestForm_servies == "54")){ ?><input type="checkbox" name="RequestForm_servies" value="54" checked><?php }else{ ?><input type="checkbox" name="RequestForm_servies" value="54"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text12" >
                     <?php if ((!empty($serviess) && isset($serviess->RequestForm_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->RequestForm_permission) && $serviess_per->RequestForm_permission == "Write")){ ?> <input type="radio" name="RequestForm_permission" value="Write" checked> Write <input type="radio" name="RequestForm_permission" value="Read">Read <?php }else{ ?><input type="radio" name="RequestForm_permission" value="Write">Write <input type="radio" name="RequestForm_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="RequestForm_permission" value="Write">Write
                     <input type="radio" name="RequestForm_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Cross Match :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->CrossMatch_servies) && $serviess->CrossMatch_servies == "55")){ ?><input type="checkbox" name="CrossMatch_servies" value="55" checked><?php }else{ ?><input type="checkbox" name="CrossMatch_servies" value="55"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text13" >
                     <?php if ((!empty($serviess) && isset($serviess->CrossMatch_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->CrossMatch_permission) && $serviess_per->CrossMatch_permission == "Write")){ ?> <input type="radio" name="CrossMatch_permission" value="Write" checked> Write <input type="radio" name="CrossMatch_permission" value="Read">Read <?php }else{ ?><input type="radio" name="CrossMatch_permission" value="Write">Write <input type="radio" name="CrossMatch_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="CrossMatch_permission" value="Write">Write
                     <input type="radio" name="CrossMatch_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Issue Blood :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->IssueBlood_servies) && $serviess->IssueBlood_servies == "56")){ ?><input type="checkbox" name="IssueBlood_servies" value="56" checked><?php }else{ ?><input type="checkbox" name="IssueBlood_servies" value="56"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text14" >
                     <?php if ((!empty($serviess) && isset($serviess->IssueBlood_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->IssueBlood_permission) && $serviess_per->IssueBlood_permission == "Write")){ ?> <input type="radio" name="IssueBlood_permission" value="Write" checked> Write <input type="radio" name="IssueBlood_permission" value="Read">Read <?php }else{ ?><input type="radio" name="IssueBlood_permission" value="Write">Write <input type="radio" name="IssueBlood_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="IssueBlood_permission" value="Write">Write
                     <input type="radio" name="IssueBlood_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Return Blood :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->ReturnBlood_servies) && $serviess->ReturnBlood_servies == "57")){ ?><input type="checkbox" name="ReturnBlood_servies" value="57" checked><?php }else{ ?><input type="checkbox" name="ReturnBlood_servies" value="57"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text15" >
                     <?php if ((!empty($serviess) && isset($serviess->ReturnBlood_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->ReturnBlood_permission) && $serviess_per->ReturnBlood_permission == "Write")){ ?> <input type="radio" name="ReturnBlood_permission" value="Write" checked> Write <input type="radio" name="ReturnBlood_permission" value="Read">Read <?php }else{ ?><input type="radio" name="ReturnBlood_permission" value="Write">Write <input type="radio" name="ReturnBlood_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="ReturnBlood_permission" value="Write">Write
                     <input type="radio" name="ReturnBlood_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Camp Register :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->CampRegister_servies) && $serviess->CampRegister_servies == "59")){ ?><input type="checkbox" name="CampRegister_servies" value="59" checked><?php }else{ ?><input type="checkbox" name="CampRegister_servies" value="59"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text16" >
                     <?php if ((!empty($serviess) && isset($serviess->CampRegister_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->CampRegister_permission) && $serviess_per->CampRegister_permission == "Write")){ ?> <input type="radio" name="CampRegister_permission" value="Write" checked> Write <input type="radio" name="CampRegister_permission" value="Read">Read <?php }else{ ?><input type="radio" name="CampRegister_permission" value="Write">Write <input type="radio" name="CampRegister_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="CampRegister_permission" value="Write">Write
                     <input type="radio" name="CampRegister_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Camp Donor :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->CampDonor_servies) && $serviess->CampDonor_servies == "60")){ ?><input type="checkbox" name="CampDonor_servies" value="60" checked><?php }else{ ?><input type="checkbox" name="CampDonor_servies" value="60"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text17" >
                     <?php if ((!empty($serviess) && isset($serviess->CampDonor_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->CampDonor_permission) && $serviess_per->CampDonor_permission == "Write")){ ?> <input type="radio" name="CampDonor_permission" value="Write" checked> Write <input type="radio" name="CampDonor_permission" value="Read">Read <?php }else{ ?><input type="radio" name="CampDonor_permission" value="Write">Write <input type="radio" name="CampDonor_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="CampDonor_permission" value="Write">Write
                     <input type="radio" name="CampDonor_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Master Records :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->MasterRecord_servies) && $serviess->MasterRecord_servies == "62")){ ?><input type="checkbox" name="MasterRecord_servies" value="62" checked><?php }else{ ?><input type="checkbox" name="MasterRecord_servies" value="62"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text18" >
                     <?php if ((!empty($serviess) && isset($serviess->MasterRecord_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->MasterRecord_permission) && $serviess_per->MasterRecord_permission == "Write")){ ?> <input type="radio" name="MasterRecord_permission" value="Write" checked> Write <input type="radio" name="MasterRecord_permission" value="Read">Read <?php }else{ ?><input type="radio" name="MasterRecord_permission" value="Write">Write <input type="radio" name="MasterRecord_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="MasterRecord_permission" value="Write">Write
                     <input type="radio" name="MasterRecord_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Donor Records :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->DonorRecords_servies) && $serviess->DonorRecords_servies == "63")){ ?><input type="checkbox" name="DonorRecords_servies" value="63" checked><?php }else{ ?><input type="checkbox" name="DonorRecords_servies" value="63"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text19" >
                     <?php if ((!empty($serviess) && isset($serviess->DonorRecords_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->DonorRecords_permission) && $serviess_per->DonorRecords_permission == "Write")){ ?> <input type="radio" name="DonorRecords_permission" value="Write" checked> Write <input type="radio" name="DonorRecords_permission" value="Read">Read <?php }else{ ?><input type="radio" name="DonorRecords_permission" value="Write">Write <input type="radio" name="DonorRecords_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="DonorRecords_permission" value="Write">Write
                     <input type="radio" name="DonorRecords_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Blood Record :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->BloodRecords_servies) && $serviess->BloodRecords_servies == "64")){ ?><input type="checkbox" name="BloodRecords_servies" value="64" checked><?php }else{ ?><input type="checkbox" name="BloodRecords_servies" value="64"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text20" >
                     <?php if ((!empty($serviess) && isset($serviess->BloodRecords_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->BloodRecords_permission) && $serviess_per->BloodRecords_permission == "Write")){ ?> <input type="radio" name="BloodRecords_permission" value="Write" checked> Write <input type="radio" name="BloodRecords_permission" value="Read">Read <?php }else{ ?><input type="radio" name="BloodRecords_permission" value="Write">Write <input type="radio" name="BloodRecords_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="BloodRecords_permission" value="Write">Write
                     <input type="radio" name="BloodRecords_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
                 <div class="row">
                  <div class="col-md-4">
                     <label for="myCheck">Cross Match Records :</label>
                  </div>
                  <div class="col-md-1">
                     <?php if((!empty($serviess) && isset($serviess->CrossMatch_servies) && $serviess->CrossMatch_servies == "65")){ ?><input type="checkbox" name="CrossMatch_servies" value="65" checked><?php }else{ ?><input type="checkbox" name="CrossMatch_servies" value="65"> <?php } ?>
                  </div>
                  <div class="col-md-7" id="text20" >
                     <?php if ((!empty($serviess) && isset($serviess->CrossMatch_servies))){ ?>
                     <?php if((!empty($serviess_per) && isset($serviess_per->CrossMatch_permission) && $serviess_per->CrossMatch_permission == "Write")){ ?> <input type="radio" name="CrossMatch_permission" value="Write" checked> Write <input type="radio" name="CrossMatch_permission" value="Read">Read <?php }else{ ?><input type="radio" name="CrossMatch_permission" value="Write">Write <input type="radio" name="CrossMatch_permission" value="Read" checked> Read <?php } ?>
                     <?php }else{ ?>
                     <input type="radio" name="CrossMatch_permission" value="Write">Write
                     <input type="radio" name="CrossMatch_permission" value="Read">Read
                     <?php } ?>
                  </div>
               </div>
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