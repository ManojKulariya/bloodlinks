<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('get_components_by_bank')) {
     function get_components_by_bank($bank_id) {
           $CI =& get_instance(); 
            $component = $CI->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id= '$bank_id'")->row(); 
            $ids = explode(',', $component->components_available);
             $array_com = [];
            foreach ($ids as $v) {
                $query = $CI->db->query("SELECT * FROM bl_masters WHERE master_id  = '$v'");
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
            return $array_com;
     }
}
if (!function_exists('send_sms_template')) {
    function send_sms_template($temp_name, $mobile, $placeholders = []) {
        $CI =& get_instance();
        $CI->load->database();

        // Get template by temp_name
        $template = $CI->db->get_where('sms_templates', ['temp_name' => $temp_name])->row();

        if (!$template) {
            log_message('error', "SMS template '$temp_name' not found.");
            return false;
        }

        // Replace placeholders like {#otp#}, {#name#}, etc.
        $message = $template->temp;
        foreach ($placeholders as $key => $value) {
            $message = str_replace("{#$key#}", $value, $message);
        }

        // Prepare and send SMS
        $encoded_message = urlencode($message);
        $url = "https://msg.smsguruonline.com/fe/api/v1/send?"
             . "username=bloodlinks.trans"
             . "&password=mc1W1"
             . "&unicode=false"
             . "&from=BLDLNK"
             . "&to=$mobile"
             . "&dltPrincipalEntityId=1201161613715484703"
             . "&dltContentId={$template->temp_id}"
             . "&text=$encoded_message";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            log_message('error', 'SMS sending failed: ' . $error);
            return false;
        } else {
            log_message('info', "SMS sent to $mobile using template $temp_name. Response: $response");
            return true;
        }
    }
}
