<?php defined('BASEPATH') or exit('No direct script access allowed');


/**
 * This class is here to demonstrate the use of 
 * Events library with Theme library.
 */
class Theme_class
{
    public function __construct()
    {
        /**
         * With this event registered, theme can independently enqueue
         * all needed StyleSheets without adding them in controllers.
         */
        Events::register('enqueue_styles', array($this, 'styles'));

        /**
         * With this event registered, theme can independently enqueue
         * all needed JS files without adding them in controllers.
         */
        Events::register('enqueue_scripts', array($this, 'scripts'));

        Events::register('enqueue_scripts', array($this, 'scripts'));

        /**
         * With this event registered, theme can independently enqueue
         * all needed meta tags without adding them in controllers.
         */
        Events::register('enqueue_metadata', array($this, 'metadata'));

        // Manipulating <html> class.
        Events::register('html_class', array($this, 'html_class'));

        // Manipulating <body> class.
        Events::register('body_class', array($this, 'body_class'));

        Events::register('active_class', array($this, 'active_class'));
    }


    public function styles()
    {

        $style_arr = array(
            'assets/plugins/fontawesome-free/css/all.min',
            'assets/plugins/overlayScrollbars/css/OverlayScrollbars.min',
            'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
            'assets/plugins/icheck-bootstrap/icheck-bootstrap.min',
            'assets/plugins/sweetalert2/sweetalert2.min',
            'assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min',
            'assets/plugins/toastr/toastr.min',
            'assets/plugins/select2/css/select2.min',
            'assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min',
            'assets/plugins/daterangepicker/daterangepicker',
            'assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min',
            'assets/dist/css/adminlte.min',
            'assets/comman',
            'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700',


        );

        if (is_controller('Organisations') && (is_method('indexHospitals') || is_method('indexBloodBanks') || is_method('bb_stock_over_report') || is_method('total_blood_issue_detail') || is_method('total_blood_payment')
            || is_method('bloodbanks_detail_group') || is_method('blood_stock_detail') || is_method('bb_stock_over_view') || is_method('stock_handover') || is_method('bb_stock_transfer_out') || is_method('bloodbanks_detail_group_app') || is_method('bloodbanks_req_met_group') || is_method('bloodbanks_req_group') || is_method('indexlabs') || is_method('indexpetients_request') || is_method('indexall_bloodcamp') || is_method('indexdonor') || is_method('index_user_role') || is_method('indexuser') || is_method('indexBloodBankAddEdit') || is_method('deferred_donor') || is_method('Request_appointments') || is_method('request_form') || is_method('cross_match') || is_method('issue_blood') || is_method('blood_return') || is_method('blood_records'))) {
            array_push(
                $style_arr,
                'assets/plugins/daterangepicker/daterangepicker',
                'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min',
                'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min'
            );
        }
        if (is_controller('Dashboard') || is_controller('Request') || is_controller('Masters') ) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }


        if (is_controller('Donation') && (is_method('add_bloodbank') || is_method('add_hospital') || is_method('add_lab'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Settings')) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Donation') && (is_method('indexAppointments'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Donation') && (is_method('indexForm')) || (is_method('indexForm'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Organisations') && (is_method('donation_forms'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }


        if (is_controller('Organisations') && (is_method('donation_Appointments'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Organisations') && (is_method('deferred_donor'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Organisations') && (is_method('ttitest'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Organisations') && (is_method('components'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Organisations') && (is_method('bloodstock'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Organisations') && (is_method('discard'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('indexDeferred'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Donation') && (is_method('deferred_request'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('indexttitest'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Donation') && (is_method('indexdiscard'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('indexmanufactures'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('indexconsumables_items'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Donation') && (is_method('indexbloodbank_user_role'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Donation') && (is_method('indexbloodbank_user'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Donation') && (is_method('indexconsumables_types'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Donation') && (is_method('indexconsumables_recive'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('indexinvcomponents'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('indexbloodstock'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('indexconsumable'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('qc_reagents'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('qc_blood_components'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Donation') && (is_method('all_qc_reagents'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('all_qc_blood_components'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }

        if (is_controller('Donation') && (is_method('blood_appointment'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('request_form'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('cross_match'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('cross_match_add'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('indexblood_records'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('issue_blood'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('blood_return'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        if (is_controller('Donation') && (is_method('indexbloodcamps'))) {
            array_push($style_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min');
        }
        add_style($style_arr);
    }


    public function scripts()
    {
        $script_arr = array(
            'assets/plugins/jquery/jquery.min',
            'assets/plugins/bootstrap/js/bootstrap.bundle.min',
            'assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min',
            'assets/plugins/moment/moment.min',
            'assets/plugins/jquery-validation/jquery.validate.min',
            'assets/plugins/jquery-validation/additional-methods.min',
            'assets/plugins/sweetalert2/sweetalert2.all.min',
            'assets/plugins/toastr/toastr.min',
            'assets/plugins/select2/js/select2.full.min',
            'assets/plugins/daterangepicker/daterangepicker',
            'assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min',
            'assets/dist/js/adminlte.min',
            'assets/scripts/common',
            'assets/scripts/dashboard',
            'assets/scripts/dashboardexcel',
        );

        if (is_controller('Dashboard') || is_controller('Request')) {
            array_push(
                $script_arr,
                'assets/plugins/datatables/jquery.dataTables.min',
                'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min',
                'assets/plugins/datatables-responsive/js/dataTables.responsive.min',
                'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min',
                'assets/scripts/organisations',
                'assets/scripts/donations'
            );
        }
        if (is_controller('Accounts') && is_method('index')) {
            array_push($script_arr, 'assets/scripts/login');
        }


        if (is_controller('Organisations') && (is_method('discard') || is_method('indexHospitals') || is_method('indexBloodBanks') || is_method('bb_stock_over_report') || is_method('total_blood_issue_detail') || is_method('total_blood_payment')
            || is_method('bloodbanks_detail_group') || is_method('blood_stock_detail') || is_method('bb_stock_transfer_out') || is_method('bb_stock_over_view') || is_method('stock_handover') || is_method('bloodbanks_detail_group_app') || is_method('bloodbanks_req_group')  || is_method('bloodbanks_req_met_group') || is_method('indexlabs') || is_method('indexpetients_request') || is_method('indexall_bloodcamp') || is_method('indexdonor') || is_method('index_user_role') || is_method('indexuser') || is_method('indexBloodBankAddEdit') || is_method('indexHospitalsAddEdit') || is_method('indexlabsAddEdit') || is_method('deferred_donor') || is_method('Request_appointments') || is_method('request_form') || is_method('cross_match') || is_method('issue_blood') || is_method('blood_return') || is_method('blood_records'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/organisations', 'assets/scripts/donations');
        }
        if (is_controller('Masters') ){
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/organisations', 'assets/scripts/donations');
        }
        if (is_controller('Donation') && (is_method('add_bloodbank') || is_method('add_hospital') || is_method('add_lab'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/organisations', 'assets/scripts/donations');
        }


        if (is_controller('Organisations') && (is_method('indexBloodBankAddEdit'))) {
            array_push($script_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/scripts/organisations');
        }

        if (is_controller('Organisations') && (is_method('indexHospitalAddEdit'))) {
            array_push($script_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/scripts/organisations');
        }

        if (is_controller('Organisations') && (is_method('indexlabsAddEdit'))) {
            array_push($script_arr, 'assets/plugins/daterangepicker/daterangepicker', 'assets/scripts/organisations');
        }

        if (is_controller('Settings') && is_method('indexSettingsBloodGroups')) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/bloodgroups');
        }

        if (is_controller('Settings') && is_method('indexSettingsBagsTypes')) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/bagtypes');
        }


        if (is_controller('Settings') && is_method('indexSettingsTTLTypes')) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/ttltypes');
        }

        if (is_controller('Settings') && is_method('indexSettingsComponentTypes')) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/componenttypes');
        }

        if (is_controller('Settings') && is_method('indexSettingsDonationTypes')) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donationtypes');
        }

        if (is_controller('Settings') && is_method('indexSettingsDonarTypes')) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donartypes');
        }

        if (is_controller('Settings') && is_method('indexSettingsOrganisationTypes')) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/organisationtypes');
        }

        if (is_controller('Settings') && is_method('indexSettingsDiagnosisTypes')) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/diagnosistypes');
        }

        if (is_controller('Settings') && is_method('indexSettingsCoombsMethods')) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/coombsmethods');
        }


        if (is_controller('Settings') && is_method('indexSettingsCampCodes')) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/campcodes');
        }
        if (is_controller('Settings') && is_method('indexagency')) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/campcodes');
        }

        if (is_controller('Settings') && is_method('indexSettingsReturnReason')) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/returnreason');
        }

        if (is_controller('Settings') && is_method('indexSettingsDiscardReason')) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/discardreason');
        }

        if (is_controller('Settings') && is_method('indexSettingsRequestDateStatus')) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/requestdatestatus');
        }

        if (is_controller('Settings') && (is_method('indexSettingsStates') || is_method('indexSettingsDistricts') || is_method('indexSettingsCities') || is_method('indexSettingsGoogle_api'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/states');
        }


        if (is_controller('Donation') && (is_method('indexAppointments'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }

        if (is_controller('Donation') && (is_method('indexForm')) || (is_method('examination'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }

        if (is_controller('Organisations') && (is_method('donation_forms'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/organisations');
        }

        if (is_controller('Organisations') && (is_method('donation_Appointments'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/organisations');
        }
        if (is_controller('Organisations') && (is_method('deferred_donor'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/organisations', 'assets/scripts/donations');
        }

        if (is_controller('Organisations') && (is_method('ttitest'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/organisations', 'assets/scripts/donations');
        }

        if (is_controller('Organisations') && (is_method('components'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/organisations');
        }

        if (is_controller('Organisations') && (is_method('bloodstock'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/organisations', 'assets/scripts/donations');
        }
        if (is_controller('Organisations') && (is_method('discard'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/organisations');
        }

        if (is_controller('Donation') && (is_method('indexDeferred'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }

        if (is_controller('Donation') && (is_method('deferred_request'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }

        if (is_controller('Donation') && (is_method('indexttitest'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }
        if (is_controller('Donation') && (is_method('indexdiscard'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }

        if (is_controller('Donation') && (is_method('indexconsumables_items'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }
        if (is_controller('Donation') && (is_method('indexmanufactures'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }

        if (is_controller('Donation') && (is_method('indexconsumables_types'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }
        if (is_controller('Donation') && (is_method('indexbloodbank_user_role'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }

        if (is_controller('Donation') && (is_method('indexbloodbank_user'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }

        if (is_controller('Donation') && (is_method('indexconsumables_recive'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }
        if (is_controller('Donation') && (is_method('indexinvcomponents'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }

        if (is_controller('Donation') && (is_method('qc_reagents'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }

        if (is_controller('Donation') && (is_method('qc_blood_components'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }

        if (is_controller('Donation') && (is_method('all_qc_reagents'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }

        if (is_controller('Donation') && (is_method('all_qc_blood_components'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }
        if (is_controller('Donation') && (is_method('indexbloodstock'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }
        if (is_controller('Donation') && (is_method('indexconsumable'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }
        if (is_controller('Donation') && (is_method('indexbloodcamps'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }
        if (is_controller('Donation') && (is_method('blood_appointment'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }

        if (is_controller('Donation') && (is_method('request_form'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }

        if (is_controller('Donation') && (is_method('cross_match'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }
        if (is_controller('Donation') && (is_method('cross_match_add'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }
        if (is_controller('Donation') && (is_method('issue_blood'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }
        if (is_controller('Donation') && (is_method('blood_return'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }
        if (is_controller('Donation') && (is_method('request_form_add'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }
        if (is_controller('Donation') && (is_method('indexblood_records'))) {
            array_push($script_arr, 'assets/plugins/datatables/jquery.dataTables.min', 'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min', 'assets/plugins/datatables-responsive/js/dataTables.responsive.min', 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min', 'assets/scripts/donations');
        }
        add_script($script_arr);
    }

    public function body_class($class)
    {
        if (is_controller('Accounts') && is_method('index')) {
            return 'page-wrapper full-page';
        } else {
            return 'page-wrapper';
        }
    }
}


// Always instantiate the class so trigger get registered.
$theme_class = new Theme_class;
