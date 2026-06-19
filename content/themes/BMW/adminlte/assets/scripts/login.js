jQuery(function($) {
  'use strict';


  $('#form_backend_login').validate({
    rules:{
      username:{
        required:true,
        email:true
      },
      password:{
        required:true,
        minlength:8,
        maxlength:16,
        pwcheck:true
      }
    },
    messages:{
       username:{
        required:'Please enter your username',
      },
      password:{
        required:'Please enter your password',
        minlength:'Minimum 8 characters required',
        maxlength:'Maximum 16 characters allowed'
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
    submitHandler:function(){
      var formData=new FormData($('#form_backend_login')[0]);
      formData.append([csrf_name],csrf_hash);

      $.ajax({
        type:'POST',
        url:login_url,
        data: formData,
        dataType:'json',
        cache: false,
        contentType: false,
        processData: false,
        timeout: 60000000,
        beforeSend:function(){
          $('#username').prop('disabled',true);
          $('#password').prop('disabled',true);
          $('#btn_login').html('<span class="fa fa-circle-o-notch fa-sm" role="status" aria-hidden="true"></span>').prop('disabled',true);
        },
        success:function(d,status,xhr){

          if(d.success){

            setTimeout(function(){               
              $('#btn_login').html(d.success).prop('disabled',true);
              window.location.href=d.redirect;
            },1200);
            
          }else{

            Toast.fire({
              icon: 'error',
              title: d.error
            })

            $('#username').prop('disabled',false);
            $('#password').prop('disabled',false);
            $('#btn_login').html('Sign In').prop('disabled',false);
          }
        },
        error: function( jqXhr ) {
          //alert(jqXhr)
          if( jqXhr.status == 400 ) {
              Toast.fire({
                icon: 'info',
                title: 'Request url not found'
              })
              window.location.reload();
          }else if( jqXhr.status == 403 ) {
              Toast.fire({
                icon: 'info',
                title: 'Request url not found'
              })
              window.location.reload();
          }

          $('#username').prop('disabled',false);
          $('#password').prop('disabled',false);


          $('#btn_login').html('Login').prop('disabled',false);
        },
        complete:function(status,xhr){
         // $('#btn_submit').html('Sign In');
        }
      });
    }
  });

});