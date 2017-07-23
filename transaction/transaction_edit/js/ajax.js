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
            window.location = "../transaction_list/";
      
        });
    }, 100);
          $('#edit_transac')[0].reset();
       
          }  
   
          else {
          $('#loadingmessage').hide(); 
           setTimeout(function() {
        swal({
            title: data,
            text: "Please contact the developer for this problem.",
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


