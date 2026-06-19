<?php 
if(!empty($_POST['cust_name'])){
     //print_r($_POST); die;
    $cust_name = $_POST['cust_name'];
    $camp_code = $_POST['camp_code'];
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];
    $venue = $_POST['venue'];
    $sponsored = $_POST['sponsored'];
    $address = $_POST['address'];
    $mobile = $_POST['contact'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
       $n=6;
      function reg($n) {
        $characters = '0123456789';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        } 

        return $randomString;
    }

    $blood_camp = reg($n);
    $blood_campno = 'BC'.$blood_camp;
    $insert = $this->db->query("INSERT INTO bl_bloodcamp (bloodbank_id, blood_name, camp_code, camp_type, start_date, end_date,  venue, sponsored, address, mobile ,latitude ,longitude, status) VALUES ( '0' , '$cust_name' , '$blood_campno' , '$camp_code' , '$start_date', '$end_date' , '$venue' , '$sponsored' , '$address' , '$mobile' ,'$latitude','$longitude', '0')");
// echo $this->db->insert_id();die;
    if($insert==true){
    // echo 'hiii';
    // die();
        //redirect('admin/donations/bloodcamps');
echo '<script>alert("You Form submitted successfully")</script>';
    } else{
        echo "fail";
    }
}
?>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<style>
   .bloodbank-hrr{
      width:19%;
      margin:auto;
      border-bottom:2px solid red;
   }
   .form-control{
      padding:0 2px!important;
   }
</style>
<!-- <div class="image-contactus-banner">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1 class="lg-text text-dark">Register As A Blood Donor</h1>
            <h6>Home / <span>Register Now</span></h6>
         </div>
      </div>
   </div>
</div> -->

<section class="sign-in-page my-5">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-xl-9 col-lg-7">
             <div class="contact-wrapper">
               <header class="login-cta">
                  <h1 style="color: #000; text-align: center;">Register Blood Camp</h1>
                  <hr class="bloodbank-hrr">
               </header>
               <form action = "<?php $_PHP_SELF ?>" method = "POST" class="new-register">
                   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                 
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Blood Camp Name <span> *</span></label>
                     <div class="col-sm-8">
                               <input class="form-control" type="text" name="cust_name" autocomplete="off" placeholder="Blood Camp Name">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Camp Code <span> *</span></label>
                     <div class="col-sm-8">
                       <select name="camp_code" id="vender" class="form-control">
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
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Start Date <span> *</span></label>
                     <div class="col-sm-8">
                        <input class="form-control" type="date" name="start" autocomplete="off" placeholder="Enter Email">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">End Date <span> *</span></label>
                     <div class="col-sm-8">
                         <input class="form-control" type="date" name="end" autocomplete="off" placeholder="Enter Phone">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Venue <span> *</span></label>
                     <div class="col-sm-8">
                       <input class="form-control" type="text" name="venue" autocomplete="off" placeholder="Enter Venue"> 
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Sponsored By <span> *</span></label>
                     <div class="col-sm-8">
                        <input class="form-control" type="text" name="sponsored" autocomplete="off" placeholder="Enter Sponsored By">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Address <span> *</span></label>
                     <div class="col-sm-8">
                         <input class="form-control" type="text" name="address" autocomplete="off" placeholder="Enter Address">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Contact No. <span> *</span></label>
                     <div class="col-sm-8">
                        <input class="form-control" type="tel" name="contact" autocomplete="off" placeholder="Enter Contact No.">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Latitude <span> *</span></label>
                     <div class="col-sm-8">
                         <input class="form-control" type="text" name="latitude" autocomplete="off" placeholder="Enter Latitude">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 col-form-label">Longitude <span> *</span></label>
                     <div class="col-sm-8">
                         <input class="form-control" type="text" name="longitude" autocomplete="off" placeholder="Enter Longitude">
                     </div>
                  </div>
                  
                  <div class="row mb-3">
                     <div class="col-sm-4"></div>
                     <div class="col-sm-8">
                        <div class="row">
                           <div class="col-xl-4">
                               <div class="regi-btn">
                                  <button type="submit" >Submit</button>
                               </div>
                           </div>
                        </div>
                     </div>
                  </div>
                 
                     
                  
               </form>
            </div>
         </div>
      </div>
   </div>
</section>