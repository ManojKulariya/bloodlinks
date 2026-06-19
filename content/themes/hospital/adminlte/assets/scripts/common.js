

function draw_datatable(selector,base_url,targets=[ 1 ],data=null,iDisplayLength=50){
  $(selector).DataTable({ 
    'bJQueryUI': false,
    'stateSave': true,
    'iDisplayLength':iDisplayLength,
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
        "url": base_url,
        "type": "POST",
        "data":{data}
    },
    //Set column definition initialisation properties.
    "columnDefs": [
    { 
        "targets": targets, //first column / numbering column
        "orderable": false, //set not orderable
    },
    ],
  });
}

const Toast = Swal.mixin({
  toast: true,
  position: 'top-center',
  showConfirmButton: false,
  timer: 3000
});


$(function() {

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

  jQuery.validator.addMethod("pwcheck", function (value, element) {
    return this.optional(element) || /(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/.test(value);
  }, "Password must contain atleast one digit , one lowercase letter , one uppercase letter and one special character(!@#$%^&)");

  jQuery.validator.addMethod("valueNotEquals", function(value, element, arg){
    return arg !== value;
  }, "Value must not equal arg.");

  jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[\w.]+$/i.test(value);
  }, "Letters, numbers, and underscores only please");

  jQuery.validator.addMethod('minStrict', function (value, el, param) {
    return value > param;
  });

  jQuery.validator.addMethod('min-length', function (val, element) {
      return this.optional(element) || val.length >= $(element).data('min');
  }, function(params, element) {
      return 'The field cannot be less than than ' + $(element).data('min') + ' length.';
  });

  jQuery.validator.addMethod('max-length', function (val, element) {
      return this.optional(element) || val.length <= $(element).data('max');
  }, function(params, element) {
      return 'The field cannot be less than than ' + $(element).data('max') + ' length.';
  });

  jQuery.validator.addMethod(
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

  jQuery.validator.addMethod(
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





});


