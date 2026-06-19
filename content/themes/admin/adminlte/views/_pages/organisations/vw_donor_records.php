<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
.btn-primary {
    background-color: #ad1e1d !important;
    border-color: #ad1e1d !important;
    height: 30px;
    padding: 0 10px;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 12px;
}
.content-wrapper {
    background: #fff;
        text-transform: capitalize;
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
label:not(.form-check-label):not(.custom-file-label) {
    font-weight: 700;
    font-size: 12px;
}
.form-control {
    height: 30px;
    font-size: 14px;
}

.capitalize{
  text-transform: capitalize;
}
</style>

<div class="container-fluid"  style="border: 1px solid black;">
<br>

          <form action = "<?php $_PHP_SELF ?>" method = "POST">
            <div class="row">
           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="col-sm-4">
                <div class="row mb-1">
                  <label for="inputEmail3" class="col-sm-4 col-form-label"
                    >Beginning Date</label
                  >
                  <div class="col-sm-8">
                    <input type="date" name="f_date" class="form-control" id="inputEmail3" />
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-4 col-form-label"
                    >Last Date</label
                  >
                  <div class="col-sm-8">
                    <input type="date" name="l_date" class="form-control" id="inputEmail3" />
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
               <button type="submit" class="btn btn-primary">Search</button>
              </div>
            </div>
            </form>
                <form action = "<?php $_PHP_SELF ?>" method = "POST">
            <div class="row">
           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="col-sm-4">
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-4 col-form-label"
                    >Beginning Id</label
                  >
                  <div class="col-sm-8">
                    <input type="text" name="f_id" class="form-control" id="inputEmail3" />
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-4 col-form-label"
                    >Last Id</label
                  >
                  <div class="col-sm-8">
                    <input type="text" name="l_id" class="form-control" id="inputEmail3" />
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
               <button type="submit" class="btn btn-primary">Search</button>
              </div>
            </div>
            </form>
                <form action = "<?php $_PHP_SELF ?>" method = "POST">
            <div class="row">
           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="col-sm-8">
                <div class="row mb-2">
                  <label for="inputEmail3" class="col-sm-2 col-form-label"
                    >Name</label
                  >
                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="inputEmail3" />
                  </div>
                </div>
              </div>
             
              <div class="col-sm-4">
               <button type="submit" class="btn btn-primary">Search</button>
              </div>
            </div>
            </form>   
            </div>
           
<button id="printPageButton" onClick="window.print();" style="background-color: #ad1e1d;color: white;border-radius: 5px;border-color: white;padding: 5px 10px;">Print</button>
<br>
<h4>Super Admin</h4>
<!-- <h4><?php echo($bloodbank->name) ?></h4> -->

<table>
  <tr>
    <th>s.no unit no</th>
    <th>Segment no</th>
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
      $query = $this->db->query("SELECT * FROM bl_bb_donatioform WHERE created_at between '$f_date' AND '$l_date'");
     }elseif(!empty($_POST['f_id'])){

         // print_r($_POST); die;
     $f_id = $_POST['f_id'];
     $l_id = $_POST['l_id']; 
      $query = $this->db->query("SELECT * FROM bl_bb_donatioform WHERE id between '$f_id' AND '$l_id'");
     }elseif(!empty($_POST['name'])){

        // print_r($_POST); die;
     $name = $_POST['name']; 
      $query = $this->db->query("SELECT * FROM bl_bb_donatioform WHERE donor_name = '$name'");
     }else{
       $query = $this->db->query("SELECT * FROM bl_bb_donatioform");
     }
 foreach ($query->result() as $row)
{
    $bank_id = $row->bloodbank_id;
$query3 = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id = '$bank_id'");
 foreach ($query3->result() as $bloodbank)
{

 // print_r($bloodbank);
// die();
   } 
$no++;
   ?>
<tr >
 
    <td class="capitalize"><?=$no ?> <br><?=$row->unit_no ?></td>
    <td class="capitalize"><?=$row->registration ?> </td>
    <td class="capitalize"><?=$row->date ?> </td>
    <td class="capitalize">Name : <?=$row->donor_name ?> <br>Address: <?=$row->address ?> <br>City: <?=$row->city ?></td>
    <td class="capitalize">contact : <?=$row->mobile ?> <br>Age: <?=$row->age ?> <br>Sex: <?=$row->sex ?></td>
    <td class="capitalize">Type of Bag : Mother <br>Value: <?=$row->bag ?></td>
   
  <td class="capitalize"><?=$row->blood_group ?></td>
  <td class="capitalize"> Hb : <?=$row->hbsag ?> <br> Pulse: <?=$row->bp ?> <br> Weight : <?=$row->weight ?>kg</td>
  <td class="capitalize">Registration no: <?=$row->registration_no ?> <br>paitent Name: <?=$row->patient_name ?> <br> Hospital name: <?=$row->hospital ?> <br> reg no: <?=$row->patient_requestno ?></td>

   </tr>
<?php } ?>
</table>