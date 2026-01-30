
function showNotifications(data) {
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
    };

    if (data.success) {
        toastr.success(data.success);
    }

    if (data.error) {
        toastr.error(data.error);
    }

    if (data.warnings && data.warnings.length > 0) {
        data.warnings.forEach(function(message) {
            toastr.warning(message);
        });
    }
}
