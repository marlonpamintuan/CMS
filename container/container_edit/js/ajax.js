$(document).ready(function() {
  $('#edit_formcylinder').submit(function(e) {
      $('#loadingmessage').show();  // show the loading message.

    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/editcylinderquery.php',
       data: $(this).serialize(),
       success: function(data)
  {
          if (data === 'done') {
      
         $('#loadingmessage').hide(); 
          setTimeout(function() {
        swal({
            title: "Successfully edited",
            text: "Successfully edited cylinder information.",
            type: "success"
        }, function() {
            window.location = "../container_list/";
      
        });
    }, 100);
          $('#edit_formcylinder')[0].reset();
        document.getElementById("USER_FIRSTNAME").focus();
          }  else if (data == 'duplicate'){
       
      $('#loadingmessage').hide(); 
        setTimeout(function() {
        swal({
            title: "Serial number already exist",
            text: "Please try another cylinder serial number.",
            type: "warning"
        }, function() {
            window.location = "#";
      
        });
    }, 100);
        document.getElementById("CYLINDER_REFERENCEID").value = "";
     
      document.getElementById("CYLINDER_REFERENCEID").focus();
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
 
    }else if (data == 'dr'){
       
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
            title: data,
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


