<style type="text/css">
  .content-wrapper>.content {
    text-transform: capitalize;
}
  .form-control {
    height: 25px !important;
    padding: 0 14px !important;
    font-size: 14px !important;
}
/*  */
hr{
  margin-top:0 !important;
  margin-bottom:0 !important;
}

.end-hr{
  border: 0;
    border-top: 1px solid;
    margin-top:none !important;
    margin-bottom:none !important;
}
/*  */
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
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 12px;
}


td, th {
  border: 1px solid black;
  text-align: left;

}

tr:nth-child(even) {
  /* background-color: #dddddd; */
}
#tab{

  border: 1px solid black;
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
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- <?php 
$bank_id = $_SESSION['bank_id'];
$query1 = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id = '$bank_id'");
 foreach ($query1->result() as $bloodbank)
{
$city_id = $bloodbank->city_id;
  // print_r($city_id);
// die();
   } 
$query2 = $this->db->query("SELECT * FROM bl_cities WHERE id = '$city_id'");
 foreach ($query2->result() as $city)
{

   } 

 ?> -->
<br>
<div class="container" id="printPageButton">
    <form action = "<?php $_PHP_SELF ?>" method = "POST">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

        <div class="timeline">
            <!-- <div class="time-label">
                <span class="bg-red">Consumables Items</span>
              </div> -->
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
                        
                               <div class="col-md-9">                  
                    <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                            <button type="submit" name="submit" class="btn btn-sm btn-danger" >Filter</button>
                        </div>
                    </div>
                    
                </div>
              </div>
              </div> 
            </form>
          </div>

           
