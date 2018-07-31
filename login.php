<?php
error_reporting(0);
//session_start();
include_once('include/header.php');
//print_r($_SESSION);
if (isset($_SESSION['details'])) {
    print '<script type="text/javascript">window.location=".?url=dashboard";</script>';
}
?>
<div id="msg_succ" class="alert alert-success alert-dismissible success" role="alert">
    Please register / login to view details of this job.
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $('#but_login').click(function (event) {
            event.preventDefault();
            var login = $.trim($('#username_id').val());
            var pass = $.trim($('#password').val());
            var job_id = $('#job_id').val();
            if (login == "")
            {
                document.getElementById("error2").style.display = 'none';
                document.getElementById("error3").style.display = 'none';
                document.getElementById("error4").style.display = 'none';
                document.getElementById("error1").style.display = null;
                return false;
            } else if (pass == "")
            {
                document.getElementById("error1").style.display = 'none';
                document.getElementById("error3").style.display = 'none';
                document.getElementById("error4").style.display = 'none';
                document.getElementById("error2").style.display = null;
                return false;
            } else if (login == "" && pass == "")
            {
                document.getElementById("error1").style.display = 'none';
                document.getElementById("error2").style.display = 'none';
                document.getElementById("error4").style.display = 'none';
                document.getElementById("error3").style.display = null;
                return false;
            }

            $.post("signin.php", {login: login, pass: pass},
                    function (data)
                    {
                        if (data == 1)
                        {
                            document.getElementById("error1").style.display = 'none';
                            document.getElementById("error2").style.display = 'none';
                            document.getElementById("error3").style.display = 'none';
                            document.getElementById("error4").style.display = 'none';
                            document.getElementById("success").style.display = null;
                            setTimeout("Login()", 2);
                            if (job_id == "") {
                                document.location.href = '.?url=dashboard';
                            } else {
                                document.location.href = '.?url=dashboar#' + job_id;
                            }
                        } else
                        {
                            //alert(data);
                            document.getElementById("error1").style.display = 'none';
                            document.getElementById("error2").style.display = 'none';
                            document.getElementById("error3").style.display = 'none';
                            document.getElementById("error4").style.display = null;
                            //alert('OOPS..please check the credentials..');
                        }
                    });

        });

        $('.abc').click(function (event) {
            var jobid = $(this).attr('id');
            $("#msg_succ").css("display", "block");
            setTimeout(function () {
                $('#msg_succ').fadeOut('slow');
            }, 1000);
            $('#username_id').focus();
            $('#job_id').val(jobid);
        });
    });
</script>
<?php session_start(); ?>
<!---------login section------->
<div class="container">
    <div class="row jobsview">
        <div class="col-lg-4 col-md-4 col-sm-4 jobs">
            <div class="login_section">
                <div class="text-center">
                    <h3><b>Jobs</b></h3>
                    <hr /> 
                </div>
                <?php $log->getjobsfront(0,20); ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="login_section">
                <div class="text-center">
                    <h3><b>BookALorry.co.uk</b></h3>
                    <hr /> 
                </div>
                <form method="post" action="">
                    <input type="hidden" id="job_id" value=""/>
                    <label>Username(Email address)</label>
                    <input id="username_id" name="username" type="email" class="form-control" placeholder="Enter Username" required="required" />
                    <div class="callout" id="error1" style="display:none;">Please provide an email-id.</div>

                    <label>Password</label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="Enter Password" required="required"  />
                    <div class="callout" id="error2" style="display:none;">Please provide a password.</div>

                    <div class="callout" id="error3" style="display:none;">Incorrect username or password. Access not granted.</div>
                    <div class="callout" id="error4" style="display:none;">Incorrect username or password. Access not granted.</div>
                    <div class="callout" style="color:green;display:none;" id="success">Login successful.</div>													
                    <input type="submit" id="but_login" class="btn btn-success" value="Login">
                    <div class="forget_pass"><a href=".?url=forgetpassword" >Forgot Password?</a></div>
                    <div class="forget_pass">Don’t have an account? <a href=".?url=register">Register here</a></div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php //include('include/footer.php');  ?>
    
