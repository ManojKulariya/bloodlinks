jQuery(function($) {
  'use strict';

  $.validator.addMethod("valueNotEquals", function(value, element, arg){
    return arg !== value;
  }, "Value must not equal arg.");

  jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[\w.]+$/i.test(value);
  }, "Letters, numbers, and underscores only please");

  //Universities
  $('#university_list_table').DataTable({ 
      'bJQueryUI': false,
      'stateSave': true,
      'iDisplayLength':50,
      'responsive': true,
      "pagingType": "full_numbers",
      'language': {
        'paginate': {
          'first': "<<", // This is the link to the first page
          'previous': "<", // This is the link to the previous page
          'next': ">", // This is the link to the next page
          'last': ">>" // This is the link to the last page
        }
      },
      "lengthMenu": [[10,25,50,100,250,500,1000,1500], [10,25,50,100,250,500,1000,1500]],
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": base_url+'/institutions/universities/search',
          "type": "POST",
          "data":{csrf_test_name:csrf_hash}
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { 
          "targets": [ 0 ], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ],
  });


  $('#form_university').validate({
    rules:{
      university_state:{
        valueNotEquals: "0" 
      },
      university_city:{
        valueNotEquals: "0" 
      },
      university_name:{
        required:true
      },
      university_email:{
        required:true,
        email:true
      },
      university_phone:{
        required:true
      },
      university_estd:{
        required:true,
        digits: true,
        minlength:4,
        maxlength:4
      },
      university_type:{
        valueNotEquals: "0"
      }
    },
    messages:{
      university_state:{
        valueNotEquals: "Please select state" 
      },
      university_city:{
        valueNotEquals: "Please select city" 
      },
      university_name:{
        required:"Please enter University name"
      },
      university_email:{
        required:"Please enter University email address",
        email:"Email address is not valid"
      },
      university_phone:{
        required:"Please enter university Phone No."
      },
      university_estd:{
        required:"Please enter Estd. year",
        digits: "Only numeric value allowed",
        minlength:"Estd. Year must be 4 digit long",
        maxlength:"Estd. Year must be 4 digit long",
      },
      university_type:{
        valueNotEquals: "Please enter University type"
      },
      college_university:{
        valueNotEquals: "Please select University" 
      }
    },
    submitHandler:function(){
      $.ajax({
          type:'POST',
          url:base_url+'/institutions/universities/save_university',
          data:new FormData($('#form_university')[0]),
          cache: false,
          contentType: false,
          processData: false,
          timeout: 60000000,
          target: '.preview',
          beforeSend:function(){
            $('#btn_save_university').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Saving...</span>').prop('disabled',true);
          },
          success:function(f){
            if(f.success){
             $('#btn_save_university').html('Save').prop('disabled',true);
              Swal.fire({
                icon: 'success',
                title: f.success,
                confirmButtonText:'Close',
                confirmButtonColor:'#69da68',
                allowOutsideClick: false,
              });           
            }else if(f.error){
              $('#btn_save_university').html('Save').prop('disabled',true);
              Swal.fire({
                icon: 'error',
                title: f.error,
                confirmButtonText:'Close',
                confirmButtonColor:'#69da68',
                allowOutsideClick: false,
              });
            }else if(f.redirect){
              $('#btn_save_university').html('Your session expired').prop('disabled',true);
            }
          },
          xhr: function(){
              //Get XmlHttpRequest object
               var xhr = $.ajaxSettings.xhr() ;
              //Set onprogress event handler
               xhr.upload.onprogress = function(data){
                  var perc =(data.loaded / data.total) * 100;// Math.round((data.loaded / data.total) * 100);
                  $('.progress-bar').css('width',perc.toFixed(2) + '%').text(perc.toFixed(2) + '%');
               };
               return xhr ;
          },
          error: function (e) {
          },
          complete:function(status,xhr){
            $('.progress-bar').css('width', '0%').text('0%');
            $('#btn_save_university').html('Save').attr('disabled',false);
          },
          resetForm: true 
        });
    }
  });


  $('body').on('click','.btn_del_university',function(){
    let _university=$(this).attr('data-aid');

    Swal.fire({
      title: "Do you want to delete the University?",
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#69da68',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value){
        $.ajax({
          type:'POST',
          url:base_url+'/institutions/universities/delete_university',
          data:{_university:_university,csrf_test_name:csrf_hash},
          beforeSend:function(){

          },
          success:function(d){
            if(d.success){
              Swal.fire({
                icon: 'success',
                title: d.success,
                confirmButtonText:'Close',
                confirmButtonColor:'#69da68',
                allowOutsideClick: false,
              });
              var table=$('#university_list_table').DataTable();
              table.ajax.reload( null, false );
            }else{
              Swal.fire({
                icon: 'error',
                title: d.error,
                confirmButtonText:'Close',
                confirmButtonColor:'#69da68',
                allowOutsideClick: false,
              });
            }
          }
        });
      }
    });
  });

  $('body').on('change','#university_country',function(){
    let country=$('#university_country :selected').val();

    let f_data  =   new Array(country);
    let ctext   =   CryptoJS.AES.encrypt(JSON.stringify(f_data), _xtYu, { format: CryptoJSAesJson }).toString();
    $.ajax({
      type:'POST',
      url:base_url+'/country/get_states',
      data:{ctext:ctext,listing_type:'1',csrf_test_name:csrf_hash},
      success:function(d){
        $('#university_state').html(d.html);
      }
    });
    load_statuetorybodies(country);
  });

  $('body').on('change','#university_state',function(){
    let country = $('#university_country :selected').val();
    let state   = $('#university_state :selected').val();
    let city    = $('#university_city :selected').val();
    let f_data  =   new Array(country,state);
    let ctext   =   CryptoJS.AES.encrypt(JSON.stringify(f_data), _xtYu, { format: CryptoJSAesJson }).toString();
    $.ajax({
      type:'POST',
      url:base_url+'/country/get_cities',
      data:{ctext:ctext,csrf_test_name:csrf_hash},
      success:function(d){
        $('#university_city').html(d.html);
      }
    });
    load_districts(country,state);
  });

  $('body').on('change','#university_city',function(){
    let country = $('#university_country :selected').val();
    let state   = $('#university_state :selected').val();
    let city    = $('#university_city :selected').val();
    load_university(country,state,city);
  });


  $('body').on('click','.btn_create_slug',function(){
    var data_value_id=$(this).attr('data-value_id');
    var data_type=$(this).attr('data-type')
    $.ajax({
      type:'POST',
      url:base_url+'/institutions/save_slug',
      data:{csrf_test_name:csrf_hash,data_value_id:data_value_id,data_type:data_type},
      beforeSend:function(){
          $(this).prop('disabled',true);
          $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Saving...</span>').prop('disabled',true);
      },
      success:function(d){
        if(d.success){
          var table=$('#university_list_table').DataTable();
          table.ajax.reload( null, false );          
        }
      }
    });
  });

  function load_districts(country,state){
    let f_data  =   new Array(country,state);
    let ctext   =   CryptoJS.AES.encrypt(JSON.stringify(f_data), _xtYu, { format: CryptoJSAesJson }).toString();
    $.ajax({
      type:'POST',
      url:base_url+'/country/get_districts',
      data:{ctext:ctext,csrf_test_name:csrf_hash},
      success:function(d){
        $('#university_district').html(d.html);
      }
    });
  }


  $('.file-upload-browse').on('click', function(e) {
    var file = $(this).parent().parent().parent().find('.file-upload-default');
    file.trigger('click');
       
  });
  // $('body').on('change','#university_logo', function(e) {
  //   $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
  //    var fileExtension = ['jpg','jpeg','png'];
  //   checkFile(fileExtension,$(this),e,$('#btn_save_university'));
  // });

  $("#university_logo").change(function (e) {
      var fileExtension = ['jpg','jpeg','png'];
      checkFile(fileExtension,$(this),e,$('#btn_save_university'));
  });


  // $("#_university_country").chosen({no_results_text: "Select Country"});
  // $("#_university_state").chosen({no_results_text: "Select State/Province"});
  // $("#_university_city").chosen({no_results_text: "Select District"});



  $('body').on('change','#_university_country',function(){
    let country=$('#_university_country :selected').val();

    let f_data  =   new Array(country);
    let ctext   =   CryptoJS.AES.encrypt(JSON.stringify(f_data), _xtYu, { format: CryptoJSAesJson }).toString();
    $.ajax({
      type:'POST',
      url:base_url+'/country/get_states',
      data:{ctext:ctext,listing_type:'1',csrf_test_name:csrf_hash},
      success:function(d){
        $('#_university_state').html(d.html);
      }
    });
  });

  $('body').on('change','#_university_state',function(){
    let country = $('#_university_country :selected').val();
    let state   = $('#_university_state :selected').val();
    let f_data  =   new Array(country,state);
    let ctext   =   CryptoJS.AES.encrypt(JSON.stringify(f_data), _xtYu, { format: CryptoJSAesJson }).toString();
    $.ajax({
      type:'POST',
      url:base_url+'/country/get_cities',
      data:{ctext:ctext,csrf_test_name:csrf_hash},
      success:function(d){
        $('#_university_city').html(d.html);
      }
    });
  });


  $('#form_university_quick_upload').validate({
    rules:{
      _university_type:{
        valueNotEquals:'0'
      },
      university_name:{
        required:true
      },
      university_short_name:{
        required:true
      },
      university_estd:{
        required:true,
        digits:true,
        maxlength:4,
        minlength:4
      },
      _university_country:{
        valueNotEquals:'0'
      },
      _university_state:{
        valueNotEquals:'0'
      },
      _university_city:{
        valueNotEquals:'0'
      },
      university_pincode:{
        required:true
      },
      university_address:{
        required:true
      }
    },
    messages:{
       _university_type:{
        valueNotEquals:'Select University Type'
      },
      university_name:{
        required:'Enter University Name'
      },
      university_short_name:{
        required:'Enter University Short Name'
      },
      university_estd:{
        required:'Enter Estd. Year',
        digits:'Only numeric value allowed',
        maxlength:'Maximum 4 digits allowed',
        minlength:'Minimum 4 digits allowed'
      },
      _university_country:{
        valueNotEquals:'Select Country'
      },
      _university_state:{
        valueNotEquals:'Select State'
      },
      _university_city:{
        valueNotEquals:'Select City'
      },
      university_pincode:{
        required:'Enter Pincode'
      },
      university_address:{
        required:'Enter address'
      }
    },
    submitHandler:function(){
      $.ajax({
        type:'POST',
        url:base_url+'/institutions/universities/save_university_quick',
        data: $('#form_university_quick_upload').serialize(),
        beforeSend:function(){
            $('#btn_update_university_quick').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Saving...</span>').prop('disabled',true);
        },
        success:function(f){
          if(f.success){
             $('#btn_update_university_quick').html('Save').prop('disabled',false);
              Swal.fire({
                icon: 'success',
                title: f.success,
                confirmButtonText:'Close',
                confirmButtonColor:'#69da68',
                allowOutsideClick: false,
              });  
              var table=$('#university_list_table').DataTable();
              table.ajax.reload( null, false );          
            }else if(f.error){
             //$('#btn_update_university_quick').html('Save').prop('disabled',true);
              Swal.fire({
                icon: 'error',
                title: f.error,
                confirmButtonText:'Close',
                confirmButtonColor:'#69da68',
                allowOutsideClick: false,
              });
            }else if(f.redirect){
              $('#btn_update_university_quick').html('Your session expired').prop('disabled',true);
            }
        }
      });
    }
  });

  function checkFile(fileExtension,control,e,btn_control){
 
    if ($.inArray(control.val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        Swal.fire({
          icon: 'error',
          //title: "Only formats are allowed : "+fileExtension.join(', '),
          title: "Oops! Incorrect format. Only ("+fileExtension.join(', ')+") file is allowed.",
          confirmButtonText:'Close',
          confirmButtonColor:'#d33',
          allowOutsideClick: false,
        });
    }else{
      if(e.target.files[0].size<=3100000){
        control.next('div.file-select-name').html(e.target.files[0].name);
        btn_control.prop('disabled', false);
      }else{
        Swal.fire({
          icon: 'error',
          title: 'File size of '+FileZise(e.target.files[0].size)+' is violating the allowed file size of '+FileZise(3100000),
          confirmButtonText:'Close',
          confirmButtonColor:'#69da68',
          allowOutsideClick: false,
        });
        btn_control.prop('disabled', true);
      }    
    }
  }


  function FileZise(bytes, si) {
    var thresh = si ? 1000 : 1024;
    if(Math.abs(bytes) < thresh) {
        return bytes + ' B';
    }
    var units = si
        ? ['KB','MB','GB','TB','PB','EB','ZB','YB']
        : ['KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB'];
    var u = -1;
    do {
        bytes /= thresh;
        ++u;
    } while(Math.abs(bytes) >= thresh && u < units.length - 1);
    return bytes.toFixed(1)+' '+units[u];
  }

});