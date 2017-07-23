$(document).ready(function() {
  $('#add_formcustomer').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/addcustomerquery.php',
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
          $('#add_formcustomer')[0].reset();
        document.getElementById("CUSTOMER_NAME").focus();
          }  else if (data == 'duplicate'){
			 
			$('#loadingmessage').hide(); 
			  setTimeout(function() {
        swal({
            title: "Contact number already exist",
            text: "Please try another contact number.",
            type: "warning"
        }, function() {
            window.location = "#";
      
        });
    }, 100);
        document.getElementById("CUSTOMER_CONTACTNUMBER").value = "";
     
      document.getElementById("CUSTOMER_CONTACTNUMBER").focus();
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
    document.getElementById("CUSTOMER_EMAIL").value = "";
      document.getElementById("CUSTOMER_EMAIL").focus();
         
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


