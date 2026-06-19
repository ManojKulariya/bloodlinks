<style type="text/css">
   .body {
      font-family: Jost, sans-serif !important;
   }

   .btn-success:not(:disabled):not(.disabled).active,
   .btn-success:not(:disabled):not(.disabled):active,
   .show>.btn-success.dropdown-toggle {
      color: #fff;
      background-color: #ad1e1d !important;
      border-color: #ad1e1d !important;
   }

   .btn-success {
      background-color: #ad1e1d !important;
      border-color: #ad1e1d !important;
   }

   .btn-danger {
      background-color: #ad1e1d !important;
      border-color: #ad1e1d !important;
   }

   .page-item.active .page-link {
      background-color: #ad1e1d !important;
      border-color: #ad1e1d !important;
      color: #fff !important;
   }

   .page-link {
      color: #000 !important;
   }

   .form-control {
      height: 25px !important;
      padding: 0 14px !important;
      font-size: 14px !important;
   }

   label {
      margin-bottom: -4px;
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

   .content-wrapper {
      background: #fff;
   }

   .card-footer {
      background-color: #fff;
   }

   .form-group {
      margin-bottom: 2px;
   }

   label {
      margin-bottom: 0;
   }

   table.dataTable thead>tr>th.sorting_asc,
   table.dataTable thead>tr>th.sorting_desc,
   table.dataTable thead>tr>th.sorting,
   table.dataTable thead>tr>td.sorting_asc,
   table.dataTable thead>tr>td.sorting_desc,
   table.dataTable thead>tr>td.sorting {
      font-size: 12px;
   }

   table.dataTable thead th,
   table.dataTable thead td {
      padding: 0 16px;
   }

   div.dataTables_wrapper div.dataTables_filter input {
      margin-left: 6px;
      display: inline-block;
      width: 100px;
   }

   td {
      font-size: 14px;
   }

   .btn-xs {
      padding: 5px;
      font-size: 7px;
   }

   div.dataTables_wrapper div.dataTables_info {
      font-size: 15px;
   }

   .dataTables_wrapper .dataTables_paginate .paginate_button {
      padding: 2px;
   }

   .card {
      box-shadow: none;
   }
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed');

$bank_id = $_SESSION['bank_id'];
?>
<div class="container">
  <form action="<?php $_PHP_SELF ?>" method="POST">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

    <div class="timeline">
      <div class="card">

        <div class="card-body">

          <?php
          if ($_SESSION['admin_type'] == '0') {
            $servies_per = $_SESSION['bloodbank_user_servies_permission'];
            $per = json_decode($servies_per);
            if ($per->Consumables_permission  == 'Write') {
          ?>
              <div class="btn-group" style="float: right;">
                <h6>Add Blood Grouping</h6>
                <a href="<?php echo $base_url; ?>/donations/blood_grouping/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
              </div><br><br>
            <?php }
          } else { ?>
            <div class="btn-group" style="float: right;">
              <h6>Add Blood Grouping</h6>
              <a href="<?php echo $base_url; ?>/donations/blood_grouping/add" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New" style="float:right;"><i class="fas fa-plus"></i></a>
            </div><br><br>
          <?php } ?>
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

<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
  <div style="overflow-x:auto;">
    <table class="table table-fluid table-responsive" id="myTable">
      <thead>
        <tr>
          <th>S No</th>
          <th>Date</th>
          <th>Unit No.</th>
          <th>Name</th>
          <th>Anti-A</th>
          <th>Anti-B</th>
          <th>Anti-AB</th>
          <th>Anti-D</th>
          <th>A Cell</th>
          <th>B Cell</th>
          <th>O Cell</th>
          <th>With A Cells</th>
          <th>With B Cells</th>
          <th>Irregular<br>
            Antibodies done<br>
            by pooled 'O'<br>
            Cells</th>
          <th>Final Blood<br>Group </th>
          <th>Done By </th>
          

        </tr>
      </thead>
      <tbody>
        <?php
        $no = 0;
        $this->db->select('bl_blood_group.*,bl_bb_donatioform.donor_name');
        $this->db->from('bl_blood_group');
        $this->db->join('bl_bb_donatioform', 'bl_bb_donatioform.id = bl_blood_group.donor_id');
        $this->db->where('bl_blood_group.bloodbank_id', $bank_id);
        $this->db->order_by('bl_blood_group.id', 'desc');
        $query = $this->db->get();
        $result = $query->result_array();
    foreach ($result as $inx=>$ms) {  ?>
      <tr style="width: 100%;">
          <td ><?= ++$inx?></td>
        <td ><?= date('d-m-Y', strtotime($ms['date'])) ?></td>
        <td ><?= $ms['unit_no'] ?></td>
        <td ><?= $ms['donor_name'] ?></td>
        <td ><?= $ms['anti_a'] ?></td>
        <td ><?= $ms['anti_b'] ?></td>
        <td ><?= $ms['anti_ab'] ?></td>
        <td ><?= $ms['anti_d'] ?></td>
        <td ><?= $ms['a_cell'] ?></td>
        <td ><?= $ms['b_cell'] ?></td>
        <td ><?= $ms['o_cell'] ?></td>
        <td ><?= $ms['with_a_cell'] ?></td>
        <td ><?= $ms['with_b_cell'] ?></td>
        <td ><?= $ms['irregular_anti_o_cells'] ?></td>
        <td ><?= $ms['final_bloodgroup'] ?></td>
        <td ><?= $ms['done_by'] ?></td>

      </tr>
    <?php }  ?>
      </tbody>
    </table>
  </div>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>

  <script type="text/javascript">
    function deleteFun(id) {
      // alert(id);


      if (confirm('Are you sure') == true) {

        $.ajax({

          url: '<?php echo $base_url; ?>/donations/consumable_delete',
          method: "POST",
          datatype: "json",
          data: {
            [csrf_name]: csrf_hash,
            id: id
          },

          success: function(d) {
            // console.log (d);
            if (d == 1) {
              alert('Data Delete Successfully');
              location.reload();
            } else {
              alert('Delete Fail');
            }
          }
        })
      }
    }
  </script>