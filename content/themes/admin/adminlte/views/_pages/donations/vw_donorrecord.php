<style type="text/css">
.btn-primary {
    background-color: #ad1e1d !important;
    border-color: #ad1e1d !important;
    height: 32px;
    padding: 0 10px;
}
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<?php 
$bank_id = $_SESSION['bank_id'];
$query3 = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id = '$bank_id'");
 foreach ($query3->result() as $bloodbank)
{

 // print_r($bloodbank);
// die();
   } 


 ?>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 12px;
}


td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  /* background-color: #dddddd; */
}
#tab{
  border: none;
}
        @media print {
  #printPageButton {
    display: none;
  }
}
.form-control {
  height: 1.5rem;
    padding: 0;
    margin-top: 5px;
}
.content-wrapper {
    background: #fff;
    text-transform: capitalize;
}
.btn-primary{
  height: 1.5rem;
    padding: 0 10px;
    padding: 0 13px;
    /* text-align: center; */
    margin-top: 4px;
    font-size: 13px;
}
</style>

<div class="container-fluid" id="printPageButton" style="border: 1px solid black;">
<br>
<!--         <div class="col-12">
          <div class="col-sm-12 p-1" style="border: 1px solid #adadad">
            <h4 class="text-danger">Patient Information</h4> -->

            <!-- part1 -->
          <form action = "<?php $_PHP_SELF ?>" method = "POST">
            <div class="row">
           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="col-sm-5">
                <div class="row mb-1">
                  <label for="inputEmail3" class="col-sm-4 col-form-label"
                    >Beginning Date</label
                  >
                  <div class="col-sm-8">
                    <input type="date" name="f_date" class="form-control" id="inputEmail3" value="<?php if(isset($_POST) && isset($_POST['f_date'])){ echo $_POST['f_date']; } ?>"/>
                  </div>
                </div>
              </div>
              <div class="col-sm-5">
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-4 col-form-label"
                    >Last Date</label
                  >
                  <div class="col-sm-8">
                    <input type="date" name="l_date" class="form-control" id="inputEmail3" value="<?php if(isset($_POST) && isset($_POST['l_date'])){ echo $_POST['l_date']; } ?>" />
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
               <button type="submit" class="btn btn-primary">Search</button>
              </div>
            </div>
            </form>
                <form action = "<?php $_PHP_SELF ?>" method = "POST">
            <div class="row">
           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="col-sm-5">
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-4 col-form-label"
                    >Beginning Id</label
                  >
                  <div class="col-sm-8">
                    <input type="text" name="f_id" value="<?php if(isset($_POST) && isset($_POST['f_id'])){ echo $_POST['f_id']; } ?>" class="form-control" id="inputEmail3" />
                  </div>
                </div>
              </div>
              <div class="col-sm-5">
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-4 col-form-label"
                    >Last Id</label
                  >
                  <div class="col-sm-8">
                    <input type="text" name="l_id" value="<?php if(isset($_POST) && isset($_POST['l_id'])){ echo $_POST['l_id']; } ?>" class="form-control" id="inputEmail3" />
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
               <button type="submit" class="btn btn-primary">Search</button>
              </div>
            </div>
            </form>
                <form action = "<?php $_PHP_SELF ?>" method = "POST">
            <div class="row">
           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="col-sm-10">
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label"
                    >Name</label
                  >
                  <div class="col-sm-10">
                    <input type="text" name="name" value="<?php if(isset($_POST) && isset($_POST['name'])){ echo $_POST['name']; } ?>" class="form-control" id="inputEmail3" />
                  </div>
                </div>
              </div>
             
              <div class="col-sm-2">
               <button type="submit" class="btn btn-primary">Search</button>
              </div>
            </div>
            </form>   
            </div>
           
<button id="printPageButton" onClick="window.print();" style="background-color: #ad1e1d;color: white;border-radius: 5px;border-color: white;padding: 5px 10px;">Print</button>                        <button class="btn btn-sm btn-warning mx-2 text-white" id="reset" name="reset"/>         Reset</button>              
<br>
<h4>Blood Bank</h4>
<h4><?php echo($bloodbank->name) ?></h4>

