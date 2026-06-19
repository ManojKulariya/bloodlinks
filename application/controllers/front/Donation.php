<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */
class Donation  extends BaseFrontController
{
   public function add_bloodbank()
   {

      //print_obj($userdata);die;

      $this->data['page_title'] = 'Add Blood Bank';
      # Captcha Code
        $captcha = $this->generate_captcha();
        $this->data['captcha_image'] = $captcha['image'];
        $this->data['captcha_word'] = $captcha['word'];
        #--------------------------

      $this->theme->title($this->data['page_title'])->load('donation/vw_add_bloodbank', $this->data);
   }
    public function update_availablity()
    {
      $Data = json_decode(file_get_contents('php://input'), true);
      
      if (empty($Data['user_id'])) {
        $result['status'] = false;
        $result['error'] = 'The user_id field is required.';
            return json_headers($result);
        }
        $id = $Data['user_id'];
        //   $update = $this->db->query("UPDATE bl_customers SET available = '' WHERE id = '$id'");
      $update = $this->db->query("UPDATE bl_customers SET available = IF(available = 1, 0, 1) WHERE user_id = '$id'");

      if ($update) {
          $query = $this->db->query("SELECT user_id, available FROM bl_customers WHERE user_id = ?", [$id]);
          $updatedData = $query->row_array(); // Fetch the updated row as an associative array

         $result['status'] = true;
         $result['message'] = 'Donor availablity successfully !';
         $result['data'] = $updatedData;
      } else {
         $result['status'] = false;
         $result['error'] = 'Donor availablity fail!';
      }
      return json_headers($result);
    }
   public function hospital_list_v2()
    {
        $Data = json_decode(file_get_contents('php://input'), true);
    
        $pin   = isset($Data['filter_pin']) ? $Data['filter_pin'] : '';
        $city  = isset($Data['filter_city']) ? $Data['filter_city'] : '';
        $limit = isset($Data['limit']) ? (int)$Data['limit'] : 10;
        $page  = isset($Data['page']) ? (int)$Data['page'] : 1;
        $offset = ($page - 1) * $limit;
    
        $user_lat = isset($Data['user_lat']) ? $Data['user_lat'] : null;
        $user_lng = isset($Data['user_lng']) ? $Data['user_lng'] : null;
    
        // Base query
        $select = "SELECT bl_hospital_other.*";
        
        if ($user_lat && $user_lng) {
            $select .= ", (
                6371 * acos(
                    cos(radians($user_lat)) * cos(radians(lat)) *
                    cos(radians(`long`) - radians($user_lng)) +
                    sin(radians($user_lat)) * sin(radians(lat))
                )
            ) AS distance";
        }
    
        $sql = "$select FROM bl_hospital_other WHERE keyword = 'Hospital'";
    
        // Filters
        if (!empty($pin)) {
            $sql .= " AND pincode LIKE '%" . $this->db->escape_like_str($pin) . "%'";
        }
    
        if (!empty($city)) {
            $sql .= " AND city LIKE '%" . $this->db->escape_like_str($city) . "%'";
        }
    
        // Sort by distance if lat/lng available
        if ($user_lat && $user_lng) {
            $sql .= " ORDER BY distance ASC";
        }
    
        // Pagination
        $sql .= " LIMIT $offset, $limit";
    
        $result = $this->db->query($sql)->result_array();
    
