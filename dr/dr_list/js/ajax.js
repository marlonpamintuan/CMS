$(document).ready(function() {
  $('#delete_dr').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php_action/delete_query.php',
       data: $(this).serialize(),
       success: function(data)
	{
          if (data === 'done') {
		  
				 $('#loadingmessage').hide(); 
				  setTimeout(function() {
        swal({
            title: "Successfully Deleted",
            text: "Successfully Deleted DR Number.",
          
            type: "success"
        }, function() {
            location.reload();
      
        });
    }, 100);
          $('#delete_dr')[0].reset();
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


