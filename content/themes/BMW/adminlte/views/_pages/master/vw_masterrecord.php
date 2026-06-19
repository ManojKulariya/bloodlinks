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
<div class="container" id="printPageButton">
  <form action="<?php echo base_url('admin/donations/master_records'); ?>" method="GET">

    <div class="timeline">
      <div class="card">

        <div class="card-body">
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Start Date</label>
                <input type="date" class="form-control" id="price" name="start_date">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">End Date</label>
                <input type="date" class="form-control" id="price" name="end_date">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Start Id</label>
                <input type="text" class="form-control" id="price" name="start_id">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">End Id</label>
                <input type="text" class="form-control" id="price" name="end_id">
              </div>
            </div>
          </div>
          <div class="row">


            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Unit No (From)</label>
                <input type="text" class="form-control" id="price" name="unit_from">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Unit No (To)</label>
                <input type="text" class="form-control" id="price" name="unit_to">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Request No (From)</label>
                <input type="text" class="form-control" id="price" name="request_from">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Request No (To)</label>
                <input type="text" class="form-control" id="price" name="request_to">
              </div>
            </div>

          </div>
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Name</label>
                <input type="text" class="form-control" id="price" name="name">
              </div>
            </div>

            <div class="col-md-7">
              <div class="card-footer">
                <div class="btn-group" style="float: right;">
                  <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                </div>
              </div>

            </div>
            <div class="col-md-2">
                <div class="card-footer">
                    <div class="btn-group" style="float: right;">
                        <a href="<?= base_url('admin/donations/master_records'); ?>" class="btn btn-sm btn-success">Reset</a>
                    </div>
                </div>
            </div>

          </div>
        </div>
    </div>
    </div>
  </form>
</div>

