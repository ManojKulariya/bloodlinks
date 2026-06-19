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

$base_url = str_replace('/admin', '', $this->data['base_url']);
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
  <form action="<?php echo base_url('admin/donations/master_discard_register'); ?>" method="GET">

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
                <label for="description">Auto Clave</label>
                <select  class="form-control" name="auto_clave">
                    <option value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="description">Reason</label>
                <input type="text" class="form-control" id="price" name="reason">
              </div>
            </div>
            


            <div class="col-md-3">
              <div class="card-footer">
                <div class="btn-group" style="float: right;">
                  <button type="submit" name="submit" class="btn btn-sm btn-danger">Filter</button>
                </div>
              </div>

            </div>
            <div class="col-md-3">
                <div class="card-footer">
                    <div class="btn-group" style="float: right;">
                        <a href="<?= base_url('admin/donations/master_discard_register'); ?>" class="btn btn-sm btn-success">Reset</a>
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

<div id="printtable">
<h6 style="text-align: center;line-height:1;"><?php echo ($bloodbank->name) ?><br> A UNIT OF VITA HEE CARE TRUST<br>
  <?php echo ($bloodbank->address_1) ?></br><span style="text-align: center;font-weight: bold;">Discard Register</span> </h6>
  
  <table style="border: 1px solid black;font-family: arial, sans-serif;border-collapse: collapse;width: 100%;font-size: 12px;">
    <tr>
      <th style="width: 12%;border: 1px solid black; text-align: center;">Discard No</th>
      <th style="width: 12%;border: 1px solid black; text-align: center;">Unit No.</th>
      <th style="width: 12%;border: 1px solid black; text-align: center;">Date</th>
      <th style="width: 12%;border: 1px solid black; text-align: center;">Component</th>
      <th style="width: 12%;border: 1px solid black; text-align: center;">Reason</th>
      <th style="width: 12%;border: 1px solid black; text-align: center;">Auto Clave</th>
      <th style="width: 12%;border: 1px solid black; text-align: center;">Hand Over</th>
      <th style="width: 12%;border: 1px solid black; text-align: center;">Signature</th>
    </tr>
    <?php foreach ($master_record as $ms) {    
    $com_p = get_com($ms['com_p']);
    $comp = get_com($ms['comp']);
    if($ms['discard_res'] == 'TTI Reactive'){
     $com_p='';
     $comp='wholeblood';
    }    ?>
      <tr style="width: 100%;">
        <td style="border: 1px solid black; text-align: center;"><?= $ms['discard_no'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['unit_no'] ?><?= $ms['unitno'] ?><?= $ms['dunitno'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= date('d-m-Y', strtotime($ms['date'])) ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $comp ?><?= $com_p ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['discard_res'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['autoclaved'] ?></td>
        <td style="border: 1px solid black; text-align: center;"><?= $ms['handover'] ?></td>
        <td style="border: 1px solid black; text-align: center;">
        <?php if ($ms['dsign'] != "") { echo '<img src="' . $base_url . '/' . $ms['dsign'] . '" width="70px" height="70px" />';    } ?>
        <!--<?php if ($ms['rsign'] != "") { echo '<img src="' . $base_url . '/' . $ms['rsign'] . '" width="70px" height="70px" />';    } ?>-->
        <!--<?php if ($ms['csign'] != "") { echo '<img src="' . $base_url . '/' . $ms['csign'] . '" width="70px" height="70px" />';    } ?>-->
        </td>
        
      </tr>
    <?php }  ?>
  </table>
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