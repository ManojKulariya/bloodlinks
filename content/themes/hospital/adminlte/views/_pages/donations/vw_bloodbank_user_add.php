<?php
$services = [
 
   1 => "Request Form",
   2 => "Discard Blood",
   3 => "Handover to BMW"
];


if (!empty($_POST['name'])) {
   $sign = "";

   $name = $_POST['name'];
//   $email = $_POST['email'];
   $mobile = $_POST['mobile'];
   $user_role = $_POST['role_type'];
//   $cust_password = $_POST['password'];
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

   $sql = "SELECT * FROM bl_users WHERE phone = '$mobile' ";
   $user = $this->db->query($sql)->result_array();

   if (count($user) > 0) { ?>

      <script type="text/javascript">
         alert("mobile already exists");
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
      $insert = $this->db->query("INSERT INTO bl_users (sign,role_id, user_status, user_verified,phone) 
      VALUES ('$sign','9', 'active', 'yes','$mobile')");
      $last_id = $this->db->insert_id();
      if ($insert == true) {
         $insert1 = $this->db->query("INSERT INTO bl_hospital_user (hospital_id, user_id, name, role, mobile, servies, servies_permission) 
                    VALUES ('$bank_id','$last_id', '$name','$user_role', '$mobile', '$service', '$service_permission')");
         if ($insert1) {
            redirect('hospital/donations/bloodbank_user');
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
                           $query1 = $this->db->query("SELECT * FROM bl_bloodbank_master where master_type_key = 'user_role' AND hospital_id = '$bank_id'");
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
               <?php foreach ($services as $id => $label): ?>
                <div class="row">
                   <div class="col-md-4">
                      <label><?= $label ?> :</label>
                   </div>
                   <div class="col-md-1">
                      <input type="checkbox" name="<?= str_replace(' ', '', $label) ?>_servies"
                             value="<?= $id ?>" id="check<?= $id ?>" onclick="togglePermission(<?= $id ?>)">
                   </div>
                   <div class="col-md-7" id="perm<?= $id ?>" style="display:none">
                      <input type="radio" name="<?= str_replace(' ', '', $label) ?>_permission" value="Write" checked> Write
                      <input type="radio" name="<?= str_replace(' ', '', $label) ?>_permission" value="Read"> Read
                      <input type="checkbox" name="<?= str_replace(' ', '', $label) ?>_permission" value="Delete"> Delete
                   </div>
                </div>
                <?php endforeach; ?>

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
function togglePermission(id) {
   var checkBox = document.getElementById("check" + id);
   var text = document.getElementById("perm" + id);
   text.style.display = checkBox.checked ? "block" : "none";
}

</script>