<button id="printPageButton" onclick="printTable()" style="background-color: #ad1e1d;color: white;border-radius: 5px;border-color: white;padding: 5px 10px;">Print</button>
<br>
<div>
    <div  id="printtable">
  <h6 style="text-align: center;line-height:1;"><?php echo ($bloodbank->name) ?><br> A UNIT OF VITA HEE CARE TRUST<br>
  <?php echo ($bloodbank->address_1) ?></br><span style="text-align: center;font-weight: bold;">master record</span> </h6>
  <table style="line-height:1;margin-top:-8px;border: 1px solid black;font-family: arial, sans-serif;border-collapse: collapse;width: 100%;font-size: 10px;">
    <tr style="">
      <th style="width: 7%;border: 1px solid black; text-align: center;">Bag Serial No. and Donation Date</th>
      <th style="width: 9%;border: 1px solid black; text-align: center;">Donor Name, Perticulars and Address</th>
      <th style="width: 10%;border: 1px solid black; text-align: center;">Replacement Detail</th>
      <th style="width: 14%;border: 1px solid black; text-align: center;">Age & Sex, hemoglobin,<br>HCT, Platelet count, weight,<br>& Blood pressure</th>
      <th style="width: 7%;border: 1px solid black; text-align: center;">Donor Type<br>Blood Group<br>Tube No</th>
      <th style="width: 8%;border: 1px solid black; text-align: center;">Test Result</th>
      <th style="width: 6%;border: 1px solid black; text-align: center;">Component</th>
      <th style="width: 4.5%;border: 1px solid black; text-align: center;">Volume<br>(ml)</th>
      <th style="width: 6%;border: 1px solid black; text-align: center;">Expiry Date</th>
      <th style="width: 7%;border: 1px solid black; text-align: center;">Issue No</th>
      <th style="width: 7%;border: 1px solid black; text-align: center;">Discard No</th>
      <th style="width: 6%;border: 1px solid black; text-align: center;">Irregular antibodies</th>
      <th style="width: 8%;border: 1px solid black; text-align: center;">QC</th>
    </tr>
    <?php foreach ($master_record as $ms) {
      
      $txt = $ms['sex'] == "female" ? "D" : "S";
      $sex = $ms['sex'] == "female" ? "F" : "M";
    ?>
      <tr style="height: 134px; width: 100%;">
        <td style="border: 1px solid black; text-align: center;"><?= $ms['unit_no'] ?><br><?= date('d-m-Y', strtotime($ms['donation_date']))  ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['donor_name'] ?>
          <?php if ($ms['sex'] != "") { ?><br> <?= $txt ?>/o <?php } ?>
          <?= $ms['father'] ?>
          <br><?= $ms['address'] ?><br><?= $ms['mobile'] ?>
        </td>
        <td style="border: 1px solid black; text-align: center;vertical-align: top;height: 100%;">
          <table style="height: 134px; width: 100%;">
            <tr style="height: 50%;vertical-align: top;">
              <td style="border: 1px solid black; text-align: center;overflow:hidden;border-top: none; border-left:none; border-right:none;border-bottom:none;">Patient Request Number<br><?= $ms['rep_request'] ?></td>
            </tr>
            <tr style="height: 50%;vertical-align: top;">
              <td style="border: 1px solid black; text-align: center;border-top: none;border-left:none; border-right:none;border-bottom:none;">Patient Name<br><?= $ms['patient_name'] ?></td>
            </tr>
          </table>
        </td>
        <td style="border: 1px solid black; text-align: center;">
          <table style="height: 134px; width: 100%;">
            <tr>
              <td style="border: 1px solid black; text-align: center;width: 55%;border-top: none; border-left:none; border-right:none;">Age & Sex</td>
              <td style="border: 1px solid black; text-align: center;width: 45%;border-top: none; border-right:none;"><?php if ($ms['sex'] != "") { ?> <?= $ms['age'] ?>/<?= $sex ?></td> <?php } ?>
            </tr>
            <tr>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-left:none; border-right:none;">HB</td>
              <td style="border: 1px solid black; text-align: center;border-top: none;border-right:none;"><?= $ms['hemoglobin'] ?></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-left:none; border-right:none;">HCT</td>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-right:none;"><?= $ms['hct'] ?></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-left:none; border-right:none;">Platlet</td>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-right:none;"><?= $ms['pet'] ?></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-left:none; border-right:none;">Weight</td>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-right:none;"><?= $ms['weight'] ?></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-left:none; border-right:none;border-bottom:none;">BP</td>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-right:none;border-bottom:none;"><?= $ms['bp'] ?></td>
            </tr>
          </table>
        </td>
        <td style="border: 1px solid black; text-align: center;">
            <table style="height: 134px; width: 100%;">
            
            <tr style="height: 33.33%;">
              <td style="border: 1px solid black; text-align: center;border-top: none; border-left:none; border-right:none;"><?= $ms['donor_type'] ?></td>
            </tr>
            <tr style="height: 33.33%;">
              <td style="border: 1px solid black; text-align: center;border-top: none; border-left:none; border-right:none;"><?= $ms['blood_group'] ?></td>
            </tr>
            <tr style="height: 33.33%;">
              <td style="border: 1px solid black; text-align: center;border-top: none; border-left:none; border-right:none;border-bottom:none;"><?= $ms['tube'] ?></td>
            </tr>
          </table>
        </td>
        <td style="border: 1px solid black; text-align: center;vertical-align: top;">
          <table style="height: 134px; width: 100%;">
            <tr>
              <td style="border: 1px solid black; text-align: center;width: 50%;border-top: none; border-left:none; border-right:none;">HIV</td>
              <td style="border: 1px solid black; text-align: center;width: 50%;border-top: none;  border-right:none;"><?= $ms['hiv'] == "Negative" ? "N" : "" ?><?= $ms['hiv'] == "Positive" ? "Y" : "" ?></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-left:none; border-right:none;">HBsAg</td>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-right:none;"><?= $ms['hbsag'] == "Negative" ? "N" : "" ?><?= $ms['hbsag'] == "Positive" ? "Y" : "" ?></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-left:none; border-right:none;">HCV</td>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-right:none;"><?= $ms['hcv'] == "Negative" ? "N" : "" ?><?= $ms['hcv'] == "Positive" ? "Y" : "" ?></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-left:none; border-right:none;">VDRL</td>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-right:none;"><?= $ms['vdrl'] == "Negative" ? "N" : "" ?><?= $ms['vdrl'] == "Positive" ? "Y" : "" ?></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-left:none; border-right:none;">MP</td>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-right:none;"><?= $ms['malaria'] == "Negative" ? "N" : "" ?><?= $ms['malaria'] == "Positive" ? "Y" : "" ?></td>
            </tr>
            <tr style="height: 14%;">
              <td style="border: 1px solid black; text-align: center;border-top: none; border-left:none; border-right:none;border-bottom:none;"></td>
              <td style="border: 1px solid black; text-align: center;border-top: none; border-right:none;border-bottom:none;"></td>
            </tr>
          </table>
        </td>
        <td style="border: 1px solid black; text-align: center;vertical-align: top;">
          <table style="height: 134px; width: 100%;">
              <!--<tr>-->
              <!--  <td style="border: 1px solid black; text-align: center;width:100%;border-top: none; border-left:none; border-right:none;">WB</td>-->
              <!--</tr>-->
            <?php foreach ($com_po as $key => $coms) {
              $last = count($com_po) - 1;
            ?>
              <tr>
                <td style="border: 1px solid black; text-align: center;<?= $key == $last ? 'border-bottom: none;' : '' ?>width:100%;border-top: none; border-left:none; border-right:none;"><?= $coms->master_type_key_short_value ?></td>
              </tr>
            <?php } ?>
            <tr style="height: 14%;">
              <td style="border: 1px solid black; text-align: center; border-left:none; border-right:none;border-bottom:none;"></td>
            </tr>
          </table>
        </td>
        <td style="border: 1px solid black; text-align: center;">
          <table style="height: 134px; width: 100%;">
              <!--<tr>-->
              <!--    <td style="border: 1px solid black; text-align: center;width:100%;border-top: none; border-left:none; border-right:none;">&nbsp;<?= $ms['wb'] ?></td>-->
              <!--</tr>-->
            <?php foreach ($com_po as $in => $coms) {
              $found = false;
              $last = count($com_po) - 1;
            ?>
              <tr>
                <?php if (count($ms['bloodRecord']) != 0) {
                  foreach ($ms['bloodRecord'] as $record) {
                    if ($coms->master_id == $record['component'] || ($coms->master_id == 18  && $record['component'] == "wholeblood")) {
                      $found = true;
                ?>
                      <td style="border: 1px solid black; text-align: center;<?= $in == $last ? 'border-bottom: none;' : '' ?>width:100%;border-top: none; border-left:none; border-right:none;">&nbsp;<?= $record['blood_volume'] ?></td>
                    <?php }
                  }
                  if (!$found) { ?>
                    <td style="border: 1px solid black; text-align: center;width:100%;border-top: none; border-left:none; border-right:none;<?= $in === $last ? 'border-bottom: none;' : '' ?>">&nbsp;</td>
                  <?php }
                } else { ?>
                  <td style="border: 1px solid black; text-align: center;<?= $in == $last ? 'border-bottom: none;' : '' ?>width:100%;border-top: none; border-left:none; border-right:none;">&nbsp;</td>
                <?php } ?>
              </tr>
            <?php } ?>
            <tr style="height: 14%;">
              <td style="border: 1px solid black; text-align: center; border-left:none; border-right:none;border-bottom:none;"></td>
            </tr>
            
          </table>
        </td>
        <td style="border: 1px solid black; text-align: center;">
          <table style="height: 134px; width: 100%;">
           
            <?php foreach ($com_po as $in => $coms) {
              $found = false;
              $last = count($com_po) - 1;
            ?>
              <tr>
                <?php if (count($ms['bloodRecord']) != 0) {
                  foreach ($ms['bloodRecord'] as $record) {
                    if ($coms->master_id == $record['component']  || ($coms->master_id == 18  && $record['component'] == "wholeblood")) {
                      $found = true; ?>
                      <td style="border: 1px solid black; text-align: center;<?= $in == $last ? 'border-bottom: none;' : '' ?>width:100%;border-top: none; border-left:none; border-right:none;">&nbsp;<?= date('d-m-Y', strtotime($record['expiry_date'])) ?></td>
                    <?php }
                  }
                  if (!$found) { ?>
                    <td style="border: 1px solid black; text-align: center;width:100%;border-top: none; border-left:none; border-right:none;<?= $in == $last ? 'border-bottom: none;' : '' ?>">&nbsp;</td>
                  <?php }
                } else { ?>
                  <td style="border: 1px solid black; text-align: center;<?= $in == $last ? 'border-bottom: none;' : '' ?>width:100%;border-top: none; border-left:none; border-right:none;">&nbsp;</td>
                <?php } ?>
              </tr>
            <?php } ?>
            <tr style="height: 14%;">
              <td style="border: 1px solid black; text-align: center; border-left:none; border-right:none;border-bottom:none;"></td>
            </tr>
          </table>
        </td>
        <td style="border: 1px solid black; text-align: center;">
          <table style="height: 134px; width: 100%;">
              
            <?php foreach ($com_po as $in => $coms) {
              $found = false;
              $last = count($com_po) - 1;
            ?>
              <tr>
                <?php if (count($ms['bloodRecord']) != 0) {
                  foreach ($ms['bloodRecord'] as $record) {
                    if ($coms->master_id == $record['component']  || ($coms->master_id == 18  && $record['component'] == "wholeblood")) {
                      $found = true;
                ?>

                      <td style="border: 1px solid black; text-align: center;<?= $in == $last ? 'border-bottom: none;' : '' ?>width:100%;border-top: none; border-left:none; border-right:none;">&nbsp;<?= $record['c_issue_no'] ?></td>
                    <?php }
                  }
                  if (!$found) { ?>
                    <td style="border: 1px solid black; text-align: center;width:100%;border-top: none; border-left:none; border-right:none;<?= $in == $last ? 'border-bottom: none;' : '' ?>">&nbsp;</td>
                  <?php }
                } else { ?>
                  <td style="border: 1px solid black; text-align: center;<?= $in == $last ? 'border-bottom: none;' : '' ?>width:100%;border-top: none; border-left:none; border-right:none;">&nbsp;</td>
                <?php } ?>
              </tr>
            <?php } ?>
            <tr style="height: 14%;">
              <td style="border: 1px solid black; text-align: center; border-left:none; border-right:none;border-bottom:none;"></td>
            </tr>
          </table>
        </td>
        <td style="border: 1px solid black; text-align: center;">
          <table style="height: 134px; width: 100%;">
            <?php foreach ($com_po as $in => $coms) {
              $found = false;
              $last = count($com_po) - 1;
            ?>
              <tr>
                <?php if (count($ms['bloodRecord']) != 0) {
                  foreach ($ms['bloodRecord'] as $record) {
                    if ($coms->master_id == $record['component']  || ($coms->master_id == 18  && $record['component'] == "wholeblood")) {
                      $found = true;
                ?>

                      <td style="border: 1px solid black; text-align: center;<?= $in == $last ? 'border-bottom: none;' : '' ?>width:100%;border-top: none; border-left:none; border-right:none;">&nbsp;<?= $record['discard_no'] ?></td>
                    <?php }
                  }
                  if (!$found) { ?>
                    <td style="border: 1px solid black; text-align: center;width:100%;border-top: none; border-left:none; border-right:none;<?= $in == $last ? 'border-bottom: none;' : '' ?>">&nbsp;</td>
                  <?php }
                } else { ?>
                  <td style="border: 1px solid black; text-align: center;<?= $in == $last ? 'border-bottom: none;' : '' ?>width:100%;border-top: none; border-left:none; border-right:none;">&nbsp;</td>
                <?php } ?>
              </tr>
            <?php } ?>
            <tr style="height: 14%;">
              <td style="border: 1px solid black; text-align: center; border-left:none; border-right:none;border-bottom:none;"></td>
            </tr>
          </table>
        </td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['anti_hbc'] ?></td>
        <td style="border: 1px solid black; text-align: center;">
          <table style="width: 100%;">
            <?php foreach ($com_po as $in => $coms) {
            ?>
              <tr>
                <?php if (count($ms['bloodRecord']) != 0) {
                  foreach ($ms['bloodRecord'] as $record) {
                    if ($coms->master_id == $record['component']  || ($coms->master_id == 18  && $record['component'] == "wholeblood")) {
                       if($record['pcv'] != ""){
                       ?>
                      
                      HCT : <?= $record['pcv'] ?><br>
                      Platelet Count :<?= $record['platelet'] ?> <br>
                      Factor-8 Fibrinogen : <?= $record['factor_8_fibrinogen'] ?><br>
                      Sterlity : <?= $record['sterllty'] ?><br>
                  <?php } }
                  }
                }?>
              </tr>
            <?php } ?>
          </table>
        </td>
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