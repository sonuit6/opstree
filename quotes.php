<?php
error_reporting(E_ALL);
$log->chk_login();
if ($_SESSION['details']['role_id'] != 1) {
    echo '<script type="text/javascript">window.location=".?url=dashboard";</script>';
}
?>

<script src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
        $(".ddate").datepicker({dateFormat: 'yy-mm-dd'});

        var email = $("#email").val();
        var address = $("#address").val();
        if (email == '' || address == '') {
            $.post("tasks.php", {searchhaulier: 'searchhaulier'},
                    function (data)
                    {
                        $('.searchhaulier').html(data);
                    });
        }

        $(document).on("click", "#search", function (event) {
            event.preventDefault();
            var email = $("#email").val();
            var address = $("#address").val();
            //alert(address);
            $.post("tasks.php", {searchhaulier: 'searchhaulier', email: email, address: address},
                    function (data) {
                        //alert(data);
                        $('.searchhaulier').html(data);
                    });
        });

        $(".haulier").click(function (event) {
            event.preventDefault();
            var verify_job_id = $(this).attr('data-blogid');
            //alert(verify_job_id);
            $.post("tasks.php", {verify_job_id: verify_job_id},
                    function (data) {
                        //alert(data);
                        $('.test').html(data);
                    });
            $(this).colorbox({width: "80%", height: "60%", scrolling: 'true', inline: true, href: "#hauliershow"});
        });

        $(document).on("click", "#selecctall", function (event) {
            if (this.checked) { // check select status
                $('.checkbox1').each(function () { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"               
                });
            } else {
                $('.checkbox1').each(function () { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"                       
                });
            }
        });

        $("#request").click(function (event) {
            event.preventDefault();
            var job_id = $("#job_id").val();
            var haulier_id = $("input[name=haulierchk]:checked").map(function () {
                return this.value;
            }).get().join(",");
            $.post("tasks.php", {requestjob: 'requestjob', job_id: job_id, haulier_id: haulier_id},
                    function (data) {
                        //alert(data);
                        if (parseInt(data) == 1) {
                            alert('This job has successfully been  subimitted to hauliers.');
                            document.location.href = '.?url=quotes';
                        }
                    });
        });

        $(".responsemore").on('change', function () {
            $('.ui-draggable-handle').addClass('closefixed');
            var job_id = $('option:selected', this).attr('job_id');
            var haulier_id = $('option:selected', this).attr('h_id');
            var email = $('option:selected', this).val();
            $.post("tasks.php", {replayadmin: 'replayadmin', job_id: job_id, haulier_id: haulier_id, email: email},
                    function (data) {
                        //alert(data);
                        if (data) {
                            $('.chats').html(data);
                        }
                    });
            $('#dialog-modal').dialog({
                modal: true,
                autoOpen: false
            });
            $('#dialog-modal').dialog('open');
            $('.responsemore option').prop('selected', function () {
                return this.defaultSelected;
            });
        });

        $(document).on("click", ".viewallhaulier", function (event) {
            event.preventDefault();
            var job_id = $(this).attr('job_id');
            $.post("tasks.php", {hauliersall: 'hauliersall', job_id: job_id},
                    function (data) {
                        //alert(data);
                        if (data) {
                            $('.showallhaulier').html(data);
                        }
                    });

            $('#dialog-modal1').dialog({
                modal: true,
                autoOpen: false
            });
            $('#dialog-modal1').dialog('open');
        });

        $(document).on("click", ".sendquery", function (event) {
            event.preventDefault();
            var job_id = $("#job_id").val();
            var haulier_id = $("#haulier_id").val();
            var admin_replay = $("#load_descccc").val();
            if (admin_replay == "") {
                alert('Please enter message.');
                $('#load_descccc').focus();
                return false;
            }
            $.post("tasks.php", {adminsenddesc: 'adminsenddesc', job_id: job_id, haulier_id: haulier_id, admin_replay: admin_replay},
                    function (data) {
                        if (data == 1) {
                            $('<div class="me">Me:</div><div class="adminrply">' + admin_replay + '</div>').appendTo('#region');
                            $('#load_descccc').val('');
                            //alert('More information has successfully been sent to haulier.');
                        }
                    });
        });

        $(".cassign").click(function (event) {
            event.preventDefault();
            var job_id = $(this).attr('job_id');
            $.post("tasks.php", {showallhauliersforprice: 'showallhauliersforprice', job_id: job_id},
                    function (data) {
                        $('.pricepound').html(data);
                    });
            $(this).colorbox({width: "80%", height: "60%", scrolling: 'true', inline: true, href: "#hauliershowprice"});
        });

        $(".assignjob").click(function (event) {
            event.preventDefault();
            var job_id = $(this).attr('job_id');
            $("#search_job_id").val(job_id);
            $.post("tasks.php", {assignjob: 'assignjob', job_id: job_id},
                    function (data) {
                        //alert(data);
                        $('.reponsehaulier').html(data);
                    });
            $(this).colorbox({width: "80%", height: "60%", scrolling: 'true', inline: true, href: "#assignhauliers"});
        });

        $("#finaljob").click(function (event) {
            event.preventDefault();
            var job_id = $("#job_id").val();
            var uemail = $("#uemail").val();
            var hemail = $("#hemail").val();
            var haulier_id = $("input[name=radio]:checked").val();
            if (!$("input[name='radio']:checked").val()) {
                alert('No haulier is selected!');
                return false;
            }
            $.post("tasks.php", {finaljobassign: 'finaljobassign', job_id: job_id, haulier_id: haulier_id, uemail: uemail, hemail: hemail},
                    function (data) {
                        //alert(data);
                        if (data == 1) {
                            alert('This job has successfully been  assigned to haulier.');
                            document.location.href = '.?url=quotes';
                        }
                    });

        });

        $(document).on("click", "#search1", function (event) {
            event.preventDefault();
            var haulieremail = $("#haulieremail").val();
            var haulieraddress = $("#haulieraddress").val();
            var job = $("#search_job_id").val();
            //alert(haulieraddress);
            $.post("tasks.php", {searchfinalhaulier: 'searchfinalhaulier', haulieremail: haulieremail, haulieraddress: haulieraddress, job: job},
                    function (data) {
                        //alert(data);
                        $('.replace').html(data);
                    });
        });

        $("#sendprice").click(function (event) {
            event.preventDefault();
            var job_id = $("#job_id").val();
            var adminprice = $("#adminprice").val();
            if (adminprice == "") {
                $('#amterror').show();
                $('#adminprice').focus();
                return false;
            }
            $.post("tasks.php", {adminprice: 'adminprice', job_id: job_id, adminprice: adminprice},
                    function (data) {
                        // alert(data);
                        if (data == 1) {
                            alert('Price for this job has successfully been sent.');
                            document.location.href = '.?url=quotes';
                        }
                    });
        });

        $(".senddate").submit(function (event) {
            event.preventDefault();
            var $product_id = $(this).find('input[name="job_id"]');
            var job_id = $product_id.val();
            var $customers = $(this).find('input[name="customer"]');
            var customer = $customers.val();
            if (customer == '') {
                alert('Please insert tender due date for customer.');
                return false;
            }
            $.post("tasks.php", {customerduedate: 'customerduedate', job_id: job_id, customer: customer},
                    function (data) {
                        alert('Date has successfully been saved.');
                        window.location.reload();
                    });
        });

        $(".senddatehaulier").submit(function (event) {
            event.preventDefault();
            var $product = $(this).find('input[name="job_id"]');
            var job_id = $product.val();
            var $product_id = $(this).find('input[name="haulier_id"]');
            var haulier_id = $product_id.val();
            var $haulier = $(this).find('input[name="haulier"]');
            var haulier = $haulier.val();
            if (haulier == '') {
                alert('Please insert tender due date for haulier.');
                return false;
            }
            $.post("tasks.php", {haulierduedate: 'haulierduedate', haulier_id: haulier_id, haulier: haulier, job_id: job_id},
                    function (data) {
                        //alert(data);
                        alert('Date has successfully been saved.');
                        window.location.reload();
                    });
        });

        $(".ticketdownload").click(function (event) {
            event.preventDefault();
            var job_id = $(this).attr('job_id');
            $.post("tasks.php", {tktdownload: 'tktdownload', job_id: job_id},
                    function (data) {
                        //alert(data);
                        $('.download').html(data);
                    });
            $(this).colorbox({width: "30%", height: "30%", scrolling: 'true', inline: true, href: "#showticket"});
        });

        $(document).on("click", ".deletetickt", function (event) {
            event.preventDefault();
            var file = $(this).attr('file');
            var id = $(this).attr('id');
            var path = $(this).attr('path');
            $.post("tasks.php", {deletetkt: 'tktdownload', file: file, id: id, path: path},
                    function (data) {
                        //alert(data);
                        if (data == 1) {
                            alert('File has succesfully been deleted.');
                            window.location.reload();
                        }
                    });
        });

        $('.invoice_status').change(function (event) {
            event.preventDefault();
            var job_id = $('option:selected', this).attr('job_id');
            var status = $('option:selected', this).val();
            $.post("tasks.php", {updatestatus: 'updatestatus', job_id: job_id, status: status},
                    function (data)
                    {
                        //alert(data);
                        if (data == 1) {
                            alert('Job status has successfully been changed.');
                            window.location.reload();
                        }
                    });
        });
    });
