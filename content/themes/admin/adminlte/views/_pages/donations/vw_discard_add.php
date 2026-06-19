<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 

$bank_id = $_SESSION['bank_id'];
$auth_id = $_SESSION['auth_id'];
if ($_SESSION['admin_type'] == '0') {
    $query1 = $this->db->query("SELECT * FROM bl_bloodbank_user where user_id = '$auth_id'");
                              foreach ($query1->result() as $type)
                              {} 
                           
}else{
    $query1 = $this->db->query("SELECT * FROM bl_blood_banks where user_id = '$auth_id'");
                    foreach ($query1->result() as $type)
                      {} 

}
 ?>
 <?php 

  if(!empty($_POST['discardid'])){

      // print_r($_POST); die;

     $discard_reason = $_POST['discard_reason'];
     $discard_by = $_POST['discard_by'];
     $bloodstock_id = $_POST['discardid'];
     $discard_date = $_POST['discard_date'];

    

    $discard = date('ymd').time().rand(1000,9999);
    $blood_discard = 'DB'.$discard;
 $update = $this->db->query("UPDATE bl_crossmatch SET discard_reason = '$discard_reason', discard_by = '$discard_by' , status ='discard', discard_no ='$blood_discard' , discard_date = '$discard_date' WHERE id = '$bloodstock_id'");
   if($update==true){
    // echo 'hiii';
    // die();
    redirect('admin/donations/discard');

  } else{
    echo "fail";
  }
 
}


   ?>
    <style type="text/css"> 
     .col-form-label{
      font-size: 12px;

     }
     .form-label{
      font-size: 12px;
     }
     .btn-primary {
    background-color: #ad1e1d !important;
    border-color: #ad1e1d !important;
    height: 30px;
    padding: 0 10px;
    margin-top: -5px;
}
.form-control {
    height: 30px;
}
.btn.btn-secondary {
    height: 30px;
    padding: 0 10px;
    margin-top: -5px;
}
.btn-success {
    background-color: white !important;
   
}
    </style>

<!-- <div class="container my-3" style="border:1px solid black"> -->
  
        <div style="text-align: center;">
    <form action = "<?php $_PHP_SELF ?>" method = "POST">
        <div class="L9"> 
            <div class="hide" id="div1">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
               <label class="L10" for="form">Unit No:</label>
                            <input type="text" id="Registration" name="unit_no" value="<?php if(isset($row->unit_no)) { echo $row->unit_no;  } ?>" placeholder="">
    <button type="submit" class="btn btn-primary">Search</button>
</div>

