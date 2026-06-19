<style type="text/css">
.content-header h1 {
    font-size: 18px;
    margin: 0 6px;
    font-weight: bold;
}
.btn-primary {
    background-color: #ad1e1d !important;
    border-color: #ad1e1d !important;
    margin: 12px 0;
}
.content-wrapper {
    background: #fff;
}

</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<style type="text/css">
  @media print {
  * {
    display: none;
  }
  #printableTable {
    display: block;
  }
}
</style>
 <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Blood Stock</h5>
        <div style="float: right;"> <button onclick="ExportToExcel('xlsx')" class="btn btn-primary" >EXCEL SHEET</button></div>
      </div>

    <div id="printableTable">
      <div class="card-body">
        <table id="table_bloodstock" border="1" class="table table-bordered table-hover">
          <thead>
          <tr style="font-size:14px;">
            <th>#</th>
            <th>Component</th>
            <th>A+</th>
            <th>A-</th>
            <th>AB+</th>
            <th>AB-</th>
            <th>B+</th>
            <th>B-</th>
            <th>O+</th>
            <th>O-</th>
            <th>Total</th>
          </tr>
          </thead>
            <tbody>
              <?php foreach($bank_component as $inx=>$row){?>
                <tr style="font-size:13px;">
                    <td><?= ++$inx ?></td>
                    <td><?= $row->master_type_key_short_value ?></td>
                    <td><?= $row->A_pos ?></td>
                    <td><?= $row->A_neg?></td>
                    <td><?= $row->AB_pos ?></td>
                    <td><?= $row->AB_neg ?></td>
                    <td><?= $row->B_pos ?></td>
                    <td><?= $row->B_neg ?></td>
                    <td><?= $row->O_pos ?></td>
                    <td><?= $row->O_neg ?></td>
                    <td><?= $row->total ?></td>
                    <!--<td></td>-->
                </tr>
            <?php } ?>
          </tbody>
        
        </table>
      </div>

    </div>
    <div id="printableTables">
      <div class="card-body">
          <div class="card-header">
        <h5 class="card-title">Whole Blood</h5>
        <div style="float: right;"> <button onclick="ExportToExcelwb('xlsx')" class="btn btn-primary" >EXCEL SHEET</button></div>
      </div>
        <table id="table_bloodstock_wb" border="1" class="table table-bordered table-hover">
          <thead>
          <tr style="font-size:14px;">
            <th>#</th>
            <th>Whole Blood</th>
            <th>A+</th>
            <th>A-</th>
            <th>AB+</th>
            <th>AB-</th>
            <th>B+</th>
            <th>B-</th>
            <th>O+</th>
            <th>O-</th>
            <th>Total</th>
          </tr>
          </thead>
            <tbody>
             <?php foreach($wp_component as $inx=>$rows){?>
                <tr style="font-size:13px;">
                    <td><?= ++$inx ?></td>
                    <td><?= $rows->comp ?></td>
                    <td><?= $rows->A_pos ?></td>
                    <td><?= $rows->A_neg?></td>
                    <td><?= $rows->AB_pos ?></td>
                    <td><?= $rows->AB_neg ?></td>
                    <td><?= $rows->B_pos ?></td>
                    <td><?= $rows->B_neg ?></td>
                    <td><?= $rows->O_pos ?></td>
                    <td><?= $rows->O_neg ?></td>
                    <td><?= $rows->total ?></td>
                    
                </tr>
            <?php } ?>
            </tbody>
        
        </table>
      </div>

    </div>
     <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
</div>

  </div> 

<script type="text/javascript">
         function printDiv() {
         window.frames["print_frame"].document.body.innerHTML = document.getElementById("printableTable").innerHTML;
         window.frames["print_frame"].window.focus();
         window.frames["print_frame"].window.print();
       }
</script>

<script>

function ExportToExcel(type, fn, dl) {
var elt = document.getElementById('table_bloodstock');
var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('BloodStock.' + (type || 'xlsx')));
}
function ExportToExcelwb(type, fn, dl) {
var elt = document.getElementById('table_bloodstock_wb');
var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('BloodStock.' + (type || 'xlsx')));
}
 </script>