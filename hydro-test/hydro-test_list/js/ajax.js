$(document).ready(function() {
  $('#cylinder_retrieve').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/retrieve.php',
       data: $(this).serialize(),
       success: function(data)
	{
          if (data === 'done') {
		  
				 $('#loadingmessage').hide(); 
				  setTimeout(function() {
        swal({
            title: "Successfully Retrieved",
            text: "Successfully back to container list.",
            type: "success"
        }, function() {
          location.reload();
        });
    }, 100);
          $('#cylinder_retrieve')[0].reset();
        document.getElementById("CYLINDER_REFERENCEID").focus();
          } 	
          else {
       		$('#loadingmessage').hide(); 
           setTimeout(function() {
        swal({
            title: "Something went wrong",
            text: data,
            type: "warning"
        }, function() {
            location.reload();
      
        });
    }, 100);   
          }
       }
   });
 });
});


