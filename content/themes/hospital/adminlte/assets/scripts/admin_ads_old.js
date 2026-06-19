jQuery(function($) {
  'use strict';

  // initializing inputmask
  $(":input").inputmask();

  // if ($(".js-example-basic-single").length) {
  //   $(".js-example-basic-single").select2();
  // }

  $.validator.addMethod("valueNotEquals", function(value, element, arg){
    return arg !== value;
  }, "Value must not equal arg.");



  $("#ads_package_streams").chosen({no_results_text: "Select Stream(s)"});
  $("#ads_package_client").chosen({no_results_text: "Select College"});
  $("#ads_package_client_country").chosen({no_results_text: "Select Country"});
  $("#ads_package_client_states").chosen({no_results_text: "Select State"});
  $("#ads_package_client_cities").chosen({no_results_text: "Select City"});
  $('#ads_width').chosen({no_results_text: "Select Width x Height"});
  $('#ads_package_category_type').chosen({no_results_text: "Select Category"});
  $('#ads_package_category').chosen({no_results_text: "Select Type"});
  $('#ads_package_type').chosen({no_results_text: "Select Position/Type"});
  $('#ads_embed_code_generate').chosen({no_results_text: "Select please"});
  //$("#ads_country").chosen({no_results_text: "Select Country"});

  $('#ads_list_table').DataTable({ 
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
          "url": base_url+'/ads/search',
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

  $('body').on('change','#ads_package_client_country',function(){
    var country_id=$('#ads_package_client_country :selected').val();
    
    $.ajax({
      type:'POST',
      url:base_url+'/country/get_colleges',
      data:{csrf_test_name:csrf_hash,country_id:country_id},
      success:function(d){
        if(d.html){
          $('#ads_package_client').html(d.html);
          $("#ads_package_client").trigger("chosen:updated");
        }
      }
    });

    let f_data  =   new Array(country_id);
    let ctext   =   CryptoJS.AES.encrypt(JSON.stringify(f_data), _xtYu, { format: CryptoJSAesJson }).toString();
    $.ajax({
      type:'POST',
      url:base_url+'/country/get_states',
      data:{ctext:ctext,listing_type:'1',csrf_test_name:csrf_hash},
      success:function(d){
        $('#ads_package_client_states').html(d.html);
        $("#ads_package_client_states").trigger("chosen:updated");
      }
    });
  });

  $('body').on('change','#ads_package_client_states',function(){
      var country_id=$('#ads_package_client_country :selected').val();
      var state_id=$('#ads_package_client_states :selected').val();
      let f_data  =   new Array(country_id,state_id);
      let ctext   =   CryptoJS.AES.encrypt(JSON.stringify(f_data), _xtYu, { format: CryptoJSAesJson }).toString();
      $.ajax({
        type:'POST',
        url:base_url+'/country/get_cities',
        data:{ctext:ctext,csrf_test_name:csrf_hash},
        success:function(d){
          $('#ads_package_client_cities').html(d.html);
          $("#ads_package_client_cities").trigger("chosen:updated");
        }
      });
  });

  

  $('body').on('change','#ads_package_type',function(){
    var v=$('#ads_package_type :selected').val();
    //alert(v);

    if(v=='0'){
      $('#ads_colleges_div_3').css('display','none');
      $('#ads_menu_type_div').css('display','none');
      $('#ads_name_div').css('display','block');
    }else if(v=='1'){
      $('#ads_colleges_div_3').css('display','none');
      $('#ads_menu_type_div').css('display','block');
      $('#ads_name_div').css('display','none');
    }else{
      $('#ads_colleges_div_3').css('display','block');
      $('#ads_menu_type_div').css('display','none');
      $('#ads_name_div').css('display','block');
    }
  });

  $('body').on('change','#ads_visibility',function(){
  	var selected=$('#ads_visibility :selected').val();

  	if(selected=='1'){
  		$('#ads_country_div').css('display','none');
  	}else if(selected=='2'){
  		$('#ads_country_div').css('display','block');
  	}
  });

  $('body').on('change','#ads_package_client_type',function(){
    var selected=$('#ads_package_client_type :selected').val();

    if(selected=='1'){
      $('#ads_colleges_div_1').css('display','block');
      $('#ads_colleges_div_2').css('display','none');
      $('#ads_colleges_div_3').css('display','none');
    }else if(selected=='2'){
      $('#ads_colleges_div_1').css('display','none');
      $('#ads_colleges_div_2').css('display','block');
      $('#ads_colleges_div_3').css('display','none');
    }else if(selected=='5'){
      $('#ads_colleges_div_1').css('display','none');
      $('#ads_colleges_div_2').css('display','block');
      $('#ads_colleges_div_3').css('display','block');
    }
  });

  $('body').on('change','#ads_country',function(){
    let country=$('#ads_country :selected').val();

    let f_data  =   new Array(country);
    let ctext   =   CryptoJS.AES.encrypt(JSON.stringify(f_data), _xtYu, { format: CryptoJSAesJson }).toString();
    $.ajax({
      type:'POST',
      url:base_url+'/country/get_states',
      data:{ctext:ctext,listing_type:'2',csrf_test_name:csrf_hash},
      success:function(d){
        $('#ads_state').html(d.html);
      }
    });
  });


  $('body').on('click','.btn_del_ads',function(){
    let _ads=$(this).attr('data-aid');

    Swal.fire({
      title: "Do you want to delete the Ads?",
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
          url:base_url+'/ads/delete',
          data:{_ads:_ads,csrf_test_name:csrf_hash},
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
              var table=$('#ads_list_table').DataTable();
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


  $('body').on('change','#ads_package_category_type',function(){
    var selected=$('#ads_package_category_type :selected').val();

    if(selected=='CUSTOM_IMG_ADS' || selected=='CUSTOM_HTML_ADS'){
      $('#ads_stream_div').css('display','block');
      $('#client_type_div').css('display','block');
      $('#other_div').css('display','block');
      $('#adsense_div').css('display','none');
      $('#ads_cost').prop('disabled',false);
      $("#ads_package_streams").val('').trigger("chosen:updated");       
      $("#ads_package_client").val('').trigger("chosen:updated"); 
      $("#ads_package_client_country").val('').trigger("chosen:updated"); 
      $("#ads_package_client_states").val('').trigger("chosen:updated"); 
      $("#ads_package_client_cities").val('').trigger("chosen:updated");
      $('#ads_package_streams_chosen').css('width','100%');
      $('#ads_package_client_chosen').css('width','100%');
      $('#ads_package_client_country_chosen').css('width','100%');
      $('#ads_package_client_states_chosen').css('width','100%');
      $('#ads_package_client_cities_chosen').css('width','100%');
    }else{
      $('#adsense_div').css('display','block');
      $('#ads_stream_div').css('display','none');
      $('#client_type_div').css('display','none');
      $('#other_div').css('display','none');
      $('#ads_cost').prop('disabled',true);
    }
  });


  $('body').on('change','#ads_height_width',function(){
    var height_width=$('#ads_height_width :selected').val();
    var ads_custom_code=$('#ads_custom_code').val();
    var txt='';

    var match = height_width.split('x');
    var width=match[0];
    var height=match[1];

    //alert(ads_custom_code)

    var t='style="display:inline-block;width:'+width+'px;height:'+height+'px"';

    if(t!='style="display:inline-block;width:728px;height:90px"'){
      txt=ads_custom_code.replace('style="display:inline-block;width:728px;height:90px"', 'style="display:inline-block;width:'+width+'px;height:'+height+'px"');
    }else{
      txt=ads_custom_code.replace(t, 'style="display:inline-block;width:'+width+'px;height:'+height+'px"');
    }

    

    if(txt){

    }

    $('#ads_custom_code').val(txt); 
  });


  $('#form_ads_add_edit').validate({
    rules:{
      ads_package_category_type:{
        valueNotEquals:'0'
      },
      ads_package_category:{
        valueNotEquals:'0'
      },
      ads_package_type:{
        valueNotEquals:'0'
      }
    },
    messages:{
      ads_package_category_type:{
        valueNotEquals:'Select Category'
      },
      ads_package_category:{
        valueNotEquals:'Select Type'
      },
      ads_package_type:{
        valueNotEquals:'Select Position'
      }
    },
    submitHandler:function(){
      $.ajax({
          type:'POST',
          url:base_url+'/ads/add_ads',
          data:new FormData($('#form_ads_add_edit')[0]),
          cache: false,
          contentType: false,
          processData: false,
          timeout: 60000000,
          target: '.preview',
          beforeSend:function(){
            $('#btn_save_ads').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Saving...</span>').prop('disabled',true);
          },
          success:function(f){
            if(f.success){
             $('#btn_save_ads').prop('disabled',true);
             Swal.fire({
                icon: 'success',
                title: f.success,
                confirmButtonText:'Close',
                confirmButtonColor:'#69da68',
                allowOutsideClick: false,
              });            
            }else if(f.error){
              $('#btn_save_ads').prop('disabled',true);
              Swal.fire({
                icon: 'error',
                title: f.error,
                confirmButtonText:'Close',
                confirmButtonColor:'#69da68',
                allowOutsideClick: false,
              });
            }else if(f.redirect){
              $('#btn_save_ads').prop('disabled',true);
              Swal.fire({
                icon: 'info',
                title: 'Your session expired',
                confirmButtonText:'Close',
                confirmButtonColor:'#69da68',
                allowOutsideClick: false,
              });
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
            $('#btn_save_ads').html('Save').attr('disabled',false);
          },
          resetForm: true 
      });
    }
  });


  $('.file-upload-browse').on('click', function(e) {
      var file = $(this).parent().parent().parent().find('.file-upload-default');
      file.trigger('click');
  });
  $('.file-upload-default').on('change', function() {
    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
  });


});