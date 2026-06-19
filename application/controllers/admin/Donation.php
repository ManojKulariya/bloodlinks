<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Donation  extends BaseAdminController
{

    function __construct()
    {
        parent::__construct();
    }

    function custompagination($totalRows, $offset, $limit, $page_url, $current_page) {
  $total_pages = ceil($totalRows / $limit);

  $pagination_links = '<ul class="pagination">';

  // Display "Previous" link
  if ($current_page > 1) {
    $pagination_links .= '<li><a href="' . $page_url . ($current_page - 1) . '">Previous</a></li>';
  }

  // Display page numbers
  for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $current_page) {
      $pagination_links .= '<li class="active"><a href="' . $page_url . $i . '">' . $i . '</a></li>';
    } elseif ($i >= $current_page - 2 && $i <= $current_page + 2) {
      $pagination_links .= '<li><a href="' . $page_url . $i . '">' . $i . '</a></li>';
    }
  }

  // Display "Next" link
  if ($current_page < $total_pages) {
    $pagination_links .= '<li><a href="' . $page_url . ($current_page + 1) . '">Next</a></li>';
  }

  $pagination_links .= '</ul>';

  return $pagination_links;
}
    //Apointments
    function indexAppointments()
    {
        
        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Appointments';
            $filters = $this->input->post(); // Get all POST filters
            $bank_id = $_SESSION['bank_id']; // Assuming session has this
        
            $this->data['appointments'] = $this->getAppointments($filters, $bank_id);
         
            $this->theme->title($this->data['page_title'])->load('donations/vw_appointments', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    private function getAppointments($filters, $bank_id)
    {
        $this->db->select('bl_blood_donation_requests.*, bl_customers.first_name, bl_customers.mid_name, bl_customers.last_name, bl_customers.email, bl_customers.ph_no');
        $this->db->from('bl_blood_donation_requests');
        $this->db->join('bl_customers', 'bl_customers.user_id = bl_blood_donation_requests.user_id');
        $this->db->join('bl_districts', 'bl_districts.id = bl_customers.district_id', 'left');
        $this->db->where('bl_blood_donation_requests.org_id', $bank_id);
    
        if (!empty($filters['app_id'])) {
            $this->db->where('bl_blood_donation_requests.id', $filters['app_id']);
        }
    
        if (!empty($filters['user_id'])) {
            $this->db->where('bl_blood_donation_requests.user_id', $filters['user_id']);
        }
    
        if (!empty($filters['status'])) {
            $this->db->like('bl_blood_donation_requests.donation_status', $filters['status']);
        }
    
        if (!empty($filters['application_id'])) {
            $this->db->like('bl_blood_donation_requests.application_no', $filters['application_id']);
        }
    
        if (!empty($filters['name'])) {
            $this->db->like('bl_customers.first_name', $filters['name']);
        }
    
        if (!empty($filters['city'])) {
            $this->db->like('bl_districts.district_name', $filters['city']);
        }
    
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $this->db->where('requested_schedule_date >=', $filters['start_date']);
            $this->db->where('requested_schedule_date <=', $filters['end_date']);
        }
    
        $this->db->order_by('bl_blood_donation_requests.id', 'DESC');
        return $this->db->get()->result();
    }
    public function verify_pw(){
        log_message('error',$_POST['password']);
        $bank_id = $_SESSION['bank_id'];
        $bloodData = $this->db->query("SELECT bl_users.password FROM bl_blood_banks JOIN bl_users ON bl_blood_banks.user_id = bl_users.id where bl_blood_banks.blood_bank_id  = $bank_id")->row();
        $hashed_password = $bloodData->password;
            header('Content-Type: application/json');
            if (isset($_POST['password'])) {
            $userPassword = $_POST['password'];
                if (password_verify($userPassword, $hashed_password)) {
                echo json_encode(['success' => true]);
                } else {
                echo json_encode(['success' => false]);
                }
            } else {
            echo json_encode(['success' => false]);
            }
    }


    public function download()
    {
        $this->data['page_title'] = '';
        $this->theme->title($this->data['page_title'])->load('donations/vw_generate_donation_pdf', $this->data);
    }
    public function check_in()
    {
        $this->data['page_title'] = 'Check In Form';

        $this->theme->title($this->data['page_title'])->load('donations/vw_checkin_form', $this->data);
    }

    public function edit_donation_form1()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit for Blood Donation';


            $this->theme->title($this->data['page_title'])->load('donations/vw_edit_donation_form_1', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function edit_donation_form2()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit for Blood Donation';


            $this->theme->title($this->data['page_title'])->load('donations/vw_edit_donation_form_2', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function edit_donation_form3()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit for Blood Donation';


            $this->theme->title($this->data['page_title'])->load('donations/vw_edit_donation_form_3', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function edit_donation_form4()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit for Blood Donation';


            $this->theme->title($this->data['page_title'])->load('donations/vw_edit_donation_form_4', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function edit_donation_form5()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit for Blood Donation';


            $this->theme->title($this->data['page_title'])->load('donations/vw_edit_donation_form_5', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function edit_donation_form()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit Donation Form';


            $this->theme->title($this->data['page_title'])->load('donations/vw_edit_donationform', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function request_pdf_download()
    {
        $this->data['page_title'] = '';
        $this->theme->title($this->data['page_title'])->load('Request/blood_request_pdf', $this->data);
    }

    // public function blood_appointment()
    // {

    //     if (session_userdata('isAdminLoggedin')) {
    //         $this->data['page_title'] = 'Request for Blood Appointment';
    //         $this->theme->title($this->data['page_title'])->load('donations/vw_blood_appointments', $this->data);
    //     } else {
    //         redirect(base_url('admin'));
    //     }
    // }
    public function blood_appointment()
    {
        if (session_userdata('isAdminLoggedin')) {
            $bank_id = $_SESSION['bank_id'];
            $filters = $this->input->post(); // get all filters
            
            $this->db->from('bl_blood_request');
            $this->db->where('org_id', $bank_id);
            // Dynamic search filters
            if (!empty($filters['appointment_id'])) {
                $this->db->like('id', $filters['appointment_id']);
            }
            if (!empty($filters['user_id'])) {
                $this->db->like('user_id', $filters['user_id']);
            }
            if (!empty($filters['name'])) {
                $this->db->like('p_name', $filters['name']);
            }
            if (!empty($filters['mobile'])) {
                $this->db->like('phone', $filters['mobile']);
            }
            if (!empty($filters['application_id'])) {
                $this->db->like('application_no', $filters['application_id']);
            }
            if (!empty($filters['blood_group'])) {
                $this->db->like('blood_group', $filters['blood_group']);
            }
            if (!empty($filters['form_status'])) {
                $this->db->like('approved_status', $filters['form_status']);
            }
            if (!empty($filters['hospital'])) {
                $this->db->like('hospital', $filters['hospital']);
            }
            if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
                $this->db->where('requested_schedule_date >=', $filters['start_date']);
                $this->db->where('requested_schedule_date <=', $filters['end_date']);
            }
        
            $this->db->order_by('id', 'DESC');
            $this->data['appointments'] = $this->db->get()->result();
            $this->data['page_title'] = 'Request for Blood Appointment';
            $this->theme->title($this->data['page_title'])->load('donations/vw_blood_appointments', $this->data);
        } else {
            redirect(base_url('admin'));
        }
    }


    public function blood_request_checkin()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Request Checkin';

            $this->theme->title($this->data['page_title'])->load('Request/vw_request_checkin', $this->data);
        } else {
            redirect(base_url('admin'));
        }
    }
    public function getuniueunit()
    {
        $id    = date("y") . '/' . $this->input->post('id');
        $data  = $this->db->query("SELECT * FROM bl_bb_donatioform WHERE unit_no = '$id'")->result_array();
        $count = count($data);
        echo json_encode($count);
    }
    public function blood_appointment_search()
    {

        // echo "hiii"; die;

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('p_name', 'application_no', 'age', 'gender', 'blood_group');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_blood_appointment($posts, $param, FALSE, FALSE);


                //print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';

                foreach ($list as $request) {
                    $no++;
                    //print_obj($request);
                    //echo $request;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $request->p_name;
                    $row[]  =   $request->application_no;
                    $row[]  =   $request->age;
                    // $row[]  =   date('d-m-Y',strtotime($donar->created_at));
                    $row[]  =   $request->gender;
                    $row[]  =   $request->blood_group;

                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            

                    if (!empty($request->application_no)) {
                        $checkin = '<a href="' . $this->data['base_url'] . '/request/request_pdf_download/' . $request->id . '/' . $request->user_id . '" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>';
                    } else {
                        $checkin = '<a href="' . $this->data['base_url'] . '/request/blood_request_checkin/' . $request->id . '/' . $request->user_id . '" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-check"></i></a>';
                    }


                    $row[]  = $checkin . ' <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $request->id . ');" ><i class="fa fa-trash"></i></button>';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_blood_appointment($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_blood_appointment($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function blood_appointment_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');

        $dataDelete = $this->db->query("DELETE FROM bl_blood_request WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    //Blood Request Form
    function request_form()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Request Form';
            
            $filters = $this->input->post();
            $bank_id = $_SESSION['bank_id'];
            $this->data['requestdata'] = $this->request_form_data($bank_id,$filters);

            $this->theme->title($this->data['page_title'])->load('Request/vw_request_form', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    // In your controller
    public function request_form_data($bank_id,$filters)
    {
        $this->db->select('rb.*, cm.status as crossmatch_status');
        $this->db->from('bl_requestblood rb');
        $this->db->join('bl_crossmatch cm', "cm.request = rb.request AND cm.bloodbank_id = '$bank_id'", 'left');
        $this->db->where('rb.bloodbank_id', $bank_id);
        $this->db->group_start();
        $this->db->where('cm.status !=', 'issued');
        $this->db->or_where('cm.status IS NULL', null, false);
        $this->db->group_end();
    
        // Dynamic filter
        if (!empty($filters)) {
            if (!empty($filters['user'])) $this->db->like('rb.request_by', $filters['user']);
            if (!empty($filters['status'])) $this->db->like('rb.status', $filters['status']);
            if (!empty($filters['blood_group'])) $this->db->where('rb.blood_group', $filters['blood_group']);
            if (!empty($filters['hospital'])) $this->db->like('rb.hospital', $filters['hospital']);
            if (!empty($filters['type'])) $this->db->like('rb.request_type', $filters['type']);
            if (!empty($filters['name'])) $this->db->like('rb.p_name', $filters['name']);
            if (!empty($filters['request_no'])) $this->db->like('rb.request', $filters['request_no']);
            if (!empty($filters['mobile'])) $this->db->like('rb.mobile', $filters['mobile']);
    
            if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
                $this->db->where('rb.required_date >=', $filters['start_date']);
                $this->db->where('rb.required_date <=', $filters['end_date']);
            } elseif (!empty($filters['start_date'])) {
                $this->db->where('rb.required_date', $filters['start_date']);
            } elseif (!empty($filters['end_date'])) {
                $this->db->where('rb.required_date', $filters['end_date']);
            }
        }
    
        $this->db->order_by('rb.ID', 'DESC');
        $query = $this->db->get();
        return $query->result();
    
    }

    //Blood Request Form Add
    function request_form_add()
    {

        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'Blood Request Form Add';
            $bank_id = $_SESSION['bank_id'];
            $pending = $this->db
            ->select('application_no')
            ->from('bl_blood_request')
            ->where('request','Accept')
            ->where('org_id',$bank_id)
            ->where("application_no NOT IN (SELECT application_no FROM bl_requestblood)", NULL, FALSE)
            ->get()
            ->result();
            $this->data['pendingapplication'] =  $pending;
            
            $this->theme->title($this->data['page_title'])->load('Request/vw_request_form_add', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }


    function my_city_hospital()
    {
        $hospitalName = $_POST['hospitalName'];
        $registrationNo = $_POST['registrationNo'];
        $bloodBankID = $_POST['bloodBankID'];
        $this->db->query("INSERT INTO bl_bb_hospital (bank_id , hp_name , reg_no) VALUES ('$bloodBankID','$hospitalName', '$registrationNo')");
        return;
    }
    //Blood Request Form Edit
    function request_form_edit()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Request Form Edit';

            $this->theme->title($this->data['page_title'])->load('Request/vw_request_form_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function request_form_search()
    {

        // echo "hiii"; die;

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('p_name', 'request', 'age', 'gender', 'blood_group');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_request_form($posts, $param, FALSE, FALSE);


                //print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';

                foreach ($list as $request_form) {
                    $no++;
                    //print_obj($request_form);
                    //echo $request_form;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $request_form->p_name;
                    $row[]  =   $request_form->request;
                    $row[]  =   $request_form->age;
                    // $row[]  =   date('d-m-Y',strtotime($donar->created_at));
                    $row[]  =   $request_form->gender;
                    $row[]  =   $request_form->blood_group;

                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            

                    //    if($donar->donation_status == 'not donated'){
                    //    $checkin = '<a href="'.$this->data['base_url'].'/donations/check_in/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-check"></i></a> <a href="'.$this->data['base_url'].'/donations/donation_form/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>';
                    // }else{
                    //     $checkin ='<a href="'.$this->data['base_url'].'/donations/download/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>';
                    // }


                    $row[]  = '<a href="' . $this->data['base_url'] . '/request/request_form_edit/' . $request_form->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $request_form->id . ');" ><i class="fa fa-trash"></i></button>';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_request_form($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_request_form($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function request_form_delete()
    {
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_requestblood WHERE id = '$id'");
        if ($dataDelete == true) {
            echo "1";
        } else {
            echo "2";
        }
    }

    //Cross Match Form
    function cross_match()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Cross Match Form';
            $filters = $this->input->post();

            $this->data['crossmatches'] = $this->get_filtered_cross_match_data($filters);


            $this->theme->title($this->data['page_title'])->load('Request/vw_crossmatch_form', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function get_filtered_cross_match_data($filters = [])
    {
        $this->db->select('*')->from('bl_crossmatch')->where([
            'status' => 'crossmatch',
            'bloodbank_id' => $_SESSION['bank_id']
        ]);
    
        if (!empty($filters)) {
            if (!empty($filters['name'])) {
                $this->db->like('p_name', $filters['name']);
            }
    
            if (!empty($filters['request_no'])) {
                $this->db->like('request', $filters['request_no']);
            }
    
            if (!empty($filters['cross_match'])) {
                $this->db->like('cross_match', $filters['cross_match']);
            }
    
            if (!empty($filters['blood_group'])) {
                $this->db->where('blood_group', $filters['blood_group']);
            }
    
            if (!empty($filters['Component_required'])) {
                $this->db->like('component', $filters['Component_required']);
            }
    
            if (!empty($filters['user'])) {
                $this->db->like('crossmatch_by', $filters['user']);
            }
    
            if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
                $this->db->where('crossmatch_date >=', $filters['start_date']);
                $this->db->where('crossmatch_date <=', $filters['end_date']);
            } elseif (!empty($filters['start_date'])) {
                $this->db->where('crossmatch_date', $filters['start_date']);
            } elseif (!empty($filters['end_date'])) {
                $this->db->where('crossmatch_date', $filters['end_date']);
            }
        }
    
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }

    //Cross Match Form Add
    function cross_match_add()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'Cross Match Form Add';
            $this->theme->title($this->data['page_title'])->load('Request/vw_crossmatch_form_add', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function cross_match_search()
    {

        // echo "hiii"; die;

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('unit_no', 'component', 'tube_no', 'blood_group', 'bleeding_date', 'expire_date', 'cross_match', 'crossmatch_by');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_crossmatch($posts, $param, FALSE, FALSE);


                //print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';

                foreach ($list as $crossmatch) {
                    $no++;
                    // print_obj($request);
                    // echo $request;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $crossmatch->unit_no;
                    $row[]  =   $crossmatch->component;
                    $row[]  =   $crossmatch->tube_no;
                    // $row[]  =   date('d-m-Y',strtotime($donar->created_at));
                    $row[]  =   $crossmatch->blood_group;
                    $row[]  =   $crossmatch->bleeding_date;
                    $row[]  =   $crossmatch->expire_date;
                    $row[]  =   $crossmatch->cross_match;
                    $row[]  =   $crossmatch->crossmatch_by;
                    $row[]  =   $crossmatch->coomb_meth;
                    $row[]  =   $crossmatch->nat;


                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            

                    //    if($donar->donation_status == 'not donated'){
                    //    $checkin = '<a href="'.$this->data['base_url'].'/donations/check_in/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-check"></i></a> <a href="'.$this->data['base_url'].'/donations/donation_form/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>';
                    // }else{
                    //     $checkin ='<a href="'.$this->data['base_url'].'/donations/download/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>';
                    // }


                    // $row[]  = '<a href="'.$this->data['base_url'].'/request/request_pdf_download/'.$request->id.'/'.$request->user_id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$request->id.');" ><i class="fa fa-trash"></i></button>';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_crossmatch($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_crossmatch($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function cross_match_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');

        $dataDelete = $this->db->query("DELETE FROM bl_crossmatch WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }


    //Cross Match Form

    function crossmatch_records()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Cross Match Record';
            $bank_id = $_SESSION['bank_id'];
           
            $query = $this->db->select('bl_crossmatch.*')
            ->from('bl_crossmatch')
            // ->join('bl_blood_record', 'bl_blood_record.crossmatch_no = bl_crossmatch.cross_match', 'LEFT')
            ->where('bl_crossmatch.bloodbank_id', $bank_id)
            ->where('bl_crossmatch.status', 'crossmatch')
            ->order_by('bl_crossmatch.ID', 'DESC')
            ->get();
            // print_r($query);exit();
            $this->data['record'] = $query->result();

            $this->theme->title($this->data['page_title'])->load('donations/vw_crossmatch_record', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function indexblood_records()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Record';

            $this->theme->title($this->data['page_title'])->load('donations/vw_bloodrecord', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function update_grouping() {
       
        // Get the data from the POST request
        $id = $this->input->post('id');
        $grouping = $this->input->post('grouping');
        $this->db->query("UPDATE bl_blood_record SET  grouping = '$grouping' WHERE id = '$id'");
             
        echo json_encode(['status' => 'success', 'message' => 'Updated successfully']);
    }

    public function onSearchblood_records()
    {

        // echo "hiii"; die;

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );
                   // Calculate financial year start and end dates
            $currentYear = date('Y');
            $currentMonth = date('m');
        
            if ($currentMonth >= 4) {
                // Financial year is from April of current year to March of next year
                $start_date = "$currentYear-04-01";
                $end_date = ($currentYear + 1) . "-03-31";
            } else {
                // Financial year is from April of the previous year to March of current year
                $start_date = ($currentYear - 1) . "-04-01";
                $end_date = "$currentYear-03-31";
            }
    

                $param['column_search'] = array('unit_no', 'component', 'bag_config', 'blood_group', 'blood_volume', 'tti_test', 'cross_match', 'issue_status');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';
                $posts['start_date']=$start_date;
                $posts['end_date']=$end_date;
                $list = $this->dm->_get_bloodrecord($posts, $param, FALSE, FALSE); 
                //print_obj($list);die;
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';
                
                foreach ($list as $Bloodrecord) {
                    $no++;
                    //print_obj($request);
                    //echo $request;die();
                    // echo $donar['first_name']; die;
                    $row = array();
                    $row[]  =   $no;
                    $row[]  =   $Bloodrecord->unit_no;
                    $row[]  =  $Bloodrecord->component;
                    $row[]  =   $Bloodrecord->bag_config;
                    // $row[]  =   date('d-m-Y',strtotime($donar->created_at));
                    $row[]  =   $Bloodrecord->blood_group;
                    $row[]  =   $Bloodrecord->blood_volume;
                    $row[]  =   $Bloodrecord->tti_test;
                    $row[]  =   $Bloodrecord->cross_match;
                    $row[]  =   $Bloodrecord->issue_status;
                    $row[]  =   $Bloodrecord->issued_vol;
                    $row[]  =   $Bloodrecord->final_vol;

                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            

                    //    if($donar->donation_status == 'not donated'){
                    //    $checkin = '<a href="'.$this->data['base_url'].'/donations/check_in/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-check"></i></a> <a href="'.$this->data['base_url'].'/donations/donation_form/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>';
                    // }else{
                    //     $checkin ='<a href="'.$this->data['base_url'].'/donations/download/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>';
                    // }


                    // $row[]  = '<a href="'.$this->data['base_url'].'/request/request_pdf_download/'.$request->id.'/'.$request->user_id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$request->id.');" ><i class="fa fa-trash"></i></button>';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_bloodrecord($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_bloodrecord($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    //Issue Blood Form
    function issue_blood()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Issue Blood';
            $filters = $this->input->post();
            $this->data['issue_bloodresults'] = $this->get_issued_blood($filters);
            $this->theme->title($this->data['page_title'])->load('Request/vw_issueblood', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function get_issued_blood($filters = [])
    {
        $this->db->select('bl_crossmatch.*, bl_masters.master_type_key_short_value');
        $this->db->from('bl_crossmatch');
        $this->db->join('bl_masters', 'bl_masters.master_id = bl_crossmatch.component');
        $this->db->where('bl_masters.master_type_name', 'Components Types');
        $this->db->where('bl_crossmatch.bloodbank_id', $_SESSION['bank_id']);
        $this->db->where('bl_crossmatch.status', 'issued');
    
        if (!empty($filters)) {
            if (!empty($filters['name'])) {
                $this->db->like('bl_crossmatch.p_name', $filters['name']);
            }
            if (!empty($filters['issue_no'])) {
                $this->db->like('bl_crossmatch.issue_no', $filters['issue_no']);
            }
            if (!empty($filters['request'])) {
                $this->db->like('bl_crossmatch.request', $filters['request']);
            }
            if (!empty($filters['blood_group'])) {
                $this->db->where('bl_crossmatch.blood_group', $filters['blood_group']);
            }
            if (!empty($filters['Component'])) {
                $this->db->where('bl_masters.master_type_key_short_value', $filters['Component']);
            }
            if (!empty($filters['user'])) {
                $this->db->like('bl_crossmatch.issue_by', $filters['user']);
            }
            if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
                $this->db->where('bl_crossmatch.issue_date >=', $filters['start_date']);
                $this->db->where('bl_crossmatch.issue_date <=', $filters['end_date']);
            } elseif (!empty($filters['start_date'])) {
                $this->db->where('bl_crossmatch.issue_date', $filters['start_date']);
            } elseif (!empty($filters['end_date'])) {
                $this->db->where('bl_crossmatch.issue_date', $filters['end_date']);
            }
        }
    
        $this->db->order_by('bl_crossmatch.id', 'DESC');
        return $this->db->get()->result();
    }

    //Issue Blood Form
    function issue_blood_form()
    {
        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Issue Blood Form';

            $this->theme->title($this->data['page_title'])->load('Request/vw_issueblood_form', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function issue_blood_download()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = '';

            $this->theme->title($this->data['page_title'])->load('Request/vw_issuecard', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function issue_bloodform_search()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('unit_no', 'component', 'tube_no', 'blood_group', 'bleeding_date', 'expire_date');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_issueblood($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $issue) {
                    $no++;
                    $row = array();


                    $row[]  =   $no;
                    $row[]  =   $issue->unit_no;
                    $row[]  =   $issue->blood_group;
                    $row[]  =   $issue->component;
                    $row[]  =   $issue->tube_no;
                    // $row[]  =   date('d-m-Y',strtotime($issue->created_at));
                    $row[]  =   $issue->bleeding_date;
                    $row[]  =   $issue->expire_date;
                    $row[]  =   $issue->status;
                    $row[]  =   $issue->coomb_meth;
                    $row[]  =   $issue->part;
                    $row[]  =   $issue->nat;
                    $row[]  =   '<a href="' . $this->data['base_url'] . '/request/issue_blood_download/' . $issue->id . '" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>';

                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            

                    //  if($donar->donation_status == 'not donated'){
                    //     $checkin = '<a href="'.$this->data['base_url'].'/donations/check_in/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-check"></i></a> <a href="'.$this->data['base_url'].'/donations/donation_form/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>';
                    // }else{
                    //     $checkin ='<a href="'.$this->data['base_url'].'/donations/download/'.$donar->donation_form_id.'/'.$donar->user_id.'" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>';
                    // }


                    // $row[]  = $checkin.'  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun('.$donar->id.');" ><i class="fa fa-trash"></i></button>';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_issueblood($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_issueblood($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }


    public function issue_bloodform_delete()
    {

        $id = $this->input->post('id');

        $dataDelete = $this->db->query("DELETE FROM bl_crossmatch WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }
    //Blood Return
    function blood_return()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Return';

            $this->theme->title($this->data['page_title'])->load('Request/vw_bloodreturn', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    //Blood Return Form
    function blood_return_form()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Return Form';

            $this->theme->title($this->data['page_title'])->load('Request/vw_bloodreturn_form', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function blood_returnform_search()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('unit_no', 'component', 'tube_no', 'request', 'issue_no');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_bloodreturn($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $blood_return) {
                    $no++;
                    //    print_obj($blood_return);
                    // echo $blood_return;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    // if(!empty($donar->mid_name)){
                    //     $donar_name=$donar->first_name.' '.$donar->mid_name.' '.$donar->last_name;
                    // }else{
                    //     $donar_name=$donar->first_name.' '.$donar->last_name;
                    // }

                    // if(!empty($donar['mid_name'])){
                    //     $donar_name=$donar['first_name'].' '.$donar['mid_name'].' '.$donar['last_name'];
                    // }else{
                    //     $donar_name=$donar['first_name'].' '.$donar['last_name'];
                    // }

                    $row[]  =   $no;
                    $row[]  =   $blood_return->request;
                    $row[]  =   $blood_return->p_name;
                    $row[]  =   '';
                    $row[]  =   $blood_return->unit_no;
                    // $row[]  =   date('d-m-Y',strtotime($donar->created_at));
                    $row[]  =   $blood_return->component;
                    $row[]  =   $blood_return->tube_no;
                    $row[]  =   $blood_return->issue_date;
                    $row[]  =   $blood_return->issue_no;
                    $row[]  =   $blood_return->hospital;


                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_bloodreturn($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_bloodreturn($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }


    public function blood_returnform_delete()
    {

        $id = $this->input->post('id');

        $dataDelete = $this->db->query("DELETE FROM bl_crossmatch WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    public function onSearchAppointments()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('first_name', 'mid_name', 'last_name', 'email', 'ph_no', 'application_no');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_appointments($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $donar) {
                    $no++;
                    //    print_obj($donar);
                    // echo $donar;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    if (!empty($donar->mid_name)) {
                        $donar_name = $donar->first_name . ' ' . $donar->mid_name . ' ' . $donar->last_name;
                    } else {
                        $donar_name = $donar->first_name . ' ' . $donar->last_name;
                    }

                    // if(!empty($donar['mid_name'])){
                    //     $donar_name=$donar['first_name'].' '.$donar['mid_name'].' '.$donar['last_name'];
                    // }else{
                    //     $donar_name=$donar['first_name'].' '.$donar['last_name'];
                    // }

                    $row[]  =   $no;
                    $row[]  =   $donar_name;
                    $row[]  =   $donar->application_no;
                    $row[]  =   $donar->email;
                    $row[]  =   $donar->ph_no;
                    // $row[]  =   date('d-m-Y',strtotime($donar->created_at));
                    $row[]  =   $donar->requested_schedule_date;
                    $row[]  =   $donar->reason;
                    $row[]  =   ucfirst($donar->donation_status);

                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            

                    if ($donar->donation_status == 'not donated') {
                        $checkin = '<a href="' . $this->data['base_url'] . '/donations/check_in/' . $donar->donation_form_id . '/' . $donar->user_id . '" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-check"></i></a> <a href="' . $this->data['base_url'] . '/donations/donation_form/' . $donar->donation_form_id . '/' . $donar->user_id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>';
                    } else {
                        $checkin = '<a href="' . $this->data['base_url'] . '/donations/download/' . $donar->donation_form_id . '/' . $donar->user_id . '" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a>';
                    }


                    $row[]  = $checkin . '  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $donar->id . ');" ><i class="fa fa-trash"></i></button>';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_appointments($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_appointments($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }



    public function deleteSingleData()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');

        $update = $this->db->query("UPDATE bl_bb_donatioform SET discard_reason = '$discard_reason',discard_by = '$discard_by' , status ='Pending' WHERE id = '$id'");
        if ($update == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    function indexForm()
    {
        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Donation Form';
			$this->data['donations'] = $this->get_filtered_donations($this->input->post());
        
            $this->theme->title($this->data['page_title'])->load('donations/vw_form', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function get_filtered_donations($postData)
    {
        $this->db->select('bl_bb_donatioform.*, bl_donor_examination.examiner_id, bl_bloodbank_user.name as ex_name, bl_users.sign');
        $this->db->from('bl_bb_donatioform');
        $this->db->join('bl_donor_examination', 'bl_bb_donatioform.id = bl_donor_examination.donation_id', 'left');
        $this->db->join('bl_users', 'bl_donor_examination.auth_id = bl_users.id', 'left');
        $this->db->join('bl_bloodbank_user', 'bl_donor_examination.examiner_id = bl_bloodbank_user.id', 'left');
    
        $this->db->where('bl_bb_donatioform.bloodbank_id', $_SESSION['bank_id']);
    
        if (!empty($postData)) {
            if (!empty($postData['name'])) {
                $this->db->like('bl_bb_donatioform.donor_name', $postData['name']);
            }
            if (!empty($postData['mobile'])) {
                $this->db->like('bl_bb_donatioform.mobile', $postData['mobile']);
            }
            if (!empty($postData['start_date']) && !empty($postData['end_date'])) {
                $this->db->where('bl_bb_donatioform.donation_date >=', $postData['start_date']);
                $this->db->where('bl_bb_donatioform.donation_date <=', $postData['end_date']);
            }
            if (!empty($postData['user_no'])) {
                $this->db->like('bl_bb_donatioform.unit_no', $postData['user_no']);
            }
            if (!empty($postData['donor_type'])) {
                $this->db->like('bl_bb_donatioform.donor_type', $postData['donor_type']);
            }
            if (!empty($postData['blood_group'])) {
                $this->db->like('bl_bb_donatioform.blood_group', $postData['blood_group']);
            }
            if (!empty($postData['donation_type'])) {
                $this->db->like('bl_bb_donatioform.camp_status', $postData['donation_type']);
            }
            if (!empty($postData['application_no'])) {
                $this->db->like('bl_bb_donatioform.application_no', $postData['application_no']);
            }
            if (!empty($postData['city'])) {
                $this->db->like('bl_bb_donatioform.city', $postData['city']);
            }
            if (!empty($postData['user'])) {
                $this->db->where('bl_bb_donatioform.donation_by', $postData['user']);
            }
        }
    
        $this->db->order_by('bl_bb_donatioform.id', 'DESC');
        return $this->db->get()->result();
    }

    function examination()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'Donation Examination';
            $this->theme->title($this->data['page_title'])->load('donations/vw_examination', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }

    function Form_add()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Add Donation Form';

            $this->theme->title($this->data['page_title'])->load('donations/vw_add_donationform', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function onSearchForm()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('donor_name', 'registration', 'unit_no', 'blood_group', 'mobile');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_donationform($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $donarform) {
                    $no++;
                    //print_obj($donarform);
                    //echo $donarform; die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    // if(!empty($donar->mid_name)){
                    //     $donar_name=$donar->first_name.' '.$donar->mid_name.' '.$donar->last_name;
                    // }else{
                    //     $donar_name=$donar->first_name.' '.$donar->last_name;
                    // }

                    // if(!empty($donar['mid_name'])){
                    //     $donar_name=$donar['first_name'].' '.$donar['mid_name'].' '.$donar['last_name'];
                    // }else{
                    //     $donar_name=$donar['first_name'].' '.$donar['last_name'];
                    // }

                    $row[]  =   $no;
                    $row[]  =   $donarform->donor_name;
                    $row[]  =   $donarform->registration;
                    // $row[]  =   $donar_application_no;
                    $row[]  =   $donarform->unit_no;
                    $row[]  =   $donarform->donor_type;
                    $row[]  =   $donarform->blood_group;
                    // $row[]  =   date('d-m-Y',strtotime($donarform->created_at));
                    $row[]  =   $donarform->mobile;
                    $row[]  =   $donarform->address;

                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            

                    $row[]  = '<a href="' . $this->data['base_url'] . '/donations/donationform/' . $donarform->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $donarform->id . ');" ><i class="fa fa-trash"></i></button>';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_donationform($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_donationform($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function request_form_delete1()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');

        $dataDelete = $this->db->query("DELETE FROM bl_requestblood WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    public function Form_delete()
    {
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_bb_donatioform WHERE id = '$id'");
        if ($dataDelete == true) {
            echo "1";
        } else {
            echo "2";
        }
    }
    public function Examination_done()
    {
        // echo "<pre>"; print_r($_SESSION); die();
        
        $bank_id = $_SESSION['bank_id'];
        $ex_id = $_SESSION['bloodbank_user_id'];
        $auth_id = $_SESSION['auth_id'];
        $id = $this->input->post('id');
        $query = $this->db->query("SELECT * FROM bl_donor_examination WHERE bank_id = '$bank_id' AND donation_id = '$id'")->row();
        if(!$query){
            $done = $this->db->query("INSERT INTO bl_donor_examination (donation_id , bank_id , examiner_id,auth_id)
            VALUES ('$id','$bank_id', '$ex_id','$auth_id')");
           if ($done == true) {
               echo "1";
           } else {
               echo "2";
           }
        }else{
            echo "2";
        }
        
    }

    //Deferred
    function deferred_request()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Deferred Request';

            $this->theme->title($this->data['page_title'])->load('donations/vw_request_deferrd', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function onSearchdeferred_request()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'p_name'
                );

                $param['column_search'] = array('p_name', 'gender', 'approved_status', 'application_no', 'ph_no', 'hospital');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_request_deffer($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';

                foreach ($list as $request) {
                    $no++;
                    // print_obj($request);
                    // echo $request;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    // if(!empty($donar->mid_name)){
                    //     $donar_name=$donar->first_name.' '.$donar->mid_name.' '.$donar->last_name;
                    // }else{
                    //     $donar_name=$donar->first_name.' '.$donar->last_name;
                    // }

                    // if(!empty($donar['mid_name'])){
                    //     $donar_name=$donar['first_name'].' '.$donar['mid_name'].' '.$donar['last_name'];
                    // }else{
                    //     $donar_name=$donar['first_name'].' '.$donar['last_name'];
                    // }

                    $row[]  =   $no;
                    $row[]  =   $request->application_no;
                    $row[]  =   $request->p_name;
                    if ($request->blood_group == '1') {
                        $row[]  =  'A+';
                    } elseif ($request->blood_group == '2') {
                        $row[]  =  'A-';
                    } elseif ($request->blood_group == '3') {
                        $row[]  =  'AB+';
                    } elseif ($request->blood_group == '4') {
                        $row[]  =  'AB-';
                    } elseif ($request->blood_group == '5') {
                        $row[]  =  'B+';
                    } elseif ($request->blood_group == '6') {
                        $row[]  =  'B-';
                    } elseif ($request->blood_group == '7') {
                        $row[]  =  'O+';
                    } elseif ($request->blood_group == '8') {
                        $row[]  =  'O-';
                    }
                    $row[]  =   $request->phone;
                    // $row[]  =   date('d-m-Y',strtotime($request->created_at));
                    $row[]  =   $request->requested_schedule_date;
                    $row[]  =   $request->reject_reason;
                    //$row[]  =   ucfirst($donar->donation_status);

                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            


                    if ($_SESSION['admin_type'] == '0') {
                        $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                        $per = json_decode($servies_per);

                        if ($per->DeferredDonor_permission  == 'Write') {

                            $row[]  = '<button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $request->id . ');" ><i class="fa fa-trash"></i></button>';
                        } else {
                            $row[]  = '';
                        }
                    } else {
                        $row[]  = '<button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $request->id . ');" ><i class="fa fa-trash"></i></button>';
                    }


                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_request_deffer($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_request_deffer($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }



    public function deferred_request_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');

        $dataDelete = $this->db->query("DELETE FROM bl_blood_request WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    //Deferred
    function indexDeferred()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Deferred Donors';

            $this->theme->title($this->data['page_title'])->load('donations/vw_deferred_donors', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function onSearchDeferred()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('first_name', 'mid_name', 'last_name', 'email', 'ph_no');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_deffer($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';

                foreach ($list as $donar) {
                    $no++;
                    //print_obj($donar);
                    // echo $donar;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    if (!empty($donar->mid_name)) {
                        $donar_name = $donar->first_name . ' ' . $donar->mid_name . ' ' . $donar->last_name;
                    } else {
                        $donar_name = $donar->first_name . ' ' . $donar->last_name;
                    }

                    // if(!empty($donar['mid_name'])){
                    //     $donar_name=$donar['first_name'].' '.$donar['mid_name'].' '.$donar['last_name'];
                    // }else{
                    //     $donar_name=$donar['first_name'].' '.$donar['last_name'];
                    // }

                    $row[]  =   $no;
                    $row[]  =   $donar->application_no;
                    $row[]  =   $donar_name;
                    if ($donar->blood_group == '1') {
                        $row[]  =  'A+';
                    } elseif ($donar->blood_group == '2') {
                        $row[]  =  'A-';
                    } elseif ($donar->blood_group == '3') {
                        $row[]  =  'AB+';
                    } elseif ($donar->blood_group == '4') {
                        $row[]  =  'AB-';
                    } elseif ($donar->blood_group == '5') {
                        $row[]  =  'B+';
                    } elseif ($donar->blood_group == '6') {
                        $row[]  =  'B-';
                    } elseif ($donar->blood_group == '7') {
                        $row[]  =  'O+';
                    } elseif ($donar->blood_group == '8') {
                        $row[]  =  'O-';
                    }
                    $row[]  =   $donar->ph_no;
                    // $row[]  =   date('d-m-Y',strtotime($donar->created_at));
                    $row[]  =   $donar->requested_schedule_date;
                    $row[]  =   $donar->reason;
                    //$row[]  =   ucfirst($donar->donation_status);

                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            


                    if ($_SESSION['admin_type'] == '0') {
                        $servies_per = $_SESSION['bloodbank_user_servies_permission'];
                        $per = json_decode($servies_per);

                        if ($per->DeferredDonor_permission  == 'Write') {

                            $row[]  = '<button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $donar->id . ');" ><i class="fa fa-trash"></i></button>';
                        } else {
                            $row[]  = '';
                        }
                    } else {
                        $row[]  = '<button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $donar->id . ');" ><i class="fa fa-trash"></i></button>';
                    }


                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_deffer($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_deffer($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }



    public function Deferred_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');

        //         // echo $id; die;
        // $query = $this->db->query("SELECT * FROM bl_blood_donation_requests WHERE user_id = '$id'");
        //  foreach ($query->result() as $row)
        //                   {
        //                    $form_id = $row->form_id;
        //                    // print_r($form_id);die();
        //                   }
        //    $dataDelete = $this->db->query("DELETE FROM bl_blood_donation_requests WHERE user_id = '$id'");
        //     // echo $dataDelete; die;
        //    if ($dataDelete==true) {
        //         $Delete = $this->db->query("DELETE FROM bl_donar_form_info WHERE form_id = '$form_id'");
        //         // echo $dataDelete; die;
        //        if ($Delete==true) {
        //            echo "Done"; 
        //        }else{
        //            echo "Fail";
        //        }

        //    }else{
        //            echo "Fail";
        //    }
        $dataDelete = $this->db->query("DELETE FROM bl_blood_donation_requests WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    //TTI Test
    function indexttitest()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'TTI Test';
            $filters = $this->input->post(null, true); // get sanitized post data

            // if reset clicked
            if ($this->input->post('reset')) {
                $filters = [];
            }
            $this->data['donations'] = $this->getFilteredDonations($filters, $_SESSION['bank_id']);
            $this->theme->title($this->data['page_title'])->load('donations/vw_ttitest', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    public function getFilteredDonations($filters, $bank_id)
    {
        $this->db->select('bl_bb_donatioform.*, bl_donor_examination.examiner_id, bl_bloodbank_user.name as ex_name, bl_users.sign')
            ->from('bl_bb_donatioform')
            ->join('bl_donor_examination', 'bl_bb_donatioform.id = bl_donor_examination.donation_id', 'left')
            ->join('bl_users', 'bl_donor_examination.auth_id = bl_users.id', 'left')
            ->join('bl_bloodbank_user', 'bl_donor_examination.examiner_id = bl_bloodbank_user.id', 'left')
            ->where('bl_bb_donatioform.bloodbank_id', $bank_id);
    
        if (!empty($filters)) {
            if (!empty($filters['name'])) {
                $this->db->like('bl_bb_donatioform.donor_name', $filters['name']);
            }
            if (!empty($filters['unit_no'])) {
                $this->db->like('bl_bb_donatioform.unit_no', $filters['unit_no']);
            }
            if (!empty($filters['blood_group'])) {
                $this->db->where('bl_bb_donatioform.blood_group', $filters['blood_group']);
            }
            if (!empty($filters['status'])) {
                $this->db->where('bl_bb_donatioform.status', $filters['status']);
            }
            if (!empty($filters['donation_type'])) {
                $this->db->where('bl_bb_donatioform.camp_status', $filters['donation_type']);
            }
            if (!empty($filters['user'])) {
                $this->db->where('bl_bb_donatioform.ttitest_by', $filters['user']);
            }
    
            if (!empty($filters['test_result'])) {
                $this->db->group_start();
                $this->db->where('hiv', $filters['test_result']);
                $this->db->or_where('hbsag', $filters['test_result']);
                $this->db->or_where('hcv', $filters['test_result']);
                $this->db->or_where('vdrl', $filters['test_result']);
                $this->db->or_where('malaria', $filters['test_result']);
                $this->db->or_where('anti_hbc', $filters['test_result']);
                $this->db->group_end();
            }
    
            if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
                $this->db->where('donation_date >=', $filters['start_date']);
                $this->db->where('donation_date <=', $filters['end_date']);
            } elseif (!empty($filters['start_date'])) {
                $this->db->where('donation_date', $filters['start_date']);
            } elseif (!empty($filters['end_date'])) {
                $this->db->where('donation_date', $filters['end_date']);
            }
        }
    
        $this->db->order_by('bl_bb_donatioform.id', 'DESC');
        return $this->db->get()->result();
    }

    public function onSearchttitest()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('donor_name', 'blood_group', 'hiv', 'hbsag', 'hcv', 'vdrl', 'malaria', 'anti_hbc');

                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_donationform($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $donar_ttitest) {
                    $no++;
                    //                  print_obj($donar);
                    // echo $donar;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $donar_ttitest->donor_name;
                    $row[]  =   $donar_ttitest->blood_group;
                    $row[]  =   $donar_ttitest->hiv;
                    $row[]  =   $donar_ttitest->hbsag;
                    $row[]  =   $donar_ttitest->hcv;
                    $row[]  =   $donar_ttitest->vdrl;
                    $row[]  =   $donar_ttitest->malaria;
                    $row[]  =   $donar_ttitest->anti_hbc;
                    $row[]  = $donar_ttitest->status;
                    $row[]  = '<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModalScrollable' . $donar_ttitest->id . '" style="color:white;"><i class="fa fa-check"></i></button> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $donar_ttitest->id . ');" ><i class="fa fa-trash"></i></button> ';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_donationform($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_donationform($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function ttitest_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_bb_donatioform WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }
    //Deferred
    function indexdiscard()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Discard Blood';

            $this->theme->title($this->data['page_title'])->load('donations/vw_discard', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function discard_add()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Add Discard';

            $this->theme->title($this->data['page_title'])->load('donations/vw_discard_add', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function get_com($comp){
            if ($comp == 18) {
            $component = "wholeblood";
            } elseif ($comp == 19) {
            $component = "CRYO";
            } elseif ($comp == 20) {
            $component = "FFP";
            } elseif ($comp == 21) {
            $component = "RDP";
            } elseif ($comp == 22) {
            $component = "PRBC";
            }  elseif ($comp == 886) {
            $component = "SDP";
            }  elseif ($comp == 885) {
            $component = "CPP";
            } else {
            $component = $comp;
            } 
            
            return $component;
    }

    public function onSearchdiscard()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            //if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){
            $param['column_order'] = array(
                null,
                'first_name'
            );

            $param['column_search'] = array('unit_no', 'tube_no', 'blood_group', 'component', 'issue_no', 'discard_no');
            $param['order'] = array('id' => 'ASC');
            $posts = $this->input->post();

            $param['type_key'] = 'blood_groups';

            $list = $this->dm->_get_discard($posts, $param, FALSE, FALSE);


            $data = array();
            $no = isset($posts['start']) ? $posts['start'] : 0;

            $action = '';

            log_message('error',json_encode($list));

            foreach ($list as $discard) {
                $no++;
                $com_p = $this->get_com($discard->com_p);
                $comp = $this->get_com($discard->comp);
                $row = array();

                $row[]  =   $no;
                $row[]  =   $discard->unit_no.$discard->unitno.$discard->dunitno;
                $row[]  =   $discard->bg.$discard->b_g.$discard->blood_group;
                $row[]  =   $discard->discard_res !="TTI Reactive" ? $com_p.$comp :"";
                $row[]  =   date('d-m-Y', strtotime($discard->date));
                // $row[]  =   $discard->date;
                $row[]  =   $discard->discard_no;
                $row[]  =   $discard->discard_res;
                $row[]  =   $discard->discard_by;
                $row[]  = '<button type="button" class="btn btn-xs btn-dark" onclick="thrown(' . $discard->id . ', \'autoclaved\');" >' . $discard->autoclaved . '</button>';
                $row[]  = '<button type="button" class="btn btn-xs btn-dark" onclick="thrown(' . $discard->id . ', \'handover\');" >' . $discard->handover . '</button>';
                $row[]  = '<button type="button" class="btn btn-xs btn-dark" disabled onclick="deleteFun(' . $discard->id . ');" ><i class="fa fa-trash"></i></button> ';

                $data[] = $row;
            }
            

            $output = array(
                "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                "recordsTotal" => $this->dm->_get_discard($posts, $param, TRUE),
                "recordsFiltered" => $this->dm->_get_discard($posts, $param, TRUE),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect($this->data['base_url']);
        }
        // }else{
        //     redirect($this->data['base_url']);
        // }
    }


    public function discard_component()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {


            $posts = $this->input->post();
            $param['column_order'] = array(
                null,
                'first_name'
            );

            $param['column_search'] = array('unit_no', 'tube_no', 'blood_group', 'component', 'collection_date', 'discard_no');
            $param['order'] = array('id' => 'ASC');
            $posts = $this->input->post();

            $param['type_key'] = 'blood_groups';

            $list = $this->dm->_get_discard_com($posts, $param, FALSE, FALSE);


            $data = array();

            $action = '';



            foreach ($list as $index => $discard) {

                $row = array();

                $row[]  =   ++$index;
                $row[]  =   $discard->unit_no;
                $row[]  =   $discard->tube_no;
                $row[]  =   $discard->blood_group;
                $row[]  =   $discard->component;
                $row[]  =   $discard->collection_date;
                $row[]  =   $discard->status;
                $row[]  =   $discard->discard_no;
                $row[]  =   $discard->discard_reason;
                $row[]  = '<button type="button" class="btn btn-xs btn-dark" onclick="throwncom(' . $discard->id . ');" >' . $discard->is_throw . '</button>';
                // $row[]  ='<button type="button" class="btn btn-xs btn-dark" onclick="deletecom('.$discard->id.');" ><i class="fa fa-trash"></i></button> ';

                $data[] = $row;
            }

            $output = array(
                "draw" => isset($posts['draw']) ? $posts['draw'] : '',

                "recordsTotal" => $this->dm->_get_discard_com($posts, $param, TRUE),
                "recordsFiltered" => $this->dm->_get_discard_com($posts, $param, TRUE),
                //  "recordsTotal" => $query->num_rows(),
                //    "recordsFiltered" => $query->num_rows(),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect($this->data['base_url']);
        }
    }
    public function discard_tti()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {


            $posts = $this->input->post();
            $param['column_order'] = array(
                null,
                'first_name'
            );

            $param['column_search'] = array('unit_no', 'tube', 'blood_group', 'donation_date', 'discard_no');
            $param['order'] = array('id' => 'ASC');
            $posts = $this->input->post();

            $param['type_key'] = 'blood_groups';

            $list = $this->dm->_get_discard_tti($posts, $param, FALSE, FALSE);

            $data = array();

            $action = '';



            foreach ($list as $index => $discard) {

                $row = array();

                $row[]  =   ++$index;
                $row[]  =   $discard->unit_no;
                $row[]  =   $discard->tube;
                $row[]  =   $discard->blood_group;
                // $row[]  =   $discard->component;
                $row[]  =   $discard->donation_date;
                $row[]  =   $discard->status;
                $row[]  =   $discard->discard_no;
                $row[]  =   "TTI test is Positive";
                $row[]  = '<button type="button" class="btn btn-xs btn-dark" onclick="throwntti(' . $discard->id . ');" >' . $discard->is_throw . '</button>';
                $row[]  = '<button type="button" class="btn btn-xs btn-dark" onclick="deletetti(' . $discard->id . ');" ><i class="fa fa-trash"></i></button> ';

                $data[] = $row;
            }

            $output = array(
                "draw" => isset($posts['draw']) ? $posts['draw'] : '',

                "recordsTotal" => $this->dm->_get_discard_tti($posts, $param, TRUE),
                "recordsFiltered" => $this->dm->_get_discard_tti($posts, $param, TRUE),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function discard_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        //$dataDelete = $this->db->query("DELETE FROM bl_crossmatch WHERE id = '$id'");

        $dataDelete = $this->db->query("UPDATE bl_crossmatch SET status = 'issued',is_throw = 'No' WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    public function discard_tti_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        //$dataDelete = $this->db->query("DELETE FROM bl_crossmatch WHERE id = '$id'");

        $dataDelete = $this->db->query("UPDATE bl_bb_donatioform SET status = 'Test Not Done',is_throw = 'No' WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }
    public function discard_com_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        //$dataDelete = $this->db->query("DELETE FROM bl_crossmatch WHERE id = '$id'");

        $dataDelete = $this->db->query("UPDATE bl_blood_record SET status = '',is_throw = 'No' WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }
    public function discard_thrown()
    {
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        if($type == 'autoclaved'){
           $dataDelete = $this->db->query("UPDATE bl_discard SET autoclaved = 'Yes' WHERE id = '$id'");
 
        }
        if($type == 'handover'){
          $dataDelete = $this->db->query("UPDATE bl_discard SET handover = 'Yes' WHERE id = '$id'");
  
        }
        
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }
    public function discard_thrown_tti()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("UPDATE bl_bb_donatioform SET is_throw = 'Yes' WHERE id = '$id'");

        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    public function discard_thrown_component()
    {
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("UPDATE bl_blood_record SET is_throw = 'Yes' WHERE id = '$id'");

        if ($dataDelete == true) {
            echo "1";
        } else {
            echo "2";
        }
    }
    // function indexinvcomponents()
    // {


    //     if (session_userdata('isAdminLoggedin')) {

    //         $this->data['page_title'] = 'Components Entry';

    //         $this->theme->title($this->data['page_title'])->load('donations/vw_invcomponents', $this->data);
    //     } else {

    //         redirect($this->data['base_url']);
    //     }
    // }
    function indexinvcomponents()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Components Entry';
            // Pagination------
            $this->load->library('pagination');
            $bank_id = $_SESSION['bank_id'];
            $limit = 10; // Number of records per page
            $filters = [
                'blood_group' => $this->input->get('blood_group'),
                'storage_type' => $this->input->get('storage_type'),
                'user' => $this->input->get('user'),
                'unit_no' => $this->input->get('unit_no'),
                'start_date' => $this->input->get('start_date'),
                'end_date' => $this->input->get('end_date'),
                // 'request_from' => $this->input->get('request_from'),
                // 'request_to' => $this->input->get('request_to'),
                'component' => $this->input->get('component'),
            ];
            $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
            $totalRows = $this->dr->getInvComptotal($bank_id, $filters);
            // echo $totalRows; die();
            // Generate custom pagination
            $offset = ($page - 1) * $limit;
            $base_url = base_url() . 'admin/donations/invcomponents';
            $query_string = http_build_query($filters);
            $page_url = $base_url . '?' . $query_string . '&page=';
            $current_page = ($offset > 0) ? ($offset / $limit) + 1 : 1;
            $pagination_links = $this->custompagination($totalRows,$offset,$limit,$page_url,$current_page);
            $offset = ($current_page - 1) * $limit;
            
            $rec = $this->dr->getInvComp($limit, $offset, $bank_id, $filters);
            // print_r($rec);
            // die();
            $this->data['record'] = $rec;
            $this->data['filter_data'] = $filters;
            $this->data['pagination'] = $pagination_links; 
            // ------------------------

            $this->theme->title($this->data['page_title'])->load('donations/vw_invcomponents', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function onSearchinvcomponents()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('donor_name', 'blood_group');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_components($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $component) {
                    $no++;
                    // print_obj($component);
                    //echo $component;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $component->unit_no;
                    $row[]  =   $component->donor_name;
                    $row[]  =   $component->blood_group;
                    $row[]  =   $component->tube;
                    $row[]  =   $component->hiv;
                    $row[]  =   $component->hbsag;
                    $row[]  =   $component->hcv;
                    $row[]  =   $component->vdrl;
                    $row[]  =   $component->malaria;
                    $row[]  =   $component->anti_hbc;
                    if ($component->storge_type == 'wholeblood') {
                        $row[] = $component->storge_type;
                    } else {
                        $comp = json_decode($component->component);
                        if ($comp->CPP_component == '') {
                            $CPP = '';
                        } else {
                            $CPP  =   'CPP' . '(' . $comp->CPP_component . 'ml)';
                        }
                        if ($comp->CRYO_component == '') {
                            $CRYO = '';
                        } else {
                            $CRYO  =   'CRYO' . '(' . $comp->CRYO_component . 'ml)';
                        }
                        if ($comp->FFP_component == '') {
                            $FFP = '';
                        } else {
                            $FFP  =   'FFP' . '(' . $comp->FFP_component . 'ml)';
                        }
                        if ($comp->RBC_component == '') {
                            $RBC = '';
                        } else {
                            $RBC  =   'RBC' . '(' . $comp->RBC_component . 'ml)';
                        }
                        if ($comp->PRC_component == '') {
                            $PRC = '';
                        } else {
                            $PRC  =   'PRC' . '(' . $comp->PRC_component . 'ml)';
                        }

                        $row[]  =   $CPP . ',' . $CRYO . ',' . $FFP . ',' . $RBC . ',' . $PRC;
                    }

                    //  $row[]  =   $component->wb .'ml';   

                    // if ($component->cpp == '0') {
                    //    $row[] = 'NAN';  
                    //  }  else{
                    //    $row[]  =   $component->cpp . '(' .$component->volume_cpp . 'ml)'; 
                    //  } 
                    //   if ($component->cryo == '0') {
                    //    $row[] = 'NAN';  
                    //  }  else{
                    //   $row[]  =   $component->cryo . '(' .$component->volume_cryp . 'ml)'; 
                    //  }
                    //   if ($component->ffp == '0') {
                    //    $row[] = 'NAN';  
                    //  }  else{
                    //    $row[]  =   $component->ffp . '('.$component->volume_ffp . 'ml)';
                    //  }
                    //   if ($component->rbc == '0') {
                    //    $row[] = 'NAN';  
                    //  }  else{
                    //   $row[]  =   $component->rbc . '('.$component->volume_rbc . 'ml)';
                    //  }              
                    //   if ($component->prc == '0') {
                    //    $row[] = 'NAN';  
                    //  }  else{
                    //     $row[]  =   $component->prc . '('.$component->volume_prc . 'ml)';
                    //  }

                    //donation_form_id

                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            

                    $row[]  = '<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModalScrollable' . $component->id . '" style="color:white;"><i class="fa fa-check"></i></button> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $component->id . ');" ><i class="fa fa-trash"></i></button> ';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_components($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_components($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }



    public function invcomponents_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_bb_donatioform WHERE id = '$id'");
        echo $dataDelete;
        die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }
   
    //Inventory Blood Stock
    function indexbloodstock()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Stock';
            $bank_id = $_SESSION['bank_id'];
            $component = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id= '$bank_id'")->row();
            $ids = explode(',', $component->components_available);
            if (!in_array(18, $ids)) {
                array_unshift($ids, 18);
            }
            $bloodGroups = ['A_pos','A_neg','B_pos','B_neg','AB_pos','AB_neg','O_pos','O_neg'];
           
            $array_com = array();
            foreach ($ids as $v) {
                $query = $this->db->query("SELECT bl_masters.master_id,bl_masters.master_type_key_short_value FROM bl_masters WHERE master_id  = '$v'");
                foreach ($query->result() as &$components) {
                    foreach($bloodGroups as $bloodGroupsr){
                        $components->$bloodGroupsr = 0 ;
                    }
                    $array_com[] = $components;
                }
            }  
            $txt = "No";
            $current_date = date('Y-m-d'); 
            foreach($array_com as &$row){
                    if($row->master_id == 18){
                        $comp = [18,'wholeblood'];
                    }else{
                        $comp = [$row->master_id];
                    }
                // Start query to count matching records
                    $this->db->select('id');
                    $this->db->from('bl_blood_record');
                    $this->db->where_in('component', $comp);
                    $this->db->where('cross_match', $txt);
                    $this->db->where('expiry_date >', $current_date);
                    $this->db->where('status', NULL, FALSE);
                
                    // Apply blood bank condition if admin_type is 5
                    if ($_SESSION['admin_type'] == 5) {
                        $B_id = $_SESSION['bank_id'];
                        $this->db->where('bloodbank_id', $B_id);
                    }
                    // Execute the query and get the count
                    $query = $this->db->get();
                    $row->total = $query->num_rows(); 
                    
                 $row->A_pos = $this->blood_group_data($comp,'A+',$bank_id);
                 $row->A_neg =  $this->blood_group_data($comp,'A-',$bank_id);
                 $row->AB_pos =  $this->blood_group_data($comp,'AB+',$bank_id);
                 $row->AB_neg =  $this->blood_group_data($comp,'AB-',$bank_id);
                 $row->B_pos =  $this->blood_group_data($comp,'B+',$bank_id);
                 $row->B_neg =  $this->blood_group_data($comp,'B-',$bank_id);
                 $row->O_pos =  $this->blood_group_data($comp,'O+',$bank_id);
                 $row->O_neg =  $this->blood_group_data($comp,'O-',$bank_id);
                
            }
            $wp = ['Untested','Tested'];
            $wp_data = array();
            foreach($wp as &$rowp){
                $rows = new stdClass();
                $rows->comp = $rowp;
                foreach($bloodGroups as $bloodGroupsr){
                        $rows->$bloodGroupsr = 0;
                    }
                $rows->total = 0;
                $wp_data[]=$rows;
            }
            foreach($wp_data as $rowht){
                 $rowht->A_pos = $this->wp_test('A+',$rowht->comp,$bank_id);
                 $rowht->A_neg =  $this->wp_test('A-',$rowht->comp,$bank_id);
                 $rowht->AB_pos =  $this->wp_test('AB+',$rowht->comp,$bank_id);
                 $rowht->AB_neg =  $this->wp_test('AB-',$rowht->comp,$bank_id);
                 $rowht->B_pos =  $this->wp_test('B+',$rowht->comp,$bank_id);
                 $rowht->B_neg =  $this->wp_test('B-',$rowht->comp,$bank_id);
                 $rowht->O_pos =  $this->wp_test('O+',$rowht->comp,$bank_id);
                 $rowht->O_neg =  $this->wp_test('O-',$rowht->comp,$bank_id);
                 $rowht->total = $rowht->A_pos+$rowht->A_neg+$rowht->AB_pos+$rowht->AB_neg+$rowht->B_pos+$rowht->B_neg+$rowht->O_pos+$rowht->O_neg;
            }
            
            $this->data['bank_component'] = $array_com;
            $this->data['wp_component'] = $wp_data;
            
            $this->data['page_title'] = 'Blood Stock';
            
            $this->theme->title($this->data['page_title'])->load('donations/vw_invbloodstocks', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
   

    public function onSearchbloodstock()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('master_type_key_value', 'ave', 'ane', 'abve', 'abne', 'bve', 'bne', 'ove', 'one');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_bloodstock($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $bloodstock) {
                    $no++;
                    //print_obj($bloodstock); die;
                    // echo $bloodstock;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $bloodstock->master_type_key_value;
                    $row[]  =   $bloodstock->ave;
                    $row[]  =   $bloodstock->ane;
                    $row[]  =   $bloodstock->abve;
                    $row[]  =   $bloodstock->abne;
                    $row[]  =   $bloodstock->bve;
                    $row[]  =   $bloodstock->bne;
                    $row[]  =   $bloodstock->ove;
                    $row[]  =   $bloodstock->one;

                    //donation_form_id

                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            

                    $row[]  = '<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModalScrollable' . $bloodstock->id . '" style="color:white;"><i class="fa fa-check"></i></button>  ';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_bloodstock($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_bloodstock($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }



    public function bloodstock_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_blood_donation_requests WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }
    //Inventory Consumables
    function indexconsumable()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Consumables';

            $this->theme->title($this->data['page_title'])->load('donations/vw_invconsumables', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }


    function consumable_add()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Add Consumable';

            $this->theme->title($this->data['page_title'])->load('donations/vw_consumble_add', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function consumable_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit Consumable';

            $this->theme->title($this->data['page_title'])->load('donations/vw_consumble_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function onSearchconsumable()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('item_name', 'manufacture_name', 'consumable_type', 'receive_condition', 'received_by', 'result_testing');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_consumable($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $consumable) {
                    $no++;
                    //                  print_obj($donar);
                    // echo $donar;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $consumable->item_name;
                    $row[]  =   $consumable->manufacture_name;
                    $row[]  =   $consumable->consumable_type;
                    $row[]  =   $consumable->receive_condition;
                    $row[]  =   $consumable->qty_total;
                    $row[]  =   $consumable->result_testing;
                    $row[]  =   $consumable->received_by;
                    //donation_form_id

                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            

                    $row[]  = '<a href="' . $this->data['base_url'] . '/donations/consumable/edit/' . $consumable->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a>  <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $consumable->id . ');" ><i class="fa fa-trash"></i></button> ';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_consumable($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_consumable($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }



    public function consumable_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_consumable WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    // Quality Control

    function qc_reagents()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'QC for Reagents';

            $this->theme->title($this->data['page_title'])->load('donations/vw_qc_reagents', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }


    function qc_reagents__add()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Add QC for Reagents';

            $this->theme->title($this->data['page_title'])->load('donations/vw_qc_reagents_add', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function qc_reagents_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit QC for Reagents';

            $this->theme->title($this->data['page_title'])->load('donations/vw_qc_reagents_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function qc_reagents_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_qc_reagents WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    // QC for Blood & Components

    function qc_blood_components()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'QC for Blood & Components';

            $this->theme->title($this->data['page_title'])->load('donations/qc_blood_components', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }


    function qc_blood_components__add()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Add QC for Blood & Components';

            $this->theme->title($this->data['page_title'])->load('donations/vw_qc_blood_components_add', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function qc_blood_components_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit QC for Blood & Components';

            $this->theme->title($this->data['page_title'])->load('donations/vw_qc_blood_components_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function qc_blood_components_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_qc_component WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }


    // Quality Control

    function all_qc_reagents()
    {
        // print_r('hii');die();
        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'All QC for Reagents';

            $this->theme->title($this->data['page_title'])->load('Request/vw_all_qc_reagents', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }


    function all_qc_reagents__add()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Add QC for Reagents';

            $this->theme->title($this->data['page_title'])->load('Request/vw_all_qc_reagents_add', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function all_qc_reagents_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit QC for Reagents';

            $this->theme->title($this->data['page_title'])->load('Request/vw_all_qc_reagents_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function all_qc_reagents_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_qc_reagents WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    // QC for Blood & Components

    function all_qc_blood_components()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'All QC for Blood & Components';

            $this->theme->title($this->data['page_title'])->load('Request/vw_all_qc_blood_components', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }


    function all_qc_blood_components__add()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Add QC for Blood & Components';

            $this->theme->title($this->data['page_title'])->load('Request/vw_all_qc_blood_components_add', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function all_qc_blood_components_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit QC for Blood & Components';

            $this->theme->title($this->data['page_title'])->load('Request/vw_all_qc_blood_components_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function all_qc_blood_components_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_qc_component WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    //Blood Camps
    function indexbloodcamps()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Camp';

            $this->theme->title($this->data['page_title'])->load('donations/vw_bloodcamp', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function bloodcamps_add()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Add New Blood Camp';

            $this->theme->title($this->data['page_title'])->load('donations/vw_bloodcamp_add', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function bloodcamps_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit Blood Camp';

            $this->theme->title($this->data['page_title'])->load('donations/vw_bloodcamp_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function onSearchbloodcamps()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('blood_name', 'camp_code', 'start_date', 'end_date', 'venue', 'sponsored', 'address', 'mobile');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_bloodcamp($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $blood_camp) {
                    $no++;
                    //                  print_obj($donar);
                    // echo $donar;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $blood_camp->blood_name;
                    $row[]  =   $blood_camp->camp_code;
                    $row[]  =   $blood_camp->start_date;
                    $row[]  =   $blood_camp->end_date;
                    $row[]  =   $blood_camp->venue;
                    $row[]  =   $blood_camp->sponsored;
                    $row[]  =   $blood_camp->address;
                    $row[]  =   $blood_camp->mobile;
                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            

                    $row[]  = '<a href="' . $this->data['base_url'] . '/donations/bloodcamps/edit/' . $blood_camp->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $blood_camp->id . ');" ><i class="fa fa-trash"></i></button> ';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_bloodcamp($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_bloodcamp($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function bloodcamps_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_bloodcamp WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    // public function bloodcamps_update()
    // {
    //     //echo 'hiiii'; die;
    //     //alert('sdadassad'); die();
    //     $id = $this->input->post('id');
    //     // print_r($id);die();
    //     $dataupdate = $this->db->query("UPDATE bl_bloodcamp SET status = '1' WHERE id = '$id'");
    //     //echo $dataupdate; die;
    //     if ($dataupdate == true) {

    //         echo "1";
    //     } else {
    //         echo "2";
    //     }
    // }
    public function bloodcamps_update()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $reason = $this->input->post('reason'); // get reason from POST
    
        if ($status == '0') {
            // Disapprove with reason
            $data = [
                'status' => $status,
                'disapprove_reason' => $reason
            ];
        } else {
            // Approve or other status
            $data = ['status' => $status];
        }
    
        $this->db->where('id', $id);
        $updated = $this->db->update('bl_bloodcamp', $data);
    
        if ($updated) {
            echo "1"; // success
        } else {
            echo "2"; // fail
        }
    }

    //Consumables Items 
    function indexconsumables_items()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Consumables Items';

            $this->theme->title($this->data['page_title'])->load('donations/vw_consumbles_items', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    // function consumables_items_add(){

    //     if(session_userdata('isAdminLoggedin')){

    //         $this->data['page_title']='Add New Consumables Items';

    //         $this->theme->title($this->data['page_title'])->load('donations/vw_consumbles_items_add', $this->data);
    //     }else{

    //         redirect($this->data['base_url']);
    //     }
    // }
    function consumables_items_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit Consumables Items';

            $this->theme->title($this->data['page_title'])->load('donations/vw_consumbles_items', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function onSearchconsumables_items()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('master_type_key_value');
                $param['order'] = array('master_id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_consumables_item($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $item) {
                    $no++;
                    //                  print_obj($donar);
                    // echo $donar;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    // if(!empty($donar->mid_name)){
                    //     $donar_name=$donar->first_name.' '.$donar->mid_name.' '.$donar->last_name;
                    // }else{
                    //     $donar_name=$donar->first_name.' '.$donar->last_name;
                    // }

                    // if(!empty($donar['mid_name'])){
                    //     $donar_name=$donar['first_name'].' '.$donar['mid_name'].' '.$donar['last_name'];
                    // }else{
                    //     $donar_name=$donar['first_name'].' '.$donar['last_name'];
                    // }

                    $row[]  =   $no;
                    $row[]  =   $item->master_type_key_value;

                    //donation_form_id

                    // $row[]  =   $donar['email'];
                    // $row[]  =   $donar['ph_no'];   
                    // $row[]  =   date('d-m-Y',strtotime($donar['created_at']));            

                    $row[]  = '<a href="' . $this->data['base_url'] . '/donations/consumables_items/edit/' . $item->master_id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $item->master_id . ');" ><i class="fa fa-trash"></i></button> ';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_consumables_item($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_consumables_item($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function consumables_items_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_bloodbank_master WHERE master_id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    //Manufactures
    function indexmanufactures()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Manufactures';

            $this->theme->title($this->data['page_title'])->load('donations/vw_manufactures', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    //     function manufactures_add(){

    //     if(session_userdata('isAdminLoggedin')){

    //         $this->data['page_title']='Add New Manufactures';

    //         $this->theme->title($this->data['page_title'])->load('donations/vw_manufactures_add', $this->data);
    //     }else{

    //         redirect($this->data['base_url']);
    //     }
    // }
    function manufactures_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit Manufactures';

            $this->theme->title($this->data['page_title'])->load('donations/vw_manufactures', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function onSearchmanufactures()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('master_type_key_value');
                $param['order'] = array('master_id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_manufecture($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $manufecture) {
                    $no++;
                    // print_obj($manufecture);
                    // echo $manufecture;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    // if(!empty($donar->mid_name)){
                    //     $donar_name=$donar->first_name.' '.$donar->mid_name.' '.$donar->last_name;
                    // }else{
                    //     $donar_name=$donar->first_name.' '.$donar->last_name;
                    // }

                    // if(!empty($donar['mid_name'])){
                    //     $donar_name=$donar['first_name'].' '.$donar['mid_name'].' '.$donar['last_name'];
                    // }else{
                    //     $donar_name=$donar['first_name'].' '.$donar['last_name'];
                    // }

                    $row[]  =   $no;
                    $row[]  =   $manufecture->master_type_key_value;



                    $row[]  = '<a href="' . $this->data['base_url'] . '/donations/manufactures/edit/' . $manufecture->master_id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $manufecture->master_id . ');" ><i class="fa fa-trash"></i></button> ';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_manufecture($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_manufecture($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function manufactures_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_bloodbank_master WHERE master_id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    //Consumables Type
    function indexconsumables_types()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Consumables Type';

            $this->theme->title($this->data['page_title'])->load('donations/vw_consumble_type', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    //     function manufactures_add(){

    //     if(session_userdata('isAdminLoggedin')){

    //         $this->data['page_title']='Add New Manufactures';

    //         $this->theme->title($this->data['page_title'])->load('donations/vw_manufactures_add', $this->data);
    //     }else{

    //         redirect($this->data['base_url']);
    //     }
    // }
    function consumables_types_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit Consumables Type';

            $this->theme->title($this->data['page_title'])->load('donations/vw_consumble_type', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function onSearchconsumables_types()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('master_type_key_value');
                $param['order'] = array('master_id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_consumable_type($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $manufecture) {
                    $no++;
                    // print_obj($manufecture);
                    // echo $manufecture;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    // if(!empty($donar->mid_name)){
                    //     $donar_name=$donar->first_name.' '.$donar->mid_name.' '.$donar->last_name;
                    // }else{
                    //     $donar_name=$donar->first_name.' '.$donar->last_name;
                    // }

                    // if(!empty($donar['mid_name'])){
                    //     $donar_name=$donar['first_name'].' '.$donar['mid_name'].' '.$donar['last_name'];
                    // }else{
                    //     $donar_name=$donar['first_name'].' '.$donar['last_name'];
                    // }

                    $row[]  =   $no;
                    $row[]  =   $manufecture->master_type_key_value;



                    $row[]  = '<a href="' . $this->data['base_url'] . '/donations/consumables_types/edit/' . $manufecture->master_id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $manufecture->master_id . ');" ><i class="fa fa-trash"></i></button> ';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_consumable_type($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_consumable_type($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function consumables_types_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_bloodbank_master WHERE master_id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }

    //Consumable Receive Condition
    function indexconsumables_recive()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Consumable Receive Condition';

            $this->theme->title($this->data['page_title'])->load('donations/vw_consumable_recive', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    //     function manufactures_add(){

    //     if(session_userdata('isAdminLoggedin')){

    //         $this->data['page_title']='Add New Manufactures';

    //         $this->theme->title($this->data['page_title'])->load('donations/vw_manufactures_add', $this->data);
    //     }else{

    //         redirect($this->data['base_url']);
    //     }
    // }
    function consumables_recive_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit Consumable Receive Condition';

            $this->theme->title($this->data['page_title'])->load('donations/vw_consumable_recive', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function onSearchconsumables_recive()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('master_type_key_value');
                $param['order'] = array('master_id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_consumable_recivecondition($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $manufecture) {
                    $no++;
                    // print_obj($manufecture);
                    // echo $manufecture;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    // if(!empty($donar->mid_name)){
                    //     $donar_name=$donar->first_name.' '.$donar->mid_name.' '.$donar->last_name;
                    // }else{
                    //     $donar_name=$donar->first_name.' '.$donar->last_name;
                    // }

                    // if(!empty($donar['mid_name'])){
                    //     $donar_name=$donar['first_name'].' '.$donar['mid_name'].' '.$donar['last_name'];
                    // }else{
                    //     $donar_name=$donar['first_name'].' '.$donar['last_name'];
                    // }

                    $row[]  =   $no;
                    $row[]  =   $manufecture->master_type_key_value;



                    $row[]  = '<a href="' . $this->data['base_url'] . '/donations/consumables_recive/edit/' . $manufecture->master_id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $manufecture->master_id . ');" ><i class="fa fa-trash"></i></button> ';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_consumable_recivecondition($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_consumable_recivecondition($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function consumables_recive_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_bloodbank_master WHERE master_id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }
    function indexbloodbank_user_role()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Bank User Role';

            $this->theme->title($this->data['page_title'])->load('donations/vw_bloodbank_ user_role', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function bloodbank_user_role_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Bank User Role';

            $this->theme->title($this->data['page_title'])->load('donations/vw_bloodbank_ user_role', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function onSearchbloodbank_user_role()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('master_type_key_value');
                $param['order'] = array('master_id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_user_role($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $manufecture) {
                    $no++;
                    // print_obj($manufecture);
                    // echo $manufecture;die();
                    // echo $donar['first_name']; die;
                    $row = array();

                    // if(!empty($donar->mid_name)){
                    //     $donar_name=$donar->first_name.' '.$donar->mid_name.' '.$donar->last_name;
                    // }else{
                    //     $donar_name=$donar->first_name.' '.$donar->last_name;
                    // }

                    // if(!empty($donar['mid_name'])){
                    //     $donar_name=$donar['first_name'].' '.$donar['mid_name'].' '.$donar['last_name'];
                    // }else{
                    //     $donar_name=$donar['first_name'].' '.$donar['last_name'];
                    // }

                    $row[]  =   $no;
                    $row[]  =   $manufecture->master_type_key_value;



                    $row[]  = '<a href="' . $this->data['base_url'] . '/donations/bloodbank_user_role/edit/' . $manufecture->master_id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $manufecture->master_id . ');" ><i class="fa fa-trash"></i></button> ';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_user_role($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_user_role($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function bloodbank_user_role_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_bloodbank_master WHERE master_id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }


    function indexbloodbank_user()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Bank User';

            $this->theme->title($this->data['page_title'])->load('donations/vw_bloodbank_user', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function bloodbank_user_add()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Bank User Add';

            $this->theme->title($this->data['page_title'])->load('donations/vw_bloodbank_user_add', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function bloodbank_user_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Bank User Edit';

            $this->theme->title($this->data['page_title'])->load('donations/vw_bloodbank_user_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function onSearchbloodbank_user()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('name', 'email', 'mobile', 'role');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_bankuser($posts, $param, FALSE, FALSE);
                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';
                $base_url = str_replace('/admin', '', $this->data['base_url']);
                foreach ($list as $bank_user) {
                    $no++;
                    $row = array();
                    $row[]  =   $no;
                    $row[]  =   $bank_user->name;
                    $row[]  =   $bank_user->role;
                    $row[]  =   $bank_user->email;
                    $row[]  =   $bank_user->mobile;
                    $row[]  =   '<img src="'.$base_url.'/' . $bank_user->sign . '" width="70px" height="70px" />';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/donations/bloodbank_user/edit/' . $bank_user->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $bank_user->id . ');" ><i class="fa fa-trash"></i></button> ';
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_bankuser($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_bankuser($posts, $param, TRUE),
                    "data" => $data,
                );

                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function bloodbank_user_delete()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_bloodbank_user WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }


    function indexmaster_records()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = '';

            $this->theme->title($this->data['page_title'])->load('donations/vw_masterrecord', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function indexdonor_records()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = '';

            $this->theme->title($this->data['page_title'])->load('donations/vw_donorrecord', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function my_records()
    {
        //unset($_SESSION['REQUEST']);
        $request_id = $this->input->post('req_no');
        $bankID = $_SESSION['bank_id'];
        $query = $this->db->query("SELECT * FROM bl_requestblood WHERE bloodbank_id=$bankID AND request = '$request_id'")->result_array();
        $query = $query[0];
        $comp = json_decode($query['components_unit']);
        $comres =$this->replacekey($comp);
        $query['components_unit']=$comres;
        header('Content-Type: application/json');
        echo json_encode($query);
    }
    function my_records_request()
    {
        //unset($_SESSION['REQUEST']);
        $request_id = $this->input->post('req_no');
        $bankID = $_SESSION['bank_id'];
        $query = $this->db->query("SELECT * FROM bl_requestblood WHERE bloodbank_id=$bankID AND request = '$request_id'")->row();
        header('Content-Type: application/json');
        echo json_encode($query);
    }
    function donation_validation()
    {
        $tube_no = $this->input->post('tube_no');
        $unit_no = $this->input->post('unit_no');
        $data['msg'] = "";
        $data['status'] = 0;
        if ($tube_no != "") {
            $query = $this->db->query("SELECT * FROM  bl_bb_donatioform WHERE   tube = '$tube_no'");

            if ($query->num_rows() == 0) {
                $data['msg'] = "";
                $data['status'] = 0;
            } else {
                $data['msg'] = "Tube No already exist!";
                $data['status'] = 1;
            }
        }
        if ($data['status'] == 0) {
            if ($unit_no != "") {
                $queryunit = $this->db->query("SELECT * FROM  bl_bb_donatioform WHERE unit_no = '$unit_no'");

                if ($queryunit->num_rows() == 0) {
                    $data['msg'] = "";
                    $data['status'] = 0;
                } else {
                    $data['msg'] = "Unit No already exist!";
                    $data['status'] = 1;
                }
            }
        }

        echo json_encode($data);
    }
    function donation_validation_reg()
    {
        $request = $this->input->post('request');
        $bankID = $_SESSION['bank_id'];
        $data['msg'] = "";
        $data['status'] = 0;
        if ($request != "") {
            $query = $this->db->query("SELECT * FROM  bl_requestblood WHERE   request = '$request' AND bloodbank_id = '$bankID' ");
            if ($query->num_rows() == 0) {
                $data['msg'] = "";
                $data['status'] = 0;
            } else {
                $data['msg'] = "Request No already exist!";
                $data['status'] = 1;
            }
        }

        echo json_encode($data);
    }

    function my_crossmatch()
    {
        $bankID = $_SESSION['bank_id'];
        $request = $this->input->post('req_no2');
        $query = $this->db->query("SELECT * FROM bl_crossmatch WHERE bloodbank_id=$bankID AND status = 'crossmatch' 
            and request = '$request'")->result_array();
        echo json_encode($query);
    }

    function my_city()
    {
        $city = $this->input->post('req_no3');
        $query = $this->db->query("SELECT * FROM bl_districts WHERE state_id = '$city'")->result_array();
        header('Content-Type: application/json');
        echo json_encode($query);
    }
    function my_unit_no_data()
    {
        $bankID = $_SESSION['bank_id'];
        $current_date = Date('Y-m-d');
        $donation_id = $this->input->post('donation_id');
        $bag_config = $this->input->post('bag_config');
        $val1 = $this->input->post('val1');
        $query = $this->db->query("SELECT * FROM bl_blood_record WHERE bloodbank_id = '$bankID' AND donation_id = '$donation_id' AND component ='$val1' AND 
        bag_config = '$bag_config' AND expiry_date >'$current_date' ")->result_array();
        header('Content-Type: application/json');
        echo json_encode($query);
    }
    function check_grouping()
    {
        $unit_no = $this->input->post('unit_no');
        $bankID = $_SESSION['bank_id'];
        $query = $this->db->query("SELECT * FROM bl_blood_record WHERE bloodbank_id = '$bankID' AND unit_no = '$unit_no'")->result_array();
        $query = $query[0];
        // $bg_total_status = 1;
        if($query['grouping'] == "No" && $query['donation_id']  != '0'){
            $u_no = explode('-', $unit_no)[0];
            $bg_total = $this->db->query("SELECT * FROM bl_blood_group WHERE bloodbank_id = '$bankID' AND unit_no = '$u_no'")->num_rows();
            
            if($bg_total == 0){
                $bg_total_status = 0;
            }else{
                $bg_total_status = 1;
            }
        }else{
            
            $bg_total_status = 1;
        }
        header('Content-Type: application/json');
        echo json_encode($bg_total_status);
    }
    function my_unit_no()
    {
        $bankID = $_SESSION['bank_id'];
        $current_date = Date('Y-m-d');
        $id  = $this->input->post('req_no1');
        $unit_id = date('y') . '/' . $id;
        $data = $this->db->query("SELECT * FROM bl_blood_record WHERE bloodbank_id = '$bankID' AND donor_unit_no = '$unit_id' AND bag_config = 'Mother' AND expiry_date > '$current_date'  ");
        $query = $this->db->query("SELECT * FROM bl_blood_record WHERE bloodbank_id = '$bankID' AND donor_unit_no = '$unit_id' AND bag_config = 'Mother' AND expiry_date > '$current_date' ")->result_array();
        $count = $data->num_rows();
        if ($count == 0) {
            $query = $this->db->query("SELECT * FROM bl_blood_record WHERE bloodbank_id = '$bankID' AND donor_unit_no = '$id' AND bag_config = 'Mother' AND expiry_date > '$current_date' ")->result_array();
        }
        // header('Content-Type: application/json');
        echo json_encode($query);
    }
}
