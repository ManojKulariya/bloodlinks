<?php defined('BASEPATH') OR exit('No direct script access allowed');

?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>


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
                      <div class="card-headers mb-18">
                        <b class="card-titles mr-5">Total Volumn: <?= $totalFinalVol ?></b>&nbsp;<a href="export_handover_report" >Export Data</a>
                      </div>
                     <!-- /.card-header -->
                     <div class="card-bodys">
                        <table id="table_stock_report" class="table table-bordered table-hover" style="font-size:12px;">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Agency</th>
                                 <th>Issue No</th>
                                 <th>Component</th>
                                 <th>Blood Group</th>
                                 <th>Unit No.</th>
                                 <th>Volumn</th>
                                 <!--<th>Exp. Date</th>-->
                              </tr>
                           </thead>
                           <tbody>
                               <?php foreach($list as $in=>$row){ 
                               $rec = json_decode($row->stock_data)
                               ?>
                               <tr>
                                   <td><?= ++$in ?></td>
                                   <td><?= $row->a_name ?></td>
                                   <td><?= $row->issue_no ?></td>
                                   <td>FFP</td>
                                   <td><?= $rec[0]->blood_group; ?></td>
                                   <td><?= $rec[0]->unit_no ?></td>
                                   <td><?= $rec[0]->final_vol ?></td>
                               </tr>
                               <?php } ?>
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
 
</section>
<script>
$(document).ready(function() {
    $('#table_stock_report').DataTable({
        paging: true, // Enable pagination
        lengthChange: true, // Allow changing number of records per page
        pageLength: 15, // Set the default number of records per page
        searching: true, // Enable search functionality
        ordering: true, // Enable sorting
        order: [[0, 'asc']], // Default sort order (by the first column)
        dom: 'Bfrtip', // Define the table control elements (buttons, filter, etc.)
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print' // Define the buttons to export data
        ]
    });
});
</script>

