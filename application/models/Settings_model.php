<?php defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Settings_model extends BaseModel
{

    public function get_states($param=NULL,$single_row=TRUE,$return_query=FALSE){
        $this->table='states';
        if($single_row==TRUE){
            return $this->get_one($param,'',$return_query);
        }else if($single_row==FALSE){
            return $this->get_many($param,null,null,$return_query);
        }       
    }

 public function _get_states($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){
        $this->db->select('states.*');

        $i = 0;

        if(isset($param['data_id'])){
            $this->db->where('storage_data_type_id',$param['data_id']);
        }

        if(isset($param['storage_data_type'])){
            $this->db->where('storage_data_type',$param['storage_data_type']);
        }

        if(isset($param['column_search'])){
            foreach ($param['column_search'] as $item)
            {
                if(isset($post['search']['value']) && $post['search']['value'])
                {
                    
                    if($i===0)
                    {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if(count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }
                
                $i++;
            }
        }

            
        if(isset($post['order']))
        {
            $column_order=$param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } 
        else if(isset($param['order']))
        {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if($count==FALSE){
            if(isset($post['length']) && $post['length'] != -1){
                $this->db->limit($post['length'],$post['start']);   
            }
            
            $query = $this->db->get('states');

            if($return_query==FALSE){
                return $query->result();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }       
            
        }else if($count==TRUE){
            $query = $this->db->get('states');
            if($return_query==FALSE){
                return $query->num_rows();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }           
        }
    }

    public function _get_googleapi($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){
        $this->db->select('googleapi.*');

        $i = 0;

        if(isset($param['data_id'])){
            $this->db->where('storage_data_type_id',$param['data_id']);
        }

        if(isset($param['storage_data_type'])){
            $this->db->where('storage_data_type',$param['storage_data_type']);
        }

        if(isset($param['column_search'])){
            foreach ($param['column_search'] as $item)
            {
                if(isset($post['search']['value']) && $post['search']['value'])
                {
                    
                    if($i===0)
                    {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if(count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }
                
                $i++;
            }
        }

            
        if(isset($post['order']))
        {
            $column_order=$param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } 
        else if(isset($param['order']))
        {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if($count==FALSE){
            if(isset($post['length']) && $post['length'] != -1){
                $this->db->limit($post['length'],$post['start']);   
            }
            
            $query = $this->db->get('googleapi');

            if($return_query==FALSE){
                return $query->result();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }       
            
        }else if($count==TRUE){
            $query = $this->db->get('googleapi');
            if($return_query==FALSE){
                return $query->num_rows();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }           
        }
    }


    public function get_districts($param=NULL,$single_row=TRUE,$return_query=FALSE){
        $this->table='districts';
        if($single_row==TRUE){
            return $this->get_one($param,'',$return_query);
        }else if($single_row==FALSE){
            return $this->get_many($param,null,null,$return_query);
        }       
    }



    public function _get_districts($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){
        $this->db->select('districts.*,state_name');
        $this->db->join('states','states.id=districts.state_id','LEFT');

        $i = 0;

        // if(isset($param['data_id'])){
        //     $this->db->where('storage_data_type_id',$param['data_id']);
        // }

        // if(isset($param['storage_data_type'])){
        //     $this->db->where('storage_data_type',$param['storage_data_type']);
        // }

        if(isset($param['column_search'])){
            foreach ($param['column_search'] as $item)
            {
                if(isset($post['search']['value']) && $post['search']['value'])
                {
                    
                    if($i===0)
                    {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if(count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }
                
                $i++;
            }
        }

            
        if(isset($post['order']))
        {
            $column_order=$param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } 
        else if(isset($param['order']))
        {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if($count==FALSE){
            if(isset($post['length']) && $post['length'] != -1){
                $this->db->limit($post['length'],$post['start']);   
            }
            
            $query = $this->db->get('districts');

            if($return_query==FALSE){
                return $query->result();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }       
            
        }else if($count==TRUE){
            $query = $this->db->get('districts');
            if($return_query==FALSE){
                return $query->num_rows();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }           
        }
    }







    //Cities
    public function store_cities($data,$return_query=FALSE){
        $this->table='cities';
        return $this->store($data,FALSE,$return_query);
    }

    public function get_cities($param=NULL,$single_row=TRUE,$return_query=FALSE){
        $this->table='cities';
        if($single_row==TRUE){
            return $this->get_one($param,'',$return_query);
        }else if($single_row==FALSE){
            return $this->get_many($param,null,null,$return_query);
        }       
    }

    public function _get_cities($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){
        $this->db->select('cities.*,states.state_name,districts.district_name');
        $this->db->join('districts','districts.id=cities.district_id','LEFT');
        $this->db->join('states','states.id=cities.state_id','LEFT');

        $i = 0;

        // if(isset($param['data_id'])){
        //     $this->db->where('storage_data_type_id',$param['data_id']);
        // }

        // if(isset($param['storage_data_type'])){
        //     $this->db->where('storage_data_type',$param['storage_data_type']);
        // }

        if(isset($param['column_search'])){
            foreach ($param['column_search'] as $item)
            {
                if(isset($post['search']['value']) && $post['search']['value'])
                {
                    
                    if($i===0)
                    {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if(count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }
                
                $i++;
            }
        }

            
        if(isset($post['order']))
        {
            $column_order=$param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } 
        else if(isset($param['order']))
        {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if($count==FALSE){
            if(isset($post['length']) && $post['length'] != -1){
                $this->db->limit($post['length'],$post['start']);   
            }
            
            $query = $this->db->get('cities');

            if($return_query==FALSE){
                return $query->result();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }       
            
        }else if($count==TRUE){
            $query = $this->db->get('cities');
            if($return_query==FALSE){
                return $query->num_rows();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }           
        }
    }


    public function get_categories($param=NULL,$single_row=TRUE,$return_query=FALSE){
        $this->table='categories';
        if($single_row==TRUE){
            return $this->get_one($param,'',$return_query);
        }else if($single_row==FALSE){
            return $this->get_many($param,null,null,$return_query);
        }       
    }

    //Storage
    public function store_file($data,$return_query=FALSE){
        $this->table='storage';
        return $this->store($data,FALSE,$return_query);
    }

    public function delete_file($param,$return_query=FALSE){
        $this->table='storage';
        return $this->remove($param,0,$return_query);
    }

    public function update_file($data,$param,$return_query=FALSE){
        $this->table='storage';
        return $this->modify($data,$param,FALSE,$return_query);
    }

    public function get_file($param=null,$return_query=FALSE){
        $this->table='storage';
        return $this->get_one($param,$return_query);    
    }

    public function get_files($param,$order_by=null,$order='DESC',$return_query=FALSE){
        $this->table='storage';
        return $this->get_many($param,$order_by,$order,$return_query);  
    }


    public function _get_files($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){
        $this->db->select('storage.*');

        $i = 0;

        if(isset($param['data_id'])){
            $this->db->where('storage_data_type_id',$param['data_id']);
        }

        if(isset($param['storage_data_type'])){
            $this->db->where('storage_data_type',$param['storage_data_type']);
        }

        if(isset($param['column_search'])){
            foreach ($param['column_search'] as $item)
            {
                if(isset($post['search']['value']) && $post['search']['value'])
                {
                    
                    if($i===0)
                    {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if(count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }
                
                $i++;
            }
        }

            
        if(isset($post['order']))
        {
            $column_order=$param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } 
        else if(isset($param['order']))
        {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if($count==FALSE){
            if(isset($post['length']) && $post['length'] != -1){
                $this->db->limit($post['length'],$post['start']);   
            }
            
            $query = $this->db->get('storage');

            if($return_query==FALSE){
                return $query->result();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }       
            
        }else if($count==TRUE){
            $query = $this->db->get('storage');
            if($return_query==FALSE){
                return $query->num_rows();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }           
        }
    }


    //Menues
    public function get_menues($param=NULL,$single_row=TRUE,$return_query=FALSE){
        $this->table='users_menu';
        if($single_row==TRUE){
            return $this->get_one($param,'',$return_query);
        }else if($single_row==FALSE){
            return $this->get_many($param,null,null,$return_query);
        }       
    }


    //Masters
    public function store_master($data,$return_query=FALSE){
        $this->table='masters';
        return $this->store($data,FALSE,$return_query);
    }

    public function delete_master($param,$return_query=FALSE){
        $this->table='masters';
        return $this->remove($param,0,$return_query);
    }

    public function update_master($data,$param,$return_query=FALSE){
        $this->table='masters';
        return $this->modify($data,$param,FALSE,$return_query);
    }

    public function get_masters($param=NULL,$single_row=TRUE,$return_query=FALSE){
        $this->table='masters';
        if($single_row==TRUE){
            return $this->get_one($param,'',$return_query);
        }else if($single_row==FALSE){
            return $this->get_many($param,null,null,$return_query);
        }       
    }


    public function _get_masters($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){
        $this->db->select('masters.*');

        $i = 0;

        if(isset($post['type_key'])){
            $this->db->where('master_type_key',$post['type_key']);
        }

        if(isset($param['column_search'])){
            foreach ($param['column_search'] as $item)
            {
                if(isset($post['search']['value']) && $post['search']['value'])
                {
                    
                    if($i===0)
                    {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $post['search']['value']);
                    }

                    if(count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }
                
                $i++;
            }
        }

            
        if(isset($post['order']))
        {
            $column_order=$param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } 
        else if(isset($param['order']))
        {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if($count==FALSE){
            if(isset($post['length']) && $post['length'] != -1){
                $this->db->limit($post['length'],$post['start']);   
            }
            
            $query = $this->db->get('masters');

            if($return_query==FALSE){
                return $query->result();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }       
            
        }else if($count==TRUE){
            $query = $this->db->get('masters');
            if($return_query==FALSE){
                return $query->num_rows();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }           
        }
    }

    public function _get_agency($post=array(),$param=array(),$count=FALSE,$return_query=FALSE){
        $this->db->select('bl_agency.*');
        $b_id=$_SESSION['bank_id'];

        $this->db->where('isdeleted',0);
        $this->db->where('created_by',$b_id);
        $i = 0;
        if(isset($param['column_search'])){
            foreach ($param['column_search'] as $item)
            {
                if(isset($post['search']['value']) && $post['search']['value'])
                {
                    if($i===0)
                    {
                        $this->db->group_start();
                        $this->db->like($item, $post['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $post['search']['value']);
                    }
                    if(count($param['column_search']) - 1 == $i)
                        $this->db->group_end();
                }
                
                $i++;
            }
        }
        if(isset($post['order']))
        {
            $column_order=$param['column_order'];
            $this->db->order_by($column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
        } 
        else if(isset($param['order']))
        {
            $order = $param['order'];
            $this->db->order_by(key($order), $order[key($order)]);
        }
        if($count==FALSE){
            if(isset($post['length']) && $post['length'] != -1){
                $this->db->limit($post['length'],$post['start']);   
            }
            $query = $this->db->get('bl_agency');

            if($return_query==FALSE){
                return $query->result();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }       
            
        }else if($count==TRUE){
            $query = $this->db->get('bl_agency');
            if($return_query==FALSE){
                return $query->num_rows();
            }else if($return_query==TRUE){
                return $this->db->last_query();
            }           
        }
    }
    public function get_system_questions($param=NULL,$single_row=TRUE,$return_query=FALSE){
        $this->table='system_questions';
        if($single_row==TRUE){
            return $this->get_one($param,'',$return_query);
        }else if($single_row==FALSE){
            return $this->get_many($param,null,null,$return_query);
        }       
    }

}