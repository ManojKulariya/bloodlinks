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
<style>
    /* Font size */
    #table_bb_details {
        font-size: 13px; /* Adjust the font size as needed */
    }

    /* Row height */
    #table_bb_details tbody tr {
        height: 40px; /* Adjust the row height as needed */
    }

    /* Cell padding */
    #table_bb_details td, #table_bb_details th {
        padding: 5px; /* Adjust cell padding as needed */
    }

    /* ########## */
    
    #table_bb_deffer {
        font-size: 13px; 
    }

    #table_bb_deffer tbody tr {
        height: 40px; 
    }

    #table_bb_deffer td, #table_bb_deffer th {
        padding: 5px; 
    }

     /* ########## */
    
     #table_bb_request {
        font-size: 13px; 
    }

    #table_bb_request tbody tr {
        height: 40px; 
    }

    #table_bb_request td, #table_bb_request th {
        padding: 5px; 
    }

    /* ########## */
    
    #table_bb_request_met {
        font-size: 13px; 
    }

    #table_bb_request_met tbody tr {
        height: 40px; 
    }

    #table_bb_request_met td, #table_bb_request_met th {
        padding: 5px; 
    }

     /* ########## */
    
     #table_bb_inv {
        font-size: 13px; 
    }

    #table_bb_inv tbody tr {
        height: 40px; 
    }

    #table_bb_inv td, #table_bb_inv th {
        padding: 5px; 
    }
    /* ########## */
    
    #table_bb_camp {
        font-size: 13px; 
    }

    #table_bb_camp tbody tr {
        height: 40px; 
    }

    #table_bb_camp td, #table_bb_camp th {
        padding: 5px; 
    }
      /* ########## */
    
      #table_bb_donar_app {
        font-size: 13px; 
    }

    #table_bb_donar_app tbody tr {
        height: 40px; 
    }

    #table_bb_donar_app td, #table_bb_donar_app th {
        padding: 5px; 
    }
      /* ########## */
    
      #table_bb_req_app {
        font-size: 13px; 
    }

    #table_bb_req_app tbody tr {
        height: 40px; 
    }

    #table_bb_req_app td, #table_bb_req_app th {
        padding: 5px; 
    }


</style>

