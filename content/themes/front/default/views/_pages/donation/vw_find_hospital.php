<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
   @media (min-width: 1200px) {
   .col-xl-4.col-lg-6.col-md-4.col-sm-6{
   width: 33.3%;
   }
   }
   .find-hospital{
      padding: 58px 10px;
    /* border: 2px solid; */
    background: #faf9fb;
   }
.hospital-hr{
   width:13%;
   margin:auto;
   border-bottom:2px solid red;
}
.find-h1-7{
   font-size:2.5rem;
}
</style>




<div class="find-hospital">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1 class="text-center find-h1-7" style="color: #000;">Find Hospitals</h1>
            <hr class="hospital-hr">
         </div>
      </div>
   </div>
</div>


<section class="sign-in-page my-5">
   <div class="container">
        <form action = "<?php $_PHP_SELF ?>" method = "GET">
               
      <div class="row"> 
          <div class="col-sm-3">
              
                  <div class="form-group">
              
                     <select class="form-control" id="select_states" name="filter_state" style="padding: 0px;margin: 5px;">
                        <option value="0">Select State</option>
                        </select>
                  </div>
            </div>
            <div class="col-sm-3">
              
                  <div class="form-group">
                   
                     <select class="form-control" id="select_districts" name="filter_city" style="padding: 0px;margin: 5px;">
                        <option value="0">Select City</option>
                     </select>
                  </div>
            </div>
            <div class="col-sm-3">
               
                  <div class="form-group">

               
                     <input class="form-control" type="text" name="filter_pin" id="cust_username" autocomplete="off" placeholder="Enter Pincode" style="padding: 0px;margin: 5px;">
                  </div>

            </div>
                  <div class="col-sm-3">
               
                  <div class="form-group">
            
                     <input class="form-control" type="text" name="name" id="cust_username" autocomplete="off" placeholder="Enter Hospital Name" style="padding: 0px;margin: 5px;">
                  </div>

            </div>

            <div class="col-sm-12">
             <div class="form-group" align="right">
               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
               <button type="cancel"   class="col-md-1 btn btn-success">Reset</button>
               <button type="submit"  class="col-md-1 btn btn-success">Filter</button>
             </div>
          
          </div>
       </div>
 </form>
    
      </div>

    <!------------other hospitals ---------------->
   <div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="contact-wrapper">
            <header class="login-cta">
               <h2>Hospital List</h2>
               <hr class="hospital-hr">
            </header>
            <div class="row">
               <div class="col-md-12" style="padding-left: 30px;">
                  <div class="table-responsive">
                     <!-- table -->
                     <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Hospital Name</th>
                                <th>Address</th>
                                <th>Phone No.</th>
                                <th>Hospital Type</th>
                                <th>details</th>
                                <th>Get Direction</th>
                              </tr>
                        </thead>
                        <?php 
                        $userLat = 26.922070;
                            $userLong = 75.778885;
                        $ip = $_SERVER['REMOTE_ADDR'];
                      
                        $url = "http://ip-api.com/json/{$ip}";
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            $response = curl_exec($ch);
                            curl_close($ch);
                        $data = json_decode($response, true);
                        
                        if ($data['status'] === 'success') {
                            $userLat = $data['lat'];
                            $userLong = $data['lon'];
                    
                        } else {
                            echo "Unable to retrieve user location.";
                        }
                        
                            $limit = 25;
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            
                            // Read filters
                            $state_id = $_GET['filter_state'] ?? "";
                            $city_id  = $_GET['filter_city'] ?? "";
                            $pin      = $_GET['filter_pin'] ?? "";
                            $name     = $_GET['name'] ?? "";
                            
                            // Build WHERE query dynamically
                            $where = "status = 1";
                            
                            if ($state_id != "" && $state_id != "0") {
                                $state = $this->db->get_where("bl_states", ["id" => $state_id])->row();
                                $where .= " AND state = '{$state->state_name}'";
                            }
                            
                            if ($city_id != "" && $city_id != "0") {
                                $city = $this->db->get_where("bl_districts", ["id" => $city_id])->row();
                                $where .= " AND city = '{$city->district_name}'";
                            }
                            
                            if ($pin != "") {
                                $where .= " AND pincode = '$pin'";
                            }
                            
                            if ($name != "") {
                                $where .= " AND company_name LIKE '%$name%'";
                            }
                            
                            // Count total rows
                            $query_count = $this->db->query("SELECT COUNT(*) AS total FROM bl_hospital_other WHERE $where");
                            $total_rows = $query_count->row()->total;
                            
                            // Fetch records
                            $offset = ($page - 1) * $limit;
                            
                            $query = $this->db->query("
                                SELECT *, 
                                (3959 * acos(cos(radians($userLat)) * cos(radians(lat)) * 
                                cos(radians(`long`) - radians($userLong)) + sin(radians($userLat)) * sin(radians(lat))))
                                AS distance
                                FROM bl_hospital_other
                                WHERE $where
                                ORDER BY distance ASC
                                LIMIT $offset, $limit
                            ");
                            
                            $hospitals = $query->result();

                           foreach ($hospitals as $row) { ?>
                           <tr>
                              <td><?php echo $row->company_name; ?></td>
                              <td><?php echo $row->address; ?></td>
                              <td><?php echo $row->phone; ?></td>
                              <td><?php echo $row->category; ?></td>
                              <td>  <a class="btn btn-sm btn-success" href="details_hospital?id=<?php echo $row->id; ?>">View</a></td>

                             
                                <td>
                                <button class="btn btn-success" onclick="getDirections(<?php echo $row->lat; ?>, <?php echo $row->long; ?>)">Get Directions</button>
                                </td>
                           </tr>
                        <?php } ?>
                     </table>
                     <?php
                        $total_pages = ceil($total_rows / $limit); // Total number of pages
                        $num_links = 5; // Number of page links to display
                        
                        // Calculate the range of page links to display
                        $start = max($page - floor($num_links / 2), 1);
                        $end = min($start + $num_links - 1, $total_pages);
                        $start = max($end - $num_links + 1, 1);
                        $urlFilters = "";
                        if (!empty($_GET['filter_state'])) {
                           $urlFilters .= "&filter_state=" . $_GET['filter_state'];
                        }
                        if (!empty($_GET['filter_city'])) {
                           $urlFilters .= "&filter_city=" . $_GET['filter_city'];
                        }
                        if (!empty($_GET['filter_pin'])) {
                           $urlFilters .= "&filter_pin=" . $_GET['filter_pin'];
                        }
                        if (!empty($_GET['name'])) {
                           $urlFilters .= "&name=" . $_GET['name'];
                        }
                        ?>
                     <div class="pagination" style="margin-top: 10px;">
                        <?php
                           if ($page > 1) {
                              echo '<a href="?page=' . ($page - 1).$urlFilters. '">Previous</a>';
                           }
                           for ($i = $start; $i <= $end; $i++) {
                              echo '<a href="?page=' . $i.$urlFilters. '">' . $i . '</a>';
                           }
                           if ($page < $total_pages) {
                              echo '<a href="?page=' . ($page + 1).$urlFilters. '">Next</a>';
                           }
                        ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
  function getDirections(latitude, longitude) {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var currentLatitude = position.coords.latitude;
        var currentLongitude = position.coords.longitude;

        var url = "https://www.google.com/maps/dir/" + currentLatitude + "," + currentLongitude + "/" + latitude + "," + longitude;
        window.open(url, "_blank");
      }, function(error) {
        // Handle error (e.g., user denied geolocation access)
        console.log(error.message);
      });
    } else {
      // Geolocation is not supported by the browser
      console.log("Geolocation is not supported");
    }
  }
 
