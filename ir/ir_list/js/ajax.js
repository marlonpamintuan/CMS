$(document).ready(function() {
  $('#delete_ir').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/delete_query.php',
       data: $(this).serialize(),
       success: function(data)
	{
          if (data === 'done') {
		  
				 $('#loadingmessage').hide(); 
				  setTimeout(function() {
        swal({
            title: "Make sure that you also deleted the DR Number of this IR Number",
            text: "Successfully Deleted IR Number.",
          
            type: "success"
        }, function() {
            location.reload();
      
        });
    }, 100);
          $('#delete_ir')[0].reset();
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