</div> 
</form>  
</div>
    <div class="col-sm-12 my-3 bg-white pb-3">

    <h5 style="text-align: center; color: red; font-size: 18px;padding: 5px;font-weight: bolder;">Discard Date</h5>
    <table class="table table-bordered table-striped mb-0">
        <thead>
            <tr>
              <th>#</th>
            <th id="th" scope="col">Unit No.</th>
            <th id="th" scope="col">Tube No.</th>
            <th id="th" scope="col">Blood Group</th>
            <th id="th" scope="col">Component</th>
            <th id="th" scope="col">Collection Date</th>
            <th id="th" scope="col">Expiry Date</th>
            <th id="th" scope="col">Status</th>
            <th id="th" scope="col">Issue No.</th>
            <th id="th" scope="col">Action</th>
              

            </tr>
        </thead>
        <tbody>
            <?php 


                     $n=6;
      function reg($n) {
        $characters = '0123456789';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        } 

        return $randomString;
    }

    $return = reg($n);
    $blood_return = 'RB'.$return;
              
                  $no="0";  
            if(!empty($_POST['unit_no'])){
             $request = $_POST['unit_no'];
             $query = $this->db->query("SELECT * FROM  bl_crossmatch WHERE bl_crossmatch.bloodbank_id = '$bank_id' AND status ='issued'  and request = '$request'");
             foreach ($query->result() as $row)
             {
                $no++;
             //print_r($row);
         ?>
                <tr>

                  <th scope="row"><?=$no ?></th>
                  <td><?=$row->unit_no ?></td>
                  <td><?=$row->tube_no ?></td>
                  <td><?=$row->blood_group ?></td>
                  <td><?=$row->component ?></td>
                  <td><?=$row->return_date ?></td>
                  <td><?=$row->expire_date ?></td>
                  <td><?=$row->status ?></td>          
                  <td><?=$row->issue_no ?></td>          
                  <td><button type="button" class="btn btn-xs" data-toggle="modal" data-target="#exampleModalScrollable<?=$row->id ?>" ><i class="fa fa-check" style="color: #ad1e1d;font-weight: bold;border: 1px solid black;padding: 3px;"></i></button></td>
           <!-- Modal -->
<div class="modal fade" id="exampleModalScrollable<?=$row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Discard Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="scheduling-confirm" action = "<?php $_PHP_SELF ?>" method = "POST" style="padding-bottom: 0px!important; margin: 0px!important;">
      <div class="modal-body">
      
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

   <div class="card-body">
      
      <div class="form-row pr-2 pl-2">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Tube No.</label>
          <input type="text" name="tube_no" class="form-control" id="inputEmail4" value="<?php if(isset($row->tube_no)) { echo $row->tube_no;  } ?>">
      </div>
      <div class="form-group col-md-6">
          <label for="inputEmail4">Blood Group</label>
          <input type="text" name="blood_group" class="form-control" id="inputEmail4" value="<?php if(isset($row->blood_group)) { echo $row->blood_group;  } ?>">
      </div>
      </div>


      <div class="form-row pr-2 pl-2">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Reason for Discard</label>
          <select id="inputState" name="discard_reason" class="form-control" style="padding:0px !important;">
            <option selected>Choose...</option>
            <?php 
            $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'discard_reason'");
            foreach ($query1->result() as $reasion)
            {
               ?>
               <option value="<?= $reasion->master_type_key_value; ?>"><?= $reasion->master_type_key_value; ?></option>
           <?php } ?>
       </select>
      </div>
      <div class="form-group col-md-6">
      <label for="inputEmail4">Discard By</label>
      <input type="text" name="discard_by" class="form-control" value="<?=$type->name ?>" id="inputEmail4">
     </div>
     </div>

     <input type="hidden" value="<?php if(isset($row->id)) {echo $row->id;} ?>"  name="discardid">
     <input type="hidden" id="date"  name="discard_date">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>

    </tr>
<?php  }
      //$user_id = $row->user_id;   
         } ?>
    </tbody>
</table>
</div>
<script>
 const [date, time] = formatDate(new Date()).split(' ');
console.log(date); // 👉️ 2021-12-31
console.log(time); // 👉️ 09:43

// ✅ Set Date input Value
const dateInput = document.getElementById('date');
dateInput.value = date;

// 👇️️ "2021-12-31"
console.log('dateInput value: ', dateInput.value);

// ✅ Set time input value
const timeInput = document.getElementById('time');
timeInput.value = time;

// 👇️ "09:43"
console.log('timeInput value: ', timeInput.value);

// ✅ Set datetime-local input value
const datetimeLocalInput = document.getElementById('datetime-local');
datetimeLocalInput.value = date + 'T' + time;

// 👇️ "2021-12-31T10:09"
console.log('dateTimeLocalInput value: ', datetimeLocalInput.value);

// 👇️👇️👇️ Format Date as yyyy-mm-dd hh:mm:ss
// 👇️ (Helper functions)
function padTo2Digits(num) {
  return num.toString().padStart(2, '0');
}

function formatDate(date) {
  return (
    [
      date.getFullYear(),
      padTo2Digits(date.getMonth() + 1),
      padTo2Digits(date.getDate()),
    ].join('-') +
    ' ' +
    [
      padTo2Digits(date.getHours()),
      padTo2Digits(date.getMinutes()),
      // padTo2Digits(date.getSeconds()),  // 👈️ can also add seconds
    ].join(':')
  );
}

// 👇️ 2022-07-22 08:50:39
console.log(formatDate(new Date()))

// 👇️ 2025-05-04 05:24
console.log(formatDate(new Date('May 04, 2025 05:24:07')))
</script>
<script>
   $('input[type="checkbox"]').on('change', function() {
   $(this).siblings('input[type="checkbox"]').prop('checked', false);
});
</script>