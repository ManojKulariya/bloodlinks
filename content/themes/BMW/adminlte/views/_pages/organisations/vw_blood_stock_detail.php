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
   /* padding-right: 15px;  */
   font-size: 12px;
   }
   table.dataTable tbody th, table.dataTable tbody td {
   /* padding: 6px !important; */
   font-size: 14px;
   }
   .btn-xs {
   padding: 2px;
   font-size: 10px;
   }
   table.dataTable thead th, table.dataTable thead td {
   /* padding: 0 15px !important; */
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
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" id="start_date" value="<?php echo $start_date;?>" name="start_date">
                            </div>
                        </div>
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
        <h3 class="card-title">Blood Stock Detail</h3>&nbsp;
        <!-- <a id="downloadpendingReqexcel" href="#" style="text-decoration: underline; color: #0D2942;">Download
        Excel</a> -->

      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table_blood_stock" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Name / Contact</th>
            <th>Blood Group</th>
            <th>Components</th>
            <th>Volume</th>
            <th>Date of <br>Donation</th>
            <th>Expiry</th>
            <?php if($_SESSION['admin_type'] != 5){ ?>
            <th>Blood Bank</th>
            <? } ?>
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
  var b_stock_type = "<?php echo $b_stock_type; ?>";
  var dayfilter = "<?php echo $dayfilter; ?>";
  var start_date = "<?php echo $start_date; ?>";
  var end_date = "<?php echo $end_date; ?>";
  var bb_stock_detail_url = '<?php echo $base_url; ?>/bb_stock_detail_search';
  function reloadDataTable() {
    var table_blood_stock = $('#table_blood_stock').DataTable();
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    table_blood_stock.ajax.url(bb_stock_detail_url).draw();
  }
  function reset() {  
    location.reload();  
  }  
  $(document).ready(function () {
   var table_blood_stock =  $('#table_blood_stock').DataTable({ 
      'bJQueryUI': false,
      'stateSave': true,
      'iDisplayLength':50,
      'responsive': true,
      "pagingType": "full_numbers",
      "rowReorder":false,
      'language': {
        'paginate': {
          'first': "<<", // This is the link to the first page
          'previous': "<", // This is the link to the previous page
          'next': ">", // This is the link to the next page
          'last': ">>" // This is the link to the last page
        }
      },
      "lengthMenu": [[10,25,50,100,250,500], [10,25,50,100,250,500]],
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      "ajax": {
          "url": bb_stock_detail_url,
          "type": "POST",
          "data":function(d){
            d[csrf_name] = csrf_hash;
            d.bb_id=bb_id;
            d.b_stock_type=b_stock_type;
            d.dayfilter=dayfilter;
            d.start_date=start_date;
            d.end_date=end_date;
            d.name = $('#name').val();
            d.blood_group = $('#blood_group').val();
          }},
      "autoWidth": false,
      //Set column definition initialisation properties.
      "columnDefs": [
        {
          "targets": 1, // Second column
          "width": "130px" // Set the width of the second column
      },
      {
        "targets": 2, // Second column
        "width": "130px" // Set the width of the second column
        },{
          "targets": 3, // Second column
          "width": "130px" // Set the width of the second column
      },
      { 
          "targets": [0,4], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ],
     
    });
    $('#filter_data').on('click', function() {
      reloadDataTable();
    });
  });
</script>