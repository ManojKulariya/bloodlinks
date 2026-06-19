<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
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
// $bank_id = $_SESSION['bank_id'];
  if(!empty($_POST['return_no'])){

     $reason_return = $_POST['reason_return'];
     $return_date = $_POST['return_date'];
     $return_no = $_POST['return_no'];
     $issue_id = $_POST['issue_id'];
     $part = $_POST['part'];
     $crossmatch = $_POST['crossmatch_no'];
     $update = $this->db->query("UPDATE bl_crossmatch SET status = 'return' ,reason_return = '$reason_return' , return_no = '$return_no' , return_by = '$type->name', return_date = '$return_date' WHERE id = '$issue_id'");

   if($update==true){
    $update1 = $this->db->query("UPDATE bl_blood_record SET cross_match = 'No', issue_status = 'No', issued_vol = '0', final_vol = '$part' WHERE crossmatch_no = '$crossmatch'");
     
       if($update1==true){
            redirect('/admin/request/blood_return');
  // echo '<script>alert("Your Appointment Booked")</script>';
    } else{
      echo "fail";
  }
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
                <label for="inputEmail3" class="col-sm-2 col-form-label">Request No:</label>
                <input type="text" id="Registration" name="request" placeholder="">
  
    <button type="submit" class="btn btn-primary">Search</button>
</div>

</div> 
</form>  
</div>
    <div class="col-sm-12 my-3 bg-white pb-3">

    <h5 style="text-align: center; color: red; font-size: 18px;padding: 5px;font-weight: bolder;">Isuued Date</h5>
    <table class="table table-bordered table-striped mb-0">
        <thead>
            <tr>
                <th id="th" scope="col">#</th>
                <th id="th" scope="col">Request no</th>
                <th id="th" scope="col">Patinet Name</th>
                <!-- <th id="th" scope="col">Ipd</th> -->
                <th id="th" scope="col">Unit no</th>
                <th id="th" scope="col">Component</th>
                <th id="th" scope="col">Tube no</th>
                <th id="th" scope="col">Issues Date</th>
                <th id="th" scope="col">Issue No</th>
                <th id="th" scope="col">Hospital</th>
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
            if(!empty($_POST['request'])){
             $request = $_POST['request'];
             $query = $this->db->query("SELECT * FROM  bl_crossmatch WHERE status ='issued'  and request = '$request'");
             foreach ($query->result() as $row)
             {
                $no++;
             // print_r($row);
         ?>
                <tr>
                  <th scope="row"><?=$no ?></th>
                  <td><?=$row->request ?></td>
                  <td><?=$row->p_name ?></td>
                  <td><?=$row->unit_no ?></td>
                  <td><?=$row->component ?></td>
                  <td><?=$row->tube_no ?></td>
                  <td><?=$row->issue_date ?></td>
                  <td><?=$row->issue_no ?></td>
                  <td><?=$row->hospital ?></td>          
                  <td><button type="button" class="btn btn-xs" data-toggle="modal" data-target="#exampleModalScrollable<?=$row->id ?>" ><i class="fa fa-check" style="color: #ad1e1d;font-weight: bold;border: 1px solid black;padding: 3px;"></i></button></td>
           <!-- Modal -->
<div class="modal fade" id="exampleModalScrollable<?=$row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Entry Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="scheduling-confirm" action = "<?php $_PHP_SELF ?>" method = "POST" style="padding-bottom: 0px!important; margin: 0px!important;">
      <div class="modal-body">
      
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

     <div class="row">
        <div class="col-sm-12">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label"> Reason for return
                </label>
                <div class="col-sm-8">
                    <select class="form-control" name="reason_return" style="font-size: 12px"> 
                        <?php 
        $query1 = $this->db->query("SELECT * FROM bl_masters where master_type_key = 'return_reason'");
        foreach ($query1->result() as $reason_return)
        {
           ?>
           <option value="<?= $reason_return->master_type_key_value; ?>"><?= $reason_return->master_type_key_value; ?></option>
       <?php } ?>
                        
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
  
                <llabel for="inputEmail3" class="col-sm-4 col-form-label">Return No </llabel>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="return_no" value="<?=$blood_return ?>" readonly>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label"> Return Date </label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" name="return_date" id="date" placeholder="">
                </div>
            </div>
        </div>
    </div>
         <input type="hidden" value="<?php echo $row->id; ?>" id="cross_match" name="issue_id">
         <input type="hidden" value="<?php echo $row->volume; ?>" id="cross_match" name="part">
          <input type="hidden" value="<?php echo $row->cross_match; ?>" id="cross_match" name="crossmatch_no">
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