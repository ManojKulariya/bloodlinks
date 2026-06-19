<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
/* 8feb */







  #h_category_err::before {
    margin: 10px;
  }
  #update-profile{
    display: none;
  }
  ul.profile_out li {
    width: 100%;
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 0px !important;
  }
  ul.profile_out li {
    width: 100%;
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 0px !important;
    font-size: 15px;
    text-transform: capitalize;
    background: #343a40;
    color: #fff !important;
  }
  .login-cta{
    border-bottom: 1px solid #ced4da;
    padding: 34px 0px;
  }
  .br-1 {
    border-left: 1px solid #ced4da;
  }
  .feils_out {
    display: flex;
    padding-bottom: 12px;
    align-items: center;
  }
  .feils_out span {
    margin-right: 15px !important;
    width: 212px;
    font-weight: 600;
    text-transform: capitalize;
  }
  .feils_out label {
    color: #000 !important;
    padding: 0px;
    margin: 0px;
  }
  .profile-hr{
    width:13%;
    margin:auto;
    border-bottom:2px solid red;

  }
  
</style>
<div class="image-contactus-banner">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="lg-text text-dark">My Profile</h1>
        <h6><a href="index.html">Home /</a> My Appointments</h6>
      </div>
    </div>
  </div>
</div>

<section class="sign-in-page my-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="contact-wrapper">
          <header class="login-cta">
            <h2 id="current-tab">My Profile</h2>
            <hr class="profile-hr">
          </header>
          <div class="row">
            <br>
            <div class="col-md-3 mt-5 pr-4">

              <ul class="profile_out">
                <li class="btn side-nav-btn active-btn" id="view-profile">view Profile</li>
                <li class="btn side-nav-btn " id="view-edit-profile">Edit Profile</li>
              </ul>
            <!-- 
             <div class="form-group" align="center">
              <span name="filter" id="reset-filter" class="col-md-5 btn btn-success">Reset</span>
              <span name="filter" id="filter" class="col-md-5 btn btn-success">Filter</span>
            </div> -->

          </div>

          <?php  $id = $_SESSION['customer_id'];
          // print_r($id);die();
          $query = $this->db->query("SELECT * FROM bl_customers WHERE user_id = '$id'");
 //print_r(json_encode($query));

          foreach ($query->result() as $row)
          {
  // print_r($row); die;
          }

          ?>
          <div class="col-md-9 pl-4 pt-5 br-1">
           <div id="show-profile">

            <div class="feils_out">
              <span >Full Name</span>
              <label><?= $row->first_name;?> <?=$row->mid_name;?> <?=$row->last_name; ?></label>
            </div>
            <div class="feils_out">
              <span  value="" name="email">Email</span>
              <label><?php echo $row->email; ?></label>
            </div>
            <div class="feils_out" id="">
              <span name="" value="" >Phone Number</span>
              <label><?php echo $row->ph_no; ?></label>
            </div>
            <div class="feils_out">
              <span name="" value="" >Age</span>
              <label><?php echo $row->age; ?></label>
            </div>
            <div class="feils_out">
              <span name="" >Gender</span> 
              <label class=""><?php echo $row->gender ?></label>
            </div>
            <?php 
             $group = $row->blood_group;
             // print_r($group);
            $query1 = $this->db->query("SELECT * FROM bl_masters WHERE master_id = '$group'"); 

            foreach ($query1->result() as $bloodgroup)
            {
   // print_r($bloodgroup); die;
            }
            ?>
            <div class="feils_out">
             <span>Blood Group</span>
             <label><?php echo $bloodgroup->master_type_key_value; ?></label>
           </div>

           <div class="feils_out">
            <span type="text"  >Address</span>
            <label><?php echo $row->address; ?></label>
          </div>
          
        </div>

      <div class="new-edit-form">
        <form id="update-profile" action = "<?php $_PHP_SELF ?>" method = "POST">

                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">First Name <span> *</span></label>
                     <div class="col-sm-8">
                       <input class="form-control" type="text" name="first_name" value="<?= $row->first_name;?>" required="">
                     </div>
                  </div>
                   <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Middle Name <span> *</span></label>
                     <div class="col-sm-8">
                      <input class="form-control" type="text" name="mid_name" value="<?=$row->mid_name;?>" >
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Last Name <span> *</span></label>
                     <div class="col-sm-8">
                      <input class="form-control" type="text" name="last_name" value="<?=$row->last_name; ?>" required="">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Email <span> *</span></label>
                     <div class="col-sm-8">
                      <input class="form-control" type="text" required="" value="<?php echo $row->email; ?>" name="email">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Phone Number <span> *</span></label>
                     <div class="col-sm-8">
                     <input class="form-control" type="text" name="phone_number" value="<?php echo $row->ph_no; ?>" required="">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Age <span> *</span></label>
                     <div class="col-sm-8">
                      <input class="form-control" type="text" name="age" value="<?php echo $row->age; ?>" required="">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Gender <span> *</span></label>
                     <div class="col-sm-8 d-flex">
                      <label class="radio-inline">
              <input type="radio" name="gender" <?php echo $row->gender == "Male" ? "checked" : ""; ?> value="Male" checked=""> <span style="color:#495057;"> Male</span>
            </label>
            <label class="radio-inline">
              <input type="radio" name="gender" <?php echo $row->gender == "Female" ? "checked" : ""; ?> value="Female"><span style="color:#495057;"> Female</span>
            </label>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Blood Group <span> *</span></label>
                     <div class="col-sm-8">
                      <select name="blood_group" style="padding:0px !important;" class="form-control" required="">
              <option value="<?php echo $bloodgroup->master_type_key_value; ?>" selected hidden><?php echo $bloodgroup->master_type_key_value; ?></option>
              <option value="A+">A+</option>
              <option value="A−">A−</option>
              <option value="B+">B+</option>
              <option value="B−">B−</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>
            </select>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Address <span> *</span></label>
                     <div class="col-sm-8">
                     <input class="form-control" type="text" name="address" value="<?php echo $row->address; ?>" required="">
                     </div>
                  </div>
          <!-- <div class="form-row">
            <input type="text" name="mid_name" value="<?=$row->mid_name;?>" >
            <span>Middle Name</span>
          </div> -->
         <!--  <div class="form-row">
            <input type="text" name="last_name" value="<?=$row->last_name; ?>" required="">
            <span>Last Name</span>
          </div> -->
         <!--  <div class="form-row">
            <input type="text" required="" value="<?php echo $row->email; ?>" name="email">
            <span>Email</span>
          </div> -->
          <!-- <div class="form-row" id="signup-phone">
            <input type="text" name="phone_number" value="<?php echo $row->ph_no; ?>" required="">
            <span>Phone Number</span>
          </div> -->
          <!-- <div class="form-row">
            <input type="text" name="age" value="<?php echo $row->age; ?>" required="">
            <span>Age</span>
          </div> -->
          <!-- <div class="form-row">
            <label class="radio-inline">
              <input type="radio" name="gender" <?php echo $row->gender == "Male" ? "checked" : ""; ?> value="Male" checked=""> <span style="color:#495057;"> Male</span>
            </label>
            <label class="radio-inline">
              <input type="radio" name="gender" <?php echo $row->gender == "Female" ? "checked" : ""; ?> value="Female"><span style="color:#495057;"> Female</span>
            </label>
          </div>
 -->
          <!-- <div class="form-row">
            <select name="blood_group" style="padding:0px !important;" class="form-control" required="">
              <option value="<?php echo $bloodgroup->master_type_key_value; ?>" selected hidden><?php echo $bloodgroup->master_type_key_value; ?></option>
              <option value="A+">A+</option>
              <option value="A−">A−</option>
              <option value="B+">B+</option>
              <option value="B−">B−</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>
            </select>
            <span>Blood Group</span>
          </div> -->
         <!--  <div class="form-row">
            <input type="text" name="address" value="<?php echo $row->address; ?>" required="">
            <span>Address</span>
          </div> -->
              <!-- <div class="form-row">
                <input type="hidden" id="e_state" value="" name="">

                <select onchange="edit_print_city('state', this.selectedIndex);" id="sts" name="state" class="form-control" style="padding:0px !important;" required></select>
              </div>
              <div class="form-row">
                <input type="hidden" id="e_city" value="" name="">

                <select id="state" name="city" class="form-control" style="padding:0px !important;" required>
                  <option value=""></option>
                </select>
                <script language="javascript">
                  edit_print_state("sts");
                </script>
              </div> -->
              <div class="row">
                <span class="btn new-red ml-3" id="change-pass-req">change password</span>
              </div>
              <!-- <input type="hidden" name="old-password" id="old_password" value="" > -->
             <!--  <div class="form-row" id="passcode" style="display: none;">
                <input type="text"  name="password" value=""  id="password">
                <span>Password</span>
              </div> -->
               <div class="row mb-3" id="passcode" style="display: none;">
                     <label id="passcode" for="colFormLabel" class="col-sm-4 col-form-label">Password <span> *</span></label>
                     <div class="col-sm-8">
                     <input class="form-control" type="text"  name="password" value=""  id="password">
                     </div>
                  </div>
              <div class="form-row"></div>
              <div class="form-row">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
               <button type="submit" >Save Changes</button>
             </div>
             <!-- <div class="form-row">
              <div class="col-md-10" id="update-response" style="display: block;">

              </div> -->
            </div>
          </form>
        </div>
          <?php 
