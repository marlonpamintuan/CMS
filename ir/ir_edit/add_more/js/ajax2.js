$(document).ready(function() {
  $('#history').submit(function(e) {
  $('#loadingmessage2').show();
    e.preventDefault();
    $.ajax({
       type: "POST",
       url: 'php/history.php',
       data: $(this).serialize(),
       success: function(data)
       {
          if (data === 'no') {
           $("#result").html("<div id='danger-alert2' class='alert alert-dismissable text-center' style='background:bisque;'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><span style='font-size:30px;' class='fa fa-warning text-warning pull-left'></span> <strong>SORRY BUT NO RECORDS FOUND </strong></div>");
        $('#loadingmessage2').hide();
        $("#danger-alert2").alert();
                $("#danger-alert2").fadeTo(1500, 500).fadeOut(4000, function(){
                $("#danger-alert2").slideUp(1000);
                }); 
       }
      
          else{
      $("#result").html(data);
      $('#loadingmessage2').hide();
        
      }
       }
   });
 });
});