$(document).ready(function() {
  $('#hydro_form').submit(function(e) {
      $('#loadingmessage2').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/addhydro.php',
       data: $(this).serialize(),
       success: function(data)
	{
          if (data === 'done') {
		  
				 $('#loadingmessage2').hide(); 
				  setTimeout(function() {
        swal({
            title: "Successfully added",
            text: "Successfully moved under hydro testing.",
            type: "success"
        }, function() {
          location.reload();
        });
    }, 100);
          $('#hydro_form')[0].reset();
        document.getElementById("HYDRO_CYLINDER_REFERENCEID").focus();
          } 	
          else {
       		$('#hydro_form').hide(); 
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


