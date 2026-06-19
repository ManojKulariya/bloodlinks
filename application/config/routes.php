<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']                =   'home';
$route['404_override']                      =   'home';
$route['translate_uri_dashes']              =   FALSE;

$route['preregister']                   =   'front/Account/indexPreregister';

$route['log']                   =   'Cron/run';
$route['about']                   =   'front/Account/about';
$route['contact']                   =   'front/Account/contact';
$route['privacy-policy']                   =   'front/Account/privacy';
$route['process_of_blood']                   =   'front/Account/process_of_blood';
$route['happan_to_post_donateblood']                   =   'front/Account/happan_to_post_donateblood';
$route['pre_and_post_pursuit']                   =   'front/Account/pre_and_post_pursuit';
$route['myaccount']                     =   'front/Account/myaccount';
$route['my-appointment']                    =   'front/Account/myappointment';
$route['my-request']                    =   'front/Account/myrequest';
$route['register']                       =   'front/Account/indexRegister';
$route['register1']                      =   'front/Account/Register1';
// $route['verificationregister']                      =   'front/Account/verificationregister';
$route['signin']                        =   'front/Account/indexLogin';
$route['signin1']                        =   'front/Account/Login1';
$route['dashboard']                     =   'Dashboard/dashboards';
$route['schedule-appointment']          =   'Appointment/appointments';
$route['account_registration']          =   'front/Account/onRegister';
$route['account_login']                 =   'front/Account/onLogin';
$route['account_logout']                =   'front/Account/onLogout';
$route['login']                =   'front/Account/login';
$route['mynewfunction']                =   'front/Account/mynewfunction';
$route['signup']                =   'front/Account/signup';
$route['verificationsignup']                =   'front/Account/verificationsignup';

$route['add_bloodbank']                =   'front/Donation/add_bloodbank';
// $route['add_hospital']                =   'front/Donation/add_hospital';
$route['add_hospital']                =   'hospital/Register/add_hospital';
$route['add_hospital_reg']          =   'hospital/Register/add_hospital_reg';
$route['add_lab']                =   'front/Donation/add_lab';
$route['add_camps']                =   'front/Donation/add_camps';
$route['find_bloodbank']                =   'front/Donation/find_bloodbank';
$route['find_hospital']                =   'front/Donation/find_hospital';
$route['details_hospital']                =   'front/Donation/details_hospital';

$route['details_bank']                =   'front/Donation/details_bank';
$route['get_hp_data']                =   'front/Donation/get_hp_data';
$route['find_lab']                =   'front/Donation/find_lab';
$route['find_camp']                =   'front/Donation/find_camp';
$route['user_hospitals_add']           =   'admin/Donation/user_hospitals_add';

//Common
$route['get_states']                    =   'front/Common/onGetStates';
$route['get_districts']                 =   'front/Common/onGetDistricts';
$route['get_cities']                    =   'front/Common/onGetCities';
$route['District']                    =   'front/Common/District';
$route['City']                    =   'front/Common/City';

//Donation Request Form
$route['donation-request']              =   'front/Donation/indexRequest';
$route['donation_request_forms']        =   'front/Donation/onLoadDonarRegistrationForm';
$route['donation_request_submit']       =   'front/Donation/onSubmitDonarRegistrationForm';

//Mobile App
// --
$route['search_donor_list']       =   'front/Donation/search_donor_list';
$route['update_availablity']       =   'front/Donation/update_availablity';
$route['update_location']       =   'front/Account/update_location';
// --
$route['donation_Appointment']       =   'front/Donation/onSubmitDonarAppointment';
$route['bookappointment']       =   'front/Donation/bookappointment';
$route['myappointmentlist']       =   'front/Donation/myappointmentlist';
$route['Re_scheduleappointment']       =   'front/Donation/Re_scheduleappointment';
$route['city_pincode_list']       =   'front/Donation/city_pincode_list';
$route['bloodbanklist']       =   'front/Donation/bloodbanklist';
$route['searchbloodbanklist']       =   'front/Donation/searchbloodbanklist';
$route['myprofile_data']       =   'front/Donation/myprofile_data';
$route['myprofile_edit']       =   'front/Donation/myprofile_edit';
$route['bloodrequest_form']       =   'front/Donation/bloodrequest_form';
$route['bloodrequest_appoint']       =   'front/Donation/bloodrequest_appoint';
$route['myrequestlist']       =   'front/Donation/myrequestlist';
$route['Re_schedulerequest']       =   'front/Donation/Re_schedulerequest';
$route['bloodbank_list']       =   'front/Donation/bloodbank_list';
$route['bloodbank_list_api']       =   'front/Donation/bloodbank_list_api';
$route['searchbloodbank_list']       =   'front/Donation/searchbloodbank_list';
$route['bloodbankcity_pincode_list']       =   'front/Donation/bloodbankcity_pincode_list';
$route['hospital_list']       =   'front/Donation/hospital_list';
$route['hospital_list_api']       =   'front/Donation/hospital_list_api';
$route['searchhospital_list']       =   'front/Donation/searchhospital_list';
$route['hospitalcity_pincode_list']       =   'front/Donation/hospitalcity_pincode_list';
$route['lab_list']       =   'front/Donation/lab_list';
$route['searchlab_list']       =   'front/Donation/searchlab_list';
$route['labcity_pincode_list']       =   'front/Donation/labcity_pincode_list';

