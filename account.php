<?php
$log->chk_login();
$qu = $acc->accountinfo();
$vehicle_type = explode(',',$qu['vehicles_type']);
$arr = array(
    'Box Van/Truck',
    'Tautliner/Curtainsider',
    'Tipper',
    'Flatbed',
    'Container',
    'Skip Loader',
    'Grab Lorry'
);
$arrdif = array_diff($vehicle_type,$arr);
$cnt = sizeof($arrdif);
?>
<script>
    $(document).ready(function () {

        var ses = '<?php echo $_SESSION['details']['role_id']; ?>';
        $("#edit").click(function (event) {
            event.preventDefault();
            $("#updateaccount").css({"display": "none"});
            $("#editaccount").css({"display": "block"});
        });

        $("#mobile").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });

        $("#submit").click(function (event) {
            event.preventDefault();
			var vt=[];
			$.each($("#vehicles_type option:selected"), function(){            
				vt.push($(this).val());
			});
			$("#vehicles_type").val(vt);
			var vehicles_type = $("#vehicles_type").val();
            var companyname = $("#companyname").val();
            var address = $("#address").val();
            var mobile = $("#mobile").val();
            var contact_person = $("#contact_person").val();
            if (companyname == "")
            {
                $('#companyerror').show();
                $('#addresserror').hide();
                $('#conerror').hide();
                $('#personerror').hide();
                document.updateacc.companyname.focus();
                return false;
            } else if (address == "") {
                $('#companyerror').hide();
                $('#addresserror').show();
                $('#conerror').hide();
                $('#personerror').hide();
                document.updateacc.address.focus();
                return false;
            } else if (mobile == "") {
                $('#companyerror').hide();
                $('#addresserror').hide();
                $('#conerror').show();
                $('#personerror').hide();
                document.updateacc.mobile.focus();
                return false;
            } else if (contact_person == "") {
                $('#companyerror').hide();
                $('#addresserror').hide();
                $('#conerror').hide();
                $('#personerror').show();
                document.updateacc.contact_person.focus();
                return false;
            }
            if (ses == '2') {
                if ($("#vehicles_type").val() == "") {
                    $('#companyerror').hide();
                    $('#addresserror').hide();
                    $('#conerror').hide();
                    $('#personerror').hide();
                    $('#vehicleerror').show();
                    document.updateacc.vehicle_type.focus();
                    return false;
                }
            }
            var val = decodeURIComponent($.param($('#updateacc :input')));
            val = val.replace(/[^a-zA-Z 0-9 & @ # ( ) % $ ! = \/ . , ! ' " * < > : ; \- _]+/g, " ").replace(/&amp;/g, "&").replace(/&nbsp;/g, " ").replace(/ & /g, "<$$$>").replace("cheque_status=Cleared", "");
            $.post("tasks.php", {editaccount: 'editaccount', data: val,vehicles_type:vehicles_type},
                    function (data) {
                        // alert(data);
                        if (data == 1) {
                            $("#msg_succ").css("display", "block");
                        } else {
                            $(".error").css("display", "block");
                        }
                    });
        });

        $(".close").click(function (event) {
            event.preventDefault();
            window.location.reload();
        });

        $('#vehicles_type').change(function () {
            var lorryreq = $(this).val();
			var other = $.inArray('Other', lorryreq);
            var cvehicle = '<?php echo $qu['vehicles_type']; ?>';
            if (other>-1 || lorryreq == cvehicle) {
                $('.othervehicle').show();
                $('#othervehicle').on('keyup', function () {
                    var nnn = $('#othervehicle').val();
                    //alert(nnn);
                    $("#other1").val(nnn);
                });
            } else {
                $('.othervehicle').hide();
            }
        });

        $('#othervehicle').on('keyup', function () {
            var nnn = $('#othervehicle').val();
            //alert(nnn);
            $("#other1").val(nnn);
        });
    });
