$(document).ready(function() {
  $('#form-password').submit(function(e) {
      $('#loadingmessage2').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/editpasswordquery.php',
       data: $(this).serialize(),
       success: function(data)
  {
          if (data === 'done') {
      
         $('#loadingmessage2').hide(); 
          setTimeout(function() {
        swal({
            title: "Successfully changed password",
            text: "Use this password next time you log in to the system.",
            type: "success"
        }, function() {
            window.location = "#";
      
        });
    }, 100);
          $('#form-password')[0].reset();
        document.getElementById("USER_FIRSTNAME").focus();
          }  
    else if (data == 'pass'){
        
      $('#loadingmessage2').hide(); 
          setTimeout(function() {
        swal({
            title: "Wrong Current Password",
            text: "Please try another password.",
            type: "warning"
        }, function() {
            window.location = "#";
      
        });
    }, 100);
          document.getElementById("CURRENT_PASSWORD").focus();
        
    }
          else {
          $('#loadingmessage2').hide(); 
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


