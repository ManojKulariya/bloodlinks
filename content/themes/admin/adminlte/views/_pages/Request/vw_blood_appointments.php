<?php defined('BASEPATH') OR exit('No direct script access allowed');
//  $query = $this->db->get('bl_customers');
//  foreach ($query->result() as $row)
// {

//     print_r($row);

// } 
// $auth = $_SESSION['auth_id'];
// print_r($_SESSION);
// die();
$bank_id = $_SESSION['bank_id'];
?>
<div class="container">
    <form action = "<?php $_PHP_SELF ?>" method = "POST">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

        <div class="timeline">
            <!-- <div class="time-label">
                <span class="bg-red">Consumables Items</span>
              </div> -->
              <div class="card">
             
                <div class="card-body">
 
    
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Appointment Id</label>
                                <input type="text" class="form-control" id="price" name="appointment_id">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">User Id</label>
                                <input type="text" class="form-control" id="price" name="user_id">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Name</label>
                                <input type="text" class="form-control" id="price" name="name">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                 <label for="description">Form Status</label>
                                <select name="form_status" id="vender" class="form-control">
          <option disabled="disabled" selected="selected" value="">Select</option>                             
          <option value="accepted">Accepted</option>
          <option value="not accepted">Not Accepted</option>
        
                                </select>
                            </div>
                        </div>
                    </div>
                         <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Mobile No</label>
                                <input type="tel" class="form-control" id="price" name="mobile">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Blood Group</label>
                                <select name="blood_group" id="vender" class="form-control">
          <option disabled="disabled" selected="selected" value="">Select</option>                            
          <option value="A+">A+</option>
          <option value="A-">A-</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="AB+">AB+</option>
          <option value="AB-">AB-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>

        
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
                                <label for="description">End Date</label>
                                <input type="date" class="form-control" id="price" name="end_date">
                            </div>
                        </div>
                    </div>
                                        <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Donor Type</label>
                                <select name="donor_type" id="vender" class="form-control">
          <option disabled="disabled" selected="selected" value="">Select</option>                                 
          <option value="Regular">Regular</option>
          <option value="Replacement">Replacement</option>
        
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                               
                                 <label for="description">Application Id</label>
<input type="text" class="form-control" id="price" name="application_id">
                            </div>
                        </div>
                 
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Components Required</label>
                               <input type="text" class="form-control" id="price" name="Components">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Hospital</label>
                               <input type="text" class="form-control" id="price" name="hospital">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">City</label>
                               <input type="text" class="form-control" id="price" name="city">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">User</label>
                               <input type="text" class="form-control" id="price" name="user">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                            <button type="submit" name="submit" class="btn btn-sm btn-danger" >Filter</button>
                        </div>
                    </div>
                </div>
              </div>
            </form>
          </div>

         <!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>-->

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
  <div style="overflow-x:auto;">
<table class="table table-fluid" id="myTable">
<thead>
<tr>
  <th>S No</th>
  <th>Appointment Id</th>
  <th>User Id</th>
  <th>Name</th>
  <th>Date</th>
  <th>Status</th>
  <th>Mobile No</th>
  <th>Application Id</th>
  <th>Donar Type</th>
  <th>Blood Group</th>
  <th>City</th>
  <th>Components Required</th>
  <th>Hospital</th>
  <th>User</th>
                    <?php 
   if ($_SESSION['admin_type'] =='0') {
$servies_per = $_SESSION['bloodbank_user_servies_permission'];
        $per = json_decode($servies_per);

        if ($per->Request_permission  =='Write') {
             
   ?>
   <th>Action</th>
<?php }
}else{?>
 <th>Action</th>
<?php } ?>
 
