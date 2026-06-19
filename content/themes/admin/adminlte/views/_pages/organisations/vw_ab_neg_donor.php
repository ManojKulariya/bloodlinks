<style type="text/css">
  .form-control {
    height: 25px !important;
    padding: 0 14px !important;
    font-size: 14px !important;
  }
  label {
      margin-bottom: 0;
      font-size: 12px;
  }
  .card-body {
      padding: 0 10px;
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
  .page-link {
      color: #000 !important;
      }
      .page-item.active .page-link {
    color: #fff !important;
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
  .capitalize{
    text-transform: capitalize;
  }
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <form action = "<?php $_PHP_SELF ?>" method = "POST">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <div class="timeline">
            <div class="card">             
                <div class="card-body">
                    <div class="row">                        
                        <div class="col-md-3">
                           <div class="form-group">
                                <label for="description">Name </label>
                                <!-- <select name="blood_group" id="vender" class="form-control">
                                  <option disabled="disabled" selected="selected" value="">Select</option>   
                                  <option value="A+">A+</option>
                                  <option value="A-">A-</option>
                                  <option value="B+">B+</option>
                                  <option value="B-">B-</option>
                                  <option value="AB+">AB+</option>
                                  <option value="AB-">AB-</option>
                                  <option value="O+">O+</option>
                                  <option value="O-">O-</option>        
                                </select> -->
                            </div>
                        </div>  
                        <div class="col-md-3">                           
                            <div class="card-footer">
                                <div class="btn-group" style="float: right;">
                                    <button type="submit" name="submit" class="btn btn-sm btn-danger" >Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
               </div>
            </form>
          </div>

         <!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>-->

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
  <div style="overflow-x:auto;">
<table class="table table-fluid" id="myTable">
    <thead>
            <tr>
                <th>S. No.</th>
                <th>Blood Bank</th>
                <th>Name </th>
                <th>Contact</th>
                <th>Blood Group</th>
                <th>Lasted Donated </th>  
            </tr>
    </thead>
    <tbody>
            <?php  $no=0;
                $city = $_GET['city']; 
                // $bloodgroup = urldecode($_GET['group']);
                $bloodgroup = "AB-";                 
                if(!empty($city) && !empty($bloodgroup) ){
                    $query = $this->db->query("SELECT DISTINCT 
                    bl_cities.city_name, 
                    bl_bb_donatioform.mobile,
                    bl_bb_donatioform.blood_group, 
                    bl_bb_donatioform.created_at, 
                    bl_blood_banks.name, 
                    bl_blood_banks.blood_bank_id, 
                    bl_cities.city_name 
                FROM 
                    bl_bb_donatioform 
                INNER JOIN 
                    bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id 
                INNER JOIN 
                    bl_cities ON bl_cities.id = bl_blood_banks.city_id 
                WHERE 
                    bl_cities.city_name = '$city' 
                    AND bl_bb_donatioform.blood_group = '$bloodgroup' 
                ORDER BY 
                    bl_bb_donatioform.created_at DESC                
                    "); 
                foreach ($query->result() as $row) { 
                    $no++;
                ?>
                <tr>
                    <th scope="row"><?=$no ?></th>
                    <td class="capitalize"><?=$row->city_name ?></td>
                    <td class="capitalize"><?=$row->name ?></td>
                    <td class="capitalize"><?=$row->mobile ?></td>                 
                    <td class="capitalize"><?=$row->blood_group ?></td>
                    <td class="capitalize"><?=$row->created_at ?></td>               
                </tr>            
            <?php }  
                    } else{ ?>
                    <tr>
                    <td class="capitalize"><?=$row->city_name ?></td>              
                </tr>  
                 <?php  }
            ?>
    </tbody>
</table>
</div>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
