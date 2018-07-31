<?php
$log->chk_login();
if(isset($_REQUEST['edit_id']))
{
	$eid= base64_decode($_REQUEST['edit_id']);
	$qu=$bal->editjobs($eid);
	$arr=array(
	'Box Van/Truck',
	'Tautliner/Curtainsider',
	'Tipper',
	'Flatbed',
	'Container',
	'Skip Loader',
	'Grab Lorry'
	);
	$arr2=array(
	'3.5',
	'4.5',
	'5.0',
	'4.8',
	'6.5',
	'8.0'
	);
}
?>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
//#############################################	 
var $j = jQuery.noConflict();
$j(document ).ready(function() {  
	$j('.rg').change(function() {
		var load = $j(this).val();
		if(load == 1){
			$j('#multi').hide();	
		}else{
			$j('#multi').show();
			$j('#multi').on('keyup', function() {
				var no = $j('#multi').val();
				$j("#r2").val(no);
			});
		}
	});
	
	$j('#multi').on('keyup', function(){
		var no = $j('#multi').val();
		 $j("#r2").val(no);
	});
	
//#############################################	
	$j('.haulage').click(function() {
		$j('#haulage_destination_addr').css({"display": "block"});
	});
	
	$j('.site_clearance').click(function() {
		$j("#d_company_name").val('');
		$j("#d_address").val('');
		$j("#d_town_city").val('');
		$j("#d_country").val('');
		$j("#d_postcode").val('');
		$j('#haulage_destination_addr').css({"display": "none"});
	});
	
//#############################################	
	$j('#lorry_req').change(function() {
		var lorryreq = $j(this).val();
		var clorryreq='<?php echo $qu['lorry_req']; ?>';
		if(lorryreq=='other' || lorryreq==clorryreq){
			$j('.otherlorry').show();
			$j('#otherlorry').on('keyup', function() {
				var nn = $j('#otherlorry').val();
				var c = nn.length;
				$j("#other").val(nn);
			});
	
		}else{
			$j('.otherlorry').hide();
		}
	});

	$j('#otherlorry').on('keyup', function() {
		var nn = $j('#otherlorry').val();
		var c = nn.length;
		$j("#other").val(nn);
	});
//#############################################

	$j('#vehicle_type').change(function() {
		var lorryreq = $j(this).val();
		var cvehicle='<?php echo $qu['vehicle_type']; ?>';
		if(lorryreq=='Other' || lorryreq==cvehicle){
			$j('.othervehicle').show();
			$j('#othervehicle').on('keyup', function() {
				var nnn = $j('#othervehicle').val();
				//alert(nnn);
				$j("#other1").val(nnn);
			});
			}
		
		else{	
			$j('.othervehicle').hide();
		}
	});
	
	$j('#othervehicle').on('keyup', function() {
		var nnn = $j('#othervehicle').val();
		//alert(nnn);
		$j("#other1").val(nnn);
	});
//#############################################
 
	$j("#start_date,#tender_due_date").datepicker({ dateFormat: 'yy-mm-dd' });
	
	$j("#submit").click(function (event) {
		event.preventDefault();
		var eid='<?php echo $eid; ?>';
		var load_desc = $j("#load_desc").val();
		// var site_add = $j("#site_add").val();
		var saddress = $j("#s_address").val();
		var stown_city = $j("#s_town_city").val();
		var spostcode = $j("#s_postcode").val();
		var daddress = $j("#d_address").val();
		var dtown_city = $j("#d_town_city").val();
		var dpostcode = $j("#d_postcode").val();
		var jobtype= document.querySelector('input[name="job_type"]:checked').value;
		var start_date = $j("#start_date").val();
		var tender_due_date = $j("#tender_due_date").val();
		var no_of_load  = $j('input[name=no_of_load]:checked', '#bookalorry').val();
		if(start_date >= tender_due_date){
			$j('#tdtaeless').hide();
		}else{
			$j('#tendererror').hide();
			$j('#tdtaeless').show();
			document.bookalorry.start_date.focus();
			return false;
		}
		var lorry_req = $j("#lorry_req").val();
		var vehicle_type = $j("#vehicle_type").val();
		if (load_desc == ""){
			$j('#loaderror').show();
			$j('#sadderror').hide();
			$j('#stownerror').hide();
			$j('#sposterror').hide();
			$j('#startdateerror').hide();
			$j('#tendererror').hide();
			$j('#noloaderror').hide();
			$j('#lorryerror').hide();
			$j('#vehicleerror').hide();
			document.bookalorry.load_desc.focus();
			return false;
		}else if (saddress == ""){
			$j('#loaderror').hide();
			$j('#sadderror').show();
			$j('#stownerror').hide();
			$j('#sposterror').hide();
			$j('#startdateerror').hide();
			$j('#tendererror').hide();
			$j('#noloaderror').hide();
			$j('#lorryerror').hide();
			$j('#vehicleerror').hide();
			document.bookalorry.saddress.focus();
			return false;
		}else if (stown_city == ""){
			$j('#loaderror').hide();
			$j('#sadderror').hide();
			$j('#stownerror').show();
			$j('#sposterror').hide();
			$j('#startdateerror').hide();
			$j('#tendererror').hide();
			$j('#noloaderror').hide();
			$j('#lorryerror').hide();
			$j('#vehicleerror').hide();
			document.bookalorry.stown_city.focus();
			return false;
		}else if (spostcode == ""){
			$j('#loaderror').hide();
			$j('#sadderror').hide();
			$j('#stownerror').hide();
			$j('#sposterror').show();
			$j('#startdateerror').hide();
			$j('#tendererror').hide();
			$j('#noloaderror').hide();
			$j('#lorryerror').hide();
			$j('#vehicleerror').hide();
			document.bookalorry.spostcode.focus();
			return false;
		}else if(jobtype == '0' && daddress == ""){
			$j('#dadderror').show();
			$j('#dtownerror').hide();
			$j('#dpostcodeerror').hide();
			return false;
		}else if(jobtype == '0' && dtown_city == ""){
			$j('#dadderror').hide();
			$j('#dtownerror').show();
			$j('#dpostcodeerror').hide();
			return false;
		}else if(jobtype == '0' && dpostcode == ""){
			$j('#dadderror').hide();
			$j('#dtownerror').hide();
			$j('#dpostcodeerror').show();
			return false;
		}else if (start_date == ""){
			$j('#loaderror').hide();
			$j('#sadderror').hide();
			$j('#stownerror').hide();
			$j('#sposterror').hide();
			$j('#startdateerror').show();
			$j('#tendererror').hide();
			$j('#noloaderror').hide();
			$j('#lorryerror').hide();
			$j('#vehicleerror').hide();
			document.bookalorry.start_date.focus();
			return false;
		}else if (tender_due_date == ""){
			$j('#loaderror').hide();
			$j('#sadderror').hide();
			$j('#stownerror').hide();
			$j('#sposterror').hide();
			$j('#startdateerror').hide();
			$j('#tendererror').show();
			$j('#noloaderror').hide();
			$j('#lorryerror').hide();
			$j('#vehicleerror').hide();
			document.bookalorry.tender_due_date.focus();
			return false;
		}else if (lorry_req == ""){
			$j('#loaderror').hide();
			$j('#sadderror').hide();
			$j('#stownerror').hide();
			$j('#sposterror').hide();
			$j('#startdateerror').hide();
			$j('#tendererror').hide();
			$j('#noloaderror').hide();
			$j('#lorryerror').show();
			$j('#vehicleerror').hide();
			document.bookalorry.lorry_req.focus();
			return false;
		}else if (vehicle_type == ""){
			$j('#loaderror').hide();
			$j('#sadderror').hide();
			$j('#stownerror').hide();
			$j('#sposterror').hide();
			$j('#startdateerror').hide();
			$j('#tendererror').hide();
			$j('#noloaderror').hide();
			$j('#lorryerror').hide();
			$j('#vehicleerror').show();
			document.bookalorry.vehicle_type.focus();
			return false;
		}
		var val =decodeURIComponent($j.param($j('#bookalorry :input')));
		val = val.replace(/[^a-zA-Z 0-9 & @ # ( ) % $ ! = \/ . , ! ' " * < > : ; \- _]+/g, " ").replace(/&amp;/g, "&").replace(/&nbsp;/g, " ").replace(/ & /g, "<$$$>").replace("cheque_status=Cleared", "");
		$j('.spiner').show();
		if(eid!=''){
			$j.post("tasks.php", {editbookalorry:'editbookalorry',data: val,no_of_load:no_of_load,eid:eid,jobtype:jobtype},	
			function (data)
			{
				// alert(data);
				if (parseInt(data) == 1){
					$j('.spiner').hide();	
					alert('Thank you, lorry booking request has successfully been updated.');	
					if('<?php echo $_SESSION['details']['role_id']; ?>'=='1'){
						document.location.href = '.?url=adminjobs';	
					}else{
						document.location.href = '.?url=view-price';
						//window.location.reload();
					}
				}else{
					$j('.spiner').hide();
					$j('#error').show();   
					$j('#success').hide();
				}
			});
		}else{
			$j.post("tasks.php", {bookalorry:'bookalorry',data: val,no_of_load:no_of_load,jobtype:jobtype},
            function (data){
				// alert(data);
				if (data == 1){
					$j('.spiner').hide();	
					alert('Thank you, Your lorry requirement has been successfully sent.');
					document.location.href = '.?url=book-a-lorry';
				}else{
					$j('.spiner').hide();
					$j('#error').show();   
					$j('#success').hide();
				}
			});
		}			
	});
		
//#############################################
$j(".viewjob").click(function(event) {
	event.preventDefault();
	var job_id = $j(this).attr('view-id');
	$j.post("tasks.php", {vjob:'vjob', job_id:job_id},
	function (data){
		$j('.vjob').html(data);
	});
	$j(this).colorbox({width:"50%", height:"80%", scrolling:'true', inline:true, href:"#ddescshow"});
});

//#############################################
$j(".contactus").click(function(event) {
	event.preventDefault();
	$j('.contactus').colorbox({width:"30%", height:"30%", scrolling:'true', inline:true, href:"#contactuss"});
});

});  
</script>

<!---------user account section------->
<div class="spiner" style="display:none;"><img src="img/spinner.gif"></div>
<div class="container spacer-40 viewlorry" >
	<div class="control_console">
    	<div class="row">
			<div class="head">
				<div class="dashboard1"><a href=".?url=dashboard" class="btn btn-success">Dashboard</a></div>
			</div>
			<form name="bookalorry" id="bookalorry" method="post">
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="account_col">
						<h3><b>BOOK A LORRY</b></h3>
						<hr />
						<div class="account_col_row">
							<span class="der3re"><b>Load Description:</b></span><span >
							<textarea rows="3" name="load_desc" id="load_desc" class="form-control" placeholder="Enter Load Description	" style="resize:none"><?= $qu['load_desc']; ?></textarea>
							</span>
							<div class="callout" style="display:none;" id="loaderror">Please provide load description..</div>
						</div>
						<span class="der3re"><b>Site Address:</b></span>
						<div class="account_col_row">
							<span class="der3re"><b>Company Name:</b></span>
							<span><input value="<?php echo $qu['s_company_name']; ?>" type="text" name="s_company_name" id="s_company_name" class="form-control" placeholder="Company Name"></span>
						</div>
						<div class="account_col_row">
							<span class="der3re"><b>Address:</b></span>
                                                        <span><textarea rows="3" name="s_address" id="s_address" class="form-control" placeholder="Address"><?php echo $qu['s_address']; ?></textarea></span>
							<div class="callout" style="display:none;" id="sadderror">Please provide address..</div>
						</div>
						<div class="account_col_row">
							<span class="der3re"><b>Town / City:</b></span>
							<span><input value="<?php echo $qu['s_town_city']; ?>" type="text" name="s_town_city" id="s_town_city" class="form-control" placeholder="Town / City"></span>
							<div class="callout" style="display:none;" id="stownerror">Please provide town / city..</div>
						</div>
						<div class="account_col_row">
							<span class="der3re"><b>Country:</b></span>
							<span><input value="<?php echo $qu['s_country']; ?>" type="text" name="s_country" id="s_country" class="form-control" placeholder="Country"></span>
						</div>
						<div class="account_col_row">
							<span class="der3re"><b>Postcode:</b></span>
							<span><input value="<?php echo $qu['s_postcode']; ?>" type="tel" name="s_postcode" id="s_postcode" class="form-control" maxlength="10" placeholder="Postcode"></span>
							<div class="callout" style="display:none;" id="sposterror">Please provide country..</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="account_col" style="margin-top:40px">
						<div class="account_col_row" style="height:60px">
							<span class="der3re"><b>Job Type:</b></span><br />
							<span  style="float:left; margin-right:10px">
							<input type="radio" name="job_type" class="haulage" id="job_type" value="0" <?php if($qu['job_type'] == '0'){ echo 'checked';} ?> />  &nbsp;<label for="check1">Haulage</label> &nbsp;&nbsp; &nbsp;&nbsp;
							<input type="radio" name="job_type"  class="site_clearance" id="job_type" value="1" <?php if($qu['job_type'] == '1'){ echo 'checked';}else if(!isset($qu['job_type'])){ echo 'checked'; } ?> /> &nbsp;<label for="check2">Site Clearance</label>
							</span>
						</div>
						<div id="haulage_destination_addr" <?php if($qu['job_type'] != '0'){ ?> style="display:none; <?php } ?>" >
							<span class="der3re"><b>Destination Address:</b></span>
							<div class="account_col_row">
								<span class="der3re"><b>Company Name:</b></span>
								<span><input value="<?php echo $qu['d_company_name']; ?>" type="text" name="d_company_name" id="d_company_name" class="form-control" placeholder="Company Name"></span>
							</div>
							<div class="account_col_row">
								<span class="der3re"><b>Address:</b></span>
								<span><textarea rows="3" name="d_address" id="d_address" class="form-control" placeholder="Address"><?php echo $qu['d_address']; ?></textarea></span>
								<div class="callout" style="display:none;" id="dadderror">Please provide address..</div>
							</div>
							<div class="account_col_row">
								<span class="der3re"><b>Town / City:</b></span>
								<span><input value="<?php echo $qu['d_town_city']; ?>" type="text" name="d_town_city" id="d_town_city" class="form-control" placeholder="Town / City"></span>
								<div class="callout" style="display:none;" id="dtownerror">Please provide town / city..</div>
							</div>
							<div class="account_col_row">
								<span class="der3re"><b>Country:</b></span>
								<span><input value="<?php echo $qu['d_country']; ?>" type="text" name="d_country" id="d_country" class="form-control" placeholder="Country"></span>
							</div>
							<div class="account_col_row">
								<span class="der3re"><b>Postcode:</b></span>
								<span><input value="<?php echo $qu['d_postcode']; ?>" type="tel" name="d_postcode" id="d_postcode" class="form-control" maxlength="10" placeholder="Postcode"></span>
								<div class="callout" style="display:none;" id="dpostcodeerror">Please provide country..</div>
							</div>
						</div>
						<div class="account_col_row">
							<span class="der3re"><b>Start Date:</b></span>
							<span><input type="text" name="start_date" id="start_date" class="form-control" placeholder="Start date" value="<?= $qu['start_date']; ?>"></span>
							<div class="callout" style="display:none;" id="startdateerror">Please provide start date..</div>
						</div>
						<div class="account_col_row">
							<span class="der3re"><b>Tenders Due By:</b></span>
							<span><input value="<?= $qu['tender_due_date']; ?>" type="text" name="tender_due_date" id="tender_due_date" class="form-control" placeholder="Tenders Due Date"></span>
							<div class="callout" style="display:none;" id="tendererror">Please provide tenders due by..</div>
							<div class="callout" style="display:none;" id="tdtaeless">Tender due date should be less than start date..</div>
						</div>
						<div class="account_col_row" style="height:60px">
							<span class="der3re"><b>Loads Required:</b></span><br />
							<span  style="float:left; margin-right:10px">
							<input type="radio" name="no_of_load" class="rg" value="1" checked />  &nbsp;<label for="check1">One off</label> &nbsp;&nbsp; &nbsp;&nbsp;
							<input type="radio" name="no_of_load"  class="rg" id="r2" value="<?php echo $qu['no_of_load']; ?>" <?php echo ($qu['no_of_load']> '1') ?  "checked" : "" ; ?> /> &nbsp;
							<label for="check2">Multiple Loads</label>
							</span>
							<input value="<?php echo $qu['no_of_load']; ?>" type="text" class="form-control" id="multi" placeholder="No. of Loads" style="width:54%; height:26px;<?php echo ($qu['no_of_load']> '1') ?  'display:block;' : "display:none;" ; ?>" />
						</div>
						<div class="account_col_row">
							<span class="der3re"><b>Lorry Required:</b></span><span >
							<select class="form-control" name="lorry_req" id="lorry_req">
								<option value="">--Select Lorry Required--</option>
								<option value="3.5" <?php echo ($qu['lorry_req']== '3.5') ?  "selected" : "" ; ?>>3.5t</option>
								<option value="4.5" <?php echo ($qu['lorry_req']== '4.5') ?  "selected" : "" ; ?>>4.5t</option>
								<option value="5.0" <?php echo ($qu['lorry_req']== '5.0') ?  "selected" : "" ; ?>>5.0t</option>
								<option value="4.8" <?php echo ($qu['lorry_req']== '4.8') ?  "selected" : "" ; ?>>4.8t</option>
								<option value="6.5" <?php echo ($qu['lorry_req']== '6.5') ?  "selected" : "" ; ?>>6.5t</option>
								<option value="8.0" <?php echo ($qu['lorry_req']== '8.0') ?  "selected" : "" ; ?>>8.0t</option>
								<option id='other' value="<?php if(isset($eid)){ echo $qu['lorry_req']; } else {echo 'other';}?>" <?php if(isset($eid)){ echo (in_array($qu['lorry_req'],$arr2))?  "" : "selected" ; }?>>other</option>
							</select>  
							</span>
							<div class="callout" style="display:none;" id="lorryerror">Please select lorry required..</div>
							<div class="account_col_row">
								<span class="otherlorry" style="<?php if(isset($eid)){ echo (in_array($qu['lorry_req'],$arr2))?  "display:none;" : "display:block;" ; } else { echo 'display:none'; } ?>">
								<input value="<?= $qu['lorry_req']; ?>"  type="text" name="otherlorry" id="otherlorry" class="form-control" placeholder="Lorry Required"></span>
							</div>
						</div>
						<div class="account_col_row">
							<span class="der3re"><b>Vehicle Type:</b></span><span >
							<select class="form-control" name="vehicle_type" id="vehicle_type">
							<option value="">--Select Vehicle Type--</option>
							<option <?php echo ($qu['vehicle_type']== 'Box Van/Truck') ?  "selected" : "" ; ?>>Box Van/Truck</option>
							<option <?php echo ($qu['vehicle_type']== 'Tautliner/Curtainsider') ?  "selected" : "" ; ?>>Tautliner/Curtainsider</option>
							<option <?php echo ($qu['vehicle_type']== 'Tipper') ?  "selected" : "" ; ?>>Tipper</option>
							<option <?php echo ($qu['vehicle_type']== 'Flatbed') ?  "selected" : "" ; ?>>Flatbed</option>
							<option <?php echo ($qu['vehicle_type']== 'Container') ?  "selected" : "" ; ?>>Container</option>
							<option <?php echo ($qu['vehicle_type']== 'Skip Loader') ?  "selected" : "" ; ?>>Skip Loader</option>
							<option <?php echo ($qu['vehicle_type']== 'Grab Lorry') ?  "selected" : "" ; ?>>Grab Lorry</option>
							<option id="other1" value="<?php if(isset($eid)){ echo $qu['vehicle_type']; } else {echo 'Other';}?>" <?php if(isset($eid)){ echo (in_array($qu['vehicle_type'],$arr))?  "" : "selected" ; } ?>>Other</option>
							</select>                       
							</span>
							<div class="callout" style="display:none;" id="vehicleerror">Please select vehicle type..</div>
							<div class="account_col_row">
							<span class="othervehicle" style="<?php if(isset($eid)){ echo (in_array($qu['vehicle_type'],$arr))?  "display:none;" : "display:block;" ; } else {echo 'display:none';} ?>">
							<input value="<?= $qu['vehicle_type']; ?>" type="text" name="othervehicle" id="othervehicle" class="form-control" placeholder="Vehicle Type">
							</span>
							</div>					
						</div>
						<div class="account_col_row">
							<input type="hidden" name="customer_id" value="<?php echo $_SESSION['details']['id']; ?>">
							<?php if(isset($eid)){
								echo '<button id="submit" class="btn btn-success">Update</button>';
							}else{ 
								echo '<button id="submit" class="btn btn-success">Submit</button>';
							}?>
						</div>
					</div>
			  </div>
		  </form>
        </div>
    </div>
</div>

