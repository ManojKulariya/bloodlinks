<?php defined('BASEPATH') or exit('No direct script access allowed');

//use Spatie\ImageOptimizer\OptimizerChainFactory;
use WebPConvert\WebPConvert;

/**
 * 
 */
class BaseBMWController extends CI_Controller
{
    public $data = array();
    public $active_controller;
    public $permission = array();
    public $login_session_duration = 5;

    function __construct()
    {

        parent::__construct();
       
        date_default_timezone_set('Asia/Kolkata');

        $this->theme->view_type = 'BMW';

        $this->theme->initialize(array(
            'theme'            => 'adminlte',
            'master'           => 'default',
            'layout'           => 'default',
            'title_sep'        => '-',
            'compress'         => (ENVIRONMENT !== 'development') ? false : false,
            'cache_lifetime'   => 0,
            'cdn_enabled'      => false,
            'cdn_server'       => null,
            'site_name'        => 'Blood Links',
            'site_description' => '',
            'site_keywords'    => ''
        ));

        $this->data['system_name'] = 'Blood Links';

        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        $this->data['base_url'] = base_url('BMW');

        $this->data['logo_image'] = base_url('uploads/app/logo.png');
        $this->data['favicon_image'] = base_url('uploads/app/fav.ico');
        $this->data['loader_image'] = base_url('uploads/app/loader.gif');

        $this->data['no_image'] = base_url('uploads/app/no.jpeg');

        $this->active_controller = get_instance()->theme->controller;

        if (session_userdata('isBMWLoggedin') == TRUE) {

            $user_id = decode_data(session_userdata('admin_id'));
            // var_dump($user_id);
            $user_type = session_userdata('admin_type');

            $userdata = $this->um->get_user(array('id' => $user_id), $user_type);

            $name = 'BMW';
            
            $_menues = array();
            $_child_meues = array();


            $menues = $this->sm->get_menues(array('menu_role_id' => $user_type, 'menu_status' => 'active', 'menu_parent_id' => '0'), FALSE);

            if (!empty($menues)) {
                foreach ($menues as $key => $value) {
                    $child_meues = $this->sm->get_menues(array('menu_role_id' => $user_type, 'menu_status' => 'active', 'menu_parent_id' => $value->menu_id), FALSE);
                    usort($child_meues, function ($a, $b) {
                        return $a->menu_order <=> $b->menu_order;
                    });
                    foreach ($child_meues as $k => $v) {
                        $_child_meues[$value->menu_id][] = array(
                            'menu_name' => $v->menu_name,
                            'menu_icon' => $v->menu_icon,
                            'menu_url' => (!empty($v->menu_url)) ? $this->data['base_url'] . $v->menu_url : '',
                            'menu_active' => '' //(is_controller($this->active_controller))?'active':''
                        );
                    }

                    $_menues[] = array(
                        'menu_name' => $value->menu_name,
                        'menu_icon' => $value->menu_icon,
                        'menu_url' => (!empty($value->menu_url)) ? $this->data['base_url'] . $value->menu_url : '',
                        'menu_active' => '', //(is_controller($this->active_controller))?'menu-open':'',
                        'child_meues' => (isset($_child_meues[$value->menu_id]) && !empty($_child_meues[$value->menu_id])) ? $_child_meues[$value->menu_id] : ''
                    );
                }
            }
            // echo "this ";
            // die();

            $this->data['menues'] = $_menues;

            $this->data['userdata'] = $userdata;

            $this->data['user_name'] = $name;

            $this->data['user_image'] = create_avatar($name);


            $this->theme->add_partial('partial_header', $this->data)->add_partial('partial_sidebar', $this->data)->add_partial('partial_footer');
        } else {
            $this->theme->theme('adminlte');
        }
    }


    public function set_active_controller($active_controller)
    {
        $this->active_controller = $active_controller;
    }

    public function get_active_controller()
    {
        return $this->active_controller;
    }



