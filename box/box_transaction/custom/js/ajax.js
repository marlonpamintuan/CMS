$(document).ready(function() {
  $('#box_form').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php_action/create.php',
       data: $(this).serialize(),
       success: function(data)
	{
          if (data === 'done') {
		  
				 $('#loadingmessage').hide(); 
				  setTimeout(function() {
        swal({
            title: "Successfully added",
            text: "Successfully added new cylinder.",
            type: "success"
        }, function() {
         window.location = "../../";
      
        });
    }, 100);
          $('#box_form')[0].reset();
       } 
           else if (data == 'not'){
			 
			$('#loadingmessage').hide(); 
			  setTimeout(function() {
        swal({
            title: "No data",
            text: "Please make sure that you input valid data.",
            type: "warning"
        }, function() {
            window.location = "#";
      
        });
    }, 100);
    
		}
    /*
    #IF CLIENT WANTS DUPLICATION ON GATEPASS
    else if (data == 'gate'){
       
      $('#loadingmessage').hide(); 
        setTimeout(function() {
        swal({
            title: "Duplicate Gate Pass Number",
            text: "Please try other gate pass number.",
            type: "warning"
        }, function() {
            window.location = "#";
      
        });
    }, 100);
    
    }
    */

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


