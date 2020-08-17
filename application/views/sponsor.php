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
        /*background-color: #444;*/
        border-radius: 30px;
        /*background: rgba(250, 250, 250, 0.8);*/
        max-width: 250px;
        min-width: 250px;
        min-height: 150px;
        max-height: 150px;
        padding: 15px;
    }

    .glow{
        border: 2px solid #f0f02b;;
        -webkit-transition: border 0.1s linear, box-shadow 0.1s linear;
        -moz-transition: border 0.1s linear, box-shadow 0.1s linear;
        transition: border 0.1s linear, box-shadow 0.1s linear;
    }

    .glow.active {
        border-color: #fdff44;
        -webkit-box-shadow: #fdff44;
        -moz-box-shadow: #fdff44;
        box-shadow: #fdff44;
    }

</style>
<section class="parallax" style="background-image: url(<?= base_url() ?>front_assets/images/Other_Expo_Background.jpg); top: 0; padding-top: 0px;">
    <div class="container container-fullscreen">
        <div class="text-middle">
            <div class="row m-t-30">
                <div class="row">
                    <form action="<?= base_url() ?>sponsor/filter_search" method="post" id="frm_search_data" name="frm_search_data">
                        <div class="col-md-2" style="margin-top:10px;">
                            <div class="input-groug">
                                <select id="sponsors_category" name="sponsors_category" class="form-control">
                                    <option value="">Filter By Category</option>
                                    <?php
                                    if (isset($sponsors_category) && !empty($sponsors_category)) {
                                        foreach ($sponsors_category as $val) {
                                            if ($val->sponsors_category_id != 2 && $val->sponsors_category_id != 5 && $val->sponsors_category_id != 11 && $val->sponsors_category_id != 12 && $val->sponsors_category_id != 14 && $val->sponsors_category_id != 16 && $val->sponsors_category_id != 21 && $val->sponsors_category_id != 22) {
                                                ?>
                                                <option value="<?= $val->sponsors_category_id ?>"><?= $val->category_name ?></option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2" style="margin-top:10px;">
                            <div class="input-groug">
                                <select id="sponsors_type" name="sponsors_type" class="form-control">
                                    <option value="">Filter By Level</option>
									<option value="">All</option>
                                    <option value="platinum">Platinum</option>
                                    <option value="gold">Gold</option>
                                    <option value="silver">Silver</option>
                                    <option value="bronze">Bronze</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3" style="margin-top:10px;">
                            <div class="input-groug">
                                <input type="text" name="searchbox" id="searchbox" class="form-control" value="" placeholder="Search Box">
                            </div>
                        </div>
                        <div class="col-md-3" style="margin-top:10px;">
                            <button type="submit" id="btn_search" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <!--                <div class="col-md-12">
                                    <div class="text-center m-t-0">
                                        <h1 style="color: orange; font-family: 'Architects Daughter', cursive; margin-bottom: 0px; font-weight: 700; font-size: 40px;">Welcome, <?= $this->session->userdata('cname') ?></h1>
                                    </div>
                                </div>-->
                <div class="col-md-12 m-t-30" style="text-align: -webkit-center; min-height: 600px;">
                    <div class="row glow">
                        <?php
                        if (isset($platinum_sponsors) && !empty($platinum_sponsors)) {
                            foreach ($platinum_sponsors as $val) {
                                ?>
                                <div class="col-md-3 col-sm-12" style="margin-bottom:40px;">
                                    <a class="icon-home" href="<?= base_url() ?>sponsor/view/<?= $val->sponsors_id ?>">
                                        <div class="col-lg box-home text-center">
                                            <img src="<?= base_url() ?>uploads/sponsors/<?= $val->sponsors_logo ?>" alt="welcome" style="max-width: 200px; max-height: 130px">
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
					<?php
                    if (isset($gold_sponsors) && !empty($gold_sponsors)) {
                        foreach ($gold_sponsors as $val) {
                            ?>
                            <div class="col-md-3 col-sm-12" style="margin-bottom:40px;">
                                <a class="icon-home" href="<?= base_url() ?>sponsor/view/<?= $val->sponsors_id ?>"> 
                                    <div class="col-lg box-home text-center">
                                        <img src="<?= base_url() ?>uploads/sponsors/<?= $val->sponsors_logo ?>" alt="welcome" style="max-width: 100px">
                                        <h4><?= $val->company_name ?></h4>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <?php
                    if (isset($silver_sponsors) && !empty($silver_sponsors)) {
                        foreach ($silver_sponsors as $val) {
                            ?>
                            <div class="col-md-3 col-sm-12" style="margin-bottom:40px;">
                                <a class="icon-home" href="<?= base_url() ?>sponsor/view/<?= $val->sponsors_id ?>"> 
                                    <div class="col-lg box-home text-center">
                                        <img src="<?= base_url() ?>uploads/sponsors/<?= $val->sponsors_logo ?>" alt="welcome" style="max-width: 100px">
                                        <h4><?= $val->company_name ?></h4>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <?php
                    if (isset($bronze_sponsors) && !empty($bronze_sponsors)) {
                        foreach ($bronze_sponsors as $val) {
                            ?>
                            <div class="col-md-3 col-sm-12" style="margin-bottom:40px;">
                                <a class="icon-home" href="<?= base_url() ?>sponsor/view/<?= $val->sponsors_id ?>"> 
                                    <div class="col-lg box-home text-center">
                                        <img src="<?= base_url() ?>uploads/sponsors/<?= $val->sponsors_logo ?>" alt="welcome" style="max-width: 100px">
                                        <h4><?= $val->company_name ?></h4>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <?php
                    /*if (isset($all_sponsor) && !empty($all_sponsor)) {
                        foreach ($all_sponsor as $val) {
                            ?>
                            <div class="col-md-3 col-sm-12" style="margin-bottom:40px;">
                                <a class="icon-home" href="<?= base_url() ?>sponsor/view/<?= $val->sponsors_id ?>"> 
                                    <div class="col-lg box-home text-center">
                                        <img src="<?= base_url() ?>uploads/sponsors/<?= $val->sponsors_logo ?>" alt="welcome" style="max-width: 100px">
                                        <h4><?= $val->company_name ?></h4>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    }*/
                    ?>
                </div> 
            </div>
        </div>
    </div>
</section>
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

//        $('#sponsors_category').on('change', function () {
//            $("#frm_search_data").submit();
//        });
//
//        $('#searchbox').on('blur', function () {
//            $("#frm_search_data").submit();
//        });

        var glower = $('.glow');
        window.setInterval(function () {
            glower.toggleClass('active');
        }, 200);

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        push_notification_admin();
        setInterval(push_notification_admin, 3000);
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
