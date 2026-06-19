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
.page-link {
    color: #000;
}
</style>

<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(isset($_POST['submit'])){

 print_r($_POST); die;
  $masters_value = $_POST['masters_value'];
  $masters_status = $_POST['masters_status'];

  $update  = $this->db->query("UPDATE googleapi SET api_link = '$masters_value', state_status = '$masters_status' WHERE id = '1'");
// echo $this->db->insert_id();die;
  if($update ==true){
    // echo 'hiii';
    // die();
    redirect('admin/settings/google_api');

  } else{
    echo "fail";
  }
}?>
<div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Google API</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table_googleapi" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>API Key</th>
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
        <h3 class="card-title">API Key</h3>
      </div>
      <!-- /.card-header -->
      <form action = "<?php $_PHP_SELF ?>" method = "POST">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">        <div class="card-body">
          <div class="form-group">
            <label for="masters_value">API Key</label>
            <input type="text" class="form-control" id="masters_value" name="masters_value" placeholder="Enter API Key">
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
            <button type="submit" class="btn btn-sm btn-danger" name="submit"><i class="fas fa-save fw"></i> Save</button>
          </div>
        </div>
      </form>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>


</div>

<script type="text/javascript">
  var states_search_url='<?php echo $base_url;?>/settings/onSearchGoogle_api';
</script>