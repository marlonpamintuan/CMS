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
					var BOOKING_PSENDER = $("#BOOKING_PSENDER").val();
					var BOOKING_PCONTACTNUMBER = $("#BOOKING_PCONTACTNUMBER").val();
					var BOOKING_PCITY = $("#BOOKING_PCITY").val();
					var BOOKING_PADDRESS = $("#BOOKING_PADDRESS").val();
					var BOOKING_PLANDMARK = $("#BOOKING_PLANDMARK").val();
					var BOOKING_DCONSIGNEE = $("#BOOKING_DCONSIGNEE").val();
					var BOOKING_DCONTACTNUMBER = $("#BOOKING_DCONTACTNUMBER").val();
					var BOOKING_DCITY = $("#BOOKING_DCITY").val();
					var BOOKING_DADDRESS = $("#BOOKING_DADDRESS").val();
					var BOOKING_DLANDMARK = $("#BOOKING_DLANDMARK").val();
					var BOOKING_TYPE = $("#BOOKING_TYPE").val();
					var BOOKING_WEIGHT = $("#BOOKING_WEIGHT").val();
					var BOOKING_SIZE = $("#BOOKING_SIZE").val();
					var BOOKING_REMARKS = $("#BOOKING_REMARKS").val();
					var BOOKING_INSURANCE = $("#BOOKING_INSURANCE").val();
					var BOOKING_PRICE = $("#BOOKING_PRICE").val();
		

			if(BOOKING_PSENDER == "") {
						$("#BOOKING_PSENDER").closest('.input-group').addClass('has-error');
						
					} else {
						$("#BOOKING_PSENDER").closest('.input-group').removeClass('has-error');
						$("#BOOKING_PSENDER").closest('.input-group').addClass('has-success');				
					}

					if(BOOKING_PCONTACTNUMBER == "") {
						$("#BOOKING_PCONTACTNUMBER").closest('.input-group').addClass('has-error');
					} else {
						$("#BOOKING_PCONTACTNUMBER").closest('.input-group').removeClass('has-error');
						$("#BOOKING_PCONTACTNUMBER").closest('.input-group').addClass('has-success');				
					}

					if(BOOKING_PCITY == "") {
						$("#BOOKING_PCITY").closest('.input-group').addClass('has-error');
						//$("#BOOKING_PCITY").after('<p class="text-danger">The Contact field is required</p>');
					} else {
						$("#BOOKING_PCITY").closest('.input-group').removeClass('has-error');
						$("#BOOKING_PCITY").closest('.input-group').addClass('has-success');				
					}

					if(BOOKING_PADDRESS == "") {
						$("#BOOKING_PADDRESS").closest('.input-group').addClass('has-error');
					} else {
						$("#BOOKING_PADDRESS").closest('.input-group').removeClass('has-error');
						$("#BOOKING_PADDRESS").closest('.input-group').addClass('has-success');				
					}
				
					if(BOOKING_DCONSIGNEE == "") {
						$("#BOOKING_DCONSIGNEE").closest('.input-group').addClass('has-error');
						} else {
						$("#BOOKING_DCONSIGNEE").closest('.input-group').removeClass('has-error');
						$("#BOOKING_DCONSIGNEE").closest('.input-group').addClass('has-success');				
					}
					if(BOOKING_DCONTACTNUMBER == "") {
						$("#BOOKING_DCONTACTNUMBER").closest('.input-group').addClass('has-error');
					} else {
						$("#BOOKING_DCONTACTNUMBER").closest('.input-group').removeClass('has-error');
						$("#BOOKING_DCONTACTNUMBER").closest('.input-group').addClass('has-success');				
					}
					if(BOOKING_DCITY == "") {
						$("#BOOKING_DCITY").closest('.input-group').addClass('has-error');
				} else {
						$("#BOOKING_DCITY").closest('.input-group').removeClass('has-error');
						$("#BOOKING_DCITY").closest('.input-group').addClass('has-success');				
					}
					if(BOOKING_DADDRESS == "") {
						$("#BOOKING_DADDRESS").closest('.input-group').addClass('has-error');
					} else {
						$("#BOOKING_DADDRESS").closest('.input-group').removeClass('has-error');
						$("#BOOKING_DADDRESS").closest('.input-group').addClass('has-success');				
					}
										if(BOOKING_TYPE == "") {
						$("#BOOKING_TYPE").closest('.input-group').addClass('has-error');
					} else {
						$("#BOOKING_TYPE").closest('.input-group').removeClass('has-error');
						$("#BOOKING_TYPE").closest('.input-group').addClass('has-success');				
					}
						if(BOOKING_PAYMENT == "") {
						$("#BOOKING_PAYMENT").closest('.input-group').addClass('has-error');
					} else {
						$("#BOOKING_PAYMENT").closest('.input-group').removeClass('has-error');
						$("#BOOKING_PAYMENT").closest('.input-group').addClass('has-success');				
					}
						
						if(BOOKING_PRICE == "") {
						$("#BOOKING_PRICE").closest('.input-group').addClass('has-error');
					} else {
						$("#BOOKING_PRICE").closest('.input-group').removeClass('has-error');
						$("#BOOKING_PRICE").closest('.input-group').addClass('has-success');				
					}
					if(BOOKING_PSENDER && BOOKING_PCONTACTNUMBER && BOOKING_PCITY && BOOKING_PADDRESS && BOOKING_DCONSIGNEE && BOOKING_DCONTACTNUMBER && BOOKING_DCITY && BOOKING_DADDRESS && BOOKING_PRICE && BOOKING_PAYMENT) {
					
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
				data: {BOXOUT_ID : id},
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

function pickup(id = null) {
	if(id) {
		// click on remove button
		$("#pickupBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: 'php_action/pickup.php',
				type: 'post',
				data: {BOOKING_ID : id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {						
						$(".pickupMessages").html('<div id="success-pickup" class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');
	  $("#success-pickup").fadeTo(1500, 500).slideUp(500, function(){
                $("#success-pickup").slideUp(500);
				
                });  
						// refresh the table
						manageMemberTable.ajax.reload(null, false);

						// close the modal
						$("#pickupMemberModal").modal('hide');

					} else {
						$(".pickupMessages").html('<div id="warning-pickup" class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
							  $("#warning-pickup").fadeTo(1500, 500).slideUp(500, function(){
                $("#warning-pickup").slideUp(500);
				
                });  
					}
				}
			});
		}); // click remove btn
	} else {
		alert('Error: Refresh the page again');
	}
}
function send(id = null) {
	if(id) {
		// click on remove button
		$("#sendBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: 'php_action/send.php',
				type: 'post',
				data: {BOOKING_ID : id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {						
						$(".sendMessages").html('<div id="success-send" class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');
	  $("#success-send").fadeTo(1500, 500).slideUp(500, function(){
                $("#success-send").slideUp(500);
				
                });  
						// refresh the table
						manageMemberTable.ajax.reload(null, false);

						// close the modal
						$("#sendModal").modal('hide');

					} else {
						$(".sendMessages").html('<div id="warning-send" class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
							  $("#warning-send").fadeTo(1500, 500).slideUp(500, function(){
                $("#warning-send").slideUp(500);
				
                });  
					}
				}
			});
		}); // click remove btn
	} else {
		alert('Error: Refresh the page again');
	}
}
function delivery(id = null) {
	if(id) {
		// click on remove button
		$("#deliveryBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: 'php_action/delivery.php',
				type: 'post',
				data: {BOOKING_ID : id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {						
						$(".deliveryMessages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');

						// refresh the table
						manageMemberTable.ajax.reload(null, false);

						// close the modal
						$("#deliveryMemberModal").modal('hide');

					} else {
						$(".deliveryMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
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
			data: {BOXOUT_ID : id},
			dataType: 'json',
			success:function(response) {
				$("#CUSTOMER_ID").val(response.CUSTOMER_ID);
				$("#BOXOUT_BOXCODE").val(response.BOXOUT_BOXCODE);
				$("#BOXOUT_DICEWEIGHT").val(response.BOXOUT_DICEWEIGHT);
				$("#BOXOUT_BOXWEIGHT").val(response.BOXOUT_BOXWEIGHT);
				$("#BOXOUT_BOXSTATUS").val(response.BOXOUT_BOXSTATUS);
				
				// mmeber id 
				$(".editMemberModal").append('<input type="hidden" name="BOXOUT_ID" id="BOXOUT_ID" value="'+response.BOXOUT_ID+'"/>');

				// here update the member data
				$("#updateMemberForm").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var CUSTOMER_ID = $("#CUSTOMER_ID").val();
					var BOXOUT_BOXCODE = $("#BOXOUT_BOXCODE").val();
					var BOXOUT_DICEWEIGHT = $("#BOXOUT_DICEWEIGHT").val();
					var BOXOUT_BOXWEIGHT = $("#BOXOUT_BOXWEIGHT").val();
					var BOXOUT_BOXSTATUS = $("#BOXOUT_BOXSTATUS").val();

					if(CUSTOMER_ID == "") {
						$("#CUSTOMER_ID").closest('.input-group').addClass('has-error');
						
					} else {
						$("#CUSTOMER_ID").closest('.input-group').removeClass('has-error');
						$("#CUSTOMER_ID").closest('.input-group').addClass('has-success');				
					}

					if(BOXOUT_BOXCODE == "") {
						$("#BOXOUT_BOXCODE").closest('.input-group').addClass('has-error');
					} else {
						$("#BOXOUT_BOXCODE").closest('.input-group').removeClass('has-error');
						$("#BOXOUT_BOXCODE").closest('.input-group').addClass('has-success');				
					}

					if(BOXOUT_DICEWEIGHT == "") {
						$("#BOXOUT_DICEWEIGHT").closest('.input-group').addClass('has-error');
						//$("#BOOKING_PCITY").after('<p class="text-danger">The Contact field is required</p>');
					} else {
						$("#BOXOUT_DICEWEIGHT").closest('.input-group').removeClass('has-error');
						$("#BOXOUT_DICEWEIGHT").closest('.input-group').addClass('has-success');				
					}

					if(BOXOUT_BOXWEIGHT == "") {
						$("#BOXOUT_BOXWEIGHT").closest('.input-group').addClass('has-error');
					} else {
						$("#BOXOUT_BOXWEIGHT").closest('.input-group').removeClass('has-error');
						$("#BOXOUT_BOXWEIGHT").closest('.input-group').addClass('has-success');				
					}
					if(BOXOUT_BOXSTATUS == "") {
						$("#BOXOUT_BOXSTATUS").closest('.input-group').addClass('has-error');
					} else {
						$("#BOXOUT_BOXSTATUS").closest('.input-group').removeClass('has-error');
						$("#BOXOUT_BOXSTATUS").closest('.input-group').addClass('has-success');				
					}
					
					if(CUSTOMER_ID && BOXOUT_BOXCODE && BOXOUT_BOXWEIGHT && BOXOUT_DICEWEIGHT && BOXOUT_BOXSTATUS) {
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