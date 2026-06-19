<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <?php
        $CI =& get_instance();

        $slug = trim($CI->uri->uri_string(), '/');

        $seo = $CI->db
            ->where('slug', $slug)
            ->where('status', 1)
            ->get('seo_meta')
            ->row();
        ?>

        <meta name="title" content="<?= !empty($seo->meta_title) ? $seo->meta_title : 'Find Blood Bank Near Me | Donate & Request Blood | BloodLinks'; ?>">

        <meta name="description" content="<?= !empty($seo->meta_description) ? $seo->meta_description : 'Find blood banks near me, donate blood & request blood across India. Locate hospitals & blood camps instantly. Download BloodLinks app now!'; ?>">

        <title><?= !empty($seo->meta_title) ? $seo->meta_title : Events::trigger('the_title', $title, 'string'); ?></title>
    <link rel="icon" href="<?php echo $favicon_image;?>">
    <?php
    $canonical_url = current_url();

    if (!empty($_SERVER['QUERY_STRING'])) {
        $canonical_url .= '?' . $_SERVER['QUERY_STRING'];
    }
    ?>

    <link rel="canonical" href="<?= $canonical_url; ?>" />
  	<?php echo @$metadata; ?>

  	<?php echo @$css_files; ?>
    <script type="text/javascript">
        var csrf_name='<?php echo $csrf['name'];?>';
        var csrf_hash='<?php echo $csrf['hash'];?>';
    </script>

    <?php echo @$js_files;?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ZG7MY75723"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-ZG7MY75723');
</script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
  	
	<body class="home">
		
		<div id="preloader">
	    	<span class="margin-bottom"><img src="<?php echo $loader_image;?>" style="height: 100px; width:100px;" alt=""></span>
		</div>

		<?php echo @$layout;?>

		
		<script type="text/javascript">
			// Mean Menu
            jQuery('.mean-menu').meanmenu({ 
                meanScreenWidth: "991"
            });
         
         
            // Header Sticky
            $(window).on('scroll', function() {
                if ($(this).scrollTop() >150){  
                    $('.navbar-area').addClass("is-sticky");
                }
                else{
                    $('.navbar-area').removeClass("is-sticky");
                }
            });
		</script>
	</body>
</html>