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
			// validation
				var BOXIN_BOXCODE = $("#BOXIN_BOXCODE").val();
				var BOXIN_DUTYOPERATOR = $("#BOXIN_DUTYOPERATOR").val();
				var BOXIN_GUARD = $("#BOXIN_GUARD").val();
				var BOXIN_DATE = $("#datepicker").val();
				var BOXIN_TIME = $("#BOXIN_TIMEIN").val();

					if(BOXIN_BOXCODE == "") {
						$("#BOXIN_BOXCODE").closest('.form-group').addClass('has-error');
						
					} else {
						$("#BOXIN_BOXCODE").closest('.form-group').removeClass('has-error');
						$("#BOXIN_BOXCODE").closest('.form-group').addClass('has-success');				
					}
					if(BOXIN_DUTYOPERATOR == "") {
						$("#BOXIN_DUTYOPERATOR").closest('.form-group').addClass('has-error');
						
					} else {
						$("#BOXIN_DUTYOPERATOR").closest('.form-group').removeClass('has-error');
						$("#BOXIN_DUTYOPERATOR").closest('.form-group').addClass('has-success');				
					}
					if(BOXIN_GUARD == "") {
						$("#BOXIN_GUARD").closest('.form-group').addClass('has-error');
						
					} else {
						$("#BOXIN_GUARD").closest('.form-group').removeClass('has-error');
						$("#BOXIN_GUARD").closest('.form-group').addClass('has-success');				
					}
					if(BOXIN_DATE == "") {
						$("#datepicker").closest('.form-group').addClass('has-error');
						
					} else {
						$("#datepicker").closest('.form-group').removeClass('has-error');
						$("#datepicker").closest('.form-group').addClass('has-success');				
					}
					if(BOXIN_TIME == "") {
						$("#BOXIN_TIMEIN").closest('.form-group').addClass('has-error');
						
					} else {
						$("#BOXIN_TIMEIN").closest('.form-group').removeClass('has-error');
						$("#BOXIN_TIMEIN").closest('.form-group').addClass('has-success');				
					}
				
					

			if(BOXIN_BOXCODE && BOXIN_DUTYOPERATOR && BOXIN_GUARD && BOXIN_DATE && BOXIN_TIME) {
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

							// reload the datatables\

							
						 setTimeout(function() {
							window.location = '../../';
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


