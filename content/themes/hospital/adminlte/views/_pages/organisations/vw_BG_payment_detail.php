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

<?php defined('BASEPATH') OR exit('No direct script access allowed');
function get_com($comp){
            if ($comp == 18) {
            $component = "wholeblood";
            } elseif ($comp == 19) {
            $component = "CRYO";
            } elseif ($comp == 20) {
            $component = "FFP";
            } elseif ($comp == 21) {
            $component = "RDP";
            } elseif ($comp == 22) {
            $component = "PRBC";
            }  elseif ($comp == 886) {
            $component = "SDP";
            }  elseif ($comp == 885) {
            $component = "CPP";
            } else {
            $component = $comp;
            } 
            
            return $component;
    }
?>


<div class="row">
  <div class="col-12">
    <div class="card">
        
      <div class="card-header">
        <h3 class="card-title">Payment details</h3> &nbsp;
        <!--<a id="downloaddonorexcel" href="#" style="text-decoration: underline; color: #0D2942;">Download Excel</a>-->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
                    <!--<?php if($_SESSION['admin_type'] != 5){ ?>-->
                    <!--<div style="margin-bottom:20px;">-->
                    <!--    <lable>Select BloodBank</lable> -->
                    <!--    <select  id="bloodBankSelect" style="margin-left:25px;">-->
                        
                    <!--        <?php foreach($bloodbank as $row): ?>-->
                    <!--            <option value="<?= $row['blood_bank_id'] ?>" data-name="<?= $row['name'] ?>"><?= $row['name'] ?></option>-->
                    <!--        <?php endforeach; ?>-->
                    <!--    </select>-->
                        <!-- Display the selected blood bank -->
                    <!--<h6 id="bloodBankNameLabel" style="color: blue;margin-top:5px;"></h6>-->

                    <!--</div>-->
                    <!--<?php } ?>-->
        <table id="issue_detail"  style="width:100%;font-size:13px;" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <?php if($_SESSION['admin_type'] != 5 ){ ?><th>Blood Bank<br>Name</th><?php } ?>
            <th>Name</th> 
            <th>Unit No</th>
            <th>Tube NO</th>
            <th>Issue No</th>
            <th>Component</th>
            <th>Request No</th>
            <th>Slip No</th>
            <th>Blood Group</th>
            <th>Issued Date</th>
            <th>Payment</th>
          </tr>
          </thead>
          <tbody>
              <?php foreach($list as $ix=>$row){
              $component = get_com($row['component']);
              ?>
              <tr>
                  <td><?= ++$ix ?></td>
                  <?php if($_SESSION['admin_type'] != 5 ){ ?><td style="width:70px;"><?= $row['b_name'] ?></td><?php } ?>
                  <td><?= $row['p_name'] ?></td>
                  <td><?= $row['unit_no'] ?></td>
                  <td><?= $row['tube_no'] ?></td>
                  <td><?= $row['issue_no'] ?></td>
                  <td><?= $component ?></td>
                  <td><?= $row['request'] ?></td>
                  <td><?= $row['slip_no'] ?></td>
                  <td><?= $row['groups'] ?></td>
                  <td><?= date('d-m-Y', strtotime($row['issue_date'])) ?></td>
                  <td><?= $row['payment'] ?></td>
              </tr>
              <?php } ?>
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
<script>
$(document).ready(function() {
    $('#issue_detail').DataTable({
        "paging": true, // Enable pagination
        "lengthChange": true, // Allow changing number of records per page
        "pageLength": 15, // Set default number of records per page
        "searching": true, // Enable searching
        "ordering": true, // Enable sorting
        "info": true, // Show table information
        "autoWidth": false, // Disable auto width calculation
        "responsive": true // Enable responsive design
    });
});
</script>

