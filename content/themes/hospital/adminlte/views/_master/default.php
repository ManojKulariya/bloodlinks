<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo $favicon_image;?>">
  <script type="text/javascript">
    var csrf_name='<?php echo $csrf['name'];?>';
    var csrf_hash='<?php echo $csrf['hash'];?>';
  </script>
 
  <?php echo @$css_files; ?>
</head>
  <body class="hold-transition <?php echo (session_userdata('isHospitalLoggedin'))?'sidebar-mini layout-fixed':'login-page';?>">
    <div class="<?php echo (session_userdata('isHospitalLoggedin'))?'wrapper':'login-box';?>">
     <!--  -->
      <?php echo @$layout;?>
    </div>

    <?php echo @$js_files;?>
  </body>

  
</html>