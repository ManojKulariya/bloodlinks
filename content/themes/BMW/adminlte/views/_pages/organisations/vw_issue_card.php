<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <style>
    * {
      box-sizing: border-box;
    }
    .main-footer {

    border-top: 1px solid white!important;
 
}

    .constant
    {
      
      border: 2px solid black;
    width: 360px;
   position: absolute;
   left: 400px;
   height: 758px;
    }

.header {
/* overflow: hidden; */
background-color: #f1f1f1;
padding: 20px 15px;
}
.header2
{
  display: block;
float: right;
}
.header2 h6
{
  position: absolute;
  top: 20px;
}
.hea-6{
  margin-left:-10px !important;
}
    .header a {
      float: left;
      color: black;
      text-align: center;
      padding: 12px;
      text-decoration: none;
      font-size: 18px;
      line-height: 25px;
      border-radius: 4px;
    }

    .header a.logo {
      font-size: 25px;
      font-weight: bold;
    }

    .header a:hover {
      background-color: #ddd;
      color: black;
    }

    .header a.active {
      background-color: dodgerblue;
      color: white;
    }

    .header-right {
      float: right;
      position: relative;
      bottom: 20px;
    }
.container1
{
padding: 0px 10px;
}
    .field {
      padding: 0px 30px;
   
      
    }
    .field p
    {
      font-size:10px;
    }

   #name,#fname,#reg,#blood,#unit,#phone,#dd,#tt {
      border-bottom: 1px dotted black !important;
      border: none;
      width: 600px;
    }



  
    .header1
    {
      display: inline-block;
    }
    .header1 h6
    {
      position:absolute;
      left: 50px;
      top: 20px;
    }
    .header1 p {
    position: absolute;
    left: 50px;
    top: 37px;
    width: 100px;
    font-size: 8px;
}
#para {
    position: absolute;
    left: 3px;
    top: 70px;
    width: 140px;
    font-size: 10px;
}
    .dob1
    {
      display: inline-block;
      position: relative;
      /* bottom: 70px; */
      /* margin-top: 20px; */
    }
    .dob1 p
    {
      font-size: 8px;
    }
    .chek1
    {
      display: flex;
      margin: 2px;
      position: relative;
top:10px;
    }
    .chek1 label
    {
     margin-left: 10px;
     font-size: 8px;
    }
   
    .dob{
      height: 1px;
    }
    .dob p
    {
      font-size: 8px;
    }
    .sty1
    {
      position: relative;

    }
  .sty1 p
  {
font-size:10px;

  }
  p
  {
    margin-bottom:10px!important;
  }
  table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 320px;
 
}

td, th {
    border: 1px solid black;
    text-align: left;
    padding: 2px;
    font-size: 10px;
}

 @media print {
  #printPageButton {
    display: none;
  }
}
.header1 img{
  width:46px;
  height: 52px;
}
.content-wrapper{
  background:white !important;
}
  </style>
  <?php 
$id= $this->uri->segment(3);
// $bank_id = $_SESSION['bank_id'];

// $query2 = $this->db->query("SELECT * FROM bl_cities WHERE id = '$city_id'");
//  foreach ($query2->result() as $city)
// {


//    } 

   $query3 = $this->db->query("SELECT * FROM bl_crossmatch WHERE  id = '$id'");
 foreach ($query3->result() as $bl_crossmatch)
{
$bank_id = $bl_crossmatch->bloodbank_id;
 //print_r($bl_crossmatch);
 //die();
   } 
           $query1 = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id = '$bank_id'");
 foreach ($query1->result() as $bloodbank)
{
$city_id = $bloodbank->city_id;
   //print_r($bloodbank);
 //die();
   }    
 ?>
 <button id="printPageButton" onClick="window.print();" style="background-color: blue;color: white;border-radius: 5px;border-color: white;padding: 5px 10px;">Print</button>
<!-- <button onclick="window.print()" class="btn">Click Me</button> -->
<script type="text/javascript">
    window.print();
// const btn= document.getElementByID("myPdf");

// btn.addEventListener('click', function(){
//    window.print();
// });
</script>
  <div class="constant">
  <div class="header">
    <div class="header1" >
      <img src="https://www.bloodlinks.in//uploads/img/"<?php echo($bloodbank->logo) ?>></br>
  <!--   <i class="fa fa-h-square" style="font-size: 30px"></i>
    <h6>Sdmh</h6> -->
 
<p id="para">(Licence No. <?php echo($bloodbank->lic_no) ?>)</p>
    
  </div>
    <div class="header2">
      <h6 class="hea-6">BLOOD BANK</h6>
      <p style="margin-top: 22px; font-size: 8px;">(Regional Blood Bank)</p>
    </div>
  </div>
  <p style="text-align: center;font-size: 12px;height: 20px;width:345px;font-weight:bold">
   <?php echo($bloodbank->name) ?>
  </p>
  <p style="text-align: center;font-size: 12px;width:345px;">
  <?php echo($bloodbank->address_1) ?>, Ph: <?php echo($bloodbank->contact_ph_no) ?>
   </p>
  <div class="field">
