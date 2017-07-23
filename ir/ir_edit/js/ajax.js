$(document).ready(function() {
  $('#edit_transac').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/edittransacquery.php',
       data: $(this).serialize(),
       success: function(data)
  {
          if (data === 'done') {
      
         $('#loadingmessage').hide(); 
          setTimeout(function() {
        swal({
            title: "Successfully edited",
            text: "Successfully edited user information.",
            type: "success"
        }, function() {
            window.location = "../ir_list/";
      
        });
    }, 100);
          $('#edit_transac')[0].reset();
       
          }  
   
          else {
          $('#loadingmessage').hide(); 
           setTimeout(function() {
        swal({
            title: "Something went wrong",
            text: data,
            type: "warning"
        }, function() {
            window.location = "#";
      
        });
    }, 100);   
          }
       }
   });
 });
});


