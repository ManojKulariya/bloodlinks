<?php 

  if(!empty($_POST['item_name'])){

      // print_r($_POST); die;
$items_name = $_POST['items_name'];
$price = $_POST['price'];
$vender = $_POST['vender'];
$quantity = $_POST['quantity'];
$description = $_POST['description'];

$insert = $this->db->query("INSERT INTO bl_consumables_items (items_name, price, vender, quantity, description ) VALUES ('$items_name','$price', '$vender', '$quantity', '$description')");
// echo $this->db->insert_id();die;
  if($insert==true){
    // echo 'hiii';
    // die();
    
    redirect('donations/consumables_items');

  } else{
  echo "fail";
  }
 }
  ?>
	<div class="timeline">
  <!-- 			<div class="time-label">
                <span class="bg-red">Consumables Items</span>
              </div> -->
              <div class="card">
              	<div class="card-header">
              		<!-- <h3 class="card-title">Register Blood Bank</h3> -->
              		<div class="btn-group" style="float: right;">
              			<!-- <button type="submit" class="btn btn-sm btn-outline-danger btn_save_category" id="btn_save_category"><i class="fas fa-save fw"></i></button> -->
              			<a href="<?php echo $base_url;?>/donations/consumables_items" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
              		</div>
              	</div>
              	<div class="card-body">
                   <form action = "<?php $_PHP_SELF ?>" method = "POST">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              		<div class="row">

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="items_name">Item Name</label>
              					<input type="text" class="form-control" name="items_name" id="items_name" placeholder="Enter Iteam Name">
              				</div>
              			</div>
              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="price">Price</label>
              					<input type="text" class="form-control" id="price" name="price"placeholder="Enter Price">

              				</div>
              			</div>


              		</div>

              		<div class="row">
              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="vender" >Vender</label>
              					<select name="vender" id="vender" class="form-control">
              						<option value="Vender1">vender1</option>
              						<option value="Vender2">Vender2</option>
              						<option value="Vender3">Vender3</option>
              						<option value="Vender4">Vender4</option>
              					</select>
              				</div>
              			</div>

              			<div class="col-md-6">
              				<div class="form-group">
              					<label for="quantity">Quantity</label>
              					<input type="text" class="form-control" name="quantity" id="quantity" placeholder="Enter Quantity">
              				</div>
              			</div>

              		</div>
              		<div class="row">
              			<div class="col-md-12">
              				<div class="form-group">
              					<label for="description">Description</label>
              					<textarea class="form-control" name="description"placeholder="Enter Item Description" id="description"  rows="3"></textarea>
              				</div>
              			</div>

              			<div class="col-md-12">
              				<div class="btn-group" style="float: right;">
              					<button type="submit" name="submit" class="btn btn-sm btn-danger" id="btn_save_basic_details"><i class="fas fa-save fw"></i> Save</button>
              				</div>
              			</div>
                    </form>
              		</div>
              	</div>
              </div>