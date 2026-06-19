<style type="text/css">
  .content-wrapper {
    background: #fff;
    text-transform: capitalize;
}
.btn-group h6 {
    font-weight: 500;
    margin: 5px 10px 0;
}
.page-item.active .page-link {
    background-color: #dc3545;
    border-color: #dc3545;
}
li.breadcrumb-item a {
    color: #dc3545;
}
.content-header h1 {
    font-size: 18px;
    /* margin: 0 20px; */
    font-weight: bold;
}
table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child:before {
    background-color: #c91728;
}
</style>

<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Registered Blood Banks</h3>
        <div class="btn-group" style="float: right;">
          <h6>Add Blood Banks</h6>
          <a href="<?php echo $base_url;?>/bloodbanks/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table_bloodbanks" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>City</th>
            <th>State</th>
            <th>Boarding Type</th>
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
  <!-- /.col -->
</div>

<script type="text/javascript">
  var blood_banks_search_url='<?php echo $base_url;?>/bloodbanks_search';
  var blood_banks_del_url='<?php echo $base_url;?>/bloodbanks_delete';
</script>