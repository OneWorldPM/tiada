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
        max-width: 270px;
        min-width: 270px;
        min-height: 270px;
        max-height: 270px;
        padding: 15px;
    }
    .box-home_2 {
        background-color: #444;
        border-radius: 30px;
        background: rgba(250, 250, 250, 0.8);
        max-width: 185px;
        min-width: 120px;
        min-height: 160px;
        max-height: 185px;
        padding: 15px;
        padding: 0px !important;
    }

    .fa {
        font-weight: 900;
    }

    @media (min-width: 768px) and (max-width: 1000px)  {
        #home_first_section{
            height: 550px;
        }
    }

    @media (min-width: 1000px) and (max-width: 1400px)  {
        #home_first_section{
            height: 590px;
        }
    }

    @media (min-width: 1400px) and (max-width: 1600px)  {
        #home_first_section{
            height: 700px;
        }
    }

    @media (min-width: 1600px) and (max-width: 1800px)  {
        #home_first_section{
            height: 800px;
        }
    }

    @media (min-width: 1800px) and (max-width: 2200px)  {
        #home_first_section{
            height: 900px;
        }
    }

    @media (min-width: 2200px) and (max-width: 2800px)  {
        #home_first_section{
            height: 1100px;
        }
    }
    @media (min-width: 2800px) and (max-width: 3200px)  {
        #home_first_section{
            height: 1450px;
        }
    }

    @media (min-width: 3200px) and (max-width: 4200px)  {
        #home_first_section{
            height: 1950px;
        }
    }

    @media (min-width: 4200px) and (max-width: 6000px)  {
        #home_first_section{
            height: 2150px;
        }
    }
</style>
<section class="parallax" style="background-image: url(<?= base_url() ?>front_assets/images/Other_Expo_Background.jpg); top: 0; padding-top: 20px;">
    <div class="container container-fullscreen" id="home_first_section">
        <div class="text-bottom">
            <div class="row">
                <div class="col-md-12" style="text-align: -webkit-center; text-align: -moz-center; margin-left: 45px;">

                </div>

            </div> 
        </div>
    </div>
</div>
<div class="chat-popup" id="supportChat">
    <form action="#" class="form-container">
        <h3>Support Chat</h3>

        <label for="msg"><b>Admin</b></label>
        <div class="support-chat-body">
            <ul class="support-chat-list">
            </ul>
        </div>
        <input type="text" class="form-control support-chat-message" placeholder="Enter your message here...">
        <button id="send-support-message-btn" type="button" class="btn">Send</button>
        <button id="close-support-request" type="button" class="btn cancel">Close</button>
    </form>
</div>
</section>

<script>
    var page_link = $(location).attr('href');
    var user_id = <?= $this->session->userdata("cid") ?>;
    var page_name = "User Dashboard";
    var user_name = "<?= $this->session->userdata('fullname') ?>";
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            url: "<?= base_url() ?>home/add_user_activity",
            type: "post",
            data: {'user_id': user_id, 'page_name': page_name, 'page_link': page_link},
            dataType: "json",
            success: function (data) {
            }
        });


        $('#btn_lounge').on('click', function () {
            alertify.alert('Opening Soon!');
        });

    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@9.17.0/dist/sweetalert2.all.min.js"></script>
<link href="<?= base_url() ?>assets/support-chat/support-chat.css?v=<?= rand(1, 100) ?>" rel="stylesheet">
<script src="<?= base_url() ?>assets/support-chat/support-chat.js?v=<?= rand(1, 100) ?>"></script>
