<?php error_reporting(0);
$log->chk_login();
if($_SESSION['details']['role_id']!=1){
	echo '<script type="text/javascript">window.location=".?url=dashboard";</script>';
}
?>

<script>
$(document ).ready(function() {
	$(document).on("click",".ccc",function(event) {
		event.preventDefault();
		$(this).text("verified");
		var verify_id= this.id;
		//alert(verify_id);
		$.ajax({
			type: "POST",
			url: "tasks.php",
			data: {verify_id: verify_id},
			cache: false,
			success: function(data){
				location.reload();
			} 
		});
	});

	$("button").click(function(event) {
		event.preventDefault();
		if(confirm('Are you sure, You want to verify job?')){
			$(this).text("verified");
			var verify_id= this.id;
			$('.spiner').show();
			$.ajax({
				type: "POST",
				url: "tasks.php",
				data: {verify_id: verify_id},
				cache: false,
				success: function(data)
				{
					//alert(data);
					$('.spiner').hide();
					location.reload();
				} 
			});
		}else{
			return false
		}
	});

	$(".viewjob").click(function(event) {
		event.preventDefault();
		var id = $(this).attr('id');
		$.post("tasks.php", {jobdesc: 'jobdesc',id:id},
		function (data)
		{
			//alert(data);
			$('.jobdescription').html(data);
		});
		$(this).colorbox({width:"50%", height:"60%", scrolling:'true', inline:true, href:"#descshow"});
	});
});
</script>
<!---------user account section------->

<div  style="margin-top:50px">
	<div class="container-fluid">
		<div class="control_console admin-jobs spacer-40">
			<div class="dashboard"><a href=".?url=dashboard" class="btn btn-success">Dashboard</a></div>
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#sectionA">OPEN JOBS</a></li>
				<!--<li><a data-toggle="tab" href="#sectionB">VERIFIED JOBS</a></li>-->
			</ul>
			<div class="tab-content">
				<div id="sectionA" class="tab-pane fade in active">
					<div class="open_jobs">
						<div class="table-responsive">
							<table class="table table-responsive table-bordered table-striped">
								<thead>
								<tr>
								<th>Job id</th>
								<th>Customer Details</th>
								<th>Address</th>
								<th>Tenders Due By</th>
								<th>Loads Required</th>
								<th>Lorry Required</th>
								<th>Vehicle Type</th>
								<th colspan=3>Action</th>
								</tr>
								</thead>
								<tbody>
								<?php  $objview->jobview(); ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<!--<div id="sectionB" class="tab-pane fade">
					<div class="assign_jobs">
						<div class="table-responsive">
							<table class="table table-responsive table-bordered table-striped">
								<thead>
								<tr>
								<th>Job id</th>
								<th>Customer Details</th>
								<th>Address</th>
								<th>Tenders Due By</th>
								<th>Loads Required</th>
								<th>Lorry Required</th>
								<th>Vehicle Type</th>
								</tr>
								</thead>
								<tbody>
								<?php $objview->verifiedjob();  ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>-->
			</div>
		</div>
	</div>
</div>

<div style='display: none;'>
	<div class="jobdescription" id="descshow"></div>
</div>