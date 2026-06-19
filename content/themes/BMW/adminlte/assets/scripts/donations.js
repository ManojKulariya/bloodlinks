jQuery(function($) {
  'use strict';
// alert('hiiii'); 
// return ();

 if($('#table_donation_form').length>0){

    $('#table_donation_form').DataTable({ 
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
          "targets": [0,8], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }

   if($('#table_bloodbank_user').length>0){

    $('#table_bloodbank_user').DataTable({ 
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
          "targets": [0,6], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }

  if($('#table_donation_appointments').length>0){

    $('#table_donation_appointments').DataTable({ 
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
          "targets": [0,8], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }


if($('#table_alldonor').length>0){

    $('#table_alldonor').DataTable({ 
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
          "targets": [0,7], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }

if($('#table_allpatients').length>0){

    $('#table_allpatients').DataTable({ 
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
          "targets": [0,6], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }

if($('#table_allcamps').length>0){

    $('#table_allcamps').DataTable({ 
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
          "targets": [0,9], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }

if($('#table_donation_ttitest').length>0){

    $('#table_donation_ttitest').DataTable({ 
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

 if($('#table_components_entry').length>0){

    $('#table_components_entry').DataTable({ 
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
          "targets": [0,13], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }

 if($('#table_bloodstock').length>0){

    $('#table_bloodstock').DataTable({ 
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

   if($('#table_deferred_donor').length>0){

    $('#table_deferred_donor').DataTable({ 
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
          "targets": [0,7], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }

  if($('#table_requestdeferred_donor').length>0){

    $('#table_requestdeferred_donor').DataTable({ 
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
          "targets": [0,7], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }
  
   if($('#table_donor_discard').length>0){

    $('#table_donor_discard').DataTable({ 
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
  
  
  
  if($('#table_tti_discard').length>0){

    $('#table_tti_discard').DataTable({ 
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
          "url":tti_discard,
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

if($('#table_component_discard').length>0){

    $('#table_component_discard').DataTable({ 
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
          "url":component_discard,
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


  if($('#table_manufactures').length>0){

    $('#table_manufactures').DataTable({ 
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

  if($('#table_consumble_type').length>0){

    $('#table_consumble_type').DataTable({ 
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



  if($('#table_user_role').length>0){

    $('#table_user_role').DataTable({ 
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
    if($('#table_consumbles_items').length>0){

    $('#table_consumbles_items').DataTable({ 
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

  if($('#table_consumables_recive').length>0){

    $('#table_consumables_recive').DataTable({ 
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

    if($('#table_bloodcamp').length>0){

    $('#table_bloodcamp').DataTable({ 
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
          "targets": [0,9], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }

if($('#table_bloodrecord').length>0){

    $('#table_bloodrecord').DataTable({ 
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

   if($('#table_issueblood').length>0){

    $('#table_issueblood').DataTable({ 
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
          "targets": [0,9], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }
      if($('#table_bloodreturn').length>0){

    $('#table_bloodreturn').DataTable({ 
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
          "targets": [0,9], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }

        if($('#table_crossmatch').length>0){

    $('#table_crossmatch').DataTable({ 
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

  
        if($('#table_crossmatch_list').length>0){

    $('#table_crossmatch_list').DataTable({ 
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

   if($('#table_consumable').length>0){

    $('#table_consumable').DataTable({ 
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
          "targets": [0,8], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }

  if($('#table_blood_appointment').length>0){

    $('#table_blood_appointment').DataTable({ 
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
          "targets": [0,6], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }

    if($('#table_blood_request').length>0){

    $('#table_blood_request').DataTable({ 
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
          "targets": [0,6], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }

  //   if($('#table_crossmatch').length>0){

  //   $('#table_crossmatch').DataTable({ 
  //     'bJQueryUI': false,
  //     'stateSave': true,
  //     'iDisplayLength':10,
  //     'responsive': true,
  //     "pagingType": "full_numbers",
  //     "rowReorder":false,
  //     'language': {
  //       'paginate': {
  //         'first': "<<", // This is the link to the first page
  //         'previous': "<", // This is the link to the previous page
  //         'next': ">", // This is the link to the next page
  //         'last': ">>" // This is the link to the last page
  //       }
  //     },
  //     "lengthMenu": [[10,25,50,100,250,500], [10,25,50,100,250,500]],
  //     "processing": true, //Feature control the processing indicator.
  //     "serverSide": true, //Feature control DataTables' server-side processing mode.
  //     "order": [], //Initial no order.
  //     // Load data for the table's content from an Ajax source
  //     "ajax": {
  //         "url":apppointment_search,
  //         "type": "POST",
  //         "data":{[csrf_name]:csrf_hash}
  //     },
  //     //Set column definition initialisation properties.
  //     "columnDefs": [
  //     { 
  //         "targets": [0,6], //first column / numbering column
  //         "orderable": false, //set not orderable
  //     },
  //     ]
  //   });
  // }
  // function deleteFun(id){

  //   if(confirm('Are you sure')==true)
  //   {


  //     $.ajax({
  //              url:deleteSingleData,
  //              method:"POST",
  //              datatype:"json",
  //              data:{id:id},

  //              success:function(d){

  //                 if(d==1){
  //                    alert('Data Delete Successfully');
  //                    $('#table_donation_appointments').DataTable().ajax.reload();
  //                 }
  //                 else{
  //                    alert(d.error);
  //                 }
  //              }
  //           })
  //   }
  // }


});