<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


  <div class="login-logo">
    <a href="<?php echo $base_url;?>"><img src="<?php echo $logo_image;?>" width="200px" height="50px"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <!-- <p class="login-box-msg">Sign in to start your session</p> -->

      <form role="form" id="form_backend_login" method="post">
        <div class="form-group">
          <input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="off">
        </div>
        <div class="form-group">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-danger btn-block" id="btn_login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>


<script type="text/javascript">
  var login_url='<?php echo $base_url;?>/login';
</script>