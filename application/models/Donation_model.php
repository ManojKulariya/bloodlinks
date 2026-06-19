<?php defined('BASEPATH') or exit('No direct script access allowed');


/**
 * 
 */
class Donation_model extends BaseModel
{
    public function get_all_bmw(){
         $this->db->select('bl_bmw_users.*');
         $query = $this->db->get('bl_bmw_users');
         return $query->result_array();
    }
    public function _get_hpuser($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {

       
        $this->db->select('bl_hospital_user.*,bl_users.sign');
        $this->db->join('bl_users', 'bl_users.id = bl_hospital_user.user_id');
        $this->db->where('bl_hospital_user.hospital_id', $param['bank_id']);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_hospital_user');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_hospital_user');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }
    public function _get_user_role_hp($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {

        $type = 'user_role';
        $this->db->select('bl_bloodbank_master.*');
        $this->db->where('bl_bloodbank_master.master_type_key', $type);
        $this->db->where('bl_bloodbank_master.hospital_id', $param['bank_id']);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bloodbank_master');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bloodbank_master');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function get_assigned_bmw($user_id = null)
    {
        $this->db->select('bmw.*');
        $this->db->from('user_bmw_assignments uba');
        $this->db->join('bl_bmw_users bmw', 'bmw.id = uba.bmw_id', 'left');
    
        if (!empty($user_id)) {
            $this->db->where('uba.user_id', $user_id);
        }
    
        $query = $this->db->get();
        return $query->result();
    }

    public function _get_user_bmw($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {
        $this->db->select('bl_bmw_users.*');
        $i = 0;

       

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bmw_users');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bmw_users');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }
    public function store_donar_form_data($data, $return_query = FALSE)
    {
        $this->table = 'donar_form_info';
        // print_r($data);die();
        return $this->store($data, FALSE, $return_query);
    }

    public function update_donar_form_data($data, $param, $batch = FALSE, $return_query = FALSE)
    {
        $this->table = 'donar_form_info';
        return $this->modify($data, $param, $batch, $return_query);
    }
    public function deleteData($id)
    {
        $query = $this->db->delete($tablename, $where);
        // $this->db->query($query);
        return $query;
    }
    public function delete_donar_form_data($param, $return_query = FALSE)
    {
        $this->table = 'donar_form_info';
        return $this->remove($param, 0, $return_query);
    }

    public function get_donar_form_data($param = NULL, $single_row = TRUE, $return_query = FALSE)
    {
        $this->table = 'donar_form_info';
        if ($single_row == TRUE) {
            return $this->get_one($param, '', $return_query);
        } else if ($single_row == FALSE) {
            return $this->get_many($param, null, null, $return_query);
        }
    }

    public function _get_appointments($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {


        // $this->db->select("*");
        // $this->db->from("bl_customers");
        // $query = $this->db->get();
        // return $query->result_array();
        $this->db->select('bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.email,bl_customers.ph_no');
        $this->db->join('bl_customers', 'bl_customers.user_id=bl_blood_donation_requests.user_id', 'INNER');

        $this->db->where('bl_blood_donation_requests.org_id', $_SESSION['bank_id']);
        // echo $this->db->last_query();
        // $this->db->select('bl_customers');

        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('blood_donation_requests');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('blood_donation_requests');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_donationform($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {


        $this->db->select('bl_bb_donatioform.*');
        $this->db->where('bl_bb_donatioform.bloodbank_id', $_SESSION['bank_id']);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bb_donatioform');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bb_donatioform');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_bankuser($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {

       
        $this->db->select('bl_bloodbank_user.*,bl_users.sign');
        $this->db->join('bl_users', 'bl_users.id = bl_bloodbank_user.user_id');
        $this->db->where('bl_bloodbank_user.bloodbank_id', $_SESSION['bank_id']);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bloodbank_user');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bloodbank_user');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_user($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {
        $_id = '0';
        $this->db->select('bl_bloodbank_user.*');
        $this->db->where('bl_bloodbank_user.bloodbank_id', $_id);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bloodbank_user');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bloodbank_user');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_crossmatch_list($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {
        $request = $this->input->post('req_no2');
        $status = 'crossmatch';

        $this->db->select('bl_crossmatch.*');
        $this->db->where('bl_crossmatch.bloodbank_id', $_SESSION['bank_id']);
        $this->db->where('bl_crossmatch.status', $status);
        $this->db->where('bl_crossmatch.request', $request);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_crossmatch');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_crossmatch');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_crossmatch($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {
        $status = 'crossmatch';


        $this->db->select('bl_crossmatch.*');
        $this->db->where('bl_crossmatch.bloodbank_id', $_SESSION['bank_id']);
        $this->db->where('bl_crossmatch.status', $status);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_crossmatch');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_crossmatch');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }


    public function _get_issueblood($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {
        $status = 'issued';

        $this->db->select('bl_crossmatch.*');
        $this->db->where('bl_crossmatch.bloodbank_id', $_SESSION['bank_id']);
        $this->db->where('bl_crossmatch.status', $status);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_crossmatch');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_crossmatch');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }
    public function _get_bloodreturn($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {
        $status = 'return';

        $this->db->select('bl_crossmatch.*');
        $this->db->where('bl_crossmatch.bloodbank_id', $_SESSION['bank_id']);
        $this->db->where('bl_crossmatch.status', $status);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_crossmatch');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_crossmatch');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }
    public function _get_bloodrecord($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {


        $this->db->select('bl_blood_record.*');
        $this->db->where('bl_blood_record.bloodbank_id', $_SESSION['bank_id']);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_blood_record');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_blood_record');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_consumable($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {

        $this->db->select('bl_consumable.*');
        $this->db->where('bl_consumable.bloodbank_id', $_SESSION['bank_id']);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_consumable');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_consumable');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }
    public function _get_manufecture($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {

        $type = 'manufacture';

        $this->db->select('bl_bloodbank_master.*');
        $this->db->where('bl_bloodbank_master.master_type_key', $type);
        $this->db->where('bl_bloodbank_master.bloodbank_id', $_SESSION['bank_id']);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bloodbank_master');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bloodbank_master');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_consumables_item($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {

        $type = 'consumables_item';

        $this->db->select('bl_bloodbank_master.*');
        $this->db->where('bl_bloodbank_master.master_type_key', $type);
        $this->db->where('bl_bloodbank_master.bloodbank_id', $_SESSION['bank_id']);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bloodbank_master');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bloodbank_master');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }


    public function _get_user_role($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {

        $type = 'user_role';
        $this->db->select('bl_bloodbank_master.*');
        $this->db->where('bl_bloodbank_master.master_type_key', $type);
        $this->db->where('bl_bloodbank_master.bloodbank_id', $_SESSION['bank_id']);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bloodbank_master');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bloodbank_master');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }


    public function _get_role($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {

        $type = 'user_role';
        $id = '0';

        $this->db->select('bl_bloodbank_master.*');
        $this->db->where('bl_bloodbank_master.master_type_key', $type);
        $this->db->where('bl_bloodbank_master.bloodbank_id', $id);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bloodbank_master');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bloodbank_master');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }
    public function _get_consumable_type($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {

        $type = 'consumables_type';

        $this->db->select('bl_bloodbank_master.*');
        $this->db->where('bl_bloodbank_master.master_type_key', $type);
        $this->db->where('bl_bloodbank_master.bloodbank_id', $_SESSION['bank_id']);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bloodbank_master');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bloodbank_master');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }
    public function _get_consumable_recivecondition($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {

        $type = 'consumable_receive_condition';
        $this->db->select('bl_bloodbank_master.*');
        $this->db->where('bl_bloodbank_master.master_type_key', $type);
        $this->db->where('bl_bloodbank_master.bloodbank_id', $_SESSION['bank_id']);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bloodbank_master');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bloodbank_master');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }


    public function _get_components($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {
        $Done = 'Test Done';


        $this->db->select('bl_bb_donatioform.*');
        $this->db->where('bl_bb_donatioform.status', $Done);
        $this->db->where('bl_bb_donatioform.bloodbank_id', $_SESSION['bank_id']);


        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bb_donatioform');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bb_donatioform');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_discard($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {
        $Done = 2;
        $this->db->select('bl_discard.*,bl_bb_donatioform.unit_no as dunitno,bl_blood_record.component as com_p,bl_crossmatch.component as comp,
        bl_blood_record.unit_no as unit_no,bl_crossmatch.unit_no as unitno,bl_blood_record.blood_group as b_g,bl_crossmatch.groups as bg,bl_bb_donatioform.blood_group as blood_group');
        $this->db->where('bl_discard.bloodbank_id', $_SESSION['bank_id']);
        $this->db->join('bl_crossmatch','bl_crossmatch.id = bl_discard.type_id AND bl_discard.type = "3"', 'left'); 
        $this->db->join('bl_blood_record', 'bl_blood_record.id = bl_discard.type_id AND bl_discard.type = "2"', 'left'); 
        $this->db->join('bl_bb_donatioform', 'bl_bb_donatioform.id = bl_discard.type_id AND bl_discard.type = "1"', 'left'); 
        $i = 0;


        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_discard');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_discard');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }
    public function _get_discard_com($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {
        $Done = 'discard';


        $this->db->select('bl_blood_record.* , bl_masters.master_type_key_short_value as component');
        $this->db->where('bl_blood_record.status', 'discard');
        $this->db->join('bl_masters', 'bl_masters.master_id = bl_blood_record.component', 'left');
        $this->db->where('bl_masters.master_type_name', 'Components Types');
        $this->db->where('bl_blood_record.bloodbank_id', $_SESSION['bank_id']);
        $this->db->order_by('bl_blood_record.id', 'desc');
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('bl_blood_record.storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('bl_blood_record.storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_blood_record');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_blood_record');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }


    public function _get_discard_tti($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {
        $Done = 'discard';


        $this->db->where('bl_bb_donatioform.status', 'discard');

        $this->db->where('bl_bb_donatioform.bloodbank_id', $_SESSION['bank_id']);
        $this->db->order_by('bl_bb_donatioform.id', 'desc');
        // $query = $this->db->get('bl_bb_donatioform');
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('bl_bb_donatioform.storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('bl_bb_donatioform.storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bb_donatioform');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bb_donatioform');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_bloodcamp($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {


        // $this->db->select("*");
        // $this->db->from("bl_customers");
        // $query = $this->db->get();
        // return $query->result_array();
        //$this->db->select('bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.email,bl_customers.ph_no');
        //$this->db->join('bl_customers','bl_customers.user_id=bl_blood_donation_requests.user_id','INNER');


        // echo $this->db->last_query();

        $this->db->select('bl_bloodcamp.*');
        $this->db->where('bl_bloodcamp.bloodbank_id', $_SESSION['bank_id']);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bloodcamp');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bloodcamp');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_blood_appointment($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {


        // $this->db->select("*");
        // $this->db->from("bl_customers");
        // $query = $this->db->get();
        // return $query->result_array();
        //$this->db->select('bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.email,bl_customers.ph_no');
        //$this->db->join('bl_customers','bl_customers.user_id=bl_blood_donation_requests.user_id','INNER');


        // echo $this->db->last_query();

        $this->db->select('bl_blood_request.*');
        $this->db->where('bl_blood_request.org_id', $_SESSION['bank_id']);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_blood_request');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_blood_request');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_request_form($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {


        // $this->db->select("*");
        // $this->db->from("bl_customers");
        // $query = $this->db->get();
        // return $query->result_array();
        //$this->db->select('bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.email,bl_customers.ph_no');
        //$this->db->join('bl_customers','bl_customers.user_id=bl_blood_donation_requests.user_id','INNER');


        // echo $this->db->last_query();

        $this->db->select('bl_requestblood.*');
        $this->db->where('bl_requestblood.bloodbank_id', $_SESSION['bank_id']);
        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_requestblood');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_requestblood');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }
    public function _get_bloodstock($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {


        // $this->db->select("*");
        // $this->db->from("bl_customers");
        // $query = $this->db->get();
        // return $query->result_array();
        $this->db->select('bl_masters.*,bl_bloodstock.id,bl_bloodstock.ave,bl_bloodstock.ane,bl_bloodstock.abve,bl_bloodstock.abne,bl_bloodstock.bve,bl_bloodstock.bne,bl_bloodstock.ove,bl_bloodstock.one');
        $this->db->join('bl_bloodstock', 'bl_bloodstock.component_id=bl_masters.master_id', 'INNER');

        //$this->db->where('bl_masters.master_type_key','component_types');
        // echo $this->db->last_query();
        // $this->db->select('bl_bb_donatioform.*');

        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_masters');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_masters');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_allbloodstock($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {


        // $this->db->select("*");
        // $this->db->from("bl_customers");
        // $query = $this->db->get();
        // return $query->result_array();
        $this->db->select('bl_masters.*,bl_bloodstock.id,bl_bloodstock.ave,bl_bloodstock.ane,bl_bloodstock.abve,bl_bloodstock.abne,bl_bloodstock.bve,bl_bloodstock.bne,bl_bloodstock.ove,bl_bloodstock.one');
        $this->db->join('bl_bloodstock', 'bl_bloodstock.component_id=bl_masters.master_id', 'INNER');

        //$this->db->where('bl_masters.master_type_key','component_types');
        // echo $this->db->last_query();
        // $this->db->select('bl_bb_donatioform.*');

        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_masters');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_masters');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }
    public function _get_request_deffer($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {

        $defer = 'Reject';
        // $this->db->select("*");
        // $this->db->from("bl_customers");
        // $query = $this->db->get();
        // return $query->result_array();
        $this->db->select('bl_blood_request.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.blood_group,bl_customers.ph_no');
        $this->db->join('bl_customers', 'bl_customers.user_id=bl_blood_request.user_id', 'INNER');

        $this->db->where('bl_blood_request.org_id', $_SESSION['bank_id']);
        $this->db->where('bl_blood_request.approved_status ', $defer);
        // echo $this->db->last_query();
        // $this->db->select('bl_customers');

        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_blood_request');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_blood_request');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_deffer($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {

        $defer = 'Defer';
        // $this->db->select("*");
        // $this->db->from("bl_customers");
        // $query = $this->db->get();
        // return $query->result_array();
        $this->db->select('bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.blood_group,bl_customers.ph_no');
        $this->db->join('bl_customers', 'bl_customers.user_id=bl_blood_donation_requests.user_id', 'INNER');

        $this->db->where('bl_blood_donation_requests.org_id', $_SESSION['bank_id']);
        $this->db->where('bl_blood_donation_requests.donation_status ', $defer);
        // echo $this->db->last_query();
        // $this->db->select('bl_customers');

        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('blood_donation_requests');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('blood_donation_requests');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_all_deffer($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {

        $defer = 'Defer';
        // $this->db->select("*");
        // $this->db->from("bl_customers");
        // $query = $this->db->get();
        // return $query->result_array();
        $this->db->select('bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.blood_group,bl_customers.ph_no ,bl_blood_banks.name , bl_blood_banks.blood_bank_id , bl_cities.city_name');
        $this->db->join('bl_customers', 'bl_customers.user_id=bl_blood_donation_requests.user_id', 'INNER');
        $this->db->join('bl_blood_banks', 'bl_blood_banks.blood_bank_id=bl_blood_donation_requests.org_id', 'INNER');
        $this->db->join('bl_cities', 'bl_cities.id=bl_blood_banks.city_id', 'INNER');

        $this->db->where('bl_blood_donation_requests.donation_status ', $defer);
        // echo $this->db->last_query();
        // $this->db->select('bl_customers');

        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_blood_donation_requests');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_blood_donation_requests');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }


    public function _get_donor($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {


        // $this->db->select("*");
        // $this->db->from("bl_customers");
        // $query = $this->db->get();
        // return $query->result_array();
        $this->db->select('bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.email,bl_customers.ph_no');
        $this->db->join('bl_customers', 'bl_customers.user_id=bl_blood_donation_requests.user_id', 'INNER');

        //$this->db->where('bl_blood_donation_requests.org_id',$_SESSION['bank_id']);
        // echo $this->db->last_query();
        // $this->db->select('bl_customers');

        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('blood_donation_requests');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('blood_donation_requests');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }

    public function _get_petientsrequest($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {


        // $this->db->select("*");
        // $this->db->from("bl_customers");
        // $query = $this->db->get();
        // return $query->result_array();
        //$this->db->select('bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.email,bl_customers.ph_no');
        //$this->db->join('bl_customers','bl_customers.user_id=bl_blood_donation_requests.user_id','INNER');
        $this->db->select('bl_blood_request.*');
        //$this->db->where('bl_blood_donation_requests.org_id',$_SESSION['bank_id']);
        // echo $this->db->last_query();
        // $this->db->select('bl_customers');

        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_blood_request');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_blood_request');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }
    public function _get_allcamp($post = array(), $param = array(), $count = FALSE, $return_query = FALSE)
    {


        // $this->db->select("*");
        // $this->db->from("bl_customers");
        // $query = $this->db->get();
        // return $query->result_array();
        //$this->db->select('bl_blood_donation_requests.*,bl_customers.first_name,bl_customers.mid_name,bl_customers.last_name,bl_customers.email,bl_customers.ph_no');
        //$this->db->join('bl_customers','bl_customers.user_id=bl_blood_donation_requests.user_id','INNER');
        $this->db->select('bl_bloodcamp.*');
        //$this->db->where('bl_blood_donation_requests.org_id',$_SESSION['bank_id']);
        // echo $this->db->last_query();
        // $this->db->select('bl_customers');

        $i = 0;

        if (isset($param['data_id'])) {
            $this->db->where('storage_data_type_id', $param['data_id']);
        }

        if (isset($param['storage_data_type'])) {
            $this->db->where('storage_data_type', $param['storage_data_type']);
        }

        if (isset($param['column_search'])) {
            foreach ($param['column_search'] as $item) {
                if (isset($post['search']['value']) && $post['search']['value']) {

                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    } else {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if (count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }

                $i++;
            }
        }


        if (isset($post['order'])) {
            $column_order = $param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } else if (isset($param['order'])) {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($count == FALSE) {
            if (isset($post['length']) && $post['length'] != -1) {
                $this->db->limit($post['length'], $post['start']);
            }

            $query = $this->db->get('bl_bloodcamp');

            if ($return_query == FALSE) {
                return $query->result();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        } else if ($count == TRUE) {
            $query = $this->db->get('bl_bloodcamp');
            if ($return_query == FALSE) {
                return $query->num_rows();
            } else if ($return_query == TRUE) {
                return $this->db->last_query();
            }
        }
    }
    public function get_differs($param = NULL, $single_row = TRUE, $return_query = FALSE)
    {
        $this->table = 'defers';
        if ($single_row == TRUE) {
            return $this->get_one($param, '', $return_query);
        } else if ($single_row == FALSE) {
            return $this->get_many($param, null, null, $return_query);
        }
    }


    public function get_medicines($param = NULL, $single_row = TRUE, $return_query = FALSE)
    {
        $this->table = 'medicine';
        if ($single_row == TRUE) {
            return $this->get_one($param, '', $return_query);
        } else if ($single_row == FALSE) {
            return $this->get_many($param, null, null, $return_query);
        }
    }

    public function get_vaccines($param = NULL, $single_row = TRUE, $return_query = FALSE)
    {
        $this->table = 'vaccination';
        if ($single_row == TRUE) {
            return $this->get_one($param, '', $return_query);
        } else if ($single_row == FALSE) {
            return $this->get_many($param, null, null, $return_query);
        }
    }

    public function get_concents_data($param = NULL, $single_row = TRUE, $return_query = FALSE)
    {
        $this->table = 'concents';
        if ($single_row == TRUE) {
            return $this->get_one($param, '', $return_query);
        } else if ($single_row == FALSE) {
            return $this->get_many($param, null, null, $return_query);
        }
    }


    public function get_blood_donation_defers_data($param = NULL, $single_row = TRUE, $return_query = FALSE)
    {
        $this->table = 'blood_donation_defers';
        if ($single_row == TRUE) {
            return $this->get_one($param, '', $return_query);
        } else if ($single_row == FALSE) {
            return $this->get_many($param, null, null, $return_query);
        }
    }

    public function store_blood_donation_defers_data($data, $return_query = FALSE)
    {
        $this->table = 'blood_donation_defers';
        return $this->store($data, FALSE, $return_query);
    }

    public function update_blood_donation_defers_data($data, $param, $batch = FALSE, $return_query = FALSE)
    {
        $this->table = 'blood_donation_defers';
        return $this->modify($data, $param, $batch, $return_query);
    }

    public function delete_blood_donation_defers_data($param, $return_query = FALSE)
    {
        $this->table = 'blood_donation_defers';
        return $this->remove($param, 0, $return_query);
    }		public function get_donation_requests($request='')
    {		return $request;
    }
}
