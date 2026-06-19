 <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <style>
       
        body{
            margin: 0px;
            padding: 0px;
            font-family: 'Roboto', sans-serif;
            color: #030303;
        }
        table, td, th {
            border: 1px solid #252122;
            border-collapse: collapse !important;
            font-size: 14px;
            font-weight: 400;
            text-transform: capitalize;
            line-height: 15px;
        }
        td, th{
            padding: 0px;
            font-size: 12px !important;
        }
        tr, td {
        vertical-align: middle;
        font: 13px / 1.25 'Roboto', sans-serif !important;
        }
        li{
            font: 14px / 1.25 'Roboto', sans-serif !important;
        }
        input{
            box-sizing: border-box;
        }
        .container{
            width: 1400px;
            margin: 0px auto;
        }
        @font-face {
            font-family: 'fontawesome3';
            src: url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/fonts/fontawesome-webfont.ttf?v=4.7.0') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        .fa3 {
            display: inline-block;
            font: normal normal normal 14px/1 fontawesome3;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .pagenum:before {
            /*content: counter(page);*/
            content: "blood safety begins with a healthy donor";
            border:1px solid black;padding: 8px;margin-top: 10px;
        }
        #donar-info{
            border:none;

        }
        #donar-info tr td{
            border:none;
            padding-top: 10px;
        }
        .under-line{
            border-bottom:1px solid black !important;
        }
        .defer-sec{
            border:none;
        }
        .defer-sec tr td{
             border:none !important;
        }
        .defer-sec td{
            padding-bottom:0px !important;
        }
        /* span{
            border:1px solid red;
            display:block;
            vertical-align: middle;
            align-items: center;
        } */
        @media print {
  #printPageButton {
    display: none;
  }
}
    </style>
<?php
$id= $this->uri->segment(3);
$userid= $this->uri->segment(4);
// $query = $this->db->get('bl_customers');
 
 $query1 = $this->db->query("SELECT * FROM bl_donar_form_info WHERE form_id = '$id' AND form_step = 'step_1'");

 // echo 'hiii';

 foreach ($query1->result() as $donar_form)
{
  // print_r($donar_form);
  // die();
 $form_data = json_decode($donar_form->detail);
  $today = json_decode($form_data->donation_time_selection->ans_data);
              //print_obj($form_data);
             //die();
  foreach ($form_data as $key => $value) {
    # code...
      //print_obj($value->ans);
  }
}
   // $userid= $form_data->user_id;
   // print_r($userid);die();
    $query = $this->db->query("SELECT * FROM bl_customers WHERE user_id = '$userid'");
 foreach ($query->result() as $row)
{
 // print_r($row);die;

   }
    // $querys=$this->db->get('bl_donar_form_info');
    //     $datas =  $querys->result(); 
    //     echo "<pre>";
    //     print_r($datas);
    //     echo "</pre>";

    //     die;
 $query4 = $this->db->query("SELECT * FROM bl_donar_form_info WHERE form_id = '$id' AND form_step = 'step_2'");
 //print_r(json_encode($query));

 foreach ($query4->result() as $row1)
{

  $form_data1 = json_decode($row1->detail);
     // print_obj($form_data1->to_undergo_hiv_test->ans);die();
  foreach ($form_data1 as $key => $value) {
    # code...
      //print_obj($value->ans);
  }
  // die;
  // print_r($row->detail);
}

  
 $query5 = $this->db->query("SELECT * FROM bl_donar_form_info WHERE form_id = '$id' AND form_step = 'step_3'");
 //print_r(json_encode($query));

 foreach ($query5->result() as $row2)
{

  //  foreach ($row->detail as $data)
  // {

  // print_r($data);
  // die;
  // }
   // $details=json_encode($data_to_store);
  $form_data2 = json_decode($row2->detail);
   // print_obj($form_data2);die();
  foreach ($form_data2 as $key => $value) {
    # code...
      //print_obj($value->ans);
  }
  // die;
  // print_r($row->detail);
}
$
$id= $this->uri->segment(4);
 $query7 = $this->db->query("SELECT * FROM bl_donar_form_info WHERE form_id = '$id' And form_id = 'step_5'");
 //print_r(json_encode($query));


 // echo $this->db->last_query();die;
 foreach ($query7->result() as $row4)
{

  //  foreach ($row->detail as $data)
  // {
// print_r($row4);die();
 
  // }
   // $details=json_encode($data_to_store);
  $form_data4 = json_decode($row4->detail);
  // print_r($form_data4);die;
      // print_obj($form_data4->{'defer-cat-type'});die;
  // foreach ($form_data4 as $key => $deffer) {
  //   # code...
  //      // print_obj($value);
  // }
     // die;
  // print_r($row->detail);
}
// print_r($id);die();
 $query6 = $this->db->query("SELECT * FROM bl_donar_form_info WHERE form_step = 'step_4' AND form_id = '$id'");
 // echo $this->db->last_query();die;
   // print_r($query6->result());

 foreach ($query6->result() as $row3)
{

  //  foreach ($row->detail as $data)
  // {

     // print_r($row3);die;
 // }die();
    // $details=json_encode($data_to_store);
   $form_data3 = json_decode($row3->detail);
   // print_r($form_data3);die();
      // print_obj($form_data3);die();
  // $c = $form_data3->informed_concent;
  // foreach ($c as $key => $information) {
  //   # code...
  //   //  print_r($key);
  //   // print_r($5->$value->ans);
  // }
   // die;
  // print_r($row->detail);
}
// die;
 $querys = $this->db->query("SELECT * FROM bl_blood_donation_requests WHERE donation_form_id = '$id'");
 foreach ($querys->result() as $request)
{

  // print_r($request);
  // die();
  
   } 
   $bank_id =$request->org_id;

 $query3 = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id = '$bank_id'");
 foreach ($query3->result() as $bloodbank)
{

// print_r($bloodbank);
// die();
   } 
?>
<button id="printPageButton" onClick="window.print();" style="background-color: blue;color: white;border-radius: 5px;border-color: white;padding: 10px 20px;">Print</button>
<!-- <button onclick="window.print()" class="btn">Click Me</button> -->
<script type="text/javascript">
    window.print();
// const btn= document.getElementByID("myPdf");

// btn.addEventListener('click', function(){
//    window.print();
// });
</script>
<div class="div2" style="float: right;">
           <!--  <img src="https://cdn.vectorstock.com/i/1000x1000/11/41/hospital-cross-sign-wave-logo-vector-20061141.webp"
                alt="" height="80" width="100" /> -->
                 <img src="https://www.bloodlinks.in//uploads/img/"<?php echo($bloodbank->logo) ?> width="100" height="80"></br>
        </div>
<div style="text-align: center;margin-bottom: 5px;padding-top: 100px;">
     <!--   $org_name
        $org_address
        $org_type
        $org_licence_no -->
    <h2 style="font-size:10px;font-weight:400;color:#282829;line-height:20px!important; margin: 0px 0px 3px 0px;;font: 20px / 1.25 'Roboto', sans-serif; text-align: center; font-weight: 600;">
       
        Bloodbank
    </h2>
    <p style="font-size:10px;font-weight:400;color:#252122;line-height:20px!important; margin: 0px 0px 0px 0px;;font: 16px / 1.25 'Raleway', sans-serif; text-align: center;font-weight: 500;">
        <?php echo ucwords($bloodbank->name);?>
    </p>
    <table width="100%" style="border: none;">
        <tr style="border: none;">
           
            <td style="border: none;"></td>
            <td style="border: none;">
                <p style="font-size:14px;font-weight:400;color:#282829;line-height:20px!important; margin: 0px 0px 3px 0px;font: 14px / 1.25 'Roboto', sans-serif; text-align: center;">
                    <!-- (Regional Blood Center) -->
                    <b>(Regional Blood Center)<?php //echo "(".ucwords($org_type).")";?></b>
                </p>
                <p style="font-size:14px;font-weight:400;color:#282829;line-height:20px!important; margin: 0px 0px 5px 0px;;font: 12px / 1.25 'Roboto', sans-serif; text-align: center;">
                    <?php echo ucwords($bloodbank->address_1);?>
                </p>
                <p style="font-size:14px;font-weight:400;color:#282829;line-height:20px!important; margin: 0px 0px 0px 0px;;font: 14px / 1.25 'Roboto', sans-serif; text-align: center;">
                    <b>BLOOD DONOR REGISTRATION CARD</b>
                </p><br><br><br><br>
                <p><span style="float: left;">For Blood Bank Use Only</span><span style="float: left;padding-left: 20px;padding-right: 20px;">Application No.:<?=$request->application_no ?></span><span style="float: right;">Licence No. <span class="under-line "><?php echo ucwords($bloodbank->lic_no);?>	</span >.</span></p>
            </td>
            <td style="border: none;"></td>
</tr>

