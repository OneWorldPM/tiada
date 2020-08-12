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
        background-color: #444;
        border-radius: 30px;
        background: rgba(250, 250, 250, 0.8);
        width: 235px;
        height: 107px;
        padding: 15px;
    }

</style>
<div style="background-image: url(<?= base_url() ?>front_assets/images/new_expo_background.jpg); background-attachment: fixed; background-size: cover !important; background-position: center center !important; height: 4000px">
    <section class="parallax" style="position: fixed !important;">
        <div class="container container-fullscreen">
            <div class="text-middle" style="vertical-align: top !important;">
                <div class="row">
                    <!--                <div class="col-md-12">
                                    <div class="text-center m-t-0">
                                        <h1 style="color: orange; font-family: 'Architects Daughter', cursive; margin-bottom: 0px; font-weight: 700; font-size: 40px;">Welcome, <?= $this->session->userdata('cname') ?></h1>
                                    </div>
                                </div>-->
                    <div class="row">
                        <?php
                        if (isset($all_sponsor) && !empty($all_sponsor)) {
                            $i = 1;

                            foreach ($all_sponsor as $val) {
                                if ($val->sponsors_id == 18 || $val->sponsors_id == 22){
                                    $backgroundRemover = 'style="background: none !important;"';
                                }else{
                                    $backgroundRemover = '';
                                }
                                if ($i % 2 == 1){

                                ?>
                                <div class="col-md-6 m-b-10 p-l-35">
                                    <a class="icon-home" href="<?= base_url() ?>sponsor/view/<?= $val->sponsors_id ?>">
                                        <div class="col-lg box-home text-center" <?=$backgroundRemover?>>
                                            <img src="<?= base_url() ?>uploads/sponsors/<?= $val->sponsors_logo ?>" alt="welcome" style="max-width: 65px">
                                            <h4><?= $val->company_name ?></h4>
                                        </div>
                                    </a>
                                </div>
                                <?php
                                $i++;
                                }else{
                                    ?>

                                    <div class="col-md-6 m-b-10 p-r-35" style="text-align: -webkit-right; text-align: -moz-right; text-align: -o-right; text-align: -ms-right;">
                                        <a class="icon-home" href="<?= base_url() ?>sponsor/view/<?= $val->sponsors_id ?>">
                                            <div class="col-lg box-home text-center <?=$backgroundRemover?>">
                                                <img src="<?= base_url() ?>uploads/sponsors/<?= $val->sponsors_logo ?>" alt="welcome" style="max-width: 65px">
                                                <h4><?= $val->company_name ?></h4>
                                            </div>
                                        </a>
                                    </div>

                                    <?php
                                    $i++;
                                }
                            }
                        }
                        ?>
                    </div>
                    <a href="<?= base_url() ?>sponsor/other_sponsor"><h1 style="text-align: center; color: #fffef0; font-weight: 900;">Check out more exhibitors!</h1></a>
                </div>
            </div>
        </div>
    </section>
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
