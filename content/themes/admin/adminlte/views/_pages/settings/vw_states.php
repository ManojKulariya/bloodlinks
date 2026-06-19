<style type="text/css">

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
</style>

<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">States</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table_states" class="table table-bordered table-hover">
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
  

  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">State Name</h3>
      </div>
      <!-- /.card-header -->
      <form role="form" id="form_bag_types">
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
            <button type="submit" class="btn btn-sm btn-danger" id="btn_save_bag_types"><i class="fas fa-save fw"></i> Save</button>
          </div>
        </div>
      </form>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>


</div>

<script type="text/javascript">
  var states_search_url='<?php echo $base_url;?>/settings/states_search';
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
                     $('#table_states').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }
</script> 
