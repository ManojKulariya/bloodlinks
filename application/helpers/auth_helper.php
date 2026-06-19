<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function has_service($serviceKey) {
    $CI = get_instance();
    $role_id = $CI->session->userdata('role_id');

    // ✅ allow all if not role 9
    if ($role_id != 9) {
        return true;
    }

    $services = $CI->session->userdata('services');
    return isset($services[$serviceKey]);
}

function has_permission($serviceKey, $action) {
    $CI = get_instance();
    $role_id = $CI->session->userdata('role_id');

    // ✅ allow all if not role 9
    if ($role_id != 9) {
        return true;
    }

    $permissions = $CI->session->userdata('permissions');
    return (isset($permissions[$serviceKey]) && $permissions[$serviceKey] == $action);
}
