$(document).on('submit', '#timedepositForm', function(e) {
  // $("#timedepositAdd").attr('disabled','true');
  // $("#timedepositAdd").attr('value','Processing...');
  e.preventDefault();
  var bankName = $('#bankName').val();
  // var branchName = $('#branchName').val();
  var parValue = $('#balance').val();
  var interestRate = $('#interestRate').val();
  var terms = $('#terms').val();
  var maturityDate = $('#maturityDate').val();
  var uponMaturity = $('#uponMaturity').val();
  var remarks = $('#remarks').val();
  

  var fd = new FormData(this);

  if(parValue <= 99999999){
    if (bankName !== '' && parValue !== '' && terms !== '' && interestRate !== '' && maturityDate !== '' && uponMaturity !== '') {
      // Proceed with AJAX request
      $.ajax({
        url: "add_timedeposit.php",
        type: "post",
        data: fd,
        contentType: false,
        processData: false,
        success: function(data) {
          var response = JSON.parse(data);
          if (response['result']) {
            mytable = $('#reporttbl').DataTable();
            mytable.draw();
            mytable.ajax.reload();
            $('#timedepositAdd').modal('hide');
            alert(response['message']);
            $('#timedepositForm')[0].reset();
            window.location.reload();
          } else {
            alert(response['message']);
          }
        }
      });
    } else {
      alert('Fill all the required fields');
    }
  }


    // Check if the par value exceeds the threshold
  if (parValue >= 100000000) {
    // Confirm action if the threshold is exceeded and bank is not allowed
    if (bankName !== "UCPB Savings Bank" && bankName !== "Land Bank of the Philippines") {
        if (!confirm("You have Exceeded the Amount Limit of P100,000,000.00. Do you still want to proceed?")) {
            return; // Exit if user cancels
        }else{
          // Ensure all required fields are filled
          if (bankName !== '' && parValue !== '' && terms !== '' && interestRate !== '' && maturityDate !== '' && uponMaturity !== '' && remarks !== '') {
            // Proceed with AJAX request
            $.ajax({
              url: "add_timedeposit.php",
              type: "post",
              data: fd,
              contentType: false,
              processData: false,
              success: function(data) {
                var response = JSON.parse(data);
                if (response['result']) {
                  mytable = $('#reporttbl').DataTable();
                  mytable.draw();
                  mytable.ajax.reload();
                  $('#timedepositAdd').modal('hide');
                  alert(response['message']);
                  $('#timedepositForm')[0].reset();
                  window.location.reload();
                } else {
                  alert(response['message']);
                }
              }
            });
          } else {
            alert('Fill all the required fields');
          }
        }
    }else{
      if (bankName !== '' && parValue !== '' && terms !== '' && interestRate !== '' && maturityDate !== '' && uponMaturity !== '' && remarks !== '') {
        // Proceed with AJAX request
        $.ajax({
          url: "add_timedeposit.php",
          type: "post",
          data: fd,
          contentType: false,
          processData: false,
          success: function(data) {
            var response = JSON.parse(data);
            if (response['result']) {
              mytable = $('#reporttbl').DataTable();
              mytable.draw();
              mytable.ajax.reload();
              $('#timedepositAdd').modal('hide');
              alert(response['message']);
              $('#timedepositForm')[0].reset();
              window.location.reload();
            } else {
              alert(response['message']);
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    }
  }
});
