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
  <div class="modal fade" id="paymentModal" tabindex="-1">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
    
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title">Approve Payment</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
    
          <div class="modal-body">
            <form id="paymentForm">
              <input type="hidden" name="user_id" id="pay_user_id">
    
              <div class="form-group">
                <label>Amount Paid</label>
                <input type="number" name="amount" class="form-control" required>
              </div>
              
              <div class="form-group">
                <label>EXP. Date</label>
                <input type="date" name="exp_date" class="form-control"  min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
              </div>
            </form>
          </div>
    
          <div class="modal-footer">
            <button class="btn btn-success btn-sm" id="savePayment">Save</button>
            <button class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
          </div>
    
        </div>
      </div>
    </div>

  <!-- /.col -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
  var blood_banks_search_url='<?php echo $base_url;?>/bloodbanks_search';
  var blood_banks_del_url='<?php echo $base_url;?>/bloodbanks_delete';
  $(document).on('click', '.btn-payment', function () {
        $('#pay_user_id').val($(this).data('user_id'));
        $('#paymentModal').modal('show');
    });
    
    $('#savePayment').click(function () {
    
        $.ajax({
            url: '<?php echo $base_url;?>/approve_payment',
            type: 'POST',
            data: $('#paymentForm').serialize(),
            success: function () {
                $('#paymentModal').modal('hide');
                location.reload();
            }
        });
    
    });
</script>