<?php /*********************************************************************************
 * Author : Meenakshi Singh                                                      *
 * Date Created : 17/07/2015                                                     *
 * Date Modified :                                                               *
 * Reasons :                                                                     *
 * By : Meenakshi Singh                                                          *
 * Lines Of Code : 31                                                            *
 * Company Name : Mount Talent Consulting Pvt. Ltd.                              *
 * Application Name : HRMS						         *
 * Notes :                                                                       *
 * Year : 2015-2016                                                              *
 *********************************************************************************/
session_start();
error_reporting(0);
if (isset($_POST['job_id'])) {
	 $hid= $_SESSION['details']['id'];
	
    $job_id = $_POST['job_id'];
    $flname = $_FILES['file']['name'];
    $file_array = explode(".", $flname);
	
    end($file_array);
   
	
    $key = key($file_array);
    $dot = strpos($flname, '.');
    $extention = substr($flname, $dot);
    $file_name = $_POST['file_name'];
    $dir = 'document_upload';
    if (!file_exists($dir .'/'.$hid.'/'.$job_id)) {
        mkdir($dir . '/'.$hid.'/'.$job_id, 0777, true);
    }
    if ($file_array[$key] == 'pdf' || $file_array[$key] == 'jpg' || $file_array[$key] == 'jpeg' || $file_array[$key] == 'png' || $file_array[$key] == 'doc' || $file_array[$key] == 'docx')
		{
       
        if($_FILES['file']['size'] <= 2097152){   //10mb
            
           if (isset($file_name)) {
              
  $name = time().'_'.$job_id.$extention;
             
 move_uploaded_file($_FILES["file"]["tmp_name"], $dir.'/'.$hid.'/'.$job_id . '/' . $name);
echo $name;
            }
        }
		else{
            echo 0;
            return False;
        }
    }
    else{
        echo 1;
        return False;
    }
    
}
else{
    return False;
}
    
   
?>

