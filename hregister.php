<?php
error_reporting(0);
if(isset($_SESSION['details']['email'])){
	if($_SESSION['details']['role_id']!=1){
		print '<script type="text/javascript">window.location=".?url=dashboard";</script>';
	}
}
?>

<script type="text/javascript" src="js/hregister.js"></script>
<!---------Register section------->
<div class="spiner" style="display:none;"><img src="img/spinner.gif"></div>
<div class="hreg" style="margin-top:50px; display:none;">
	<div class="container-fluid">
		<div class="control_console admin-jobs spacer-40" style="float:left">
			<div class="head">
				<div class="dashboard1"><a href=".?url=dashboard" class="btn btn-success">Dashboard</a></div>
				<div class="lorrybook"><a  href=".?url=hregister" class="btn btn-success hrr">Add haulier </a></div>
			</div>
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-responsive table-bordered table-striped">
						<thead>
						<tr>
						<th>Haulier id</th>
						<th>Email</th>
						<th>Company name</th>
						<th>Mobile no</th>
						<th>Address</th>
						<th>Contact person</th>
						<th>License No</th>
						<th>Status</th>
						<th>Action</th>
						</tr>
						</thead>
					   <tbody>
					   <?php  $hreg->viewhaulier(); ?>
					   </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
					
<div  class="container hreg" >
	<div  class="login_section">
		<div class="text-center">
			<h3><b>Haulier  Registration <!--BookALorry.co.uk--></b></h3>
			<div class="tagline">(BookALorry.co.uk)</div>
			<hr />
		</div>
		<form name="register" id="register" method="post">
			<label>Email<span style="color:#F00;">*</span></label>
			<input type="email" id="email" name="email" class="form-control" placeholder="Email"/>
			<div class="callout" style="display:none;" id="emailerror">Please provide an email-id.</div>
			
			<label>Password<span style="color:#F00;">*</span></label>
			<input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required" />
			<div class="callout" style="height:38px;padding:0px 10px;margin-top: -14px; margin-bottom: 10px;display:none;" id="error2">
			<h4 id="passwordErrorMsg" style="font-size:15px;color:red;font-family:Verdana"></h4></div>
			
			<label>Confirm Password<span style="color:#F00;">*</span></label>
			<input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="Confirm Password" required="required" />
			<div class="callout" style="display:none;" id="error1">Confirm Password Should be Same as Password.</div>

			<label>Company Name<span style="color:#F00;">*</span></label>
			<input type="text" name="companyname" id="companyname" class="form-control" placeholder="Company Name"/>
			<div class="callout" style="display:none;" id="companyerror">Please provide Company name.</div>
			
			<label>Address<span style="color:#F00;">*</span></label>
			<textarea rows="3" name="address" id="address" class="form-control" placeholder="Address" style="resize:none"></textarea>
			<div class="callout " style="display:none;" id="addresserror">Please provide address.</div>

			<label>Contact No.<span style="color:#F00;">*</span></label>
			<input type="text" id="mobile" name="mobile" class="form-control" placeholder="Contact No." onkeyup="this.value = this.value.replace(/[^0-9]/g, '')" />
			<div class="callout " style="display:none;" id="conerror">Please Provide Contact No.</div>
	
			<label>Contact Person<span style="color:#F00;">*</span></label>
			<input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="Contact Person" onkeyup="this.value = this.value.replace(/[^A-Za-z. ]/g, '')"/>
			<div class="callout" style="display:none;" id="personerror">Please provide contact person name.</div>
	  
			<label>License Number<span style="color:#F00;">*</span></label>
			<input type="text" name="lic_num" id="lic_num" class="form-control" placeholder="License Number" />
			<div class="callout" style="display:none;" id="licerror">Please provide license number.</div>
	  
			<label>Vehicle Type</label>
			<div class="field_wrapper">
				<select class="form-control" name="vehicles_type[]" multiple="multiple" id="vehicle_type">
					<option value="">--Select Vehicle Type--</option>
					<option selected>Box Van/Truck</option>
					<option>Tautliner/Curtainsider</option>
					<option >Tipper</option>
					<option >Flatbed</option>
					<option >Container</option>
					<option >Skip Loader</option>
					<option >Grab Lorry</option>
					<option id="other1" value="Other" >Other</option>
				</select>
				<div class="callout" style="display:none;" id="vehicleerror">Please select vehicle type..</div>					
				<div class="account_col_row">
					<span class="othervehicle" style="display:none">
						<input value="" type="text" name="othervehicle" id="othervehicle" class="form-control" placeholder="Vehicle Type">
					</span>
				</div>					
			</div>

			<input type="submit" id="submit" value="Register" class="btn btn-success">
			<?php 
			if($_SESSION['details']['role_id']==1){
				echo '<a href=".?url=hregister" class="btn btn-info lorry hrr">View hauliers</a>';	
			}else{
				echo '<a href="index.php" class="btn btn-info lorry">Back</a>';	
			}
			?>
		</form>
	</div>
</div>

<div style='display: none;'>
	<div class="hvjob" id="ddescshow"></div>
</div>