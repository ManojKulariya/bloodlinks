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
<!--  <form action="<?php echo base_url('admin/donations/master_records'); ?>" method="GET">-->
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
  <?php echo ($bloodbank->address_1) ?></br><span style="text-align: center;font-weight: bold;">Component Register</span> </h6>
  
  <table style="line-height:1;border: 1px solid black;font-family: arial, sans-serif;border-collapse: collapse;width: 100%;font-size: 10px;">
    <tr>
      <th style="width: 8%;border: 1px solid black; text-align: center;" rowspan="2">Bag<br>Serial<br>No</th>
      <th style="width: 7%;border: 1px solid black; text-align: center;" rowspan="2">Blood<br>Group ABO &<br>Rh</th>
      <th style="width: 6%;border: 1px solid black; text-align: center;" rowspan="2">Date & Time<br>of<br>Bleeding</th>
      <th style="width: 6%;border: 1px solid black; text-align: center;" rowspan="2">Date & Time<br>of<br>Preparation</th>
      <th style="width: 10%;border: 1px solid black; text-align: center;" colspan="<?= count($com_po) ?>">Volume of Component</th>
      <th style="width: 6.5%;border: 1px solid black; text-align: center;" rowspan="2">Prepared<br>By</th>
      <th style="width: 12%;border: 1px solid black; text-align: center;" colspan="3">Quality Check</th>
      <th style="width: 10%;border: 1px solid black; text-align: center;" rowspan="2">Compatibility<br>Report</th>
      <th style="width: 10%;border: 1px solid black; text-align: center;" rowspan="2">Details of<br>Recipient</th>
      <th style="width: 8%;border: 1px solid black; text-align: center;" rowspan="2">Signature<br>of issuing<br>Person</th>
    </tr>
    <tr>
      <?php foreach ($com_po as $key => $coms) { ?>
        <th style="width: 3.5%;border: 1px solid black; text-align: center;"><?= $coms->master_type_key_short_value ?></th>
      <?php } ?>
      <th style="width: 5%;border: 1px solid black; text-align: center;">PRC<br>HCT</th>
      <th style="width: 6%;border: 1px solid black; text-align: center;">FFP<br>Factor-VIII<br>Fibrinogen</th>
      <th style="width: 5%;border: 1px solid black; text-align: center;">PC<br>Count</th>
    </tr>
    <?php foreach ($master_record as $ms) { ?>
      <tr style="width: 100%;">
        <td style="border: 1px solid black; text-align: center;"><?= $ms[0]['donor_unit_no'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms[0]['blood_group'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= date('d-m-Y', strtotime($ms[0]['d_d'])) ?> <?= $ms[0]['d_time'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= date('d-m-Y H:i:s', strtotime($ms[0]['created_at']))  ?></td>
        <?php 
        foreach ($com_po as $in => $coms) {
            $black = 0 ;
            foreach($ms as $mscom){
                $black = 0 ;
                if ($coms->master_id == $mscom['component'] || ($coms->master_id == 18  && $mscom['component'] == "wholeblood")) {
                    $black=1; 
                ?>
                
                <td style="border: 1px solid black; text-align: center;"><?= $mscom['blood_volume'] ?></td>
                <?php 
                    break;
                }
            }
            if($black == 0) {
                echo "<td style='border: 1px solid black; text-align: center;'></td>";
            }
        }
        ?>
        <td style="border: 1px solid black; text-align: center;"><?= $ms[0]['iss_by'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms[0]['pcv'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms[0]['frbrinogen'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms[0]['platelet'] ?></td>
        <td style="border: 1px solid black; text-align: center;">
          <table style="height: 134px;width: 100%;">
            <tr>
              <td style="border: 1px solid black; text-align: center;width:50%;border-top: none; border-left:none; border-right:none;">Compatible or<br>Incompatible</td>
              <td style="border: 1px solid black; text-align: center;width:50%;border-top: none; border-right:none;">
                  <?php
                  
                  foreach($ms as $final){ 
                  $res_data = $this->db->query("SELECT * FROM bl_crossmatch WHERE component='".$final['component']."' And cross_match = '" . $final['crossmatch_no'] . "'")->result_array();
                      foreach($res_data as $resdata){ 
                        ?>
                  <?= $resdata['final_cross'] ?>
                  <?php }
                  } ?>
            </td>
            </tr>
            <tr>
              <td style="height:25%;border: 1px solid black; text-align: center;width:50%;border-top: none; border-left:none; border-bottom:none;border-right:none;">cross match<br>no.</td>
              <td style="border: 1px solid black; text-align: center;width:50%;border-top: none; border-right:none;border-bottom:none;">
                  <?php
                  
                  foreach($ms as $final){ 
                  $res_data = $this->db->query("SELECT * FROM bl_crossmatch WHERE component='".$final['component']."' And cross_match = '" . $final['crossmatch_no'] . "'")->result_array();
                      foreach($res_data as $resdata){ 
                        ?>
                  <?= $resdata['cross_match'] ?>
                  <?php }
                  } ?></td>
            </tr>
          </table>
        </td>
        <td style="border: 1px solid black; text-align: center;">
          <table style="height: 134px;width: 100%;">
            <tr>
              <td style="border: 1px solid black; text-align: center;width:50%;border-top: none; border-left:none; border-right:none;">Name of<br>patient </td>
              <td style="border: 1px solid black; text-align: center;width:50%;border-top: none; border-right:none;"><?= $ms[0]['p_name'] ?></td>
            </tr>
            <tr>
              <td style="border: 1px solid black; text-align: center;width:50%;border-top: none; border-left:none; border-right:none;">Request no.</td>
              <td style="border: 1px solid black; text-align: center;width:50%;border-top: none; border-right:none;"><?= $ms[0]['req'] ?></td>
            </tr>
            <tr>
              <td style="height:25%;border: 1px solid black; text-align: center;width:50%;border-top: none; border-left:none; border-bottom:none;border-right:none;">Issue<br>serial no.</td>
              <td style="border: 1px solid black; text-align: center;width:50%;border-top: none; border-right:none;border-bottom:none;">
                 <?php foreach($ms as $final){ 
                  $res_data = $this->db->query("SELECT * FROM bl_crossmatch WHERE component='".$final['component']."' And cross_match = '" . $final['crossmatch_no'] . "'")->result_array();
                      foreach($res_data as $resdata){ 
                        ?>
                  <?= $resdata['issue_no'] ?>
                  <?php }
                  } ?>
                  
                </td>
            </tr>
          </table>
        </td>
        <td style="border: 1px solid black; text-align: center;">
        <?php if ($ms['0']['sign'] != "") {
            $base_url = str_replace('/admin', '', $this->data['base_url']);

          echo '<img src="' . $base_url . '/' . $ms[0]['sign'] . '" width="70px" height="70px" />';
        } ?>
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