</table>
</div>
 <table width="100%" style="border:1px solid #252122">

    <tr>

    <th align="cenetr" style="border:1px solid #252122; padding: 5px;">date</th>
    <th align="cenetr" style="border:1px solid #252122; padding: 5px;">Blood Unit No.</th>
    <th align="cenetr" style="border:1px solid #252122; padding: 5px;">Blood Group & Rh</th>
    <th align="cenetr" style="border:1px solid #252122; padding: 5px;">350ml Triple</th>
    <th align="cenetr" style="border:1px solid #252122; padding: 5px;">450ml Triple</th>
    <th align="cenetr" style="border:1px solid #252122; padding: 5px;">Double</th>
    <th align="cenetr" style="border:1px solid #252122; padding: 5px;">Penta</th>
    <th align="cenetr" style="border:1px solid #252122; padding: 5px;">Leuko Bag</th>
    <th rowspan="2" align="cenetr" style="border:1px solid #252122; padding: 5px; text-align: left; vertical-align: middle; ">
                    <span><i class="fa">&#xf096;</i></i> penpol</span><br>
                    <span><i class="fa">&#xf096;</i></i> Fresnius Kabi</span><br>
                    <span><i class="fa">&#xf096;</i></i> H.L</span><br>
                    <span><i class="fa">&#xf096;</i></i> JML</span><br>
    </th>
    <th align="cenetr" style="border:1px solid #252122; padding: 5px;">Blood Bag Tube No.</th>
    </tr>
    <tr>
        <td style="border:1px solid #252122; padding: 5px;" align="center"></td>
        <td style="border:1px solid #252122; padding: 5px;" align="center"><i class="fa"></i></td>
        <td></td>
        <td align="cenetr" colspan="5" style="text-align: left;">Lot No</td>
        <td></td>
    </tr>
</table>


<h3 style="font-size:14px;font-weight:700 !important;color:#282829;line-height:10px!important; margin: 0px 0px 8px 0px;;font: 15px / 1.25 'Roboto', sans-serif; text-align: left;padding-top: 5px;">Donor Information :</h3>
<!-- <p style="width:900px;font-size:14px;font-weight:400;color:#282829;line-height:20px!important; margin: 0px 0px 8px 0px;;font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">Donor Name<span style="width: 500px;background-color: red;">testing testing<?=$name?></span> Ftaher/Husband's Name______________________________________</p>
<p style="font-size:14px;font-weight:400;color:#282829;line-height:20px!important; margin: 0px 0px 3px 0px;;font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">Date of Birth__________________ Age<span><?=$age?></span> Sex:M/F<span><?=$gender?></span> Occupation<span><?=$occupation?></span> Married/Unmarried_______________</p>
<p style="font-size:14px;font-weight:400;color:#282829;line-height:20px!important; margin: 0px 0px 3px 0px;;font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">Address :<span><?=$address?></span> Cast____________________</p>
<p style="font-size:14px;font-weight:400;color:#282829;line-height:20px!important; margin: 0px 0px 3px 0px;;font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">Tel. No. : Res.____________________ Off.________________________Mobile <span><?=$phone_number?></span> Email Id <span><?=$email?></span></p>
<p style="line-height: 20px;margin-top: 0px;">_________________________________________________________________________________________________________________</p> -->
<table width="100%" id="donar-info">
    <tr>
        <td>Donor Name:</td>
        <td class="under-line " style="width: 350px;"><?=$row->first_name?> <?=$row->mid_name?> <?=$row->last_name?></td>
        <td>Father/Husband's Name:</td>
        <td class="under-line" style="width: 400px;"><?=$row->f_name?></td>

    </tr>
    </table>
    <table width="100%" id="donar-info">
    <tr>
        <td style="width: 80px;">Date of Birth: </td>
        <td class="under-line" style="width: 100px;"><?=$row->dob?></td>
        <td style="width: 5px;">Age: </td>
        <td class="under-line" style="width: 80px;"><?=$row->age?></td>
        <td style="width: 85px;">Sex: (M/F) </td>
        <td class="under-line" style="width: 100px;"><?=$row->gender?></td>
        <td style="width: 40px;">Occupation: </td>
        <td class="under-line" style="width: 100px;"></td>
        <td style="width: 40px;"> Married/Unmarried: </td>
        <td class="under-line" style="width: 100px;"><?=$row->marital?></td>
    </tr>
    </table>
    <table width="100%" id="donar-info">
    <tr>
        <td style="width: 70px;">Address :</td>
        <td class="under-line" style="width: 1000px;"> <?=$row->address?></td>
        <td></td>
        <!-- <td>Cast</td>
        <td class="under-line" style="width: 500px;"></td> -->
        </tr>
    </table>
    <table width="100%" id="donar-info">
    <tr>
        <td style="width: 85px;">Tel. No. :Res. </td>
        <td class="under-line" style="width: 150px;"></td>
        <td style="width:20px;">Off. </td>
        <td class="under-line" style="width: 150px;"></td>
        <td style="width: 25px;">Mobile</td>
        <td class="under-line" style="width: 150px;"> <?=$row->ph_no?> </td>
        <td style="width: 40px;">Email Id</td>
        <td class="under-line" style="width: 150px;"><?=$row->email?></td>
    </tr>
</table>
<div style="border-bottom: 2px solid black;margin-top: 10px;"></div>
<table width="100%" style="border: none; padding-top:10px;">
<tr style="border: none;">
  <h3 style="font-size:14px;font-weight:700 !important;color:#282829;line-height:20px!important; margin: 0px 0px 8px 0px;;font: 15px / 1.25 'Roboto', sans-serif; text-align: left;">Patient details : </h3>
  <td style="width: 70px;border: none;">Name</td>
        <td class="under-line" style="width: 500px;border: none;"></td>
        <td style="width:70px;border: none;">Reg. No. </td>
        <td class="under-line" style="width: 350px;border: none;"></td>
    </tr>
</table>
<table width="100%" style="border: none; margin-top:10px;">
<tr style="border: none;">
  <td style="width: 125px;border: none;">Request Reg. No.</td>
        <td class="under-line" style="width: 400px;border: none;"></td>
        <td style="width:70px;border: none;"> Date </td>
        <td class="under-line" style="width: 400px;border: none;"></td>
      
    </tr>
