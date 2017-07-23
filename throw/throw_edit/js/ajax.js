$(document).ready(function() {
  $('#edit_trash').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/edittrashquery.php',
       data: $(this).serialize(),
       success: function(data)
  {
          if (data === 'done') {
      
         $('#loadingmessage').hide(); 
          setTimeout(function() {
        swal({
            title: "Successfully edited",
            text: "Successfully edited reason.",
            type: "success"
        }, function() {
            window.location = "../throw_list/";
      
        });
    }, 100);
       
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


