<?php
$bank_id = $_SESSION['bank_id'];
$id =  $_SESSION['auth_id'];
if (!empty($_POST['name'])) {
   
   $cust_password = $_POST['password'];
   $sign = $_POST['sign_old'];
 
      $filename = $_FILES['sign']['name'];
      if ($filename != "") {
         $file_tmp_name = $_FILES['sign']['tmp_name'];
         $ext = pathinfo($filename, PATHINFO_EXTENSION);
         $uniquename = date('ymdHis') . rand(11111, 99999);
         move_uploaded_file($file_tmp_name, "uploads/sign/$uniquename.$ext");
         $file = "uploads/sign/$uniquename.$ext";
         $sign = $file;
         $update1 = $this->db->query("UPDATE bl_users SET sign = '$sign' WHERE id = '$id'");
      }
      $password = password_hash($cust_password, PASSWORD_BCRYPT);
      if($cust_password != ''){
          $update1 = $this->db->query("UPDATE bl_users SET  password = '$password' WHERE id = '$id'");
      }
      if ($update1) {
         redirect('admin/settings/profile');
      } else {
         echo "fail";
      }
  
}

$query1 = $this->db->query("SELECT * FROM bl_blood_banks WHERE user_id = $id");

foreach ($query1->result() as $row) {
$query2 = $this->db->query("SELECT * FROM bl_users WHERE id = $row->user_id")->row();

}
$result = $query1->result();
// echo "<pre>";print_r($query2);die();

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
                        <label for="vender">Blood Bank Name</label>
                        <input type="text" class="form-control" value="<?php if (isset($row->name)) { echo $row->name;  } ?>" id="price" readonly name="name">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="description">Email</label>
                        <input type="email" class="form-control" id="price" value="<?php if (isset($query2->email)) { echo $query2->email; } ?>" readonly name="email">
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
                    <div class="col-md-6">
                      <label for="price">Password</label>
                      <input type="password" class="form-control" id="password" onkeyup="validatePassword()" autocomplete="new-password" name="password">
                      <span id="passwordMessage" style="color:red;"></span>
                   </div>
                   <div class="col-md-6">
                       <lable>Uploaded Sign.</lable>
                       <?php $base_url = str_replace('/admin', '', $this->data['base_url']); ?>
                      <img src="<?php echo $base_url.'/'.$query2->sign ?>" height="100px;" width=110px;"/>
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