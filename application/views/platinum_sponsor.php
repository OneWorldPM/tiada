<!-- SECTION -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
<style>
    .icon-home {
        color: #ae0201;
        font-size: 1.5em;
        font-weight: 700;
        vertical-align: middle;
    }

    .box-home {
        background-color: #fff;
        /*border-radius: 30px*/;
        /*background: rgba(250, 250, 250, 0.8);*/
        width: 240px;
        height: 190px;
        cursor: pointer;
    }

</style>
<a href="<?= base_url() ?>sponsor/filter_search" style="text-align: center; color: #fffef0; font-weight: 900;position: absolute;margin-left:37.2%;margin-top: 30%;z-index: 10; font-size: 31px;">Check out the exhibits!</a>
<div style="background-image: url(<?= base_url() ?>front_assets/images/tiada_new_platinum_cover.png); background-attachment: fixed; background-size: cover !important; background-position: center center !important; height: 4000px">
    <section class="parallax" style="position: fixed !important;">
        <div class="container container-fullscreen">
            <div class="text-middle" style="vertical-align: top !important;">
                <div class="row">
                    <!--                <div class="col-md-12">
                                    <div class="text-center m-t-0">
                                        <h1 style="color: orange; font-family: 'Architects Daughter', cursive; margin-bottom: 0px; font-weight: 700; font-size: 40px;">Welcome, <?= $this->session->userdata('cname') ?></h1>
                                    </div>
                                </div>-->
<!--                    <div class="row">-->
<!--                        --><?php
//                        if (isset($all_sponsor) && !empty($all_sponsor)) {
//                            $i = 1;
//
//                            foreach ($all_sponsor as $val) {
//                                if ($val->sponsors_id == 18 || $val->sponsors_id == 22){
////                                    $backgroundRemover = 'style="background: none !important;"';
//                                    $backgroundRemover = '';
//                                }else{
//                                    $backgroundRemover = '';
//                                }
//                                if ($i % 2 == 1){
//
//                                ?>
<!--                                <div class="col-md-6 p-l-35">-->
<!--                                    <span class="icon-home">-->
<!--                                        <div class="col-lg box-home text-center" --><?//=$backgroundRemover?><!-- onclick="window.location='--><?//= base_url() ?><!--sponsor/view/<?//= $val->sponsors_id ?>';">
                                           <!-- <img src="<?//= base_url() ?> uploads/sponsors/<?//= $val->sponsors_logo ?>" alt="welcome" style="max-width: 160px">-->
<!--                                        </div>-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                                --><?php
//                                $i++;
//                                }else{
//                                    ?>
<!---->
<!--                                    <div class="col-md-6 p-r-35" style="text-align: -webkit-right; text-align: -moz-right; text-align: -o-right; text-align: -ms-right;">-->
<!--                                        <span class="icon-home">-->
<!--                                            <div class="col-lg box-home text-center" --><?//=$backgroundRemover?><!--  onclick="window.location='--><?//= base_url() ?><!--sponsor/view/<?//= $val->sponsors_id ?>';">
                                                <!-- <img src="<?//= base_url() ?>uploads/sponsors/<?//= $val->sponsors_logo ?>" alt="welcome" style="max-width: 160px">-->
<!--                                            </div>-->
<!--                                        </span>-->
<!--                                    </div>-->
<!---->
<!--                                    --><?php
//                                    $i++;
//                                }
//                            }
//                        }
//                        ?>
<!--                    </div>-->
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="push_notification" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true" style="display: none; text-align: left; right: unset;">
    <input type="hidden" id="push_notification_id" value="">
    <div class="modal-dialog">
        <div class="modal-content" style="border: 1px solid #ae0201;">
            <div class="modal-body">
                <div class="row" style="padding-top: 10px; padding-bottom: 20px;">
                    <div class="col-sm-12">
                        <div style="color:#ae0201; font-size: 16px; font-weight: 800; " id="push_notification_message"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close" style="padding: 10px; color: #fff; background-color: #ae0201; opacity: 1;" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var page_link = $(location).attr('href');
        var user_id = <?= $this->session->userdata("cid") ?>;
        var page_name = "Sponsor";
        $.ajax({
            url: "<?= base_url() ?>home/add_user_activity",
            type: "post",
            data: {'user_id': user_id, 'page_name': page_name, 'page_link': page_link},
            dataType: "json",
            success: function (data) {
            }
        });

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        push_notification_admin();
        setInterval(push_notification_admin, 43000000);
        function push_notification_admin()
        {
            var push_notification_id = $("#push_notification_id").val();

            $.ajax({
                url: "<?= base_url() ?>push_notification/get_push_notification_admin",
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (data.status == "success") {
                        if (push_notification_id == "0") {
                            $("#push_notification_id").val(data.result.push_notification_id);
                        }
                        if (push_notification_id != data.result.push_notification_id) {
                            $("#push_notification_id").val(data.result.push_notification_id);
                            $('#push_notification').modal('show');
                            $("#push_notification_message").text(data.result.message);
                        }
                    } else {
                        $('#push_notification').modal('hide');
                    }
                }
            });
        }
    });
</script>

