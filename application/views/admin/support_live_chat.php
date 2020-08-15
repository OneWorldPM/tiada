<?php
if (isset($status) && $status == 1){
    $statusFixer = 'true';
    $statusText = 'Support is enabled';
}else{
    $statusFixer = 'false';
    $statusText = 'Support is disabled';
}
?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<div class="main-content" >
    <div class="wrap-content container" id="container">
        <form name="frm_credit" id="frm_credit" method="POST" action="">
            <div class="container-fluid container-fullw bg-white">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-primary" id="panel5">
                            <div class="panel-heading">
                                <h4 class="panel-title text-white">Support - Live Chat</h4>
                            </div>
                            <div class="panel-body bg-white" style="border: 1px solid #b2b7bb;">
                                <div class="row">
                                    <label>
                                        <input id="status-btn" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" checked="<?=$statusFixer?>">
                                        <span class="status-text"><?=$statusText?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                </div>
            </div>
        </form>
        <!-- end: DYNAMIC TABLE -->
    </div>
</div>

</div>


<script>
    $(function() {

        $('#status-btn').change(function() {
            var status = $(this).prop('checked');

            if (status == 'true'){
                $('.status-text').html('Support is enabled');
            }else{
                $('.status-text').html('Support is disabled');
            }

            $.get("/tiadaannualconference/admin/Support_Live_Chat/chageStatus/"+status, function (status) {
                console.log(status);
            });
        })

    });
</script>





