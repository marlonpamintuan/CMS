$(document).ready(function() {
  $('#add_formuser').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/adduserquery.php',
       data: $(this).serialize(),
       success: function(data)
	{
          if (data === 'done') {
		  
				 $('#loadingmessage').hide(); 
				  setTimeout(function() {
        swal({
            title: "Successfully added",
            text: "Successfully added new user.",
            type: "success"
        }, function() {
            window.location = "#";
      
        });
    }, 100);
          $('#add_formuser')[0].reset();
        document.getElementById("USER_FIRSTNAME").focus();
          }  else if (data == 'duplicate'){
			 
			$('#loadingmessage').hide(); 
			  setTimeout(function() {
        swal({
            title: "Username already exist",
            text: "Please try another username.",
            type: "warning"
        }, function() {
            window.location = "#";
      
        });
    }, 100);
        document.getElementById("USER_USERNAME").value = "";
     
      document.getElementById("USER_USERNAME").focus();
		}
		else if (data == 'email'){
			  
			$('#loadingmessage').hide(); 
			    setTimeout(function() {
        swal({
            title: "Email already exist",
            text: "Please try another email address.",
            type: "warning"
        }, function() {
            window.location = "#";
      
        });
    }, 100);
    document.getElementById("USER_EMAIL").value = "";
      document.getElementById("USER_EMAIL").focus();
         
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


