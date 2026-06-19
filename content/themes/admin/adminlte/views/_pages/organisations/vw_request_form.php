<style type="text/css">
  .form-control {
    height: 25px !important;
    padding: 0 14px !important;
    font-size: 14px !important;
}
label {
    margin-bottom: 0px;
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
.content-wrapper {
    background: #fff;
        text-transform: capitalize;
}
.card-footer {
    padding: 18px 0 10px;
    background-color: #fff;
  }
  table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
     padding-right: 15px; 
    font-size: 12px;
}
table.dataTable tbody th, table.dataTable tbody td {
    padding: 6px !important;
    font-size: 14px;
}
.btn-xs {
    padding: 2px;
    font-size: 10px;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 0 15px !important;
}
.form-group {
    margin-bottom: 0;
}
.page-link {
    color: #000;
}
.capitalize{
  text-transform: capitalize;
}
.card-body {
    padding: 0 10px;
}
.timeline::before{
  width:0;
}
</style>

<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <form action="<?= base_url('admin/request_form'); ?>" method = "GET">

        <div class="timeline">
            
              <div class="card">
             
                <div class="card-body">
   
    
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Name</label>
                                <input type="text" class="form-control" id="price" name="name">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Request No</label>
                                <input type="text" class="form-control" id="price" name="request_no">
                            </div>
                        </div>
                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Mobile No</label>
                                <input type="tel" class="form-control" id="price" name="mobile">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                 <label for="description">Donor Type</label>
                                <select name="donor_type" id="vender" class="form-control">
                                <option disabled="disabled" selected="selected" value="">Select</option>               
          <option value="Volunter">Volunter</option>
          <option value="replacement">Replacement</option>
        
                                </select>
                            </div>
                        </div>
                    </div>
                         <div class="row">

                          <div class="col-sm-3">
                      <div class="form-group">
                        <label for="vender" >Hospital:</label>
                         <select class="form-control" name="hospital">
                             <option disabled="disabled" selected="selected" value="" style="margin:0px !important;">Select</option>
                    
                     <?php 
                   $query3 = $this->db->query("SELECT * FROM bl_blood_banks where org_type = 'Hospital'");
                   foreach ($query3->result() as $hospital)
                   {?>
                       <option value="<?= $hospital->name; ?>"><?= $hospital->name; ?></option>
                   <?php } ?>
                  </select>
                      </div>
                    </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Blood Group</label>
                                <select name="blood_group" id="vender" class="form-control">
                                <option disabled="disabled" selected="selected" value="">Select</option>             
          <option value="A+">A+</option>
          <option value="A-">A-</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="AB+">AB+</option>
          <option value="AB-">AB-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>

        
                                </select>
                            </div>
                        </div>
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
                    </div>
                                        <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Status</label>
                                 <input type="text" class="form-control" id="price" name="status">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                               
                                 <label for="description">Type</label>
                                <select name="type" id="vender" class="form-control">
                                <option disabled="disabled" selected="selected" value="">Select</option>                    
          <option value="Online">Online</option>
          <option value="Offline">Offline</option>
        
                                </select>
                            </div>
                        </div>
                 
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">City</label>
                               <input type="text" class="form-control" id="price" name="city">
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">User</label>
                                <select name="user" id="vender" class="form-control">
                                <option value="#" selected disabled>Select</option> 
                                                <?php 
            $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user");
           foreach ($query1->result() as $type)
           {
              ?>
          <option value="<?= $type->name; ?>"><?= $type->name; ?></option>
            <?php } ?>
                                </select>
                            </div>
                        </div>
                           <div class="col-md-3">
                  <div class="form-group">
                     <label for="description">Blood Bank</label>
                     <select name="blood_bank" id="vender" class="form-control">
                      <option value="#" selected  disabled>Select</option>
                         <?php 
                           $query12 = $this->db->query("SELECT * FROM bl_blood_banks");
                           foreach ($query12->result() as $type)
                           {
                             ?>
                        
                        <option value="<?= $type->name; ?>"><?= $type->name; ?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
                  
                       <div class="col-md-9">
                          <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                            <button type="submit" name="submit" class="btn btn-sm btn-danger" >Filter</button>
                              <button class="btn btn-sm btn-warning mx-2 text-white" id="reset" />Reset</button>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </form>
          </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
  <div style="overflow-x:auto;box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);padding: 12px;border-radius: 4px;margin-left: -6px;">
    <table class="table table-fluid" id="myTable">
    <thead>
    <tr>
      <th>S No</th>
      <th>Blood Bank Name</th>
      <th>Blood Bank Code</th>
      <th>Blood Bank City</th>
      <th>Name</th>
      <th>Request No</th>
      <th>Mobile No</th>
      <th>Blood Group</th>
      <th>Date</th>
      <th>Hospital</th>
      <th>Status</th>
      <th>Request Type</th>
      <th>User</th>
        <?php 
       if ($_SESSION['admin_type'] =='0') {
            $servies_per = $_SESSION['bloodbank_user_servies_permission'];
            $per = json_decode($servies_per);
    
            if ($per->RequestRegister_permission  =='Write') {
                 
       ?>
       <th>Action</th>
    <?php }
    }else{?>
     <th>Action</th>
    <?php } ?>
     
    </tr>
    </thead>
    <tbody>
        <?php
            $current_page = $current_page== 0?$current_page:$current_page-1;
            $start = ($current_page) * $limit;
            foreach ($blood_requests_data as $index=>$row) {
                 $sr_no = $start + $index + 1;
            ?>
                  <tr>
                      <th scope="row"><?=$sr_no ?></th>
                      <td style="text-transform: capitalize;"><?=$row->name ?></td>
                      <td style="text-transform: capitalize;"><?=$row->blood_bank_id ?></td>
                      <td style="text-transform: capitalize;"><?=$row->city_name ?></td> 
                      <td class="capitalize" ><?=$row->p_name ?></td>
                      <td class="capitalize"><?=$row->request ?></td>
                      <td class="capitalize"><?=$row->mobile ?></td>
                      <td class="capitalize"><?=$row->blood_group ?></td>                 
                      <td class="capitalize"><?=$row->required_date ?></td>
                      <td class="capitalize"><?=$row->hospital ?></td>
                      <td class="capitalize"><?=$row->status ?></td>
                      <td class="capitalize"><?=$row->request_type ?></td>
                      <td class="capitalize"><?=$row->request_by ?></td>
                    <?php 
                    if ($_SESSION['admin_type'] =='0') {
                    $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                    $per = json_decode($servies_per);
                    
                    if ($per->RequestRegister_permission  =='Write') {
                    
                    ?>
                    <td class="capitalize"><?php echo '<a href="'.$this->data['base_url'].'/request_form_edit/'.$row->id.'" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$row->id.');" ><i class="fa fa-trash"></i></button>'; ?></td>
                    <?php }
                    }else{?>
                    <td class="capitalize"><?php echo '<a href="'.$this->data['base_url'].'/request_form_edit/'.$row->id.'" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$row->id.');" ><i class="fa fa-trash"></i></button>'; ?></td>
                    <?php } ?>
    
                       
    </tr>
    <?php } ?>
    </tbody>
    </table>
    <?= $pagination_links ?>
</div>
<script>
$(document).ready( function () {
$('#myTable').DataTable();
} );
 $("#reset").click(function(){
   var url ="<?= base_url('admin/request_form') ?>";
   $("input,select").val("");
   window.location.href = url;
});

</script>

<script type="text/javascript">

  function deleteFun(id){

    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/request_form_delete',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data Delete Successfully');
                     location.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }
</script>