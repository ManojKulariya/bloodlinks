<style type="text/css">
   .content-wrapper {
   background: #fff;
   text-transform: capitalize;
   }
   .content-header h1 {
   font-size: 1.2rem !important;
   /* margin: 0 20px; */
   font-weight: 700 !important;
   }
   .card-footer {
   padding: 10px 20px;
   background-color: #fff;
   }
   .form-control {
      height:1.6rem;
    font-size: 0.9rem;
    padding:0px;
   }
   label {
   font-size: 12px;
   }
   .form-group {
   margin-bottom: 0;
   }
   table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
   padding-right: 15px; 
   font-size: 12px;
   }
   table.dataTable tbody th, table.dataTable tbody td {
   padding: 6px !important;
   font-size: 14px;
   }
   .btn-xs {
   padding: 2px;
   font-size: 10px;
   }
   table.dataTable thead th, table.dataTable thead td {
   padding: 0 15px !important;
   }
   .page-item.active .page-link {
   background-color: #dc3545;
   border-color: #dc3545;
   }
   .page-link {
   color: #000;
   }
   .capitalize{
   text-transform: capitalize;
   }
   label {
     margin-bottom: 0; 
}

</style>
<style type="text/css">
  .page-item.active .page-link {
    background-color: #ad1e1d;
    border-color: #ad1e1d;
}
.breadcrumb-item a {
    color: #ad1e1d;
}
.content-wrapper {
    background: #fff;
    text-transform: capitalize;
}
  .content-header h1 {
    font-size: 18px;
    /* margin: 0 20px; */
    font-weight: bold;
}
.content-wrapper {
    background: #fff;
    text-transform: capitalize;
}
.btn-group h6 {
    font-weight: 500;
    margin: 5px 10px 0;
}
table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child:before {
    background-color: #ad1e1d;
}
.btn-info {
    background-color: #ad1e1d;
    border-color: #ad1e1d;
}
.btn-info:hover {
    background-color: #ad1e1d;
    border-color: #ad1e1d;
}
</style>

<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
        <div class="timeline">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="blood_group">Blood Group</label>
                                <select name="blood_group" id="blood_group" class="form-control">
                                    <option  selected="selected" value="">Select</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">Test Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option selected="selected" value="">Select</option>
                                    <option value="Test done">Test done</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="test_result">Test Result</label>
                                <select name="test_result" id="test_result" class="form-control">
                                    <option disabled="disabled" selected="selected" value="">Select</option>
                                    <option value="Positive">Positive</option>
                                    <option value="Negative">Negative</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" id="start_date" value="<?php echo $start_date;?>" name="start_date">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        
                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="donation_type">Donation Type</label>
                                <select name="donation_type" id="donation_type" class="form-control">
                                    <option disabled="disabled" selected="selected" value="">Select</option>
                                    <option value="direct">Direct</option>
                                    <option value="camp">Camp</option>
                                </select>
                            </div>
                        </div> -->

                      
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" id="end_date" value="<?php echo $end_date;?>" name="end_date">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="card-footer">
                                <div class="btn-group" style="float: left;">
                                    <button class="btn btn-sm btn-success" id="filter_data">Filter</button>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-2">
                            <div class="card-footer">
                                <div class="btn-group" style="float: right;">
                                    <button class="btn btn-sm btn-danger"  onclick="reset()">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><?php echo $listtitle;?></h3> &nbsp;
        <a id="downloaddonorexcel" href="#" style="text-decoration: underline; color: #0D2942;">Download
        Excel</a>

      </div>
      
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table_bg" style="width:100%;" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Blood Group</th>
            <th>Lasted Donated</th>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
  var bb_id = <?php echo $bb_id;?>;
  var d_type = "<?php echo $d_type; ?>";
  var g_type = "<?php echo $g_type; ?>"; 
  var dayfilter = "<?php echo $dayfilter; ?>";
  var start_date = "<?php echo $start_date; ?>";
  var end_date = "<?php echo $end_date; ?>";
  var bg_search_url='<?php echo $base_url;?>/bg_search'; 
  var bg_search_excel_url='<?php echo $base_url;?>/bg_search_excel'; 
  function reloadDataTable() {
    var table_bg = $('#table_bg').DataTable();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    table_bg.ajax.url(bg_search_url).draw();
  }
  function reset() {  
    location.reload();  
    }  
  $(document).ready(function () {
    var table_bg = $('#table_bg').DataTable({ 
      'bJQueryUI': false,
      'stateSave': true,
      'iDisplayLength': 50,
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
      "columns": [
            { "width": "20%" }, 
            { "width": "20%" },  // Set width for first column
            { "width": "20%" },  // Set width for second column
            { "width": "20%" },  // Set width for third column
            { "width": "20%" }   // Set width for fourth column
        ],
      "lengthMenu": [[10, 25, 50, 100, 250, 500], [10, 25, 50, 100, 250, 500]],
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        "url": bg_search_url,
        "type": "POST",
        "data": function(d) {
          d.bb_id = bb_id;
          d.d_type = d_type;
          d.g_type = g_type;
          d.dayfilter = dayfilter;
          d.start_date = $('#start_date').val();;
          d.end_date = $('#end_date').val();;
          d.name = $('#name').val();
          d.blood_group = $('#blood_group').val();
          d.status = $('#status').val();
          // d.test_result = $('#test_result').val();
          // d.donation_type = $('#donation_type').val();
          d[csrf_name] = csrf_hash; // Assuming csrf_name and csrf_hash are defined elsewhere
        }
      },
      "columnDefs": [
        { 
          "targets": [0, 4],
          "orderable": false,
        }
      ],
    });
    
    $('#filter_data').on('click', function() {
      reloadDataTable();
    });
   
  });

</script>