//Blood Request Form
$route['blood-request']             =   'front/Request/indexRequest';
$route['blood_request_appointment']             =   'front/Request/blood_request_appointment';
$route['admin/request/blood_appointment']               =   'admin/Donation/blood_appointment';
$route['admin/request/blood_appointment_search']                =   'admin/Donation/blood_appointment_search';
$route['admin/request/blood_appointment_delete']                =   'admin/Donation/blood_appointment_delete';
$route['admin/request/blood_request_checkin/(:any)/(:any)']             =   'admin/Donation/blood_request_checkin';
$route['admin/request/request_pdf_download/(:any)/(:any)']      =   'admin/Donation/request_pdf_download';
$route['admin/request/request_form']                =   'admin/Donation/request_form';
$route['admin/request/request_form_search']             =   'admin/Donation/request_form_search';
$route['admin/request/request_form_add']                =   'admin/Donation/request_form_add';
$route['admin/donations/my_city_hospital']                =   'admin/Donation/my_city_hospital';
$route['admin/request/request_form_edit/(:any)']                =   'admin/Donation/request_form_edit';
$route['admin/request/request_form_delete']             =   'admin/Donation/request_form_delete';
$route['admin/request/cross_match']             =   'admin/Donation/cross_match';
$route['admin/request/cross_match_search']              =   'admin/Donation/cross_match_search';
$route['admin/request/cross_match_add']             =   'admin/Donation/cross_match_add';
$route['admin/request/cross_match_edit']                =   'admin/Donation/cross_match_edit';
$route['admin/request/cross_match_delete']              =   'admin/Donation/cross_match_delete';
$route['admin/request/issue_blood']             =   'admin/Donation/issue_blood';
$route['admin/request/issue_blood_download/(:any)']        =   'admin/Donation/issue_blood_download';
$route['admin/donations/donation_validation']                    =   'admin/Donation/donation_validation';
$route['admin/donations/donation_validation_reg']                    =   'admin/Donation/donation_validation_reg';

$route['admin/request/issue_blood_form']                =   'admin/Donation/issue_blood_form';
$route['admin/request/issue_bloodform_search']              =   'admin/Donation/issue_bloodform_search';
$route['admin/request/issue_bloodform_delete']              =   'admin/Donation/issue_bloodform_delete';
$route['admin/request/blood_return']                =   'admin/Donation/blood_return';
$route['admin/request/blood_return_form']               =   'admin/Donation/blood_return_form';
$route['admin/request/blood_returnform_search']             =   'admin/Donation/blood_returnform_search';
$route['admin/request/blood_returnform_delete']             =   'admin/Donation/blood_returnform_delete';

//Non Ajax Routes
$route['admin']                         =   'admin/Accounts/index';
$route['admin/dashboard']               =   'admin/Dashboards/index';
$route['admin/overview']            =   'admin/Dashboards/overview';
$route['admin/overview_get']        =   'admin/Dashboards/overview_get';

$route['hospital']                         =   'hospital/Register/loginpage';
$route['bmw']                         =   'BMW/Register/loginpage';
$route['BMW']                         =   'BMW/Register/loginpage';
$route['otp_hospital']                         =   'hospital/Register/otp_hospital';
$route['otp_bmw']                         =   'BMW/Register/otp_hospital';
$route['hp_verify_otp']                         =   'hospital/Register/verify_otp';
$route['bmw_verify_otp']                         =   'BMW/Register/verify_otp';

//Organisations
$route['admin/labs']                =   'admin/Organisations/indexlabs';
$route['admin/bloodbanks_detail_group/(:any)/(:any)/(:any)'] =   'admin/Organisations/bloodbanks_detail_group/$1/$2/$3';
$route['admin/bloodbanks_detail_group_app/(:any)/(:any)/(:any)'] =   'admin/Organisations/bloodbanks_detail_group_app/$1/$2/$3';
$route['admin/bloodbanks_req_group/(:any)/(:any)'] =   'admin/Organisations/bloodbanks_req_group/$1/$2';
$route['admin/bloodbanks_req_met_group/(:any)'] =   'admin/Organisations/bloodbanks_req_met_group/$1';
$route['admin/labs/add']            =   'admin/Organisations/indexlabsAddEdit';

// ----------- new dash links --------------
$route['admin/register_donars']         =   'admin/Dashboards/register_donars';
$route['admin/defer_donars']         =   'admin/Dashboards/defer_donars';
$route['admin/donation_appointments_donor']         =   'admin/Dashboards/donation_appointments_donor';
$route['admin/total_request_met']         =   'admin/Dashboards/total_request_met';

$route['admin/total_pending_app']         =   'admin/Dashboards/total_pending_app';
$route['admin/bb_pending_app_search']  =   'admin/Organisations/bb_pending_app_search';

// --

$route['admin/total_blood_issue']         =   'admin/Dashboards/total_blood_issue';
$route['admin/total_blood_issue_search']  =   'admin/Organisations/total_blood_issue_search';
$route['admin/total_blood_issue_detail/(:any)']  =   'admin/Organisations/total_blood_issue_detail/$1';


$route['admin/total_blood_payment']         =   'admin/Organisations/total_blood_payment';

// --


