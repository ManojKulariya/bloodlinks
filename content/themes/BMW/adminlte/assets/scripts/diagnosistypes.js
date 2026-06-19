jQuery(function($) {
  'use strict';

  if($('#table_diagnosis_types').length>0){

    $('#table_diagnosis_types').DataTable({ 
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
          "url":masters_search_url,
          "type": "POST",
          "data":{[csrf_name]:csrf_hash,type_key:'diagnosis_types'}
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


  $('#form_diagnosis_types').validate({
    rules:{
      masters_value:{
        required:true
      }
    },
    messages:{
      masters_value:{
        required:'Enter Diagnosis type name'
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

      var formData=new FormData($('#form_diagnosis_types')[0]);
      formData.append([csrf_name],csrf_hash);
      formData.append('masters_type','diagnosis_types');
      formData.append('masters_type_name','Diagnosis Types');

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
            url:masters_add_url,
            data:formData,
            dataType:'json',
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000000,
            beforeSend:function(){
              $('#btn_save_diagnosis_types').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading').prop('disabled',true);
            },
            success:function(d,status,xhr){

              if(d.success){
                $('#btn_save_diagnosis_types').html('<i class="fas fa-save fw"></i> Uploaded').prop('disabled',true);
                
                Toast.fire({
                  icon: 'success',
                  title: d.success
                });

                if(d.next_step){

                }

                setTimeout(function(){               
                  $('#btn_save_diagnosis_types').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
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

               
                $('#btn_save_diagnosis_types').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
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


              $('#btn_save_diagnosis_types').html('<i class="fas fa-save fw"></i> Save').prop('disabled',false);
            },
            complete:function(status,xhr){
              var table=$('#table_diagnosis_types').DataTable();
              table.ajax.reload( null, false );
            }
          });

        }
      });

    }
  });


});