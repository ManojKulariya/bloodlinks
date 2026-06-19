$(document).ready(function () {

        $('#downloadexcelLink').on('click', function(event) {
        // Get values of hidden inputs
        var daysfilter =  $('#daysfillter').val()
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        // Construct the URL with query parameters
        var url = bb_details_excel_url;
        url += "?days_filter=" + daysfilter;
        url += "&start_date=" + start_date;
        url += "&end_date=" + end_date;
        window.location.href = url;
    });
    $('#downloaddonorexcelLink').on('click', function(event) {
        // Get values of hidden inputs
        var daysfilter =  $('#daysfillter').val()
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        // Construct the URL with query parameters
        var url = bb_details_donor_excel_url;
        url += "?days_filter=" + daysfilter;
        url += "&start_date=" + start_date;
        url += "&end_date=" + end_date;
        // Navigate to the URL
        window.location.href = url;
    });
    $('#downloadDO_APPexcelLink').on('click', function(event) {
        // Get values of hidden inputs
        var daysfilter =  $('#daysfillter').val()
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        // Construct the URL with query parameters
        var url = bb_donnar_app_excel_url;
        url += "?days_filter=" + daysfilter;
        url += "&start_date=" + start_date;
        url += "&end_date=" + end_date;
        // Navigate to the URL
        window.location.href = url;
    });
    $('#downloadBL_APPexcelLink').on('click', function(event) {
        // Get values of hidden inputs
        var daysfilter =  $('#daysfillter').val()
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        // Construct the URL with query parameters 
        var url = bb_req_app_excel;
        url += "?days_filter=" + daysfilter;
        url += "&start_date=" + start_date;
        url += "&end_date=" + end_date;
        // Navigate to the URL
        window.location.href = url;
    });
    $('#downloadpending_req_BL_excelLink').on('click', function(event) {
        // Get values of hidden inputs
        var daysfilter =  $('#daysfillter').val()
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        // Construct the URL with query parameters
        var url = bb_request_excel;
        url += "?days_filter=" + daysfilter;
        url += "&start_date=" + start_date;
        url += "&end_date=" + end_date;
        // Navigate to the URL
        window.location.href = url;
    });
    $('#downloadMET_req_BL_excelLink').on('click', function(event) {
        var daysfilter =  $('#daysfillter').val()
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        // Construct the URL with query parameters
        var url = bb_request_met_excel;
        url += "?days_filter=" + daysfilter;
        url += "&start_date=" + start_date;
        url += "&end_date=" + end_date;
        // Navigate to the URL
        window.location.href = url;
    });
    $('#downloadMET_BLINV_excelLink').on('click', function(event) {
        var daysfilter =  $('#daysfillter').val()
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        // Construct the URL with query parameters
        var url = bb_inv_search_excel;
        url += "?days_filter=" + daysfilter;
        url += "&start_date=" + start_date;
        url += "&end_date=" + end_date;
        // Navigate to the URL
        window.location.href = url;
    });
    $('#downloadMET_Camp_excelLink').on('click', function(event) {
        var daysfilter =  $('#daysfillter').val()
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        // Construct the URL with query parameters
        var url = bb_camp_search_excel;
        url += "?days_filter=" + 60;
        url += "&start_date=" + start_date;
        url += "&end_date=" + end_date;
        url += "&name=" + $('#name').val();
        url += "&venue=" + $('#venue').val();
        url += "&bloodbank_id=" + $('#bloodbank_id').val();
        url += "&city=" + $('#city').val();
        // Navigate to the URL
        window.location.href = url;
    });
    $('#downloaddonorexcel').on('click', function(event) {
        var url = bg_search_excel_url;
        url += "?days_filter=" + encodeURIComponent(dayfilter);
        url += "&start_date=" + encodeURIComponent(start_date);
        url += "&end_date=" + encodeURIComponent(end_date);
        url += "&d_type=" + encodeURIComponent(d_type);
        url += "&g_type=" + encodeURIComponent(g_type);
        url += "&bb_id=" + encodeURIComponent(bb_id);
        url += "&name=" + encodeURIComponent($('#name').val());
        url += "&blood_group=" + encodeURIComponent($('#blood_group').val());
        url += "&status=" + encodeURIComponent($('#status').val());
        // Navigate to the URL
        window.location.href = url;
    });
    
    $('#downloaddonorappexcel').on('click', function(event) {
        var url = bg_search_app_excel_url;
        url += "?days_filter=" + dayfilter;
        url += "&start_date=" + start_date;
        url += "&end_date=" + end_date;
        url += "&d_type=" + d_type;
        url += "&g_type=" + g_type;
        url += "&bb_id=" + bb_id;
        url += "&name=" + $('#name').val();
        url += "&approved_status=" + $('#approved_status').val();
        url += "&donation_status=" + $('#donation_status').val();
        url += "&blood_group=" + $('#blood_group').val();
        // Navigate to the URL
        window.location.href = url;
    });
    $('#downloadpendingReqexcel').on('click', function(event) {
       
        var url = bg_req_search_excel_url;
        url += "?days_filter=" + dayfilter;
        url += "&start_date=" + start_date;
        url += "&end_date=" + end_date;
        url += "&bb_id=" + bb_id;
        url += "&name=" + $('#name').val();
        url += "&blood_group=" + encodeURIComponent($('#blood_group').val());
        url += "&component=" + encodeURIComponent($('#component').val());
        // Navigate to the URL
        window.location.href = url;
    });
    $('#downloadmetReqexcel').on('click', function(event) {
       
        var url = bg_req_met_excel_search_url;
        url += "?days_filter=" + dayfilter;
        url += "&start_date=" + start_date;
        url += "&end_date=" + end_date;
        url += "&bb_id=" + bb_id;
        url += "&name=" + $('#name').val();
        url += "&blood_group=" + encodeURIComponent($('#blood_group').val());
        // Navigate to the URL
        window.location.href = url;
    });
});

