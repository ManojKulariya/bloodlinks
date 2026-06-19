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
    
    #table_bb_pendding_app {
        font-size: 13px; 
    }

    #table_bb_pendding_app tbody tr {
        height: 40px; 
    }

    #table_bb_pendding_app td, #table_bb_pendding_app th {
        padding: 5px; 
    }

     /* ########## */
    
     #table_bb_inv {
        font-size: 13px; 
    }

    #table_bb_inv tbody tr {
        height: 40px; 
    }

    #table_bb_inv td, #table_bb_inv th {
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
   
   <div class="card">
      
   <div class="card-body">
      
      <div class="container-fluid pb-3">
        
         <?php 
           
            $admin_id = $_SESSION['admin_type'];
           ?>

         <div class="row" style="">
           
           <div class="col-12">
           <section class="content-header" style="padding-bottom :5px;">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1></h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
					<!-- date rage  -->
					<div class="dropdown">
					<div class="dropdown-btn-container">
					<i class="fa fa-calendar"></i>
					<button onclick="toggleDropdown()" class="dropbtn">Selected:</button>
					</div>
					<div id="dropdownContent" class="dropdown-content">
					<div onclick="selectTimeRange(0)">Today</div>
					<div onclick="selectTimeRange(10)">Last 10 Days</div>
					<div onclick="selectTimeRange(30)">Last 30 Days</div>
					<div onclick="selectTimeRange(60)">Last 60 Days</div>
					<div onclick="selectTimeRange(90)">Last 90 Days</div>
					<div class="custom-date-range">Custom Date Range</div>
					<input type="text" id="customRangePicker" style="display: none;" />
					</div>
					</div>
					<script>
					function toggleDropdown() {
					var dropdownContent = document.getElementById("dropdownContent");
					dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
					}
					function selectTimeRange(range) {
					var dropdownContent = document.getElementById("dropdownContent");
					var dropdownButton = document.querySelector(".dropbtn");
					if(range == 0){
					ranges = "Selected: Today"
					var  daysfilter = 0;
					}else{
					var  daysfilter = range;
					ranges = "Selected: Last "+range+" Days";
					}
					$('#daysfillter').val();
					$('#start_date').val("");
					$('#end_date').val("");
					dropdownButton.textContent = ranges;
					dropdownContent.style.display = "none"; // close the dropdown after selection
					reloadDataTable();
					}
					document.querySelector('.custom-date-range').addEventListener('click', function() {
					var datePickerInput = document.getElementById('customRangePicker');
					datePickerInput.style.display = 'block';
					$(datePickerInput).daterangepicker({
					opens: 'up',
					});
					$(datePickerInput).on('apply.daterangepicker', function(ev, picker) {
					var startdate = picker.startDate.format('YYYY-MM-DD');
					var enddate = picker.endDate.format('YYYY-MM-DD');
					$('#start_date').val(startdate);
					$('#end_date').val(enddate);
					var selectedRange = startdate + ' to ' + enddate;
					reloadDataTable();

					var dropdownButton = document.querySelector(".dropbtn");
					dropdownButton.textContent = "Selected: " + selectedRange;
					dropdownContent.style.display = "none"; // close the dropdown after selection
					});
					});
					</script>
          <?php 
          $enddate = new DateTime();
          $startdate = (clone $enddate)->modify('-1 year');
          $enddateFormatted = $enddate->format('Y-m-d');
          $startdateFormatted = $startdate->format('Y-m-d');
          ?>
					<input type="hidden" name="daysfillter" id="daysfillter" value="">
					<input type="hidden" name="start_date" id="start_date" value="<?php echo $startdateFormatted;?>">
					<input type="hidden" name="end_date" id="end_date" value="<?php echo $enddateFormatted;?>">
					<!-- end date range -->   
				
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
	    </section>
         </div>
           <!-- --------------- -->
            <div class="row col-12" >
            <div class="col-12 mb-3">
                  <div class="cards">
                     <div class="card-headers">
                        <b class="card-titles">Total Pending Appointment</b>&nbsp;
                        <!--<a id="downloadMET_req_BL_excelLink" href="#" style="text-decoration: underline; color: #0D2942;">Download Excel</a>-->
                     </div>
                     <!-- /.card-header -->
                     <div class="card-bodys">
                        
                        <table id="table_bb_pendding_app" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Blood Bank</th>
                                 <th>A+</th>
                                 <th>B+</th>
                                 <th>A-</th>
                                 <th>B-</th>
                                 <th>AB+</th>
                                 <th>AB-</th>
                                 <th>O+</th>
                                 <th>O-</th>
                                 <th>Total</th>
                              </tr>
                           </thead>
                           <tbody>

                           </tbody>
                        </table>
                        <a href="#" id="load_more_link_bb_met">View More</a>

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
var bb_request_met_search = '<?php echo $base_url; ?>/bb_pending_app_search';

//   excel URLS---------------
var bb_request_met_excel = '<?php echo $base_url; ?>/bb_request_met_excel';

//------------------------------------------
//var days_filter = 0;
function reloadDataTable() {
   
  var tablereqmet = $('#table_bb_pendding_app').DataTable();
  tablereqmet.ajax.url(bb_request_met_search).draw();

}
$(document).ready(function () {
// ------------------ link for blood met
var tablereqmet = $('#table_bb_pendding_app').DataTable({
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
            "url": bb_request_met_search,
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
                "targets": [0, 10], //first column / numbering column
                "orderable": false, //set not orderable
            }
        ],
        "initComplete": function (settings, json) {
            // Hide pagination controls initially
            $('#table_bb_pendding_app_paginate').hide();
        },
        "drawCallback": function (settings) {
            toggleLoadLinkbloodreqmet();
            if (tablereqmet.page.info().pages > 1) {
                $('#table_bb_pendding_app_paginate').show();
            } else {
                $('#table_bb_pendding_app_paginate').hide();
            }
        }
    });
    function toggleLoadLinkbloodreqmet() {
        var totalRecords4 = tablereqmet.page.info().recordsTotal;
        var currentLength4 = tablereqmet.page.len();
        var link = $('#load_more_link_bb_met');
        if (currentLength4 < totalRecords4) {
            link.text('View More');
        } else {
            link.text('View Less');
        }
    }
    $('#load_more_link_bb_met').on('click', function (event) {
        event.preventDefault();
        var currentLength4 = tablereqmet.page.len();
        var totalRecords4 = tablereqmet.page.info().recordsTotal;
    
        if (currentLength4 < totalRecords4) {
            tablereqmet.page.len(currentLength4 + 3).draw();
        } else {
            tablereqmet.page.len(3).draw();
        }
        toggleLoadLinkbloodreqmet();
    });
    toggleLoadLinkbloodreqmet();

});

</script>
