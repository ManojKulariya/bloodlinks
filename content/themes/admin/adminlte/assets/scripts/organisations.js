jQuery(function($) {
  'use strict';
 if($('#table_user').length>0){

    $('#table_user').DataTable({ 
      'bJQueryUI': false,
      'stateSave': true,
      'iDisplayLength':10,
      'responsive': true,
      "pagingType": "full_numbers",
      "rowReorder":false,
      'language': {
        'paginate': {
          'first': "<<", // This is the link to the first page
          'previous': "<", // This is the link to the previous page
          'next': ">", // This is the link to the next page
          'last': ">>" // This is the link to the last page
        }
      },
      "lengthMenu": [[10,25,50,100,250,500], [10,25,50,100,250,500]],
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      // Load data for the table's content from an Ajax source
      "ajax": {
          "url":apppointment_search,
          "type": "POST",
          "data":{[csrf_name]:csrf_hash}
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { 
          "targets": [0,5], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }

   if($('#table_alldeferred_donor').length>0){

    $('#table_alldeferred_donor').DataTable({ 
      'bJQueryUI': false,
      'stateSave': true,
      'iDisplayLength':10,
      'responsive': true,
      "pagingType": "full_numbers",
      "rowReorder":false,
      'language': {
        'paginate': {
          'first': "<<", // This is the link to the first page
          'previous': "<", // This is the link to the previous page
          'next': ">", // This is the link to the next page
          'last': ">>" // This is the link to the last page
        }
      },
      "lengthMenu": [[10,25,50,100,250,500], [10,25,50,100,250,500]],
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      // Load data for the table's content from an Ajax source
      "ajax": {
          "url":apppointment_search,
          "type": "POST",
          "data":{[csrf_name]:csrf_hash}
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { 
          "targets": [0,10], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }
  
if($('#table_allbloodstock').length>0){

    $('#table_allbloodstock').DataTable({ 
      'bJQueryUI': false,
      'stateSave': true,
      'iDisplayLength':10,
      'responsive': true,
      "pagingType": "full_numbers",
      "rowReorder":false,
      'language': {
        'paginate': {
          'first': "<<", // This is the link to the first page
          'previous': "<", // This is the link to the previous page
          'next': ">", // This is the link to the next page
          'last': ">>" // This is the link to the last page
        }
      },
      "lengthMenu": [[10,25,50,100,250,500], [10,25,50,100,250,500]],
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      // Load data for the table's content from an Ajax source
      "ajax": {
          "url":apppointment_search,
          "type": "POST",
          "data":{[csrf_name]:csrf_hash}
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { 
          "targets": [0,10], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }


  if($('#table_role').length>0){

    $('#table_role').DataTable({ 
      'bJQueryUI': false,
      'stateSave': true,
      'iDisplayLength':10,
      'responsive': true,
      "pagingType": "full_numbers",
      "rowReorder":false,
      'language': {
        'paginate': {
          'first': "<<", // This is the link to the first page
          'previous': "<", // This is the link to the previous page
          'next': ">", // This is the link to the next page
          'last': ">>" // This is the link to the last page
        }
      },
      "lengthMenu": [[10,25,50,100,250,500], [10,25,50,100,250,500]],
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      // Load data for the table's content from an Ajax source
      "ajax": {
          "url":apppointment_search,
          "type": "POST",
          "data":{[csrf_name]:csrf_hash}
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { 
          "targets": [0,2], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }
  if($('#table_labs').length>0){

    $('#table_labs').DataTable({ 
      'bJQueryUI': false,
      'stateSave': true,
      'iDisplayLength':50,
      'responsive': true,
      "pagingType": "full_numbers",
      "rowReorder":false,
      'language': {
        'paginate': {
          'first': "<<", // This is the link to the first page
          'previous': "<", // This is the link to the previous page
          'next': ">", // This is the link to the next page
          'last': ">>" // This is the link to the last page
        }
      },
      "lengthMenu": [[10,25,50,100,250,500], [10,25,50,100,250,500]],
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": lab_search_url,
          "type": "POST",
          "data":{[csrf_name]:csrf_hash}
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { 
          "targets": [0,5], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  $('body').on('click','.btn_lab_bank',function(){
      var blood_bank_id=$(this).data('blood_bank_id');

       Swal.fire({   
          title: "Are you sure?",   
          text: "You will not be able retrieve the data later",   
          icon: 'warning',  
          showCancelButton: true,   
          confirmButtonColor: '#000000', 
          cancelButtonColor: '#f11026', 
          confirmButtonText: "Yes, delete",   
          cancelButtonText: "No, cancel",
          allowOutsideClick: false
      }).then((isConfirm)=>{


        if(isConfirm){
          $.ajax({
            type:'POST',
            url:lab_del_url,
            data:{[csrf_name]:csrf_hash,blood_bank_id:blood_bank_id},
            success:function(d){
              if(d.success){
                Toast.fire({
                  icon: 'success',
                  title: d.success
                });
              }else{
                Toast.fire({
                  icon: 'error',
                  title: d.error
                });
              }
            },
            complete:function(status,xhr){
              var table=$('#table_labs').DataTable();
              table.ajax.reload( null, false );
            }
          });
        }

      });
    });

  }

  

 
  if($('#table_hospitals').length>0){

    $('#table_hospitals').DataTable({ 
      'bJQueryUI': false,
      'stateSave': true,
      'iDisplayLength':50,
      'responsive': true,
      "pagingType": "full_numbers",
      "rowReorder":false,
      'language': {
        'paginate': {
          'first': "<<", // This is the link to the first page
          'previous': "<", // This is the link to the previous page
          'next': ">", // This is the link to the next page
          'last': ">>" // This is the link to the last page
        }
      },
      "lengthMenu": [[10,25,50,100,250,500], [10,25,50,100,250,500]],
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": hospital_search_url,
          "type": "POST",
          "data":{[csrf_name]:csrf_hash}
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { 
          "targets": [0,5], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  $('body').on('click','.btn_del_hospital',function(){
      var blood_bank_id=$(this).data('blood_bank_id');

       Swal.fire({   
          title: "Are you sure?",   
          text: "You will not be able retrieve the data later",   
          icon: 'warning',  
          showCancelButton: true,   
          confirmButtonColor: '#000000', 
          cancelButtonColor: '#f11026', 
          confirmButtonText: "Yes, delete",   
          cancelButtonText: "No, cancel",
          allowOutsideClick: false
      }).then((isConfirm)=>{


        if(isConfirm){
          $.ajax({
            type:'POST',
            url:hospital_del_url,
            data:{[csrf_name]:csrf_hash,blood_bank_id:blood_bank_id},
            success:function(d){
              if(d.success){
                Toast.fire({
                  icon: 'success',
                  title: d.success
                });
              }else{
                Toast.fire({
                  icon: 'error',
                  title: d.error
                });
              }
            },
            complete:function(status,xhr){
              var table=$('#table_hospitals').DataTable();
              table.ajax.reload( null, false );
            }
          });
        }

      });
    });

  }


  if($('#table_bloodbanks').length>0){

    $('#table_bloodbanks').DataTable({ 
      'bJQueryUI': false,
      'stateSave': true,
      'iDisplayLength':50,
      'responsive': true,
      "pagingType": "full_numbers",
      "rowReorder":false,
      'language': {
        'paginate': {
          'first': "<<", // This is the link to the first page
          'previous': "<", // This is the link to the previous page
          'next': ">", // This is the link to the next page
          'last': ">>" // This is the link to the last page
        }
      },
      "lengthMenu": [[10,25,50,100,250,500], [10,25,50,100,250,500]],
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": blood_banks_search_url,
          "type": "POST",
          "data":{[csrf_name]:csrf_hash}
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { 
          "targets": [0,5], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });

      $('body').on('click','.btn_del_blood_bank',function(){
      var blood_bank_id=$(this).data('blood_bank_id');

       Swal.fire({   
          title: "Are you sure?",   
          text: "You will not be able retrieve the data later",   
          icon: 'warning',  
          showCancelButton: true,   
          confirmButtonColor: '#000000', 
          cancelButtonColor: '#f11026', 
          confirmButtonText: "Yes, delete",   
          cancelButtonText: "No, cancel",
          allowOutsideClick: false
      }).then((isConfirm)=>{


        if(isConfirm){
          $.ajax({
            type:'POST',
            url:blood_banks_del_url,
            data:{[csrf_name]:csrf_hash,blood_bank_id:blood_bank_id},
            success:function(d){
              if(d.success){
                Toast.fire({
                  icon: 'success',
                  title: d.success
                });
              }else{
                Toast.fire({
                  icon: 'error',
                  title: d.error
                });
              }
            },
            complete:function(status,xhr){
              var table=$('#table_bloodbanks').DataTable();
              table.ajax.reload( null, false );
            }
          });
        }

      });
    });

  }

  if($('#table_blood_banks_files').length>0){

    $('#table_blood_banks_files').DataTable().destroy();

    $('#table_blood_banks_files').DataTable({ 
        'bJQueryUI': false,
        'stateSave': true,
        'iDisplayLength':50,
        'responsive': true,
        "pagingType": "full_numbers",
        "rowReorder":false,
        'language': {
          'paginate': {
            'first': "<<", // This is the link to the first page
            'previous': "<", // This is the link to the previous page
            'next': ">", // This is the link to the next page
            'last': ">>" // This is the link to the last page
          }
        },
        "lengthMenu": [[10,25,50,100,250,500], [10,25,50,100,250,500]],
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": file_search_url,
            "type": "POST",
            "data":{[csrf_name]:csrf_hash,data_id:blood_bank_id}
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0,3], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ]
      });

      
  }


  $(".org_state").select2({
    placeholder: "Select a state",
    allowClear: true
  });

  $(".org_districs").select2({
    placeholder: "Select a district",
    allowClear: true
  });

  $(".org_city").select2({
    placeholder: "Select a city",
    allowClear: true,
    tags: true
  });

 //Date range picker
  $('#org_lic_valid_from_date').datetimepicker({
      format: 'DD-MM-YYYY'
  });
  $('#org_lic_valid_to_date').datetimepicker({
      format: 'DD-MM-YYYY'
  });


  //State wise districts

  $('body').on('change','#org_state',function(){
    var state_id=$('#org_state :selected').val();
    var html='<option value="0">Select District</option>';
    $.ajax({
      type:'POST',
      url:dist_search_url,
      data:{[csrf_name]:csrf_hash,state_id:state_id},
      success:function(d){
        
        if(d!=''){
          $.each(d,function(i,v){
            html+='<option value="'+v['district_id']+'">'+v['district_name']+'</option>';
          });
        }

        $('#org_districs').html(html);
      }
    });

  });

  $('body').on('change','#org_districs',function(){
    var state_id=$('#org_state :selected').val();
    var district_id=$('#org_districs :selected').val();
    var html='<option value="0">Select City</option>';
    $.ajax({
      type:'POST',
      url:city_search_url,
      data:{[csrf_name]:csrf_hash,state_id:state_id,district_id:district_id},
      success:function(d){
        
        if(d!=''){
          $.each(d,function(i,v){
            html+='<option value="'+v['city_id']+'">'+v['city_name']+'</option>';
          });
        }

        $('#org_city').html(html);
      }
    });

  });

  //Basic data save
  $('#hospital_basic_detail').validate({

    rules:{
      org_name:{
        required:true,
        minlength:3
      },
      org_short_name:{
        required:true,
        minlength:3
      },
      org_category:{
        valueNotEquals:'0'
      },
      org_contact_name:{
        required:true,
        minlength:3
      },
      org_email:{
        required:true,
        email:true
      },
      org_ph_no:{
        required:true,
        digits:true,
        minlength:10
      },
      org_lic_no:{
        required:true
      },
      org_lic_valid_from:{
        required:true
      },
      org_lic_valid_to:{
        required:true
      },
      org_state:{
        valueNotEquals:'0'
      },
      org_districs:{
        valueNotEquals:'0'
      },
      org_city:{
        required:true
      },
      org_pincode:{
        required:true,
        digits:true
      },
      org_address1:{
        required:true
      }
    },
    messages:{
      org_name:{
        required:'Enter Hospital name'
      },
      org_short_name:{
        required:'Enter short name'
      },
      org_category:{
        valueNotEquals:'Select category'
      },
      org_contact_name:{
        required:'Enter contact person name'
      },
      org_email:{
        required:'Enter email address'
      },
      org_ph_no:{
        required:'Enter phone no'
      },
      org_lic_no:{
        required:'Enter licence No'
      },
      org_lic_valid_from:{
        required:'Enter licence valid from date'
      },
      org_lic_valid_to:{
        required:'Enter licence valid to date'
      },
      org_state:{
        valueNotEquals:'Select state'
      },
      org_districs:{
        valueNotEquals:'Select district'
      },
      org_city:{
        required:'Enter city'
      },
      org_pincode:{
        required:'Enter pincode'
      },
      org_address1:{
        required:'Enter address'
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

      var formData=new FormData($('#hospital_basic_detail')[0]);
      formData.append([csrf_name],csrf_hash);
      formData.append('data_tab','basic_details');
      formData.append('hospital_id',hospital_id)

       Swal.fire({   
          title: "Are you sure?",   
          text: "You will be able to edit this data later",   
          icon: 'warning',  
          showCancelButton: true,   
          confirmButtonColor: '#000000', 
          cancelButtonColor: '#f11026', 
          confirmButtonText: "Yes, register",   
          cancelButtonText: "No, cancel",
          allowOutsideClick: false
      }).then((isConfirm)=>{ 

      //console.log(isConfirm); 

        if (isConfirm) {

          // alert('hi');

          $.ajax({
            type:'POST',
            url:hospital_add_url,
            data:formData,
            dataType:'json',
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000000,
            beforeSend:function(){
              $('#btn_save_basic_details').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading').prop('disabled',true);
            },
            success:function(d,status,xhr){

              if(d.success){
                $('#btn_save_basic_details').html('<i class="fas fa-save fw"></i> Uploaded').prop('disabled',true);
                

                Toast.fire({
                  icon: 'success',
                  title: d.success
                });

                if(d.next_step){

                }

                setTimeout(function(){               
                  $('#btn_save_basic_details').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
                  if(d.redirect){
                    window.location.href=d.redirect;
                  }
                },1200);

                //$('#form_basic_details')[0].reset();
                
              }else{

                Toast.fire({
                  icon: 'error',
                  title: d.error
                })

               
                $('#btn_save_basic_details').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
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


              $('#btn_save_basic_details').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
            },
            complete:function(status,xhr){
             // $('#btn_submit').html('Sign In');
            }
          });

        }
      });

    }
  });

  //Basic data save
  $('#lab_basic_detail').validate({

    rules:{
      org_name:{
        required:true,
        minlength:3
      },
      org_short_name:{
        required:true,
        minlength:3
      },
      org_category:{
        valueNotEquals:'0'
      },
      org_contact_name:{
        required:true,
        minlength:3
      },
      org_email:{
        required:true,
        email:true
      },
      org_ph_no:{
        required:true,
        digits:true,
        minlength:10
      },
      org_lic_no:{
        required:true
      },
      org_lic_valid_from:{
        required:true
      },
      org_lic_valid_to:{
        required:true
      },
      org_state:{
        valueNotEquals:'0'
      },
      org_districs:{
        valueNotEquals:'0'
      },
      org_city:{
        required:true
      },
      org_pincode:{
        required:true,
        digits:true
      },
      org_address1:{
        required:true
      }
    },
    messages:{
      org_name:{
        required:'Enter Labs name'
      },
      org_short_name:{
        required:'Enter short name'
      },
      org_category:{
        valueNotEquals:'Select category'
      },
      org_contact_name:{
        required:'Enter contact person name'
      },
      org_email:{
        required:'Enter email address'
      },
      org_ph_no:{
        required:'Enter phone no'
      },
      org_lic_no:{
        required:'Enter licence No'
      },
      org_lic_valid_from:{
        required:'Enter licence valid from date'
      },
      org_lic_valid_to:{
        required:'Enter licence valid to date'
      },
      org_state:{
        valueNotEquals:'Select state'
      },
      org_districs:{
        valueNotEquals:'Select district'
      },
      org_city:{
        required:'Enter city'
      },
      org_pincode:{
        required:'Enter pincode'
      },
      org_address1:{
        required:'Enter address'
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

      var formData=new FormData($('#lab_basic_detail')[0]);
      formData.append([csrf_name],csrf_hash);
      formData.append('data_tab','basic_details');
      formData.append('lab_id',lab_id)

       Swal.fire({   
          title: "Are you sure?",   
          text: "You will be able to edit this data later",   
          icon: 'warning',  
          showCancelButton: true,   
          confirmButtonColor: '#000000', 
          cancelButtonColor: '#f11026', 
          confirmButtonText: "Yes, register",   
          cancelButtonText: "No, cancel",
          allowOutsideClick: false
      }).then((isConfirm)=>{ 

      //console.log(isConfirm); 

        if (isConfirm) {

          // alert('hi');

          $.ajax({
            type:'POST',
            url:lab_add_url,
            data:formData,
            dataType:'json',
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000000,
            beforeSend:function(){
              $('#btn_save_basic_details').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading').prop('disabled',true);
            },
            success:function(d,status,xhr){

              if(d.success){
                $('#btn_save_basic_details').html('<i class="fas fa-save fw"></i> Uploaded').prop('disabled',true);
                

                Toast.fire({
                  icon: 'success',
                  title: d.success
                });

                if(d.next_step){

                }

                setTimeout(function(){               
                  $('#btn_save_basic_details').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
                  if(d.redirect){
                    window.location.href=d.redirect;
                  }
                },1200);

                //$('#form_basic_details')[0].reset();
                
              }else{

                Toast.fire({
                  icon: 'error',
                  title: d.error
                })

               
                $('#btn_save_basic_details').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
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


              $('#btn_save_basic_details').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
            },
            complete:function(status,xhr){
             // $('#btn_submit').html('Sign In');
            }
          });

        }
      });

    }
  });
 //Basic data save
  $('#form_basic_details').validate({
    rules:{
      org_name:{
        required:true,
        minlength:3
      },
      org_short_name:{
        required:true,
        minlength:3
      },
      org_category:{
        valueNotEquals:'0'
      },
      org_contact_name:{
        required:true,
        minlength:3
      },
      org_email:{
        required:true,
        email:true
      },
      org_ph_no:{
        required:true,
        digits:true,
        minlength:10
      },
      org_lic_no:{
        required:true
      },
      org_lic_valid_from:{
        required:true
      },
      org_lic_valid_to:{
        required:true
      },
      org_state:{
        valueNotEquals:'0'
      },
      org_districs:{
        valueNotEquals:'0'
      },
      org_city:{
        required:true
      },
      org_pincode:{
        required:true,
        digits:true
      },
      org_address1:{
        required:true
      }
    },
    messages:{
      org_name:{
        required:'Enter blood bank name'
      },
      org_short_name:{
        required:'Enter short name'
      },
      org_category:{
        valueNotEquals:'Select category'
      },
      org_contact_name:{
        required:'Enter contact person name'
      },
      org_email:{
        required:'Enter email address'
      },
      org_ph_no:{
        required:'Enter phone no'
      },
      org_lic_no:{
        required:'Enter licence No'
      },
      org_lic_valid_from:{
        required:'Enter licence valid from date'
      },
      org_lic_valid_to:{
        required:'Enter licence valid to date'
      },
      org_state:{
        valueNotEquals:'Select state'
      },
      org_districs:{
        valueNotEquals:'Select district'
      },
      org_city:{
        required:'Enter city'
      },
      org_pincode:{
        required:'Enter pincode'
      },
      org_address1:{
        required:'Enter address'
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
//console.log(isConfirm); return false;
      var formData=new FormData($('#form_basic_details')[0]);
      formData.append([csrf_name],csrf_hash);
      formData.append('data_tab','basic_details');
      formData.append('blood_bank_id',blood_bank_id)

       Swal.fire({   
          title: "Are you sure?",   
          text: "You will be able to edit this data later",   
          icon: 'warning',  
          showCancelButton: true,   
          confirmButtonColor: '#000000', 
          cancelButtonColor: '#f11026', 
          confirmButtonText: "Yes, register",   
          cancelButtonText: "No, cancel",
          allowOutsideClick: false
      }).then((isConfirm)=>{ 

      //console.log(isConfirm); 

        if (isConfirm) {

          //alert('hi');

          $.ajax({
            type:'POST',
            url:blood_banks_add_url,
            data:formData,
            dataType:'json',
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000000,
            beforeSend:function(){
              $('#btn_save_basic_details').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading').prop('disabled',true);
            },
            success:function(d,status,xhr){

              if(d.success){
                $('#btn_save_basic_details').html('<i class="fas fa-save fw"></i> Uploaded').prop('disabled',true);
                

                Toast.fire({
                  icon: 'success',
                  title: d.success
                });

                if(d.next_step){

                }

                setTimeout(function(){               
                  $('#btn_save_basic_details').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
                  if(d.redirect){
                    window.location.href=d.redirect;
                  }
                },1200);

                //$('#form_basic_details')[0].reset();
                
              }else{

                Toast.fire({
                  icon: 'error',
                  title: d.error
                })

               
                $('#btn_save_basic_details').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
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


              $('#btn_save_basic_details').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
            },
            complete:function(status,xhr){
             // $('#btn_submit').html('Sign In');
            }
          });

        }
      });

    }
  }); 

  //Misc Details
  $('#form_mics_details').validate({
    rules:{
      org_tariff_name:{
        required:true
      },
      org_tariff_charge:{
        required:true,
        number:true
      },
      org_area_name:{
        required:true
      },
      org_area_usability:{
        required:true
      },
      org_area_room_no:{
        required:true
      },
      org_storage_name:{
        required:true
      },
      org_storage_type:{
        required:true
      },
      org_storage_area_name:{
        required:true
      },
      org_refreshment_name:{
        required:true
      },
      org_refreshment_quality:{
        required:true
      }
    },
    messages:{
      org_tariff_name:{
        required:'Enter tarrif name'
      },
      org_tariff_charge:{
        required:'Enter tarrif charge'
      },
      org_area_name:{
        required:'Enter area name'
      },
      org_area_usability:{
        required:'Enter area usability'
      },
      org_area_room_no:{
        required:'Enter room no'
      },
      org_storage_name:{
        required:'Enter storage name'
      },
      org_storage_type:{
        required:'Enter storage type'
      },
      org_storage_area_name:{
        required:'Enter storage area name'
      },
      org_refreshment_name:{
        required:'Enter refreshment name'
      },
      org_refreshment_quality:{
        required:'Enter refreshment quantity'
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

      var formData=new FormData($('#form_mics_details')[0]);
      formData.append([csrf_name],csrf_hash);
      formData.append('blood_bank_id',blood_bank_id);
      formData.append('data_tab','mics_details');

       Swal.fire({   
          title: "Are you sure?",   
          text: "You will be able to edit this data later",   
          icon: 'warning',  
          showCancelButton: true,   
          confirmButtonColor: '#000000', 
          cancelButtonColor: '#f11026', 
          confirmButtonText: "Yes, register",   
          cancelButtonText: "No, cancel",
          allowOutsideClick: false
      }).then((isConfirm)=>{ 


        if (isConfirm) {

          $.ajax({
            type:'POST',
            url:blood_banks_add_url,
            data:formData,
            dataType:'json',
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000000,
            beforeSend:function(){
              $('#btn_save_mics_details').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading').prop('disabled',true);
            },
            success:function(d,status,xhr){

              if(d.success){
                $('#btn_save_mics_details').html('<i class="fas fa-save fw"></i> Uploaded').prop('disabled',true);
                setTimeout(function(){               
                  $('#btn_save_mics_details').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
                },1200);

                Toast.fire({
                  icon: 'success',
                  title: d.success
                });

                if(d.next_step){

                }

                //$('#form_mics_details')[0].reset();
                
              }else{

                Toast.fire({
                  icon: 'error',
                  title: d.error
                })

               
                $('#btn_save_mics_details').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
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


              $('#btn_save_mics_details').html('Login').prop('disabled',false);
            },
            complete:function(status,xhr){
             // $('#btn_submit').html('Sign In');
            }
          });

        }
      });

    }
  });


  //Document Details
  $('#form_documents_details').validate({
    ignore: [],
    rules: {
      org_constitution_doc: {
        required: true,
        extension: 'pdf|jpeg|jpg|png',
        maxFileSize: {
          "unit": "KB",
          "size": '1000'
        }
      },
      org_pan_card: {
        required: true,
        extension: 'pdf|jpeg|jpg|png',
        maxFileSize: {
          "unit": "KB",
          "size": '1000'
        }
      },
      org_12_aa_doc: {
        required: true,
        extension: 'pdf|jpeg|jpg|png',
        maxFileSize: {
          "unit": "KB",
          "size": '1000'
        }
      },
      org_12_ab_doc: {
        required: true,
        extension: 'pdf|jpeg|jpg|png',
        maxFileSize: {
          "unit": "KB",
          "size": '1000'
        }
      },
      org_80_g_doc: {
        required: true,
        extension: 'pdf|jpeg|jpg|png',
        maxFileSize: {
          "unit": "KB",
          "size": '1000'
        }
      },
      org_lic_doc: {
        required: true,
        extension: 'pdf|jpeg|jpg|png',
        maxFileSize: {
          "unit": "KB",
          "size": '1000'
        }
      },
      org_competent_auth_doc: {
        required: true,
        extension: 'pdf|jpeg|jpg|png',
        maxFileSize: {
          "unit": "KB",
          "size": '1000'
        }
      },
      org_competent_person_doc: {
        required: true, 
        extension: 'pdf|jpeg|jpg|png',
        maxFileSize: {
          "unit": "MB",
          "size": '10000'
        }
      }
    },
    messages:{
      org_constitution_doc: {
        required: 'Select Constitution Document',
        extension: 'Only pdf,jpeg,jpg,png files are allowed'
      },
      org_pan_card: {
        required: 'Select Pancard',
        extension: 'Only pdf,jpeg,jpg,png files are allowed'
      },
      org_12_aa_doc: {
        required: 'Select 12 AA Document',
        extension: 'Only pdf,jpeg,jpg,png files are allowed'
      },
      org_12_ab_doc: {
        required: 'Select 12 AB Document',
        extension: 'Only pdf,jpeg,jpg,png files are allowed'
      },
      org_80_g_doc: {
        required: 'Select 80 G Document',
        extension: 'Only pdf,jpeg,jpg,png files are allowed'
      },
      org_lic_doc: {
        required: 'Select Blood Center License',
        extension: 'Only pdf,jpeg,jpg,png files are allowed'
      },
      org_competent_auth_doc: {
        required: 'Select Registration with Competent Authority Document',
        extension: 'Only pdf,jpeg,jpg,png files are allowed'
      },
      org_competent_person_doc: {
        required: 'Select Document Related Change in the Competent person',
        extension: 'Only pdf,jpeg,jpg,png files are allowed'
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

      var formData=new FormData($('#form_documents_details')[0]);
      formData.append([csrf_name],csrf_hash);
      formData.append('blood_bank_id',blood_bank_id);
      formData.append('data_tab','doc_details');

       Swal.fire({   
          title: "Are you sure?",   
          text: "You will be able to edit this data later",   
          icon: 'warning',  
          showCancelButton: true,   
          confirmButtonColor: '#000000', 
          cancelButtonColor: '#f11026', 
          confirmButtonText: "Yes, upload",   
          cancelButtonText: "No, cancel",
          allowOutsideClick: false
      }).then((isConfirm)=>{ 


        if (isConfirm) {

          $.ajax({
            type:'POST',
            url:blood_banks_add_url,
            data:formData,
            dataType:'json',
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000000,
            beforeSend:function(){
              $('#btn_save_mics_details').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading').prop('disabled',true);
            },
            success:function(d,status,xhr){

              if(d.success){
                $('#btn_save_docs').html('<i class="fas fa-save fw"></i> Uploaded').prop('disabled',true);
                setTimeout(function(){               
                  $('#btn_save_docs').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
                },1200);

                Toast.fire({
                  icon: 'success',
                  title: d.success
                });

                if(d.next_step){

                }

                $('#form_documents_details')[0].reset();
                
              }else{

                Toast.fire({
                  icon: 'error',
                  title: d.error
                }); 

               
                $('#btn_save_docs').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
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


              $('#btn_save_docs').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
            },
            complete:function(status,xhr){
              var table=$('#table_blood_banks_files').DataTable();
              table.ajax.reload( null, false );
            }
          });

        }
      });

    }
  });


  $('body').on('click','.btn_del_file',function(){

    var blood_bank_id=$(this).data('blood_bank_id');
    var storage_id=$(this).data('storage_id');

    Swal.fire({   
          title: "Are you sure?",   
          text: "You will be able to edit this data later",   
          icon: 'warning',  
          showCancelButton: true,   
          confirmButtonColor: '#000000', 
          cancelButtonColor: '#f11026', 
          confirmButtonText: "Yes, upload",   
          cancelButtonText: "No, cancel",
          allowOutsideClick: false
      }).then((isConfirm)=>{ 


        if (isConfirm) {

          $.ajax({
            type:'POST',
            url:file_delete_url,
            data:{[csrf_name]:csrf_hash,storage_id:storage_id,blood_bank_id:blood_bank_id},
            success:function(d){
              if(d.success){
                Toast.fire({
                  icon: 'success',
                  title: d.success
                });
              }
            },
            complete:function(status,xhr){
              var table=$('#table_blood_banks_files').DataTable();
              table.ajax.reload( null, false );
            }
          });

        }

      });

  });


  $('body').on('change','#org_component_facillity',function(){
    var v=$('#org_component_facillity :selected').val();

    if(v=='component'){
      $('#components_div').css('display','block');
    }
    if(v=='both'){
      $('#components_div').css('display','block');
    }else if(v=='wb'){
      $('#components_div').css('display','none');
    }
  });


  //File selection
  $('body').on('change','input[type="file"]',function(e) {
      var file = e.target.files[0].name;
      $(this).next('label').html(file)
      //alert('The file "' + file + '" has been selected.');
  });

});