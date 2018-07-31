<?php
/* * *******************************************************************************
 * Author : Meenakshi Singh                                                      *
 * Date Created : 17/07/2015                                                     *
 * Date Modified :                                                               *
 * Reasons :                                                                     *
 * By : Meenakshi Singh                                                          *
 * Lines Of Code : 18                                                            *
 * Company Name : Mount Talent Consulting Pvt. Ltd.                              *
 * Application Name : HRMS						         *
 * Notes :                                                                       *
 * Year : 2015-2016                                                              *
 * ******************************************************************************* */

error_reporting(E_ALL);
if (isset($_SESSION['details'])) {
    print '<script type="text/javascript">window.location=".?url=dashboard";</script>';
}
?>
<script type="text/javascript">
    $(document).ready(function () {

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

        $("#submit").click(function (event) {
            event.preventDefault();



            var email = $("#email").val();
            var password = $("#password").val();
            var confirmPassword = $("#cpassword").val();
            var companyname = $("#companyname").val();
            var address = $("#address").val();
            var mobile = $("#mobile").val();
            var contact_person = $("#contact_person").val();

            if (email == "")
            {
                $('#emailerror').show();
                document.register.email.focus();
                return false;
            }  else if(email!= "")
            {
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!filter.test($('#email').val())) {
                    $('#email').css('border', '1px solid #FF4747');
                    $('#emailerror').show();
                document.register.email.focus();
                return false;
                }
            }
              $('#email').css('border', '');
                $('#emailerror').hide();
            
            
            var upperCase = new RegExp('[A-Z]');
            var lowerCase = new RegExp('[a-z]');
            var numbers = new RegExp('[0-9]');
            if (password.match(upperCase) || password.match(lowerCase) && password.match(numbers) && password.length >= 8)
            {
 $("#error2").hide();
$('#password').css('border', '');
            } else
            {
                document.register.password.focus();
                $("#error2").show();
                $("#passwordErrorMsg").html("Your password must be at least 8 characters long and contain a mixture of letters and numbers.");
            $('#password').css('border', '1px solid #FF4747');
                return false;
            }
            
             if (password != confirmPassword)
            {
                document.register.cpassword.focus();
                $('#cpassword').css('border', '1px solid #FF4747');
                return false;
            }
            else
            {
               $('#cpassword').css('border', '');  
            }
            
            
            
            
            
            if (companyname == "")
            {
                $('#companyerror').show();
                 $('#companyname').css('border', '1px solid #FF4747');
                document.register.companyname.focus();
                return false;
            }
            else
            {
                 $('#companyname').css('border', '');
               $('#companyerror').hide();  
            }

            if (address == "")
            {
                $('#addresserror').show();
                 $('#address').css('border', '1px solid #FF4747');
                document.register.address.focus();
                return false;
            }
             else
            {
                     $('#address').css('border', '');
               $('#addresserror').hide();  
            }


            if (mobile == "")
            {
                $('#conerror').show();
                     $('#mobile').css('border', '1px solid #FF4747');
                document.register.mobile.focus();
                return false;
            }
 else
            {
                 $('#mobile').css('border', '');
               $('#conerror').hide();  
            }

            if (contact_person == "")
            {
                $('#personerror').show();
                 $('#contact_person').css('border', '1px solid #FF4747');
                document.register.contact_person.focus();
                return false;
            }
 else
            {
                $('#contact_person').css('border', '');
               $('#personerror').hide();  
            }

            var email = $("#email").val();
            var password = $("#password").val();
            var confirmPassword = $("#cpassword").val();
            var companyname = $("#companyname").val();
            var address = $("#address").val();
            var mobile = $("#mobile").val();
            var contact_person = $("#contact_person").val();
            $.post("tasks.php", {register: 'register', email: email, password: password, companyname: companyname, address: address, mobile: mobile, contact_person: contact_person},
                    function (data)
                    {
                      
                        if (data == 1)
                        {
                            $("#rmsg").show();

                            alert('Thank you for registering with us, you will soon get an email to activate your account.');


                            window.location = "index.php";

                        } else
                        {

                            alert("This email address has already been used.");
document.register.email.focus();
                            //window.location.reload();
                        }
                    });


        });

        $("#mobile").keypress(function (e) {

            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
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

    });
</script>

<!---------Register section------->
<div id="msg_succ" class="success"></div>
<div  class="container">
    <div  class="login_section">

        <div class="text-center">
			<h3><b>Customer  Registration <!--BookALorry.co.uk--></b></h3>
			<div class="tagline">(BookALorry.co.uk)</div>
			<hr />
		</div>
        <form name="register" id="register" method="post">
            <label>Email<span style="color:#F00;">*</span></label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email"/>
            <div class="callout callout-warning" style="height:30px;padding:8px 10px;display:none;" id="emailerror">
                <h4 style="font-size:15px;color:red;font-family:Verdana">Please provide an email-id.</h4>
            </div>
            <label>Password<span style="color:#F00;">*</span></label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password"required="required" />
            <div class="callout callout-warning" style="height:38px;padding:0px 10px;margin-top: -14px; margin-bottom: 10px;display:none;" id="error2">
                <h4 id="passwordErrorMsg" style="font-size:15px;color:red;font-family:Verdana"></h4></div>


            <label>Confirm Password<span style="color:#F00;">*</span></label>
            <input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="Cofirm Password"required="required" />

            <div class="callout callout-warning" style="height:30px;padding:0px 10px;margin-top: -14px;display:none;" id="error1">
                <h4 style="font-size:15px;color:red;font-family:Verdana">Confirm password should be same as password.</h4>
            </div>


            <label>Company Name<span style="color:#F00;">*</span></label>
            <input type="text" name="companyname" id="companyname" class="form-control" placeholder="Company Name"/>
            <div class="callout callout-warning" style="height:30px;padding:0px 10px;margin-top: -14px;display:none;" id="companyerror">
                <h4 style="font-size:15px;color:red;font-family:Verdana">Please provide the Company name.</h4>
            </div>

            <label>Address<span style="color:#F00;">*</span></label>
            <textarea rows="3" name="address" id="address" class="form-control" placeholder="Address" style="resize:none"></textarea>
            <div class="callout callout-warning" style="height:30px;padding:0px 10px;margin-top: -14px;display:none;" id="addresserror">
                <h4 style="font-size:15px;color:red;font-family:Verdana">Please provide address.</h4>
            </div>


            <label>Contact No.<span style="color:#F00;">*</span></label>
            <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Contact No." onkeyup="this.value = this.value.replace(/[^0-9]/g, '')" />
            <div class="callout callout-warning" style="height:30px;padding:0px 10px;margin-top: -14px;display:none;" id="conerror">
                <h4 style="font-size:15px;color:red;font-family:Verdana">Please provide contact no.</h4>
            </div>

            <label>Contact Person<span style="color:#F00;">*</span></label>
            <input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="Contact Person" onkeyup="this.value = this.value.replace(/[^A-Za-z. ]/g, '')"/>
            <div class="callout callout-warning" style="height:30px;padding:0px 10px;margin-top: -14px;display:none;" id="personerror">
                <h4 style="font-size:15px;color:red;font-family:Verdana">Please provide the Contact Person Name.</h4>
            </div>

            <input type="submit" id="submit" value="Register" class="btn btn-success">
            <div class="rmsg" id="rmsg" style="display:none;">Thanks,Registration has been successful.</div>
            <div  class="forget_pass">Already have an account? <a href=".?url=login">Login here</a></div>
        </form>

    </div >
</div >