$route['admin/blood_inventory']         =   'admin/Dashboards/blood_inventory';
$route['admin/camp_planned']         =   'admin/Dashboards/camp_planned';
$route['admin/pending_request_blood']   =   'admin/Dashboards/pending_request_blood';
$route['admin/blood_stock_detail/(:any)/(:any)']    =   'admin/Organisations/blood_stock_detail/$1/$2';
$route['admin/bb_stock_detail_search']         =   'admin/Organisations/bb_stock_detail_search';
// -------------------------------------------
// ---------------- Stock Handover---------------------
$route['admin/stock_handover']           =   'admin/Organisations/stock_handover';
$route['admin/bb_stock_handover_search'] =   'admin/Organisations/bb_stock_handover_search';
$route['admin/bb_stock_hand_over'] =   'admin/Organisations/bb_stock_hand_over';
$route['admin/bb_stock_transfer_in'] =   'admin/Organisations/bb_stock_transfer_in';
$route['admin/bb_stock_transfer_in_save'] =   'admin/Organisations/bb_stock_transfer_in_save';

$route['admin/bb_stock_transfer_out'] =   'admin/Organisations/bb_stock_transfer_out';
$route['admin/bb_stock_out'] =   'admin/Organisations/bb_stock_out';

$route['admin/bb_stock_prc'] =   'admin/Organisations/bb_stock_prc';
$route['admin/unit_validation'] =   'admin/Organisations/unit_validation';
$route['admin/bb_stock_over_view'] =   'admin/Organisations/bb_stock_over_view';

$route['admin/bb_stock_over_report'] =   'admin/Organisations/bb_stock_over_report';
$route['admin/export_handover_report'] =   'admin/Organisations/export_handover_report';

$route['admin/bb_stock_over_view_search'] =   'admin/Organisations/bb_stock_over_view_search';

// ------------------------------------------------------
$route['admin/labs/add/(:any)']     =   'admin/Organisations/indexlabsAddEdit/$1';
$route['admin/labs_search']         =   'admin/Organisations/onSearchlabs';
$route['admin/bg_search']         =   'admin/Organisations/bg_search';
$route['admin/bg_search_excel']         =   'admin/Organisations/bg_search_excel';
$route['admin/bg_app_search']         =   'admin/Organisations/bg_app_search';
$route['admin/bg_app_search_excel']         =   'admin/Organisations/bg_app_search_excel';
$route['admin/bb_req_met_search']         =   'admin/Organisations/bb_req_met_search';
$route['admin/bb_req_met_search_excel']         =   'admin/Organisations/bb_req_met_search_excel';
$route['admin/bb_req_app_excel']         =   'admin/Organisations/bb_req_app_excel';
$route['admin/bb_req_app_search']         =   'admin/Organisations/bb_req_app_search';
$route['admin/bb_donar_app_search']         =   'admin/Organisations/bb_donar_app_search';
$route['admin/bb_req_search']         =   'admin/Organisations/bb_req_search';
$route['admin/bb_req_search_excel']         =   'admin/Organisations/bb_req_search_excel';
$route['admin/bb_details_search']  =   'admin/Organisations/bb_details_search';
$route['admin/bb_details_excel_url']  =   'admin/Organisations/bb_details_excel_url';
$route['admin/bb_details_donor_excel_url']  =   'admin/Organisations/bb_details_donor_excel_url';
$route['admin/bb_donnar_app_excel_url']  =   'admin/Organisations/bb_donnar_app_excel_url';
$route['admin/bb_deffer_search']  =   'admin/Organisations/bb_deffer_search';
$route['admin/bb_request_search']  =   'admin/Organisations/bb_request_search';
$route['admin/bb_request_excel']  =   'admin/Organisations/bb_request_excel';
$route['admin/bb_request_met_search']  =   'admin/Organisations/bb_request_met_search';
$route['admin/bb_request_met_excel']  =   'admin/Organisations/bb_request_met_excel';
$route['admin/bb_inv_search']  =   'admin/Organisations/bb_inv_search';
$route['admin/bb_inv_search_excel']  =   'admin/Organisations/bb_inv_search_excel';
$route['admin/bb_camp_search']  =   'admin/Organisations/bb_camp_search';
$route['admin/bb_camp_search_excel']  =   'admin/Organisations/bb_camp_search_excel';
$route['admin/labs_add']            =   'admin/Organisations/onAddEditlab';
$route['admin/labs_delete']         =   'admin/Organisations/onDeletelab';
$route['admin/hospitals']               =   'admin/Organisations/indexHospitals';
$route['admin/hospitals/add']           =   'admin/Organisations/indexHospitalsAddEdit';
$route['admin/hospitals/add/(:any)']    =   'admin/Organisations/indexHospitalsAddEdit/$1';
$route['admin/hospitals_search']        =   'admin/Organisations/onSearchHospitals';
$route['admin/hospitals_add']           =   'admin/Organisations/onAddEditHospital';
$route['admin/hospitals_delete']        =   'admin/Organisations/onDeleteHospital';
$route['admin/bloodbanks']              =   'admin/Organisations/indexBloodBanks';
$route['admin/bloodbanks/add']          =   'admin/Organisations/indexBloodBankAddEdit';
$route['admin/bloodbanks/status/(:any)/(:any)']          =   'admin/Organisations/bloodbanks_status';
$route['admin/hospital/status/(:any)/(:any)']          =   'admin/Organisations/hospital_status';
$route['admin/lab/status/(:any)/(:any)']          =   'admin/Organisations/lab_status';
$route['admin/bloodbanks/add/(:any)']   =   'admin/Organisations/indexBloodBankAddEdit/$1';

$route['admin/bloodbanks_search']       =   'admin/Organisations/onSearchBloodBanks';
$route['admin/approve_payment']       =   'admin/Organisations/approve_payment';
$route['admin/bloodbanks_file_search']  =   'admin/Organisations/onSearchBloodBanksFiles';
$route['admin/bloodbanks_add']          =   'admin/Organisations/onAddEditBloodBank';
$route['admin/bloodbanks_delete']       =   'admin/Organisations/onDeleteBloodBank';
$route['admin/donor']                   =   'admin/Organisations/indexdonor';
$route['admin/donor_search']            =   'admin/Organisations/onSearchdonor';
$route['admin/deleteSingleData']        =   'admin/Organisations/deleteSingleData';

