jQuery(function($) {
  'use strict';

  if($('#table_googleapi').length>0){

    $('#table_googleapi').DataTable({ 
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
          "url":states_search_url,
          "type": "POST",
          "data":{[csrf_name]:csrf_hash}
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { 
          "targets": [0,1], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
  }

  if($('#table_states').length>0){

    $('#table_states').DataTable({ 
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
          "url":states_search_url,
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


  if($('#table_districts').length>0){

      $('#table_districts').DataTable({ 
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
            "url":district_search_url,
            "type": "POST",
            "data":{[csrf_name]:csrf_hash}
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


  if($('#table_cities').length>0){

    $('#table_cities').DataTable({ 
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
          "url":city_search_url,
          "type": "POST",
          "data":{[csrf_name]:csrf_hash}
      },
      //Set column definition initialisation properties.
      "columnDefs": [
      { 
          "targets": [0,4], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ]
    });
}


});