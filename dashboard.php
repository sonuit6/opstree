<?php
@session_start();
$log->chk_login();
?>
<?php if ($_SESSION['details']['role_id'] == 3) { ?> 

    <!---------Control Console section------->
    <div class="container spacer-40"  >
        <div class="control_console" style="height:400px">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <div class="">
                        <h3><b>BOOK A LORRY</b></h3>
                        <p class="spacer-40">This is your control console, From here you can book a lorry, view prices for current tenders, manage your account.</p>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-8">
                    <h3 class="text-center"><b>Control Console(Customer)</b></h3>
                    <div class="control_console_panel">
                        <span class="hex1"><img src="img/hex1.png" /><br /><a href=".?url=account">Account</a></span>
                        <span class="hex2"><img src="img/hex2.png" /><br /> <a href=".?url=view-price">View Prices</a></span>
                        <span class="hex3"><img src="img/hex3.png" /><br /><a href=".?url=book-a-lorry">Book A Lorry</a></span>
                        <span class="hex4"><img src="img/hex4.png" /></span>
                        <span class="hex5"><img src="img/hex5.png" /></span>
                        <span class="hex6"><img src="img/hex6.png" /></span>       
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else if ($_SESSION['details']['role_id'] == 2) { ?>

    <!---------Control Console section------->
    <div class="container spacer-40"  >
        <div class="control_console" style="height:400px">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <div class="">
                        <h3><b>BOOK A LORRY</b></h3>
                        <p class="spacer-40">This is your control console, From where you can View live jobs, tender prices, manage your account.</p>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-8">
                    <h3 class="text-center"><b>Control Console(Haulier)</b></h3>
                    <div class="control_console_panel">
                        <span class="hex1"><img src="img/hex1.png" /><br /><a href=".?url=account">Account</a></span>
                        <span class="hex2"><img src="img/hex2.png" /><br /> <a href=".?url=tenders">Tender</a></span>
                        <span class="hex3"><img src="img/hex3.png" /><br /><a href=".?url=view-jobs">View Jobs</a></span>
                        <span class="hex4"><img src="img/hex4.png" /></span>
                        <span class="hex5"><img src="img/hex5.png" /></span>
                        <span class="hex6"><img src="img/hex6.png" /></span>       
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else if ($_SESSION['details']['role_id'] == 1) { ?>

    <!---------Control Console section------->
    <div class="container spacer-40">
        <div class="control_console" style="height:400px">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <div class="">
                        <h3><b>BOOK A LORRY</b></h3>
                        <p class="spacer-40">This is Admin control console, From where Admin can Control all the things.</p>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-8">
                    <h3 class="text-center"><b>Admin Control Panel</b></h3>
                    <div class="control_console_panel admin">
                        <span class="hex1"><img src="img/hex1.png" /><br /><a href=".?url=customers">Customers</a></span>
                        <span class="hex2"><img src="img/hex2.png" /><br /> <a href="#">Reports</a></span>
                        <span class="hex3"><img src="img/hex3.png" /><br /><a href=".?url=hregister">Hauliers</a></span>
                        <span class="hex4"><img src="img/hex3.png" /><br /><a href=".?url=quotes">Quotes</a></span></span>
                        <span class="hex5"><img src="img/hex2.png" /><br /><a href=".?url=adminjobs">Jobs</a></span></span>
                        <span class="hex6"><img src="img/hex2.png" /><br /><a href=".?url=profile">Profile</a></span></span>       
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<div class="container spacer-40">
    <div class="control_console">
        <div class="row">
            <div class="text-center">
                <h3><b>Jobs</b></h3>
                <br/>
            </div>	
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?php
                if($_SESSION['details']['role_id']==3){
                    $log->getjobscustomer(0,20);
                }else{
                    $log->getjobshaulier();
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div style='display: none;'>
	<div class="viewjobs" id="ddescshow"></div>
</div>
<script>
    $(".viewjob").click(function(event) {
        event.preventDefault();
        var job_id = $(this).attr('view-id');
        $.post("tasks.php", {viewjob:'viewjob', job_id:job_id},
        function (data){
            //alert(data);
            $('.viewjobs').html(data);
        });
        $(this).colorbox({width:"50%", height:"80%", scrolling:'true', inline:true, href:"#ddescshow"});
    });
    
    $(function () {
        $(".readmore").click(function () {
            var id = $(this).attr('jobid');
            $(this).colorbox({width: "740px", height: "auto", scrolling: 'false', inline: true, href: "#popup_" + id});
        });
    });
</script>