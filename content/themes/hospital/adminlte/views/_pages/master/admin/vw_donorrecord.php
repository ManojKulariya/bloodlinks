<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

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

<div class="container" id="printPageButton" >
  <form action="<?php echo base_url('admin/donations/admin_donor_records'); ?>" method="GET">

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
                        <a href="<?= base_url('admin/donations/donor_records'); ?>" class="btn btn-sm btn-success">Reset</a>
                    </div>
                </div>
            </div>

          </div>
        </div>
    </div>
    </div>
  </form>
</div>


<!-- <h4>Blood Bank</h4> -->
<div id="printtable">
<h6 style="text-align: center;line-height:1;"> <span style="text-align: center;font-weight: bold;">Blood Donor Record</span> </h6>

<table style="border: 1px solid black;font-family: arial, sans-serif;border-collapse: collapse;width: 100%;font-size: 10px;">
  <tr>
    <th style="width: 8%;border: 1px solid black; text-align: center;">Bag Serial No.<br>and<br>Bleeding Date</th>
    <th style="width: 13%;border: 1px solid black; text-align: center;">Donor Name, Perticulars<br>and<br>Address</th>
    <th style="width: 13%;border: 1px solid black; text-align: center;">Patient's Detail</th>
    <th style="width: 13%;border: 1px solid black; text-align: center;">Age & Sex, hemoglobin,<br>weight, & Blood pressure</th>
    <th style="width: 9%;border: 1px solid black; text-align: center;">Donor Type<br>Blood Group<br>Tube No</th>
    <th style="width: 10%;border: 1px solid black; text-align: center;">Selected for Donation<br>or Deffered </th>
    <th style="width: 11%;border: 1px solid black; text-align: center;">Reason of<br>Defferal</th>
    <th style="width: 11%;border: 1px solid black; text-align: center;">Done By</th>
    <th style="width: 12%;border: 1px solid black; text-align: center;">Signature of<br>Medical Officer</th>
  </tr>
  <?php foreach ($master_record as $key => $ms) {
    // print_r($ms);die();
    $txt = $ms['sex'] == "female" ? "d" : "s";
    $sex = $ms['sex'] == "female" ? "F" : "M"; ?>
    <tr style="height: 146px; width: 100%;">
      <td style="border: 1px solid black; text-align: center;"><?= $ms['unit_no'] ?><br><?= date('d-m-Y', strtotime($ms['donation_date'])) ?></td>
      <td style="border: 1px solid black; text-align: center;"><?= $ms['donor_name'] ?><br> <?= $txt ?>/o <?= $ms['father'] ?>
        <br><?= $ms['address'] ?><br><?= $ms['mobile'] ?>
      </td>
      <td style="border: 1px solid black; text-align: center;vertical-align: top;height: 100%;">
        <table style="height: 146px; width: 100%;">
          <tr style="height: 50%;vertical-align: top;">
            <td style="border: 1px solid black; text-align: center;overflow:hidden;border-top: none; border-left:none; border-right:none;border-bottom:none;">Patient Request Number<br><?= $ms['rep_request'] ?></td>
          </tr>
          <tr style="height: 50%;vertical-align: top;">
            <td style="border: 1px solid black; text-align: center;border-top: none;border-left:none; border-right:none;border-bottom:none;">Patient Name<br><?= $ms['patient_name'] ?></td>
          </tr>
        </table>
      </td>
      <td style="border: 1px solid black; text-align: center;">
        <table style="height: 146px; width: 100%;">
          <tr>
            <td style="border: 1px solid black; text-align: center;width: 55%;border-top: none; border-left:none; border-right:none;">Age & Sex</td>
            <td style="border: 1px solid black; text-align: center;width: 45%;border-top: none; border-right:none;"><?= $ms['age'] ?>/<?= $sex ?></td>
          </tr>
          <tr>
            <td style="border: 1px solid black; text-align: center;border-top: none; border-left:none; border-right:none;">HB</td>
            <td style="border: 1px solid black; text-align: center;border-top: none;border-right:none;"><?= $ms['hemoglobin'] ?></td>
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
      <td style="border: 1px solid black; text-align: center;"><?= $ms['selectedFor'] ?></td>
      <td style="border: 1px solid black; text-align: center;"><?= $ms['DeferReason'] ?></td>
      <td style="border: 1px solid black; text-align: center;"><?= $ms['donation_by'] ?></td>
      <td style="border: 1px solid black; text-align: center;">
        <?php if ($ms['ex_name'] != "") {
          // echo "<strong>" . $ms['ex_name'] . "</strong><br>";
          echo '<img src="' . $base_url . '/' . $ms['sign'] . '" width="70px" height="70px" />';
        } ?></td>

    </tr>
  <?php } ?>
</table>
</div>
 <!-- Display pagination links -->
 <br>
  <div class="pagination-links">
    <?php echo $pagination; ?>
  </div>
  <br>


</div>