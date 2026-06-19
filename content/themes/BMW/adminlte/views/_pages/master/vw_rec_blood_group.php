<style type="text/css">
  .pagination {
    list-style: none;
    padding: 0;
  }

  .pagination li {
    display: inline;
    margin-right: 5px;
  }

  .pagination li a {
    text-decoration: none;
    padding: 5px 10px;
    border: 1px solid #ddd;
  }

  .pagination li.active a {
    background-color: #007bff;
    color: white;
  }


  @media print {
    body * {
      visibility: hidden;
    }

    #printtable,
    #printtable * {
      visibility: visible;
    }

    #printtable {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
    }

    @page {
      size: landscape;
      margin: 0;
    }

    body {
      margin: 0;
      -webkit-print-color-adjust: exact;
    }
  }

  .content-wrapper>.content {
    text-transform: capitalize;
  }

  .form-control {
    height: 25px !important;
    padding: 0 14px !important;
    font-size: 14px !important;
  }

  label {
    margin-bottom: 0;
    font-size: 12px;
  }

  .card-body {
    padding: 10px 20px 0;
  }

  .content-header h1 {
    font-size: 18px;
    margin: 0 6px;
    font-weight: bold;
  }

  .page-item.active .page-link {
    background-color: #ad1e1d !important;
    border-color: #ad1e1d !important;
  }

  .form-group {
    margin-bottom: 0;
  }

  @media print {
    #printPageButton {
      display: none;
    }
  }

  .timeline::before {
    background: none !important;
  }

  .content-wrapper {
    background: none !important;
  }

  .card-footer {
    background-color: #fff;
  }
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// print_r($filter_data['start_date']);
// die();
$bank_id = $_SESSION['bank_id'];
$query1 = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id = '$bank_id'");
foreach ($query1->result() as $bloodbank) {
  $city_id = $bloodbank->city_id;
}
$query2 = $this->db->query("SELECT * FROM bl_cities WHERE id = '$city_id'");
foreach ($query2->result() as $city) {
}

?>
<br>
<!--<div class="container" id="printPageButton">-->
<!--  <form action="<?php echo base_url('admin/donations/master_records'); ?>" method="POST">-->
<!--    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">-->

<!--    <div class="timeline">-->
<!--      <div class="card">-->

<!--        <div class="card-body">-->
<!--          <div class="row">-->

<!--            <div class="col-md-3">-->
<!--              <div class="form-group">-->
<!--                <label for="description">Start Date</label>-->
<!--                <input type="date" class="form-control" id="price" name="start_date">-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="col-md-3">-->
<!--              <div class="form-group">-->
<!--                <label for="description">End Date</label>-->
<!--                <input type="date" class="form-control" id="price" name="end_date">-->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="col-md-3">-->
<!--              <div class="form-group">-->
<!--                <label for="description">Start Id</label>-->
<!--                <input type="text" class="form-control" id="price" name="start_id">-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="col-md-3">-->
<!--              <div class="form-group">-->
<!--                <label for="description">End Id</label>-->
<!--                <input type="text" class="form-control" id="price" name="end_id">-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="row">-->


<!--            <div class="col-md-3">-->
<!--              <div class="form-group">-->
<!--                <label for="description">Unit No (From)</label>-->
<!--                <input type="text" class="form-control" id="price" name="unit_from">-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="col-md-3">-->
<!--              <div class="form-group">-->
<!--                <label for="description">Unit No (To)</label>-->
<!--                <input type="text" class="form-control" id="price" name="unit_to">-->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="col-md-3">-->
<!--              <div class="form-group">-->
<!--                <label for="description">Request No (From)</label>-->
<!--                <input type="text" class="form-control" id="price" name="request_from">-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="col-md-3">-->
<!--              <div class="form-group">-->
<!--                <label for="description">Request No (To)</label>-->
<!--                <input type="text" class="form-control" id="price" name="request_to">-->
<!--              </div>-->
<!--            </div>-->

<!--          </div>-->
<!--          <div class="row">-->

<!--            <div class="col-md-3">-->
<!--              <div class="form-group">-->
<!--                <label for="description">Name</label>-->
<!--                <input type="text" class="form-control" id="price" name="name">-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="col-md-9">-->
<!--              <div class="card-footer">-->
<!--                <div class="btn-group" style="float: right;">-->
<!--                  <button type="submit" name="submit" class="btn btn-sm btn-danger">Filter</button>-->
<!--                </div>-->
<!--              </div>-->

