jQuery(function($) {
  'use strict';


  load_states();

  $('body').on('change','#select_states',function(){
    var state_id=$('#select_states :selected').val();
    var district_id=$('#select_districts :selected').val();    
    load_district(state_id);
    load_cities(state_id,district_id);
  });

  $('body').on('change','#select_districts',function(){
    var state_id=$('#select_states :selected').val();
    var district_id=$('#select_districts :selected').val();
    load_cities(state_id,district_id);
  });


  $('#fomr_register').validate({
    rules:{
      cust_first_name:{
        required:true
      },
      cust_last_name:{
        required:true
      },
      cust_email:{
        required:true,
        email:true
      },
      cust_ph:{
        required:true
      },
      cust_age:{
        required:true,
        digits:true
      },
      cust_gender:{
        valueNotEquals:'0'
      },
      cust_blood_group:{
        valueNotEquals:'0'
      },
      cust_states:{
        valueNotEquals:'0'
      },
      cust_districts:{
        valueNotEquals:'0'
      },
      cust_cities:{
        valueNotEquals:'0'
      },
      cust_pincode:{
        required:true
      },
       cust_username:{
        required:true
      },
      cust_address:{
        required:true
      },
      cust_password:{
        required:true,
        pwcheck:true
      },
      cust_conf_password:{
        equalTo:'#cust_password'
      }
    },
    messages:{
      cust_first_name:{
        required:'Enter first name'
      },
      cust_last_name:{
        required:'Enter last name'
      },
      cust_email:{
        required:'Enter email address',
        email:'Email address is not valid'
      },
      cust_ph:{
        required:'Enter phone number'
      },
      cust_age:{
        required:'Enter age',
        digits:'Only numeric value allowed'
      },
      cust_gender:{
        valueNotEquals:'Select gender'
      },
      cust_blood_group:{
        valueNotEquals:'Select blood group'
      },
      cust_states:{
        valueNotEquals:'Select state you live in'
      },
      cust_districts:{
        valueNotEquals:'Select district you live in'
      },
      cust_cities:{
        valueNotEquals:'Select city you live in'
      },
      cust_pincode:{
        required:'Enter pincode'
      },
      cust_address:{
        required:'Enter your address'
      },
      cust_username:{
        required:'Enter your Username'
      },
      cust_password:{
        required:'Enter password'
      },
      cust_conf_password:{
        equalTo:'Confirm password not matched'
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
      var formData=new FormData($('#fomr_register')[0]);
      formData.append([csrf_name],csrf_hash);
// alert(register_url);return false;

      $.ajax({
        type:'POST',
        url:register_url,
        data:formData,
        cache: false,
        contentType: false,
        processData: false,
        timeout: 60000000,
        beforeSend:function(){
          $('#btn_sign_up').html('<span class="fa fa-circle-o-notch fa-sm" role="status" aria-hidden="true"></span>').prop('disabled',true);
        },
        success:function(d){
          // location.href = 'https://www.javascripttutorial.net/';
           //alert("base_url");
           // window.location.href=d.redirect;
          // console.log(d); 
           //return false;
          if(d.success){
            $('#btn_sign_up').html('Sign UP').prop('disabled',false);

            $('#fomr_register')[0].reset();

            $('#success_div').css('display','block');
            //window.scrollTo(0, 0);
            window.location.href=d.redirect;
          
          }else{

           alert(d.error);

            $('#btn_sign_up').html('Sign UP').prop('disabled',false);
          }
        },
        error: function( jqXhr ) {
          //alert(jqXhr)
            // window.location.href = "http://jquery4u.com";
          if( jqXhr.status == 400 ) {
              alert('Request forbidden');
              window.location.reload();
          }else if( jqXhr.status == 403 ) {
              alert('Request forbidden');
              window.location.reload();
          }

 
          $('#btn_add_college').html('Submit').prop('disabled',false);
        },
        complete:function(status,xhr){
        }

      });
    }
  });

});