</script>
<!---------user account section------->


<div  style="margin-top:50px">
    <div class="container-fluid">
        <div class="control_console admin-jobs spacer-40">
            <div class="dashboard"><a href=".?url=dashboard" class="btn btn-success">Dashboard</a></div>
            <ul class="nav nav-tabs">
                <!--<li class="active"><a data-toggle="tab" href="#sectionA">REQUEST QUOTES</a></li>
                <li><a data-toggle="tab" href="#sectionB">PENDING QUOTES</a></li>-->
                <li class="active"><a data-toggle="tab" href="#sectionC">RESPONSE QUOTES</a></li>
                <li><a data-toggle="tab" href="#sectionD">Send price to customer</a></li>
                <li><a data-toggle="tab" href="#sectionE">ASSIGN JOB</a></li>
                <li><a data-toggle="tab" href="#sectionF">Add Tender Date</a></li>
                <li><a data-toggle="tab" href="#sectionG">Change Job Status</a></li>
            </ul>
            <div class="tab-content">
                <!--<div id="sectionA" class="tab-pane fade in active">
                        <div class="open_jobs">
                                <div class="table-responsive">
                                        <table class="table table-responsive table-bordered table-striped">
                                                <thead>
                                                        <tr>
                                                                <th>Job Id</th>
                                                                <th>Customer Details</th>
                                                                <th>Address</th>
                                                                <th>Tenders Due By</th>
                                                                <th>Loads Required</th>
                                                                <th>Lorry Required</th>
                                                                <th>Vehicle Type</th>
                                                                <th>Action</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                <?php $objview->requestquotes(); ?>
                                        </tbody>
                                        </table>
                                </div>
                        </div>
                </div>
                
                <div id="sectionB" class="tab-pane fade">
                        <div class="assign_jobs">
                                <div class="table-responsive">
                                        <table class="table table-responsive table-bordered table-striped">
                                                <thead>
                                                        <tr>
                                                                <th>Job Id</th>
                                                                <th>Customer Details</th>
                                                                <th>Tenders Due By</th>
                                                                <th>Loads Required</th>
                                                                <th>Lorry Required</th>
                                                                <th>Vehicle Type</th>
                                                                <th>Status</th>
                                                                <th>More Info</th> 
                                                        </tr>
                                                </thead>
                                                <tbody>
                <?php $quotes->viewquotes(); ?>
                                                </tbody>
                                        </table>
                                </div>
                        </div>
                </div>-->

                <div id="sectionC" class="tab-pane fade in active">
                    <div class="assign_jobs">
                        <div class="table-responsive">
                            <table class="table table-responsive table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Job Id</th>
                                        <th>Haulier Details</th>
                                        <th>Amount</th>
                                        <th>Customer Name</th>
                                        <th>Site Address</th>
                                        <th>Lorry Required</th>
                                        <th>Start Date</th>
                                        <th>Tenders Due By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $quotes->haulierresponse(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="sectionD" class="tab-pane fade">
                    <div class="assign_jobs">
                        <div class="table-responsive">
                            <table class="table table-responsive table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Job Id</th>
                                        <th>Customer Name</th>
                                        <th>Company Name</th>
                                        <th>Site Address</th>
                                        <th>Lorry Required</th>
                                        <th>No Of Load</th>
                                        <th>Start Date</th>
                                        <th>Tenders Due By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $quotes->customersend(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="sectionE" class="tab-pane fade">
                    <div class="assign_jobs">
                        <div class="table-responsive">
                            <table class="table table-responsive table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Job Id</th>
                                        <th>Customer Details</th>
                                        <th>Address</th>
                                        <th>Tenders Due By</th>
                                        <th>Loads Required</th>
                                        <th>Lorry Required</th>
                                        <th>Vehicle Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $quotes->assignjob(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="sectionF" class="tab-pane fade">
                    <div class="open_jobs">
                        <div class="table-responsive">
                            <table class="table table-responsive table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Job Id</th>
                                        <th>Customer Details</th>
                                        <th>Site Address</th>
                                        <th>Start Date</th>
                                        <th>Tenders Due By</th>
                                        <th>Tickets</th>
                                        <th>Payment Due Date</br><span class="cmnt">(Customer)</span></th>
                                        <th>Haulier Details</th>
                                        <th>Payment Due Date</br><span class="cmnt">(Haulier)</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $quotes->setdate(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="sectionG" class="tab-pane fade">
                    <div class="open_jobs">
                        <div class="table-responsive">
                            <table class="table table-responsive table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Job Id</th>
                                        <th>Customer Details</th>
                                        <th>Site Address</th>
                                        <th>Start Date</th>
                                        <th>Tenders Due By</th>
                                        <th>Current Status</th>
                                        <th>Haulier Details</th>
                                        <th>Change Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $quotes->changestatus(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div style='display: none;'>
    <div id='hauliershow' class='event_popup'>
        <form name="request_job" method="post">
            <form name="search" id="search" method="post">
                <div class="col-md-12">
                    <input type="email" id="email" name="email" class="form-control search" placeholder="Email"/>
                    <input type="text" id="address" name="address" class="form-control search" placeholder="address"/>
                    <input type="submit" id="search" value="search" class="btn btn-success search">
                </div>
            </form>
            <div class="test"></div>
            <div class="searchhaulier"></div>
            <?php //$quotes->showhaulier(); ?>
            <input type="submit" id="request" value="Request Quotes" class="btn btn-success">
        </form>
    </div>
</div>

<div style='display: none;'>
    <div id='assignhauliers' class='event_popup'>
        <form name="assignjobfinal" id="assignjobfinal" method="post">
            <form name="search1" id="search1" method="post">
                <div class="col-md-12">
                    <input type="email" id="haulieremail" name="haulieremail" class="form-control search" placeholder="Email"/>
                    <input type="text" id="haulieraddress" name="haulieraddress" class="form-control search" placeholder="address"/>
                    <input type="hidden" id="search_job_id" name="search_job_id" value="">
                    <input type="submit" id="search1" value="search" class="btn btn-success search">
                </div>
            </form>
            <div class="reponsehaulier"></div>
            <div class="searchhaulierresponse"></div>
            <input type="submit" id="finaljob" value="Assign Job" class="btn btn-success">
        </form>
    </div>
</div>

<div style='display: none;'>
    <div class="chatsssss" id="chats"></div>
</div>

<div id="dialog-modal" class="chats"></div>

<div id="dialog-modal1" class="showallhaulier"></div>	

<div style='display: none;'>
    <div id='hauliershowprice' class='event_popup'>
        <form name="amt" id="amt" method="post">
            <div class="pricepound"></div>
            <div class="col-md-12 row">
                <div class="form-group col-md-4">
                    <label class="sr-only" for="exampleInputAmount">Amount (in pounds)</label>
                    <div class="input-group">
                        <div class="input-group-addon">&pound;</div>
                        <input type="text" class="form-control col-md-4" value="" name="adminprice" placeholder="Please insert your price.." id="adminprice" >
                        <div class="input-group-addon">.00</div>
                    </div>
                </div>
                <div class="callout col-md-4" style="display:none;margin:0" id="amterror">Please Provide amount..</div>
            </div>
            <input type="submit" id="sendprice" value="Send price" class="btn btn-success">
        </form>
    </div>
</div>

<div style='display: none;'>
    <div id='showticket' class='download'></div>
</div>