</script>

<style>
   .pagination a {
      display: inline-block;
      padding: 5px 10px;
      margin-right: 5px;
      background-color: #f0f0f0;
      color: #333;
      text-decoration: none;
      border-radius: 3px;
   }
   
   .pagination a:hover {
      background-color: #ccc;
   }
   
   .pagination a:active,
   .pagination a.active {
      background-color: #333;
      color: #fff;
   }
</style>

    <!--------- end other hospitals--------------->
   </div>
</section>
<br>

<script type="text/javascript" language="javascript" >
   $(document).ready(function(){
   
    fill_datatable();
   
    function fill_datatable(filter_city = '', filter_pin = '')
    {
      var base_url = $('#protocol').val();
     var dataTable = $('#customer_data').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "searching" : false,
      "ajax" : {
       url:base_url+"/filter-locations.php",
       type:"POST",
       data:{
        filter_city:filter_city, filter_pin:filter_pin
       }
      }
     });
    }
   
    
    $('#filter').click(function(){
     var filter_city = $('#filter_city').val();
     var filter_pin = $('#filter_pin').val();
     if(filter_city != '' && filter_pin != '')
     {
      $('#customer_data').DataTable().destroy();
      fill_datatable(filter_city, filter_pin);
     }
     else
     {
      alert('Select Both filter option');
      $('#customer_data').DataTable().destroy();
      fill_datatable();
     }
    });
    
    $('#reset-filter').on('click', function(){
      $('#customer_data').DataTable().destroy();
      fill_datatable('', '');
    });
   });
   
   
</script>

<script type="text/javascript">
   $('#closemodal').modal('hide');
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
      var states_get_url='<?php echo base_url('get_states');?>';
   var districts_get_url='<?php echo base_url('get_districts');?>';
</script>
<script type="text/javascript" src="https://bloodlinks.in/content/themes/front/default/assets/scripts/common.js"></script>
   <script type="text/javascript" src="https://bloodlinks.in/content/themes/front/default/assets/scripts/register.js"></script>
