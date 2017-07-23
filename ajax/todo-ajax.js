$(document).ready(function() {
  $('#todo_form').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/todo_add.php',
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
        });
    }, 100);
          $('#todo_form')[0].reset();
        document.getElementById("TODO_INFO").focus();
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


