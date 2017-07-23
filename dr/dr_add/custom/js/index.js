// global the manage memeber table 
var manageMemberTable;

		// remove the error 
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".messages").html("");

		// submit form
		$("#createMemberForm").unbind('submit').bind('submit', function() {
	
			$(".text-danger").remove();

			var form = $(this);
$('#loadingmessage2').show(); 
$('#btnsave').prop('disabled',true); 
$('#btnclose').prop('disabled',true); 
$('#btnhistory').prop('disabled',true); 
			// validation
				var CYLINDER_REFERENCEID = $("#cylinder").val();
				var DR_NO = $("#DR_NO").val();
				var CUSTOMER_ID= $("#CUSTOMER_ID").val();
				var datepicker = $("#datepicker").val();
				var datepicker2 = $("#datepicker2").val();

					if(CYLINDER_REFERENCEID == "") {
						$("#cylinder").closest('.form-group').addClass('has-error');
						
					} else {
						$("#cylinder").closest('.form-group').removeClass('has-error');
						$("#cylinder").closest('.form-group').addClass('has-success');				
					}
					if(DR_NO == "") {
						$("#DR_NO").closest('.form-group').addClass('has-error');
						
					} else {
						$("#DR_NO").closest('.form-group').removeClass('has-error');
						$("#DR_NO").closest('.form-group').addClass('has-success');				
					}
					if(CUSTOMER_ID == "") {
						$("#CUSTOMER_ID").closest('.form-group').addClass('has-error');
						
					} else {
						$("#CUSTOMER_ID").closest('.form-group').removeClass('has-error');
						$("#CUSTOMER_ID").closest('.form-group').addClass('has-success');				
					}
					if(datepicker == "") {
						$("#datepicker").closest('.form-group').addClass('has-error');
						
					} else {
						$("#datepicker").closest('.form-group').removeClass('has-error');
						$("#datepicker").closest('.form-group').addClass('has-success');				
					}
					if(datepicker2 == "") {
						$("#datepicker2").closest('.form-group').addClass('has-error');
						
					} else {
						$("#datepicker2").closest('.form-group').removeClass('has-error');
						$("#datepicker2").closest('.form-group').addClass('has-success');				
					}
				

			if(CYLINDER_REFERENCEID,datepicker,datepicker2,DR_NO,CUSTOMER_ID) {
				//submi the form to server
				$.ajax({
					url : form.attr('action'),
					type : form.attr('method'),
					data : form.serialize(),
					dataType : 'json',
					success:function(response) {
	$('#loadingmessage2').hide(); 
	$('#btnsave').prop('disabled',false); 
		$('#btnhistory').prop('disabled',false); 
			$('#btnclose').prop('disabled',false); 
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

							// reload the datatables\

							
						 setTimeout(function() {
							location.reload();
							   }, 1800);
							// this function is built in function of datatables;

						
				
						} else if(response.success == false){
								$(".messages").html('<div id="warning-create" class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
							  $("#warning-create").fadeTo(1500, 500).slideUp(500, function(){
                $("#warning-create").slideUp(500);
				
                });  
						} // /else
					} // success  
				}); // ajax subit 				
			} /// if


			return false;
		}); // /submit form for create member


