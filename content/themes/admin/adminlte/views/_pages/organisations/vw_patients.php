<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All patients Request Form</h3>
       <!--   <div class="btn-group" style="float: right;">
          <a href="<?php echo $base_url;?>/request/request_form_add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div> -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table_allpatients" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Patient Name</th>
            <th>Request No.</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Blood Group</th>
            <th>Action</th>
          </tr>
          </thead>
        
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

  <script type="text/javascript">
    var apppointment_search='<?php echo $base_url;?>/petients_request_search';
  </script>
<script type="text/javascript">

  function deleteFun(id){
// alert(id);

    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/petients_request_delete',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data Delete Successfully');
                     $('#table_allpatients').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }
</script>