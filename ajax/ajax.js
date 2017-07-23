$(document).ready(function() {
  $('#today_cylinder').submit(function(e) {
      $('#loadingmessages').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/cylinder_today.php',
       data: $(this).serialize(),
       success: function(data)
	{
          if (data === 'done') {
		  
				 $('#loadingmessages').hide(); 
				  setTimeout(function() {
        swal({
            title: "Successfully added",
            text: "Successfully saving today's transaction.",
          
            type: "success"
        }, function() {
          $('#myModal2').modal('toggle');
       
        });
    }, 100);
          $('#today_cylinder')[0].reset();
    
          }
		 else if (data === 'exist') {
      
         $('#loadingmessages').hide(); 
          setTimeout(function() {
        swal({
            title: "You've already saved today's cylinder status",
            text: "Please try another date.",
          
            type: "warning"
        }, function() {
        
      
        });
    }, 100);
          $('#today_cylinder')[0].reset();
    
          }  
     
          else {
       		$('#loadingmessages').hide(); 
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


