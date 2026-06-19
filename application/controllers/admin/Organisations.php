<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Organisations  extends BaseAdminController
{
    function __construct()
    {
        parent::__construct();
    }
    function indexdonor()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'All Donor';
            $this->theme->title($this->data['page_title'])->load('organisations/vw_donor', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    public function bb_stock_over_report(){
        $param['column_search'] = array('p_name', 'mobile', 'component', 'hospital', 'hospital');
        $param['order'] = array('id' => 'ASC');
        $posts = $this->input->post();
        $posts['status'] = 'Ajency';
        $list = $this->um->_get_blood_stock_overview($posts, $param, FALSE, FALSE);
        $totalFinalVol = 0;

        foreach ($list as $entry) {
            // Decode the stock_data JSON string
            $stockData = json_decode($entry->stock_data);
            
            foreach ($stockData as $stock) {
                // Sum the final_vol value
                $totalFinalVol += $stock->final_vol;
            }
        }
         $this->data['page_title'] = 'Stock Handover Report';
         $this->data['list'] = $list;
         $this->data['totalFinalVol'] = $totalFinalVol;
         
         $this->theme->title($this->data['page_title'])->load('dashboards/handover_report', $this->data);
      
    }
   public function export_handover_report() {
   
    $param['column_search'] = array('p_name', 'mobile', 'component', 'hospital', 'hospital');
    $param['order'] = array('id' => 'ASC');
    $posts = $this->input->post();
    $posts['status'] = 'Ajency';
    $list = $this->um->_get_blood_stock_overview($posts, $param, FALSE, FALSE);
    $totalFinalVol = 0;

    foreach ($list as $entry) {
        $stockData = json_decode($entry->stock_data);
        foreach ($stockData as $stock) {
            $totalFinalVol += $stock->final_vol;
        }
    }

    $data['list'] = $list;
    $data['totalFinalVol'] = $totalFinalVol;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $customHeaders = array(
        'Agency', 'Issue No', 'Component', 'Blood Group', 'Unit No', 'Volume'
    );
    $sheet->fromArray($customHeaders, null, 'A1');

    $row = 2;
    foreach ($list as $item) {
        $rec = json_decode($item->stock_data);
        $sheet->setCellValue("A{$row}", $item->a_name);
        $sheet->setCellValue("B{$row}", $item->issue_no);
        $sheet->setCellValue("C{$row}", 'FFP');
        $sheet->setCellValue("D{$row}", $rec[0]->blood_group);
        $sheet->setCellValue("E{$row}", $rec[0]->unit_no);
        $sheet->setCellValue("F{$row}", $rec[0]->final_vol);
        $row++;
    }
     // Add the total final volume in the last row under column H
    $sheet->setCellValue("F{$row}", $totalFinalVol);
    
    // Set a label for the total final volume column
    $sheet->setCellValue("E{$row}", 'Total');

    $filename = 'Stock_handover.xlsx';  // Include the .xlsx extension
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Write the Excel file to the browser
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit();  // Ensure no further output is sent
}
    public function onSearchdonor()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('first_name', 'mid_name', 'last_name', 'email', 'ph_no', 'donation_status');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $param['type_key'] = 'blood_groups';
                $list = $this->dm->_get_donor($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';

                foreach ($list as $donar) {
                    $no++;
                    $row = array();
                    if (!empty($donar->mid_name)) {
                        $donar_name = $donar->first_name . ' ' . $donar->mid_name . ' ' . $donar->last_name;
                    } else {
                        $donar_name = $donar->first_name . ' ' . $donar->last_name;
                    }
                    $row[]  =   $no;
                    $row[]  =   $donar_name;
                    $row[]  =   $donar->email;
                    $row[]  =   $donar->ph_no;
                    $row[]  =   $donar->requested_schedule_date;
                    $row[]  =   $donar->reason;
                    $row[]  =   ucfirst($donar->donation_status);

                    if ($donar->donation_status == 'not donated') {
                        $row[] = $checkin = '<button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $donar->id . ');" ><i class="fa fa-trash"></i></button>';
                    } else {
                        $row[] = $checkin = '<a href="' . $this->data['base_url'] . '/organisations/download/' . $donar->donation_form_id . '/' . $donar->user_id . '" class="btn btn-xs btn-success" style="color:white;"><i class="fa fa-download"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $donar->id . ');" ><i class="fa fa-trash"></i></button>';
                    }

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_donor($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_donor($posts, $param, TRUE),
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

        $dataDelete = $this->db->query("DELETE FROM bl_blood_donation_requests WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }
    function indexpetients_request()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'All Patients Requests';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_patients', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function onSearchpetients_request()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('p_name', 'registration', 'age', 'gender', 'blood_group');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_petientsrequest($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

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
                    $row[]  =   $request->registration;
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
                        $checkin = '';
                    }


                    $row[]  = $checkin . ' <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $request->id . ');" ><i class="fa fa-trash"></i></button>';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_petientsrequest($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_petientsrequest($posts, $param, TRUE),
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
    public function petients_request_delete()
    {

        $id = $this->input->post('id');

        $dataDelete = $this->db->query("DELETE FROM bl_blood_request WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }
    function indexall_bloodcamp()
    {
        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'All Blood Camp';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_allcamp', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function all_bloodcamp_add()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Add New Blood Camp';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_allcamp_add', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function all_bloodcamp_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit Blood Camp';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_allcamp_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function onSearchall_bloodcamp()
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
                $list = $this->dm->_get_allcamp($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $blood_camp) {
                    $no++;
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

                    $row[]  = '<a href="' . $this->data['base_url'] . '/all_bloodcamp_edit/' . $blood_camp->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $blood_camp->id . ');" ><i class="fa fa-trash"></i></button> ';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_allcamp($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_allcamp($posts, $param, TRUE),
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
    public function all_bloodcamp_delete()
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
    //Labs
    function indexlabs()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Labs';

            $this->data['bredcrumb'] = array(
                'Dashboard' => $this->data['base_url'],
                'Labs' => ''
            );
            $this->theme->title($this->data['page_title'])->load('organisations/vw_labs', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
     function total_blood_payment($id=null)
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Payment details';
           
            $this->data['bredcrumb'] = array(
                'Dashboard' => $this->data['base_url'],
                'Blood Group' => '',
            );
            $this->db->select('bl_crossmatch.*,bl_blood_banks.name as b_name'); // Add this line
            // $this->db->from('bl_crossmatch');
            $this->db->join('bl_blood_banks', 'bl_blood_banks.blood_bank_id = bl_crossmatch.bloodbank_id');
            if ($_SESSION['admin_type'] == 5) {
                $B_id = $_SESSION['bank_id'];
                $this->db->where('bl_crossmatch.bloodbank_id', $B_id);
            }
            $this->db->where('bl_crossmatch.status', 'issued');
            $this->db->where('bl_crossmatch.payment !=', 0);
            $query = $this->db->get('bl_crossmatch');
            
            $bloodbank = $this->db->query("SELECT * FROM bl_blood_banks where org_type = 'Blood Bank'")->result_array();
            $this->data['bloodbank'] = $bloodbank;
            $this->data['list'] = $query->result_array();
            $this->theme->title($this->data['page_title'])->load('organisations/vw_BG_payment_detail', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    function total_blood_issue_detail($id)
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Issue details';
            $id = decode_data($id);
           
            $this->data['bredcrumb'] = array(
                'Dashboard' => $this->data['base_url'],
                'Blood Group' => '',
            );
            $components = "18, 'wholeblood', 20, 21, 886, 22";
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
    
            $query18 = $this->db->query("SELECT * FROM bl_crossmatch where status = 'issued' AND bl_crossmatch.created_at <= '{$end_date}' 
            AND bl_crossmatch.created_at >= '{$start_date}' AND component IN ($components)  AND bloodbank_id = '$id' ORDER BY bl_crossmatch.id DESC")->result(); 
            // echo "<pre>";
            // print_r($query18);
            // die();
            $this->data['list'] = $query18;
            $this->theme->title($this->data['page_title'])->load('organisations/vw_BG_issue_detail', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    function bloodbanks_detail_group($id = null, $d = null, $g = null)
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood group details';
            $id = decode_data($id);
            $this->data['dayfilter'] =  $this->input->get('days_filter');
            $this->data['start_date'] =  $this->input->get('start_date');
            $this->data['end_date'] =  $this->input->get('end_date');
            if ($d == 'donars') {
                $txt = "Registered Donors";
            } else {
                $txt = "Deferred Donors";
            }
            $this->data['bredcrumb'] = array(
                'Dashboard' => $this->data['base_url'],
                'Blood Group' => '',
            );
            $this->data['listtitle'] = $txt;
            $this->data['bb_id'] = $id;
            $this->data['d_type'] = $d;
            $this->data['g_type'] = $g;
            $this->theme->title($this->data['page_title'])->load('organisations/vw_BG_LIST', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    function blood_stock_detail($id = null, $d = null)
    {

        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'Blood Stock Detail';
            $id = decode_data($id);
            $this->data['bredcrumb'] = array(
                'Dashboard' => $this->data['base_url'],
                'Blood Group' => ''
            );
            $this->data['bb_id'] = $id;
            $this->data['b_stock_type'] = $d;
            $this->data['dayfilter'] =  $this->input->get('days_filter');
            $this->data['start_date'] =  $this->input->get('start_date');
            $this->data['end_date'] =  $this->input->get('end_date');

            $this->theme->title($this->data['page_title'])->load('organisations/vw_blood_stock_detail', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    function bloodbanks_detail_group_app($id = null, $d = null, $g = null)
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Donation Appointments';
            $id = decode_data($id);
            $this->data['bredcrumb'] = array(
                'Dashboard' => $this->data['base_url'],
                'Blood Group' => ''
            );
            $this->data['bb_id'] = $id;
            $this->data['d_type'] = $d;
            $this->data['g_type'] = $g;
            $this->data['dayfilter'] =  $this->input->get('days_filter');
            $this->data['start_date'] =  $this->input->get('start_date');
            $this->data['end_date'] =  $this->input->get('end_date');
            if ($d == 'donars') {
                $this->data['title_2'] = "Blood Donation Appointments";
            } else {
                $this->data['title_2'] = "Blood Request Appointments";
            }
            $this->theme->title($this->data['page_title'])->load('organisations/vw_BG_APP_LIST', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    function bloodbanks_req_group($id = null, $d = null)
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood group details';
            $id = decode_data($id);
            $this->data['bredcrumb'] = array(
                'Dashboard' => $this->data['base_url'],
                'Blood Group' => ''
            );
            $this->data['bb_id'] = $id;
            $this->data['d_type'] = $d;
            $this->data['dayfilter'] = $this->input->get('days_filter');
            $this->data['start_date'] = $this->input->get('start_date');
            $this->data['end_date'] = $this->input->get('end_date');
            $this->theme->title($this->data['page_title'])->load('organisations/vw_BG_REQ_LIST', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    function bloodbanks_req_met_group($id = null)
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'Total Request Met';
            $id = decode_data($id);
            $this->data['bredcrumb'] = array(
                'Dashboard' => $this->data['base_url'],
                'Blood Group' => ''
            );
            $this->data['bb_id'] = $id;
            $this->data['dayfilter'] = $this->input->get('days_filter');
            $this->data['start_date'] = $this->input->get('start_date');
            $this->data['end_date'] = $this->input->get('end_date');
            $this->theme->title($this->data['page_title'])->load('organisations/vw_BG_REQ_MET_LIST', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    public function onSearchlabs()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'name',
                    'city_name',
                    'state_name',
                    'boarding_type'
                );

                $param['column_search'] = array('name', 'city_name', 'state_name', 'boarding_type');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();


                //$param['created_by']=session_userdata('admin_id');


                $list = $this->um->_get_labs($posts, $param, FALSE, FALSE);

                // print_obj($list);die;


                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';

                foreach ($list as $lab) {
                    $no++;

                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $lab->name;
                    $row[]  =   $lab->city_name;
                    $row[]  =   $lab->state_name;
                    $row[]  =   $lab->boarding_type;

                    $row[]  =   '<a href="' . $this->data['base_url'] . '/labs/add/' . encode_data($lab->user_id) . '" class="btn btn-xs btn-info btn_edit_college"><i class="fa fa-edit"></i></a> <button type="button" class="btn btn-xs btn-dark btn_lab_bank" data-blood_bank_id ="' . encode_data($lab->user_id) . '"><i class="fa fa-trash"></i></button> <a href="' . $this->data['base_url'] . '/lab/status/' . $lab->user_id . '/' . $lab->status . '" class="btn btn-xs btn-danger">' . $lab->status . '</a>';

                    //<button type="button" class="btn btn-xs btn-danger" data-session="'.encode_data($lab->user_id).'"><i class="fa fa-trash"></i></button>
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_labs($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_labs($posts, $param, TRUE),
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
    public function bb_details_search()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'short_name',
                    'A_pos',
                    'B_pos',
                    'A_neg',
                    'B_neg',
                    'AB_pos',
                    'AB_neg',
                    'O_pos',
                    'O_neg',
                    'total_count'
                );

                $param['column_search'] = array('short_name', 'A_pos', 'B_pos', 'A_neg', 'B_neg', 'AB_pos', 'AB_neg', 'O_pos', 'O_neg');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['days_filter'] = post_data('days_filter');
                $posts['end_date'] = post_data('end_date');
                $posts['start_date'] = post_data('start_date');
                $list = $this->um->_get_bb_detail($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    $no++;
                    $row = array();
                    $row[]  =   $no;

                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/donars/All?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->short_name . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/donars/A_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->A_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/donars/B_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->B_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/donars/A_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->A_neg . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/donars/B_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->B_neg . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/donars/AB_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->AB_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/donars/AB_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->AB_neg . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/donars/O_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->O_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/donars/O_neg?days_filter=' . $posts['days_filter'] . '$start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->O_neg . '</a>';

                    $row[]  =   $lab->total_count;

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bb_detail($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bb_detail($posts, $param, TRUE),
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
    public function bg_search_excel()
    {
        $posts['bb_id'] = $this->input->get('bb_id');
        $posts['d_type'] = $this->input->get('d_type');
        $posts['g_type'] = $this->input->get('g_type');
        $posts['days_filter'] = $this->input->get('days_filter');
        $posts['start_date'] = $this->input->get('start_date');
        $posts['end_date'] = $this->input->get('end_date');
        $posts['name'] = $this->input->get('name');
        $posts['blood_group'] = $this->input->get('blood_group');
        $posts['status'] = $this->input->get('status');
        // print_r($posts);die();

        $dataObjects = $this->um->_get_bg($posts);

        $data = array();
        foreach ($dataObjects as $lab) {
            $row = array();
            $row[] = $lab->donor_name;
            $row[] = $lab->mobile;
            $row[] = $lab->blood_group;
            $row[] = $lab->donation_date;
            $data[] = $row;
        }
        // print_r($data);die();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set custom headers
        $customHeaders = array(
            'Name', 'Contact', 'Blood Group', 'Lasted Donated'
        );
        $sheet->fromArray($customHeaders, null, 'A1');

        // Add data to the Excel sheet
        $row = 2;
        foreach ($data as $rowData) {
            $sheet->fromArray($rowData, null, 'A' . $row);
            $row++;
        }
        if ($posts['d_type'] == 'donars') {
            $filename = 'Registered_Donars__List_' . date('Ymd') . '.xlsx';
        } else {
            $filename = 'deffer_Donars_List_' . date('Ymd') . '.xlsx';
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Write the Excel file to the browser
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
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
    public function bb_req_search_excel()
    {

        $posts['bb_id'] = $this->input->get('bb_id');
        $posts['days_filter'] = $this->input->get('days_filter');
        $posts['start_date'] = $this->input->get('start_date');
        $posts['end_date'] = $this->input->get('end_date');
        $posts['name'] = $this->input->get('name');
        $posts['blood_group'] = $this->input->get('blood_group');
        $posts['component'] = $this->input->get('component');
        // print_r($posts);
        // exit();
        $dataObjects = $this->um->_get_bg_req($posts);

        $data = array();
        foreach ($dataObjects as $lab) {
            $component = $this->get_com($lab->component);
            $row = array();
            $row[] = $lab->pname;
            $row[] = $lab->mobile;
            $row[] = $component;
            $row[] = $lab->required_date;
            $data[] = $row;
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set custom headers
        $customHeaders = array(
            'Name', 'Contact', 'Component', 'Request Date'
        );
        $sheet->fromArray($customHeaders, null, 'A1');

        // Add data to the Excel sheet
        $row = 2;
        foreach ($data as $rowData) {
            $sheet->fromArray($rowData, null, 'A' . $row);
            $row++;
        }

        $filename = 'PendingRequestForBlood_list' . date('Ymd') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Write the Excel file to the browser
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    public function bb_req_met_search_excel()
    {
        $posts['bb_id'] = $this->input->get('bb_id');
        $posts['days_filter'] = $this->input->get('days_filter');
        $posts['start_date'] = $this->input->get('start_date');
        $posts['end_date'] = $this->input->get('end_date');
        $posts['name'] = $this->input->get('name');
        $posts['blood_group'] = $this->input->get('blood_group');
        $dataObjects = $this->um->_get_bg_req_met($posts);

        $data = array();
        foreach ($dataObjects as $lab) {
            $component = $this->get_com($lab->component);
            $row = array();
            $row[] = $lab->p_name;
            $row[] = $lab->mobile;
            $row[] = $component;
            $row[] =  $lab->doc . '/' . $lab->hospital;
            $data[] = $row;
        }
        // print_r($data);
        // exit();
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set custom headers
        $customHeaders = array(
            'Name', 'Contact', 'Component', 'Demand Genrated By - Doctor/ Hospital'
        );
        $sheet->fromArray($customHeaders, null, 'A1');

        // Add data to the Excel sheet
        $row = 2;
        foreach ($data as $rowData) {
            $sheet->fromArray($rowData, null, 'A' . $row);
            $row++;
        }

        $filename = 'TotalRequestMet_list_' . date('Ymd') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Write the Excel file to the browser
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    public function bg_app_search_excel()
    {
        $posts['bb_id'] = $this->input->get('bb_id');
        $posts['d_type'] = $this->input->get('d_type');
        $posts['g_type'] = $this->input->get('g_type');
        $posts['days_filter'] = $this->input->get('days_filter');
        $posts['start_date'] = $this->input->get('start_date');
        $posts['end_date'] = $this->input->get('end_date');
        $posts['name'] = $this->input->get('name');
        $posts['approved_status'] = $this->input->get('approved_status');
        $posts['donation_status'] = $this->input->get('donation_status');
        $posts['blood_group'] = $this->input->get('blood_group');
        // print_r($posts);
        // exit();
        if ($posts['d_type'] == "req") {
            $dataObjects = $this->um->_get_bg_app_req($posts);
        } else {
            $dataObjects = $this->um->_get_bg_app($posts);
        }

        $data = array();
        foreach ($dataObjects as $lab) {
            $row = array();
            $row[] = $lab->donor_name;
            $row[] = $lab->mobile;
            $row[] = $lab->blood_group;
            $row[] = $lab->donation_date;
            $data[] = $row;
        }
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set custom headers
        $customHeaders = array(
            'Name', 'Contact', 'Blood Group', 'Appointment Date'
        );
        $sheet->fromArray($customHeaders, null, 'A1');

        $row = 2;
        foreach ($data as $rowData) {
            $sheet->fromArray($rowData, null, 'A' . $row);
            $row++;
        }
        if ($posts['d_type'] == 'req') {
            $filename = 'Blood_Request_Appointments_List_' . date('Ymd') . '.xlsx';
        } else {
            $filename = 'Blood_Donation_Appointments_List_' . date('Ymd') . '.xlsx';
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    public function bb_details_excel_url()
    {
        // Fetch data from the model
        $posts['days_filter'] = $this->input->get('days_filter');
        $posts['end_date'] = $this->input->get('end_date');
        $posts['start_date'] = $this->input->get('start_date');
        $dataObjects = $this->um->_get_bb_excel_detail($posts);
        // Convert objects to arrays
        $data = array();
        foreach ($dataObjects as $object) {
            $data[] = (array) $object;
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set custom headers
        $customHeaders = array(
            'Blood Bank', 'A+', 'B+', 'A-', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'Total'
        );
        $sheet->fromArray($customHeaders, null, 'A1');

        // Add data to the Excel sheet
        $row = 2;
        foreach ($data as $rowData) {
            $sheet->fromArray($rowData, null, 'A' . $row);
            $row++;
        }
        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;
        $e = 0;
        $f = 0;
        $g = 0;
        $h = 0;
        $i = 0;
        foreach ($data as $rowData) {
            $a += $rowData['A_pos'];
            $b += $rowData['B_pos'];
            $c += $rowData['A_neg'];
            $d += $rowData['B_neg'];
            $e += $rowData['AB_pos'];
            $f += $rowData['AB_neg'];
            $g += $rowData['O_pos'];
            $h += $rowData['O_neg'];
            $i += $rowData['total_count'];
        }
        $customHeaders = array(
            'Total', "" . $a, "" . $b, "" . $c, "" . $d, "" . $e, "" . $f, "" . $g, "" . $h, "" . $i
        );
        $sheet->fromArray($customHeaders, null, 'A' . $row);

        // Set headers for download
        $filename = 'RegisteredDonars_' . date('Ymd') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Write the Excel file to the browser
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    public function bb_donnar_app_excel_url()
    {
        // Fetch data from the model
        $posts['days_filter'] = $this->input->get('days_filter');
        $posts['end_date'] = $this->input->get('end_date');
        $posts['start_date'] = $this->input->get('start_date');
        $dataObjects = $this->um->_get_bb_donar_app_excel($posts);
        // Convert objects to arrays
        $data = array();
        foreach ($dataObjects as $object) {
            $data[] = (array) $object;
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set custom headers
        $customHeaders = array(
            'Blood Bank', 'A+', 'B+', 'A-', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'Total'
        );
        $sheet->fromArray($customHeaders, null, 'A1');

        // Add data to the Excel sheet
        $row = 2;
        foreach ($data as $rowData) {
            $sheet->fromArray($rowData, null, 'A' . $row);
            $row++;
        }
        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;
        $e = 0;
        $f = 0;
        $g = 0;
        $h = 0;
        $i = 0;
        foreach ($data as $rowData) {
            $a += $rowData['A_pos'];
            $b += $rowData['B_pos'];
            $c += $rowData['A_neg'];
            $d += $rowData['B_neg'];
            $e += $rowData['AB_pos'];
            $f += $rowData['AB_neg'];
            $g += $rowData['O_pos'];
            $h += $rowData['O_neg'];
            $i += $rowData['total_count'];
        }
        $customHeaders = array(
            'Total', "" . $a, "" . $b, "" . $c, "" . $d, "" . $e, "" . $f, "" . $g, "" . $h, "" . $i
        );
        $sheet->fromArray($customHeaders, null, 'A' . $row);

        // Set headers for download
        $filename = 'Donation_Appointments_' . date('Ymd') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Write the Excel file to the browser
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    public function bb_req_app_excel()
    {
        // Fetch data from the model
        $posts['days_filter'] = $this->input->get('days_filter');
        $posts['end_date'] = $this->input->get('end_date');
        $posts['start_date'] = $this->input->get('start_date');
        $dataObjects = $this->um->_get_bb_req_app_excel($posts);
        // Convert objects to arrays
        $data = array();
        foreach ($dataObjects as $object) {
            $data[] = (array) $object;
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set custom headers
        $customHeaders = array(
            'Blood Bank', 'A+', 'B+', 'A-', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'Total'
        );
        $sheet->fromArray($customHeaders, null, 'A1');

        // Add data to the Excel sheet
        $row = 2;
        foreach ($data as $rowData) {
            $sheet->fromArray($rowData, null, 'A' . $row);
            $row++;
        }
        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;
        $e = 0;
        $f = 0;
        $g = 0;
        $h = 0;
        $i = 0;
        foreach ($data as $rowData) {
            $a += $rowData['A_pos'];
            $b += $rowData['B_pos'];
            $c += $rowData['A_neg'];
            $d += $rowData['B_neg'];
            $e += $rowData['AB_pos'];
            $f += $rowData['AB_neg'];
            $g += $rowData['O_pos'];
            $h += $rowData['O_neg'];
            $i += $rowData['total_count'];
        }
        $customHeaders = array(
            'Total', "" . $a, "" . $b, "" . $c, "" . $d, "" . $e, "" . $f, "" . $g, "" . $h, "" . $i
        );
        $sheet->fromArray($customHeaders, null, 'A' . $row);

        // Set headers for download
        $filename = 'BloodRequestAppointments_' . date('Ymd') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Write the Excel file to the browser
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    public function bb_request_excel()
    {
        // Fetch data from the model
        $posts['days_filter'] = $this->input->get('days_filter');
        $posts['end_date'] = $this->input->get('end_date');
        $posts['start_date'] = $this->input->get('start_date');
        $dataObjects = $this->um->_get_bb_reqest_excel($posts);
        // Convert objects to arrays
        $data = array();
        foreach ($dataObjects as $object) {
            $data[] = (array) $object;
        }
        // print_r($dataObjects);die();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set custom headers
        $customHeaders = array(
            'Blood Bank', 'Whole Blood', 'PRC/ Packed Cell', 'RDP/SDP', 'FFP/Plasma', 'Total'
        );
        $sheet->fromArray($customHeaders, null, 'A1');

        // Add data to the Excel sheet
        $row = 2;
        foreach ($data as $rowData) {
            $sheet->fromArray($rowData, null, 'A' . $row);
            $row++;
        }
        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;
        $i = 0;
        foreach ($data as $rowData) {
            $a += $rowData['whole_blood_unit_count'];
            $b += $rowData['Platelet_rich_concentrate_unit_count'];
            $c += $rowData['Red_blood_cell_unit_count'];
            $d += $rowData['Fresh_Frozen_Plasma_unit_count'];
            $i += $rowData['total_component_count'];
        }
        $customHeaders = array(
            'Total', "" . $a, "" . $b, "" . $c, "" . $d, "" . $i
        );
        $sheet->fromArray($customHeaders, null, 'A' . $row);

        // Set headers for download
        $filename = 'PendingRequestForBlood_' . date('Ymd') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Write the Excel file to the browser
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    public function bb_request_met_excel()
    {
        // Fetch data from the model
        $posts['days_filter'] = $this->input->get('days_filter');
        $posts['end_date'] = $this->input->get('end_date');
        $posts['start_date'] = $this->input->get('start_date');
        $dataObjects = $this->um->_get_bb_reqest_met_excel($posts);
        // Convert objects to arrays
        $data = array();
        foreach ($dataObjects as $object) {
            $data[] = (array) $object;
        }
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set custom headers
        $customHeaders = array(
            'Blood Bank', 'Whole Blood', 'PRC/ Packed Cell', 'RDP/SDP', 'FFP/Plasma', 'Total'
        );
        $sheet->fromArray($customHeaders, null, 'A1');

        // Add data to the Excel sheet
        $row = 2;
        foreach ($data as $rowData) {
            $sheet->fromArray($rowData, null, 'A' . $row);
            $row++;
        }
        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;
        $i = 0;
        foreach ($data as $rowData) {
            $a += $rowData['whole_blood_unit_count'];
            $b += $rowData['Platelet_rich_concentrate_unit_count'];
            $c += $rowData['Red_blood_cell_unit_count'];
            $d += $rowData['Fresh_Frozen_Plasma_unit_count'];
            $i += $rowData['total_component_count'];
        }
        $customHeaders = array(
            'Total', "" . $a, "" . $b, "" . $c, "" . $d, "" . $i
        );
        $sheet->fromArray($customHeaders, null, 'A' . $row);

        // Set headers for download
        $filename = 'TotalRequestMet_' . date('Ymd') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Write the Excel file to the browser
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    public function bb_inv_search_excel()
    {
        // Fetch data from the model
        $posts['days_filter'] = $this->input->get('days_filter');
        $posts['end_date'] = $this->input->get('end_date');
        $posts['start_date'] = $this->input->get('start_date');
        $dataObjects = $this->um->_get_bb_inv_excel($posts);
        // Convert objects to arrays
        $data = array();
        foreach ($dataObjects as $object) {
            $data[] = (array) $object;
        }
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set custom headers
        $customHeaders = array(
            'Blood Bank', 'Whole Blood', 'PRC/ Packed Cell', 'RDP/SDP', 'FFP/Plasma', 'Total'
        );
        $sheet->fromArray($customHeaders, null, 'A1');

        // Add data to the Excel sheet
        $row = 2;
        foreach ($data as $rowData) {
            $sheet->fromArray($rowData, null, 'A' . $row);
            $row++;
        }
        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;
        $i = 0;
        foreach ($data as $rowData) {
            $a += $rowData['whole_blood_unit_count'];
            $b += $rowData['Platelet_rich_concentrate_unit_count'];
            $c += $rowData['Red_blood_cell_unit_count'];
            $d += $rowData['Fresh_Frozen_Plasma_unit_count'];
            $i += $rowData['total_component_count'];
        }
        $customHeaders = array(
            'Total', "" . $a, "" . $b, "" . $c, "" . $d, "" . $i
        );
        $sheet->fromArray($customHeaders, null, 'A' . $row);

        // Set headers for download
        $filename = 'BloodInventory_' . date('Ymd') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Write the Excel file to the browser
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    public function bb_camp_search_excel()
    {
        // Fetch data from the model
        $posts['days_filter'] = $this->input->get('days_filter');
        $posts['end_date'] = $this->input->get('end_date');
        $posts['start_date'] = $this->input->get('start_date');
        $posts['name'] = $this->input->get('name');
        $posts['venue'] = $this->input->get('venue');
        $posts['bloodbank_id'] = $this->input->get('bloodbank_id');
        $posts['city'] = $this->input->get('city');
        $dataObjects = $this->um->_get_bb_camp($posts);
        // Convert objects to arrays
        $data = array();
        // print_r($posts);die();
        foreach ($dataObjects as $object) {
            $data[] = (array) $object;
        }
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set custom headers
        $customHeaders = array(
            'Blood Bank', 'Camp Name', 'Start Date', 'End Date', 'City', 'Venue'
        );
        $sheet->fromArray($customHeaders, null, 'A1');

        // Add data to the Excel sheet
        $row = 2;
        foreach ($data as $rowData) {
            $sheet->fromArray($rowData, null, 'A' . $row);
            $row++;
        }


        // Set headers for download
        $filename = 'CampsPlanned_' . date('Ymd') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Write the Excel file to the browser
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function bb_details_donor_excel_url()
    {
        // Fetch data from the model
        $posts['days_filter'] = $this->input->get('days_filter');
        $posts['end_date'] = $this->input->get('end_date');
        $posts['start_date'] = $this->input->get('start_date');
        $dataObjects = $this->um->_get_bb_excel_deffer($posts);
        // Convert objects to arrays
        $data = array();
        foreach ($dataObjects as $object) {
            $data[] = (array) $object;
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set custom headers
        $customHeaders = array(
            'Blood Bank', 'A+', 'B+', 'A-', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'Total'
        );
        $sheet->fromArray($customHeaders, null, 'A1');

        // Add data to the Excel sheet
        $row = 2;
        foreach ($data as $rowData) {
            $sheet->fromArray($rowData, null, 'A' . $row);
            $row++;
        }
        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;
        $e = 0;
        $f = 0;
        $g = 0;
        $h = 0;
        $i = 0;
        foreach ($data as $rowData) {
            $a += $rowData['A_pos'];
            $b += $rowData['B_pos'];
            $c += $rowData['A_neg'];
            $d += $rowData['B_neg'];
            $e += $rowData['AB_pos'];
            $f += $rowData['AB_neg'];
            $g += $rowData['O_pos'];
            $h += $rowData['O_neg'];
            $i += $rowData['total_count'];
        }
        $customHeaders = array(
            'Total', "" . $a, "" . $b, "" . $c, "" . $d, "" . $e, "" . $f, "" . $g, "" . $h, "" . $i
        );
        $sheet->fromArray($customHeaders, null, 'A' . $row);

        // Set headers for download
        $filename = 'DeferredDonars_' . date('Ymd') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Write the Excel file to the browser
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }


    public function bb_donar_app_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'short_name',
                    'A_pos',
                    'B_pos',
                    'A_neg',
                    'B_neg',
                    'AB_pos',
                    'AB_neg',
                    'O_pos',
                    'O_neg',
                    'total_count'
                );

                $param['column_search'] = array('short_name', 'A_pos', 'B_pos', 'A_neg', 'B_neg', 'AB_pos', 'AB_neg', 'O_pos', 'O_neg');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['days_filter'] = post_data('days_filter');
                $posts['end_date'] = post_data('end_date');
                $posts['start_date'] = post_data('start_date');

                $list = $this->um->_get_bb_donar_app($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    $no++;
                    $row = array();
                    $row[]  =   $no;

                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/donars/All?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->short_name . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/donars/A_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->A_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/donars/B_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->B_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/donars/A_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->A_neg . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/donars/B_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->B_neg . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/donars/AB_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->AB_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/donars/AB_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->AB_neg . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/donars/O_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->O_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/donars/O_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->O_neg . '</a>';
                    $row[]  =   $lab->total_count;

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bb_donar_app($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bb_donar_app($posts, $param, TRUE),
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
    public function bb_req_app_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'short_name',
                    'A_pos',
                    'B_pos',
                    'A_neg',
                    'B_neg',
                    'AB_pos',
                    'AB_neg',
                    'O_pos',
                    'O_neg',
                    'total_count'
                );

                $param['column_search'] = array('short_name', 'A_pos', 'B_pos', 'A_neg', 'B_neg', 'AB_pos', 'AB_neg', 'O_pos', 'O_neg');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['days_filter'] = post_data('days_filter');
                $posts['end_date'] = post_data('end_date');
                $posts['start_date'] = post_data('start_date');

                $list = $this->um->_get_bb_req_app($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    $no++;
                    $row = array();
                    $row[]  =   $no;
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/req/All?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->short_name . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/req/A_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->A_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/req/B_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->B_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/req/A_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->A_neg . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/req/B_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->B_neg . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/req/AB_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->AB_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/req/AB_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->AB_neg . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/req/O_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->O_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group_app/' . encode_data($lab->blood_bank_id) . '/req/O_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->O_neg . '</a>';

                    $row[]  =   $lab->total_count;

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bb_req_app($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bb_req_app($posts, $param, TRUE),
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

    public function bb_deffer_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'short_name',
                    'A_pos',
                    'B_pos',
                    'A_neg',
                    'B_neg',
                    'AB_pos',
                    'AB_neg',
                    'O_pos',
                    'O_neg',
                    'total_count'
                );

                $param['column_search'] = array('short_name', 'A_pos', 'B_pos', 'A_neg', 'B_neg', 'AB_pos', 'AB_neg', 'O_pos', 'O_neg');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['days_filter'] = post_data('days_filter');
                $posts['end_date'] = post_data('end_date');
                $posts['start_date'] = post_data('start_date');
                $posts['days_filter'] = post_data('days_filter');
                $posts['end_date'] = post_data('end_date');
                $posts['start_date'] = post_data('start_date');

                $list = $this->um->_get_bb_deffer($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    $no++;
                    $row = array();
                    $row[]  =   $no;
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/defer/All?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->short_name . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/defer/A_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->A_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/defer/B_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->B_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/defer/A_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->A_neg . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/defer/B_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->B_neg . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/defer/AB_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->AB_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/defer/AB_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->AB_neg . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/defer/O_pos?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->O_pos . '</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_detail_group/' . encode_data($lab->blood_bank_id) . '/defer/O_neg?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . '" >' . $lab->O_neg . '</a>';
                    $row[]  =   $lab->total_count;
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bb_deffer($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bb_deffer($posts, $param, TRUE),
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

    public function bb_request_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'short_name',
                    'whole_blood_unit_count',
                    'Cryo_Poor_Plasma_unit_count',
                    'Cryoprecipitate_unit_count',
                    'Fresh_Frozen_Plasma_unit_count',
                    'Red_blood_cell_unit_count',
                    'Platelet_rich_concentrate_unit_count',
                    'total_component_count'
                );

                $param['column_search'] = array('short_name', 'whole_blood_unit_count', 'Cryo_Poor_Plasma_unit_count', 'Cryoprecipitate_unit_count', 'Fresh_Frozen_Plasma_unit_count', 'Red_blood_cell_unit_count', 'Platelet_rich_concentrate_unit_count');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['days_filter'] = post_data('days_filter');
                $posts['end_date'] = post_data('end_date');
                $posts['start_date'] = post_data('start_date');

                $list = $this->um->_get_bb_reqest($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    $no++;
                    $row = array();
                    $row[]  =   $no;
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_req_group/' . encode_data($lab->blood_bank_id) . '/defer?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . ' ">' . $lab->short_name . '</a>';
                    $row[]  =   $lab->whole_blood_unit_count;
                    $row[]  =   $lab->Platelet_rich_concentrate_unit_count;
                    $row[]  =   $lab->Red_blood_cell_unit_count;
                    $row[]  =   $lab->Fresh_Frozen_Plasma_unit_count;
                    $row[]  =   $lab->total_component_count;
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bb_reqest($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bb_reqest($posts, $param, TRUE),
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
    public function bb_pending_app_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'short_name',
                    'A_pos',
                    'B_pos',
                    'A_neg',
                    'B_neg',
                    'AB_pos',
                    'AB_neg',
                    'O_pos',
                    'O_neg',
                    'total_count'
                );

                $param['column_search'] = array('short_name', 'A_pos', 'B_pos', 'A_neg', 'B_neg', 'AB_pos', 'AB_neg', 'O_pos', 'O_neg');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['days_filter'] = post_data('days_filter');
                $posts['end_date'] = post_data('end_date');
                $posts['start_date'] = post_data('start_date');

                $list = $this->um->_get_bb_pending_app($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    $no++;
                    $row = array();
                    $row[]  = $no;
                    $row[]  = $lab->short_name ;
                    $row[]  = $lab->A_pos ;
                    $row[]  = $lab->B_pos ;
                    $row[]  = $lab->A_neg ;
                    $row[]  = $lab->B_neg ;
                    $row[]  = $lab->AB_pos ;
                    $row[]  = $lab->AB_neg ;
                    $row[]  = $lab->O_pos ;
                    $row[]  = $lab->O_neg ;
                    $row[]  = $lab->total_count;
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bb_deffer($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bb_deffer($posts, $param, TRUE),
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
    public function bb_request_met_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'short_name',
                    'whole_blood_unit_count',
                    'Cryo_Poor_Plasma_unit_count',
                    'Cryoprecipitate_unit_count',
                    'Fresh_Frozen_Plasma_unit_count',
                    'Red_blood_cell_unit_count',
                    'Platelet_rich_concentrate_unit_count',
                    'total_component_count'
                );

                $param['column_search'] = array('short_name', 'whole_blood_unit_count', 'Cryo_Poor_Plasma_unit_count', 'Cryoprecipitate_unit_count', 'Fresh_Frozen_Plasma_unit_count', 'Red_blood_cell_unit_count', 'Platelet_rich_concentrate_unit_count');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['days_filter'] = post_data('days_filter');
                $posts['end_date'] = post_data('end_date');
                $posts['start_date'] = post_data('start_date');


                $list = $this->um->_get_bb_reqest_met($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    $no++;
                    $row = array();
                    $row[]  =   $no;
                    $row[]  = '<a href="' . $this->data['base_url'] . '/bloodbanks_req_met_group/' . encode_data($lab->blood_bank_id) . '?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . ' " >' . $lab->short_name . '</a>';
                    $row[]  =   $lab->whole_blood_unit_count;
                    $row[]  =   $lab->Platelet_rich_concentrate_unit_count;
                    $row[]  =   $lab->Red_blood_cell_unit_count;
                    $row[]  =   $lab->Fresh_Frozen_Plasma_unit_count;
                    $row[]  =   $lab->total_component_count;
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bb_reqest_met($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bb_reqest_met($posts, $param, TRUE),
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
    public function total_blood_issue_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'short_name',
                    'whole_blood_unit_count',
                    'Cryo_Poor_Plasma_unit_count',
                    'Cryoprecipitate_unit_count',
                    'Fresh_Frozen_Plasma_unit_count',
                    'Red_blood_cell_unit_count',
                    'Platelet_rich_concentrate_unit_count',
                    'total_component_count'
                );

                $param['column_search'] = array('short_name', 'whole_blood_unit_count', 'Cryo_Poor_Plasma_unit_count', 'Cryoprecipitate_unit_count', 'Fresh_Frozen_Plasma_unit_count', 'Red_blood_cell_unit_count', 'Platelet_rich_concentrate_unit_count');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['days_filter'] = post_data('days_filter');
                $posts['end_date'] = post_data('end_date');
                $posts['start_date'] = post_data('start_date');

                $list = $this->um->_get_bb_issue($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    $no++;
                    $row = array();
                    $row[]  =   $no;
                    $row[] = '<a href="' . $this->data['base_url'] . '/total_blood_issue_detail/' . encode_data($lab->blood_bank_id) . '">' . $lab->short_name . '</a>';

                    $row[]  =   $lab->whole_blood_unit_count;
                    $row[]  =   $lab->Platelet_rich_concentrate_unit_count;
                    $row[]  =   $lab->Red_blood_cell_unit_count;
                    $row[]  =   $lab->Fresh_Frozen_Plasma_unit_count;
                    $row[]  =   $lab->total_component_count;
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bb_issue($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bb_issue($posts, $param, TRUE),
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
    public function bb_inv_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'short_name',
                    'whole_blood_unit_count',
                    'Cryo_Poor_Plasma_unit_count',
                    'Cryoprecipitate_unit_count',
                    'Fresh_Frozen_Plasma_unit_count',
                    'Red_blood_cell_unit_count',
                    'Platelet_rich_concentrate_unit_count',
                    'total_component_count'
                );

                $param['column_search'] = array('short_name', 'whole_blood_unit_count', 'Cryo_Poor_Plasma_unit_count', 'Cryoprecipitate_unit_count', 'Fresh_Frozen_Plasma_unit_count', 'Red_blood_cell_unit_count', 'Platelet_rich_concentrate_unit_count');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['days_filter'] = post_data('days_filter');
                $posts['end_date'] = post_data('end_date');
                $posts['start_date'] = post_data('start_date');

                $list = $this->um->_get_bb_inv($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    $no++;
                    $row = array();
                    $row[]  =   $no;
                    // $row[]  = '<a href="'.$this->data['base_url'].'/bloodbanks_detail_group/'.encode_data($lab->blood_bank_id).'/defer/All?days_filter='.$posts['days_filter'].'&start_date='.$posts['start_date'].'&end_date='.$posts['end_date'].'" >'.$lab->short_name.'</a>';
                    $row[]  = '<a href="' . $this->data['base_url'] . '/blood_stock_detail/' . encode_data($lab->blood_bank_id) . '/all?days_filter=' . $posts['days_filter'] . '&start_date=' . $posts['start_date'] . '&end_date=' . $posts['end_date'] . ' " >' . $lab->short_name . '</a>';
                    $row[]  =   $lab->whole_blood_unit_count;
                    $row[]  =   $lab->Platelet_rich_concentrate_unit_count;
                    $row[]  =   $lab->Red_blood_cell_unit_count;
                    $row[]  =   $lab->Fresh_Frozen_Plasma_unit_count;
                    $row[]  =   $lab->total_component_count;
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bb_inv($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bb_inv($posts, $param, TRUE),
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
    public function bb_camp_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'short_name',
                    'blood_name',
                    'camp_type',
                    'city',
                    'venue'
                );

                $param['column_search'] = array('short_name', 'blood_name', 'camp_type', 'city', 'venue');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['days_filter'] = post_data('days_filter');
                $posts['end_date'] = post_data('end_date');
                $posts['start_date'] = post_data('start_date');
                $posts['name'] = post_data('name');
                $posts['venue'] = post_data('venue');
                $posts['bloodbank_id'] = post_data('bloodbank_id');
                $posts['city'] = post_data('city');


                $list = $this->um->_get_bb_camp($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    $no++;
                    $row = array();
                    $row[]  =   $no;
                    $row[]  = $lab->short_name;
                    $row[]  =   $lab->blood_name;
                    $row[]  =   $lab->start_date . '/' . $lab->end_date;
                    $row[]  =   $lab->city_name;
                    $row[]  =   $lab->venue;
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bb_camp($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bb_camp($posts, $param, TRUE),
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
    function generateUniqueIssueNo()
    {
        // Get the current date and time
        $dateTime = date('mdHs'); // Format: YYYYMMDDHHMMSS

        // Generate a random string of 4 capital letters
        $randomString = $this->generateRandomString(4);

        // Concatenate date, time, and random string to form the unique issue number
        $uniqueIssueNo = $randomString . $dateTime;

        return $uniqueIssueNo;
    }

    function generateRandomString($length = 4)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function unit()
    {
        $characters = '0123456789';
        $randomString = '';

        for ($i = 0; $i < 6; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
    public function bb_stock_transfer_in_save()
    {

        $blood_groups = $this->input->post('blood_group');
        $by = $this->input->post('by');

        foreach ($blood_groups as $in => $row) {
            $unit_no = $this->input->post('unit_no')[$in];
            $old_unit_no = $this->input->post('old_unit_no')[$in];
            $blood_groups = $this->input->post('blood_group')[$in];
            $expiry_dt = $this->input->post('expiry_date')[$in];
            $donation_date = $this->input->post('collection_date')[$in];
            $blood_record = $this->input->post('blood_volume')[$in];
            $ttistatus = $this->input->post('tti_test')[$in];
            $tube = $this->input->post('tube')[$in];
            $issueNo = $this->generateUniqueIssueNo();
            $B_id = $_SESSION['bank_id'];
            $query = $this->db->query("INSERT INTO bl_blood_record (blood_from_bank,issued_no,donation_id ,bloodbank_id ,old_unit_no,donor_unit_no, unit_no, tube_no ,
            component , collection_date , expiry_date, bag_config ,blood_group , blood_volume ,
            tti_test ,  cross_match , issue_status , issued_vol , final_vol) 
            VALUES ('$by','$issueNo','','$B_id' ,'$old_unit_no', '$unit_no', '$unit_no' ,'$tube' ,
            22, '$donation_date', '$expiry_dt' ,'Mother' ,'$blood_groups' ,'$blood_record',
            '$ttistatus' , 'No', 'No','0','$blood_record')");
            // Retrieve the last inserted row data
            if ($query) {
                $last_id = $this->db->insert_id();
                $query = $this->db->query("SELECT * FROM bl_blood_record WHERE id = $last_id");
                $result = json_encode($query->result());
                $added = $this->db->query("INSERT INTO bl_stock_handover (bb_id,issue_to,aj_id,stock_data,issue_no,status)
                VALUES ('$B_id','',$by,'$result','$issueNo','In')");
            }
        }
        redirect($this->data['base_url'] . '/bb_stock_transfer_in');
    }

    public function bb_stock_hand_over()
    {
        $aj = post_data('aj');
        $issue_to = post_data('issue_to');
        $selectedIds = $this->input->post('selectedIds'); // Directly using CI's input class to get the array
        $issueNo = $this->generateUniqueIssueNo();
        $B_id = $_SESSION['bank_id'];
        foreach ($selectedIds as $selectedId) {
            $this->db->select('bl_blood_record.*');
            $this->db->where('bl_blood_record.id', $selectedId);
            $query = $this->db->get('bl_blood_record');
            $result = json_encode($query->result());
            $added = $this->db->query("INSERT INTO bl_stock_handover (bb_id,issue_to,aj_id,stock_data,issue_no)
             VALUES ('$B_id','$issue_to','$aj','$result','$issueNo')");
            $this->db->query("DELETE FROM bl_blood_record WHERE id = '$selectedId'");
        }

        echo json_encode('Staock handover successfuly.');
    }
    public function unit_validation()
    {
        $unit_no = $this->input->post('unit_no');
        $this->db->where('donor_unit_no', $unit_no);
        $query = $this->db->get('bl_blood_record');

        if ($query->num_rows() > 0) {
            echo json_encode(array('status' => 'exists'));
        } else {
            echo json_encode(array('status' => 'unique'));
        }
    }

    public function bb_stock_out()
    {
        $aj = post_data('aj');
        $selectedIds = $this->input->post('selectedIds'); // Directly using CI's input class to get the array
        $B_id = $_SESSION['bank_id'];
        foreach ($selectedIds as $selectedId) {
            $issueNo = $this->generateUniqueIssueNo();
            $this->db->select('bl_blood_record.*');
            $this->db->where('bl_blood_record.id', $selectedId);
            $query = $this->db->get('bl_blood_record');
            $result = json_encode($query->result());
            $added = $this->db->query("INSERT INTO bl_stock_handover (bb_id,issue_to,aj_id,stock_data,issue_no,status)
             VALUES ('$B_id','','$aj','$result','$issueNo','out')");
            $this->db->query("DELETE FROM bl_blood_record WHERE id = '$selectedId'");
        }

        echo json_encode('Staock handover successfuly.');
    }

    public function bb_stock_handover_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'unit_no',
                    'bag_config',
                    'final_vol',
                    'blood_group',
                    'expiry_date',
                    'created_at'
                );
                $param['column_search'] = array('unit_no', 'bag_config', 'final_vol', 'blood_group', 'expiry_date', 'created_at');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['end_date'] = post_data('end_date');
                $posts['start_date'] = post_data('start_date');
                $list = $this->um->_search_bb_stock_handover($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {

                    $no++;
                    $row = array();
                    $row[]  = '<input type="checkbox" name="ids[]" value="' . $lab->id . '" class="record-checkbox" checked> ' . $no; // Checkbox column
                    $row[]  = $lab->unit_no;
                    //   $row[]  = $lab->bag_config;
                    $row[]  =   $lab->final_vol;
                    $row[]  =   $lab->blood_group;
                    $row[]  =   $lab->expiry_date;
                    $row[]  =   $lab->created_at;
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_search_bb_stock_handover($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_search_bb_stock_handover($posts, $param, TRUE),
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

    public function bb_stock_prc()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'unit_no',
                    'bag_config',
                    'final_vol',
                    'blood_group',
                    'expiry_date',
                    'created_at'
                );
                $param['column_search'] = array('unit_no', 'bag_config', 'final_vol', 'blood_group', 'expiry_date', 'created_at');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                //   $posts['end_date'] = post_data('end_date');
                //   $posts['start_date'] = post_data('start_date');
                $posts['unit_no'] = post_data('unit_no');
                $list = $this->um->_search_bb_stock_prc($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {

                    $no++;
                    $row = array();
                    $row[]  = '<input type="checkbox" name="ids[]" value="' . $lab->id . '" class="record-checkbox" checked> ' . $no; // Checkbox column
                    $row[]  = $lab->unit_no;
                    $row[]  = $lab->bag_config;
                    $row[]  =   $lab->final_vol;
                    $row[]  =   $lab->blood_group;
                    $row[]  =   $lab->expiry_date;
                    $row[]  =   $lab->created_at;
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_search_bb_stock_prc($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_search_bb_stock_prc($posts, $param, TRUE),
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

    public function bb_req_met_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'p_name',
                    'mobile',
                    'component',
                    'hospital',
                );

                $param['column_search'] = array('p_name', 'mobile', 'component', 'hospital');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['bb_id'] = post_data('bb_id');
                $posts['days_filter'] = post_data('dayfilter');
                $posts['start_date'] = post_data('start_date');
                $posts['end_date'] = post_data('end_date');
                $posts['name'] = post_data('name');
                $posts['blood_group'] = post_data('blood_group');
                $list = $this->um->_get_bg_req_met($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    $component = $this->get_com($lab->component);
                    $no++;
                    $row = array();
                    $row[]  =   $no;
                    $row[]  =   $lab->p_name;
                    $row[]  =   $lab->mobile;
                    $row[]  =   $component;
                    $row[]  =   $lab->doc . '/' . $lab->hospital;

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bg_req_met($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bg_req_met($posts, $param, TRUE),
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

    public function bb_stock_detail_search()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'p_name',
                    'mobile',
                    'component',
                    'hospital',
                );
                $param['column_search'] = array('p_name', 'mobile', 'component', 'hospital');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['bb_id'] = post_data('bb_id');
                $posts['b_stock_type'] = post_data('b_stock_type');
                $posts['days_filter'] = post_data('dayfilter');
                $posts['start_date'] = post_data('start_date');
                $posts['end_date'] = post_data('end_date');
                $posts['name'] = post_data('name');
                $posts['blood_group'] = post_data('blood_group');
                $list = $this->um->_get_blood_stock_detail($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    // log_message('info',json_encode($lab));
                    $component = $this->get_com($lab->component);
                    
                    if ($lab->blood_from_bank != null) {
                        $this->db->from("bl_agency");
                        $this->db->where('id', $lab->blood_from_bank);
                        $bloodbank = $this->db->get()->row();
                        if ($bloodbank) {
                            $donor_name = $bloodbank->a_name;
                            $mobile = $bloodbank->phon;
                            $blood_group = '';
                        } else {
                            $donor_name = 'Blood Bank';
                            $mobile = 'XXXXXXXXXX';
                            $blood_group = '';
                        }
                    } else {
                        $donor_name = $lab->donor_name;
                        $mobile = $lab->mobile;
                        $blood_group = $lab->blood_group;
                    }
                    $no++;

                    $row = array();
                    $row[]  =   $no;
                    $row[]  =   $donor_name.'<br>'.$mobile;
                    $row[]  =   $blood_group;
                    $row[]  =   $component;
                    $row[]  =   $lab->final_vol;
                    $row[]  =   $lab->donation_date;
                    $row[]  =   $lab->expiry_date;
                    if($_SESSION['admin_type'] != 5){
                    $row[]  =   $lab->bl_name;
                    }
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_blood_stock_detail($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_blood_stock_detail($posts, $param, TRUE),
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
    public function bb_stock_over_view_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'p_name',
                    'mobile',
                    'component',
                    'hospital',
                    'hospital',
                );
                $param['column_search'] = array('p_name', 'mobile', 'component', 'hospital', 'hospital');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['status'] = $this->input->post('status');
                $list = $this->um->_get_blood_stock_overview($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                if ($posts['status'] == "Agency") {
                    $txt = "FFP";
                } else {
                    $txt = "PRC";
                }
                foreach ($list as $lab) {
                    $rec = json_decode($lab->stock_data);
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $lab->a_name;
                    $row[] = $lab->issue_no;
                    $row[] = $txt;
                    $row[] = $rec[0]->blood_group; // Fixed typo here
                    $row[] = $rec[0]->unit_no; // Fixed typo here
                    $row[] = $rec[0]->created_at; // Fixed typo here
                    $row[] = $rec[0]->expiry_date; // Fixed typo here
                    $data[] = $row;
                }
                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_blood_stock_overview($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_blood_stock_overview($posts, $param, TRUE),
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

    public function bb_req_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'pname',
                    'mobile',
                    'component',
                    'required_date',
                );

                $param['column_search'] = array('pname', 'mobile', 'component', 'required_date');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['bb_id'] = post_data('bb_id');
                $posts['days_filter'] = post_data('dayfilter');
                $posts['start_date'] = post_data('start_date');
                $posts['end_date'] = post_data('end_date');
                $posts['name'] = post_data('name');
                $posts['blood_group'] = post_data('blood_group');
                $list = $this->um->_get_bg_req($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                $replacements = array(
                    "whole_blood_unit" => "Whole blood",
                    "Cryo_Poor_Plasma_unit" => "CRYO",
                    "Fresh_Frozen_Plasma_unit" => "FFP",
                    "Red_blood_cell_unit" => "RDP",
                    "Platelet_rich_concentrate_unit" => "PRBC"
                );
                foreach ($list as $lab) {
                    $component = $this->get_com($lab->component);
                    if ($component == "") {
                        $jsonData = json_decode($lab->components_unit, true);
                        $nonEmptyKeys = array_keys(array_filter($jsonData, function ($value) {
                            return $value !== "";
                        }));
                        $component = implode(", ", $nonEmptyKeys);
                        foreach ($replacements as $search => $replace) {
                            $component = str_replace($search, $replace, $component);
                        }
                    }
                    $no++;
                    $row = array();
                    $row[]  =   $no;
                    $row[]  =   $lab->pname;
                    $row[]  =   $lab->mobile;
                    $row[]  =   $component;
                    $row[]  =   $lab->required_date;

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bg_req($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bg_req($posts, $param, TRUE),
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
    public function bg_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'donor_name',
                    'mobile',
                    'blood_group',
                    'donation_date'
                );
                $param['column_search'] = array('donor_name', 'mobile', 'blood_group', 'donation_date');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();
                $posts['bb_id'] = post_data('bb_id');
                $posts['d_type'] = post_data('d_type');
                $posts['g_type'] = post_data('g_type');
                $posts['days_filter'] = post_data('dayfilter');
                $posts['start_date'] = post_data('start_date');
                $posts['end_date'] = post_data('end_date');
                $posts['name'] = post_data('name');
                $posts['blood_group'] = post_data('blood_group');
                $posts['status'] = post_data('status');
                //   $posts['test_result'] = post_data('test_result');
                //   $posts['donation_type'] = post_data('donation_type');
                $list = $this->um->_get_bg($posts, $param, FALSE, FALSE);
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    $no++;
                    $row = array();
                    $row[]  =   $no;
                    $row[]  =   $lab->donor_name;
                    $row[]  =   $lab->mobile;
                    $row[]  =   $lab->blood_group;
                    $row[]  =   $lab->donation_date;
                    $data[] = $row;
                }
                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_bg($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_bg($posts, $param, TRUE),
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
    public function bg_app_search()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'donor_name',
                    'mobile',
                    'blood_group',
                    'donation_date'
                );

                $param['column_search'] = array('donor_name', 'mobile', 'blood_group', 'donation_date');
                $posts = $this->input->post();
                $posts['bb_id'] = post_data('bb_id');
                $posts['d_type'] = post_data('d_type');

                $posts['g_type'] = post_data('g_type');
                $posts['days_filter'] = post_data('dayfilter');
                $posts['start_date'] = post_data('start_date');
                $posts['end_date'] = post_data('end_date');
                $posts['name'] = post_data('name');
                $posts['approved_status'] = post_data('approved_status');
                $posts['donation_status'] = post_data('donation_status');
                $posts['blood_group'] = post_data('blood_group');


                if ($posts['d_type'] == "req") {
                    $list = $this->um->_get_bg_app_req($posts, $param, FALSE, FALSE);
                } else {
                    $list = $this->um->_get_bg_app($posts, $param, FALSE, FALSE);
                }
                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;
                $action = '';
                foreach ($list as $lab) {
                    $no++;
                    $row = array();
                    $row[]  =   $no;
                    $row[]  =   $lab->donor_name;
                    $row[]  =   $lab->mobile;
                    $row[]  =   $lab->blood_group;
                    $row[]  =   $lab->donation_date;
                    $data[] = $row;
                }

                if ($posts['d_type'] == "req") {
                    $output = array(
                        "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                        "recordsTotal" => $this->um->_get_bg_app_req($posts, $param, TRUE),
                        "recordsFiltered" => $this->um->_get_bg_app_req($posts, $param, TRUE),
                        "data" => $data,
                    );
                } else {
                    $output = array(
                        "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                        "recordsTotal" => $this->um->_get_bg_app($posts, $param, TRUE),
                        "recordsFiltered" => $this->um->_get_bg_app($posts, $param, TRUE),
                        "data" => $data,
                    );
                }


                echo json_encode($output);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }



    public function indexlabsAddEdit($id = null)
    {
        if (session_userdata('isAdminLoggedin')) {

            if ($id != null) {
                $this->data['lab_id'] = $id;
                $id = decode_data($id);
                $page_title = 'Update Labs';

                $get_user = $this->um->get_user(array('id' => $id), '5');

                $get_user_mics_data = $this->um->get_mics_data(array('misc_type' => 'Lab', 'misc_type_id' => $id));

                $this->data['blood_bank_data'] = $get_user;
                $this->data['blood_bank_misc_data'] = $get_user_mics_data;
            } else {
                $page_title = 'Register Lab';
            }

            $this->data['page_title'] = $page_title;

            $this->data['bredcrumb'] = array(
                'Dashboard' => $this->data['base_url'],
                'Lab' => $this->data['base_url'] . '/labs'
            );

            $_states = array();
            $_categories = array();
            $_districts = array();
            $_cities = array();
            $_components = array();

            $states = $this->sm->get_states(NULL, FALSE);

            foreach ($states as $key => $value) {
                $_states[] = array(
                    'state_id' => $value->id,
                    'state_name' => $value->state_name,
                    'selected' => (isset($get_user) && ($get_user->state_id == $value->id)) ? 'selected' : ''
                );
            }

            $this->data['states'] = $_states;


            if (isset($get_user) && !empty($get_user)) {
                $districts = $this->sm->get_districts(array('state_id' => $get_user->state_id), FALSE);

                if (!empty($districts)) {
                    foreach ($districts as $key => $value) {
                        $_districts[] = array(
                            'district_id' => $value->id,
                            'district_name' => $value->district_name,
                            'selected' => ($get_user->district_id == $value->id) ? 'selected' : ''

                        );
                    }
                }
            }

            $this->data['districts'] = $_districts;

            if (isset($get_user) && !empty($get_user)) {
                $cities = $this->sm->get_cities(array('state_id' => $get_user->state_id, 'district_id' => $get_user->district_id), FALSE);

                if (!empty($cities)) {
                    foreach ($cities as $key => $value) {
                        $_cities[] = array(
                            'city_id' => $value->id,
                            'city_name' => $value->city_name,
                            'selected' => ($get_user->city_id == $value->id) ? 'selected' : ''

                        );
                    }
                }
            }

            $this->data['cities'] = $_cities;


            //$categories=$this->sm->get_categories(null,FALSE);

            $categories = $this->sm->get_masters(array('master_type_key' => 'organisation_types'), FALSE);

            foreach ($categories as $key => $value) {
                $_categories[] = array(
                    'category_id' => $value->master_id,
                    'category_name' => $value->master_type_key_value,
                    'selected' => (isset($get_user) && ($get_user->category_id == $value->master_id)) ? 'selected' : ''
                );
            }

            $this->data['categories'] = $_categories;


            $components = $this->sm->get_masters(array('master_type_key' => 'component_types', 'master_type_key_status' => 'active'), FALSE);

            if (!empty($components)) {
                foreach ($components as $key => $value) {
                    $_components[] = array(
                        'component_id' => $value->master_id,
                        'component_value' => $value->master_type_key_value,
                        'component_short_value' => $value->master_type_key_short_value,
                        'selected' => (isset($get_user) && $get_user->components_available != NULL && in_array($value->master_id, char_separated_to_array($get_user->components_available))) ? 'checked' : ''
                    );
                }
            }

            $this->data['components'] = $_components;

            $this->theme->title($this->data['page_title'])->load('organisations/vw_labs_add_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }


    public function onAddEditlab()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                //print_r($_POST); die();
                $lab_id = post_data('lab_id');

                $data_tab = post_data('data_tab');


                if ($data_tab == 'basic_details') {

                    $org_name = post_data('org_name');
                    //$org_parent_hospital=post_data('org_parent_hospital');
                    $org_short_name = post_data('org_short_name');
                    $latitude = post_data('latitude');
                    $longitude = post_data('longitude');
                    $org_category = post_data('org_category');
                    $org_contact_name = post_data('org_contact_name');
                    $org_email = post_data('org_email');
                    $org_ph_no = post_data('org_ph_no');
                    $org_fax_no = post_data('org_fax_no');
                    $org_lic_no = post_data('org_lic_no');
                    $org_lic_valid_from = post_data('org_lic_valid_from');
                    $org_lic_valid_to = post_data('org_lic_valid_to');
                    $org_component_facillity = post_data('org_component_facillity');
                    $org_apheresis_facillity = post_data('org_apheresis_facillity');
                    $org_help_line_no = post_data('org_help_line_no');
                    $org_state = post_data('org_state');
                    $org_districs = post_data('org_districs');
                    $org_city = post_data('org_city');
                    $org_pincode = post_data('org_pincode');
                    $org_address1 = post_data('org_address1');
                    $org_address2 = post_data('org_address2');
                    $org_password = post_data('org_password');

                    $org_available_components = $this->input->post('org_available_components');

                    //echo $org_city;die;

                    if (is_numeric($org_city)) {
                        $city_id = $org_city;
                    } else if (is_string($org_city)) {
                        $get_cities = $this->sm->get_cities(array('state_id' => $org_state, 'district_id' => $org_districs, 'city_name' => $org_city));

                        if (!empty($get_cities)) {
                            $city_id = $get_cities->id;
                        } else {
                            $city_id = $this->sm->store_cities(array('state_id' => $org_state, 'district_id' => $org_districs, 'city_name' => $org_city));
                        }
                    }

                    $data_to_add = array(
                        'name' => $org_name,
                        'short_name' => $org_short_name,
                        'org_type' => 'Lab',
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'boarding_type' => 'Onboarding',
                        'state_id' => $org_state,
                        'city_id' => $city_id,
                        'district_id' => $org_districs,
                        'pincode' => $org_pincode,
                        'address_1' => $org_address1,
                        'address_2' => $org_address2,
                        'category_id' => $org_category,
                        'contact_person' => $org_contact_name,
                        'contact_email' => $org_email,
                        'contact_ph_no' => $org_ph_no,
                        'fax_no' => $org_fax_no,
                        'lic_no' => $org_lic_no,
                        'lic_valid_from' => date('Y-m-d', strtotime($org_lic_valid_from)),
                        'lic_valid_to' => date('Y-m-d', strtotime($org_lic_valid_to)),
                        'component_facillity' => $org_component_facillity,
                        'apheresis_facillity' => $org_apheresis_facillity,
                        'components_available' => (!empty($org_available_components)) ? char_separated($org_available_components) : NULL,
                        'help_line_no' => $org_help_line_no
                    );

                    if (empty($lab_id)) {

                        $duplicate_data = $this->um->get_duplicate_blood_banks_data(array('contact_email' => $org_email), array('contact_ph_no' => $org_ph_no));

                        if ($duplicate_data[0]->counted == 0) {

                            $_data_to_add = array_merge($data_to_add, array('created_at' => date('Y-m-d'), 'created_by' => $this->data['userdata']->id));

                            $added = $this->um->store_blood_bank_data($_data_to_add);

                            if ($added) {

                                $password = (!empty($org_password)) ? password_hash($org_password, PASSWORD_BCRYPT, array('cost' => 12)) : password_hash('Password@123', PASSWORD_BCRYPT, array('cost' => 12));

                                $user_data = array(
                                    'role_id' => '5',
                                    'email' => $org_email,
                                    'password' => $password,
                                    'user_status' => 'active',
                                    'created_at' => date('Y-m-d'),
                                    'created_by' => $this->data['userdata']->id
                                );

                                $user_id = $this->um->store_users($user_data);

                                if ($user_id) {
                                    $this->um->update_blood_bank_data(array('user_id' => $user_id), array('blood_bank_id' => $added));
                                }

                                $return['success'] = 'Basic details has been added.';
                                // $return['redirect']=$this->data['base_url'].'/bloodbanks/add/'.encode_data($user_id);
                                // session_set_userdata(array('next_step'=>'mics_details'));
                            } else {
                                $return['error'] = 'there was an error occurred';
                            }
                        } else {
                            $return['error'] = 'Email or Phone No already in use';
                        }
                    } else {
                        $lab_id = decode_data($lab_id);

                        $get_user = $this->um->get_user(array('id' => $lab_id), '5');

                        if (!empty($get_user)) {

                            $duplicate_data = $this->um->get_duplicate_blood_banks_data(array('user_id!=' => $lab_id), array('contact_ph_no' => $org_ph_no, 'contact_email' => $org_email), null, null, FALSE);



                            //print_obj($duplicate_data);die;

                            if ($duplicate_data[0]->counted == 0) {
                                $_data_to_add = array_merge($data_to_add, array('updated_at' => date('Y-m-d'), 'updated_by' => $this->data['userdata']->id));
                                $updated = $this->um->update_blood_bank_data($_data_to_add, array('blood_bank_id' => $get_user->blood_bank_id));

                                if ($updated) {

                                    if (!empty($org_password)) {
                                        $password = password_hash($org_password, PASSWORD_BCRYPT, array('cost' => 12));
                                        $this->um->update_users(array('password' => $password), array('id' => $get_user->user_id));
                                    }


                                    $return['success'] = 'Data has been updated successfully.';
                                } else {
                                    $return['error'] = 'Error occurred to update data.';
                                }
                            } else {
                                $return['error'] = 'Data already exists with the same email or phone no';
                            }
                        } else {
                            $return['error'] = 'Data not found in the system.';
                        }
                    }
                }

                return json_headers($return);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function onDeletelab()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

                $blood_bank_id = post_data('blood_bank_id');

                if (!empty($blood_bank_id)) {
                    $blood_bank_id = decode_data($blood_bank_id);

                    $_get_blood_bank = $this->um->get_user(array('user_id' => $blood_bank_id), '5');

                    //print_obj($_get_blood_bank);die;

                    if (!empty($_get_blood_bank)) {

                        $deleted = $this->um->delete_blood_bank_datas(array('blood_bank_id' => $_get_blood_bank->blood_bank_id));

                        if ($deleted) {
                            $this->um->delete_users(array('id' => $_get_blood_bank->user_id));

                            $get_files = $this->sm->get_files(array('storage_data_type' => '5', 'storage_data_type_id' => $_get_blood_bank->blood_bank_id));

                            if (!empty($get_files)) {
                                foreach ($get_files as $key => $value) {
                                    @unlink(FCPATH . $value->media_disk_path);
                                    $this->sm->delete_file(array('storage_id' => $value->storage_id));
                                }
                            }

                            $return['success'] = 'Data has been deleted successfully';
                        } else {
                            $return['error'] = 'Data has been deleted';
                        }
                    } else {
                        $return['error'] = 'data not found';
                    }
                } else {
                    $return['error'] = 'Data has not been deleted';
                }

                json_headers($return);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }


    //Hospitals
    function indexHospitals()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Hospitals';

            $this->data['bredcrumb'] = array(
                'Dashboard' => $this->data['base_url'],
                'Hospitals' => ''
            );

            $this->theme->title($this->data['page_title'])->load('organisations/vw_hospitals', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }


    public function onSearchHospitals()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'name',
                    'city_name',
                    'state_name',
                    'boarding_type'
                );

                $param['column_search'] = array('name', 'city_name', 'state_name', 'boarding_type');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();


                //$param['created_by']=session_userdata('admin_id');


                $list = $this->um->_get_hospitals($posts, $param, FALSE, FALSE);

                // print_obj($list);die;


                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';

                foreach ($list as $hospital) {
                    $no++;

                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $hospital->name;
                    $row[]  =   $hospital->city_name;
                    $row[]  =   $hospital->state_name;
                    $row[]  =   $hospital->boarding_type;

                    $row[]  =   '<a href="' . $this->data['base_url'] . '/hospitals/add/' . encode_data($hospital->user_id) . '" class="btn btn-xs btn-info btn_edit_college"><i class="fa fa-edit"></i></a> <button type="button" class="btn btn-xs btn-dark btn_del_hospital" data-blood_bank_id="' . encode_data($hospital->user_id) . '"><i class="fa fa-trash"></i></button><a href="' . $this->data['base_url'] . '/hospital/status/' . $hospital->user_id . '/' . $hospital->status . '" class="btn btn-xs btn-danger">' . $hospital->status . '</a>';

                    //<button type="button" class="btn btn-xs btn-danger" data-session="'.encode_data($hospital->user_id).'"><i class="fa fa-trash"></i></button>
                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_hospitals($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_hospitals($posts, $param, TRUE),
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
    public function indexHospitalsAddEdit($id = null)
    {
        if (session_userdata('isAdminLoggedin')) {

            if ($id != null) {
                $this->data['hospital_id'] = $id;
                $id = decode_data($id);
                $page_title = 'Update Hospital';

                $get_user = $this->um->get_user(array('id' => $id), '5');

                $get_user_mics_data = $this->um->get_mics_data(array('misc_type' => 'Hospital', 'misc_type_id' => $id));

                $this->data['blood_bank_data'] = $get_user;
                $this->data['blood_bank_misc_data'] = $get_user_mics_data;
            } else {
                $page_title = 'Register Hospital';
            }

            $this->data['page_title'] = $page_title;

            $this->data['bredcrumb'] = array(
                'Dashboard' => $this->data['base_url'],
                'Hospital' => $this->data['base_url'] . '/hospitals'
            );

            $_states = array();
            $_categories = array();
            $_districts = array();
            $_cities = array();
            $_components = array();

            $states = $this->sm->get_states(NULL, FALSE);

            foreach ($states as $key => $value) {
                $_states[] = array(
                    'state_id' => $value->id,
                    'state_name' => $value->state_name,
                    'selected' => (isset($get_user) && ($get_user->state_id == $value->id)) ? 'selected' : ''
                );
            }

            $this->data['states'] = $_states;


            if (isset($get_user) && !empty($get_user)) {
                $districts = $this->sm->get_districts(array('state_id' => $get_user->state_id), FALSE);

                if (!empty($districts)) {
                    foreach ($districts as $key => $value) {
                        $_districts[] = array(
                            'district_id' => $value->id,
                            'district_name' => $value->district_name,
                            'selected' => ($get_user->district_id == $value->id) ? 'selected' : ''

                        );
                    }
                }
            }

            $this->data['districts'] = $_districts;

            if (isset($get_user) && !empty($get_user)) {
                $cities = $this->sm->get_cities(array('state_id' => $get_user->state_id, 'district_id' => $get_user->district_id), FALSE);

                if (!empty($cities)) {
                    foreach ($cities as $key => $value) {
                        $_cities[] = array(
                            'city_id' => $value->id,
                            'city_name' => $value->city_name,
                            'selected' => ($get_user->city_id == $value->id) ? 'selected' : ''

                        );
                    }
                }
            }

            $this->data['cities'] = $_cities;


            //$categories=$this->sm->get_categories(null,FALSE);

            $categories = $this->sm->get_masters(array('master_type_key' => 'organisation_types'), FALSE);

            foreach ($categories as $key => $value) {
                $_categories[] = array(
                    'category_id' => $value->master_id,
                    'category_name' => $value->master_type_key_value,
                    'selected' => (isset($get_user) && ($get_user->category_id == $value->master_id)) ? 'selected' : ''
                );
            }

            $this->data['categories'] = $_categories;


            $components = $this->sm->get_masters(array('master_type_key' => 'component_types', 'master_type_key_status' => 'active'), FALSE);

            if (!empty($components)) {
                foreach ($components as $key => $value) {
                    $_components[] = array(
                        'component_id' => $value->master_id,
                        'component_value' => $value->master_type_key_value,
                        'component_short_value' => $value->master_type_key_short_value,
                        'selected' => (isset($get_user) && $get_user->components_available != NULL && in_array($value->master_id, char_separated_to_array($get_user->components_available))) ? 'checked' : ''
                    );
                }
            }

            $this->data['components'] = $_components;

            $this->theme->title($this->data['page_title'])->load('organisations/vw_hospitals_add_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    // public function onAddEditHospital(){
    //     if(session_userdata('isAdminLoggedin')==TRUE && session_userdata('admin_id')){
    //         if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){

    //         }else{
    //             redirect($this->data['base_url']);
    //         }
    //     }else{
    //         redirect($this->data['base_url']);
    //     }
    // }

    // public function onDeleteHospital(){
    //     if(session_userdata('isAdminLoggedin')==TRUE && session_userdata('admin_id')){
    //         if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD')=='POST'){

    //         }else{
    //             redirect($this->data['base_url']);
    //         }
    //     }else{
    //         redirect($this->data['base_url']);
    //     }
    // }

    public function onAddEditHospital()
    {
        //print_r($_POST); die();
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

                $hospital_id = post_data('hospital_id');

                $data_tab = post_data('data_tab');

                if ($data_tab == 'basic_details') {

                    $org_name = post_data('org_name');
                    //$org_parent_hospital=post_data('org_parent_hospital');
                    $org_short_name = post_data('org_short_name');
                    $org_category = post_data('org_category');
                    $website = post_data('website');
                    $blood_center = post_data('blood_center');
                    $latitude = post_data('latitude');
                    $longitude = post_data('longitude');
                    $org_contact_name = post_data('org_contact_name');
                    $org_email = post_data('org_email');
                    $org_ph_no = post_data('org_ph_no');
                    $org_fax_no = post_data('org_fax_no');
                    $org_lic_no = post_data('org_lic_no');
                    $org_lic_valid_from = post_data('org_lic_valid_from');
                    $org_lic_valid_to = post_data('org_lic_valid_to');
                    $org_component_facillity = post_data('org_component_facillity');
                    $org_apheresis_facillity = post_data('org_apheresis_facillity');
                    $org_help_line_no = post_data('org_help_line_no');
                    $org_state = post_data('org_state');
                    $org_districs = post_data('org_districs');
                    $org_city = post_data('org_city');
                    $org_pincode = post_data('org_pincode');
                    $org_address1 = post_data('org_address1');
                    $org_address2 = post_data('org_address2');
                    $org_password = post_data('org_password');

                    $org_available_components = $this->input->post('org_available_components');

                    //echo $org_city;die;

                    if (is_numeric($org_city)) {
                        $city_id = $org_city;
                    } else if (is_string($org_city)) {
                        $get_cities = $this->sm->get_cities(array('state_id' => $org_state, 'district_id' => $org_districs, 'city_name' => $org_city));

                        if (!empty($get_cities)) {
                            $city_id = $get_cities->id;
                        } else {
                            $city_id = $this->sm->store_cities(array('state_id' => $org_state, 'district_id' => $org_districs, 'city_name' => $org_city));
                        }
                    }


                    $data_to_add = array(
                        'name' => $org_name,
                        'short_name' => $org_short_name,
                        'org_type' => 'Hospital',
                        'website' => $website,
                        'blood_center' => $blood_center,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'boarding_type' => 'Onboarding',
                        'state_id' => $org_state,
                        'city_id' => $city_id,
                        'district_id' => $org_districs,
                        'pincode' => $org_pincode,
                        'address_1' => $org_address1,
                        'address_2' => $org_address2,
                        'category_id' => $org_category,
                        'contact_person' => $org_contact_name,
                        'contact_email' => $org_email,
                        'contact_ph_no' => $org_ph_no,
                        'fax_no' => $org_fax_no,
                        'lic_no' => $org_lic_no,
                        'lic_valid_from' => date('Y-m-d', strtotime($org_lic_valid_from)),
                        'lic_valid_to' => date('Y-m-d', strtotime($org_lic_valid_to)),
                        'component_facillity' => $org_component_facillity,
                        'apheresis_facillity' => $org_apheresis_facillity,
                        'components_available' => (!empty($org_available_components)) ? char_separated($org_available_components) : NULL,
                        'help_line_no' => $org_help_line_no
                    );

                    if (empty($hospital_id)) {

                        $duplicate_data = $this->um->get_duplicate_blood_banks_data(array('contact_email' => $org_email), array('contact_ph_no' => $org_ph_no));

                        if ($duplicate_data[0]->counted == 0) {

                            $_data_to_add = array_merge($data_to_add, array('created_at' => date('Y-m-d'), 'created_by' => $this->data['userdata']->id));

                            $added = $this->um->store_blood_bank_data($_data_to_add);

                            if ($added) {

                                $password = (!empty($org_password)) ? password_hash($org_password, PASSWORD_BCRYPT, array('cost' => 12)) : password_hash('Password@123', PASSWORD_BCRYPT, array('cost' => 12));

                                $user_data = array(
                                    'role_id' => '5',
                                    'email' => $org_email,
                                    'password' => $password,
                                    'user_status' => 'active',
                                    'created_at' => date('Y-m-d'),
                                    'created_by' => $this->data['userdata']->id
                                );

                                $user_id = $this->um->store_users($user_data);

                                if ($user_id) {
                                    $this->um->update_blood_bank_data(array('user_id' => $user_id), array('blood_bank_id' => $added));
                                }

                                $return['success'] = 'Basic details has been added.';
                                //$return['redirect']=$this->data['base_url'].'/bloodbanks/add/'.encode_data($user_id);
                                //session_set_userdata(array('next_step'=>'mics_details'));
                            } else {
                                $return['error'] = 'there was an error occurred';
                            }
                        } else {
                            $return['error'] = 'Email or Phone No already in use';
                        }
                    } else {
                        $hospital_id = decode_data($hospital_id);

                        $get_user = $this->um->get_user(array('id' => $hospital_id), '5');

                        if (!empty($get_user)) {

                            $duplicate_data = $this->um->get_duplicate_blood_banks_data(array('user_id!=' => $hospital_id), array('contact_ph_no' => $org_ph_no, 'contact_email' => $org_email), null, null, FALSE);



                            //print_obj($duplicate_data);die;

                            if ($duplicate_data[0]->counted == 0) {
                                $_data_to_add = array_merge($data_to_add, array('updated_at' => date('Y-m-d'), 'updated_by' => $this->data['userdata']->id));
                                $updated = $this->um->update_blood_bank_data($_data_to_add, array('blood_bank_id' => $get_user->blood_bank_id));

                                if ($updated) {

                                    if (!empty($org_password)) {
                                        $password = password_hash($org_password, PASSWORD_BCRYPT, array('cost' => 12));
                                        $this->um->update_users(array('password' => $password), array('id' => $get_user->user_id));
                                    }


                                    $return['success'] = 'Data has been updated successfully.';
                                } else {
                                    $return['error'] = 'Error occurred to update data.';
                                }
                            } else {
                                $return['error'] = 'Data already exists with the same email or phone no';
                            }
                        } else {
                            $return['error'] = 'Data not found in the system.';
                        }
                    }
                }

                return json_headers($return);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }


    public function onDeleteHospital()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

                $blood_bank_id = post_data('blood_bank_id');

                if (!empty($blood_bank_id)) {
                    $blood_bank_id = decode_data($blood_bank_id);

                    $_get_blood_bank = $this->um->get_user(array('user_id' => $blood_bank_id), '5');

                    //print_obj($_get_blood_bank);die;

                    if (!empty($_get_blood_bank)) {

                        $deleted = $this->um->delete_blood_bank_datas(array('blood_bank_id' => $_get_blood_bank->blood_bank_id));

                        if ($deleted) {
                            $this->um->delete_users(array('id' => $_get_blood_bank->user_id));

                            $get_files = $this->sm->get_files(array('storage_data_type' => '5', 'storage_data_type_id' => $_get_blood_bank->blood_bank_id));

                            if (!empty($get_files)) {
                                foreach ($get_files as $key => $value) {
                                    @unlink(FCPATH . $value->media_disk_path);
                                    $this->sm->delete_file(array('storage_id' => $value->storage_id));
                                }
                            }

                            $return['success'] = 'Data has been deleted successfully';
                        } else {
                            $return['error'] = 'Data has been deleted';
                        }
                    } else {
                        $return['error'] = 'data not found';
                    }
                } else {
                    $return['error'] = 'Data has not been deleted';
                }

                json_headers($return);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }
    //Blood Banks
    function indexBloodBanks()
    {

        if (session_userdata('isAdminLoggedin')) {
            $this->active_controller = 'Organisations';
            $this->data['page_title'] = 'Blood Banks';

            $this->data['bredcrumb'] = array(
                'Dashboard' => $this->data['base_url'],
                'Blood Banks' => ''
            );

            $this->theme->title($this->data['page_title'])->load('organisations/vw_blood_banks', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }


    public function indexBloodBankAddEdit($id = null)
    {
        if (session_userdata('isAdminLoggedin')) {

            if ($id != null) {
                $this->data['blood_bank_id'] = $id;
                $id = decode_data($id);
                $page_title = 'Update Blood Bank';

                $get_user = $this->um->get_user(array('id' => $id), '5');

                $get_user_mics_data = $this->um->get_mics_data(array('misc_type' => 'blood_bank', 'misc_type_id' => $id));

                $this->data['blood_bank_data'] = $get_user;
                $this->data['blood_bank_misc_data'] = $get_user_mics_data;
            } else {
                $page_title = 'Register Blood Bank';
            }

            $this->data['page_title'] = $page_title;

            $this->data['bredcrumb'] = array(
                'Dashboard' => $this->data['base_url'],
                'Blood Banks' => $this->data['base_url'] . '/bloodbanks'
            );

            $_states = array();
            $_categories = array();
            $_districts = array();
            $_cities = array();
            $_components = array();

            $states = $this->sm->get_states(NULL, FALSE);

            foreach ($states as $key => $value) {
                $_states[] = array(
                    'state_id' => $value->id,
                    'state_name' => $value->state_name,
                    'selected' => (isset($get_user) && ($get_user->state_id == $value->id)) ? 'selected' : ''
                );
            }

            $this->data['states'] = $_states;


            if (isset($get_user) && !empty($get_user)) {
                $districts = $this->sm->get_districts(array('state_id' => $get_user->state_id), FALSE);

                if (!empty($districts)) {
                    foreach ($districts as $key => $value) {
                        $_districts[] = array(
                            'district_id' => $value->id,
                            'district_name' => $value->district_name,
                            'selected' => ($get_user->district_id == $value->id) ? 'selected' : ''

                        );
                    }
                }
            }

            $this->data['districts'] = $_districts;

            if (isset($get_user) && !empty($get_user)) {
                $cities = $this->sm->get_cities(array('state_id' => $get_user->state_id, 'district_id' => $get_user->district_id), FALSE);

                if (!empty($cities)) {
                    foreach ($cities as $key => $value) {
                        $_cities[] = array(
                            'city_id' => $value->id,
                            'city_name' => $value->city_name,
                            'selected' => ($get_user->city_id == $value->id) ? 'selected' : ''

                        );
                    }
                }
            }

            $this->data['cities'] = $_cities;


            //$categories=$this->sm->get_categories(null,FALSE);

            $categories = $this->sm->get_masters(array('master_type_key' => 'organisation_types'), FALSE);

            foreach ($categories as $key => $value) {
                $_categories[] = array(
                    'category_id' => $value->master_id,
                    'category_name' => $value->master_type_key_value,
                    'selected' => (isset($get_user) && ($get_user->category_id == $value->master_id)) ? 'selected' : ''
                );
            }

            $this->data['categories'] = $_categories;


            $components = $this->sm->get_masters(array('master_type_key' => 'component_types', 'master_type_key_status' => 'active'), FALSE);

            if (!empty($components)) {
                foreach ($components as $key => $value) {
                    $_components[] = array(
                        'component_id' => $value->master_id,
                        'component_value' => $value->master_type_key_value,
                        'component_short_value' => $value->master_type_key_short_value,
                        'selected' => (isset($get_user) && $get_user->components_available != NULL && in_array($value->master_id, char_separated_to_array($get_user->components_available))) ? 'checked' : ''
                    );
                }
            }

            $this->data['components'] = $_components;

            $this->theme->title($this->data['page_title'])->load('organisations/vw_blood_banks_add_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function onSearchBloodBanks()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'name',
                    'city_name',
                    'state_name',
                    'boarding_type'
                );

                $param['column_search'] = array('name', 'city_name', 'state_name', 'boarding_type');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $list = $this->um->_get_blood_banks($posts, $param, FALSE, FALSE);

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';

                foreach ($list as $blood_bank) {
                    $limitReached = ($blood_bank->used_requests >= $blood_bank->request_limit && $blood_bank->payments_approved== 0);
                    $limitStatus = $limitReached
                                    ? '<span class="badge badge-danger">Limit Reached</span> 
                                        <button 
                                          class="btn btn-xs btn-success btn-payment"
                                          data-user_id="'.encode_data($blood_bank->user_id).'"
                                          data-name="'.$blood_bank->name.'"
                                        >
                                          <i class="fa fa-credit-card"></i> Approve Payment
                                        </button>'
                                    : '';
                    $no++;

                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $blood_bank->name.'<br>'.$limitStatus;
                    $row[]  =   $blood_bank->city_name;
                    $row[]  =   $blood_bank->state_name;
                    $row[]  =   $blood_bank->boarding_type;

                    $row[]  =   '<a href="' . $this->data['base_url'] . '/bloodbanks/add/' . encode_data($blood_bank->user_id) . '" class="btn btn-xs btn-danger"><i class="fa fa-edit"></i></a>
                    <button type="button" class="btn btn-xs btn-dark btn_del_blood_bank" data-blood_bank_id="' . encode_data($blood_bank->user_id) . '"><i class="fa fa-trash"></i></button> <a href="' . $this->data['base_url'] . '/bloodbanks/status/' . $blood_bank->user_id . '/' . $blood_bank->status . '" class="btn btn-xs btn-danger">' . $blood_bank->status . '</a>';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->um->_get_blood_banks($posts, $param, TRUE),
                    "recordsFiltered" => $this->um->_get_blood_banks($posts, $param, TRUE),
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
    public function approve_payment()
    {
        if (!$this->input->is_ajax_request()) return;
    
        $user_id = decode_data($this->input->post('user_id'));
        $amount  = (float)$this->input->post('amount');
    
        if ($user_id && $amount > 0) {
    
            // save payment
            $this->db->insert('payments', [
                'bloodbank_id'    => $user_id,
                'amount'     => $amount,
                'exp_date'   => $this->input->post('exp_date'),
                // 'status'     => 'approved',
                'created_at'=> date('Y-m-d H:i:s')
            ]);
    
            // ðŸ”“ unlock automatically (system logic)
            $this->db->where('user_id', $user_id)
                     ->update('blood_banks', [
                         'payments_approved' => 1 // OR extend logic internally
                     ]);
    
            echo json_encode(['status'=>true]);
        }
    }


    public function bloodbanks_status()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        // print_r($status);die();
        if ($status == 'active') {
            $sta = 'inactive';
            # code...
        } else {
            $sta = 'active';
        }
        $update = $this->db->query("UPDATE bl_blood_banks SET status = '$sta' WHERE user_id = '$id'");
        redirect(base_url('admin/bloodbanks'));
    }

    public function hospital_status()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        // print_r($status);die();
        if ($status == 'active') {
            $sta = 'inactive';
            # code...
        } else {
            $sta = 'active';
        }
        $update = $this->db->query("UPDATE bl_blood_banks SET status = '$sta' WHERE user_id = '$id'");
        redirect(base_url('admin/hospitals'));
    }
    function stock_handover()
    {

        if (session_userdata('isAdminLoggedin')) {
            $b_id = $_SESSION['bank_id'];
            $this->data['page_title'] = 'Stock Handover';
            $this->db->from("bl_masters");
            $this->db->where('master_type_key', 'component_types');
            $com = $this->db->get();
            $com = $com->result();
            $this->db->from("bl_agency");
            $this->db->where('isdeleted', 0);
            $this->db->where('created_by', $b_id);
            $this->db->where('type', 'Agency');

            $aj = $this->db->get();
            $aj = $aj->result();
            $this->data['bredcrumbs'] = array(
                'Dashboard' => $this->data['base_url'],
                'Blood Group' => '',
            );
            $this->data['com'] = $com;
            $this->data['aj'] = $aj;
            $this->theme->title($this->data['page_title'])->load('dashboards/vw_stock_handover', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    function bb_stock_over_view()
    {

        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'Stock OverView';
            $this->data['bredcrumbs'] = array(
                'Dashboard' => $this->data['base_url'],
                'Blood Group' => '',
            );
            $this->theme->title($this->data['page_title'])->load('dashboards/vw_stock_overview', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    function bb_stock_transfer_in()
    {

        if (session_userdata('isAdminLoggedin')) {
            $b_id = $_SESSION['bank_id'];
            $this->data['page_title'] = 'Requisition To External Blood Bank';
            $this->db->from("bl_masters");
            $this->db->where('master_type_key', 'component_types');
            $com = $this->db->get();
            $com = $com->result();
            $this->db->from("bl_agency");
            $this->db->where('created_by', $b_id);
            $this->db->where('isdeleted', 0);
            $this->db->where('type', 'Bank');
            $aj = $this->db->get();
            $aj = $aj->result();
            $this->data['bredcrumbs'] = array(
                'Dashboard' => $this->data['base_url'],
                'Blood Group' => '',
            );
            $this->data['com'] = $com;
            $this->data['aj'] = $aj;
            $this->db->from("bl_masters");
            $this->db->where('master_id', 22);
            $exp = $this->db->get()->row();
            $this->data['exp_days'] = $exp->expiry_day;
            $this->theme->title($this->data['page_title'])->load('dashboards/vw_stock_in', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    function bb_stock_transfer_out()
    {

        if (session_userdata('isAdminLoggedin')) {
            $b_id = $_SESSION['bank_id'];
            $this->data['page_title'] = 'From External Blood Bank Requisition';
            $this->db->from("bl_masters");
            $this->db->where('master_type_key', 'component_types');
            $com = $this->db->get();
            $com = $com->result();
            $this->db->from("bl_agency");
            $this->db->where('isdeleted', 0);
            $this->db->where('created_by', $b_id);
            $this->db->where('type', 'Bank');
            $aj = $this->db->get();
            $aj = $aj->result();
            $this->data['bredcrumbs'] = array(
                'Dashboard' => $this->data['base_url'],
                'Blood Group' => '',
            );
            $this->data['com'] = $com;
            $this->data['aj'] = $aj;
            $this->theme->title($this->data['page_title'])->load('dashboards/vw_stock_out', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    public function lab_status()
    {
        // echo 'hiiii'; die;
        // alert('sdadassad'); die();
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        // print_r($status);die();
        if ($status == 'active') {
            $sta = 'inactive';
            # code...
        } else {
            $sta = 'active';
        }
        $update = $this->db->query("UPDATE bl_blood_banks SET status = '$sta' WHERE user_id = '$id'");
        redirect(base_url('admin/labs'));
    }

    public function onSearchBloodBanksFiles()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'storage_type_name'
                );

                $param['column_search'] = array('storage_type_name');
                $param['order'] = array('storage_id' => 'ASC');
                $posts = $this->input->post();

                $param['storage_data_type'] = '5';

                $param['data_id'] = decode_data($posts['data_id']);

                $list = $this->sm->_get_files($posts, $param, FALSE, FALSE);

                //print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';

                foreach ($list as $file) {
                    $no++;

                    $row = array();

                    $row[]  =   $no;
                    $row[]  =   $file->storage_type_name;
                    $row[]  =   '<img src="' . base_url($file->media_disk_path_relative) . '" width="100px" height="100px">';
                    $row[]  =   '<button type="button" class="btn btn-xs btn-dark btn_del_file" data-storage_id="' . encode_data($file->storage_id) . '" data-blood_bank_id="' . encode_data($file->storage_data_type_id) . '"><i class="fa fa-trash"></i></button>';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->sm->_get_files($posts, $param, TRUE),
                    "recordsFiltered" => $this->sm->_get_files($posts, $param, TRUE),
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


    public function onAddEditBloodBank()
    {
        // print_r($_POST); die();
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

                $blood_bank_id = post_data('blood_bank_id');

                $data_tab = post_data('data_tab');


                if ($data_tab == 'basic_details') {

                    $org_name = post_data('org_name');
                    $org_parent_hospital = post_data('org_parent_hospital');
                    $org_short_name = post_data('org_short_name');
                    $latitude = post_data('latitude');
                    $longitude = post_data('longitude');
                    $org_category = post_data('org_category');
                    $org_contact_name = post_data('org_contact_name');
                    $org_email = post_data('org_email');
                    $org_ph_no = post_data('org_ph_no');
                    $org_fax_no = post_data('org_fax_no');
                    $org_lic_no = post_data('org_lic_no');
                    $org_lic_valid_from = post_data('org_lic_valid_from');
                    $org_lic_valid_to = post_data('org_lic_valid_to');
                    $org_component_facillity = post_data('org_component_facillity');
                    $org_apheresis_facillity = post_data('org_apheresis_facillity');
                    $org_help_line_no = post_data('org_help_line_no');
                    $org_state = post_data('org_state');
                    $org_districs = post_data('org_districs');
                    $org_city = post_data('org_city');
                    $org_pincode = post_data('org_pincode');
                    $org_address1 = post_data('org_address1');
                    $org_address2 = post_data('org_address2');
                    $org_password = post_data('org_password');
                    $images = "";

                    $org_available_components = $this->input->post('org_available_components');

                    //echo $org_city;die;


                    if (is_numeric($org_city)) {
                        $city_id = $org_city;
                    } else if (is_string($org_city)) {
                        $get_cities = $this->sm->get_cities(array('state_id' => $org_state, 'district_id' => $org_districs, 'city_name' => $org_city));

                        if (!empty($get_cities)) {
                            $city_id = $get_cities->id;
                        } else {
                            $city_id = $this->sm->store_cities(array('state_id' => $org_state, 'district_id' => $org_districs, 'city_name' => $org_city));
                        }
                    }
                    if ($_FILES['blood_bank_logo']['name'] != '') {
                        $config['upload_path'] = './uploads/img';
                        $config['allowed_types'] = 'gif|jpg|png';

                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('blood_bank_logo')) {
                            $upload_data = $this->upload->data();
                            $images = $upload_data['file_name'];
                            // print_r($images); die;

                        } else {
                        }
                    }

                    $data_to_add = array(
                        'name' => $org_name,
                        'short_name' => $org_short_name,
                        'org_type' => 'Blood Bank',
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'state_id' => $org_state,
                        'boarding_type' => 'Onboarding',
                        'city_id' => $city_id,
                        'district_id' => $org_districs,
                        'pincode' => $org_pincode,
                        'address_1' => $org_address1,
                        'address_2' => $org_address2,
                        'category_id' => $org_category,
                        'logo' => $images,
                        'parent_hospital_id' => $org_parent_hospital,
                        'contact_person' => $org_contact_name,
                        'contact_email' => $org_email,
                        'contact_ph_no' => $org_ph_no,
                        'fax_no' => $org_fax_no,
                        'lic_no' => $org_lic_no,
                        'lic_valid_from' => date('Y-m-d', strtotime($org_lic_valid_from)),
                        'lic_valid_to' => date('Y-m-d', strtotime($org_lic_valid_to)),
                        'component_facillity' => $org_component_facillity,
                        'apheresis_facillity' => $org_apheresis_facillity,
                        'components_available' => (!empty($org_available_components)) ? char_separated($org_available_components) : NULL,
                        'help_line_no' => $org_help_line_no
                    );
                    // print_r($data_to_add); die;
                    if (empty($blood_bank_id)) {

                        $duplicate_data = $this->um->get_duplicate_blood_banks_data(array('contact_email' => $org_email), array('contact_ph_no' => $org_ph_no));

                        if ($duplicate_data[0]->counted == 0) {

                            $_data_to_add = array_merge($data_to_add, array('created_at' => date('Y-m-d'), 'created_by' => $this->data['userdata']->id));

                            $added = $this->um->store_blood_bank_data($_data_to_add);

                            if ($added) {

                                $password = (!empty($org_password)) ? password_hash($org_password, PASSWORD_BCRYPT, array('cost' => 12)) : password_hash('Password@123', PASSWORD_BCRYPT, array('cost' => 12));

                                $user_data = array(
                                    'role_id' => '5',
                                    'email' => $org_email,
                                    'password' => $password,
                                    'user_status' => 'active',
                                    'created_at' => date('Y-m-d'),
                                    'created_by' => $this->data['userdata']->id
                                );

                                $user_id = $this->um->store_users($user_data);

                                if ($user_id) {
                                    $this->um->update_blood_bank_data(array('user_id' => $user_id), array('blood_bank_id' => $added));
                                }

                                $return['success'] = 'Basic details has been added.';
                                $return['redirect'] = $this->data['base_url'] . '/bloodbanks/add/' . encode_data($user_id);
                                session_set_userdata(array('next_step' => 'mics_details'));
                            } else {
                                $return['error'] = 'there was an error occurred';
                            }
                        } else {
                            $return['error'] = 'Email or Phone No already in use';
                        }
                    } else {
                        $blood_bank_id = decode_data($blood_bank_id);

                        $get_user = $this->um->get_user(array('id' => $blood_bank_id), '5');

                        if (!empty($get_user)) {

                            $duplicate_data = $this->um->get_duplicate_blood_banks_data(array('user_id!=' => $blood_bank_id), array('contact_ph_no' => $org_ph_no, 'contact_email' => $org_email), null, null, FALSE);



                            //print_obj($duplicate_data);die;

                            if ($duplicate_data[0]->counted == 0) {
                                $_data_to_add = array_merge($data_to_add, array('updated_at' => date('Y-m-d'), 'updated_by' => $this->data['userdata']->id));
                                $updated = $this->um->update_blood_bank_data($_data_to_add, array('blood_bank_id' => $get_user->blood_bank_id));

                                if ($updated) {

                                    if (!empty($org_password)) {
                                        $password = password_hash($org_password, PASSWORD_BCRYPT, array('cost' => 12));
                                        $this->um->update_users(array('password' => $password), array('id' => $get_user->user_id));
                                    }


                                    $return['success'] = 'Data has been updated successfully.';
                                } else {
                                    $return['error'] = 'Error occurred to update data.';
                                }
                            } else {
                                $return['error'] = 'Data already exists with the same email or phone no';
                            }
                        } else {
                            $return['error'] = 'Data not found in the system.';
                        }
                    }
                } else if ($data_tab == 'mics_details') {
                    // print_r($_POST);die();
                    if (!empty($blood_bank_id)) {
                        $blood_bank_id = decode_data($blood_bank_id);

                        $org_tariff_name = post_data('org_tariff_name');
                        $org_tariff_charge = post_data('org_tariff_charge');
                        $org_area_name = post_data('org_area_name');
                        $org_area_usability = post_data('org_area_usability');
                        $org_area_room_no = post_data('org_area_room_no');
                        $org_storage_name = post_data('org_storage_name');
                        $org_storage_type = post_data('org_storage_type');
                        $org_storage_area_name = post_data('org_storage_area_name');
                        $org_storage_licence = post_data('org_storage_licence');
                        $org_refreshment_name = post_data('org_refreshment_name');
                        $org_refreshment_quality = post_data('org_refreshment_quality');

                        $get_user = $this->um->get_user(array('id' => $blood_bank_id), '5');

                        if (!empty($get_user)) {
                            $data_to_insert = array(
                                'misc_type' => 'blood_bank',
                                'misc_type_id' => $get_user->id,
                                'misc_tariff_name' => $org_tariff_name,
                                'misc_tariff_charge' => $org_tariff_charge,
                                'misc_area_name' => $org_area_name,
                                'misc_area_usability' => $org_area_usability,
                                'misc_area_room_no' => $org_area_room_no,
                                'misc_storage_name' => $org_storage_name,
                                'misc_storage_type' => $org_storage_type,
                                'misc_storage_area_name' => $org_storage_area_name,
                                'misc_storage_licence' => $org_storage_licence,
                                'misc_refreshment_name' => $org_refreshment_name,
                                'misc_refreshment_qty' => $org_refreshment_quality
                            );
                            // print_r($data_to_insert);die();
                            $get_mics_data = $this->um->get_mics_data(array('misc_type' => 'blood_bank', 'misc_type_id' => $get_user->id));

                            if (!empty($get_mics_data)) {
                                $added = $this->um->update_mics_data($data_to_insert, array('misc_id' => $get_mics_data->misc_id, 'misc_type' => 'blood_bank', 'misc_type_id' => $get_user->id));
                            } else {
                                $added = $this->um->store_mics_data($data_to_insert);
                            }

                            if ($added) {
                                $return['success'] = 'Data has been updated successfully';
                                session_set_userdata(array('next_step' => 'doc_details'));
                            } else {
                                $return['error'] = 'Error occurred.';
                            }
                        } else {
                            $return['error'] = 'Blood Bank data not found to update';
                        }
                    } else {
                        $return['error'] = 'Data error.';
                    }
                } else if ($data_tab == 'doc_details') {
                    $storage_dir = date('Y');
                    if (!empty($blood_bank_id)) {
                        $blood_bank_id = decode_data($blood_bank_id);

                        $get_user = $this->um->get_user(array('id' => $blood_bank_id), '5');

                        if (!empty($get_user)) {
                            if (isset($_FILES['org_constitution_doc']) && $_FILES['org_constitution_doc']['name'] != '') {

                                $file_found = $this->sm->get_file(array('storage_type' => 'org_constitution_doc', 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));

                                if (!empty($file_found)) {
                                    if (file_exists(FCPATH . $file_found->media_disk_path_relative)) {
                                        @unlink(FCPATH . $file_found->media_disk_path_relative);
                                    }

                                    $this->sm->delete_file(array('storage_type' => 'org_constitution_doc', 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));
                                }

                                $org_constitution_doc = array(
                                    'file_size' => '5',
                                    'file_name' => 'org_constitution_doc',
                                    'file_types' => 'png,jpg,jpeg,pdf',
                                    'file_storage_type' => 'org_constitution_doc',
                                    'file_storage_type_name' => 'Constitution Document',
                                    'file_storage_data_type' => $get_user->role_id,
                                    'file_storage_data_type_id' => $get_user->id,
                                    'file_storage_dir' => $storage_dir,
                                    'file_parent_id' => '0',
                                    'file_compress' => false,
                                    'file_operation_type' => 'new',
                                    'file_uploaded_by' => $this->data['userdata']->id
                                );

                                $org_constitution_doc_returned = $this->onUploadFiles($org_constitution_doc);
                            }


                            if (isset($_FILES['org_pan_card']) && $_FILES['org_pan_card']['name'] != '') {

                                $file_found = $this->sm->get_file(array('storage_type' => 'org_pan_card', 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));

                                if (!empty($file_found)) {
                                    if (file_exists(FCPATH . $file_found->media_disk_path_relative)) {
                                        @unlink(FCPATH . $file_found->media_disk_path_relative);
                                    }

                                    $this->sm->delete_file(array('storage_type' => 'org_pan_card', 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));
                                }

                                $org_pan_card = array(
                                    'file_size' => '5',
                                    'file_name' => 'org_pan_card',
                                    'file_types' => 'png,jpg,jpeg,pdf',
                                    'file_storage_type' => 'org_pan_card',
                                    'file_storage_type_name' => 'PAN Card',
                                    'file_storage_data_type' => $get_user->role_id,
                                    'file_storage_data_type_id' => $get_user->id,
                                    'file_storage_dir' => $storage_dir,
                                    'file_parent_id' => '0',
                                    'file_compress' => false,
                                    'file_operation_type' => 'new',
                                    'file_uploaded_by' => $this->data['userdata']->id
                                );

                                $org_pan_card_returned = $this->onUploadFiles($org_pan_card);
                            }


                            if (isset($_FILES['org_12_aa_doc']) && $_FILES['org_12_aa_doc']['name'] != '') {

                                $file_found = $this->sm->get_file(array('storage_type' => 'org_12_aa_doc', 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));

                                if (!empty($file_found)) {
                                    if (file_exists(FCPATH . $file_found->media_disk_path_relative)) {
                                        @unlink(FCPATH . $file_found->media_disk_path_relative);
                                    }

                                    $this->sm->delete_file(array('storage_type' => 'org_12_aa_doc', 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));
                                }

                                $org_12_aa_doc = array(
                                    'file_size' => '5',
                                    'file_name' => 'org_12_aa_doc',
                                    'file_types' => 'png,jpg,jpeg,pdf',
                                    'file_storage_type' => 'org_12_aa_doc',
                                    'file_storage_type_name' => '12 AA Document',
                                    'file_storage_data_type' => $get_user->role_id,
                                    'file_storage_data_type_id' => $get_user->id,
                                    'file_storage_dir' => $storage_dir,
                                    'file_parent_id' => '0',
                                    'file_compress' => false,
                                    'file_operation_type' => 'new',
                                    'file_uploaded_by' => $this->data['userdata']->id
                                );

                                $org_12_aa_doc_returned = $this->onUploadFiles($org_12_aa_doc);
                            }

                            if (isset($_FILES['org_12_ab_doc']) && $_FILES['org_12_ab_doc']['name'] != '') {

                                $file_found = $this->sm->get_file(array('storage_type' => 'org_12_aa_doc', 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));

                                if (!empty($file_found)) {
                                    if (file_exists(FCPATH . $file_found->media_disk_path_relative)) {
                                        @unlink(FCPATH . $file_found->media_disk_path_relative);
                                    }

                                    $this->sm->delete_file(array('storage_type' => 'org_12_aa_doc', 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));
                                }

                                $org_12_ab_doc = array(
                                    'file_size' => '5',
                                    'file_name' => 'org_12_ab_doc',
                                    'file_types' => 'png,jpg,jpeg,pdf',
                                    'file_storage_type' => 'org_12_aa_doc',
                                    'file_storage_type_name' => '12 AB Document',
                                    'file_storage_data_type' => $get_user->role_id,
                                    'file_storage_data_type_id' => $get_user->id,
                                    'file_storage_dir' => $storage_dir,
                                    'file_parent_id' => '0',
                                    'file_compress' => false,
                                    'file_operation_type' => 'new',
                                    'file_uploaded_by' => $this->data['userdata']->id
                                );

                                $org_12_ab_doc_returned = $this->onUploadFiles($org_12_ab_doc);
                            }

                            if (isset($_FILES['org_80_g_doc']) && $_FILES['org_80_g_doc']['name'] != '') {

                                $file_found = $this->sm->get_file(array('storage_type' => 'org_80_g_doc', 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));

                                if (!empty($file_found)) {
                                    if (file_exists(FCPATH . $file_found->media_disk_path_relative)) {
                                        @unlink(FCPATH . $file_found->media_disk_path_relative);
                                    }

                                    $this->sm->delete_file(array('storage_type' => 'org_80_g_doc', 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));
                                }

                                $org_80_g_doc = array(
                                    'file_size' => '5',
                                    'file_name' => 'org_80_g_doc',
                                    'file_types' => 'png,jpg,jpeg,pdf',
                                    'file_storage_type' => 'org_80_g_doc',
                                    'file_storage_type_name' => '80 G Document',
                                    'file_storage_data_type' => $get_user->role_id,
                                    'file_storage_data_type_id' => $get_user->id,
                                    'file_storage_dir' => $storage_dir,
                                    'file_parent_id' => '0',
                                    'file_compress' => false,
                                    'file_operation_type' => 'new',
                                    'file_uploaded_by' => $this->data['userdata']->id
                                );

                                $org_80_g_doc_returned = $this->onUploadFiles($org_80_g_doc);
                            }

                            if (isset($_FILES['org_lic_doc']) && $_FILES['org_lic_doc']['name'] != '') {

                                $file_found = $this->sm->get_file(array('storage_type' => 'org_lic_doc', 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));

                                if (!empty($file_found)) {
                                    if (file_exists(FCPATH . $file_found->media_disk_path_relative)) {
                                        @unlink(FCPATH . $file_found->media_disk_path_relative);
                                    }

                                    $this->sm->delete_file(array('storage_type' => 'org_lic_doc', 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));
                                }

                                $org_lic_doc = array(
                                    'file_size' => '5',
                                    'file_name' => 'org_lic_doc',
                                    'file_types' => 'png,jpg,jpeg,pdf',
                                    'file_storage_type' => 'org_lic_doc',
                                    'file_storage_type_name' => 'Blood Center License',
                                    'file_storage_data_type' => $get_user->role_id,
                                    'file_storage_data_type_id' => $get_user->id,
                                    'file_storage_dir' => $storage_dir,
                                    'file_parent_id' => '0',
                                    'file_compress' => false,
                                    'file_operation_type' => 'new',
                                    'file_uploaded_by' => $this->data['userdata']->id
                                );

                                $org_lic_doc_returned = $this->onUploadFiles($org_lic_doc);
                            }


                            if (isset($_FILES['org_competent_auth_doc']) && $_FILES['org_competent_auth_doc']['name'] != '') {

                                $file_found = $this->sm->get_file(array('storage_type' => 'org_competent_auth_doc', 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));

                                if (!empty($file_found)) {
                                    if (file_exists(FCPATH . $file_found->media_disk_path_relative)) {
                                        @unlink(FCPATH . $file_found->media_disk_path_relative);
                                    }

                                    $this->sm->delete_file(array('storage_type' => 'org_competent_auth_doc', 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));
                                }

                                $org_competent_auth_doc = array(
                                    'file_size' => '5',
                                    'file_name' => 'org_competent_auth_doc',
                                    'file_types' => 'png,jpg,jpeg,pdf',
                                    'file_storage_type' => 'org_80_g_doc',
                                    'file_storage_type_name' => 'Registration with Competent Authority Document',
                                    'file_storage_data_type' => $get_user->role_id,
                                    'file_storage_data_type_id' => $get_user->id,
                                    'file_storage_dir' => $storage_dir,
                                    'file_parent_id' => '0',
                                    'file_compress' => false,
                                    'file_operation_type' => 'new',
                                    'file_uploaded_by' => $this->data['userdata']->id
                                );

                                $org_competent_auth_doc_returned = $this->onUploadFiles($org_competent_auth_doc);
                            }



                            // if(isset($_FILES['org_competent_person_doc']) && $_FILES['org_competent_person_doc']['name']!=''){

                            //     $org_competent_person_doc=$_FILES['org_competent_person_doc'];

                            //     foreach ($org_competent_person_doc as $key => $value) {

                            //       $file_found=$this->sm->get_file(array('storage_type'=>'org_competent_person_doc','storage_data_type'=>'5','storage_data_type_id'=>$blood_bank_id));

                            //         if(!empty($file_found)){
                            //             if(file_exists(FCPATH.$file_found->media_disk_path_relative)){
                            //                 @unlink(FCPATH.$file_found->media_disk_path_relative);
                            //             }

                            //             $this->sm->delete_file(array('storage_id'=>$value,'storage_type'=>'org_competent_person_doc','storage_data_type'=>'5','storage_data_type_id'=>$blood_bank_id));
                            //         }

                            //         $org_competent_person_doc=array(
                            //             'file_size'=>'5',
                            //             'file_name'=>$value,
                            //             'file_types'=>'png,jpg,jpeg,pdf',
                            //             'file_storage_type'=>'org_competent_person_doc',
                            //             'file_storage_type_name'=>'Document Related Change in the Competent person',
                            //             'file_storage_data_type'=>$get_user->role_id,
                            //             'file_storage_data_type_id'=>$get_user->id,
                            //             'file_storage_dir'=>$storage_dir,                                    
                            //             'file_parent_id'=>'0',
                            //             'file_compress'=>false,
                            //             'file_operation_type'=>'new',
                            //             'file_uploaded_by'=>$this->data['userdata']->id
                            //         );

                            //         $org_competent_person_doc_returned=$this->onUploadFiles($org_competent_person_doc);

                            //     }

                            // }


                            $this->session->unset_userdata('next_step');

                            $return['org_constitution_doc_returned'] = (isset($org_constitution_doc_returned) && is_numeric($org_constitution_doc_returned)) ? 'Uploaded' : $org_constitution_doc_returned;
                            $return['org_pan_card_returned'] = (isset($org_pan_card_returned) && is_numeric($org_pan_card_returned)) ? 'Uploaded' : $org_pan_card_returned;
                            $return['org_12_aa_doc_returned'] = (isset($org_12_aa_doc_returned) && is_numeric($org_12_aa_doc_returned)) ? 'Uploaded' : $org_12_aa_doc_returned;
                            $return['org_12_ab_doc_returned'] = (isset($org_12_ab_doc_returned) && is_numeric($org_12_ab_doc_returned)) ? 'Uploaded' : $org_12_ab_doc_returned;
                            $return['org_80_g_doc_returned'] = (isset($org_80_g_doc_returned) && is_numeric($org_80_g_doc_returned)) ? 'Uploaded' : $org_80_g_doc_returned;
                            $return['org_lic_doc_returned'] = (isset($org_lic_doc_returned) && is_numeric($org_lic_doc_returned)) ? 'Uploaded' : $org_lic_doc_returned;
                            $return['org_competent_auth_doc_returned'] = (isset($org_competent_auth_doc_returned) && is_numeric($org_competent_auth_doc_returned)) ? 'Uploaded' : $org_competent_auth_doc_returned;
                            //$return['org_competent_person_doc_returned']=(isset($org_competent_person_doc_returned) && is_numeric($org_competent_auth_doc_returned))?'Uploaded':$org_competent_person_doc_returned;



                            $return['success'] = 'Files are uploaded';
                        } else {
                            $return['error'] = 'Data not found to update';
                        }
                    } else {
                        $return['error'] = 'data can not be tampered';
                    }
                }


                return json_headers($return);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    public function onDeleteBloodBank()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

                $blood_bank_id = post_data('blood_bank_id');

                if (!empty($blood_bank_id)) {
                    $blood_bank_id = decode_data($blood_bank_id);

                    $_get_blood_bank = $this->um->get_user(array('user_id' => $blood_bank_id), '5');

                    //print_obj($_get_blood_bank);die;

                    if (!empty($_get_blood_bank)) {

                        $deleted = $this->um->delete_blood_bank_datas(array('blood_bank_id' => $_get_blood_bank->blood_bank_id));

                        if ($deleted) {
                            $this->um->delete_users(array('id' => $_get_blood_bank->user_id));

                            $get_files = $this->sm->get_files(array('storage_data_type' => '5', 'storage_data_type_id' => $_get_blood_bank->blood_bank_id));

                            if (!empty($get_files)) {
                                foreach ($get_files as $key => $value) {
                                    @unlink(FCPATH . $value->media_disk_path);
                                    $this->sm->delete_file(array('storage_id' => $value->storage_id));
                                }
                            }

                            $return['success'] = 'Data has been deleted successfully';
                        } else {
                            $return['error'] = 'Data has been deleted';
                        }
                    } else {
                        $return['error'] = 'data not found';
                    }
                } else {
                    $return['error'] = 'Data has not been deleted';
                }

                json_headers($return);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }


    public function onDeleteBloodBankFiles()
    {
        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {
            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

                $blood_bank_id = post_data('blood_bank_id');
                $storage_id = post_data('storage_id');

                $blood_bank_id = decode_data($blood_bank_id);
                $storage_id = decode_data($storage_id);

                //echo $storage_id;die;

                $get_file = $this->sm->get_file(array('storage_id' => $storage_id, 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));

                if (!empty($get_file)) {

                    $deleted = $this->sm->delete_file(array('storage_id' => $storage_id, 'storage_data_type' => '5', 'storage_data_type_id' => $blood_bank_id));

                    if ($deleted) {

                        if (file_exists(FCPATH . $get_file->media_disk_path)) {
                            @unlink(FCPATH . $get_file->media_disk_path);
                        }

                        $return['success'] = 'File deleted';
                    } else {
                        $return['error'] = 'File deleted';
                    }
                } else {
                    $return['error'] = 'File not found';
                }

                json_headers($return);
            } else {
                redirect($this->data['base_url']);
            }
        } else {
            redirect($this->data['base_url']);
        }
    }

    function index_user_role()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Superadmin User Role';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_user_role', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function user_role_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Superadmin User Role';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_user_role', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function onSearch_user_role()
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

                $list = $this->dm->_get_role($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $manufecture) {
                    $no++;
                    //print_obj($manufecture);
                    //echo $manufecture;die();
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



                    $row[]  = '<a href="' . $this->data['base_url'] . '/user_role/edit/' . $manufecture->master_id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $manufecture->master_id . ');" ><i class="fa fa-trash"></i></button> ';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_role($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_role($posts, $param, TRUE),
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

    public function user_role_delete()
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


    function indexuser()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Superadmin User';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_user', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function user_add()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Superadmin User Add';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_user_add', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function user_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Superadmin User Edit';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_user_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function onSearch_user()
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

                $list = $this->dm->_get_user($posts, $param, FALSE, FALSE);


                // print_obj($list);die;

                $data = array();
                $no = isset($posts['start']) ? $posts['start'] : 0;

                $action = '';



                foreach ($list as $bank_user) {
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
                    $row[]  =   $bank_user->name;
                    $row[]  =   $bank_user->role;
                    $row[]  =   $bank_user->email;
                    $row[]  =   $bank_user->mobile;

                    $row[]  = '<a href="' . $this->data['base_url'] . '/user/edit/' . $bank_user->id . '" class="btn btn-xs btn-danger btn_edit_data" data-master_id="" data-master_type="" data-master_type_value=""><i class="fa fa-pen"></i></a> <button type="button" class="btn btn-xs btn-dark" onclick="deleteFun(' . $bank_user->id . ');" ><i class="fa fa-trash"></i></button> ';

                    $data[] = $row;
                }

                $output = array(
                    "draw" => isset($posts['draw']) ? $posts['draw'] : '',
                    "recordsTotal" => $this->dm->_get_user($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_user($posts, $param, TRUE),
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

    public function user_delete()
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

    function donation_Appointments()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Appointments';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_donation_appointment', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    // public function download(){
    // $this->load->;
    //     $html = $this->output->get_output();
    //             // Load pdf library
    //     $this->load->library('pdf');
    //     $this->pdf->loadHtml($html);
    //     $this->pdf->setPaper('A4', 'landscape');
    //     $this->pdf->render();
    // $this->dompdf->stream("Donar_form.pdf", array("Attachment"=>0));
    // }


    public function download()
    {
        $this->data['page_title'] = '';
        $this->theme->title($this->data['page_title'])->load('organisations/vw_donation_appointment_pdf', $this->data);
    }

    public function donation_Appointments_delete()
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

    public function donation_forms_old()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Donation Form';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_donation_form', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function donation_forms()
    {
        if (!session_userdata('isAdminLoggedin')) {
            redirect($this->data['base_url']);
        }
    
        $this->load->library('pagination');
    
        $limit = 10; // how many records per page
        $start = $this->uri->segment(3); // current page segment (change if needed)
       
    
        if (empty($start)) {
            $start = 0;
        }
        $where = "1=1"; // default no filter
        if (!empty($_GET)) {
            if (!empty($_GET['name'])) {
                $where .= " AND bl_bb_donatioform.donor_name LIKE '%" . $_GET['name'] . "%'";
            }
             if (!empty($_GET['donation_type'])) {
                $where .= " AND bl_bb_donatioform.camp_status LIKE '%" . $_GET['donation_type'] . "%'";
            }
            if (!empty($_GET['mobile'])) {
                $where .= " AND bl_bb_donatioform.mobile LIKE '%" .$_GET['mobile'] . "%'";
            }
            if (!empty($_GET['donor_type'])) {
                $where .= " AND bl_bb_donatioform.donor_type LIKE '%" .$_GET['donor_type'] . "%'";
            }
            
            if (!empty($_GET['blood_group'])) {
                $where .= " AND bl_bb_donatioform.blood_group LIKE '%" .$_GET['blood_group'] . "%'";
            }
            if (!empty($_GET['unit_no'])) {
                $where .= " AND bl_bb_donatioform.unit_no LIKE '%" .$_GET['user_no'] . "%'";
            }
            
            if (!empty($_GET['application_no'])) {
                $where .= " AND bl_bb_donatioform.application_no LIKE '%" .$_GET['application_no'] . "%'";
            }
            if (!empty($_GET['city'])) {
                $where .= " AND bl_bb_donatioform.city LIKE '%" .$_GET['city'] . "%'";
            }
            if (!empty($_GET['user'])) {
                $where .= " AND bl_bb_donatioform.donation_by LIKE '%" .$_GET['user'] . "%'";
            }
            if (!empty($_GET['blood_bank'])) {
                $where .= " AND bl_blood_banks.name LIKE '%" .$_GET['blood_bank'] . "%'";
            }
            
            if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
                $where .= " AND bl_bb_donatioform.donation_date BETWEEN '" . $_GET['start_date'] . "' AND '" . $_GET['end_date'] . "'";
            }
            // Add more filters if needed
        }
    
        // Total rows count
        $total_rows_query = $this->db->query("
            SELECT COUNT(*) AS total
            FROM bl_bb_donatioform
            INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id
            INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id
            WHERE $where
        ");
        $total_rows = $total_rows_query->row()->total;
    
        // Get limited results
        $query = $this->db->query("
            SELECT bl_bb_donatioform.*, bl_blood_banks.blood_bank_id, bl_donor_examination.examiner_id, bl_bloodbank_user.name as ex_name, bl_users.sign, bl_blood_banks.name, bl_cities.city_name
            FROM bl_bb_donatioform
            LEFT JOIN bl_donor_examination ON bl_bb_donatioform.id = bl_donor_examination.donation_id
            LEFT JOIN bl_users ON bl_donor_examination.auth_id = bl_users.id
            LEFT JOIN bl_bloodbank_user ON bl_donor_examination.examiner_id = bl_bloodbank_user.id
            INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id
            INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id
            WHERE $where
            ORDER BY bl_bb_donatioform.id DESC
            LIMIT $start, $limit
        ");
    
        $this->data['donations'] = $query->result();
        
        // Pagination Config
        $base_url= base_url('admin/donation_forms'); // Change to your controller
        
        
        $current_page = $this->uri->segment(3) ? $this->uri->segment(3) : 0;  // Current page

        $this->data['current_page'] = $current_page;  // Add this to the data array passed to the view
        $this->data['limit'] = 10;
        $this->data['pagination_links'] = $this->pagination($total_rows, $limit,$base_url);
        $this->data['page_title'] = 'Donation Form';
        $this->theme->title($this->data['page_title'])->load('organisations/vw_donation_form', $this->data);
    }



    public function donation_forms_edit()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Edit Donation Form';


            $this->theme->title($this->data['page_title'])->load('organisations/vw_donation_form_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function donation_forms_delete()
    {
        echo 'hiiii';
        die;
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
    //Deferred
    function deferred_donor()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Deferred Donors';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_defferred_donor', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function onSearchdeferred_donor()
    {

        if (session_userdata('isAdminLoggedin') == TRUE && session_userdata('admin_id')) {

            if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
                $param['column_order'] = array(
                    null,
                    'first_name'
                );

                $param['column_search'] = array('first_name', 'mid_name', 'last_name', 'email', 'name', 'ph_no');
                $param['order'] = array('id' => 'ASC');
                $posts = $this->input->post();

                $param['type_key'] = 'blood_groups';

                $list = $this->dm->_get_all_deffer($posts, $param, FALSE, FALSE);


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
                    $row[]  =   $donar->name;
                    $row[]  =   $donar->blood_bank_id;
                    $row[]  =   $donar->city_name;
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
                    "recordsTotal" => $this->dm->_get_all_deffer($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_all_deffer($posts, $param, TRUE),
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



    public function deferred_donor_delete()
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

    //TTI Test
    function ttitest()
    {
        $data['query_params'] = $_GET;
        $limit = 15;

        $discard_type = $_GET['discard_type'] ?? '';
        $name = $_GET['name'] ?? '';
        $user = $_GET['user'] ?? '';
        $status = $_GET['status'] ?? '';
        $test_result = $_GET['test_result'] ?? '';
        $unit_no = $_GET['unit_no'] ?? '';
        $blood_bank = $_GET['blood_bank'] ?? '';
        $blood_group = $_GET['blood_group'] ?? '';
        $donation_type = $_GET['donation_type'] ?? '';
        $start_date = $_GET['start_date'] ?? '';
        $end_date = $_GET['end_date'] ?? '';
        if (!empty($name) || !empty($status) || !empty($test_result) || !empty($unit_no) || !empty($blood_bank) || !empty($blood_group) || !empty($donation_type) || !empty($city) || (!empty($start_date) || !empty($end_date))) {
            if (!empty($name) && !empty($status) && !empty($test_result) && !empty($unit_no) && !empty($blood_bank) && !empty($blood_group) && !empty($donation_type) && !empty($city) && (!empty($start_date) && !empty($end_date))) {

                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $query_count = $this->db->query("SELECT COUNT(*) as total  FROM bl_bb_donatioform INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id INNER 
                JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id WHERE donation_date BETWEEN '$start_date' AND '$end_date' And bl_bb_donatioform.donor_name = '$name' 
                And bl_bb_donatioform.unit_no = '$unit_no' And bl_bb_donatioform.status = '$status' And bl_blood_banks.name = '$blood_bank' And
                bl_bb_donatioform.blood_group = '$blood_group' And bl_bb_donatioform.camp_status = '$donation_type' And (bl_bb_donatioform.hiv = 'test_result' 
                OR bl_bb_donatioform.hbsag = 'test_result'OR bl_bb_donatioform.hcv = 'test_result'OR bl_bb_donatioform.vdrl = 'test_result'OR 
                bl_bb_donatioform.malaria = 'test_result'OR bl_bb_donatioform.anti_hbc = 'test_result'");

                $total_rows = $query_count->row()->total;
                $query = $this->db->query("SELECT bl_donor_examination.examiner_id,bl_bloodbank_user.name as ex_name,bl_users.sign,bl_users.sign,bl_bb_donatioform.* ,bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name 
                FROM bl_bb_donatioform 
                LEFT JOIN bl_donor_examination ON bl_bb_donatioform.id = bl_donor_examination.donation_id  
                     LEFT JOIN bl_users ON bl_donor_examination.auth_id = bl_users.id 
                     LEFT JOIN bl_bloodbank_user ON bl_donor_examination.examiner_id = bl_bloodbank_user.id
                INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id INNER 
                JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id WHERE donation_date BETWEEN '$start_date' AND '$end_date' And bl_bb_donatioform.donor_name = '$name' 
                And bl_bb_donatioform.unit_no = '$unit_no' And bl_bb_donatioform.status = '$status' And bl_blood_banks.name = '$blood_bank' And
                bl_bb_donatioform.blood_group = '$blood_group' And bl_bb_donatioform.camp_status = '$donation_type' And (bl_bb_donatioform.hiv = 'test_result' 
                OR bl_bb_donatioform.hbsag = 'test_result'OR bl_bb_donatioform.hcv = 'test_result'OR bl_bb_donatioform.vdrl = 'test_result'OR 
                bl_bb_donatioform.malaria = 'test_result'OR bl_bb_donatioform.anti_hbc = 'test_result'ORDER BY ID DESC LIMIT " . (($page - 1) * $limit) . ", $limit");
                $data['page'] = $page;
                $data['query'] = $query;
                $data['total_rows'] = $total_rows;
            } else {

                if (!empty($name)) {
                    $search = "bl_bb_donatioform.donor_name = '$name'";
                } elseif (!empty($unit_no)) {
                    $search = "bl_bb_donatioform.unit_no = '$unit_no'";
                } elseif (!empty($status)) {
                    $search = "bl_bb_donatioform.status = '$status'";
                } elseif (!empty($blood_group)) {
                    $search = "bl_bb_donatioform.blood_group = '$blood_group'";
                } elseif (!empty($donation_type)) {
                    $search = "bl_bb_donatioform.camp_status = '$donation_type'";
                } elseif (!empty($blood_bank)) {
                    $search = "bl_blood_banks.name = '$blood_bank'";
                } elseif (!empty($test_result)) {
                    $search = "bl_bb_donatioform.hiv = 'test_result' OR bl_bb_donatioform.hbsag = 'test_result'OR bl_bb_donatioform.hcv = 'test_result'OR bl_bb_donatioform.vdrl = 'test_result'OR bl_bb_donatioform.malaria = 'test_result'OR bl_bb_donatioform.anti_hbc = 'test_result'";
                } elseif (!empty($start_date) && !empty($end_date)) {
                    $search = "donation_date BETWEEN '$start_date' AND '$end_date'";
                }
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $query_count = $this->db->query("SELECT COUNT(*) as total FROM bl_bb_donatioform INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id INNER JOIN bl_cities 
                ON bl_cities.id = bl_blood_banks.city_id WHERE $search");

                $total_rows = $query_count->row()->total;
                $query = $this->db->query("SELECT bl_donor_examination.examiner_id,bl_bloodbank_user.name as ex_name,bl_users.sign,bl_users.sign,bl_bb_donatioform.* ,bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name FROM bl_bb_donatioform 
               LEFT JOIN bl_donor_examination ON bl_bb_donatioform.id = bl_donor_examination.donation_id  
                     LEFT JOIN bl_users ON bl_donor_examination.auth_id = bl_users.id 
                     LEFT JOIN bl_bloodbank_user ON bl_donor_examination.examiner_id = bl_bloodbank_user.id
               INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id 
               WHERE $search ORDER BY ID DESC LIMIT " . (($page - 1) * $limit) . ", $limit");
                $data['page'] = $page;
                $data['query'] = $query;
                $data['total_rows'] = $total_rows;
            }
        } else {

            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            // Calculate total rows
            $query_count = $this->db->query("SELECT COUNT(*) as total FROM bl_bb_donatioform INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id 
            INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id");
            $total_rows = $query_count->row()->total;

            $query = $this->db->query("SELECT bl_donor_examination.examiner_id,bl_bloodbank_user.name as ex_name,bl_users.sign,bl_users.sign,bl_bb_donatioform.* ,bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name 
            FROM bl_bb_donatioform INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id 
            LEFT JOIN bl_donor_examination ON bl_bb_donatioform.id = bl_donor_examination.donation_id  
                     LEFT JOIN bl_users ON bl_donor_examination.auth_id = bl_users.id 
                     LEFT JOIN bl_bloodbank_user ON bl_donor_examination.examiner_id = bl_bloodbank_user.id
            INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id ORDER BY ID DESC LIMIT " . (($page - 1) * $limit) . ", $limit");
            $data['page'] = $page;
            $data['query'] = $query;
            $data['total_rows'] = $total_rows;
        }
        if (session_userdata('isAdminLoggedin')) {
            $data['limit'] = $limit;

            $data['page_title'] = 'TTI Test';

            $this->theme->title($data['page_title'])->load('organisations/vw_tti_test', $data);
        } else {

            redirect($this->data['base_url']);
        }
    }


    public function tti_test_delete()
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

    //Inventory Components Entry
    function componentsold()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Components Entry';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_components', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function components()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'Components Entry';
    
            // Collect search filters from POST or default to empty
            $filters = [
                'bl_bb_donatioform.name' => $this->input->get('name'),
                'bl_bb_donatioform.blood_group' => $this->input->get('blood_group'),
                'bl_bb_donatioform.storge_type' => $this->input->get('storage_type'),
                'bl_bb_donatioform.unit_no' => $this->input->get('unit_no'),
                'bl_bb_donatioform.start_date' => $this->input->get('start_date'),
                'bl_bb_donatioform.end_date' => $this->input->get('end_date'),
                'bl_bb_donatioform.component' => $this->input->get('component'),
                'bl_bb_donatioform.user' => $this->input->get('user'),
                'bl_blood_banks.name' => $this->input->get('blood_bank')
            ];
    
            // Pagination settings
            $limit = 10; // how many records per page
            $start = $this->uri->segment(3); // current page segment (change if needed)
           
        
            if (empty($start)) {
                $start = 0;
            }
    
            // Building the query based on the search filters
            $query = $this->db->from('bl_bb_donatioform')
                ->join('bl_blood_banks', 'bl_blood_banks.blood_bank_id = bl_bb_donatioform.bloodbank_id')
                ->join('bl_cities', 'bl_cities.id = bl_blood_banks.city_id')
                ->where('bl_bb_donatioform.status', 'Test Done');
    
            // Apply filters
            foreach ($filters as $key => $value) {
                if (!empty($value)) {
                    if ($key == 'start_date' && !empty($filters['end_date'])) {
                        $query->where('donation_date BETWEEN', "{$filters['start_date']} AND {$filters['end_date']}");
                    } else {
                        $query->where("$key", $value);
                    }
                }
            }
    
            // Paginate the result
            $query->limit($limit,$start);
            $results = $query->get()->result();
    
            // Get total records count for pagination
            $totalResults = $this->db->count_all_results('bl_bb_donatioform');
            $base_url = base_url('admin/components');
            $this->data['pagination'] = $this->pagination($totalResults, $limit,$base_url);
    
            $this->data['componentsdata'] = $results;
            $current_page = $this->uri->segment(3) ? $this->uri->segment(3) : 0;  // Current page

            $this->data['current_page'] = $current_page;  // Add this to the data array passed to the view
            $this->data['limit'] = 10;
    
            // Load the view
            $this->theme->title($this->data['page_title'])->load('organisations/vw_components', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    private function pagination($totalRows, $perPage,$base_url)
    {
        $this->load->library('pagination');
        $config['base_url'] = $base_url;
        $config['total_rows'] = $totalRows;
        $config['per_page'] = $perPage;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        
        // Number of links around current page
        $config['num_links'] = 2; // (2 left + 2 right = total 5 numbers showing)
        
        // Show First and Last link
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next &raquo;';
        $config['prev_link'] = '&laquo; Prev';
        
        // Now adjust tags for DataTables style:
        $config['full_tag_open'] = '<div class="dataTables_paginate paging_simple_numbers"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div>';
        
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="paginate_button page-item">';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="paginate_button page-item">';
        $config['last_tag_close'] = '</li>';
        
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="paginate_button page-item next">';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['num_tag_open'] = '<li class="paginate_button page-item">';
        $config['num_tag_close'] = '</li>';
        
        $config['attributes'] = array('class' => 'page-link'); // <a> class
        
        // Initialize
        $this->pagination->initialize($config);

    
        return $this->pagination->create_links();
    }

    public function components_delete()
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
    function bloodstock()
    {

        if (session_userdata('isAdminLoggedin')) {
            $bank_id =$this->input->get('blood_bank');
            $query = $this->db->get('bl_blood_banks', 1); // Limit to 1 row
            
            $query12 = $query->row_array();
            if($bank_id == ''){
                $bank_id = $query12['blood_bank_id'];
            }
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
                    $this->db->where('bloodbank_id', $bank_id);
                    
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
            $this->data['bank_id']=$bank_id;
            $this->data['bank_component'] = $array_com;
            $this->data['wp_component'] = $wp_data;
            $this->data['page_title'] = 'Blood Stock';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_bloodstock', $this->data);
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

                $list = $this->dm->_get_allbloodstock($posts, $param, FALSE, FALSE);


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
                    "recordsTotal" => $this->dm->_get_allbloodstock($posts, $param, TRUE),
                    "recordsFiltered" => $this->dm->_get_allbloodstock($posts, $param, TRUE),
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
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_blood_donation_requests WHERE id = '$id'");
        // echo $dataDelete; die;
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }
    //Deferred
    function discard()
    {

        if (session_userdata('isAdminLoggedin')) {
            

            $this->data['page_title'] = 'Discard Donor';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_discard', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    public function discard_delete()
    {
        
        $id = $this->input->post('id');
        $dataDelete = $this->db->query("DELETE FROM bl_blood_donation_requests WHERE id = '$id'");
        if ($dataDelete == true) {

            echo "1";
        } else {
            echo "2";
        }
    }
    public function Request_appointments_pdf_download()
    {
        $this->data['page_title'] = '';
        $this->theme->title($this->data['page_title'])->load('organisations/vw_request_appointments_pdf', $this->data);
    }

    public function Request_appointments()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Request for Blood Appointment';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_request_appointments', $this->data);
        } else {
            redirect(base_url('admin'));
        }
    }

    public function Request_appointments_checkin()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Request Checkin';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_request_appointments_checkin', $this->data);
        } else {
            redirect(base_url('admin'));
        }
    }

    public function Request_appointments_delete()
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
            // Pagination settings
            $limit = 10; // how many records per page
            $start = $this->uri->segment(3); // current page segment (change if needed)
           
        
            if (empty($start)) {
                $start = 0;
            }
            
            $search_conditions = [];
    
            if (!empty($_GET['blood_group'])) {
                $search_conditions[] = "bl_requestblood.blood_group = '".$this->db->escape_str($_GET['blood_group'])."'";
            }
            if (!empty($_GET['type'])) {
                $search_conditions[] = "bl_requestblood.request_type = '".$this->db->escape_str($_GET['type'])."'";
            }
            if (!empty($_GET['user'])) {
                $search_conditions[] = "bl_requestblood.request_by = '".$this->db->escape_str($_GET['user'])."'";
            }
            if (!empty($_GET['blood_bank'])) {
                $search_conditions[] = "bl_blood_banks.name = '".$this->db->escape_str($_GET['blood_bank'])."'";
            }
            if (!empty($_GET['hospital'])) {
                $search_conditions[] = "bl_requestblood.hospital = '".$this->db->escape_str($_GET['hospital'])."'";
            }
            if (!empty($_GET['name'])) {
                $search_conditions[] = "bl_requestblood.p_name = '".$this->db->escape_str($_GET['name'])."'";
            }
            if (!empty($_GET['request_no'])) {
                $search_conditions[] = "bl_requestblood.request = '".$this->db->escape_str($_GET['request_no'])."'";
            }
            if (!empty($_GET['mobile'])) {
                $search_conditions[] = "bl_requestblood.mobile = '".$this->db->escape_str($_GET['mobile'])."'";
            }
            if (!empty($_GET['status'])) {
                $search_conditions[] = "bl_requestblood.status = '".$this->db->escape_str($_GET['status'])."'";
            }
            if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
                $search_conditions[] = "required_date BETWEEN '".$this->db->escape_str($_GET['start_date'])."' AND '".$this->db->escape_str($_GET['end_date'])."'";
            }
    
            $where = '';
            if (!empty($search_conditions)) {
                $where = 'WHERE ' . implode(' AND ', $search_conditions);
            }
    
            $query = $this->db->query("SELECT bl_requestblood.*, bl_blood_banks.name, bl_blood_banks.blood_bank_id, bl_cities.city_name 
                FROM bl_requestblood
                INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_requestblood.bloodbank_id
                INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id
                $where
                ORDER BY bl_requestblood.id DESC LIMIT $start, $limit");
                
            $this->data['blood_requests_data'] = $query->result();
            // Total rows count
           
            $total_rows_query= $this->db->query("SELECT COUNT(*) AS total
                FROM bl_requestblood
                INNER JOIN bl_blood_banks ON bl_blood_banks.blood_bank_id = bl_requestblood.bloodbank_id
                INNER JOIN bl_cities ON bl_cities.id = bl_blood_banks.city_id
                $where");
            $totalResults = $total_rows_query->row()->total;
            
            $base_url = base_url('admin/request_form');
            $this->data['pagination_links'] = $this->pagination($totalResults, $limit,$base_url);
            $current_page = $this->uri->segment(3) ? $this->uri->segment(3) : 0;  // Current page

            $this->data['current_page'] = $current_page;  // Add this to the data array passed to the view
            $this->data['limit'] = 10;
            $this->theme->title($this->data['page_title'])->load('organisations/vw_request_form', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }


    //Blood Request Form Edit
    function request_form_edit()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Request Form Edit';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_request_form_edit', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    public function request_form_delete()
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

    //Cross Match Form
    function cross_match()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Cross Match';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_cross_match', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    //Issue Blood Form
    function issue_blood()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Issue Blood';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_issue_blood', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function issue_blood_download()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = '';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_issue_card', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    //Blood Return
    function blood_return()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Return';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_return_blood', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function master_records()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = '';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_master_records', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function donor_records()
    {

        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Donor Records';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_donor_records', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function crossmatch_records()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Cross Match Record';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_crossmatch_records', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function blood_records()
    {


        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Record';

            $this->theme->title($this->data['page_title'])->load('organisations/vw_blood_records', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function a_pos_donor()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'A+ Registered Donors ';
            $this->theme->title($this->data['page_title'])->load('organisations/vw_a_pos_donor', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function b_pos_donor()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'B+ Registered Donors ';
            $this->theme->title($this->data['page_title'])->load('organisations/vw_b_pos_donor', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function a_neg_donor()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'A- Registered Donors ';
            $this->theme->title($this->data['page_title'])->load('organisations/vw_a_neg_donor', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function b_neg_donor()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'B- Registered Donors ';
            $this->theme->title($this->data['page_title'])->load('organisations/vw_b_neg_donor', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }

    function ab_neg_donor()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'AB- Registered Donors ';
            $this->theme->title($this->data['page_title'])->load('organisations/vw_ab_neg_donor', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }

    function ab_pos_donor()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'AB+ Registered Donors ';
            $this->theme->title($this->data['page_title'])->load('organisations/vw_ab_pos_donor', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function o_neg_donor()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'O- Registered Donors ';
            $this->theme->title($this->data['page_title'])->load('organisations/vw_o_neg_donor', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    function o_pos_donor()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'O+ Registered Donors ';
            $this->theme->title($this->data['page_title'])->load('organisations/vw_o_pos_donor', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
}
