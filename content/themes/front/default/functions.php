<?php defined('BASEPATH') OR exit('No direct script access allowed');


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


    public function styles(){

        $style_arr=array(
            'assets/dist/css/bootstrap.min',
            'assets/dist/css/main',
            'assets/dist/css/responsive',
            'assets/dist/css/slick',
            'assets/dist/css/slick-theme',
            'assets/dist/css/owl.carousel.min',
            'assets/dist/css/owl.theme.default.min',
            'assets/dist/css/meanmenu',
            'assets/dist/css/header',
            'assets/dist/css/nice-select.min',
            'assets/stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
            'assets/dist/css/custom',
        );

      

        add_style($style_arr);
    }


    public function scripts(){
        $script_arr=array(
            'assets/dist/js/jquery.min.js',            
            'assets/dist/js/bootstrap.min',
            'assets/dist/js/jquery.meanmenu',
            'assets/dist/js/jquery.nice-select.min',
            'assets/cdnjs.cloudflare.com/ajax/libs/superfish/1.7.4/superfish.min',            
            'assets/dist/js/custom',
            'assets/dist/js/slick.min',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
            'assets/dist/js/jquery-validation/jquery.validate.min',
            'assets/dist/js/jquery-validation/additional-methods.min',
            'assets/scripts/common'
        );
    if (is_controller('Donation') && (is_method('add_bloodbank') || is_method('add_hospital') || is_method('add_lab')))
        {
           array_push($script_arr,'assets/plugins/datatables/jquery.dataTables.min','assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min','assets/plugins/datatables-responsive/js/dataTables.responsive.min','assets/plugins/datatables-responsive/js/responsive.bootstrap4.min','assets/scripts/organisations');
        }

      

        if (is_controller('Account') && (is_method('indexPreregister'))){
            array_push($script_arr,'assets/scripts/preregister');
        }

        if (is_controller('Account') && (is_method('indexRegister'))){
            array_push($script_arr,'assets/scripts/register');
        }

        if (is_controller('Account') && (is_method('indexLogin'))){
            array_push($script_arr,'assets/scripts/signin');
        }

        if (is_controller('Home')){
            array_push($script_arr,'assets/dist/js/owl.carousel');
        }

        if (is_controller('Donation') && (is_method('indexRequest'))){
            array_push($script_arr,'assets/scripts/donation_request');
        }

        add_script($script_arr);
    }

    public function body_class($class)
    {
        if (is_controller('Accounts') && is_method('index'))
        {
            return 'page-wrapper full-page';
        }
        else
        {
            return 'page-wrapper';
        }
    }

   
         
}


// Always instantiate the class so trigger get registered.
$theme_class = new Theme_class;