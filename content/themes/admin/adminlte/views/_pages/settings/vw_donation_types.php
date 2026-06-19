<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Donation Types</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table_donation_types" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Type Name</th>
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
  

  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Donation Types</h3>
      </div>
      <!-- /.card-header -->
      <form role="form" id="form_donation_types">
        <input type="hidden" name="masters_id" id="masters_id">
        <div class="card-body">
          <div class="form-group">
            <label for="masters_value">Type Name</label>
            <input type="text" class="form-control" id="masters_value" name="masters_value" placeholder="Enter bag types name">
          </div>
          <div class="form-group">
            <label for="maters_status">Status</label>
            <select class="form-control" name="masters_status">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <div class="btn-group" style="float: right;">
            <button type="submit" class="btn btn-sm btn-danger" id="btn_save_donation_types"><i class="fas fa-save fw"></i> Save</button>
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
  var masters_add_url='<?php echo $base_url;?>/settings/masters_add';
</script>
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
                     $('#table_role').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }
</script>