<section class="content-header">
<div class="container">
 <div class="timeline">
   
   <div class="card">
      
   <div class="card-body">
      
      <div class="container-fluid pb-3">
        
         <?php 
           
            $admin_id = $_SESSION['admin_type'];
           ?>

         <div class="row" style="">
           
           <div class="col-12">
           <section class="content-header" style="padding-bottom :5px;">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1></h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
					<!-- date rage  -->
					<div class="dropdown">
					<div class="dropdown-btn-container">
					<i class="fa fa-calendar"></i>
					<button onclick="toggleDropdown()" class="dropbtn">Selected:</button>
					</div>
					<div id="dropdownContent" class="dropdown-content">
					<div onclick="selectTimeRange(0)">Today</div>
					<div onclick="selectTimeRange(10)">Last 10 Days</div>
					<div onclick="selectTimeRange(30)">Last 30 Days</div>
					<div onclick="selectTimeRange(60)">Last 60 Days</div>
					<div onclick="selectTimeRange(90)">Last 90 Days</div>
					<div class="custom-date-range">Custom Date Range</div>
					<input type="text" id="customRangePicker" style="display: none;" />
					</div>
					</div>
					<script>
					function toggleDropdown() {
					var dropdownContent = document.getElementById("dropdownContent");
					dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
					}
					function selectTimeRange(range) {
					var dropdownContent = document.getElementById("dropdownContent");
					var dropdownButton = document.querySelector(".dropbtn");
					if(range == 0){
					ranges = "Selected: Today"
					var  daysfilter = 0;
					}else{
					var  daysfilter = range;
					ranges = "Selected: Last "+range+" Days";
					}
					$('#daysfillter').val(daysfilter);
					$('#start_date').val("");
					$('#end_date').val("");
					dropdownButton.textContent = ranges;
					dropdownContent.style.display = "none"; // close the dropdown after selection
					reloadDataTable();
					}
					document.querySelector('.custom-date-range').addEventListener('click', function() {
					var datePickerInput = document.getElementById('customRangePicker');
					datePickerInput.style.display = 'block';
					$(datePickerInput).daterangepicker({
					opens: 'up',
					});
					$(datePickerInput).on('apply.daterangepicker', function(ev, picker) {
					var startdate = picker.startDate.format('YYYY-MM-DD');
					var enddate = picker.endDate.format('YYYY-MM-DD');
					$('#start_date').val(startdate);
					$('#end_date').val(enddate);
					var selectedRange = startdate + ' to ' + enddate;
					reloadDataTable();

					var dropdownButton = document.querySelector(".dropbtn");
					dropdownButton.textContent = "Selected: " + selectedRange;
					dropdownContent.style.display = "none"; // close the dropdown after selection
					});
					});
					</script>
          <?php 
          $enddate = new DateTime();
          $startdate = (clone $enddate)->modify('-1 year');
          $enddateFormatted = $enddate->format('Y-m-d');
          $startdateFormatted = $startdate->format('Y-m-d');
          ?>
					<input type="hidden" name="daysfillter" id="daysfillter" value="">
					<input type="hidden" name="start_date" id="start_date" value="<?php echo $startdateFormatted;?>">
					<input type="hidden" name="end_date" id="end_date" value="<?php echo $enddateFormatted;?>">
					<!-- end date range -->   
				
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
	    </section>
         </div>
           <!-- --------------- -->
            <div class="row col-12" >
            <div class="col-12 mb-3">
                  <div class="cards">
                     <div class="card-headers">
                        <b class="card-titles">Total Request Met</b>&nbsp;
                        <a id="downloadMET_req_BL_excelLink" href="#" style="text-decoration: underline; color: #0D2942;">Download
                           Excel</a>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-bodys">
                        <table id="table_bb_request_met" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Blood Bank</th>
                                 <th>Whole Blood</th>
                                 <th>PRC/ Packed Cell</th>
                                 <th>RDP/SDP</th>
                                 <th>FFP/Plasma</th>
                                 <th>Total</th>
                              </tr>
                           </thead>
                           <tbody>
                           </tbody>
                        </table>
                        <a href="#" id="load_more_link_bb_met">View More</a>

                     </div>
                  </div>
               </div>
               </div>

              
            </div>
        

</div>

      </div>
   </div>
   <!-- </div>/.container-fluid -->