</tr>
</thead>
<tbody>
<?php
      $no=0;
   if(!empty($_POST)){

        //print_r($_POST); die;

     $name = $_POST['name']; 
     $user_no = $_POST['user_no']; 
     $application_no = $_POST['application_no']; 
     $donor_type = $_POST['donor_type']; 
     $mobile = $_POST['mobile']; 
     $blood_group = $_POST['blood_group']; 
     $start_date = $_POST['start_date']; 
     $end_date = $_POST['end_date']; 
     $donation_type = $_POST['donation_type']; 
     $type = $_POST['type']; 
     $city = $_POST['city']; 
     $user = $_POST['user'];

        if (!empty($name) && !empty($user_no) && !empty($donor_type) && !empty($mobile)
        && !empty($blood_group) && !empty($donation_type) && !empty($city)
        && (!empty($start_date) && !empty($end_date))) {

          $query = $this->db->query("SELECT * FROM bl_bb_donatioform WHERE donation_date BETWEEN '$start_date' AND '$end_date' AND bl_bb_donatioform.bloodbank_id = '$bank_id' And bl_bb_donatioform.donor_name = '$name' And bl_bb_donatioform.unit_no = '$user_no' And bl_bb_donatioform.donor_type = '$donor_type' And bl_bb_donatioform.mobile = '$mobile' And bl_bb_donatioform.blood_group = '$blood_group' And bl_bb_donatioform.camp_status = '$donation_type' And bl_bb_donatioform.city = '$city' ORDER BY ID DESC");
  
      }else{

        if(!empty($name)){
          $search = "bl_bb_donatioform.donor_name = '$name'";
        }elseif(!empty($user_no)){
          $search = "bl_bb_donatioform.unit_no = '$user_no'";
        }elseif(!empty($donor_type)){
          $search = "bl_bb_donatioform.donor_type = '$donor_type'";
        }elseif(!empty($blood_group)){
          $search = "bl_bb_donatioform.blood_group = '$blood_group'";
        }elseif(!empty($donation_type)){
          $search = "bl_bb_donatioform.camp_status = '$donation_type'";
        

        // if(!empty($type)){
        //   $search = "bl_bb_donatioform.id = $app_id";
        // }

       }elseif(!empty($city)){
          $search = "bl_bb_donatioform.city = '$city'";
                  
        

        // if(!empty($user)){
        //   $search = "bl_bb_donatioform.id = $user";
        // }

        }elseif(!empty($start_date) && !empty($end_date)){
          $search = "donation_date BETWEEN '$start_date' AND '$end_date'";
        }

         $query = $this->db->query("SELECT * FROM bl_bb_donatioform  WHERE bl_bb_donatioform.bloodbank_id = '$bank_id' And $search ORDER BY ID DESC");

      }
    }else{
       $query = $this->db->query("SELECT * FROM bl_bb_donatioform  WHERE bl_bb_donatioform.bloodbank_id = '$bank_id' ORDER BY ID DESC"); }
             foreach ($query->result() as $row) {
           
               
                $no++;
              // print_r($row);
         ?>
  
              <tr>
                  <th scope="row"><?=$no ?></th>
                  <td style="text-transform: capitalize;"><?=$row->donor_name ?></td>
                  <td></td>
                  <td style="text-transform: capitalize;"><?=$row->unit_no ?></td>
                  <td style="text-transform: capitalize;"><?=$row->tube ?></td>                 
                  <td  style="text-transform: capitalize;"><?=$row->mobile ?></td>
                  <td style="text-transform: capitalize;"><?=$row->donor_type ?></td>
                  <td style="text-transform: capitalize;"><?=$row->blood_group ?></td>
                  <td style="text-transform: capitalize;"><?=$row->donation_date ?></td>
                  <td style="text-transform: capitalize;"><?=$row->camp_status ?></td>
                  <td style="text-transform: capitalize;"><?=$row->place ?></td>
                  <td></td>
                  <td></td>
                  
       <?php 
   if ($_SESSION['admin_type'] =='0') {
$servies_per = $_SESSION['bloodbank_user_servies_permission'];
        $per = json_decode($servies_per);

        if ($per->Request_permission  =='Write') {
             
   ?>
   <td><?php echo '<a href="'.$this->data['base_url'].'/donations/donationform/'.$row->id.'" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$row->id.');" ><i class="fa fa-trash"></i></button>'; ?></td>
<?php }
}else{?>
 <td><?php echo '<a href="'.$this->data['base_url'].'/donations/donationform/'.$row->id.'" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$row->id.');" ><i class="fa fa-trash"></i></button>'; ?></td>
<?php } ?>

                   
</tr>
<?php } ?>
</tbody>
</table>
</div>
<script>
$(document).ready( function () {
$('#myTable').DataTable();
} );
</script>

<!-- <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Appontments</h3>
      </div>

      <div class="card-body">
        <table id="table_blood_appointment" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Patient Name</th>
            <th>Registration No.</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Blood Group</th>
            <th>Action</th>
          </tr>
          </thead>
        
        </table>
      </div>

    </div>

  </div>

  <script type="text/javascript">
    var apppointment_search='<?php echo $base_url;?>/request/blood_appointment_search';
    // var deleteSingleData='<?php echo $base_url;?>/donations/deleteSingleData';
  </script> -->
<script type="text/javascript">

  function deleteFun(id){
// alert(id);


    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/request/blood_appointment_delete',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data Delete Successfully');
                     $('#table_blood_appointment').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }


</script>