<style>
   .form-control {
      height: calc(1.70rem + 2px) !important;
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
$id = $this->uri->segment(4);
// $bank_id = $_SESSION['bank_id'];
if (!empty($_POST['name_reagent'])) {
   // print_r($_POST); die;

   $date = $_POST['date'];
   $name_reagent = $_POST['name_reagent'];
   $lot_no = $_POST['lot_no'];
   $manufactures_date = $_POST['manufactures_date'];
   $expiry_date = $_POST['expiry_date'];
   $Physical = $_POST['Physical'];
   $color_appearance = $_POST['color_appearance'];
   $suspension_b_cell = $_POST['suspension_b_cell'];
   $suspension_Rh_pos_cell = $_POST['suspension_Rh_pos_cell'];
   $suspension_Rh_neg_cell = $_POST['suspension_Rh_neg_cell'];
   $suspension_cell = $_POST['suspension_cell'];
   $total_protein = $_POST['total_protein'];
   $total_albumin = $_POST['total_albumin'];
   $Quality = $_POST['Quality'];
   $bbo = $_POST['bbo'];
   $remark = $_POST['remark'];

   $update = $this->db->query("UPDATE bl_qc_reagents SET suspension_Rh_pos_cell='$suspension_Rh_pos_cell',suspension_Rh_neg_cell='$suspension_Rh_neg_cell',suspension_b_cell='$suspension_b_cell',date = '$date', name_reagent = '$name_reagent' ,lot_no = '$lot_no', manufactures_date = '$manufactures_date', expiry_date = '$expiry_date', Physical = '$Physical', color_appearance = '$color_appearance', suspension_cell = '$suspension_cell', total_protein = '$total_protein', total_albumin = '$total_albumin', Quality = '$Quality', bbo = '$bbo', remark = '$remark' WHERE id = '$id'");
   //echo $this->db->insert_id();die;
   if ($update == true) {
      // echo 'hiii';
      // die();
      redirect('admin/all_qc_reagents');
   } else {
      echo "fail";
   }
}
?>
<?php

$query1 = $this->db->query("SELECT * FROM bl_qc_reagents WHERE id = $id");
foreach ($query1->result() as $row) {
}
?>
<div class="container">
   <form action="<?php $_PHP_SELF ?>" method="POST">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      <input type="hidden" name="id" value="<?php if (isset($row->id)) {
                                                echo $row->id;
                                             } ?>" id="masters_id">
      <div class="timeline">
         <!-- <div class="time-label">
                <span class="bg-red">Consumables Items</span>
              </div> -->

         <div class="card pl-2 pr-2">
            <div class="card-header">
               <!-- <h3 class="card-title">Register Blood Bank</h3> -->
               <div class="btn-group" style="float: right;">
                  <a href="<?php echo $base_url; ?>/all_qc_reagents" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
               </div>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label for="vender">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" value="<?php if (isset($row->date)) {
                                                                                                echo $row->date;
                                                                                             } ?>">
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label for="vender">Name of Reagent:</label>
                        <input type="text" class="form-control" id="price" name="name_reagent" value="<?php if (isset($row->name_reagent)) {
                                                                                                         echo $row->name_reagent;
                                                                                                      } ?>">
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label for="description">Lot No./Batch No.:</label>
                        <input type="text" class="form-control" id="price" name="lot_no" value="<?php if (isset($row->lot_no)) {
                                                                                                   echo $row->lot_no;
                                                                                                } ?>">
                     </div>
                  </div>

               </div>
               <div class="row">
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label for="price">Manufactures Date: </label>
                        <input type="date" class="form-control" id="price" name="manufactures_date" value="<?php if (isset($row->manufactures_date)) {
                                                                                                               echo $row->manufactures_date;
                                                                                                            } ?>">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="description">Expiry Date:</label>
                        <input type="date" class="form-control" id="price" name="expiry_date" value="<?php if (isset($row->expiry_date)) {
                                                                                                         echo $row->expiry_date;
                                                                                                      } ?>">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="price">Physical Appearance:</label>
                        <input type="text" class="form-control" id="price" name="Physical" value="<?php if (isset($row->Physical)) {
                                                                                                      echo $row->Physical;
                                                                                                   } ?>">
                     </div>
                  </div>

               </div>

               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="description">Colour Appearance:</label>
                        <input type="text" class="form-control" id="price" name="color_appearance" value="<?php if (isset($row->color_appearance)) {
                                                                                                               echo $row->color_appearance;
                                                                                                            } ?>">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="price">Agglutination with 50% Cell suspension of A-cell: </label>
                        <input type="text" class="form-control" id="price" name="suspension_cell" value="<?php if (isset($row->suspension_cell)) {
                                                                                                            echo $row->suspension_cell;
                                                                                                         } ?>">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="price">Agglutination with 50% Cell suspension of B-cell: </label>
                        <input type="text" class="form-control" id="price" name="suspension_b_cell" value="<?php if (isset($row->suspension_b_cell)) {
                                                                                                               echo $row->suspension_b_cell;
                                                                                                            } ?>">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="price">Agglutination with 50% Cell suspension of Rh +ive Cell: </label>
                        <input type="text" class="form-control" id="price" name="suspension_Rh_pos_cell" value="<?php if (isset($row->suspension_Rh_pos_cell)) {
                                                                                                                     echo $row->suspension_Rh_pos_cell;
                                                                                                                  } ?>">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="price">Agglutination with 50% Cell suspension of Rh -ve Cell </label>
                        <input type="text" class="form-control" id="price" name="suspension_Rh_neg_cell" value="<?php if (isset($row->suspension_Rh_neg_cell)) {
                                                                                                                     echo $row->suspension_Rh_neg_cell;
                                                                                                                  } ?>">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="vender">Clump size at 2 Mints Total Protein:</label>
                        <input type="text" class="form-control" id="price" name="total_protein" value="<?php if (isset($row->total_protein)) {
                                                                                                            echo $row->total_protein;
                                                                                                         } ?>">
                     </div>
                  </div>

               </div>

               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="description">Time of commencing Agglutination Total Albumin:</label>
                        <input type="text" class="form-control" id="price" name="total_albumin" value="<?php if (isset($row->total_albumin)) {
                                                                                                            echo $row->total_albumin;
                                                                                                         } ?>">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="vender">Quality:</label>
                        <input type="text" class="form-control" id="price" name="Quality" value="<?php if (isset($row->Quality)) {
                                                                                                      echo $row->Quality;
                                                                                                   } ?>">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="vender">BBO:</label>
                        <input type="text" class="form-control" id="price" name="bbo" value="<?php if (isset($row->bbo)) {
                                                                                                echo $row->bbo;
                                                                                             } ?>">
                     </div>
                  </div>

               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="price">Remark:</label>
                     <input type="text" class="form-control" id="price" name="remark" value="<?php if (isset($row->remark)) {
                                                                                                echo $row->remark;
                                                                                             } ?>">
                  </div>
                  <div class="col-md-8">
                     <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                           <button type="submit" name="submit" class="btn btn-sm btn-danger"><i class="fas fa-save fw"></i> Save</button>
                        </div>
                     </div>
                  </div>
               </div>


            </div>
         </div>
   </form>
</div>