</section>
<script type="text/javascript">
   var options = {
   series: [80],
   grid: {
   padding: {
   top: 0,
   right: 0,
   bottom: 0,
   left: 0
   },
   },
   chart: {
   height: 100,
   width: 70,
   type: 'radialBar',
   },  
   plotOptions: {
   radialBar: {
   hollow: {
     size: '50%',
   },
   dataLabels: {
     name: {
       show: false,
       color: '#fff'
     },
     value: {
       show: true,
       color: '#333',
       offsetY: 5,
       fontSize: '15px'
     }
   }
   }
   },
   colors: ['#ecf0f4'],
   fill: {
   type: 'gradient',
   gradient: {
   shade: 'dark',
   type: 'diagonal1',
   shadeIntensity: 0.8,
   gradientToColors: ['#1b00ff'],
   inverseColors: false,
   opacityFrom: [1, 0.2],
   opacityTo: 1,
   stops: [0, 100],
   }
   },
   states: {
   normal: {
   filter: {
     type: 'none',
     value: 0,
   }
   },
   hover: {
   filter: {
     type: 'none',
     value: 0,
   }
   },
   active: {
   filter: {
     type: 'none',
     value: 0,
   }
   },
   }
   };
   
   var options2 = {
   series: [70],
   grid: {
   padding: {
   top: 0,
   right: 0,
   bottom: 0,
   left: 0
   },
   },
   chart: {
   height: 100,
   width: 70,
   type: 'radialBar',
   },  
   plotOptions: {
   radialBar: {
   hollow: {
     size: '50%',
   },
   dataLabels: {
     name: {
       show: false,
       color: '#fff'
     },
     value: {
       show: true,
       color: '#333',
       offsetY: 5,
       fontSize: '15px'
     }
   }
   }
   },
   colors: ['#ecf0f4'],
   fill: {
   type: 'gradient',
   gradient: {
   shade: 'dark',
   type: 'diagonal1',
   shadeIntensity: 1,
   gradientToColors: ['#66c6ba'],
   inverseColors: false,
   opacityFrom: [1, 0.2],
   opacityTo: 1,
   stops: [0, 100],
   }
   },
   states: {
   normal: {
   filter: {
     type: 'none',
     value: 0,
   }
   },
   hover: {
   filter: {
     type: 'none',
     value: 0,
   }
   },
   active: {
   filter: {
     type: 'none',
     value: 0,
   }
   },
   }
   };
   
   var options3 = {
   series: [75],
   grid: {
   padding: {
   top: 0,
   right: 0,
   bottom: 0,
   left: 0
   },
   },
   chart: {
   height: 100,
   width: 70,
   type: 'radialBar',
   },  
   plotOptions: {
   radialBar: {
   hollow: {
     size: '50%',
   },
   dataLabels: {
     name: {
       show: false,
       color: '#fff'
     },
     value: {
       show: true,
       color: '#333',
       offsetY: 5,
       fontSize: '15px'
     }
   }
   }
   },
   colors: ['#ecf0f4'],
   fill: {
   type: 'gradient',
   gradient: {
   shade: 'dark',
   type: 'diagonal1',
   shadeIntensity: 0.8,
   gradientToColors: ['#f56767'],
   inverseColors: false,
   opacityFrom: [1, 0.2],
   opacityTo: 1,
   stops: [0, 100],
   }
   },
   states: {
   normal: {
   filter: {
     type: 'none',
     value: 0,
   }
   },
   hover: {
   filter: {
     type: 'none',
     value: 0,
   }
   },
   active: {
   filter: {
     type: 'none',
     value: 0,
   }
   },
   }
   };
   
   var options4 = {
   series: [85],
   grid: {
   padding: {
   top: 0,
   right: 0,
   bottom: 0,
   left: 0
   },
   },
   chart: {
   height: 100,
   width: 70,
   type: 'radialBar',
   },  
   plotOptions: {
   radialBar: {
   hollow: {
     size: '50%',
   },
   dataLabels: {
     name: {
       show: false,
       color: '#fff'
     },
     value: {
       show: true,
       color: '#333',
       offsetY: 5,
       fontSize: '15px'
     }
   }
   }
   },
   colors: ['#ecf0f4'],
   fill: {
   type: 'gradient',
   gradient: {
   shade: 'dark',
   type: 'diagonal1',
   shadeIntensity: 0.8,
   gradientToColors: ['#226F54'],
   inverseColors: false,
   opacityFrom: [1, 0.5],
   opacityTo: 1,
   stops: [0, 100],
   }
   },
   states: {
   normal: {
   filter: {
     type: 'none',
     value: 0,
   }
   },
   hover: {
   filter: {
     type: 'none',
     value: 0,
   }
   },
   active: {
   filter: {
     type: 'none',
     value: 0,
   }
   },
   }
   };
   
   var options5 = {
   series: [{
   name: 'series1',
   data: [30, 50, 70, 65, 80, 90]
   }],
   chart: {
   height: 110,
   type: 'area',
   toolbar: {
   show: false,
   },
   sparkline: {
   enabled: true
   }
   },
   grid: {
   show: false,
   padding: {
   left: 0,
   right: 0
   }
   },
   dataLabels: {
   enabled: false
   },
   stroke: {
   curve: 'smooth'
   },
   xaxis: {
   type: 'numeric',
   lines: {
   show: false,
   },
   axisBorder: {
   show: false,
   },
   labels: {
   show: false,
   },
   },
   yaxis: [{
   y: 0,
   offsetX: 0,
   offsetY: 0,
   labels: {
   show: false,
   },
   padding: {
   left: 0,
   right: 0
   },
   }],
   tooltip: {
   x: {
   show: false,
   format: 'dd/MM/yy HH:mm'
   },
   },
   };
   
   var options6 = {
   series: [{
   name: 'series1',
   data: [150, 650, 450, 650, 350, 480, 900]
   }],
   chart: {
   height: 110,
   type: 'line',
   toolbar: {
   show: false,
   },
   sparkline: {
   enabled: true
   }
   },
   grid: {
   show: false,
   padding: {
   left: 0,
   right: 0
   }
   },
   dataLabels: {
   enabled: false
   },
   xaxis: {
   type: 'numeric',
   lines: {
   show: false,
   },
   axisBorder: {
   show: false,
   },
   labels: {
   show: false,
   },
   },
   yaxis: [{
   y: 0,
   offsetX: 0,
   offsetY: 0,
   labels: {
   show: false,
   },
   padding: {
   left: 0,
   right: 0
   },
   }],
   tooltip: {
   x: {
   show: false,
   format: 'dd/MM/yy HH:mm'
   },
   },
   fill: {
   type: "gradient",
   gradient: {
   shadeIntensity: 1,
   opacityFrom: 0.7,
   opacityTo: 0.9,
   colorStops: [
   {
     offset: 0,
     color: "#EB656F",
     opacity: 1
   },
   {
     offset: 20,
     color: "#FAD375",
     opacity: 1
   },
   {
     offset: 60,
     color: "#61DBC3",
     opacity: 1
   },
   {
     offset: 100,
     color: "#95DA74",
     opacity: 1
   }
   ]
   }
   },
   };
   
   var options7 = {
   series: [{
   data: [21, 22, 10, 28, 16, 21, 13, 30]
   }],
   chart: {
   height: 110,
   type: 'bar',
   toolbar: {
   show: false,
   },
   sparkline: {
   enabled: true
   },
   events: {
   click: function(chart, w, e) {
   }
   }
   },
   plotOptions: {
   bar: {
   columnWidth: '20px',
   distributed: true,
   endingShape: 'rounded',
   }
   },
   dataLabels: {
   enabled: false
   },
   legend: {
   show: false
   },
   xaxis: {
   type: 'numeric',
   lines: {
   show: false,
   },
   axisBorder: {
   show: false,
   },
   labels: {
   show: false,
   },
   },
   yaxis: [{
   y: 0,
   offsetX: 0,
   offsetY: 0,
   labels: {
   show: false,
   },
   padding: {
   left: 0,
   right: 0
   },
   }],
   };
   
   var options8 = {
   series: [{
   name: 'series1',
   data: [41, 50, 38, 61, 42, 70, 100]
   }, {
   name: 'series2',
   data: [21, 42, 55, 32, 34, 92, 41]
   }],
   chart: {
   height: 110,
   type: 'area',
   toolbar: {
   show: false,
   },
   sparkline: {
   enabled: true
   }
   },
   grid: {
   show: false,
   padding: {
   left: 0,
   right: 0
   }
   },
   dataLabels: {
   enabled: false
   },
   stroke: {
   show: false,
   curve: 'smooth'
   },
   xaxis: {
   type: 'numeric',
   lines: {
   show: false,
   },
   axisBorder: {
   show: false,
   },
   labels: {
   show: false,
   },
   },
   yaxis: [{
   y: 0,
   offsetX: 0,
   offsetY: 0,
   labels: {
   show: false,
   },
   padding: {
   left: 0,
   right: 0
   },
   }],
   tooltip: {
   x: {
   show: false,
   format: 'dd/MM/yy HH:mm'
   },
   },
   };
   
   var options9 = {
   chart: {
   height: 400,
   type: 'bar',
   parentHeightOffset: 0,
   fontFamily: 'Poppins, sans-serif',
   toolbar: {
   show: false,
   },
   },
   colors: ['#EB4738', '#F7AE1D'],
   grid: {
   borderColor: '#c7d2dd',
   strokeDashArray: 5,
   },
   plotOptions: {
   bar: {
   horizontal: false,
   columnWidth: '15px',
   endingShape: 'rounded'
   },
   },
   dataLabels: {
   enabled: false
   },
   stroke: {
   show: true,
   width: 2,
   colors: ['transparent']
   },
   series: [{
   name: 'In Progress',
   data: [40, 28, 47, 22, 34, 25]
   }, {
   name: 'Complete',
   data: [30, 20, 37, 10, 28, 11]
   }],
   xaxis: {
   categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
   labels: {
   style: {
     colors: ['#353535'],
     fontSize: '16px',
   },
   },
   axisBorder: {
   color: '#8fa6bc',
   }
   },
   yaxis: {
   title: {
   text: ''
   },
   labels: {
   style: {
     colors: '#353535',
     fontSize: '16px',
   },
   },
   axisBorder: {
   color: '#f00',
   }
   },
   legend: {
   horizontalAlign: 'right',
   position: 'top',
   fontSize: '16px',
   offsetY: 0,
   labels: {
   colors: '#353535',
   },
   markers: {
   width: 10,
   height: 10,
   radius: 15,
   },
   itemMargin: {
   vertical: 0
   },
   },
   fill: {
   opacity: 1
   
   },
   tooltip: {
   style: {
   fontSize: '15px',
   fontFamily: 'Poppins, sans-serif',
   },
   y: {
   formatter: function (val) {
     return val
   }
   }
   }
   }
   
   var options10 = {
   series: [73],
   chart: {
   height: 350,
   type: 'radialBar',
   offsetY: 0
   },
   colors: ['#0B132B', '#222222'],
   plotOptions: {
   radialBar: {
   startAngle: -135,
   endAngle: 135,
   dataLabels: {
   name: {
   fontSize: '16px',
   color: undefined,
   offsetY: 120
   },
   value: {
   offsetY: 76,
   fontSize: '22px',
   color: undefined,
   formatter: function (val) {
     return val + "%";
   }
   }
   }
   }
   },
   fill: {
   type: 'gradient',
   gradient: {
   shade: 'dark',
   shadeIntensity: 0.15,
   inverseColors: false,
   opacityFrom: 1,
   opacityTo: 1,
   stops: [0, 50, 65, 91]
   },
   },
   stroke: {
   dashArray: 4
   },
   labels: ['Achieve Goals'],
   };
   
   var chart = new ApexCharts(document.querySelector("#chart"), options);
   chart.render();
   
   var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
   chart2.render();
   
   var chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
   chart3.render();
   
   var chart4 = new ApexCharts(document.querySelector("#chart4"), options4);
   chart4.render();
   
   var chart5 = new ApexCharts(document.querySelector("#chart5"), options5);
   chart5.render();
   
   var chart6 = new ApexCharts(document.querySelector("#chart6"), options6);
   chart6.render();
   
   var chart7 = new ApexCharts(document.querySelector("#chart7"), options7);
   chart7.render();
   
   var chart8 = new ApexCharts(document.querySelector("#chart8"), options8);
   chart8.render();
   
   var chart9 = new ApexCharts(document.querySelector("#chart9"), options9);
   chart9.render();
   
   var chart10 = new ApexCharts(document.querySelector("#chart10"), options10);
   chart10.render();
   
   Highcharts.chart('chart11', {
   chart: {
   type: 'packedbubble',
   height: '500px'
   },
   title: {
   text: ''
   },
   colors: ['#00bde3', '#ffad26', '#00c5e2', '#b58261', '#7cdace'],
   navigation: {
     buttonOptions: {
         enabled: false
     }
   },
   credits: {
     enabled: false
   },
   tooltip: {
   useHTML: true,
   pointFormat: '<b>{point.name}:</b> {point.value}'
   },
   plotOptions: {
   packedbubble: {
   minSize: '30%',
   maxSize: '100%',
   zMin: 0,
   zMax: 1000,
   layoutAlgorithm: {
     bubblePadding: 10,
     splitSeries: false,
     friction: 7.981,
     gravitationalConstant: 0.01
   },
   dataLabels: {
     enabled: true,
     format: '{point.name}',
     allowOverlap: true,
     filter: {
       property: 'y',
       operator: '>',
       value: 0
     },
     style: {
       color: 'black',
       textOutline: 'none',
       fontWeight: 'normal'
     }
   }
   }
   },
   series: [{
   name: 'Microservices Dev',
   data: [{
   name: 'Microservices Dev',
   value: 207.1
   }]
   }, {
   name: 'React.js',
   data: [{
   name: "React.js",
   value: 589.4
   }]
   }, {
   name: 'AWS DevOps',
   data: [{
   name: "AWS DevOps",
   value: 147.6
   }]
   }, {
   name: 'AWS DevOps',
   data: [{
   name: "AWS DevOps",
   value: 127.2
   }]
   }, {
   name: 'AWS DevOps',
   data: [{
   name: "AWS DevOps",
   value: 116.5
   }]
   }]
   });
