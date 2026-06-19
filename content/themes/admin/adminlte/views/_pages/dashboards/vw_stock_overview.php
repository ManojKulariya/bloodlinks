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
                        <b class="card-titles">Stock HandOver to Agency</b>&nbsp;<a href="bb_stock_over_report">View Stock HandOver Report</a>
                      </div>
                     <!-- /.card-header -->
                     <div class="card-bodys">
                        <table id="table_stock_handover" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Agency</th>
                                 <th>Issue No</th>
                                 <th>Component</th>
                                 <th>Blood Group</th>
                                 <th>Unit No.</th>
                                 <th>Fraction Date</th>
                                 <th>Exp. Date</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="col-12 mb-50">
                  <div class="cards">
                      <div class="card-headers">
                        <b class="card-titles">Requisition To External Blood Bank</b>&nbsp;
                      </div>
                     <!-- /.card-header -->
                     <div class="card-bodys">
                        <table id="table_stock_in" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Agency</th>
                                 <th>Issue No</th>
                                 <th>Component</th>
                                 <th>Blood Group</th>
                                 <th>Unit No.</th>
                                 <th>Fraction Date</th>
                                 <th>Exp. Date</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="col-12 mb-50">
                  <div class="cards">
                      <div class="card-headers">
                        <b class="card-titles">Requisition From External Blood Bank</b>&nbsp;
                      </div>
                     <!-- /.card-header -->
                     <div class="card-bodys">
                        <table id="table_stock_out" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Agency</th>
                                 <th>Issue No</th>
                                 <th>Component</th>
                                 <th>Blood Group</th>
                                 <th>Unit No.</th>
                                 <th>Fraction Date</th>
                                 <th>Exp. Date</th>
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
 
  var bb_stock_over_view_search = '<?php echo $base_url; ?>/bb_stock_over_view_search';
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
            "url": bb_stock_over_view_search,
            "type": "POST",
            "data": function (d) {
                d[csrf_name] = csrf_hash;
                d.status = 'Ajency';
            },
        },
        "autoWidth": false,
        "searching": false,
        "lengthChange": false,
        "columnDefs": [
            {
                "targets": [0,6],
                "orderable": false,
            }
        ]
    });

    var table_handover = $('#table_stock_in').DataTable({
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
            "url": bb_stock_over_view_search,
            "type": "POST",
            "data": function (d) {
                d[csrf_name] = csrf_hash;
                d.status = 'in';
            },
        },
        "autoWidth": false,
        "searching": false,
        "lengthChange": false,
        "columnDefs": [
            {
                "targets": [0,6],
                "orderable": false,
            }
        ]
    });


    var table_handover = $('#table_stock_out').DataTable({
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
            "url": bb_stock_over_view_search,
            "type": "POST",
            "data": function (d) {
                d[csrf_name] = csrf_hash;
                d.status = 'out';
            },
        },
        "autoWidth": false,
        "searching": false,
        "lengthChange": false,
        "columnDefs": [
            {
                "targets": [0,6],
                "orderable": false,
            }
        ]
    });
}

$(document).ready(function () {
  ins();
  });

</script>
