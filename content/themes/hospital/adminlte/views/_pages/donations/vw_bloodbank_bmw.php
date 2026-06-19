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
          <a href="javascript:void(0)" 
               data-toggle="modal" 
               data-target="#bmwModal"
               title="Assign BMW" 
               class="btn btn-sm btn-outline-danger">
               <i class="fas fa-plus"></i>
            </a>

          <!--<a href="" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add BMW" style="float:right;"><i class="fas fa-plus"></i></a>-->
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table  class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>Address</th>
              <th>Pincode</th>
            </tr>
          </thead>
          <tbody>
              <?php if(!empty($assigned_bmws)) { foreach($assigned_bmws as $inx=>$assigned_bmw) { ?>
            <tr>
              <td><?php echo ++$inx ?></td>
              <td><?php echo $assigned_bmw->name; ?></td>
              <td><?php echo $assigned_bmw->email; ?></td>
              <td><?php echo $assigned_bmw->mobile; ?></td>
              <td><?php echo $assigned_bmw->address_1; ?></td>
              <td><?php echo $assigned_bmw->pincode ?></td>
            </tr>
            <?php } } ?>
          </tbody>

        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
<!-- BMW Selection Modal -->
<div class="modal fade" id="bmwModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Assign BMW</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <table id="table_bmw_list" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Select</th>
              <th>Name</th>
              <th>Address</th>
              <th>Pincode</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($bmws)) { foreach($bmws as $bmw) { ?>
            <tr>
              <td><input type="checkbox" class="bmw-check" value="<?php echo $bmw['id']; ?>"></td>
              <td><?php echo $bmw['name']; ?></td>
              <td><?php echo $bmw['address_1']; ?></td>
              <td><?php echo $bmw['pincode'] ?></td>
            </tr>
            <?php } } ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="assignBMW" class="btn btn-primary">Assign</button>
      </div>
    </div>
  </div>
</div>
<!-- jQuery CDN (Load First) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script type="text/javascript">
    var assign_bmw = '<?php echo $base_url; ?>/assign_bmw_to_user';
    
$(document).ready(function(){
  // Optional: initialize DataTable for modal
//   $('#table_bmw_list').DataTable();

  $('#assignBMW').click(function(){
    let selected = [];
    $('.bmw-check:checked').each(function(){
      selected.push($(this).val());
    });

    if(selected.length === 0){
      alert("Please select at least one BMW!");
      return;
    }

    $.ajax({
      url: assign_bmw,
      method: "POST",
      data: {bmw_ids: selected},
      success: function(response){
        $('#bmwModal').modal('hide');
        // Refresh your table
        location.reload();
      },
      error: function(){
        alert("Error assigning BMWs!");
      }
    });
  });
});
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
            //   $('#table_bloodbank_user').DataTable().ajax.reload();
            } else {
              alert('Delete Fail');
            }
          }
        })
      }
    }
  </script>