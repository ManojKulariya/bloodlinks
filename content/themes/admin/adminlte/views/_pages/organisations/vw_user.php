<style type="text/css">
  .content-header h1 {
    font-size: 18px;
    margin: 0 6px;
    font-weight: bold;
}
.page-item.active .page-link {
    background-color: #ad1e1d !important;
    border-color: #ad1e1d !important;
}
 table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
     padding-right: 15px; 
    font-size: 12px;
}
table.dataTable tbody th, table.dataTable tbody td {
    padding: 6px !important;
    font-size: 14px;
}
.btn-xs {
    padding: 2px;
    font-size: 10px;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 0 15px !important;
}
.btn-group h6 {
    font-weight: 500;
    margin: 5px 10px 0;
}
.content-wrapper {
    background: #fff;
        text-transform: capitalize;
}
table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child:before {
    background-color: #ad1e1d;
}
</style>

<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Superadmin User </h3>
         <div class="btn-group" style="float: right;">
          <h6>Add Superadmin User</h6>
          <a href="<?php echo $base_url;?>/user/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table_user" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Roll</th>
            <th>Mobile</th>
            <th>Email</th>
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
    var apppointment_search='<?php echo $base_url;?>/user_search';
    // var deleteSingleData='<?php echo $base_url;?>/donations/deleteSingleData';
  </script>
<script type="text/javascript">

  function deleteFun(id){
// alert(id);

    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/user_delete',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data Delete Successfully');
                     $('#table_user').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }

</script>