$route['admin/petients_request']                    =   'admin/Organisations/indexpetients_request';
$route['admin/petients_request_search']         =   'admin/Organisations/onSearchpetients_request';
$route['admin/petients_request_delete']     =   'admin/Organisations/petients_request_delete';
$route['admin/all_bloodcamp']                   =   'admin/Organisations/indexall_bloodcamp';
$route['admin/all_bloodcamp_add']                   =   'admin/Organisations/all_bloodcamp_add';
$route['admin/all_bloodcamp_edit/(:any)']                   =   'admin/Organisations/all_bloodcamp_edit';
$route['admin/all_bloodcamp_search']            =   'admin/Organisations/onSearchall_bloodcamp';
$route['admin/all_bloodcamp_delete']        =   'admin/Organisations/all_bloodcamp_delete';
$route['admin/bloodbanks_file_delete']  =   'admin/Organisations/onDeleteBloodBankFiles';
$route['admin/user_role']                   =   'admin/Organisations/index_user_role';
$route['admin/user_role/edit/(:any)']           =   'admin/Organisations/user_role_edit';
$route['admin/user_role_search']            =   'admin/Organisations/onSearch_user_role';
$route['admin/user_role_delete']        =   'admin/Organisations/user_role_delete';
$route['admin/user']                    =   'admin/Organisations/indexuser';
$route['admin/user/add']            =   'admin/Organisations/user_add';
$route['admin/user/edit/(:any)']            =   'admin/Organisations/user_edit';
$route['admin/user_search']         =   'admin/Organisations/onSearch_user';
$route['admin/user_delete']     =   'admin/Organisations/user_delete';
$route['admin/donation_appointments']              =   'admin/Organisations/donation_Appointments';
$route['admin/donation_Appointments_delete']      =   'admin/Organisations/donation_Appointments_delete';
$route['admin/donations_download/(:any)/(:any)']        =   'admin/Organisations/download';
$route['admin/donation_forms']                 =   'admin/Organisations/donation_forms';
$route['admin/donation_forms/(:num)']                 =   'admin/Organisations/donation_forms/$1';
$route['admin/donation_forms_delete']           =   'admin/Organisations/donation_forms_delete';
$route['admin/donation_forms_edit/(:any)']               =   'admin/Organisations/donation_forms_edit';
$route['admin/deferred_donor']              =   'admin/Organisations/deferred_donor';
$route['admin/deferred_donor_search']       =   'admin/Organisations/onSearchdeferred_donor';
$route['admin/deferred_donor_delete']       =   'admin/Organisations/deferred_donor_delete';
$route['admin/tti_test']                   =   'admin/Organisations/ttitest';
$route['admin/tti_test_delete']        =   'admin/Organisations/tti_test_delete';
$route['admin/components']                 =   'admin/Organisations/components';
$route['admin/components/(:any)']                 =   'admin/Organisations/components/$1';
$route['admin/components_delete']      =   'admin/Organisations/components_delete';
$route['admin/bloodstocks']                    =   'admin/Organisations/bloodstock';
$route['admin/bloodstock_search']         =   'admin/Organisations/onSearchbloodstock';
$route['admin/bloodstock_delete']     =   'admin/Organisations/bloodstock_delete';
$route['admin/discard']                   =   'admin/Organisations/discard';
$route['admin/discard_delete']        =   'admin/Organisations/discard_delete';
$route['admin/Request_appointments']               =   'admin/Organisations/Request_appointments';
$route['admin/Request_appointments_delete']                =   'admin/Organisations/Request_appointments_delete';
$route['admin/Request_appointments_checkin/(:any)/(:any)']             =   'admin/Organisations/Request_appointments_checkin';
$route['admin/Request_appointments_pdf_download/(:any)/(:any)']      =   'admin/Organisations/Request_appointments_pdf_download';
$route['admin/request_form']                =   'admin/Organisations/request_form';
$route['admin/request_form/(:any)']                =   'admin/Organisations/request_form/$1';
$route['admin/request_form_edit/(:any)']                =   'admin/Organisations/request_form_edit';
$route['admin/request_form_delete']             =   'admin/Organisations/request_form_delete';
$route['admin/cross_match']             =   'admin/Organisations/cross_match';
$route['admin/cross_match_delete']              =   'admin/Organisations/cross_match_delete';
$route['admin/issue_blood']             =   'admin/Organisations/issue_blood';
$route['admin/issue_blood_download/(:any)']        =   'admin/Organisations/issue_blood_download';
// $route['admin/issue_blood_form']                =   'admin/Organisations/issue_blood_form';
// $route['admin/issue_bloodform_search']              =   'admin/Organisations/issue_bloodform_search';
// $route['admin/issue_bloodform_delete']              =   'admin/Organisations/issue_bloodform_delete';
$route['admin/blood_return']                =   'admin/Organisations/blood_return';
$route['admin/master_records']                    =   'admin/Organisations/master_records';
$route['admin/donor_records']                    =   'admin/Organisations/donor_records';
$route['admin/blood_records']                    =   'admin/Organisations/blood_records';
$route['admin/crossmatch_records']                    =   'admin/Organisations/crossmatch_records';


