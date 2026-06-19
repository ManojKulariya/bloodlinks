<style type="text/css">
   .card {
   height: 100%;
   }
   .content-wrapper {
   background: #fff;
   text-transform: capitalize;
   }
   .card-footer {
   background-color: #fff;
   }
   .page-item.active .page-link {
   background-color: #dc3545;
   border-color: #dc3545;
   }
   .content-header h1 {
   font-size: 20px;
   font-weight: bold;
   }
   .qc-area h4 {
   color: #dc3545;
   font-weight: 600;
   font-size: 22px;
   margin: 0 0 14px;
   }
  button.qc-btn {
    background: #dc3545;
    color: #fff;
    border: none;
    border-radius: 15px;
    padding: 2px 15px;
    float: right;
    margin-top: -50px;
}
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
   <div class="col-6">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Blood Groups</h3>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            <table id="table_component_types" class="table table-bordered table-hover">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Type Name</th>
                     <th>Short Code</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
            </table>
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
   </div>
   <?php
   $auth_id = $_SESSION['admin_type'];

if(isset($_POST['submit'])){
  // print_r($_POST); die;

  $masters_value = $_POST['masters_value'];
  $masters_short_value = $_POST['masters_short_value'];
  $masters_status = $_POST['masters_status'];
  $expiry_day = $_POST['expiry_day'];
  $min_volume = $_POST['min_volume'];
  $max_volume = $_POST['max_volume'];
  $masters_type = 'Components Types';
  $master_type_key = 'component_types';

  $insert = $this->db->query("INSERT INTO bl_masters (master_type_name, master_type_key, master_type_key_value, master_type_key_short_value, master_type_key_status , expiry_day , min_volume , max_volume) VALUES ( '$masters_type' , '$master_type_key' , '$masters_value', '$masters_short_value', '$masters_status' , '$expiry_day' , '$min_volume' , '$max_volume' )");
// echo $this->db->insert_id();die;
  if($insert==true){
    // echo 'hiii';
    // die();
    redirect('admin/settings/componenttypes');

  } else{
    echo "fail";
  }
}

?>
 <?php 
$id= $this->uri->segment(4);
// print_r($id);die();
if(!empty($id)){
$query1 = $this->db->query("SELECT * FROM bl_masters WHERE master_id = $id");
foreach ($query1->result() as $row)
{}}
 ?>
   <div class="col-6">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Components Types</h3>
         </div>
         <!-- /.card-header -->
         <form action = "<?php $_PHP_SELF ?>" method = "POST">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name="masters_id" value="<?php if(isset($row->master_id)) { echo $row->master_id;  } ?>" id="masters_id">
            <div class="card-body">
               <div>
                  <div class="form-group">
                     <label for="masters_value">Type Name</label>
                     <input type="text" class="form-control" id="masters_value" name="masters_value" value="<?php if(isset($row->master_type_key_value)) { echo $row->master_type_key_value;  } ?>" placeholder="Enter component types name">
                  </div>
                  <div class="form-group">
                     <label for="masters_short_value">Type Short Name</label>
                     <input type="text" class="form-control" id="masters_short_value" name="masters_short_value" value="<?php if(isset($row->master_type_key_short_value)) { echo $row->master_type_key_short_value;  } ?>" placeholder="Enter component types short name">
                  </div>
                  <div class="form-group">
                     <label for="maters_status">Status</label>
                     <select class="form-control" name="masters_status">
              <option value="active" <?= isset($row->master_type_key_status) && ($row->master_type_key_status === 'active')?  'selected':'' ?>>Active</option>
              <option value="inactive" <?= isset($row->master_type_key_status) && ($row->master_type_key_status === 'inactive')?  'selected':'' ?>>Inactive</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="maters_status">Expiry Day</label>
                     <input type="text" class="form-control" name="expiry_day" value="<?php if(isset($row->expiry_day)) { echo $row->expiry_day;  } ?>"placeholder="Expiry Day">
                  </div>
                  <div class="form-group">
                     <label for="maters_status">Min Volume</label>
                     <input type="text" class="form-control" name="min_volume" value="<?php if(isset($row->min_volume)) { echo $row->min_volume;  } ?>"placeholder="Min Volume">
                  </div>
                  <div class="form-group">
                     <label for="maters_status">Max Volume</label>
                     <input type="text" class="form-control" name="max_volume" value="<?php if(isset($row->max_volume)) { echo $row->max_volume;  } ?>"placeholder="Max Volume">
                  </div>
               </div>
             <!--   <div class="qc-area">
                  <h4>QC Field Master</h4>
                  <div id="users">
                     <div class="user">
                        <div class="row">
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <label for="maters_status">Field Name</label>
                                 <input name="fieldname" type="text" class="form-control">
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <label for="maters_status">Range From</label>
                                 <input name="rangefrom" type="text" class="form-control">
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <label for="maters_status">Calculation Type</label>
                                 <input name="calculationtype" type="text" class="form-control">
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="form-group">
                                 <label for="maters_status">Range To</label>
                                 <input name="rangeto" type="text" class="form-control">
                              </div>
                           </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                 <label for="maters_status">Range Unit</label>
                                 <select class="form-control" >
                                 <option value="ml">ML</option>
                                 <option value="mg">MG</option>
                                 <option value="%">%</option>
                              </select>
                              </div>
                           </div>

                        </div>
                     </div>
                     <button class="qc-btn" id='add-user'>Add more fields</button><br><br>   
                  </div>
               </div> -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
               <div class="btn-group" style="float: right;">
                   <button type="submit" name="<?php if(!empty($id)){echo 'update';}else{echo 'submit';}?>" class="btn btn-sm btn-danger"><i class="fas fa-save fw"></i> Save</button>
               </div>
            </div>
         </form>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
   </div>
</div>
<script type="text/javascript">
   var masters_search_url='<?php echo $base_url;?>/settings/masters_search';
   // var blood_group_del_url='<?php echo $base_url;?>/bloodbanks_delete';
   // var masters_add_url='<?php echo $base_url;?>/settings/masters_add';
</script>
<!-- <script>
   (function() {
    var button=document.getElementById("add-user");
    button.addEventListener('click', function(event) {
       event.preventDefault();
       var cln = document.getElementsByClassName("user")[0].cloneNode(true);
       document.getElementById("users").insertBefore(cln,this);
       return false;
    });
   })();
</script> -->
<script type="text/javascript">

  function deleteFun(id){
// alert(id);


    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/settings/masters_delete',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data Delete Successfully');
                     $('#table_component_types').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }
</script> 