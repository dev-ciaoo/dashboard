$(document).on('submit', '#treasuryForm', function (e) {
  e.preventDefault();

  // Get form values
  var bankName = $('#bankName').val();
  var parValue = parseFloat($('#parValue').val()); 
  var terms = $('#terms').val();
  var interestRate = $('#interestRate').val();
  var maturityDate = $('#maturityDate').val();
  var netInterest = $('#netInterest').val();
  var bondsBank = $('#bondsBank').val();

  var fd = new FormData(this);

  // Check if parValue is a valid number
  if (isNaN(parValue)) {
    alert("Par Value must be a valid number.");
    return;
  }

  // Check if the par value exceeds the threshold
  if (parValue > 99999999) {
    // Confirm action if the threshold is exceeded and bank is not allowed
    if (bankName !== "UCPB Savings Bank" && bankName !== "Land Bank of the Philippines") {
      if (!confirm("You have exceeded the amount limit of P100,000,000.00. Do you still want to proceed?")) {
        return; // Exit if user cancels
      }
    }

    // Ensure all required fields are filled
    if (bankName && terms && interestRate && maturityDate && netInterest) {
      $.ajax({
        url: "add_treasury.php",
        type: "post",
        data: fd,
        contentType: false,
        processData: false,
        success: function (data) {
          var response = JSON.parse(data);
          if (response['result']) {
            var mytable = $('#reporttbl').DataTable();
            mytable.draw();
            mytable.ajax.reload();
            $('#treasuryAdd').modal('hide');
            alert(response['message']);
            $('#treasuryForm')[0].reset();
            window.location.reload();
          } else {
            alert(response['message']);
          }
        }
      });
    } else {
      alert('Fill all the required fields');
    }
  } else {
    // Normal (≤100M) path
    if (bankName && terms && interestRate && maturityDate && netInterest) {
      $.ajax({
        url: "add_treasury.php",
        type: "post",
        data: fd,
        contentType: false,
        processData: false,
        success: function (data) {
          var response = JSON.parse(data);
          if (response['result']) {
            var mytable = $('#reporttbl').DataTable();
            mytable.draw();
            mytable.ajax.reload();
            $('#treasuryAdd').modal('hide'); // changed to treasuryAdd since form is treasuryForm
            alert(response['message']);
            $('#treasuryForm')[0].reset();
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
});
