
<div class="container">
    <form id="myform" method="post" action="payotherdeduction.php">
        <input type="hidden" name="id" value="">
        <div class="d-flex flex-column gap-3">
            <div class="input-group">
                <span class="input-group-text">Employee ID</span>
                <input require placeholder="Input Employee ID" value="" required class="form-control" name="empid" id="empid" type="number">
            </div>
            <div class="input-group">
                <span class="input-group-text">Name</span>
                <input readonly  required class="form-control" name="name" id="name" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text">Position</span>
                <input readonly required class="form-control" name="bankPosition" id="bankPosition" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text">Branch</span>
                <input readonly  required class="form-control" name="address" id="address" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text">Amount</span>
                <input require placeholder="Input Amount" value="" required class="form-control" name="otherpayment" id="otherpayment" type="number">
            </div>
            <div class="input-group">
                <span class="input-group-text">Remarks</span>
                <input require placeholder="Input Remarks" value="" required class="form-control" name="remarks" id="remarks" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-text">Date</span>
                <input required placeholder="Input Date" value="" class="form-control" name="date" id="date" type="date">
            </div>
            <div class="d-flex align-items-center justify-content-center flex-row gap-3">
                <button type="submit" id="btnsave" class="btn btn-primary">SAVE</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
            </div>
        </div>
    </form>
</div>

<script>

$('#myform').submit(function(){
    return confirm('Do you want to save it?');
});

$('#empid').keyup(function(){
    var id = $(this).val();

    $.ajax({
    url: 'payreadotherdeductionform.php',
    method: 'GET',
    data: { id: id },
    dataType: 'json', // Specify the expected data type as JSON
    success: function(response) {
        // Handle the response data here
        console.log(response); // Check the structure of the response in the console
        // Access and set the values of input fields
        $('#name').val(response.fullName);
        $('#bankPosition').val(response.bankPosition);
        $('#address').val(response.address);
    },
    error: function(xhr, status, error) {
        // Handle errors
        console.error(xhr.responseText);
    }
});

});

</script>