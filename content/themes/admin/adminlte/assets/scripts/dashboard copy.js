
console.log('test');
var bb_details_search_url='<?php echo $base_url;?>/bb_details_search';
var days_filter = $('#daysfillter').val();
$('#resetFiltersBtn').click(function() {
    // Clear the values of all filter inputs
    $('#daysfillter').val(0); // Reset days filter to its default value
    $('#start_date').val(''); // Reset start date input
    $('#end_date').val(''); // Reset end date input

    // Reload the DataTable to reset all filters
    var table = $('#table_bb_details').DataTable();
    table.search('').columns().search('').draw(); 
    var tabledef = $('#table_bb_deffer').DataTable();
    tabledef.search('').columns().search('').draw(); 
    var tablereq = $('#table_bb_request').DataTable();
    tablereq.search('').columns().search('').draw(); 
    var tablereqmet = $('#table_bb_request_met').DataTable();
    tablereqmet.search('').columns().search('').draw(); 
    var tableinv = $('#table_bb_inv').DataTable();
    tableinv.search('').columns().search('').draw(); 
    var tablecamp = $('#table_bb_camp').DataTable();
    tablecamp.search('').columns().search('').draw(); 

    var tablereqapp = $('#table_bb_req_app').DataTable();
    tablereqapp.search('').columns().search('').draw(); 
    var tabledonarapp = $('#table_bb_donar_app').DataTable();
    tabledonarapp.search('').columns().search('').draw(); 
});