<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        </div>-->
<!--        </div>-->
<!--  </form>-->
<!--</div>-->

<button id="printPageButton" onclick="printTable()" style="background-color: #ad1e1d;color: white;border-radius: 5px;border-color: white;padding: 5px 10px;">Print</button>
<br>
<div>
     <div id="printtable">
<h6 style="text-align: center;line-height:1;"><?php echo ($bloodbank->name) ?><br> A UNIT OF VITA HEE CARE TRUST<br>
  <?php echo ($bloodbank->address_1) ?></br><span style="text-align: center;font-weight: bold;">Blood Grouping Record</span> </h6>
  
  <table id="printtable" style="border: 1px solid black;font-family: arial, sans-serif;border-collapse: collapse;width: 100%;font-size: 10px;">
    <tr>
      <th style="width: 5%;border: 1px solid black; text-align: center;" rowspan="2">Date</th>
      <th style="width: 9%;border: 1px solid black; text-align: center;" rowspan="2">Unit No.</th>
      <th style="width: 8%;border: 1px solid black; text-align: center;" rowspan="2">Name</th>
      <th style="width: 23%;border: 1px solid black; text-align: center;" colspan="4">Forward Group</th>
      <th style="width: 16%;border: 1px solid black; text-align: center;" colspan="3">Reverse Group</th>
      <th style="width: 15%;border: 1px solid black; text-align: center;" colspan="2">Himolysin In Blood Group<br>'O' </th>
      <th style="width: 8%;border: 1px solid black; text-align: center;" rowspan="2">Irregular<br>Antibodies done<br>by pooled 'O'<br>Cells</th>
      <th style="width: 8%;border: 1px solid black; text-align: center;" rowspan="2">Final Blood<br>Group</th>
      <th style="width: 8%;border: 1px solid black; text-align: center;" rowspan="2">Done By</th>
    </tr>
    <tr>
      <th style="width: 4.6%;border: 1px solid black; text-align: center;">Anti-A</th>
      <th style="width: 4.6%;border: 1px solid black; text-align: center;">Anti-B</th>
      <th style="width: 4.6%;border: 1px solid black; text-align: center;">Anti-AB</th>
      <th style="width: 4.6%;border: 1px solid black; text-align: center;">Anti-D</th>
      <!-- <th style="width: 4.6%;border: 1px solid black; text-align: center;">Anti-D</th> -->
      <th style="width: 5.3%;border: 1px solid black; text-align: center;">A Cell</th>
      <th style="width: 5.3%;border: 1px solid black; text-align: center;">B Cell</th>
      <th style="border: 1px solid black; text-align: center;">O Cell</th>
      <th style="width: 7.5%;border: 1px solid black; text-align: center;">With A Cells</th>
      <th style="border: 1px solid black; text-align: center;">With B Cells</th>
    </tr>
    <?php foreach ($master_record as $ms) {  ?>
      <tr style="width: 100%;">
        <td style="border: 1px solid black; text-align: center;"><?= date('d-m-Y', strtotime($ms['date'])) ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['unit_no'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['donor_name'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['anti_a'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['anti_b'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['anti_ab'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['anti_d'] ?></td>
        <!-- <td style="border: 1px solid black; text-align: center;"><?= $ms['anti_a'] ?></td> -->
        <td style="border: 1px solid black; text-align: center;"><?= $ms['a_cell'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['b_cell'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['o_cell'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['with_a_cell'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['with_b_cell'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['irregular_anti_o_cells'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['final_bloodgroup'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['done_by'] ?></td>

      </tr>
    <?php }  ?>
  </table>
  </div>
  <!-- Display pagination links -->
  <br>
  <div class="pagination-links">
    <?php echo $pagination; ?>
  </div>
  <br>


</div>
<script>
  function printTable() {
    var printContents = '<html><head><title>Print Table</title> <style>@media print { @page { size: landscape; margin: 3.5px; } </style>';
    printContents += '</head><body>';
    printContents += document.getElementById('printtable').outerHTML;
    printContents += "</body></html>";

    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }
</script>