$route['admin/a_pos_donor']              =   'admin/Organisations/a_pos_donor';
$route['admin/b_pos_donor']              =   'admin/Organisations/b_pos_donor';
$route['admin/a_neg_donor']              =   'admin/Organisations/a_neg_donor';
$route['admin/b_neg_donor']              =   'admin/Organisations/b_neg_donor';
$route['admin/ab_neg_donor']             =   'admin/Organisations/ab_neg_donor';
$route['admin/ab_pos_donor']             =   'admin/Organisations/ab_pos_donor';
$route['admin/o_neg_donor']              =   'admin/Organisations/o_neg_donor';
$route['admin/o_pos_donor']              =   'admin/Organisations/o_pos_donor';

//Ajax routes
$route['admin/login']                   =   'admin/Accounts/onLogin';
$route['admin/logout']                  =   'admin/Accounts/onLogout';
$route['admin/donations/getuniueunit']  =   'admin/Donation/getuniueunit';


//Common
$route['admin/get_districts']           =   'admin/Common/onGetDistricts';
$route['admin/get_cities']              =   'admin/Common/onGetCities';

//Settings
// Agency 
$route['admin/settings/agency']                =   'admin/Settings/indexagency';
$route['admin/settings/agency_add']                =   'admin/Settings/agency_add';
$route['admin/settings/agency_search']             =   'admin/Settings/agency_search';
$route['admin/settings/ajency_delete']                =   'admin/Settings/ajency_delete';




$route['admin/settings/bloodgroups']                =   'admin/Settings/indexSettingsBloodGroups';
$route['admin/settings/bagtypes']                   =   'admin/Settings/indexSettingsBagsTypes';
$route['admin/settings/ttltypes']                   =   'admin/Settings/indexSettingsTTLTypes';
$route['admin/settings/componenttypes']             =   'admin/Settings/indexSettingsComponentTypes';
$route['admin/settings/donationtypes']              =   'admin/Settings/indexSettingsDonationTypes';
$route['admin/settings/donartypes']                 =   'admin/Settings/indexSettingsDonarTypes';
$route['admin/settings/organisationtypes']          =   'admin/Settings/indexSettingsOrganisationTypes';
$route['admin/settings/diagnosistypes']             =   'admin/Settings/indexSettingsDiagnosisTypes';
$route['admin/settings/coombsmethods']              =   'admin/Settings/indexSettingsCoombsMethods';
$route['admin/settings/campcodes']                  =   'admin/Settings/indexSettingsCampCodes';
$route['admin/settings/returnreason']               =   'admin/Settings/indexSettingsReturnReason';
$route['admin/settings/discardeason']               =   'admin/Settings/indexSettingsDiscardReason';
$route['admin/settings/requestdatestatus']          =   'admin/Settings/indexSettingsRequestDateStatus';
$route['admin/settings/masters_search']             =   'admin/Settings/onSearchMasters';
$route['admin/settings/masters_add']                =   'admin/Settings/onAddEditMaters';
$route['admin/settings/masters_edit/(:any)']                =   'admin/Settings/masters_edit';
$route['admin/settings/masters_delete']                =   'admin/Settings/masters_delete';

$route['admin/settings/states']                     =   'admin/Settings/indexSettingsStates';
$route['admin/settings/districts']                  =   'admin/Settings/indexSettingsDistricts';
$route['admin/settings/cities']                     =   'admin/Settings/indexSettingsCities';
$route['admin/settings/google_api']                     =   'admin/Settings/indexSettingsGoogle_api';

$route['admin/settings/states_search']              =   'admin/Settings/onSearchStates';
$route['admin/settings/districts_search']           =   'admin/Settings/onSearchDistricts';
$route['admin/settings/cities_search']              =   'admin/Settings/onSearchCities';
$route['admin/settings/google_api_search']                 =   'admin/Settings/onSearchGoogle_api';

//Donation
$route['admin/donations/verify_pw']                    =   'admin/Donation/verify_pw'; 
$route['admin/donations/my_records']                    =   'admin/Donation/my_records';
$route['admin/donations/my_records_request']                    =   'admin/Donation/my_records_request';
$route['admin/donations/my_crossmatch']                    =   'admin/Donation/my_crossmatch';
$route['admin/donations/my_city']                    =   'admin/Donation/my_city';
$route['admin/donations/my_crossmatch_search']                    =   'admin/Donation/my_crossmatch_search';
$route['admin/donations/my_unit_no']                    =   'admin/Donation/my_unit_no';

$route['admin/donations/check_grouping']                    =   'admin/Donation/check_grouping';

$route['admin/donations/my_unit_no_data']                    =   'admin/Donation/my_unit_no_data';


