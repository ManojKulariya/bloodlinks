<style>
	.form-control{
height: calc(1.70rem + 2px) !important;
	}
	.card-footer{
		background-color:white !important;
	}
</style>
<?php 

if(!empty($_POST['item_name'])){

	// print_r($_POST); die;
	$item_name = $_POST['item_name'];
	$manufacture_name = $_POST['manufacture_name'];
	$supply_date = $_POST['supply_date'];
	$batch_no = $_POST['batch_no'];
	$hits_reagents = $_POST['hits_reagents'];
	$date_use = $_POST['date_use'];
	$manufacture_date = $_POST['manufacture_date'];
	$expiry = $_POST['expiry'];
	$consumable_type = $_POST['consumable_type'];
	$lot_no = $_POST['lot_no'];
	$Bloodbag_type = $_POST['Bloodbag_type'];
	$receive_condition = $_POST['receive_condition'];
	$qty_purchase = $_POST['qty_purchase'];
	$qty_issued = $_POST['qty_issued'];
	$qty_hand = $_POST['qty_hand'];
	$qty_receive = $_POST['qty_receive'];
	$qty_total = $_POST['qty_total'];
	$balance = $_POST['balance'];
	$result_testing = $_POST['result_testing'];
	$received_by = $_POST['received_by'];

	$update = $this->db->query("UPDATE bl_consumable SET item_name = '$item_name', manufacture_name = '$manufacture_name' ,supply_date = '$supply_date',batch_no = '$batch_no',hits_reagents = '$hits_reagents',date_use = '$date_use',manufacture_date = '$manufacture_date',expiry = '$expiry',consumable_type = '$consumable_type',lot_no = '$lot_no',Bloodbag_type = '$Bloodbag_type',receive_condition = '$receive_condition',qty_purchase = '$qty_purchase',qty_issued = '$qty_issued',qty_hand = '$qty_hand',qty_receive = '$qty_receive' ,qty_total = '$qty_total' ,balance = '$balance' ,result_testing = '$result_testing' ,received_by = '$received_by'WHERE id = '$id'");
// echo $this->db->insert_id();die;
	if($update==true){
    // echo 'hiii';
    // die();
		redirect('admin/donations/consumable');

	} else{
		echo "fail";
	}
}
?>
<?php 
$id= $this->uri->segment(5);
$query1 = $this->db->query("SELECT * FROM bl_consumable WHERE id = $id");
foreach ($query1->result() as $row)
{}
 ?>
<div class="container">
	<form action = "<?php $_PHP_SELF ?>" method = "POST">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
