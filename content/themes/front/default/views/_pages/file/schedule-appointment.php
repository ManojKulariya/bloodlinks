  <?php defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($list);
//die;?>



<?php 

  if(!empty($_POST['blood_bank_id'])){

     // print_r($_SESSION); die;

    $o_id = $_POST['blood_bank_id'];
    $o_date = $_POST['appointment_date'];
    $o_name = $_POST['blood_bank_name'];
    $o_address = $_POST['blood_bank_address'];

     //$userIdOrg = se

    // echo $o_id; die;
// id 
// user_id  
// org_id 
// org_type 
// donation_form_id 
// approved_status  
// donation_status  
// requested_schedule_date  
// reason 
// re_schedule_status 
// updated_at 
// created_at 
// created_by 
// updated_by
$id = $_SESSION['customer_id'];
$form = $_SESSION['form_id'];
 // $form_id = uniqid();
  // print_r($form);
 // die();
// $donar_form_update = $this->db->query("UPDATE bl_donar_form_info SET form_id = '$form_id' WHERE user_id = '$id'");

    // $query=$this->db->get('bl_donar_form_info');
    //     $data =  $query->result(); 
    //     echo "<pre>";
    //     print_r($data);
    //     echo "</pre>";

    //     die;


          
            $insert = $this->db->query("INSERT INTO bl_blood_donation_requests (org_id, user_id, donation_form_id, approved_status, requested_schedule_date ) VALUES ('$o_id','$id', '$form', 'approved','$o_date')");
// echo $this->db->insert_id();die;
  if($insert==true){
    // echo 'hiii';
    // die();
    
    redirect('my-appointment');
 // echo '<script>alert("Your Appointment Booked")</script>';
  } else{
  echo "fail";
  }
    // $o_update = $this->db->query("UPDATE bl_donar_form_info SET form_id = ' '  WHERE user_id = 35");
      

 
        // $query=$this->db->get('bl_donar_form_info');
        // $data =  $query->result(); 
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        // die;

  }
 
?>

<style type="text/css">
@media (min-width: 1200px) {

   .col-xl-4.col-lg-6.col-md-4.col-sm-6{
    width: 33.3%;
  }

}

.hr-schedule{
  width:25%;
  border-bottom:2px solid red;
  margin:auto;
}


.form-group-ayu{
  display:inline-block;

}
.form-control-ayu{
width:234px ;
}

.btn-ayu-23{
  padding-right: 43px;
    /* margin: 0px 6px; */
    padding-top: 8px;
    padding-bottom: 8px;
    margin-right:14px;
}
.form-ayu-23{
  margin:1rem 0;
}
.fade{
  background:none !important;
}

@media (max-width:992px) 
{.form-control-ayu{
  width: 138px;
}
.btn-ayu-23{
  margin-right:7px;
}
  
.nav-area{
  position: relative;
    /* z-index: -1; */
}
.modal-content{
  z-index: 5;
}


}

@media (max-width:767px) {
  .text-dark{
  font-size:12px;
}
.modal-content{
  width:60%;
  left:20%;
}
}

    </style>

    <!-- <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" id="user_id" name=""> -->
    <div class="image-contactus-banner">

      <?php 

        // $query=$this->db->get('bl_donar_form_info');
        // $data =  $query->result(); 
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        // die;

      ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="lg-text text-dark">Schedule Appointment</h1>
                    <h6><a href="index.html">Home /</a> Schedule Appointment</h6>
                </div>
            </div>
        </div>
    </div>

    <header class="login-cta">
              <h2>Schedule Appointment</h2>
              <hr class="hr-schedule">
            </header>

   <!--  <input type="hidden" name="" id="protocol" value="<?php echo $protocol;?>"> -->
    <section class="sign-in-page">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="contact-wrapper">

<!-- nav -->