// $route['admin/donations/master_records_search']         =   'admin/Donation/onSearchmaster_records';
//  new-
$route['admin/donations/blood_grouping'] = 'admin/Masters/index_blood_grouping';
$route['admin/donations/blood_grouping/add'] = 'admin/Masters/add_blood_grouping';
// ------------- Admin Master Record ------------------------------------
$route['admin/donations/admin_master_records'] = 'admin/AdminMasters/indexmaster_records';
$route['admin/donations/admin_donor_records']                    =   'admin/AdminMasters/indexdonor_records';
// ------------ MASTER RECORD URLs---------------------------------------
$route['admin/donations/master_records'] = 'admin/Masters/indexmaster_records';
$route['admin/donations/donor_records']                    =   'admin/Masters/indexdonor_records';
$route['admin/donations/master_request']                    =   'admin/Masters/index_request_records';
$route['admin/donations/master_request/(:num)']                    =   'admin/Masters/index_request_records/$1';
$route['admin/donations/master_discard_register']                    =   'admin/Masters/master_discard_register';
$route['admin/donations/master_discard_register/(:num)']                    =   'admin/Masters/master_discard_register/$1';
$route['admin/donations/master_issue_register']                    =   'admin/Masters/master_issue_register';
$route['admin/donations/master_issue_register/(:num)']                    =   'admin/Masters/master_issue_register/$1';
$route['admin/donations/master_component_register']                    =   'admin/Masters/master_component_register';
$route['admin/donations/master_component_register/(:num)']                    =   'admin/Masters/master_component_register/$1';
$route['admin/donations/master_return_register']                    =   'admin/Masters/master_return_register';
$route['admin/donations/master_return_register/(:num)']                    =   'admin/Masters/master_return_register/$1';
$route['admin/donations/master_qcc_register']                    =   'admin/Masters/master_qcc_register';
$route['admin/donations/master_qcc_register/(:num)']                    =   'admin/Masters/master_qcc_register/$1';
$route['admin/donations/master_tti_register']                    =   'admin/Masters/master_tti_register';
$route['admin/donations/master_tti_register/(:num)']                    =   'admin/Masters/master_tti_register/$1';
$route['admin/donations/master_rec_blood_bag']                    =   'admin/Masters/master_rec_blood_bag';
$route['admin/donations/master_rec_blood_bag/(:num)']                    =   'admin/Masters/master_rec_blood_bag/$1';
$route['admin/donations/master_rec_consumble']                    =   'admin/Masters/master_rec_consumble';
$route['admin/donations/master_rec_consumble/(:num)']                    =   'admin/Masters/master_rec_consumble/$1';
$route['admin/donations/master_reg_dia_reag']                    =   'admin/Masters/master_reg_dia_reag';
$route['admin/donations/master_reg_dia_reag/(:num)']             =   'admin/Masters/master_reg_dia_reag/$1';
$route['admin/donations/master_rec_blood_group']                    =   'admin/Masters/master_rec_blood_group';
$route['admin/donations/master_rec_blood_group/(:num)']                    =   'admin/Masters/master_rec_blood_group/$1';

// -------------   END --------------------------------------------------

// $route['admin/donations/donor_records_search']         =   'admin/Donation/onSearchdonor_records';
$route['admin/donations/blood_records']                    =   'admin/Donation/indexblood_records';

$route['admin/donations/update_grouping']                    =   'admin/Donation/update_grouping';
$route['admin/donations/crossmatch_records']                    =   'admin/Donation/crossmatch_records';
$route['admin/donations/blood_records_search']         =   'admin/Donation/onSearchblood_records';
$route['admin/donations/bloodcamps']                    =   'admin/Donation/indexbloodcamps';
$route['admin/donations/bloodcamps/add']                    =   'admin/Donation/bloodcamps_add';
$route['admin/donations/bloodcamps/edit/(:any)']            =   'admin/Donation/bloodcamps_edit';
$route['admin/donations/bloodcamps_search']         =   'admin/Donation/onSearchbloodcamps';
$route['admin/donations/bloodcamps_delete']     =   'admin/Donation/bloodcamps_delete';
$route['admin/donations/bloodcamps_update']     =   'admin/Donation/bloodcamps_update';
$route['admin/donations/invcomponents']                 =   'admin/Donation/indexinvcomponents';
$route['admin/donations/invcomponents_search']          =   'admin/Donation/onSearchinvcomponents';
$route['admin/donations/invcomponents_delete']      =   'admin/Donation/invcomponents_delete';
$route['admin/donations/invbloodstocks']                    =   'admin/Donation/indexbloodstock';
$route['admin/donations/bloodstock_search']         =   'admin/Donation/onSearchbloodstock';
$route['admin/donations/bloodstock_delete']     =   'admin/Donation/bloodstock_delete';
$route['admin/donations/consumable']                    =   'admin/Donation/indexconsumable';
$route['admin/donations/consumable/add']                    =   'admin/Donation/consumable_add';
$route['admin/donations/consumable/edit/(:any)']            =   'admin/Donation/consumable_edit';
$route['admin/donations/consumable_search']         =   'admin/Donation/onSearchconsumable';
$route['admin/donations/consumable_delete']     =   'admin/Donation/consumable_delete';
$route['admin/donations/qc_reagents']                    =   'admin/Donation/qc_reagents';
$route['admin/donations/qc_reagents/add']                    =   'admin/Donation/qc_reagents__add';
$route['admin/donations/qc_reagents/edit/(:any)']            =   'admin/Donation/qc_reagents_edit';
$route['admin/donations/qc_reagents_delete']     =   'admin/Donation/qc_reagents_delete';
$route['admin/donations/qc_blood_components']                    =   'admin/Donation/qc_blood_components';
$route['admin/donations/qc_blood_components/add']                    =   'admin/Donation/qc_blood_components__add';
$route['admin/donations/qc_blood_components/edit/(:any)']            =   'admin/Donation/qc_blood_components_edit';
$route['admin/donations/qc_blood_components_delete']     =   'admin/Donation/qc_blood_components_delete';
$route['admin/all_qc_reagents']                    =   'admin/Donation/all_qc_reagents';
$route['admin/all_qc_reagents/add']                    =   'admin/Donation/all_qc_reagents__add';
$route['admin/all_qc_reagents/edit/(:any)']            =   'admin/Donation/all_qc_reagents_edit';
$route['admin/all_qc_reagents_delete']     =   'admin/Donation/all_qc_reagents_delete';
$route['admin/all_qc_blood_components']                    =   'admin/Donation/all_qc_blood_components';
$route['admin/all_qc_blood_components/add']                    =   'admin/Donation/all_qc_blood_components__add';
$route['admin/all_qc_blood_components/edit/(:any)']            =   'admin/Donation/all_qc_blood_components_edit';
$route['admin/all_qc_blood_components_delete']     =   'admin/Donation/all_qc_blood_components_delete';
$route['admin/donations/ttitest']                   =   'admin/Donation/indexttitest';
$route['admin/donations/ttitest_search']            =   'admin/Donation/onSearchttitest';
$route['admin/donations/ttitest_delete']        =   'admin/Donation/ttitest_delete';
$route['admin/donations/discard']                   =   'admin/Donation/indexdiscard';
$route['admin/donations/discard/add']                   =   'admin/Donation/discard_add';
$route['admin/donations/discard_search']            =   'admin/Donation/onSearchdiscard';


