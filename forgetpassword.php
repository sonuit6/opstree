<?php
error_reporting(0);
if (isset($_SESSION['details'])) {
    print '<script type="text/javascript">window.location=".url=dashboard";</script>';
}
?>  
<script type="text/javascript">
    $(document).ready(function () {
        $("#but_forget").click(function (event) {
            event.preventDefault();
            var email = $("#email").val();
            if (email == "")
            {
                $('#emailerror').show();
                document.register.email.focus();
                return false;
            }
            else if(email!= "")
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
            
            
           
            $.post("tasks.php", {forget: 'forget', email: email},
                function (data)
                {
                    //alert(data);
                    //document.write(data);
                    if (data == 1)
                    {

                        $('#success').show();
                        $('#error').hide();
                    } else
                    {

                        $('#error').show();
                        $('#success').hide();
                    }
                });
        });
    });
</script>
<!---------login section------->
<div class="container">
    <div class="login_section">
        <div id="error" style="display:none;" class="email_not_exist">This email address is not available.</div>	
        <div id="success" style="color:green;display:none;" class="email_not_exist"><b>THANK YOU</b> <br>Your password reset link has been sent to this email address.</div>	
        <div class="text-center">
            <h3><b>Forgot Password <!--BookALorry.co.uk--></b></h3>
            <div class="tagline">(BookALorry.co.uk)</div>
            <hr /> 
        </div>
        
        <form method="post" action="">
            <div class="resetpassword_msg">Please enter your email address below. Your login information will be sent to this email address.</div>
            <label>Email</label>
            <input id="email" name="email" type="email" class="form-control" placeholder="Enter User Email" required="required" />
            <div class="callout" style="display:none;" id="emailerror">Please provide an email-id.</div>
            <div class="forget_pass">										
                <input type="submit" id="but_forget" class="btn btn-success" value="Submit">
            </div> 
        </form>
    </div>
</div>
<?php include('footer.php'); ?>