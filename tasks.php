<?php

error_reporting(0);
include('function/load.php');
###############################################
if (isset($_POST['register'])) {
    $user = $reg->isUserExist();
    if ($user) {
        print 2;
    } else {
        $reg->adduser();
    }
}
##################################
if (isset($_POST['forget'])) {
    $forget->forget();
}
#################################
if (isset($_POST['hregister'])) {
    $user = $hreg->isUserExist();
    if ($user) {
        print 2;
    } else {
        $hreg->adduser();
    }
}
#################################
if (isset($_POST['bookalorry'])) {
    $bal = $bal->addjobes();
}
#################################
if (isset($_POST['verify_id'])) {
    $ver = $objview->verifyjob();
}
#################################
if (isset($_POST['verify_job_id'])) {
    $quotes->singlejob();
}
#################################
if (isset($_POST['requestjob'])) {
    $quotes->jobassign();
}
#################################
if (isset($_POST['searchhaulier'])) {
    $quotes->showhaulier();
}
#################################
if (isset($_POST['editaccount'])) {
    $acc->updateaccount();
    if ($acc) {
        echo '1';
    }
}
#################################
if (isset($_POST['jobdesc'])) {
    $objview->description();
}
#################################
if (isset($_POST['tenderviewinfo'])) {
    $ten->viewinfo();
}
#################################
if (isset($_POST['amount'])) {
    $ten->sendamount();
}
#################################
if (isset($_POST['assignjob'])) {
    $quotes->assign();
}
#################################
if (isset($_POST['finaljobassign'])) {
    $quotes->finaljobtohaulier();
}
#################################
if (isset($_POST['searchfinalhaulier'])) {
    $quotes->searchfinhaulier();
}
#################################
if (isset($_POST['reviseamount'])) {
    $hvj->updateamount();
}
#################################
if (isset($_POST['editbookalorry'])) {
    $bal->editbookalorry();
}
#################################
if (isset($_POST['vjob'])) {
    $bal->vjobs();
}
#################################
if (isset($_POST['viewjob'])) {
    $log->viewjob();
}
#################################
if (isset($_POST['hvjob'])) {
    $hreg->hviewinfo();
}
#################################
if (isset($_POST['requestmoreinfo'])) {
    $ten->requestmoreinfo();
}
#################################
if (isset($_POST['replayadmin'])) {
    $quotes->adminreplay();
}
#################################
if (isset($_POST['adminsenddesc'])) {
    $quotes->adminsenddesc();
}
#################################
if (isset($_POST['showcustomers'])) {
    $ctmr->viewcustomer();
}
#################################
if (isset($_POST['ctmrview'])) {
    $ctmr->ctmrdetailsview();
}
#################################
if (isset($_POST['search_ctmr'])) {
    $ctmr->viewcustomer();
}
#################################
if (isset($_POST['customerdetail'])) {
    $ctmr->customerdetail();
}
#################################
if (isset($_POST['search_ctmr1'])) {
    $ctmr->customerdetail();
}
#################################
if (isset($_POST['showallhauliersforprice'])) {
    $quotes->showallhauliersforprice();
}
#################################
if (isset($_POST['adminprice'])) {
    $quotes->adminprices();
}
#################################
if (isset($_POST['acceptjob'])) {
    $ten->acceptjob();
}
#################################
if (isset($_POST['rejectjob'])) {
    $ten->rejectjob();
}
#################################
if (isset($_POST['moreloadrequired'])) {
    $ten->moreloadrequired();
}
#################################
if (isset($_POST['addmoreload'])) {
    $hvj->addmoreload();
}
#################################
if (isset($_POST['uploadtkt'])) {
    $hvj->uploadtkt();
}
#################################
if (isset($_POST['editadminprofile'])) {
    $admin->editadminprofile();
}
#################################
if (isset($_POST['adminpass'])) {
    $admin->adminpass();
}
#################################
if (isset($_POST['loassend'])) {
    $hvj->loassend();
}
#################################
if (isset($_POST['customerduedate'])) {
    $quotes->customerduedate();
}
#################################
if (isset($_POST['haulierduedate'])) {
    $quotes->haulierduedate();
}
#################################
if (isset($_POST['tktdownload'])) {
    $hvj->tktdownload();
}
#################################
if (isset($_POST['deletetkt'])) {
    $hvj->deletetkt();
}
#################################
if (isset($_POST['updatestatus'])) {
    $quotes->updatestatus();
}
#################################
if (isset($_POST['hauliersall'])) {
    $quotes->hauliersall();
}
?>