<?php defined('BASEPATH') OR exit('No direct script access allowed');


if(session_userdata('isAdminLoggedin')){
	 echo @$partial_header;
	 echo @$partial_sidebar;
	?>
<style>
.dropbtn {
  border: none;
  cursor: pointer;
}
.dropdown-btn-container{
   background-color: #f1f1f1;
  color: black;
  padding: 3px 10px;
  font-size: 14px;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Style the dropdown items */
.dropdown-content div {
  padding: 5px 8px;
  cursor: pointer;
}

/* Change color of dropdown items on hover */
.dropdown-content div:hover {
  background-color: #ddd;
}

</style>
	<div class="content-wrapper">
		<section class="content-header" style="padding-bottom :5px;">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1><?php echo $page_title;?></h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">

	            	<?php
	            	if(!empty($bredcrumb)){
	            		foreach ($bredcrumb as $key => $value) {
	            			?>
	            			<li class="breadcrumb-item">
	            				<?php
	            				if($value!=''){
	            					?>
	            					<a href="<?php echo $value;?>"><?php echo $key;?></a>
	            					<?php
	            				}else{
	            					echo $key;
	            				}
	            				?>
	            			</li>
	            			<?php
	            		}
	            	}
	            	?>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
	    </section>
		<!-- Main content -->
    	<section class="content">
    		<div class="container-fluid">
	<?php
		

}

echo @$content;
if(session_userdata('isAdminLoggedin')){
	
	?>
			</div>
		</section>
	</div>
	<?php
	echo @$partial_footer;
}

?>