<div class="row"> 
<div class="col-md-12 d-flex justify-content-center">
            <!-- <div class="row"> -->
              <form action = "<?php $_PHP_SELF ?>" method = "POST" class="form-ayu-23">
            <?php $query = $this->db->get('bl_blood_banks'); 
                 
            ?>
            <div class="row">

              <div class="form-group form-group-ayu col-sm-4 col-4">
                <select name="filter_city"  class="form-control form-control-ayu" style="padding: 0px;">
                 <option value="">Select city</option>
                 <?php foreach ($query->result() as $row) {  ?>
                 <option value="<?php echo $row->address_1; ?>"><?php echo $row->address_1; ?></option>
                 <?php } ?>
                </select>

               </div>
               

             <div class="form-group form-group-ayu col-sm-4 col-4">
              <select name="filter_pin"  class="form-control  form-control-ayu" style="padding: 0px;">
               <option value="">Select pincode</option>
             <?php foreach ($query->result() as $row) {  ?>
                 <option value="<?php echo $row->pincode; ?>"><?php echo $row->pincode; ?></option>
                 <?php } ?>
              </select>
             </div>
             

             <div class="form-group col-sm-4 col-4" >
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="row">
              <button type="cancel"   class="col-md-5 col-sm-5 col-5 btn btn-success btn-ayu-23">Reset</button>
              <button type="submit"  class="col-md-5 col-sm-5 col-5 btn btn-success btn-ayu-23">Filter</button>
              </div>
             </div>

            </div>

          </form>

            <!-- <div class="col-md-4"></div> -->
           </div>

         </div>


<!-- nav enbd -->



            <!-- <header class="login-cta">
              <h2>Schedule Appointment</h2>
            </header> -->
            <div class="row">
              <br>

            <!-- <div class="col-md-2 mt-5 ">
            <div class="row">
              <form action = "<?php $_PHP_SELF ?>" method = "POST">
            <?php $query = $this->db->get('bl_blood_banks'); 
                 
            ?>
            <div class="">
              <div class="form-group">
                <select name="filter_city"  class="form-control" style="padding: 0px;">
                 <option value="">Select city</option>
                 <?php foreach ($query->result() as $row) {  ?>
                 <option value="<?php echo $row->address_1; ?>"><?php echo $row->address_1; ?></option>
                 <?php } ?>
                </select>

               </div>
               <br>
             <div class="form-group">
              <select name="filter_pin"  class="form-control" style="padding: 0px;">
               <option value="">Select pincode</option>
             <?php foreach ($query->result() as $row) {  ?>
                 <option value="<?php echo $row->pincode; ?>"><?php echo $row->pincode; ?></option>
                 <?php } ?>
              </select>
             </div>
             <br>
             <div class="form-group" align="center">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <button type="cancel"   class="col-md-5 btn btn-success">Reset</button>
              <button type="submit"  class="col-md-5 btn btn-success">Filter</button>
             </div>
            </div>
          </form>
            <div class="col-md-4"></div>
           </div>
         </div> -->


           <div class="col-md-10" style="padding-left: 30px;">
           <div class="table-responsive">
        <!-- table -->
            <table  class="table table-bordered table-hover">
             <thead>
              <tr>
                <th width="25%">Book Appointment</th>
                <th width="25%">Blood Bank Name</th>
                <!-- <th width="25%">Address</th> -->
                <th width="30%">Blood Bank Address</th>
                <th width="30%">Blood Bank Phone no.</th>
                <!-- <th width="15%">Postal Code</th> -->
                <!-- <th width="15%">organization Type</th> -->
              </tr>
             </thead>
             <?php 
          if (!empty($_POST['filter_pin']) || !empty($_POST['filter_city'])) {

                $pin = $_POST['filter_pin'];
                $city = $_POST['filter_city'];

                $query1 = $this->db->query("SELECT * FROM  bl_blood_banks WHERE pincode = '$pin' OR address_1 = '$city'");
               
               }
               else{
                 $query1 = $this->db->query("SELECT * FROM  bl_blood_banks");

               }
// print_r($_POST);
 // print_r($query1);