</table>
<div style="border-bottom: 2px solid black;margin-top: 10px;"></div>
<table width="100%" style="border: none; margin-top:10px;">
<tr style="border: none;">
 
  <td style="width: 160px;border: none;font-size:14px;font-weight:700 !important;color:#282829;line-height:20px!important; margin: 0px 0px 8px 0px;;font: 15px / 1.25 'Roboto', sans-serif; text-align: left;">Type of donor :</td>
        <td  style="width: 400px;border: none;"><span style="font-size:14px;color:#282829;line-height:20px!important; margin: 0px 0px 0px 0px;font: 14px / 1.25 'Roboto', sans-serif; text-align: left;"><?php if((!empty($form_data) && isset($today->fed_in_last_4_hrs) && $today->fed_in_last_4_hrs == "Voluntary")){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> Voluntary Donor <?php if((!empty($form_data) && isset($today->fed_in_last_4_hrs) && $today->fed_in_last_4_hrs == "Replacement")){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>  Replacement Donor</span></td>
        <td style="width:125px;border: none;">phlebotomy Site : </td>
        <td style="width: 350px;border: none;"> <span style="font-size:14px;color:#282829;line-height:20px!important; margin: 0px 0px 0px 0px;font: 14px / 1.25 'Roboto', sans-serif; text-align: left;"><?php if((!empty($form_data) && isset($today->fed_in_last_4_hrs) && $today->fed_in_last_4_hrs == "Acceptable")){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> Acceptable  <?php if((!empty($form_data) && isset($today->fed_in_last_4_hrs) && $today->fed_in_last_4_hrs == "Un Acceptable")){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> Un Acceptable</span></td>
    </tr>
</table>
<table width="100%" style="border: none; padding-top:10px;margin-bottom: 10px;">
<tr style="border: none;">
  <td style="width: 130px;border: none;">Name of Phlebotomist :</td>
        <td class="under-line" style="width: 400px;border: none;"></td>
        <td style="width: 152px;border: none;">Duration of Bleeding Time</td>
        <td  style="width: 190px;border: none;">_______________________Min.</td>
      
    </tr>
</table>


<div style="border-bottom: 2px solid black;margin-top: 10px;"></div><br>
<b>GENERAL PHYSICAL EXAMINATION:</b>
<p style="margin-bottom: 0rem !important;"> 
    Weight&nbsp; : &nbsp;<?php echo $form_data3->weight; ?>(Kg) 
    Temperature&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;
   <?php if( $form_data3->temperature == "normal"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;
    Afebrile&nbsp;&nbsp;
   <?php if(  $form_data3->temperature == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;
    febrile&nbsp;&nbsp;
    Haemoglobin&nbsp;:&nbsp;<?php echo $form_data3->hemoglobin ?>&nbsp;gm/dl 
    BP&nbsp;:&nbsp;<?php echo $form_data3->BP ?>&nbsp;mm Hg&nbsp;&nbsp;&nbsp;
    Pulse  &nbsp;:&nbsp;
   <?php if($form_data3->pulse == "normal"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;
    Regular&nbsp;&nbsp;
   <?php if( $form_data3->pulse == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;
    Irregular&nbsp;&nbsp;
    </p>
   
<table width="100%" style="border: none;border-top: 1px solid #252122; border-bottom: 1px solid #252122; ">
    <tr style="border: none;">
        <td style="border: none; border-right:1px solid #252122; padding-top: 10px; padding-bottom: 10px;">
        <h3 style="font-size:14px;font-weight:700 !important;color:#282829;line-height:20px!important; margin: 0px 0px 8px 0px;font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">NOTE : ANY OF THE BELOW APPLY (MARK SPECIFY IF YES)</h3>
<!-- $donation_day
$recieved_organisation_name
$recieved_organisation_city -->
        <table style="border: none;">
            <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;" >1. Have you donated Whole Blood / SDP / Plasma previously<br> <?php echo (!empty($form_data) && isset($form_data->has_prev_donation->ans_data->prev_donation_date))?$form_data->has_prev_donation->ans_data->prev_donation_date : "When Last______________.";?></td>

                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: top;width: 80px;">
                    <i class="fa"><?php if( $form_data->has_prev_donation->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> Yes</span> 
                    <i class="fa"><?php if($form_data->has_prev_donation->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> No</span>
                </td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;" >
                    2. Have You Donated Blood At Any Blood Bank.?  : If yes. how many time:______________.</td>

                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: top;">
                    <i class="fa"><?php if($form_data->has_prev_donation->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> Yes</span> 
                    <i class="fa"><?php if($form_data->has_prev_donation->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> No</span>
                </td> 
                  <!--   <br>
                    blood bank name&nbsp;:&nbsp;<?php echo (!empty($form_data) && isset($form_data->has_prev_donation->ans_data->prev_donation_bloodbank))?$form_data->has_prev_donation->ans_data->prev_donation_bloodbank : "________________________________"; ?>
                    <br>city&nbsp;:&nbsp;<?php echo (!empty($form_data) && isset($form_data->has_prev_donation->ans_data->prev_donation_city))?$form_data->has_prev_donation->ans_data->prev_donation_city : "______________"; ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;how many times&nbsp;:&nbsp;<?php echo (!empty($form_data) && isset($form_data->has_prev_donation->ans_data->prev_donation_times))?$form_data->has_prev_donation->ans_data->prev_donation_times: "________"; ?> 
                </td>-->
                <td width="10" style="border: none;"></td>
                <!-- <td style="border: none;vertical-align: top;"><i class="fa"><?php echo $form_data->has_discomfort_post_donation->ans == "yes" ? "&#xf14a;" : "&#xf096;"; ?></i> Yes</span> <i class="fa"><?php echo $form_data->has_discomfort_post_donation->ans == "no" ? "&#xf14a;" : "&#xf096;"; ?></i> No</span></td> -->
            </tr>
            <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;" >3. Did You Have Any Discomfort During Or<br> After Donation: ?</td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: top;"><i class="fa"> <?php if($form_data->has_discomfort_post_donation->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"> <?php if($form_data->has_discomfort_post_donation->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;" >4.Have You Any Reason To Believe That Donation Shall <br>Infect You: ?:</td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: top;"><i class="fa"><?php if($form_data->has_infect_reason_believed->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"> <?php if($form_data->has_infect_reason_believed->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
            </tr>
            
           
            <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">5. Did You Have Anything To Eat In Last 4 Hours</td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: middle;"><i class="fa"> <?php if((!empty($form_data) && isset($today->fed_in_last_4_hrs) && $today->fed_in_last_4_hrs == "yes")){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"> <?php if((!empty($form_data) && isset($today->fed_in_last_4_hrs) && $today->fed_in_last_4_hrs == "no")){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>

            </tr>

            <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">6. Do You Feel Well Today</td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: middle;"><i class="fa">
                  <?php if((!empty($form_data) && isset($today->well_feeling) && $today->well_feeling == "yes")){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"> <?php if((!empty($form_data) && isset($today->well_feeling) && $today->well_feeling == "no")){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">7. Did You Sleep Well Last Night:</td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: middle;"><i class="fa"> <?php if((!empty($form_data) && isset($today->well_slept_last_night) && $today->well_slept_last_night == "yes")){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"><?php if((!empty($form_data) && isset($today->well_slept_last_night) && $today->well_slept_last_night == "no")){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">8. Are You Suffering From any of the following:
                
                   <table style="border: none;">
                    <tr style="border: none;">
                    <td style="border: none; width:130px;">
                     
                        <?php if((!empty($form_data->has_general_differs->ans_data)) && in_array("66",  $form_data->has_general_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?> <i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i> <?php } ?>
                        Common Cold <br>
                    </td>
                    <td style="border: none;width:85px;">
                        <?php if((!empty($form_data->has_general_differs->ans_data)) && in_array("67",  $form_data->has_general_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> sinusitis <br>
                        
                    </td>
                        <td  style="border: none;">
                          <?php if((!empty($form_data->has_general_differs->ans_data)) && in_array("68",  $form_data->has_general_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> fever <br>
                        </td>  
                </tr>
                    <tr style="border: none;">
                    <td style="border: none;">
     
                        <i class="fa"> <?php if($form_data->has_general_differs->ans_data == "sore throat"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i>
                        sore throat<br>
                    </td>
                    <td style="border: none;">
                        <i class="fa"><?php if($form_data->has_general_differs->ans_data == "flu"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> flu<br>
                        
                    </td>
                        <td  style="border: none;">
                          <i class="fa"><?php if($form_data->has_general_differs->ans_data == "cough"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i></i> cough<br>
                        </td>  
                </tr>
                </table>
                </td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: middle;"><i class="fa"><?php if($form_data->has_general_differs->ans == "yes" ){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"> <?php if($form_data->has_general_differs->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
            
            </tr>
            <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">9. Have You Taking Or Have Taken Medicine In Last<br> 72 Hours Any Of The Following:
                <table style="border: none;">
                    <tr style="border: none;">
                    <td style="border: none;width:85px;">
     
                        <i class="fa"><?php if((!empty($form_data->has_taken_medicines->ans_data)) && in_array("2",  $form_data->has_taken_medicines->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i>
                        alcohol<br>
                    </td>
                    <td style="border: none;width:85px;">
                        <i class="fa"> <?php if((!empty($form_data->has_taken_medicines->ans_data)) && in_array("3",  $form_data->has_taken_medicines->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> asprin<br>
                        
                    </td>
                        <td  style="border: none;width:85px;">
                          <i class="fa"><?php if((!empty($form_data->has_taken_medicines->ans_data)) && in_array("4",  $form_data->has_taken_medicines->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i></i> steroid<br>
                        </td>
                    <td style="border: none;">
                        <i class="fa"> <?php if((!empty($form_data->has_taken_medicines->ans_data)) && in_array("5",  $form_data->has_taken_medicines->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Any Other<br>
                    </td>   
                </tr>
                </table>
                </td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: middle;"><i class="fa"> <?php if($form_data->has_taken_medicines->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"> <?php if($form_data->has_taken_medicines->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">10. In The Last 14-28 days Have You Been Vaccinated/<br>Immunized For Any Of The Following
                <table style="border: none;">
                    <tr style="border: none;">
                    <td style="border: none;width:120px;">
                        <i class="fa"> <?php if((!empty($form_data->has_vaccinated->ans_data)) && in_array("1",  $form_data->has_vaccinated->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Diphtheria<br>
                       
                    </td>
                    <td style="border: none;width:80px;">
                        
                        <i class="fa"> <?php if((!empty($form_data->has_vaccinated->ans_data)) && in_array("2",  $form_data->has_vaccinated->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Tetanus<br>
                    </td>
                    <td style="border: none;">
                       <i class="fa"> <?php if((!empty($form_data->has_vaccinated->ans_data)) && in_array("3",  $form_data->has_vaccinated->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Rabies Prophylaxis<br>  
                    </td>
                  </tr>
                  <tr style="border: none;">
                    <td style="border: none;">                       
                        <i class="fa"> <?php if((!empty($form_data->has_vaccinated->ans_data)) && in_array("4",  $form_data->has_vaccinated->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Plague<br>
                    </td>
                    <td style="border: none;">
                        <i class="fa"> <?php if((!empty($form_data->has_vaccinated->ans_data)) && in_array("5",  $form_data->has_vaccinated->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Polio Inj<br>
                    </td>
                    <td style="border: none;">
                       
                        <i class="fa"> <?php if((!empty($form_data->has_vaccinated->ans_data)) && in_array("6",  $form_data->has_vaccinated->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Hepatitis B Vaccine
                    </td>   
                    </tr>
                    <tr>
                    <td style="border: none;">
                        <i class="fa"> <?php if((!empty($form_data->has_vaccinated->ans_data)) && in_array("7",  $form_data->has_vaccinated->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Papilloma Virus<br>
                       
                    </td>
                     <td style="border: none;">
                        
                        <i class="fa"> <?php if((!empty($form_data->has_vaccinated->ans_data)) && in_array("8",  $form_data->has_vaccinated->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Cholera <br>
                    </td> 
                    <td style="border: none;">
                        <i class="fa"> <?php if((!empty($form_data->has_vaccinated->ans_data)) && in_array("9",  $form_data->has_vaccinated->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Pneumococcal<br>
                       
                    </td>
                    </tr>
                    <tr>
                     <td style="border: none;">
                        <i class="fa"> <?php if((!empty($form_data->has_vaccinated->ans_data)) && in_array("10",  $form_data->has_vaccinated->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Pertussis
                    </td>  
                    <td style="border: none;">
                        <i class="fa"> <?php if((!empty($form_data->has_vaccinated->ans_data)) && in_array("11",  $form_data->has_vaccinated->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Typhoid<br>
                       
                    </td>
                     <td style="border: none;">
                         <i class="fa"> <?php if((!empty($form_data->has_vaccinated->ans_data)) && in_array("12",  $form_data->has_vaccinated->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Meningoceccal
                    </td>   
                </tr>
                </table>
                </td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: middle;"><i class="fa"> <?php if($form_data->has_vaccinated->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"><?php if($form_data->has_vaccinated->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">11. In The Last 2 Weeks Did You Suffer From<br> Any Of The Following Diseases
                <table style="border: none;">
                    <tr style="border: none;">
                    <td style="border: none;width:105px;">
                        <i class="fa"><?php if((!empty($form_data->has_last_2_week_differs->ans_data)) && in_array("41",  $form_data->has_last_2_week_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Chicken Pox<br>
                        
                    </td>
                      <td style="border: none;width:120px;">
                       
                        <i class="fa"><?php if((!empty($form_data->has_last_2_week_differs->ans_data)) && in_array("44",  $form_data->has_last_2_week_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Measles<br>
                    </td>
                      <td style="border: none;">
                        <i class="fa"> <?php if((!empty($form_data->has_last_2_week_differs->ans_data)) && in_array("43",  $form_data->has_last_2_week_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Mumps<br>
                    </td>
                    </tr>
                    <tr style="border: none;">
                    <td style="border: none;">
                       
                        <i class="fa"> <?php if((!empty($form_data->has_last_2_week_differs->ans_data)) && in_array("45",  $form_data->has_last_2_week_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Diarrhoea<br>
                    </td>
                    <td style="border: none;">
                        <i class="fa"> <?php if((!empty($form_data->has_last_2_week_differs->ans_data)) && in_array("42",  $form_data->has_last_2_week_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Cystitis:Urinary Tract Infection
                    </td> 
                     <td style="border: none;">
                        <i class="fa"> <?php if($form_data->has_last_2_week_differs->ans_data == "antibiotics"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> On Antibiotics
                    </td>   
                    </tr>

                </table>
                </td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: middle;"><i class="fa"> <?php if($form_data->has_last_2_week_differs->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"> <?php if($form_data->has_last_2_week_differs->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
            </tr>   
            <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">12. In The Last 3 Months Have You Had Any Of The Following :
                <table style="border: none;">
                    <tr style="border: none;">
                    <td style="border: none;width:80px;">
                       
                        <i class="fa"> <?php if((!empty($form_data->has_last_3_month_differs->ans_data)) && in_array("47",  $form_data->has_last_3_month_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Malaria<br>
                    </td>
                    <td style="border: none;">
                       
                        <i class="fa"> <?php if((!empty($form_data->has_last_3_month_differs->ans_data)) && in_array("49",  $form_data->has_last_3_month_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Zika / West Nile IntectIon(S)<br>
                    </td>   
                    </tr>
                </table>
                </td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: middle;"><i class="fa"> <?php if($form_data->has_last_3_month_differs->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"><?php echo $form_data->has_last_3_month_differs->ans == "no" ? "&#xf14a;" : "&#xf096;"; ?></i></i> No</span></td>
            </tr>  
            <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">13. In The Last 6 Months Have You Had Any<br> Of The Following :
                    <table style="border: none;">
                        <tr style="border: none;">
                         <td style="border: none;">
                            <i class="fa"> <?php if((!empty($form_data->has_recent_difers->ans_data)) && in_array("37",  $form_data->has_recent_difers->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Anemia<br>
                            <i class="fa"><?php if((!empty($form_data->has_recent_difers->ans_data)) && in_array("39",  $form_data->has_recent_difers->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Dengue<br>
                            <i class="fa"><?php if((!empty($form_data->has_recent_difers->ans_data)) && in_array("50",  $form_data->has_recent_difers->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Tattooing<br>
                             <i class="fa"><?php if((!empty($form_data->has_recent_difers->ans_data)) && in_array("52",  $form_data->has_recent_difers->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Chikungunya<br>
                            <i class="fa"><?php if((!empty($form_data->has_recent_difers->ans_data)) && in_array("38",  $form_data->has_recent_difers->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Accidental Needle Prick<br>
                        </td>
                        <td style="border: none;">
                            
                           
                            <i class="fa"><?php if((!empty($form_data->has_recent_difers->ans_data)) && in_array("53",  $form_data->has_recent_difers->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Repeated Diarrhea<br>
                            <i class="fa"><?php if((!empty($form_data->has_recent_difers->ans_data)) && in_array("40",  $form_data->has_recent_difers->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Penpheral Stem Cells<br>
                            <i class="fa"><?php if((!empty($form_data->has_recent_difers->ans_data)) && in_array("Blood Transfusion",  $form_data->has_recent_difers->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Blood Transfusion<br>
                            <i class="fa"><?php if((!empty($form_data->has_recent_difers->ans_data)) && in_array("51",  $form_data->has_recent_difers->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Localized Skin Cancer that was removed
                        </td>
                         
                        </tr>
                       
                    </table>
                </td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: middle;"><i class="fa"><?php if($form_data->has_recent_difers->ans == "yes" ){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"> <?php if($form_data->has_recent_difers->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
            </tr>  
        </table>
            
        </td> 
        <td style="border: none; padding-top: 10px; padding-bottom: 10px; padding-left: 15px; vertical-align: top;">
          
                <table style="border: none;">
                    <tr style="border: none;">
                        <td style="border: none;font-weight:400 !important;color:#282829;font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">14. In The Last 12 Months Have You Had Any Of The Following :
                        <table style="border: none;">
                        <tr style="border: none;">
                        <td style="border: none;width: 150px;">
                            <!-- Immunogtobutin
                            Maier Surgery
                            Typhoid
                            Rabies
                            Hepatitis
                            Skin Graft
                            GI Endoscopy
                            Body Piercing
                            Inmate of Jail or any other confinement
                            Organ / Tissue or bone marrow donation -->

                            <i class="fa"><?php if((!empty($form_data->has_last_12_month_differs->ans_data)) && in_array("55",  $form_data->has_last_12_month_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Jaundice<br>
                            <i class="fa"><?php if((!empty($form_data->has_last_12_month_differs->ans_data)) && in_array("57",  $form_data->has_last_12_month_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Major Surgery<br>
                            <i class="fa"> <?php if((!empty($form_data->has_last_12_month_differs->ans_data)) && in_array("59",  $form_data->has_last_12_month_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Vaccination (Rabies)<br>
                            <i class="fa"><?php if((!empty($form_data->has_last_12_month_differs->ans_data)) && in_array("61",  $form_data->has_last_12_month_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Bone Or Skin Graft<br>
                            <i class="fa"><?php if((!empty($form_data->has_last_12_month_differs->ans_data)) && in_array("64",  $form_data->has_last_12_month_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> GI Endoscopy<br>
                            <i class="fa"><?php if((!empty($form_data->has_last_12_month_differs->ans_data)) && in_array("65",  $form_data->has_last_12_month_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Blood Transfusion<br>
                           
                        </td>
                        <td style="border: none;width: 150px;">
                            <i class="fa"> <?php if((!empty($form_data->has_last_12_month_differs->ans_data)) && in_array("58",  $form_data->has_last_12_month_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Immunogtobutin<br>
                            <i class="fa"> <?php if((!empty($form_data->has_last_12_month_differs->ans_data)) && in_array("60",  $form_data->has_last_12_month_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Typhoid<br>
                            <i class="fa"><?php if((!empty($form_data->has_last_12_month_differs->ans_data)) && in_array("62",  $form_data->has_last_12_month_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Hepatitis A/ E<br>
                             <i class="fa"> <?php if((!empty($form_data->has_last_12_month_differs->ans_data)) && in_array("63",  $form_data->has_last_12_month_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Body Piercing<br>
                            <i class="fa"><?php if((!empty($form_data->has_last_12_month_differs->ans_data)) && in_array("56",  $form_data->has_last_12_month_differs->ans_data)){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Organ / Tissue or bone marrow donation<br>
                           
                        </td>   
                        </tr>
                      <!--   <tr style="border: none;">
                            <td style="border: none;">
                               <i class="fa"><?php echo $form_data->has_last_12_month_differs->ans_data == "Anemia" ? "&#xf14a;" : "&#xf096;"; ?></i></i> Bone Or Skin Graft<br>
                                <i class="fa"><?php echo $form_data->has_last_12_month_differs->ans_data == "Inmate of Jail or any other confinement" ? "&#xf14a;" : "&#xf096;"; ?></i></i> Inmate Of Jail Or Any Other Confinement<br>
                                <i class="fa"><?php echo $last_six_ill_type == "Organ / Tissue or bone marrow donation" ? "&#xf14a;" : "&#xf096;"; ?></i></i> Organ / Tissue Or Bone Marrow Donation
                            </td>
            
                            </tr> -->
                    </table>
                        </td>
                        <td width="10" style="border: none;"></td>
                        <td style="border: none;vertical-align: top;width: 80px;"><i class="fa"><?php if($form_data->has_last_12_month_differs->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"><?php if($form_data->has_last_12_month_differs->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span>
                        </td>
                    </tr>
                     <tr style="border: none;">
                        <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">15. In The Last 2 Years Have You Had Any Of The Following :
                        <table style="border: none;">
                            <tr style="border: none;">
                  
                            <td width="150" style="border: none;">
                                <?php if($form_data->has_perm_differ->ans_data == "osieomyelltis"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> osieomyelltis</td>
                             <td style="border: none;"><?php if($form_data->has_perm_differ->ans_data == "tuberculosis"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> Tubercuiosis
                            </td> 
                            </tr>
                            
                        </table>
                        </td>
                        <td width="10" style="border: none;"></td>
                        <td style="border: none;vertical-align: top;"><i class="fa"><?php if($form_data->has_perm_differ->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"><?php if($form_data->has_perm_differ->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
                    </tr> 
                    <tr style="border: none;">
                        <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;">16. Have You Ever Had Any Of The Following (Permanent Defer) :
                        <table style="border: none;">
                            <tr style="border: none;">
                            <td style="border: none;">
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Heart Disease"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Heart Disease <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Tuberculosis"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Tuberculosis<br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Cancer Malignant Disease"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Cancer! Malignant Disease  <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Any Swollen Gland"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Any Swollen Gland<br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Chronic Liver Disease"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Chronic Liver Disease  <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Acute Kidney Infection"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Acute Kidney Infection  <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Hepatitis Infection"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Hepatitis B/C Infection  <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Chronic Respiratory Disease"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Chronic Respiratory Disease  <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Convulsion"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Convulsion  <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Polycythemia"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Polycythemia  <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Leprosy"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Leprosy  <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Schizophrenia"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Schizophrenia  <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Endocrine Disorders"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Endocrine Disorders <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Hepatitis"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>Disorders  
                            </td>
                            <td style="border: none;"><i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Hepatitis"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Minor Surgery<br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Epilepsy"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Epilepsy<br>
                                 
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Heart Disease Medication"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Heart Disease Medication  <br>
                                <i class="fa"><?php if( $form_data->has_perm_differ->ans_data == "Abnormal Bleeding Tendency"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Abnormal Bleeding Tendency<br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Asthma on Steroids"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Asthma On Steroids  <br>
                                 <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Cardiac Vascular Disease"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Cardiac Vascular Disease  <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Stomach Unfcer"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Stomach Unfcer  <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Lung Disease"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Lung Disease<br>
                                <i class="fa"><?php if( $form_data->has_perm_differ->ans_data == "Hemolytic Anemia"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Hemolytic Anemia  <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Autoimmune Disorder"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Autoimmune Disorder  <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Psychiatric Disorder"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Psychiatric Disorder  <br>
                                <i class="fa"><?php if( $form_data->has_perm_differ->ans_data == "Kala - azar"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Kala - Azar<br> 
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Severe Allergic Disease"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Severe Allergic Disease  <br>
                            </td> 
                            </tr>
                             <tr>
                                <td colspan="2" style="border: none;">
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Sexually Transmitted Diseases"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>Sexually Transmitted Diseases  <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Open Heart Surgery Including By-pass Surgery"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>Open Heart Surgery Including By-Pass Surgery <br> 
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Unexplained Weight Loss"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>Unexplained Weight Loss  <br>
                                <i class="fa"><?php if( $form_data->has_perm_differ->ans_data == "Recipient of Organ / Stem Cells Transplantation"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>Recipient Of Organ / Stem Cells Transplantation <br>
                                <i class="fa"><?php if($form_data->has_perm_differ->ans_data == "Diabetes (Contsolled on Insulin)"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Diabetes (Contsolled On Insulin)  <br></td>
                            </tr>
                        </table>
                        </td>
                        <td width="10" style="border: none;"></td>
                        <td style="border: none;vertical-align: top;"><i class="fa"><?php if( $form_data->has_perm_differ->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"><?php if($form_data->has_perm_differ->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
                    </tr> 
                     <!-- 16-point -->
                     <?php  if($row->gender == 'female'){ ?>
                     <tr style="border: none;">
                        <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left; vertical-align: top;"><strong>17. For Female Only :</strong>
                        </td>
                        
                    </tr> 
                   <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;" >1. Are You Pregnant Or Have You Been Pregnant Within Last Six Months:</td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: top;"><i class="fa"><?php if( $form_data1->has_pregnant->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"><?php if($form_data1->has_pregnant->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
            </tr>
             <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;" >2. Abortion (6 Months)?:</td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: top;"><i class="fa"><?php if($form_data1->has_abortion->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"><?php if($form_data1->has_abortion->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
            </tr>
             <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;" >3. When Did You Have Last Menstrual Period <?php echo (!empty($form_data1) && isset($form_data1->last_menstrual_period->ans_data))?$form_data1->last_menstrual_period->ans_data:'';?></td>
                
            </tr>
             <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;" >4. Are You Breast Feeding (12 Months)?:</td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: top;"><i class="fa"><?php if($form_data1->has_breast_feeden_last_12_month->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"><?php if($form_data1->has_breast_feeden_last_12_month->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
            </tr>
                   <tr style="border: none;">
                <td style="border: none;font-weight:400 !important;color:#282829;line-height:20px!important; font: 14px / 1.25 'Roboto', sans-serif; text-align: left;" >5. Do You Have Child Less Than 1 Year Old</td>
                <td width="10" style="border: none;"></td>
                <td style="border: none;vertical-align: top;"><i class="fa"><?php if($form_data1->has_child_less_one_year->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</span> <i class="fa"><?php if( $form_data1->has_child_less_one_year->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</span></td>
            </tr> 
            <?php } ?>  
                </table>        
        </td>
    </tr>

</table>
<br><br><br><br>
<p style="font-weight:700;color:#252122;line-height:20px!important; margin: 0px 0px 15px 0px;;font: 14px / 1.25 'Raleway', sans-serif; text-align: center;font-weight: 500;">SELF EXCLUSION QUESTIONNAIRE - RISK BEHAVIOR <br>
    (Please answer all question honestly Your answers will be confidential)</p>
    <?php  if($row->gender == 'male'){ ?>
       <table style="border: none;" class="defer-sec">        
        <tr style="border:none;">
            <td style="width: 700px;border:none;">1. Do You Practice Safe Sex? </td>
            <td style="width: 50px;border:none;"><i class="fa"><?php if((!empty($form_data1->has_safe_sex->ans)) && $form_data1->has_safe_sex->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>Yes</td>
            <td style="width: 50px;border:none;"><i class="fa"><?php if((!empty($form_data1->has_safe_sex->ans)) && $form_data1->has_safe_sex->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td style="border:none;"><i class="fa"><?php if( (!empty($form_data1->has_safe_sex->ans)) && $form_data1->has_safe_sex->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>NA</td> 
        </tr>
        <tr style="border:none;">
            <td style="border:none;">2. Are You HIV Positive Or Do You Think You May Be HIV Positive?</td>
            <td style="border:none;"><i class="fa"><?php if( (!empty($form_data1->has_hiv_positive->ans)) && $form_data1->has_hiv_positive->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>Yes </td>
            <td style="border:none;"><i class="fa"><?php if((!empty($form_data1->has_hiv_positive->ans)) && $form_data1->has_hiv_positive->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>No </td>
            <td style="border:none;"><i class="fa"><?php if((!empty($form_data1->has_hiv_positive->ans)) && $form_data1->has_hiv_positive->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>NA </td>  
        </tr>
        <tr style="border:none;">
            <td style="border:none;">3. Is Your Reason For Donating Blood To Undergo An HIV Test ?</td>
            <td style="border:none;"><i class="fa"><?php if((!empty($form_data1->to_undergo_hiv_test->ans)) && $form_data1->to_undergo_hiv_test->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>Yes </td>
            <td style="border:none;"><i class="fa"><?php if((!empty($form_data1->to_undergo_hiv_test->ans)) && $form_data1->to_undergo_hiv_test->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>No </td>
            <td style="border:none;"><i class="fa"><?php if((!empty($form_data1->to_undergo_hiv_test->ans)) && $form_data1->to_undergo_hiv_test->ans == "none"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>None Of These </td>
           
        </tr>
                </table>
    <h3 style="font-weight:700 !important;color:#282829;line-height:20px!important; margin: 0px 0px 8px 0px;font: 15px / 1.25 'Roboto', sans-serif; text-align: left;">IN THE PAST 6 MONTHS :</h3>
    <table width="100%" class="defer-sec">
        <tr>
            <td>1. Have You Had Sexual Activity By Paying Money Or Vise Versa?</td>
            <td><i class="fa"><?php if((!empty($form_data1->has_sex_with_money->ans)) && $form_data1->has_sex_with_money->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if( (!empty($form_data1->has_sex_with_money->ans)) && $form_data1->has_sex_with_money->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> No</td>  
            <td><i class="fa"><?php if((!empty($form_data1->has_sex_with_money->ans)) && $form_data1->has_sex_with_money->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> NA</td>  
        </tr>
        <tr>
            <td>2. Have You Had Multiple Sex Partners?</td>
            <td><i class="fa"><?php if((!empty($form_data1->has_multiple_sex_partner->ans)) && $form_data1->has_multiple_sex_partner->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if( (!empty($form_data1->has_multiple_sex_partner->ans)) && $form_data1->has_multiple_sex_partner->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td><i class="fa"><?php if( (!empty($form_data1->has_multiple_sex_partner->ans)) && $form_data1->has_multiple_sex_partner->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> NA</td>  
        </tr>
        <tr>
            <td>3. Victim Of Sexual Assault?</td>
            <td><i class="fa"><?php if( (!empty($form_data1->has_sexual_assualt->ans)) && $form_data1->has_sexual_assualt->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if( (!empty($form_data1->has_sexual_assualt->ans)) && $form_data1->has_sexual_assualt->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td><i class="fa"><?php if((!empty($form_data1->has_sexual_assualt->ans)) && $form_data1->has_sexual_assualt->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> NA</td>  
        </tr>
        <tr>
            <td>4. Sex With Someone Whose Background You Do Not Know?</td>
            <td><i class="fa"><?php if((!empty($form_data1->has_sex_with_stranger->ans)) && $form_data1->has_sex_with_stranger->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if((!empty($form_data1->has_sex_with_stranger->ans)) && $form_data1->has_sex_with_stranger->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td><i class="fa"><?php if((!empty($form_data1->has_sex_with_stranger->ans)) && $form_data1->has_sex_with_stranger->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> None Of These</td>  
        </tr>
    </table>
    <h3 style="font-weight:700 !important;color:#282829;line-height:20px!important; margin: 0px 0px 8px 0px;font: 15px / 1.25 'Roboto', sans-serif; text-align: left;">IN THE PAST 12 MONTHS :</h3>
    <table width="100%" class="defer-sec" >
        <tr>
            <td>1. Have You Suffered From Sexually Transmitted Disease?</td>
            <td><i class="fa"><?php if((!empty($form_data1->has_sexually_transmitted_disease->ans)) && $form_data1->has_sexually_transmitted_disease->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if((!empty($form_data1->has_sexually_transmitted_disease->ans)) && $form_data1->has_sexually_transmitted_disease->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td><i class="fa"><?php if((!empty($form_data1->has_sexually_transmitted_disease->ans)) && $form_data1->has_sexually_transmitted_disease->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> NA</td>  
        </tr>
        <tr>
            <td>2. Have You Over Injected Yourself With Drugs Not Prescribed By Doctor?</td>
            <td><i class="fa"><?php if( (!empty($form_data1->has_injected_drugs->ans)) && $form_data1->has_injected_drugs->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if((!empty($form_data1->has_injected_drugs->ans)) && $form_data1->has_injected_drugs->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td><i class="fa"><?php if( (!empty($form_data1->has_injected_drugs->ans)) && $form_data1->has_injected_drugs->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> NA</td>  
        </tr>
        <tr>
            <td>3. Do You Think Any Of The Above Questions May Be True For Your Sex Partner?</td>
            <td><i class="fa"><?php if( (!empty($form_data1->has_thinking_above_questions_true->ans)) && $form_data1->has_thinking_above_questions_true->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if( (!empty($form_data1->has_thinking_above_questions_true->ans)) && $form_data1->has_thinking_above_questions_true->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td><i class="fa"><?php if( (!empty($form_data1->has_thinking_above_questions_true->ans)) && $form_data1->has_thinking_above_questions_true->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> NA</td>  
        </tr>
        <tr>
            <td>4. Do You Consider Your Blood Safe For Transfusion To A Patient</td>
            <td><i class="fa"><?php if((!empty($form_data1->has_consider_self_safe_transfusion->ans)) && $form_data1->has_consider_self_safe_transfusion->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if((!empty($form_data1->has_consider_self_safe_transfusion->ans)) && $form_data1->has_consider_self_safe_transfusion->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td><i class="fa"><?php if((!empty($form_data1->has_consider_self_safe_transfusion->ans)) && $form_data1->has_consider_self_safe_transfusion->ans == "none"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> None Of These</td>  
        </tr>
    </table>
<?php }else{ ?>
       <table style="border: none;" class="defer-sec">        
        <tr style="border:none;">
            <td style="width: 700px;border:none;">1. Do You Practice Safe Sex? </td>
            <td style="width: 50px;border:none;"><i class="fa"><?php if((!empty($form_data2->has_safe_sex->ans)) && $form_data2->has_safe_sex->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>
            <td style="width: 50px;border:none;"><i class="fa"><?php if((!empty($form_data2->has_safe_sex->ans)) && $form_data2->has_safe_sex->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td style="border:none;"><i class="fa"><?php if( (!empty($form_data2->has_safe_sex->ans)) && $form_data2->has_safe_sex->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> NA</td> 
        </tr>
        <tr style="border:none;">
            <td style="border:none;">2. Are You HIV Positive Or Do You Think You May Be HIV Positive?</td>
            <td style="border:none;"><i class="fa"><?php if( (!empty($form_data2->has_hiv_positive->ans)) && $form_data2->has_hiv_positive->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes </td>
            <td style="border:none;"><i class="fa"><?php if((!empty($form_data2->has_hiv_positive->ans)) && $form_data2->has_hiv_positive->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No </td>
            <td style="border:none;"><i class="fa"><?php if((!empty($form_data2->has_hiv_positive->ans)) && $form_data2->has_hiv_positive->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> NA </td>  
        </tr>
        <tr style="border:none;">
            <td style="border:none;">3. Is Your Reason For Donating Blood To Undergo An HIV Test ?</td>
            <td style="border:none;"><i class="fa"><?php if((!empty($form_data2->to_undergo_hiv_test->ans)) && $form_data2->to_undergo_hiv_test->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes </td>
            <td style="border:none;"><i class="fa"><?php if((!empty($form_data2->to_undergo_hiv_test->ans)) && $form_data2->to_undergo_hiv_test->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No </td>
            <td style="border:none;"><i class="fa"><?php if((!empty($form_data2->to_undergo_hiv_test->ans)) && $form_data2->to_undergo_hiv_test->ans == "none"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> None Of These </td>
           
        </tr>
                </table>
    <h3 style="font-weight:700 !important;color:#282829;line-height:20px!important; margin: 0px 0px 8px 0px;font: 15px / 1.25 'Roboto', sans-serif; text-align: left;">IN THE PAST 6 MONTHS :</h3>
    <table width="100%" class="defer-sec">
        <tr>
            <td>1. Have You Had Sexual Activity By Paying Money Or Vise Versa?</td>
            <td><i class="fa"><?php if((!empty($form_data2->has_sex_with_money->ans)) && $form_data2->has_sex_with_money->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if((!empty($form_data2->has_sex_with_money->ans)) && $form_data2->has_sex_with_money->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> No</td>  
            <td><i class="fa"><?php if( (!empty($form_data2->has_sex_with_money->ans)) && $form_data2->has_sex_with_money->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> NA</td>  
        </tr>
        <tr>
            <td>2. Have You Had Multiple Sex Partners?</td>
            <td><i class="fa"><?php if((!empty($form_data2->has_multiple_sex_partner->ans)) && $form_data2->has_multiple_sex_partner->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if( (!empty($form_data2->has_multiple_sex_partner->ans)) && $form_data2->has_multiple_sex_partner->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td><i class="fa"><?php if( (!empty($form_data2->has_multiple_sex_partner->ans)) && $form_data2->has_multiple_sex_partner->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> NA</td>  
        </tr>
        <tr>
            <td>3. Victim Of Sexual Assault?</td>
            <td><i class="fa"><?php if((!empty($form_data2->has_sexual_assualt->ans)) && $form_data2->has_sexual_assualt->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if( (!empty($form_data2->has_sexual_assualt->ans)) && $form_data2->has_sexual_assualt->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td><i class="fa"><?php if( (!empty($form_data2->has_sexual_assualt->ans)) && $form_data2->has_sexual_assualt->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> NA</td>  
        </tr>
        <tr>
            <td>4. Sex With Someone Whose Background You Do Not Know?</td>
            <td><i class="fa"><?php if((!empty($form_data2->has_sex_with_stranger->ans)) && $form_data2->has_sex_with_stranger->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if((!empty($form_data2->has_sex_with_stranger->ans)) && $form_data2->has_sex_with_stranger->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td><i class="fa"><?php if((!empty($form_data2->has_sex_with_stranger->ans)) && $form_data2->has_sex_with_stranger->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> None Of These</td>  
        </tr>
    </table>
    <h3 style="font-weight:700 !important;color:#282829;line-height:20px!important; margin: 0px 0px 8px 0px;font: 15px / 1.25 'Roboto', sans-serif; text-align: left;">IN THE PAST 12 MONTHS :</h3>
    <table width="100%" class="defer-sec" >
        <tr>
            <td>1. Have You Suffered From Sexually Transmitted Disease?</td>
            <td><i class="fa"><?php if( (!empty($form_data2->has_sexually_transmitted_disease->ans)) && $form_data2->has_sexually_transmitted_disease->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if((!empty($form_data2->has_sexually_transmitted_disease->ans)) && $form_data2->has_sexually_transmitted_disease->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td><i class="fa"><?php if((!empty($form_data2->has_sexually_transmitted_disease->ans)) && $form_data2->has_sexually_transmitted_disease->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> NA</td>  
        </tr>
        <tr>
            <td>2. Have You Over Injected Yourself With Drugs Not Prescribed By Doctor?</td>
            <td><i class="fa"><?php if((!empty($form_data2->has_injected_drugs->ans)) && $form_data2->has_injected_drugs->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if( (!empty($form_data2->has_injected_drugs->ans)) && $form_data2->has_injected_drugs->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td><i class="fa"><?php if( (!empty($form_data2->has_injected_drugs->ans)) && $form_data2->has_injected_drugs->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> NA</td>  
        </tr>
        <tr>
            <td>3. Do You Think Any Of The Above Questions May Be True For Your Sex Partner?</td>
            <td><i class="fa"><?php if( (!empty($form_data2->has_thinking_above_questions_true->ans)) && $form_data2->has_thinking_above_questions_true->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if((!empty($form_data2->has_thinking_above_questions_true->ans)) && $form_data2->has_thinking_above_questions_true->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td><i class="fa"><?php if((!empty($form_data2->has_thinking_above_questions_true->ans)) && $form_data2->has_thinking_above_questions_true->ans == "na"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> NA</td>  
        </tr>
        <tr>
            <td>4. Do You Consider Your Blood Safe For Transfusion To A Patient</td>
            <td><i class="fa"><?php if( (!empty($form_data2->has_consider_self_safe_transfusion->ans)) && $form_data2->has_consider_self_safe_transfusion->ans == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> Yes</td>  
            <td><i class="fa"><?php if( (!empty($form_data2->has_consider_self_safe_transfusion->ans)) && $form_data2->has_consider_self_safe_transfusion->ans == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> No</td>  
            <td><i class="fa"><?php if( (!empty($form_data2->has_consider_self_safe_transfusion->ans)) && $form_data2->has_consider_self_safe_transfusion->ans == "none"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i> None Of These</td>  
        </tr>
    </table>
    <?php } ?> 
    <ul style="padding-left: 0px; list-style: none;">
        <li style="line-height: 28px;margin-bottom: 8px;">1. The test done on your donated Blood are follows :<br>• HBsAg&nbsp;&nbsp;  • Anti HIV&nbsp;&nbsp;  • Anti HCV&nbsp;&nbsp;  • Syphilis&nbsp;&nbsp;  • Malaria Parasite</li>
        <li style="line-height: 28px;margin-bottom: 8px;">2. These tests are also done free of cost at ICTC Centre. If you are looking to get the test done, please contact Department of Microbiology,SMS Medical College. Jaipur.</li>
        <li style="line-height: 28px;margin-bottom: 8px;">3. All the test results are kept highly confidential.Danger :The window period • It refers to the time from when a person is first infected till the person tests positive.<br>
        <strong>Danger:</strong> the window period,laboratory tests are negative but the person is still capable of infecting others. Help keep the blood supply as safe as possible by lookingHONESTLY at your lifestyle &amp; answering the question truthfully.</li>
      </ul>
      <strong style="font-size:14px;">INFORMED CONSENT:</strong>
    <ul style="padding-left: 0px; list-style: none;margin-bottom: 0rem;">
        <li style="line-height: 28px;margin-bottom: 8px;">1.    I have read and understood the intormati on in the donor form and education material.</li>
        <li style="line-height: 28px;margin-bottom: 8px;">2.    I confirm, that to my knowledge. I have answered all the questions accurately and truth fully and do not consider myself to be a person involved in any of thedescribed activities that could please me at the risk of spreading HIV or Hepatitis.</li>
        <li style="line-height: 28px;margin-bottom: 8px;">3.    I understand that any willful misrepresentation of the facts could endanger the patients receiving my blood.</li>
        <li style="line-height: 28px;margin-bottom: 8px;">4.    I am aware that my blood will be screened for HIV. Hepatitis B. Hepatitis C. Malaria & Syphilis in addition to any other screening tests required to ensureblood safety</li>
        <li style="line-height: 28px;margin-bottom: 8px;">5.    I understand that screening test are not diagnostics and may yield false postive results.I also understand further confirmatory test would be required incase of positive results and that for any positive results <i class="fa fa-check-square" aria-hidden="true" ></i> I MaY. <i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i> MaY Not. <i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i> be contacted.</li>
        <li style="line-height: 28px;margin-bottom: 8px;">6.    I understand that my blood will be utlized in accordance with regulatory guide'mesinclud,ng NBTC and drug and cosmetic act and regulations pertaining toit or its future replacements</li>
        <li style="line-height: 28px;margin-bottom: 8px;">7.    I understand the blood donation procedure and possible risk (vaso-vagal re act on. hematoma. etc.) involved as explained.</li>
        <li style="line-height: 28px;margin-bottom: 8px;">8.    I confirm that I am over the age of 18 years</li>
        <li style="line-height: 28px;margin-bottom: 8px;">9.    I understand that blood donation is totally voluntary act and no inducement or remunerat on in cash or hind has been offered to me.</li>
        <li style="line-height: 28px;margin-bottom: 8px;">10.   I prohibit any personal details (except demographic details) provided by me or about my donation to be disclosed to any individual or agency except askedby government.</li>
        <li style="line-height: 28px;margin-bottom: 8px;">11.   I hereby declare that I am donating blood voluntarily without any pressure lone cchesionthreatlalse misconception from the Blood Bank.</li>
        <li style="line-height: 28px;margin-bottom: 8px;">12.   I hereby volume-et to donate my Blood Blood components which may be used for pat,ent'scientific researchlfractionation (surplus plasma).</li>
        <li style="line-height: 28px;margin-bottom: 8px;">13.   My donatea blood/ components may be utilized beyond this Blood Bank</li>
         <li style="line-height: 28px;">14.  <b>You would liked to be informed about any abnormal test results (HIV, HBsAg, HCV, Syphilis, Malaria parasite) at the address furnished by you</b></li>
    </ul>
    <?php  if($row->gender == 'male'){ ?>
<table class="defer-sec">
    <tr>
                
        <td style="padding: 5px;">• I have been give in the opportunity to ask question and they have been answered in the language understand. by me.</td>

<td><?php if($form_data2->opportunity == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> Yes &nbsp;&nbsp;</td>
<td><?php if( $form_data2->opportunity == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> No </td>

</tr>
<tr>
    <td style="padding: 5px;">• I have given the opportunity to refuse the blood donation</td>
  
    <td ><?php if($form_data2->refuse == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> Yes &nbsp;&nbsp;</td>
  
    <td><?php if(  $form_data2->refuse == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> No </td>
    </tr>
    <tr>
        
        <td style="padding: 5px;">• I would like to be regular voluntary donor :</td>

        <td><?php if($form_data2->regular == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> Yes  &nbsp;&nbsp;</td>
 
        <td><?php if( $form_data2->regular == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> No  </td>
        </tr>
</table>

<p style="margin-bottom: 0rem !important;" class="icons-my-hero">If yes on : &nbsp;&nbsp;&nbsp;&nbsp;
    
    <?php if( $form_data2->donor == "Birthday"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?><span class="birthday-span"> Birthday </span>
    <?php if( $form_data2->donor == "Marriage"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?><span class="birthday-span"> Marriage Anniversary</span>
   <?php if( $form_data2->donor == "After"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?><span class="birthday-span"> After 6 month </span>
   <?php if( $form_data2->donor == "Once"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?><span class="birthday-span"> Once year </span>
    <?php if( $form_data2->donor == "Emergency"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> <span class="birthday-span">In Emergency Requirement</span>
</p>
<!-- <p><b>MEDICAL & SYSTEMIC EXAMINATION :</b></p> -->

<p style="font-size:14px;margin-bottom: 0rem !important;"><b>MEDICAL & SYSTEMIC EXAMINATION :</b>
	<?php if((!empty( $form_data3->has_accepted_defer)) && $form_data3->has_accepted_defer == "accept" ){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;Accept&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if((!empty( $form_data3->has_accepted_defer)) && $form_data3->has_accepted_defer == "defer"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;Defer</p>
<?php }else{ ?>
  <table class="defer-sec">
    <tr>
                
        <td style="padding: 5px;">• I have been give in the opportunity to ask question and they have been answered in the language understand. by me.</td>

<td><?php if($form_data3->opportunity == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> Yes &nbsp;&nbsp;</td>
<td><?php if( $form_data3->opportunity == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> No </td>

</tr>
<tr>
    <td style="padding: 5px;">• I have given the opportunity to refuse the blood donation</td>
  
    <td ><?php if($form_data3->refuse == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> Yes &nbsp;&nbsp;</td>
  
    <td><?php if(  $form_data3->refuse == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> No </td>
    </tr>
    <tr>
        
        <td style="padding: 5px;">• I would like to be regular voluntary donor :</td>

        <td><?php if($form_data3->regular == "yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> Yes  &nbsp;&nbsp;</td>
 
        <td><?php if( $form_data3->regular == "no"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> No  </td>
        </tr>
</table>

<p style="margin-bottom: 0rem !important;" class="icons-my-hero">If yes on : &nbsp;&nbsp;&nbsp;&nbsp;
    
    <?php if( $form_data3->donor == "Birthday"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?><span class="birthday-span"> Birthday </span>
    <?php if( $form_data3->donor == "Marriage"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?><span class="birthday-span"> Marriage Anniversary</span>
   <?php if( $form_data3->donor == "After"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?><span class="birthday-span"> After 6 month </span>
   <?php if( $form_data3->donor == "Once"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?><span class="birthday-span"> Once year </span>
    <?php if( $form_data3->donor == "Emergency"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?> <span class="birthday-span">In Emergency Requirement</span>
</p>
<!-- <p><b>MEDICAL & SYSTEMIC EXAMINATION :</b></p> -->

<p style="font-size:14px;margin-bottom: 0rem !important;"><b>MEDICAL & SYSTEMIC EXAMINATION :</b>
  <?php if((!empty( $form_data3->has_accepted_defer)) && $form_data3->has_accepted_defer == "accept" ){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;Accept&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if((!empty( $form_data3->has_accepted_defer)) && $form_data3->has_accepted_defer == "defer"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;Defer</p>
<?php } ?>
<table width="100%" style="border:1px solid #252122">
    <tr>
        <td align="cenetr" style="border:1px solid #252122; padding: 10px; text-align: center;"></td>
        <td align="cenetr" style="border:1px solid #252122; padding: 10px; text-align: center;">Donor</td>
        <td align="cenetr" style="border:1px solid #252122; padding: 10px; text-align: center;">interpreter(if applicable)</td>
        <td align="cenetr" style="border:1px solid #252122; padding: 10px; text-align: center;">Councelor/Doctor</td>
    </tr>
    <tr>
        <td align="cenetr" style="border:1px solid #252122; padding: 10px; text-align: center;">Signature or Thumb Impression</td>
        <td align="cenetr" style="border:1px solid #252122; padding: 10px; text-align: center;"></td>
        <td align="cenetr" style="border:1px solid #252122; padding: 10px; text-align: center;"></td>
        <td align="cenetr" style="border:1px solid #252122; padding: 10px; text-align: center;"></td>
    </tr>

   
</table>

<h3 style="text-align: center;font-size:16px;font-weight:700;">Reason of Defer</h3>

<table  width="100%" class="defer-sec">
  <!--   Abnormal Bleeding Tendency
    Abrotion
    Breast Feeding
    Gonorrhea
    Medication History
    Seizures
    Cancer
    Heart Disease
    Occupational Hazard
    Surgical Procedures
    Chikungunya
    Jaundice
    Pregnancy
    Tuberculosis
    Age (Below 18 yrs)
    Dengue
    Kidney Disease
    Pulse (Abnormal
    lcer
    Age (Above 65 yrs)
    Donation Interval
    Leprosy
    Respiratory Infection
    Unexplained weight loss
    Blood Transfusion History
    Fever
    Liver Disease
    Schizophrenia
    Vaccination
    Blood Pressure
    Genital sore or generalized skin rashes
    Low Haemoglobin
    Severe Allergic Disorders
    Viral Hepatitis (B & C)
    Malaria
    Weight (Less than 50 Kg)
    Active symptom (Chest Pain. Shortness of breath. Swelling of feet ) -->
   <!-- <?php  $sex_partner = "yes"; ?> -->
       <tr>
        <td> <?php if((!empty( $form_data3->has_accepted_defer)) && $form_data3->has_accepted_defer == "Permanent"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;Permanent Deferral&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><?php if((!empty( $form_data3->has_accepted_defer)) && $form_data3->has_accepted_defer == "Temporary"){?><i class="fa fa-check-square" aria-hidden="true"></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;Temporary Deferral</td>
        <td colspan="2"></td>
    </tr>

<tr>
    <td colspan="5"><h4 style="font-size:14px;margin-bottom:0px;font-weight:700;">PLEASE TICK THE REASON FOR DEFERRAL</h4></td>
</tr>
    
    <tr>
        <td > <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Abnormal Bleeding Tendency",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Abnormal Bleeding Tendency&nbsp;&nbsp;&nbsp;&nbsp;</td>      
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Breast Feeding",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Breast Feeding&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Gonorrhea",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Gonorrhea&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Medication History",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Medication History&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Seizures",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Seizures</td>
       
    </tr>
    <tr>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Abrotion",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Abrotion&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Cancer",  $form_data3->{'defer-cat-type'}) ){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Cancer&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Heart Disease",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Heart Disease&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Occupational Hazard",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true"></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Occupational Hazard&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Surgical Procedures",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;surgical Procedures</td>
       
    </tr>
    <tr>
        <td > <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("yes",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Active Symptom <br>(Chest Pain. Shortness Of Breath.<br> Swelling Of Feet ) &nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("yes",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Cardio-Vascular Disease&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("yes",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;HIV Information/AIDS&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("yes",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Polycythemia vera&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("yes",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Syphilis</td>
       
    </tr>
    <tr>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("yes",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Age (Below 18 Yrs)  &nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Dengue",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Dengue&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Jaundice",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Jaundice&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Pregnancy",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Pregnancy&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Tuberculosis",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true"></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Tuberculosis</td>
       
    </tr>
    <tr>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Age",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true"></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Age (Above 65 Yrs)&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Chikungunya",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Chikungunya&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Kidney Disease",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Kidney Disease&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Pulse (Abnormal)",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Pulse (Abnormal)&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("yes",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true"></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Ulcer</td>
       
    </tr>
    <tr>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Blood Transfusion History",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Blood Transfusion History&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Donation Interval",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Donation Interval&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Leprosy",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Leprosy&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Respiratory Infection",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true"></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Respiratory Infection&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Unexplained Weight Loss",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" style="font-weight: normal;"></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Unexplained Weight Loss</td>
       
    </tr>
    <tr>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Blood Pressure",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Blood Pressure&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Fever",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Fever&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Liver Disease",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Liver Disease&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Schizophrenia",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Schizophrenia&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Vaccination",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Vaccination</td>
       
    </tr>
    <tr>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Genital Sore",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Genital Sore Or Generalized Skin Rashes&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Low Haemoglobin",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Low Haemoglobin&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Severe Allergic Disorders",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp; Severe Allergic Disorders&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Viral Hepatitis",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Viral Hepatitis </td>
        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Malaria",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Malaria&nbsp;&nbsp;&nbsp;&nbsp;</td>
       
    </tr>
    <tr>

        <td> <i class="fa"><?php if( (!empty($form_data3->{'defer-cat-type'})) && in_array("Weight",  $form_data3->{'defer-cat-type'})){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i></i>&nbsp;&nbsp;Weight (Less Than 50 Kg)</td>
       
    </tr>
</table>
<br><br>
<p> <span>Any Other :__________________________ </span><span style="float:right;">Doctor Signature :__________________________ </span> </p>

</div>