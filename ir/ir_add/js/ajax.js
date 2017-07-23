$(document).ready(function() {
  $('#add_formir').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/addirquery.php',
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
          $('#add_formir')[0].reset();
    
          }  else if(data === 'not'){
              $('#loadingmessage').hide(); 
           setTimeout(function() {
        swal({
            title: "Oops, Invalid Data",
            text: "Make sure that container(s) is/are borrowed by that customer",
            type: "warning"
        }, function() {
            window.location = "#";
      
        });
    }, 100);
          }else if (data === 'ir') {
      
         $('#loadingmessage').hide(); 
          setTimeout(function() {
        swal({
            title: "Duplicate IR No",
            text: "Please check the ir number make sure it is unique.",
          
            type: "warning"
        });
    }, 100);
        
    
          }else if(data === 'date'){
              $('#loadingmessage').hide(); 
           setTimeout(function() {
        swal({
            title: "Oops, Invalid Data",
            text: "Make sure that returning date is less than borrowed date",
            type: "warning"
        }, function() {
            window.location = "#";
      
        });
    }, 100);
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


