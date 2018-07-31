<?php
error_reporting(0);
$log->chk_login();
if ($_SESSION['details']['role_id'] != 1) {
    echo '<script type="text/javascript">window.location=".?url=dashboard";</script>';
}
?>
<script>
$(document).ready(function () {
    $.post("tasks.php", {search_ctmr: 'search_ctmr'},
    function (data)
    {
        $('.searchresult').html(data);
    });

    $.post("tasks.php", {customerdetail: 'customerdetail'},
    function (data)
    {
        $('.customerdetails').html(data);
    });

    $(document).on("click", ".searchctmr", function (event) {
        event.preventDefault();
        var email = $("#customeremail").val();
        var customerid = $("#customerid").val();
        var mobile = $("#customermobile").val();

        $.post("tasks.php", {search_ctmr: 'search_ctmr', email: email, customerid: customerid, mobile: mobile},
        function (data)
        {
            $('.searchresult').html(data);
        });
    });

    $(document).on("click", ".searchctmr1", function (event) {
        event.preventDefault();
        var email = $("#customeremail1").val();
        var customerid = $("#customerid1").val();
        var mobile = $("#customermobile1").val();

        $.post("tasks.php", {search_ctmr1: 'search_ctmr1', email: email, customerid: customerid, mobile: mobile},
        function (data)
        {
            $('.customerdetails').html(data);
        });
    });

    $(document).on("click", ".cview", function (event) {
        event.preventDefault();
        var cid = $(this).attr('cview-id');
        $.post("tasks.php", {ctmrview: 'ctmrview', cid: cid},
        function (data)
        {
            $('.customerview').html(data);
        });
        $(this).colorbox({width: "30%", height: "50%", scrolling: 'true', inline: true, href: "#cshowww"});
    });
});
</script>
<!---------user account section------->

<div style='display: none;'>
    <div class="customerview" id="cshowww"></div>
</div>

<div  style="margin-top:50px">
    <div class="container-fluid">
        <div class="control_console admin-jobs spacer-40">
            <div class="dashboard"><a href=".?url=dashboard" class="btn btn-success">Dashboard</a></div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#sectionA">View customers</a></li>
                <!-- <li><a data-toggle="tab" href="#sectionB">Customers details</a></li>-->
            </ul>

            <div class="tab-content">
                <div id="sectionA" class="tab-pane fade in active">
                    <div class="open_jobs">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <div class="col-md-12 csearch">   
                                    <form name="search1" id="search1" method="post">
                                        <input type="text" id="customerid" name="customerid" class="col-md-3 customerssearch" placeholder="Customer id"/>
                                        <input type="email" id="customeremail" name="customeremail" class="col-md-3 customerssearch" placeholder="Email"/>
                                        <input type="text" id="customermobile" name="customermobile" class="col-md-3 customerssearch" placeholder="Mobile no."/>	
                                        <input type="button" id="search1" value="search" class="btn btn-success col-md-2 searchctmr">
                                    </form>
                                </div>
                                <div class="searchresult"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="sectionB" class="tab-pane fade">
                    <div class="open_jobs">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <div class="col-md-12 csearch">   
                                    <form name="search1" id="search1" method="post">
                                        <input type="text" id="customerid1" name="customerid" class="col-md-3 customerssearch" placeholder="Customer id"/>
                                        <input type="email" id="customeremail1" name="customeremail" class="col-md-3 customerssearch" placeholder="Email"/>
                                        <input type="text" id="customermobile1" name="customermobile" class="col-md-3 customerssearch" placeholder="Mobile no."/>	
                                        <input type="button" id="search1" value="search" class="btn btn-success col-md-2 searchctmr1">
                                    </form>
                                </div>
                                <div class="customerdetails"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


