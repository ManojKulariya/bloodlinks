<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<style type="text/css">
   .body {
   font-family: Jost, sans-serif !important;
   }
   a {
   outline: none;
   text-decoration: none;
   color: #555;
   }
   a:hover, a:focus {
   outline: none;
   text-decoration: none;
   }
   img {
   border: 0;
   }
   input, textarea, select {
   outline: none;
   resize: none;
   font-family: 'Muli', sans-serif;
   }
   a, input, button {
   outline: none !important;
   }
   button::-moz-focus-inner {
   border: 0;
   }
   h1, h2, h3, h4, h5, h6 {
   margin: 0;
   padding: 0;
   font-weight: 700;
   color: #202342;
   font-family: 'Muli', sans-serif;
   }
   img {
   border: 0;
   vertical-align: top;
   max-width: 100%;
   height: auto;
   }
   ul, ol {
   margin: 0;
   padding: 0;
   list-style: none;
   }
   p {
   margin: 0 0 15px 0;
   padding: 0;
   }
   .container-fluid{
   max-width: 1900px;
   }
   .widget-style3:hover img {
    filter: brightness(0) invert(1) !important;
}
   /* Common Class */
   .pd-5{padding: 5px;}
   .pd-10{padding: 10px;}
   .pd-20{padding: 20px;}
   .pd-30{padding: 30px;}
   .pb-10{padding-bottom: 10px;}
   .pb-20{padding-bottom: 20px;}
   .pb-30{padding-bottom: 30px;}
   .pt-10{padding-top: 10px;}
   .pt-20{padding-top: 20px;}
   .pt-30{padding-top: 30px;}
   .pr-10{padding-right: 10px;}
   .pr-20{padding-right: 20px;}
   .pr-30{padding-right: 30px;}
   .pl-10{padding-left: 10px;}
   .pl-20{padding-left: 20px;}
   .pl-30{padding-left: 30px;}
   .px-30{padding-left: 30px; padding-right: 30px;}
   .px-20{padding-left: 20px; padding-right: 20px;}
   .py-30{padding-top: 30px; padding-bottom: 30px;}
   .py-20{padding-top: 20px; padding-bottom: 20px;}
   .mb-30{margin-bottom: 30px;}
   .mb-50{margin-bottom: 20px;}
   .font-30{font-size: 20px; line-height: 1.46em;}
   .font-24{font-size: 24px; line-height: 1.5em;}
   .font-20{font-size: 15.3px; line-height: 1.5em;}
   .font-18{font-size: 18px; line-height: 1.6em;}
   .font-16{font-size: 16px; line-height: 1.75em;}
   .font-14{font-size: 14px; line-height: 1.85em;}
   .font-12{font-size: 12px; line-height: 2em;}
   .weight-300{font-weight: 300;}
   .weight-400{font-weight: 400;}
   .weight-500{font-weight: 500;}
   .weight-600{font-weight: 600;}
   .weight-700{font-weight: 700;}
   .weight-800{font-weight: 800;}
   .text-blue{color: #1b00ff;}
   .text-dark{color: #000000;}
   .text-white{color: #ffffff;}
   .height-100-p{height: 100%;}
   .bg-white{background: #ffffff;}
   .border-radius-10{
   -webkit-border-radius: 10px;
   -moz-border-radius: 10px;
   border-radius: 30px 0;
   }
   .border-radius-100{
   -webkit-border-radius: 100%;
   -moz-border-radius: 100%;
   border-radius: 100%;
   }
   .box-shadow{
   -webkit-box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
   -moz-box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
   box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
   }
   .gradient-style1{
   background-image: linear-gradient( 135deg, #43CBFF 10%, #9708CC 100%);
   }
   .gradient-style2{
   background-image: linear-gradient( 135deg, #72EDF2 10%, #5151E5 100%);
   }
   .gradient-style3{
   background-image: radial-gradient( circle 732px at 96.2% 89.9%,  rgba(70,66,159,1) 0%, rgba(187,43,107,1) 92% );
   }
   .gradient-style4{
   background-image: linear-gradient( 135deg, #FF9D6C 10%, #BB4E75 100%);
   }
   /* widget style 1 */
   .widget-style1{
   padding: 20px 10px;
   }
   .widget-style1 .circle-icon{
   width: 60px;
   }
   .widget-style1 .circle-icon .icon{
   width: 60px;
   height: 60px;
   background: #ecf0f4;
   display: flex;
   align-items: center;
   justify-content: center;
   }
   .widget-style1 .widget-data{
   width: calc(100% - 150px);
   padding: 0 15px;
   }
   .widget-style1 .progress-data{
   width: 90px;
   }
   .widget-style1 .progress-data .apexcharts-canvas{
   margin: 0 auto;
   }
   .content-header h1 {
   font-size: 18px;
   /*margin: 0 20px;*/
   }
   .widget-style2 .widget-data{
   padding: 20px;
   }
   .widget-style3 {
   box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
   padding: 15px;
   border-radius: 15px;
   position: relative;
   z-index: 1;
   height: 100%;
   transition: .5s;
   }
   .widget-style3:hover:before {
   height: 100%;
   background: #ad1e1d;
   }
   .widget-style3:before {
   position: absolute;
   content: "";
   z-index: -1;
   width: 100%;
   height: 0;
   background: #ad1e1d;
   left: 0;
   bottom: 0;
   transition: .5s;
   border-radius: 15px;
   }
   .widget-style3:hover i {
   color: #fff;
   }
   .widget-style3:hover .weight-500.font-20 {    
   color: #fff;
   }
   .widget-style3:hover .text-dark{
   color: #fff !important;
   }
   a.d-block {
   color: #ad1e1d !important;
   font-weight: bold;
   }
   .widget-style3 .widget-data{
   width: calc(100% - 60px);
   }
   .widget-style3 .widget-icon {
   width: 30px;
   height: 50px;
   font-size: 30px;
   line-height: 1;
   margin: 0 15px;
   }
   .widget-style3 i {
    color: black;
}
   .widget-style3:hover img {
   -webkit-filter: invert(40%) grayscale(100%) brightness(40%) sepia(100%) hue-rotate(-70deg) saturate(400%) contrast(2);
   /* filter: grayscale(100%) brightness(40%) sepia(100%) hue-rotate(-50deg) saturate(600%) contrast(0.8); */
   }
   .apexcharts-legend-marker{
   margin-right: 6px !important;
   }
   .page_title_card {
    display: flex;
    margin-bottom: 6px;
}
.page_title_card h5 {
    font-size: 16px;
    font-weight: 500;
    color: gray;
    padding: 0 10px 0 0;
}
.content-wrapper {
    background: #fff;
    text-transform: capitalize;
}
.super-cards {
  padding: 0 30px;
}
.Purchase-card {
  box-shadow: rgb(149 157 165 / 20%) 0px 8px 24px;
    padding: 20px;
    height: 100%;
}
.dash-graph {
  padding: 0 30px;
}
</style>

<section class="content-header">
<div class="container">
 <div class="timeline">
   <!-- <div class="time-label">
      <span class="bg-red">Consumables Items</span>
      </div> -->
   <div class="card">
      
   <div class="card-body">
      
      <div class="container-fluid pb-3">
    
         <?php 
         $components = "18, 'wholeblood', 20, 21, 886, 22";
         // Calculate financial year start and end dates
        $currentYear = date('Y');
        $currentMonth = date('m');
    
        if ($currentMonth >= 4) {
            // Financial year is from April of current year to March of next year
            $start_date = "$currentYear-04-01";
            $end_date = ($currentYear + 1) . "-03-31";
        } else {
            // Financial year is from April of the previous year to March of current year
            $start_date = ($currentYear - 1) . "-04-01";
            $end_date = "$currentYear-03-31";
        }
    
            $admin_id = $_SESSION['admin_type'];
            if ($admin_id == "1"){ ?>
                
         <h1>Registered Organisations</h1>
         <br>
         <div class="row" style="">
            <div class="col-xl-3 mb-50">
            <a href="<?php echo base_url('admin/bloodbanks')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Blood Banks</div>
                        <div class="weight-500 font-30 text-dark"><?=$query1->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><img src="<?php echo base_url('uploads/app/Total-Donation.png');?>"></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
        <div class="col-xl-3 mb-50">
            <a href="<?php echo base_url('admin/hospitals')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Hospitals</div>
                        <div class="weight-500 font-30 text-dark"><?=$query2->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa fa-hospital" aria-hidden="true"></i></div>
                     </div>
                  </div>
               </div>
            </a>

            </div>


           <div class="col-xl-3 mb-50">
            <a href="<?php echo base_url('admin/labs')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Labs</div>
                        <div class="weight-500 font-30 text-dark"><?=$query33->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-flask-vial"></i></div>
                     </div>
                  </div>
               </div>
            </a>
            </div>
         </div>
         <h1> Blood Donations</h1>
         <br>
         <div class="row" style="">
           <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/register_donars')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Donor Registered</div>
                        <div class="weight-500 font-30 text-dark"><?=$TotalDonor->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-address-card"></i></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>

            <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/donation_appointments_donor')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Appointments Scheduled</div>
                        <div class="weight-500 font-30 text-dark"><?=$schedule_app->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-calendar-check"></i></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
           <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/total_pending_app')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Pending Appointments</div>
                        <div class="weight-500 font-30 text-dark"><?=$pending_app->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-calendar-xmark"></i></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
           <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/defer_donars')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Deferred Donors</div>
                        <div class="weight-500 font-30 text-dark"><?=$query6->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
            
         </div>
         <h1> Blood Requests</h1>
         <br>
<!-- <div class="row"> -->
         <div class="row" style="">
             <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/total_blood_payment')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Payment</div>
                        <div class="weight-500 font-30 text-dark"><?=$blood_payment ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><img src="<?php echo base_url('uploads/app/Total-Requests.png');?>"></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
            <?php  $query7 = $this->db->query("SELECT * FROM bl_blood_request"); ?>
            <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/Request_appointments')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Blood Requests</div>
                        <div class="weight-500 font-30 text-dark"><?=$query7->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa fa-tint" aria-hidden="true"></i></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
            <?php  $query8 = $this->db->query("SELECT * FROM bl_crossmatch JOIN bl_blood_banks ON bl_crossmatch.bloodbank_id = bl_blood_banks.blood_bank_id 
            where bl_crossmatch.status IN ('issued','crossmatch') "); ?>
            <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/total_request_met')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Request Met</div>
                        <div class="weight-500 font-30 text-dark"><?=$query8->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-user-check"></i></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
            <?php  $query9 = $this->db->query("SELECT * FROM bl_crossmatch where status = 'issued' AND bl_crossmatch.created_at <= '{$end_date}' AND bl_crossmatch.created_at >= '{$start_date}' AND component IN ($components)  "); ?>
            <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/total_blood_issue') ?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Blood Issued</div>
                        <div class="weight-500 font-30 text-dark"><?=$query9->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-regular fa-address-card"></i></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
            <?php  $query99 = $this->db->query("SELECT * FROM bl_bb_donatioform where status = 'discard'"); ?>
            <div class="col-xl-3 mb-50">
              <!--<a href="<?php echo base_url('admin/discard')?>">-->
              <a href="<?php echo base_url('admin/donations/discard')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Blood Discard</div>
                        <div class="weight-500 font-30 text-dark"><?=$query99->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-droplet-slash"></i></div>
                     </div>
                  </div>
               </div>
             </a>
            </div>
            
            <div class="col-xl-3 mb-50">
            <a href="<?php echo base_url('admin/blood_inventory')?>">

               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Blood Stock</div>
                        <div class="weight-500 font-30 text-dark"><?=$invsum; ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-droplet"></i></div>
                     </div>
                  </div>
               </div>
             </a>
            </div>
            <div class="col-xl-3 mb-50">
            <a href="<?php echo base_url('admin/camp_planned')?>">

               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Camps Planned</div>
                        <div class="weight-500 font-30 text-dark"><?=$querycamprec; ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-campground"></i></div>
                     </div>
                  </div>
               </div>
             </a>
            </div>
            <div class="col-xl-3 mb-50">
            <a href="<?php echo base_url('admin/pending_request_blood')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Pending Blood Request</div>
                        <div class="weight-500 font-30 text-dark"><?= $pen_b_req ?> </div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-hourglass-half"></i></div>
                     </div>
                  </div>
               </div>
             </a>
            </div>
          
         
         <?php }  ?>
         
          <?php    if ($admin_id == "5"){
                $id = $_SESSION['bank_id'];
            ?>
            
         <h1>Blood Donations</h1>
         <br>
         <div class="row" style="">
            <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/register_donars')?>">

               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Donor Registered</div>
                        <div class="weight-500 font-30 text-dark"><?=$TotalDonor->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><img src="<?php echo base_url('uploads/app/Total-Donation.png');?>"></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>

            <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/donation_appointments_donor')?>">

               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Appointments Scheduled</div>
                        <div class="weight-500 font-30 text-dark"><?=$schedule_app->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-calendar-check"></i></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>

            
            <?php  $query12 = $this->db->query("SELECT * FROM bl_bb_donatioform where bloodbank_id = '$id' AND status = 'Pending'"); ?>
            <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/total_pending_app')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Pending Appointments</div>
                        <div class="weight-500 font-30 text-dark"><?=$pending_app->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-calendar-xmark"></i></div>
                     </div>
                  </div>
               </div>
              </a>
            </div>


            <?php  $query14 = $this->db->query("SELECT * FROM bl_bb_donatioform where bloodbank_id = '$id' AND status = 'Pending'"); ?>
            <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/donations/discard')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Discards </div>
                        <div class="weight-500 font-30 text-dark"><?=$query14->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-droplet-slash"></i></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
         </div>

         <div class="row">
            
         <?php  $query13 = $this->db->query("SELECT * FROM bl_bb_donatioform where bloodbank_id = '$id' AND status = 'Pending'"); ?> 
            <div class="col-xl-3 mb-50">
               <!-- <a href="https://bloodlinks.in/admin/deferred_donor"> -->
               <a href="<?php echo base_url('admin/defer_donars')?>">

               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Deferred Donors</div>
                        <div class="weight-500 font-30 text-dark"><?=$query13->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><img src="<?php echo base_url('uploads/app/Total-Deferred-Donors.png');?>"></div>
                     </div>
                  </div>
               </div>
              </a>
            </div>

            <?php  $query15 = $this->db->query("SELECT * FROM bl_bb_donatioform where bloodbank_id = '$id' AND status IN ('Test Not Done', 'Pending')"); ?>
            <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/tti_test')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">TTI Test Pending</div>
                        <div class="weight-500 font-30 text-dark"><?=$query15->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><img src="<?php echo base_url('uploads/app/TTI-Test.png');?>"></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
         </div>
         <h1>Blood Requests</h1>
         <br>
         <div class="row" style="">
            <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/total_blood_payment')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Payment</div>
                        <div class="weight-500 font-30 text-dark"><?=$blood_payment ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><img src="<?php echo base_url('uploads/app/Total-Requests.png');?>"></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
            <div class="col-xl-3 mb-50">
            <a href="<?php echo base_url('admin/pending_request_blood')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-19">Pending Blood Request</div>
                        <div class="weight-500 font-30 text-dark"><?= $pen_b_req ?> </div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-hourglass-half"></i></div>
                     </div>
                  </div>
               </div>
             </a>
            </div>

            <?php  $query17 = $this->db->query("SELECT * FROM bl_crossmatch where status = 'crossmatch' AND bloodbank_id = '$id'"); ?>

            <div class="col-xl-3 mb-50">
            <a href="<?php echo base_url('admin/total_request_met')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Cross Match Pending</div>
                        <div class="weight-500 font-30 text-dark"><?=$query17->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><img src="<?php echo base_url('uploads/app/Cross-Match-Pending.png');?>"></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
            <?php  $query8 = $this->db->query("SELECT * FROM bl_crossmatch where bl_crossmatch.status IN ('issued','crossmatch') AND bl_crossmatch.bloodbank_id = '$id'"); ?>
            <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/total_request_met')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Request Met </div>
                        <div class="weight-500 font-30 text-dark"><?=$query8->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-user-check"></i></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
            <?php  $query18 = $this->db->query("SELECT * FROM bl_crossmatch where status = 'issued' AND bl_crossmatch.created_at <= '{$end_date}' AND bl_crossmatch.created_at >= '{$start_date}' AND component IN ($components)  AND bloodbank_id = '$id'"); ?>
            <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/total_blood_issue') ?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Blood Issued</div>
                        <div class="weight-500 font-30 text-dark"><?=$query18->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><img src="<?php echo base_url('uploads/app/Total_Issued.png');?>"></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
            <div class="col-xl-3 mb-50">
            <a href="<?php echo base_url('admin/blood_inventory')?>">

               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Blood Stock</div>
                        <div class="weight-500 font-30 text-dark"><?=$invsum; ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-droplet"></i></div>
                     </div>
                  </div>
               </div>
             </a>
            </div>

            <?php  $query19 = $this->db->query("SELECT * FROM bl_crossmatch where status = 'return' AND bloodbank_id = '$id'"); ?>
            <div class="col-xl-3 mb-50">
               <a href="<?php echo base_url('admin/request/blood_return')?>">
               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Total Returns</div>
                        <div class="weight-500 font-30 text-dark"><?=$query19->num_rows(); ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><img src="<?php echo base_url('uploads/app/Total_Return.png');?>"></div>
                     </div>
                  </div>
               </div>
               </a>
            </div>
            <div class="col-xl-3 mb-50">
            <a href="<?php echo base_url('admin/camp_planned')?>">

               <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                  <div class="d-flex flex-wrap">
                     <div class="widget-data">
                        <div class="weight-500 font-20">Camps Planned</div>
                        <div class="weight-500 font-30 text-dark"><?=$querycamprec; ?></div>
                     </div>
                     <div class="widget-icon">
                        <div class="icon"><i class="fa-solid fa-campground"></i></div>
                     </div>
                  </div>
               </div>
             </a>
            </div>
         </div>
                
         <?php } ?>

         </div>
</div>
      </div>
   </div>
</section>