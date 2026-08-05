$(document).ready(function(){
  $('.print-btn').click(function(){
    // Create a new image object
    var img = new Image();
    
    // Set the image source
    img.src = $('#payLogo').attr('src');
    
    // Execute printing code after the image has loaded
    img.onload = function() {
      setTimeout(function() {
        $('#payslip-content').printThis();
      }, 500);  
    };
  });
});



