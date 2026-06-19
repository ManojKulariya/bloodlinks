jQuery(function($) {
  'use strict';

   // This set of validators requires the File API, so if we'ere in a browser
    // that isn't sufficiently "HTML5"-y, don't even bother creating them.  It'll
    // do no good, so we just automatically pass those tests.
    var is_supported_browser = !!window.File,
        fileSizeToBytes,
        formatter = $.validator.format;

    /**
     * Converts a measure of data size from a given unit to bytes.
     *
     * @param number size
     *   A measure of data size, in the give unit
     * @param string unit
     *   A unit of data.  Valid inputs are "B", "KB", "MB", "GB", "TB"
     *
     * @return number|bool
     *   The number of bytes in the above size/unit combo.  If an
     *   invalid unit is specified, false is returned
     */
    fileSizeToBytes = (function () {

        var units = ["B", "KB", "MB", "GB", "TB"];

        return function (size, unit) {

            var index_of_unit = units.indexOf(unit),
                coverted_size;

            if (index_of_unit === -1) {

                coverted_size = false;

            } else {

                while (index_of_unit > 0) {
                    size *= 1024;
                    index_of_unit -= 1;
                }

                coverted_size = size;
            }

            return coverted_size;
        };
    }());

    $.validator.addMethod(
      "minFileSize",
      function (value, element, params) {

          var files,
              unit = params.unit || "KB",
              size = params.size || 100,
              min_file_size = fileSizeToBytes(size, unit),
              is_valid = false;

          if (!is_supported_browser || this.optional(element)) {

              is_valid = true;

          } else {

              files = element.files;

              if (files.length < 1) {

                  is_valid = false;

              } else {

                  is_valid = files[0].size >= min_file_size;

              }
          }

          return is_valid;
      },
      function (params, element) {
          return formatter(
              "File must be at least {0}{1} large.",
              [params.size || 100, params.unit || "KB"]
          );
      }
  );

  $.validator.addMethod(
        "maxFileSize",
        function (value, element, params) {

            var files,
                unit = params.unit || "KB",
                size = params.size || 100,
                max_file_size = fileSizeToBytes(size, unit),
                is_valid = false;

            if (!is_supported_browser || this.optional(element)) {

                is_valid = true;

            } else {

                files = element.files;

                if (files.length < 1) {

                    is_valid = false;

                } else {

                    is_valid = files[0].size <= max_file_size;

                }
            }

            return is_valid;
        },
        function (params, element) {
            return formatter(
                "File cannot be larger than {0}{1}.",
                [params.size || 100, params.unit || "KB"]
            );
        }
  );

  	$.validator.addMethod("valueNotEquals", function(value, element, arg){
	  return arg != value;
	}, "Value must not equal arg.");

	//Couorses

	$("#_parent_course").chosen({no_results_text: "Select Parent Course"});
	$("#course_streams").chosen({no_results_text: "Select Course Stream"});
	$("#course_duration").chosen({no_results_text: "Select Course Duration"});


	$('#courses_list_table').DataTable({ 
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
	      "url": base_url+'/streams/course/search',
	      "type": "POST",
	      "data":{csrf_test_name:csrf_hash,course_parent:course_parent}
	  },
	  //Set column definition initialisation properties.
	  "columnDefs": [
	  { 
	      "targets": [ 0 ], //first column / numbering column
	      "orderable": false, //set not orderable
	  },
	  ],
	});


	


	$('#courses_menues_list_table').DataTable({ 
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
	      "url": base_url+'/streams/courses/menues/search',
	      "type": "POST",
	      "data":{csrf_test_name:csrf_hash,course_parent:course_id}
	  },
	  //Set column definition initialisation properties.
	  "columnDefs": [
	  { 
	      "targets": [ 0 ], //first column / numbering column
	      "orderable": false, //set not orderable
	  },
	  ],
	});


	$('#courses_category_list_table').DataTable({ 
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
	      "url": base_url+'/streams/course/category/search',
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


	$('#course_menu_list').DataTable({ 
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
	      "url": base_url+'/settings/menues/search',
	      "type": "POST",
	      "data":{csrf_test_name:csrf_hash,menu_category_id:'4',menu_link_id:course_id}
	  },
	  //Set column definition initialisation properties.
	  "columnDefs": [
	  { 
	      "targets": [ 0 ], //first column / numbering column
	      "orderable": false, //set not orderable
	  },
	  ],
	});

	$('body').on('click','.btn_course_category_stream',function(){
		var cat=$(this).attr('data-course_category');

		$.ajax({
			type:'POST',
			url:base_url+'/streams/course/category/stream_search',
			data:{csrf_test_name:csrf_hash,_course_category:cat},
			success:function(d){
				$('#courses_category_stream_list_table tbody').html(d.html);
			}
		});
	});


	$('body').on('click','.btn_course_stream_edit',function(){
		$('#courseStreamSlugsModal').find('#course_stream_category').val($(this).attr('data-course_category'));
		$('#courseStreamSlugsModal').find('#course_category_stream').val($(this).attr('data-streams'));

		$('#courseStreamSlugsModal').find('#course_stream_url_meta_heading').val($(this).attr('data-meta_heading'));

		$('#courseStreamSlugsModal').find('#course_stream_url_meta_title').val($(this).attr('data-meta_title'));

		$('#courseStreamSlugsModal').find('#course_stream_url_meta_keywords').val($(this).attr('data-meta_key_words'));

		$('#courseStreamSlugsModal').find('#course_stream_url_meta_desc').val($(this).attr('data-meta_desc'));

		$('#courseStreamSlugsModal').find('#course_stream_url_og_title').val($(this).attr('data-og_title'));

		$('#courseStreamSlugsModal').find('#course_stream_url_og_desc').val($(this).attr('data-og_desc'));

		$('#courseStreamSlugsModal').find('#course_stream_url_page_heading').val($(this).attr('data-page_heading'));

		$('#courseStreamSlugsModal').find('#course_stream_url_page_sub_heading').val($(this).attr('data-page_sub_heading'));

		$('#courseStreamSlugsModal').find('#course_category_stream_name').val($(this).attr('data-og_desc'));

		$('#courseStreamSlugsModal').find('#course_stream_category_name').val($(this).attr('data-og_desc'));
	});


	$('#form_courses_category_stream_slugs').validate({
		rules:{

		},
		messages:{

		},
		submitHandler:function(f){
			$.ajax({
				type:'POST',
				url:base_url+'/streams/course/category/slug_create',
				data:$('#form_courses_category_stream_slugs').serialize(),
				success:function(d){
					if(d.success){
						$('#btn_add_course_stream_url').html(d.success);
					}else{
						$('#btn_add_course_stream_url').html(d.error);
					}
					
				},complete:function(status,xhr){
					$('#btn_add_course_stream_url').html('Update');
				}
			});
		}
	});

	$('#form_course').validate({
	    rules:{	    	
	      course_name:{
	        required:true,
	      },
	      course_serial:{
	        required:true,
	        digits:true
	      },
	      course_streams:{
	    	valueNotEquals:''
	      }
	    },
	    messages:{
	       course_name:{
	        required:'Please enter course name',
	      },
	      course_serial:{
	        required:'Please enter serial no',
	        digits:'Only numeric value allowed',
	      },
	      course_streams:{
	    	valueNotEquals:'Select Stream'
	      }
	    },
	    errorPlacement: function(label, element) {
	      label.addClass('mt-2 text-danger');
	      label.insertAfter(element);
	    },
	    highlight: function(element, errorClass) {
	      $(element).parent().addClass('has-danger')
	      $(element).addClass('form-control-danger')
	    },
	    submitHandler:function(f){
	      
	      var f_data = FormDataJson.formToJson(document.getElementById("form_course"));
	      var ctext= CryptoJS.AES.encrypt(JSON.stringify(f_data), _xtYu, { format: CryptoJSAesJson }).toString();

	      $.ajax({
	        type:'POST',
	        url:base_url+'/streams/course/add',
	        data: {ctext:ctext,csrf_test_name:csrf_hash},
	        cache:true,
	        beforeSend:function(){
	          $('#course_name').prop('disabled',true);
	          $('#course_serial').prop('disabled',true);
	          $('#btn_save_course').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Saving...</span>').prop('disabled',true);
	        },
	        success:function(d,status,xhr){

	          if(d.success){
	          	$('#form_course')[0].reset();

	            var table=$('#courses_list_table').DataTable();
	            table.ajax.reload( null, false );

	            $('#course_name').prop('disabled',false);
	            $('#course_serial').prop('disabled',false);
	            $('#btn_save_course').html(d.success).prop('disabled',false);

	            setTimeout(function(){               
	              $('#btn_save_course').html('Save').prop('disabled',false);
	            },1200);
	            
	            
	          }else{
	            Swal.fire({
	              icon: 'error',
	              title: d.error,
	              confirmButtonText:'Close',
	              confirmButtonColor:'#d33',
	              allowOutsideClick: false,
	            });

	            $('#course_name').prop('disabled',false);
	            $('#course_serial').prop('disabled',false);
	            $('#btn_save_course').html('Login').prop('disabled',false);
	          }
	        },
	        error: function( jqXhr ) {
	          //alert(jqXhr)
	          if( jqXhr.status == 400 ) {
	              Swal.fire({
	                icon: 'error',
	                title: 'Request url not found',
	                confirmButtonText:'Close',
	                confirmButtonColor:'#d33',
	                allowOutsideClick: false,
	              });
	              window.location.reload();
	          }else if( jqXhr.status == 403 ) {
	              Swal.fire({
	                icon: 'error',
	                title: 'Request is forbidden',
	                confirmButtonText:'Close',
	                confirmButtonColor:'#d33',
	                allowOutsideClick: false,
	              });
	              window.location.reload();
	          }

	          $('#course_name').prop('disabled',false);
	          $('#course_serial').prop('disabled',false);


	          $('#btn_save_course').html('Save').prop('disabled',false);
	        },
	        complete:function(status,xhr){
	         $('#form_course')[0].reset();
	        }
	      });
	    }
	});



	$('body').on('click','.btn_edit_course',function(){
		$('#_course').val($(this).attr('data-course'));
		$('#course_name').val($(this).attr('data-course_name'));
	});


	$('body').on('click','.btn_del_course',function(){
	  	var _course=$(this).attr('data-course');

	  	Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'mr-2',
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type:'POST',
					url:base_url+'/courses/delete',
					data:{csrf_test_name:csrf_hash,_course:_course},
					success:function(d){
						if(d.success){
							Swal.fire('Deleted!',d.success,'success');
							var table=$('#courses_list_table').DataTable();
	                		table.ajax.reload( null, false );
						}else if(d.error){
							Swal.fire('Not Deleted!',d.error,'error');
						}
					}
				});		  
			}
		})
	});


	//Streams
	$('#streams_list_table').DataTable({ 
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
	      "url": base_url+'/streams/search',
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

	if(_parent_stream!=''){

		$('#sub_streams_list_table').DataTable({ 
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
		      "url": base_url+'/streams/substreams/'+_parent_stream+'/search',
		      "type": "POST",
		      "data":{csrf_test_name:csrf_hash,_parent_stream:_parent_stream}
		  },
		  //Set column definition initialisation properties.
		  "columnDefs": [
		  { 
		      "targets": [ 0 ], //first column / numbering column
		      "orderable": false, //set not orderable
		  },
		  ],
		});
	}

	

	$('#form_stream').validate({
	    rules:{
	      stream_name:{
	        required:true,
	      },
	      stream_serial:{
	        required:true,
	        digits:true
	      }
	    },
	    messages:{
	       stream_name:{
	        required:'Please enter stream name',
	      },
	      stream_serial:{
	        required:'Please enter serial no',
	        digits:'Only numeric value allowed',
	      }
	    },
	    errorPlacement: function(label, element) {
	      label.addClass('mt-2 text-danger');
	      label.insertAfter(element);
	    },
	    highlight: function(element, errorClass) {
	      $(element).parent().addClass('has-danger')
	      $(element).addClass('form-control-danger')
	    },
	    submitHandler:function(f){
	      
	      var f_data = FormDataJson.formToJson(document.getElementById("form_stream"));
	      var ctext= CryptoJS.AES.encrypt(JSON.stringify(f_data), _xtYu, { format: CryptoJSAesJson }).toString();

	      $.ajax({
	        type:'POST',
	        url:base_url+'/streams/add',
	        data: {ctext:ctext,csrf_test_name:csrf_hash},
	        cache:true,
	        beforeSend:function(){
	          $('#stream_name').prop('disabled',true);
	          $('#stream_serial').prop('disabled',true);
	          $('#btn_save_stream').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Saving...</span>').prop('disabled',true);
	        },
	        success:function(d,status,xhr){

	          if(d.success){

	            var table=$('#streams_list_table').DataTable();
	            table.ajax.reload( null, false );

	            $('#stream_name').prop('disabled',false);
	            $('#stream_serial').prop('disabled',false);
	            $('#btn_save_stream').html(d.success).prop('disabled',false);

	            setTimeout(function(){               
	              $('#btn_save_stream').html('Save').prop('disabled',false);
	            },1200);
	            
	            
	          }else{
	            Swal.fire({
	              icon: 'error',
	              title: d.error,
	              confirmButtonText:'Close',
	              confirmButtonColor:'#d33',
	              allowOutsideClick: false,
	            });

	            $('#stream_name').prop('disabled',false);
	            $('#stream_serial').prop('disabled',false);
	            $('#btn_save_stream').html('Save').prop('disabled',false);
	          }
	        },
	        error: function( jqXhr ) {
	          //alert(jqXhr)
	          if( jqXhr.status == 400 ) {
	              Swal.fire({
	                icon: 'error',
	                title: 'Request url not found',
	                confirmButtonText:'Close',
	                confirmButtonColor:'#d33',
	                allowOutsideClick: false,
	              });
	              window.location.reload();
	          }else if( jqXhr.status == 403 ) {
	              Swal.fire({
	                icon: 'error',
	                title: 'Request is forbidden',
	                confirmButtonText:'Close',
	                confirmButtonColor:'#d33',
	                allowOutsideClick: false,
	              });
	              window.location.reload();
	          }

	          $('#stream_name').prop('disabled',false);
	          $('#stream_serial').prop('disabled',false);


	          $('#btn_save_stream').html('Save').prop('disabled',false);
	        },
	        complete:function(status,xhr){
	         $('#form_stream')[0].reset();
	        }
	      });
	    }
	});

	$('body').on('click','.btn_del_stream',function(){
	  	var _stream=$(this).attr('data-stream');

	  	Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'mr-2',
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type:'POST',
					url:base_url+'/streams/delete',
					data:{csrf_test_name:csrf_hash,_stream:_stream},
					success:function(d){
						if(d.success){
							Swal.fire('Deleted!',d.success,'success');
							var table=$('#streams_list_table').DataTable();
	                		table.ajax.reload( null, false );
						}else if(d.error){
							Swal.fire('Not Deleted!',d.error,'error');
						}
					}
				});		  
			}
		})
	});

	//Degrees
	//if(stream!=''){
		$('#degree_list_table').DataTable({ 
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
		      "url": base_url+'/streams/degrees/search',
		      "type": "POST",
		      "data":{csrf_test_name:csrf_hash,stream:stream}
		  },
		  //Set column definition initialisation properties.
		  "columnDefs": [
		  { 
		      "targets": [ 0 ], //first column / numbering column
		      "orderable": false, //set not orderable
		  },
		  ],
		});

		$('#form_degree').validate({
		    rules:{
		      degree_name:{
		        required:true,
		      },
		      _stream:{
		      	valueNotEquals:''
		      }
		    },
		    messages:{
		       degree_name:{
		        required:'Please enter degree name',
		      },
		      _stream:{
		      	valueNotEquals:'Please select stream'
		      }
		    },
		    errorPlacement: function(label, element) {
		      label.addClass('mt-2 text-danger');
		      label.insertAfter(element);
		    },
		    highlight: function(element, errorClass) {
		      $(element).parent().addClass('has-danger')
		      $(element).addClass('form-control-danger')
		    },
		    submitHandler:function(f){
		      
		      var f_data = FormDataJson.formToJson(document.getElementById("form_degree"));
		      var ctext= CryptoJS.AES.encrypt(JSON.stringify(f_data), _xtYu, { format: CryptoJSAesJson }).toString();

		      $.ajax({
		        type:'POST',
		        url:base_url+'/streams/degrees/add',
		        data: {ctext:ctext,csrf_test_name:csrf_hash},
		        cache:true,
		        beforeSend:function(){
		          $('#degree_name').prop('disabled',true);
		          $('#btn_save_degree').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Saving...</span>').prop('disabled',true);
		        },
		        success:function(d,status,xhr){

		          if(d.success){

		            var table=$('#degree_list_table').DataTable();
		            table.ajax.reload( null, false );

		            $('#degree_name').prop('disabled',false);
		            $('#btn_save_degree').html(d.success).prop('disabled',false);

		            setTimeout(function(){               
		              $('#btn_save_degree').html('Save').prop('disabled',false);
		            },1200);
		            
		            
		          }else{
		            Swal.fire({
		              icon: 'error',
		              title: d.error,
		              confirmButtonText:'Close',
		              confirmButtonColor:'#d33',
		              allowOutsideClick: false,
		            });

		            $('#degree_name').prop('disabled',false);
		            $('#btn_save_degree').html('Save').prop('disabled',false);
		          }
		        },
		        error: function( jqXhr ) {
		          //alert(jqXhr)
		          if( jqXhr.status == 400 ) {
		              Swal.fire({
		                icon: 'error',
		                title: 'Request url not found',
		                confirmButtonText:'Close',
		                confirmButtonColor:'#d33',
		                allowOutsideClick: false,
		              });
		              window.location.reload();
		          }else if( jqXhr.status == 403 ) {
		              Swal.fire({
		                icon: 'error',
		                title: 'Request is forbidden',
		                confirmButtonText:'Close',
		                confirmButtonColor:'#d33',
		                allowOutsideClick: false,
		              });
		              window.location.reload();
		          }

		          $('#degree_name').prop('disabled',false);
		          $('#btn_save_degree').html('Save').prop('disabled',false);
		        },
		        complete:function(status,xhr){
		         $('#form_degree')[0].reset();
		        }
		      });
		    }
		});

		$('body').on('click','.btn_del_degree',function(){
		  	var _degree=$(this).attr('data-degree');

		  	Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonClass: 'mr-2',
				confirmButtonText: 'Yes, delete it!',
				cancelButtonText: 'No, cancel!',
				reverseButtons: true
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type:'POST',
						url:base_url+'/streams/degrees/delete',
						data:{csrf_test_name:csrf_hash,_degree:_degree},
						success:function(d){
							if(d.success){
								Swal.fire('Deleted!',d.success,'success');
								var table=$('#degree_list_table').DataTable();
		                		table.ajax.reload( null, false );
							}else if(d.error){
								Swal.fire('Not Deleted!',d.error,'error');
							}
						}
					});		  
				}
			})
		});
	//}


	//Exams
	//if(degree!=''){
		$('#exam_list_table').DataTable({ 
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
		      "url": base_url+'/streams/exams/search',
		      "type": "POST",
		      "data":{csrf_test_name:csrf_hash,degree:degree}
		  },
		  //Set column definition initialisation properties.
		  "columnDefs": [
		  { 
		      "targets": [ 0 ], //first column / numbering column
		      "orderable": false, //set not orderable
		  },
		  ],
		});

		$('body').on('click','.btn_update_slug_url',function(){
			var exam_id=$(this).attr('data-exam_id');

			$.ajax({
				type:'POST',
				url:base_url+'/streams/exams/update_slugs',
				data:{csrf_test_name:csrf_hash,_exam_id:exam_id},
				success:function(d){
					var table=$('#exam_list_table').DataTable();
		            table.ajax.reload( null, false );
				}
			});
		});

		$('#_form_exam').validate({
		    rules:{
		      exam_name:{
		        required:true,
		      },
		      _degree:{
		      	valueNotEquals:''
		      }
		    },
		    messages:{
		       exam_name:{
		        required:'Please enter exam name',
		      },
		      _degree:{
		      	valueNotEquals:'Please select degree'
		      }
		    },
		    errorPlacement: function(label, element) {
		      label.addClass('mt-2 text-danger');
		      label.insertAfter(element);
		    },
		    highlight: function(element, errorClass) {
		      $(element).parent().addClass('has-danger')
		      $(element).addClass('form-control-danger')
		    },
		    submitHandler:function(f){
		      
		      var f_data = FormDataJson.formToJson(document.getElementById("form_exam"));
		      var ctext= CryptoJS.AES.encrypt(JSON.stringify(f_data), _xtYu, { format: CryptoJSAesJson }).toString();

		      $.ajax({
		        type:'POST',
		        url:base_url+'/streams/degrees/exams/add',
		        data: {ctext:ctext,csrf_test_name:csrf_hash},
		        cache:true,
		        beforeSend:function(){
		          $('#exam_name').prop('disabled',true);
		          $('#btn_save_exam').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Saving...</span>').prop('disabled',true);
		        },
		        success:function(d,status,xhr){

		          if(d.success){

		            var table=$('#exam_list_table').DataTable();
		            table.ajax.reload( null, false );

		            $('#exam_name').prop('disabled',false);
		            $('#btn_save_exam').html(d.success).prop('disabled',false);

		            setTimeout(function(){               
		              $('#btn_save_exam').html('Save').prop('disabled',false);
		            },1200);
		            
		            
		          }else{
		            Swal.fire({
		              icon: 'error',
		              title: d.error,
		              confirmButtonText:'Close',
		              confirmButtonColor:'#d33',
		              allowOutsideClick: false,
		            });

		            $('#exam_name').prop('disabled',false);
		            $('#btn_save_exam').html('Save').prop('disabled',false);
		          }
		        },
		        error: function( jqXhr ) {
		          //alert(jqXhr)
		          if( jqXhr.status == 400 ) {
		              Swal.fire({
		                icon: 'error',
		                title: 'Request url not found',
		                confirmButtonText:'Close',
		                confirmButtonColor:'#d33',
		                allowOutsideClick: false,
		              });
		              window.location.reload();
		          }else if( jqXhr.status == 403 ) {
		              Swal.fire({
		                icon: 'error',
		                title: 'Request is forbidden',
		                confirmButtonText:'Close',
		                confirmButtonColor:'#d33',
		                allowOutsideClick: false,
		              });
		              window.location.reload();
		          }

		          $('#exam_name').prop('disabled',false);
		          $('#btn_save_exam').html('Save').prop('disabled',false);
		        },
		        complete:function(status,xhr){
		         $('#form_exam')[0].reset();
		        }
		      });
		    }
		});

		$('body').on('click','.btn_del_exam',function(){
		  	var _exam=$(this).attr('data-exam');

		  	Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonClass: 'mr-2',
				confirmButtonText: 'Yes, delete it!',
				cancelButtonText: 'No, cancel!',
				reverseButtons: true
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type:'POST',
						url:base_url+'/streams/exams/delete',
						data:{csrf_test_name:csrf_hash,_exam:_exam},
						success:function(d){
							if(d.success){
								Swal.fire('Deleted!',d.success,'success');
								var table=$('#exam_list_table').DataTable();
		                		table.ajax.reload( null, false );
							}else if(d.error){
								Swal.fire('Not Deleted!',d.error,'error');
							}
						}
					});		  
				}
			})
		});


		$('#form_exam_excel').validate({
			rules:{
				exam_stream:{
					valueNotEquals:'0'
				},
				exam_excel:{
					required: true,
					extension: "xls|xlsx"
				}
			},
			messages:{
				exam_stream:{
					valueNotEquals:'Select stream'
				},
				exam_excel:{
					required: 'Select excel file',
					extension:"Select valied input file format"
				}
			},
			submitHandler:function(){
		      $.ajax({
		        type:'POST',
		        url:base_url+'/streams/exams/import',
		        data:new FormData($('#form_exam_excel')[0]),
		        cache: false,
		        contentType: false,
		        processData: false,
		        timeout: 60000000,
		        target: '.preview',
		        beforeSend:function(){
		            $('#btn_import_exam').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').prop('disabled',true);
		        },
		        success:function(f){
		            if(f.success){
		             $('#btn_import_exam').prop('disabled',true);
		             Swal.fire({
		                icon: 'success',
		                title: f.success,
		                confirmButtonText:'Close',
		                confirmButtonColor:'#69da68',
		                allowOutsideClick: false,
		              });
		              var table=$('#exam_list_table').DataTable();
		              table.ajax.reload( null, false );
		              $('#form_exam_excel').trigger("reset");
		              $('#examImportModal').modal('hide');         
		            }else if(f.error){
		              $('#btn_import_exam').prop('disabled',true);
		              Swal.fire({
		                icon: 'error',
		                title: f.error,
		                confirmButtonText:'Close',
		                confirmButtonColor:'#69da68',
		                allowOutsideClick: false,
		              });
		            }else if(f.redirect){
		              $('#btn_import_exam').prop('disabled',true);
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
		            $('#btn_import_exam').html('Save').attr('disabled',false);
		        },
		        resetForm: true 
		      });
		    }
		});


		$('body').on('click','#btn_add_exam_modal',function(){
			$('#form_exam')[0].reset();
		});


		$('#form_exam').validate({
		    rules:{
		      exam_name:{
		        required:true,
		      },
		      "exam_stream[]":{
		      	required:false,
		      },
		      exam_logo:{
		      	required:false,
		        extension: "jpeg|jpg,png",
		        maxFileSize: {
		            "unit": "KB",
		            "size": "200"
		        },
		        minFileSize: {
		            "unit": "KB",
		            "size": "0.50"
		        }
		      }
		    },
		    messages:{
		       exam_name:{
		        required:'Please enter exam name',
		      },
		      "exam_stream[]":{
		      	required:"Select stream",
		      }
		    },
		    errorPlacement: function(label, element) {
		      label.addClass('mt-2 text-danger');
		      label.insertAfter(element);
		    },
		    highlight: function(element, errorClass) {
		      $(element).parent().addClass('has-danger')
		      $(element).addClass('form-control-danger')
		    },
		    submitHandler:function(f){
		      
		      $.ajax({
		        type:'POST',
		        url:base_url+'/streams/exams/add',
		        data:new FormData($('#form_exam')[0]),
		        cache: false,
		        contentType: false,
		        processData: false,
		        timeout: 60000000,
		        target: '.preview',
		        cache:true,
		        beforeSend:function(){
		          $('#exam_name').prop('disabled',true);
		           $('#exam_short_name').prop('disabled',true);
		          $('#btn_add_exam').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').prop('disabled',true);
		        },
		        success:function(d,status,xhr){

		          if(d.success){

		          	Swal.fire({
		              icon: 'success',
		              title: d.success,
		              confirmButtonText:'Close',
		              allowOutsideClick: false,
		            });

		            var table=$('#exam_list_table').DataTable();
		            table.ajax.reload( null, false );

		            $('#exam_name').prop('disabled',false);
		            $('#exam_short_name').prop('disabled',false);
		            $('#btn_add_exam').html(d.success).prop('disabled',false);

		            setTimeout(function(){               
		              $('#btn_add_exam').html('Save').prop('disabled',false);
		            },1200);
		            
		            
		          }else{
		            Swal.fire({
		              icon: 'error',
		              title: d.error,
		              confirmButtonText:'Close',
		              confirmButtonColor:'#d33',
		              allowOutsideClick: false,
		            });

		            $('#exam_name').prop('disabled',false);
		            $('#exam_short_name').prop('disabled',false);
		            $('#btn_add_exam').html('Save').prop('disabled',false);
		          }
		        },
		        error: function( jqXhr ) {
		          //alert(jqXhr)
		          if( jqXhr.status == 400 ) {
		              Swal.fire({
		                icon: 'error',
		                title: 'Request url not found',
		                confirmButtonText:'Close',
		                confirmButtonColor:'#d33',
		                allowOutsideClick: false,
		              });
		              window.location.reload();
		          }else if( jqXhr.status == 403 ) {
		              Swal.fire({
		                icon: 'error',
		                title: 'Request is forbidden',
		                confirmButtonText:'Close',
		                confirmButtonColor:'#d33',
		                allowOutsideClick: false,
		              });
		              window.location.reload();
		          }

		          $('#exam_name').prop('disabled',false);
		          $('#exam_short_name').prop('disabled',false);
		          $('#btn_add_exam').html('Save').prop('disabled',false);
		        },
		        complete:function(status,xhr){
		        	if($('#_exam').val()==''){
						$('#form_exam')[0].reset();
		        	}
		        }
		      });
		    }
		});


		$('#examsModal').on('show.bs.modal', function() {
			var _exam=$('#examsModal').find('#_exam').val();
		    $.ajax({
		    	type:'POST',
		    	url:base_url+'/streams/get_streams',
		    	data:{csrf_test_name:csrf_hash,_exam:_exam},
		    	success:function(d){
		    		if(d.html){
		    			$('#examsModal').find('div#streams_div').html(d.html);
		    		}
		    	}
		    });
		});

		$('body').on('change','#exam_type',function(){
			var s=$('#exam_type :selected').val();

			if(s=='2'){
				let country=$('#exam_country :selected').val();

			    let f_data  =   new Array(country);
			    let ctext   =   CryptoJS.AES.encrypt(JSON.stringify(f_data), _xtYu, { format: CryptoJSAesJson }).toString();
			    $.ajax({
			      type:'POST',
			      url:base_url+'/country/get_states',
			      data:{ctext:ctext,listing_type:'1',csrf_test_name:csrf_hash},
			      success:function(d){
			        $('#exam_state').html(d.html);
			      }
			    });
				$('#exam_state_div').css('display','block');
			}else{
				$('#exam_state').html('');
				$('#exam_state_div').css('display','none');
			}
		});


		$('body').on('click','.btn_exam',function(){
			$('#examsModal').find('#_exam').val($(this).attr('data-exam'));
			$('#examsModal').find('#exam_name').val($(this).attr('data-exam_name'));
			$('#examsModal').find('#exam_short_name').val($(this).attr('data-exam_short_name'));
			$('#examsModal').find('#exam_description').html($(this).attr('data-exam_short_desc'));
			$('#examsModal').modal('show');
		});

		$('body').on('click','.btn_update_exam_dates',function(){
			$('#examsdatesModal').find('#_exam').val($(this).attr('data-exam'));
			$('#examsdatesModal').find('.modal-title').html('Add/Edit '+$(this).attr('data-exam_name')+' Dates');
			$('#examsdatesModal').find('#exam_short_desc').val($(this).attr('data-exam_short_desc'));
			$('#examsdatesModal').modal('show');
		});

		if($('#exam_application_start_date').length>0){
		   $('#exam_application_start_date').datepicker({ format: "dd-mm-yyyy"});
		}

		if($('#exam_application_end_date').length>0){
		   $('#exam_application_end_date').datepicker({ format: "dd-mm-yyyy"});
		}

		if($('#exam_start_date').length>0){
		   $('#exam_start_date').datepicker({ format: "dd-mm-yyyy"});
		}

		if($('#exam_result_start_date').length>0){
		   $('#exam_result_start_date').datepicker({ format: "dd-mm-yyyy"});
		}

		if($('#exam_result_end_date').length>0){
		   $('#exam_result_end_date').datepicker({ format: "dd-mm-yyyy"});
		}

		if($('#exam_end_date').length>0){
		   $('#exam_end_date').datepicker({ format: "dd-mm-yyyy"});
		}

		$('#examsdatesModal').on('shown.bs.modal', function (e){
			var _exam_id=$('#examsdatesModal').find('#_exam').val();

			load_exam_dates_table(_exam_id);
		})

		$('#form_exam_dates').validate({
			rules:{
				exam_short_desc:{
					required:true
				}
			},
			messages:{
				exam_short_desc:{
					required:'Short description is required'
				}
			},
			submitHandler:function(){
				$.ajax({
					type:'POST',
					url:base_url+'/streams/exams/dateadd',
					data:$('#form_exam_dates').serialize(),
					beforeSend:function(){
		            	$('#btn_add_exam_dates').html('<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Uploading...</span></div>').attr('disabled',true);
		          	},
					success:function(d){
						if(d.success){
							Swal.fire({
				              icon: 'success',
				              title: d.success,
				              confirmButtonText:'Close',
				              allowOutsideClick: false,
				            });
				            var table=$('#exams_dates_table').DataTable();
			                table.ajax.reload( null, false );
						}else{
							Swal.fire({
				              icon: 'error',
				              title: d.error,
				              confirmButtonText:'Close',
				              allowOutsideClick: false,
				            });
						}
					},
					complete:function(xhr,status){
						$('#btn_add_exam_dates').html('Save');
						$('#form_exam_dates')[0].reset();
						setTimeout(function(){
							$('#examsdatesModal').modal('hide');
						},3000);
					}
				});
			}
		});

		$('body').on('click','.btn_del_exam_dates',function(){
			var exam_id=$(this).attr('data-exam_id');
			var dates_data_id=$(this).attr('data-dates_data_id');
			Swal.fire({
		      title: "Do you want to delete the Banner?",
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
					url:base_url+'/streams/exams/datedelete',
					data:{[csrf_name]:csrf_hash,exam_id:exam_id,date_data_id:dates_data_id},
					success:function(d){
						if(d.success){
							Swal.fire({
				              icon: 'success',
				              title: d.success,
				              confirmButtonText:'Close',
				              allowOutsideClick: false,
				            });
				            var table=$('#exams_dates_table').DataTable();
			                table.ajax.reload( null, false );
						}else{
							Swal.fire({
				              icon: 'error',
				              title: d.error,
				              confirmButtonText:'Close',
				              allowOutsideClick: false,
				            });
						}
					}
				});

		      }
		    });
			


			
		});

		function load_exam_dates_table(exam_id){
			$('#exams_dates_table').DataTable().destroy();
			$('#exams_dates_table').DataTable({ 
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
		          "url": base_url+'/streams/exams/datesearch',
		          "type": "POST",
		          "data":{csrf_test_name:csrf_hash,exam_id:exam_id}
		      },
		      //Set column definition initialisation properties.
		      "columnDefs": [
		      { 
		          "targets": [ 0 ], //first column / numbering column
		          "orderable": false, //set not orderable
		      },
		      ],
		  });
		}

		$('body').on('click','.btn_change_single_data',function(){
			var _exam=$(this).attr('data-exam');
			var _field=$(this).attr('data-field');
			var _field_data=$(this).attr('data-field_value');

			$.ajax({
				type:'POST',
				url:base_url+'/streams/exams/update_single',
				data:{csrf_test_name:csrf_hash,_exam:_exam,_field:_field,_field_data:_field_data},
				success:function(d){
					if(d.success){
						Swal.fire({
			              icon: 'success',
			              title: d.success,
			              confirmButtonText:'Close',
			              allowOutsideClick: false,
			            });
			            var table=$('#exam_list_table').DataTable();
		                table.ajax.reload( null, false );
					}else if(d.error){
						Swal.fire({
			              icon: 'error',
			              title: d.error,
			              confirmButtonText:'Close',
			              allowOutsideClick: false,
			            });
					}
				}
			});
		});
	//}

	if ($(".course_overview_general").length) {
	    tinymce.init({
	      selector: '.course_overview_general',
	      entity_encoding : "raw",
	      height: 400,
	      theme: 'silver',
	      plugins: [
	        'advlist autolink lists link image code charmap print preview hr anchor pagebreak',
	        'searchreplace wordcount visualblocks visualchars code fullscreen table colorpicker visualblocks visualchars textpattern imagetools',
	      ],
	      menubar: 'file table view',
	      toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link undo redo | image code | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
	      toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help | visualblocks | visualchars',
	      visualblocks_default_state: true,
	      target_list: false,
	      image_advtab: true,
	      templates: [{
	          title: 'Test template 1',
	          content: 'Test 1'
	        },
	        {
	          title: 'Test template 2',
	          content: 'Test 2'
	        }
	      ],
	      content_css: []
	    });
	  }





	  // if ($(".course_overview_table").length) {
	  //   tinymce.init({
	  //     selector: '.course_overview_table',
	  //     entity_encoding : "raw",
	  //     height: 400,
	  //     theme: 'silver',
	  //     plugins: [
	  //       'code fullscreen table colorpicker visualblocks',
	  //     ],
	  //     menubar: 'table view',
	  //     toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link undo redo | image code | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
	  //     toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help | visualblocks | visualchars',
	  //     visualblocks_default_state: true,
	  //     target_list: false,
	  //     image_advtab: true,
	  //     templates: [{
	  //         title: 'Test template 1',
	  //         content: 'Test 1'
	  //       },
	  //       {
	  //         title: 'Test template 2',
	  //         content: 'Test 2'
	  //       }
	  //     ],
	  //     content_css: []
	  //   });
	  // }


	  $('#form_course_data_edit').validate({
	  	submitHandler:function(){
	  		$.ajax({
	  			type:'POST',
	  			url:base_url+'/streams/course/add_details_data',
	  			data:$('#form_course_data_edit').serialize(),
	  			beforeSend:function(){

	  			},
	  			success:function(d){
	  				if(d.success){
	  					alert(d.success);
	  				}else{
	  					alert(d.error);
	  				}
	  				
	  			}
	  		});
	  	}
	  });





	  //var hdr=1;

	  $(document).on('click','#btn_add_heading',function(){
	      var heading_rows='';

	      	heading_rows+='<tr id="tr2' + hdr + '">';
			heading_rows+='<td>';
				heading_rows+='<div class="form-group row">';
					heading_rows+='<div class="col-md-12">';
						heading_rows+='<label for="system_meta_title">Heading</label>';
						heading_rows+='<input type="hidden" name="course_overview_general_heading_details['+hdr+'][data_type]" value="normal">';
						heading_rows+='<input type="text" class="form-control" id="course_over_view_heading" name="course_overview_general_heading_details['+hdr+'][heading]" autocomplete="off" placeholder="Menu Name Name" value="">';
					heading_rows+='</div>';
				heading_rows+='</div>';
				heading_rows+='<div class="form-group row">';
					heading_rows+='<div class="col-md-12">';
						heading_rows+='<label for="system_meta_title">Heading Detail</label>';
						heading_rows+='<textarea class="form-control course_overview_general" rows="40" name="course_overview_general_heading_details['+hdr+'][heading_detail]"></textarea>';
					heading_rows+='</div>';
				heading_rows+='</div>';
				heading_rows+='<div class="form-group row"><div class="col-md-12"><button type="button" class="btn btn-danger btn-icon-text mb-2 mb-md-0 pull0right" onclick="$(\'#tr2' + hdr + '\').remove()">Delete Row</button></div></div>';
			heading_rows+='</td>';
			heading_rows+='</tr>';

		


	      $('#heading_rows tbody').append(heading_rows);

	       tinymce.init({
		      selector: '.course_overview_general',
		      entity_encoding : "raw",
		      height: 400,
		      theme: 'silver',
		      plugins: [
		        'code fullscreen table colorpicker visualblocks',
		      ],
		      menubar: 'table view',
		      toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link undo redo | image code | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
		      toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help | visualblocks | visualchars',
		      visualblocks_default_state: true,
		      target_list: false,
		      image_advtab: true,
		      templates: [{
		          title: 'Test template 1',
		          content: 'Test 1'
		        },
		        {
		          title: 'Test template 2',
		          content: 'Test 2'
		        }
		      ],
		      content_css: []
		    });

	      hdr++;
	  });

	 // var hdr1=1;
	  $(document).on('click','#btn_add_image_heading',function(){
	  	 var heading_rows='';

	  	 	heading_rows+='<tr id="tr3' + hdr + '">';
			heading_rows+='<td>';
			heading_rows+='<div class="form-group row">';
				heading_rows+='<div class="col-md-12">';
					heading_rows+='<label>Image Data</label>';
					heading_rows+='<input type="hidden" name="course_overview_general_heading_details['+hdr+'][data_type]" value="image">';
					heading_rows+='<input type="file" name="course_overview_general_heading_details['+hdr+'][image_file]" class="file-upload-default" id="file-upload-default'+hdr+'">';
					heading_rows+='<div class="input-group col-xs-12">';
						heading_rows+='<input type="text" class="form-control file-upload-info" disabled="" placeholder="Browse Image" name="course_overview_general_heading_details['+hdr+'][image_file_name]" value="">';
						heading_rows+='<span class="input-group-append">';
							heading_rows+='<button class="file-upload-browse btn btn-primary"  id="file-upload-browse'+hdr+'" type="button" onclick="load_file_browser(\'file-upload-browse' + hdr + '\',\'file-upload-default' + hdr + '\')">Browse Image</button>';
						heading_rows+='</span>';
					heading_rows+='</div>';
				heading_rows+='</div>';
			heading_rows+='</div>';
			heading_rows+='<div class="form-group row">';
				heading_rows+='<div class="col-md-12">';
					heading_rows+='<label for="system_meta_title">Image Details</label>';
					heading_rows+='<textarea class="form-control course_overview_image_detail" rows="40" name="course_overview_general_heading_details['+hdr+'][heading_detail]"></textarea>';
				heading_rows+='</div>';
			heading_rows+='</div>';
			heading_rows+='<div class="form-group row"><div class="col-md-12"><button type="button" class="btn btn-danger btn-icon-text mb-2 mb-md-0 pull0right" onclick="$(\'#tr3' + hdr + '\').remove()">Delete Row</button></div></div>';
			heading_rows+='</td>';
			heading_rows+='</tr>';

	  	  $('#heading_rows tbody').append(heading_rows);

	       tinymce.init({
		      selector: '.course_overview_image_detail',
		      entity_encoding : "raw",
		      height: 400,
		      theme: 'silver',
		      plugins: [
		        'code fullscreen table colorpicker visualblocks',
		      ],
		      menubar: 'table view',
		      toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link undo redo | image code | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
		      toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help | visualblocks | visualchars',
		      visualblocks_default_state: true,
		      target_list: false,
		      image_advtab: true,
		      templates: [{
		          title: 'Test template 1',
		          content: 'Test 1'
		        },
		        {
		          title: 'Test template 2',
		          content: 'Test 2'
		        }
		      ],
		      content_css: []
		    });

	      hdr++;
	  });


	  if(hdr>0){
	  	table_rowa_tiny_mce();
	  }
	  

	$(document).on('click','#btn_add_table_heading',function(){
	  	var heading_rows='';

	  	heading_rows+='<tr id="tr3' + hdr + '">';
		heading_rows+='<td>';
		heading_rows+='<div class="form-group row">';
			heading_rows+='<div class="col-md-12">';
				heading_rows+='<label for="system_meta_title">Heading</label>';
				heading_rows+='<input type="hidden" name="course_overview_general_heading_details['+hdr+'][data_type]" value="table">';
				heading_rows+='<input type="text" class="form-control" id="course_overview_table_heading" name="course_overview_general_heading_details['+hdr+'][heading]" autocomplete="off" placeholder="Menu Name Name" value="">';
			heading_rows+='</div>';
		heading_rows+='</div>';
		heading_rows+='<div class="form-group row">';
			heading_rows+='<div class="col-md-12">';
				heading_rows+='<label for="system_meta_title">Table Detail</label>';
				heading_rows+='<textarea class="form-control course_overview_table" rows="40" name="course_overview_general_heading_details['+hdr+'][heading_detail]"></textarea>';
			heading_rows+='</div>';
		heading_rows+='</div>';
		heading_rows+='<div class="form-group row"><div class="col-md-12"><button type="button" class="btn btn-danger btn-icon-text mb-2 mb-md-0 pull0right" onclick="$(\'#tr3' + hdr + '\').remove()">Delete Table Row</button></div></div>';
		heading_rows+='</td>';
		heading_rows+='</tr>';


		$('#heading_rows tbody').append(heading_rows);

	     table_rowa_tiny_mce(); 

	    hdr++;
	});

	
	$(document).on('click','#btn_add_faqs',function(){
		var faqs_rows='';

		faqs_rows+='<tr id="tr4' + hdr + '">';
		faqs_rows+='<td>';
			faqs_rows+='<div class="form-group row">';
				faqs_rows+='<div class="col-md-12">';
					faqs_rows+='<label for="system_meta_title">FAQ Question</label>';
					faqs_rows+='<input type="hidden" name="course_overview_general_heading_details['+hdr+'][data_type]" value="faqs">';
					faqs_rows+='<input type="text" class="form-control" name="course_overview_general_heading_details['+hdr+'][heading]" autocomplete="off" placeholder="FAQ Question" value="">';
				faqs_rows+='</div>';
			faqs_rows+='</div>';
			faqs_rows+='<div class="form-group row">';
				faqs_rows+='<div class="col-md-12">';
					faqs_rows+='<label for="system_meta_title">FAQ Question Answer</label>';
					faqs_rows+='<textarea class="form-control" rows="10" name="course_overview_general_heading_details['+hdr+'][heading_detail]"></textarea>';
				faqs_rows+='</div>';
			faqs_rows+='</div>';
			faqs_rows+='<div class="form-group row"><div class="col-md-12"><button type="button" class="btn btn-danger btn-icon-text mb-2 mb-md-0 pull-right" onclick="$(\'#tr4' + hdr + '\').remove()">Delete Faq Row</button></div></div>';
		faqs_rows+='</td>';
		faqs_rows+='</tr>';

		$('#heading_rows tbody').append(faqs_rows);

		hdr++;

	});


	function table_rowa_tiny_mce(){
		tinymce.init({
	      selector: '.course_overview_table',
	      entity_encoding : "raw",
	      height: 600,
	      theme: 'silver',
	      plugins: [
	        'advlist autolink lists link image code charmap print preview hr anchor pagebreak',
	        'searchreplace wordcount visualblocks visualchars code fullscreen table colorpicker visualblocks visualchars textpattern imagetools',
	      ],
	      menubar: 'table view',
	      toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link undo redo | image code | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
	      toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help | visualblocks | visualchars | source',
	      visualblocks_default_state: true,
	      target_list: false,
	      image_advtab: true,
	      templates: [{
	          title: 'Test template 1',
	          content: 'Test 1'
	        },
	        {
	          title: 'Test template 2',
	          content: 'Test 2'
	        }
	      ],
	      content_css: []
	    });
	}


	$(document).on('click','.img-fluid',function(){
		var dataimg=$(this).attr('data-img');
		var datafile_id=$(this).attr('data-file_id');
		var heading_rows='';

		heading_rows+='<tr id="tr3' + hdr + '">';
		heading_rows+='<td>';
		heading_rows+='<div class="form-group row">';
		heading_rows+='<div class="col-md-12">';
		heading_rows+='<label>Image Data</label>';
		heading_rows+='<input type="hidden" name="course_overview_general_heading_details['+hdr+'][data_type]" value="image">';
		heading_rows+='<input type="hidden" name="course_overview_general_heading_details['+hdr+'][data_type_value]" value="'+datafile_id+'">';
		heading_rows+='<input type="hidden" name="course_overview_general_heading_details['+hdr+'][heading_detail]" value="'+dataimg+'">';
		heading_rows+='<div class="row"><img src="'+dataimg+'" class="img-thumbnail" alt="Cinque Terre"></div>';
		heading_rows+='<div>';
		heading_rows+='</div>';
		heading_rows+='<div class="form-group row"><div class="col-md-12"><button type="button" class="btn btn-danger btn-icon-text mb-2 mb-md-0 pull0right" onclick="$(\'#tr3' + hdr + '\').remove()">Delete Row</button></div></div>';
		heading_rows+='</td>';
		heading_rows+='<tr>';

		console.log(heading_rows);

		$('#heading_rows tbody').append(heading_rows);

		$('#tinyFileBrowserModal').modal('hide');

		hdr++;

	});


	jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[\w.]+$/i.test(value);
  }, "Letters, numbers, and underscores only please");

  // Applying perfect-scrollbar 
  if ($('.chat-aside .tab-content').length) {
    const sidebarBodyScroll = new PerfectScrollbar('.chat-aside .tab-content');
  }
  if ($('.chat-content .chat-body').length) {
    const sidebarBodyScroll = new PerfectScrollbar('.chat-content .chat-body');
  }

  $('body').on('change input paste','#folder_name',function(){
    var fn=$('#folder_name').val();
    if(fn!=''){
       $('#btn_create_btn').attr('disabled',false); 
    }else{
      $('#btn_create_btn').attr('disabled',true);
    }
  });

  $('#newFolderModal').find('#parent_folder_disk_name').val(parent_folder);


  $('body').on('click','.folder_ellipsed_name',function(){
  	$('#newFolderModal').find('#parent_folder_disk_name').val($(this).attr('data-disk_name'));

	$('#back_to_parent').attr('data-back',$(this).attr('data-pfoldder_disk_name'));
	$('#back_to_parent').attr('data-p-back',$(this).attr('data-spfoldder_disk_name'));

    // $('#curent_folder').html($(this).attr('data-fname'));
    // $('#curent_folder_created').html($(this).attr('data-cdate'));
    // $('#newFileModal').find('#folder_data').val($(this).attr('data-folder'));

    // $('#document_folder').val($(this).attr('data-folder'));
    // $('#parent_folder').val($(this).attr('data-folder'));
    // $('#parent_folder_name').val($(this).attr('data-folder'));

    // $('#back_to_parent').attr('data-back',$(this).attr('data-pfoldder'));

    get_folders($(this).attr('data-disk_name'));
    get_files($(this).attr('data-disk_name'));
    $('#file_parent_folder').val($(this).attr('data-disk_name'));
    // get_folders_in();
  });

  $('body').on('click','#back_to_parent',function(){
    var p=$(this).attr('data-back');
    // alert(parent);
    get_folders(p);
    get_files(p);
    $('#file_parent_folder').val(p);
    $('#back_to_parent').attr('data-back',$(this).attr('data-p-back'));
  });


  	$('#form_file_browser_upload').validate({
	    
	    submitHandler:function(d){
	      $.ajax({
	          type:'POST',
	          url:base_url+'/settings/browser/_upload_file',
	          data:new FormData($('#form_file_browser_upload')[0]),
	          cache: false,
	          contentType: false,
	          processData: false,
	          timeout: 60000000,
	          target: '.preview',
	          beforeSend:function(){
	            $('#btn_upload_files').html('<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Uploading...</span></div>').attr('disabled',true);
	            $('.progress-bar').width('0%');
	            $('.progress-bar').attr('aria-valuenow','0');
	            // $('.progress-bar').text('0%');
	          },
	          success:function(f){
	            if(f.success){
               		Swal.fire({
		              icon: 'success',
		              title: f.success,
		              confirmButtonText:'Close',
		              confirmButtonColor:'#69da68',
		              allowOutsideClick: false,
		            });
	              $('.progress-bar').css('width','0%');
	              $('.progress-bar').attr('aria-valuenow','0');
	            }else if(f.error){
	              	Swal.fire({
		              icon: 'error',
		              title: f.error,
		              confirmButtonText:'Close',
		              confirmButtonColor:'#69da68',
		              allowOutsideClick: false,
		            });
	            }else if(f.redirect){
	              window.location.href=f.redirect;
	            }
	          },
	          xhr: function(){
	              //Get XmlHttpRequest object
	               var xhr = $.ajaxSettings.xhr() ;
	              //Set onprogress event handler
	               xhr.upload.onprogress = function(data){
	                  var perc =(data.loaded / data.total) * 100;// Math.round((data.loaded / data.total) * 100);
	                  $('.progress-bar').css('width',perc.toFixed(2) + '%');
	                  //.text(perc.toFixed(2) + '%');
	                  $('.progress-bar').attr('aria-valuenow',perc.toFixed(2));
	               };
	               return xhr ;
	          },
	          error: function (e) {
              
                Swal.fire({
	              icon: 'error',
	              title: 'Error has occurred while uploading the media file.',
	              confirmButtonText:'Close',
	              confirmButtonColor:'#69da68',
	              allowOutsideClick: false,
	            });
	          },
	          complete:function(status,xhr){
	            $('.progress-bar').css('width', '0%');
	            $('.progress-bar').attr('aria-valuenow','0');
	            $('#btn_upload_files').html('Upload').attr('disabled',false);
	            get_files($('#form_file_browser_upload').find('#file_parent_folder').val());
	          },
	          resetForm: true 
	        });
	    }
  	});



  $('#form_folder_browser').validate({
    rules:{
      folder_name:{
        required:true,
        alphanumeric: true,
        minlength:3,
        maxlength:128
      }
    },
    messages:{
      folder_name:{
        required:'Enter folder name',
        alphanumeric: "Letters, numbers, and underscores only please",
        minlength: "Folder name should be at least 8 characters",
        maxlength: "Folder name should be maximum 128 characters"
      }
    },
    errorPlacement: function(label, element) {
      label.addClass('mt-2 text-danger');
      label.insertAfter(element);
    },
    highlight: function(element, errorClass) {
      $(element).parent().addClass('has-danger')
      $(element).addClass('form-control-danger')
    },
    submitHandler:function(){
     var folder_name=$('#folder_name').val();
     var parent_folder_disk_name=$('#parent_folder_disk_name').val();

      $.ajax({
        type:'POST',
        url:base_url+'/settings/browser/_create_folder',
        data: {parent_folder_disk_name:parent_folder_disk_name,folder_name:folder_name,csrf_test_name:csrf_hash},
        cache:false,
        beforeSend:function(){
          $('#btn_create_btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').prop('disabled',true);
        },
        success:function(d,status,xhr){
          if(d.success){
            var html='<div class="alert alert-success alert-dismissible fade show" role="alert">'+d.success+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            $('#newFolderModal').find('div.diverror').html(html);

              get_folders(parent_folder_disk_name);
             
              setTimeout(function(){
                $('#newFolderModal').find('div.diverror').html('');    
                $('#btn_create_btn').html('Create').prop('disabled',false);
                //$('#newFolderModal').find('#form_folder_browser')[0].reset();
                $('#newFolderModal').find('#folder_name').val('');
                $('#newFolderModal').modal('toggle');                
              },1200);              
          }else if(d.error){
            var html='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+d.error+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

            $('#newFolderModal').find('div.diverror').html(html);

            setTimeout(function(){
              $('#newFolderModal').find('div.diverror').html('');    
              $('#btn_create_btn').html('Create').prop('disabled',false);
              $('#newFolderModal').find('#form_browser_folder')[0].reset();               
            },1200); 
          }
        },
        error: function( jqXhr ) {
          //alert(jqXhr)
          if( jqXhr.status == 400 ) {
              Swal.fire({
                icon: 'error',
                title: 'Request url not found',
                confirmButtonText:'Close',
                confirmButtonColor:'#d33',
                allowOutsideClick: false,
              });
              window.location.reload();
          }else if( jqXhr.status == 403 ) {
              Swal.fire({
                icon: 'error',
                title: 'Request is forbidden',
                confirmButtonText:'Close',
                confirmButtonColor:'#d33',
                allowOutsideClick: false,
              });
              window.location.reload();
          }

          $('#newFolderModal').find('#form_browser_folder')[0].reset();

          $('#btn_create_btn').html('Create').prop('disabled',false);
        }
      });
    }
});


	$('#tinyFileBrowserModal').on('shown.bs.modal', function (e) {

		get_folders(parent_folder);
		get_files(parent_folder);
		$('#file_parent_folder').val(parent_folder);

		$('#buttons_wrapper').css('display','none');

	  // $.ajax({
	  // 	type:'POST',
	  // 	url:base_url+'/settings/browser/_get_folders',
	  // 	data:{csrf_test_name:csrf_hash,parent_folder:parent_folder},
	  // 	success:function(d){
	  // 		$('#sys_folders').html(d.html);
	  // 	}
	  // });
	});

	$('#tinyFileBrowserModal').on('hidden.bs.modal', function () {
	    //$('#sys_folders').html('');
	    $('#buttons_wrapper').css('display','block');
	});


	$('body').on('click','#btn_course_menu_add',function(){
		$('#courseMenuesModal').find('#course_id').val($(this).attr('data-course_id'));
	});

	$('body').on('click','.btn_delete_course_menues',function(){

		var menu_id=$(this).attr('data-cmenu');
		var course_id=$(this).attr('data-course');

		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonClass: 'mr-2',
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type:'POST',
					url:base_url+'/streams/courses/menues/delete',
					data:{[csrf_name]:csrf_hash,_menu_id:menu_id,course_id:course_id},
					success:function(d){
						if(d.success){
							Swal.fire('Deleted!',d.success,'success');
							var table=$('#courses_menues_list_table').DataTable();
	                		table.ajax.reload( null, false );
						}else if(d.error){
							Swal.fire('Not Deleted!',d.error,'error');
						}
					}
				});		  
			}
		})
	});


	$('#form_courses_menyu').validate({
		rules:{
			course_menu_name:{
				required:true
			}
		},
		messages:{
			course_menu_name:{
				required:'Enter Menu name'
			}
		},
		submitHandler:function(){
			$.ajax({
				type:'POST',
				url:base_url+'/streams/courses/menues/add',
				data:$('#form_courses_menyu').serialize(),
				beforeSend:function(){
					$('#btn_add_course_menu').html('Adding Menu...').prop('disabled',true);
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
			            var table=$('#courses_menues_list_table').DataTable();
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
				},
				complete:function(status,xhr){
	            	$('#btn_add_course_menu').html('Add Menu').prop('disabled',false);
	            	var table=$('#courses_menues_list_table').DataTable();
              		table.ajax.reload( null, false );
	          	},
			});
		}
	});



	$('body').on('click','.btn_edit_meta',function(){
		$('#editCourseMenuMetaModal').find('#_course').val($(this).attr('data-ccourse'));
		$('#editCourseMenuMetaModal').find('#_course_menu').val($(this).attr('data-cmenu'));
		$('#editCourseMenuMetaModal').find('#course_menu_page_url').val($(this).attr('data-slug_url'));
		$('#editCourseMenuMetaModal').find('#course_menu_page_heading').val($(this).attr('data-page_heading'));
		$('#editCourseMenuMetaModal').find('#course_menu_meta_title').val($(this).attr('data-meta_title'));
		$('#editCourseMenuMetaModal').find('#course_menu_meta_keywords').val($(this).attr('data-meta_key_words'));
		$('#editCourseMenuMetaModal').find('#course_menu_meta_desc').val($(this).attr('data-meta_desc'));
		$('#editCourseMenuMetaModal').find('#course_menu_og_title').val($(this).attr('data-og_title'));
		$('#editCourseMenuMetaModal').find('#course_menu_og_desc').val($(this).attr('data-og_desc'));
	});


	$('#form_course_menu_meta').validate({
		rules:{

		},
		messages:{

		},
		submitHandler:function(){
			$.ajax({
				type:'POST',
				url:base_url+'/seo/courses/menues/add_meta',
				data:$('#form_course_menu_meta').serialize(),
				beforeSend:function(){

				},
				beforeSend:function(){
		            $('#btn_update_course_menu_meta').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').prop('disabled',true);
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
		              var table=$('#courses_menues_list_table').DataTable();
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
		          },
		          complete:function(){
		            $('#btn_update_course_menu_meta').html('Update').prop('disabled',false);
		          }
			});	
		}
	});

	$("#course_streams").chosen().change(function() {
	    var stream=$('#course_streams :selected').val();
		var html='<option value="0">Select Stream</option>';
		$.ajax({
			type:'POST',
			url:base_url+'/streams/search_sub_streams',
			data:{[csrf_name]:csrf_hash,_stream_id:stream},
			success:function(d){
				if(d.sub_stream!=''){
					$.each(d.sub_stream,function(i,v){
						html+='<option value="'+v.sub_stream_id+'">'+v.sub_stream_name+'</option>';
					});
				}

				$('#course_sub_streams').html(html);
			}
		});
	});


	$('body').on('click','.btn_set_field',function(){
		var cfield=$(this).attr('data-field');
		var cid=$(this).attr('data-course');
		var cvalue=$(this).attr('data-value');

		$.ajax({
			type:'POST',
			url:base_url+'/streams/course/update_single',
			data:{[csrf_name]:csrf_hash,course_id:cid,course_field:cfield,field_value:cvalue},
			success:function(){
				var table=$('#courses_list_table').DataTable();
              	table.ajax.reload( null, false );
			}
		});
	});

	$('body').on('click','.btn_data_change',function(){
		var sfield=$(this).attr('data-field');
		var sid=$(this).attr('data-stream');
		var svalue=$(this).attr('data-value');

		$.ajax({
			type:'POST',
			url:base_url+'/streams/course/update_stream_single_field',
			data:{[csrf_name]:csrf_hash,stream:sid,field:sfield,field_value:svalue},
			success:function(){
				var table=$('#streams_list_table').DataTable();
              	table.ajax.reload( null, false );
			}
		}); 
	});


	$('body').on('click','.btn_add_to_search',function(){
		var exam_id=$(this).attr('data-exam_id');

		$.ajax({
			type:'POST',
			url:base_url+'/stream/add_exam_to_search',
			data:{[csrf_name]:csrf_hash,exam_id:exam_id},
			success:function(d){
				if(d.success){
					Swal.fire({
		                icon: 'success',
		                title: d.success,
		                confirmButtonText:'Close',
		                confirmButtonColor:'#69da68',
		                allowOutsideClick: false,
		            });
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
	});


	function get_folders(parent_folder){
		$.ajax({
	  	type:'POST',
	  	url:base_url+'/settings/browser/_get_folders',
	  	data:{[csrf_name]:csrf_hash,parent_folder:parent_folder},
	  	success:function(d){
	  		$('#sys_folders').html(d.html);
	  	}
	  });
	}

	function get_files(parent_folder){
		$.ajax({
	  	type:'POST',
	  	url:base_url+'/settings/browser/_get_files',
	  	data:{[csrf_name]:csrf_hash,parent_folder:parent_folder},
	  	success:function(d){
	  		$('#sys_files').html(d.html);
	  	}
	  });
	}
	

	$('.file-upload-browse').on('click', function(e) {
      var file = $(this).parent().parent().parent().find('.file-upload-default');
      file.trigger('click');
    });
    $('.file-upload-default').on('change', function() {
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });



    
});


function open_file_browser(){

}


 function load_file_browser(fileuploadbrowse,fileuploaddefault){
    	var browse_control='#'+fileuploadbrowse;
    	var browse_control_default='#'+fileuploaddefault
    	$(browse_control).on('click', function(e) {
	      var file = $(this).parent().parent().parent().find(browse_control_default);
	      file.trigger('click');
	    });
	    $(browse_control_default).on('change', function() {
	      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
	    });
    }