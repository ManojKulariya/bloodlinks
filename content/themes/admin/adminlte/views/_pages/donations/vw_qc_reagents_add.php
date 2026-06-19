<style>
   .form-control {
      height: calc(1.70rem + 2px) !important;
   }

   .card-footer {
      background-color: white !important;
   }

   label:not(.form-check-label):not(.custom-file-label) {
      font-size: 13px;
   }

   .content-header {
      display: none;
   }
</style>
<?php
$bank_id = $_SESSION['bank_id'];
if (!empty($_POST['name_reagent'])) {
   // print_r($_POST); die;
   $date = $_POST['date'];
   $name_reagent = $_POST['name_reagent'];
   $lot_no = $_POST['lot_no'];
   $manufactures_date = $_POST['manufactures_date'];
   $expiry_date = $_POST['expiry_date'];
   $Physical = $_POST['Physical'];
   $color_appearance = $_POST['color_appearance'];
   $suspension_cell = $_POST['suspension_cell'];
   $suspension_b_cell = $_POST['suspension_b_cell'];
   $suspension_Rh_pos_cell = $_POST['suspension_Rh_pos_cell'];
   $suspension_Rh_neg_cell = $_POST['suspension_Rh_neg_cell'];
   $total_protein = $_POST['total_protein'];
   $total_albumin = $_POST['total_albumin'];
   $Quality = $_POST['Quality'];
   $bbo = $_POST['bbo'];
   $remark = $_POST['remark'];
   $insert = $this->db->query("INSERT INTO bl_qc_reagents (bloodbank_id , date, name_reagent, lot_no, manufactures_date, expiry_date, Physical, color_appearance,suspension_cell,suspension_b_cell, suspension_Rh_pos_cell,suspension_Rh_neg_cell,total_protein, total_albumin, Quality, bbo, remark) VALUES ('$bank_id' , '$date' , '$name_reagent' , '$lot_no','$manufactures_date','$expiry_date','$Physical','$color_appearance','$suspension_cell','$suspension_b_cell','$suspension_Rh_pos_cell','$suspension_Rh_neg_cell','$total_protein','$total_albumin','$Quality','$bbo','$remark')");
   // echo $this->db->insert_id();die;
   if ($insert == true) {
      // echo 'hiii';
      // die();
      redirect('admin/donations/qc_reagents');
   } else {
      echo "fail";
   }
}
?>
<div class="container ">
   <h1 style="    font-size: 1.5rem;
   font-weight: 700;
   text-align: left;">QC for Reagents</h1>
   <form action="<?php $_PHP_SELF ?>" method="POST">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      <div class="timeline">
         <!-- <div class="time-label">
         <span class="bg-red">Consumables Items</span>
         </div> -->
         <div class="card pl-2 pr-2">
            <div class="card-header">
               <!-- <h3 class="card-title">Register Blood Bank</h3> -->
               <div class="btn-group" style="float: right;">
                  <a href="<?php echo $base_url; ?>/donations/qc_reagents" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
               </div>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label for="vender">Date:</label>
                        <input type="date" class="form-control" id="date" name="date">
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label for="vender">Name of Reagent:</label>
                        <input type="text" class="form-control" id="price" name="name_reagent">
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label for="description">Lot No./Batch No.:</label>
                        <input type="text" class="form-control" id="price" name="lot_no">
                     </div>
                  </div>

               </div>
               <div class="row">
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label for="price">Manufactures Date: </label>
                        <input type="date" class="form-control" id="price" name="manufactures_date">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="description">Expiry Date:</label>
                        <input type="date" class="form-control" id="price" name="expiry_date">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="price">Physical Appearance:</label>
                        <input type="text" class="form-control" id="price" name="Physical">
                     </div>
                  </div>

               </div>
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="description">Colour Appearance:</label>
                        <input type="text" class="form-control" id="price" name="color_appearance">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="price">Agglutination with 50% Cell suspension of A-cell: </label>
                        <input type="text" class="form-control" id="price" name="suspension_cell">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="price">Agglutination with 50% Cell suspension of B-cell: </label>
                        <input type="text" class="form-control" id="price" name="suspension_b_cell">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="price">Agglutination with 50% Cell suspension of Rh +ive Cell: </label>
                        <input type="text" class="form-control" id="price" name="suspension_Rh_pos_cell">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="price">Agglutination with 50% Cell suspension of Rh -ve Cell </label>
                        <input type="text" class="form-control" id="price" name="suspension_Rh_neg_cell">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="vender">Clump size at 2 Mints Total Protein:</label>
                        <input type="text" class="form-control" id="price" name="total_protein">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="description">Time of commencing Agglutination Total Albumin:</label>
                        <input type="text" class="form-control" id="price" name="total_albumin">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="vender">Quality:</label>
                        <input type="text" class="form-control" id="price" name="Quality">
                     </div>
                  </div>

                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="vender">BBO:</label>
                        <input type="text" class="form-control" id="price" name="bbo">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <label for="price">Remark:</label>
                     <input type="text" class="form-control" id="price" name="remark">
                  </div>
                  <div class="col-md-8">
                     <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                           <button type="submit" name="submit" class="btn btn-sm btn-danger"><i class="fas fa-save fw"></i> Save</button>
                        </div>
                     </div>
                  </div>
               </div>


            </div>
         </div>
   </form>
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
         ' ' + [
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