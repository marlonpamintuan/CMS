$(document).ready(function() {
  $('#USER_LOGIN').submit(function(e) {
  $('#loadingmessage_login').show();
    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/login.php',
       data: $(this).serialize(),
       success: function(data)
       {
          if (data === 'Login') {
            $('#loadingmessage_login').hide();
            window.location = '../';
			
		  }
		  
		  else if(data === 'no'){
		  $('#loadingmessage_login').hide();
		 setTimeout(function() {
        swal({
            title: "Invalid Username or Password!",
            text: "Check your username or password.",
            type: "warning"
        }, function() {
            window.location = "#";
      
        });
    }, 100);  
		  }else if(data === 'customer'){
		  $('#loadingmessage_login').hide();
		   window.location = '../../../';
		  }
          else {
		  username=$("#username").val("");
          password=$("#password").val("");
           $("#result_login").html("<div id='danger-alert2' class='alert alert-danger alert-dismissable text-center'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b><span class='fa fa-exclamation-circle'></span>&nbsp;&nbsp;Sorry, Something went wrong. </b></div></div>");
		   	$('#loadingmessage_login').hide();
			$("#danger-alert2").alert();
                $("#danger-alert2").fadeTo(1500, 500).slideUp(500, function(){
                $("#danger-alert2").slideUp(500);
                }); 
          }
       }
   });
 });
});