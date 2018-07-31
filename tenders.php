<?php
session_start();
$log->chk_login();
?>
<script>
$(document ).ready(function() {
	$(".viewinfo").click(function(event) {
		event.preventDefault();
		$('.euro').css("display", "none");
		$('.request').css("display", "none");
		var job_id = $(this).attr('id');
		$.post("tasks.php", {tenderviewinfo:'tenderviewinfo', job_id:job_id},
		function (data)
		{
			//alert(data);
			$('.jobdescription').html(data);
		});
		$(this).colorbox({width:"50%", height:"80%", scrolling:'true', inline:true, href:"#descshow"});
	});
	
	$(".pricethisjob").click(function(event) {
		event.preventDefault();
		var job_id = $(this).attr('id');
		//alert(job_id);
		$('.euro').css("display", "none");
		$('.request').css("display", "none");
		$('#price_'+job_id).css("display", "block");
	});
	
	$(".requestmoreinfo").click(function(event) {
		event.preventDefault();
		var job_id = $(this).attr('id');
		//alert(job_id);
		$('.euro').css("display", "none");
		$('.request').css("display", "none");
		$('#request_'+job_id).css("display", "block");
	});
	
	$(".request").submit(function (event) {
		event.preventDefault();	
		var $product_id = $(this).find('input[name="job_id"]');
		var job_id= $product_id.val();
		var $haulier_id = $(this).find('input[name="haulier_id"]');
		var haulier_id= $haulier_id.val();
		var $enquiry = $(this).find('textarea[name="enquiry"]');
		var enquiry= $enquiry.val();
		//alert(enquiry);
		if (enquiry == ""){
			$('#requesterr').show();
			$('#requesterr').focus();
			return false;
		}				
		$.post("tasks.php", {requestmoreinfo:'requestmoreinfo',job_id: job_id,haulier_id: haulier_id,enquiry: enquiry},
		function (data)
		{
			//alert(data);
			if (data == 1){				
				$('<div class="haulierrply ten">'+enquiry+'</div>').appendTo('#region');
				$('#load_desc').val('');
			}
		});			
	});
	
	$(".sendamount").submit(function (event) {
		event.preventDefault();
		var $product_id = $(this).find('input[name="job_id"]');
		var job_id= $product_id.val();
		var $haulier_id = $(this).find('input[name="haulier_id"]');
		var haulier_id= $haulier_id.val();
		var $amount = $(this).find('input[name="amount"]');
		var amount= $amount.val();
		if (amount == ""){
			$('#amounterr').show();
			$('#amount').focus();
			return false;
		}
		$.post("tasks.php", {amount:'amount',job_id: job_id,haulier_id: haulier_id,amount: amount},
		function (data)
		{
			//alert(data);
			if (data == 1){
				$("#msg_succ").css("display","block");
			}else{
				$(".error").css("display","block");		
            }
        });				
	});
	
	$(".close").click(function (event) {
		event.preventDefault();
		window.location.reload();
	});
});
</script>

<!---------user account section------->
<div id="msg_succ" class="alert alert-success alert-dismissible success" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	Your quotes for this job has been Successfully submitted.
</div>
<div id="msg_succ" class="alert alert-success alert-dismissible error" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	Some error occured. Please try again.
</div>
<div class="container spacer-40" >
	<div class="control_console">
    	<div class="row">
			<div class="back"><a href=".?url=dashboard" class="btn btn-success">Back</a></div>	
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="account_col">
					<h3><b>Tenders</b></h3>
					<hr />
					<?php  $ten->pendingtender(); ?>
				</div>
			</div>
        </div>
    </div>
</div>
<div style='display: none;'>
	<div class="jobdescription" id="descshow"></div>
</div>