<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminMasters  extends BaseAdminController
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
            $limit = 25; // Number of records per page
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
            $totalRows = $this->adr->getDonationDetailstotal($filters);
            // Generate custom pagination
            $offset = ($page - 1) * $limit;
            $base_url = base_url() . 'admin/donations/admin_master_records';
            $query_string = http_build_query($filters);
            $page_url = $base_url . '?' . $query_string . '&page=';
            $current_page = ($offset > 0) ? ($offset / $limit) + 1 : 1;
            $pagination_links = $this->custompagination($totalRows,$offset,$limit,$page_url,$current_page);
            $offset = ($current_page - 1) * $limit;
            
          

            
            $donations = $this->adr->getDonationDetails($limit, $offset, $filters);
            // echo "<pre>";print_r($donations[0]);exit();
            $this->data['page_title'] = 'Master Record';
            $this->data['master_record'] = $donations;
            $this->data['filter_data'] = $filters;
            $this->data['pagination'] = $pagination_links; // Custom pagination links
            $this->theme->title($this->data['page_title'])->load('master/admin/vw_masterrecord', $this->data);
        } else {
            redirect($this->data['base_url']);
        }
    }
    function indexdonor_records()
    {
        if (session_userdata('isAdminLoggedin')) {

            $this->data['page_title'] = 'Blood Donor Record';
            
            $limit = 25; // Number of records per page
            $filters = [
                'start_date' => $this->input->get('start_date'),
                'end_date' => $this->input->get('end_date'),
                'start_id' => $this->input->get('start_id'),
                'end_id' => $this->input->get('end_id'),
                'name' => $this->input->get('name'),
            ];
            $totalRows = $this->adr->getDonorrecordtotal($filters);
            
            // Generate custom pagination
            $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
            $offset = ($page - 1) * $limit;
            $base_url = base_url() . 'admin/donations/admin_donor_records';
            $query_string = http_build_query($filters);
            $page_url = $base_url . '?' . $query_string . '&page=';
            $current_page = ($offset > 0) ? ($offset / $limit) + 1 : 1;
            $pagination_links = $this->custompagination($totalRows,$offset,$limit,$page_url,$current_page);
            $offset = ($current_page - 1) * $limit;
            // -----------------------------

            $donations = $this->adr->getDonorrecord($limit, $offset,$filters);
            $this->data['master_record'] = $donations;
            $this->data['pagination'] = $pagination_links;

            $this->theme->title($this->data['page_title'])->load('master/admin/vw_donorrecord', $this->data);
        } else {

            redirect($this->data['base_url']);
        }
    }

  
   
}