$route['admin/donations/discard_tti']            =   'admin/Donation/discard_tti';

$route['admin/donations/discard_component']            =   'admin/Donation/discard_component';
$route['admin/donations/discard_delete']        =   'admin/Donation/discard_delete';
$route['admin/donations/discard_tti_delete']        =   'admin/Donation/discard_tti_delete';

$route['admin/donations/discard_com_delete']        =   'admin/Donation/discard_com_delete';

$route['admin/donations/discard_thrown']        =   'admin/Donation/discard_thrown';

$route['admin/donations/discard_thrown_tti']        =   'admin/Donation/discard_thrown_tti';

$route['admin/donations/discard_thrown_component']        =   'admin/Donation/discard_thrown_component';

$route['admin/donations/appointments']              =   'admin/Donation/indexAppointments';
$route['admin/donations/appointments_search']       =   'admin/Donation/onSearchAppointments';
$route['admin/donations/deleteSingleData']      =   'admin/Donation/deleteSingleData';
$route['admin/donations/forms']                 =   'admin/Donation/indexForm';
$route['admin/donations/examination']                 =   'admin/Donation/examination';
$route['admin/donations/forms/add']                 =   'admin/Donation/Form_add';
$route['admin/donations/forms_search']          =   'admin/Donation/onSearchForm';
$route['admin/donations/form_delete']           =   'admin/Donation/Form_delete';
$route['admin/donations/Examination_done']           =   'admin/Donation/Examination_done';
$route['admin/donations/form_delete1']           =   'admin/Donation/Form_delete1';
$route['admin/donations/donationform/(:any)']               =   'admin/Donation/edit_donation_form';
$route['admin/donations/deferred']              =   'admin/Donation/indexDeferred';
$route['admin/donations/deferred_search']       =   'admin/Donation/onSearchDeferred';
$route['admin/donations/deferred_delete']       =   'admin/Donation/Deferred_delete';
$route['admin/donations/deferred_request']              =   'admin/Donation/deferred_request';
$route['admin/donations/onSearchdeferred_request']       =   'admin/Donation/onSearchdeferred_request';
$route['admin/donations/deferred_request_delete']       =   'admin/Donation/deferred_request_delete';
$route['admin/donations/consumables_items']                 =   'admin/Donation/indexconsumables_items';
$route['admin/donations/consumables_items/edit/(:any)']         =   'admin/Donation/consumables_items_edit';
$route['admin/donations/consumables_items_search']          =   'admin/Donation/onSearchconsumables_items';
$route['admin/donations/consumables_items_delete']      =   'admin/Donation/consumables_items_delete';
$route['admin/donations/consumables_types']                 =   'admin/Donation/indexconsumables_types';
$route['admin/donations/consumables_types/edit/(:any)']         =   'admin/Donation/consumables_types_edit';
$route['admin/donations/consumables_types_search']          =   'admin/Donation/onSearchconsumables_types';
$route['admin/donations/consumables_types_delete']      =   'admin/Donation/consumables_types_delete';
$route['admin/donations/consumables_recive']                    =   'admin/Donation/indexconsumables_recive';
$route['admin/donations/consumables_recive/edit/(:any)']            =   'admin/Donation/consumables_recive_edit';
$route['admin/donations/consumables_recive_search']         =   'admin/Donation/onSearchconsumables_recive';
$route['admin/donations/consumables_recive_delete']     =   'admin/Donation/consumables_recive_delete';
$route['admin/donations/manufactures']                  =   'admin/Donation/indexmanufactures';
$route['admin/donations/manufactures/edit/(:any)']          =   'admin/Donation/manufactures_edit';
$route['admin/donations/manufactures_search']           =   'admin/Donation/onSearchmanufactures';
$route['admin/donations/manufactures_delete']       =   'admin/Donation/manufactures_delete';
$route['admin/donations/bloodbank_user_role']                   =   'admin/Donation/indexbloodbank_user_role';
$route['admin/donations/bloodbank_user_role/edit/(:any)']           =   'admin/Donation/bloodbank_user_role_edit';
$route['admin/donations/bloodbank_user_role_search']            =   'admin/Donation/onSearchbloodbank_user_role';
$route['admin/donations/bloodbank_user_role_delete']        =   'admin/Donation/bloodbank_user_role_delete';

