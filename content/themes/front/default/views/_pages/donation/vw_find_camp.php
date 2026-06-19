<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
   @media (min-width: 1200px) {
   .col-xl-4.col-lg-6.col-md-4.col-sm-6{
   width: 33.3%;
   }
   }

   .bloodbank-hr{
      width:16%;
      margin:auto;
      border-bottom:2px solid red;
   }
   .find-bank-1{
      background:#faf9fb;
      padding: 51px 12px;
   }
   .btn-yes-2{
      padding: 8px 8px;
    margin: 2px 15px
   }
</style>


<div class="find-bank-1">
   <div class="container-">
      <div class="row">
         <div class="col-md-12">
            <h1 class="text-dark text-center">Find Blood Camps</h1>
<hr class="bloodbank-hr">
         </div>
      </div>
   </div>
</div>


<section class="sign-in-page my-5">
   <div class="container">
        <form action = "<?php $_PHP_SELF ?>" method = "POST">
               
      <div class="row"> 
          <div class="col-sm-3">
              
                  <div class="form-group">
              
                     <select class="form-control" id="select_states" name="filter_state" style="padding: 0px;margin: 5px;">
                        <option value="0">Select State</option>
                        </select>
                  </div>
            </div>
            <div class="col-sm-3">
              
                  <div class="form-group">
                   
                     <select class="form-control" id="select_districts" name="filter_city" style="padding: 0px;margin: 5px;">
                        <option value="0">Select City</option>
                     </select>
                  </div>
            </div>
            <div class="col-sm-3">
               
                  <div class="form-group">

               
                     <input class="form-control" type="text" name="address" id="cust_username" autocomplete="off" placeholder="    Enter Address" style="padding: 0px;margin: 5px;">
                  </div>

            </div>
                  <div class="col-sm-3">
               
                  <div class="form-group">
            
                     <input class="form-control" type="text" name="camp_name" id="cust_username" autocomplete="off" placeholder="  Enter Camp Name" style="padding: 0px;margin: 5px;">
                  </div>

            </div>

            <div class="col-sm-12">
             <div class="form-group" align="right">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
               <button type="cancel"   class="col-md-1 btn btn-success btn-yes-2">Reset</button>
               <button type="submit"  class="col-md-1 btn btn-success  btn-yes-2">Filter</button>
             </div>
          
          </div>
       </div>
 </form>
    
      </div>
      <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="contact-wrapper">
               <header class="login-cta">
                  <h2>Camp List</h2>
                  <hr class="bloodbank-hr">
               </header>
               <div class="row">
                  <div class="col-md-12" style="padding-left: 30px;">
                     <div class="table-responsive">
                        <!-- table -->
                        <table  class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                <th>Camp Name</th>
                                <th>Address</th>
                                <th>Phone No.</th>
                                <th>Camp Type</th>
                                <th>Get Direction</th>
                              </tr>
                           </thead>
                           <?php 
                              if (!empty($_POST['address']) || !empty($_POST['filter_city']) || !empty($_POST['camp_name'])) {
                                
                                // print_r($_POST);
                                //    die();
                                    $address = $_POST['address'];
                                    $city = $_POST['filter_city'];
                                    $state = $_POST['filter_state'];
                                    $name = $_POST['camp_name'];
                              
                                    $query1 = $this->db->query("SELECT * from bl_bloodcamp WHERE bl_bloodcamp.blood_name = '$name' OR bl_bloodcamp.address = '$address' OR (bl_bloodcamp.city = '$city' AND bl_bloodcamp.state = '$state')");
                                   
                                   }
                                   else{
                                     $query1 = $this->db->query("SELECT * from bl_bloodcamp");
                              
                                   }
                              // print_r($_POST);
                              // print_r($query1);
                              
                              foreach ($query1->result() as $row)
                              {
                              // echo $row->name;
                              
                              //print_r($row);
                              // die();
                                  ?>
                           <tr>
                             <td><?php echo $row->blood_name; ?></td>
                             <td><?php echo $row->address; ?></td>
                             <td><?php echo $row->mobile; ?></td>
                             <td><?php echo $row->camp_type; ?></td>
                              <td><a class="btn btn-success" href="https://www.google.com/maps/@<?php echo $row->latitude; ?>,<?php echo $row->longitude; ?>">Get Direction</a></td>
                             
                              
                              <!-- <td><?php  ?></td> -->
                           </tr>
                           <?php } ?>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
    </div>
   </div>
</section>
<br>

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
<script type="text/javascript">
      var states_get_url='<?php echo base_url('get_states');?>';
   var districts_get_url='<?php echo base_url('get_districts');?>';
</script>
<script type="text/javascript" src="https://bloodlinks.in/content/themes/front/default/assets/scripts/common.js"></script>
   <script type="text/javascript" src="https://bloodlinks.in/content/themes/front/default/assets/scripts/register.js"></script>
<!-- <script type="text/javascript">
   function getDistance(){
    // Google API key
    $apiKey = 'AIzaSyAgEGH8AWxjrZeGEcjWy__HCV-ZiNgVD94';
    
    
    // Get latitude and longitude from the geodata
    $latitudeFrom    = '23.208656';
    $longitudeFrom    = '77.424246';
    $latitudeTo        = '23.865642';
    $longitudeTo    = '45.54645';
    
    // Calculate distance between latitude and longitude
    $theta    = $longitudeFrom - $longitudeTo;
    $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist    = acos($dist);
    $dist    = rad2deg($dist);
    $miles    = $dist * 60 * 1.1515;
    
    // Convert unit and return distance
    $unit = strtoupper($unit);
    if($unit == "K"){
        return round($miles * 1.609344, 2).'km';
    }elseif($unit == "M"){
        return round($miles * 1609.344, 2).'meters';
    }else{
        return round($miles, 2).'miles';
    }
}

</script> -->