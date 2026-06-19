<?php defined('BASEPATH') or exit('No direct script access allowed');

// print_r($bloodbank[0]['short_name']);die();
?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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
        height: 1.6rem;
        font-size: 0.9rem;
        padding: 0px;
    }

    label {
        font-size: 12px;
    }

    .form-group {
        margin-bottom: 0;
    }

    table.dataTable thead>tr>th.sorting_asc,
    table.dataTable thead>tr>th.sorting_desc,
    table.dataTable thead>tr>th.sorting,
    table.dataTable thead>tr>td.sorting_asc,
    table.dataTable thead>tr>td.sorting_desc,
    table.dataTable thead>tr>td.sorting {
        /* padding-right: 15px;  */
        font-size: 12px;
    }

    table.dataTable tbody th,
    table.dataTable tbody td {
        /* padding: 6px !important; */
        font-size: 14px;
    }

    .btn-xs {
        padding: 2px;
        font-size: 10px;
    }

    table.dataTable thead th,
    table.dataTable thead td {
        /* padding: 0 15px !important; */
    }

    .page-item.active .page-link {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .page-link {
        color: #000;
    }

    .capitalize {
        text-transform: capitalize;
    }

    label {
        margin-bottom: 0;
    }
</style>
<style type="text/css">
    .body {
        font-family: Jost, sans-serif !important;
    }

    a {
        outline: none;
        text-decoration: none;
        color: #555;
    }

    a:hover,
    a:focus {
        outline: none;
        text-decoration: none;
    }

    img {
        border: 0;
    }

    input,
    textarea,
    select {
        outline: none;
        resize: none;
        font-family: 'Muli', sans-serif;
    }

    a,
    input,
    button {
        outline: none !important;
    }

    button::-moz-focus-inner {
        border: 0;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0;
        padding: 0;
        font-weight: 700;
        color: #202342;
        font-family: 'Muli', sans-serif;
    }

    img {
        border: 0;
        vertical-align: top;
        max-width: 100%;
        height: auto;
    }

    ul,
    ol {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    p {
        margin: 0 0 15px 0;
        padding: 0;
    }

    .container-fluid {
        max-width: 1900px;
    }

    .widget-style3:hover img {
        filter: brightness(0) invert(1) !important;
    }

    /* Common Class */
    .pd-5 {
        padding: 5px;
    }

    .pd-10 {
        padding: 10px;
    }

    .pd-20 {
        padding: 20px;
    }

    .pd-30 {
        padding: 30px;
    }

    .pb-10 {
        padding-bottom: 10px;
    }

    .pb-20 {
        padding-bottom: 20px;
    }

    .pb-30 {
        padding-bottom: 30px;
    }

    .pt-10 {
        padding-top: 10px;
    }

    .pt-20 {
        padding-top: 20px;
    }

    .pt-30 {
        padding-top: 30px;
    }

    .pr-10 {
        padding-right: 10px;
    }

    .pr-20 {
        padding-right: 20px;
    }

    .pr-30 {
        padding-right: 30px;
    }

    .pl-10 {
        padding-left: 10px;
    }

    .pl-20 {
        padding-left: 20px;
    }

    .pl-30 {
        padding-left: 30px;
    }

    .px-30 {
        padding-left: 30px;
        padding-right: 30px;
    }

    .px-20 {
        padding-left: 20px;
        padding-right: 20px;
    }

    .py-30 {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .py-20 {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .mb-30 {
        margin-bottom: 30px;
    }

    .mb-50 {
        margin-bottom: 20px;
    }

    .font-30 {
        font-size: 20px;
        line-height: 1.46em;
    }

    .font-24 {
        font-size: 24px;
        line-height: 1.5em;
    }

    .font-20 {
        font-size: 15.3px;
        line-height: 1.5em;
    }

    .font-18 {
        font-size: 18px;
        line-height: 1.6em;
    }

    .font-16 {
        font-size: 16px;
        line-height: 1.75em;
    }

    .font-14 {
        font-size: 14px;
        line-height: 1.85em;
    }

    .font-12 {
        font-size: 12px;
        line-height: 2em;
    }

    .weight-300 {
        font-weight: 300;
    }

    .weight-400 {
        font-weight: 400;
    }

    .weight-500 {
        font-weight: 500;
    }

    .weight-600 {
        font-weight: 600;
    }

    .weight-700 {
        font-weight: 700;
    }

    .weight-800 {
        font-weight: 800;
    }

    .text-blue {
        color: #1b00ff;
    }

    .text-dark {
        color: #000000;
    }

    .text-white {
        color: #ffffff;
    }

    .height-100-p {
        height: 100%;
    }

    .bg-white {
        background: #ffffff;
    }

    .border-radius-10 {
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 30px 0;
    }

    .border-radius-100 {
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        border-radius: 100%;
    }

    .box-shadow {
        -webkit-box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
        -moz-box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
        box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
    }

    .gradient-style1 {
        background-image: linear-gradient(135deg, #43CBFF 10%, #9708CC 100%);
    }

    .gradient-style2 {
        background-image: linear-gradient(135deg, #72EDF2 10%, #5151E5 100%);
    }

    .gradient-style3 {
        background-image: radial-gradient(circle 732px at 96.2% 89.9%, rgba(70, 66, 159, 1) 0%, rgba(187, 43, 107, 1) 92%);
    }

    .gradient-style4 {
        background-image: linear-gradient(135deg, #FF9D6C 10%, #BB4E75 100%);
    }

    /* widget style 1 */
    .widget-style1 {
        padding: 20px 10px;
    }

    .widget-style1 .circle-icon {
        width: 60px;
    }

    .widget-style1 .circle-icon .icon {
        width: 60px;
        height: 60px;
        background: #ecf0f4;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .widget-style1 .widget-data {
        width: calc(100% - 150px);
        padding: 0 15px;
    }

    .widget-style1 .progress-data {
        width: 90px;
    }

    .widget-style1 .progress-data .apexcharts-canvas {
        margin: 0 auto;
    }

    .content-header h1 {
        font-size: 18px;
        /*margin: 0 20px;*/
    }

    .widget-style2 .widget-data {
        padding: 20px;
    }

    .widget-style3 {
        box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
        padding: 15px;
        border-radius: 15px;
        position: relative;
        z-index: 1;
        height: 100%;
        transition: .5s;
    }

    .widget-style3:hover:before {
        height: 100%;
        background: #ad1e1d;
    }

    .widget-style3:before {
        position: absolute;
        content: "";
        z-index: -1;
        width: 100%;
        height: 0;
        background: #ad1e1d;
        left: 0;
        bottom: 0;
        transition: .5s;
        border-radius: 15px;
    }

    .widget-style3:hover i {
        color: #fff;
    }

    .widget-style3:hover .weight-500.font-20 {
        color: #fff;
    }

    .widget-style3:hover .text-dark {
        color: #fff !important;
    }

    a.d-block {
        color: #ad1e1d !important;
        font-weight: bold;
    }

    .widget-style3 .widget-data {
        width: calc(100% - 60px);
    }

    .widget-style3 .widget-icon {
        width: 30px;
        height: 50px;
        font-size: 30px;
        line-height: 1;
        margin: 0 15px;
    }

    .widget-style3 i {
        color: black;
    }

    .widget-style3:hover img {
        -webkit-filter: invert(40%) grayscale(100%) brightness(40%) sepia(100%) hue-rotate(-70deg) saturate(400%) contrast(2);
        /* filter: grayscale(100%) brightness(40%) sepia(100%) hue-rotate(-50deg) saturate(600%) contrast(0.8); */
    }

    .apexcharts-legend-marker {
        margin-right: 6px !important;
    }

    .page_title_card {
        display: flex;
        margin-bottom: 6px;
    }

    .page_title_card h5 {
        font-size: 16px;
        font-weight: 500;
        color: gray;
        padding: 0 10px 0 0;
    }

    .content-wrapper {
        background: #fff;
        text-transform: capitalize;
    }

    .super-cards {
        padding: 0 30px;
    }

    .Purchase-card {
        box-shadow: rgb(149 157 165 / 20%) 0px 8px 24px;
        padding: 20px;
        height: 100%;
    }

    .dash-graph {
        padding: 0 30px;
    }
</style>
<style>
    /* Font size */
    #table_bb_details {
        font-size: 13px;
        /* Adjust the font size as needed */
    }

    /* Row height */
    #table_bb_details tbody tr {
        height: 40px;
        /* Adjust the row height as needed */
    }

    /* Cell padding */
    #table_bb_details td,
    #table_bb_details th {
        padding: 5px;
        /* Adjust cell padding as needed */
    }

    /* ########## */

    #table_bb_deffer {
        font-size: 13px;
    }

    #table_bb_deffer tbody tr {
        height: 40px;
    }

    #table_bb_deffer td,
    #table_bb_deffer th {
        padding: 5px;
    }

    /* ########## */

    #table_bb_request {
        font-size: 13px;
    }

    #table_bb_request tbody tr {
        height: 40px;
    }

    #table_bb_request td,
    #table_bb_request th {
        padding: 5px;
    }

    /* ########## */

    #table_bb_request_met {
        font-size: 13px;
    }

    #table_bb_request_met tbody tr {
        height: 40px;
    }

    #table_bb_request_met td,
    #table_bb_request_met th {
        padding: 5px;
    }

    /* ########## */

    #table_bb_inv {
        font-size: 13px;
    }

    #table_bb_inv tbody tr {
        height: 40px;
    }

    #table_bb_inv td,
    #table_bb_inv th {
        padding: 5px;
    }

    /* ########## */

    #table_bb_camp {
        font-size: 13px;
    }

    #table_bb_camp tbody tr {
        height: 40px;
    }

    #table_bb_camp td,
    #table_bb_camp th {
        padding: 5px;
    }

    /* ########## */

    #table_bb_donar_app {
        font-size: 13px;
    }

    #table_bb_donar_app tbody tr {
        height: 40px;
    }

    #table_bb_donar_app td,
    #table_bb_donar_app th {
        padding: 5px;
    }

    /* ########## */

    #table_bb_req_app {
        font-size: 13px;
    }

    #table_bb_req_app tbody tr {
        height: 40px;
    }

    #table_bb_req_app td,
    #table_bb_req_app th {
        padding: 5px;
    }
