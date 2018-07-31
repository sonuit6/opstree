<?php
error_reporting(E_ALL);
$log->chk_login();
if($_SESSION['details']['role_id']==3)
{
	print '<script type="text/javascript">window.location=".?url=dashboard";</script>';
}
?>
<script>
function reviseprice(input,id) 
{
	var job_id =  $("#jobb_id_"+id).val();
	var ramount =  $("#ramount_"+id).val();
	if (ramount == ""){
		$('#amounterr').show();
		$('#ramount').focus();
		return false;
	}
	$.post("tasks.php", {reviseamount:'reviseamount',job_id: job_id,ramount: ramount},
	function (data)
	{
		//alert(data);
		if (data == 1){
			//$("#msg_succ").css("display","block");
			alert('Your price have successfully been updated.');
		window.location.reload();
		}else{
			$(".error").css("display","block");		
		}

	});	
	return false;
}

$(document).on("click",".addmoreload",function(event) {
	event.preventDefault();	
	var job_id = $(this).attr('job_id');
	$('#moreload_'+job_id).css("display", "block");
	$('readmore_popup').css("display", "none");
});
	
$(document ).ready(function() {
	$(".addload").submit(function (event) {
		event.preventDefault();
		var $product_id = $(this).find('input[name="moreload"]');
		var no_of_load= $product_id.val();
		var $job_id = $(this).find('input[name="job_id1"]');
		var job_id= $job_id.val();
		if(no_of_load==''){
			alert('Please insert no. of more loads.');
			return false;
		}
		$.post("tasks.php", {addmoreload:'addmoreload',no_of_load:no_of_load,job_id:job_id},
		function (data){
			// alert(data);
			if(data==1){
				alert(no_of_load+ ' more loads request has successfully been submitted .');	
				window.location=".?url=view-jobs";
			}											
		});	
	});
	
	$(".contactus").click(function(event) {
		event.preventDefault();
		$(this).colorbox({width:"30%", height:"30%", scrolling:'true', inline:true, href:"#contactuss"});
	});

	$(".revise").click(function(event) {
		event.preventDefault();
		var job_id = $(this).attr('id');
		//alert(job_id);
		$('.euro').css("display", "none");
		$('#revise_'+job_id).css("display", "block");
	});

	$(".close").click(function (event) {
		event.preventDefault();
		window.location.reload();
	});

	$(function(){
		$(".readmore").click(function(){
			var id = $(this).attr('jobid');
			$(this).colorbox({width:"740px", height:"auto", scrolling:'false', inline:true, href:"#popup_"+id});
		});    
	});

	$(".tickets").submit(function (event) {
		event.preventDefault();
		var $job_id = $(this).find('input[name="job_id"]');
		var job_id= $job_id.val();
		var $filename = $(this).find('input[name="upfilename"]');
		var filename= $filename.val();
		//alert(filename);
		if (filename == ""){
			alert('Please select file to upload.');
			return false;
		}
		$.post("tasks.php", {uploadtkt:'uploadtkt',job_id: job_id,filename: filename},
		function (data){
			//alert(data);
			if (parseInt(data) == 1){
				$("#msg_succ").css("display","block");
			}else{
				$(".error").css("display","block");		
			}
		});	
	});

	$(".ticketdownload").click(function(event) {
		event.preventDefault();
		var job_id = $(this).attr('job_id');
		$.post("tasks.php", {tktdownload:'tktdownload',job_id: job_id},
		function (data){
			//alert(data);
			$('.download').html(data);
		});	
		$(this).colorbox({width:"30%", height:"30%", scrolling:'true', inline:true, href:"#showticket"});
	});

	$(document).on("click",".deletetickt",function(event) {	
		event.preventDefault();
		var file = $(this).attr('file');
		var id = $(this).attr('id');
		var path = $(this).attr('path');
		$.post("tasks.php", {deletetkt:'tktdownload',file: file,id:id,path:path},
		function (data){
			//alert(data);
			if(data==1){
				alert('File has succesfully been deleted.');
				window.location.reload();
			}
		});	
	});
});

function salThreeToReadURL(input,id) {
	if (input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload = function (e) {};
		reader.readAsDataURL(input.files[0]);
	}
	
	var file_data = $('#file_'+id).prop('files')[0];
	var form_data = new FormData();
	form_data.append('file', file_data);
	var file_name = document.getElementById("file_"+id).name;
	form_data.append('job_id', id);
	form_data.append('file_name', file_name);
	$('.spiner').show();
	$.ajax({
		url: 'document_upload.php',
		dataType: 'text',
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: 'POST',
		success: function (data) {
			if (data) {
				//alert(data);
				$('.spiner').hide();	
				if(data==0){
					alert('Please upload file less than 2MB.');
					return false;
				}else if(data==1){
					alert('Please upload valid extension file.');
					return false;
				}else{
					$('.filename').val('');
					document.getElementById('filename_'+id).value = data;
				}
			}
		}
	});
}
 
function myOnSubmitHandler(form) { 
   var job_id= form.job_id.value; 
   var loadsend= form.loadsendtocustomer.value;
	//alert(job_id);
	if (loadsend == ""){
		alert('Please insert no of load transfer ot customer.');
		return false;
	}				
	$.post("tasks.php", {loassend:'loassend',job_id: job_id,loadsend: loadsend},
	function (data){
		//alert(data);
		if (data == 1){			
			alert(loadsend+ '  loads have successfully been submitted.');
			window.location.reload();
		}else if (data == 2){		
			alert( 'Please insert correct remaining no of load.');
			return false;
		}else{
			$(".error").css("display","block");		
		}
    });										
	return false;
}
</script>
<div class="spiner" style="display:none;"><img src="img/spinner.gif"></div>
 
<!---------user account section------->
<div id="msg_succ" class="alert alert-success alert-dismissible success" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
	</button>
	Your tickets have successfully been uploaded.
</div>
<div id="msg_succ" class="alert alert-success alert-dismissible error" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
	</button>
	Some error occured. Please try again.
</div>

<div  style="margin-top:50px">
	<div class="container-fluid">
		<div class="control_console admin-jobs spacer-40">
			<div class="dashboard"><a href=".?url=dashboard" class="btn btn-success">Dashboard</a></div>
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#sectionA">Sites You Are On</a></li>
				<li><a data-toggle="tab" href="#sectionB">Revise Price</a></li>
				<li><a data-toggle="tab" href="#sectionC">Sites You Have Tendered For</a></li>
			</ul>
			<div class="tab-content">
				<div id="sectionA" class="tab-pane fade in active">
					<div class="open_jobs">
						<div class="table-responsive">
							<?php $hvj->Siteyouareon(); ?>
						</div>
					</div>
				</div>
				<div id="sectionB" class="tab-pane fade">
					<div class="open_jobs">
						<div class="table-responsive">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="account_col">
									<h3><b>Revise price</b></h3>
									<hr />
									<?php $hvj->tenderfor(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="sectionC" class="tab-pane fade">
					<div class="open_jobs">
						<div class="col-md-12">
							<div class="table-responsive">
								<div class="account_col">
									<h3><b>Sites You Have Tendered For</b></h3>
									<hr />
									<?php $hvj->totaltender(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		
<div style='display: none;'>
	<div id='contactuss' class='con_popup' style="text-align: center">
		<h2>Contact us</h2>
		<p>20 Dawley Avenue, Uxbridge. UB8 3BT</br>Ph: 0208 819 3868</p>
	</div>
</div>
		
<div style='display: none;'>
	<div id='showticket' class='download'></div>
</div>