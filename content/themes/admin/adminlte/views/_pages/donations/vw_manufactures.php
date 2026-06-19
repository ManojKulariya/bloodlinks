
<style type="text/css">
.content-header h1 {
    font-size: 18px;
    margin: 0 6px;
    font-weight: bold;
}
.content-wrapper {
    background: #fff;
        text-transform: capitalize;
}
.card-footer {
    background-color: #fff;
  }
  .card {
    height: 100%;
}
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed');
$bloodbank_id = $_SESSION['bank_id'];
if(isset($_POST['submit'])){

 //print_r($_POST); die;
  $vendor_name = $_POST['vender_name'];
  $masters_status = $_POST['masters_status'];
  $masters_type = 'Manufacture';
  $master_type_key = 'manufacture';


  $insert = $this->db->query("INSERT INTO bl_bloodbank_master ( bloodbank_id, master_type_name, master_type_key, master_type_key_value, master_type_key_status ) VALUES ( '$bloodbank_id', '$masters_type' , '$master_type_key' , '$vendor_name', '$masters_status' )");
// echo $this->db->insert_id();die;
  if($insert==true){
    // echo 'hiii';
    // die();
    redirect('admin/donations/manufactures');

  } else{
    echo "fail";
  }
}
// $uris= $this->uri->segment(5);
if(isset($_POST['update'])){

 //print_r($_POST); die;
  $vender_name = $_POST['vender_name'];
  $masters_status = $_POST['masters_status'];
  $id = $_POST['masters_id'];
  $update = $this->db->query("UPDATE bl_bloodbank_master SET master_type_key_value = '$vender_name', master_type_key_status = '$masters_status' WHERE master_id = '$id'");
    if($update==true){
    // echo 'hiii';
    // die();
    redirect('admin/donations/manufactures');

  } else{
    echo "fail";
  }
}
?>
<div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Manufacture Details</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table_manufactures" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
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
$id= $this->uri->segment(5);
// print_r($id);die();
if(!empty($id)){
$query1 = $this->db->query("SELECT * FROM bl_bloodbank_master WHERE master_id = $id");
foreach ($query1->result() as $row)
{}}
 ?>
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Manufacture Details</h3>
      </div>
      <!-- /.card-header -->
      <form action = "<?php $_PHP_SELF ?>" method = "POST">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <input type="hidden" name="masters_id" value="<?php if(isset($row->master_id)) { echo $row->master_id;  } ?>" id="masters_id">
        <div class="card-body">
          <div class="form-group">
            <label for="masters_value">Name</label>
          <input type="text" class="form-control" name="vender_name" value="<?php if(isset($row->master_type_key_value)) { echo $row->master_type_key_value;  } ?>" id="vender_name" placeholder="Enter Name">
          </div>
          <div class="form-group">
            <label for="maters_status">Status</label>
            <select class="form-control" name="masters_status">
             <option disabled="disabled" selected="selected" value="">Select</option>
             <option value="active" <?= isset($row->master_type_key_status) && ($row->master_type_key_status === 'active')?  'selected':'' ?>>Active</option>
              <option value="inactive" <?= isset($row->master_type_key_status) && ($row->master_type_key_status === 'inactive')?  'selected':'' ?>>Inactive</option>
            </select>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <div class="btn-group" style="float: right;">
           <button type="submit" name="<?php if(!empty($id)){echo 'update';}else{echo 'submit';}?>" class="btn btn-sm btn-danger" id="btn_save_basic_details"><i class="fas fa-save fw"></i> Save</button>
          </div>
        </div>
      </form>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>


</div>

<script type="text/javascript">
  var apppointment_search='<?php echo $base_url;?>/donations/manufactures_search';
</script>
<script type="text/javascript">

  function deleteFun(id){
// alert(id);


    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/donations/manufactures_delete',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data Delete Successfully');
                     $('#table_manufactures').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }
</script>