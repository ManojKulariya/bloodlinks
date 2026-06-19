<style>
   .form-control {
      height: 25px !important;
      padding: 0 14px !important;
      font-size: 14px !important;
   }

   .card-footer {
      background-color: white !important;
   }

   label:not(.form-check-label):not(.custom-file-label) {
      font-size: 13px;
   }

   .content-header {
      display: none;
   }
</style>
<?php
$bank_id = $_SESSION['bank_id'];
$com = "";
if (!empty($_POST['submit'])) {
   $component    = $_POST['com_ponent'];
   $done_by    = $_POST['done_by'];
   $factor_8_fibrinogen    = $_POST['factor_8_fibrinogen'];
   if (isset($_POST['wb_unit_no'])) {

      $unit_no    = $_POST['wb_unit_no'];

      $qc_id      = $_POST['wb_qc_id'];
      $volume     = $_POST['wb_volume'];
      $qc_date    = $_POST['wb_qc_date'];
      $anti       = $_POST['wb_anti'];
      $collection = $_POST['wb_collection'];
      $pcv        = $_POST['wb_pcv'];
      $expiry     = $_POST['wb_expiry'];
      $sterllty   = $_POST['wb_sterllty'];
      $query20 = $this->db->query("SELECT * FROM bl_qc_component WHERE unit_no = '$unit_no'");
      foreach ($query20->result() as $data1) {
      }
      if (empty($data1)) {
         $insert = $this->db->query("INSERT INTO bl_qc_component (bloodbank_id,component,unit_no , qc_id, volume, qc_date, anti,  collection_date, pcv, expiry_date, sterllty,done_by,factor_8_fibrinogen) VALUES ('$bank_id','$component', '$unit_no' , '$qc_id' , '$volume' , '$qc_date', '$anti','$collection','$pcv','$expiry','$sterllty','$done_by','$factor_8_fibrinogen')");
      }
   }
   if (isset($_POST['prc_unit_no'])) {

      $unit_no    = $_POST['prc_unit_no'];
      $qc_id      = $_POST['prc_qc_id'];
      $volume     = $_POST['prc_volume'];
      $qc_date    = $_POST['prc_qc_date'];
      $collection = $_POST['prc_collection'];
      $pcv        = $_POST['prc_pcv'];
      $expiry     = $_POST['prc_expiry'];
      $query21 = $this->db->query("SELECT * FROM bl_qc_component WHERE unit_no = '$unit_no'");
      foreach ($query21->result() as $data2) {
      }
      if (empty($data2)) {
         $insert = $this->db->query("INSERT INTO bl_qc_component (bloodbank_id ,component, unit_no , qc_id, volume, qc_date, collection_date, pcv, expiry_date,done_by,factor_8_fibrinogen) VALUES ('$bank_id','$component', '$unit_no' , '$qc_id' , '$volume' , '$qc_date', '$collection','$pcv','$expiry','$done_by','$factor_8_fibrinogen')");
      }
   }
   if (isset($_POST['rdb_unit_no'])) {

      $unit_no    = $_POST['rdb_unit_no'];
      $qc_id      = $_POST['rdb_qc_id'];
      $volume     = $_POST['rdc_volume'];
      $qc_date    = $_POST['rdc_qc_date'];
      $collection = $_POST['rdc_collection'];
      $ptt        = $_POST['rdc_ptt'];
      $expiry     = $_POST['rdc_expiry'];
      $platelet   = $_POST['rdc_platelet'];
      $query22 = $this->db->query("SELECT * FROM bl_qc_component WHERE unit_no = '$unit_no'");
      foreach ($query22->result() as $data3) {
      }
      if (empty($data3)) {
         $insert = $this->db->query("INSERT INTO bl_qc_component (bloodbank_id ,component,unit_no , qc_id, volume, qc_date, collection_date, platelet, expiry_date,ptt,done_by,factor_8_fibrinogen) VALUES ('$bank_id', '$component','$unit_no' , '$qc_id' , '$volume' , '$qc_date', '$collection','$platelet','$expiry','$ptt','$done_by','$factor_8_fibrinogen')");
      }
   }
   if (isset($_POST['ffp_unit_no'])) {

      $unit_no    = $_POST['ffp_unit_no'];
      $qc_id      = $_POST['ffp_qc_id'];
      $volume     = $_POST['ffp_volume'];
      $qc_date    = $_POST['ffp_qc_date'];
      $collection = $_POST['ffp_collection'];
      $frbrinogen = $_POST['ffp_frbrinogen'];
      $expiry     = $_POST['ffp_expiry'];
      $fac   = $_POST['ffp_factor'];
      $factor = $fac * '0.7';
      $query23 = $this->db->query("SELECT * FROM bl_qc_component WHERE unit_no = '$unit_no'");
      foreach ($query23->result() as $data4) {
      }
      if (empty($data4)) {
         $insert = $this->db->query("INSERT INTO bl_qc_component  (bloodbank_id ,component,unit_no , qc_id, volume, qc_date, collection_date, frbrinogen, expiry_date,factor,done_by) VALUES ('$bank_id','$component','$unit_no' , '$qc_id' , '$volume' , '$qc_date', '$collection','$frbrinogen','$expiry','$factor','$done_by','$factor_8_fibrinogen')");
      }
   }
   redirect('admin/donations/qc_blood_components');
}
?>
<div class="container ">
   <h1 style="    font-size: 1.5rem;
   font-weight: 700;
   text-align: left;">QC for Blood & Components</h1>

   <div style="">
      <form action="<?php $_PHP_SELF ?>" method="POST">
         <div class="L9">
            <div id="div1" style="text-align:center;">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
               <label for="inputEmail3" class=" col-form-label">Enter Unit No.:</label>
               <input type="text" id="Registration" class="appli-new" name="unit_no" placeholder="">
               <button type="submit" class="btn btn-danger Search-new-btn" style="padding:4px 26px;">Submit</button>
            </div>
         </div>
      </form>
   </div>
   <?php
   // $array = [];
   if (!empty($_POST['unit_no'])) {
      $unit_no = $_POST['unit_no'];
      $query = $this->db->query("SELECT * FROM  bl_blood_record WHERE unit_no = '$unit_no' And bag_config = 'Mother'");
      foreach ($query->result() as $data) {
         $com = $data->component;
      }
      // echo "<pre>";
      // print_r($com);die();
   ?>
      <form action="<?php $_PHP_SELF ?>" method="POST">
         <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
         <input type="hidden" name="com_ponent" value="<?php echo $com ?>" />
         <div class="timeline">
            <div class="card pl-2 pr-2">
               <div class="card-header">
                  <!-- <h3 class="card-title">Register Blood Bank</h3> -->
                  <div class="btn-group" style="float: right;">
                     <a href="<?php echo $base_url; ?>/donations/qc_blood_components" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
                  </div>
               </div>
               <!--  <input type="hidden" class="form-control" id="price" name="donor_unit_no" value="<?php if (isset($row->donor_unit_no)) {
                                                                                                         echo $row->donor_unit_no;
                                                                                                      } ?>"> -->
               <div class="card-body">
                  <div class="pb-3">
                     <div class="row " style="margin-bottom: -12px;">
                        <div class="col-sm-6">
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-3">
                                    <label for="vender">QC Done By:</label>
                                 </div>
                                 <div class="col-md-4">
                                    <input type="text" class="form-control" name="done_by">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-3">
                                    <label for="vender">Factor-8 Fibrinogen:</label>
                                 </div>
                                 <div class="col-md-4">
                                    <input type="text" class="form-control" name="factor_8_fibrinogen">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php if ($com == 'wholeblood') {
                        $query1 = $this->db->query("SELECT * FROM  bl_blood_record WHERE component = 'wholeblood' And unit_no = '$unit_no' And bag_config = 'Mother'");
                        foreach ($query1->result() as $row) {
                        }
                     ?>

                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label for="vender">Unit No./Sub Unit No.:</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" id="price" name="wb_unit_no" value="<?php if (isset($row->unit_no)) {
                                                                                                                        echo $row->unit_no;
                                                                                                                     } ?>">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label for="vender">Component:</label>
                                    </div>
                                    <div class="col-md-10">
                                       <h6 class="mt-1"> Whole Blood (WB)</h6>
                                    </div>
                                 </div>
                              </div>
                           </div>

                        </div>
                        <?php $n1 = 6;
                        function reg1($n1)
                        {
                           $characters = '0123456789';
                           $randomString = '';

                           for ($i = 0; $i < $n1; $i++) {
                              $index = rand(0, strlen($characters) - 1);
                              $randomString .= $characters[$index];
                           }

                           return $randomString;
                        }

                        $qc1 = reg1($n1);
                        $qc11 = 'QC' . $qc1; ?>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">QC ID:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" id="price" value="<?php if (isset($qc11)) {
                                                                                                      echo $qc11;
                                                                                                   } ?>" name="wb_qc_id">
                                    </div>
                                    <!--  <div class="col-md-5">
                              <h6>(Auto Generated)</h6>
                           </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Volume:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" min="340" max="460" id="wb_volume" value="<?php if (isset($row->final_vol)) {
                                                                                                                              echo $row->final_vol;
                                                                                                                           } ?>" name="wb_volume">
                                    </div>
                                    <script>
                                       document.getElementById("wb_volume").addEventListener("change", function() {
                                          let v = parseInt(this.value);
                                          if (v < 340) this.value = 340;
                                          if (v > 460) this.value = 460;
                                       });
                                    </script>
                                    <div class="col-md-5">
                                       ML
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Date of Q.C:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" id="date" name="wb_qc_date">
                                    </div>
                                    <!--  <div class="col-md-5">
                              <h6>(take from system Date)</h6>
                           </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Anticoagulants:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" min="49" max="63" id="inp" name="wb_anti">
                                    </div>
                                    <script>
                                       document.getElementById("inp").addEventListener("change", function() {
                                          let v = parseInt(this.value);
                                          if (v < 49) this.value = 49;
                                          if (v > 63) this.value = 63;
                                       });
                                    </script>
                                    <div class="col-md-5">
                                       ML
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Date of Collection:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" id="price" value="<?php if (isset($row->donation_date)) {
                                                                                                      echo $row->donation_date;
                                                                                                   } ?>" name="wb_collection">
                                    </div>
                                    <!--  <div class="col-md-5">
                              <h6>(Calender Field)</h6>
                           </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">PCV (HCT):</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" min="30" max="40" id="wb_pcv" name="wb_pcv">
                                    </div>
                                    <script>
                                       document.getElementById("wb_pcv").addEventListener("change", function() {
                                          let v = parseInt(this.value);
                                          if (v < 30) this.value = 30;
                                          if (v > 40) this.value = 40;
                                       });
                                    </script>
                                    <div class="col-md-5">
                                       %
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Date of Expiry:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" id="price" value="<?php if (isset($row->expiry_date)) {
                                                                                                      echo $row->expiry_date;
                                                                                                   } ?>" name="wb_expiry">
                                    </div>
                                    <!--  <div class="col-md-5">
                              <h6>(Calender Field)</h6>
                           </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Sterllty</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" id="price" name="wb_sterllty">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php } ?>
                  </div>
                  <div class="pt-3 pb-3">
                     <?php if ($com == 22) {
                        $query2 = $this->db->query("SELECT * FROM  bl_blood_record WHERE component = 'PRC' And unit_no = '$unit_no' And bag_config = 'Mother'");
                        foreach ($query2->result() as $row1) {
                        }
                     ?>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label for="vender">Unit No./Sub Unit No.:</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" id="price" name="prc_unit_no" value="<?php if (isset($row1->unit_no)) {
                                                                                                                        echo $row1->unit_no;
                                                                                                                     } ?>">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label for="vender">Component:</label>
                                    </div>
                                    <div class="col-md-10">
                                       <h6 class="mt-1">PRC</h6>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php $n2 = 6;
                        function reg2($n2)
                        {
                           $characters = '0123456789';
                           $randomString = '';

                           for ($i = 0; $i < $n2; $i++) {
                              $index = rand(0, strlen($characters) - 1);
                              $randomString .= $characters[$index];
                           }

                           return $randomString;
                        }

                        $qc2 = reg2($n2);
                        $qc12 = 'QC' . $qc2; ?>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">QC ID:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" id="price" value="<?php if (isset($qc12)) {
                                                                                                      echo $qc12;
                                                                                                   } ?>" name="prc_qc_id">
                                    </div>
                                    <!--  <div class="col-md-5">
                              <h6>(Auto Generated)</h6>
                           </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Volume:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" min="330" max="370" id="prc_volume" value="<?php if (isset($row1->final_vol)) {
                                                                                                                              echo $row1->final_vol;
                                                                                                                           } ?>" name="prc_volume">
                                    </div>
                                    <script>
                                       document.getElementById("prc_volume").addEventListener("change", function() {
                                          let v = parseInt(this.value);
                                          if (v < 330) this.value = 330;
                                          if (v > 370) this.value = 370;
                                       });
                                    </script>
                                    <div class="col-md-5">
                                       ML
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Date of Q.C:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" id="date" name="prc_qc_date">
                                    </div>
                                    <!--  <div class="col-md-5">
                              <h6>(Take from system Date)</h6>
                           </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">PCV (HCT):</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" min="55" max="65" id="prc_pcv" name="prc_pcv">
                                    </div>
                                    <script>
                                       document.getElementById("prc_pcv").addEventListener("change", function() {
                                          let v = parseInt(this.value);
                                          if (v < 55) this.value = 55;
                                          if (v > 65) this.value = 65;
                                       });
                                    </script>
                                    <div class="col-md-5">
                                       ML
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Date of Collection:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" id="price" value="<?php if (isset($row1->donation_date)) {
                                                                                                      echo $row1->donation_date;
                                                                                                   } ?>" name="prc_collection">
                                    </div>
                                    <!-- <div class="col-md-5">
                              <h6>(Calender Field)</h6>
                           </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Date of Expiry:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" id="price" value="<?php if (isset($row1->expiry_date)) {
                                                                                                      echo $row1->expiry_date;
                                                                                                   } ?>" name="prc_expiry">
                                    </div>
                                    <!--  <div class="col-md-5">
                              (Calender Field)
                           </div> -->
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php } ?>
                  </div>
                  <div class="pt-3 pb-3">
                     <?php if ($com == 21) {

                        $query3 = $this->db->query("SELECT * FROM  bl_blood_record WHERE component = 'RDP' And unit_no = '$unit_no' And bag_config = 'Mother'");
                        foreach ($query3->result() as $row2) {
                        }
                     ?>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label for="vender">Unit No./Sub Unit No.:</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" id="price" name="rdp_unit_no" value="<?php if (isset($row2->unit_no)) {
                                                                                                                        echo $row2->unit_no;
                                                                                                                     } ?>">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label for="vender">Component:</label>
                                    </div>
                                    <div class="col-md-10">
                                       <h6 class="mt-1">RDP</h6>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php $n3 = 6;
                        function reg3($n3)
                        {
                           $characters = '0123456789';
                           $randomString = '';

                           for ($i = 0; $i < $n3; $i++) {
                              $index = rand(0, strlen($characters) - 1);
                              $randomString .= $characters[$index];
                           }

                           return $randomString;
                        }

                        $qc3 = reg1($n3);
                        $qc13 = 'QC' . $qc3; ?>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">QC ID:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" id="price" value="<?php if (isset($qc13)) {
                                                                                                      echo $qc13;
                                                                                                   } ?>" name="rdp_qc_id">
                                    </div>
                                    <!-- <div class="col-md-5">
                              <h6>(Auto Generated)</h6>
                           </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Volume:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" min="50" max="70" id="rdc_volume" value="<?php if (isset($row2->final_vol)) {
                                                                                                                           echo $row2->final_vol;
                                                                                                                        } ?>" name="rdc_volume">
                                    </div>
                                    <script>
                                       document.getElementById("rdc_volume").addEventListener("change", function() {
                                          let v = parseInt(this.value);
                                          if (v < 50) this.value = 50;
                                          if (v > 70) this.value = 70;
                                       });
                                    </script>
                                    <div class="col-md-5">
                                       ML
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Date of Q.C:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" id="date" name="rdc_qc_date">
                                    </div>
                                    <!--  <div class="col-md-5">
                              <h6>(Take from system Date)</h6>
                           </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Platelets Count:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" min="0.1" max="5.5" id="rdc_platelet" name="rdc_platelet">
                                    </div>
                                    <script>
                                       document.getElementById("rdc_platelet").addEventListener("change", function() {
                                          let v = parseInt(this.value);
                                          if (v < 0.1) this.value = 0.1;
                                          if (v > 5.5) this.value = 5.5;
                                       });
                                    </script>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Date of Collection:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" id="price" value="<?php if (isset($row2->donation_date)) {
                                                                                                      echo $row2->donation_date;
                                                                                                   } ?>" name="rdc_collection">
                                    </div>
                                    <!--  <div class="col-md-5">
                              <h6>(Calender Field)</h6>
                           </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">PTT:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" min="0.1" max="6.0" id="rdc_ptt" name="rdc_ptt">
                                    </div>
                                    <script>
                                       document.getElementById("prc_pcv").addEventListener("change", function() {
                                          let v = parseInt(this.value);
                                          if (v < 0.1) this.value = 0.1;
                                          if (v > 6.0) this.value = 6.0;
                                       });
                                    </script>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Date of Expiry:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" id="price" value="<?php if (isset($row2->expiry_date)) {
                                                                                                      echo $row2->expiry_date;
                                                                                                   } ?>" name="rdc_expiry">
                                    </div>
                                    <!--  <div class="col-md-5">
                              <h6>(Calender Field)</h6>
                           </div> -->
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php } ?>
                  </div>
                  <div class="pt-3 pb-3">
                     <?php if ($com == 20) {
                        $query4 = $this->db->query("SELECT * FROM  bl_blood_record WHERE component = 'FFP' And unit_no = '$unit_no' And bag_config = 'Mother'");
                        foreach ($query4->result() as $row3) {
                        }
                     ?>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label for="vender">Unit No./Sub Unit No.:</label>
                                    </div>
                                    <div class="col-md-8">
                                       <input type="text" class="form-control" id="price" name="ffp_unit_no" value="<?php if (isset($row3->unit_no)) {
                                                                                                                        echo $row3->unit_no;
                                                                                                                     } ?>">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label for="vender">Component:</label>
                                    </div>
                                    <div class="col-md-10">
                                       <h6 class="mt-1">FFP</h6>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php $n4 = 6;
                        function reg4($n4)
                        {
                           $characters = '0123456789';
                           $randomString = '';

                           for ($i = 0; $i < $n4; $i++) {
                              $index = rand(0, strlen($characters) - 1);
                              $randomString .= $characters[$index];
                           }

                           return $randomString;
                        }

                        $qc4 = reg4($n4);
                        $qc14 = 'QC' . $qc4; ?>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">QC ID:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" id="price" value="<?php if (isset($qc14)) {
                                                                                                      echo $qc14;
                                                                                                   } ?>" name="ffp_qc_id">
                                    </div>
                                    <!--  <div class="col-md-5">
                              <h6>(Auto Generated)</h6>
                           </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Volume:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" min="200" max="220" id="ffp_volume" value="<?php if (isset($row3->final_vol)) {
                                                                                                                              echo $row3->final_vol;
                                                                                                                           } ?>" name="ffp_volume">
                                    </div>
                                    <script>
                                       document.getElementById("ffp_volume").addEventListener("change", function() {
                                          let v = parseInt(this.value);
                                          if (v < 200) this.value = 200;
                                          if (v > 220) this.value = 220;
                                       });
                                    </script>
                                    <div class="col-md-5">
                                       ML
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Date of Q.C:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" id="date" name="ffp_qc_date">
                                    </div>
                                    <!--  <div class="col-md-5">
                              <h6>(Take from system Date)</h6>
                           </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Fibrinogen:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" min="200" max="400" id="ffp_frbrinogen" name="ffp_frbrinogen">
                                    </div>
                                    <script>
                                       document.getElementById("ffp_frbrinogen").addEventListener("change", function() {
                                          let v = parseInt(this.value);
                                          if (v < 200) this.value = 200;
                                          if (v > 400) this.value = 400;
                                       });
                                    </script>
                                    <div class="col-md-5">
                                       <h6>ML</h6>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Date of Collection:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" id="price" value="<?php if (isset($row3->donation_date)) {
                                                                                                      echo $row3->donation_date;
                                                                                                   } ?>" name="ffp_collection">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Factor VIII</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" class="form-control" id="price" name="ffp_factor">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label for="vender">Date of Expiry:</label>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" id="price" value="<?php if (isset($row3->expiry_date)) {
                                                                                                      echo $row3->expiry_date;
                                                                                                   } ?>" name="ffp_expiry">
                                    </div>
                                    <!-- <div class="col-md-5">
                              <h6>(Calender Field)</h6>
                           </div> -->
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php } ?>
                  </div>

                  <div class="card-footer">
                     <div class="btn-group" style="float: right;">
                        <button type="submit" value="submit" name="submit" class="btn btn-sm btn-danger"><i class="fas fa-save fw"></i> Save</button>
                     </div>
                  </div>
               </div>
            </div>
      </form>
   <?php } ?>