foreach ($query1->result() as $row)
{
    // echo $row->name;

    // print_r($row);
// die();
              ?>
           
                <tr>
                  
                  <td><span class="btn btn-success book<?php echo $row->blood_bank_id; ?>" id="<?php echo $row->blood_bank_id; ?>"  >book appointment</span></td>
                  <td><?php echo $row->name; ?></td>
                 <td><?php echo $row->address_1; ?></td>
                 <td><?php echo $row->contact_ph_no; ?></td>
                  <!-- <td><?php  ?></td> -->
                </tr> 
                 <!-- Modal -->
  <div class="modal fade" id="book-appointment-modal<?php echo $row->blood_bank_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header p-2">
          <h5 class="modal-title" id="exampleModalLabel">Scheduling Details</h5>
         <!--  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button> -->
        </div>
        <form id="scheduling-confirm" action = "<?php $_PHP_SELF ?>" method = "POST" style="padding-bottom: 0px!important; margin: 0px!important;">
           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <div class="modal-body">
          <div id="appo-details" class="">
            <div class="row">
              <label class="text-dark col-md-5 col-sm-5 col-5"><strong>Blood Bank Name</strong> </label>:
              <span  class="text-dark col-md-5 col-sm-5 col-5" id="bb-name"><?php echo $row->name; ?></span>
            </div>
            <!--  <div class="row">
              <label class="text-dark  col-md-5 "><strong> Organization Type</strong> </label>:
              <span  class="text-dark col-md-5" id="bb-cat"></span>
            </div> -->
             <div class="row">
              <label class="text-dark  col-md-5 col-sm-5 col-5"><strong> Blood Bank Address</strong> </label>:
              <span  class="text-dark col-md-5 col-sm-5 col-5" id="bb-addrs"><?php echo $row->address_1; ?></span>
            </div>
            
             <div class="row">
              <label class="text-dark col-md-5 "><strong> Date</strong> </label>:
               <input type="date" id="appointment_date"  name="appointment_date" style="margin-left: 10px;padding-left: 5px;padding-right: 5px;border-radius: 5px;" required>
            </div>
            <input type="hidden" value="<?php echo $row->blood_bank_id; ?>" id="blood_bank_id" name="blood_bank_id">
            <input type="hidden" value="<?php echo $row->name; ?>" id="blood_bank_name" name="blood_bank_name">
            <input type="hidden" value="<?php echo $row->address_1; ?>" id="blood_bank_address" name="blood_bank_address">
            <span id="appo-book-msg"  class="text-success" ></span>
          </div>
        </div>
        <div class="modal-footer p-1">
          <button type="button" id="closemodal" class="btn bg-dark text-white" data-dismiss="modal">Close</button>
          <button type="submit" name="submit" id="confirmBtn" name="organization_form" class="btn btn-primary" >Confirm</button>
        </div>
        </form>
      </div>

    </div>
  </div>
  <script type="text/javascript">
     $(document).on( 'click', '.book<?php echo $row->blood_bank_id; ?>', function () { 
    // $('#bb-name').html($(this).attr('data-name'));
    // $('#bb-cat').html($(this).attr('data-cat'));
    // $('#bb-addrs').html($(this).attr('data-addrs'));
    // $('#bb-id').val($(this).attr('id'));
    $('#book-appointment-modal<?php echo $row->blood_bank_id; ?>').modal('show');
    // $('#book-appointment-modal').appendTo("body").modal('hide');
  });
  </script>
              <?php } ?>
            </table>
          </div>
        </div>
       </div>
        </div>
      </div>
    </div>
  </section>
  <br>
 <?php 
// $query = $this->db->get('bl_blood_banks');
//$query = $this->db->get_where('bl_blood_banks', array('blood_bank_id' => $blood_bank_id), $limit, $offset);
foreach ($query->result() as $row)
{
    // echo $row->name;
}
    //print_r($row);
// die();
              ?>

  