<button id="printPageButton" onClick="window.print();" style="background-color: #ad1e1d;color: white;border-radius: 5px;border-color: white;padding: 5px 10px;">Print</button>
<br>
<div >
<h4  style="text-align: center;font-weight: bold;">master record</h4>

    <?php 
  $no=0;
   if(isset($_POST['submit'])){

         //print_r($_POST); die;
     $start_date = $_POST['start_date'];
     $end_date = $_POST['end_date']; 
     $start_id = $_POST['start_id']; 
     $end_id = $_POST['end_id']; 
     $unit_from = $_POST['unit_from']; 
     $unit_to = $_POST['unit_to']; 
     $request_from = $_POST['request_from']; 
     $request_to = $_POST['request_to']; 
     $name = $_POST['name']; 

     if (!empty($name) && (!empty($unit_from) && !empty($unit_to)) && (!empty($request_from) && !empty($request_to)) && (!empty($start_id) && !empty($end_id)) && (!empty($start_date) && !empty($end_date))) {

          $query = $this->db->query("SELECT bl_bb_donatioform.*, bl_blood_record.* FROM bl_bb_donatioform INNER JOIN bl_blood_record ON bl_blood_record.donor_unit_no = bl_bb_donatioform.unit_no WHERE bl_bb_donatioform.donor_name = '$name' And bl_bb_donatioform.created_at BETWEEN '$start_date' AND '$end_date' And bl_bb_donatioform.id BETWEEN '$start_id' AND '$end_id' And bl_bb_donatioform.unit_no BETWEEN '$unit_from' AND '$unit_to' And bl_bb_donatioform.registration_no BETWEEN '$request_from' AND '$request_to'");
  
      }else{

        if(!empty($name)){
          $search = "bl_bb_donatioform.donor_name = '$name'";
        }elseif(!empty($start_date) && !empty($end_date)){
          $search = "bl_bb_donatioform.created_at BETWEEN '$start_date' AND '$end_date'";
        }elseif(!empty($start_id) && !empty($end_id)){
          $search = "bl_bb_donatioform.id BETWEEN '$start_id' AND '$end_id'";
        }elseif(!empty($unit_from) && !empty($unit_to)){
          $search = "bl_bb_donatioform.unit_no BETWEEN '$unit_from' AND '$unit_to'";
        }elseif(!empty($request_from) && !empty($request_to)){
          $search = "bl_bb_donatioform.registration_no BETWEEN '$request_from' AND '$request_to'";

      }
          $query = $this->db->query("SELECT bl_bb_donatioform.*, bl_blood_record.* FROM bl_bb_donatioform INNER JOIN bl_blood_record ON bl_blood_record.donor_unit_no = bl_bb_donatioform.unit_no WHERE $search");

      }
    }else{
       $query = $this->db->query("SELECT bl_bb_donatioform.*, bl_blood_record.* FROM bl_bb_donatioform INNER JOIN bl_blood_record ON bl_blood_record.donor_unit_no = bl_bb_donatioform.unit_no "); }
             foreach ($query->result() as $row) {
        $bank_id = $row->bloodbank_id;
$query1 = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id = '$bank_id'");
 foreach ($query1->result() as $bloodbank)
{
//$city_id = $bloodbank->city_id;
  // print_r($city_id);
// die();
   } 
// $query2 = $this->db->query("SELECT * FROM bl_cities WHERE id = '$city_id'");
//  foreach ($query2->result() as $city)
// {   

//    } 

               
                $no++;
                //print_r($row);
         ?>
<table>
  <tr>
 
    <th>S No.</th>
    <th>Blood Bank</th>
    <th>Name & address</th>
    <th>Donor Type and blood bag detail</th>
    <th>Age and sex and medical examination</th>
    <th style="text-align:center;">Replacement detail <hr class="replacement-hr" style="margin-top:0;margin-bottom:0;border-top:1px solid black;"> patient name, hospital and request no</th>
    <!-- <th>Replacement Details <th>patient name, hospital and request no</th> </th> -->
    <!-- a -->
    <th style="padding:0px 12px">qc</th>
    <!-- a -->
    <th>test result</th>
  
  
  </tr>
<tr >
  <td><?=$no ?></td>
  <td><?php echo($bloodbank->name) ?></td>
    <td rowspan="5">
     <table>  
        <tr>
            <td  id="tab" style="border-top: none;border-right: none; border-left:none;"><?=$row->donor_name ?></td>
        </tr>
        <tr>
            <td id="tab" style="border-right: none; border-left:none; border-bottom:none !important;"><?=$row->address ?></td>
        </tr>
        <tr>
            <td id="tab" style="border-right: none; border-left:none; border-bottom:none;" ><?=$row->city ?></td>
        </tr>
       
     </table>
    </td>
    <td rowspan="5">
      <table>
         <tr>
          <td  id="tab" style="border-top: none; border-left:none; border-right:none;">Donor Type-</td>

          <td  id="tab" style="border-top: none;border-right: none; border-left:none;"><?=$row->donor_type ?></td>
         </tr>
         <tr>
             <td id="tab" style=" border-left:none;border-right:none">tube no-</td>
             <td id="tab" style="border-right: none; border-left:none;"><?=$row->tube ?></td>

         </tr>
         <tr>
             <td id="tab"style=" border-left:none; border-bottom:none;border-right:none" >Bag type-</td>
             <td id="tab"style="border-right: none; border-left:none; border-bottom:none;" ><?=$row->bag ?></td>

         </tr>
        
      </table>
     </td>

    <td rowspan="5">
      <table>

         <tr>
             <td id="tab" style="    border-left: none;
    border-top: none;border-right:none;
    ">Age-</td>
             <td id="tab" style="    border-left: none;
             border-top: none;
             border-right: none;"><?=$row->age ?></td>
             
             <td id="tab" style="    border-left: none;
             border-top: none;border-right:none;
             
             ">sex -</td>

             <td id="tab" style="border-left: none;
             border-top: none;
             border-right: none;"><?=$row->sex ?> </td>

         </tr>
         <tr>
             <td id="tab" style="border-left: none;border-right:none;
            ">Hb-</td>
             <td id="tab" style="border-right: none;
    border-left: none;"><?=$row->hbsag ?></td>

<td id="tab" style="border-top:none;border-right:none;border-left:none;">Bp&nbsp&nbsp-&nbsp

<td id="tab" style="border-left: none;
             border-top: none;
             border-right: none;"> <?=$row->bp ?> </td>
            
            <!-- <?=$row->bp ?> -->
           </td> 
           <td id="tab" style="border-top:none;border-right:none;border-left:none;">

           </td>
  
         </tr>

         <tr>
          <td id="tab" style="border-left: none;border-right:none;border-top:none;border-bottom:none;
         ">Hcv-</td>
           <td id="tab" style="border-right: none;border-top:none;border-right:none;border-bottom:none;
    border-left: none;"><?=$row->hcv ?></td>

           <!-- <td rowspan="2" id="tab" style="border-top:none;border-right:none;border-left:none;border-bottom:none;">Bp-&nbsp
            
            <?=$row->bp ?>
           </td> -->
           
       </tr>
       
      <!--  <tr>
        <td id="tab" style="border-left: none;
        border-right: none;border-bottom: none;">plt</td>
        <td id="tab" style="border-right: none;
    border-left: none; border-bottom: none;">1.355</td>

       </tr> -->
      </table>  
      
 </td>
  
   <td rowspan="5">
      <table>
         <tr>

          <td  id="tab" style="border-top: none; border-left:none; border-right:none;">Patient Name-</td>

          <td  id="tab" style="border-top: none;border-right: none; border-left:none;"><?=$row->patient_name ?></td>
         </tr>
         <tr>
             <td id="tab" style=" border-left:none;border-right:none">Hospital-</td>
             <td id="tab" style="border-right: none; border-left:none;"><?=$row->hospital ?></td>

         </tr>
         <tr>
             <td id="tab"style=" border-left:none; border-bottom:none;border-right:none" >Request No-</td>
             <td id="tab"style="border-right: none; border-left:none; border-bottom:none;" ><?=$row->patient_requestno ?></td>

         </tr>
        
      </table>
     </td>
     <td rowspan="5">
       <table>
       <tr>
<?php 
$bl_unit = $row->unit_no ; 
$query2 = $this->db->query("SELECT bl_blood_record.* , bl_qc_component.* FROM bl_blood_record INNER JOIN bl_qc_component ON bl_qc_component.unit_no = bl_blood_record.unit_no  WHERE bl_blood_record.unit_no = '$bl_unit'");
 foreach ($query2->result() as $qc)
{ ?>
    <!-- <?php print_r($qc);die(); ?> -->
<tr>
        <?php if (!empty($qc->anti)){ ?>
          
         <td id="tab" style="border-top: none;
         border-left: none;
         border-right: none;">
         Anticoagulants- <?=$qc->anti ?></td>
       <?php } ?>
       <?php if (!empty($qc->pcv)){ ?>
         <td id="tab" style="border-right: none;border-top: none;">
           PCV- <?=$qc->pcv ?></td>
         <?php } ?>
       <?php if (!empty($qc->sterllty)){ ?>
         <td id="tab" style="border-top: none;
         border-left: none;
         border-right: none;">
         Sterllty- <?=$qc->sterllty ?></td>
           <?php } ?>
       <?php if (!empty($qc->platelet)){ ?>
         <td id="tab" style="border-right: none;border-top: none;">
           Platelets- <?=$qc->platelet ?></td>
  <?php } ?>
       <?php if (!empty($qc->ptt)){ ?>
            <td id="tab" style="border-top: none;
         border-left: none;
         border-right: none;">
         PTT- <?=$qc->ptt ?></td>
           <?php } ?>
       <?php if (!empty($qc->frbrinogen)){ ?>
         <td id="tab" style="border-right: none;border-top: none;">
           Fibrinogen- <?=$qc->frbrinogen ?></td>
             <?php } ?>
       <?php if (!empty($qc->factor)){ ?>
            <td id="tab" style="border-right: none;border-top: none;">
           Factor Vlll- <?=$qc->factor ?></td>
         <?php } ?>
        </tr>
       <?php } ?>
       <!-- a -->
     </tr>
<?php } ?>
  <!-- a -->
   </tr>
         
    </table>
     </td>
  <!-- aa -->
  <td >
    <table>
       <tr>
           <td id="tab" style="border-top: none;
           border-left: none;
           border-right: none;">
         Hiv</td>
         <td id="tab" style="border-right: none;border-top: none;">
         <?=$row->hiv ?></td>
         <!--  <td id="tab" style="border-top: none;">
            NAt</td> -->
       </tr>
       <tr>
          <td id="tab" style="border-right: none;
          border-left: none;">HBeAg </td>
          <td id="tab">
            <?=$row->hbsag ?></td>
       </tr>
       <tr>
        <td id="tab" style="border-right: none;
        border-left: none;">HcV </td>
        <td id="tab">
          <?=$row->hcv ?></td>
     </tr>
     <tr>
      <td id="tab" style="border-right: none;
      border-left: none;">Vdrl </td>
      <td id="tab">
       <?=$row->vdrl ?></td>
   </tr>
   <tr>
    <td id="tab" style="border-right: none;
    border-left: none; border-bottom:none;">Malaria </td>
    <td id="tab" style="border-bottom:none ;">
      <?=$row->malaria ?></td>
 </tr>
         
    </table>
   </td>

   </tr>


  
</table>
<table style="margin-top: 1px;
width: 50%;
float: right;
">
  <tr>
    <th>Component</th>
    <th>volume</th>
    <th>expiry Date</th>
    <th>final issues no</th>
    <th>discard no </th>
    <th>return no</th>
    <th>return date</th>
    <th>return time</th>
  </tr>
  <tr>
    <td><?=$row->component ?></td>
    <td><?=$row->final_vol ?></td>
    <td><?=$row->expiry_date ?></td>
    <td>.</td>
    <td><?=$row->discard_no ?></td>
    
    <td>.</td>
    <td>.</td>
    <td>.</td>
  </tr>
  <tr>
   
  </tr>
  <tr>
    
  </tr>
  <tr>
    
  </tr>
  <tr>

  </tr>

</table>
<?php 
//}
?>
</div>