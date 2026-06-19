<?php defined('BASEPATH') OR exit('No direct script access allowed');

// print_r($bloodbank[0]['short_name']);die();
?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<section class="content-header">
<div class="container">
 <div class="timeline">
   <div class="card">
    <div class="card-body">
      <div class="container-fluid pb-3">
         <?php $admin_id = $_SESSION['admin_type'];    ?>
         <div class="row" style="">          
           <!-- --------------- -->
            <div class="row col-12" >
                <div class="col-12 mb-50">
                  <div class="cards">
                      <div class="card-headers">
                        <b class="card-titles">Stock HandOver to BMW</b>
                      </div>
                     <!-- /.card-header -->
                     <div class="card-bodys">
                        <table id="table_stock_handover" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Hospital Name</th>
                                 <th>Discard No</th>
                                 <th>Component</th>
                                 <th>Blood Group</th>
                                 <th>Unit No.</th>
                                 <th>Date</th>
                                 <th>BMW Status</th>
                                 <th>Dispose</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>

              
            </div>
         

</div>

      </div>
<div class="modal fade" id="bmwStatusModal" tabindex="-1" role="dialog" aria-labelledby="bmwStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update BMW Status</h5>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <select class="form-control" id="bmw_status_select">
          <option value="Pending">Pending</option>
          <option value="Reached">Reached</option>
          <option value="Not Reached">Not Reached</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save_bmw_status">Save</button>
        <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
      </div>
    </div>
  </div>
</div>
   </div>
  <!-- BMW Status Modal -->



</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
 
  var hp_stock_over_view_search = '<?php echo $base_url; ?>/hp_stock_over_view_search';
  var update_bmw_status = '<?php echo $base_url; ?>/update_bmw_status';
//------------------------------------------

function ins() {
    var table_handover = $('#table_stock_handover').DataTable({
        'bJQueryUI': false,
        'stateSave': false,
        'iDisplayLength': 15,
        'responsive': true,
        "pagingType": "full_numbers",
        "rowReorder": false,
        'language': {
            'paginate': {
                'first': "<<",
                'previous': "<",
                'next': ">",
                'last': ">>"
            }
        },
        "lengthMenu": [[15, 50, 100, 250, 500], [15, 50, 100, 250, 500]],
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": hp_stock_over_view_search,
            "type": "POST",
            "data": function (d) {
                d[csrf_name] = csrf_hash;
                d.status = 'Ajency';
            },
        },
        "autoWidth": false,
        "searching": true,
        "lengthChange": false,
        "columnDefs": [
            {
                "targets": [0,6],
                "orderable": false,
            },{
                "targets": 7, // BMW Status column
                "render": function (data, type, row) {
                    let id = row[0];
                    let status = row[7];
                    if(status === 'Complete') {
                        return status; // just show the text
                    }else{
                       return `
                        ${status}<br>
                        <a href="/BMW/update_bmw_req/${id}/Complete" 
                           class="btn btn-sm btn-success">
                           Yes
                        </a>
                        <a href="/BMW/update_bmw_req/${id}/Not_Complete" 
                           class="btn btn-sm btn-danger">
                           No
                        </a>`; 
                    }
                    
                }
            },
            {
                "targets": 8, // BMW Status column
                "render": function (data, type, row) {
                    let id = row[0];
                    let status = row[7];
                    let dispose = row[8];
                    if(status == 'Complete') {
                        if(dispose == "Yes"){
                             return `${dispose}`; 
                        }else{
                           return `
                            ${dispose}<br>
                            
                            <a href="/BMW/update_bmw_req_dispose/${id}/Yes" 
                               class="btn btn-primary btn-sm"">
                               Yes
                            </a>`;   
                        }
                       
                    }else{
                       return '--';
                    }
                    
                }
            }
        ]
    });

}
 // Handle click for status button
    $('#table_stock_handover').on('click', '.update-status-btn', function() {
        let id = $(this).data('id');
        let status = $(this).data('status');
 
        $('#bmwStatusModal').data('id', id);
        $('#bmwStatusModal select').val(status);
        $('#bmwStatusModal').modal('show');
    });
$(document).ready(function () {
  ins();
  });
$('#save_bmw_status').on('click', function() {
   
    let id = $('#bmwStatusModal').data('id');
    let status = $('#bmw_status_select').val();
    
    $.ajax({
        url: update_bmw_status, // create this route
        type: 'POST',
        data: {
            id: id,
            bmw_status: status,
            [csrf_name]: csrf_hash
        },
        success: function(res) {
            $('#bmwStatusModal').modal('hide');
            $('#table_stock_handover').DataTable().ajax.reload(null, false);
        },
        error: function() {
            alert('Failed to update status.');
        }
    });
});

</script>