</script>
<!---------user account section------->
<div id="msg_succ" class="alert alert-success alert-dismissible success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>Your account has been successfully updated.
</div>
<div id="msg_succ" class="alert alert-success alert-dismissible error" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>Some error occured. Please try again.
</div>
<div class="container spacer-40">
    <div class="control_console" style="padding:40px 20px">
        <div class="row">
            <div class="back" style=" z-index: 2147483647;"><a href=".?url=dashboard" class="btn btn-success">Back</a></div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <!-- account info after update start or by default  -->				
                <div class="account_col" id="updateaccount">
                    <h3><b><?php
                            if ($_SESSION['details']['role_id'] == 3) {
                                echo 'Customer';
                            } else if ($_SESSION['details']['role_id'] == 2) {
                                echo 'Haulier';
                            } else {
                                echo 'Admin';
                            }
                            ?></b>
                        <span class="edit" id="edit"><input class="btn btn-success" type="button" value="Edit"></span></h3>
                    <hr />
                    <div class="account_col_row">
                        <span class="der3re der3re1"><b>Company Name:</b></span><span ><?= $qu['companyname']; ?></span>
                    </div>
                    <div class="account_col_row">
                        <span class="der3re der3re1"><b>Address:</b></span><span ><?= $qu['address']; ?></span>
                    </div>
                    <div class="account_col_row">
                        <span class="der3re der3re1"><b>Contact No.:</b></span><span><?= $qu['mobile']; ?></span>
                    </div>
                    <div class="account_col_row">
                        <span class="der3re der3re1"><b>Email_Id:</b></span><span ><?= $qu['email']; ?></span>
                    </div>
                    <div class="account_col_row">
                        <span class="der3re der3re1"><b>Contact Person:</b></span><span ><?= $qu['contact_person']; ?></span>
                    </div>
                    <?php if ($_SESSION['details']['role_id'] == 2) { ?>    
                        <div class="account_col_row">
                            <span class="der3re der3re1"><b>Waste Management Lic. No.:</b></span><span ><?= $qu['lic_num']; ?></span>
                        </div>
                        <div class="account_col_row">
                            <span class="der3re der3re1"><b>Vehicle Type:</b></span><span ><?= $qu['vehicles_type']; ?></span>
                        </div>  
                    <?php } ?>
                </div>
                <!-- account info after update finished or by default  -->		
                <!-- account info after onclick on edit button start  -->				
                <div class="account_col" id="editaccount" style="display:none;">
                    <form name="updateacc" id="updateacc" method="post">
                        <h3><b><?php
                            if ($_SESSION['details']['role_id'] == 3) {
                                echo 'Customer';
                            } else if ($_SESSION['details']['role_id'] == 2) {
                                echo 'Haulier';
                            } else {
                                echo 'Admin';
                            }
                            ?></b><span class="edit"><input class="btn btn-success" id="submit" type="submit" value="Update"></span></h3>
                        <hr />
                        <div class="account_col_row">
                            <span class="der3re der3re1"><b>Company Name:</b></span>
                            <span ><input type="text" name="companyname" id="companyname" class="form-control"  value='<?= $qu['companyname']; ?>'></span>
                            <div class="callout" style="display:none;" id="companyerror">Please Provide Company Name..</div>
                        </div>

                        <div class="account_col_row">
                            <span class="der3re der3re1"><b>Address:</b></span>
                            <span ><textarea required="required" rows="3" name="address" id="address" class="form-control" style="resize:none"><?= $qu['address']; ?></textarea></span>
                            <div class="callout" style="display:none;" id="addresserror">Please Provide Address..</div>						
                        </div>

                        <div class="account_col_row">
                            <span class="der3re der3re1"><b>Contact No.:</b></span>
                            <span><input type="text" required="required"  id="mobile" name="mobile" class="form-control" value='<?= $qu['mobile']; ?>'/></span>
                            <div class="callout" style="display:none;" id="conerror">Please Provide Contact No..</div>	
                        </div>
						
                        <div class="account_col_row">
                            <span class="der3re der3re1"><b>Email_Id:</b></span>
                            <span ><input type="email" id="email" name="email" readonly="readonly" class="form-control" value='<?= $qu['email']; ?>'/></span>
                        </div>
						
                        <div class="account_col_row">
                            <span class="der3re der3re1"><b>Contact Person:</b>
                            </span>
                            <span > <input type="text" name="contact_person" id="contact_person" class="form-control" value='<?= $qu['contact_person']; ?>' /></span>
                            <div class="callout" style="display:none;" id="personerror">Please Provide Contact Person..</div>	
                        </div>
						
                        <?php if ($_SESSION['details']['role_id'] == 2) { ?>    
                            <div class="account_col_row">
                                <span class="der3re der3re1"><b>Waste Management Lic. No.:</b></span>
                                <span > <input type="text" name="lic_num" id="lic_num" class="form-control" value='<?= $qu['lic_num']; ?>' /></span>
                                <div class="callout" style="display:none;" id="licerror">Please Provide License Number..</div>
                            </div>

                            <div class="account_col_row">
                                <span class="der3re der3re1"><b>Vehicle Type:</b></span>
								<input type="hidden" name="vehicles_type" value=""/>
                                <select class="form-control" name="vehicles_type[]" multiple="multiple" id="vehicles_type">
                                    <option value="">--Select Vehicle Type--</option>
									<option <?php foreach($vehicle_type as $vt){
										echo ($vt == 'Box Van/Truck') ? "selected" : "";
									} ?>>Box Van/Truck</option>
									<option <?php foreach($vehicle_type as $vt){
										echo ($vt == 'Tautliner/Curtainsider') ? "selected" : "";
									} ?>>Tautliner/Curtainsider</option>
									<option <?php foreach($vehicle_type as $vt){
										echo ($vt == 'Tipper') ? "selected" : "";
									} ?>>Tipper</option>
									<option <?php foreach($vehicle_type as $vt){
										echo ($vt == 'Flatbed') ? "selected" : "";
									} ?>>Flatbed</option>
									<option <?php foreach($vehicle_type as $vt){
										echo ($vt == 'Container') ? "selected" : "";
									} ?>>Container</option>
									<option <?php foreach($vehicle_type as $vt){
										echo ($vt == 'Skip Loader') ? "selected" : "";
									} ?>>Skip Loader</option>
									<option <?php foreach($vehicle_type as $vt){
										echo ($vt == 'Grab Lorry') ? "selected" : "";
									} ?>>Grab Lorry</option>
									<option id="other1" <?php echo ($cnt == 0) ? "" : "selected";	?>>Other</option>
                                </select>
                                <div class="callout" style="display:none;" id="vehicleerror">Please select vehicle type..</div>					
                                <div class="account_col_row">
                                    <span class="othervehicle" style="<?php echo ($cnt == 0) ? "display:none" : "display:block"; ?>">
                                        <input value="<?php foreach($arrdif as $ar){ $arrr .= $ar.','; } echo rtrim($arrr,',') ; ?>" type="text" name="othervehicle" id="othervehicle" class="form-control" placeholder="Vehicle Type">
                                    </span>
                                </div>					
                            </div> 

                        <?php } ?>
                    </form>
                </div>

                <!-- account info after onclick on edit button finished  -->			
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="account_col admin-jobs" style="width:100%">
                    <h3><b>Billing</b></h3>
                    <hr />
                    <?php
                    if ($_SESSION['details']['role_id'] == 3) {
                        $acc->billingcustomer();
                    } else if ($_SESSION['details']['role_id'] == 2) {
                        $acc->billinghaulier();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>