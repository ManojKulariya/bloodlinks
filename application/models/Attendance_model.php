<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendance_model extends CI_Model
{
    public function getTegentWhereLike($field, $search)
    {
        $query = $this->db->like($field, $search)->orderBy('id')->get('attendance');
        return $query->result();
    }
}