$(document).ready(function() {
    var bb_details_search_url = '<?php echo $base_url; ?>/bb_details_search';
    var bb_deffer_search = '<?php echo $base_url; ?>/bb_deffer_search';
    var bb_request_search = '<?php echo $base_url; ?>/bb_request_search';
    var bb_request_met_search = '<?php echo $base_url; ?>/bb_request_met_search';
    var bb_inv_search = '<?php echo $base_url; ?>/bb_inv_search';
    var bb_camp_search = '<?php echo $base_url; ?>/bb_camp_search';
    var bb_req_app_search = '<?php echo $base_url; ?>/bb_req_app_search';
    var bb_donar_app_search = '<?php echo $base_url; ?>/bb_donar_app_search';


    // Function to reload the DataTable with updated filters
    function reloadDataTable() {
        var table = $('#table_bb_details').DataTable();
        var tabledef = $('#table_bb_deffer').DataTable();
        var tablereq = $('#table_bb_request').DataTable();
        var tablereqmet = $('#table_bb_request_met').DataTable();
        var tableinv = $('#table_bb_inv').DataTable();
        var tablecamp = $('#table_bb_camp').DataTable();
        var tabledonarapp = $('#table_bb_req_app').DataTable();
        var tablereaapp = $('#table_bb_donar_app').DataTable();
        table.ajax.url(bb_details_search_url).draw(); 
        tabledef.ajax.url(bb_deffer_search).draw(); 
        tablereq.ajax.url(bb_request_search).draw(); 
        tablereqmet.ajax.url(bb_request_met_search).draw(); 
        tableinv.ajax.url(bb_inv_search).draw(); 
        tablecamp.ajax.url(bb_camp_search).draw(); 
        tabledonarapp.ajax.url(bb_donar_app_search).draw(); 
        tablereqapp.ajax.url(bb_donar_app_search).draw(); 
    }

    // Handle change event on the dropdown and date inputs
    $('#daysfillter, #start_date, #end_date').change(function() {
        reloadDataTable(); 
    });


   //  var table = $('#table_bb_req_app').DataTable({ 
   //      'bJQueryUI': false,
   //      'stateSave': false,
   //      'iDisplayLength': 3,
   //      'responsive': true,
   //      "pagingType": "full_numbers",
   //      "rowReorder": false,
   //      'language': {
   //          'paginate': {
   //              'first': "<<", // This is the link to the first page
   //              'previous': "<", // This is the link to the previous page
   //              'next': ">", // This is the link to the next page
   //              'last': ">>" // This is the link to the last page
   //          }
   //      },
   //      "lengthMenu": [[3,10, 25, 50, 100, 250, 500], [3,10, 25, 50, 100, 250, 500]],
   //      "processing": true, //Feature control the processing indicator.
   //      "serverSide": true, //Feature control DataTables' server-side processing mode.
   //      "order": [], //Initial no order.
   //      // Load data for the table's content from an Ajax source
   //      "ajax": {
   //          "url": bb_req_app_search,
   //          "type": "POST",
   //          "data": function(d) {
   //              d[csrf_name] = csrf_hash;
   //              d.days_filter = $('#daysfillter').val(); // Pass selected days filter value
   //              d.start_date = $('#start_date').val(); // Pass selected start date value
   //              d.end_date = $('#end_date').val(); // Pass selected end date value
   //          }
   //      },
   //       "autoWidth": false,
   //                  "searching": false, // Disable search
   //       "lengthChange": false,
   //      //Set column definition initialisation properties.
   //      "columnDefs": [
   //          {
   //              "targets": 1, // Second column
   //              "width": "100px" // Set the width of the second column
   //          },
   //          { 
   //              "targets": [0,10], //first column / numbering column
   //              "orderable": false, //set not orderable
   //          }
   //      ],
        
   //      // Add Buttons extension for export options
    
   //  });
   var tablereqapp = $('#table_bb_req_app').DataTable({ 
    'bJQueryUI': false,
    'stateSave': false,
    'iDisplayLength': 3, // Show 3 entries initially
    'responsive': true,
    "pagingType": "full_numbers",
    "rowReorder": false,
    'language': {
        'paginate': {
            'first': "<<", // This is the link to the first page
            'previous': "<", // This is the link to the previous page
            'next': ">", // This is the link to the next page
            'last': ">>" // This is the link to the last page
        },
        "info": ""
    },
    "lengthMenu": [[3, 5, 10, 25, 50, 100, 250, 500], [3, 5, 10, 25, 50, 100, 250, 500]],
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.
    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": bb_req_app_search,
        "type": "POST",
        "data": function(d) {
            d[csrf_name] = csrf_hash;
            d.days_filter = $('#daysfillter').val(); // Pass selected days filter value
            d.start_date = $('#start_date').val(); // Pass selected start date value
            d.end_date = $('#end_date').val(); // Pass selected end date value
        }
    },
    "autoWidth": false,
    //Set column definition initialisation properties.
    "columnDefs": [
        {
            "targets": 1, // Second column
            "width": "100px" // Set the width of the second column
        },
        { 
            "targets": [0, 10], //first column / numbering column
            "orderable": false, //set not orderable
        }
    ],
       "searching": false, // Disable search initially
    "lengthChange": false, // Disable length change dropdown initially
    "initComplete": function(settings, json) {
        // Hide pagination controls initially
        $('#table_bb_req_app_paginate').hide();
    },
    "drawCallback": function(settings) {
        if (tablereqapp.page.info().pages > 1) {
            $('#table_bb_req_app_paginate ').show();
        } else {
            $('#table_bb_req_app_paginate ').hide();
        }
    }
});

// $('#view_more_button').on('click', function() {
//     tablereqapp.page.len(tablereqapp.page.len() + 3).draw(); // Show 3 more entries

//     // Show pagination after loading more data
//     $('.dataTables_paginate').show();
// });
// Function to toggle link text and functionality
function toggleLoadLink() {
    var totalRecords = tablereqapp.page.info().recordsTotal;
    var currentLength = tablereqapp.page.len();
    var link = $('#load_more_link');

    if (currentLength < totalRecords) {
        link.text('Load More');
    } else {
        link.text('Load Less');
    }
}

// Add a click event listener to load more/less entries
$('#load_more_link').on('click', function(event) {
    event.preventDefault();
    var currentLength = tablereqapp.page.len();
    var totalRecords = tablereqapp.page.info().recordsTotal;

    if (currentLength < totalRecords) {
        // Show 3 more entries
        tablereqapp.page.len(currentLength + 3).draw();
    } else {
        // Reset to initial display length
        tablereqapp.page.len(3).draw();
    }

    // Toggle link text and functionality
    toggleLoadLink();
});

// Initial toggle of link text and functionality
toggleLoadLink();

    var table = $('#table_bb_donar_app').DataTable({ 
        'bJQueryUI': false,
        'stateSave': false,
        'iDisplayLength': 3,
        'responsive': true,
        "pagingType": "full_numbers",
        "rowReorder": false,
        'language': {
            'paginate': {
                'first': "<<", // This is the link to the first page
                'previous': "<", // This is the link to the previous page
                'next': ">", // This is the link to the next page
                'last': ">>" // This is the link to the last page
            }
        },
        "lengthMenu": [[3,10, 25, 50, 100, 250, 500], [3,10, 25, 50, 100, 250, 500]],
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": bb_donar_app_search,
            "type": "POST",
            "data": function(d) {
                d[csrf_name] = csrf_hash;
                d.days_filter = $('#daysfillter').val(); // Pass selected days filter value
                d.start_date = $('#start_date').val(); // Pass selected start date value
                d.end_date = $('#end_date').val(); // Pass selected end date value
            }
        },
        "autoWidth": false,
           "searching": false, // Disable search
    "lengthChange": false,
        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": 1, // Second column
                "width": "100px" // Set the width of the second column
            },
            { 
                "targets": [0,10], //first column / numbering column
                "orderable": false, //set not orderable
            }
        ],
        
        // Add Buttons extension for export options
    
    });
    // Initialize DataTable
    var table = $('#table_bb_details').DataTable({ 
        'bJQueryUI': false,
        'stateSave': false,
        'iDisplayLength': 3,
        'responsive': true,
        "pagingType": "full_numbers",
        "rowReorder": false,
        'language': {
            'paginate': {
                'first': "<<", // This is the link to the first page
                'previous': "<", // This is the link to the previous page
                'next': ">", // This is the link to the next page
                'last': ">>" // This is the link to the last page
            }
        },
        "lengthMenu": [[3,10, 25, 50, 100, 250, 500], [3,10, 25, 50, 100, 250, 500]],
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": bb_details_search_url,
            "type": "POST",
            "data": function(d) {
                d[csrf_name] = csrf_hash;
                d.days_filter = $('#daysfillter').val(); // Pass selected days filter value
                d.start_date = $('#start_date').val(); // Pass selected start date value
                d.end_date = $('#end_date').val(); // Pass selected end date value
            }
        },
        "autoWidth": false,
           "searching": false, // Disable search
    "lengthChange": false,
        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": 1, // Second column
                "width": "100px" // Set the width of the second column
            },
            { 
                "targets": [0,10], //first column / numbering column
                "orderable": false, //set not orderable
            }
        ],
        
        // Add Buttons extension for export options
    
    });


    var tabledeff = $('#table_bb_deffer').DataTable({ 
        'bJQueryUI': false,
        'stateSave': false,
        'iDisplayLength': 3,
        'responsive': true,
        "pagingType": "full_numbers",
        "rowReorder": false,
        'language': {
            'paginate': {
                'first': "<<", // This is the link to the first page
                'previous': "<", // This is the link to the previous page
                'next': ">", // This is the link to the next page
                'last': ">>" // This is the link to the last page
            }
        },
        "lengthMenu": [[3,10, 25, 50, 100, 250, 500], [3,10, 25, 50, 100, 250, 500]],
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": bb_deffer_search,
            "type": "POST",
            "data": function(d) {
                d[csrf_name] = csrf_hash;
                d.days_filter = $('#daysfillter').val(); // Pass selected days filter value
                d.start_date = $('#start_date').val(); // Pass selected start date value
                d.end_date = $('#end_date').val(); // Pass selected end date value
            }
        },
        "autoWidth": false,
           "searching": false, // Disable search
    "lengthChange": false,
        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": 1, // Second column
                "width": "100px" // Set the width of the second column
            },
            { 
                "targets": [0,10], //first column / numbering column
                "orderable": false, //set not orderable
            }
        ]
    });

    var tablereq = $('#table_bb_request').DataTable({ 
        'bJQueryUI': false,
        'stateSave': false,
        'iDisplayLength': 3,
        'responsive': true,
        "pagingType": "full_numbers",
        "rowReorder": false,
        'language': {
            'paginate': {
                'first': "<<", // This is the link to the first page
                'previous': "<", // This is the link to the previous page
                'next': ">", // This is the link to the next page
                'last': ">>" // This is the link to the last page
            }
        },
        "lengthMenu": [[3,10, 25, 50, 100, 250, 500], [3,10, 25, 50, 100, 250, 500]],
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": bb_request_search,
            "type": "POST",
            "data": function(d) {
                d[csrf_name] = csrf_hash;
                d.days_filter = $('#daysfillter').val(); // Pass selected days filter value
                d.start_date = $('#start_date').val(); // Pass selected start date value
                d.end_date = $('#end_date').val(); // Pass selected end date value
            }
        },
        "autoWidth": false,
           "searching": false, // Disable search
    "lengthChange": false,
        "columnDefs": [
            {
                "targets": 1, // Second column
                "width": "100px" // Set the width of the second column
            },
            { 
                "targets": [0,5], //first column / numbering column
                "orderable": false, //set not orderable
            }
        ]
    });
    var tablereqmet = $('#table_bb_request_met').DataTable({ 
        'bJQueryUI': false,
        'stateSave': false,
        'iDisplayLength': 3,
        'responsive': true,
        "pagingType": "full_numbers",
        "rowReorder": false,
        'language': {
            'paginate': {
                'first': "<<", // This is the link to the first page
                'previous': "<", // This is the link to the previous page
                'next': ">", // This is the link to the next page
                'last': ">>" // This is the link to the last page
            }
        },
        "lengthMenu": [[3,10, 25, 50, 100, 250, 500], [3,10, 25, 50, 100, 250, 500]],
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": bb_request_met_search,
            "type": "POST",
            "data": function(d) {
                d[csrf_name] = csrf_hash;
                d.days_filter = $('#daysfillter').val(); // Pass selected days filter value
                d.start_date = $('#start_date').val(); // Pass selected start date value
                d.end_date = $('#end_date').val(); // Pass selected end date value
            }
        },
        "autoWidth": false,
           "searching": false, // Disable search
    "lengthChange": false,
        "columnDefs": [
            {
                "targets": 1, // Second column
                "width": "100px" // Set the width of the second column
            },
            { 
                "targets": [0,5], //first column / numbering column
                "orderable": false, //set not orderable
            }
        ]
    });
    var tableinv = $('#table_bb_inv').DataTable({ 
        'bJQueryUI': false,
        'stateSave': false,
        'iDisplayLength': 3,
        'responsive': true,
        "pagingType": "full_numbers",
        "rowReorder": false,
        'language': {
            'paginate': {
                'first': "<<", // This is the link to the first page
                'previous': "<", // This is the link to the previous page
                'next': ">", // This is the link to the next page
                'last': ">>" // This is the link to the last page
            }
        },
        "lengthMenu": [[3,10, 25, 50, 100, 250, 500], [3,10, 25, 50, 100, 250, 500]],
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": bb_inv_search,
            "type": "POST",
            "data": function(d) {
                d[csrf_name] = csrf_hash;
                d.days_filter = $('#daysfillter').val(); // Pass selected days filter value
                d.start_date = $('#start_date').val(); // Pass selected start date value
                d.end_date = $('#end_date').val(); // Pass selected end date value
            }
        },
        "autoWidth": false,
           "searching": false, // Disable search
    "lengthChange": false,
        "columnDefs": [
            {
                "targets": 1, // Second column
                "width": "100px" // Set the width of the second column
            },
            { 
                "targets": [0,5], //first column / numbering column
                "orderable": false, //set not orderable
            }
        ]
    });
    var tablecamp = $('#table_bb_camp').DataTable({ 
        'bJQueryUI': false,
        'stateSave': false,
        'iDisplayLength': 3,
        'responsive': true,
        "pagingType": "full_numbers",
        "rowReorder": false,
        'language': {
            'paginate': {
                'first': "<<", // This is the link to the first page
                'previous': "<", // This is the link to the previous page
                'next': ">", // This is the link to the next page
                'last': ">>" // This is the link to the last page
            }
        },
        "lengthMenu": [[3,10, 25, 50, 100, 250, 500], [3,10, 25, 50, 100, 250, 500]],
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": bb_camp_search,
            "type": "POST",
            "data": function(d) {
                d[csrf_name] = csrf_hash;
                d.days_filter = $('#daysfillter').val(); // Pass selected days filter value
                d.start_date = $('#start_date').val(); // Pass selected start date value
                d.end_date = $('#end_date').val(); // Pass selected end date value
            }
        },
        "autoWidth": false,
           "searching": false, // Disable search
    "lengthChange": false,
        "columnDefs": [
            {
                "targets": 1, // Second column
                "width": "120px" // Set the width of the second column
            },
            { 
                "targets": [0,5], //first column / numbering column
                "orderable": false, //set not orderable
            }
        ]
    });
});