        return json_headers($result);
    }
    
    public function blood_bank_list_v2()
    {
        $Data = json_decode(file_get_contents('php://input'), true);
    
        $pin   = isset($Data['filter_pin']) ? $Data['filter_pin'] : '';
        $city  = isset($Data['filter_city']) ? $Data['filter_city'] : '';
        $limit = isset($Data['limit']) ? (int)$Data['limit'] : 10;
        $page  = isset($Data['page']) ? (int)$Data['page'] : 1;
        $offset = ($page - 1) * $limit;
    
        $user_lat = isset($Data['user_lat']) ? $Data['user_lat'] : null;
        $user_lng = isset($Data['user_lng']) ? $Data['user_lng'] : null;
    
        // Base query
        $select = "SELECT bl_bloodbank_other.*";
        
        if ($user_lat && $user_lng) {
            $select .= ", (
                6371 * acos(
                    cos(radians($user_lat)) * cos(radians(latitude)) *
                    cos(radians(`longitude`) - radians($user_lng)) +
                    sin(radians($user_lat)) * sin(radians(latitude))
                )
            ) AS distance";
        }
    
        $sql = "$select FROM bl_bloodbank_other WHERE status = '1'";
    
        // Filters
        if (!empty($pin)) {
            $sql .= " AND pincode LIKE '%" . $this->db->escape_like_str($pin) . "%'";
        }
    
        if (!empty($city)) {
            $sql .= " AND city LIKE '%" . $this->db->escape_like_str($city) . "%'";
        }
    
        // Sort by distance if lat/lng available
        if ($user_lat && $user_lng) {
            $sql .= " ORDER BY distance ASC";
        }
    
        // Pagination
        $sql .= " LIMIT $offset, $limit";
    
        $result = $this->db->query($sql)->result_array();
    
        return json_headers($result);
    }
    public function lab_list_v2()
    {
        // Get input (if any)
        $Data = json_decode(file_get_contents('php://input'), true);
    
        // Use query builder for safety and clarity
        $this->db->select('bl_blood_banks.*, bl_cities.city_name');
        $this->db->from('bl_blood_banks');
        $this->db->join('bl_cities', 'bl_blood_banks.city_id = bl_cities.id');
        $this->db->where('bl_blood_banks.org_type', 'Blood Bank');
    
        if (!empty($Data['filter_pin'])) {
            $this->db->where('bl_blood_banks.pincode', $Data['filter_pin']);
        }
    
        // if (!empty($Data['filter_city'])) {
        //     $this->db->where('bl_cities.city_name', $Data['filter_city']);
        // }
        // return $Data['filter_city'];
        if (!empty($Data['filter_city'])) {
            $this->db->like('bl_cities.city_name', $Data['filter_city']);
        }
    
        $lablist = $this->db->get()->result_array();
    
        return json_headers($lablist);
    }
   public function search_donor_list()
    {
        $latitude = $this->input->get('latitude');
        $longitude = $this->input->get('longitude');
        $radius = $this->input->get('radius') ?? 100; // Default radius is 10 km
        $page = $this->input->get('page') ?? 1;
        $limit = 5; // Number of records per page
        $offset = ($page - 1) * $limit;
        $blood_group_filter = $this->input->get('blood_group');
    
        if ($latitude && $longitude) {
            // Get paginated donor list
            $this->db->select("id, user_id, first_name,last_name, lat, lang, blood_group, dob,ph_no ,TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS age,
                (6371 * ACOS(COS(RADIANS($latitude)) * COS(RADIANS(lat)) * 
                COS(RADIANS(lang) - RADIANS($longitude)) + 
                SIN(RADIANS($latitude)) * SIN(RADIANS(lat)))) AS distance");
            $this->db->from('bl_customers');
            $this->db->where('blood_group !=', '0');
            if (!empty($blood_group_filter)) {
                $this->db->where('blood_group', $blood_group_filter); // Apply blood group filter
            }
            $this->db->having('distance <=', $radius);
            $this->db->order_by('distance', 'ASC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
    
            $result = $query->result();
            // Fetch blood group names separately
    			$this->db->select('master_id as id , master_type_key_value');
    			$this->db->from('bl_masters');
    			$blood_groups_query = $this->db->get();
    			$blood_groups = $blood_groups_query->result();
    	
    			// Convert blood group data into an associative array (id => name)
    			$blood_group_map = [];
    			foreach ($blood_groups as $bg) {
    				$blood_group_map[$bg->id] = $bg->master_type_key_value;
    			}
            $donors = [];
    			foreach ($result as $row) {
    				$donors[] = [
    					'id' => $row->id,
    					'user_id' => $row->user_id,
    					'first_name' => $row->first_name,
    					'last_name' => $row->last_name,
    					'lat' => $row->lat,
    					'lang' => $row->lang,
    					'blood_group' => $row->blood_group,
    					'blood_group_name' => $blood_group_map[$row->blood_group] ?? 'Unknown', // Map blood group name
    					'dob' => $row->dob,
    					'age' => $row->age,
    					'ph_no' => $row->ph_no,
    					'distance' => round($row->distance, 2) . ' km'
    				];
    			}
            // Get total count with same distance filter
            $this->db->select("COUNT(*) as total");
            $this->db->from("(SELECT id,
                (6371 * ACOS(COS(RADIANS($latitude)) * COS(RADIANS(lat)) * 
                COS(RADIANS(lang) - RADIANS($longitude)) + 
                SIN(RADIANS($latitude)) * SIN(RADIANS(lat)))) AS distance 
                FROM bl_customers WHERE blood_group != '0'" . (!empty($blood_group_filter) ? " AND blood_group = " . $this->db->escape($blood_group_filter) : "") . ") as subquery");
            // $this->db->where('blood_group !=', '0');
            $this->db->where('distance <=', $radius);
            $total_query = $this->db->get();
            $total_records = $total_query->row()->total ?? 0;
    
            return json_headers([
                'status' => true,
                'message' => 'Donor list fetched successfully',
                'data' => $donors,
                'pagination' => [
                    'current_page' => (int)$page,
                    'total_pages' => ceil($total_records / $limit),
                    'total_records' => $total_records
                ]
            ]);
        } else {
            return json_headers([
                'status' => false,
                'message' => 'Latitude and longitude are required'
            ]);
        }
    }
   public function details_hospital()
   {
      $id = $this->input->get('id');

      $query_count = $this->db->query("SELECT * FROM bl_hospital_other WHERE id = '$id'");
      $result =  $query_count->result_array();
      if (count($result) == 0) {
            redirect(base_url());
            exit;
        }
      $this->data['page_title'] = 'Hospital details';
      $this->theme->title($this->data['page_title'])->load('donation/hp_detail_page', array('data' => $this->data, 'detail_data' => $result));
   }
   public function details_bank()
   {
      $id = $this->input->get('id');

      $query_count = $this->db->query("SELECT * FROM bl_bloodbank_other WHERE id = '$id'");
      $result =  $query_count->result_array();
      // If ID exists but NO RESULT → redirect
        if (count($result) == 0) {
            redirect(base_url());
            exit;
        }

      $this->data['page_title'] = 'BloodBank details';
      $this->theme->title($this->data['page_title'])->load('donation/bb_detail_page', array('data' => $this->data, 'detail_data' => $result));
   }
   public function get_hp_data()
   {
      $userLat = $this->input->get('user_lat');
      $userLong = $this->input->get('user_long');
      $limit = 25;
      $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number, passed via query parameter

      // Calculate total rows
      $query_count = $this->db->query("SELECT COUNT(*) as total FROM bl_hospital_other WHERE status = 1");
      $total_rows = $query_count->row()->total;

      // Calculate the offset for the current page
      $offset = ($page - 1) * $limit;

      // Retrieve data for the current page and sort by proximity
      $query_other = $this->db->query("SELECT *,
        (3959 * acos(cos(radians($userLat)) * cos(radians(lat)) * cos(radians(`long`) - radians($userLong)) + sin(radians($userLat)) * sin(radians(lat))))
        AS distance
        FROM bl_hospital_other
        WHERE status = 1
        ORDER BY distance ASC
        LIMIT $offset, $limit");

      // ... (rest of the code)

      $total_pages = ceil($total_rows / $limit); // Total number of pages

      // Generate the pagination HTML
      $pagination = '';
      if ($total_pages > 1) {
         $pagination .= '<ul class="pagination">';
         if ($page > 1) {
            $pagination .= '<li><a href="' . ($page - 1) . '">Previous</a></li>';
         }
         for ($i = 1; $i <= $total_pages; $i++) {
            $activeClass = ($page == $i) ? 'active' : '';
            $pagination .= '<li class="' . $activeClass . '"><a href="' . $i . '">' . $i . '</a></li>';
         }
         if ($page < $total_pages) {
            $pagination .= '<li><a href="' . ($page + 1) . '">Next</a></li>';
         }
         $pagination .= '</ul>';
      }

      $response = [
         'table_html' => $html,
         'pagination_html' => $pagination
      ];

      header('Content-Type: application/json');
      echo json_encode($response);
      exit();
   }

   public function add_hospital()
   {

      $this->data['page_title'] = 'Add Hospital';
      # Captcha Code
        $captcha = $this->generate_captcha();
        $this->data['captcha_image'] = $captcha['image'];
        $this->data['captcha_word'] = $captcha['word'];
        #--------------------------

      $this->theme->title($this->data['page_title'])->load('donation/vw_add_hospital', $this->data);
   }
   public function add_lab()
   {

      $this->data['page_title'] = 'Add Lab';
      # Captcha Code
      $captcha = $this->generate_captcha();
      $this->data['captcha_image'] = $captcha['image'];
      $this->data['captcha_word'] = $captcha['word'];
      #--------------------------

      $this->theme->title($this->data['page_title'])->load('donation/vw_add_lab', $this->data);
   }
   public function add_camps()
   {

      $this->data['page_title'] = 'Add Blood Camps';

      $this->theme->title($this->data['page_title'])->load('donation/vw_add_camps', $this->data);
   }

   public function find_bloodbank()
   {

      $this->data['page_title'] = 'Find Blood Bank';

      $this->theme->title($this->data['page_title'])->load('donation/vw_find_bloodbank', $this->data);
   }
   public function find_hospital()
   {

      $this->data['page_title'] = 'Find Hospital';

      $this->theme->title($this->data['page_title'])->load('donation/vw_find_hospital', $this->data);
   }
   public function find_lab()
   {

      $this->data['page_title'] = 'Find Lab';

      $this->theme->title($this->data['page_title'])->load('donation/vw_find_lab', $this->data);
   }
   public function find_camp()
   {

      $this->data['page_title'] = 'Find Camp';

      $this->theme->title($this->data['page_title'])->load('donation/vw_find_camp', $this->data);
   }
   public function indexRequest()
   {

      if (session_userdata('isUserLoggedin')) {
         $userdata = $this->userdata;

         //print_obj($userdata);die;

         $this->data['page_title'] = 'Request for Blood Donation';



         $this->theme->title($this->data['page_title'])->load('donation/vw_request_form', $this->data);
      } else {
         redirect(base_url('signin'));
      }
   }

   public function onLoadDonarRegistrationForm()
   {
      if (session_userdata('isUserLoggedin') == TRUE && session_userdata('user_id')) {
         if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

            $userdata = $this->userdata;
            $form_no = post_data('form_type');

            $_form_data = array();

            $get_donar_form_data = $this->dm->get_donar_form_data(array('user_id' => $userdata->user_id, 'form_step' => $form_no));

            if (!empty($get_donar_form_data)) {
               $_form_data = json_decode($get_donar_form_data->detail);
            }

            $this->data['form_data'] = $_form_data;

            if ($form_no == 'step_1') {

               $_p_dif = array();
               $_r_dif = array();
               $_g_dif = array();
               $_last_2_week_dif = array();
               $_last_3_month_dif = array();

               $_med = array();
               $_vaccines = array();

               $p_dif = $this->dm->get_differs(array('defer_type' => 'permanent'), FALSE);

               $r_dif = $this->dm->get_differs(array('defer_type' => 'recent_6_month'), FALSE);

               $last_2_week_dif = $this->dm->get_differs(array('defer_type' => 'recent_2_weeks'), FALSE);

               $last_3_month_dif = $this->dm->get_differs(array('defer_type' => 'recent_3_month'), FALSE);

               $last_12_month_dif = $this->dm->get_differs(array('defer_type' => 'recent_12_month'), FALSE);

               $g_dif = $this->dm->get_differs(array('defer_type' => 'general'), FALSE);

               $med = $this->dm->get_medicines(array('status' => 'active'), FALSE);

               $vaccines = $this->dm->get_vaccines(array('status' => 'active'), FALSE);

               if (!empty($p_dif)) {
                  $total = count($p_dif) / 2;
                  $_p_dif = array_chunk($p_dif, $total);
               }

               if (!empty($r_dif)) {
                  $rtotal = count($r_dif) / 2;
                  $_r_dif = array_chunk($r_dif, $rtotal);
               }

               if (!empty($g_dif)) {
                  $gtotal = count($g_dif) / 2;
                  $_g_dif = array_chunk($g_dif, $gtotal);
               }

               if (!empty($last_2_week_dif)) {
                  $l2wtotal = count($last_2_week_dif) / 2;
                  $_last_2_week_dif = array_chunk($last_2_week_dif, $l2wtotal);
               }

               if (!empty($last_3_month_dif)) {
                  $l3mtotal = count($last_3_month_dif) / 2;
                  $_last_3_month_dif = array_chunk($last_3_month_dif, $l3mtotal);
               }


               if (!empty($last_12_month_dif)) {
                  $l12mtotal = count($last_12_month_dif) / 2;
                  $_last_12_month_dif = array_chunk($last_12_month_dif, $l12mtotal);
               }

               if (!empty($med)) {
                  $mtotal = count($med) / 2;
                  $_med = array_chunk($med, $mtotal);
               }

               if (!empty($vaccines)) {
                  $vtotal = count($vaccines) / 2;
                  $_vaccines = array_chunk($vaccines, $vtotal);
               }

               $this->data['permanent_differs'] = $_p_dif;
               $this->data['recent_differs'] = $_r_dif;
               $this->data['general_differs'] = $_g_dif;
               $this->data['last_2_week_dif'] = $_last_2_week_dif;
               $this->data['last_3_month_dif'] = $_last_3_month_dif;
               $this->data['last_12_month_dif'] = $_last_12_month_dif;
               $this->data['medicines'] = $_med;
               $this->data['vaccines'] = $_vaccines;
               $this->data['step_no'] = '1';
               $this->data['step'] = 'step_1';

               $form = '_pages/donation/vw_request_form_1';
            } else if ($form_no == 'step_2') {

               if ($userdata->gender == 'female') {
                  $form = '_pages/donation/vw_request_form_2';
               } else {
                  $form = '_pages/donation/vw_request_form_3';
               }

               $this->data['current_step'] = 'step_2';
               $this->data['step_no'] = '2';
               $this->data['step'] = 'step_3';
               $this->data['step_back'] = 'step_1';
            } else if ($form_no == 'step_3') {
               if ($userdata->gender == 'female') {
                  $form = '_pages/donation/vw_request_form_3';
               } else {
                  $form = '_pages/donation/vw_request_form_4';
               }
               $this->data['current_step'] = 'step_3';
               $this->data['step_no'] = '3';
               $this->data['step'] = ($userdata->gender == 'female') ? 'step_4' : 'step_3';
               $this->data['step_back'] = ($userdata->gender == 'female') ? 'step_3' : 'step_2';
               // $form='_pages/donation/vw_request_form_3';

            } else if ($form_no == 'step_4') {
               if ($userdata->gender == 'female') {
                  $form = '_pages/donation/vw_request_form_4';
               } else {
                  $form = '_pages/donation/vw_request_form_5';
               }
               $this->data['current_step'] = 'step_4';
               $this->data['step_no'] = '4';
               $this->data['step'] = ($userdata->gender == 'female') ? 'step_5' : 'step_4';
               $this->data['step_back'] = ($userdata->gender == 'female') ? 'step_4' : 'step_3';
            } else if ($form_no == 'step_5') {
               if ($userdata->gender == 'female') {
                  $form = '_pages/donation/vw_request_form_5';
               } else {
                  // $form='_pages/donation/vw_request_form_5';
               }
               $this->data['current_step'] = 'step_5';
               $this->data['step_no'] = '5';

               // $form='_pages/donation/vw_request_form_3';
            } else if ($form_no == 'step_5') {
               $c_c_value = array();
               $_c_c_value = array();
               $_c_c = array();
               $__c_c = array();
               $_c = array();
               $concents = $this->dm->get_concents_data(array('status' => 'active', 'parent_id' => NULL), FALSE);

               if (!empty($concents)) {

                  //print_obj($_form_data->informed_concent);
                  foreach ($concents as $key => $value) {

                     if (!empty($value->concent_value_choice)) {
                        $c_c_value = unserialize($value->concent_value_choice);
                     } else {
                        $c_c_value = array();
                     }

                     $child_consents = $this->dm->get_concents_data(array('status' => 'active', 'parent_id' => $value->id), FALSE);

                     if (!empty($child_consents)) {
                        foreach ($child_consents as $k => $v) {

                           $_child_consents = $this->dm->get_concents_data(array('status' => 'active', 'parent_id' => $v->id), FALSE);

                           foreach ($_child_consents as $_k => $_v) {

                              if (!empty($_v->concent_value_choice)) {
                                 $__c_c_value = unserialize($_v->concent_value_choice);
                              } else {
                                 $__c_c_value = array();
                              }

                              $__c_c[] = array(
                                 'consent_id' => $_v->id,
                                 'consent_pid' => $_v->parent_id,
                                 'consent_value' => $_v->concent_value,
                                 'consent_choice' => $__c_c_value,
                                 'concent_highlihted' => $_v->consent_highlight
                              );
                           }


                           if (!empty($v->concent_value_choice)) {
                              $_c_c_value = unserialize($v->concent_value_choice);
                           } else {
                              $_c_c_value = array();
                           }

                           $_c_c[] = array(
                              'consent_id' => $v->id,
                              'consent_pid' => $v->parent_id,
                              'consent_value' => $v->concent_value,
                              'consent_choice' => $_c_c_value,
                              'concent_highlihted' => $v->consent_highlight,
                              'consent_child' => $__c_c
                           );
                        }
                     }

                     $_c[] = array(
                        'consent_id' => $value->id,
                        'consent_pid' => $value->parent_id,
                        'consent_value' => $value->concent_value,
                        'consent_choice' => $c_c_value,
                        'concent_highlihted' => $value->consent_highlight,
                        'consent_child' => $_c_c
                     );
                  }

                  //die;


               }


               $this->data['consents'] = $_c;
               $this->data['current_step'] = 'step_4';
               $this->data['step_no'] = '4';
               $this->data['step'] = ($userdata->gender == 'female') ? 'step_4' : 'step_3';
               $this->data['step_back'] = ($userdata->gender == 'female') ? 'step_3' : 'step_2';
               $form = '_pages/donation/vw_request_form_4';
            }


            $return['html'] = $this->theme->view($form, $this->data, true);

            return json_headers($return);
         } else {
            redirect(base_url('signin'));
         }
      } else {
         redirect(base_url('signin'));
      }
   }


   public function onSubmitDonarRegistrationForm()
   {


      if (session_userdata('isUserLoggedin') == TRUE && session_userdata('user_id')) {
         // print_r($_SESSION); die();
         if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

            $userdata = $this->userdata;

            $post = $this->input->post();

            if (!empty($post)) {
               // print_r($_POST); die();

               $step = clean_data($post['step_data']);
               // print_r($step);
               $perm_defer = false;
               $temp_defer = false;
               $vacc_defer = false;

               if ($step == 'step_1') {
                  //echo "yes";die;
                  $dts = clean_data($post['donation_time_selection']);

                  if ($dts == 'today') {
                     $dts_data = array(
                        'well_feeling' => clean_data($post['well_feeling']),
                        'fed_in_last_4_hrs' => clean_data($post['fed_in_last_4_hrs']),
                        'well_slept_last_night' => clean_data($post['well_slept_last_night'])
                     );
                  } else {
                     $dts_data = array();
                  }
                  $aa = json_encode($dts_data);
                  $hpd = clean_data($post['has_prev_donation']);

                  if ($hpd == 'yes') {
                     $hpd_data = array(
                        'prev_donation_date' => clean_data($post['prev_donation_date']),
                        'prev_donation_bloodbank' => clean_data($post['prev_donation_bloodbank']),
                        'prev_donation_city' => clean_data($post['prev_donation_city']),
                        'prev_donation_times' => clean_data($post['prev_donation_times'])
                     );
                  } else {
                     $hpd_data = array();
                  }

                  $hdpd = clean_data($post['has_discomfort_post_donation']);

                  $hirb = clean_data($post['has_infect_reason_believed']);

                  $hgdy = clean_data($post['has_general_differs']);

                  if ($hgdy == 'yes') {
                     $temp_defer = true;
                     $general_differs = $post['general_differs'];
                     if (!empty($general_differs)) {
                        // print_r($general_differs);die();
                        foreach ($general_differs as $key => $value) {
                           $hgdy_data[] = $value;
                        }
                     } else {
                        $hgdy_data = array();
                     }
                  } else {
                     $hgdy_data = array();
                  }

                  $htm = clean_data($post['has_taken_medicines']);

                  if ($htm == 'yes') {
                     $medicines_taken = $post['medicines_taken'];
                     if (!empty($medicines_taken)) {
                        foreach ($medicines_taken as $key => $value) {
                           $htm_data[] = $value;
                        }
                     } else {
                        $htm_data = array();
                     }
                  } else {
                     $htm_data = array();
                  }

                  $hv = clean_data($post['has_vaccinated']);

                  if ($hv == 'yes') {
                     $vacc_defer = true;
                     $vaccinated_with = $post['vaccinated_with'];
                     if (!empty($vaccinated_with)) {
                        foreach ($vaccinated_with as $key => $value) {
                           $hv_data[] = $value;
                        }
                     } else {
                        $hv_data = array();
                     }
                  } else {
                     $hv_data = array();
                  }

                  $hl2wd = clean_data($post['has_last_2_week_differs']);

                  if ($hl2wd == 'yes') {
                     $temp_defer = true;
                     $weeked_differs = $post['weeked_differs'];
                     if (!empty($weeked_differs)) {
                        foreach ($weeked_differs as $key => $value) {
                           $hl2wd_data[] = $value;
                        }
                     } else {
                        $hl2wd_data = array();
                     }
                  } else {
                     $hl2wd_data = array();
                  }

                  $hl3md = clean_data($post['has_last_3_month_differs']);

                  if ($hl3md == 'yes') {
                     $temp_defer = true;
                     $three_months_differs = $post['three_months_differs'];
                     if (!empty($three_months_differs)) {
                        foreach ($three_months_differs as $key => $value) {
                           $hl3md_data[] = $value;
                        }
                     } else {
                        $hl3md_data = array();
                     }
                  } else {
                     $hl3md_data = array();
                  }

                  $hrd = clean_data($post['has_recent_difers']);

                  if ($hrd == 'yes') {
                     $temp_defer = true;
                     $six_months_differs = $post['six_months_differs'];
                     if (!empty($six_months_differs)) {
                        foreach ($six_months_differs as $key => $value) {
                           $hrd_data[] = $value;
                        }
                     } else {
                        $hrd_data = array();
                     }
                  } else {
                     $hrd_data = array();
                  }


                  $hl12md = clean_data($post['has_last_12_month_differs']);

                  if ($hl12md == 'yes') {
                     $temp_defer = true;
                     $twelve_months_diffres = $post['twelve_months_diffres'];
                     if (!empty($twelve_months_diffres)) {
                        foreach ($twelve_months_diffres as $key => $value) {
                           $hl12md_data[] = $value;
                        }
                     } else {
                        $hl12md_data = array();
                     }
                  } else {
                     $hl12md_data = array();
                  }

                  $hprd = clean_data($post['has_perm_differ']);

                  if ($hprd == 'yes') {
                     $perm_defer = true;
                     $permanent_differs = $post['permanent_differs'];
                     if (!empty($permanent_differs)) {
                        foreach ($permanent_differs as $key => $value) {
                           $hprd_data[] = $value;
                        }
                     } else {
                        $hprd_data = array();
                     }
                  } else {
                     $hprd_data = array();
                  }

                  $data_to_store = array(
                     'donation_time_selection' => array('ans' => $dts, 'ans_data' => $aa),
                     'has_prev_donation' => array('ans' => $hpd, 'ans_data' => $hpd_data),
                     'has_discomfort_post_donation' => array('ans' => $hdpd, 'ans_data' => array()),
                     'has_infect_reason_believed' => array('ans' => $hirb, 'ans_data' => array()),
                     'has_general_differs' => array('ans' => $hgdy, 'ans_data' => $hgdy_data),
                     'has_taken_medicines' => array('ans' => $htm, 'ans_data' => $htm_data),
                     'has_vaccinated' => array('ans' => $hv, 'ans_data' => $hv_data),
                     'has_last_2_week_differs' => array('ans' => $hl2wd, 'ans_data' => $hl2wd_data),
                     'has_last_3_month_differs' => array('ans' => $hl3md, 'ans_data' => $hl3md_data),
                     'has_recent_difers' => array('ans' => $hrd, 'ans_data' => $hrd_data),
                     'has_last_12_month_differs' => array('ans' => $hl12md, 'ans_data' => $hl12md_data),
                     'has_perm_differ' => array('ans' => $hprd, 'ans_data' => $hprd_data)
                  );

                  $details = json_encode($data_to_store);


                  $_data_to_store = array(
                     'user_id' => $userdata->user_id,
                     'form_id' => $_SESSION['form_id'],
                     'form_step' => $step,
                     'detail' => $details
                  );


                  // $get_donar_form_data=$this->dm->get_donar_form_data(array('form_step'=>$step,'user_id'=>$userdata->user_id));

                  // if(empty($get_donar_form_data)){
                  $added = $this->dm->store_donar_form_data($_data_to_store);
                  // }else{
                  //     $added=$this->dm->update_donar_form_data($_data_to_store,array('form_step'=>$step,'user_id'=>$userdata->user_id));
                  // }


                  if ($added) {

                     $differ_data = array(
                        'Temporary Defer' => array(
                           'has_general_differs' => array('ans' => $hgdy, 'ans_data' => $hgdy_data),
                           'has_taken_medicines' => array('ans' => $htm, 'ans_data' => $htm_data),
                           'has_vaccinated' => array('ans' => $hv, 'ans_data' => $hv_data),
                           'has_last_2_week_differs' => array('ans' => $hl2wd, 'ans_data' => $hl2wd_data),
                           'has_last_3_month_differs' => array('ans' => $hl3md, 'ans_data' => $hl3md_data),
                           'has_recent_difers' => array('ans' => $hrd, 'ans_data' => $hrd_data),
                           'has_last_12_month_differs' => array('ans' => $hl12md, 'ans_data' => $hl12md_data)
                        ),
                        'Permanent Dfere' => array(
                           'has_perm_differ' => array('ans' => $hprd, 'ans_data' => $hprd_data)
                        )
                     );

                     if ($temp_defer == true && $perm_defer == true) {
                        $blood_donation_defers = array('user_id' => $userdata->user_id, 'requst_id' => '', 'defer_permanent' => 'yes', 'defer_temporary' => 'yes', 'defer_reasons' => json_encode($differ_data));
                     } else if ($temp_defer == true && $perm_defer == false) {
                        $blood_donation_defers = array('user_id' => $userdata->user_id, 'requst_id' => '', 'defer_permanent' => 'no', 'defer_temporary' => 'yes', 'defer_reasons' => json_encode($differ_data));
                     } else if ($temp_defer == false && $perm_defer == true) {
                        $blood_donation_defers = array('user_id' => $userdata->user_id, 'requst_id' => '', 'defer_permanent' => 'yes', 'defer_temporary' => 'no', 'defer_reasons' => json_encode($differ_data));
                     } else if ($temp_defer == false && $perm_defer == false) {
                        $blood_donation_defers = array('user_id' => $userdata->user_id, 'requst_id' => '', 'defer_permanent' => 'no', 'defer_temporary' => 'no');
                     }

                     $get_blood_donation_defers_data = $this->dm->get_blood_donation_defers_data(array('user_id' => $userdata->user_id));

                     if (!empty($get_blood_donation_defers_data)) {
                        $this->dm->delete_blood_donation_defers_data(array('user_id' => $userdata->user_id));
                     }

                     $this->dm->store_blood_donation_defers_data($blood_donation_defers);

                     $return['step'] = 'step_2';
                     $return['step_no'] = '2';
                     $return['step_back'] = 'step_1';
                  } else {
                     $return['error'] = 'Data not saved';
                  }
               } else if ($step == 'step_2') {
                  if ($userdata->gender == 'female') {

                     $data_to_store = array(
                        'has_pregnant' => array('ans' => clean_data($post['has_pregnant']), 'ans_data' => array()),
                        'has_abortion' => array('ans' => clean_data($post['has_abortion']), 'ans_data' => array()),
                        'last_menstrual_period' => array('ans' => '', 'ans_data' => clean_data($post['last_menstrual_period'])),
                        'has_breast_feeden_last_12_month' => array('ans' => clean_data($post['has_breast_feeden_last_12_month']), 'ans_data' => array()),
                        'has_child_less_one_year' => array('ans' => clean_data($post['has_child_less_one_year']), 'ans_data' => array())
                     );

                     $details = json_encode($data_to_store);
                     //print_r($details);die;
                     $_data_to_store = array(
                        'user_id' => $userdata->user_id,
                        'form_id' => $_SESSION['form_id'],
                        'form_step' => $step,
                        'detail' => $details
                     );


                     // $get_donar_form_data=$this->dm->get_donar_form_data(array('form_step'=>$step,'user_id'=>$userdata->user_id));

                     // if(empty($get_donar_form_data)){
                     $added = $this->dm->store_donar_form_data($_data_to_store);
                     // }else{
                     //     $added=$this->dm->update_donar_form_data($_data_to_store,array('form_step'=>$step,'user_id'=>$userdata->user_id));
                     // }


                     if ($added) {
                        $return['step'] = 'step_3';
                        $return['step_no'] = '3';
                        $return['step_back'] = 'step_1';
                     } else {
                        $return['error'] = 'Data not saved';
                     }
                  } else {

                     $data_to_store = array(
                        'has_safe_sex' => array('ans' => clean_data($post['has_safe_sex']), 'ans_data' => array()),
                        'has_hiv_positive' => array('ans' => clean_data($post['has_hiv_positive']), 'ans_data' => array()),
                        'to_undergo_hiv_test' => array('ans' => clean_data($post['to_undergo_hiv_test']), 'ans_data' => array()),
                        'has_sex_with_money' => array('ans' => clean_data($post['has_sex_with_money']), 'ans_data' => array()),
                        'has_multiple_sex_partner' => array('ans' => clean_data($post['has_multiple_sex_partner']), 'ans_data' => array()),
                        'has_sexual_assualt' => array('ans' => clean_data($post['has_sexual_assualt']), 'ans_data' => array()),
                        'has_sex_with_stranger' => array('ans' => clean_data($post['has_sex_with_stranger']), 'ans_data' => array()),
                        'has_sexually_transmitted_disease' => array('ans' => clean_data($post['has_sexually_transmitted_disease']), 'ans_data' => array()),
                        'has_injected_drugs' => array('ans' => clean_data($post['has_injected_drugs']), 'ans_data' => array()),
                        'has_thinking_above_questions_true' => array('ans' => clean_data($post['has_thinking_above_questions_true']), 'ans_data' => array()),
                        'has_consider_self_safe_transfusion' => array('ans' => clean_data($post['has_consider_self_safe_transfusion']), 'ans_data' => array())
                     );

                     $details = json_encode($data_to_store);
                     //    print_r($details);die;

                     $_data_to_store = array(
                        'user_id' => $userdata->user_id,
                        'form_id' => $_SESSION['form_id'],
                        'form_step' => $step,
                        'detail' => $details
                     );


                     // $get_donar_form_data=$this->dm->get_donar_form_data(array('form_step'=>$step,'user_id'=>$userdata->user_id));

                     // if(empty($get_donar_form_data)){
                     $added = $this->dm->store_donar_form_data($_data_to_store);
                     // }else{
                     //     $added=$this->dm->update_donar_form_data($_data_to_store,array('form_step'=>$step,'user_id'=>$userdata->user_id));
                     // }


                     if ($added) {
                        $return['step'] = 'step_3';
                        $return['step_no'] = '3';
                        $return['step_back'] = 'step_1';
                     } else {
                        $return['error'] = 'Data not saved';
                     }
                  }
               } else if ($step == 'step_3') {

                  if ($userdata->gender == 'female') {
                     $data_to_store = array(
                        'has_safe_sex' => array('ans' => clean_data($post['has_safe_sex']), 'ans_data' => array()),
                        'has_hiv_positive' => array('ans' => clean_data($post['has_hiv_positive']), 'ans_data' => array()),
                        'to_undergo_hiv_test' => array('ans' => clean_data($post['to_undergo_hiv_test']), 'ans_data' => array()),
                        'has_sex_with_money' => array('ans' => clean_data($post['has_sex_with_money']), 'ans_data' => array()),
                        'has_multiple_sex_partner' => array('ans' => clean_data($post['has_multiple_sex_partner']), 'ans_data' => array()),
                        'has_sexual_assualt' => array('ans' => clean_data($post['has_sexual_assualt']), 'ans_data' => array()),
                        'has_sex_with_stranger' => array('ans' => clean_data($post['has_sex_with_stranger']), 'ans_data' => array()),
                        'has_sexually_transmitted_disease' => array('ans' => clean_data($post['has_sexually_transmitted_disease']), 'ans_data' => array()),
                        'has_injected_drugs' => array('ans' => clean_data($post['has_injected_drugs']), 'ans_data' => array()),
                        'has_thinking_above_questions_true' => array('ans' => clean_data($post['has_thinking_above_questions_true']), 'ans_data' => array()),
                        'has_consider_self_safe_transfusion' => array('ans' => clean_data($post['has_consider_self_safe_transfusion']), 'ans_data' => array())
                     );

                     $details = json_encode($data_to_store);

                     // print_r($details);die;
                     $_data_to_store = array(
                        'user_id' => $userdata->user_id,
                        'form_id' => $_SESSION['form_id'],
                        'form_step' => $step,
                        'detail' => $details
                     );


                     // $get_donar_form_data=$this->dm->get_donar_form_data(array('form_step'=>$step,'user_id'=>$userdata->user_id));

                     // if(empty($get_donar_form_data)){
                     $added = $this->dm->store_donar_form_data($_data_to_store);
                     // }else{
                     //     $added=$this->dm->update_donar_form_data($_data_to_store,array('form_step'=>$step,'user_id'=>$userdata->user_id));
                     // }

                     if ($added) {

                        $return['step'] = 'step_4';
                        $return['step_no'] = '4';
                        $return['step_back'] = 'step_2';
                     } else {
                        $return['error'] = 'Data not saved';
                     }
                  } else {
                     // print_r($_POST);die();


                     if ($post['regular'] == 'yes') {
                        $data_to_store = array(
                           'opportunity' => clean_data($post['opportunity']),
                           'refuse' => clean_data($post['refuse']),
                           'regular' => clean_data($post['regular']),
                           'donor' => clean_data($post['donor'])
                        );
                     } else {
                        $data_to_store = array(
                           'opportunity' => clean_data($post['opportunity']),
                           'refuse' => clean_data($post['refuse']),
                           'regular' => clean_data($post['regular']),
                           'donor' => ''
                        );
                     }

                     $details = json_encode($data_to_store);


                     $_data_to_store = array(
                        'user_id' => $userdata->user_id,
                        'form_id' => $_SESSION['form_id'],
                        'form_step' => $step,
                        'detail' => $details
                     );

                     // print_r($details);
                     // print_r($_data_to_store);die;
                     // $get_donar_form_data=$this->dm->get_donar_form_data(array('form_step'=>$step,'user_id'=>$userdata->user_id));

                     // if(empty($get_donar_form_data)){
                     $added = $this->dm->store_donar_form_data($_data_to_store);
                     // }else{
                     //     $added=$this->dm->update_donar_form_data($_data_to_store,array('form_step'=>$step,'user_id'=>$userdata->user_id));
                     // }

                     // $return['procced']='yes';
                     //     $return['step']='step_4';
                     //     $return['step_no']='4';
                     //     $return['step_back']='step_2';
                     if ($added) {
                        $return['procced'] = 'yes';
                        $return['step'] = 'step_4';
                        $return['step_no'] = '4';
                        $return['step_back'] = 'step_2';
                     } else {
                        $return['error'] = 'Data not saved';
                     }
                  }

                  // }
                  // $return['error']='There was an error occurred';
               } else if ($step == 'step_4') {

                  if ($userdata->gender == 'female') {
                     if ($post['regular'] == 'yes') {
                        $data_to_store = array(
                           'opportunity' => clean_data($post['opportunity']),
                           'refuse' => clean_data($post['refuse']),
                           'regular' => clean_data($post['regular']),
                           'donor' => clean_data($post['donor'])
                        );
                     } else {
                        $data_to_store = array(
                           'opportunity' => clean_data($post['opportunity']),
                           'refuse' => clean_data($post['refuse']),
                           'regular' => clean_data($post['regular']),
                           'donor' => ''
                        );
                     }

                     $details = json_encode($data_to_store);

                     // print_r($details);die;
                     $_data_to_store = array(
                        'user_id' => $userdata->user_id,
                        'form_id' => $_SESSION['form_id'],
                        'form_step' => $step,
                        'detail' => $details
                     );


                     // $get_donar_form_data=$this->dm->get_donar_form_data(array('form_step'=>$step,'user_id'=>$userdata->user_id));

                     // if(empty($get_donar_form_data)){
                     $added = $this->dm->store_donar_form_data($_data_to_store);
                     // }else{
                     //     $added=$this->dm->update_donar_form_data($_data_to_store,array('form_step'=>$step,'user_id'=>$userdata->user_id));
                     // }

                     if ($added) {
                        $return['procced'] = 'yes';
                        $return['step'] = 'step_5';
                        $return['step_no'] = '5';
                        $return['step_back'] = 'step_3';
                     } else {
                        $return['error'] = 'Data not saved';
                     }
                     // $return['procced']='yes';
                     // $return['step']='step_5';
                     // $return['step_no']='5';
                     // $return['step_back']='step_3';                           

                  }


                  // }
                  // $return['error']='There was an error occurred';
               }
               // start step 4


            } else {
               $return['error'] = 'There was an error occurred';
            }
            //print_r($return);
            return json_headers($return);
         } else {
            redirect(base_url('signin'));
         }
      } else {
         redirect(base_url('signin'));
      }
   }
   //mobile app
   public function city_pincode_list()
   {

      $sql = "SELECT * FROM bl_blood_banks";

      $city_pincode_list = $this->db->query($sql)->result_array();
      return json_headers($city_pincode_list);
   }

   public function bloodbanklist()
   {

      $sql = "SELECT * FROM bl_blood_banks";
      $banklist = $this->db->query($sql)->result_array();
      return json_headers($banklist);
   }

   public function searchbloodbanklist()
   {
      $Data = json_decode(file_get_contents('php://input'), true);

      $pin = $Data['filter_pin'];
      $city = $Data['filter_city'];
      if (!empty($pin) or !empty($city)) {
         $sql = "SELECT * FROM bl_blood_banks WHERE pincode = '$pin' OR address_1 = '$city'";
      } else {
         $sql = "SELECT * FROM bl_blood_banks";
      }

      $searchbanklist = $this->db->query($sql)->result_array();
      return json_headers($searchbanklist);
   }

   public function onSubmitDonarAppointment()
   {

      $Data = json_decode(file_get_contents('php://input'), true);
      // log_message('error','run');
      $form_step = $Data['form_step'];
      if ($form_step == 'step_1') {

         $dts = $Data['dts'];
         if ($dts == 'today') {
            $dts_data = array(
               'well_feeling' => $Data['well_feeling'],
               'fed_in_last_4_hrs' => $Data['fed_in_last_4_hrs'],
               'well_slept_last_night' => $Data['well_slept_last_night']
            );
         } else {
            $dts_data = array();
         }
         $aa = json_encode($dts_data);

         $hdpd = '';

         $hirb = '';
         $hgdy = $Data['has_general_differs'];

         if ($hgdy == 'yes') {
            $temp_defer = true;
            $general_differs = $Data['general_differs'];
            // return json_headers($general_differs);
            if (!empty($general_differs)) {
               foreach ($general_differs as $key => $value) {
                  $hgdy_data[] = $value;
               }
               //return json_headers($key => $value);
            } else {
               $hgdy_data = array();
            }
         } else {
            $hgdy_data = array();
         }
         // return json_headers($hgdy_data);
         $htm = $Data['has_taken_medicines'];

         if ($htm == 'yes') {
            $medicines_taken = $Data['medicines_taken'];
            if (!empty($medicines_taken)) {
               foreach ($medicines_taken as $key => $value) {
                  $htm_data[] = $value;
               }
            } else {
               $htm_data = array();
            }
         } else {
            $htm_data = array();
         }

         $hv = $Data['has_vaccinated'];

         if ($hv == 'yes') {
            $vacc_defer = true;
            $vaccinated_with = $Data['vaccinated_with'];
            if (!empty($vaccinated_with)) {
               foreach ($vaccinated_with as $key => $value) {
                  $hv_data[] = $value;
               }
            } else {
               $hv_data = array();
            }
         } else {
            $hv_data = array();
         }

         $hl2wd = $Data['has_last_2_week_differs'];

         if ($hl2wd == 'yes') {
            $temp_defer = true;
            $weeked_differs = $Data['weeked_differs'];
            if (!empty($weeked_differs)) {
               foreach ($weeked_differs as $key => $value) {
                  $hl2wd_data[] = $value;
               }
            } else {
               $hl2wd_data = array();
            }
         } else {
            $hl2wd_data = array();
         }

         $hl3md = $Data['has_last_3_month_differs'];

         if ($hl3md == 'yes') {
            $temp_defer = true;
            $three_months_differs = $Data['three_months_differs'];
            if (!empty($three_months_differs)) {
               foreach ($three_months_differs as $key => $value) {
                  $hl3md_data[] = $value;
               }
            } else {
               $hl3md_data = array();
            }
         } else {
            $hl3md_data = array();
         }

         $hrd = $Data['has_recent_difers'];

         if ($hrd == 'yes') {
            $temp_defer = true;
            $six_months_differs = $Data['six_months_differs'];
            if (!empty($six_months_differs)) {
               foreach ($six_months_differs as $key => $value) {
                  $hrd_data[] = $value;
               }
            } else {
               $hrd_data = array();
            }
         } else {
            $hrd_data = array();
         }
         // return json_headers($hrd,$hrd_data);

         $hl12md = $Data['has_last_12_month_differs'];

         if ($hl12md == 'yes') {
            $temp_defer = true;
            $twelve_months_diffres = $Data['twelve_months_diffres'];
            if (!empty($twelve_months_diffres)) {
               foreach ($twelve_months_diffres as $key => $value) {
                  $hl12md_data[] = $value;
               }
            } else {
               $hl12md_data = array();
            }
         } else {
            $hl12md_data = array();
         }

         $hprd = $Data['has_perm_differ'];

         if ($hprd == 'yes') {
            $perm_defer = true;
            $permanent_differs = $Data['permanent_differs'];
            if (!empty($permanent_differs)) {
               foreach ($permanent_differs as $key => $value) {
                  $hprd_data[] = $value;
               }
            } else {
               $hprd_data = array();
            }
         } else {
            $hprd_data = array();
         }


         $data_to_store = array(
            'donation_time_selection' => array('ans' => $dts, 'ans_data' => $aa),
            'has_discomfort_post_donation' => array('ans' => $hdpd, 'ans_data' => array()),
            'has_infect_reason_believed' => array('ans' => $hirb, 'ans_data' => array()),
            'has_general_differs' => array('ans' => $hgdy, 'ans_data' => $hgdy_data),
            'has_taken_medicines' => array('ans' => $htm, 'ans_data' => $htm_data),
            'has_vaccinated' => array('ans' => $hv, 'ans_data' => $hv_data),
            'has_last_2_week_differs' => array('ans' => $hl2wd, 'ans_data' => $hl2wd_data),
            'has_last_3_month_differs' => array('ans' => $hl3md, 'ans_data' => $hl3md_data),
            'has_recent_difers' => array('ans' => $hrd, 'ans_data' => $hrd_data),
            'has_last_12_month_differs' => array('ans' => $hl12md, 'ans_data' => $hl12md_data),
            'has_perm_differ' => array('ans' => $hprd, 'ans_data' => $hprd_data)
         );

         // return json_headers($data_to_store,true);
         $details = json_encode($data_to_store);
         $user_id = $Data['user_id'];
         $form_id = uniqid();
         $query = $this->db->query("SELECT * FROM bl_customers WHERE user_id = $user_id");

         foreach ($query->result() as $row) {
         }


         $insert1 = $this->db->query("INSERT INTO bl_donar_form_info (user_id, form_id, form_step, detail, defer_status) VALUES ('$user_id', '$form_id','$form_step', '$details', 'not deffered')");
         //echo $this->db->insert_id();die();
         // return json_headers($insert1);
         if ($insert1) {

            $result['status'] = true;
            $result['form_id'] = $form_id;
            $result['gender'] = $row->gender;
            $result['message'] = 'First Form successfully submit !';
         } else {
            $result['status'] = false;
            $result['form_id'] = $form_id;
            $result['gender'] = $row->gender;
            $result['error'] = 'First Form Fail !';
         }
         return json_headers($result);
         // print_r($step);
         // $form_step=$Data['form_step'];


      } elseif ($form_step == 'step_2') {
         $form_id = $Data['form_id'];
         $gender = $Data['gender'];

         if ($gender == 'female') {
            $data_to_store = array(
               'has_pregnant' => array('ans' => $Data['has_pregnant'], 'ans_data' => array()),
               'has_abortion' => array('ans' => $Data['has_abortion'], 'ans_data' => array()),
               'last_menstrual_period' => array('ans' => '', 'ans_data' => $Data['last_menstrual_period']),
               'has_breast_feeden_last_12_month' => array('ans' => $Data['has_breast_feeden_last_12_month'], 'ans_data' => array()),
               'has_child_less_one_year' => array('ans' => $Data['has_child_less_one_year'], 'ans_data' => array())
            );
            // return json_headers('hii',true);
            $details = json_encode($data_to_store);
            //$details='';

            $user_id = $Data['user_id'];

            $insert2 = $this->db->query("INSERT INTO bl_donar_form_info (user_id, form_id, form_step, detail, defer_status) VALUES ('$user_id', '$form_id','$form_step', '$details', 'not deffered')");
            //echo $this->db->insert_id();die();
            // return json_headers($insert1);
            if ($insert2) {

               $result['status'] = true;
               $result['form_id'] = $form_id;
               $result['message'] = 'Second Form successfully submit !';
            } else {
               $result['status'] = false;
               $result['form_id'] = $form_id;
               $result['error'] = 'Second Form Fail !';
            }
         } else {

            // $data_to_store = array(
            //     'has_safe_sex' => array('ans' => $Data['has_safe_sex'], 'ans_data' => array()),
            //     'has_hiv_positive' => array('ans' => $Data['has_hiv_positive'], 'ans_data' => array()),
            //     'to_undergo_hiv_test' => array('ans' => $Data['to_undergo_hiv_test'], 'ans_data' => array()),
            //     'has_sex_with_money' => array('ans' => $Data['has_sex_with_money'], 'ans_data' => array()),
            //     'has_multiple_sex_partner' => array('ans' => $Data['has_multiple_sex_partner'], 'ans_data' => array()),
            //     'has_sexual_assualt' => array('ans' => $Data['has_sexual_assualt'], 'ans_data' => array()),
            //     'has_sex_with_stranger' => array('ans' => $Data['has_sex_with_stranger'], 'ans_data' => array()),
            //     'has_sexually_transmitted_disease' => array('ans' => $Data['has_sexually_transmitted_disease'], 'ans_data' => array()),
            //     'has_injected_drugs' => array('ans' => $Data['has_injected_drugs'], 'ans_data' => array()),
            //     'has_thinking_above_questions_true' => array('ans' => $Data['has_thinking_above_questions_true'], 'ans_data' => array()),
            //     'has_consider_self_safe_transfusion' => array('ans' => $Data['has_consider_self_safe_transfusion'], 'ans_data' => array())
            // );
            $data_to_store = array(
               'has_safe_sex' => array('ans' => isset($Data['has_safe_sex']) ? $Data['has_safe_sex'] : null, 'ans_data' => array()),
               'has_hiv_positive' => array('ans' => isset($Data['has_hiv_positive']) ? $Data['has_hiv_positive'] : null, 'ans_data' => array()),
               'to_undergo_hiv_test' => array('ans' => isset($Data['to_undergo_hiv_test']) ? $Data['to_undergo_hiv_test'] : null, 'ans_data' => array()),
               'has_sex_with_money' => array('ans' => isset($Data['has_sex_with_money']) ? $Data['has_sex_with_money'] : null, 'ans_data' => array()),
               'has_multiple_sex_partner' => array('ans' => isset($Data['has_multiple_sex_partner']) ? $Data['has_multiple_sex_partner'] : null, 'ans_data' => array()),
               'has_sexual_assualt' => array('ans' => isset($Data['has_sexual_assualt']) ? $Data['has_sexual_assualt'] : null, 'ans_data' => array()),
               'has_sex_with_stranger' => array('ans' => isset($Data['has_sex_with_stranger']) ? $Data['has_sex_with_stranger'] : null, 'ans_data' => array()),
               'has_sexually_transmitted_disease' => array('ans' => isset($Data['has_sexually_transmitted_disease']) ? $Data['has_sexually_transmitted_disease'] : null, 'ans_data' => array()),
               'has_injected_drugs' => array('ans' => isset($Data['has_injected_drugs']) ? $Data['has_injected_drugs'] : null, 'ans_data' => array()),
               'has_thinking_above_questions_true' => array('ans' => isset($Data['has_thinking_above_questions_true']) ? $Data['has_thinking_above_questions_true'] : null, 'ans_data' => array()),
               'has_consider_self_safe_transfusion' => array('ans' => isset($Data['has_consider_self_safe_transfusion']) ? $Data['has_consider_self_safe_transfusion'] : null, 'ans_data' => array())
            );


            //return json_headers($data_to_store);
            $details = json_encode($data_to_store);
            // log_message('error',$details);
            //$details='';
            $user_id = $Data['user_id'];
            $form_id = $Data['form_id'];
            $insert3 = $this->db->query("INSERT INTO bl_donar_form_info (user_id, form_id, form_step, detail, defer_status) 
                VALUES ('$user_id',
                '$form_id',
                '$form_step',
                '$details', 'not deffered')");

            if ($insert3) {
               $result['status'] = true;
               $result['form_id'] = $form_id;
               $result['message'] = 'Second Form successfully submit !';
            } else {
               $result['status'] = false;
               $result['form_id'] = $form_id;
               $result['error'] = 'Second Form Fail !';
            }
            return json_headers($result);
         }
      } elseif ($form_step == 'step_3') {
         $form_id = $Data['form_id'];
         $gender = $Data['gender'];
         $user_id = $Data['user_id'];

         if ($gender == 'female') {
            $data_to_store = array(
               'has_safe_sex' => array('ans' => $Data['has_safe_sex'], 'ans_data' => array()),
               'has_hiv_positive' => array('ans' => $Data['has_hiv_positive'], 'ans_data' => array()),
               'to_undergo_hiv_test' => array('ans' => $Data['to_undergo_hiv_test'], 'ans_data' => array()),
               'has_sex_with_money' => array('ans' => $Data['has_sex_with_money'], 'ans_data' => array()),
               'has_multiple_sex_partner' => array('ans' => $Data['has_multiple_sex_partner'], 'ans_data' => array()),
               'has_sexual_assualt' => array('ans' => $Data['has_sexual_assualt'], 'ans_data' => array()),
               'has_sex_with_stranger' => array('ans' => $Data['has_sex_with_stranger'], 'ans_data' => array()),
               'has_sexually_transmitted_disease' => array('ans' => $Data['has_sexually_transmitted_disease'], 'ans_data' => array()),
               'has_injected_drugs' => array('ans' => $Data['has_injected_drugs'], 'ans_data' => array()),
               'has_thinking_above_questions_true' => array('ans' => $Data['has_thinking_above_questions_true'], 'ans_data' => array()),
               'has_consider_self_safe_transfusion' => array('ans' => $Data['has_consider_self_safe_transfusion'], 'ans_data' => array())
            );

            $details = json_encode($data_to_store);
            // $details='';
            $user_id = $Data['user_id'];
            //$form_step ='step_1';
            //$form_id = uniqid();

            // $_data_to_store=array(
            //     'user_id'=>$userdata->user_id,
            //     'form_id'=>$_SESSION['form_id'],
            //     'form_step'=>$step,
            //     'detail'=>$details
            // );

            $insert4 = $this->db->query("INSERT INTO bl_donar_form_info (user_id, form_id, form_step, detail, defer_status) VALUES ('$user_id', '$form_id','$form_step', '$details', 'not deffered')");
            //echo $this->db->insert_id();die();
            // return json_headers($insert1);
            if ($insert4) {

               $result['status'] = true;
               $result['form_id'] = $form_id;
               $result['message'] = 'thrid Form successfully submit !';
            } else {
               $result['status'] = false;
               $result['form_id'] = $form_id;
               $result['error'] = 'thrid Form Fail !';
            }
            return json_headers($result);
         } else {

            $data_to_store = array(
               'opportunity' => $Data['opportunity'],
               'refuse' => $Data['refuse'],
               'regular' => $Data['regular'],
               'donor' => $Data['donor']
            );
            // return json_headers($data_to_store);
            $details = json_encode($data_to_store);



            $insert4 = $this->db->query("INSERT INTO bl_donar_form_info (user_id, form_id, form_step, detail, defer_status) VALUES ('$user_id', '$form_id','$form_step', '$details', 'not deffered')");
            //echo $this->db->insert_id();die();
            // return json_headers($insert1);
            if ($insert4) {

               $result['status'] = true;
               $result['form_id'] = $form_id;
               $result['message'] = 'thrid Form successfully submit !';
            } else {
               $result['status'] = false;
               $result['form_id'] = $form_id;
               $result['error'] = 'thrid Form Fail !';
            }
            return json_headers($result);
         }
      } elseif ($form_step == 'step_4') {
         $form_id = $Data['form_id'];
         $gender = $Data['gender'];
         $user_id = $Data['user_id'];

         if ($gender == 'female') {
            $data_to_store = array(
               'opportunity' => $Data['opportunity'],
               'refuse' => $Data['refuse'],
               'regular' => $Data['regular'],
               'donor' => $Data['donor']
            );

            $details = json_encode($data_to_store);
            $insert4 = $this->db->query("INSERT INTO bl_donar_form_info (user_id, form_id, form_step, detail, defer_status) VALUES ('$user_id', '$form_id','$form_step', '$details', 'not deffered')");

            if ($insert4) {

               $result['status'] = true;
               $result['form_id'] = $form_id;
               $result['message'] = 'Fourth Form successfully submit !';
            } else {
               $result['status'] = false;
               $result['form_id'] = $form_id;
               $result['error'] = 'Fourth Form Fail !';
            }
            return json_headers($result);
         } else {
            $details = '';
            $insert4 = $this->db->query("INSERT INTO bl_donar_form_info (user_id, form_id, form_step, detail, defer_status) VALUES ('$user_id', '$form_id','$form_step', '$details', 'not deffered')");
            //echo $this->db->insert_id();die();
            // return json_headers($insert1);
            if ($insert4) {

               $result['status'] = true;
               $result['form_id'] = $form_id;
               $result['message'] = 'Fourth Form successfully submit !';
            } else {
               $result['status'] = false;
               $result['form_id'] = $form_id;
               $result['error'] = 'Fourth Form Fail !';
            }
         }
         return json_headers($result);
      }
   }
   public function bookappointment()
   {

      $Data = json_decode(file_get_contents('php://input'), true);

      $o_id = $Data['blood_bank_id'];
      $id = $Data['user_id'];
      $form = $Data['form_id'];
      $o_date = $Data['appointment_date'];

      $insert = $this->db->query("INSERT INTO bl_blood_donation_requests (org_id, user_id, donation_form_id, approved_status, requested_schedule_date ) VALUES ('$o_id','$id', '$form', 'approved','$o_date')");

      if ($insert) {
         $result['status'] = true;
         $result['message'] = 'Appointment Book successfully !';
      } else {
         $result['status'] = false;
         $result['error'] = 'Appointment Booking Fail !';
      }
      return json_headers($result);
   }

   public function myappointmentlist()
   {

      $Data = json_decode(file_get_contents('php://input'), true);

      $id = $Data['user_id'];
      $sql = "SELECT bl_blood_donation_requests.id, bl_blood_donation_requests.requested_schedule_date, bl_blood_banks.name FROM bl_blood_donation_requests INNER JOIN bl_blood_banks ON bl_blood_donation_requests.org_id = bl_blood_banks.blood_bank_id  WHERE bl_blood_donation_requests.user_id = '$id'";

      $appointment = $this->db->query($sql)->result_array();

      return json_headers($appointment);

      //  return json_headers($result);
   }

   public function Re_scheduleappointment()
   {

      $Data = json_decode(file_get_contents('php://input'), true);

      $o_id = $Data['form_request_id'];
      $o_date = $Data['rescheduale_date'];
      $o_reasion = $Data['reasion'];
      $id = $Data['user_id'];
      $update = $this->db->query("UPDATE bl_blood_donation_requests SET requested_schedule_date = '$o_date', reason = '$o_reasion' WHERE id = '$o_id'");

      if ($update) {
         $result['status'] = true;
         $result['message'] = 'Re-Schedule successfully !';
      } else {
         $result['status'] = false;
         $result['error'] = 'Re-Schedule Fail !';
      }
      return json_headers($result);
   }

//   public function myprofile_data()
//   {

//       $Data = json_decode(file_get_contents('php://input'), true);
//       $id = $Data['user_id'];
//       $sql = "SELECT bl_customers.user_id,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.email,bl_customers.ph_no,bl_customers.age,bl_customers.gender, bl_masters.master_type_key_value, bl_customers.address FROM bl_customers INNER JOIN bl_masters ON bl_customers.blood_group = bl_masters.master_id  WHERE bl_customers.user_id = '$id'";

//       $profile = $this->db->query($sql)->result_array();

//       return json_headers($profile);
//   }
    public function myprofile_data()
   {

      $Data = json_decode(file_get_contents('php://input'), true);
      $id = $Data['user_id'];
      $sql = "SELECT bl_customers.user_id,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.email,bl_customers.ph_no,bl_customers.age,bl_customers.gender, bl_masters.master_type_key_value, bl_customers.address FROM bl_customers LEFT JOIN bl_masters ON bl_customers.blood_group = bl_masters.master_id  WHERE bl_customers.user_id = '$id'";

      $profile = $this->db->query($sql)->result_array();

      return json_headers($profile);
   }
   public function myprofile_edit()
   {
      // return json_headers($POST);
      $Data = json_decode(file_get_contents('php://input'), true);
      // return json_headers($Data);
      $id = $Data['user_id'];
      $first_name = $Data['first_name'];
      $mid_name = $Data['mid_name'];
      $last_name = $Data['last_name'];
      $blood_group = $Data['blood_group'];
      $query1 = $this->db->query("SELECT * FROM bl_masters WHERE master_id = '$blood_group'");

      foreach ($query1->result() as $bloodgroup) {
         // print_r($bloodgroup); die;
      }
      $gender = $Data['gender'];
      $email = $Data['email'];
      $ph_no = $Data['phone_number'];
      $age = $Data['age'];
      $address = $Data['address'];

      if (!empty($Data['password'])) {
         $password = password_hash($Data['password'], PASSWORD_BCRYPT, array('cost' => 12));
         // print_r($password);die();
      } else {

         $query4 = $this->db->query("SELECT * FROM bl_users WHERE id = '$id'");
         foreach ($query4->result() as $user) {
         }
         $password = $user->password;
      }

      $update = $this->db->query("UPDATE bl_customers SET first_name = '$first_name', mid_name = '$mid_name', last_name = '$last_name', gender = '$gender', email = '$email', 
      ph_no = '$ph_no', age = '$age', blood_group = '$bloodgroup->master_id' , address = '$address'  WHERE user_id = '$id'");

      if ($update) {
         $update1 = $this->db->query("UPDATE bl_users SET password = '$password'  WHERE id = '$id'");
         if ($update1 == true) {
            $result['status'] = true;
            $result['user_id'] = $id;
            $result['details'] = $Data;
            $result['message'] = 'Profile Update successfully !';
         } else {
            $result['status'] = false;
            $result['error'] = 'Profile Update Fail !';
         }
      } else {
         $result['status'] = false;
         $result['error'] = 'Profile Update Fail !';
      }

      return json_headers($result);
   }

   public function bloodrequest_form()
   {

      $Data = json_decode(file_get_contents('php://input'), true);
      // return json_headers($Data);

      $id = $Data['user_id'];
      $p_name = $Data['p_name'];
      $age = $Data['age'];
      $gender = $Data['gender'];
      $registration = $Data['registration'];
      $ward = $Data['ward'];
      $bed = $Data['bed'];
      $f_name = $Data['f_name'];
      $hospital = $Data['hospital'];
      $phone = $Data['phone'];
      $consultant = $Data['consultant'];
      $consultant_phone = $Data['consultant_phone'];
      $clinical_history = $Data['clinical_history'];
      $diagnosis = $Data['diagnosis'];
      $hb = $Data['hb'];
      $platelet = $Data['platelet'];
      $reasons = $Data['reasons'];
      $history_previous = $Data['history_previous'];
      $blood_group = $Data['blood_group'];
      $female = $Data['female'];

      foreach ($Data as $key => $value) {
         if (strpos($key, "unit")) {
            $unit[$key] = $value;
         }
         if (strpos($key, "test")) {
            $test[$key] = $value;
         }
      }
      //print_r($unit);
      //print_r($test);
      //die;                                                                                                  
      $components_unit = json_encode($unit);
      $components_test = json_encode($test);
      // return json_headers($components_test); 
      $required_date = $Data['required_date'];
      $required_time = $Data['required_time'];
      $stat = $Data['stat'];
      $urgent = $Data['urgent'];
      $routine = $Data['routine'];
      $reserved = $Data['reserved'];
      $patient = $Data['patient'];
      $identity = $Data['identity'];
      $medical = $Data['medical'];
      $completely = $Data['completely'];
      $sample = $Data['sample'];
      $match = $Data['match'];
      $sample_tube = $Data['sample_tube'];

      $insert = $this->db->query("INSERT INTO bl_blood_request (user_id , p_name , age , gender , registration , ward , bed , f_name, hospital, phone , consultant , consultant_phone , clinical_history , diagnosis , hb , platelet , reasons , history_previous , blood_group , female , components_unit , components_test , required_date , required_time , stat , urgent , routine , reserved , patient , identity , medical , completely  , sample , matchs , sample_tube ) VALUES ('$id','$p_name','$age', '$gender','$registration','$ward','$bed','$f_name','$hospital','$phone','$consultant','$consultant_phone','$clinical_history','$diagnosis','$hb','$platelet','$reasons','$history_previous','$blood_group','$female','$components_unit','$components_test','$required_date','$required_time','$stat','$urgent' ,'$routine','$reserved','$patient','$identity','$medical','$completely','$sample','$match','$sample_tube')");
      $last_id = $this->db->insert_id();
      $form_id = uniqid();
      if ($insert) {
         $result['status'] = true;
         $result['last_id'] = $last_id;
         $result['form_id'] = $form_id;
         $result['message'] = 'Request Appointment Book successfully !';
      } else {
         $result['status'] = false;
         $result['form_id'] = $form_id;
         $result['last_id'] = $last_id;
         $result['error'] = 'Request Booking Fail !';
      }

      return json_headers($result);
   }

   public function bloodrequest_appoint()
   {

      $Data = json_decode(file_get_contents('php://input'), true);

      $o_id = $Data['blood_bank_id'];
      $o_date = $Data['appointment_date'];
      $id = $Data['user_id'];
      $form = $Data['form_id'];
      // return json_headers($Data); 
      $update = $this->db->query("UPDATE bl_blood_request SET org_id = '$o_id',approved_status = 'approved',requested_schedule_date = '$o_date' WHERE user_id = '$id' and id = '$form'");

      if ($update) {

         $result['status'] = true;
         $result['message'] = 'Blood Request Appointment successfully !';
      } else {
         $result['status'] = false;
         $result['error'] = 'Blood Request Appointment Fail !';
      }
      return json_headers($result);
   }

   public function myrequestlist()
   {

      $Data = json_decode(file_get_contents('php://input'), true);
      // return json_headers($Data);
      $id = $Data['user_id'];

      $sql = "SELECT bl_blood_request.*, bl_blood_banks.name FROM bl_blood_request INNER JOIN bl_blood_banks ON bl_blood_request.org_id = bl_blood_banks.blood_bank_id  WHERE bl_blood_request.user_id = '$id'";

      $request = $this->db->query($sql)->result_array();

      return json_headers($request);

      //  return json_headers($result);
   }

   public function Re_schedulerequest()
   {

      $Data = json_decode(file_get_contents('php://input'), true);

      $o_id = $Data['form_request_id'];
      $o_date = $Data['rescheduale_date'];
      $o_reasion = $Data['reasion'];
      $id = $Data['user_id'];
      $update = $this->db->query("UPDATE bl_blood_request SET requested_schedule_date = '$o_date', reason = '$o_reasion' WHERE id = '$o_id'");

      if ($update) {
         $result['status'] = true;
         $result['message'] = 'Re-Schedule successfully !';
      } else {
         $result['status'] = false;
         $result['error'] = 'Re-Schedule Fail !';
      }
      return json_headers($result);
   }


   public function bloodbank_list()
   {

      $sql = "SELECT bl_blood_banks.name,bl_blood_banks.address_1,bl_blood_banks.latitude,bl_blood_banks.longitude,bl_blood_banks.pincode,bl_cities.city_name FROM bl_blood_banks INNER JOIN bl_cities ON bl_blood_banks.city_id = bl_cities.id  WHERE bl_blood_banks.org_type = 'Blood Bank'";
      $banklist = $this->db->query($sql)->result_array();
      return json_headers($banklist);
   }
   //  public function bloodbank_list_api(){

   //   // $sql = "SELECT * FROM bl_bloodbank_other WHERE status = 1 ";   
   //     $Data = json_decode(file_get_contents('php://input'), true);

   //         $userLat = $Data['latitude'];
   //         $userLong = $Data['longitude'];
   //     $sql = $this->db->query("SELECT *, 
   //                           (3959 * acos(cos(radians($userLat)) * cos(radians(latitude)) * cos(radians(`longitude`) - radians($userLong)) + sin(radians($userLat)) * sin(radians(latitude))))
   //                           AS distance
   //                           FROM bl_bloodbank_other
   //                           WHERE status = 1
   //                           ORDER BY distance ASC");
   //     $banklist = $sql->result();
   //     return json_headers($banklist); 

   //  }
   public function bloodbank_list_api()
   {

      if ($this->input->get('latitude') != '' && $this->input->get('longitude') != '') {
         $userLat = $this->input->get('latitude');
         $userLong = $this->input->get('longitude');

         $sql = $this->db->query("SELECT *, 
                                (3959 * acos(cos(radians($userLat)) * cos(radians(latitude)) * cos(radians(`longitude`) - radians($userLong)) + sin(radians($userLat)) * sin(radians(latitude))))
                                AS distance
                                FROM bl_bloodbank_other
                                WHERE status = 1
                                ORDER BY distance ASC
                              LIMIT 100");
         $banklist = $sql->result();
         return json_headers($banklist);
      } else {
         $response = ['status' => 'error', 'message' => 'Invalid latitude or longitude'];
      }

      header('Content-Type: application/json');

      echo json_encode($response);
   }

   public function searchbloodbank_list()
   {

      $filter_pin = $this->input->get('filter_pin');
      $filter_city = $this->input->get('filter_city');

      $sql = $this->db->query("SELECT *  FROM bl_bloodbank_other WHERE status = 1 AND ( city = '$filter_city' OR pincode = '$filter_pin')
                          ");
      $searchbanklist = $sql->result();
      return json_headers($searchbanklist);
   }
   public function searchhospital()
   {

      $filter_pin = $this->input->get('filter_pin');
      $filter_city = $this->input->get('filter_city');

      $sql = $this->db->query("SELECT *  FROM bl_hospital_other WHERE status = 1 AND ( city = '$filter_city' OR pincode = '$filter_pin')
                          ");
      $searchbanklist = $sql->result();
      return json_headers($searchbanklist);
   }

   public function bloodbankcity_pincode_list()
   {

      $sql =   "SELECT city as city_name FROM bl_bloodbank_other GROUP BY city";
      $city_pincode_list = $this->db->query($sql)->result_array();
      return json_headers($city_pincode_list);
   }

   public function hospitalcity_pincode_list()
   {

      $sql =   "SELECT city as city_name FROM bl_hospital_other GROUP BY city";
      $city_pincode_list = $this->db->query($sql)->result_array();
      return json_headers($city_pincode_list);
   }
   public function hospital_list_api()
   {
      if ($this->input->get('latitude') != '' && $this->input->get('longitude') != '') {
         $userLat = $this->input->get('latitude');
         $userLong = $this->input->get('longitude');

         $sql = $this->db->query("SELECT *, 
                                (3959 * acos(cos(radians($userLat)) * cos(radians(lat)) * cos(radians(`long`) - radians($userLong)) + sin(radians($userLat)) * sin(radians(lat))))
                                AS distance
                                FROM bl_hospital_other
                                WHERE status = 1
                                ORDER BY distance ASC
                              LIMIT 100");
         $banklist = $sql->result();
         return  json_headers($banklist);
      } else {
         $response = ['status' => 'error', 'message' => 'Invalid latitude or longitude'];
      }

      header('Content-Type: application/json');

      echo json_encode($response);
   }
   public function hospital_list()
   {

      $sql = "SELECT bl_blood_banks.name,bl_blood_banks.address_1,bl_blood_banks.latitude,bl_blood_banks.longitude,bl_blood_banks.pincode,bl_cities.city_name FROM bl_blood_banks INNER JOIN bl_cities ON bl_blood_banks.city_id = bl_cities.id  WHERE bl_blood_banks.org_type = 'Hospital'";
      $banklist = $this->db->query($sql)->result_array();
      return json_headers($banklist);
   }

   public function searchhospital_list()
   {
      $Data = json_decode(file_get_contents('php://input'), true);

      $pin = $Data['filter_pin'];
      $city = $Data['filter_city'];
      if (!empty($pin) or !empty($city)) {
         $sql = "SELECT bl_blood_banks.name,bl_blood_banks.address_1,bl_blood_banks.latitude,bl_blood_banks.longitude,bl_blood_banks.pincode,bl_cities.city_name FROM bl_blood_banks INNER JOIN bl_cities ON bl_blood_banks.city_id = bl_cities.id  WHERE bl_blood_banks.org_type = 'Hospital' and bl_blood_banks.pincode = '$pin' OR bl_cities.city_name = '$city'";
      } else {
         $sql = "SELECT bl_blood_banks.name,bl_blood_banks.address_1,bl_blood_banks.latitude,bl_blood_banks.longitude,bl_blood_banks.pincode,bl_cities.city_name FROM bl_blood_banks INNER JOIN bl_cities ON bl_blood_banks.city_id = bl_cities.id  WHERE bl_blood_banks.org_type = 'Hospital'";
      }

      $searchbanklist = $this->db->query($sql)->result_array();
      return json_headers($searchbanklist);
   }


   public function lab_list()
   {

      $sql = "SELECT bl_blood_banks.name,bl_blood_banks.address_1,bl_blood_banks.latitude,bl_blood_banks.longitude,bl_blood_banks.pincode,bl_cities.city_name FROM bl_blood_banks INNER JOIN bl_cities ON bl_blood_banks.city_id = bl_cities.id  WHERE bl_blood_banks.org_type = 'Lab'";
      $lablist = $this->db->query($sql)->result_array();
      return json_headers($lablist);
   }

   public function searchlab_list()
   {
      $Data = json_decode(file_get_contents('php://input'), true);

      $pin = $Data['filter_pin'];
      $city = $Data['filter_city'];
      if (!empty($pin) or !empty($city)) {
         $sql = "SELECT bl_blood_banks.name,bl_blood_banks.address_1,bl_blood_banks.latitude,bl_blood_banks.longitude,bl_blood_banks.pincode,bl_cities.city_name FROM bl_blood_banks INNER JOIN bl_cities ON bl_blood_banks.city_id = bl_cities.id  WHERE bl_blood_banks.org_type = 'Lab' and bl_blood_banks.pincode = '$pin' OR bl_cities.city_name = '$city'";
      } else {
         $sql = "SELECT bl_blood_banks.name,bl_blood_banks.address_1,bl_blood_banks.latitude,bl_blood_banks.longitude,bl_blood_banks.pincode,bl_cities.city_name FROM bl_blood_banks INNER JOIN bl_cities ON bl_blood_banks.city_id = bl_cities.id  WHERE bl_blood_banks.org_type = 'Lab'";
      }

      $searchlablist = $this->db->query($sql)->result_array();
      return json_headers($searchlablist);
   }

   public function labcity_pincode_list()
   {

      $sql = "SELECT bl_cities.city_name FROM bl_cities";

      $city_pincode_list = $this->db->query($sql)->result_array();
      return json_headers($city_pincode_list);
   }
}
