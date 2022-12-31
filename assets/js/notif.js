toastr.options = {
    "closeButton": true,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  
  
  function notifSuccess(message)
  {
    toastr.success(message);
  }
  
  function notifError(message)
  {
    toastr.error(message);
  }
  
  function notifWarning(message)
  {
    toastr.warning(message);
  }
  
  function notifInfo(message)
  {
    toastr.info(message);
  }