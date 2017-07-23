$(document).ready(function() {
  $('#today_cylinderundo').submit(function(e) {
      $('#loadingmessages2').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/cylinder_todayundo.php',
       data: $(this).serialize(),
       success: function(data)
	{
          if (data === 'done') {
		  
				 $('#loadingmessages2').hide(); 
				  setTimeout(function() {
        swal({
            title: "Successfully Undo",
            text: "successfully deleted previous save",
            type: "success"
        }, function() {
      
        });
    }, 100);
          $('#today_cylinderundo')[0].reset();
    
          }
	
     
          else {
       		$('#loadingmessages2').hide(); 
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