<p><span style="font-weight: bold;">Name. </span> <?php echo($bl_crossmatch->p_name) ?></p>
<p><span style="font-weight: bold;">Father's Name. </span> <?php echo($bl_crossmatch->f_name) ?></p>
<p><span style="font-weight: bold;">Blood Group. </span> <?php echo($bl_crossmatch->blood_group) ?></p>
<p><span style="font-weight: bold;">Unit no. </span> <?php echo($bl_crossmatch->unit_no) ?></p>

    </div>
    
    <div class="container1">
      <h6 style="width:345px;">Cross Match Report</h6>
       
      
<table>
<tr>
                <th rowspan="2">Component</th>
                <th rowspan="2">unit.NO</th>
                <th rowspan="2">Group</th>
                <th rowspan="2">Rh</th>
                <th colspan="2">Major Cross Match</th>
                <th rowspan="2">Minor cross match saline</th>
              </tr>
              <tr>
                <th>Title</th>
                <th>Final Cross match</th>

              </tr>
  <tr>
    <td><?php echo($bl_crossmatch->component) ?></td>
    <td><?php echo($bl_crossmatch->unit_no) ?></td>
    <td><?php echo($bl_crossmatch->groups) ?></td>
    <td></td>
    <td><?php echo($bl_crossmatch->tittre) ?></td>
    <td><?php echo($bl_crossmatch->final_cross) ?></td>
    <td><?php echo($bl_crossmatch->minnor_cross) ?></td>
  </tr>
  
</table>


      
  <h6 style="text-align: center; height: 10px; width:345px;font-size: 12px;padding-top:6px;">blood is compatible with recipient</h6>
<span style="font-size: 10px;">Name and Signature of cross match person</span>
  
  <br>
  <div class="dob">
   <p>Date .<?php echo($bl_crossmatch->crossmatch_date) ?>  Time .<?php echo($bl_crossmatch->required_time) ?>.AM/PM</p>
  </div>
   <h6 style="text-align: center;margin-top:13px;height:1px;width:340px; font-size: 12px;">Checklist for issue of Blood Product from Blood Bank</h6>
   <div class="chek1">
    <input type="checkbox" id="coding" name="interest" value="coding">
    <label for="coding" style="width:340px;">Blood bag label and compatiblity label/paparwork are all identical/compatible and correct</label>
  </div>
  <div class="chek1">
    <input type="checkbox" id="music" name="interest" value="music">
    <label for="music"  style="width:340px;">All the blood bag and patient details are identical and correct</label>
  </div>
  <div class="chek1">
    <input type="checkbox" id="music" name="interest" value="music">
    <label for="music"  style="width:340px;">Ask the attendant, spell patient full Name </label>
  </div>
  <div class="chek1">
    <input type="checkbox" id="music" name="interest" value="music">
    <label for="music" style="width:340px;">Requested of blood product including special raquirements provided</label>
  </div>
  <div class="chek1">
    <input type="checkbox" id="music" name="interest" value="music">
    <label for="music"  style="width:340px;">Expiry date and time of blood bag(ensure cross match specimen current)</label>
  </div>
  <div id="sty">
  <h6  style=" font-size: 12px;padding-top:10px; margin:0px;">Visual inspection of the blood bag(mix gently before use)</h6>
  <div class="chek1">
   <input type="checkbox" id="coding" name="interest" value="coding">
   <label for="coding">Bag intact-no leaks or evidence of tampering
   </label>
 </div>
 <div class="chek1">
   <input type="checkbox" id="music" name="interest" value="music">
   <label for="music"  style="width:340px;">No clots, unusual discoloration or turbidity or haemolysis</label>
 </div>
 <div class="chek1">
   <input type="checkbox" id="music" name="interest" value="music">
   <label for="music"  style="width:340px;">No significant color difference between tube segments and blood in bag</label>
 </div>
</div>
<div class="sty1">
<p  style="width:340px;padding:10px;">Issue no.<?php echo($bl_crossmatch->issue_no) ?></p>


 <p style="padding-left:180px; font-size: 8px;width:340px;">Name and Signature of issues person</p>
</div>
 
 <div class="dob1">
 <p  style="width:340px;">Date .<?php echo($bl_crossmatch->issue_date) ?>  Time .<?php echo($bl_crossmatch->issue_time) ?>.AM/PM</p>

 <p style="text-align: center;font-size: 8px;font-weight:600;">(Note: once issued blood/blood component will not be taken back by blood bank) </p>

</div>
    </div>
</div>