$(document).ready(function() {
  $('#list').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/x.php',
       data: $(this).serialize(),
       success: function(data)
	{
          if (data === 'done') {
$('#loadingmessage').hide();  // show the loading message.

		    $("#result").html("<div class='alert alert-warning'>There is no data available</div>");       

          
		}
		 
          else {
$('#loadingmessage').hide();  // show the loading message.
       	
          $("#result").html(data);       
   
          }
       }
   });
 });
});


