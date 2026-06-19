<style>
	.form-control{
        height: 1.5rem;
    padding: 0;
	}
    .row{
        margin-bottom:-9px !important ;
    }
    .card-footer{
        background-color:white !important;
    }
    label{
        font-weight: 700;
    font-size: 0.8rem;
    margin-bottom: 0; 
    }
    .content-header h1{
        font-size: 1.2rem;
    margin: 0;
    font-weight: 700;
    margin-bottom:12px;
    }
</style>
<?php 
$id= $this->uri->segment(3);

if(!empty($_POST['blood_name'])){
     //print_r($_POST); die;
    $blood_id = $_POST['blood_bank'];
    $blood_name = $_POST['blood_name'];
    $camp_code = $_POST['camp_code'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $venue = $_POST['venue'];
    $sponsored = $_POST['sponsored'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $state = $_POST['state'];
    $city = $_POST['city']; 
    $expected_no = $_POST['expected_no'];
    $permission = $_POST['permission'];    
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
$update = $this->db->query("UPDATE bl_bloodcamp SET bloodbank_id = '$blood_id', blood_name = '$blood_name', camp_code = '$camp_code' ,start_date = '$start_date',end_date = '$end_date',venue = '$venue',sponsored = '$sponsored',address = '$address',mobile = '$mobile' ,latitude = '$latitude' ,longitude = '$longitude'  , state = '$state' , city = '$city' ,expected_no ='$expected_no' ,permission ='$permission' , start_time = '$start_time' , end_time = '$end_time' WHERE id = '$id'");
// echo $this->db->insert_id();die;
    if($update==true){
    // echo 'hiii';
    // die();
        redirect('admin/all_bloodcamp');

    } else{
        echo "fail";
    }
}
?>
<?php 

$query1 = $this->db->query("SELECT * FROM bl_bloodcamp INNER JOIN bl_states ON bl_bloodcamp.state = bl_states.id WHERE bl_bloodcamp.id = '$id'")->result();
foreach ($query1 as $row)
{}
// print_r($query1); die();
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
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="vender" >Blood Bank Name</label>
                                <select name="blood_bank" id="vender" class="form-control" style="padding:0px !important;">
            <?php
            $id = $row->bloodbank_id; 
            // print_r($id);die();
            $query = $this->db->query("SELECT * FROM bl_blood_banks where blood_bank_id = '$id'");
           foreach ($query->result() as $blood)
                   {
              ?>
                    <option value="<?= $blood->blood_bank_id; ?>"><?= $blood->name; ?></option>
                                                <?php }
            $query1 = $this->db->query("SELECT * FROM bl_blood_banks");
           foreach ($query1->result() as $bank)
           {
              ?>
          <option value="<?= $bank->blood_bank_id; ?>"><?= $bank->name; ?></option>
            <?php } ?>
                                </select>
                            </div>
                        </div>
           </div>

                        <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Blood Camp Name</label>
                                <input type="text" class="form-control" id="price" value="<?php if(isset($row->blood_name)) { echo $row->blood_name;  } ?>" name="blood_name">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="vender" >Camp Code</label>
                                <select name="camp_code" id="vender" class="form-control" style="padding:0px !important;">
                                        <option value="<?= $row->camp_code; ?>"><?= $row->camp_code; ?></option>
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
                                <input type="date" class="form-control" id="price" name="start_date" value="<?php if(isset($row->start_date)) { echo $row->start_date;  } ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">End Date</label>
                                <input type="date" class="form-control" id="price" name="end_date" value="<?php if(isset($row->end_date)) { echo $row->end_date;  } ?>">

                            </div>
                        </div>

                    </div>
                   
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Venue</label>
                                <input type="text" class="form-control" id="price" name="venue" value="<?php if(isset($row->venue)) { echo $row->venue;  } ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Sponsored By</label>
                                <input type="text" class="form-control" id="price" name="sponsored" value="<?php if(isset($row->sponsored)) { echo $row->sponsored;  } ?>">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="price">Address</label>
                            <input type="text" class="form-control" id="price" name="address" value="<?php if(isset($row->address)) { echo $row->address;  } ?>">

                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Contact No.</label>
                                <input type="text" class="form-control" id="price" name="mobile" value="<?php if(isset($row->mobile)) { echo $row->mobile;  } ?>">

                            </div>
                        </div>

                    </div>



                    <div class="row">

                       

<div class="col-md-3">
    <div class="form-group">
        <label for="per" >Permission Status</label>
       <select name="permission" id="per" class="form-control">
       <option value="<?php $row->permission; ?>"><?php echo $row->permission; ?></option>
        <option value="Applied">Applied</option>
        <option value="Granted">Granted</option>
       </select>
    </div>
</div>


<div class="col-md-3">
    <div class="form-group">
        <label for="description" style="font-size:13px;">Expected no.of donor in blood camp</label>
        <input type="text" class="form-control" id="price" name="expected_no" value="<?php if(isset($row->expected_no)) { echo $row->expected_no;  } ?>">
    </div>
</div>



<div class="col-md-3">
    <div class="form-group">
        <label for="description">Start Time</label>
        <input type="time" class="form-control" id="price" name="start_time" value="<?php if(isset($row->start_time)) { echo $row->start_time;  } ?>">
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="price">End Time</label>
        <input type="time" class="form-control" id="price" name="end_time" value="<?php if(isset($row->end_time)) { echo $row->end_time;  } ?>">

    </div>
</div>


</div>




                    
                   <div class="row">

                        <div class="col-md-3">
                            <label for="price">Latitude</label>
                            <input type="text" class="form-control" id="price" name="latitude" value="<?php if(isset($row->latitude)) { echo $row->latitude;  } ?>">

                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Longitude</label>
                                <input type="tel" class="form-control" id="price" name="longitude" value="<?php if(isset($row->longitude)) { echo $row->longitude;  } ?>">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="price">Select State</label>
                             <select class="form-control" id="select_states" name="state" >
                                <option value="<?= $row->state; ?>"><?= $row->state_name; ?></option>
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
                        <!-- <option value="<?= $row->city; ?>"><?= $row->district_name; ?></option> -->
                     </select>
                            </div>
                        </div>

                    </div>
                               
                    <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                            <button type="submit" name="submit" class="btn btn-sm btn-danger" ><i class="fas fa-save fw"></i> Update </button>
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