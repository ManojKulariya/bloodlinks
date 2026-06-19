<style>
   .form-control{
   height:1.5rem;
   padding:0;
   }
   .row{
   margin-bottom:-9px !important ;
   }
   .card-footer{
   background-color:white !important;
   }
   label {
    display: inline-block;
    margin-bottom: 0;
    font-size: 12px;
}

.content-header h1{
   font-size:1.2rem;
   font-weight:700;
   margin-bottom: 9px;
}

</style>
<?php 
   if(!empty($_POST['camp_name'])){
        //print_r($_POST); die;
       $camp_name = $_POST['camp_name'];
       $camp_code = $_POST['camp_code'];
       $start_date = $_POST['start_date'];
       $end_date = $_POST['end_date'];
       $venue = $_POST['venue'];
       $sponsored = $_POST['sponsored'];
       $address = $_POST['address'];
       $mobile = $_POST['mobile'];
       $start_time = $_POST['start_time'];
       $end_time = $_POST['end_time'];
      $latitude = $_POST['latitude'];
       $longitude = $_POST['longitude'];
       $state = $_POST['state'];
       $city = $_POST['city'];
       $expected_no = $_POST['expected_no'];
       $permission = $_POST['permission'];
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
       $insert = $this->db->query("INSERT INTO bl_bloodcamp (bloodbank_id, blood_name, camp_code, camp_type, start_date, end_date,  venue, sponsored, address, mobile ,latitude ,longitude, state, city ,  status , start_time, end_time, permission, expected_no) VALUES ( '0' , '$camp_name' , '$blood_campno' , '$camp_code' , '$start_date', '$end_date' , '$venue' , '$sponsored' , '$address' , '$mobile' ,'$latitude','$longitude', '$state' , '$city' , '1' , '$start_time','$end_time' ,'$permission','$expected_no')");
   // echo $this->db->insert_id();die;
       if($insert==true){
       // echo 'hiii';
       // die();
           redirect('admin/all_bloodcamp');
   
       } else{
           echo "fail";
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
               <a href="<?php echo $base_url;?>/all_bloodcamp" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
            </div>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="description">Blood Camp Name</label>
                     <input type="text" class="form-control" id="price" name="camp_name">
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="vender" >Camp Type</label>
                     <select name="camp_code" id="vender" class="form-control" style="padding:0px !important;">
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
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="description">Start Date</label>
                     <input type="date" class="form-control" id="price" name="start_date">
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="price">End Date</label>
                     <input type="date" class="form-control" id="price" name="end_date">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="description">Venue</label>
                     <input type="text" class="form-control" id="price" name="venue">
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="price">Sponsored By</label>
                     <input type="text" class="form-control" id="price" name="sponsored">
                  </div>
               </div>
               <div class="col-md-3">
                  <label for="price">Address</label>
                  <input type="text" class="form-control" id="price" name="address">
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="price">Contact No.</label>
                     <input type="tel" class="form-control" id="price" name="mobile">
                  </div>
               </div>
            </div>

            <div class="row">

                       

<div class="col-md-3">
    <div class="form-group">
        <label for="per" >Permission Status</label>
       <select name="permission" id="per" class="form-control">
        <option value="Applied">Applied</option>
        <option value="Granted">Granted</option>
       </select>
    </div>
</div>


<div class="col-md-3">
    <div class="form-group">
        <label for="description" style="font-size:13px;">Expected no.of donor in blood camp</label>
        <input type="text" class="form-control" id="price" name="expected_no">
    </div>
</div>



<div class="col-md-3">
    <div class="form-group">
        <label for="description">Start Time</label>
        <input type="time" class="form-control" id="price" name="start_time">
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="price">End Time</label>
        <input type="time" class="form-control" id="price" name="end_time">

    </div>
</div>


</div>



            <div class="row">
               <div class="col-md-3">
                  <label for="price">Latitude</label>
                  <input type="text" class="form-control" id="price" name="latitude">
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="price">Longitude</label>
                     <input type="tel" class="form-control" id="price" name="longitude">
                  </div>
               </div>
               <div class="col-md-3">
                  <label for="price">Select State</label>
                  <select class="form-control" id="select_states" name="state" >
                     <?php 
                        $query1 = $this->db->query("SELECT * FROM bl_states");
                        foreach ($query1->result() as $type)
                        {
                          ?>
                     <option value="<?= $type->id; ?>"><?= $type->state_name; ?></option>
                     <?php } ?>
                  </select>
                  </select>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="price">Select City</label>
                     <select class="form-control" id="select_districts" name="city" >
                        <option value="0">Select City</option>
                     </select>
                  </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" ></script>
<script type="text/javascript">
   var url ='<?php echo $base_url;?>/donations/my_city';
   $(document).ready(function(){
       $('#select_states').on('blur',function(){
         // alert('hiii')
         var req_no3 = $('#select_states').val();
   
         var csrf_token = $('#token_id').val();
         var csrf_name = $('#token_id').attr('name');
   
         // console.log(token);
         if(req_no3){
           $.ajax({
             url:url,
             // headers: {"X-Test-Header": "test-value"},
             method:'POST',
             data:{req_no3:req_no3,[csrf_name]: csrf_token},
             success: function(res){
                   if(res){
                   
                     $('#select_districts').html('');
                     
                       for(var i=0; i<res.length; i++){
                        
                         $('#select_districts').append(`
                             <option value="${res[i].id}">${res[i].district_name}</option>
                         `);
                       }
                   }
             
               // <tr>
                            
               //               <td>${res[i].unit_no}</td>
               //               <td>${res[i].component}</td>
               //               <td>${res[i].tube_no}</td>
               //               <td>${res[i].groups}</td>
               //               <td>${res[i].bleeding_date}</td>
               //               <td>${res[i].expire_date}</td>
               //               <td>${res[i].cross_match}</td>
               //               <td>${res[i].crossmatch_by}</td>
               //               <td>${res[i].coomb_meth}</td>
               //               <td>${res[i].nat}</td>
               //               </tr>
               console.log(res);
               
             }
           })
         }else{
           console.log('null');
         }
         
       });    
   })
</script>