// Call toaster
function callToaster(title, message, type, delay) {
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: 'toast-top-right',
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: delay,
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    };
    if(type === 'info') toastr.info(message, title);
    else if(type === 'danger') toastr.error(message, title);
    else if(type === 'success') toastr.success(message, title);
    else if(type === 'warning') toastr.warning(message, title);
}