    public function onUploadFiles($param, $uploader_method = 'uploader')
    {

        $document_to_upload     =     $_FILES[$param['file_name']];

        $uploader = new Uploader();

        $file_types = explode(',', $param['file_types']);

        //print_obj($file_types);die;

        $file_size = isset($param['file_size']) ? $param['file_size'] : 5;

        $file_limit = isset($param['file_limit']) ? $param['file_limit'] : 1;

        $file_size = $param['file_size'];

        $storage_type = $param['file_storage_type'];
        $storage_type_name = $param['file_storage_type_name'];
        $storage_data_type = $param['file_storage_data_type'];
        $storage_data_type_id = $param['file_storage_data_type_id'];

        if (isset($param['file_storage_dir'])) {
            $upload_dir = DIR_UPLOADS . $param['file_storage_dir'];

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777);
                chmod($upload_dir, 0777);
                @touch($upload_dir . '/' . 'index.html');
            }
            $upload_dir = $upload_dir . '/';
        } else {
            $upload_dir = DIR_UPLOADS;
        }

        $document_data = array(
            'limit' => $file_limit,
            'maxSize' => $file_size,
            'extensions' => $file_types,
            'required' => true,
            'uploadDir' => $upload_dir,
            'title' => array('auto', 10),
            'removeFiles' => true,
            'perms' => null,
            'onCheck' => null,
            'onError' => null,
            'onSuccess' => null,
            'onUpload' => '',
            'onComplete' => null,
            'onRemove' => ''
        );

        $data = $uploader->upload($document_to_upload, $document_data);

        if ($data['isComplete'] == 1 && $data['isSuccess'] == 1 && $data['hasErrors'] == NULL) {

            $files = $data['data'];

            $media_mime = implode('/', $files['metas'][0]['type']);

            if (isset($param['file_storage_dir'])) {
                $file_relative_path = 'uploads/' . $param['file_storage_dir'] . '/' . $files['metas'][0]['name'];
            } else {
                $file_relative_path = 'uploads/' . $files['metas'][0]['name'];
            }

            $pathToImage = $files['metas'][0]['file'];


            if (isset($param['file_resize']) && $param['file_resize'] == true) {
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $pathToImage;
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width']        = $param['file_resize_width'];
                $config['height']       = $param['file_resize_height'];

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();
            }

            if (isset($param['file_compress']) && $param['file_compress'] == true) {

                if (in_array($media_mime, array('image/png', 'image/jpg', 'image/jpeg'))) {
                    $source = $pathToImage;

                    $destination = str_replace('.' . $files['metas'][0]['extension'], '', $source) . '.webp';

                    $options = [
                        'converters' => [
                            'cwebp',
                            'vips',
                            'imagick',
                            'gmagick',
                            'imagemagick',
                            'graphicsmagick',
                            'wpc',
                            'ewww',
                            'gd'
                        ],

                        // Any available options can be set here, they dribble down to all converters.
                        'metadata' => 'all',

                        // To override for specific converter, you can prefix with converter id:
                        'cwebp-metadata' => 'exif'
                    ];

                    WebPConvert::convert($source, $destination, $options);

                    $file_name = str_replace('.' . $files['metas'][0]['extension'], '.webp', $files['metas'][0]['name']);
                    $file_relative_path = str_replace($files['metas'][0]['name'], $file_name, $file_relative_path);
                    $file_disk_path = $destination;
                    $bytes = filesize($destination);
                    $file_mime = 'image/webp';
                    if ($bytes >= 1073741824) {
                        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
                    } elseif ($bytes >= 1048576) {
                        $bytes = number_format($bytes / 1048576, 2) . ' MB';
                    } elseif ($bytes > 0) {
                        $bytes = number_format($bytes / 1024, 2) . ' KB';
                    } else {
                        $bytes = '0 bytes';
                    }

                    $file_size2 = $bytes;
                    $file_size = filesize($destination);

                    @unlink($source);
                } else {
                    $media_mime = implode('/', $files['metas'][0]['type']);
                    $file_name = $files['metas'][0]['name'];
                    $file_size2 = $files['metas'][0]['size2'];
                    $file_size = $files['metas'][0]['size'];
                    $file_mime = $media_mime;
                }
            } else {
                $media_mime = implode('/', $files['metas'][0]['type']);
                $file_name = $files['metas'][0]['name'];
                $file_size2 = $files['metas'][0]['size2'];
                $file_size = $files['metas'][0]['size'];
                $file_mime = $media_mime;
            }

            //$file_disk_path=$upload_dir.$file_name;

            $sdata = array(
                'storage_type' => $storage_type,
                'storage_data_type' => $storage_data_type,
                'storage_type_name' => $storage_type_name,
                'storage_data_type_id' => $storage_data_type_id,
                'storage_parent_id' => $param['file_parent_id'],
                'media_disk_path' => $file_relative_path,
                'media_disk_path_relative' => $file_relative_path,
                'media_disk_name' => $file_name,
                'media_org_name' => $files['metas'][0]['old_name'] . '.' . $files['metas'][0]['extension'],
                'media_size' => $file_size,
                'media_size2' => $file_size2,
                'media_mime' => $file_mime,
                'media_uploaded_by' => $param['file_uploaded_by'],
                'media_uploaded_date' => date('Y-m-d H:i:s')
            );


            if ($param['file_operation_type'] == 'new') {
                $temp_file_id = $this->sm->store_file($sdata);
            } else if ($param['file_operation_type' == 'update']) {
                $file_found = $this->sm->get_file(array('storage_type' => $storage_type, 'storage_type_id' => $storage_type_id));

                //print_obj($file_logo_found);die;

                if (!empty($file_found)) {
                    if (is_file($file_found->media_disk_path)) {
                        @unlink($file_found->media_disk_path);
                        $this->sm->update_file($sdata, array('storage_id' => $file_found->storage_id));
                    }

                    $temp_file_id = $file_found->storage_id;
                }
            }


            //print_obj($sdata);die;



            return $temp_file_id;
        } else if ($data['isComplete'] == NuLL && $data['hasErrors'] == 1 && $data['isSuccess'] == NULL) {
            return $data['errors'][0][0];
        } else if ($data['isComplete'] == 1 && $data['hasErrors'] == 1 && $data['isSuccess'] == NULL) {
            return $data['errors'][0][0];
        }
    }
    public function wp_test($group, $name, $bank_id)
    {
        if ($name == 'Tested') {
            $txt = 'Test Done';
        } else {
            $txt = 'Test Not Done';
        }

        $this->db->select('id');
        $this->db->from('bl_bb_donatioform');
        $this->db->where('status', $txt);
        $this->db->where('blood_group', $group);
        // Apply blood bank condition if admin_type is 5

        $this->db->where('bloodbank_id', $bank_id);


        // Execute the query and get the count
        $query = $this->db->get();
        return $query->num_rows();
    }
    function blood_group_data($comp, $group, $bank_id)
    {
        $txt = "No";
        $current_date = date('Y-m-d');
        $this->db->select('id');
        $this->db->from('bl_blood_record');
        $this->db->where_in('component', $comp);
        $this->db->where('cross_match', $txt);
        $this->db->where('expiry_date >', $current_date);
        $this->db->where('status', NULL, FALSE);
        $this->db->where('blood_group', $group);
        // Apply blood bank condition if admin_type is 5

        $this->db->where('bloodbank_id', $bank_id);


        // Execute the query and get the count
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function replacekey($data)
    {
        // Define the mapping for old keys to new keys
        $keyMapping = [
            "whole_blood_unit" => 'Whole Blood',
            "Cryo_Poor_Plasma_unit" => 'CPP',
            "Cryoprecipitate_unit" => 'CRYO',
            "Single_Donor_Platellet_unit" => 'SDP',
            "Fresh_Frozen_Plasma_unit" => 'FFP',
            "Red_blood_cell_unit" => 'RDP',
            "Platelet_rich_concentrate_unit" => 'PRBC'
        ];
        $newData = [];
        foreach ($data as $key => $value) {
            if (isset($keyMapping[$key]) && $value !== "") {
                $newKey = $keyMapping[$key];
                $newData[$newKey] = $value;
            }
        }

        return $newData;
    }
}
