$(document).ready(function(){
    var xhr; // Variable to store the AJAX request object
    $('#tagg').keyup(function(event){
        var input = $(this).val();
        var atIndex = input.indexOf('@');
        var chat1 = $('#tagg').val();

        if(input === '') {
            $('#suggestions').html('');
            return; // Exit the function
        }
        
        // pang-handle to ng multiple @ tagging.
        while(atIndex !== -1 && atIndex !== input.length - 1 && input.charAt(atIndex + 1) !== ' ' && chat1) {
            var query = input.substring(atIndex + 1);
            // Abort previous AJAX request if it's still running
            if(xhr && xhr.readyState !== 4){
                xhr.abort();
            }
            // Perform new AJAX request
                xhr = $.ajax({
                    url: 'fetch_names.php',
                    method: 'POST',
                    data: {value: query},
                    success: function(response){
                        $('#suggestions').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
                // Find the next "@" index  
                atIndex = input.indexOf('@', atIndex + 1);
        }
    });

    // Handle click event on suggestions
    $(document).on('click', '#suggestions div', function(){
        var selectedName = $(this).text();
        var input = $('#tagg');
        var atIndex = input.val().lastIndexOf('@');
        if(atIndex !== -1) {
            var cursorPosition = input[0].selectionStart;
            var textBeforeCursor = input.val().substring(0, cursorPosition);
            var newText = textBeforeCursor.substring(0, atIndex + 1) + selectedName + ', ';
            input.val(newText);
            input.focus();
            $('#suggestions').html(''); // Clear suggestions after selection
        }
    });
});