</div>
<script>
   const [date, time] = formatDate(new Date()).split(' ');
   console.log(date); // 👉️ 2021-12-31
   console.log(time); // 👉️ 09:43

   // ✅ Set Date input Value
   const dateInput = document.getElementById('date');
   dateInput.value = date;

   // 👇️️ "2021-12-31"
   console.log('dateInput value: ', dateInput.value);

   // ✅ Set time input value
   const timeInput = document.getElementById('time');
   timeInput.value = time;

   // 👇️ "09:43"
   console.log('timeInput value: ', timeInput.value);

   // ✅ Set datetime-local input value
   const datetimeLocalInput = document.getElementById('datetime-local');
   datetimeLocalInput.value = date + 'T' + time;

   // 👇️ "2021-12-31T10:09"
   console.log('dateTimeLocalInput value: ', datetimeLocalInput.value);

   // 👇️👇️👇️ Format Date as yyyy-mm-dd hh:mm:ss
   // 👇️ (Helper functions)
   function padTo2Digits(num) {
      return num.toString().padStart(2, '0');
   }

   function formatDate(date) {
      return (
         [
            date.getFullYear(),
            padTo2Digits(date.getMonth() + 1),
            padTo2Digits(date.getDate()),
         ].join('-') +
         ' ' + [
            padTo2Digits(date.getHours()),
            padTo2Digits(date.getMinutes()),
            // padTo2Digits(date.getSeconds()),  // 👈️ can also add seconds
         ].join(':')
      );
   }

   // 👇️ 2022-07-22 08:50:39
   console.log(formatDate(new Date()))

   // 👇️ 2025-05-04 05:24
   console.log(formatDate(new Date('May 04, 2025 05:24:07')))
</script>