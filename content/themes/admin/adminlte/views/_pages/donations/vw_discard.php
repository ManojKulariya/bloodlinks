<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
  .content-wrapper {
    background: #fff;
    text-transform: capitalize;
  }

  .content-header h1 {
    font-size: 1.2rem !important;
    /* margin: 0 20px; */
    font-weight: 700 !important;
  }

  .card-footer {
    padding: 10px 20px;
    background-color: #fff;
  }

  .form-control {
    height: 1.6rem;
    font-size: 0.9rem;
    padding: 0px;
  }

  label {
    font-size: 12px;
  }

  .form-group {
    margin-bottom: 0;
  }

  table.dataTable thead>tr>th.sorting_asc,
  table.dataTable thead>tr>th.sorting_desc,
  table.dataTable thead>tr>th.sorting,
  table.dataTable thead>tr>td.sorting_asc,
  table.dataTable thead>tr>td.sorting_desc,
  table.dataTable thead>tr>td.sorting {
    /* padding-right: 15px;  */
    font-size: 12px;
  }

  table.dataTable tbody th,
  table.dataTable tbody td {
    /* padding: 6px !important; */
    font-size: 14px;
  }

  .btn-xs {
    padding: 2px;
    font-size: 10px;
  }

  table.dataTable thead th,
  table.dataTable thead td {
    /* padding: 0 15px !important; */
  }

  .page-item.active .page-link {
    background-color: #dc3545;
    border-color: #dc3545;
  }

  .page-link {
    color: #000;
  }

  .capitalize {
    text-transform: capitalize;
  }

  label {
    margin-bottom: 0;
  }
</style>
<?php 

$bank_id = $_SESSION['bank_id'];
  if(!empty($_POST['donationform_id'])){

     $hiv = $_POST['hiv'];
     $hbsag = $_POST['hbsag'];
     $hcv = $_POST['hcv'];
     $vdrl = $_POST['vdrl'];
     $malaria = $_POST['malaria'];
     $anti_hbc = $_POST['anti_hbc'];
     $donationform_id = $_POST['donationform_id'];
if(($hiv == 'Negative') && ($hbsag == 'Negative') && ($hcv == 'Negative') && ($vdrl == 'Negative') && ($malaria == 'Negative') && ($anti_hbc == 'Negative')){
                         $status= 'Test done';
                     }else{
                        $status= 'Pending';
                     } 
 $update = $this->db->query("UPDATE bl_bb_donatioform SET hiv = '$hiv',hbsag = '$hbsag',hcv = '$hcv',malaria = '$malaria',vdrl = '$vdrl',anti_hbc = '$anti_hbc', status ='$status' WHERE id = '$donationform_id'");
 
}

 ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Discard Blood</h3>
               <div class="btn-group" style="float: right;">
          <a href="<?php echo $base_url;?>/donations/discard/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table_donor_discard" class="table table-bordered table-hover">
        
          <thead>
          <tr>
            <th>#</th>
            <th>Unit No.</th>
            <th>Blood Group</th>
            <th>Component</th>
            <!--<th>Collection Date</th>-->
            <!--<th>Expiry Date</th>-->
            <th>Discard Date</th>
            <th>Discard No.</th>
            <th>Discard Reason</th>
            <th>Discard by</th>
            <th>Autoclaved</th>
            <th>Handover to BMW </th>
            <th>Action</th>
          </tr>
          </thead>
        
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

  <script type="text/javascript">
    var apppointment_search='<?php echo $base_url;?>/donations/discard_search';
  </script>
<script type="text/javascript">

  function deleteFun(id){
    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/donations/discard_delete',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data Delete Successfully');
                     $('#table_donor_discard').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }
  function deletecom(id){
    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/donations/discard_com_delete',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data Delete Successfully');
                     $('#table_donor_discard').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }
 function deletetti(id){
    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/donations/discard_tti_delete',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data Delete Successfully');
                     $('#table_tti_discard').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }

 function thrown(id,type){
    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/donations/discard_thrown',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id,type:type},

               success:function(d){
                  if(d==1){
                     alert('Data updated Successfully');
                     $('#table_donor_discard').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }
  
 function throwntti(id){
    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/donations/discard_thrown_tti',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data updated Successfully');
                     $('#table_tti_discard').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }
  
  function throwncom(id){
    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/donations/discard_thrown_component',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data updated Successfully');
                     $('#table_component_discard').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }
</script>
