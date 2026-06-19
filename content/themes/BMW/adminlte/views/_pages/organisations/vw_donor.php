<?php defined('BASEPATH') OR exit('No direct script access allowed');
//  $query = $this->db->get('bl_customers');
//  foreach ($query->result() as $row)
// {

//     print_r($row);

// } 
// $auth = $_SESSION['auth_id'];
// print_r($_SESSION);
// die();
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Donors</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table_alldonor" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Donar Name</th>
            <th>Donar Email</th>
            <th>Donar Phone No</th>
            <th>Request Date</th>
            <th>Reason</th>
            <th>Donation Status</th>
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
    
    var apppointment_search='<?php echo $base_url;?>/donor_search';
    // var deleteSingleData='<?php echo $base_url;?>/donations/deleteSingleData';

  </script>

<script type="text/javascript">

  function deleteFun(id){
// alert(id);


    if(confirm('Are you sure')==true)
    { 

      $.ajax({
                 
               url:'<?php echo $base_url;?>/deleteSingleData',
               method:"POST",
               datatype:"json",
               data:{[csrf_name]:csrf_hash,id:id},

               success:function(d){
                 // console.log (d);
                  if(d==1){
                     alert('Data Delete Successfully');
                     $('#table_alldonor').DataTable().ajax.reload();
                  }
                  else{
                     alert('Delete Fail');
                  }
               }
            })
    }
  }


</script>
<!-- 
           <?php

         $auth = $_SESSION['auth_id'];
         //$access = "5";
          //print($auth);die();
 $query = $this->db->get('bl_customers');

// $id = 'your id';
// $this->db->select("*");
// $this->db->from("bl_customers");
// $this->db->where('id','$id');
// $query = $this->db->get();
// return $query->result_array();



    // $this->db->select('*');
    // $this->db->from('bl_users a'); 
    // $this->db->join('bl_donar_form_info b', 'b.user_id=a.id', 'left');
    // $this->db->join('bl_customers c', 'c.user_id=a.id', 'left');
    // $this->db->join('bl_blood_banks d', 'd.user_id=a.id', 'left');
    // $this->db->where('b.user_id', $auth );

    // $query = $this->db->get();

 // echo $this->db->last_query();
 // die();
  // print_r($query->result());die();
$counter=0;
foreach ($query->result() as $row)
{
    // echo $row->name;
$counter=$counter+1;
    //print_r($row);
// die();
              ?>
           
                <tr>
                  
                 
                  <td><?php echo $counter; ?></td>
                  <td><?php echo $row->first_name. $row->mid_name. $row->last_name; ?></td>
                  <td><?php echo $row->email; ?></td>
                  <td><?php echo $row->ph_no; ?></td>
                 <td><?php echo $row->created_at; ?></td>
                 <td><a href="<?php echo base_url('admin/donations/donation_form/'.$row->user_id);?>" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>
                    <button type="button" class="btn btn-xs btn-dark btn_del_data deleteBtn" data-master_id="$row->user_id" id=""><i class="fa fa-trash"></i></button></td>
                  
                </tr> 
              <?php } ?> -->