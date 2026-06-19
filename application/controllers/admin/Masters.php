<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masters  extends BaseAdminController
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
    }
    
    function custompagination($totalRows, $offset, $limit, $page_url, $current_page) {
    $total_pages = ceil($totalRows / $limit);
    $pagination_links = '<ul class="pagination">';

    // Previous link
    if ($current_page > 1) {
        $prev_page = $current_page - 1;
        $pagination_links .= "<li><a href='{$page_url}{$prev_page}'>Previous</a></li>";
    } else {
        $pagination_links .= "<li class='disabled'><span>Previous</span></li>";
    }

    // Calculate the range of page numbers to display
    $max_links = 5; // Number of links to display
    $start_page = max(1, $current_page - floor($max_links / 2));
    $end_page = min($total_pages, $start_page + $max_links - 1);

    // Adjust start page if we are at the end of the page range
    if ($end_page - $start_page < $max_links - 1) {
        $start_page = max(1, $end_page - $max_links + 1);
    }

    // Page number links
    for ($i = $start_page; $i <= $end_page; $i++) {
        $active_class = ($i == $current_page) ? 'class="active"' : '';
        $pagination_links .= "<li $active_class><a href='{$page_url}{$i}'>{$i}</a></li>";
    }

    // Next link
    if ($current_page < $total_pages) {
        $next_page = $current_page + 1;
        $pagination_links .= "<li><a href='{$page_url}{$next_page}'>Next</a></li>";
    } else {
        $pagination_links .= "<li class='disabled'><span>Next</span></li>";
    }

    $pagination_links .= '</ul>';
    
    return $pagination_links;
}

    function indexmaster_records()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->load->library('pagination');
            $bank_id = $_SESSION['bank_id'];
            $limit = 5; // Number of records per page
            $filters = [
                'start_date' => $this->input->get('start_date'),
                'end_date' => $this->input->get('end_date'),
                'start_id' => $this->input->get('start_id'),
                'end_id' => $this->input->get('end_id'),
                'unit_from' => $this->input->get('unit_from'),
                'unit_to' => $this->input->get('unit_to'),
                'name' => $this->input->get('name'),
            ];
            $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
            $totalRows = $this->dr->getDonationDetailstotal($bank_id, $filters);
            // Generate custom pagination
            $offset = ($page - 1) * $limit;
            $base_url = base_url() . 'admin/donations/master_records';
            $query_string = http_build_query($filters);
            $page_url = $base_url . '?' . $query_string . '&page=';
            $current_page = ($offset > 0) ? ($offset / $limit) + 1 : 1;
            $pagination_links = $this->custompagination($totalRows,$offset,$limit,$page_url,$current_page);
            $offset = ($current_page - 1) * $limit;
            
            
            $component = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id= '$bank_id'")->row();
            $ids = explode(',', $component->components_available);
            $array_com = array();
            foreach ($ids as $v) {
                $query = $this->db->query("SELECT * FROM bl_masters WHERE master_id  = '$v'");
                foreach ($query->result() as $components) {
                    $array_com[] = $components;
                }
            }
            $customOrder = [22, 20, 21, 19];
            // Sort function based on custom order
            usort($array_com, function($a, $b) use ($customOrder) {
                $indexA = array_search($a->master_id, $customOrder);
                $indexB = array_search($b->master_id, $customOrder);
            
                if ($indexA === false) $indexA = PHP_INT_MAX; // If not found, move to the end
                if ($indexB === false) $indexB = PHP_INT_MAX;
            
                return $indexA - $indexB;
            });

            // echo "<pre>";print_r($array_com);exit();
            $donations = $this->dr->getDonationDetails($limit, $offset, $bank_id, $filters);
            $this->data['page_title'] = 'Master Record';
            $this->data['master_record'] = $donations;
            $this->data['com_po'] = $array_com;
            $this->data['filter_data'] = $filters;
            $this->data['pagination'] = $pagination_links; // Custom pagination links
            $this->theme->title($this->data['page_title'])->load('master/vw_masterrecord', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }

    function indexdonor_records()
    {
        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Donor Record';
            $bank_id = $_SESSION['bank_id'];
            $limit = 5; // Number of records per page
            $filters = [
                'start_date' => $this->input->get('start_date'),
                'end_date' => $this->input->get('end_date'),
                'start_id' => $this->input->get('start_id'),
                'end_id' => $this->input->get('end_id'),
                'name' => $this->input->get('name'),
            ];
            $totalRows = $this->dr->getDonorrecordtotal($bank_id,$filters);
            
            // Generate custom pagination
            $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
            $offset = ($page - 1) * $limit;
            $base_url = base_url() . 'admin/donations/donor_records';
            $query_string = http_build_query($filters);
            $page_url = $base_url . '?' . $query_string . '&page=';
            $current_page = ($offset > 0) ? ($offset / $limit) + 1 : 1;
            $pagination_links = $this->custompagination($totalRows,$offset,$limit,$page_url,$current_page);
            $offset = ($current_page - 1) * $limit;
            // -----------------------------

            $donations = $this->dr->getDonorrecord($limit, $offset, $bank_id,$filters);
            $this->data['master_record'] = $donations;
            $this->data['pagination'] = $pagination_links;

            $this->theme->title($this->data['page_title'])->load('master/vw_donorrecord', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function index_request_records()
    {
        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Request Record';
            $bank_id = $_SESSION['bank_id'];
            $limit = 18; // Number of records per page
            $filters = [
                'start_date' => $this->input->get('start_date'),
                'end_date' => $this->input->get('end_date'),
                'start_id' => $this->input->get('start_id'),
                'end_id' => $this->input->get('end_id'),
                'name' => $this->input->get('name'),
            ];
            $totalRows = $this->dr->getreq_recordtotal($bank_id,$filters);
            
            // Generate custom pagination
            $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
            $offset = ($page - 1) * $limit;
            $base_url = base_url() . 'admin/donations/master_request';
            $query_string = http_build_query($filters);
            $page_url = $base_url . '?' . $query_string . '&page=';
            $current_page = ($offset > 0) ? ($offset / $limit) + 1 : 1;
            $pagination_links = $this->custompagination($totalRows,$offset,$limit,$page_url,$current_page);
            $offset = ($current_page - 1) * $limit;
            // -----------------------------
           
            $donations = $this->dr->getreq_record($limit, $offset, $bank_id,$filters);
            $this->data['master_record'] = $donations;
            $this->data['pagination'] = $pagination_links;

            $this->theme->title($this->data['page_title'])->load('master/vw_request_record', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function master_discard_register()
    {
        // echo $this->input->post('start_date'),;exit();
        if (session_userdata('isAdminLoggedin')) {
            $this->load->library('pagination');
            $bank_id = $_SESSION['bank_id'];
            $limit = 15; // Number of records per page
            $filters = [
                'start_date' => $this->input->get('start_date'),
                'end_date' => $this->input->get('end_date'),
                'start_id' => $this->input->get('start_id'),
                'end_id' => $this->input->get('end_id'),
                'reason' => $this->input->get('reason'),
                'auto_clave' => $this->input->get('auto_clave'),
            ];
           
            $totalRows = $this->dr->get_discard_rec_total($bank_id,$filters);
            // Generate custom pagination
            $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
            $offset = ($page - 1) * $limit;
            $base_url = base_url() . 'admin/donations/master_discard_register';
            $query_string = http_build_query($filters);
            $page_url = $base_url . '?' . $query_string . '&page=';
            $current_page = ($offset > 0) ? ($offset / $limit) + 1 : 1;
            $pagination_links = $this->custompagination($totalRows,$offset,$limit,$page_url,$current_page);
            $offset = ($current_page - 1) * $limit;
            // -----------------------------
            $donations = $this->dr->get_discard_rec($limit, $offset, $bank_id,$filters);
            $this->data['page_title'] = 'Discard Register';
            $this->data['master_record'] = $donations;
            
            $this->data['pagination'] = $pagination_links; // Pagination links
            $this->theme->title($this->data['page_title'])->load('master/vw_discard_reg', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function master_issue_register()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->load->library('pagination');
            $bank_id = $_SESSION['bank_id'];
            $limit = 13; // Number of records per page
            $filters = [
                'start_date' => $this->input->get('start_date'),
                'end_date' => $this->input->get('end_date'),
                'start_id' => $this->input->get('start_id'),
                'end_id' => $this->input->get('end_id'),
                // 'name' => $this->input->get('name'),
                // 'auto_clave' => $this->input->get('auto_clave'),
            ];
            $totalRows = $this->dr->get_issue_record_total($bank_id,$filters);

            // Generate custom pagination
            $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
            $offset = ($page - 1) * $limit;
            $base_url = base_url() . 'admin/donations/master_issue_register';
            $query_string = http_build_query($filters);
            $page_url = $base_url . '?' . $query_string . '&page=';
            $current_page = ($offset > 0) ? ($offset / $limit) + 1 : 1;
            $pagination_links = $this->custompagination($totalRows,$offset,$limit,$page_url,$current_page);
            $offset = ($current_page - 1) * $limit;
            // -----------------------------
            $donations = $this->dr->get_issue_record($limit, $offset, $bank_id,$filters);
            $this->data['page_title'] = 'Issue Register';
            $this->data['master_record'] = $donations;
            $this->data['pagination'] = $pagination_links;
            $this->theme->title($this->data['page_title'])->load('master/vw_issue_reg', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function master_component_register($offset = 0)
    {
        // echo $this->input->post('start_date'),;exit();
        if (session_userdata('isAdminLoggedin')) {
            $this->load->library('pagination');
            $bank_id = $_SESSION['bank_id'];
            $limit = 5; // Number of records per page
            $filters = [
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
            ];
            $totalRows = $this->dr->get_comp_record_total($bank_id);

            $configs['base_url'] = base_url() . 'admin/donations/master_component_register';
            $configs['total_rows'] = $totalRows;
            $configs['per_page'] = $limit;
            $configs['use_page_numbers'] = TRUE;
            $configs['full_tag_open'] = '<ul class="pagination">';
            $configs['full_tag_close'] = '</ul>';
            $configs['first_link'] = 'First';
            $configs['last_link'] = 'Last';
            $configs['next_link'] = 'Next';
            $configs['prev_link'] = 'Previous';
            $configs['first_tag_open'] = '<li>';
            $configs['first_tag_close'] = '</li>';
            $configs['prev_tag_open'] = '<li>';
            $configs['prev_tag_close'] = '</li>';
            $configs['next_tag_open'] = '<li>';
            $configs['next_tag_close'] = '</li>';
            $configs['last_tag_open'] = '<li>';
            $configs['last_tag_close'] = '</li>';
            $configs['cur_tag_open'] = '<li class="active"><a href="#">';
            $configs['cur_tag_close'] = '</a></li>';
            $configs['num_tag_open'] = '<li>';
            $configs['num_tag_close'] = '</li>';
            $this->pagination->initialize($configs);
            $offset = ($offset > 0) ? ($offset - 1) * $limit : 0;
            $component = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id= '$bank_id'")->row();
            $ids = explode(',', $component->components_available);
            $array_com = array();
            foreach ($ids as $v) {
                $query = $this->db->query("SELECT * FROM bl_masters WHERE master_id  = '$v'");
                foreach ($query->result() as $components) {
                    $array_com[] = $components;
                }
            }
            $donations = $this->dr->get_comp_record($limit, $offset, $bank_id);
            $this->data['page_title'] = 'Component Register';
            $this->data['master_record'] = $donations;
            $this->data['com_po'] = $array_com;
            $this->data['pagination'] = $this->pagination->create_links(); // Pagination links
            $this->theme->title($this->data['page_title'])->load('master/vw_component_reg', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function master_return_register($offset = 0)
    {
        // echo $this->input->post('start_date'),;exit();
        if (session_userdata('isAdminLoggedin')) {
            $this->load->library('pagination');
            $bank_id = $_SESSION['bank_id'];
            $limit = 14; // Number of records per page
            $filters = [
                'start_date' => $this->input->get('start_date'),
                'end_date' => $this->input->get('end_date'),
                'start_id' => $this->input->get('start_id'),
                'end_id' => $this->input->get('end_id'),
                'res' => $this->input->get('res'),
                'req_no' => $this->input->get('req_no'),
            ];
            $totalRows = $this->dr->get_return_record_total($bank_id,$filters);
            // Generate custom pagination
            $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
            $offset = ($page - 1) * $limit;
            $base_url = base_url() . 'admin/donations/master_return_register';
            $query_string = http_build_query($filters);
            $page_url = $base_url . '?' . $query_string . '&page=';
            $current_page = ($offset > 0) ? ($offset / $limit) + 1 : 1;
            $pagination_links = $this->custompagination($totalRows,$offset,$limit,$page_url,$current_page);
            $offset = ($current_page - 1) * $limit;
            // -----------------------------
            $donations = $this->dr->get_return_record($limit, $offset, $bank_id,$filters);
            $this->data['page_title'] = 'Return Register';
            $this->data['master_record'] = $donations;
            $this->data['pagination'] = $pagination_links;
            $this->theme->title($this->data['page_title'])->load('master/vw_rtn_reg', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function master_qcc_register($offset = 0)
    {
        // echo $this->input->post('start_date'),;exit();
        if (session_userdata('isAdminLoggedin')) {
            $this->load->library('pagination');
            $bank_id = $_SESSION['bank_id'];
            $limit = 12; // Number of records per page
            $totalRows = $this->dr->get_qcr_record_total($bank_id);

            $configs['base_url'] = base_url() . 'admin/donations/master_qcc_register';
            $configs['total_rows'] = $totalRows;
            $configs['per_page'] = $limit;
            $configs['use_page_numbers'] = TRUE;
            $configs['full_tag_open'] = '<ul class="pagination">';
            $configs['full_tag_close'] = '</ul>';
            $configs['first_link'] = 'First';
            $configs['last_link'] = 'Last';
            $configs['next_link'] = 'Next';
            $configs['prev_link'] = 'Previous';
            $configs['first_tag_open'] = '<li>';
            $configs['first_tag_close'] = '</li>';
            $configs['prev_tag_open'] = '<li>';
            $configs['prev_tag_close'] = '</li>';
            $configs['next_tag_open'] = '<li>';
            $configs['next_tag_close'] = '</li>';
            $configs['last_tag_open'] = '<li>';
            $configs['last_tag_close'] = '</li>';
            $configs['cur_tag_open'] = '<li class="active"><a href="#">';
            $configs['cur_tag_close'] = '</a></li>';
            $configs['num_tag_open'] = '<li>';
            $configs['num_tag_close'] = '</li>';
            $this->pagination->initialize($configs);
            $offset = ($offset > 0) ? ($offset - 1) * $limit : 0;
            $donations = $this->dr->get_qcr_record($limit, $offset, $bank_id);
            $this->data['page_title'] = 'Quality Control Register for Bovins Albumin / Anti Sera';
            $this->data['master_record'] = $donations;
            $this->data['pagination'] = $this->pagination->create_links(); // Pagination links
            $this->theme->title($this->data['page_title'])->load('master/vw_qcc', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function master_tti_register()
    {
        // echo $this->input->post('start_date'),;exit();
        if (session_userdata('isAdminLoggedin')) {
            $this->load->library('pagination');
            $bank_id = $_SESSION['bank_id'];
            $limit = 30; // Number of records per page
            $filters = [
                'start_date' => $this->input->get('start_date'),
                'end_date' => $this->input->get('end_date'),
                'start_id' => $this->input->get('start_id'),
                'end_id' => $this->input->get('end_id'),
            ];
            $totalRows = $this->dr->get_tti_record_total($bank_id,$filters);
            // Generate custom pagination
            $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
            $offset = ($page - 1) * $limit;
            $base_url = base_url() . 'admin/donations/master_tti_register';
            $query_string = http_build_query($filters);
            $page_url = $base_url . '?' . $query_string . '&page=';
            $current_page = ($offset > 0) ? ($offset / $limit) + 1 : 1;
            $pagination_links = $this->custompagination($totalRows,$offset,$limit,$page_url,$current_page);
            $offset = ($current_page - 1) * $limit;
            // -----------------------------
            $donations = $this->dr->get_tti_record($limit, $offset, $bank_id,$filters);
            $this->data['page_title'] = 'Transfusion Transmissble Disease Register';
            $this->data['master_record'] = $donations;
            $this->data['pagination'] = $pagination_links;
            $this->theme->title($this->data['page_title'])->load('master/vw_tti_reg', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function master_rec_blood_bag($offset = 0)
    {
        // echo $this->input->post('start_date'),;exit();
        if (session_userdata('isAdminLoggedin')) {
            $this->load->library('pagination');
            $bank_id = $_SESSION['bank_id'];
            $limit = 15;
            $totalRows = $this->dr->get_reg_dia_reag_total($bank_id);

            $configs['base_url'] = base_url() . 'admin/donations/master_rec_blood_bag';
            $configs['total_rows'] = $totalRows;
            $configs['per_page'] = $limit;
            $configs['use_page_numbers'] = TRUE;
            $configs['full_tag_open'] = '<ul class="pagination">';
            $configs['full_tag_close'] = '</ul>';
            $configs['first_link'] = 'First';
            $configs['last_link'] = 'Last';
            $configs['next_link'] = 'Next';
            $configs['prev_link'] = 'Previous';
            $configs['first_tag_open'] = '<li>';
            $configs['first_tag_close'] = '</li>';
            $configs['prev_tag_open'] = '<li>';
            $configs['prev_tag_close'] = '</li>';
            $configs['next_tag_open'] = '<li>';
            $configs['next_tag_close'] = '</li>';
            $configs['last_tag_open'] = '<li>';
            $configs['last_tag_close'] = '</li>';
            $configs['cur_tag_open'] = '<li class="active"><a href="#">';
            $configs['cur_tag_close'] = '</a></li>';
            $configs['num_tag_open'] = '<li>';
            $configs['num_tag_close'] = '</li>';
            $this->pagination->initialize($configs);
            $donations = $this->dr->get_reg_dia_reag($limit, $offset, $bank_id);
            $this->data['page_title'] = 'Record for Blood Bags';
            $this->data['master_record'] = $donations;
            $this->data['pagination'] = $this->pagination->create_links(); // Pagination links
            $this->theme->title($this->data['page_title'])->load('master/vw_rec_bb', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function master_rec_consumble($offset = 0)
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->load->library('pagination');
            $bank_id = $_SESSION['bank_id'];
            $limit = 14;
            $totalRows = $this->dr->get_consumble_record_total($bank_id);

            $configs['base_url'] = base_url() . 'admin/donations/master_rec_consumble';
            $configs['total_rows'] = $totalRows;
            $configs['per_page'] = $limit;
            $configs['use_page_numbers'] = TRUE;
            $configs['full_tag_open'] = '<ul class="pagination">';
            $configs['full_tag_close'] = '</ul>';
            $configs['first_link'] = 'First';
            $configs['last_link'] = 'Last';
            $configs['next_link'] = 'Next';
            $configs['prev_link'] = 'Previous';
            $configs['first_tag_open'] = '<li>';
            $configs['first_tag_close'] = '</li>';
            $configs['prev_tag_open'] = '<li>';
            $configs['prev_tag_close'] = '</li>';
            $configs['next_tag_open'] = '<li>';
            $configs['next_tag_close'] = '</li>';
            $configs['last_tag_open'] = '<li>';
            $configs['last_tag_close'] = '</li>';
            $configs['cur_tag_open'] = '<li class="active"><a href="#">';
            $configs['cur_tag_close'] = '</a></li>';
            $configs['num_tag_open'] = '<li>';
            $configs['num_tag_close'] = '</li>';
            $this->pagination->initialize($configs);
            $offset = ($offset > 0) ? ($offset - 1) * $limit : 0;
            $donations = $this->dr->get_consumble_record($limit, $offset, $bank_id);
            $this->data['page_title'] = 'Record for Consumable Items';
            $this->data['master_record'] = $donations;
            $this->data['pagination'] = $this->pagination->create_links(); // Pagination links
            $this->theme->title($this->data['page_title'])->load('master/vw_rec_consumble', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function master_reg_dia_reag($offset = 0)
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->load->library('pagination');
            $bank_id = $_SESSION['bank_id'];
            $limit = 14;
            $totalRows = $this->dr->get_reg_dia_reag_total($bank_id);

            $configs['base_url'] = base_url() . 'admin/donations/master_reg_dia_reag';
            $configs['total_rows'] = $totalRows;
            $configs['per_page'] = $limit;
            $configs['use_page_numbers'] = TRUE;
            $configs['full_tag_open'] = '<ul class="pagination">';
            $configs['full_tag_close'] = '</ul>';
            $configs['first_link'] = 'First';
            $configs['last_link'] = 'Last';
            $configs['next_link'] = 'Next';
            $configs['prev_link'] = 'Previous';
            $configs['first_tag_open'] = '<li>';
            $configs['first_tag_close'] = '</li>';
            $configs['prev_tag_open'] = '<li>';
            $configs['prev_tag_close'] = '</li>';
            $configs['next_tag_open'] = '<li>';
            $configs['next_tag_close'] = '</li>';
            $configs['last_tag_open'] = '<li>';
            $configs['last_tag_close'] = '</li>';
            $configs['cur_tag_open'] = '<li class="active"><a href="#">';
            $configs['cur_tag_close'] = '</a></li>';
            $configs['num_tag_open'] = '<li>';
            $configs['num_tag_close'] = '</li>';
            $this->pagination->initialize($configs);
            $offset = ($offset > 0) ? ($offset - 1) * $limit : 0;

            $donations = $this->dr->get_reg_dia_reag($limit, $offset, $bank_id);
            $this->data['page_title'] = 'Register for Diagnostic Kits & Reagents Used';
            $this->data['master_record'] = $donations;
            $this->data['pagination'] = $this->pagination->create_links(); // Pagination links
            $this->theme->title($this->data['page_title'])->load('master/vw_reg_dia_reag', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
    function master_rec_blood_group($offset = 0)
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->load->library('pagination');
            $bank_id = $_SESSION['bank_id'];
            $limit = 12; // Number of records per page
            $totalRows = $this->dr->get_bb_rec_total($bank_id);
            $configs['base_url'] = base_url() . 'admin/donations/master_rec_blood_group';
            $configs['total_rows'] = $totalRows;
            $configs['per_page'] = $limit;
            $configs['use_page_numbers'] = TRUE;
            $configs['full_tag_open'] = '<ul class="pagination">';
            $configs['full_tag_close'] = '</ul>';
            $configs['first_link'] = 'First';
            $configs['last_link'] = 'Last';
            $configs['next_link'] = 'Next';
            $configs['prev_link'] = 'Previous';
            $configs['first_tag_open'] = '<li>';
            $configs['first_tag_close'] = '</li>';
            $configs['prev_tag_open'] = '<li>';
            $configs['prev_tag_close'] = '</li>';
            $configs['next_tag_open'] = '<li>';
            $configs['next_tag_close'] = '</li>';
            $configs['last_tag_open'] = '<li>';
            $configs['last_tag_close'] = '</li>';
            $configs['cur_tag_open'] = '<li class="active"><a href="#">';
            $configs['cur_tag_close'] = '</a></li>';
            $configs['num_tag_open'] = '<li>';
            $configs['num_tag_close'] = '</li>';
            $this->pagination->initialize($configs);
            $offset = ($offset > 0) ? ($offset - 1) * $limit : 0;
            $donations = $this->dr->get_bb_rec($limit, $offset, $bank_id);
            $this->data['page_title'] = 'Blood Grouping Record';
            $this->data['master_record'] = $donations;
            $this->data['pagination'] = $this->pagination->create_links(); // Pagination links
            $this->theme->title($this->data['page_title'])->load('master/vw_rec_blood_group', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

    // blood grouping module
    function index_blood_grouping()
    {
        if (session_userdata('isAdminLoggedin')) {
            $this->data['page_title'] = 'Blood Grouping';
            $this->theme->title($this->data['page_title'])->load('master/vw_inv_bloodgrouping', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    function add_blood_grouping()
    {
        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Add Blood Gruop';

            $this->theme->title($this->data['page_title'])->load('master/vw_bb_add', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }
}
