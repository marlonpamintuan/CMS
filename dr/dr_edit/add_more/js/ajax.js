$(document).ready(function() {
  $('#add_formdr').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/adddrquery.php',
       data: $(this).serialize(),
       success: function(data)
	{
          if (data === 'done') {
		  
				 $('#loadingmessage').hide(); 
				  setTimeout(function() {
        swal({
            title: "Successfully Saved",
            text: "Successfully saved today's transaction.",
          
            type: "success"
        }, function() {
            location.reload();
      
        });
    }, 100);
          $('#add_formdr')[0].reset();
    
          }else if (data === 'date') {
      
         $('#loadingmessage').hide(); 
          setTimeout(function() {
        swal({
            title: "Invalid Date Format",
            text: "Please check the starting date and the due date.",
          
            type: "warning"
        });
    }, 100);
        
    
          
    
          }else if (data === 'not') {
      
         $('#loadingmessage').hide(); 
          setTimeout(function() {
        swal({
            title: "Not",
            text: "Please check the starting date and the due date.",
          
            type: "warning"
        });
    }, 100);
        
    
          }  
		
          else {
            $('#loadingmessage').hide(); 
           	$("#result").html(data);			 

      
          }
       }
   });
 });
});


