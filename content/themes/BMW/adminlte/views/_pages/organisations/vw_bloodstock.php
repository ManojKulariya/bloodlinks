<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<style type="text/css">
  .content-wrapper {
    background: #fff;
    text-transform: capitalize;
  }

  .content-header h1 {
    font-size: 18px;
    /* margin: 0 20px; */
    font-weight: bold;
  }

  .btn-primary {
    background-color: #dc3545;
    border-color: #dc3545;
    margin: 0 0 15px;
  }

  .btn-danger {
    padding: 6px 27px;
  }

  .card-footer {
    background: none;
  }

  .timeline::before {
    width: 0;
  }

  @media print {
    * {
      display: none;
    }

    #printableTable {
      display: block;
    }
  }
</style>
<div class="container">
  <form action="bloodstocks" method="GET">
       <div class="timeline">

      <div class="card">

        <div class="card-body">


          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Blood Bank</label>
                <select name="blood_bank" id="vender" class="form-control">
                  <!--<option value="#" selected disabled>Select</option>-->
                  <?php
                  $query12 = $this->db->query("SELECT * FROM bl_blood_banks");
                  foreach ($query12->result() as $type) {
                  ?>
                    <option value="<?= $type->blood_bank_id; ?>" <?= ($type->blood_bank_id == $bank_id) ? 'selected' : ''; ?>><?= $type->name; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="card-footer" style="float: right;">
              <div class="btn-group" style=" margin-top:21px;">
                <button type="submit"  class="btn btn-sm btn-danger">Filter</button>
              </div>
            </div>
          </div>
        </div>
  </form>
  <div class="card-header">
    <h5 class="card-title">Blood Stock</h5>
    <div style="float: right;"> <button onclick="ExportToExcel('xlsx')" class="btn btn-primary">EXCEL SHEET</button></div>
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
          <?php foreach ($bank_component as $inx => $row) { ?>
            <tr style="font-size:13px;">
              <td><?= ++$inx ?></td>
              <td><?= $row->master_type_key_short_value ?></td>
              <td><?= $row->A_pos ?></td>
              <td><?= $row->A_neg ?></td>
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
        <div style="float: right;"> <button onclick="ExportToExcelwb('xlsx')" class="btn btn-primary">EXCEL SHEET</button></div>
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
          <?php foreach ($wp_component as $inx => $rows) { ?>
            <tr style="font-size:13px;">
              <td><?= ++$inx ?></td>
              <td><?= $rows->comp ?></td>
              <td><?= $rows->A_pos ?></td>
              <td><?= $rows->A_neg ?></td>
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
</div>


<script>
  function ExportToExcel(type, fn, dl) {
    var elt = document.getElementById('table_bloodstock');
    var wb = XLSX.utils.table_to_book(elt, {
      sheet: "sheet1"
    });
    return dl ?
      XLSX.write(wb, {
        bookType: type,
        bookSST: true,
        type: 'base64'
      }) :
      XLSX.writeFile(wb, fn || ('BloodStock.' + (type || 'xlsx')));
  }

  function ExportToExcelwb(type, fn, dl) {
    var elt = document.getElementById('table_bloodstock_wb');
    var wb = XLSX.utils.table_to_book(elt, {
      sheet: "sheet1"
    });
    return dl ?
      XLSX.write(wb, {
        bookType: type,
        bookSST: true,
        type: 'base64'
      }) :
      XLSX.writeFile(wb, fn || ('BloodStock.' + (type || 'xlsx')));
  }
</script>