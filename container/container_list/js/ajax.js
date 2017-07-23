$(document).ready(function() {
  $('#cylinder_multiple').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/addmultiple.php',
       data: $(this).serialize(),
       success: function(data)
	{
          if (data === 'done') {
		  
				 $('#loadingmessage').hide(); 
				  setTimeout(function() {
        swal({
            title: "Successfully added",
            text: "Successfully throwing container(s).",
            type: "success"
        }, function() {
          location.reload();
        });
    }, 100);
          $('#cylinder_multiple')[0].reset();
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


