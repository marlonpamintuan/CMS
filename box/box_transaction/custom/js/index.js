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
					var BOXIN_BOXCODE2= $("#BOXIN_BOXCODE2").val();
					var BOXIN_RDI2 = $("#BOXIN_RDI2").val();
					

			if(BOXIN_BOXCODE2 == "") {
						$("#BOXIN_BOXCODE2").closest('.input-group').addClass('has-error');
						
					} else {
						$("#BOXIN_BOXCODE2").closest('.input-group').removeClass('has-error');
						$("#BOXIN_BOXCODE2").closest('.input-group').addClass('has-success');				
					}

					if(BOXIN_RDI2 == "") {
						$("#BOXIN_RDI2").closest('.input-group').addClass('has-error');
					} else {
						$("#BOXIN_RDI2").closest('.input-group').removeClass('has-error');
						$("#BOXIN_RDI2").closest('.input-group').addClass('has-success');				
					}

					if(BOXIN_BOXCODE2 && BOXIN_RDI2) {
					
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
				data: {BOXIN_ID : id},
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



function editMember(id = null) {
	if(id) {

		// remove the error 
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".edit-messages").html("");

		// remove the id
		$("#BOXOUT_ID").remove();

		// fetch the member data
		$.ajax({
			url: 'php_action/getSelectedMember.php',
			type: 'post',
			data: {BOXIN_ID : id},
			dataType: 'json',
			success:function(response) {
				$("#CUSTOMER_ID").val(response.CUSTOMER_ID);
				$("#BOXIN_BOXCODE").val(response.BOXIN_BOXCODE);
				$("#BOXIN_DICEWEIGHT").val(response.BOXIN_DICEWEIGHT);
				$("#BOXIN_BOXWEIGHT").val(response.BOXIN_BOXWEIGHT);
				$("#BOXIN_BOXSTATUS").val(response.BOXIN_STATUS);

				$("#BOXIN_GATEPASS").val(response.BOXIN_GATEPASS);
				$("#BOXIN_DATEOUT").val(response.BOXIN_DATEOUT);
				$("#BOXIN_TIMEOUT").val(response.BOXIN_TIMEOUT);
				$("#BOXIN_GUARDOUT").val(response.BOXIN_GUARDOUT);
				$("#BOXIN_DUTYOPERATOROUT").val(response.BOXIN_DUTYOPERATOROUT);
				// mmeber id 
				$(".editMemberModal").append('<input type="hidden" name="BOXIN_ID" id="BOXIN_ID" value="'+response.BOXIN_ID+'"/>');

				// here update the member data
				$("#updateMemberForm").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var CUSTOMER_ID = $("#CUSTOMER_ID").val();
					var BOXIN_BOXCODE = $("#BOXIN_BOXCODE").val();
					var BOXIN_DICEWEIGHT = $("#BOXIN_DICEWEIGHT").val();
					var BOXIN_BOXWEIGHT = $("#BOXIN_BOXWEIGHT").val();
					var BOXIN_BOXSTATUS = $("#BOXIN_BOXSTATUS").val();
					var BOXIN_GATEPASS = $("#BOXIN_GATEPASS").val();
					var BOXIN_DATEOUT = $("#BOXIN_DATEOUT").val();
					var BOXIN_TIMEOUT = $("#BOXIN_TIMEOUT").val();
					var BOXIN_GUARDOUT = $("#BOXIN_GUARDOUT").val();
					var BOXIN_DUTYOPERATOROUT = $("#BOXIN_DUTYOPERATOROUT").val();


					if(CUSTOMER_ID == "") {
						$("#CUSTOMER_ID").closest('.input-group').addClass('has-error');
						
					} else {
						$("#CUSTOMER_ID").closest('.input-group').removeClass('has-error');
						$("#CUSTOMER_ID").closest('.input-group').addClass('has-success');				
					}

					if(BOXIN_BOXCODE == "") {
						$("#BOXIN_BOXCODE").closest('.input-group').addClass('has-error');
					} else {
						$("#BOXIN_BOXCODE").closest('.input-group').removeClass('has-error');
						$("#BOXIN_BOXCODE").closest('.input-group').addClass('has-success');				
					}

					if(BOXIN_DICEWEIGHT == "") {
						$("#BOXIN_DICEWEIGHT").closest('.input-group').addClass('has-error');
						//$("#BOOKING_PCITY").after('<p class="text-danger">The Contact field is required</p>');
					} else {
						$("#BOXIN_DICEWEIGHT").closest('.input-group').removeClass('has-error');
						$("#BOXIN_DICEWEIGHT").closest('.input-group').addClass('has-success');				
					}

					if(BOXIN_BOXWEIGHT == "") {
						$("#BOXIN_BOXWEIGHT").closest('.input-group').addClass('has-error');
					} else {
						$("#BOXIN_BOXWEIGHT").closest('.input-group').removeClass('has-error');
						$("#BOXIN_BOXWEIGHT").closest('.input-group').addClass('has-success');				
					}
					if(BOXIN_BOXSTATUS == "") {
						$("#BOXIN_BOXSTATUS").closest('.input-group').addClass('has-error');
					} else {
						$("#BOXIN_BOXSTATUS").closest('.input-group').removeClass('has-error');
						$("#BOXIN_BOXSTATUS").closest('.input-group').addClass('has-success');				
					}
					if(BOXIN_GATEPASS == "") {
						$("#BOXIN_GATEPASS").closest('.input-group').addClass('has-error');
					} else {
						$("#BOXIN_GATEPASS").closest('.input-group').removeClass('has-error');
						$("#BOXIN_GATEPASS").closest('.input-group').addClass('has-success');				
					}
					if(BOXIN_DATEOUT == "") {
						$("#BOXIN_DATEOUT").closest('.input-group').addClass('has-error');
					} else {
						$("#BOXIN_DATEOUT").closest('.input-group').removeClass('has-error');
						$("#BOXIN_DATEOUT").closest('.input-group').addClass('has-success');				
					}
					if(BOXIN_TIMEOUT == "") {
						$("#BOXIN_TIMEOUT").closest('.input-group').addClass('has-error');
					} else {
						$("#BOXIN_TIMEOUT").closest('.input-group').removeClass('has-error');
						$("#BOXIN_TIMEOUT").closest('.input-group').addClass('has-success');				
					}
					if(BOXIN_GUARDOUT == "") {
						$("#BOXIN_GUARDOUT").closest('.input-group').addClass('has-error');
					} else {
						$("#BOXIN_GUARDOUT").closest('.input-group').removeClass('has-error');
						$("#BOXIN_GUARDOUT").closest('.input-group').addClass('has-success');				
					}
					if(BOXIN_DUTYOPERATOROUT == "") {
						$("#BOXIN_DUTYOPERATOROUT").closest('.input-group').addClass('has-error');
					} else {
						$("#BOXIN_DUTYOPERATOROUT").closest('.input-group').removeClass('has-error');
						$("#BOXIN_DUTYOPERATOROUT").closest('.input-group').addClass('has-success');				
					}
					
					if(CUSTOMER_ID && BOXIN_BOXCODE && BOXIN_BOXWEIGHT && BOXIN_DICEWEIGHT && BOXIN_BOXSTATUS && BOXIN_GATEPASS && BOXIN_DATEOUT && BOXIN_TIMEOUT && BOXIN_GUARDOUT && BOXIN_DUTYOPERATOROUT) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if(response.success == true) {
									$(".edit-messages").html('<div id="success-edit" class="alert alert-success alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
									'</div>');
										  $("#success-edit").fadeTo(1500, 500).slideUp(500, function(){
                $("#success-edit").slideUp(500);
				
                });  

									// reload the datatables
									manageMemberTable.ajax.reload(null, false);
									// this function is built in function of datatables;

									// remove the error 
									$(".input-group").removeClass('has-success').removeClass('has-error');
									$(".text-danger").remove();
								} else {
									$(".edit-messages").html('<div id="warning-edit" class="alert alert-warning alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
									'</div>');
										  $("#warning-edit").fadeTo(1500, 500).slideUp(500, function(){
                $("#warning-edit").slideUp(500);
				
                });  
								}
							} // /success
						}); // /ajax
					} // /if

					return false;
				});

			} // /success
		}); // /fetch selected member info

	} else {
		alert("Error : Refresh the page again");
	}
}