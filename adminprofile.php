<?php
error_reporting(0);
$qu = $admin->accountinfo();
$log->chk_login();
if ($_SESSION['details']['role_id'] != 1) {
    echo '<script type="text/javascript">window.location=".?url=dashboard";</script>';
}
?>
<script>
    $(document).ready(function () {
        $("#edit").click(function (event) {
            event.preventDefault();
            $(".showprofile").css({"display": "none"});
            $(".hideprofile").css({"display": "block"});
        });

		$("#mobile").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });

        $("#submit").click(function (event) {
            event.preventDefault();
            var email = $("#email").val();
            var companyname = $("#companyname").val();
            var address = $("#address").val();
            var mobile = $("#mobile").val();
            if (email == "")
            {
                $('#emailerror').show();
                $('#companyerror').hide();
                $('#addresserror').hide();
                $('#conerror').hide();
                $('#email').focus();
                return false;
            } else if (companyname == "")
            {
                $('#companyerror').show();
                $('#emailerror').hide();
                $('#addresserror').hide();
                $('#conerror').hide();
                $('#companyname').focus();
                return false;
            } else if (address == "")
            {
                $('#companyerror').hide();
                $('#addresserror').show();
                $('#conerror').hide();
                $('#emailerror').hide();
                $('#address').focus();
                return false;
            } else if (mobile == "")
            {
                $('#companyerror').hide();
                $('#addresserror').hide();
                $('#conerror').show();
                $('#emailerror').hide();
                $('#mobile').focus();
                return false;
            }

            var val = decodeURIComponent($.param($('#updateadmin :input')));
            val = val.replace(/[^a-zA-Z 0-9 & @ # ( ) % $ ! = \/ . , ! ' " * < > : ; \- _]+/g, " ").replace(/&amp;/g, "&").replace(/&nbsp;/g, " ").replace(/ & /g, "<$$$>").replace("cheque_status=Cleared", "");
            $.post("tasks.php", {editadminprofile: 'editadminprofile', data: val},
                    function (data)
                    {
                        //alert(data);
                        if (data == 1)
                        {
                            $("#msg_succ").css("display", "block");
                        } else
                        {
                            $(".error").css("display", "block");
                        }
                    });
        });

        $(".close").click(function (event) {
            event.preventDefault();
            window.location.reload();
        });

        $('#cpassword').on('keyup', function () {
            var password = $("#password").val();
            var confirmPassword = $("#cpassword").val();
            if (password != confirmPassword)
            {
                $("#error1").show();
            } else
            {
                $("#error1").hide();
            }
        });

        $('#password').on('keyup', function () {

            var password = $("#password").val();
            var upperCase = new RegExp('[A-Z]');
            var lowerCase = new RegExp('[a-z]');
            var numbers = new RegExp('[0-9]');
            if (password.match(upperCase) || password.match(lowerCase) && password.match(numbers) && password.length >= 8)
            {
                $("#error2").show();
                $("#passwordErrorMsg").html("Strong Password")
            } else
            {
                $("#error2").show();
                $("#passwordErrorMsg").html("Your password must be at least 8 characters long and contain a mixture of letters and numbers.");
            }
        });

        $("#changepass").click(function (event) {
            event.preventDefault();
            var ccpassword = $("#ccpassword").val();
            var password = $("#password").val();
            var cpassword = $("#cpassword").val();
            if (ccpassword == "")
            {
                alert('Please provide current password.');
                $('#ccpassword').focus();
                return false;
            } else if (password != cpassword)
            {
                alert('Confirm Password Should be Same as Password.');
                $('#cpassword').focus();
                return false;
            }
            var upperCase = new RegExp('[A-Z]');
            var lowerCase = new RegExp('[a-z]');
            var numbers = new RegExp('[0-9]');
            if (password.match(upperCase) || password.match(lowerCase) && password.match(numbers) && password.length >= 8)
            {
            } else
            {
                document.register.password.focus();
                $("#error2").show();
                $("#passwordErrorMsg").html("Your password must be at least 8 characters long and contain a mixture of letters and numbers.");
                return false;
            }

            $.post("tasks.php", {adminpass: 'adminpass', ccpassword: ccpassword, password: password},
                    function (data)
                    {
                        //alert(data);
                        if (data == 1)
                        {
                            alert('Your password has successfully been updated.');
                            window.location.reload();

                        } else if (data == 2)
                        {
                            alert('Your current password is incorrect!');
                        } else
                        {
                            alert('Some error occured. Please try again.');
                        }
                    });
        });
    });
</script>

<!---------user account section------->
<div id="msg_succ" class="alert alert-success alert-dismissible success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    Your account has been successfully updated.
</div>
<div id="msg_succ" class="alert alert-success alert-dismissible error" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    Some error occured. Please try again.
</div>
<div class="container spacer-40"  >
    <div class="control_console">
        <div class="row">
            <div class="back" style="z-index:999"><a href=".?url=dashboard" class="btn btn-success">Back</a></div>
            <div class="col-lg-6 col-md-6 col-sm-6 showprofile">
                <div class="account_col">
                    <h3><b>Admin</b><span class="adminprofile edit" id="edit"><input class="btn btn-success" type="button" value="Edit profile"></span></h3>
                    <hr />
                    <div class="account_col_row">
                        <span class="der3re"><b>Email Id:</b></span><span ><?= $qu['email']; ?></span>
                    </div>					
                    <div class="account_col_row">
                        <span class="der3re"><b>Company Name:</b></span><span ><?= $qu['companyname']; ?></span>
                    </div>
                    <div class="account_col_row">
                        <span class="der3re"><b>Address:</b></span><span ><?= $qu['address']; ?></span>
                    </div>
                    <div class="account_col_row">
                        <span class="der3re"><b>Contact No.:</b></span><span><?= $qu['mobile']; ?></span>
                    </div>
                    <div class="account_col_row">
                        <span class="der3re"><b>Last login:</b></span><span ><?= date("d-m-Y, g:i a", strtotime($qu['last_login'])); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 hideprofile" style="display:none;">
                <form name="updateadmin" id="updateadmin" method="post">
                    <div class="account_col">
                        <h3><b>Admin</b><span class="adminprofile edit" id="edit"><input class="btn btn-success" id="submit" type="submit" value="Update profile"></span></h3>
                        <hr />
                        <div class="account_col_row">
                            <span class="der3re der3re1"><b>Email:</b></span>
                            <span ><input type="text" name="email" id="email" class="form-control"  value='<?= $qu['email']; ?>'></span>
                            <div class="callout" style="display:none;" id="emailerror">Please Provide email..</div>
                        </div>					
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
                            <span class="der3re"><b>Last login:</b></span><span ><?= date("d-m-Y, g:i a", strtotime($qu['last_login'])); ?></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 ">
                <div class="account_col">
                    <h3><b>Change password</b></h3>
                    <hr />
                    <form name="change pass" action="" method="post">
                        <label>Current Password</label>
                        <input type="password" id="ccpassword" name="ccpassword" class="form-control" placeholder="Current password"required="required"/>
                        <label>Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password"required="required" />
                        <div class="callout" style="height:38px;padding:0px 10px;margin-top: -14px; margin-bottom: 10px;display:none;" id="error2">
                            <h4 id="passwordErrorMsg" style="font-size:15px;color:red;font-family:Verdana"></h4></div>
                        <label>Conform Password</label>
                        <input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="Cofirm Password"required="required" />
                        <div class="callout" style="display:none;" id="error1">Confirm Password Should be Same as Password.</div>				 
                        <input type="submit" id="changepass" value="Submit" class="btn btn-success">
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>