// print_r($_POST);die();
          if (!empty($_POST)) {
           $blood = $_POST['blood_group'];
            // print_r($_POST['first_name']);die();
           $query2 = $this->db->query("SELECT * FROM bl_masters WHERE master_type_key_value = '$blood'"); 

           foreach ($query2->result() as $bloodID)
           {

           }
          $first_name = $_POST['first_name'];
          $mid_name = $_POST['mid_name'];
          $last_name = $_POST['last_name'];
          $gender = $_POST['gender'];
          $email = $_POST['email'];
          $ph_no = $_POST['phone_number'];
          $age = $_POST['age'];
          $address = $_POST['address'];
          if (!empty($_POST['password'])) {
           $password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost'=>12));
          // print_r($password);die();
         }else{

            $query4 = $this->db->query("SELECT * FROM bl_users WHERE id = '$id'");
              foreach ($query4->result() as $user)
           {

           }
          $password = $user->password;
          
         }
          
// $new_details = json_encode($_POST);
           $update = $this->db->query("UPDATE bl_customers SET first_name = '$first_name', mid_name = '$mid_name', last_name = '$last_name', gender = '$gender', email = '$email', ph_no = '$ph_no', age = '$age', blood_group = '$bloodID->master_id' , address = '$address'  WHERE user_id = '$id'");
          if($update==true){

            $update1 = $this->db->query("UPDATE bl_users SET password = '$password'  WHERE id = '$id'");
              if($update1==true){
            echo '<script>alert("successfully submit your form")</script>';
               // alert("successfully submit your form");
              } else{
               echo "fail";
              }
          } else{
            echo "fail";
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>
</div>
</section>
<!--request form-->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script type="text/javascript">

  $('#change-pass-req').on('click', function(){
    $('#passcode').toggle();
    if($('#passcode').is(':visible') == false){
      $('#password').val($('#old_password').val())
    }
    if($('#passcode').is(':visible') == true){
      $('#password').val("");
    }
  });
  $('#view-edit-profile').on('click', function(){
    $('#show-profile').hide();
    $('#update-profile').show();
    $('#current-tab').html('Edit Profile');
  });
  $('#view-profile').on('click', function(){
    $('#show-profile').show();
    $('#update-profile').hide();
    $('#current-tab').html('My Profile');
  });
</script>
