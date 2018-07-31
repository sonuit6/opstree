<?php
session_start();
$log->chk_login();
error_reporting(0);
?>
<script>
    $(document).ready(function () {
        $(document).on("click", ".acceptjob", function (event) {
            event.preventDefault();
            if (confirm('Are you sure, You want to accept this job?')) {
                var job_id = $("#job_id_re").val();
                var haulier_id = $("#haulier_id_re").val();
                var job_remark = $("#job_remark").val();
                var admin_price = $("#admin_price").val();
                $.post("tasks.php", {acceptjob: 'acceptjob', job_id: job_id, haulier_id: haulier_id, job_remark: job_remark, admin_price: admin_price},
                        function (data) {
                            if (data == 1) {
                                alert('This job has successfully been accepted.');
                                window.location = ".?url=view-price";
                                $("#addremark").css({"display": "none"});
                            }
                        });
            } else {
                return false
            }
        });

        $(document).on("click", ".rejectjob", function (event) {
            event.preventDefault();
            if (confirm('Are you sure you want to reject this price?')) {
                var job_id = $(this).attr('job_id');
                var haulier_id = $(this).attr('haulier_id');
                var admin_price = $(this).attr('admin_price');
                $.post("tasks.php", {rejectjob: 'rejectjob', job_id: job_id, haulier_id: haulier_id, admin_price: admin_price},
                        function (data) {
                            //alert(data);
                            if (parseInt(data) == 1) {
                                alert('This price has successfully been rejected.');
                                window.location = ".?url=view-price";
                            }
                        });

            } else {
                return false
            }
        });

        $(function () {
            $(".readmore").click(function () {
                var id = $(this).attr('jobid');
                $(this).colorbox({width: "740px", height: "auto", scrolling: 'false', inline: true, href: "#popup_" + id});
            });
        });

        $(document).on("click", ".bookmoreload", function (event) {
            event.preventDefault();
            var job_id = $(this).attr('job_id');
            $('#moreload_' + job_id).css("display", "block");
            $('readmore_popup').css("display", "none");
        });

        $("form").submit(function (event) {
            event.preventDefault();
            var $product_id = $(this).find('input[name="moreload"]');
            var no_of_load = $product_id.val();
            var $job_id = $(this).find('input[name="job_id"]');
            var job_id = $job_id.val();
            if (no_of_load == '') {
                alert('Please insert no of more loads.');
                return false;
            }
            $.post("tasks.php", {moreloadrequired: 'moreloadrequired', no_of_load: no_of_load, job_id: job_id},
                    function (data) {
                        //alert(data);
                        if (data == 1) {
                            alert(no_of_load + ' more loads request has successfully been submitted .');
                            window.location = ".?url=view-price";
                        }
                    });
        });

        $(".viewjob").click(function (event) {
            event.preventDefault();
            var job_id = $(this).attr('view-id');
            $.post("tasks.php", {vjob: 'vjob', job_id: job_id},
                    function (data) {
                        $('.vjob').html(data);
                    });
            $(this).colorbox({width: "50%", height: "80%", scrolling: 'true', inline: true, href: "#ddescshow"});
        });

        $(".remark_job").click(function (event) {
            var job_id = $(this).attr('job_id');
            var haulier_id = $(this).attr('haulier_id');
            var admin_price = $(this).attr('admin_price');
            $("#job_id_re").val(job_id);
            $("#haulier_id_re").val(haulier_id);
            $("#admin_price").val(admin_price);
            $("#addremark").css({"display": "block"});
            $(this).colorbox({width: "60%", height: "50%", scrolling: 'true', inline: true, href: "#addremark"})
        });
    });
</script>

<!---------user account section------->
<div  style="margin-top:50px">
    <div class="container-fluid">
        <div class="control_console admin-jobs spacer-40">
            <div class="dashboard"><a href=".?url=dashboard" class="btn btn-success">Dashboard</a></div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#sectionA">Booked Lorry Details</a></li>
                <!--<li><a data-toggle="tab" href="#sectionB">View Price & Generate Orders</a></li>
                <li><a data-toggle="tab" href="#sectionC">Tenders</a></li>-->
            </ul>
            <div class="tab-content">
                <div id="sectionA" class="tab-pane fade in active">
                    <div class="open_jobs">
                        <div class="table-responsive">
                            <table class="table table-responsive table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Job Id</th>
                                        <th>Job Details</th>
                                        <th>Address</th>
                                        <th>Haulier Details</th>
                                        <th>Price Accepted</th>
                                        <th>Billing Date</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $bal->viewjobtocustomer(); ?>
                                </tbody>
                            </table>	
                        </div>
                    </div>
                </div>
                <!--<div id="sectionB" class="tab-pane fade">
                        <div class="open_jobs">
                                <div class="table-responsive">
                                        <p><b>Current Orders:</b></p><br />
                <?php $ten->customercurrentorder(); ?>
                                </div>
                        </div>
                </div>
                <div id="sectionC" class="tab-pane fade">
                        <div class="open_jobs">
                        <div class="table-responsive">
                                <table class="table table-responsive table-bordered table-striped">
                <?php $ten->tenderacceptreject(); ?>
                                </tbody>
                                </table>  
                        </div>
                        </div>
                </div>-->
            </div>
        </div>
    </div>
</div>
<div style='display: none;'>
    <div class="vjob" id="ddescshow"></div>
</div>

<div id="addremark" class="jobdesc" style="display:none;">
    <div class="row">
        <input type="hidden" name="job_id_re" id="job_id_re" value="" />
        <input type="hidden" name="haulier_id_re" id="haulier_id_re" value="" />
        <input type="hidden" name="admin_price" id="admin_price" value="" />
        <div class="col-md-12">
            <label for="remark">Add Remark</label>
            <textarea style="resize:none;" placeholder="Enter remark here..." class="form-control" id="job_remark" name="job_remark" rows="3"></textarea>
        </div>
        <div class="col-md-12">
            <input type="button" name="accept" class="btn btn-success acceptjob" value="Accept" style="float:right;" />
        </div>
    </div>
</div>