</script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
   var xValues = [100,200,300,400,500,600,700,800,900,1000];
   
   new Chart("myChart", {
     type: "line",
     data: {
       labels: xValues,
       datasets: [{ 
         data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
         borderColor: "red",
         fill: false
       }, { 
         data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
         borderColor: "green",
         fill: false
       }, { 
         data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
         borderColor: "blue",
         fill: false
       }]
     },
     options: {
       legend: {display: false}
     }
   });
</script>
<script>
   var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
   var yValues = [55, 49, 44, 24, 15];
   var barColors = [
     "#b91d47",
     "#00aba9",
     "#2b5797",
     "#e8c3b9",
     "#1e7145"
   ];
   
   new Chart("myChart2", {
     type: "pie",
     data: {
       labels: xValues,
       datasets: [{
         backgroundColor: barColors,
         data: yValues
       }]
     },
     options: {
       title: {
         display: true,
         text: "World Wide Wine Production 2018"
       }
     }
   });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
      var bb_request_met_search = '<?php echo $base_url; ?>/bb_request_met_search';

//   excel URLS---------------
var bb_request_met_excel = '<?php echo $base_url; ?>/bb_request_met_excel';

//------------------------------------------
//var days_filter = 0;
function reloadDataTable() {
   
  var tablereqmet = $('#table_bb_request_met').DataTable();
  tablereqmet.ajax.url(bb_request_met_search).draw();

}
$(document).ready(function () {
// ------------------ link for blood met
var tablereqmet = $('#table_bb_request_met').DataTable({
        'bJQueryUI': false,
        'stateSave': false,
        'iDisplayLength': 3,
        'responsive': true,
        "pagingType": "full_numbers",
        "rowReorder": false,
        'language': {
            'paginate': {
                'first': "<<", // This is the link to the first page
                'previous': "<", // This is the link to the previous page
                'next': ">", // This is the link to the next page
                'last': ">>" // This is the link to the last page
            },
            "info": ""
        },
        "lengthMenu": [[3, 10, 25, 50, 100, 250, 500], [3, 10, 25, 50, 100, 250, 500]],
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": bb_request_met_search,
            "type": "POST",
            "data": function (d) {
                d[csrf_name] = csrf_hash;
                d.days_filter = $('#daysfillter').val(); // Pass selected days filter value
                d.start_date = $('#start_date').val(); // Pass selected start date value
                d.end_date = $('#end_date').val(); // Pass selected end date value
            }
        },
        "autoWidth": false,
        "searching": false, // Disable search
        "lengthChange": false,
        "columnDefs": [
            {
                "targets": 1, // Second column
                "width": "100px" // Set the width of the second column
            },
            {
                "targets": [0, 5], //first column / numbering column
                "orderable": false, //set not orderable
            }
        ],
        "initComplete": function (settings, json) {
            // Hide pagination controls initially
            $('#table_bb_request_met_paginate').hide();
        },
        "drawCallback": function (settings) {
            toggleLoadLinkbloodreqmet();
            if (tablereqmet.page.info().pages > 1) {
                $('#table_bb_request_met_paginate').show();
            } else {
                $('#table_bb_request_met_paginate').hide();
            }
        }
    });
    function toggleLoadLinkbloodreqmet() {
        var totalRecords4 = tablereqmet.page.info().recordsTotal;
        var currentLength4 = tablereqmet.page.len();
        var link = $('#load_more_link_bb_met');
        if (currentLength4 < totalRecords4) {
            link.text('View More');
        } else {
            link.text('View Less');
        }
    }
    $('#load_more_link_bb_met').on('click', function (event) {
        event.preventDefault();
        var currentLength4 = tablereqmet.page.len();
        var totalRecords4 = tablereqmet.page.info().recordsTotal;
    
        if (currentLength4 < totalRecords4) {
            tablereqmet.page.len(currentLength4 + 3).draw();
        } else {
            tablereqmet.page.len(3).draw();
        }
        toggleLoadLinkbloodreqmet();
    });
    toggleLoadLinkbloodreqmet();

});

</script>
