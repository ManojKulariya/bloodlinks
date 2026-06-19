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
.form-control {
      height:2rem;
    font-size: 0.9rem;
    padding:0px;
   }
   label {
   font-size: 12px;
   }
   .form-group {
   margin-bottom: 0;
   }
</style>

<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Agency & Bank</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table_agency" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Type</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Address</th>
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
        <h3 class="card-title">Agency & Bank</h3>
      </div>
      <!-- /.card-header -->
      <form role="form" id="form_agency">
        <input type="hidden" name="masters_id" id="masters_id">
        <div class="card-body">
          <div class="form-group">
            <label for="a_name">Type</label>
            <select class="form-control" id="type" name="type">
              <option>Bank</option>
              <option>Agency</option>
            </select>
          </div>
          <div class="form-group">
            <label for="a_name">Name</label>
            <input type="text" class="form-control" id="a_name" name="a_name" placeholder="Enter Name">
          </div>
          <div class="form-group">
            <label for="a_name">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Name">
          </div>
          <div class="form-group">
            <label for="a_name">Contact</label>
            <input type="text" class="form-control" id="phon" name="phon" placeholder="Enter Name">
          </div>
          <div class="form-group">
            <label for="a_name">Address</label>
            <textarea class="form-control" id="address" name="address"></textarea>
          </div>
          
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <div class="btn-group" style="float: right;">
            <button type="submit" class="btn btn-sm btn-danger" id="btn_save_agency"><i class="fas fa-save fw"></i> Save</button>
          </div>
        </div>
      </form>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>


</div>

<script type="text/javascript">
  var agency_search_url='<?php echo $base_url;?>/settings/agency_search';
  // var blood_group_del_url='<?php echo $base_url;?>/bloodbanks_delete';
  var agency_add_url='<?php echo $base_url;?>/settings/agency_add';
</script>

<script type="text/javascript">
function editMaster(id, type, name, email, phon, address) {
    // Set the form fields with the data
    document.getElementById('masters_id').value = id;
    document.getElementById('type').value = type;
    document.getElementById('a_name').value = name;
    document.getElementById('email').value = email;
    document.getElementById('phon').value = phon;
    document.getElementById('address').value = address;
}
  function deleteagency(id){

    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/settings/ajency_delete',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data Delete Successfully');
                     $('#table_agency').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }
</script>