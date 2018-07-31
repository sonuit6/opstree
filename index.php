<?php
/*********************************************************************************
 * Author : Meenakshi Singh                                                      *
 * Date Created : 17/07/2015                                                     *
 * Date Modified :                                                               *
 * Reasons :                                                                     *
 * By : Meenakshi Singh                                                          *
 * Lines Of Code : 136                                                           *
 * Company Name : Mount Talent Consulting Pvt. Ltd.                              *
 * Application Name : HRMS						         *
 * Notes :                                                                       *
 * Year : 2015-2016                                                              *
 *********************************************************************************/
ob_clean();
error_reporting(0);
include("include/header.php");
echo "Sonu Kumar";
//$log->chk_login();
$url='';
switch ($_GET['url']) {
        case "account":
        {
            include("account.php");
            break;
        }
        case "register":
        {
            include("register.php");
            break;
        }
    case "dashboard":
    {
        include("dashboard.php");
        break;
    }
	 case "view-price":
    {
        include("view-price.php");
        break;
    }
	 case "book-a-lorry":
    {
        include("book-a-lorry.php");
        break;
    }
	
	case "tenders":
    {
        include("tenders.php");
        break;
    }
	
	case "view-jobs":
    {
        include("view-jobs.php");
        break;
    }
   case "forgetpassword":
        {
            include("forgetpassword.php");
            break;
        }
		
		 case "hregister":
        {
			
            include("hregister.php");
            break;
        }
		
	case "adminjobs":
        {
			
            include("adminjobs.php");
            break;
        }
case "quotes":
        {
			
            include("quotes.php");
            break;
        }


case "customers":
        {
			
            include("customers.php");
            break;
        }
case "profile":
        {
            include("adminprofile.php");
            break;
        }

        case "logout":
        {
            include("logout.php");
            break;
        }
        
        
    default : {
		
            include("login.php");
            break;
        }
}
 include("include/footer.php") ?>
