

// $(document).ready(function () {


   
 



// // ------------ link for camp

  
    

// // ------------- link for blood request 
// var tablereqapp = $('#table_bb_req_app').DataTable({
//     'bJQueryUI': false,
//     'stateSave': false,
//     'iDisplayLength': 3, // Show 3 entries initially
//     'responsive': true,
//     "pagingType": "full_numbers",
//     "rowReorder": false,
//     'language': {
//         'paginate': {
//             'first': "<<", // This is the link to the first page
//             'previous': "<", // This is the link to the previous page
//             'next': ">", // This is the link to the next page
//             'last': ">>" // This is the link to the last page
//         },
//         "info": ""
//     },
//     "lengthMenu": [[3, 5, 10, 25, 50, 100, 250, 500], [3, 5, 10, 25, 50, 100, 250, 500]],
//     "processing": true, //Feature control the processing indicator.
//     "serverSide": true, //Feature control DataTables' server-side processing mode.
//     "order": [], //Initial no order.
//     // Load data for the table's content from an Ajax source
//     "ajax": {
//         "url": bb_req_app_search,
//         "type": "POST",
//         "data": function (d) {
//             d[csrf_name] = csrf_hash;
//             d.days_filter = $('#daysfillter').val(); // Pass selected days filter value
//             d.start_date = $('#start_date').val(); // Pass selected start date value
//             d.end_date = $('#end_date').val(); // Pass selected end date value
//         }
//     },
//     "autoWidth": false,
//     //Set column definition initialisation properties.
//     "columnDefs": [
//         {
//             "targets": 1, // Second column
//             "width": "100px" // Set the width of the second column
//         },
//         {
//             "targets": [0, 10], //first column / numbering column
//             "orderable": false, //set not orderable
//         }
//     ],
//     "searching": false, // Disable search initially
//     "lengthChange": false, // Disable length change dropdown initially
//     "initComplete": function (settings, json) {
//         // Hide pagination controls initially
//         $('#table_bb_req_app_paginate').hide();
//     },
//     "drawCallback": function (settings) {
//         toggleLoadLink();
//         if (tablereqapp.page.info().pages > 1) {
//             $('#table_bb_req_app_paginate').show();
//         } else {
//             $('#table_bb_req_app_paginate').hide();
//         }
//     }
// });
// function toggleLoadLink() {

//     var totalRecords = tablereqapp.page.info().recordsTotal;
//     var currentLength = tablereqapp.page.len();
//     var link = $('#load_more_link');
//     if (currentLength < totalRecords) {
//         link.text('View More');
//     } else {
//         link.text('View Less');
//     }
// }

// // Add a click event listener to View More/less entries
// $('#load_more_link').on('click', function (event) {
//     event.preventDefault();
//     var currentLength = tablereqapp.page.len();
//     var totalRecords = tablereqapp.page.info().recordsTotal;

//     if (currentLength < totalRecords) {
//         // Show 3 more entries
//         tablereqapp.page.len(currentLength + 3).draw();
//     } else {
//         // Reset to initial display length
//         tablereqapp.page.len(3).draw();
//     }

//     // Toggle link text and functionality
//     toggleLoadLink();
// });

// // Initial toggle of link text and functionality
// toggleLoadLink();


//        // ------------------ link for blood request 
   


// });

