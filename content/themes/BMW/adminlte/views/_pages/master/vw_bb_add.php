<style>
	label:not(.form-check-label):not(.custom-file-label) {
		margin-bottom: 0;
		font-size: 0.7rem;
		font-weight: 799;
	}

	.form-control {
		height: 1.5rem !important;
		padding: 0 !important;
	}
</style>
<?php
$row_count = 0;
$bank_id = $_SESSION['bank_id'];
if (!empty($_POST['search_unit'])) {
	$search_unit = $_POST['search_unit'];
	$bankID = $_SESSION['bank_id'];
	$query = $this->db->query("SELECT * FROM bl_bb_donatioform 
	WHERE bloodbank_id=$bank_id AND  unit_no = '$search_unit'");
	$row_count = $query->num_rows();		
	$res = $query->row();
}
if (!empty($_POST['anti_a'])) {
	$bloodbank_id = $_POST['bloodbank_id'];
	$date = $_POST['date'];
	$unit_no = $_POST['unit_no'];
	$donor_id = $_POST['donor_id'];
	$anti_a = $_POST['anti_a'];
	$anti_b = $_POST['anti_b'];
	$anti_ab = $_POST['anti_ab'];
	$anti_d = $_POST['anti_d'];
	$a_cell = $_POST['a_cell'];
	$b_cell = $_POST['b_cell'];
	$o_cell = $_POST['o_cell'];
	$with_a_cell = $_POST['with_a_cell'];
	$with_b_cell = $_POST['with_b_cell'];
	$irregular_anti_o_cells = $_POST['irregular_anti_o_cells'];
	$final_bloodgroup = $_POST['final_bloodgroup'];
	$done_by = $_POST['done_by'];
	$query1 = $this->db->query("SELECT * FROM bl_blood_group 
	WHERE bloodbank_id=$bank_id AND  unit_no = '$unit_no'");
	if($query1->num_rows() == 0){
		$insert = $this->db->query("INSERT INTO bl_blood_group 
		(bloodbank_id, date, unit_no, donor_id, anti_a,
		anti_b, anti_ab, anti_d, a_cell, b_cell,
		o_cell, with_a_cell, with_b_cell, irregular_anti_o_cells, final_bloodgroup,done_by
		) 
		VALUES 
		('$bloodbank_id','$date', '$unit_no', '$donor_id', '$anti_a',
		'$anti_b','$anti_ab', '$anti_d', '$a_cell', '$b_cell',
		'$o_cell','$with_a_cell', '$with_b_cell', '$irregular_anti_o_cells', '$final_bloodgroup','$done_by')");
		if ($insert == true) {
			$this->db->query("UPDATE bl_bb_donatioform SET blood_group = '$final_bloodgroup' WHERE id = '$donor_id'");
			$this->db->query("UPDATE bl_blood_record SET blood_group = '$final_bloodgroup' WHERE donation_id = '$donor_id'");
			
			redirect('admin/donations/blood_grouping');
		} else {
			echo "fail";
		}
	}else{
		echo "<script>
		alert('For this donor Blood Grouping already done!');
		</script>";
		// redirect('admin/donations/blood_grouping');

	}
}
?>
<div class="timeline">
	<div class="card">
		<div class="card-header">
			<div class="btn-group" style="float: right;">
				<a href="<?php echo $base_url; ?>/donations/consumables_items" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
			</div>
		</div>
		<div class="card-body">
			<form action="<?php $_PHP_SELF ?>" method="POST">
				<div class="L9">
					<div id="div1" style="text-align:center;">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<label for="inputEmail3" class="col-form-label">Unit No:</label>
						<input type="text" class="appli-new" name="search_unit" placeholder="">
						<button type="submit" class="btn btn-danger Search-new-btn" style="padding:4px 26px;">Search</button>
					</div>
				</div>
			</form>
			<?php if($row_count != 0){ ?>
			<form action="<?php $_PHP_SELF ?>" method="POST" id="bb_form">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<input type="hidden" name="bloodbank_id" value="<?= $bank_id ?>">
				<input type="hidden" name="donor_id" id="donor_id" value="<?php if(isset($res->unit_no)){ echo$res->id; } ?>">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="items_name">Date</label>
							<input type="date" class="form-control" required name="date">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="price">Unit No</label>
							<input type="text" class="form-control" required readonly id="unit_no" name="unit_no" value="<?php if(isset($res->unit_no)){ echo$res->unit_no; } ?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="price">Name</label>
							<input type="text" class="form-control" required readonly ="name" name="name" value="<?php if(isset($res->unit_no)){ echo$res->donor_name; } ?>">

						</div>
					</div>
				</div>
				<h6>Forward Group</h6>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="vender">Anti-A</label>
							<select name="anti_a" id="anti_a" class="form-control">
								<option value="-tive">-tive</option>
								<option value="+1">+1</option>
								<option value="+2">+2</option>
								<option value="+3">+3</option>
								<option value="+4">+4</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="vender">Anti-B</label>
							<select name="anti_b" id="anti_b" class="form-control">
								<option value="-tive">-tive</option>
								<option value="+1">+1</option>
								<option value="+2">+2</option>
								<option value="+3">+3</option>
								<option value="+4">+4</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="vender">Anti-AB</label>
							<select name="anti_ab" id="anti_ab" class="form-control">
								<option value="-tive">-tive</option>
								<option value="+1">+1</option>
								<option value="+2">+2</option>
								<option value="+3">+3</option>
								<option value="+4">+4</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="vender">Anti-D</label>
							<select name="anti_d" id="anti_d" class="form-control">
								<option value="-tive">-tive</option>
								<option value="+1">+1</option>
								<option value="+2">+2</option>
								<option value="+3">+3</option>
								<option value="+4">+4</option>
							</select>
						</div>
					</div>
				</div>
				<h6>Reverse Group</h6>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="vender">A Cell</label>
							<select name="a_cell" id="a_cell" class="form-control">
								<option value="-tive">-tive</option>
								<option value="+1">+1</option>
								<option value="+2">+2</option>
								<option value="+3">+3</option>
								<option value="+4">+4</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="vender">B Cell</label>
							<select name="b_cell" id="b_cell" class="form-control">
								<option value="-tive">-tive</option>
								<option value="+1">+1</option>
								<option value="+2">+2</option>
								<option value="+3">+3</option>
								<option value="+4">+4</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="vender">O Cell</label>
							<select name="o_cell" id="o_cell" class="form-control">
								<option value="-tive">-tive</option>
								<option value="+1">+1</option>
								<option value="+2">+2</option>
								<option value="+3">+3</option>
								<option value="+4">+4</option>
							</select>
						</div>
					</div>
				</div>
				<h6>Himolysin In Blood Group 'O'</h6>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="vender">With A Cells</label>
							<select name="with_a_cell" id="with_a_cell" class="form-control">
								<option value="-tive">-tive</option>
								<option value="+1">+1</option>
								<option value="+2">+2</option>
								<option value="+3">+3</option>
								<option value="+4">+4</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="vender">With B Cells</label>
							<select name="with_b_cell" id="with_b_cell" class="form-control">
								<option value="-tive">-tive</option>
								<option value="+1">+1</option>
								<option value="+2">+2</option>
								<option value="+3">+3</option>
								<option value="+4">+4</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="quantity">Irregular Antibodies Done By Pooled 'O' Cells</label>
							<input type="text" class="form-control" required name="irregular_anti_o_cells" id="irregular_anti_o_cells">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="description">Final Blood Group</label>
							<select class="form-control" required id="final_bloodgroup" name="final_bloodgroup">
								<option value="select" disabled>select</option>
								<option value="A+" <?php if(isset($res->blood_group)){  if($res->blood_group == 'A+') {echo"selected='selected'";} } ?>>A+</option>
								<option value="A-" <?php if(isset($res->blood_group)){  if($res->blood_group == 'A-') {echo"selected='selected'";} } ?>>A-</option>
								<option value="B+" <?php if(isset($res->blood_group)){  if($res->blood_group == 'B+') {echo"selected='selected'";} } ?>>B+</option>
								<option value="B-" <?php if(isset($res->blood_group)){  if($res->blood_group == 'B-') {echo"selected='selected'";} } ?>>B-</option>
								<option value="O+" <?php if(isset($res->blood_group)){  if($res->blood_group == 'O+') {echo"selected='selected'";} } ?>>O+</option>
								<option value="O-" <?php if(isset($res->blood_group)){  if($res->blood_group == 'O-') {echo"selected='selected'";} } ?>>O-</option>
								<option value="AB-" <?php if(isset($res->blood_group)){  if($res->blood_group == 'AB-') {echo"selected='selected'";} } ?>>AB-</option>
								<option value="AB+" <?php if(isset($res->blood_group)){  if($res->blood_group == 'AB+') {echo"selected='selected'";} } ?>>AB+</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="description">Done By</label>
							<input type="text" class="form-control" required name="done_by" id="done_by">
						</div>
					</div>

				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="btn-group" style="float: right;">
							<button type="submit" name="submit" class="btn btn-sm btn-danger" id="btn_save_basic_details"><i class="fas fa-save fw"></i> Save</button>
						</div>
					</div>
			</form>
			<?php } ?>

		</div>
	</div>
</div>