<input type="hidden" name="id" value="<?php if(isset($row->id)) { echo $row->id;  } ?>" id="masters_id">
		<div class="timeline">
  			<!-- <div class="time-label">
                <span class="bg-red">Consumables Items</span>
              </div> -->
              <div class="card pr-2 pl-2">
              	<div class="card-header">
              		<!-- <h3 class="card-title">Register Blood Bank</h3> -->
              		<div class="btn-group" style="float: right;">
              			<a href="<?php echo $base_url;?>/donations/consumable" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
              		</div>
              	</div>
              	<div class="card-body">
              		<div class="row">

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="vender" >Item Name</label>
              					<select style="padding:0px !important;" name="item_name" id="vender" class="form-control">
              						<option value="<?= $row->item_name; ?>"><?= $row->item_name; ?></option>
              						<?php 
            $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'consumables_item'");
           foreach ($query1->result() as $item)
           {
              ?>
          <option value="<?= $item->master_type_key_value; ?>"><?= $item->master_type_key_value; ?></option>
            <?php } ?>
              						
              					</select>
              				</div>
              			</div>

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="vender" >Manufacturing Name</label>
              					<select style="padding:0px !important;" name="manufacture_name" id="vender" class="form-control">
              						<option value="<?= $row->manufacture_name; ?>"><?= $row->manufacture_name; ?></option>
              						  						<?php 
            $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'manufacture'");
           foreach ($query1->result() as $manufacture)
           {
              ?>
          <option value="<?= $manufacture->master_type_key_value; ?>"><?= $manufacture->master_type_key_value; ?></option>
            <?php } ?>
              					</select>
              				</div>
              			</div>

              		</div>

              		<div class="row">

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="description">Date of Supply</label>
              					<input type="date" class="form-control"  value="<?php if(isset($row->supply_date)) { echo $row->supply_date;  } ?>" id="price" name="supply_date">
              				</div>
              			</div>

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="price">Batch No.</label>
              					<input type="text" value="<?php if(isset($row->batch_no)) { echo $row->batch_no;  } ?>" class="form-control" id="price" name="batch_no">

              				</div>
              			</div>
              		</div>
              		<div class="row">

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="description">Name of hits & reagents</label>
              					<input type="text" value="<?php if(isset($row->hits_reagents)) { echo $row->hits_reagents;  } ?>" class="form-control" id="price" name="hits_reagents">
              				</div>
              			</div>

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="price">Date of Use</label>
              					<input type="date" value="<?php if(isset($row->date_use)) { echo $row->date_use;  } ?>" class="form-control" id="price" name="date_use">

              				</div>
              			</div>


              		</div><div class="row">

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="description">Manufacturing Date</label>
              					<input type="date" value="<?php if(isset($row->manufacture_date)) { echo $row->manufacture_date;  } ?>" class="form-control" id="price" name="manufacture_date">
              				</div>
              			</div>

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="price">Expiry Date</label>
              					<input type="date" value="<?php if(isset($row->expiry)) { echo $row->expiry;  } ?>" class="form-control" id="price" name="expiry">

              				</div>
              			</div>


              		</div>
              		<div class="row">

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="vender" >Consumables Types</label>
              					<select style="padding:0px !important;" name="consumable_type" id="vender" class="form-control">
              						<option value="<?= $row->consumable_type; ?>"><?= $row->consumable_type; ?></option>
              									<?php 
            $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'consumables_type'");
           foreach ($query1->result() as $type)
           {
              ?>
          <option value="<?= $type->master_type_key_value; ?>"><?= $type->master_type_key_value; ?></option>
            <?php } ?>
              					</select>
              				</div>
              			</div>

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="description">Lot No.</label>
              					<input type="text" value="<?php if(isset($row->lot_no)) { echo $row->lot_no;  } ?>" class="form-control" id="price" name="lot_no">
              				</div>
              			</div>


              		</div>
              		<div class="row">

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="vender" >Blood Bag Types</label>
              					<select style="padding:0px !important;" name="Bloodbag_type" id="vender" class="form-control">
              						<option value="<?= $row->Bloodbag_type; ?>"><?= $row->Bloodbag_type; ?></option>
              						<?php 
            $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'bag_types'");
           foreach ($query1->result() as $bag)
           {
              ?>
          <option value="<?= $bag->master_type_key_value; ?>"><?= $bag->master_type_key_value; ?></option>
            <?php } ?>
              					</select>
              				</div>
              			</div>

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="vender" >Receive Condition</label>
              					<select style="padding:0px !important;" name="receive_condition" id="vender" class="form-control">
              						<option value="<?= $row->receive_condition; ?>"><?= $row->receive_condition; ?></option>
              							<?php 
            $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'consumable_receive_condition'");
           foreach ($query1->result() as $recieve)
           {
              ?>
          <option value="<?= $recieve->master_type_key_value; ?>"><?= $recieve->master_type_key_value; ?></option>
            <?php } ?>
              					</select>
              				</div>
              			</div>


              		</div>
              		<div class="row">

              			<div class="col-md-6">
              				<label for="price">Quantity Purchase</label>
              				<input type="text" value="<?php if(isset($row->qty_purchase)) { echo $row->qty_purchase;  } ?>" class="form-control" id="price" name="qty_purchase">

              			</div>


              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="price">Quantity Issued</label>
              					<input type="text" value="<?php if(isset($row->qty_issued)) { echo $row->qty_issued;  } ?>" class="form-control" id="price" name="qty_issued">

              				</div>
              			</div>


              		</div>
              		<div class="row">

              			<div class="col-md-6">
              				<label for="price">Quantity in Hand</label>
              				<input type="text" value="<?php if(isset($row->qty_hand)) { echo $row->qty_hand;  } ?>" class="form-control" id="price" name="qty_hand">

              			</div>


              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="price">Quantity Received</label>
              					<input type="text" value="<?php if(isset($row->qty_receive)) { echo $row->qty_receive;  } ?>" class="form-control" id="price" name="qty_receive">

              				</div>
              			</div>


              		</div>

              		<div class="row">

              			<div class="col-md-6">
              				<label for="price">Total Quantity</label>
              				<input type="text" value="<?php if(isset($row->qty_total)) { echo $row->qty_total;  } ?>" class="form-control" id="price" name="qty_total">

              			</div>


              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="price">Balance</label>
              					<input type="text" value="<?php if(isset($row->balance)) { echo $row->balance;  } ?>" class="form-control" id="price" name="balance">

              				</div>
              			</div>


              		</div>
              		<div class="row">

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="price">Result of Testing</label>
              					<input type="text" value="<?php if(isset($row->result_testing)) { echo $row->result_testing;  } ?>" class="form-control" id="price" name="result_testing">

              				</div>
              			</div>

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="price">Received by</label>
              					<input type="text" value="<?php if(isset($row->received_by)) { echo $row->received_by;  } ?>" class="form-control" id="price" name="received_by">

              				</div>
              			</div>


              		</div>
              		


              		<div class="card-footer">
              			<div class="btn-group" style="float: right;">
              				<button type="submit" name="submit" class="btn btn-sm btn-danger" ><i class="fas fa-save fw"></i> Update </button>
              			</div>
              		</div>
              	</div>
              </div>
            </form>
          </div>