<script type="text/javascript" language="javascript" >

 $(document).ready(function(){

  // alert('hiiii');


  // $('#confirmBtn').click( function(e) {

  //     e.preventDefault();

  //     let O_id = $('#blood_bank_id').val();
  //     let O_name = $('#blood_bank_name').val();
  //     let O_address = $('#blood_bank_address').val();
  //     let O_date = $('#appointment_date').val();

  //     alert(O_address);

  //     // $.ajax({
  //     //     url: 'some-url',
  //     //     type: 'post',
  //     //     dataType: 'json',
  //     //     data: $('form#myForm').serialize(),
  //     //     success: function(data) {
  //     //                // ... do something with the data...
  //     //              }
  //     // });
  // });

  // $('#confirmBtn').click(function(e){
  //   e,pr
  //   alert()
  // })
  
  
  fill_datatable();

  function fill_datatable(filter_city = '', filter_pin = '')
  {
    var base_url = $('#protocol').val();
   var dataTable = $('#customer_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "searching" : false,
    "ajax" : {
     url:base_url+"/filter-locations.php",
     type:"POST",
     data:{
      filter_city:filter_city, filter_pin:filter_pin
     }
    }
   });
  }

  
  $('#filter').click(function(){
   var filter_city = $('#filter_city').val();
   var filter_pin = $('#filter_pin').val();
   if(filter_city != '' && filter_pin != '')
   {
    $('#customer_data').DataTable().destroy();
    fill_datatable(filter_city, filter_pin);
   }
   else
   {
    alert('Select Both filter option');
    $('#customer_data').DataTable().destroy();
    fill_datatable();
   }
  });
  
  $('#reset-filter').on('click', function(){
    $('#customer_data').DataTable().destroy();
    fill_datatable('', '');
  });
 });

  //$(document).on( 'click', '.book', function () { 
    // $('#bb-name').html($(this).attr('data-name'));
    // $('#bb-cat').html($(this).attr('data-cat'));
    // $('#bb-addrs').html($(this).attr('data-addrs'));
    // $('#bb-id').val($(this).attr('id'));
    //$('#book-appointment-modal').modal('show');
    // $('#book-appointment-modal').appendTo("body").modal('hide');
  //});
  // $('#scheduling-confirm').on('click', function(){

  //   var base_url = $('#protocol').val();
  //   var url = base_url+"ajax_requests/schedule_appointment_request.php";
  //   var user_id = $('#user_id').val();
  //   var org_id = $('#bb-id').val();
  //   // alert(user_id+""+org_id);
  //     $.ajax({
  //         url: url,
  //         type: 'POST',
  //         dataType: "text",
  //         data: {user_id:user_id, org_id:org_id},
  //         success: function(response) {
  //           $('#appo-book-msg').html(response);
  //           window.setTimeout(function() {  $('#book-appointment-modal').appendTo("body").modal('hide');}, 4000);
  //         },
  //         error: function(xhr, desc, err) {
  //           console.log("error");
  //         }
  //       });

  // })
 
</script>
<script type="text/javascript">
    $('#closemodal').modal('hide');
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
   $(document).ready(function(){

      $('#scheduling-confirm').validate({
         rules:{
      
         },
         messages:{
         },
         submitHandler:function(){
            var formData=new FormData($('#scheduling-confirm')[0]);
            formData.append([csrf_name],csrf_hash);
            formData.append('step_data','<?php echo $current_step;?>');
            $.ajax({
               type:'POST',
               url:'<?php echo base_url('donation_request_submit');?>',
               data:formData,
               cache: false,
               contentType: false,
               processData: false,
               timeout: 60000000,
               success:function(d){

                  if(d.procced=='yes'){
                     load_forms(d.step);
                  }else if(d.procced=='no'){
                     alert(d.reason);
                     $('#deferReasonModal').modal('show');
                  }
                  else{
                     alert(d.error);
                  }
               }
            });

            console.log(formData);
         }
      });
   });
</script>