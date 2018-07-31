<?php
/*********************************************************************************
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
 *********************************************************************************/
session_start();

if(isset($_SESSION['details']))
{
header('Location:dashboard');	
	
}
include('include/header.php');		

 $email=$_REQUEST['id'];
 
  $user = $vrfy->actvateaccount($email); 
 if ($user) {  
               $data= "1";  
			   
			  echo "<script>alert('Your account has successfully been activated, please login now')</script>";  
print '<script type="text/javascript">window.location="index.php";</script>'; 
			   
			}  
			else
			{
			 $data= "0"; 	
			}
 
 

 ?>
 <script type="text/javascript">
    $(document).ready(function () {
				
		$('#cpassword').on('keyup', function() {
				var password = $("#password").val();
				var confirmPassword = $("#cpassword").val();
				if (password != confirmPassword)
				{
				 $("#error1").show();	
				
				}
				else
				{
				$("#error1").hide();
				}
		});
		
		$("#submit").click(function(){
			 
			var password = $("#password").val();
			var confirmPassword = $("#cpassword").val();
			if (password != confirmPassword)
				{
					document.verify.cpassword.focus();
					
				return false;
				}
				
			var upperCase= new RegExp('[A-Z]');
				var lowerCase= new RegExp('[a-z]');
				var numbers = new RegExp('[0-9]');
if(password.match(upperCase) || password.match(lowerCase) && password.match(numbers) && password.length>= 8)  
{
return true;	 

}
else
{
document.verify.password.focus();
$("#error2").show();
    $("#passwordErrorMsg").html("Your password Alleast 8 characters Long. It must contain a mixture of Alphanumeric.");
					
				return false;	
}
			
			
				
				
		});
		
		
   
   $('#password').on('keyup', function() {
				var password = $("#password").val();
				var upperCase= new RegExp('[A-Z]');
				var lowerCase= new RegExp('[a-z]');
				var numbers = new RegExp('[0-9]');
if(password.match(upperCase) || password.match(lowerCase) && password.match(numbers) && password.length>= 8)  
{
	 $("#error2").show();
    $("#passwordErrorMsg").html("Strong Password")

}
else
{
	 $("#error2").show();
    $("#passwordErrorMsg").html("Your password Alleast 8 characters Long. It must contain a mixture of Alphanumeric.");
}
		});
		
	});
					</script>

					<!---------Register section------->
<div  class="container">
<div  class="login_section">
<?php 

if(isset($data))
{
	if($data==1)
	{
echo '<div class="err">Your Password Successfully Reset. Please Login Now.</div>';	
	}
     
	
}
?>

<div class="text-center">
<h3><b>Reset Password</b></h3>
<div>(BookALorry.co.uk)</div>
<hr />
</div>
<form name="verify" action="" method="post">

	<label>Password</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Password"required="required" />
	<div class="callout callout-warning" style="height:30px;padding:0px 10px;margin-top: -14px; margin-bottom: 10px;display:none;" id="error2">
     <h4 id="passwordErrorMsg" style="font-size:15px;color:red;font-family:Verdana"></h4></div>
	
	
	<label>Conform Password</label>
    <input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="Company Name"required="required" />
	
	<div class="callout callout-warning" style="height:30px;padding:0px 10px;margin-top: -14px;display:none;" id="error1">
     <h4 style="font-size:15px;color:red;font-family:Verdana">Enter Confirm Password Same as Password</h4>
     </div>
	
	<input type="submit" id="submit" value="Reset Password" class="btn btn-success">
   
</form>

</div >
</div >


<?php include('include/footer.php'); ?>