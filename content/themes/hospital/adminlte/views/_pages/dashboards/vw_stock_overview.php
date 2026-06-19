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
                        <b class="card-titles">Discard send to BMW</b>
                      </div>
                     <!-- /.card-header -->
                     <div class="card-bodys">
                        <table id="table_stock_handover" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                <th>#</th>
                                <th>BMW</th>
                                    <th>Patient Name</th>
                                    <th>Volume</th>
                                <!--<th>Issue No</th>-->
                                <th>Component</th>
                                <th>Blood Group</th>
                                <th>Unit No.</th>
                                <th>Date</th>
                                <th>Discard No</th>
                                <th>Discard why</th>
                                <th>BMW Status</th>
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
   </div>
   <!-- </div>/.container-fluid -->
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
 
  var hp_stock_over_view_search = '<?php echo $base_url; ?>/hp_stock_over_view_search';
//------------------------------------------

function ins() {
    var table_handover = $('#table_stock_handover').DataTable({
        'bJQueryUI': false,
        'stateSave': false,
        "processing": true,
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
                "targets": [0,5],
                "orderable": false,
            }
        ]
    });

}

$(document).ready(function () {
  ins();
  });

</script>
