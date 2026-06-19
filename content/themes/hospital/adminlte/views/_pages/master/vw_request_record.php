<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$base_url = str_replace('/admin', '', $this->data['base_url']);

$bank_id = $_SESSION['bank_id'];
$query3 = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id = '$bank_id'");
foreach ($query3->result() as $bloodbank) {
}
?>
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

<div class="container" id="printPageButton">
  
  <form action="<?php echo base_url('admin/donations/master_request'); ?>" method="GET">

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
                        <a href="<?= base_url('admin/donations/master_request'); ?>" class="btn btn-sm btn-success">Reset</a>
                    </div>
                </div>
            </div>

          </div>
        </div>
    </div>
    </div>
  </form>
</div>

<button id="printPageButton" onClick="window.print();" style="background-color: #ad1e1d;color: white;border-radius: 5px;border-color: white;padding: 5px 10px;">Print</button>
<br>
<!-- <h4>Blood Bank</h4> -->

<div id="printtable">
<h6 style="text-align: center;line-height:1;"><?php echo ($bloodbank->name) ?><br> A UNIT OF VITA HEE CARE TRUST<br>
  <?php echo ($bloodbank->address_1) ?></br><span style="text-align: center;font-weight: bold;">Request Register</span> </h6>
<table style="border: 1px solid black;font-family: arial, sans-serif;border-collapse: collapse;width: 100%;font-size: 10px;">
  <tr>
    <th style="width: 8%;border: 1px solid black; text-align: center;" rowspan="2">Request No</th>
    <th style="width: 8%;border: 1px solid black; text-align: center;" rowspan="2">Request Date</th>
    <th style="width: 10%;border: 1px solid black; text-align: center;" rowspan="2">Name &<br>Address</th>
    <th style="width: 10%;border: 1px solid black; text-align: center;" rowspan="2">Hospital &<br>Reg No</th>
    <th style="width: 9%;border: 1px solid black; text-align: center;" rowspan="2">Required Component</th>
    <th style="width: 8%;border: 1px solid black; text-align: center;" rowspan="2">Disease<br>Required Date</th>
    <th style="width: 10%;border: 1px solid black; text-align: center;" colspan="4">Donor</th>
    <th style="width: 8%;border: 1px solid black; text-align: center;" rowspan="2">Reason for<br>WR</th>
    <th style="width: 8%;border: 1px solid black; text-align: center;" rowspan="2">Payment No.<br>Amount</th>
    <th style="width: 8%;border: 1px solid black; text-align: center;" rowspan="2">Issue No<br>Date</th>
    <th style="width: 5%;border: 1px solid black; text-align: center;" rowspan="2">Remark</th>
  </tr>
  <tr>
    <th style="width: 4%;border: 1px solid black; text-align: center;">Rep</th>
    <th style="width: 4%;border: 1px solid black; text-align: center;">Card</th>
    <th style="width: 4%;border: 1px solid black; text-align: center;">APR</th>
    <th style="width: 4%;border: 1px solid black; text-align: center;">WR</th>
  </tr>
  <?php foreach ($master_record as $key => $ms) { 
    $comp = json_decode($ms['components_unit']);    
    ?>
    <tr style="width: 100%;">
      <td style="border: 1px solid black; text-align: center;"><?= $ms['request'] ?></td> 
      <td style="border: 1px solid black; text-align: center;"><?= date('d-m-Y', strtotime($ms['dates'])) ?></td>  
      <td style="border: 1px solid black; text-align: center;"><?= $ms['p_name'] ?><br><?= $ms['address'] ?></td>  
      <td style="border: 1px solid black; text-align: center;"><?= $ms['hospital'] ?><br><?= $ms['registration'] ?></td>  
      <td style="border: 1px solid black; text-align: center;">
        <?php
        foreach($comp as $inx=>$cm){
          if($cm != ""){
            if($inx == "whole_blood_unit"){ echo "WB : $cm<br>"; }
            if($inx == "Cryo_Poor_Plasma_unit"){ echo "CPP : $cm<br>"; }
            if($inx == "Cryoprecipitate_unit"){ echo "CRYO : $cm<br>"; }
            if($inx == "Single_Donor_Platellet_unit"){ echo "SDP : $cm<br>"; }
            if($inx == "Fresh_Frozen_Plasma_unit"){ echo "FFP : $cm<br>";}
            if($inx == "Red_blood_cell_unit"){ echo "RBC : $cm<br>"; }
            if($inx == "Platelet_rich_concentrate_unit"){ echo "PRBC : $cm<br>";}
          }
        }
        ?>
      </td>  
      <td style="border: 1px solid black; text-align: center;"><?= $ms['diagnosis'] ?><br>
          <?php
        // Create a DateTime object and format it
        $date = new DateTime($ms['required_date']);
        echo $date->format('d-m-Y'); // Format the date as dd-mm-yyyy
        ?></td>  
      <!--<td style="border: 1px solid black; text-align: center;"></td>  -->
        <td style="border: 1px solid black; text-align: center;">
            <?php foreach($ms['cromatchdata'] as $row) { 
                echo ($row['type'] == 'Replacement') ? 'Yes<br>' : '<br>'; 
            } ?>
        </td>
        <td style="border: 1px solid black; text-align: center;">
            <?php foreach($ms['cromatchdata'] as $row) { 
                echo ($row['type'] == 'Voluntary Card') ? 'Yes<br>' : '<br>'; 
            } ?>
        </td>
        <td style="border: 1px solid black; text-align: center;">
            <?php foreach($ms['cromatchdata'] as $row) { 
                echo ($row['type'] == 'APR') ? 'Yes<br>' : '<br>'; 
            } ?>
        </td>
        <td style="border: 1px solid black; text-align: center;">
            <?php foreach($ms['cromatchdata'] as $row) { 
                echo ($row['type'] == 'Without Replacement') ? 'Yes<br>' : '<br>'; 
            } ?>
        </td>
      <td style="border: 1px solid black; text-align: center;"><?php foreach($ms['cromatchdata'] as $row){ echo $row['res_wr'] ."<br>"; } ?></td>  
      <td style="border: 1px solid black; text-align: center;"><?php foreach($ms['cromatchdata'] as $row){ echo $row['payment'] ."<br>"; } ?></td>  
      <td style="border: 1px solid black; text-align: center;"><?php 
            foreach($ms['cromatchdata'] as $row){ 
            echo '('.$row['issue_no'].'<br>'.date('d-m-Y', strtotime($row['issue_date'])) .")<br>"; } ?></td>  
      <td style="border: 1px solid black; text-align: center;"></td>  

    </tr>
  <?php } ?>
</table>
<!-- Display pagination links -->
</div>
<br>
<div class="pagination-links">
  <?php echo $pagination; ?>
</div>
<br>


</div>