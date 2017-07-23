// global the manage memeber table 
var manageMemberTable;

$(document).ready(function() {
	manageMemberTable = $("#manageMemberTable").DataTable({
		"ajax": "php_action/retrieve.php",
		"order": []
	});

	$("#addMemberModalBtn").on('click', function() {
		// reset the form 
		$("#createMemberForm")[0].reset();
		// remove the error 
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".messages").html("");

		// submit form
		$("#createMemberForm").unbind('submit').bind('submit', function() {

			$(".text-danger").remove();

			var form = $(this);

			// validation
					var CUSTOMER_ID = $("#CUSTOMER_ID").val();
					var TEMP_BOXCODE = $("#TEMP_BOXCODE").val();
					var TEMP_BOXSTATUS = $("#TEMP_BOXSTATUS").val();
					var TEMP_DICEWEIGHT = $("#TEMP_DICEWEIGHT").val();
					var TEMP_BOXWEIGHT = $("#TEMP_BOXWEIGHT").val();
				
		

			if(CUSTOMER_ID == "") {
						$("#CUSTOMER_ID").closest('.input-group').addClass('has-error');
						
					} else {
						$("#CUSTOMER_ID").closest('.input-group').removeClass('has-error');
						$("#CUSTOMER_ID").closest('.input-group').addClass('has-success');				
					}

					if(TEMP_BOXCODE == "") {
						$("#TEMP_BOXCODE").closest('.input-group').addClass('has-error');
					} else {
						$("#TEMP_BOXCODE").closest('.input-group').removeClass('has-error');
						$("#TEMP_BOXCODE").closest('.input-group').addClass('has-success');				
					}

					if(TEMP_BOXSTATUS == "") {
						$("#TEMP_BOXSTATUS").closest('.input-group').addClass('has-error');
						//$("#BOOKING_PCITY").after('<p class="text-danger">The Contact field is required</p>');
					} else {
						$("#TEMP_BOXSTATUS").closest('.input-group').removeClass('has-error');
						$("#TEMP_BOXSTATUS").closest('.input-group').addClass('has-success');				
					}

					if(TEMP_DICEWEIGHT == "") {
						$("#TEMP_DICEWEIGHT").closest('.input-group').addClass('has-error');
					} else {
						$("#TEMP_DICEWEIGHT").closest('.input-group').removeClass('has-error');
						$("#TEMP_DICEWEIGHT").closest('.input-group').addClass('has-success');				
					}
				
					if(TEMP_BOXWEIGHT == "") {
						$("#TEMP_BOXWEIGHT").closest('.input-group').addClass('has-error');
						} else {
						$("#TEMP_BOXWEIGHT").closest('.input-group').removeClass('has-error');
						$("#TEMP_BOXWEIGHT").closest('.input-group').addClass('has-success');				
					}
				
					
					
					if(CUSTOMER_ID && TEMP_BOXCODE && TEMP_BOXSTATUS && TEMP_DICEWEIGHT && TEMP_BOXWEIGHT) {
					
				//submi the form to server
				$.ajax({
					url : form.attr('action'),
					type : form.attr('method'),
					data : form.serialize(),
					dataType : 'json',
					success:function(response) {

						// remove the error 
						$(".form-group").removeClass('has-error').removeClass('has-success');

						if(response.success == true) {
							$(".messages").html('<div id="success-create" class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');
						$("#success-create").fadeTo(1500, 500).slideUp(500, function(){
                $("#success-create").slideUp(500);
				
                });  
							// reset the form
							$("#createMemberForm")[0].reset();		

							// reload the datatables
							manageMemberTable.ajax.reload(null, false);
							// this function is built in function of datatables;

						} else {
							$(".messages").html('<div id="warning-create" class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
											  $("#warning-create").fadeTo(1500, 500).slideUp(500, function(){
                $("#warning-create").slideUp(500);
				
                });  
						}  // /else
					} // success  
				}); // ajax subit 				
			} /// if


			return false;
		}); // /submit form for create member
	}); // /add modal

});

function removeMember(id = null) {
	if(id) {
		// click on remove button
		$("#removeBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: 'php_action/remove.php',
				type: 'post',
				data: {TEMP_ID : id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {						
						$(".removeMessages").html('<div id="success-remove" class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');
							  $("#success-remove").fadeTo(1500, 500).slideUp(500, function(){
                $("#success-remove").slideUp(500);
				
                });  

						// refresh the table
						manageMemberTable.ajax.reload(null, false);

						// close the modal
						$("#removeMemberModal").modal('hide');

					} else {
						$(".removeMessages").html('<div id="warning-remove" class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
							  $("#warning-remove").fadeTo(1500, 500).slideUp(500, function(){
                $("#warning-remove").slideUp(500);
				
                });  
					}
				}
			});
		}); // click remove btn
	} else {
		alert('Error: Refresh the page again');
	}
}

