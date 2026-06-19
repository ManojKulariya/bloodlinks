jQuery(function($) {
  'use strict';


   $('#form_login').validate({
    rules:{
      cust_username:{
        required:true
      },
      cust_password:{
        required:true
      }
    },
    messages:{
      cust_username:{
        required:'Enter username'
      },
      cust_password:{
        required:'Enter password'
      }
    },
    errorElement: 'label',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-row').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
    submitHandler:function(){
      var formData=new FormData($('#form_login')[0]);
      formData.append([csrf_name],csrf_hash);

      $.ajax({
        type:'POST',
        url:login_url,
        data:formData,
        cache: false,
        contentType: false,
        processData: false,
        timeout: 60000000,
        beforeSend:function(){
          $('#btn_sign_in').html('<span class="fa fa-circle-o-notch fa-sm" role="status" aria-hidden="true"></span>').prop('disabled',true);
        },
        success:function(d){

          if(d.success){

            window.location.href=d.redirect;
            
          }else{

            alert(d.error);

            $('#btn_sign_in').html('Sign IN').prop('disabled',false);
          }
        },
        error: function( jqXhr ) {
          //alert(jqXhr)
          if( jqXhr.status == 400 ) {
              alert('Request forbidden');
              window.location.reload();
          }else if( jqXhr.status == 403 ) {
              alert('Request forbidden');
              window.location.reload();
          }

 
          $('#btn_sign_in').html('Sign IN').prop('disabled',false);
        },
        complete:function(status,xhr){
        }

      });
    }
  });

});