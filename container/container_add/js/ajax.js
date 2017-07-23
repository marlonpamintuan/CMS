$(document).ready(function() {
  $('#add_formcylinder').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/addcylinderquery.php',
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
            window.location = "#";
      
        });
    }, 100);
          $('#add_formcylinder')[0].reset();
        document.getElementById("CYLINDER_REFERENCEID").focus();
          }  else if (data == 'duplicate'){
			 
			$('#loadingmessage').hide(); 
			  setTimeout(function() {
        swal({
            title: "Serial number already exist",
            text: "Please try another container serial number.",
            type: "warning"
        }, function() {
            window.location = "#";
      
        });
    }, 100);
    
		}
	else if (data == 'maintenance'){
       
      $('#loadingmessage').hide(); 
        setTimeout(function() {
        swal({
            title: "This container is under maintenance",
            text: "Please try another cylinder serial number or kindly recover this container from maintenance.",
            type: "warning"
        }, function() {
            window.location = "#";
      
        });
    }, 100);
 
    } else if (data == 'dr'){
       
      $('#loadingmessage').hide(); 
        setTimeout(function() {
        swal({
            title: "This serial number is in DR",
            text: "Please try another cylinder serial number.",
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
            text: "Please contact the developer for this problem.",
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