$route['admin/donations/bloodbank_user']                    =   'admin/Donation/indexbloodbank_user';
$route['admin/donations/bloodbank_user/add']            =   'admin/Donation/bloodbank_user_add';
$route['admin/donations/bloodbank_user/edit/(:any)']            =   'admin/Donation/bloodbank_user_edit';
$route['admin/donations/bloodbank_user_search']         =   'admin/Donation/onSearchbloodbank_user';
$route['admin/donations/bloodbank_user_delete']     =   'admin/Donation/bloodbank_user_delete';

$route['admin/donations/mymethod']      =   'admin/Donation/mymethod';
$route['admin/donations/donation_form/(:any)/(:any)']               =   'admin/Donation/edit_donation_form1';
$route['admin/donations/donation_form2/(:any)/(:any)']              =   'admin/Donation/edit_donation_form2';
$route['admin/donations/donation_form3/(:any)/(:any)']              =   'admin/Donation/edit_donation_form3';
$route['admin/donations/donation_form4/(:any)/(:any)']              =   'admin/Donation/edit_donation_form4';
$route['admin/donations/donation_form5/(:any)/(:any)']              =   'admin/Donation/edit_donation_form5';
$route['donation_request_update']       =   'admin/Donation/update_donation_form';

// $route['admin/donations/deleteSingleData']       =   'admin/Donation/deleteSingleData';
$route['admin/donations/download/(:any)/(:any)']        =   'admin/Donation/download';
$route['admin/donations/check_in/(:any)/(:any)']        =   'admin/Donation/check_in';
$route['admin/settings/profile'] = 'admin/Accounts/edit_profile';
// v2 api 
$route['hospital_list_v2']       =   'front/Donation/hospital_list_v2';

$route['blood_bank_list_v2']       =   'front/Donation/blood_bank_list_v2';
$route['lab_list_v2']       =   'front/Donation/lab_list_v2';



// ------------ hospital dash path--------------
$route['hospital/dashboard']          =   'hospital/Dashboard/dashboards';

$route['hospital/nearby_bloodbank']   =   'hospital/Dashboard/nearby_bloodbank';
$route['hospital/nearby_bloodbank_1/(:any)']   =   'hospital/Dashboard/nearby_bloodbank_1/$1';
$route['hospital/req_bloodbank']   =   'hospital/Request/req_bloodbank';


$route['hospital/bb_inv_search']  =   'hospital/Dashboard/bb_inv_search';
$route['hospital/bb_inv_search_1']  =   'hospital/Dashboard/bb_inv_search_1';

$route['hospital/Blood_request/(:any)']  =   'hospital/Request/Request/$1';
$route['hospital/Blood_request_1/(:any)/(:any)']  =   'hospital/Request/Request_1/$1/$2';

$route['hospital/Blood_request_submit']  =   'hospital/Request/Blood_request_submit';
$route['hospital/Blood_request_submit_1']  =   'hospital/Request/Blood_request_submit_1';
$route['hospital/Blood_request_history']  =   'hospital/Request/Blood_request_history';

$route['hospital/Blood_request_issued']  =   'hospital/Request/Blood_request_issued';
$route['hospital/Blood_request_issued_rec']  =   'hospital/Request/Blood_request_issued_rec';


$route['hospital/Blood_request_update_status']  =   'hospital/Request/Blood_request_update_status';
$route['hospital/Blood_request_discard_blood']  =   'hospital/Request/Blood_request_discard_blood';
$route['hospital/logout']                  =   'hospital/Accounts/onLogout';
$route['hospital/my_bmw']                    =   'hospital/Request/my_bmw';
$route['hospital/assign_bmw_to_user']                    =   'hospital/Request/assign_bmw_to_user';
$route['hospital/handover_to_bmw']                    =   'hospital/Request/stock_handover';
$route['hospital/handover_to_bmw_overview']                    =   'hospital/Request/handover_to_bmw_overview';
$route['hospital/bb_stock_handover_search'] =   'hospital/Request/bb_stock_handover_search';
$route['hospital/bmw_stock_hand_over'] =   'hospital/Request/bmw_stock_hand_over';
$route['hospital/hp_stock_over_view_search'] =   'hospital/Request/hp_stock_over_view_search';


$route['hospital/donations/bloodbank_user_role'] =   'hospital/Donation/indexbloodbank_user_role';
$route['hospital/donations/bloodbank_user_role_search']    =   'hospital/Donation/onSearchbloodbank_user_role';
$route['hospital/donations/bloodbank_user']     =   'hospital/Donation/indexbloodbank_user';
$route['hospital/donations/bloodbank_user_search']         =   'hospital/Donation/onSearchbloodbank_user';
$route['hospital/donations/bloodbank_user/add']            =   'hospital/Donation/bloodbank_user_add';

// ---------------- Hooks-----------------
$route['admin/payment_required'] = 'admin/Payment/payment_required';
// ------------ BMW dash path--------------
$route['BMW/dashboard']          =   'BMW/Dashboard/dashboards';
$route['bmw/dashboard']          =   'BMW/Dashboard/dashboards';
$route['BMW/logout']             =   'BMW/Accounts/onLogout';
$route['BMW/stock_hospital']                    =   'BMW/Request/handover_to_bmw_overview';
$route['BMW/hp_stock_over_view_search'] =   'BMW/Request/hp_stock_over_view_search';
$route['BMW/update_bmw_status'] =   'BMW/Request/update_bmw_status';
$route['BMW/update_bmw_req/(:any)/(:any)'] =   'BMW/Request/update_bmw_req/$1/$2';
$route['BMW/update_bmw_req_dispose/(:any)/(:any)'] =   'BMW/Request/update_bmw_req_dispose/$1/$2';

$route['translate_uri_dashes'] = FALSE;
