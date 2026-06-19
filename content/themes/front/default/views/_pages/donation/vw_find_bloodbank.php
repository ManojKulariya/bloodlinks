<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
   @media (min-width: 1200px) {
   .col-xl-4.col-lg-6.col-md-4.col-sm-6{
   width: 33.3%;
   }
   }

   .bloodbank-hr{
      width:16%;
      margin:auto;
      border-bottom:2px solid red;
   }
   .find-bank-1{
      background:#faf9fb;
      padding: 51px 12px;
   }
</style>


<div class="find-bank-1">
   <div class="container-">
      <div class="row">
         <div class="col-md-12">
            <h1 class="text-dark text-center">Find Blood Banks</h1>
<hr class="bloodbank-hr">
         </div>
      </div>
   </div>
</div>

<section class="sign-in-page" >
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
               <h2>BloodBank List</h2>
               <hr class="hospital-hr">
            </header>
            <div class="row">
               <div class="col-md-12" style="padding-left: 30px;">
                  <div class="table-responsive">
                     <!-- table -->
                     <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Blood Bank Name</th>
                                <th>Address</th>
                                <th>Phone No.</th>
                                <th>Blood Center Type</th>
                                <th>Details</th>
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

                        $filterConditions = [];
                        $filterText = "";
                        
                        // State filter
                        if (!empty($_GET['filter_state']) && $_GET['filter_state'] != "0") {
                            $state_id = $_GET['filter_state'];
                            $query_state = $this->db->query("SELECT * FROM bl_states WHERE id = '$state_id'");
                            $state = $query_state->result_array();
                            $filterConditions[] = "state = '{$state[0]['state_name']}'";
                        }
                        
                        // City filter
                        if (!empty($_GET['filter_city']) && $_GET['filter_city'] != "0") {
                            $city_id = $_GET['filter_city'];
                            $query_city = $this->db->query("SELECT * FROM bl_districts WHERE id = '$city_id'");
                            $city = $query_city->result_array();
                            $filterConditions[] = "(city = '{$city[0]['district_name']}' OR district = '{$city[0]['district_name']}')";
                        }
                        
                        // Pincode filter
                        if (!empty($_GET['filter_pin'])) {
                            $pin = $_GET['filter_pin'];
                            $filterConditions[] = "pincode = '$pin'";
                        }
                        
                        // Name Search
                        if (!empty($_GET['name'])) {
                            $name = $_GET['name'];
                            $filterConditions[] = "blood_bank_name LIKE '%$name%'";
                        }
                        
                        // Base condition
                        $finalWhere = "status = 1";
                        
                        if (!empty($filterConditions)) {
                            $finalWhere .= " AND (" . implode(" AND ", $filterConditions) . ")";
                        }
                        
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        
                        // Count rows
                        $query_count = $this->db->query("SELECT COUNT(*) as total FROM bl_bloodbank_other WHERE $finalWhere");
                        $total_rows = $query_count->row()->total;
                        
                        // Fetch data
                        $query_other = $this->db->query("
                            SELECT *,
                            (3959 * acos(
                                cos(radians($userLat)) * cos(radians(latitude)) *
                                cos(radians(longitude) - radians($userLong)) +
                                sin(radians($userLat)) * sin(radians(latitude))
                            )) AS distance
                            FROM bl_bloodbank_other
                            WHERE $finalWhere
                            ORDER BY distance ASC
                            LIMIT " . (($page - 1) * $limit) . ", $limit
                        ");
                           foreach ($query_other->result() as $row) { ?>
                           <tr>
                              <td><?php echo $row->blood_bank_name; ?></td>
                              <td><?php echo $row->address; ?></td>
                              <td>
                                  <!--<?php echo $row->mobile; ?>-->
                                  </td>
                              <td><?php echo $row->category; ?></td>
                              <td>  <a class="btn btn-sm btn-success" href="details_bank?id=<?php echo $row->id; ?>">View</a></td>

                              <!--<td><a class="btn btn-success" href="https://www.google.com/maps/@<?php echo $row->latitude; ?>,<?php echo $row->longitude; ?>">Get Direction</a></td>-->
                          
                                <td>
                                <button class="btn btn-success" onclick="getDirections(<?php echo $row->latitude; ?>, <?php echo $row->longitude; ?>)">Get Directions</button>
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
   
</section>
<script type="text/javascript">
      var states_get_url='<?php echo base_url('get_states');?>';
   var districts_get_url='<?php echo base_url('get_districts');?>';
</script>
<script type="text/javascript" src="https://bloodlinks.in/content/themes/front/default/assets/scripts/common.js"></script>
   <script type="text/javascript" src="https://bloodlinks.in/content/themes/front/default/assets/scripts/register.js"></script>