<table>
  <tr>
    <th>s.no unit no</th>
    <th>Registration no</th>
    <th>Collection Date</th>
    <th >Name & addres</th>
    <th >Contact number age and Sex</th>
    <th>Type of bag and value</th>
    <th>Abo & is  group ing</th>
    <th>Medicla examination</th>
    <th>paitent deliverd</th>
  </tr>
  <?php 
  $no=0;
   if(!empty($_POST['f_date'])){

        // print_r($_POST); die;
     $f_date = $_POST['f_date'];
     $l_date = $_POST['l_date']; 
      $query = $this->db->query("SELECT * FROM bl_bb_donatioform WHERE bloodbank_id = '$bank_id' And created_at between '$f_date' AND '$l_date'");
     }elseif(!empty($_POST['f_id'])){

         // print_r($_POST); die;
     $f_id = $_POST['f_id'];
     $l_id = $_POST['l_id']; 
      $query = $this->db->query("SELECT * FROM bl_bb_donatioform WHERE bloodbank_id = '$bank_id' And id between '$f_id' AND '$l_id'");
     }elseif(!empty($_POST['name'])){

        // print_r($_POST); die;
     $name = $_POST['name']; 
      $query = $this->db->query("SELECT * FROM bl_bb_donatioform WHERE bloodbank_id = '$bank_id' And donor_name LIKE '%$name%'");
     }else{
       $query = $this->db->query("SELECT * FROM bl_bb_donatioform WHERE bloodbank_id = '$bank_id'");
     }
 foreach ($query->result() as $row)
{
$no++;
   ?>
<tr >
 
    <td><?=$no ?> <br><?=$row->unit_no ?></td>
    <td><?=$row->registration ?> </td>
    <td><?=$row->donation_date ?> </td>
    <td>Name : <?=$row->donor_name ?> <br>Address: <?=$row->address ?> <br>City: <?=$row->city ?></td>
    <td>contact : <?=$row->mobile ?> <br>Age: <?=$row->age ?> <br>Sex: <?=$row->sex ?></td>
    <td>Type of Bag : Mother <br>Value: <?=$row->bag ?></td>
    <!-- <td rowspan="3">
     <table>
        <tr>
            <td  id="tab">Mr Dayal singh Nathawat</td>
        </tr>
        <tr>
            <td id="tab">burtal amber <br> <p>jaipur</p></td>
        </tr>
        <tr>
            <td id="tab">jaipur</td>
        </tr>
       
     </table>
    </td>
    <td id="tab">contact number
        <br>
            000000000000
         <table>
            <tr>
                <th colspan="2" id="tab"></th>
            </tr>
            <tr>
                <td id="tab">age</td>
                <td id="tab">59</td>
            </tr>
            <tr>
                <td id="tab">sex</td>
                <td id="tab">Male</td>
            </tr>
         </table>  
    </td> 
  <td>ts</td>-->
  <td><?=$row->blood_group ?></td>
  <td> Hemoglobin : <?=$row->hemoglobin ?> <br> Pulse: <?=$row->bp ?> <br> Weight : <?=$row->weight ?>kg</td>
  <td>Registration no: <?=$row->registration_no ?> <br>paitent Name: <?=$row->patient_name ?> <br> Hospital name: <?=$row->hospital ?> <br> reg no: <?=$row->patient_requestno ?></td>

  <!-- <td rowspan="3">
    <table>
       <tr>
           <td id="tab">
            Hb : <?=$row->hbsag ?></td>
       </tr>

       <tr>
         <th id="tab">pulse</th>
        <th id="tab"><?=$row->bp ?></th>
       </tr>
       <tr> <th colspan="2" id="tab"></th>
       </tr>
       <tr>
        <th id="tab">weight</th>
        <th id="tab"><?=$row->weight ?>kg</th>

       </tr>
         
    </table>
   </td>
   <td rowspan="4">
    <table>
       <tr>
           <td id="tab">Registration no: <?=$row->registration_no ?></td>
       </tr>
       <tr>
           <td id="tab">paitent Name: <?=$row->patient_name ?></td>
       </tr>
       <tr>
           <td id="tab">Hospital name: <?=$row->hospital ?></td>
       </tr>
       <tr>
       <td id="tab">reg no: <?=$row->patient_requestno ?></td>
       </tr>
      
    </table>
   </td> -->
   </tr>
<?php } ?>
</table><script src="http://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script><script>   $("#reset").click(function(){$("input").val("");window.location.href = window.location.href;});</script>