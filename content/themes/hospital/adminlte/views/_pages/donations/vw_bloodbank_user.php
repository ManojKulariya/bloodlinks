<style type="text/css">
  .content-wrapper {
    background: #fff;
    text-transform: capitalize;
  }

  .content-header h1 {
    font-size: 18px;
    /* margin: 0 20px; */
    font-weight: bold;
  }

  .page-item.active .page-link {
    background-color: #dc3545;
    border-color: #dc3545;
  }
</style>

<?php defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Blood Bank User </h3>
        <div class="btn-group" style="float: right;">
          <a href="<?php echo $base_url; ?>/donations/bloodbank_user/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table_bloodbank_user" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Roll</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>sign</th>
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
    var apppointment_search = '<?php echo $base_url; ?>/donations/bloodbank_user_search';
    // var deleteSingleData='<?php echo $base_url; ?>/donations/deleteSingleData';
  </script>
  <script type="text/javascript">
    function deleteFun(id) {
      // alert(id);


      if (confirm('Are you sure') == true) {

        $.ajax({

          url: '<?php echo $base_url; ?>/donations/bloodbank_user_delete',
          method: "POST",
          datatype: "json",
          data: {
            [csrf_name]: csrf_hash,
            id: id
          },

          success: function(d) {
            // console.log (d);
            if (d == 1) {
              alert('Data Delete Successfully');
              $('#table_bloodbank_user').DataTable().ajax.reload();
            } else {
              alert('Delete Fail');
            }
          }
        })
      }
    }
  </script>