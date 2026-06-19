<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<style>
    /* Font size */
    #table_bb_details {
        font-size: 13px; /* Adjust the font size as needed */
    }

    /* Row height */
    #table_bb_details tbody tr {
        height: 40px; /* Adjust the row height as needed */
    }

    /* Cell padding */
    #table_bb_details td, #table_bb_details th {
        padding: 5px; /* Adjust cell padding as needed */
    }

    /* ########## */
    
    #table_bb_deffer {
        font-size: 13px; 
    }

    #table_bb_deffer tbody tr {
        height: 40px; 
    }

    #table_bb_deffer td, #table_bb_deffer th {
        padding: 5px; 
    }

     /* ########## */
    
     #table_bb_request {
        font-size: 13px; 
    }

    #table_bb_request tbody tr {
        height: 40px; 
    }

    #table_bb_request td, #table_bb_request th {
        padding: 5px; 
    }

    /* ########## */
    
    #table_bb_request_met {
        font-size: 13px; 
    }

    #table_bb_request_met tbody tr {
        height: 40px; 
    }

    #table_bb_request_met td, #table_bb_request_met th {
        padding: 5px; 
    }

     /* ########## */
    
     #table_bb_issue {
        font-size: 13px; 
    }

    #table_bb_issue tbody tr {
        height: 40px; 
    }

    #table_bb_issue td, #table_bb_issue th {
        padding: 5px; 
    }
    /* ########## */
    
    #table_bb_camp {
        font-size: 13px; 
    }

    #table_bb_camp tbody tr {
        height: 40px; 
    }

    #table_bb_camp td, #table_bb_camp th {
        padding: 5px; 
    }
      /* ########## */
    
      #table_bb_donar_app {
        font-size: 13px; 
    }

    #table_bb_donar_app tbody tr {
        height: 40px; 
    }

    #table_bb_donar_app td, #table_bb_donar_app th {
        padding: 5px; 
    }
      /* ########## */
    
      #table_bb_req_app {
        font-size: 13px; 
    }

    #table_bb_req_app tbody tr {
        height: 40px; 
    }

    #table_bb_req_app td, #table_bb_req_app th {
        padding: 5px; 
    }


</style>

<section class="content-header">
<div class="container">
 <div class="timeline">
   <!-- <div class="time-label">
      <span class="bg-red">Consumables Items</span>
      </div> -->
   <div class="card">
      
   <div class="card-body">
      
      <div class="container-fluid pb-3">
         
         <?php 
            $admin_id = $_SESSION['admin_type'];
           ?>

         <div class="row" style="">
           
           <!-- --------------- -->
            <div class="row col-12" >
            <div class="col-12 mb-50">
                  <div class="cards">
                     <div class="card-headers">
                        <b class="card-titles">Total Blood Issue</b>&nbsp;
                        <!--<a id="downloadMET_BLINV_excelLink" href="#" style="text-decoration: underline; color: #0D2942;">Download  Excel</a>-->

                     </div>
                     <!-- /.card-header -->
                     <div class="card-bodys">
                        <table id="table_bb_issue" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Blood Bank</th>
                                 <th>Whole Blood</th>
                                 <th>PRC/ Packed Cell</th>
                                 <th>RDP/SDP</th>
                                 <th>FFP/Plasma</th>
                                 <th>Total</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                        <a href="#" id="load_more_link_bb_inv">View More</a>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
   var bb_inv_search = '<?php echo $base_url; ?>/total_blood_issue_search';

//   excel URLS---------------
var bb_inv_search_excel = '<?php echo $base_url; ?>/bb_inv_search_excel';

//------------------------------------------
//var days_filter = 0;
function reloadDataTable() {

  var tableinv = $('#table_bb_issue').DataTable();
        tableinv.ajax.url(bb_inv_search).draw();

}
$(document).ready(function () {
// ------------- link for 
var tableinv = $('#table_bb_issue').DataTable({
        'bJQueryUI': false,
        'stateSave': false,
        'iDisplayLength': 3,
        'responsive': true,
        "pagingType": "full_numbers",
        "rowReorder": false,
        'language': {
            'paginate': {
                'first': "<<", // This is the link to the first page
                'previous': "<", // This is the link to the previous page
                'next': ">", // This is the link to the next page
                'last': ">>" // This is the link to the last page
            },
            "info": ""
        },
        "lengthMenu": [[3, 10, 25, 50, 100, 250, 500], [3, 10, 25, 50, 100, 250, 500]],
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": bb_inv_search,
            "type": "POST",
            "data": function (d) {
                d[csrf_name] = csrf_hash;
                d.days_filter = $('#daysfillter').val(); // Pass selected days filter value
                d.start_date = $('#start_date').val(); // Pass selected start date value
                d.end_date = $('#end_date').val(); // Pass selected end date value
            }
        },
        "autoWidth": false,
        "searching": false, // Disable search
        "lengthChange": false,
        "columnDefs": [
            {
                "targets": 1, // Second column
                "width": "100px" // Set the width of the second column
            },
            {
                "targets": [0, 5], //first column / numbering column
                "orderable": false, //set not orderable
            }
        ],
        "initComplete": function (settings, json) {
            $('#table_bb_issue_paginate').hide();
        },
        "drawCallback": function (settings) {
            toggleLoadLinkbloodinv();
            if (tableinv.page.info().pages > 1) {
                $('#table_bb_issue_paginate').show();
            } else {
                $('#table_bb_issue_paginate').hide();
            }
        }
    });
    function toggleLoadLinkbloodinv() {
        var totalRecords5 = tableinv.page.info().recordsTotal;
        var currentLength5 = tableinv.page.len();
        var link = $('#load_more_link_bb_inv');
        if (currentLength5 < totalRecords5) {
            link.text('View More');
        } else {
            link.text('View Less');
        }
    }
    $('#load_more_link_bb_inv').on('click', function (event) {
        event.preventDefault();
        var currentLength5 = tableinv.page.len();
        var totalRecords5 = tableinv.page.info().recordsTotal;
    
        if (currentLength5 < totalRecords5) {
            tableinv.page.len(currentLength5 + 3).draw();
        } else {
            tableinv.page.len(3).draw();
        }
        toggleLoadLinkbloodinv();
    });
    toggleLoadLinkbloodinv();

});

</script>
