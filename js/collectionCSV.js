$(document).ready(function(){
  $(document).on('submit', '#csvForm', function(e){
    e.preventDefault();
    var fd = new FormData(this);
    // var files = $('#file')[0].files[0];
    // fd.append('file',files);

    // AJAX request
    $.ajax({
      url: 'dueCollectionUpload.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        if(response != 0){
          // Show image preview
          alert('successfully!');
          window.location.reload();
          // $('#preview').append("<img src='"+response+"' width='100' height='100' style='display: inline-block;'>");
        }else{
          alert('file not uploaded');
        }
      }
    });
  });
});