</style>

<section class="content-header">
    <div class="container">
        <div class="timeline">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid pb-3">
                        <?php $admin_id = $_SESSION['admin_type'];    ?>
                        <div class="row" style="">
                            <!-- --------------- -->
                            <div class="row col-12">
                                <div class="col-12 mb-50">
                                    <div class="cards">
                                        <div class="card-headers">
                                            <b class="card-titles">Discard</b>&nbsp;
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-bodys">
                                            <table id="table_handover" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th> #</th>
                                                        <th>Patient Name</th>
                                                        <th>Unit No</th>
                                                        <th>Component</th> 
                                                        <th>Volume</th>
                                                        <th>Blood Group</th>
                                                        <th>Status</th>
                                                        <th>Discard No</th>
                                                        <th>Discard why</th>
                                                        <th>Discard Date</th>
                                                        <th>Action</th>
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
<!-- Modal -->
<div class="modal fade" id="bmwModal" tabindex="-1" role="dialog" aria-labelledby="bmwModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select BMW</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <select name="aj" id="aj" class="form-control">
          <?php foreach ($bmw as $ajs) { ?>
            <option value="<?= $ajs->id; ?>"><?= $ajs->name; ?></option>
          <?php } ?>
        </select>
        <input type="hidden" id="selectedRowId">
        <input type="hidden" id="dis_res">
        <input type="hidden" id="dis_no">
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary" onclick="save()">Save</button>
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
    $('#checkAll').change(function() {
        $('.record-checkbox').prop('checked', $(this).prop('checked'));
    });
    var bb_stock_handover_search = '<?php echo $base_url; ?>/bb_stock_handover_search';
    // console.log(bb_stock_handover_search);
    //------------------------------------------
    function save() {
        var selectedId = $('#selectedRowId').val();
        var dis_res = $('#dis_res').val();
        var dis_no = $('#dis_no').val();
        
        var aj = $('#aj').val();
        var issue_to = $('#issue_to').val();
        if (aj == "") {
            alert('please Select BMW!');
            return;
        }
       
        $.ajax({
            url: '<?php echo $base_url; ?>/bmw_stock_hand_over',
            method: "POST",
            datatype: "json",
            data: {
                [csrf_name]: csrf_hash,
                aj: aj,dis_no:dis_no,dis_res:dis_res,
                selectedIds: [selectedId]
            },
            success: function(d) {
            
                location.reload();
            }
        })
    }

      // Trigger modal for single row
    $(document).on('click', '.handover-btn', function() {
        var rowId = $(this).data('id');
        var dis_res = $(this).data('dis_res');
        var dis_no = $(this).data('dis_no');
        
        $('#selectedRowId').val(rowId);
        $('#dis_res').val(dis_res);
        $('#dis_no').val(dis_no);
        $('#bmwModal').modal('show');
    });
    function ins() {
        var table_handover = $('#table_handover').DataTable({
            'bJQueryUI': false,
            'stateSave': false,
          
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": bb_stock_handover_search,
                "type": "POST",
                "data": function(d) {
                    d[csrf_name] = csrf_hash;
                },
                "dataSrc": function(json) {
                    if (json.data.length === 0) {
                        json.draw = 0;
                        json.recordsTotal = 0;
                        json.recordsFiltered = 0;
                    }
                    return json.data;
                }
            },
            "autoWidth": false,
            "searching": true,
            "columnDefs": [{
                "targets": [0, 10], //first column / numbering column
                "orderable": false, //set not orderable
            }],
            

        });
    }
    $(document).ready(function() {

        ins();


    });
</script>